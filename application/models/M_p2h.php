<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_p2h extends CI_Model {

    public function get_all_data()
    {
        // $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi');
        // $this->db->from('tbl_kendaraan');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->join('tbl_transaksi', 'tbl_transaksi.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // // $this->db->where('tbl_transaksi.jenis_perawatan', 1);
        // $this->db->group_by('tbl_transaksi.id_kendaraan');
        // return $this->db->get()->result();

        $this->db->select('xin_p2h_kendaraan.id_kendaraan AS id, xin_p2h_kendaraan.tanggal AS tanggal_p2h, xin_p2h_kendaraan.*, tbl_kendaraan.*, tbl_operator.*');
        $this->db->from('xin_p2h_kendaraan');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = xin_p2h_kendaraan.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = xin_p2h_kendaraan.id_kendaraan', 'left');
        return $this->db->get()->result();

        // $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1") AS tanggal_transaksi
        //                     from tbl_kendaraan
        //                     join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
        //                     join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_kendaraan.id_kendaraan
        //                     GROUP BY tbl_kendaraan.id_kendaraan'); 
        // // $this->db->group_by('tbl_transaksi.id_kendaraan');
        // return $this->db->get()->result();
    }

    public function get_all_data_alarm1()
    {
        // $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi');
        // $this->db->from('tbl_kendaraan');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->join('tbl_transaksi', 'tbl_transaksi.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->where('DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) <= 30');
        // $this->db->group_by('tbl_transaksi.id_kendaraan');
        // return $this->db->get()->result();

        $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental
        from tbl_kendaraan
        join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
        WHERE DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) <= 30 AND tbl_operator.status = 1'); 
        return $this->db->get()->result();
    }

    public function get_all_data_alarm2()
    {
        // $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi');
        // $this->db->from('tbl_kendaraan');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->join('tbl_transaksi', 'tbl_transaksi.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->where('DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) <= 30');
        // return $this->db->get()->result();

        $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental
        from tbl_kendaraan
        join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
        WHERE DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) <= 30 AND tbl_operator.status = 1');
        return $this->db->get()->result();
    }

    public function get_all_data_alarm3()
    {
        $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi
        from tbl_kendaraan
        join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
        join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_kendaraan.id_kendaraan
        WHERE tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1" GROUP BY tbl_transaksi.id_kendaraan) AND
        DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) <= 5 AND tbl_operator.status = 1');   
        $this->db->group_by('tbl_transaksi.id_kendaraan');     
        return $this->db->get()->result();
    }

    public function get_all_data_alarm4()
    {
        $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, DATEDIFF(tbl_kendaraan.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_kendaraan.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) AS masa_rental');
        $this->db->from('tbl_kendaraan');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('DATEDIFF(tbl_kendaraan.tanggal_rental, NOW()) <= 5');
        return $this->db->get()->result();
    }

    public function get_all_data_service()
    {
        $this->db->select('tbl_kendaraan.id_kendaraan AS id, tbl_kendaraan.*, tbl_operator.*, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi
        from tbl_kendaraan
        left join tbl_operator ON tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan
        left join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_kendaraan.id_kendaraan
        WHERE tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1" GROUP BY tbl_transaksi.id_kendaraan) AND tbl_operator.status = 1 GROUP BY tbl_transaksi.id_kendaraan');        
        return $this->db->get()->result();
    }

    public function get_data($p2h_id)
    {
        $this->db->select('xin_p2h_kendaraan.id_kendaraan AS id, xin_p2h_kendaraan.tanggal AS tanggal_p2h, xin_p2h_kendaraan.*, tbl_kendaraan.*, tbl_operator.*');
        $this->db->from('xin_p2h_kendaraan');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = xin_p2h_kendaraan.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = xin_p2h_kendaraan.id_kendaraan', 'left');
        $this->db->where('xin_p2h_kendaraan.p2h_id', $p2h_id);
        return $this->db->get()->row();
    }

    public function add($data)
    {
        $this->db->insert('tbl_kendaraan', $data);  
    }

    public function edit($data)
    {
        $this->db->where('id_kendaraan', $data['id_kendaraan']);
        $this->db->update('tbl_kendaraan', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_kendaraan', $data['id_kendaraan']);
        $this->db->delete('tbl_kendaraan', $data);
    }

    public function add_operator($data)
    {
        $this->db->insert('tbl_operator', $data);  
    }

    public function edit_operator($data)
    {
        $this->db->where('id_histori', $data['id_histori']);
        $this->db->update('tbl_operator', $data);
    }

}

/* End of file M_user.php */
