<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan_truck extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('m_kendaraan_truck');
        // $this->load->model('m_kategori');
    }

    // List all your items
    public function index()
    {
        
        $data = array(
            'title' => 'Kendaraan Truck',
            'kendaraan' => $this->m_kendaraan_truck->get_all_data(),
            'isi'   => 'kendaraan/v_kendaraan_truck'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // List all your items
    public function stnk()
    {
        
        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $this->m_kendaraan_truck->get_all_data_alarm1(),
            'isi'   => 'kendaraan/v_kendaraan_truck'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }
    
    public function kir()
    {
        
        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $this->m_kendaraan_truck->get_all_data_alarm2(),
            'isi'   => 'kendaraan/v_kendaraan_truck'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function service($alarm = NULL)
    {
        if ($alarm == 'alarm') {
            $get = $this->m_kendaraan_truck->get_all_data_alarm3();
        }else{
            $get = $this->m_kendaraan_truck->get_all_data_service();

        }
        
        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $get,
            'isi'   => 'kendaraan/v_kendaraan_truck_service'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function rental()
    {
        
        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $this->m_kendaraan_truck->get_all_data_alarm4(),
            'isi'   => 'kendaraan/v_kendaraan_truck'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // Add a new item
    public function add()
    {
        
        $this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('status_kepemilikan', 'Status Kepemilikan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tahun_pembuatan', 'Tahun Pembuatan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('warna', 'Warna Kendaraan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tanggalstnk', 'Tanggal STNK', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('bulanstnk', 'Bulan STNK', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tahunstnk', 'Tahun STNK', 'required',  array('required' => '%s Harus Diisi !!' ));


        $tanggalstnk = $this->input->post('tanggalstnk');
        $bulanstnk = $this->input->post('bulanstnk');
        $tahunstnk = $this->input->post('tahunstnk');

        $stnk_waktu = date('Y-m-d', strtotime($tahunstnk."-".$bulanstnk."-".$tanggalstnk));

        $tanggalkir = $this->input->post('tanggalkir');
        $bulankir = $this->input->post('bulankir');
        $tahunkir = $this->input->post('tahunkir');

        $kir_waktu = date('Y-m-d', strtotime($tahunkir."-".$bulankir."-".$tanggalkir));

        
        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
            $config['max_size']     = '10000';
            $this->upload->initialize($config);
           
            $field_name1 = 'foto_depan';
            $field_name2 = 'foto_belakang';
            $field_name3 = 'foto_kiri';
            $field_name4 = 'foto_kanan';

            $field_name5 = 'foto_interior1';
            $field_name6 = 'foto_interior2';
            $field_name7 = 'foto_interior3';
            $field_name8 = 'foto_interior4';
            if (!$this->upload->do_upload($field_name1) && !$this->upload->do_upload($field_name2) && !$this->upload->do_upload($field_name3) && !$this->upload->do_upload($field_name4)) {
                $data = array(
                    'title' => 'Tambah Kendaraan',
                    // 'kategori' => $this->m_kategori->get_all_data(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi'   => 'kendaraan/v_add'
                );
                $this->load->view('layout/v_wrapper_backend', $data, FALSE);
            }else{

                $upload_data1 = array('gambar1' => $this->upload->data());   
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/'.$upload_data1['gambar1']['file_name'];
                $this->load->library('image_lib', $config);

                // $this->upload->do_upload($field_name1);
                // $result1 = $this->upload->data();
                $this->upload->do_upload($field_name2);
                $result2 = $this->upload->data();
                $this->upload->do_upload($field_name3);
                $result3 = $this->upload->data();
                $this->upload->do_upload($field_name4);
                $result4 = $this->upload->data();

                $this->upload->do_upload($field_name5);
                $result5 = $this->upload->data();
                $this->upload->do_upload($field_name6);
                $result6 = $this->upload->data();
                $this->upload->do_upload($field_name7);
                $result7 = $this->upload->data();
                $this->upload->do_upload($field_name8);
                $result8 = $this->upload->data();
                $result = array('gambar2'=>$result2,'gambar3'=>$result3,'gambar4'=>$result4,
                                'gambar5'=>$result5,'gambar6'=>$result6,'gambar7'=>$result7,'gambar8'=>$result8);

                $data = array(
                    'id_kendaraan' => date('y').strtoupper(random_string('alnum',2)).date('m').strtoupper(random_string('alnum',2)).date('d'),
                    'plat_nomor' => $this->input->post('plat_nomor'),
                    'status_kepemilikan' => $this->input->post('status_kepemilikan'),
                    'nama_pemilik' => $this->input->post('nama_pemilik'),
                    'jenis_kendaraan' => $this->input->post('jenis_kendaraan'),
                    'tahun_pembuatan' => $this->input->post('tahun_pembuatan'),
                    'keterangan' => $this->input->post('keterangan'),
                    'warna' => $this->input->post('warna'),
                    'bahan_bakar' => $this->input->post('bahan_bakar'),
                    'nomor_rangka' => $this->input->post('nomor_rangka'),
                    'nomor_mesin' => $this->input->post('nomor_mesin'),
                    'nomor_bpkb' => $this->input->post('nomor_bpkb'),
                    'stnk_waktu' => $stnk_waktu,
                    'kir_waktu' => $kir_waktu,

                    // 'foto_depan' => $result['gambar1']['file_name'],
                    'foto_depan' => $upload_data1['gambar1']['file_name'],
                    'foto_belakang' =>  $result['gambar2']['file_name'],
                    'foto_kiri' => $result['gambar3']['file_name'],
                    'foto_kanan' => $result['gambar4']['file_name'],
                    'foto_interior1' => $result['gambar5']['file_name'],
                    'foto_interior2' => $result['gambar6']['file_name'],
                    'foto_interior3' => $result['gambar7']['file_name'],
                    'foto_interior4' => $result['gambar8']['file_name'],
                    'foto_interior4' => $result['gambar8']['file_name'],
                    'odometer' => 0,
                    'tanggal_rental' => ''
                );
                $this->m_kendaraan_truck->add($data);
                $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Ditambahkan');
                redirect('kendaraan_truck');
            }
        }

        $data = array(
            'title' => 'Tambah Kendaraan',
            // 'kategori' => $this->m_kategori->get_all_data(),
            'isi'   => 'kendaraan/v_add'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Update one item
    public function edit($id_kendaraan = NULL)
    {
        if($this->input->post('submit') == "save"){
            $tanggalstnk = $this->input->post('tanggalstnk');
            $bulanstnk = $this->input->post('bulanstnk');
            $tahunstnk = $this->input->post('tahunstnk');

            $stnk_waktu = date('Y-m-d', strtotime($tahunstnk."-".$bulanstnk."-".$tanggalstnk));

            $tanggalkir = $this->input->post('tanggalkir');
            $bulankir = $this->input->post('bulankir');
            $tahunkir = $this->input->post('tahunkir');

            $kir_waktu = date('Y-m-d', strtotime($tahunkir."-".$bulankir."-".$tanggalkir));
            
            $this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('status_kepemilikan', 'Status Kepemilikan', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('tahun_pembuatan', 'Tahun Pembuatan', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('warna', 'Warna Kendaraan', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('tanggalstnk', 'Tanggal STNK', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('bulanstnk', 'Bulan STNK', 'required',  array('required' => '%s Harus Diisi !!' ));
            $this->form_validation->set_rules('tahunstnk', 'Tahun STNK', 'required',  array('required' => '%s Harus Diisi !!' ));

            
            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'id_kendaraan' => $id_kendaraan,
                    'plat_nomor' => $this->input->post('plat_nomor'),
                    'status_kepemilikan' => $this->input->post('status_kepemilikan'),
                    'nama_pemilik' => $this->input->post('nama_pemilik'),
                    'jenis_kendaraan' => $this->input->post('jenis_kendaraan'),
                    'tahun_pembuatan' => $this->input->post('tahun_pembuatan'),
                    'keterangan' => $this->input->post('keterangan'),
                    'warna' => $this->input->post('warna'),
                    'bahan_bakar' => $this->input->post('bahan_bakar'),
                    'nomor_rangka' => $this->input->post('nomor_rangka'),
                    'nomor_mesin' => $this->input->post('nomor_mesin'),
                    'nomor_bpkb' => $this->input->post('nomor_bpkb'),
                    'stnk_waktu' => $stnk_waktu,
                    'kir_waktu' => $kir_waktu
                );
                $this->m_kendaraan_truck->edit($data);
                $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
                // $this->session->set_flashdata('pesan_kendaraan', $error);
                redirect('kendaraan_truck');
            }
        }elseif ($this->input->post('submit') == "upload1") {
            $this->upload1($id_kendaraan, 'foto_depan');
        }elseif ($this->input->post('submit') == "upload2") {
            $this->upload1($id_kendaraan, 'foto_belakang');
        }elseif ($this->input->post('submit') == "upload3") {
            $this->upload1($id_kendaraan, 'foto_kiri');
        }elseif ($this->input->post('submit') == "upload4") {
            $this->upload1($id_kendaraan, 'foto_kanan');
        }elseif ($this->input->post('submit') == "upload5") {
            $this->upload1($id_kendaraan, 'foto_interior1');
        }elseif ($this->input->post('submit') == "upload6") {
            $this->upload1($id_kendaraan, 'foto_interior2');
        }elseif ($this->input->post('submit') == "upload7") {
            $this->upload1($id_kendaraan, 'foto_interior3');
        }elseif ($this->input->post('submit') == "upload8") {
            $this->upload1($id_kendaraan, 'foto_interior4');
        }

        $data = array(
            'title' => 'Edit Kendaraan',
            // 'kategori' => $this->m_kategori->get_all_data(),
            'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
            'isi'   => 'kendaraan/v_edit'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    public function upload1($id_kendaraan = NULL, $field_name = NULL)
    {
        $redirect_page = $this->input->post('redirect_page');
        $config['upload_path'] = './assets/gambar/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['max_size']     = '10000';
        $this->upload->initialize($config);

        $kendaraan = $this->m_kendaraan_truck->get_data($id_kendaraan);
        if($field_name == 'foto_depan'){
            $field_name1 = 'foto_depan';
            $gambar = $kendaraan->foto_depan;
        }elseif($field_name == 'foto_belakang'){
            $field_name1 = 'foto_belakang';
            $gambar = $kendaraan->foto_belakang;
        }elseif($field_name == 'foto_kiri'){
            $field_name1 = 'foto_kiri';
            $gambar = $kendaraan->foto_kiri;
        }elseif($field_name == 'foto_kanan'){
            $field_name1 = 'foto_kanan';
            $gambar = $kendaraan->foto_kanan;
        }elseif($field_name == 'foto_interior1'){
            $field_name1 = 'foto_interior1';
            $gambar = $kendaraan->foto_interior1;
        }elseif($field_name == 'foto_interior2'){
            $field_name1 = 'foto_interior2';
            $gambar = $kendaraan->foto_interior2;
        }elseif($field_name == 'foto_interior3'){
            $field_name1 = 'foto_interior3';
            $gambar = $kendaraan->foto_interior3;
        }elseif($field_name == 'foto_interior4'){
            $field_name1 = 'foto_interior4';
            $gambar = $kendaraan->foto_interior4;
        }
        

        if (!$this->upload->do_upload($field_name1)) {
            $data = array(
                'title' => 'Edit Kendaraan',
                // 'kategori' => $this->m_kategori->get_all_data(),
                'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
                'error_upload' => $this->upload->display_errors(),
                'isi'   => 'kendaraan/v_edit'
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        }else{
            if ($gambar != "") {
                unlink('./assets/gambar/'.$gambar);
            }
            $upload_data = array('gambar1' => $this->upload->data());   
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/gambar/'.$upload_data['gambar1']['file_name'];
            $this->load->library('image_lib', $config);

            $data = array(
                'id_kendaraan' => $id_kendaraan,
                $field_name1 => $upload_data['gambar1']['file_name']
            );
            $this->m_kendaraan_truck->edit($data);
            $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
            redirect($redirect_page,'refresh');
        }

        $data = array(
            'title' => 'Edit Kendaraan',
            // 'kategori' => $this->m_kategori->get_all_data(),
            'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
            'isi'   => 'kendaraan/v_edit'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    //Delete one item
    public function delete( $id_barang = NULL )
    {
        // hapus gambar
        $barang = $this->m_barang->get_data($id_barang);
        if ($barang->gambar != "") {
            unlink('./assets/gambar/'.$barang->gambar);
        }
        // end hapus gambar
        $data = array(
            'id_barang' => $id_barang
        );
        $this->m_kendaraan_truck->delete($data);
        $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Dihapus');
        redirect('kendaraan_truck');
    }

    public function operator()
    {
        $tanggalhis = $this->input->post('tanggalhis');
        $bulanhis = $this->input->post('bulanhis');
        $tahunhis = $this->input->post('tahunhis');

        $operator_his = date('Y-m-d', strtotime($tahunhis."-".$bulanhis."-".$tanggalhis));
        
        $this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('id_kendaraan', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('cluster', 'Cluster', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('operator', 'Nama Operator', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('jabatan', 'Jabatan/Posisi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tanggalhis', 'Tanggal', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('bulanhis', 'Bulan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tahunhis', 'Tahun', 'required',  array('required' => '%s Harus Diisi !!' ));

        
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'title' => 'Kendaraan',
                'kendaraan' => $this->m_kendaraan_truck->get_all_data(),
                'isi'   => 'kendaraan/v_kendaraan_truck'
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);

            $data = array(
                'id_histori' => date('Y').strtoupper(random_string('alnum',1)).date('m').strtoupper(random_string('alnum',1)).date('d'),
                'id_kendaraan' => $this->input->post('id_kendaraan'),
                'cluster' => $this->input->post('cluster'),
                'operator' => $this->input->post('operator'),
                'jabatan' => $this->input->post('jabatan'),
                'tanggal' => $operator_his,
                'status' => 1 
            );
            $this->m_kendaraan_truck->add_operator($data);
            $this->session->set_flashdata('pesan_kendaraan', 'Data Operator Ditambahkan');
            redirect('kendaraan_truck');
        }

        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $this->m_kendaraan_truck->get_all_data(),
            'isi'   => 'kendaraan/v_kendaraan_truck'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function operator1($id_histori = NULL)
    {
        $tanggalhis = $this->input->post('tanggalhis');
        $bulanhis = $this->input->post('bulanhis');
        $tahunhis = $this->input->post('tahunhis');

        $operator_his = date('Y-m-d', strtotime($tahunhis."-".$bulanhis."-".$tanggalhis));
        
        $this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('id_kendaraan', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('cluster', 'Cluster', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('operator', 'Nama Operator', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('jabatan', 'Jabatan/Posisi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tanggalhis', 'Tanggal', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('bulanhis', 'Bulan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tahunhis', 'Tahun', 'required',  array('required' => '%s Harus Diisi !!' ));

        
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'title' => 'Kendaraan',
                'kendaraan' => $this->m_kendaraan_truck->get_all_data(),
                'isi'   => 'kendaraan/v_kendaraan_truck'
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);

            $data = array(
                'id_histori' => date('Y').strtoupper(random_string('alnum',1)).date('m').strtoupper(random_string('alnum',1)).date('d'),
                'id_kendaraan' => $this->input->post('id_kendaraan'),
                'cluster' => $this->input->post('cluster'),
                'operator' => $this->input->post('operator'),
                'jabatan' => $this->input->post('jabatan'),
                'tanggal' => $operator_his,
                'status' => 1 
            );
            $this->m_kendaraan_truck->add_operator($data);
            // if ($this->m_kendaraan_truck->add_operator($data) == TRUE) {
                $data = array(
                    'id_histori' => $id_histori,
                    'status' => 0
                );
                $this->m_kendaraan_truck->edit_operator($data);
                $this->session->set_flashdata('pesan_kendaraan', 'Data Operator Ditambahkan');
                redirect('kendaraan_truck');
            // }
        }

        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $this->m_kendaraan_truck->get_all_data(),
            'isi'   => 'kendaraan/v_kendaraan_truck'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // public function upload2($id_kendaraan = NULL)
    // {
    //     $redirect_page = $this->input->post('redirect_page');
    //     $config['upload_path'] = './assets/gambar/';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
    //     $config['max_size']     = '10000';
    //     $this->upload->initialize($config);

    //     $field_name1 = 'foto_belakang';

    //     if (!$this->upload->do_upload($field_name1)) {
    //         $data = array(
    //             'title' => 'Edit Kendaraan',
    //             'kategori' => $this->m_kategori->get_all_data(),
    //             'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
    //             'error_upload' => $this->upload->display_errors(),
    //             'isi'   => 'kendaraan/v_edit'
    //         );
    //         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    //     }else{
    //         $kendaraan = $this->m_kendaraan_truck->get_data($id_kendaraan);
    //         if ($kendaraan->foto_belakang != "") {
    //             unlink('./assets/gambar/'.$kendaraan->foto_belakang);
    //         }
    //         $upload_data = array('gambar1' => $this->upload->data());   
    //         $config['image_library'] = 'gd2';
    //         $config['source_image'] = './assets/gambar/'.$upload_data['gambar1']['file_name'];
    //         $this->load->library('image_lib', $config);

    //         $data = array(
    //             'id_kendaraan' => $id_kendaraan,
    //             'foto_belakang' => $upload_data['gambar1']['file_name']
    //         );
    //         $this->m_kendaraan_truck->edit($data);
    //         $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
    //         redirect($redirect_page,'refresh');
    //     }

    //     $data = array(
    //         'title' => 'Edit Kendaraan',
    //         'kategori' => $this->m_kategori->get_all_data(),
    //         'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
    //         'isi'   => 'kendaraan/v_edit'
    //     );
    //     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    // }

    // public function upload3($id_kendaraan = NULL)
    // {
    //     $redirect_page = $this->input->post('redirect_page');
    //     $config['upload_path'] = './assets/gambar/';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
    //     $config['max_size']     = '10000';
    //     $this->upload->initialize($config);

    //     $field_name1 = 'foto_kiri';

    //     if (!$this->upload->do_upload($field_name1)) {
    //         $data = array(
    //             'title' => 'Edit Kendaraan',
    //             'kategori' => $this->m_kategori->get_all_data(),
    //             'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
    //             'error_upload' => $this->upload->display_errors(),
    //             'isi'   => 'kendaraan/v_edit'
    //         );
    //         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    //     }else{
    //         $kendaraan = $this->m_kendaraan_truck->get_data($id_kendaraan);
    //         if ($kendaraan->foto_kiri != "") {
    //             unlink('./assets/gambar/'.$kendaraan->foto_kiri);
    //         }
    //         $upload_data = array('gambar1' => $this->upload->data());   
    //         $config['image_library'] = 'gd2';
    //         $config['source_image'] = './assets/gambar/'.$upload_data['gambar1']['file_name'];
    //         $this->load->library('image_lib', $config);

    //         $data = array(
    //             'id_kendaraan' => $id_kendaraan,
    //             'foto_kiri' => $upload_data['gambar1']['file_name']
    //         );
    //         $this->m_kendaraan_truck->edit($data);
    //         $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
    //         redirect($redirect_page,'refresh');
    //     }

    //     $data = array(
    //         'title' => 'Edit Kendaraan',
    //         'kategori' => $this->m_kategori->get_all_data(),
    //         'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
    //         'isi'   => 'kendaraan/v_edit'
    //     );
    //     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    // }

    // public function upload4($id_kendaraan = NULL)
    // {
    //     $redirect_page = $this->input->post('redirect_page');
    //     $config['upload_path'] = './assets/gambar/';
    //     $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
    //     $config['max_size']     = '10000';
    //     $this->upload->initialize($config);

    //     $field_name1 = 'foto_kanan';

    //     if (!$this->upload->do_upload($field_name1)) {
    //         $data = array(
    //             'title' => 'Edit Kendaraan',
    //             'kategori' => $this->m_kategori->get_all_data(),
    //             'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
    //             'error_upload' => $this->upload->display_errors(),
    //             'isi'   => 'kendaraan/v_edit'
    //         );
    //         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    //     }else{
    //         $kendaraan = $this->m_kendaraan_truck->get_data($id_kendaraan);
    //         if ($kendaraan->foto_kanan != "") {
    //             unlink('./assets/gambar/'.$kendaraan->foto_kanan);
    //         }
    //         $upload_data = array('gambar1' => $this->upload->data());   
    //         $config['image_library'] = 'gd2';
    //         $config['source_image'] = './assets/gambar/'.$upload_data['gambar1']['file_name'];
    //         $this->load->library('image_lib', $config);

    //         $data = array(
    //             'id_kendaraan' => $id_kendaraan,
    //             'foto_kanan' => $upload_data['gambar1']['file_name']
    //         );
    //         $this->m_kendaraan_truck->edit($data);
    //         $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
    //         redirect($redirect_page,'refresh');
    //     }

    //     $data = array(
    //         'title' => 'Edit Kendaraan',
    //         'kategori' => $this->m_kategori->get_all_data(),
    //         'kendaraan' => $this->m_kendaraan_truck->get_data($id_kendaraan),
    //         'isi'   => 'kendaraan/v_edit'
    //     );
    //     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    // }
}

/* End of file barang.php */

