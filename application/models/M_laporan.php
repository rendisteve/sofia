<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan extends CI_Model {

    // public function lap_harian($tanggal,$bulan,$tahun)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_rincian_transaksi1');
    //     $this->db->join('tbl_transaksi1', 'tbl_transaksi1.no_order = tbl_rincian_transaksi1.no_order', 'left');
    //     $this->db->join('tbl_barang', 'tbl_barang.id_barang = tbl_rincian_transaksi1.id_barang', 'left');
    //     $this->db->where('DAY(tbl_transaksi1.tgl_order)', $tanggal);
    //     $this->db->where('MONTH(tbl_transaksi1.tgl_order)', $bulan);
    //     $this->db->where('YEAR(tbl_transaksi1.tgl_order)', $tahun);
    //     return $this->db->get()->result();
    // }

    public function lap_harian($tanggal,$bulan,$tahun)
    {
        $this->db->select('tbl_rincian_transaksi.*, tbl_kendaraan.*, tbl_transaksi.*, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        $this->db->from('tbl_rincian_transaksi');
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_rincian_transaksi.id_transaksi', 'left');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('DAY(tbl_transaksi.tgl_transaksi)', $tanggal);
        $this->db->where('MONTH(tbl_transaksi.tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tbl_transaksi.tgl_transaksi)', $tahun);
        return $this->db->get()->result();
    }

    // public function lap_bulanan($bulan,$tahun)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_transaksi1');
    //     $this->db->where('MONTH(tbl_transaksi1.tgl_order)', $bulan);
    //     $this->db->where('YEAR(tbl_transaksi1.tgl_order)', $tahun);
    //     $this->db->where('status_bayar=1');
    //     return $this->db->get()->result();
    // }

    public function lap_bulanan($bulan,$tahun)
    {
        $this->db->select('tbl_rincian_transaksi.*, tbl_kendaraan.*, tbl_transaksi.*, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        $this->db->from('tbl_rincian_transaksi');
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_rincian_transaksi.id_transaksi', 'left');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('MONTH(tbl_transaksi.tgl_transaksi)', $bulan);
        $this->db->where('YEAR(tbl_transaksi.tgl_transaksi)', $tahun);
        return $this->db->get()->result();
    }

    // public function lap_tahunan($tahun)
    // {
    //     $this->db->select('*');
    //     $this->db->from('tbl_transaksi1');
    //     $this->db->where('YEAR(tbl_transaksi1.tgl_order)', $tahun);
    //     $this->db->where('status_bayar=1');        
    //     return $this->db->get()->result();
    // }

    public function lap_tahunan($tahun)
    {
        $this->db->select('tbl_rincian_transaksi.*, tbl_kendaraan.*, tbl_transaksi.*, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        $this->db->from('tbl_rincian_transaksi');
        $this->db->join('tbl_transaksi', 'tbl_transaksi.id_transaksi = tbl_rincian_transaksi.id_transaksi', 'left');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('YEAR(tbl_transaksi.tgl_transaksi)', $tahun);       
        return $this->db->get()->result();
    }

}

/* End of file M_laporan.php */
