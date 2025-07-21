<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    public function total_kendaraan($user)
    {
        if ($user == '1234567089') {
            return $this->db->get('tbl_kendaraan')->num_rows();
        }elseif ($user == '1234567517') {
            return $this->db->get('tbl_truck')->num_rows();
        }
    }

    public function total_asset($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            $this->db->select('*');
            $this->db->from('tbl_kendaraan');
            $this->db->where('status_kepemilikan = 1');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('*');
            $this->db->from('tbl_truck');
            $this->db->where('status_kepemilikan = 1');
            return $this->db->get()->num_rows();
        }
    }

    public function total_rental($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            $this->db->select('*');
            $this->db->from('tbl_kendaraan');
            $this->db->where('status_kepemilikan = 2');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('*');
            $this->db->from('tbl_truck');
            $this->db->where('status_kepemilikan = 2');
            return $this->db->get()->num_rows();
        }
    }

    public function total_nonasset($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            $this->db->select('*');
            $this->db->from('tbl_kendaraan');
            $this->db->where('status_kepemilikan = 3');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('*');
            $this->db->from('tbl_truck');
            $this->db->where('status_kepemilikan = 3');
            return $this->db->get()->num_rows();
        }
    }

    public function total_kategori($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            $this->db->select('*');
            $this->db->from('tbl_kendaraan');
            $this->db->where('status_kepemilikan > 3');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('*');
            $this->db->from('tbl_truck');
            $this->db->where('status_kepemilikan > 3');
            return $this->db->get()->num_rows();
        }
    }

    public function get_alarm_surat($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            $this->db->select('*');
            $this->db->from('tbl_kendaraan');
            return $this->db->get()->result();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('*');
            $this->db->from('tbl_truck');
            return $this->db->get()->result();
        }
        
    }

    public function get_alarm_stnk($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            // $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental
            // from tbl_kendaraan
            // join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
            // WHERE DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) <= 30 AND tbl_operator.status = 1'); 

            $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, 
            DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental 
            FROM tbl_kendaraan 
            LEFT JOIN tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan 
            WHERE DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) <= 30 AND (tbl_operator.status = 1 OR tbl_operator.status IS NULL) AND status_kepemilikan <3 ');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental
            from tbl_truck
            join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
            WHERE DATEDIFF(tbl_truck.stnk_waktu, NOW()) <= 30 AND tbl_operator.status = 1'); 
            return $this->db->get()->num_rows();
        }
    }

    public function get_alarm_kir($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental
            from tbl_kendaraan
            join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
            WHERE DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) <= 30 AND tbl_operator.status = 1');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental
            from tbl_truck
            join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
            WHERE DATEDIFF(tbl_truck.kir_waktu, NOW()) <= 30 AND tbl_operator.status = 1');
            return $this->db->get()->num_rows();
        }
    }

    

    public function get_alarm_service($user)
    {
        if ($user == '1234567000' || $user == '1234567089') {
            $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi
            from tbl_kendaraan
            join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
            join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_kendaraan.id_kendaraan
            WHERE tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1" GROUP BY tbl_transaksi.id_kendaraan) AND
            DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) <= 5 AND tbl_operator.status = 1');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi
            from tbl_truck
            join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
            join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_truck.id_kendaraan
            WHERE tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1" GROUP BY tbl_transaksi.id_kendaraan) AND
            DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) <= 5 AND tbl_operator.status = 1');
            return $this->db->get()->num_rows();
        }
        
    }

    public function get_alarm_rental($user)
    {
        if ($user == '1234567000' || $user == '1234567004' || $user == '1234567005' || $user == '1234567089') {
            $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*
            from tbl_kendaraan
            join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
            WHERE DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) < 1 ');
            return $this->db->get()->num_rows();
        }elseif ($user == '1234567000' || $user == '1234567517') {
            $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*
            from tbl_truck
            join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
            WHERE DATEDIFF(tbl_truck.tanggal_rental, NOW()) < 1 ');
            return $this->db->get()->num_rows();
        }
        
    }

    public function data_setting()
    {
        $this->db->select('*');
        $this->db->from('tbl_setting');
        $this->db->where('id', 1);
        return $this->db->get()->row();
    }

    public function edit($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_setting', $data);
    }
}

/* End of file M_user.php */
