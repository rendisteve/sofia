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
        return "$tanggal-$bulan-$tahun $jam";
    }
?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Data Kendaraan</h3>

        <div class="card-tools">
            <!-- <a href="<?= base_url('kendaraan/add')?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
            Tambah</a> -->
        </div>
        <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
            if ($this->session->flashdata('pesan_kendaraan')) {
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>';
                echo $this->session->flashdata('pesan_kendaraan');
                echo '</h5></div>';
            }
            ?>
            <table class="table table-bordered table-condensed" id="example3">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Id Transaksi</th>
                        <th>Tanggal</th>
                        <th>Jenis Kendaraan</th>
                        <th>Pemilik</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Perawatan</th>
                        <th>Kilometer</th>
                        <th>Keperluan</th>
                        <th>Keterangan</th>
                        <th>Operator</th>
                        <th>Nominal</th>
                        <th>Dikirim ke</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($transaksi as $key => $value) {
                    if ($value->status_histori == 1) {
                            if($value->jenis_perawatan == ""){
                                $jenis_perawatan = "-";
                            }elseif($value->jenis_perawatan == 1){
                                // $jenis_perawatan = "<span class='badge bg-info'>Servis Rutin</span>";
                                $jenis_perawatan = "Servis Rutin";
                            }elseif($value->jenis_perawatan == 2){
                                // $jenis_perawatan = "<span class='badge bg-info'>Pergantian</span>";
                                $jenis_perawatan = "Pergantian";
                            }elseif($value->jenis_perawatan == 3){
                                // $jenis_perawatan = "<span class='badge bg-info'>Perbaikan</span>";
                                $jenis_perawatan = "Perbaikan";
                            }elseif($value->jenis_perawatan == 4){
                                // $jenis_perawatan = "<span class='badge bg-info'>Bayar Pajak</span>";
                                $jenis_perawatan = "Bayar Pajak";
                            }elseif($value->jenis_perawatan == 5){
                                // $jenis_perawatan = "<span class='badge bg-info'>Bayar KIR</span>";
                                $jenis_perawatan = "Bayar KIR";
                            }elseif($value->jenis_perawatan == 6){
                                // $jenis_perawatan = "<span class='badge bg-info'>Bayar Rental</span>";
                                $jenis_perawatan = "Bayar Rental";
                            }

                            if($value->jenis_perawatan == ""){
                                $jenis_perawatan = "-";
                            }elseif($value->jenis_perawatan == 1){
                                // $jenis_perawatan = "<span class='badge bg-info'>Servis Rutin</span>";
                                $jenis_perawatan = "Servis Rutin";
                            }elseif($value->jenis_perawatan == 2){
                                // $jenis_perawatan = "<span class='badge bg-info'>Pergantian</span>";
                                $jenis_perawatan = "Pergantian";
                            }elseif($value->jenis_perawatan == 3){
                                // $jenis_perawatan = "<span class='badge bg-info'>Perbaikan</span>";
                                $jenis_perawatan = "Perbaikan";
                            }elseif($value->jenis_perawatan == 4){
                                // $jenis_perawatan = "<span class='badge bg-info'>Bayar Pajak</span>";
                                $jenis_perawatan = "Bayar Pajak";
                            }elseif($value->jenis_perawatan == 5){
                                // $jenis_perawatan = "<span class='badge bg-info'>Bayar KIR</span>";
                                $jenis_perawatan = "Bayar KIR";
                            }elseif($value->jenis_perawatan == 6){
                                // $jenis_perawatan = "<span class='badge bg-info'>Bayar Rental</span>";
                                $jenis_perawatan = "Bayar Rental";
                            }
                            ?>
                        <tr>
                            <td style="vertical-align: middle;" class="text-center"><?= $no++ ?></td>
                            <td style="vertical-align: middle;" class="text-center">
                                <a href="<?= base_url('transaksi/cetak_foto/'.$value->id_transaksi.'/'.$value->jenis_perawatan)?>" class="btn-xs btn-primary" data-placement="top" title="Cetak Foto"><i class="fas fa-camera"></i></a>
                                <a href="<?= base_url('transaksi/cetak_form/'.$value->id_transaksi.'/'.$value->jenis_perawatan)?>" class="btn-xs btn-success" data-placement="top" title="Cetak Form"><i class="fas fa-print"></i></a>
                                <a href="<?= base_url('transaksi/update_transaksi/'.$value->id_transaksi)?>" class="btn-xs btn-warning" data-placement="top" title="Update Transaksi"><i class="fas fa-edit"></i></a>
                                <!-- <button class="btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value->id_transaksi ?>"><i class="fas fa-trash"></i></button> -->
                            </td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->status ?></td>            
                            <td style="vertical-align: middle;" class="text-center"><?= $value->id_transaksi ?></td>
                            <!-- <td class="text-center"><?= date('d-m-Y', strtotime($value->tgl_transaksi) )?></td> -->
                            <td style="vertical-align: middle;" class="text-center"><?= $value->tgl_transaksi?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->jenis_kendaraan ?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->nama_pemilik ?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->plat_nomor ?></td>
                            <!-- <td class="text-center"><?= $jenis_perawatan ?></td> -->
                            <td style="vertical-align: middle;" class="text-center"><button class="btn-xs btn-info" data-toggle="modal" data-target="#rincian<?=$value->id_transaksi?>"><?= $jenis_perawatan ?></button></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->kilometer_kendaraan ?></td>
                            <td><?= $value->keperluan ?></td>
                            <td><?= $value->keterangan ?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->operator ?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= number_format($value->jumlah,0)?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->atas_nama ?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->created_by ?></td>
                            <td style="vertical-align: middle;" class="text-center"><?= $value->created_at ?></td>
                        </tr>
                    <?php }
                        
                    }
                     ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal rincian -->
<?php foreach ($transaksi as $key => $value) { ?>
<div class="modal fade" id="rincian<?=$value->id_transaksi?>">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">SPAREPART YANG DIPERLUKAN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-striped">
                    <thead class="text-center">
                        <tr>
                            <th>Barang/Jasa</th>
                            <th>Volume/Qty</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th class="text-center">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $query = $this->db->select('tbl_transaksi.*, tbl_rincian_transaksi.barang_jasa AS barang_jasa, tbl_rincian_transaksi.volume AS volume, 
                            tbl_rincian_transaksi.satuan AS satuan, tbl_rincian_transaksi.harga AS harga');
                        $this->db->from('tbl_transaksi');
                        $this->db->join('tbl_rincian_transaksi', 'tbl_rincian_transaksi.id_transaksi = tbl_transaksi.id_transaksi', 'left');
                        $this->db->where('tbl_transaksi.id_transaksi', $value->id_transaksi);
                        
                        // return $this->db->get()->result();
                        $grand_total = 0; 
                        foreach ($query->get()->result() as $key => $value1) { 
                            $tot_harga = $value1->volume * $value1->harga;
                            $grand_total = $grand_total + $tot_harga; ?>
                        <tr>
                            <td><?= $value1->barang_jasa ?></td>
                            <td class="text-center"><?= $value1->volume ?></td>
                            <td class="text-center"><?= $value1->satuan ?></td>
                            <td class="text-right"><?= number_format($value1->harga,0); ?></td>
                            <td class="text-right"><?= number_format($tot_harga,0); ?></td>
                        </tr>
                    <?php } ?> 
                        <tr>
                            <td colspan="3">&nbsp;</td>
                            <td class="text-right"><b>Total</b></td>
                            <td class="text-right"><b><?= number_format($grand_total,0); ?></b></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer justify-content-between">  
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<?php } ?>


<?php foreach ($transaksi as $key => $value) { 
    if ($value->status == 1) { ?>
    <div class="modal fade" id="operator1<?= $value->id_transaksi ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Operator</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                    echo form_open('kendaraan/operator1/'.$value->id_histori);
                    ?>
                        <div class="form-group">
                            <label>Kendaraan</label>
                            <input name="id_history" value="<?= $value->id_histori ?>" hidden>
                            <input name="id_kendaraan" value="<?= $value->id ?>" hidden>
                            <input type="text" name="plat_nomor" value="<?= $value->plat_nomor ?>" class="form-control" placeholder="Plat Nomor" required>
                        </div>

                        <div class="form-group">
                            <label>Cluster</label>
                            <input name="cluster" type="text" class="form-control" placeholder="Cluster" value="<?= set_value('cluster') ?>">
                        </div>

                        <div class="form-group">
                            <label>Nama </label>
                            <input name="operator" type="text" class="form-control" placeholder="Nama" value="<?= set_value('operator') ?>">
                        </div>

                        <div class="form-group">
                            <label>Jabatan/Posisi </label>
                            <input name="jabatan" type="text" class="form-control" placeholder="Jabatan/Posisi" value="<?= set_value('jabatan') ?>">
                        </div>

                        <div class="row">
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <select name="tanggalhis" class="form-control">
                                        <option value="0">Tanggal</option>
                                        <?php 
                                            $mulai = 1;
                                            for ($i=$mulai; $i < $mulai + 31; $i++) { 
                                                // $sel = $i == date('Y') ? 'selected="selected"' : '';
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                                
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select name="bulanhis" class="form-control">
                                        <option value="0">Bulan</option>
                                        <?php 
                                            $mulai = 1;
                                            for ($i=$mulai; $i < $mulai + 12; $i++) { 
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                                
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <select name="tahunhis" class="form-control">
                                        <option value="0">Tahun</option>
                                        <?php 
                                            $mulai = 2000;
                                            for ($i=$mulai; $i < $mulai + 50; $i++) { 
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                                
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
                
                <?php
                    echo form_close();
                ?>
            </div>
            <!-- /.modal-content -->
        </div>
    <!-- /.modal-dialog -->
    </div>
<?php }
} ?>

<!-- /.modal hapus-->
<?php foreach ($transaksi as $key => $value) { ?>
<div class="modal fade" id="delete<?= $value->id_transaksi ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete <?= $value->plat_nomor?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <h5>Apakah Anda Yakin Ingin Menghapus Data Ini ?</h5>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?= base_url('kendaraan/delete/'.$value->id)?>" class="btn btn-primary">Delete</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<?php } ?>