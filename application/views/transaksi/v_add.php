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
<!-- general form elements disabled -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Transaksi</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <?php
                // notifikasi form kosong
                echo validation_errors('<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-info"></i>','<h5></div>');

                // notifikasi gagal upload

                if (isset($error_upload)) {
                    echo '<div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i>'.$error_upload.'<h5></div>';
                }
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Plat Nomor</label>
                        <input name="plat_nomor" type="text" class="form-control" placeholder="Plat Nomor" value="<?= $kendaraan->plat_nomor ?>" disabled>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status Kepemilikan</label>
                        <?php
                            if($kendaraan->status_kepemilikan == ""){
                                $status_kepemilikan = "-";
                            }elseif($kendaraan->status_kepemilikan == 1){
                                $status_kepemilikan = "Asset";
                            }elseif($kendaraan->status_kepemilikan == 2){
                                $status_kepemilikan = "Rental";
                            }elseif($kendaraan->status_kepemilikan == 3){
                                $status_kepemilikan = "Non Asset";
                            }
                        ?>
                        <input name="status_kepemilikan" type="text" class="form-control" placeholder="Status Kepemilikan" value="<?= $status_kepemilikan ?>" disabled>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input name="nama_pemilik" type="text" class="form-control" placeholder="Nama Pemilik" value="<?= $kendaraan->nama_pemilik ?>" disabled>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Kendaraan</label>
                        <input name="jenis_kendaraan" type="text" class="form-control" placeholder="Jenis Kendaraan" value="<?= $kendaraan->jenis_kendaraan ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" min="0" name="tahun_pembuatan" class="form-control" placeholder="Tahun" value="<?= $kendaraan->tahun_pembuatan ?>" disabled>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="2" disabled><?= $kendaraan->keterangan ?></textarea>
                </div>
            </div>

            <br>

            <div class="row" hidden>
            <?php
            if ($kendaraan->cluster == "") {
                $cluster = "-";
            }else{
                $cluster = $kendaraan->cluster; 
            }   
            
            if ($kendaraan->operator == "") {
                $operator = "-";
            }else{
                $operator = $kendaraan->operator; 
            }
            
            if ($kendaraan->jabatan == "") {
                $jabatan = "-";
            }else{
                $jabatan = $kendaraan->jabatan; 
            }    
                        
            ?>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Cluster</label>
                        
                        <input name="cluster" type="text" class="form-control" placeholder="Cluster" value="<?= $cluster ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Operator</label>
                        <input name="opertor" type="text" class="form-control" placeholder="Operator" value="<?= $operator ?>" disabled>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Jabatan/Posisi</label>
                        <input name="jabatan" type="text" class="form-control" placeholder="Jabatan" value="<?= $jabatan ?>" disabled>
                    </div>
                </div>
            </div>

            <hr style="border: 2px solid;">

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Perawatan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Riwayat</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Messages</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill" href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings" aria-selected="false">Settings</a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                                <?php
                                    echo form_open_multipart('Transaksi/add_cart');
                                    echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                                ?>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input name="barang_jasa" type="text" class="form-control" placeholder="Nama Barang/Jasa" value="<?= set_value('barang_jasa') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="number" min="0" name="volume" class="form-control" placeholder="Volume/QTY" value="<?= set_value('volume') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input name="satuan" type="text" class="form-control" placeholder="Satuan" value="<?= set_value('satuan') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="number" min="0" name="harga" class="form-control" placeholder="Harga" value="<?= set_value('harga') ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-2">
                                        <div class="form-group">
                                            <input type="number" min="0" name="jumlah" class="form-control" placeholder="Jumlah" value="<?= set_value('jumlah') ?>">
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>KM Kendaraan</label>
                                            <input type="number" min="0" name="tahun_pembuatan" class="form-control" placeholder="KM Awal" value="<?= set_value('tahun_pembuatan') ?>">
                                        </div>
                                    </div> -->
                                    <!-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>KM Akhir</label>
                                            <input type="number" min="0" name="tahun_pembuatan" class="form-control" placeholder="KM Awal" value="<?= set_value('tahun_pembuatan') ?>">
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <button type="submit" class="btn-sm btn-primary btn-flat"><i class="fas fa-save"></i> Tambah</button>
                                        <!-- <a href="<?= base_url('belanja/clear')?>" class="btn-sm btn-danger btn-flat"><i class="fas fa-sync"></i> Clear Cart</a>
                                        <a href="<?= base_url('belanja/cekout')?>" class="btn-sm btn-success btn-flat"><i class="fas fa-check-square"></i> Check Out</a> -->
                                    </div>
                                </div>
                                <?php echo form_close(); ?>

            
                                <div class="row">
                                    <div class="card-body pb-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <?php
                                                    if ($this->session->flashdata('pesan_update_keranjang')) {
                                                        echo '<div class="alert alert-success alert-dismissible">
                                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                        <h5><i class="icon fas fa-check"></i>';
                                                        echo $this->session->flashdata('pesan_update_keranjang');
                                                        echo '</h5></div>';
                                                    }
                                                ?>
                                            </div>
                                            
                                            <div class="col-sm-12">
                                                <?php 
                                                    echo form_open_multipart('transaksi/update');
                                                    echo form_hidden('redirect_page', str_replace('index.php/','',current_url())); 
                                                ?>
                                                    <table class="table table-condensed table-bordered table-striped">
                                                        <thead class="text-center">
                                                            <tr>
                                                                <th width="250px">Nama Barang/Jasa</th>
                                                                <th width="50px">Volume/Qty</th>
                                                                <th width="50px">Satuan</th>
                                                                <th width="150px" style="text-align:right">Harga</th>
                                                                <th width="150px" style="text-align:right">Jumlah</th>
                                                                <th width="50px" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                    <?php $i = 1; ?>
                                                    <?php 
                                                        $total_berat = 0;
                                                        foreach ($this->cart->contents() as $items) {
                                                            // $barang = $this->m_home->detail_barang($items['id']);
                                                            // $berat = $items['qty'] * $barang->berat;
                                                            // $total_berat = $total_berat + $berat;
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $items['name']; ?></td>
                                                            <!-- <td style="text-align:right"><?php echo $items['qty']; ?></td> -->
                                                            <td><?php echo form_input(array('name' => $i.'[qty]', 
                                                                                            'value' => $items['qty'], 
                                                                                            'maxlength' => '3',
                                                                                            'min' => '0', 
                                                                                            'size' => '5',
                                                                                            'type'=>'number',
                                                                                            'class'=>'form-control'
                                                                                        )); ?></td>
                                                            <td style="text-align:right"><?php echo $items['satuan']; ?></td>
                                                            <!-- <td style="text-align:right">Rp. <?php echo number_format($items['price'],0); ?></td> -->
                                                            <td><?php echo form_input(array('name' => $i.'[price]', 
                                                                                            'value' => $items['price'], 
                                                                                            'maxlength' => '3',
                                                                                            'min' => '0', 
                                                                                            'size' => '5',
                                                                                            'type'=>'number',
                                                                                            'class'=>'form-control'
                                                                                        )); ?></td>
                                                            <td style="text-align:right">Rp. <?php echo number_format($items['subtotal'],0); ?></td>
                                                            <td class="text-center">
                                                                <a href="<?= base_url('transaksi/delete/'.$items['rowid'].'/'.$kendaraan->id_kendaraan)?>" class="btn-xs btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                                                            </td>
                                                        </tr>

                                                    <?php $i++; ?>

                                                    <?php } ?>
                                                        <tr>
                                                            <th class="right" colspan="4"><h3><strong>Total Item : <?php echo number_format($i-1,0); ?></strong></h3></th>
                                                            <td class="right" colspan="2"><h3><strong>Total : Rp. <?php echo number_format($this->cart->total(),0); ?></strong></h3></td>
                                                        </tr>
                                                    </table>
                                                <button type="submit" class="btn-sm btn-primary btn-flat"><i class="fas fa-save"></i> Update Rincian</button>
                                                <a href="<?= base_url('transaksi/clear/'.$kendaraan->id_kendaraan)?>" class="btn-sm btn-danger btn-flat"><i class="fas fa-sync"></i> Kosongkan Rincian</a>
                                                <!-- <a href="<?= base_url('belanja/cekout')?>" class="btn-sm btn-success btn-flat"><i class="fas fa-check-square"></i> Check Out</a> -->
                                                <?php 
                                                    echo form_close(); 
                                                ?>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php echo form_open_multipart('transaksi/simpan_transaksi'); ?>
                                <hr style="border: 2px solid;">
                                <div class="row">
                                    <div class="col-sm-2">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Tanggal Transaksi</label>
                                            <select name="tanggaltran" type="text" class="form-control">
                                                <option value="">Tanggal</option>
                                                <?php 
                                                    $mulai = 1;
                                                    for ($i=$mulai; $i < $mulai + 31; $i++) { 
                                                        // $sel = $i == date('Y') ? 'selected="selected"' : '';
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select name="bulantran" class="form-control">
                                                <option value="">Bulan</option>
                                                <?php 
                                                    $mulai = 1;
                                                    for ($i=$mulai; $i < $mulai + 12; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select name="tahuntran" class="form-control">
                                                <option value="">Tahun</option>
                                                <?php 
                                                    $mulai = date('Y')-2;
                                                    for ($i=$mulai; $i < $mulai + 10; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Request Terakhir</label>
                                            <?php 
                                                if ($row != 0) {
                                                    $tanggal_transaksi = format_hari_tanggal($last_transaksi->tgl_transaksi);
                                                }else{
                                                    $tanggal_transaksi = '-';
                                                }
                                            ?>
                                            <input type="text" class="form-control" placeholder="Nomor Rekening" value="<?= $tanggal_transaksi ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>KM Terakhir</label>
                                            <?php 
                                                if ($row != 0) {
                                                    $kilometer_kendaraan = $last_transaksi->kilometer_kendaraan;
                                                }else{
                                                    $kilometer_kendaraan = '0';
                                                }
                                            ?>
                                            <input type="number" min="0" class="form-control" placeholder="Kilometer" value="<?= $kilometer_kendaraan ?>" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Jenis Perawatan</label>
                                            <select name="jenis_perawatan" type="text" class="form-control">
                                                <option value="">-Pilih Perawatan-</option>
                                                <option value="1">Servis Rutin</option>
                                                <option value="2">Pergantian</option>
                                                <option value="3">Perbaikan</option>
                                                <option value="4">Bayar Pajak</option>
                                                <option value="5">Bayar KIR</option>
                                                <option value="6">Bayar Rental</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>KM Kendaraan</label>
                                            <input type="number" min="0" name="kilometer_kendaraan" class="form-control" placeholder="Kilometer" value="<?= set_value('tahun_pembuatan') ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input name="no_rekening" type="text" class="form-control" placeholder="Nomor Rekening" value="<?= set_value('no_rekening') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input name="nama_bank" type="text" class="form-control" placeholder="Nama Bank" value="<?= set_value('nama_bank') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input name="atas_nama" type="text" class="form-control" placeholder="Atas Nama" value="<?= set_value('atas_nama') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <input type="number" min="0" name="jumlah" class="form-control" placeholder="Nominal" value="<?= $this->cart->total() ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="keperluan" class="form-control" placeholder="Keperluan" rows="2" ><?= set_value('keperluan') ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea name="keterangan" class="form-control" placeholder="keterangan" rows="2" ><?= set_value('keterangan') ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Admin Kendaraan</label>
                                            <input name="admin_kendaraan" type="text" class="form-control" placeholder="Admin Kendaraan" value="<?= $this->session->userdata('nama_user') ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Manager Operasional</label>
                                            <select name="mgr_ops" type="text" class="form-control">
                                                <option value="">-Pilih Manager-</option>
                                                <option value="Rizavada">Rizavada</option>
                                                <option value="Irsan">Irsan</option>
                                                <option value="Iqbal Azhari">Iqbal Azhari</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Manager Support</label>
                                            <input name="mgr_support" type="text" class="form-control" placeholder="Manager Support" value="Rika Anggraini">
                                        </div>
                                    </div>
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Admin Keuangan</label>
                                            <select name="admin_keuangan" type="text" class="form-control">
                                                <option value="">-Pilih Admin-</option>
                                                <option value="Nova Lydria Sary">Nova Lydria Sary</option>
                                                <option value="Arini Hardyanti">Arini Hardyanti</option>
                                                <option value="Defi Amalia">Defi Amalia</option>
                                                <option value="Mersa">Mersa</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <hr style="border: 2px solid;">
                                <div class="row">
                                    <!-- <div class="col-sm-4"> -->
                                        <!-- <div class="form-group"> -->
                                        <!-- <label>Date:</label> -->
                                            <!-- <div class="input-group date" id="reservationdate" data-target-input="nearest"> -->
                                                <!-- <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/> -->
                                                <!-- <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker"> -->
                                                    <!-- <div class="input-group-text"><i class="fa fa-calendar"></i></div> -->
                                                <!-- </div> -->
                                            <!-- </div> -->
                                        <!-- </div> -->

                                        <!-- <div class="form-group"> -->
                                            <!-- <label>Masa STNK</label> -->
                                            <!-- <input id="datetimepicker" width="312" /> -->
                                            <!-- <input id="datetimepicker" name="stnk" type="text" class="form-control" placeholder="Masa STNK" value="<?= set_value('stnk') ?>" readonly> -->
                                        <!-- </div> -->
                                    <!-- </div> -->

                                    <div class="col-sm-1">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Masa STNK</label>
                                            <select name="tanggalstnk" class="form-control">
                                                <option value="<?= date('d', strtotime($kendaraan->stnk_waktu)); ?>"><?= date('d', strtotime($kendaraan->stnk_waktu)); ?></option>
                                                <?php 
                                                    $mulai = 1;
                                                    for ($i=$mulai; $i < $mulai + 31; $i++) { 
                                                        // $sel = $i == date('Y') ? 'selected="selected"' : '';
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select name="bulanstnk" class="form-control">
                                                <option value="<?= date('m', strtotime($kendaraan->stnk_waktu)); ?>"><?= date('m', strtotime($kendaraan->stnk_waktu)); ?></option>
                                                <?php 
                                                    $mulai = 1;
                                                    for ($i=$mulai; $i < $mulai + 12; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select name="tahunstnk" class="form-control">
                                                <option value="<?= date('Y', strtotime($kendaraan->stnk_waktu)); ?>"><?= date('Y', strtotime($kendaraan->stnk_waktu)); ?></option>
                                                <?php 
                                                    $mulai = date('Y');
                                                    for ($i=$mulai; $i < $mulai + 10; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-1">
                                    </div>


                                    <div class="col-sm-1">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Masa KIR</label>
                                            <select name="tanggalkir" class="form-control">
                                                <option value="<?= date('d', strtotime($kendaraan->kir_waktu)); ?>"><?= date('d', strtotime($kendaraan->kir_waktu)); ?></option>
                                                <?php 
                                                    $mulai = 1;
                                                    for ($i=$mulai; $i < $mulai + 31; $i++) { 
                                                        // $sel = $i == date('Y') ? 'selected="selected"' : '';
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select name="bulankir" class="form-control">
                                                <option value="<?= date('m', strtotime($kendaraan->kir_waktu)); ?>"><?= date('m', strtotime($kendaraan->kir_waktu)); ?></option>
                                                <?php 
                                                    $mulai = 1;
                                                    for ($i=$mulai; $i < $mulai + 12; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-1">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>&nbsp;</label>
                                            <select name="tahunkir" class="form-control">
                                                <option value="<?= date('Y', strtotime($kendaraan->kir_waktu)); ?>"><?= date('Y', strtotime($kendaraan->kir_waktu)); ?></option>
                                                <?php 
                                                    $mulai = date('Y');
                                                    for ($i=$mulai; $i < $mulai + 10; $i++) { 
                                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                                        
                                                } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                                <table class="table table-bordered table-condensed" id="example3A">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Status</th>
                                            <th class="no-sort">Id Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Perawatan</th>
                                            <th class="no-sort">Kilometer</th>
                                            <th class="text-center">Nama Barang/Jasa</th>
                                            <th class="text-center">Volume/Qty	</th>
                                            <th class="text-center">Satuan</th>
                                            <th class="text-center">Est. Harga Satuan</th>
                                            <th class="text-center">Total Harga</th>
                                            <th class="no-sort">Keperluan</th>
                                            <th class="no-sort">Keterangan</th>
                                            <th>Operator</th>
                                            <!-- <th>Nominal</th> -->
                                            <th class="no-sort">Dikirim ke</th>
                                            <th>Created By</th>
                                            <th>Created At</th>

                                            <!-- <th>No</th>
                                            <th>Status</th>
                                            <th class="no-sort">Id Transaksi</th>
                                            <th>Tanggal</th>
                                            <th>Jenis Perawatan</th>
                                            <th class="no-sort">Kilometer</th>
                                            <th class="no-sort">Keperluan</th>
                                            <th class="no-sort">Keterangan</th>
                                            <th>Operator</th>
                                            <th>Nominal</th>
                                            <th class="no-sort">Dikirim ke</th>
                                            <th>Created By</th>
                                            <th>Created At</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $no = 1;

                                            $grand_total = 0; 
                                            foreach ($transaksi as $key => $value) { 
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
                                        <?php
                                        // $no=1;
                                        // foreach ($transaksi as $key => $value) {
                                        // if ($value->status_histori == 1) {
                                        //         if($value->jenis_perawatan == ""){
                                        //             $jenis_perawatan = "-";
                                        //         }elseif($value->jenis_perawatan == 1){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Servis Rutin</span>";
                                        //             $jenis_perawatan = "Servis Rutin";
                                        //         }elseif($value->jenis_perawatan == 2){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Pergantian</span>";
                                        //             $jenis_perawatan = "Pergantian";
                                        //         }elseif($value->jenis_perawatan == 3){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Perbaikan</span>";
                                        //             $jenis_perawatan = "Perbaikan";
                                        //         }elseif($value->jenis_perawatan == 4){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Bayar Pajak</span>";
                                        //             $jenis_perawatan = "Bayar Pajak";
                                        //         }elseif($value->jenis_perawatan == 5){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Bayar KIR</span>";
                                        //             $jenis_perawatan = "Bayar KIR";
                                        //         }elseif($value->jenis_perawatan == 6){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Bayar Rental</span>";
                                        //             $jenis_perawatan = "Bayar Rental";
                                        //         }

                                        //         if($value->jenis_perawatan == ""){
                                        //             $jenis_perawatan = "-";
                                        //         }elseif($value->jenis_perawatan == 1){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Servis Rutin</span>";
                                        //             $jenis_perawatan = "Servis Rutin";
                                        //         }elseif($value->jenis_perawatan == 2){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Pergantian</span>";
                                        //             $jenis_perawatan = "Pergantian";
                                        //         }elseif($value->jenis_perawatan == 3){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Perbaikan</span>";
                                        //             $jenis_perawatan = "Perbaikan";
                                        //         }elseif($value->jenis_perawatan == 4){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Bayar Pajak</span>";
                                        //             $jenis_perawatan = "Bayar Pajak";
                                        //         }elseif($value->jenis_perawatan == 5){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Bayar KIR</span>";
                                        //             $jenis_perawatan = "Bayar KIR";
                                        //         }elseif($value->jenis_perawatan == 6){
                                        //             // $jenis_perawatan = "<span class='badge bg-info'>Bayar Rental</span>";
                                        //             $jenis_perawatan = "Bayar Rental";
                                        //         }
                                                ?>
                                            <!-- <tr>
                                                <td class="text-center"><?= $no++ ?></td>
                                                <td class="text-center"><?= $value->status ?></td>            
                                                <td class="text-center"><?= $value->id_transaksi ?></td>
                                                <td class="text-center"><?= format_hari_tanggal($value->tgl_transaksi) ?></td>
                                                <td class="text-center"><button class="btn-xs btn-info" data-toggle="modal" data-target="#rincian<?=$value->id_transaksi?>"><?= $jenis_perawatan ?></button></td>
                                                <td class="text-center"><?= $value->kilometer_kendaraan ?></td>
                                                <td><?= $value->keperluan ?></td>
                                                <td><?= $value->keterangan ?></td>
                                                <td class="text-center"><?= $value->operator ?></td>
                                                <td class="text-center"><?= number_format($value->jumlah,0)?></td>
                                                <td class="text-center"><?= $value->atas_nama ?></td>
                                                <td class="text-center"><?= $value->created_by ?></td>
                                                <td class="text-center"><?= $value->created_at ?></td>
                                            </tr> -->
                                        <?php 
                                        // }
                                            
                                        // }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                                Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel" aria-labelledby="custom-tabs-four-settings-tab">
                                Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis.
                            </div> -->
                        </div>
                    </div>
                    <!-- /.card -->
                    </div>
                </div>
            </div>

            <input name="id_kendaraan" value="<?= $kendaraan->id_kendaraan ?>" hidden>
            <?php $id_transaksi = 'TRX'.date('Ymd').strtoupper(random_string('alnum',2)); ?>
            <input name="id_transaksi" value="<?= $id_transaksi ?>" hidden>
            <!-- // TRX20230609QA -->
            <!-- <input name="estimasi" hidden>
            <input name="ongkir" hidden>
            <input name="berat" value="<?= $total_berat; ?>" hidden> <br>
            <input name="grand_total" value="<?= $this->cart->total(); ?>" hidden>
            <input name="total_bayar" hidden> -->

            
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a href="<?= base_url('kendaraan')?>" class="btn btn-success btn-sm">Kembali</a>
            </div>

            <?php
                form_close();
            ?>
        </div>
    </div>
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

<script>
    // $('#datetimepicker').datetimepicker({ format: 'yyyy-mm-dd' });

    // $('#reservationdate').datetimepicker({format: 'L'});
    
    function bacaGambar1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load1").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    function bacaGambar2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load2").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    function bacaGambar3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load3").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    function bacaGambar4(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load4").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    function bacaGambar5(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load5").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    function bacaGambar6(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load6").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    function bacaGambar7(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load7").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    function bacaGambar8(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#gambar_load8").attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            
        }
    }

    $("#preview_gambar1").change(function() {
       bacaGambar1(this); 
    });

    $("#preview_gambar2").change(function() {
       bacaGambar2(this); 
    });

    $("#preview_gambar3").change(function() {
       bacaGambar3(this); 
    });

    $("#preview_gambar4").change(function() {
       bacaGambar4(this); 
    });

    $("#preview_gambar5").change(function() {
       bacaGambar5(this); 
    });

    $("#preview_gambar6").change(function() {
       bacaGambar6(this); 
    });

    $("#preview_gambar7").change(function() {
       bacaGambar7(this); 
    });

    $("#preview_gambar8").change(function() {
       bacaGambar8(this); 
    });
</script>