<?php
defined('BASEPATH') OR exit('No direct script access allowed');
#--Bright IT Solutions--#  

class User_model extends CI_Model {
 
	public function create($data = array())
	{
		$user_id = $this->generator(6);
		 $users = array(
		 	'user_id'    => $user_id,
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'logo'       => $data['image'],
            'status'     => $data['status'],
			'group_id'	 => $data['group_id'],
			'department_id'	 => $data['department_id'],
        );
        $this->db->insert('users', $users);
        $user_login = array(
            'user_id'   => $user_id,
            'username'  => $data['email'],
            'password'  => $data['password'],
            'user_type' => $data['user_type'],
            'status'    => $data['status'],
        );
        $this->db->insert('user_login', $user_login);
        return true;
	}

	public function read()
	{
		return $this->db->select("
				a.*, 
				CONCAT_WS(' ', a.first_name, a.last_name) AS fullname,b.*,b.status as status,b.username as email
			")
			->from('users a')
			->join('user_login b','b.user_id = a.user_id')
			->order_by('a.user_id', 'desc')
			->group_by('a.user_id')
			->get()
			->result();
	}

	public function single($id = null)
	{
		return $this->db->select("
				a.*,a.logo as image,b.*,b.status as status,b.username as email
			")
			->from('users a')
			->where('a.user_id', $id)
			->join('user_login b','b.user_id = a.user_id')
			->order_by('a.user_id', 'desc')
			
			->get()
			->row();
	}

	public function update($data = array())
	{


		$userdata = array(
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'logo'       => $data['image'],
            'status'     => $data['status'],
			'group_id'	 => $data['group_id'],
			'department_id'	 => $data['department_id'],
        );
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('users', $userdata);
        $user_login = array(
            'username' => $data['email'],
            'password' => $data['password'],
            'user_type'=> $data['user_type'],
            'status'   => $data['status'],
        );
        $this->db->where('user_id', $data['user_id']);
        $this->db->update('user_login', $user_login);
        return true;
	}

	public function delete($id = null)
	{
		 $this->db->where('user_id', $id)
			->delete("users");
		$this->db->where('user_id', $id)
			->delete("user_login");	
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

	public function groups()
	{
		return $this->db->select("*")
			->from('user_group')
			->where('status', 1)
			->order_by('group_name', 'asc')
			->get()
			->result();
	}

	public function departments() {
        return $this->db->select("*")
			->from('department')
			->where('status', 1)
			->order_by('department_name', 'asc')
			->get()
			->result();
    }

	public function get_team_by_department($dept){
        return $this->db->select("a.*")
			->from('user_group as a')
            ->where('a.status', 1)
            ->where('a.department_id', $dept)
			->get()
			->result();
    }

	public function get_teams(){
        return $this->db->select("a.*")
        ->from('user_group as a')
        ->where('a.status', 1)
        ->get()
        ->result();
    }

}
