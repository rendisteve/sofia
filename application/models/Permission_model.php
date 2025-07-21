<?php
class Permission_model extends CI_Model {
    public function get_user_permissions($role_id) {
        $this->db->select('menu');
        $this->db->where('role_id', $role_id);
        $query = $this->db->get('tbl_permissions');
        return array_column($query->result_array(), 'menu');
    }
}
?>