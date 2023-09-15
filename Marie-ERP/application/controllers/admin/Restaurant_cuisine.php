<?php

defined('BASEPATH') or exit('No direct script access allowed');

class restaurant_cuisine extends AdminController
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
            $this->app->get_table_data('restaurant_cuisine');
        }
        // $data['groups']    = $this->knowledge_base_model->get_kbg();
        $data['bodyclass'] = 'top-tabs kan-ban-body';
        $data['title']     = _l('restaurant_title');
        $this->load->view('admin/restaurant_cuisine/view_cuisine',$data);
    }
}
