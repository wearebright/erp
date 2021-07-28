<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class Group extends MX_Controller {
 	
 	public function __construct()
 	{
 		parent::__construct();
 		$this->load->model(array(
 			'group_model'  
 		));
 		
		if (! $this->session->userdata('isAdmin'))
			redirect('login');
 	}
 


   public function bdtask_grouplist() {
        $data['title']      = display('group_list');
		$data['module'] 	= "dashboard";  
		$data['page']   	= "group/list";   
		$data['user']       = $this->group_model->read();
		echo Modules::run('template/layout', $data); 
    }

	public function bdtask_groupform($id = null)
	{ 
		$data['title']    = display('add_group');
		$data['departments'] = $this->group_model->departments();
		/*-----------------------------------*/
		$this->form_validation->set_rules('department_id', display('department'),'required|max_length[50]');
		$this->form_validation->set_rules('group_name', display('group_name'),'required|max_length[50]');
		
         
		/*-----------------------------------*/
		$data['group'] = (object)$groupData = array(
			'id'     	=> $id,
			'department_id' => $this->input->post('department_id'),  
			'group_name'  	=> $this->input->post('group_name'),
			'status'      => $this->input->post('status'),
		);

		/*-----------------------------------*/
		if ($this->form_validation->run()) {
			if (empty($id)) {
				if ($this->group_model->create($groupData)) {
					$this->session->set_flashdata('message', display('save_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}
				redirect("group_list");

			} else {
				if ($this->group_model->update($groupData)) {
					$this->session->set_flashdata('message', display('update_successfully'));
				} else {
					$this->session->set_flashdata('exception', display('please_try_again'));
				}

				redirect("edit_group/$id");
			}


		} else {
			$data['module'] = "dashboard";  
			$data['page']   = "group/form"; 
			if(!empty($id)){
			$data['title']  = display('group_user');
			$data['group']   = $this->group_model->single($id);
		}

			
			echo Modules::run('template/layout', $data);
		}
	}

	 public function bdtask_deletegroup($id = null) {
        if ($this->group_model->delete($id)) {
      $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
       $this->session->set_flashdata('exception', display('please_try_again'));
        }

        redirect("group_list");
    }



   
}
