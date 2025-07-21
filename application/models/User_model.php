<?php
class User_model extends CI_Model {
    public function get_user($username) {
        return $this->db->get_where('tbl_users', ['username' => $username])->row_array();
    }
}
?>