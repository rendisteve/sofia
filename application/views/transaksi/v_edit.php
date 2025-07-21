<!-- general form elements disabled -->
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Form Update Transaksi</h3>
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


                echo form_open_multipart('transaksi/update_transaksi/'.$transaksi->id_transaksi);
            
            ?>
            <div class="row">
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
                        $this->db->where('tbl_transaksi.id_transaksi', $transaksi->id_transaksi);
                        
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

            <hr style="border: 2px solid;">

            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto 1</label>
                        <input type="file" name="foto1" class="form-control" id="preview_gambar1" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto 2</label>
                        <input type="file" name="foto2" class="form-control" id="preview_gambar2" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto 3</label>
                        <input type="file" name="foto3" class="form-control" id="preview_gambar3" required>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="form-group">
                        <label>Foto 4</label>
                        <input type="file" name="foto4" class="form-control" id="preview_gambar4" required>
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
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a href="<?= base_url('transaksi')?>" class="btn btn-success btn-sm">Kembali</a>
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
</script>