<?php
define('basic','1');
define('standard','2');
define('pro','3');
class RegistrationApi_model extends CI_Model
{
    public function restaurant_registration($data){

        $data['datecreated'] = date('Y-m-d H:i:s');

        $business_details = [
            'business_name' => $data['BasicInformation']['businessName'],
            'b_address' => $data['contactInformation']['address'],
            'b_postcode' => $data['contactInformation']['pincode'],
            'b_state' => $data['contactInformation']['state'],
            'b_country' => $data['contactInformation']['country'],
            'business_type' => $data['BasicInformation']['businessType'],
            'seating_capacity' => $data['otherInformation']['dineInCapacity'],
            'datecreated' => $data['datecreated']
        ];

        $this->db->insert('restaurant_registration', $business_details);
        if ($this->db->affected_rows() > 0) {

            $insert_id = $this->db->insert_id();
            $client_details = [
                'client_user' => $insert_id,
                'client_email' => $data['contactInformation']['email'],
                'client_password' => null,
                'client_phoneNumber' => $data['contactInformation']['phone']
            ];

            $this->db->insert('client_details', $client_details);

            log_activity('New Restaurant Added [RestaurantID: ' . $insert_id . ']');
            
            $cuisine = $data["otherInformation"]['typeOfCuisine'];
            if ($insert_id) {
                if (isset($cuisine)) {
                    foreach ($cuisine as $cuisines) {
                        $this->db->insert(db_prefix() . 'cuisine_data', [
                            'r_id' => $insert_id,
                            'cuisine_id'     => $cuisines,
                        ]);
                    }
                }
            }

        }

        $business_hours = $data['operatingDays'];

        $operating_days = [
            'restaurant' => $insert_id,
            'operating_hours' => serialize($business_hours)
        ];

        $this->db->insert(db_prefix().'restaurant_operating_days',$operating_days);
        

        $dateString = $data['datecreated'];
        $date = new DateTime($dateString);
        $date->add(new DateInterval('P1Y'));
        $date->sub(new DateInterval('P1D'));
        $newDate = $date->format('Y-m-d');
        $plan_details = [
            'restaurant_user' => $insert_id,
            'restaurant_plan' => $data['plan_type'],
            'datecreated' => $data['datecreated'],
            'nextduedate' => $newDate
        ];
        $this->db->insert('restaurant_user_plans', $plan_details);

        $password = $data['password'];
        $hashed_password = password_hash($password,   PASSWORD_BCRYPT  );

        $this->db->where('client_user',$insert_id);
        $update_password = [
            'client_password' => $hashed_password
        ];
        $output = $this->db->update(db_prefix().'client_details', $update_password);

        if($output){
            $this->db->select('tblrestaurant_registration.business_name,tblclient_details.client_email');
            $this->db->from('tblclient_details');
            $this->db->join('tblrestaurant_registration','tblrestaurant_registration.restaurant_id = tblclient_details.client_user');
            $this->db->where('tblrestaurant_registration.restaurant_id',$insert_id);

            $result = $this->db->get()->result_array();
            $result['userid'] = $insert_id;
            $result['plan_type']  = $data['plan_type'];
            return $result;
        }

    
    }
    public function check_email_exist($email) {
        $this->db->where('client_email', $email);
        $query = $this->db->get(db_prefix() . 'client_details'); 
        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }

    }





}