<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class Outgoing extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'outgoing_model')); 
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }
   
    /* outgoing products */
    public function outgoing_stocks(){
        $from_date =(!empty($this->input->get('from_date'))?$this->input->get('from_date'):date('Y-m-d')) ;
        $to_date = (!empty($this->input->get('to_date'))?$this->input->get('to_date'):date('Y-m-d'));
        $product_id = $this->input->get('product_id');

        $outgoing_data = $this->outgoing_model->getOutgoing($from_date, $to_date, $product_id);
        $product_list = $this->outgoing_model->product_list();
        
        
        $data = array(
            'from'           => $from_date,
            'to'             => $to_date,
            'outgoing_data'  => $outgoing_data,
            'product_list'   => $product_list,
            'product_id'     => $product_id
        );

        $data['title'] = display('outgoing_stocks');
        $data['module']     = "tracking";
        $data['page']       = "outgoing"; 
        echo modules::run('template/layout', $data);
    }

    /* public function scan_barcode(){

        $outgoing_data = $this->outgoing_model->getOutgoing();

        $data['outgoing_data'] = $outgoing_data;
        $data['title'] = "Barcode Scanner";
        $data['module']     = "tracking";
        $data['page']       = "scan_barcode"; 
        echo modules::run('template/layout', $data);
    } */

    public function remove($id){
        if ($this->outgoing_model->deleteOutgoing($id)) {
            $this->session->set_flashdata('message', display('delete_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function saveOutgoing(){
        if ($this->outgoing_model->saveOutgoing()) {
            $this->session->set_flashdata('message', display('save_successfully'));
        } else {
            $this->session->set_flashdata('exception', display('please_try_again'));
        }

        redirect($_SERVER['HTTP_REFERER']);
    }

    public function addOutgoing(){
        $product_id = $this->input->post('product_id',TRUE);
        $invoice_id = $this->input->post('invoice_id',TRUE);

        $data['product_id'] = $product_id;
        $data['invoice_id'] = $invoice_id;
        $data['user_id'] = $this->session->userdata('id');


        $res = $this->outgoing_model->add_outgoing($data);

        if(!$res['error']){
            $res['data'] = $this->outgoing_model->getAllOutgoingByInvoiceID($res['data']);
        }
        
        echo json_encode($res);
    }
}

