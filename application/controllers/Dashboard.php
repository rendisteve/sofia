<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_dashboard');
        $this->load->model('m_user');
        $this->load->model('m_logistik');
        $this->load->model('m_pesanan_masuk');
        // check_access('dashboard');
                
    }
    

    public function index()
    {
        $user = $this->session->userdata('user_id');

        $role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');

		if ($role_id == '7') {
            $total_gudang = 0;
            $total_penyimpanan = 0;
            $total_kategori = 0;
            $total_satuan = 0;
            $total_barang = 0;
			$barang_masuk = $this->m_logistik->getTotalBarangMasukUser($user_id);
            $barang_keluar = $this->m_logistik->getTotalBarangKeluarUser($user_id);

		}else{
            $total_gudang = $this->m_logistik->countTotalLokasi();
            $total_penyimpanan = $this->m_logistik->countTotalPenyimpanan();
            $total_kategori = $this->m_logistik->countTotalKategori();
            $total_satuan = $this->m_logistik->countTotalSatuan();
            $total_barang = $this->m_logistik->countTotalBarang();
			$barang_masuk = $this->m_logistik->getTotalBarangMasuk();
            $barang_keluar = $this->m_logistik->getTotalBarangKeluar();
		}
        
        // $total_gudang = $this->m_logistik->countTotalLokasi();
        // $total_penyimpanan = $this->m_logistik->countTotalPenyimpanan();
        // $total_kategori = $this->m_logistik->countTotalKategori();
        // $total_satuan = $this->m_logistik->countTotalSatuan();
        // $total_barang = $this->m_logistik->countTotalBarang();

        // $barang_masuk = $this->m_logistik->getTotalBarangMasuk();
        // $barang_keluar = $this->m_logistik->getTotalBarangKeluar();
        $graph = $this->m_logistik->getGraph();
        $graph1= $this->m_logistik->getGraph1();

        $alarm_service = $this->m_dashboard->get_alarm_service($user);
        $alarm_rental = $this->m_dashboard->get_alarm_rental($user);
        $alarm_surat = $this->m_dashboard->get_alarm_surat($user);
        $hari1a = 0;
        $hari1b = 0;
        $alarm1a = 0; 
        $alarm1b = 0; 
        $tgl2 = new DateTime(date('Y-m-d')); 
        // foreach ($alarm_surat as $key => $value) {
        //     $tgl1a = new DateTime($value->stnk_waktu); 
        //     // $tgl1b = new DateTime($value->kir_waktu); 
        //     // $tgl2 = new DateTime(date('Y-m-d')); 
        //     // $jarak = $tgl2 - $tgl1;
        //     // $hari = $jarak / 60 / 60 / 24;
        //     $jarak1a = date_diff($tgl1a,$tgl2);
        //     // $jarak1b = date_diff($tgl1b,$tgl2);
        //     $hari1a = $jarak1a->format("%a");
        //     // $hari1b = $jarak1b->format("%a");
        //     if ($tgl2 > $tgl1a || $hari1a <= 30) {
        //         $alarm1a = $alarm1a + 1;
        //     }elseif($hari1a < 15){
        //         $alarm1a = $alarm1a + 1;
        //     }

        //     // if ($tgl2 > $tgl1b || $hari1b > 30) {
        //     //     $alarm1b = $alarm1b + 1;
        //     // }elseif($hari1b < 15){
        //     //     $alarm1b = $alarm1b + 1;
        //     // }
        // }

        // foreach ($alarm_surat as $key => $value) {
        //     // $tgl1a = new DateTime($value->stnk_waktu); 
        //     $tgl1b = new DateTime($value->kir_waktu); 
        //     // $tgl2 = new DateTime(date('Y-m-d')); 
        //     // $jarak = $tgl2 - $tgl1;
        //     // $hari = $jarak / 60 / 60 / 24;
        //     // $jarak1a = date_diff($tgl1a,$tgl2);
        //     $jarak1b = date_diff($tgl1b,$tgl2);
        //     // $hari1a = $jarak1a->format("%a");
        //     $hari1b = $jarak1b->format("%a");
        //     // if ($tgl2 > $tgl1a || $hari1a > 30) {
        //     //     $alarm1a = $alarm1a + 1;
        //     // }elseif($hari1a < 15){
        //     //     $alarm1a = $alarm1a + 1;
        //     // }

        //     if ($value->kir_waktu == "") {
        //         $alarm1b = 0;
        //     }
        //     if ($tgl2 > $tgl1b || $hari1b <= 30) {
        //         $alarm1b = $alarm1b + 1;
        //     }elseif($hari1b < 15){
        //         $alarm1b = $alarm1b + 1;
        //     }
        // }
        $data = array(
            'title' => 'Dashboard',
            'total_gudang' => $total_gudang,
            'total_penyimpanan' => $total_penyimpanan,
            'total_kategori_barang' => $total_kategori,
            'total_satuan' => $total_satuan,
            'total_barang' => $total_barang,
            'barang_masuk' => $barang_masuk['qty_masuk'],
            'barang_keluar' => $barang_keluar['qty_keluar'],
            'graph' => $graph,
            'graph1' => $graph1,

            // 'total_kendaraan' => $this->m_dashboard->total_kendaraan($user),
            'total_asset' => $this->m_dashboard->total_asset($user),
            'total_rental' => $this->m_dashboard->total_rental($user),
            'total_nonasset' => $this->m_dashboard->total_nonasset($user),
            'total_kategori' => $this->m_dashboard->total_kategori($user),
            // // 'alarm_stnk' => $alarm1a,
            'alarm_stnk' => $this->m_dashboard->get_alarm_stnk($user),
            // // 'alarm_kir' => $alarm1b,
            'alarm_kir' => $this->m_dashboard->get_alarm_kir($user),
            'alarm_service' => $alarm_service,
            'alarm_rental' => $alarm_rental,
            'isi'    => 'v_dashboard'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    public function fetchGudangBarangMasukData()
	{

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
			return "$tanggal-$bulan-$tahun $jam";
		}
		
		$result = array('data' => array());

		// $data = $this->m_logistik->getGudangBarangMasukData();
        $data = $this->m_logistik->getGraph();

		foreach ($data as $key => $value) {
			
			$result['data'][$key] = array(
				$value['total'],
				$value['first_name'].' '.$value['last_name']
			);
		} // /foreach
		echo json_encode($result);
	}

    public function setting()
    {
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('kota', 'Kota', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required',  array('required' => '%s Harus Diisi !!' ));
        $this->form_validation->set_rules('no_telpon', 'No Telpon', 'required',  array('required' => '%s Harus Diisi !!' ));

        
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Setting',
                'setting' => $this->m_dashboard->data_setting(),
                'isi'    => 'v_setting'
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        }else{
            $data = array(
                'id' => 1,
                'lokasi' => $this->input->post('kota'),
                'nama_toko' => $this->input->post('nama_toko'),
                'alamat_toko' => $this->input->post('alamat_toko'),
                'no_telpon' => $this->input->post('no_telpon'),
            );
            $this->m_dashboard->edit($data);
            $this->session->set_flashdata('pesan_setting', 'Settingan Berhasil Diganti');
            redirect('admin/setting');
        }
    }

    public function pesanan_masuk()
    {
        $data = array(
            'title' => 'Pesanan Masuk',
            'pesanan' => $this->m_pesanan_masuk->pesanan(),
            'pesanan_diproses' => $this->m_pesanan_masuk->pesanan_diproses(),
            'pesanan_dikirim' => $this->m_pesanan_masuk->pesanan_dikirim(),
            'pesanan_selesai' => $this->m_pesanan_masuk->pesanan_selesai(),
            'isi'    => 'v_pesanan_masuk'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

    public function proses($id_transaksi)
    {
        $data = array(
                    'id_transaksi' => $id_transaksi,
                    'status_order' => '1' 
                );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan_pesanan_masuk', 'Pesanan Berhasil Diproses/Dikemas');
        redirect('admin/pesanan_masuk'); 
    }

    public function kirim($id_transaksi)
    {
        $data = array(
                    'id_transaksi' => $id_transaksi,
                    'status_order' => '2', 
                    'no_resi' => $this->input->post('no_resi')
                );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan_pesanan_masuk', 'Pesanan Berhasil Dikirim');
        redirect('admin/pesanan_masuk');
    }

    

}

/* End of file Home.php */
