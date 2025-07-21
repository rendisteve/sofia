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
        <h3 class="card-title">List P2H</h3>

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
            <table class="table table-bordered table-condensed" id="examplep2h">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Action</th>
                        <th>Tanggal</th>
                        <th>Plat Nomor</th>
                        <th>Jenis Kendaraan</th>
                        <th>Cluster</th>
                        <th>Operator</th>
                        <th>Jabatan/Posisi</th>
                        <th>FORM P2H</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no=1;
                    foreach ($p2h as $key => $value) {
                    if ($value->status == 1 OR $value->status == NULL) { ?>
                        <tr>
                            <td class="text-center"><?= $no++ ?></td>
                            <td class="text-center">
                                <a href="<?= base_url('p2h/detail/'.$value->p2h_id)?>" class="btn-xs btn-info" data-placement="top" title="Detail"><i class="fas fa-share-square"></i></a>
                            </td>
                            <td class="text-center"><?= format_hari_tanggal($value->tanggal_p2h) ?></td>
                            <td class="text-center"><?= $value->plat_nomor ?></td>
                            <td class="text-center"><?= $value->jenis_kendaraan ?></td>
                            <td class="text-center"><?= $value->cluster ?></td>
                            <td class="text-center"><?= $value->operator ?></td>
                            <td class="text-center"><?= $value->jabatan ?></td>
                            <td>
                                <!-- <table class="table table-bordered table-condensed" id="examplep2h1"> -->
                                <table class="table table-hover table-bordered text-nowrap">
                                    <thead class="text-center">
                                        <tr>
                                            <th rowspan="2" style="vertical-align: middle;">No</th>
                                            <th rowspan="2" style="vertical-align: middle;">Item</th>
                                            <th colspan="2">Kondisi</th>
                                            <th rowspan="2" style="vertical-align: middle;">Remark</th>
                                            <th rowspan="2" style="vertical-align: middle;">Foto Before</th>
                                            <th rowspan="2" style="vertical-align: middle;">Foto After</th>
                                        </tr>
                                        <tr>
                                            <th>Ya</th>
                                            <th>Tidak</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>Air Radiator</td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->air_radiator == 1) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->air_radiator == 0) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td><?= $value->r1 ?></td>
                                            <td><a href="<?= $value->fb1 ?>" data-toggle="lightbox" data-title="Foto Before">
                                                    <img src="<?= $value->fb1 ?>" class="img-size-50" alt="Foto Before"/>
                                                </a></td>
                                            <td><a href="<?= $value->fa1 ?>" data-toggle="lightbox" data-title="Foto After">
                                                    <img src="<?= $value->fa1 ?>" class="img-size-50" alt="Foto After"/>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>Oli Mesin</td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->oli_mesin == 1) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->oli_mesin == 0) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td><?= $value->r2 ?></td>
                                            <td><a href="<?= $value->fb2 ?>" data-toggle="lightbox" data-title="Foto Before">
                                                    <img src="<?= $value->fb2 ?>" class="img-size-50" alt="Foto Before"/>
                                                </a></td>
                                            <td><a href="<?= $value->fa2 ?>" data-toggle="lightbox" data-title="Foto After">
                                                    <img src="<?= $value->fa2 ?>" class="img-size-50" alt="Foto After"/>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>Baterai</td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->baterai == 1) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->baterai == 0) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td><?= $value->r3 ?></td>
                                            <td><a href="<?= $value->fb3 ?>" data-toggle="lightbox" data-title="Foto Before">
                                                    <img src="<?= $value->fb3 ?>" class="img-size-50" alt="Foto Before"/>
                                                </a></td>
                                            <td><a href="<?= $value->fa3 ?>" data-toggle="lightbox" data-title="Foto After">
                                                    <img src="<?= $value->fa3 ?>" class="img-size-50" alt="Foto After"/>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td>Rem</td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->rem == 1) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->rem == 0) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td><?= $value->r4 ?></td>
                                            <td><a href="<?= $value->fb4 ?>" data-toggle="lightbox" data-title="Foto Before">
                                                    <img src="<?= $value->fb4 ?>" class="img-size-50" alt="Foto Before"/>
                                                </a></td>
                                            <td><a href="<?= $value->fa4 ?>" data-toggle="lightbox" data-title="Foto After">
                                                    <img src="<?= $value->fa4 ?>" class="img-size-50" alt="Foto After"/>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td>Saringan Udara</td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->saringan_udara == 1) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->saringan_udara == 0) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td><?= $value->r5 ?></td>
                                            <td><a href="<?= $value->fb5 ?>" data-toggle="lightbox" data-title="Foto Before">
                                                    <img src="<?= $value->fb5 ?>" class="img-size-50" alt="Foto Before"/>
                                                </a></td>
                                            <td><a href="<?= $value->fa5 ?>" data-toggle="lightbox" data-title="Foto After">
                                                    <img src="<?= $value->fa5 ?>" class="img-size-50" alt="Foto After"/>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td>Ban Terpakai</td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->ban_terpakai == 1) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->ban_terpakai == 0) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td><?= $value->r6 ?></td>
                                            <td><a href="<?= $value->fb6 ?>" data-toggle="lightbox" data-title="Foto Before">
                                                    <img src="<?= $value->fb6 ?>" class="img-size-50" alt="Foto Before"/>
                                                </a></td>
                                            <td><a href="<?= $value->fa6 ?>" data-toggle="lightbox" data-title="Foto After">
                                                    <img src="<?= $value->fa6 ?>" class="img-size-50" alt="Foto After"/>
                                                </a></td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td>Ban Serap</td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->ban_serap == 1) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php 
                                                    if ($value->ban_serap == 0) { ?>
                                                        <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                                    <?php }else{ ?>
                                                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                                    <?php }
                                                ?>
                                            </td>
                                            <td><?= $value->r7 ?></td>
                                            <td><a href="<?= $value->fb7 ?>" data-toggle="lightbox" data-title="Foto Before">
                                                    <img src="<?= $value->fb7 ?>" class="img-size-50" alt="Foto Before"/>
                                                </a></td>
                                            <td><a href="<?= $value->fa7 ?>" data-toggle="lightbox" data-title="Foto After">
                                                    <img src="<?= $value->fa7 ?>" class="img-size-50" alt="Foto After"/>
                                                </a></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr style="border: 2px solid;">
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <label>Foto Depan</label>
                                        <a href="<?= $value->f_depan ?>" data-toggle="lightbox" data-title="Foto Depan">
                                        <img src="<?= $value->f_depan ?>" class="img-fluid mb-2" alt="Foto Depan"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="2, 4" data-sort="black sample">
                                        <label>Foto Belakang</label>
                                        <a href="<?= $value->f_belakang ?>" data-toggle="lightbox" data-title="Foto Belakang">
                                        <img src="<?= $value->f_belakang ?>" class="img-fluid mb-2" alt="Foto Belakang"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="3, 4" data-sort="red sample">
                                        <label>Foto Kiri</label>
                                        <a href="<?= $value->f_kiri ?>" data-toggle="lightbox" data-title="Foto Kiri">
                                        <img src="<?= $value->f_kiri ?>" class="img-fluid mb-2" alt="Foto Kiri"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-3" data-category="3, 4" data-sort="red sample">
                                        <label>Foto Kanan</label>
                                        <a href="<?= $value->f_kanan ?>" data-toggle="lightbox" data-title="Foto Kanan">
                                        <img src="<?= $value->f_kanan ?>" class="img-fluid mb-2" alt="Foto Kanan"/>
                                        </a>
                                    </div>
                                </div>
                                <hr style="border: 2px solid;">
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                        <label>Foto Atas</label>
                                        <a href="<?= $value->f_atas ?>" data-toggle="lightbox" data-title="Foto Atas">
                                        <img src="<?= $value->f_atas ?>" class="img-fluid mb-2" alt="Foto Atas"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                        <label>Foto Kolong</label>
                                        <a href="<?= $value->f_kolong ?>" data-toggle="lightbox" data-title="Foto Kolong">
                                        <img src="<?= $value->f_kolong ?>" class="img-fluid mb-2" alt="Foto Kolong"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                        <label>Foto Kabin Kiri</label>
                                        <a href="<?= $value->f_kabinkiri ?>" data-toggle="lightbox" data-title="Foto Kabin Kiri">
                                        <img src="<?= $value->f_kabinkiri ?>" class="img-fluid mb-2" alt="Foto Kabin Kiri"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                                        <label>Foto Kabin Kanan</label>      
                                        <a href="<?= $value->f_kabinkanan ?>" data-toggle="lightbox" data-title="Foto Kabin Kanan">
                                        <img src="<?= $value->f_kabinkanan ?>" class="img-fluid mb-2" alt="Foto Kabin Kanan"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                                        <label>Foto Kabin Tengah</label>
                                        <a href="<?= $value->f_kabintengah ?>" data-toggle="lightbox" data-title="Foto Kabin Tengah">
                                        <img src="<?= $value->f_kabintengah ?>" class="img-fluid mb-2" alt="Foto Kabin Tengah"/>
                                        </a>
                                    </div>
                                    <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                        <label>Foto Kabin Belakang</label>
                                        <a href="<?= $value->f_kabinbelakang ?>" data-toggle="lightbox" data-title="Foto Kabin Belakang">
                                        <img src="<?= $value->f_kabinbelakang ?>" class="img-fluid mb-2" alt="white sample"/>
                                        </a>
                                    </div>
                                </div>
                                <hr style="border: 2px solid;">
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <label>Foto Kilometer</label>
                                        <a href="<?= $value->f_kilometer ?>" data-toggle="lightbox" data-title="Foto Kilometer">
                                        <img src="<?= $value->f_kilometer ?>" class="img-fluid mb-2" alt="Foto Kilometer"/>
                                        </a>
                                    </div>
                                </div>
                                <hr style="border: 2px solid;">
                                <div class="filter-container p-0 row">
                                    <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                                        <label>Remark Body & Kabin : </label>
                                        <?= $value->r8 ?>
                                    </div>
                                </div>
                            </td>
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
<?php foreach ($p2h as $key => $value) { ?>
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

<?php foreach ($p2h as $key => $value) { 
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
<?php foreach ($p2h as $key => $value) { ?>
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