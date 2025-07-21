<?php
function check_access($menu) {
    $CI = &get_instance();
    $CI->load->model('Permission_model');
    
    $role_id = $CI->session->userdata('role_id');
    $permissions = $CI->Permission_model->get_user_permissions($role_id);

    if (!in_array($menu, $permissions)) {
        show_error('Anda tidak memiliki akses ke halaman ini.', 403);
    }
}
?>