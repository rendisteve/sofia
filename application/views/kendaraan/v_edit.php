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
            <h3 class="card-title">Form Edit Kendaraan</h3>
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

                


                echo form_open_multipart('kendaraan/edit/'.$kendaraan->id_kendaraan)
            
            ?>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Plat Nomor</label>
                        <input name="plat_nomor" type="text" class="form-control" placeholder="Plat Nomor" value="<?= $kendaraan->plat_nomor ?>">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Status Kepemilikan</label>
                        <select name="status_kepemilikan" type="text" class="form-control">
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
                            <option value="<?= $kendaraan->status_kepemilikan ?>"><?= $status_kepemilikan ?></option>
                            <option value="1">Asset</option>
                            <option value="2">Rental</option>
                            <option value="3">Non Asset</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Nama Pemilik</label>
                        <input name="nama_pemilik" type="text" class="form-control" placeholder="Nama Pemilik" value="<?= $kendaraan->nama_pemilik ?>">
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Jenis Kendaraan</label>
                        <input name="jenis_kendaraan" type="text" class="form-control" placeholder="Jenis Kendaraan" value="<?= $kendaraan->jenis_kendaraan ?>">
                    </div>
                </div>
                <div class="col-sm-1">
                    <div class="form-group">
                        <label>Tahun</label>
                        <input type="number" min="0" name="tahun_pembuatan" class="form-control" placeholder="Tahun" value="<?= $kendaraan->tahun_pembuatan ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label>Keterangan</label>
                    <textarea name="keterangan" class="form-control" placeholder="Keterangan" rows="2" ><?= $kendaraan->keterangan ?></textarea>
                </div>
            </div>

            <hr style="border: 2px solid;">

            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Warna Kendaraan</label>
                        <input name="warna" type="text" class="form-control" placeholder="Warna Kendaraan" value="<?= $kendaraan->warna ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Bahan Bakar</label>
                        <input name="bahan_bakar" type="text" class="form-control" placeholder="Bahan Bakar" value="<?= $kendaraan->bahan_bakar ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nomor Rangka</label>
                        <input name="nomor_rangka" type="text" class="form-control" placeholder="Nomor Rangka" value="<?= $kendaraan->nomor_rangka ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nomor Mesin</label>
                        <input name="nomor_mesin" type="text" class="form-control" placeholder="Nomor Mesin" value="<?= $kendaraan->nomor_mesin ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Nomor BPKB</label>
                        <input name="nomor_bpkb" type="text" class="form-control" placeholder="Nomor BPKB" value="<?= $kendaraan->nomor_bpkb ?>">
                    </div>
                </div>
            </div>

            <div class="row">
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

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm" name="submit" value="save">Simpan</button>
                <a href="<?= base_url('kendaraan')?>" class="btn btn-success btn-sm">Kembali</a>
            </div>

            <?php
                // form_close();
            ?>
            <hr style="border: 2px solid;">
            
            <div class="row">
                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Depan</label>
                            <input type="file" name="foto_depan" class="form-control" id="preview_gambar1">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_depan)?>" id="gambar_load1" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload1">Upload</button>
                    </div>
                </div>

                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Belakang</label>
                            <input type="file" name="foto_belakang" class="form-control" id="preview_gambar2">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_belakang)?>" id="gambar_load2" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload2">Upload</button>
                    </div>
                </div>

                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Kiri</label>
                            <input type="file" name="foto_kiri" class="form-control" id="preview_gambar3">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_kiri)?>" id="gambar_load3" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload3">Upload</button>
                    </div>
                </div>

                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Kanan</label>
                            <input type="file" name="foto_kanan" class="form-control" id="preview_gambar4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_kanan)?>" id="gambar_load4" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload4">Upload</button>
                    </div>
                </div>
            </div>

            <hr style="border: 2px solid;">

            <div class="row">
                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Interior 1</label>
                            <input type="file" name="foto_interior1" class="form-control" id="preview_gambar5">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_interior1)?>" id="gambar_load5" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload5">Upload</button>
                    </div>
                </div>

                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Interior 2</label>
                            <input type="file" name="foto_interior2" class="form-control" id="preview_gambar6">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_interior2)?>" id="gambar_load6" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload6">Upload</button>
                    </div>
                </div>

                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Interior 3</label>
                            <input type="file" name="foto_interior3" class="form-control" id="preview_gambar7">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_interior3)?>" id="gambar_load7" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload7">Upload</button>
                    </div>
                </div>

                <div class="col-sm-3">
                    <?php
                        echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label>Foto Interior 4</label>
                            <input type="file" name="foto_interior4" class="form-control" id="preview_gambar8">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <img src="<?= base_url('assets/gambar/'.$kendaraan->foto_interior4)?>" id="gambar_load8" width="300px">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm btn-block" name="submit" value="upload8">Upload</button>
                    </div>

                    <?php
                        form_close()
                    ?>
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