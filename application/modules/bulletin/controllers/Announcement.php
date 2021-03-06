<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class Announcement extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'announcement_model')); 
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }
   
    function index() {
        $data['title']             = display('manage_announcement');
        $data['module']            = "bulletin";
        $data['page']              = "manage_announcement"; 
        echo modules::run('template/layout', $data);
    }

    public function announcementList(){
        $postData = $this->input->post();
        $data     = $this->announcement_model->getAnnoucementListByUser($postData, $this->session->userdata('id'));
        echo json_encode($data);
    }

    public function announcement_form($slug = null)
    {
        $data['title'] = display('add_announcement');
        #-------------------------------#
        $this->form_validation->set_rules('title',display('title'),'max_length[255]');
        $this->form_validation->set_rules('description',display('description'));
        $this->form_validation->set_rules('banner',display('banner'),'max_length[100]');
        #-------------------------------#

        
        
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            
            $banner_url = $this->fileupload->do_upload(
                'my-assets/image/announcement/', 
                'banner'
            );
            
            $attachment_url = $this->fileupload->do_upload(
                'my-assets/image/announcement_attach/', 
                'attachment'
            );

            $seleced_banner = $this->input->post('defaultBanner',true);
            $banner_image  = !is_null($banner_url) ? $banner_url : $this->input->post('old_banner');
            $attachment_url  = !is_null($attachment_url)? $attachment_url: $this->input->post('old_attachment');

            

            $slug = url_title($this->input->post('title',true), 'dash', true);

            #check slug if exist
            $slugExist = $this->announcement_model->checkSlug($slug);
            if($slugExist){
                $slug = $slugExist->slug.'c';
            }


            $data['announcement'] = (object)$postData = [
                'id' => $this->input->post('announcement_id',true),
                'title'         => $this->input->post('title',true),
                'banner'        => !is_null($banner_image) ? $banner_image : '',
                'attachment'    => !is_null($attachment_url) ? $attachment_url : '',
                'description'   => $this->input->post('description', true),
                'user_id'       => $this->session->userdata('id'),
            ]; 

            
            $postData['random_banner'] = $seleced_banner;
            #if empty $id then insert data
            if (empty($postData['id'])) {
                $postData['slug'] = $slug;
                if ($this->announcement_model->create($postData)) {
                    #set success message
                        $info['msg']    = display('save_successfully');
                        $info['status'] = 1;
                } else {
                    #set exception message
                        $info['msg']    = display('please_try_again');
                        $info['status'] = 0;
                }
            } else {
                if ($this->announcement_model->update($postData)) {
                    #set success message
                    $info['msg']    = display('update_successfully');
                    $info['status'] = 1;
                } else {
                    #set exception message
                    $info['msg']    = display('please_try_again');
                    $info['status'] = 0;
                } 
            }
            
            echo json_encode($info);
        } else { 
            if(empty($this->input->post('title',true))){
                if(!empty($slug)){
                    $data['title']    = display('edit_announcement');
                    $data['announcement'] = $this->announcement_model->getAnnouncementBySlug($slug);  
                }
                $data['module']   = "bulletin";  
                $data['page']     = "announcement_form";  
                echo Modules::run('template/layout', $data); 
            }else{
                $info['msg']    = validation_errors();
                $info['status'] = 0;
                echo json_encode($info);
            }
        }
    }

    public function delete(){
        $delete = $this->announcement_model->delete($this->input->post('id'));  
        if($delete){
            $info['msg']    = display('delete_successfully');
            $info['status'] = 1;
        }else{
            $info['msg']    = display('please_try_again');
            $info['status'] = 0;
        }
        echo json_encode($info);
    }
}

