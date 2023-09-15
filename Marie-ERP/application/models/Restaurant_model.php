<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Restaurant_model extends App_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_restaurant($id = '')
    {
        $this->db->where('restaurant_id', $id);

        return $this->db->get(db_prefix() . 'restaurant_registration')->result_array();
    }

    public function get_restaurant_types($id)
    {
        $this->db->select(db_prefix() . 'restaurant_type.name');
        $this->db->from(db_prefix() . 'restaurant_registration');
        $this->db->join(db_prefix() . 'restaurant_type', db_prefix() . 'restaurant_registration.business_type = ' . db_prefix() . 'restaurant_type.id');
        $this->db->where(db_prefix() . 'restaurant_registration.restaurant_id', $id);

        $result = $this->db->get()->result_array();
        return $result;
    }

    public function add_restaurant($data)
    {
        $data['datecreated'] = date('Y-m-d H:i:s');
        $restaurant_details = [
            'restaurant_name' => $data['restaurant_name'],
            'r_address' => $data['r_address'],
            'r_location' => $data['country'],
            'datecreated' => $data['datecreated'],
            'r_state' => $data['r_state'],
            'r_photo_image' => $data['profile_image'],
            'postcode' => $data['postcode'],
            'business_type' => $data['business_type'],
            'cuisine' => $data['cuisine_type']
        ];



        $restaurant_details = hooks()->apply_filters('before_add_kb_article', $restaurant_details);

        $this->db->insert(db_prefix() . 'restaurant', $restaurant_details);
        $insert_id = $this->db->insert_id();
        $customer_details = [
            'client_name' => $data['client_username'],
            'client_details' => $insert_id,
            'client_email' => $data['client_email'],
            'client_phone_number' => $data['client_phonenumber']
        ];
        $this->db->insert(db_prefix() . 'restaurant_client_details', $customer_details);
        if ($insert_id) {
            $this->db->select(db_prefix() . 'restaurant_client_details.client_name,' . db_prefix() . 'restaurant_client_details.client_email');
            $this->db->from(db_prefix() . 'restaurant_client_details');
            $this->db->join(db_prefix() . 'restaurant', db_prefix() . 'restaurant_client_details.client_details = ' . db_prefix() . 'restaurant.r_id', 'left');
            $this->db->where(db_prefix() . 'restaurant.r_id', $insert_id);
            // Array ( [0] => Array ( [client_name] => kiran [client_email] => kasfka@gmail.com ) )
            $data = $this->db->get()->result_array();
            $data = $data[0];
            $result = sendMail($data['client_name'], $data['client_email'], $insert_id);
            if ($result) {
                log_activity('New Restaurant Added [RestaurantID: ' . $insert_id . ']');
            }
        }
        return $insert_id;
    }

    public function add_restaurantBusiness($data, $id = '')
    {
        if ($id == '') {

            if ($data['group'] == 'basic_information') {
                unset($data['group']);
                $data['datecreated'] = date('Y-m-d H:i:s');

                $business_details = [
                    'business_name' => $data['business_name'],
                    'b_address' => $data['b_address'],
                    'b_postcode' => $data['b_postcode'],
                    'b_state' => $data['b_state'],
                    'b_country' => $data['b_country'],
                    'business_type' => $data['business_type'],
                    'seating_capacity' => $data['seating_capacity'],
                    'datecreated' => $data['datecreated']
                ];

                $this->db->insert('restaurant_registration', $business_details);
                if ($this->db->affected_rows() > 0) {
                    $insert_id = $this->db->insert_id();

                    $client_details = [
                        'client_user' => $insert_id,
                        'client_email' => $data['restaurant_mail'],
                        'client_password' => null
                    ];

                    $this->db->insert('client_details', $client_details);

                    if($data['payment_status'] == '1'){
                        $business_name  = $data['business_name'];
                        $business_email = $data['restaurant_mail'];
                        $user_id = $insert_id;
                        sendMail($business_name,$business_email,$user_id);
                    }
                    log_activity('New Restaurant Added [RestaurantID: ' . $insert_id . ']');
                    $dateString = $data['datecreated'];
                    $date = new DateTime($dateString);
                    $date->add(new DateInterval('P1Y'));
                    $date->sub(new DateInterval('P1D'));
                    $newDate = $date->format('Y-m-d');
                    $plan_details = [
                        'restaurant_user' => $insert_id,
                        'restaurant_plan' => $data['plans'],
                        'datecreated' => $data['datecreated'],
                        'nextduedate' => $newDate
                    ];
                    $this->db->insert('restaurant_user_plans', $plan_details);

                    return $insert_id;
                }
            } else {
                return false;
            }
        } else {

            $data['id'] = $id;
            if ($data['group'] == 'basic_information') {
                unset($data['group']);
                $this->restaurant_model->update_restaurant($data, $id);
            }elseif ($data['group'] == 'sales_channel') {
                unset($data['sales_channel']);
                $user_id = $id;
                $reach_data = $data['reach'];
                $sales_food = $data['food_values'];
                for ($i = 0; $i < count($reach_data); $i++) {
                    $sales_food_data = [
                        $reach_data[$i] => $sales_food[$i]
                    ];
                }
                $sales_beverages_data = $data['beverages_values'];
                if (empty($data['reach'])) {
                    $reachs = $data['reach'];
                    if (isset($reachs)) {
                        foreach ($reachs as $reach) {
                            $this->db->insert(db_prefix() . 'restaurant_reach_data', [
                                'r_id' => $user_id,
                                'reach'     => $reach,
                            ]);
                        }
                        return $id;
                    }
                }
            } 
        }
        return $id;
    }

    public function departments($data, $id)
    {
        $datecreated = date('Y-m-d H:i:s');

        $this->db->where('r_id', $id);
        $query = $this->db->get(db_prefix() . 'restaurant_department_data');

        if ($query->num_rows() > 0) {

            $this->db->where('r_id', $id);
            $this->db->delete(db_prefix() . 'restaurant_department_data');
        }
            $departments = $data['departments'];
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->insert(db_prefix() . 'restaurant_department_data', [
                        'r_id' => $id,
                        'department'     => $department,
                        'datecreated' => $datecreated,
                    ]);
                }
            }
            return $id;
    }

    public function sales_channel($data, $id){

        $this->db->where('r_id', $id);
        $getdata = $this->db->get(db_prefix() . 'restaurant_reach_data');

        if ($getdata->num_rows() > 0) {

            $this->db->where('r_id', $id);
            $this->db->delete(db_prefix() . 'restaurant_reach_data');
        }

        if (!empty($data['reach'])) {
            $reachs = $data['reach'];
            if (isset($reachs)) {
                foreach ($reachs as $reach) {
                    $this->db->insert(db_prefix() . 'restaurant_reach_data', [
                        'r_id' => $id,
                        'reach'     => $reach,
                    ]);
                }
                return $id;
            }
        } 
    }

    public function cuisine_types($data,$id){

        $this->db->where('r_id', $id);
        $query = $this->db->get(db_prefix() . 'cuisine_data');

        if ($query->num_rows() > 0) {

            $this->db->where('r_id', $id);
            $this->db->delete(db_prefix() . 'cuisine_data');
        }

        if (isset($data['cuisine'])) {
            $cuisine = $data['cuisine'];
        }
        if ($id) {
            if (isset($cuisine)) {
                foreach ($cuisine as $cuisines) {
                    $this->db->insert(db_prefix() . 'cuisine_data', [
                        'r_id' => $id,
                        'cuisine_id'     => $cuisines,
                    ]);
                }
            }
        }

        return $id;
    } 

    public function get_cuisine_types($id)
    {

        // $this->db->select(db_prefix() . 'cuisine_data.cuisine_id');
        // $this->db->from(db_prefix() . 'cuisine_data');
        // $this->db->join(db_prefix() . 'restaurant_registration', db_prefix() . 'restaurant_registration.restaurant_id = ' . db_prefix() . 'cuisine_data.r_id');
        // $this->db->where(db_prefix() . 'restaurant_registration.restaurant_id', $id);

        $this->db->where('r_id', $id);
        $cuisine_types = $this->db->get(db_prefix() . 'cuisine_data')->result_array();

        $cuisine_ids = array();
        if (!empty($cuisine_types)) {
            foreach ($cuisine_types as $innerArray) {
                $cuisine_ids[] = $innerArray["cuisine_id"];
            }
            return $cuisine_ids;
        }
    }

    public function get_salesChannel($id)
    {
        $this->db->select(db_prefix() . 'restaurant_reach_data.reach');
        $this->db->from(db_prefix() . 'restaurant_reach_data');
        $this->db->join(db_prefix() . 'restaurant_registration', db_prefix() . 'restaurant_registration.restaurant_id = ' . db_prefix() . 'restaurant_reach_data.r_id');
        $this->db->where(db_prefix() . 'restaurant_registration.restaurant_id', $id);

        $reach_types = $this->db->get()->result_array();

        if (!empty($reach_types)) {
            foreach ($reach_types as $innerReach) {
                $reach_ids[] = $innerReach["reach"];
            }


            return $reach_ids;
        } else {
            return false;
        }
    }


    public function check_email_by_id($id, $email)
    {
        $this->db->where('client_details', $id);
        $this->db->where('client_email', $email);
        $query = $this->db->get(db_prefix() . 'restaurant_client_details');

        return $query->num_rows() === 1;
    }

    public function update_password($id, $password)
    {
        $data = array(
            'passoword' => password_hash($password, PASSWORD_DEFAULT)
        );
        $this->db->where('client_details', $id);
        $this->db->update(db_prefix() . 'restaurant_client_details', $data);

        return true;
    }

    public function loginCheck($email, $password)
    {
        $this->db->select('*');
        $this->db->from('tblrestaurant_client_details');
        $this->db->where('client_email', $email);
        $data = $this->db->get()->result_array();
        $data = $data[0];
        $original_password = $password;
        $password = $data['passoword'];
        $result = password_verify($original_password, $password);
        if ($result) {
            return true;
        }
        return false;
    }





    public function update_restaurant($data, $id)
    {
        if (isset($data['plans'])) {
            $plans = $data['plans'];
            $name = $data['business_name'];
            $this->restaurant_model->update_plans($plans, $name);
            unset($data['plans']);
        }
        if (isset($data['name'])) {
            unset($data['name']);
        }
        if (isset($data['id'])) {
            unset($data['id']);
        }
        $this->db->where('restaurant_id', $id);
        $this->db->update(db_prefix() . 'restaurant_registration', $data);
        if ($this->db->affected_rows() > 0) {
            log_activity('Restaurant Updated [RestaurantID: ' . $id . ']');
            return $id;
        }
        return false;
    }

    public function delete_restaurant($id)
    {
        $this->db->where('restaurant_id', $id);
        $this->db->delete(db_prefix() . 'restaurant_registration');
        if ($this->db->affected_rows() > 0) {

            log_activity('Restaurant Deleted [restaurantID: ' . $id . ']');

            return true;
        }

        return false;
    }

    public function get($id)
    {
        $this->db->where('restaurant_id', $id);
        return $this->db->get(db_prefix() . 'restaurant_registration')->result_array();
    }

    public function get_cuisine($id)
    {
        $this->db->where('r_id', $id);
        return $this->db->get(db_prefix() . 'cuisine_data')->result_array();
    }

    public function get_sales_channel($id)
    {
        $this->db->where('r_id', $id);
        return $this->db->get(db_prefix() . 'restaurant_reach_data')->result_array();
    }

    public function get_plan($name)
    {
        $this->db->where('restaurant_user', $name);
        return $this->db->get(db_prefix() . 'restaurant_user_plans')->result_array();
    }

    public function get_departments($id)
    {
        $this->db->where('r_id', $id);
        $departments=$this->db->get(db_prefix() . 'restaurant_department_data')->result_array();

        $department = array();
            if (!empty($departments)) {
                foreach ($departments as $innerArray) {
                    $department[] = $innerArray["department"];
                }
                return $department;
            }


        {

            $this->db->select(db_prefix() . 'cuisine_data.cuisine_id');
            $this->db->from(db_prefix() . 'cuisine_data');
            $this->db->join(db_prefix() . 'restaurant_registration', db_prefix() . 'restaurant_registration.restaurant_id = ' . db_prefix() . 'cuisine_data.r_id');
            $this->db->where(db_prefix() . 'restaurant_registration.restaurant_id', $id);
    
            $cuisine_types = $this->db->get()->result_array();
    
            $cuisine_ids = array();
            if (!empty($cuisine_types)) {
                foreach ($cuisine_types as $innerArray) {
                    $cuisine_ids[] = $innerArray["cuisine_id"];
                }
                return $cuisine_ids;
            }
        }
    }

    public function update_plans($plans, $name)
    {

        $this->db->where('restaurant_user', $name);
        $this->db->update(db_prefix() . 'restaurant_user_plans', $plans);
    }
}
