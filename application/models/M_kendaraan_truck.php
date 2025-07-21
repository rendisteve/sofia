<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_kendaraan_truck extends CI_Model {

    public function get_all_data()
    {
        // $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi');
        // $this->db->from('tbl_truck');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        // $this->db->join('tbl_transaksi', 'tbl_transaksi.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        // // $this->db->where('tbl_transaksi.jenis_perawatan', 1);
        // $this->db->group_by('tbl_transaksi.id_kendaraan');
        // return $this->db->get()->result();

        $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental');
        $this->db->from('tbl_truck');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        return $this->db->get()->result();

        // $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1") AS tanggal_transaksi
        //                     from tbl_truck
        //                     join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
        //                     join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_truck.id_kendaraan
        //                     GROUP BY tbl_truck.id_kendaraan'); 
        // // $this->db->group_by('tbl_transaksi.id_kendaraan');
        // return $this->db->get()->result();
    }

    public function get_all_data_alarm1()
    {
        // $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi');
        // $this->db->from('tbl_truck');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        // $this->db->join('tbl_transaksi', 'tbl_transaksi.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        // $this->db->where('DATEDIFF(tbl_truck.stnk_waktu, NOW()) <= 30');
        // $this->db->group_by('tbl_transaksi.id_kendaraan');
        // return $this->db->get()->result();

        $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental
        from tbl_truck
        join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
        WHERE DATEDIFF(tbl_truck.stnk_waktu, NOW()) <= 30 AND tbl_operator.status = 1'); 
        return $this->db->get()->result();
    }

    public function get_all_data_alarm2()
    {
        // $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi');
        // $this->db->from('tbl_truck');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        // $this->db->join('tbl_transaksi', 'tbl_transaksi.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        // $this->db->where('DATEDIFF(tbl_truck.kir_waktu, NOW()) <= 30');
        // return $this->db->get()->result();

        $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental
        from tbl_truck
        join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
        WHERE DATEDIFF(tbl_truck.kir_waktu, NOW()) <= 30 AND tbl_operator.status = 1');
        return $this->db->get()->result();
    }

    public function get_all_data_alarm3()
    {
        $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi
        from tbl_truck
        join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
        join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_truck.id_kendaraan
        WHERE tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1" GROUP BY tbl_transaksi.id_kendaraan) AND
        DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) <= 5 AND tbl_operator.status = 1');   
        $this->db->group_by('tbl_transaksi.id_kendaraan');     
        return $this->db->get()->result();
    }

    public function get_all_data_alarm4()
    {
        $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, DATEDIFF(tbl_truck.stnk_waktu, NOW()) AS masa_stnk, DATEDIFF(tbl_truck.kir_waktu, NOW()) AS masa_kir, tbl_operator.*, DATEDIFF(tbl_truck.tanggal_rental, NOW()) AS masa_rental');
        $this->db->from('tbl_truck');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        $this->db->where('DATEDIFF(tbl_truck.tanggal_rental, NOW()) <= 5');
        return $this->db->get()->result();
    }

    public function get_all_data_service()
    {
        $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, tbl_operator.*, tbl_transaksi.tgl_transaksi, DATEDIFF(tbl_transaksi.tgl_transaksi + INTERVAL 6 MONTH, NOW()) AS tanggal_transaksi
        from tbl_truck
        left join tbl_operator ON tbl_operator.id_kendaraan = tbl_truck.id_kendaraan
        left join tbl_transaksi ON tbl_transaksi.id_kendaraan = tbl_truck.id_kendaraan
        WHERE tbl_transaksi.tgl_transaksi IN (SELECT MAX(tbl_transaksi.tgl_transaksi) FROM `tbl_transaksi` WHERE tbl_transaksi.jenis_perawatan = "1" GROUP BY tbl_transaksi.id_kendaraan) AND tbl_operator.status = 1 GROUP BY tbl_transaksi.id_kendaraan');        
        return $this->db->get()->result();
    }

    public function get_data($id_kendaraan)
    {
        $this->db->select('tbl_truck.id_kendaraan AS id, tbl_truck.*, tbl_operator.*');
        $this->db->from('tbl_truck');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        $this->db->where('tbl_operator.id_kendaraan', $id_kendaraan);
        return $this->db->get()->row();
    }

    public function add($data)
    {
        $this->db->insert('tbl_truck', $data);  
    }

    public function edit($data)
    {
        $this->db->where('id_kendaraan', $data['id_kendaraan']);
        $this->db->update('tbl_truck', $data);
    }

    public function delete($data)
    {
        $this->db->where('id_kendaraan', $data['id_kendaraan']);
        $this->db->delete('tbl_truck', $data);
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
