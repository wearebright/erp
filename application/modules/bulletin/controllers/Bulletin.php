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
        $data['title']            = display('bulletin_board');
        $data['module']           = "bulletin";
        $data['page']             = "bulletin_board"; 
        $data['sliders']          = $this->slider_model->getFeaturedSliderBanner();
        $data['posts']            = $this->announcement_model->getAnnoucementsPaginate();
        $data['totalPosts']       = $this->announcement_model->getTotalAnnouncement();
        echo modules::run('template/layout', $data);
    }

    function getPaginateData(){
        $records = $this->announcement_model->getAnnoucementsPaginate($this->input->post('row',true));
        foreach($records as $record){
            if($record->banner){ 
                $banner = base_url().$record->banner; 
            }else { 
                $banner = base_url().$record->random_banner; 
            }
            $html .= '<div class="main_slides post">';
            $html .=     '<div class="placeHolder" style="left: 0px;">';
            $html .=         '<a href="https://manilastandard.net/news/top-stories/358857/pump-price-hike-for-7th-time-looms.html">';
            $html .=             '<img class="object-fit-cover" src="'. $banner .'">';
            $html .=             '<div class="title_Container" style="margin-top: -85px;">';
            $html .=                 '<p class="title">'.$record->title.'</p>';
            $html .=                 '<p class="datePosted">Posted at '.date('F d, Y h:i A', strtotime($record->created_at)).' by '.$record->name.'</p>';
            $html .=             '</div>';
            $html .=         '</a>';
            $html .=     '</div>';
            $html .= '</div>';
        }

        echo $html;
        die;
    }

}

