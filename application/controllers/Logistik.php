<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');


class Logistik extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_logistik');
        $this->load->model('m_user');
        // $this->user_login->cek_login();
        
    }

    public function index()
    {    
        // $data = array(
        //     'title' => 'Gudang',
        //     // 'kendaraan' => $this->m_kendaraan->get_all_data(),
        //     'isi'   => 'logistik/v_gudang'
        // );
        // $this->load->view('layout/v_wrapper_backend', $data, FALSE);
    }

	public function print_label100mm($id)
    {
        $data = array(
            'title' => 'Label 100mm',
			'barang' => $this->m_logistik->getBarangDataCetak($id)
            // 'tiket' => $this->m_keranjang->detail($no_penjualan)
        );

        $this->load->view('logistik/print-label100mm', $data, FALSE);
    }

	public function print_label80mm($id)
    {
        $data = array(
            'title' => 'Label',
			'barang' => $this->m_logistik->getBarangDataCetak($id)
            // 'tiket' => $this->m_keranjang->detail($no_penjualan)
        );

        $this->load->view('logistik/print-label80mm', $data, FALSE);
    }

	public function print_label58mm($id)
    {
        $data = array(
            'title' => 'Label',
			'barang' => $this->m_logistik->getBarangDataCetak($id)
            // 'tiket' => $this->m_keranjang->detail($no_penjualan)
        );

        $this->load->view('logistik/print-label58mm', $data, FALSE);
    }

	public function print_label_gudang100mm($id)
    {
        $data = array(
            'title' => 'Label Gudang 100mm',
			// 'barang' => $this->m_logistik->getBarangDataCetak($id)
			'barang' => $this->m_logistik->getGudangDataCetak($id)
            // 'tiket' => $this->m_keranjang->detail($no_penjualan)
        );

        $this->load->view('logistik/print-label-gudang100mm', $data, FALSE);
    }

	public function print_label_gudang80mm($id)
    {
        $data = array(
            'title' => 'Label Gudang 80mm',
			// 'barang' => $this->m_logistik->getBarangDataCetak($id)
			'barang' => $this->m_logistik->getGudangDataCetak($id)
            // 'tiket' => $this->m_keranjang->detail($no_penjualan)
        );

        $this->load->view('logistik/print-label-gudang80mm', $data, FALSE);
    }

	public function print_label_gudang58mm($id)
    {
        $data = array(
            'title' => 'Label Gudang 58mm',
			// 'barang' => $this->m_logistik->getBarangDataCetak($id)
			'barang' => $this->m_logistik->getGudangDataCetak($id)
            // 'tiket' => $this->m_keranjang->detail($no_penjualan)
        );

        $this->load->view('logistik/print-label-gudang58mm', $data, FALSE);
    }

	////LOKASI
    public function Lokasi_gudang()
    { 
        $data = array(
            'title' => 'Lokasi Gudang',
            // 'kendaraan' => $this->m_kendaraan->get_all_data(),
            'isi'   => 'logistik/v_lokasi_gudang'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }
    
    public function fetchLokasiDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getLokasiData($id);
			echo json_encode($data);
		}
	}

	public function fetchLokasiData()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getLokasiData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			$status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			$result['data'][$key] = array(
				$buttons,
				$status,
				$value['nama_gudang'],
				$value['alamat']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function createLokasi()
	{
		// if(!in_array('createStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('nama_gudang', 'Nama Gudang', 'trim|required');
		$this->form_validation->set_rules('alamat_gudang', 'Alamat Gudang', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'nama_gudang' => $this->input->post('nama_gudang'),
        		'alamat' => $this->input->post('alamat_gudang'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->m_logistik->createLokasi($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Berhasil menambahkan data';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	public function updateLokasi($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_nama_gudang', 'Nama Gudang', 'trim|required');
			$this->form_validation->set_rules('edit_alamat_gudang', 'Alamat Gudang', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'nama_gudang' => $this->input->post('edit_nama_gudang'),
	        		'alamat' => $this->input->post('edit_alamat_gudang'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->m_logistik->updateLokasi($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Berhasil memperbarui data';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function removeLokasi()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->m_logistik->removeLokasi($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data berhasil dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

	////PENYIMPANAN
	public function penyimpanan()
    { 
        $data = array(
            'title' => 'Penyimpanan Gudang',
            'gudang' => $this->m_logistik->getActiveLokasi(),
            'isi'   => 'logistik/v_penyimpanan_gudang'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }
    
    public function fetchPenyimpananDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getPenyimpananData($id);
			$data_gudang = $this->m_logistik->getLokasiData($this->m_logistik->getPenyimpananData($id)['id_gudang']);
			$gudang = $this->m_logistik->getActiveLokasi();
			echo json_encode($data);
		}
	}

	public function fetchPenyimpananData()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getPenyimpananData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			$status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			$gudang = $this->m_logistik->getLokasiData($value['id_gudang']);

			$result['data'][$key] = array(
				$buttons,
				$status,
				$value['nama_penyimpanan'],
				$gudang['nama_gudang']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function createPenyimpanan()
	{
		// if(!in_array('createStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('nama_penyimpanan', 'Nama Penyimpanan', 'trim|required');
		$this->form_validation->set_rules('gudang', 'Gudang', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'nama_penyimpanan' => $this->input->post('nama_penyimpanan'),
        		'id_gudang' => $this->input->post('gudang'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->m_logistik->createPenyimpanan($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Berhasil menambahkan data';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	public function updatePenyimpanan($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_nama_penyimpanan', 'Nama Penyimpanan', 'trim|required');
			$this->form_validation->set_rules('edit_gudang', 'Nama Gudang', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'nama_penyimpanan' => $this->input->post('edit_nama_penyimpanan'),
	        		'id_gudang' => $this->input->post('edit_gudang'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->m_logistik->updatePenyimpanan($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Berhasil memperbarui data';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function removePenyimpanan()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->m_logistik->removePenyimpanan($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data berhasil dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

	////KATEGORI
    public function kategori()
    { 
        $data = array(
            'title' => 'Kategori',
            // 'kendaraan' => $this->m_kendaraan->get_all_data(),
            'isi'   => 'logistik/v_kategori'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }
    
    public function fetchKategoriDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getKategoriData($id);
			echo json_encode($data);
		}
	}

	public function fetchKategoriData()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getKategoriData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			$status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			$result['data'][$key] = array(
				$buttons,
				$status,
				$value['nama_kategori']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function createKategori()
	{
		// if(!in_array('createStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('nama_kategori', 'Nama Kategori', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'nama_kategori' => $this->input->post('nama_kategori'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->m_logistik->createKategori($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Berhasil menambahkan data';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	public function updateKategori($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_nama_kategori', 'Nama Kategori', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'nama_kategori' => $this->input->post('edit_nama_kategori'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->m_logistik->updateKategori($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Berhasil memperbarui data';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function removeKategori()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->m_logistik->removeKategori($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data berhasil dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

	////JENIS
    public function jenis()
    { 
        $data = array(
            'title' => 'Jenis',
            // 'kendaraan' => $this->m_kendaraan->get_all_data(),
            'isi'   => 'logistik/v_jenis'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }
    
    public function fetchJenisDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getJenisData($id);
			echo json_encode($data);
		}
	}

	public function fetchJenisData()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getJenisData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			$status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			$result['data'][$key] = array(
				$buttons,
				$status,
				$value['nama_jenis']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function createJenis()
	{
		// if(!in_array('createStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'nama_jenis' => $this->input->post('nama_jenis'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->m_logistik->createJenis($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Berhasil menambahkan data';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	public function updateJenis($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_nama_jenis', 'Nama Jenis', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'nama_jenis' => $this->input->post('edit_nama_jenis'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->m_logistik->updateJenis($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Berhasil memperbarui data';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function removeJenis()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->m_logistik->removeJenis($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data berhasil dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}


	////SATUAN
    public function satuan()
    { 
        $data = array(
            'title' => 'Satuan',
            // 'kendaraan' => $this->m_kendaraan->get_all_data(),
            'isi'   => 'logistik/v_satuan'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }
    
    public function fetchSatuanDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getSatuanData($id);
			echo json_encode($data);
		}
	}

	public function fetchSatuanData()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getSatuanData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			$status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			$result['data'][$key] = array(
				$buttons,
				$status,
				$value['nama_satuan']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function createSatuan()
	{
		// if(!in_array('createStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'trim|required');
		$this->form_validation->set_rules('active', 'Active', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'nama_satuan' => $this->input->post('nama_satuan'),
        		'active' => $this->input->post('active'),	
        	);

        	$create = $this->m_logistik->createSatuan($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Berhasil menambahkan data';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	public function updateSatuan($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_nama_satuan', 'Nama Satuan', 'trim|required');
			$this->form_validation->set_rules('edit_active', 'Active', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'nama_satuan' => $this->input->post('edit_nama_satuan'),
	        		'active' => $this->input->post('edit_active'),	
	        	);

	        	$update = $this->m_logistik->updateSatuan($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Berhasil memperbarui data';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function removeSatuan()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->m_logistik->removeSatuan($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data berhasil dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

	
	// BARANG
	public function barang()
    { 
        $data = array(
            'title' => 'Barang',
            // 'kendaraan' => $this->m_kendaraan->get_all_data(),
			'kategori' => $this->m_logistik->getActiveKategori(),
			'satuan' => $this->m_logistik->getActiveSatuan(),
            'isi'   => 'logistik/v_barang'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }
    
    public function fetchBarangDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getBarangData($id);
			echo json_encode($data);
		}
	}

	public function fetchBarangData()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getBarangData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				// $buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
				$buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				$buttons .= ' <button type="button" class="btn btn-success btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-print"></i></button>';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			
			$foto_barang = '<a href="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" data-toggle="lightbox" data-title="Foto Barang">
                                <img src="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" class="img-size-50" alt="Foto Barang"/>
                            </a>';

			$qr_code = '<a href="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" data-toggle="lightbox" data-title="QR Code">
				<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" class="img-size-50" alt="QR Code"/>
			</a>';

			$kategori = $this->m_logistik->getKategoriData($value['id_kategori']);
			$kategori = $kategori['nama_kategori'];

			$satuan = $this->m_logistik->getSatuanData($value['id_satuan']);
			$satuan = $satuan['nama_satuan'];
			

			$result['data'][$key] = array(
				$buttons,
				$value['kode_barang'],
				$qr_code,
				$foto_barang,
				$value['nama_barang'],
				$value['spesifikasi'],
				$kategori,
				$satuan,
				$value['min_qty'],
				$value['max_qty']

			);
		} // /foreach

		echo json_encode($result);
	}

	public function createBarang1()
	{
		// if(!in_array('createStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('spesifikasi_barang', 'Spesifikasi Barang', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
			// // assets/images/product_image
			// $config['upload_path'] = './assets/gambar_barang/';
			// $config['file_name'] =  uniqid();
			// $config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
			// $config['max_size'] = '10000';
	
			// // $config['max_width']  = '1024';s
			// // $config['max_height']  = '768';
	
			// $this->load->library('upload', $config);
			// if (!$this->upload->do_upload('foto_barang'))
			// {
			// 	$data = array(
			// 		'title' => 'Barang',
			// 		'error_upload' => $this->upload->display_errors(),
			// 		'kategori' => $this->m_logistik->getActiveKategori(),
			// 		'satuan' => $this->m_logistik->getActiveSatuan(),
			// 		'isi'   => 'logistik/v_barang'
			// 	);
			// 	$this->load->view('layout/v_wrapper_backend', $data, FALSE);
			// }
			// else
			// {
			// 	$gambar = $this->upload->data();
			// 	$gambar = $gambar['file_name'];
			$kode_barang = "BRGMR10".rand(1000,9999);
			
			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['cacheable']	= true; //boolean, the default is true
			$config['cachedir']		= './assets/'; //string, the default is application/cache/
			$config['errorlog']		= './assets/'; //string, the default is application/logs/
			$config['imagedir']		= './assets/gambar_barang/qrcode/'; //direktori penyimpanan qr code
			$config['quality']		= true; //boolean, the default is true
			$config['size']			= '1024'; //interger, the default is 1024
			$config['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config['white']		= array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name = $kode_barang.'.png'; //buat name dari qr code sesuai dengan nim

			$params['data'] = $image_name; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				$data = array(
					'kode_barang' => $kode_barang,
					'nama_barang' => $this->input->post('nama_barang'),
					'spesifikasi' => $this->input->post('spesifikasi_barang'),
					'id_kategori' => $this->input->post('kategori'),
					'id_satuan' => $this->input->post('satuan'),
					'foto_barang' => "gambar",
					'qr_code' => $image_name
				);
	
				$create = $this->m_logistik->createBarang($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Berhasil menambahkan data';
				}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the brand information';			
				}           
			// }
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
	}	

	public function createBarang()
	{
		// if(!in_array('createStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required');
		$this->form_validation->set_rules('spesifikasi_barang', 'Spesifikasi Barang', 'trim|required');
		$this->form_validation->set_rules('kategori', 'kategori', 'trim|required');
		$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {

			if ($this->input->post('kode_barang') == '') {
				$kode_barang = "BRGMR10".rand(1000,9999);
			}else{
				$kode_barang = $this->input->post('kode_barang');
			}

			$upload_image = $this->upload_image();
			
			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['cacheable']	= true; //boolean, the default is true
			$config['cachedir']		= './assets/'; //string, the default is application/cache/
			$config['errorlog']		= './assets/'; //string, the default is application/logs/
			$config['imagedir']		= './assets/gambar_barang/qrcode/'; //direktori penyimpanan qr code
			$config['quality']		= true; //boolean, the default is true
			$config['size']			= '1024'; //interger, the default is 1024
			$config['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config['white']		= array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name = $kode_barang.'.png'; //buat name dari qr code sesuai dengan nim

			$params['data'] = $kode_barang; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

				$data = array(
					'kode_barang' => $kode_barang,
					'nama_barang' => $this->input->post('nama_barang'),
					'spesifikasi' => $this->input->post('spesifikasi_barang'),
					'id_kategori' => $this->input->post('kategori'),
					'id_satuan' => $this->input->post('satuan'),
					'foto_barang' => $upload_image,
					'qr_code' => $image_name
				);
	
				$create = $this->m_logistik->createBarang($data);
				if($create == true) {
					$response['success'] = true;
					$response['messages'] = 'Berhasil menambahkan data';
					$this->session->set_flashdata('success', 'Berhasil menambahkan data');
        			redirect('Logistik/barang', 'refresh');
        		}
				else {
					$response['success'] = false;
					$response['messages'] = 'Error in the database while creating the brand information';
					$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('Logistik/CreateBarang', 'refresh');			
				}           
			// }
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
			$data = array(
				'title' => 'Tambah Barang',
				// 'kendaraan' => $this->m_kendaraan->get_all_data(),
				'kategori' => $this->m_logistik->getActiveKategori(),
				'satuan' => $this->m_logistik->getActiveSatuan(),
				'isi'   => 'logistik/v_add_barang'
			);
			$this->load->view('layout/v_wrapper_backend', $data, FALSE);
        }

        echo json_encode($response);
	}
	
	public function upload_image()
    {
    	// assets/images/product_image
        $config['upload_path'] = './assets/gambar_barang/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|ico';
		$config['max_size']     = '10000';
		$this->upload->initialize($config);

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
        {
            $error = $this->upload->display_errors();
            return $error;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
			$config['image_library'] = 'gd2';
			$config['source_image'] = './assets/gambar/'.$data['upload_data']['file_name'];
			$this->load->library('image_lib', $config);

            return ($data == true) ? $data['upload_data']['file_name'] : false; 

        }
    }

	public function updateBarang($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$data = array(
			'title' => 'Edit Barang',
			// 'kendaraan' => $this->m_kendaraan->get_all_data(),
			'kategori' => $this->m_logistik->getActiveKategori(),
			'satuan' => $this->m_logistik->getActiveSatuan(),
			'data' => $this->m_logistik->getBarangData($id),
			'data_kategori' => $this->m_logistik->getKategoriData($this->m_logistik->getBarangData($id)['id_kategori']),
			'data_satuan' => $this->m_logistik->getSatuanData($this->m_logistik->getBarangData($id)['id_satuan']),
			'isi'   => 'logistik/v_edit_barang'
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);

		$response = array();

		if($id) {

			$this->form_validation->set_rules('edit_nama_barang', 'Nama Barang', 'trim|required');
			$this->form_validation->set_rules('edit_spesifikasi_barang', 'Spesifikasi Barang', 'trim|required');
			$this->form_validation->set_rules('edit_kategori', 'kategori', 'trim|required');
			$this->form_validation->set_rules('edit_min', 'Min Stok', 'trim|required');
			$this->form_validation->set_rules('edit_max', 'Max Stok', 'trim|required');
			// $this->form_validation->set_rules('edit_qty', 'Stok', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'nama_barang' => $this->input->post('edit_nama_barang'),
					'spesifikasi' => $this->input->post('edit_spesifikasi_barang'),
					'id_kategori' => $this->input->post('edit_kategori'),
					'id_satuan' => $this->input->post('edit_satuan'),
					'min_qty' => $this->input->post('edit_min'),
					'max_qty' => $this->input->post('edit_max'),
					// 'qty' => $this->input->post('edit_qty'),
					// 'foto_barang' => "gambar",	
	        	);

	        	$update = $this->m_logistik->updateBarang($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Berhasil memperbarui data';
					$this->session->set_flashdata('success', 'Berhasil update');
        			redirect('Logistik/barang', 'refresh');
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated';
					$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('Logistik/updateBarang/'.$id, 'refresh');				
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';

		}

		// echo json_encode($response);
	}

	public function removeBarang()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->m_logistik->removeBarang($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data berhasil dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}


	// BARANG MASUK
	public function barang_masuk()
    { 
        $data = array(
            'title' => 'Barang Masuk',
			'gudang' => $this->m_logistik->getActiveLokasi(),
            'isi'   => 'logistik/v_barang_masuk'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }

	public function fetchBarangMasukData()
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

		$data = $this->m_logistik->getBarangMasukData();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="detailFunc('.$value['id'].')" data-toggle="modal" data-target="#detailModal" data-placement="top" title="Detail"><i class="bi bi-eye-fill"></i></button>';
				// $buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			$user = $this->m_user->get_user_data($value['user_id']);
			$waktu  = format_hari_tanggal($value['waktu']);
			$qr = '<a href="'.base_url('/assets/gambar_barang/qrcode/qr_barang_masuk/'.$value['qr_barang_masuk']).'" data-toggle="lightbox" data-title="QR Code">
				<img src="'.base_url('/assets/gambar_barang/qrcode/qr_barang_masuk/'.$value['qr_barang_masuk']).'" class="img-size-50" alt="QR Code"/>';
		
			$result['data'][$key] = array(
				$buttons,
				$value['kode_inventaris'],
				$user['first_name'].' '.$user['last_name'],
				$waktu,
				$value['total_barang'],
				$qr
			);
		} // /foreach
		echo json_encode($result);
	}

	public function getBarangMasukGudang()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getDetailBarangMasukGudang();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="detailFunc('.$value['id'].')" data-toggle="modal" data-target="#detailModal"><i class="bi bi-check-circle-fill"></i></button>';
				// $buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
		
			$result['data'][$key] = array(
				$buttons,
				$value['id'],
				$value['id_barang'],
				$value['qty'],
				$value['id_gudang'],
				$value['detail_lokasi'],
				$value['keterangan']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function getBarangMasukGudangID($id)
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getDetailBarangMasukGudang($id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
			if ($value['status'] == 0) {
				$buttons = '<span class="badge bg-secondary">Menunggu</span>';
				$qr = '-';
			}else{
				$buttons = '<span class="badge bg-success">Valid</span>';
				$qr = '<a href="'.base_url('/assets/gambar_barang/qrcode/qr_gudang/'.$value['qr_gudang']).'" data-toggle="lightbox" data-title="QR Code">
				<img src="'.base_url('/assets/gambar_barang/qrcode/qr_gudang/'.$value['qr_gudang']).'" class="img-size-50" alt="QR Code"/>
			</a>';
			}
				// $buttons = '<input c="select_all_item" value="1" type="checkbox">';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			$barang = $this->m_logistik->getBarangData($value['id_barang']);
			$gudang = $this->m_logistik->getGudangData($value['id_gudang']);
			$penyimpanan = $this->m_logistik->getPenyimpanan($value['detail_lokasi']);
			$kategori = $this->m_logistik->getKategoriData($barang['id_kategori']);
			$satuan = $this->m_logistik->getSatuanData($barang['id_satuan']);
			
			$result['data'][$key] = array(
				$value['id'],
				$buttons,
				$qr,
				$barang['kode_barang'],
				$barang['nama_barang'],
				$barang['spesifikasi'],
				$kategori['nama_kategori'],
				$satuan['nama_satuan'],
				$value['qty'],
				$gudang['nama_gudang'],
				$penyimpanan['nama_penyimpanan'],
				$value['keterangan']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function create_barang_masuk()
    { 
        $user = $this->session->userdata('user_id');
		$cek = $this->m_logistik->countTotalCart($user);

		$redirect_page = $this->input->post('redirect_page');
		if($cek < 0) {
			$this->session->set_flashdata('error', 'Data kosong');
            redirect($redirect_page,'refresh');
		}else {
			$this->form_validation->set_rules('kode_inventaris', 'No Inventaris', 'trim|required');
			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');
			if ($this->form_validation->run() == TRUE) {
				$data = array(
					'kode_inventaris' => $this->input->post('kode_inventaris'),
					'user_id' => $user,
					'waktu' => date('Y-m-d H:i:s'),
					'total_barang' => $cek	
				);
				$create = $this->m_logistik->createBarangMasuk($data);
				// if($create != '') {
					$keranjang = $this->m_logistik->getCartDataUser($user);
					foreach ($keranjang as $row) {
						$barang = $this->m_logistik->getBarangDataKode($row['kode_barang']);
						$data = array(
							'id_barang_masuk' => $create,
							'id_barang' => $barang['id'],
							'qty' => $row['qty'],
							'id_gudang' => $row['id_gudang'],	
							'detail_lokasi' => $row['detail_lokasi'],	
							'keterangan' => $row['keterangan']	
						);
						$this->m_logistik->createDetailBarangMasuk($data);
					}
					$delete = $this->m_logistik->clearCart($user);
					$delete = true;
					if($delete == true) {
						$this->session->set_flashdata('success', 'Data berhasil disimpan');
						redirect('Logistik/barang_masuk','refresh');	
					}
					else {
						$this->session->set_flashdata('error', 'Data gagal disimpan');
						redirect($redirect_page,'refresh');			
					}	
				// }
				// else {
				// 	$this->session->set_flashdata('error', 'Data kosong');
            	// 	redirect($redirect_page,'refresh');			
				// }
			}

		}

		$data = array(
            'title' => 'Tambah Barang Masuk',
			'gudang' => $this->m_logistik->getActiveLokasi(),
			'detail_lokasi' => $this->m_logistik->getPenyimpanan(),
            'isi'   => 'logistik/v_add_barang_masuk'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
		
	}

	public function updateBarangMasuk(){
		$id = $this->input->post('string');
		$response = array();
		if($id) {
			// $arr_id = explode('||', $id);
			// $how_many = count($arr_id);

			// for($i = 0; $i < $how_many; $i++){
			// 	$barang_masuk = $this->m_logistik->getDetailBarangMasukData($arr_id[$i]);
			// 	$barang = $this->m_logistik->getBarangData($barang_masuk['id_barang']);
			// 	$qty = $barang['qty'] + $barang_masuk['qty'];
			// 	// $qty = $barang_masuk['qty'];
			// 	$update = $this->m_logistik->updateBarangMasuk($arr_id[$i],  $barang_masuk['id_barang'], $qty);
			// 	print_r($arr_id[$i].','.$barang_masuk['id_barang'].','.$qty.'<br>');
			// }
			// foreach ($arr_id as $key => $value) {
			// 	$barang_masuk = $this->m_logistik->getDetailBarangMasukData($value);
			// 	$barang = $this->m_logistik->getBarangData($barang_masuk['id_barang']);
			// 	$qty = $barang['qty'];
			// 	$data = array(
			// 		'status' => 1	
			// 	);
			// 	$total = $qty + $barang_masuk[qty];
				
			// 	$update = $this->m_logistik->updateBarangMasuk($data, $value,  $barang_masuk['id_barang'], $total);
			// }

			$barang_masuk = $this->m_logistik->getDetailBarangMasukData($id);
			$barang = $this->m_logistik->getBarangData($barang_masuk['id_barang']);
			// $qty = $barang['qty'] + $barang_masuk['qty'];
			// $qty = $barang_masuk['qty'];
			// $update = $this->m_logistik->updateBarangMasuk($id,  $barang_masuk['id_barang'], $qty);

			$this->load->library('ciqrcode'); //pemanggilan library QR CODE
			$config['cacheable']	= true; //boolean, the default is true
			$config['cachedir']		= './assets/'; //string, the default is application/cache/
			$config['errorlog']		= './assets/'; //string, the default is application/logs/
			$config['imagedir']		= './assets/gambar_barang/qrcode/qr_gudang/'; //direktori penyimpanan qr code
			$config['quality']		= true; //boolean, the default is true
			$config['size']			= '1024'; //interger, the default is 1024
			$config['black']		= array(224,255,255); // array, default is array(255,255,255)
			$config['white']		= array(70,130,180); // array, default is array(0,0,0)
			$this->ciqrcode->initialize($config);
			$image_name = 'QR'.$barang['kode_barang'].$barang_masuk['id_gudang'].$barang_masuk['detail_lokasi'].'.png'; //buat name dari qr code sesuai dengan nim

			$params['data'] = $image_name; //data yang akan di jadikan QR CODE
			$params['level'] = 'H'; //H=High
			$params['size'] = 10;
			$params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
			$this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

			$update = $this->m_logistik->updateBarangMasuk($id, $image_name);
			if($update == true) {
				$cek = $this->m_logistik->cekGudangData($barang_masuk['id_barang'], $barang_masuk['id_gudang'], $barang_masuk['detail_lokasi']);
				if($cek > 0) {
					$update = $this->m_logistik->UpdateGudang($barang_masuk['id_barang'], $barang_masuk['id_gudang'], $barang_masuk['detail_lokasi'], $barang_masuk['qty']);
					if($update == true) {
						$response['success'] = true;
						$response['messages'] = "Validasi";
					}else{
						$response['success'] = false;
						$response['messages'] = "Error in the database while removing the brand information";
					}
				}else{
					$data = array(
						'kode_transaksi' => 'I',	
						'id_transaksi' => $id,	
						'id_barang_masuk' => $barang_masuk['id_barang_masuk'],	
						'id_barang_keluar' => 0,	
						'id_barang' => $barang_masuk['id_barang'],	
						'qty' => $barang_masuk['qty'],	
						'id_gudang' => $barang_masuk['id_gudang'],	
						'detail_lokasi' => $barang_masuk['detail_lokasi']	
					);
					$insert = $this->m_logistik->InsertGudang($data);
					if($insert == true) {
						$response['success'] = true;
						$response['messages'] = "Validasi";
					}else{
						$response['success'] = false;
						$response['messages'] = "Error in the database while removing the brand information";
					}
				}
				
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Tidak Ada data yang dipilih";
		}

		echo json_encode($response);
	}

	public function fetchCartData()
	{
		$user = $this->session->userdata('user_id');
		$result = array('data' => array());

		$data = $this->m_logistik->getCartData($user);

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
			// }

			// if(in_array('deleteStore', $this->permission)) {
				$buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';
			$barang = $this->m_logistik->getBarangDataKode($value['kode_barang']);
			$kategori = $this->m_logistik->getKategoriData($barang['id_kategori']);
			$satuan = $this->m_logistik->getSatuanData($barang['id_satuan']);
			$gudang = $this->m_logistik->getLokasiData($value['id_gudang']);

			$result['data'][$key] = array(
				$barang['nama_barang'],
				$value['qtyA'],
				$satuan['nama_satuan'],
				$kategori['nama_kategori'],
				$gudang['nama_gudang'],
				$value['detail_lokasi'],
				$value['keterangan'],
				$buttons
			);
		} // /foreach

		echo json_encode($result);
	}

	public function add_cart_in()
    {
		$user = $this->session->userdata('user_id');
		$response = array();

		$this->form_validation->set_rules('kode_barang', 'Kode', 'trim|required');
		$this->form_validation->set_rules('volume', 'Qty', 'trim|required');
		$this->form_validation->set_rules('gudang', 'Gudang', 'trim|required');

		$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

        if ($this->form_validation->run() == TRUE) {
        	$data = array(
        		'user_id' => $user,
        		'kode_barang' => $this->input->post('kode_barang'),
        		'qty' => $this->input->post('volume'),
        		'id_gudang' => $this->input->post('gudang'),	
        		'detail_lokasi' => $this->input->post('detail_lokasi'),	
        		'keterangan' => $this->input->post('keterangan')	
        	);

        	$create = $this->m_logistik->createCartIn($data);
        	if($create == true) {
        		$response['success'] = true;
        		$response['messages'] = 'Berhasil menambahkan data';
        	}
        	else {
        		$response['success'] = false;
        		$response['messages'] = 'Error in the database while creating the brand information';			
        	}
        }
        else {
        	$response['success'] = false;
        	foreach ($_POST as $key => $value) {
        		$response['messages'][$key] = form_error($key);
        	}
        }

        echo json_encode($response);
    }

	public function fetchCartDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getCartDataBykode($id);
			echo json_encode($data);
		}
	}

	public function updateCartIn($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		$response = array();

		if($id) {
			$this->form_validation->set_rules('edit_volume', 'Qty', 'trim|required');
			$this->form_validation->set_rules('edit_gudang', 'Gudang', 'trim|required');

			$this->form_validation->set_error_delimiters('<p class="text-danger">','</p>');

	        if ($this->form_validation->run() == TRUE) {
	        	$data = array(
	        		'qty' => $this->input->post('edit_volume'),
	        		'id_gudang' => $this->input->post('edit_gudang'),
	        		'detail_lokasi' => $this->input->post('edit_detail_lokasi'),
	        		'keterangan' => $this->input->post('edit_keterangan')
	        	);

	        	$update = $this->m_logistik->updateCart($data, $id);
	        	if($update == true) {
	        		$response['success'] = true;
	        		$response['messages'] = 'Berhasil memperbarui data';
	        	}
	        	else {
	        		$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updated';			
	        	}
	        }
	        else {
	        	$response['success'] = false;
	        	foreach ($_POST as $key => $value) {
	        		$response['messages'][$key] = form_error($key);
	        	}
	        }
		}
		else {
			$response['success'] = false;
    		$response['messages'] = 'Error please refresh the page again!!';
		}

		echo json_encode($response);
	}

	public function removeCart()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$store_id = $this->input->post('store_id');

		$response = array();
		if($store_id) {
			$delete = $this->m_logistik->removeCart($store_id);
			if($delete == true) {
				$response['success'] = true;
				$response['messages'] = "Data berhasil dihapus";	
			}
			else {
				$response['success'] = false;
				$response['messages'] = "Error in the database while removing the brand information";
			}
		}
		else {
			$response['success'] = false;
			$response['messages'] = "Refersh the page again!!";
		}

		echo json_encode($response);
	}

	public function clearCart()
	{
		// if(!in_array('deleteStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
		
		$user = $this->session->userdata('user_id');
		$redirect_page = $this->input->post('redirect_page');

		// $response = array();
		$delete = $this->m_logistik->clearCart($user);
		if($delete == false) {
			// $response['success'] = false;
			// $response['messages'] = "Data sudah kosong";	
			$this->session->set_flashdata('error', 'Data sudah kosong');
            redirect($redirect_page,'refresh');
		}
		else {
			// $response['success'] = true;
			// $response['messages'] = "Data berhasil dikosongkan";
			$this->session->set_flashdata('success', 'Data berhasil dikosongkan');
            redirect($redirect_page,'refresh');
		}

		// echo json_encode($response);
	}
    
    public function fetchBarangDataByKode($id) 
	{
		if($id) {
			$data1 = $this->m_logistik->getBarangDataKode($id);
			$kategori = $this->m_logistik->getKategoriData($data1['id_kategori']);
			$satuan = $this->m_logistik->getSatuanData($data1['id_satuan']);
			$data = array(
				'nama_barang' => $data1['nama_barang'],
				'spesifikasi' => $data1['spesifikasi'],
				'kategori' => $kategori['nama_kategori'],
				'satuan' => $satuan['nama_satuan'],
				'foto_barang'   => $data1['foto_barang']
			);
			echo json_encode($data);
		}
	}

	public function fetchBarangDataByIdDetail($id) 
	{
		if($id) {
			$data1 = $this->m_logistik->getBarangData($id);
			$kategori = $this->m_logistik->getKategoriData($data1['id_kategori']);
			$satuan = $this->m_logistik->getSatuanData($data1['id_satuan']);
			$data = array(
				'nama_barang' => $data1['nama_barang'],
				'spesifikasi' => $data1['spesifikasi'],
				'kategori' => $kategori['nama_kategori'],
				'satuan' => $satuan['nama_satuan'],
				'foto_barang'   => $data1['foto_barang']
			);
			echo json_encode($data);
		}
	}

	// public function fetchBarangData()
	// {
	// 	$result = array('data' => array());

	// 	$data = $this->m_logistik->getBarangData();

	// 	foreach ($data as $key => $value) {

	// 		// button
	// 		$buttons = '';

	// 		// if(in_array('updateStore', $this->permission)) {
	// 			// $buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="editFunc('.$value['id'].')" data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>';
	// 			$buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				
	// 		// }

	// 		// if(in_array('deleteStore', $this->permission)) {
	// 			// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
	// 		// }

	// 		// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

	// 		// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			
	// 		$foto_barang = '<a href="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" data-toggle="lightbox" data-title="Foto Barang">
    //                             <img src="'.base_url('/assets/gambar_barang/'.$value['foto_barang']).'" class="img-size-50" alt="Foto Barang"/>
    //                         </a>';

	// 		$qr_code = '<a href="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" data-toggle="lightbox" data-title="QR Code">
	// 			<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" class="img-size-50" alt="QR Code"/>
	// 		</a>';

	// 		$kategori = $this->m_logistik->getKategoriData($value['id_kategori']);
	// 		$kategori = $kategori['nama_kategori'];

	// 		$satuan = $this->m_logistik->getSatuanData($value['id_satuan']);
	// 		$satuan = $satuan['nama_satuan'];
			

	// 		$result['data'][$key] = array(
	// 			$buttons,
	// 			$value['kode_barang'],
	// 			$qr_code,
	// 			$foto_barang,
	// 			$value['nama_barang'],
	// 			$value['spesifikasi'],
	// 			$kategori,
	// 			$satuan
	// 		);
	// 	} // /foreach

	// 	echo json_encode($result);
	// }

    ////GUDANG
    public function gudang()
    { 
        $data = array(
            'title' => 'Gudang',
            // 'kendaraan' => $this->m_kendaraan->get_all_data(),
            'isi'   => 'logistik/v_gudang'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }
    
    public function fetchGudangDataById($id) 
	{
		if($id) {
			$data = $this->m_logistik->getGudangData($id);
			echo json_encode($data);
		}
	}

    public function fetchGudangData()
	{
		$result = array('data' => array());

		$role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');

		if ($role_id == '7') {
			$data = $this->m_logistik->getGudangDataUser($user_id);
		}else{
			$data = $this->m_logistik->getGudangData();
		}


		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			$buttons = '<a href="'.base_url('logistik/detailStokGudang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';

			$status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

            $datastok = $this->m_logistik->getCountBarangMasukGudang($value['id']);

            $result['data'][$key] = array(
				$buttons,
				$value['nama_gudang'],
				$value['alamat'],
				$datastok
			);
		} // /foreach

		echo json_encode($result);
	}

    public function detailStokGudang($id)
	{
		// if(!in_array('updateStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }
        $gudang = $this->m_logistik->getGudangData($id);
		$data = array(
			'title' => 'Gudang '.$gudang['nama_gudang'],
            'id' => $id,
			'isi'   => 'logistik/v_detail_stok_gudang'
		);
		$this->load->view('layout/v_wrapper_backend', $data, FALSE);
	}

    public function fetchStokBarangData($id)
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getStokBarangGudang($id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			$buttons = '<button type="button" class="btn btn-primary btn-xs" onclick="detailFunc('.$id.','.$value['id_barang'].')" data-toggle="modal" data-target="#detailModal">Rincian <i class="bi bi-check-circle-fill"></i></button>';

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

            // $datastok = $this->m_logistik->getCountBarangMasukGudang($value['id']);
			$barang = $this->m_logistik->getBarangData($value['id_barang']);
			$kategori = $this->m_logistik->getKategoriData($barang['id_kategori']);
			$satuan = $this->m_logistik->getSatuanData($barang['id_satuan']);

			$qty_status = '';
            if($value['stok'] < $barang['min_qty']) {
				$qty_status = '<span class="badge bg-danger">Habis</span>';
            }else if($value['stok'] >= $barang['min_qty'] && $value['qty'] < $barang['max_qty']) {
				$qty_status = '<span class="badge bg-warning">Kurang</span>';
            }else if($value['stok'] >= $barang['max_qty']) {
				$qty_status = '<span class="badge bg-success">Cukup</span>';
            }

            $result['data'][$key] = array(
				$buttons,
				// $value['nama_penyimpanan'],
				$barang['kode_barang'],
				$barang['nama_barang'],
				$barang['spesifikasi'],
				$kategori['nama_kategori'],
				$satuan = $satuan['nama_satuan'],
				$barang['min_qty'],
				$barang['max_qty'],
				$value['stok'] . ' ' . $qty_status,
			);
		} // /foreach

		echo json_encode($result);
	}

	public function getPenyimpananBarangID($id_gudang, $id_barang)
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getPenyimpananBarang($id_gudang, $id_barang);

		foreach ($data as $key => $value) {
            $result['data'][$key] = array(
				$value['nama_penyimpanan'],
				$value['qty_masuk'],
				$value['qty_keluar'],
				$value['stok']
			);
		} // /foreach

		echo json_encode($result);
	}

	//MASUK GUDANG
	public function masuk()
    { 
        $data = array(
            'title' => 'Barang Masuk Gudang',
			'gudang' => $this->m_logistik->getActiveLokasi(),
            'isi'   => 'logistik/v_barang_masuk_gudang'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
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

		$role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');

		if ($role_id == '7') {
			$data = $this->m_logistik->getGudangBarangMasukDataUser($user_id);
		}else{
			$data = $this->m_logistik->getGudangBarangMasukData();
		}

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="detailFunc('.$value['id'].')" data-toggle="modal" data-target="#detailModal" data-placement="top" title="Detail"><i class="bi bi-eye-fill"></i></button>';
				// $buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			$user = $this->m_user->get_user_data($value['user_id']);
			$waktu  = format_hari_tanggal($value['waktu']);
			$qr = '<a href="'.base_url('/assets/gambar_barang/qrcode/qr_barang_masuk/'.$value['qr_barang_masuk']).'" data-toggle="lightbox" data-title="QR Code">
				<img src="'.base_url('/assets/gambar_barang/qrcode/qr_barang_masuk/'.$value['qr_barang_masuk']).'" class="img-size-50" alt="QR Code"/>';
			$total = $value['qty'] * $value['harga'];
			
			if ($role_id == '7') {
				$result['data'][$key] = array(
					// $buttons,
					date_format(date_create($value['waktu']), "Y-m-d"),
					$waktu,
					$value['kode_inventaris'],
					$value['kode_barang'],
					$value['nama_barang'],
					$value['qty'],
					$value['nama_gudang'],
					$value['nama_penyimpanan'],
					$value['keterangan'],
					$user['first_name'].' '.$user['last_name']
				);
			}else{
				$result['data'][$key] = array(
					// $buttons,
					date_format(date_create($value['waktu']), "Y-m-d"),
					$waktu,
					$value['kode_inventaris'],
					$value['kode_barang'],
					$value['nama_barang'],
					$value['qty'],
					number_format($value['harga'],0,".",","),
					number_format($total,0,".",","),
					$value['nama_gudang'],
					$value['nama_penyimpanan'],
					$value['keterangan'],
					$user['first_name'].' '.$user['last_name']
				);
			}
			
		} // /foreach
		echo json_encode($result);
	}

	public function getGudangBarangMasukGudang()
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getDetailBarangMasukGudang();

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="detailFunc('.$value['id'].')" data-toggle="modal" data-target="#detailModal"><i class="bi bi-check-circle-fill"></i></button>';
				// $buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
		
			$result['data'][$key] = array(
				$buttons,
				$value['id'],
				$value['id_barang'],
				$value['qty'],
				$value['id_gudang'],
				$value['detail_lokasi'],
				$value['keterangan']
			);
		} // /foreach

		echo json_encode($result);
	}

	public function getGudangBarangMasukGudangID($id)
	{
		$result = array('data' => array());

		$data = $this->m_logistik->getDetailBarangMasukGudang($id);

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
			if ($value['status'] == 0) {
				$buttons = '<span class="badge bg-secondary">Menunggu</span>';
				$qr = '-';
			}else{
				$buttons = '<span class="badge bg-success">Valid</span>';
				$qr = '<a href="'.base_url('/assets/gambar_barang/qrcode/qr_gudang/'.$value['qr_gudang']).'" data-toggle="lightbox" data-title="QR Code">
				<img src="'.base_url('/assets/gambar_barang/qrcode/qr_gudang/'.$value['qr_gudang']).'" class="img-size-50" alt="QR Code"/>
			</a>';
			}
				// $buttons = '<input c="select_all_item" value="1" type="checkbox">';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			$barang = $this->m_logistik->getBarangData($value['id_barang']);
			$gudang = $this->m_logistik->getGudangData($value['id_gudang']);
			$penyimpanan = $this->m_logistik->getPenyimpanan($value['detail_lokasi']);
			$kategori = $this->m_logistik->getKategoriData($barang['id_kategori']);
			$satuan = $this->m_logistik->getSatuanData($barang['id_satuan']);
			
			$result['data'][$key] = array(
				$value['id'],
				$buttons,
				$qr,
				$barang['kode_barang'],
				$barang['nama_barang'],
				$barang['spesifikasi'],
				$kategori['nama_kategori'],
				$satuan['nama_satuan'],
				$value['qty'],
				$gudang['nama_gudang'],
				$penyimpanan['nama_penyimpanan'],
				$value['keterangan']
			);
		} // /foreach

		echo json_encode($result);
	}


	//KELUAR GUDANG
	public function keluar()
    { 
        $data = array(
            'title' => 'Barang Keluar Gudang',
			'gudang' => $this->m_logistik->getActiveLokasi(),
            'isi'   => 'logistik/v_barang_keluar_gudang'
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);

        // if(!in_array('viewStore', $this->permission)) {
		// 	redirect('dashboard', 'refresh');
		// }

		// $this->render_template('warehouse/index', $this->data);	
    }

	public function fetchGudangBarangKeluarData()
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
		
		$role_id = $this->session->userdata('role_id');
		$user_id = $this->session->userdata('user_id');

		if ($role_id == '7') {
			$data = $this->m_logistik->getGudangBarangKeluarDataUser($user_id);
		}else{
			$data = $this->m_logistik->getGudangBarangKeluarData();
		}

		foreach ($data as $key => $value) {

			// button
			$buttons = '';

			// if(in_array('updateStore', $this->permission)) {
				$buttons = '<button type="button" class="btn btn-warning btn-xs" onclick="detailFunc('.$value['id'].')" data-toggle="modal" data-target="#detailModal" data-placement="top" title="Detail"><i class="bi bi-eye-fill"></i></button>';
				// $buttons = '<a href="'.base_url('Logistik/updateBarang/'.$value['id']).'" class="btn btn-warning btn-xs" data-placement="top" title="Edit Data"><i class="fa fa-edit"></i></a>';
				
			// }

			// if(in_array('deleteStore', $this->permission)) {
				// $buttons .= ' <button type="button" class="btn btn-danger btn-xs" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
			// }

			// $status = ($value['active'] == 1) ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-warning">Inactive</span>';

			// $qr_code = '<img src="'.base_url('/assets/gambar_barang/qrcode/'.$value['qr_code']).'" alt="'.$value['qr_code'].'" class="img-circle" width="50" height="50" />';
			$user = $this->m_user->get_user_data($value['user_id']);
			$waktu  = format_hari_tanggal($value['waktu']);

			if ($value['job_site'] == 1) {
				$jobsite = $this->m_logistik->getJobSite($value['job_site']);
				$keperluan = $jobsite['nama_site'];
				$object = '-';
			}else if ($value['job_site'] == 2) {
				$jobsite = $this->m_logistik->getJobSite($value['job_site']);
				$keperluan = $jobsite['nama_site'];
				$tower = $this->m_logistik->getTower($value['site_id']);
				$object = $tower['nama_tower'];
			}else if ($value['job_site'] == 3) {
				$jobsite = $this->m_logistik->getJobSite($value['job_site']);
				$keperluan = $jobsite['nama_site'];
				$tower = $this->m_logistik->getGenset($value['id_genset']);
				$object = $tower['nama_genset'];
			}else if ($value['job_site'] == 4) {
				$jobsite = $this->m_logistik->getJobSite($value['job_site']);
				$keperluan = $jobsite['nama_site'];
				$tower = $this->m_logistik->getExca($value['id_exca']);
				$object = $tower['nama_unit'];
			}else if ($value['job_site'] == 5) {
				$jobsite = $this->m_logistik->getJobSite($value['job_site']);
				$keperluan = $jobsite['nama_site'];
				$tower = $this->m_logistik->getHauler($value['id_hauler']);
				$object = $tower['nama_unit'];
			}else if ($value['job_site'] == 6) {
				$jobsite = $this->m_logistik->getJobSite($value['job_site']);
				$keperluan = $jobsite['nama_site'];
				$tower = $this->m_logistik->getKendaraanAir($value['id_kendaraan_air']);
				$object = $tower['nama_unit'];
			}else{
				$keperluan = '-';
				$object = '-';
			} 

			$harga = $this->m_logistik->getHargaBarang($value['id_transaksi']);
			$total = $value['qty'] * $harga['harga'];
			if ($role_id == '7') {
				$result['data'][$key] = array(
					// $buttons,
					date_format(date_create($value['waktu']), "Y-m-d"),
					$waktu,
					$value['kode_barang'],
					$value['nama_barang'],
					$value['qty'],
					$value['nama_gudang'],
					$value['nama_penyimpanan'],
					$keperluan,
					$object,
					// $value['job_site'],
					// $value['site_id'],
					// $value['id_genset'],
					// $value['id_exca'],
					// $value['id_hauler'],
					// $value['id_kendaraan_air'],
					$value['keterangan'],
					$user['first_name'].' '.$user['last_name']
				);
			}else{
				$result['data'][$key] = array(
					// $buttons,
					date_format(date_create($value['waktu']), "Y-m-d"),
					$waktu,
					$value['kode_barang'],
					$value['nama_barang'],
					$value['qty'],
					number_format($harga['harga'],0,".",","),
					number_format($total,0,".",","),
					$value['nama_gudang'],
					$value['nama_penyimpanan'],
					$keperluan,
					$object,
					// $value['job_site'],
					// $value['site_id'],
					// $value['id_genset'],
					// $value['id_exca'],
					// $value['id_hauler'],
					// $value['id_kendaraan_air'],
					$value['keterangan'],
					$user['first_name'].' '.$user['last_name']
				);
			}
		} // /foreach
		echo json_encode($result);
	}
}

/* End of file Dashboard.php */
