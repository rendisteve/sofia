<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //Load Dependencies
        $this->load->model('m_kendaraan');
        $this->load->model('m_user');
        // $this->load->model('m_kategori');
    }

    // List all your items
    public function index()
    {
        
        $data = array(
            'title' => 'Kendaraan',
            // 'kendaraan' => $this->m_kendaraan->get_all_data(),
            'isi'   => 'kendaraan/v_kendaraan'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function fetchKendaraanDataById($id) 
	{
		if($id) {
			$data = $this->m_kendaraan->get_all_data($id);
			echo json_encode($data);
		}
	}

    public function fetchKendaraanDataById1($id) 
	{
		if($id) {
			$data = $this->m_kendaraan->get_all_data($id);
			echo json_encode($data);
		}
	}

    public function fetchKendaraanData()
	{

        date_default_timezone_set('Asia/Jakarta');
        $user = $this->m_user->get_all_data();
        function format_hari_tanggal($waktu)
        {
            $hari_array = array(
                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
            );
            $hr = date('w', strtotime($waktu));
            $hari = $hari_array[$hr];
            $tanggal = date('j', strtotime($waktu));
            $bulan_array = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            );
            $bl = date('n', strtotime($waktu));
            $bulan = $bulan_array[$bl];
            $tahun = date('Y', strtotime($waktu));
            $jam = date( 'H:i:s', strtotime($waktu));
            
            //untuk menampilkan hari, tanggal bulan tahun jam
            //return "$hari, $tanggal $bulan $tahun $jam";
        
            //untuk menampilkan hari, tanggal bulan tahun
            return "$tanggal-$bulan-$tahun";
        }
		$result = array('data' => array());

		$data = $this->m_kendaraan->get_all_data();

		foreach ($data as $key => $value) {

            if($value['status_kepemilikan'] == ""){
                $status_kepemilikan = "-";
            }elseif($value['status_kepemilikan'] == 1){
                $status_kepemilikan = "<span class='badge bg-success'>Asset</span>";
            }elseif($value['status_kepemilikan'] == 2){
                $status_kepemilikan = "<span class='badge bg-info'>Rental</span>";
            }elseif($value['status_kepemilikan'] == 3){
                $status_kepemilikan = "<span class='badge bg-warning'>Non Asset</span>";
            }
            
            if ($value['masa_stnk'] < 0){
                $pesan_stnk = "<span class='badge bg-danger'>STNK TERLEWAT</span>";
            }elseif ($value['masa_stnk'] <= 20) {
                $pesan_stnk = "<span class='badge bg-danger'>KIRIM STNK</span>";
            }elseif ($value['masa_stnk'] <= 30) {
                $pesan_stnk = "<span class='badge bg-warning'>INFO KE OPERATOR</span>";
            }else{
                $pesan_stnk = "<span class='badge bg-success'>STNK AMAN</span>";
            }

            if ($value['masa_kir'] == ""){
                $pesan_kir = "<span class='badge bg-success'>NON KIR</span>";
            }elseif ($value['masa_kir'] < 0){
                $pesan_kir = "<span class='badge bg-danger'>KIR TERLEWAT</span>";
            }elseif ($value['masa_kir'] <= 14) {
                $pesan_kir = "<span class='badge bg-warning'>KIRIM KIR</span>";
            }elseif ($value['masa_kir'] <= 30) {
                $pesan_kir = "<span class='badge bg-info'>INFO KE OPERATOR</span>";
            }else{
                $pesan_kir = "<span class='badge bg-success'>KIR AMAN</span>";
            }

            if ($value['masa_rental'] == ''){
                $pesan_rental = "<span class='badge bg-success'>ASET</span>";
            }elseif ($value['masa_rental'] < 1){
                $pesan_rental = "<span class='badge bg-danger'>BAYAR SEKARANG !!!</span>";
            }
            elseif ($value['masa_rental'] <= 2) {
                $pesan_rental = "<span class='badge bg-warning'>SEGERA DIPROSES !!!</span>";
            }elseif ($value['masa_rental'] <= 5) {
                $pesan_rental = "<span class='badge bg-info'>PERSIAPKAN</span>";
            }else{
                $pesan_rental = "<span class='badge bg-success'>RENTAL AMAN</span>";
            }

            if ($value['user_id'] != '') {
                $operator = $this->m_user->get_operator($value['user_id']);
                $operator = $operator['first_name'].' '.$operator['last_name'];
                // $operator = $value['user_id'];
            }else{
                $operator = '-';
            }

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				// $buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
				// $buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id_kendaraan']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
                                    if ($value['id_histori'] != "") {
				                        // $buttons = '<a href="'.base_url('transaksi/add/'.$value['id_kendaraan'].'/1/1').'" class="btn-xs btn-info" data-placement="top" title="Tambah Transaksi"><i class="fas fa-calendar-check"></i></a>';
                                        // $buttons.= '<button class="btn-xs btn-secondary" data-toggle="modal" data-target="#operator1'.$value['id'].'"><i class="fas fa-user" data-placement="top" title="Update Operator"></i></button>';
                                        $buttons .= '<button type="button" class="btn-xs btn-secondary" onclick="editFunc1('.$value['id'].')" data-toggle="modal" data-target="#operator1">
                                                    <i class="fas fa-user" data-placement="top" title="Update Operator"></i>
                                                    </button>';
                                    }else{
                                        // $buttons.= '<button class="btn-xs btn-success" data-toggle="modal" data-target="#operator'.$value['id'].'"><i class="fas fa-user" data-placement="top" title="Tambah Operator"></i></button>';
				                        // $buttons = '<a href="'.base_url('transaksi/add/'.$value['id_kendaraan'].'/1/0').'" class="btn-xs btn-info" data-placement="top" title="Tambah Transaksi"><i class="fas fa-calendar-check"></i></a>';
                                        $buttons .= '<button type="button" class="btn-xs btn-success" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#operator">
                                                    <i class="fas fa-user" data-placement="top" title="Tambah Operator"></i>
                                                    </button>';
                                    }
                                    $buttons .= '<a href="'.base_url('kendaraan/edit/'.$value['idkendaraan']).'" class="btn-xs btn-warning" data-placement="top" title="Edit Kendaraan"><i class="fas fa-edit"></i></a>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			
			// $foto_barang = '<a href="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" data-toggle="lightbox" data-title="Foto Barang">
            //                     <img src="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" class="img-size-50" alt="Foto Barang"/>
            //                 </a>';

			// $qr_code = '<a href="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" data-toggle="lightbox" data-title="QR Code">
			// 	<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" class="img-size-50" alt="QR Code"/>
			// </a>';

			// $kategori = $this->m_logistik->getKategoriData($value['id_kategori']);
			// $kategori = $kategori['nama_kategori'];

			// $satuan = $this->m_logistik->getSatuanData($value['id_satuan']);
			// $satuan = $satuan['nama_satuan'];
			

			$result['data'][$key] = array(
				$buttons,
				$value['masa_stnk'] .' Hari <br>'. $pesan_stnk,
                $value['masa_kir'] .' Hari <br>'. $pesan_kir,
                $value['masa_rental'] .' Hari <br>'. $pesan_rental,
                // $value['tanggal_transaksi'] .' Hari <br>'. $pesan_service
                $value['cluster'],
                $operator,
                $value['jabatan'],
                $status_kepemilikan,
                $value['plat_nomor'],
                $value['odometer'],
                $value['tanggal_rental'],
                $value['nama_pemilik'],
                $value['jenis_kendaraan'],
                $value['tahun_pembuatan'],
                $value['keterangan'],
                $value['warna'],
                $value['bahan_bakar'],
                $value['nomor_rangka'],
                $value['nomor_mesin'],
                $value['nomor_bpkb'],
                format_hari_tanggal($value['stnk_waktu']),
                format_hari_tanggal($value['kir_waktu']),


                '<a href="'.base_url('assets/gambar/'.$value['foto_depan']).'" data-toggle="lightbox" data-title="Foto Depan">Foto Depan
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value->foto_depan).'" class="img-size-50" alt="Foto Depan"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_belakang']).'" data-toggle="lightbox" data-title="Foto Belakang">Foto Belakang
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_belakang']).'" class="img-size-50" alt="Foto Belakang"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_kiri']).'" data-toggle="lightbox" data-title="Foto Kiri">Foto Kiri
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_kiri']).'" class="img-size-50" alt="Foto Kiri"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_kanan']).'" data-toggle="lightbox" data-title="Foto Kanan">Foto Kanan
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_kanan']).'" class="img-size-50" alt="Foto Kanan"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior1']).'" data-toggle="lightbox" data-title="Foto Interior 1">Foto Interior 1
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior1']).'" class="img-size-50" alt="Foto Interior 1"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior2']).'" data-toggle="lightbox" data-title="Foto Interior 2">Foto Interior 2
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior2']).'" class="img-size-50" alt="Foto Interior 2"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior3']).'" data-toggle="lightbox" data-title="Foto Interior 3">Foto Interior 3
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior3']).'" class="img-size-50" alt="Foto Interior 3"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior4']).'" data-toggle="lightbox" data-title="Foto Interior 4">Foto Interior 4
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior4']).'" class="img-size-50" alt="Foto Interior 4"/> -->
			);
		} // /foreach

		echo json_encode($result);
	}

    // List all your items
    public function stnk()
    {
        
        $data = array(
            'title' => 'Alarm STNK Kendaraan',
            // 'kendaraan' => $this->m_kendaraan->get_all_data_alarm1(),
            'isi'   => 'kendaraan/v_kendaraan_stnk'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function fetchKendaraanStnk()
	{

        date_default_timezone_set('Asia/Jakarta');
        $user = $this->m_user->get_all_data();
        function format_hari_tanggal($waktu)
        {
            $hari_array = array(
                'Minggu',
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
            );
            $hr = date('w', strtotime($waktu));
            $hari = $hari_array[$hr];
            $tanggal = date('j', strtotime($waktu));
            $bulan_array = array(
                1 => 'Januari',
                2 => 'Februari',
                3 => 'Maret',
                4 => 'April',
                5 => 'Mei',
                6 => 'Juni',
                7 => 'Juli',
                8 => 'Agustus',
                9 => 'September',
                10 => 'Oktober',
                11 => 'November',
                12 => 'Desember',
            );
            $bl = date('n', strtotime($waktu));
            $bulan = $bulan_array[$bl];
            $tahun = date('Y', strtotime($waktu));
            $jam = date( 'H:i:s', strtotime($waktu));
            
            //untuk menampilkan hari, tanggal bulan tahun jam
            //return "$hari, $tanggal $bulan $tahun $jam";
        
            //untuk menampilkan hari, tanggal bulan tahun
            return "$tanggal-$bulan-$tahun";
        }
		$result = array('data' => array());

		$data = $this->m_kendaraan->get_all_data_alarm1();

		foreach ($data as $key => $value) {

            if($value['status_kepemilikan'] == ""){
                $status_kepemilikan = "-";
            }elseif($value['status_kepemilikan'] == 1){
                $status_kepemilikan = "<span class='badge bg-success'>Asset</span>";
            }elseif($value['status_kepemilikan'] == 2){
                $status_kepemilikan = "<span class='badge bg-info'>Rental</span>";
            }elseif($value['status_kepemilikan'] == 3){
                $status_kepemilikan = "<span class='badge bg-warning'>Non Asset</span>";
            }
            
            if ($value['masa_stnk'] < 0){
                $pesan_stnk = "<span class='badge bg-danger'>STNK TERLEWAT</span>";
            }elseif ($value['masa_stnk'] <= 20) {
                $pesan_stnk = "<span class='badge bg-danger'>KIRIM STNK</span>";
            }elseif ($value['masa_stnk'] <= 30) {
                $pesan_stnk = "<span class='badge bg-warning'>INFO KE OPERATOR</span>";
            }else{
                $pesan_stnk = "<span class='badge bg-success'>STNK AMAN</span>";
            }

            // if ($value['masa_kir'] == ""){
            //     $pesan_kir = "<span class='badge bg-success'>NON KIR</span>";
            // }elseif ($value['masa_kir'] < 0){
            //     $pesan_kir = "<span class='badge bg-danger'>KIR TERLEWAT</span>";
            // }elseif ($value['masa_kir'] <= 14) {
            //     $pesan_kir = "<span class='badge bg-warning'>KIRIM KIR</span>";
            // }elseif ($value['masa_kir'] <= 30) {
            //     $pesan_kir = "<span class='badge bg-info'>INFO KE OPERATOR</span>";
            // }else{
            //     $pesan_kir = "<span class='badge bg-success'>KIR AMAN</span>";
            // }

            // if ($value['masa_rental'] == ''){
            //     $pesan_rental = "<span class='badge bg-success'>ASET</span>";
            // }elseif ($value['masa_rental'] < 1){
            //     $pesan_rental = "<span class='badge bg-danger'>BAYAR SEKARANG !!!</span>";
            // }
            // elseif ($value['masa_rental'] <= 2) {
            //     $pesan_rental = "<span class='badge bg-warning'>SEGERA DIPROSES !!!</span>";
            // }elseif ($value['masa_rental'] <= 5) {
            //     $pesan_rental = "<span class='badge bg-info'>PERSIAPKAN</span>";
            // }else{
            //     $pesan_rental = "<span class='badge bg-success'>RENTAL AMAN</span>";
            // }

            if ($value['user_id'] != '') {
                $operator = $this->m_user->get_operator($value['user_id']);
                $operator = $operator['first_name'].' '.$operator['last_name'];
                // $operator = $value['user_id'];
            }else{
                $operator = '-';
            }

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				// $buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
				// $buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id_kendaraan']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				// $buttons = '<a href="'.base_url('transaksi/add/'.$value['id_kendaraan'].'/1').'" class="btn-xs btn-info" data-placement="top" title="Tambah Transaksi"><i class="fas fa-calendar-check"></i></a>';
                                    if ($value['id_histori'] != "") {
				                        // $buttons = '<a href="'.base_url('transaksi/add/'.$value['idkendaraan'].'/1/1').'" class="btn-xs btn-info" data-placement="top" title="Tambah Transaksi"><i class="fas fa-calendar-check"></i></a>';

                                    //     $buttons.= '<button class="btn-xs btn-secondary" data-toggle="modal" data-target="#operator11'.$value['id'].'"><i class="fas fa-user" data-placement="top" title="Update Operator"></i></button>';
                                    }else{
                                    //     $buttons.= '<button class="btn-xs btn-success" data-toggle="modal" data-target="#operator'.$value['id'].'"><i class="fas fa-user" data-placement="top" title="Tambah Operator"></i></button>';
				                        // $buttons = '<a href="'.base_url('transaksi/add/'.$value['idkendaraan'].'/1/0').'" class="btn-xs btn-info" data-placement="top" title="Tambah Transaksi"><i class="fas fa-calendar-check"></i></a>';

                                    }
                                    $buttons.= '<a href="'.base_url('kendaraan/edit/'.$value['idkendaraan']).'" class="btn-xs btn-warning" data-placement="top" title="Edit Kendaraan"><i class="fas fa-edit"></i></a>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			
			// $foto_barang = '<a href="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" data-toggle="lightbox" data-title="Foto Barang">
            //                     <img src="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" class="img-size-50" alt="Foto Barang"/>
            //                 </a>';

			// $qr_code = '<a href="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" data-toggle="lightbox" data-title="QR Code">
			// 	<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" class="img-size-50" alt="QR Code"/>
			// </a>';

			// $kategori = $this->m_logistik->getKategoriData($value['id_kategori']);
			// $kategori = $kategori['nama_kategori'];

			// $satuan = $this->m_logistik->getSatuanData($value['id_satuan']);
			// $satuan = $satuan['nama_satuan'];
			

			$result['data'][$key] = array(
				$buttons,
				$value['masa_stnk'] .' Hari <br>'. $pesan_stnk,
                format_hari_tanggal($value['stnk_waktu']),
                // $value['masa_kir'] .' Hari <br>'. $pesan_kir,
                // $value['masa_rental'] .' Hari <br>'. $pesan_rental,
                // $value['tanggal_transaksi'] .' Hari <br>'. $pesan_service
                $value['cluster'],
                $operator,
                $value['jabatan'],
                $status_kepemilikan,
                $value['plat_nomor'],
                $value['odometer'],
                $value['tanggal_rental'],
                $value['nama_pemilik'],
                $value['jenis_kendaraan'],
                $value['tahun_pembuatan'],
                $value['keterangan'],
                $value['warna'],
                $value['bahan_bakar'],
                $value['nomor_rangka'],
                $value['nomor_mesin'],
                $value['nomor_bpkb'],
                // format_hari_tanggal($value['kir_waktu']),


                '<a href="'.base_url('assets/gambar/'.$value['foto_depan']).'" data-toggle="lightbox" data-title="Foto Depan">Foto Depan
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value->foto_depan).'" class="img-size-50" alt="Foto Depan"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_belakang']).'" data-toggle="lightbox" data-title="Foto Belakang">Foto Belakang
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_belakang']).'" class="img-size-50" alt="Foto Belakang"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_kiri']).'" data-toggle="lightbox" data-title="Foto Kiri">Foto Kiri
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_kiri']).'" class="img-size-50" alt="Foto Kiri"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_kanan']).'" data-toggle="lightbox" data-title="Foto Kanan">Foto Kanan
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_kanan']).'" class="img-size-50" alt="Foto Kanan"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior1']).'" data-toggle="lightbox" data-title="Foto Interior 1">Foto Interior 1
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior1']).'" class="img-size-50" alt="Foto Interior 1"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior2']).'" data-toggle="lightbox" data-title="Foto Interior 2">Foto Interior 2
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior2']).'" class="img-size-50" alt="Foto Interior 2"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior3']).'" data-toggle="lightbox" data-title="Foto Interior 3">Foto Interior 3
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior3']).'" class="img-size-50" alt="Foto Interior 3"/> -->
                '<a href="'.base_url('assets/gambar/'.$value['foto_interior4']).'" data-toggle="lightbox" data-title="Foto Interior 4">Foto Interior 4
                </a>',
                // <!-- <img src="'.base_url('assets/gambar/'.$value['foto_interior4']).'" class="img-size-50" alt="Foto Interior 4"/> -->
			);
		} // /foreach

		echo json_encode($result);
	}
    
    public function kir()
    {
        
        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $this->m_kendaraan->get_all_data_alarm2(),
            'isi'   => 'kendaraan/v_kendaraan'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function service($alarm = NULL)
    {
        if ($alarm == 'alarm') {
            $get = $this->m_kendaraan->get_all_data_alarm3();
        }else{
            $get = $this->m_kendaraan->get_all_data_service();

        }
        
        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $get,
            'isi'   => 'kendaraan/v_kendaraan_service'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function rental()
    {
        
        $data = array(
            'title' => 'Kendaraan',
            'kendaraan' => $this->m_kendaraan->get_all_data_alarm4(),
            'isi'   => 'kendaraan/v_kendaraan'
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
                $this->m_kendaraan->add($data);
                $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Ditambahkan');
                redirect('kendaraan');
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
                $this->m_kendaraan->edit($data);
                $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
                // $this->session->set_flashdata('pesan_kendaraan', $error);
                redirect('kendaraan');
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
            'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
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

        $kendaraan = $this->m_kendaraan->get_data($id_kendaraan);
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
                'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
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
            $this->m_kendaraan->edit($data);
            $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
            redirect($redirect_page,'refresh');
        }

        $data = array(
            'title' => 'Edit Kendaraan',
            // 'kategori' => $this->m_kategori->get_all_data(),
            'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
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
        $this->m_kendaraan->delete($data);
        $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Dihapus');
        redirect('kendaraan');
    }

    // OPERATOR
    public function operator()
    {
        $tanggalhis = $this->input->post('tanggalhis');
        $bulanhis = $this->input->post('bulanhis');
        $tahunhis = $this->input->post('tahunhis');

        $operator_his = date('Y-m-d', strtotime($tahunhis."-".$bulanhis."-".$tanggalhis));
        
        $this->form_validation->set_rules('o_plat_nomor', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('o_id_kendaraan', 'Plat Nomor', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('cluster', 'Cluster', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('operator', 'Nama Operator', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('jabatan', 'Jabatan/Posisi', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tanggalhis', 'Tanggal', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('bulanhis', 'Bulan', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('tahunhis', 'Tahun', 'required',  array('required' => '%s Harus Diisi !!' ));

        
        if ($this->form_validation->run() == TRUE) {
            // $data = array(
            //     'title' => 'Kendaraan',
            //     'kendaraan' => $this->m_kendaraan->get_all_data(),
            //     'isi'   => 'kendaraan/v_kendaraan'
            // );
            // $this->load->view('layout/v_wrapper_backend', $data, FALSE);

            $data = array(
                'id_histori' => date('Y').strtoupper(random_string('alnum',1)).date('m').strtoupper(random_string('alnum',1)).date('d'),
                'id_kendaraan' => $this->input->post('o_id_kendaraan'),
                'cluster' => $this->input->post('cluster'),
                'operator' => $this->input->post('operator'),
                'jabatan' => $this->input->post('jabatan'),
                'tanggal' => $operator_his,
                'status' => 1,
                'user_id' => $this->input->post('operator')
            );
            $insert = $this->m_kendaraan->add_operator($data);
            if($insert == true) {
                $response['success'] = true;
                $response['messages'] = 'Berhasil menambah operator';
            }
            else {
                $response['success'] = false;
                $response['messages'] = 'Error in the database while updated';			
            }
            // $this->session->set_flashdata('pesan_kendaraan', 'Data Operator Ditambahkan');
            // redirect('kendaraan');
        }
        echo json_encode($response);


        // $data = array(
        //     'title' => 'Kendaraan',
        //     // 'kendaraan' => $this->m_kendaraan->get_all_data(),
        //     'isi'   => 'kendaraan/v_kendaraan'
        // );
        // $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    // OPERATOR1
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
            // $data = array(
            //     'title' => 'Kendaraan',
            //     'kendaraan' => $this->m_kendaraan->get_all_data(),
            //     'isi'   => 'kendaraan/v_kendaraan'
            // );
            // $this->load->view('layout/v_wrapper_backend', $data, FALSE);

            $data = array(
                'id_histori' => date('Y').strtoupper(random_string('alnum',1)).date('m').strtoupper(random_string('alnum',1)).date('d'),
                'id_kendaraan' => $this->input->post('id_kendaraan'),
                'cluster' => $this->input->post('cluster'),
                'operator' => $this->input->post('operator'),
                'jabatan' => $this->input->post('jabatan'),
                'tanggal' => $operator_his,
                'status' => 1,
                'user_id' => $this->input->post('operator')
            );
            $this->m_kendaraan->add_operator($data);
            // if ($this->m_kendaraan->add_operator($data) == TRUE) {
                $data = array(
                    'id_histori' => $this->input->post('id_histori'),
                    'status' => 0
                );
                $update = $this->m_kendaraan->edit_operator($data);
                // $this->session->set_flashdata('pesan_kendaraan', 'Data Operator Ditambahkan');
                // redirect('kendaraan');
                if($update == true) {
                    $response['success'] = true;
                    $response['messages'] = 'Berhasil update operator';
                }
                else {
                    $response['success'] = false;
                    $response['messages'] = 'Error in the database while updated';			
                }
            // }
        }

        echo json_encode($response);
        // $data = array(
        //     'title' => 'Kendaraan',
        //     'kendaraan' => $this->m_kendaraan->get_all_data(),
        //     'isi'   => 'kendaraan/v_kendaraan'
        // );
        // $this->load->view('layout/v_wrapper_backend', $data, FALSE);
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
    //             'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
    //             'error_upload' => $this->upload->display_errors(),
    //             'isi'   => 'kendaraan/v_edit'
    //         );
    //         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    //     }else{
    //         $kendaraan = $this->m_kendaraan->get_data($id_kendaraan);
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
    //         $this->m_kendaraan->edit($data);
    //         $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
    //         redirect($redirect_page,'refresh');
    //     }

    //     $data = array(
    //         'title' => 'Edit Kendaraan',
    //         'kategori' => $this->m_kategori->get_all_data(),
    //         'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
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
    //             'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
    //             'error_upload' => $this->upload->display_errors(),
    //             'isi'   => 'kendaraan/v_edit'
    //         );
    //         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    //     }else{
    //         $kendaraan = $this->m_kendaraan->get_data($id_kendaraan);
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
    //         $this->m_kendaraan->edit($data);
    //         $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
    //         redirect($redirect_page,'refresh');
    //     }

    //     $data = array(
    //         'title' => 'Edit Kendaraan',
    //         'kategori' => $this->m_kategori->get_all_data(),
    //         'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
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
    //             'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
    //             'error_upload' => $this->upload->display_errors(),
    //             'isi'   => 'kendaraan/v_edit'
    //         );
    //         $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    //     }else{
    //         $kendaraan = $this->m_kendaraan->get_data($id_kendaraan);
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
    //         $this->m_kendaraan->edit($data);
    //         $this->session->set_flashdata('pesan_kendaraan', 'Data Berhasil Diedit');
    //         redirect($redirect_page,'refresh');
    //     }

    //     $data = array(
    //         'title' => 'Edit Kendaraan',
    //         'kategori' => $this->m_kategori->get_all_data(),
    //         'kendaraan' => $this->m_kendaraan->get_data($id_kendaraan),
    //         'isi'   => 'kendaraan/v_edit'
    //     );
    //     $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    // }
}

/* End of file barang.php */

