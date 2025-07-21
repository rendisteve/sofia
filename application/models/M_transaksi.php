<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_transaksi extends CI_Model {

    public function simpan_transaksi($data)
    {
        $this->db->insert('tbl_transaksi', $data);
    }

    public function simpan_rincian_transaksi($data_rinci)
    {
        $this->db->insert('tbl_rincian_transaksi', $data_rinci);
    }

    public function get_all_data()
    {
        // $this->db->select('*');
        // $this->db->from('tbl_transaksi');
        // return $this->db->get()->result();

        $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
                            tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        return $this->db->get()->result();
    }

    public function get_all_data_kendaraan()
    {
        // $this->db->select('*');
        // $this->db->from('tbl_transaksi');
        // return $this->db->get()->result();

        $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
                            tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        return $this->db->get()->result();
    }

    public function get_all_data_kendaraan_truck()
    {
        // $this->db->select('*');
        // $this->db->from('tbl_transaksi');
        // return $this->db->get()->result();

        $this->db->select('tbl_transaksi.*, tbl_truck.plat_nomor AS plat_nomor, tbl_truck.jenis_kendaraan AS jenis_kendaraan, 
                        tbl_truck.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_truck', 'tbl_truck.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        return $this->db->get()->result();
    }

    public function get_data_rincian()
    {
        $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
                            tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');
        return $this->db->get()->result();
    }

    public function get_transaksi($id_transaksi, $user)
    {
        // $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        //                     tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        // $this->db->from('tbl_transaksi');
        // $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');

        if ($user == '1234567089') {
            $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
            tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
            tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
            $this->db->from('tbl_transaksi');
            $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
            $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
            $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
            $this->db->where('tbl_transaksi.id_transaksi', $id_transaksi);
            $this->db->where('tbl_operator.status=1');
            return $this->db->get()->result();
        }elseif ($user == '1234567517') {
            $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
            tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_truck.plat_nomor AS plat_nomor, tbl_truck.jenis_kendaraan AS jenis_kendaraan, 
            tbl_truck.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
            $this->db->from('tbl_transaksi');
            $this->db->join('tbl_truck', 'tbl_truck.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
            $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
            $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
            $this->db->where('tbl_transaksi.id_transaksi', $id_transaksi);
            $this->db->where('tbl_operator.status=1');
            return $this->db->get()->result();
        }
    }

    public function get_transaksi1($id_transaksi, $user)
    {
        if ($user == '1234567089') {
            $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
            tbl_kendaraan.status_kepemilikan AS status_kepemilikan, tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.cluster AS cluster, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
            $this->db->from('tbl_transaksi');
            $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
            $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
            $this->db->where('tbl_transaksi.id_transaksi', $id_transaksi);
            $this->db->where('tbl_operator.status=1');
            return $this->db->get()->result();
        }elseif ($user == '1234567517') {
            $this->db->select('tbl_transaksi.*, tbl_truck.plat_nomor AS plat_nomor, tbl_truck.jenis_kendaraan AS jenis_kendaraan, 
            tbl_truck.status_kepemilikan AS status_kepemilikan, tbl_truck.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.cluster AS cluster, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
            $this->db->from('tbl_transaksi');
            $this->db->join('tbl_truck', 'tbl_truck.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
            $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
            $this->db->where('tbl_transaksi.id_transaksi', $id_transaksi);
            $this->db->where('tbl_operator.status=1');
            return $this->db->get()->result();
        }
        
    }

    public function get_rincian($id_transaksi)
    {
        $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
                            tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');
        $this->db->where('tbl_transaksi.id_transaksi', $id_transaksi);
        return $this->db->get()->num_rows();
    }

    public function get_data_transaksi($id_transaksi)
    {
        $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        tbl_kendaraan.status_kepemilikan AS status_kepemilikan, tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.cluster AS cluster, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('tbl_transaksi.id_transaksi', $id_transaksi);
        $this->db->where('tbl_operator.status=1');
        return $this->db->get()->row();
    }

    public function get_data_by_id_kendaraan($id_kendaraan)
    {
        // $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        //                     tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        // $this->db->from('tbl_transaksi');
        // $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        // return $this->db->get()->result();

        $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
        tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        $this->db->where('tbl_operator.status=1');
        $this->db->order_by('tbl_transaksi.tgl_transaksi', 'desc');
        // $this->db->group_by('tbl_transaksi.jenis_perawatan');
        return $this->db->get()->result();
    }

    public function get_data_by_id_kendaraan_limit1($id_kendaraan)
    {
        // $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        //                     tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        // $this->db->from('tbl_transaksi');
        // $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        // return $this->db->get()->result();

        $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
        tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        $this->db->where('tbl_operator.status=1');
        $this->db->order_by('tbl_transaksi.tgl_transaksi', 'desc');
        // $this->db->group_by('tbl_transaksi.jenis_perawatan');
        return $this->db->get()->row();
    }

    public function get_row_transaksi($id_kendaraan)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_kendaraan', $id_kendaraan);
        return $this->db->get()->num_rows();
    }

    public function get_data_by_id_kendaraan_truck_limit1($id_kendaraan)
    {
        // $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        //                     tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        // $this->db->from('tbl_transaksi');
        // $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        // return $this->db->get()->result();

        $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
        tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_truck.plat_nomor AS plat_nomor, tbl_truck.jenis_kendaraan AS jenis_kendaraan, 
        tbl_truck.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_truck', 'tbl_truck.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
        $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        $this->db->where('tbl_operator.status=1');
        $this->db->order_by('tbl_transaksi.tgl_transaksi', 'desc');
        // $this->db->group_by('tbl_transaksi.jenis_perawatan');
        return $this->db->get()->row();
    }

    public function get_data_by_id_kendaraan_limit1a($id_kendaraan)
    {
        // $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        //                     tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
        // $this->db->from('tbl_transaksi');
        // $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        // $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        // return $this->db->get()->result();

        $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
        tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
        tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
        $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
        $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        $this->db->where('tbl_operator.status=1');
        $this->db->order_by('tbl_transaksi.tgl_transaksi', 'desc');
        $this->db->limit(1,1);
        
        // $this->db->group_by('tbl_transaksi.jenis_perawatan');
        return $this->db->get()->row();
    }

    // public function get_data_by_id_kendaraan_limit1a($id_kendaraan, $user)
    // {
    //     if ($user == '1234567089') {
    //         // $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
    //         //                     tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
    //         // $this->db->from('tbl_transaksi');
    //         // $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
    //         // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
    //         // $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
    //         // return $this->db->get()->result();

    //         $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
    //         tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
    //         tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
    //         $this->db->from('tbl_transaksi');
    //         $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
    //         $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
    //         $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
    //         $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
    //         $this->db->where('tbl_operator.status=1');
    //         $this->db->order_by('tbl_transaksi.tgl_transaksi', 'desc');
    //         $this->db->limit(1,1);
            
    //         // $this->db->group_by('tbl_transaksi.jenis_perawatan');
    //         return $this->db->get()->row();
    //     }elseif ($user == '1234567517') {
    //         // $this->db->select('tbl_transaksi.*, tbl_kendaraan.plat_nomor AS plat_nomor, tbl_kendaraan.jenis_kendaraan AS jenis_kendaraan, 
    //         //                     tbl_kendaraan.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.status AS status_histori');
    //         // $this->db->from('tbl_transaksi');
    //         // $this->db->join('tbl_kendaraan', 'tbl_kendaraan.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
    //         // $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_kendaraan.id_kendaraan', 'left');
    //         // $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
    //         // return $this->db->get()->result();

    //         $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
    //         tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga, tbl_truck.plat_nomor AS plat_nomor, tbl_truck.jenis_kendaraan AS jenis_kendaraan, 
    //         tbl_truck.nama_pemilik AS nama_pemilik, tbl_operator.operator AS operator, tbl_operator.jabatan AS jabatan, tbl_operator.status AS status_histori');
    //         $this->db->from('tbl_transaksi');
    //         $this->db->join('tbl_truck', 'tbl_truck.id_kendaraan = tbl_transaksi.id_kendaraan', 'left');
    //         $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');    
    //         $this->db->join('tbl_operator', 'tbl_operator.id_kendaraan = tbl_truck.id_kendaraan', 'left');
    //         $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
    //         $this->db->where('tbl_operator.status=1');
    //         $this->db->order_by('tbl_transaksi.tgl_transaksi', 'desc');
    //         $this->db->limit(1,1);
            
    //         // $this->db->group_by('tbl_transaksi.jenis_perawatan');
    //         return $this->db->get()->row();
    //     }
    // }

    public function get_rincian_by_id_kendaraan($id_kendaraan)
    {
        $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
                            tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga');
        $this->db->from('tbl_transaksi');
        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');
        $this->db->where('tbl_transaksi.id_kendaraan', $id_kendaraan);
        return $this->db->get()->num_rows();
    }

    public function edit($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tbl_transaksi', $data);
    }

    public function belum_bayar()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');        
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=0');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
    }

    public function diproses()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');        
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=1');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
    }

    public function dikirim()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');        
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=2');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
    }

    public function selesai()
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');        
        $this->db->where('id_pelanggan', $this->session->userdata('id_pelanggan'));
        $this->db->where('status_order=3');
        $this->db->order_by('id_transaksi', 'desc');
        return $this->db->get()->result();
    }

    public function detail_pesanan($id_transaksi)
    {
        $this->db->select('*');
        $this->db->from('tbl_transaksi');
        $this->db->where('id_transaksi', $id_transaksi);
        return $this->db->get()->row();
    }

    public function rekening()
    {
        $this->db->select('*');
        $this->db->from('tbl_rekening');
        return $this->db->get()->result(); 
    }

    public function upload_bukti_bayar($data)
    {
        $this->db->where('id_transaksi', $data['id_transaksi']);
        $this->db->update('tbl_transaksi', $data);
        
    }

}
