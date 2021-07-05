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
        $data['stickyImage']       = $this->announcement_model->getStickyImage();
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
            $html .=         '<a href="'.base_url().'/announcement/'.$record->id.'">';
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

    function announcementDetails($id){
        $data['title']            = display('announcement_details');
        $data['module']           = "bulletin";
        $data['page']             = "announcement_details"; 
        $data['postDetails']      = $this->announcement_model->getAnnouncementById($id);
        echo modules::run('template/layout', $data);
    }

    function update_sticky_image(){
        $id = $this->input->post('id',true);

        if(!empty($id)){

            $sticky_image_url = $this->fileupload->do_upload(
                'my-assets/image/sticky/', 
                'sticky_image'
            );

            $data['sticky'] = (object)$postData = [
                'id'    => $this->input->post('id',true),
                'image' => !is_null($sticky_image_url) ? $sticky_image_url : $this->input->post('old_sticky_image'),
            ]; 

            if ($this->announcement_model->updateStickyImage($postData)) {
                #set success message
                    $info['msg']    = display('save_successfully');
                    $info['status'] = 1;
            } else {
                #set exception message
                    $info['msg']    = display('please_try_again');
                    $info['status'] = 0;
            }
            echo json_encode($info);
        }else{
            $data['title']    = display('update_sticky');
            $data['sticky_image'] = $this->announcement_model->getStickyImage();  
            $data['module']   = "bulletin";  
            $data['page']     = "update_sticky_image";  
            echo Modules::run('template/layout', $data); 
        }
        
    }

}

