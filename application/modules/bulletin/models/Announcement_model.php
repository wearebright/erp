<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#--Bright IT Solutions--#  

class Announcement_model extends CI_Model {

    public function allannouncement()
    {
        return $this->db->select('*')
        ->from('bulletin_announcement')
        ->get()
        ->result();
    }

    public function announcement_dropdown()
	{
		$data =  $this->db->select("*")
			->from('bulletin_announcement')
			->order_by('title', 'asc')
			->get()
			->result();

      $list[''] = display('select_option');
        if (!empty($data)) {
        foreach($data as $value)
            $list[$value->customer_id] = $value->customer_name;
        return $list;
        } else {
        return false; 
        }
    }


    public function getAnnoucementListByUser($postData=null, $user_id){

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
           $searchQuery = "(a.title like '%".$searchValue."%' or b.first_name like '%".$searchValue."%' or b.last_name like '%".$searchValue."%' or a.created_at like '%".$searchValue."%' or CONCAT(first_name, ' ', last_name) like '%".$searchValue."%')";
        }

        ## Total number of records without filtering
        $this->db->select("count(*) as allcount, CONCAT(first_name, ' ', last_name) AS name");
        $this->db->from('bulletin_announcement a');
        $this->db->join('users b','a.user_id = b.user_id','left');
        

        if($searchValue != ''){
            $this->db->where($searchQuery);
        }
        $this->db->where('a.user_id', $user_id);

        $totalRecords =$this->db->get()->num_rows();
        $totalRecordwithFilter = $totalRecords;

        ## Fetch records
        $this->db->select("a.*, CONCAT(b.first_name, ' ', b.last_name) AS name");
        $this->db->from('bulletin_announcement a');
        $this->db->join('users b','a.user_id = b.user_id','left');
        
        if($searchValue != ''){
            $this->db->where($searchQuery);
        }
        $this->db->where('a.user_id', $user_id);

        $this->db->order_by($columnName, $columnSortOrder);
        $this->db->limit($rowperpage, $start);
        $records = $this->db->get()->result();
        $data = array();
        $sl =1;
 
        foreach($records as $record ){
            $button = '';
            $banner = 'N/A';
            $base_url = base_url();

  
            $button .=' <a href="'.$base_url.'edit_announcement/'.$record->id.'" class="btn btn-info btn-xs m-b-5 custom_btn" data-toggle="tooltip" data-placement="left" title="Update"><i class="pe-7s-note" aria-hidden="true"></i></a>';
            $button .=' <a onclick="announcementdelete('.$record->id.')" href="javascript:void(0)"  class="btn btn-danger btn-xs m-b-5 custom_btn" data-toggle="tooltip" data-placement="right" title="Delete "><i class="pe-7s-trash" aria-hidden="true"></i></a>';
            if($record->banner){
                $banner = '<img src="'.$base_url.$record->banner.'" width="90" height="60">';
            }

            $data[] = array( 
               'title'          => $record->title,
               'name'    => $record->name,
               'banner'         => $banner,
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

    public function getAnnoucementsPaginate($offset = 0){


        ## Read value
        ## Search 
        ## Total number of records without filtering
        

        ## Fetch records
        $this->db->select("a.*, CONCAT(b.first_name, ' ', b.last_name) AS name");
        $this->db->from('bulletin_announcement a');
        $this->db->join('users b','a.user_id = b.user_id','left');
        $this->db->limit(5, $offset);
                
        $records = $this->db->get()->result();

        return $records; 
    }

    public function getTotalAnnouncement(){
        $this->db->select("*");
        $this->db->from('bulletin_announcement');
        return $this->db->get()->num_rows();
    }

    public function getAnnouncementById($id){
        return $this->db->select('*')
            ->from('bulletin_announcement')
            ->where('id', $id)
            ->get()
            ->row();
    }

    public function create($data = array())
	{
		return $this->db->insert('bulletin_announcement', $data);
	}

    public function update($data = array())
	{
		return $this->db->where('id', $data["id"])
			->update("bulletin_announcement", $data);

	}

    public function delete($id)
	{
		return $this->db->where('id', $id)->delete("bulletin_announcement");
	}
}

