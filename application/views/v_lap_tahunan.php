<style>
  .table-condensed{
    font-size: 12px;
  }
  th {
    font-size: 14px;
  }
</style>

<?php
    date_default_timezone_set('Asia/Jakarta');
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

    function format_hari_tanggal1($waktu)
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
        $jam = date( 'H:i', strtotime($waktu));
        
        //untuk menampilkan hari, tanggal bulan tahun jam
        //return "$hari, $tanggal $bulan $tahun $jam";
    
        //untuk menampilkan hari, tanggal bulan tahun
        return "$tahun";
    }
?>
<div class="col-md-12">
    <div class="invoice p-3 mb-3">
        <div class="row">
            <div class="col-12">
                <h4>
                <i class="fas fa-globe"></i> <?= $title; ?>
                <small class="float-right">Tahun: <?= $tahun;?></small>
                </h4>
            </div>
        <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12 table-responsive">
            <?php
            if ($this->session->flashdata('pesan_kendaraan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo $this->session->flashdata('pesan_kendaraan');
                echo '</h5></div>';
            }
            ?>
            <table class="table table-bordered table-condensed" id="example3B">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th class="no-sort">Id Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jenis Perawatan</th>
                        <th>Plat Nomor</th>
                        <th class="no-sort">Kilometer</th>
                        <th class="text-center">Nama Barang/Jasa</th>
                        <th class="text-center">Volume/Qty	</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-center">Est. Harga Satuan</th>
                        <th class="text-center">Total Harga</th>
                        <th class="no-sort">Keperluan</th>
                        <th class="no-sort">Keterangan</th>
                        <th>Operator</th>
                        <th class="no-sort">Dikirim ke</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $no = 1;

                    $grand_total = 0; 
                    foreach ($laporan as $key => $value) { 
                        if ($value->status_histori == 1) {
                            $tot_harga = $value->volume * $value->harga;
                            $grand_total = $grand_total + $tot_harga;
                            $row = $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
                                                tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga');
                            $this->db->from('tbl_transaksi');
                            $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');
                            $this->db->where('tbl_transaksi.id_transaksi', $value->id_transaksi);
                            $row = $row->get()->num_rows();
                    ?>
                    <tr>
                        <?php 
                        // if ($row > 1) {
                            if($value->jenis_perawatan == ""){
                                $jenis_perawatan = "-";
                            }elseif($value->jenis_perawatan == 1){
                                $jenis_perawatan = "<span class='badge bg-info'>Servis Rutin</span>";
                                // $jenis_perawatan = "Servis Rutin";
                            }elseif($value->jenis_perawatan == 2){
                                $jenis_perawatan = "<span class='badge bg-info'>Pergantian</span>";
                                // $jenis_perawatan = "Pergantian";
                            }elseif($value->jenis_perawatan == 3){
                                $jenis_perawatan = "<span class='badge bg-info'>Perbaikan</span>";
                                // $jenis_perawatan = "Perbaikan";
                            }elseif($value->jenis_perawatan == 4){
                                $jenis_perawatan = "<span class='badge bg-info'>Bayar Pajak</span>";
                                // $jenis_perawatan = "Bayar Pajak";
                            }elseif($value->jenis_perawatan == 5){
                                $jenis_perawatan = "<span class='badge bg-info'>Bayar KIR</span>";
                                // $jenis_perawatan = "Bayar KIR";
                            }elseif($value->jenis_perawatan == 6){
                                $jenis_perawatan = "<span class='badge bg-info'>Bayar Rental</span>";
                                // $jenis_perawatan = "Bayar Rental";
                            } ?>
                            <!-- <td rowspan="<?= $row ?>" class="text-center"><?= $no ?></td>
                            <td rowspan="<?= $row ?>" class="text-center"><?= $value->status; ?></td>
                            <td rowspan="<?= $row ?>" class="text-center"><?= $value->id_transaksi; ?></td>
                            <td rowspan="<?= $row ?>" class="text-center"><?= $value->tgl_transaksi; ?></td>
                            <td rowspan="<?= $row ?>" class="text-center"><button class="btn-xs btn-info" data-toggle="modal" data-target="#rincian<?=$value->id_transaksi?>"><?= $jenis_perawatan ?></button></td>
                            <td rowspan="<?= $row ?>" class="text-center"><?= $value->kilometer_kendaraan; ?></td> -->
                            <td class="text-center"><?= $no ?></td>
                            <td class="text-center"><?= $value->status; ?></td>
                            <td class="text-center"><?= $value->id_transaksi; ?></td>
                            <td class="text-center"><?= $value->tgl_transaksi; ?></td>
                            <td class="text-center"><?= $jenis_perawatan ?></td>
                            <td class="text-center"><?= $value->plat_nomor ?></td>
                            <td class="text-center"><?= $value->kilometer_kendaraan; ?></td>
                        <?php 
                        // }else{

                        // }
                        // if ($row > 2) {

                        // } 
                        ?> 
                        <td><?= $value->barang_jasa; ?></td>
                        <td class="text-center"><?= $value->volume; ?></td>
                        <td class="text-center"><?= $value->satuan; ?></td>
                        <td class="text-right"><?= number_format($value->harga,0); ?></td>
                        <td class="text-right"><?= number_format($tot_harga,0); ?></td>
                        <?php 
                        // if ($row >= 1) { 
                        ?>
                            <!-- <td rowspan="<?= $row ?>" style="border: 1px solid; width: 200px; padding: 5px;"><?= $value->keterangan;?> </td> -->
                            <td><?= $value->keperluan;?> </td>
                            <td><?= $value->keterangan;?> </td>
                            <td class="text-center"><?= $value->operator;?> </td>
                            <!-- <td class="text-right"><?= number_format($value->jumlah,0); ?></td> -->
                            <td><?= $value->atas_nama; ?></td>
                            <td class="text-center"><?= $value->created_by; ?></td>
                            <td class="text-center"><?= $value->created_at; ?></td>
                        <?php 
                        // }
                        // if ($row > 2) {

                        // } 
                        $no++;?>
                    </tr>
                        <?php 
                            }
                        }
                        ?>
                    <!-- ////////////// -->
                </tbody>
            </table>
        </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>