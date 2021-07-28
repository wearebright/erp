<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class Group_model extends CI_Model {
 
	public function create($data = array())
	{
        $groupdata = array(
            'department_id' => $data['department_id'],
            'group_name'  => $data['group_name'],
            'status'     => $data['status']
        );
        $this->db->insert('user_group', $groupdata);
        return true;
	}

	public function read()
	{
		return $this->db->select("
				a.*,
                b.department_name
			")
			->from('user_group a')
			->join('department b','a.department_id = b.id')
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select("
				a.*,
                b.department_name
			")
			->from('user_group a')
			->join('department b','b.id = a.department_id')
			->get()
			->row();
	}

    public function departments()
	{
		return $this->db->select("*")
			->from('department')
			->get()
			->result();
	}

	public function update($data = array())
	{


		$groupdata = array(
            'department_id' => $data['department_id'],
            'group_name'  => $data['group_name'],
            'status'     => $data['status']
        );
        $this->db->where('id', $data['id']);
        $this->db->update('user_group', $groupdata);
        return true;
	}

	public function delete($id = null)
	{
		 $this->db->where('id', $id)
			->delete("user_group");
		if ($this->db->affected_rows()) {
			return true;
		} else {
			return false;
		}
	}



 public function generator($lenth) {
        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 9);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }


}
