<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Billing extends AdminController
{
    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        if (!has_permission('restaurant', '', 'view')) {
            access_denied('restaurant');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('restaurant_billing_table');
        }
        // $data['groups']    = $this->knowledge_base_model->get_kbg();
        $data['bodyclass'] = 'top-tabs kan-ban-body';
        $data['title']     = 'Restaurant Billings';
        $this->load->view('admin/restaurant_billing/view_billing',$data);
        
    }

}