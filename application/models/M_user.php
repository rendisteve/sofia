<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

    // public function get_all_data()
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_user');
    //     $this->db->order_by('id_user', 'desc');
    //     return $this->db->get()->result();
    // }

    public function get_all_data() {
		$query = $this->db->query("SELECT * from xin_employees WHERE is_active = '1' AND user_id <> '1234567000'");
        return $query->result();
	}

    public function get_all_data_user() {
		$query = $this->db->query("SELECT * from xin_employees WHERE is_active = '1' AND user_id <> '1234567000' ORDER BY first_name ASC");
        return $query->result();
	}

    public function get_data_all($user_id = null)
    {
        if($user_id) {
			$sql = "SELECT a.*, b.first_name, b.last_name, c.* 
            FROM tbl_users a 
            JOIN xin_employees b ON a.user_id = b.user_id
            JOIN tbl_roles c ON a.role_id = c.id
            where user_id = ?";
			$query = $this->db->query($sql, array($user_id));
			return $query->result();
		}

		$sql = "SELECT a.*, b.first_name, b.last_name, c.*
            FROM tbl_users a 
            JOIN xin_employees b ON a.user_id = b.user_id
            JOIN tbl_roles c ON a.role_id = c.id";
		$query = $this->db->query($sql);
		return $query->result();
    }

    public function get_data($user_id)
    {
        $this->db->select('*');
        $this->db->from('tbl_users');
        $this->db->where('user_id', $user_id);
        return $this->db->get()->row();
    }

    public function get_user_data($user_id)
    {
        $sql = "SELECT * FROM xin_employees where user_id = ?";
			$query = $this->db->query($sql, array($user_id));
			return $query->row_array();
    }

    public function get_operator($user_id)
    {
        $sql = "SELECT * FROM xin_employees where user_id = ?";
			$query = $this->db->query($sql, array($user_id));
			return $query->row_array();
    }

    // $query = $this->db->query("SELECT * from xin_employees WHERE user_id <> '1234567000'");

    public function add($data)
    {
        $this->db->insert('tbl_user', $data);  
    }

    public function edit($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->update('tbl_user', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_user', $data['id_user']);
        $this->db->delete('tbl_user', $data);
    }

}

/* End of file M_user.php */
