<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class Bulletin extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'announcement_model', 'slider_model')); 
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }
   
    function index() {
        $data['title']             = display('bulletin_board');
        $data['module']            = "bulletin";
        $data['page']              = "bulletin_board"; 
        echo modules::run('template/layout', $data);
    }

}

