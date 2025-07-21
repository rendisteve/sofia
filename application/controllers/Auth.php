<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function login_user()
    {
        $this->form_validation->set_rules('username', 'Username', 'required', array(
            'required' => '%s Harus Diisi !!!'    
        ));

        $this->form_validation->set_rules('password', 'Password', 'required', array(
            'required' => '%s Harus Diisi !!!'    
        ));

        if ($this->form_validation->run() == TRUE){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->user_login->login($username, $password);
        }
        $data = array(
            'title' => 'Login User',
         );
        $this->load->view('v_login_user', $data, FALSE);
    }

    public function logout_user()
    {
        $this->user_login->logout();
    }

}

// /* End of file Auth.php */
// ?>

// <?php
// defined('BASEPATH') OR exit('No direct script access allowed');
// class Auth extends CI_Controller {
//     public function login() {
//         $this->load->model('User_model');
//         $username = $this->input->post('username');
//         $password = $this->input->post('password');

//         $user = $this->User_model->get_user($username);

//         if ($user && password_verify($password, $user['password'])) {
//             $this->session->set_userdata([
//                 'user_id' => $user['id'],
//                 'role_id' => $user['role_id'],
//                 'logged_in' => TRUE
//             ]);
//             redirect('dashboard');
//         } else {
//             echo "Login gagal!";
//         }
//     }

//     public function logout() {
//         $this->session->sess_destroy();
//         redirect('auth/login');
//     }

//     function check_access($menu) {
//         $CI = &get_instance();
//         $CI->load->model('Permission_model');
        
//         $role_id = $CI->session->userdata('role_id');
//         $permissions = $CI->Permission_model->get_user_permissions($role_id);
    
//         if (!in_array($menu, $permissions)) {
//             show_error('Anda tidak memiliki akses ke halaman ini.', 403);
//         }
//     }
// }
?>