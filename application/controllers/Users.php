<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('m_user');
    }

    // List all your items
    public function index()
    {
        $data = array(
            'title' => 'User',
            'get_employee'  => $this->m_user->get_all_data(), 
            'user'  => $this->m_user->get_data_all(), 
            'isi'   => 'v_user'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        $data = array(
            'nama_user' => $this->input->post('nama_user'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level_user' => $this->input->post('level_user')
        );
        $this->m_user->add($data);
        $this->session->set_flashdata('pesan_user', 'Data Berhasil Ditambahkan');
        redirect('user');
    }

    //Update one item
    public function edit($id_user = NULL)
    {
        $data = array(
            'id_user' => $id_user,
            'nama_user' => $this->input->post('nama_user'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'level_user' => $this->input->post('level_user')
        );
        $this->m_user->edit($data);
        $this->session->set_flashdata('pesan_user', 'Data Berhasil Diedit');
        redirect('user');
    }

    //Delete one item
    public function delete( $id_user = NULL )
    {
        $data = array(
            'id_user' => $id_user
        );
        $this->m_user->delete($data);
        $this->session->set_flashdata('pesan_user', 'Data Berhasil Dihapus');
        redirect('user');
    }
}

/* End of file User.php */

