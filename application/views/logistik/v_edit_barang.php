<style>
  /* .table-condensed{
    font-size: 14px;
  }
  th {
    font-size: 16px;
  } */
</style>
<?php
    date_default_timezone_set('Asia/Jakarta');
    // $user = $this->m_user->get_all_data();
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
        <h3 class="card-title">Form Edit Barang</h3>

        <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="messages"></div>
          
            <?php if($this->session->flashdata('success')): ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i>
                <?php echo $this->session->flashdata('success'); ?>
                </h5>
              </div>
            <?php elseif($this->session->flashdata('error')): ?>
              <div class="alert alert-error alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="bi bi-x-circle-fill"></i>
                <?php echo $this->session->flashdata('error'); ?>
                </h5>
              </div>
            <?php endif; ?>

            <?php
              if (isset($error_upload)) {
                  echo '<div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h5><i class="icon fas fa-info"></i>'.$error_upload.'<h5></div>';
              }
            ?>

            <form role="form" action="<?php echo base_url('Logistik/updateBarang/'.$data['id']) ?>" method="post" id="updateForm">

              <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="brand_name">Nama Barang</label>
                      <input type="text" class="form-control" id="edit_nama_barang" name="edit_nama_barang" placeholder="Nama Barang" autocomplete="off" value="<?= $data['nama_barang']?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleFormControlTextarea1">Spesifikasi Barang</label>
                      <textarea class="form-control" id="edit_spesifikasi_barang" name="edit_spesifikasi_barang" rows="3"><?= $data['spesifikasi']?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="category">Kategori</label>
                      <select class="form-control select_group" id="edit_kategori" name="edit_kategori">
                        <option value="<?= $data_kategori['id'] ?>"><?= $data_kategori['nama_kategori'] ?></option>
                        <?php foreach ($kategori as $k => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_kategori'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>

                    <div class="form-group">
                      <label for="category">Satuan</label>
                      <select class="form-control select_group" id="edit_satuan" name="edit_satuan">
                        <option value="<?php echo $data_satuan['id'] ?>"><?php echo $data_satuan['nama_satuan'] ?></option>
                        <?php foreach ($satuan as $s => $v): ?>
                          <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_satuan'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>

                    <div class="form-group">
                        <label for="min_qty">Min Stok</label>
                        <input type="number" min="0" name="edit_min" id="edit_min" class="form-control" placeholder="Min Stok" value="<?= $data['min_qty']?>">
                    </div>

                    <div class="form-group">
                      <label for="qty">Max Stok</label>
                      <input type="number" min="0" name="edit_max" id="edit_max" class="form-control" placeholder="Max Stok" value="<?= $data['max_qty']?>">
                  </div>

                  <!-- <div class="form-group">
                      <label for="qty">Stok</label>
                      <input type="number" min="0" name="edit_qty" id="edit_qty" class="form-control" placeholder="Stok" value="<?= $data['qty']?>">
                  </div> -->
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Foto Barang</label>
                      <input type="file" name="edit_userfile" class="form-control" id="edit_preview_gambar1">
                    </div>

                    <div class="form-group">
                        <a href=<?= base_url('/assets/gambar_barang/'.$data['foto_barang'])?> data-toggle="lightbox" data-title="Foto Barang">
                        <img src="<?= base_url('assets/gambar_barang/'.$data['foto_barang'])?>" id="edit_gambar_load1" width="300px">
                            </a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> -->
                <a href="<?php echo base_url('Logistik/barang') ?>" class="btn btn-danger">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan perubahan</button>
              </div>

            </form>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
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

  $("#preview_gambar1").change(function() {
      bacaGambar1(this); 
  });


  function editbacaGambar1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $("#edit_gambar_load1").attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
          
      }
  }

  $("#edit_preview_gambar1").change(function() {
      editbacaGambar1(this); 
  });
</script>