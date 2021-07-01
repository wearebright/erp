<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class Stock extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'stock_model')); 
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }
   
    /* public function purchase_list(){
        $from_date =(!empty($this->input->get('from_date'))?$this->input->get('from_date'):date('Y-m-d')) ;
        $to_date = (!empty($this->input->get('to_date'))?$this->input->get('to_date'):date('Y-m-d'));
        $purchase_report = $this->report_model->bdtask_purchase_report($from_date, $to_date);
        $purchase_amount = 0;

        if (!empty($purchase_report)) {
            $i = 0;
            foreach ($purchase_report as $k => $v) {
                $i++;
                $purchase_report[$k]['sl'] = $i;
                $purchase_report[$k]['prchse_date'] = $this->occational->dateConvert($purchase_report[$k]['purchase_date']);
                $purchase_amount = $purchase_amount + $purchase_report[$k]['grand_total_amount'];
            }
        }

        $data = array(
            'title'           => display('purchase_report'),
            'purchase_amount' => number_format($purchase_amount, 2, '.', ','),
            'purchase_report' => $purchase_report,
            'from'            => $from_date,
            'to'              => $to_date,
        );

        $data['module']   = "report";
        $data['page']     = "purchase_list"; 
        echo modules::run('template/layout', $data); 
    } */

    public function audit_purchase($purchase_id = null){
        $purchase_detail = $this->stock_model->retrieve_purchase_editdata($purchase_id);
        $supplier_id = $purchase_detail[0]['supplier_id'];
        $supplier_list = $this->stock_model->supplier_list();
       
        if (!empty($purchase_detail)) {
            $i = 0;
            foreach ($purchase_detail as $k => $v) {
                $i++;
                $purchase_detail[$k]['sl'] = $i;
            }
        }


        $data = array(
            'title'         => display('audit_purchase'),
            'purchase_id'   => $purchase_detail[0]['purchase_id'],
            'chalan_no'     => $purchase_detail[0]['chalan_no'],
            'supplier_name' => $purchase_detail[0]['supplier_name'],
            'supplier_id'   => $purchase_detail[0]['supplier_id'],
            'grand_total'   => $purchase_detail[0]['grand_total_amount'],
            'purchase_details' => $purchase_detail[0]['purchase_details'],
            'purchase_date' => $purchase_detail[0]['purchase_date'],
            'total_discount'=> $purchase_detail[0]['total_discount'],
            'total'         => number_format($purchase_detail[0]['grand_total_amount'] + (!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0),2),
            'bank_id'       =>  $purchase_detail[0]['bank_id'],
            'purchase_info' => $purchase_detail,
            'supplier_list' => $supplier_list,
            'paid_amount'   => $purchase_detail[0]['paid_amount'],
            'due_amount'    => $purchase_detail[0]['due_amount'],
            'paytype'       => $purchase_detail[0]['payment_type'],
        );

        $data['module']     = "stock";
        $data['page']       = "audit_purchase"; 
        echo modules::run('template/layout', $data);
    }


    public function update_purchase() {
    
        $purchase_id = $this->input->post('purchase_id',TRUE);
        $this->form_validation->set_rules('product_quantity_received[]',display('quantity'),'required|max_length[20]');

        if ($this->form_validation->run() === true) {
            $p_id     = $this->input->post('product_id',TRUE);
            $ids     = $this->input->post('id',TRUE);
            $quantity = $this->input->post('product_quantity',TRUE);
            $quantity_pending = $this->input->post('product_quantity_pending',TRUE);
            $quantity_received = $this->input->post('product_quantity_received',TRUE);
    
            for ($i = 0, $n = count($p_id); $i < $n; $i++) {
                $product_quantity_pending = $quantity_pending[$i];
                $product_quantity_received = $quantity_received[$i];
    
                $data = array(
                    'purchase_detail_id' => $this->generator(15),
                    'quantity_received'  => $product_quantity_received,
                    'quantity_pending'   => $product_quantity_pending,
                );

    
                $this->db->where('id', $ids[$i]);
                $this->db->update('product_purchase_details', $data);
            }
            $this->session->set_flashdata('message', display('update_successfully'));
            redirect("audit_purchase/".$purchase_id);
           
        } else {
            $this->session->set_flashdata('exception', validation_errors());
            redirect("audit_purchase/".$purchase_id);
        }
    }

    public function generator($lenth)
    {
        $number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    
        for($i=0; $i<$lenth; $i++)
        {
            $rand_value=rand(0,34);
            $rand_number=$number["$rand_value"];
        
            if(empty($con))
            { 
            $con=$rand_number;
            }
            else
            {
            $con="$con"."$rand_number";}
        }
        return $con;
    }

    public function purchase_list(){
        $data['title']      = display('purchase');
        $data['total_purhcase']= $this->stock_model->count_purchase();
        $data['module']     = "stock";
        $data['page']       = "purchase_list"; 
        echo modules::run('template/layout', $data);
    }
}

