<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_logistik extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}

	// BARANG MASUK

	public function getBarangMasukData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_barang_masuk where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_barang_masuk";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getDetailBarangMasukData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_detail_barang_masuk where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_barang_masuk";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createBarangMasuk($data)
	{
		if($data) {
			$this->db->insert('tbl_barang_masuk', $data);
			// return ($insert == true) ? true : false;
			$insert_id = $this->db->insert_id();
   			return  $insert_id;
		}
	}

	public function createDetailBarangMasuk($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_detail_barang_masuk', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateBarangMasuk($id, $qr_gudang)
	{
			// $this->db->where(array('id' => $id));
			// $update = $this->db->update('tbl_detail_barang_masuk', $data);
			$sql1 = "UPDATE tbl_detail_barang_masuk set status = '1', qr_gudang = '".$qr_gudang."' where id = '".$id."'";
			$update = $this->db->query($sql1);
			return ($update == true) ? true : false;

			// if ($update == true) {
			// 	$sql = "UPDATE tbl_barang set qty = '".$qty."' where id = ?";
			// 	$query = $this->db->query($sql, $id_barang);
			// 	return ($query == true) ? true : false;
			// } else{
			// 	return false;
			// }
	}

	public function getTotalBarangMasuk()
	{
		$sql = "SELECT SUM(total_barang) AS qty_masuk
				FROM tbl_barang_masuk";
        $query = $this->db->query($sql);
        return $query->row_array();	
	}

	public function getTotalBarangMasukUser($user_id)
	{
		$sql = "SELECT SUM(total_barang) AS qty_masuk
				FROM tbl_barang_masuk WHERE user_id = '".$user_id."'";
        $query = $this->db->query($sql);
        return $query->row_array();	
	}

	// BARANG KELUAR
	public function getTotalBarangKeluar()
	{
		$sql = "SELECT SUM(total_barang) AS qty_keluar
				FROM tbl_barang_keluar";
        $query = $this->db->query($sql);
        return $query->row_array();	
	}

	public function getTotalBarangKeluarUser($user_id)
	{
		$sql = "SELECT SUM(total_barang) AS qty_keluar
				FROM tbl_barang_keluar WHERE user_id = '".$user_id."'";
        $query = $this->db->query($sql);
        return $query->row_array();	
	}

	// CART
	public function createCartIn($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_keranjang_masuk_gudang', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function getCartData($user_id = null)
	{
		if($user_id) {
			$sql = "SELECT *, SUM(qty) AS qtyA  FROM tbl_keranjang_masuk_gudang where user_id = ? GROUP BY kode_barang, id_gudang ORDER BY kode_barang ASC";
			$query = $this->db->query($sql, array($user_id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM tbl_keranjang_masuk_gudang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getCartDataUser($user_id = null)
	{
		$sql = "SELECT *, SUM(qty) AS qtyA  FROM tbl_keranjang_masuk_gudang where user_id = ? GROUP BY kode_barang, id_gudang ORDER BY kode_barang ASC";
		$query = $this->db->query($sql, array($user_id));
		return $query->result_array();
	}

	/* get the brand data */
	public function getCartDataBykode($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_keranjang_masuk_gudang where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_keranjang_masuk_gudang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function updateCart($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_keranjang_masuk_gudang', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeCart($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tbl_keranjang_masuk_gudang');
			return ($delete == true) ? true : false;
		}
	}

	public function clearCart($user_id)
	{
		$sql = "SELECT * FROM tbl_keranjang_masuk_gudang WHERE user_id = ?";
		$query = $this->db->query($sql, array($user_id));
		if ($query->num_rows() < 0) {
			return false;
		}else {
			$this->db->where('user_id', $user_id);
			$this->db->delete('tbl_keranjang_masuk_gudang');
			return true;
		}
	}

	public function countTotalCart($user_id)
	{
		$sql = "SELECT * FROM tbl_keranjang_masuk_gudang WHERE user_id = ?";
		$query = $this->db->query($sql, array($user_id));
		return $query->num_rows();
	}
	


	// LOKASI GUDANG
	/* get the active store data */
	public function getActiveLokasi()
	{
		$sql = "SELECT * FROM tbl_lokasi_gudang WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getLokasiData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_lokasi_gudang where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_lokasi_gudang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createLokasi($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_lokasi_gudang', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateLokasi($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_lokasi_gudang', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeLokasi($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tbl_lokasi_gudang');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalLokasi()
	{
		$sql = "SELECT * FROM tbl_lokasi_gudang WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}



	//PENYIMPANAN
	/* get the active store data */
	public function getActivePenyimpanan()
	{
		$sql = "SELECT * FROM tbl_penyimpanan_barang WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	public function getPenyimpanan($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_penyimpanan_barang WHERE id = ?";
			$query = $this->db->query($sql, array(1));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_penyimpanan_barang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	/* get the brand data */
	public function getPenyimpananData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_penyimpanan_barang where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_penyimpanan_barang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createPenyimpanan($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_penyimpanan_barang', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updatePenyimpanan($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_penyimpanan_barang', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removePenyimpanan($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tbl_penyimpanan_barang');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalPenyimpanan()
	{
		$sql = "SELECT * FROM tbl_penyimpanan_barang WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}


	// KATEGORI
	/* get the active store data */
	public function getActiveKategori()
	{
		$sql = "SELECT * FROM tbl_kategori WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getKategoriData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_kategori where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_kategori";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createKategori($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_kategori', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateKategori($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_kategori', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeKategori($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tbl_kategori');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalKategori()
	{
		$sql = "SELECT * FROM tbl_kategori WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}


	// JENIS
	/* get the active store data */
	public function getActiveJenis()
	{
		$sql = "SELECT * FROM tbl_jenis WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getJenisData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_jenis where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_jenis";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createJenis($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_jenis', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateJenis($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_jenis', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeJenis($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tbl_jenis');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalJenis()
	{
		$sql = "SELECT * FROM tbl_jenis WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}

	// SATUAN
	/* get the active store data */
	public function getActiveSatuan()
	{
		$sql = "SELECT * FROM tbl_satuan WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getSatuanData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_satuan where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_satuan";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function createSatuan($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_satuan', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateSatuan($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_satuan', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeSatuan($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tbl_satuan');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalSatuan()
	{
		$sql = "SELECT * FROM tbl_satuan WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->num_rows();
	}


	// BARANG
	/* get the active Barang data */
	public function getActiveBarang()
	{
		$sql = "SELECT * FROM tbl_barang WHERE active = ?";
		$query = $this->db->query($sql, array(1));
		return $query->result_array();
	}

	/* get the brand data */
	public function getBarangDataKode($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_barang where kode_barang = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_barang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBarangData($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_barang where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_barang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getBarangDataCetak($id = null)
	{
		$sql = "SELECT * FROM tbl_barang where id = ?";
		$query = $this->db->query($sql, array($id));
		return $query->result();
	}

	public function getGudangDataCetak($id = null)
	{
		// $sql = "SELECT * FROM tbl_detail_barang_masuk where id_barang_masuk = ?";
		// $query = $this->db->query($sql, array($id));

		$sql = "SELECT a.qr_gudang, b.kode_barang, b.nama_barang, b.spesifikasi, c.nama_kategori, d.nama_satuan, a.qty, e.nama_gudang, f.nama_penyimpanan 
				FROM tbl_detail_barang_masuk a
				JOIN tbl_barang b ON a.id_barang=b.id 
				JOIN tbl_kategori c ON b.id_kategori=c.id 
				JOIN tbl_satuan d ON b.id_satuan=d.id 
				JOIN tbl_lokasi_gudang e ON a.id_gudang=e.id 
				JOIN tbl_penyimpanan_barang f ON a.detail_lokasi=f.id 
				where id_barang_masuk = $id";
				// where a.id_gudang = $id_gudang AND id_barang = $id_barang GROUP BY a.id_barang, a.id_gudang, a.detail_lokasi ORDER BY a.detail_lokasi ASC";
        $query = $this->db->query($sql);
		return $query->result();
	}

	public function createBarang($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_barang', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function updateBarang($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tbl_barang', $data);
			return ($update == true) ? true : false;
		}
	}

	public function removeBarang($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tbl_barang');
			return ($delete == true) ? true : false;
		}
	}

	public function countTotalBarang()
	{
		$sql = "SELECT * FROM tbl_barang";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}


    //GUDANG 
    public function getGudangData($id = null, $user_id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_lokasi_gudang where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		if($user_id) {
			$sql = "SELECT * FROM tbl_lokasi_gudang where responsible = '1234567090'";
			$query = $this->db->query($sql, array($user_id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM tbl_lokasi_gudang";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getGudangDataUser($user_id)
	{

		$sql = "SELECT * FROM tbl_lokasi_gudang where responsible = '".$user_id."'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

    public function getCountBarangMasukGudang($id = null)
	{
		
        $sql = "SELECT * FROM tbl_gudang where id_gudang = ? GROUP BY id_barang";
        $query = $this->db->query($sql, array($id));
        return $query->num_rows();
		
	}

	public function getBarangMasukGudang($id = null)
	{
		
        $sql = "SELECT * FROM tbl_detail_barang_masuk where id_gudang = ? GROUP BY id_barang";
        $query = $this->db->query($sql, array($id));
        return $query->num_rows();
		
	}

    public function getPenyimpananBarang($id_gudang, $id_barang)
	{
        // $sql = "SELECT a.*, SUM(a.qty) AS qtyA, b.nama_penyimpanan  
		// 		FROM tbl_gudang a
		// 		JOIN tbl_penyimpanan_barang b ON a.detail_lokasi=b.id 
		// 		where a.id_gudang = $id_gudang AND id_barang = $id_barang GROUP BY a.id_barang, a.id_gudang, a.detail_lokasi ORDER BY a.detail_lokasi ASC";

		$sql = "SELECT a.*, b.nama_penyimpanan,    				
				SUM(IF( a.kode_transaksi = 'i', a.qty, 0)) AS qty_masuk, 
				SUM(IF( a.kode_transaksi = 'o', a.qty, 0)) AS qty_keluar, 
				(SUM(IF( a.kode_transaksi = 'i', a.qty, 0)) - SUM(IF( a.kode_transaksi = 'o', a.qty, 0))) AS stok 
				FROM tbl_gudang a 				
				JOIN tbl_penyimpanan_barang b ON a.detail_lokasi=b.id  				
				where a.id_gudang = $id_gudang AND id_barang = $id_barang 
				GROUP BY a.id_barang, a.id_gudang, a.detail_lokasi ORDER BY a.detail_lokasi ASC";
        $query = $this->db->query($sql);
        return $query->result_array();	
	}

	public function getStokBarangGudang($id = null)
	{
        // $sql = "SELECT *, SUM(qty) AS qtyA  
		// 		FROM tbl_gudang
		// 		where id_gudang = ? GROUP BY id_barang, id_gudang ORDER BY id_barang ASC";

		$sql = "SELECT a.*, b.kode_barang, b.nama_barang, b.spesifikasi, b.id_kategori, c.nama_kategori, b.id_satuan, d.nama_satuan, b.min_qty, b.max_qty, b.foto_barang, e.nama_gudang, f.nama_penyimpanan, 
				SUM(IF( a.kode_transaksi = 'i', a.qty, 0)) AS qty_masuk, 
				SUM(IF( a.kode_transaksi = 'o', a.qty, 0)) AS qty_keluar, 
				(SUM(IF( a.kode_transaksi = 'i', a.qty, 0)) - SUM(IF( a.kode_transaksi = 'o', a.qty, 0))) AS stok 
				FROM tbl_gudang a 
				JOIN tbl_barang b ON a.id_barang = b.id 
				JOIN tbl_kategori c ON b.id_kategori = c.id 
				JOIN tbl_satuan d ON b.id_satuan = d.id 
				JOIN tbl_lokasi_gudang e ON a.id_gudang = e.id 
				JOIN tbl_penyimpanan_barang f ON a.detail_lokasi = f.id 
				where a.id_gudang = ?
				GROUP BY a.id_barang, a.id_gudang, a.detail_lokasi";
        $query = $this->db->query($sql, array($id));
        return $query->result_array();	
	}

	public function getDetailBarangMasukGudang($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_detail_barang_masuk where id_barang_masuk = ?";
			$query = $this->db->query($sql, array($id));
			return $query->result_array();
		}

		$sql = "SELECT * FROM tbl_detail_barang_masuk";
		$query = $this->db->query($sql);
		return $query->result_array();
	}


	public function cekGudangData($id_barang, $id_gudang, $detail_lokasi)
	{
        $sql = "SELECT *FROM tbl_gudang where id_barang = $id_barang AND id_gudang = $id_gudang AND detail_lokasi = $detail_lokasi";
        $query = $this->db->query($sql);
        return $query->num_rows();	
	}

	public function InsertGudang($data)
	{
		if($data) {
			$insert = $this->db->insert('tbl_gudang', $data);
			return ($insert == true) ? true : false;
		}
	}

	public function UpdateGudang($id_barang, $id_gudang, $detail_lokasi, $qty)
	{
        $sql = "UPDATE tbl_gudang set qty = qty + $qty where id_barang = $id_barang AND id_gudang = $id_gudang AND detail_lokasi = $detail_lokasi";
        $query = $this->db->query($sql);
        return ($query == true) ? true : false;
	}


	//GUDANG MASUK
	public function getGudangBarangMasukData($user_id = null)
	{
		if($user_id) {
			$sql = "SELECT * 
					FROM tbl_detail_barang_masuk a
					JOIN tbl_barang_masuk b ON b.id=a.id_barang_masuk
					JOIN tbl_barang c ON c.id=a.id_barang
					JOIN tbl_lokasi_gudang d ON d.id=a.id_gudang
					JOIN tbl_penyimpanan_barang e ON e.id=a.detail_lokasi
					WHERE b.user_id = ? AND a.status = '1'";
			$query = $this->db->query($sql, array($user_id));
			return $query->row_array();
		}

		$sql = "SELECT * 
				FROM tbl_detail_barang_masuk a
				JOIN tbl_barang_masuk b ON b.id=a.id_barang_masuk
				JOIN tbl_barang c ON c.id=a.id_barang
				JOIN tbl_lokasi_gudang d ON d.id=a.id_gudang
				JOIN tbl_penyimpanan_barang e ON e.id=a.detail_lokasi
				AND a.status = '1'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getGudangBarangMasukDataUser($user_id)
	{

		$sql = "SELECT * 
					FROM tbl_detail_barang_masuk a
					JOIN tbl_barang_masuk b ON b.id=a.id_barang_masuk
					JOIN tbl_barang c ON c.id=a.id_barang
					JOIN tbl_lokasi_gudang d ON d.id=a.id_gudang
					JOIN tbl_penyimpanan_barang e ON e.id=a.detail_lokasi
					WHERE b.user_id = '".$user_id."' AND a.status = '1'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	//GUDANG KELUAR
	public function getGudangBarangKeluarData($user_id = null)
	{
		if($user_id) {
			$sql = "SELECT * 
					FROM tbl_detail_barang_keluar a 
					JOIN tbl_barang_keluar b ON b.id=a.id_barang_keluar 
					JOIN tbl_barang c ON c.id=a.id_barang 
					JOIN tbl_lokasi_gudang d ON d.id=a.id_gudang 
					JOIN tbl_penyimpanan_barang e ON e.id=a.detail_lokasi
					WHERE b.user_id = ? AND a.status = '1' AND a.kode_transaksi = 'o'";
			$query = $this->db->query($sql, array($user_id));
			return $query->row_array();
		}

		$sql = "SELECT * 
				FROM tbl_detail_barang_keluar a 
				JOIN tbl_barang_keluar b ON b.id=a.id_barang_keluar 
				JOIN tbl_barang c ON c.id=a.id_barang 
				JOIN tbl_lokasi_gudang d ON d.id=a.id_gudang 
				JOIN tbl_penyimpanan_barang e ON e.id=a.detail_lokasi
				WHERE a.status = '1' AND a.kode_transaksi = 'o'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getGudangBarangKeluarDataUser($user_id)
	{
		$sql = "SELECT * 
				FROM tbl_detail_barang_keluar a 
				JOIN tbl_barang_keluar b ON b.id=a.id_barang_keluar 
				JOIN tbl_barang c ON c.id=a.id_barang 
				JOIN tbl_lokasi_gudang d ON d.id=a.id_gudang 
				JOIN tbl_penyimpanan_barang e ON e.id=a.detail_lokasi
				WHERE b.user_id = '".$user_id."' AND a.status = '1' AND a.kode_transaksi = 'o'";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getJobSite($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_job_site where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_job_site";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getTower($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_tower where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_tower";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getGenset($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM tbl_genset where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM tbl_genset";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getExca($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM xin_unit_alatberat where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM xin_unit_alatberat";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getHauler($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM xin_unit_truck where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM xin_unit_truck";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getKendaraanAir($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM xin_unit_tugboat where id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM xin_unit_tugboat";
		$query = $this->db->query($sql);
		return $query->row_array();
	}

	public function getGraph($user_id = null)
	{
		if($user_id) {
			$sql = "SELECT b.waktu, c.first_name, c.last_name, SUM(a.harga*a.qty) AS total
					FROM tbl_detail_barang_masuk a 
					JOIN tbl_barang_masuk b ON a.id_barang_masuk = b.id
					JOIN xin_employees c ON b.user_id = c.user_id
					WHERE b.user_id = ? AND a.id_gudang = '1'
					GROUP BY b.user_id";
			$query = $this->db->query($sql, array($user_id));
			return $query->result_array();
		}

		$sql = "SELECT b.waktu, c.first_name, c.last_name, SUM(a.harga*a.qty) AS total 
					FROM tbl_detail_barang_masuk a 
					JOIN tbl_barang_masuk b ON a.id_barang_masuk = b.id
					JOIN xin_employees c ON b.user_id = c.user_id
					WHERE a.id_gudang = '1'
					GROUP BY b.user_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getGraph1($user_id = null)
	{
		if($user_id) {
			$sql = "SELECT b.waktu, e.first_name, e.last_name, SUM(c.harga*a.qty) AS total 
					FROM tbl_detail_barang_keluar a 
					JOIN tbl_barang_keluar b ON a.id_barang_keluar = b.id
					JOIN tbl_detail_barang_masuk c ON a.id_transaksi = c.id_barang_masuk
					JOIN tbl_barang_masuk d ON c.id_barang_masuk = d.id
					JOIN xin_employees e ON b.user_id = e.user_id
					WHERE b.user_id = ? AND a.status = '1' AND a.kode_transaksi = 'o'
					GROUP BY b.user_id";
			$query = $this->db->query($sql, array($user_id));
			return $query->result_array();
		}

		$sql = "SELECT b.waktu, e.first_name, e.last_name, SUM(c.harga*a.qty) AS total  
					FROM tbl_detail_barang_keluar a 
					JOIN tbl_barang_keluar b ON a.id_barang_keluar = b.id
					JOIN tbl_detail_barang_masuk c ON a.id_transaksi = c.id
					JOIN tbl_barang_masuk d ON c.id_barang_masuk = d.id
					JOIN xin_employees e ON b.user_id = e.user_id
					WHERE a.status = '1' AND a.kode_transaksi = 'o'
					GROUP BY b.user_id";
		$query = $this->db->query($sql);
		return $query->result_array();
	}

	public function getHargaBarang($id_transaksi = null)
	{
		if($id_transaksi) {
			$sql = "SELECT a.*, b.harga 
					FROM tbl_detail_barang_keluar a 
					JOIN tbl_detail_barang_masuk b ON b.id = a.id_transaksi
					WHERE b.id = ?";
			$query = $this->db->query($sql, array($id_transaksi));
			return $query->row_array();
		}

		$sql = "SELECT a.*, b.harga
					FROM tbl_detail_barang_keluar a 
					JOIN tbl_detail_barang_masuk b ON b.id = a.id_transaksi";
		$query = $this->db->query($sql);
		return $query->row_array();
	}
}
