<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#--Bright IT Solutions--#  

class Slider_model extends CI_Model {

    public function getSliderList($postData=null){

        $response = array();
        $custom_data = $this->input->post('customfiled');
        if(!empty($custom_data)){
            $cus_data = [''];
            foreach ($custom_data as $cusd) {
                $cus_data[] = $cusd;
            }
        }
    
        ## Read value
        $draw = $postData['draw'];
        $start = $postData['start'];
        $rowperpage = $postData['length']; // Rows display per page
        $columnIndex = $postData['order'][0]['column']; // Column index
        $columnName = $postData['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $postData['order'][0]['dir']; // asc or desc
        $searchValue = $postData['search']['value']; // Search value

        ## Search 
        $searchQuery = "";  
        if($searchValue != ''){
           $searchQuery = "(a.link like '%".$searchValue."%' or a.image like '%".$searchValue."%' or a.created_at like '%".$searchValue."%')";
        }

        ## Total number of records without filtering
        $this->db->select("count(*) as allcount");
        $this->db->from('bulletin_slider a');
        // $this->db->join('users b','a.user_id = b.user_id','left');
        

        if($searchValue != ''){
            $this->db->where($searchQuery);
        }

        $totalRecords =$this->db->get()->num_rows();
        $totalRecordwithFilter = $totalRecords;

        ## Fetch records
        $this->db->select("a.*");
        $this->db->from('bulletin_slider a');
        // $this->db->join('users b','a.user_id = b.user_id','left');
        
        if($searchValue != ''){
            $this->db->where($searchQuery);
        }

        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        $data = array();
        $sl =1;
 
        foreach($records as $record ){
            $button = '';
            $banner = '';
            $attachment = 'N/A';
            $base_url = base_url();

  
            $button .= '<a href="'.$base_url.'edit_slider/'.$record->id.'" class="btn btn-info btn-xs m-b-5 custom_btn" data-toggle="tooltip" data-placement="left" title="Update"><i class="pe-7s-note" aria-hidden="true"></i></a>';
            $button .= '<a onclick="sliderdelete('.$record->id.')" href="javascript:void(0)"  class="btn btn-danger btn-xs m-b-5 custom_btn" data-toggle="tooltip" data-placement="right" title="Delete "><i class="pe-7s-trash" aria-hidden="true"></i></a>';
            if($record->image)
                $banner .= '<img src="'.$base_url.$record->image.'" width="120" height="60">';
            if($record->link){
                $attachment = '<a target="_blank" href="'.$record->link.'">View Attachement</a>';
            }

            $data[] = array( 
               'image'          => $banner,
               'link'           => $attachment,
               'featured'       => $record->featured?"Yes": "No",
               'created_at'     => date('Y-m-d', strtotime($record->created_at)).' at '. date('h:i A', strtotime($record->created_at)),
               'button'         => $button,
            ); 
        }

        ## Response
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecordwithFilter,
           "iTotalDisplayRecords" => $totalRecords,
           "aaData" => $data
        );

        return $response; 
    }

    public function getSliderById($id){
        return $this->db->select('*')
            ->from('bulletin_slider')
            ->where('id', $id)
            ->get()
            ->row();
    }

    public function create($data = array())
	{
		return $this->db->insert('bulletin_slider', $data);
	}

    public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("bulletin_slider", $data);
	}

    public function delete($id)
	{
		return $this->db->where('id', $id)->delete("bulletin_slider");
	}

    public function getFeaturedSliderBanner(){
        return $this->db->select('*')
            ->from('bulletin_slider')
            ->where('featured', 1)
            ->get()
            ->result();
    }

}

