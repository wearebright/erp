<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#--Bright IT Solutions--#  

class Outgoing_model extends CI_Model {

    CONST OUTGOING_PENDING = 0;
    CONST OUTGOING_PUBLISH = 1;

    function getOutgoing($from, $to, $product_id = null){
        $query = $this->db->select('outgoing_stock.*, product_information.product_name, product_information.product_model, product_information.price, users.last_name, users.first_name ')
                ->from('outgoing_stock')
                ->join('product_information', 'product_information.product_id = outgoing_stock.product_id')
                ->join('users', 'users.user_id = outgoing_stock.user_id')
                ->where('outgoing_stock.status', Self::OUTGOING_PUBLISH)
                ->order_by('outgoing_stock.created_at', 'DESC');
        if($from && $to){
            $this->db->where('outgoing_stock.created_at >=', date('Y-m-d H:i:s', strtotime($from)));
            $this->db->where('outgoing_stock.created_at <=', date('Y-m-d 23:59:59', strtotime($to)));
        }
        
        if($product_id && $product_id !== 'all'){
            
            $this->db->where('outgoing_stock.product_id', $product_id);   
        }
        
        $query = $query->get();
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    /* public function getOutgoing(){
        $query = $this->db->select('outgoing_stock.*, product_information.product_name, product_information.product_model, product_information.price ')
                   ->from('outgoing_stock')
                   ->join('product_information', 'product_information.product_id = outgoing_stock.product_id')
                   ->where('outgoing_stock.status', Self::OUTGOING_PENDING)
                   ->order_by('outgoing_stock.created_at', 'DESC')
                   ->get();
        if ($query) {
            return $query->result_array();
        }
        return false;
    } */

    public function deleteOutgoing($id){
        $this->db->where('id', $id)
            ->delete("outgoing_stock");
        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function saveOutgoing(){

        $list = $this->db->from('outgoing_stock')->where('status', Self::OUTGOING_PENDING)->get()->result();
        
        foreach ($list as $key => $value) {
            $this->db->set('status', Self::OUTGOING_PUBLISH, FALSE);
            $this->db->where('id', $value->id);
            $this->db->update('outgoing_stock');
            $data['quantity_adjustment'] = -$value->quantity;
            $data['invoice_id'] = $value->invoice_id;
            $data['product_id'] = $value->product_id;
            $data['user_id'] = $this->session->userdata('id');
            $data['movement_type'] = 'OUTGOING';

            $this->db->insert('stock_edit_logs', $data);
        }

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    public function getAllOutgoingByInvoiceID($id){
        $query = $this->db->select('outgoing_stock.*, product_information.product_name, product_information.product_model, product_information.price, users.last_name, users.first_name ')
                   ->from('outgoing_stock')
                   ->join('product_information', 'product_information.product_id = outgoing_stock.product_id')
                   ->join('users', 'users.user_id = outgoing_stock.user_id')
                   ->where('outgoing_stock.invoice_id', $id)
                   ->get();
                   
        if ($query) {
            return $query->result_array();
        }
        return false;
    }

    public function getOutgoingByInvoiceID($product_id, $invoice_id){
        $query = $this->db->select('outgoing_stock.*, product_information.product_name, product_information.product_model, product_information.price, users.last_name, users.first_name ')
                   ->from('outgoing_stock')
                   ->join('product_information', 'product_information.product_id = outgoing_stock.product_id')
                   ->join('users', 'users.user_id = outgoing_stock.user_id')
                   ->where('outgoing_stock.product_id', $product_id)
                   ->where('outgoing_stock.invoice_id', $invoice_id)
                   ->get();
                   
        if ($query) {
            return $query->row();
        }
        return false;
    }

    public function add_outgoing($data) {
        
        $res['error'] = true;
        $res['message'] = "Something wen't wrong";

        $data['status'] = Self::OUTGOING_PENDING;
        $invoice_id = $data['invoice_id'];
        $product_id = $data['product_id'];

        /* check orders base on invoice id */
        $order = $this->db->select('*')
            ->from('invoice_details')
            ->where('invoice_details.invoice_id', $invoice_id)
            ->where('invoice_details.product_id', $product_id)
            ->get()->row();

        if($order){
            $existingLog = $this->getOutgoingByInvoiceID($product_id, $invoice_id);
            if($existingLog){
                if($existingLog->quantity < $order->quantity ){
                    $new_qty = $existingLog->quantity + 1;
                    
                    $affected_row = $this->db->set('quantity', $new_qty, FALSE)
                                ->where('product_id', $product_id)
                                ->where('invoice_id', $invoice_id)
                                ->update('outgoing_stock');
                                
                    if($affected_row){
                        $res['error'] = false;
                        $res['data'] = $invoice_id;
                        $res['message'] = "Success";
                    }
                }else{
                    $res['error'] = true;
                    $res['message'] = "You've reach the maximum quantity of order";
                }
            }else{
                $this->db->insert('outgoing_stock', $data);

                $res['error'] = false;
                $res['message'] = "Success";
                $res['data'] = $invoice_id;
            }
        }else{
            $res['error'] = true;
            $res['message'] = "The item you scanned is not included in the order";
        }
        return $res;
    }


    public function product_list(){
        $this->db->select('*');
        $this->db->from('product_information');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

}

