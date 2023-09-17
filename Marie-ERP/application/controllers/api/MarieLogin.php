<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';



use chriskacerguis\RestServer\RestController;

class MarieLogin extends RestController{

    public function __construct(){
        parent::__construct();        
        $this->load->model('api/MarieLogin_model');
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");


    }
    
    public function index_get(){
        echo "hello";
    }

    public function password_creation_post(){
        $login_model = new MarieLogin_model;
        $inputdata = json_decode(file_get_contents("php://input"),true);
        if(!empty($inputdata)){
            $user_id = $inputdata['user_id'];
            $client_email = $inputdata['email'];
            $new_password = $inputdata['new_password'];
            $confirm_password = $inputdata['confirm_password'];
        }
        $isuser = $login_model->check_email_by_id($user_id,$client_email);
        if($isuser){
            if($new_password === $confirm_password){
                $user_data = [
                    'client_password' => $login_model->hash_password($new_password)
                ];

                $result = $login_model->create_password($user_id, $user_data);
                if($result > 0){
                    $this->response([
                        'status' => 200,
                        'message' => 'success'
                    ],RestController::HTTP_OK);
                }
                else{
                    $this->response([
                        'status' => 500,
                        'error' => 'Password not created'
                    ],RestController::HTTP_BAD_REQUEST);
                }
            }
            else{
                $this->response([
                    'status' => 500,
                    'message' => 'Password not same'
                ],RestController::HTTP_BAD_REQUEST);
            }
        }
        else{
            $this->response([
                'status' => 200,
                'error' => 'User is not valid'
            ], RestController::HTTP_BAD_REQUEST);
        }

    }



    // public function registration_post(){}

    public function login_post(){
        $login_model = new MarieLogin_model;
        $inputdata = json_decode(file_get_contents("php://input"),true);

        $email = $inputdata['email'];
        $password = $inputdata['password'];

        $result = $login_model->login_check($email,$password);
        if($result){
            $this->response([
                'status' => 200,
                'message' => 'Success'
            ],RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => 500,
                'message' => 'Incorrect Password or Email'
            ],RestController::HTTP_BAD_REQUEST);
        }
    }

}