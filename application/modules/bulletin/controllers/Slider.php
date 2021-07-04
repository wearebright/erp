<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class Slider extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'slider_model')); 
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }
   
    function index() {
        $data['title']             = display('manage_slider');
        $data['module']            = "bulletin";
        $data['page']              = "manage_slider"; 
        echo modules::run('template/layout', $data);
    }

    public function sliderList(){
        $postData = $this->input->post();
        $data     = $this->slider_model->getSliderList($postData);
        echo json_encode($data);
    }
}

