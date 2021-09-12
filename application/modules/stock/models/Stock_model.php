<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#--Bright IT Solutions--#  

class Stock_model extends CI_Model {

    public function retrieve_purchase_editdata($purchase_id) {
        $this->db->select('a.*,
                        b.*,
                        c.product_id,
                        c.product_name,
                        c.product_model,
                        d.supplier_id,
                        d.supplier_name'
        );
        $this->db->from('product_purchase a');
        $this->db->join('product_purchase_details b', 'b.purchase_id =a.purchase_id');
        $this->db->join('product_information c', 'c.product_id =b.product_id');
        $this->db->join('supplier_information d', 'd.supplier_id = a.supplier_id');
        $this->db->where('a.purchase_id', $purchase_id);
        $this->db->order_by('a.purchase_details', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    public function supplier_list(){
        $query = $this->db->select('*')
                   ->from('supplier_information')
                   ->where('status', '1')
                   ->get();
           if ($query->num_rows() > 0) {
               return $query->result_array();
           }
           return false;
    }

    public function count_purchase() {
        $this->db->select('a.*,b.supplier_name');
        $this->db->from('product_purchase a');
        $this->db->join('supplier_information b', 'b.supplier_id = a.supplier_id');
        $this->db->order_by('a.purchase_date', 'desc');
        $this->db->order_by('purchase_id', 'desc');
        $query = $this->db->get();

        $last_query = $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    public function product_details($product_id){
        $query = $this->db->select('*')
                   ->from('product_information')
                   ->where('product_id', $product_id)
                   ->where('status', '1')
                   ->get();
           if ($query->num_rows() > 0) {
               return $query->row();
           }
           return false;
    }

    function updateProductQuantity($product_id, $quantity){
        try {
            // var_dump($quantity); die;

            $que = $this->db->from('product_information')->where('product_id',$product_id)->get();
            if ($que->num_rows() > 0)
            {
                $product = $que->row(); 
                
                $quantity = (int) $quantity;
                if($quantity > 0){
                    return $this->db->set('total_stock', $product->total_stock + $quantity)
                    ->where('product_id', $product_id)
                    ->update('product_information');
                }else{
                    return $this->db->set('total_stock', $product->total_stock + ($quantity))
                    ->where('product_id', $product_id)
                    ->update('product_information');
                }
            }
            
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }

}

