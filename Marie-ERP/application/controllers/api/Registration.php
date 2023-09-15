<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';



use chriskacerguis\RestServer\RestController;
use net\authorize\api\contract\v1\EmvTagType;

class Registration extends RestController{

    public function __construct(){
        parent::__construct();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header("Access-Control-Allow-Headers: Content-Type, Authorization");
        $this->load->model('RegistrationApi_model');
    }

    public function onboarding_post(){
        $inputdata = json_decode(file_get_contents("php://input"),true);
        $result = $this->RegistrationApi_model->restaurant_registration($inputdata);
        if(!empty($result)){
            $this->response([
                'status' => 200,
                'userId' => $result,
                'message' => 'Restaurant registered successfully'
            ],RestController::HTTP_OK);
        }
        else{
            $this->response([
                'status' => 500,
                'message' => 'Failed to upload'
            ],RestController::HTTP_BAD_REQUEST);
        }
    }

}