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


    public function slider_form($id = null)
    {
        $data['title'] = display('add_slider');
        #-------------------------------#
        $this->form_validation->set_rules('title',display('title'),'max_length[255]');
        $this->form_validation->set_rules('description',display('description'));
        $this->form_validation->set_rules('banner',display('banner'),'max_length[100]');
        #-------------------------------#

        
        
        #-------------------------------#
        if ($this->form_validation->run() === true) {
            
            $banner_url = $this->fileupload->do_upload(
                'my-assets/image/slider/', 
                'banner'
            );

            $banner_image  = !is_null($banner_url) ? $banner_url : $this->input->post('old_banner') ;
            /* var_dump($banner_image); die; */
            $data['slider'] = (object)$postData = [
                'id' => $this->input->post('slider_id', true),
                'featured' => $this->input->post('featured', true), 
                'image'      => !is_null($banner_image) ? $banner_image : 'my-assets/image/product.png',
                'link' => $this->input->post('link', true),
                'user_id'     => $this->session->userdata('id'),
            ]; 

            #if empty $id then insert data
            if (empty($postData['id'])) {
                if ($this->slider_model->create($postData)) {
                    #set success message
                        $info['msg']    = display('save_successfully');
                        $info['status'] = 1;
                } else {
                    #set exception message
                        $info['msg']    = display('please_try_again');
                        $info['status'] = 0;
                }
            } else {
                if ($this->slider_model->update($postData)) {
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
            if(empty($this->input->post('link',true))){
                if(!empty($id)){
                    $data['title']    = display('edit_slider');
                    $data['slider'] = $this->slider_model->getSliderById($id);  
                }
                $data['module']   = "bulletin";  
                $data['page']     = "slider_form";  
                echo Modules::run('template/layout', $data); 
            }else{
                $info['msg']    = validation_errors();
                $info['status'] = 0;
                echo json_encode($info);
            }
        }
    }

    public function delete(){
        $delete = $this->slider_model->delete($this->input->post('id'));  
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

