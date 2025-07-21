<!-- general form elements disabled -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Tambah Kendaraan</h3>
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


                echo form_open_multipart('kendaraan/add');
            
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Plat Nomor</label>
                        <input name="plat_nomor" type="text" class="form-control" placeholder="Plat Nomor" value="<?= set_value('plat_nomor') ?>">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status Kepemilikan</label>
                        <select name="status_kepemilikan" type="text" class="form-control">
                            <option value="">--Pilih Status Kepemilikan--</option>
                            <option value="1">Asset</option>
                            <option value="2">Rental</option>
                            <option value="3">Non Asset</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input name="nama_pemilik" type="text" class="form-control" placeholder="Nama Pemilik" value="<?= set_value('nama_pemilik') ?>">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Kendaraan</label>
                        <input name="jenis_kendaraan" type="text" class="form-control" placeholder="Jenis Kendaraan" value="<?= set_value('jenis_kendaraan') ?>">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" min="0" name="tahun_pembuatan" class="form-control" placeholder="Tahun" value="<?= set_value('tahun_pembuatan') ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="2" ><?= set_value('keterangan') ?></textarea>
                </div>
            </div>

            <hr style="border: 2px solid;">

            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Warna Kendaraan</label>
                        <input name="warna" type="text" class="form-control" placeholder="Warna Kendaraan" value="<?= set_value('warna') ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Bahan Bakar</label>
                        <input name="bahan_bakar" type="text" class="form-control" placeholder="Bahan Bakar" value="<?= set_value('bahan_bakar') ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nomor Rangka</label>
                        <input name="nomor_rangka" type="text" class="form-control" placeholder="Nomor Rangka" value="<?= set_value('nomor_rangka') ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nomor Mesin</label>
                        <input name="nomor_mesin" type="text" class="form-control" placeholder="Nomor Mesin" value="<?= set_value('nomor_mesin') ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nomor BPKB</label>
                        <input name="nomor_bpkb" type="text" class="form-control" placeholder="Nomor BPKB" value="<?= set_value('nomor_bpkb') ?>">
                    </div>
                </div>
            </div>

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
                <div class="col-sm-1">
                    <!-- text input -->
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <select name="bulanstnk" class="form-control">
                            <option value="0">Bulan</option>
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
                            <option value="0">Tahun</option>
                            <?php 
                                $mulai = date('Y');
                                for ($i=$mulai; $i < $mulai + 10; $i++) { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="col-sm-1">
                    <!-- <div class="form-group"> -->
                        <!-- <label>Masa KIR</label> -->
                        <!-- <input id="datetimepicker" width="312" /> -->
                        <!-- <input id="datetimepicker" name="kir" type="text" class="form-control" placeholder="Masa KIR" value="<?= set_value('kir') ?>" readonly> -->
                    <!-- </div> -->
                </div>


                <div class="col-sm-1">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Masa KIR</label>
                        <select name="tanggalkir" class="form-control">
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
                <div class="col-sm-1">
                    <!-- text input -->
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <select name="bulankir" class="form-control">
                            <option value="0">Bulan</option>
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
                            <option value="0">Tahun</option>
                            <?php 
                                $mulai = date('Y');
                                for ($i=$mulai; $i < $mulai + 10; $i++) { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>
            </div>

            <hr style="border: 2px solid;">

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Depan</label>
                        <input type="file" name="foto_depan" class="form-control" id="preview_gambar1" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Belakang</label>
                        <input type="file" name="foto_belakang" class="form-control" id="preview_gambar2" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Kiri</label>
                        <input type="file" name="foto_kiri" class="form-control" id="preview_gambar3" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Kanan</label>
                        <input type="file" name="foto_kanan" class="form-control" id="preview_gambar4" required>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load1" width="300px">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load2" width="300px">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load3" width="300px">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load4" width="300px">
                    </div>
                </div>
            </div>

            <hr style="border: 2px solid;">

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Interior 1</label>
                        <input type="file" name="foto_interior1" class="form-control" id="preview_gambar5" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Interior 2</label>
                        <input type="file" name="foto_interior2" class="form-control" id="preview_gambar6" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Interior 3</label>
                        <input type="file" name="foto_interior3" class="form-control" id="preview_gambar7" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto Interior 4</label>
                        <input type="file" name="foto_interior4" class="form-control" id="preview_gambar8" required>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load5" width="300px">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load6" width="300px">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load7" width="300px">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load8" width="300px">
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a href="<?= base_url('kendaraan')?>" class="btn btn-success btn-sm">Kembali</a>
            </div>

            <?php
                form_close()
            ?>
        </div>
    </div>
</div>

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