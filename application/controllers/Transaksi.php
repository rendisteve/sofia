<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
        $this->load->model('m_kendaraan');
        $this->load->model('m_kendaraan_truck');
        
    }
    

    public function index()
    {
        // if (empty($this->cart->contents())) {
        //     redirect('home');
        // }
        // $data = array(
        //     'title' => 'Keranjang Belanja',
        //     'isi'    => 'v_belanja'
        // );
        // $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        $user = $this->session->userdata('user_id');
        if ($user == '1234567089') {
            $transaksi = $this->m_transaksi->get_all_data_kendaraan();
        }elseif ($user == '1234567517') {
            $transaksi = $this->m_transaksi->get_all_data_kendaraan_truck();
        }

        $data = array(
            'title' => 'Transaksi',
            'transaksi' => $transaksi,
            'rincian' => $this->m_transaksi->get_data_rincian(),
            'isi'   => 'transaksi/v_transaksi'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function add_cart()
    {
        $id = date('y').date('m').strtoupper(random_string('alnum',2));
        $redirect_page = $this->input->post('redirect_page');
        $data = array(
            'id'      => $id,
            'name'    => $this->input->post('barang_jasa'),
            'qty'    => $this->input->post('volume'),
            'satuan'    => $this->input->post('satuan'),
            'price'   => $this->input->post('harga')
            
        );
        $this->cart->insert($data);
        redirect($redirect_page);
    }

    // Add a new item
    public function add($id_kendaraan = NULL, $kode = NULL, $get = NULL)
    {
        // $tanggalstnk = $this->input->post('tanggalstnk');
        // $bulanstnk = $this->input->post('bulanstnk');
        // $tahunstnk = $this->input->post('tahunstnk');

        // $stnk_waktu = date('Y-m-d', strtotime($tahunstnk."-".$bulanstnk."-".$tanggalstnk));

        // $tanggalkir = $this->input->post('tanggalkir');
        // $bulankir = $this->input->post('bulankir');
        // $tahunkir = $this->input->post('tahunkir');

        // $kir_waktu = date('Y-m-d', strtotime($tahunkir."-".$bulankir."-".$tanggalkir));
        
        // $this->form_validation->set_rules('plat_nomor', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('status_kepemilikan', 'Status Kepemilikan', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('nama_pemilik', 'Nama Pemilik', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('jenis_kendaraan', 'Jenis Kendaraan', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('tahun_pembuatan', 'Tahun Pembuatan', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('warna', 'Warna Kendaraan', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('tanggalstnk', 'Tanggal STNK', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('bulanstnk', 'Bulan STNK', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('tahunstnk', 'Tahun STNK', 'required',  array('required' => '%s Harus Diisi !!' ));

        
        // if ($this->form_validation->run() == TRUE) {
        //     $config['upload_path'] = './assets/gambar/';
        //     $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        //     $config['max_size']     = '10000';
        //     $this->upload->initialize($config);
           
        //     $field_name1 = 'foto_depan';
        //     $field_name2 = 'foto_belakang';
        //     $field_name3 = 'foto_kiri';
        //     $field_name4 = 'foto_kanan';

        //     $field_name5 = 'foto_interior1';
        //     $field_name6 = 'foto_interior2';
        //     $field_name7 = 'foto_interior3';
        //     $field_name8 = 'foto_interior4';
        //     if (!$this->upload->do_upload($field_name1) && !$this->upload->do_upload($field_name2) && !$this->upload->do_upload($field_name3) && !$this->upload->do_upload($field_name4)) {
        //         $data = array(
        //             'title' => 'Tambah Kendaraan',
        //             'kategori' => $this->m_kategori->get_all_data(),
        //             'error_upload' => $this->upload->display_errors(),
        //             'isi'   => 'kendaraan/v_add'
        //         );
        //         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        //     }else{

        //         $upload_data1 = array('gambar1' => $this->upload->data());   
        //         $config['image_library'] = 'gd2';
        //         $config['source_image'] = './assets/gambar/'.$upload_data1['gambar1']['file_name'];
        //         $this->load->library('image_lib', $config);

        //         // $this->upload->do_upload($field_name1);
        //         // $result1 = $this->upload->data();
        //         $this->upload->do_upload($field_name2);
        //         $result2 = $this->upload->data();
        //         $this->upload->do_upload($field_name3);
        //         $result3 = $this->upload->data();
        //         $this->upload->do_upload($field_name4);
        //         $result4 = $this->upload->data();

        //         $this->upload->do_upload($field_name5);
        //         $result5 = $this->upload->data();
        //         $this->upload->do_upload($field_name6);
        //         $result6 = $this->upload->data();
        //         $this->upload->do_upload($field_name7);
        //         $result7 = $this->upload->data();
        //         $this->upload->do_upload($field_name8);
        //         $result8 = $this->upload->data();
        //         $result = array('gambar2'=>$result2,'gambar3'=>$result3,'gambar4'=>$result4,
        //                         'gambar5'=>$result5,'gambar6'=>$result6,'gambar7'=>$result7,'gambar8'=>$result8);

        //         $data = array(
        //             'id_kendaraan' => date('y').strtoupper(random_string('alnum',2)).date('m').strtoupper(random_string('alnum',2)).date('d'),
        //             'plat_nomor' => $this->input->post('plat_nomor'),
        //             'status_kepemilikan' => $this->input->post('status_kepemilikan'),
        //             'nama_pemilik' => $this->input->post('nama_pemilik'),
        //             'jenis_kendaraan' => $this->input->post('jenis_kendaraan'),
        //             'tahun_pembuatan' => $this->input->post('tahun_pembuatan'),
        //             'keterangan' => $this->input->post('keterangan'),
        //             'warna' => $this->input->post('warna'),
        //             'bahan_bakar' => $this->input->post('bahan_bakar'),
        //             'nomor_rangka' => $this->input->post('nomor_rangka'),
        //             'nomor_mesin' => $this->input->post('nomor_mesin'),
        //             'nomor_bpkb' => $this->input->post('nomor_bpkb'),
        //             'stnk_waktu' => $stnk_waktu,
        //             'kir_waktu' => $kir_waktu,

        //             // 'foto_depan' => $result['gambar1']['file_name'],
        //             'foto_depan' => $upload_data1['gambar1']['file_name'],
        //             'foto_belakang' =>  $result['gambar2']['file_name'],
        //             'foto_kiri' => $result['gambar3']['file_name'],
        //             'foto_kanan' => $result['gambar4']['file_name'],
        //             'foto_interior1' => $result['gambar5']['file_name'],
        //             'foto_interior2' => $result['gambar6']['file_name'],
        //             'foto_interior3' => $result['gambar7']['file_name'],
        //             'foto_interior4' => $result['gambar8']['file_name']
        //         );
        //         $this->m_kendaraan->add($data);
        //         $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Ditambahkan');
        //         redirect('kendaraan');
        //     }
        // }

        if ($kode == 1) {
            if ($get == 1) {
                $get_kendaraan = $this->m_kendaraan->get_data1($id_kendaraan);
            }else{
                $get_kendaraan = $this->m_kendaraan->get_data($id_kendaraan);
            }
            $get_row = $this->m_transaksi->get_row_transaksi($id_kendaraan);
            $get_last = $this->m_transaksi->get_data_by_id_kendaraan_limit1($id_kendaraan);
        }elseif ($kode == 2) {
            $get_kendaraan = $this->m_kendaraan_truck->get_data1($id_kendaraan);
            $get_row = $this->m_transaksi->get_row_transaksi($id_kendaraan);
            $get_last = $this->m_transaksi->get_data_by_id_kendaraan_truck_limit1($id_kendaraan);
        }

        $data = array(
            'title' => 'Tambah Transaksi',
            'kendaraan' => $get_kendaraan,
            'transaksi' => $this->m_transaksi->get_data_by_id_kendaraan($id_kendaraan),
            'row' => $get_row,
            'last_transaksi' => $get_last,
            'row' => $this->m_transaksi->get_rincian_by_id_kendaraan($id_kendaraan),
            'isi'   => 'transaksi/v_add'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function delete($rowid,$id_kendaraan)
    {
        $this->cart->remove($rowid);
        redirect('transaksi/add/'.$id_kendaraan);
    }

    public function update()
    {
        $redirect_page = $this->input->post('redirect_page');
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty'   => $this->input->post($i . '[qty]'),
                'price'   => $this->input->post($i . '[price]'),
            );
            $this->cart->update($data);
            $i++;
        }
        $this->session->set_flashdata('pesan_update_keranjang', 'Data berhasil diupdate');
        redirect($redirect_page);
    }

    public function clear($id_kendaraan)
    {
        $this->cart->destroy();
        redirect('transaksi/add/'.$id_kendaraan);
    }

    public function simpan_transaksi()
    {
        // $this->pelanggan_login->proteksi_halaman();

        // $this->form_validation->set_rules('provinsi', 'Provinsi', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('kota', 'Kota', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('expedisi', 'Expedisi', 'required',  array('required' => '%s Harus Diisi !!' ));
        // $this->form_validation->set_rules('paket', 'Paket', 'required',  array('required' => '%s Harus Diisi !!' ));

        $this->form_validation->set_rules('tanggaltran', 'Tanggal Transaksi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('bulantran', 'Bulan Transaksi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tahuntran', 'Tahun Transaksi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('jenis_perawatan', 'Jenis Perawatan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('kilometer_kendaraan', 'Kilometer', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('no_rekening', 'No Rekening', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('nama_bank', 'Nama Bank', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('atas_nama', 'Atas Nama', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('jumlah', 'Atas Nama', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('keperluan', 'Keperluan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('mgr_ops', 'Manager Operasional', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('admin_keuangan', 'Admin Keuangan', 'required',  array('required' => '%s Harus Diisi !!' ));

        $tanggaltran = $this->input->post('tanggaltran');
        $bulantran = $this->input->post('bulantran');
        $tahuntran = $this->input->post('tahuntran');

        $transaksi_waktu = date('Y-m-d', strtotime($tanggaltran."-".$bulantran."-".$tahuntran));

        $tanggalstnk = $this->input->post('tanggalstnk');
        $bulanstnk = $this->input->post('bulanstnk');
        $tahunstnk = $this->input->post('tahunstnk');

        $stnk_waktu = date('Y-m-d', strtotime($tahunstnk."-".$bulanstnk."-".$tanggalstnk));

        $tanggalkir = $this->input->post('tanggalkir');
        $bulankir = $this->input->post('bulankir');
        $tahunkir = $this->input->post('tahunkir');

        $kir_waktu = date('Y-m-d', strtotime($tahunkir."-".$bulankir."-".$tanggalkir));

        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Tambah Transaksi',
                'kendaraan' => $this->m_kendaraan->get_data($this->input->post('id_kendaraan')),
                'isi'   => 'transaksi/v_add'
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        }else{
            // simpan ke tabel transaksi
            $no_rincian = 'TRX'.date('Ymd').strtoupper(random_string('alnum',2));
            $data = array(
                        'id_transaksi ' => $this->input->post('id_transaksi'),
                        'tgl_transaksi ' => $transaksi_waktu,
                        'id_kendaraan' => $this->input->post('id_kendaraan'),
                        'jenis_perawatan' => $this->input->post('jenis_perawatan'),
                        'kilometer_kendaraan' => $this->input->post('kilometer_kendaraan'),
                        'no_rekening' => $this->input->post('no_rekening'),
                        'nama_bank' => $this->input->post('nama_bank'),
                        'atas_nama' => $this->input->post('atas_nama'),
                        'jumlah' => $this->input->post('jumlah'),
                        'keperluan' => $this->input->post('keperluan'),
                        'keterangan' => $this->input->post('keterangan'),
                        'admin_kendaraan' => $this->input->post('admin_kendaraan'),
                        'mgr_ops' => $this->input->post('mgr_ops'),
                        'mgr_support' => $this->input->post('mgr_support'),
                        'admin_keuangan' => $this->input->post('admin_keuangan'),
                        'foto1' => '',
                        'foto2' => '',
                        'foto3' => '',
                        'foto4' => '',
                        'created_by' => $this->session->userdata('nama_user'),
                        'created_at' => date('Y-m-d H:m:s'),
                        'status' => 0
                    );
            $this->m_transaksi->simpan_transaksi($data);
            $data_surat = array(
                'id_kendaraan' => $this->input->post('id_kendaraan'),
                'stnk_waktu' => $stnk_waktu,
                'kir_waktu' => $kir_waktu
            );
            $this->m_kendaraan->edit($data_surat);
            // simpan ke tabel rincian transaksi
            $i = 1;
            foreach ($this->cart->contents() as $items) {
                $data_rinci = array(
                                // 'no_order' => $this->input->post('no_order'),
                                // 'id_barang' => $items['id'],
                                // 'qty' => $this->input->post('qty'.$i++),

                                'id_transaksi'      => $this->input->post('id_transaksi'),
                                'barang_jasa'    => $items['name'],
                                'volume'    => $items['qty'],
                                'satuan'    =>  $items['satuan'],
                                'harga'   => $items['price']
                            );
                $this->m_transaksi->simpan_rincian_transaksi($data_rinci);
            }
            // ==========================================================
            $this->session->set_flashdata('pesan_pesanan_saya', 'Pesanan Berhasil Diproses');
            $this->cart->destroy();
            redirect('transaksi');
        }
        
        
    }

    public function update_transaksi($id_transaksi = NULL)
    {
        $config['upload_path'] = './assets/gambar/lampiran_transaksi/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
        $config['max_size']     = '10000';
        $this->upload->initialize($config);
        
        $field_name1 = 'foto1';
        $field_name2 = 'foto2';
        $field_name3 = 'foto3';
        $field_name4 = 'foto4';
        if (!$this->upload->do_upload($field_name1) && !$this->upload->do_upload($field_name2) && !$this->upload->do_upload($field_name3) && !$this->upload->do_upload($field_name4)) {
            $data = array(
                'title' => 'Update Transaksi',
                // 'error_upload' => $this->upload->display_errors(),
                'transaksi' => $this->m_transaksi->get_data_transaksi($id_transaksi),
                'isi'   => 'transaksi/v_edit'
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        }else{

            $upload_data1 = array('gambar1' => $this->upload->data());   
            $config['image_library'] = 'gd2';
            $config['source_image'] = './assets/gambar/lampiran_transaksi/'.$upload_data1['gambar1']['file_name'];
            $this->load->library('image_lib', $config);

            // $this->upload->do_upload($field_name1);
            // $result1 = $this->upload->data();
            $this->upload->do_upload($field_name2);
            $result2 = $this->upload->data();
            $this->upload->do_upload($field_name3);
            $result3 = $this->upload->data();
            $this->upload->do_upload($field_name4);
            $result4 = $this->upload->data();

            $result = array('gambar2'=>$result2,'gambar3'=>$result3,'gambar4'=>$result4);

            $data = array(
                'id_transaksi' => $id_transaksi,

                // 'foto_depan' => $result['gambar1']['file_name'],
                'foto1' => $upload_data1['gambar1']['file_name'],
                'foto2' =>  $result['gambar2']['file_name'],
                'foto3' => $result['gambar3']['file_name'],
                'foto4' => $result['gambar4']['file_name']
            );
            $this->m_transaksi->edit($data);
            $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
            redirect('transaksi');
        }

        $data = array(
            'title' => 'Update Transaksi',
            'transaksi' => $this->m_transaksi->get_data_transaksi($id_transaksi),
            'isi'   => 'transaksi/v_edit'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    public function cetak_form($id_transaksi = NULL, $jenis_perawatan = NULL)
    {
        // $tanggal = $this->input->post('tanggal');
        // $bulan = $this->input->post('bulan');
        // $tahun = $this->input->post('tahun');
        $user = $this->session->userdata('user_id');

        if($jenis_perawatan < 4){
            $title = 'Form 08';
            $isi = 'v_cetak_form1';
            $form = $this->m_transaksi->get_transaksi($id_transaksi, $user);
            $form1 = $this->m_transaksi->get_transaksi1($id_transaksi, $user); 
        }elseif($jenis_perawatan == 6){
            $title = 'Form 05';
            $isi = 'v_cetak_form2a';
            $form = $this->m_transaksi->get_transaksi($id_transaksi);
            $form1 = $this->m_transaksi->get_transaksi1($id_transaksi);
        }else{
            $title = 'Form 05';
            $isi = 'v_cetak_form2';
            $form = $this->m_transaksi->get_transaksi($id_transaksi);
            $form1 = $this->m_transaksi->get_transaksi1($id_transaksi);
        }

        $data = array(
            'title' => $title,
            'form' => $form,
            'form1' => $form1,
            'row' => $this->m_transaksi->get_rincian($id_transaksi),
            // // 'tanggal' => $tanggal,
            // // 'bulan' => $bulan,
            // // 'tahun' => $tahun,
            // 'laporan' => $this->m_laporan->lap_harian($tanggal,$bulan,$tahun),
            'isi'    => $isi
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    public function cetak_foto($id_transaksi = NULL, $jenis_perawatan = NULL)
    {
        // $tanggal = $this->input->post('tanggal');
        // $bulan = $this->input->post('bulan');
        // $tahun = $this->input->post('tahun');

        if($jenis_perawatan < 4){
            $title = 'Foto Form 08';
            $isi = 'v_cetak_foto1';
            $form = $this->m_transaksi->get_transaksi($id_transaksi);
            $form1 = $this->m_transaksi->get_transaksi1($id_transaksi);
        }else{
            $title = 'Foto Form 05';
            $isi = 'v_cetak_foto2';
            $form = $this->m_transaksi->get_transaksi($id_transaksi);
            $form1 = $this->m_transaksi->get_transaksi1($id_transaksi);
        }

        $data = array(
            'title' => $title,
            'form' => $form,
            'form1' => $form1,
            'row' => $this->m_transaksi->get_rincian($id_transaksi),
            // // 'tanggal' => $tanggal,
            // // 'bulan' => $bulan,
            // // 'tahun' => $tahun,
            // 'laporan' => $this->m_laporan->lap_harian($tanggal,$bulan,$tahun),
            'isi'    => $isi
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    public function cekout()
    {
        $this->pelanggan_login->proteksi_halaman();

        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('kota', 'Kota', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('expedisi', 'Expedisi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('paket', 'Paket', 'required',  array('required' => '%s Harus Diisi !!' ));

        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Cek Out Belanja',
                'isi'    => 'v_cekout'
            );
            $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        }else{
            // simpan ke tabel transaksi
            $data = array(
                        'id_pelanggan' => $this->session->userdata('id_pelanggan'),
                        'no_order' => $this->input->post('no_order'),
                        'tgl_order' => date('Y-m-d'),
                        'nama_penerima' => $this->input->post('nama_penerima'),
                        'hp_penerima' => $this->input->post('hp_penerima'),
                        'provinsi' => $this->input->post('provinsi'),
                        'kota' => $this->input->post('kota'),
                        'alamat' => $this->input->post('alamat'),
                        'kode_pos' => $this->input->post('kode_pos'),
                        'expedisi' => $this->input->post('expedisi'),
                        'paket' => $this->input->post('paket'),
                        'estimasi' => $this->input->post('estimasi'),
                        'ongkir' => $this->input->post('ongkir'),
                        'berat' => $this->input->post('berat'),
                        'grand_total' => $this->input->post('grand_total'),
                        'total_bayar' => $this->input->post('total_bayar'),
                        'status_bayar' => '0',
                        'status_order' => '0',
                    );
            $this->m_transaksi->simpan_transaksi($data);
            // simpan ke tabel rincian transaksi
            $i = 1;
            foreach ($this->cart->contents() as $items) {
                $data_rinci = array(
                                'no_order' => $this->input->post('no_order'),
                                'id_barang' => $items['id'],
                                'qty' => $this->input->post('qty'.$i++),
                            );
                $this->m_transaksi->simpan_rincian_transaksi($data_rinci);
            }
            // ==========================================================
            $this->session->set_flashdata('pesan_pesanan_saya', 'Pesanan Berhasil Diproses');
            $this->cart->destroy();
            redirect('pesanan_saya');
        }
        
        
    }
}