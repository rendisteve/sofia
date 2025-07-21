<?php

class User_login
{
    protected $ci;
    
    public function __construct()
    {
        $this->ci = &get_instance();
        $this->ci->load->model('m_auth');
        
    }

    public function login($username, $password)
    {
        $cek = $this->ci->m_auth->login_user($username, $password);
        if ($cek) {
            $nama_user = $cek->first_name.' '.$cek->last_name;
            $username = $cek->username;
            $user_id = $cek->user_id; 
            $id = $cek->user_id; 
            $role_id = $cek->role_id; 

            $this->ci->session->set_userdata('username', $username);
            $this->ci->session->set_userdata('nama_user', $nama_user);
            $this->ci->session->set_userdata('user_id', $user_id);
            $this->ci->session->set_userdata('id', $id);
            $this->ci->session->set_userdata('role_id', $role_id);
            redirect('dashboard');            
        }else{
            $this->ci->session->set_flashdata('error', 'Username atau Password Salah');
            redirect('auth/login_user');
        }
    }

    public function proteksi_halaman()
    {
        if ($this->ci->session->userdata('username') == '') {
            $this->ci->session->set_flashdata('error', 'Anda Belum Login');
            redirect('auth/login_user');
        }
    }

    public function logout()
    {
        $this->ci->session->unset_userdata('username');
        $this->ci->session->unset_userdata('nama_user');
        $this->ci->session->unset_userdata('level_user');
        $this->ci->session->set_flashdata('pesan', 'Anda Berhasil Logout !!!');
        redirect('auth/login_user');
    }

}