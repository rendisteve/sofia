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
            <table class="table table-bordered table-condensed" id="example2A">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Jatuh Tempo Service</th>
                        <th>Tanggal Transaksi</th>
                        <th>Cluster</th>
                        <th>Operator</th>
                        <th>Jabatan/Posisi</th>
                        <th>Status Kepemililikan</th>
                        <th>Plat Nomor</th>
                        <th>Odometer</th>
                        <th>Tanggal Rental</th>
                        <th>Nama Pemilik</th>
                        <th>Jenis Kendaraan</th>
                        <th>Tahun Pembuatan</th>
                        <th>Keterangan</th>
                        <th>Warna</th>
                        <th>Bahan Bakar</th>
                        <th>Nomor Rangka</th>
                        <th>Nomor Mesin</th>
                        <th>Nomor BPKB</th>
                        <th>Masa STNK</th>
                        <th>Masa KIR</th>
                        <th>Foto Depan</th>
                        <th>Foto Belakang</th>
                        <th>Foto Kiri</th>
                        <th>Foto Kanan</th>
                        <th>Foto Interior 1</th>
                        <th>Foto Interior 2</th>
                        <th>Foto Interior 3</th>
                        <th>Foto Interior 4</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($kendaraan as $key => $value) {
                    if ($value->status == 1 OR $value->status == NULL) {
                            if($value->status_kepemilikan == ""){
                                $status_kepemilikan = "-";
                            }elseif($value->status_kepemilikan == 1){
                                $status_kepemilikan = "<span class='badge bg-success'>Asset</span>";
                            }elseif($value->status_kepemilikan == 2){
                                $status_kepemilikan = "<span class='badge bg-info'>Rental</span>";
                            }elseif($value->status_kepemilikan == 3){
                                $status_kepemilikan = "<span class='badge bg-warning'>Non Asset</span>";
                            }

                            if ($value->tanggal_transaksi < 0){
                                $pesan_service = "<span class='badge bg-danger'>SERVICE TERLEWAT</span>";
                            }elseif ($value->tanggal_transaksi <= 2) {
                                $pesan_service = "<span class='badge bg-warning'>SEGERA DIEKSEKUSI !!!</span>";
                            }elseif ($value->tanggal_transaksi <= 5) {
                                $pesan_service = "<span class='badge bg-info'>INFO KE OPERATOR</span>";
                            }else{
                                $pesan_service = "<span class='badge bg-success'>KENDARAAN AMAN</span>";
                            }
                            ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center">
                            <a href="<?= base_url('transaksi/add/'.$value->id)?>" class="btn-xs btn-info" data-placement="top" title="Tambah Transaksi"><i class="fas fa-calendar-check"></i></a>
                                <?php
                                    if ($value->id_histori != "") { ?>
                                        <button class="btn-xs btn-secondary" data-toggle="modal" data-target="#operator1<?= $value->id ?>"><i class="fas fa-user" data-placement="top" title="Update Operator"></i></button>
                                <?php }else{?>
                                        <button class="btn-xs btn-success" data-toggle="modal" data-target="#operator<?= $value->id ?>"><i class="fas fa-user" data-placement="top" title="Tambah Operator"></i></button>
                                <?php } ?>
                                <a href="<?= base_url('kendaraan/edit/'.$value->id)?>" class="btn-xs btn-warning" data-placement="top" title="Edit Kendaraan"><i class="fas fa-edit"></i></a>
                                <!-- <button class="btn-xs btn-danger" data-toggle="modal" data-target="#delete<?= $value->id ?>"><i class="fas fa-trash"></i></button> -->
                            </td>
                            <td class="text-center"><?= $value->tanggal_transaksi .' Hari <br>'. $pesan_service?></td>
                            <td class="text-center"><?= $value->tgl_transaksi ?></td>
                            <td class="text-center"><?= $value->cluster ?></td>
                            <td class="text-center"><?= $value->operator ?></td>
                            <td class="text-center"><?= $value->jabatan ?></td>
                            <td class="text-center"><?= $status_kepemilikan ?></td>
                            <td class="text-center"><?= $value->plat_nomor ?></td>
                            <td class="text-center"><?= $value->odometer ?></td>
                            <td class="text-center"><?= $value->tanggal_rental ?></td>
                            <td class="text-center"><?= $value->nama_pemilik ?></td>
                            <td class="text-center"><?= $value->jenis_kendaraan ?></td>
                            <td class="text-center"><?= $value->tahun_pembuatan ?></td>
                            <td class="text-center"><?= $value->keterangan ?></td>
                            <td class="text-center"><?= $value->warna ?></td>
                            <td class="text-center"><?= $value->bahan_bakar ?></td>
                            <td class="text-center"><?= $value->nomor_rangka ?></td>
                            <td class="text-center"><?= $value->nomor_mesin ?></td>
                            <td class="text-center"><?= $value->nomor_bpkb ?></td>
                            <td class="text-center"><?= format_hari_tanggal($value->stnk_waktu) ?></td>
                            <td class="text-center"><?= format_hari_tanggal($value->kir_waktu) ?></td>


                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_depan) ?>" data-toggle="lightbox" data-title="Foto Depan">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_depan) ?>" class="img-size-50" alt="Foto Depan"/>
                            </a></td>
                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_belakang) ?>" data-toggle="lightbox" data-title="Foto Belakang">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_belakang) ?>" class="img-size-50" alt="Foto Belakang"/>
                            </a></td>
                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_kiri) ?>" data-toggle="lightbox" data-title="Foto Kiri">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_kiri) ?>" class="img-size-50" alt="Foto Kiri"/>
                            </a></td>
                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_kanan) ?>" data-toggle="lightbox" data-title="Foto Kanan">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_kanan) ?>" class="img-size-50" alt="Foto Kanan"/>
                            </a></td>
                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_interior1) ?>" data-toggle="lightbox" data-title="Foto Interior 1">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_interior1) ?>" class="img-size-50" alt="Foto Interior 1"/>
                            </a></td>
                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_interior2) ?>" data-toggle="lightbox" data-title="Foto Interior 2">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_interior2) ?>" class="img-size-50" alt="Foto Interior 2"/>
                            </a></td>
                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_interior3) ?>" data-toggle="lightbox" data-title="Foto Interior 3">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_interior3) ?>" class="img-size-50" alt="Foto Interior 3"/>
                            </a></td>
                            <td class="text-center"><a href="<?= base_url('assets/gambar/'.$value->foto_interior4) ?>" data-toggle="lightbox" data-title="Foto Interior 4">
                                <img src="<?= base_url('assets/gambar/'.$value->foto_interior4) ?>" class="img-size-50" alt="Foto Interior 4"/>
                            </a></td>
                            
                        </tr>
                    <?php }
                        
                    } ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal add operator -->
<?php foreach ($kendaraan as $key => $value) { ?>
<div class="modal fade" id="operator<?= $value->id ?>">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Operator</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                echo form_open('kendaraan/operator');
                ?>
                    <div class="form-group">
                        <label>Kendaraan</label>
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
<?php } ?>

<?php foreach ($kendaraan as $key => $value) { 
    if ($value->status == 1) { ?>
    <div class="modal fade" id="operator1<?= $value->id ?>">
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
<?php foreach ($kendaraan as $key => $value) { ?>
<div class="modal fade" id="delete<?= $value->id ?>">
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