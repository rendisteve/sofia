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
?>
<!-- general form elements disabled -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form P2H <?= $p2h->plat_nomor.' ('.format_hari_tanggal($p2h->tanggal_p2h).')' ?></h3>
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

                


                // echo form_open_multipart('kendaraan/edit/'.$p2h->id_kendaraan)
            
            ?>
            <div class="row">
                <div class="col-12">
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
                                        if ($p2h->air_radiator == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->air_radiator == 0) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td><?= $p2h->r1 ?></td>
                                <td><a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Before">
                                        <img src="<?= $p2h->fb1 ?>" class="img-size-50" alt="Foto Before"/>
                                    </a></td>
                                <td><a href="<?= $p2h->fa1 ?>" data-toggle="lightbox" data-title="Foto After">
                                        <img src="<?= $p2h->fa1 ?>" class="img-size-50" alt="Foto After"/>
                                    </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>Oli Mesin</td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->oli_mesin == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->oli_mesin == 0) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td><?= $p2h->r2 ?></td>
                                <td><a href="<?= $p2h->fb2 ?>" data-toggle="lightbox" data-title="Foto Before">
                                        <img src="<?= $p2h->fb2 ?>" class="img-size-50" alt="Foto Before"/>
                                    </a></td>
                                <td><a href="<?= $p2h->fa2 ?>" data-toggle="lightbox" data-title="Foto After">
                                        <img src="<?= $p2h->fa2 ?>" class="img-size-50" alt="Foto After"/>
                                    </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>Baterai</td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->baterai == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->baterai == 0) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td><?= $p2h->r3 ?></td>
                                <td><a href="<?= $p2h->fb3 ?>" data-toggle="lightbox" data-title="Foto Before">
                                        <img src="<?= $p2h->fb3 ?>" class="img-size-50" alt="Foto Before"/>
                                    </a></td>
                                <td><a href="<?= $p2h->fa3 ?>" data-toggle="lightbox" data-title="Foto After">
                                        <img src="<?= $p2h->fa3 ?>" class="img-size-50" alt="Foto After"/>
                                    </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">4</td>
                                <td>Rem</td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->rem == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->rem == 0) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td><?= $p2h->r4 ?></td>
                                <td><a href="<?= $p2h->fb4 ?>" data-toggle="lightbox" data-title="Foto Before">
                                        <img src="<?= $p2h->fb4 ?>" class="img-size-50" alt="Foto Before"/>
                                    </a></td>
                                <td><a href="<?= $p2h->fa4 ?>" data-toggle="lightbox" data-title="Foto After">
                                        <img src="<?= $p2h->fa4 ?>" class="img-size-50" alt="Foto After"/>
                                    </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">5</td>
                                <td>Saringan Udara</td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->saringan_udara == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->saringan_udara == 0) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td><?= $p2h->r5 ?></td>
                                <td><a href="<?= $p2h->fb5 ?>" data-toggle="lightbox" data-title="Foto Before">
                                        <img src="<?= $p2h->fb5 ?>" class="img-size-50" alt="Foto Before"/>
                                    </a></td>
                                <td><a href="<?= $p2h->fa5 ?>" data-toggle="lightbox" data-title="Foto After">
                                        <img src="<?= $p2h->fa5 ?>" class="img-size-50" alt="Foto After"/>
                                    </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">6</td>
                                <td>Ban Terpakai</td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->ban_terpakai == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->ban_terpakai == 0) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td><?= $p2h->r6 ?></td>
                                <td><a href="<?= $p2h->fb6 ?>" data-toggle="lightbox" data-title="Foto Before">
                                        <img src="<?= $p2h->fb6 ?>" class="img-size-50" alt="Foto Before"/>
                                    </a></td>
                                <td><a href="<?= $p2h->fa6 ?>" data-toggle="lightbox" data-title="Foto After">
                                        <img src="<?= $p2h->fa6 ?>" class="img-size-50" alt="Foto After"/>
                                    </a></td>
                            </tr>
                            <tr>
                                <td class="text-center">7</td>
                                <td>Ban Serap</td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->ban_serap == 1) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php 
                                        if ($p2h->ban_serap == 0) { ?>
                                            <span class="badge badge-success"><i class="fas fa-check"></i></span>
                                        <?php }else{ ?>
                                            <span class="badge badge-danger"><i class="fas fa-times-circle"></i></span>
                                        <?php }
                                    ?>
                                </td>
                                <td><?= $p2h->r7 ?></td>
                                <td><a href="<?= $p2h->fb7 ?>" data-toggle="lightbox" data-title="Foto Before">
                                        <img src="<?= $p2h->fb7 ?>" class="img-size-50" alt="Foto Before"/>
                                    </a></td>
                                <td><a href="<?= $p2h->fa7 ?>" data-toggle="lightbox" data-title="Foto After">
                                        <img src="<?= $p2h->fa7 ?>" class="img-size-50" alt="Foto After"/>
                                    </a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <hr style="border: 2px solid;">
            <div class="filter-container p-0 row">
                <div class="filtr-item col-sm-3" data-category="1" data-sort="white sample">
                    <label>Foto Depan</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Depan">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Depan"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-3" data-category="2, 4" data-sort="black sample">
                    <label>Foto Belakang</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Belakang">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Belakang"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-3" data-category="3, 4" data-sort="red sample">
                    <label>Foto Kiri</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Kiri">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Kiri"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-3" data-category="3, 4" data-sort="red sample">
                    <label>Foto Kanan</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Kanan">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Kanan"/>
                    </a>
                </div>
            </div>
            <hr style="border: 2px solid;">
            <div class="filter-container p-0 row">
                <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                    <label>Foto Atas</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Atas">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Atas"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                    <label>Foto Kolong</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Kolong">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Kolong"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                    <label>Foto Kabin Kiri</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Kabin Kiri">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Kabin Kiri"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-2" data-category="2, 4" data-sort="black sample">
                    <label>Foto Kabin Kanan</label>      
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Kabin Kanan">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Kabin Kanan"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-2" data-category="3, 4" data-sort="red sample">
                    <label>Foto Kabin Tengah</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Kabin Tengah">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="Foto Kabin Tengah"/>
                    </a>
                </div>
                <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                    <label>Foto Kabin Belakang</label>
                    <a href="<?= $p2h->fb1 ?>" data-toggle="lightbox" data-title="Foto Kabin Belakang">
                    <img src="<?= $p2h->fb1 ?>" class="img-fluid mb-2" alt="white sample"/>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

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