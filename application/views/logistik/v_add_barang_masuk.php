<style>
  .table-condensed{
    font-size: 14px;
  }
  th {
    font-size: 16px;
  }
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
        <h3 class="card-title">Form Barang Masuk</h3>

        <div class="card-tools">
            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Tambah</button> -->
            <!-- <a href="<?php echo base_url('Logistik/createBarang') ?>" class="btn btn-primary" data-placement="top" title="Tambah Data">Tambah</a> -->
        </div>
        <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div id="messages"></div>
          
            <?php
                $success    = $this->session->flashdata('success');
                $error      = $this->session->flashdata('error');
                $warning    = $this->session->flashdata('warning');
            ?>  
            <?php if ($success) { ?>
                <script>
                    swal(
                        "Berhasil!",
                        "<?php echo $success ?>",
                        "success"
                    )
                </script>
            <?php } ?>
            
            <?php if ($error) { ?>
                <script>
                    swal(
                        "Gagal!",
                        "<?php echo $error ?>",
                        "error"
                    )
                </script>
            <?php } ?>

            <?php
                // echo form_open_multipart('Logistik/add_cart');
                // echo form_hidden('redirect_page', str_replace('index.php/','',current_url()));
            ?>
            <form enctype="multipart/form-data" action="<?php echo base_url('Logistik/add_cart_in') ?>" method="POST" id="createForm">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <video id="previewKamera" style="width: 300px;height: 300px;"></video>
                        <select id="pilihKamera" style="max-width:400px"></select>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="brand_name">Kode Barang</label>
                        <input type="text" id="hasilscan" name="kode_barang" class="form-control" placeholder="Kode Barang">
                        <button type="button" id="btn_scan" class="btn btn-primary"  onclick="initScanner()" style="display: none;">Scan</button>
                        <button type="button" id="btn_clear" class="btn btn-danger">Bersihkan</button>
                    </div>
                    <div class="form-group">
                        <label for="brand_name">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" autocomplete="off" disabled value="<?= set_value('nama_barang') ?>">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Spesifikasi Barang</label>
                        <textarea class="form-control" id="spesifikasi_barang" name="spesifikasi_barang" rows="3" disabled></textarea>
                    </div>
                    <div class="form-group">
                        <label for="category">Kategori</label>
                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Kategori Barang" autocomplete="off" disabled>
                    </div>
                    <div class="form-group">
                        <label for="category">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" placeholder="Satuan Barang" autocomplete="off" disabled>
                    </div>
                    
                </div>
                <div class="col-sm-3">
                    
                    <div class="form-group">
                        <label>Foto Barang</label>
                        <img id="gambar_load" width="300px">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="qty">Volume/QTY</label>
                        <input type="number" min="0" name="volume" class="form-control" placeholder="Volume/QTY" value="<?= set_value('volume') ?>">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="category">Gudang</label>
                        <select class="form-control select_group" id="gudang" name="gudang">
                            <option value="">Gudang</option>
                            <?php foreach ($gudang as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_gudang'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="category">Detail Lokasi</label>
                        <select class="form-control select_group" id="detail_lokasi" name="detail_lokasi">
                            <option value="">Detail Lokasi</option>
                            <?php foreach ($detail_lokasi as $k => $v): ?>
                            <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_penyimpanan'] ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <button type="submit" class="btn-sm btn-primary btn-flat"><i class="fas fa-save"></i> Tambah</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                <?php echo form_close(); ?>

                <table class="table table-bordered table-hover table-striped" id="table_keranjang"  width="100%">
                    <thead class="text-center">
                        <tr>
                            <th width="100px">Nama Barang/Jasa</th>
                            <th width="10px">Volume/Qty</th>
                            <th width="10px">Satuan</th>
                            <th width="10px">Kategori</th>
                            <th width="50px">Gudang</th>
                            <th width="50px">Detail Lokasi</th>
                            <th width="50px">Keterangan</th>
                            <th width="10px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <label id="total"></label>

                </div>
            </div>
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
                            <!-- <form enctype="multipart/form-data" action="<?php echo base_url('Logistik/clearCart') ?>" method="POST" id="clearForm1"> -->
                            <?php 
                                echo form_open_multipart('Logistik/clearCart');
                                echo form_hidden('redirect_page', str_replace('index.php/','',current_url())); 
                            ?>
                                
                            <button type="submit" class="btn-sm btn-danger btn-flat"><i class="fas fa-trash"></i> Hapus Semua</button>
                            <!-- <a href="<?= base_url('transaksi/clear/'.$kendaraan->id_kendaraan)?>" class="btn-sm btn-danger btn-flat"><i class="fas fa-sync"></i> Kosongkan Rincian</a> -->
                            <!-- <a href="<?= base_url('belanja/cekout')?>" class="btn-sm btn-success btn-flat"><i class="fas fa-check-square"></i> Check Out</a> -->
                            <?php 
                                echo form_close(); 
                            ?>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
            // echo form_open_multipart('transaksi/simpan_transaksi'); 
            ?>
            <hr style="border: 2px solid;"> 
            <?php 
                echo form_open_multipart('Logistik/create_barang_masuk');
                echo form_hidden('redirect_page', str_replace('index.php/','',current_url())); 
            ?>
                <div class="row">
                    <div class="col-sm-2">
                        <!-- text input -->
                        <div class="form-group">
                            <label>Tanggal Input</label>
                            <button type="button" class="btn btn-primary btn-rounded"><i class="fas fa-calendar"></i> &nbsp;<?= date('d/M/Y') ?></button>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <!-- text input -->
                        <div class="form-group">
                            <label>No Inventaris</label>
                            <input type="text" name="kode_inventaris" class="form-control" placeholder="No Inventaris">
                        </div>
                    </div>
                </div>    
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                    <a href="<?= base_url('Logistik/barang_masuk')?>" class="btn btn-success btn-sm">Kembali</a>
                </div>
            </form>

            <?php
                // form_close();
            ?>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Qty</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Logistik/updateCartIn') ?>" method="post" id="updateForm">

        <div class="modal-body">

            <div class="form-group">
                <label for="qty">Volume/QTY</label>
                <input type="number" min="0" name="edit_volume" id="edit_volume" class="form-control" placeholder="Volume/QTY">
            </div>
            <div class="form-group">
                <label for="edit_active">Gudang</label>
                <select class="form-control" id="edit_gudang" name="edit_gudang">
                    <?php foreach ($gudang as $k => $v): ?>
                        <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_gudang'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Detail Lokasi</label>
                <textarea class="form-control" id="edit_detail_lokasi" name="edit_detail_lokasi" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Keterangan</label>
                <textarea class="form-control" id="edit_keterangan" name="edit_keterangan" rows="3"></textarea>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus dari keranjang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Logistik/removeCart') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p>Apakah data ini akan dihapus?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script> -->

<script type="text/javascript">
        var manageTable;
    $(document).ready(function(){
        // $('#hasilscan').val("").focus();
        $('#hasilscan').keyup(function(e){
        var tex = $(this).val();
        if(tex !=="" || e.keyCode===13){
            $('#hasilscan').val(tex).focus();
            cari();
            // $.ajax({
            // type: 'POST',
            // //   url: 'cari.php',
            // url: 'fetchBarangDataByKode/'+tex,
            // //   data: {"hasilscan":tex},
            // dataType: 'json',
            // beforeSend:function(response) {
            //     $('#message_info').html("Sedang memproses data, silahkan tunggu...");
            //     swal({
            //         title:"", 
            //         text:"Loading...",
            //         icon: "<?= base_url() ?>assets/img/load.gif",
            //         buttons: false,      
            //         closeOnClickOutside: false,
            //         // timer: 3000,
            //         //icon: "success"
            //     });
            // },
            // success:function(response) {
            //     swal.close();
            //     $('#message_info').html('');
            //     $("#kode_barang").val(response.kode_barang);
            //     $("#nama_barang").val(response.nama_barang);
            //     $("#spesifikasi_barang").val(response.spesifikasi);
            //     $("#kategori").val(response.kategori);
            //     $("#satuan").val(response.satuan);
            //     var image = document.getElementById('gambar_load'); 
            //         image.src="https://ptmuarariau.com/sofia/assets/gambar_barang/"+response.foto_barang;
            // }
            // });
        }
        // if(tex !=="" && e.keyCode===13){
        //     $('#hasilscan').val(tex).focus();
        //     $.ajax({
        //     type: 'POST',
        //     //   url: 'cari.php',
        //     url: 'fetchBarangDataByKode/'+tex,
        //     //   data: {"hasilscan":tex},
        //     dataType: 'json',
        //     beforeSend:function(response) {
        //         $('#message_info').html("Sedang memproses data, silahkan tunggu...");
        //     },
        //     success:function(response) {
        //         $('#message_info').html('');
        //         $("#kode_barang").val(response.kode_barang);
        //         $("#nama_barang").val(response.nama_barang);
        //         $("#spesifikasi_barang").val(response.spesifikasi);
        //         $("#kategori").val(response.kategori);
        //         $("#satuan").val(response.satuan);
        //         var image = document.getElementById('gambar_load'); 
        //             image.src="https://ptmuarariau.com/sofia/assets/gambar_barang/"+response.foto_barang;
        //     }
        //     });
        // }
        e.preventDefault();
        });
        $('#btn_clear').click(function(){
            $('#hasilscan').val("").focus();
        });

        manageTable = $('#table_keranjang').DataTable({
            "scrollY":        400,
            "scrollX":        true,
            "scrollCollapse": true,
            "paging":         true,
            "fixedColumns":   true,
            'ajax': 'fetchCartData',
            'ordering': false
        });
        $("#createForm").unbind('submit').on('submit', function() {
            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success:function(response) {

                manageTable.ajax.reload(null, false); 

                if(response.success === true) {
                // $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                //   '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                // '</div>');

                // swal({
                //     title: "Informasi",
                //     text: response.messages,
                //     icon: "success",
                //     timer: "5000",
                //     buttons: false,
                // });
                initScanner();


                // hide the modal
                $("#addModal").modal('hide');

                // reset the form
                $("#createForm")[0].reset();
                $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

                } else {

                if(response.messages instanceof Object) {
                    $.each(response.messages, function(index, value) {
                    var id = $("#"+index);

                    id.closest('.form-group')
                    .removeClass('has-error')
                    .removeClass('has-success')
                    .addClass(value.length > 0 ? 'has-error' : 'has-success');
                    
                    id.after(value);

                    });
                } else {
                    // $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                    //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                    //   '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                    // '</div>');
                    swal({
                        title: "Informasi",
                        text: response.messages,
                        icon: "error",
                        timer: "5000",
                        buttons: false,
                    });
                }
                }
            }
            }); 

            return false;
        });
    });


    // edit function
    function editFunc(id){ 
        $.ajax({
            url: 'fetchCartDataById/'+id,
            type: 'post',
            dataType: 'json',
            success:function(response) {

                $("#edit_volume").val(response.qty);
                $("#edit_gudang").val(response.id_gudang);
                $("#edit_detail_lokasi").val(response.detail_lokasi);
                $("#edit_keterangan").val(response.keterangan);

                // submit the edit from 
                $("#updateForm").unbind('submit').bind('submit', function() {
                    var form = $(this);

                    // remove the text-danger
                    $(".text-danger").remove();

                    $.ajax({
                    url: form.attr('action') + '/' + id,
                    type: form.attr('method'),
                    data: form.serialize(), // /converting the form data into array and sending it to server
                    dataType: 'json',
                    success:function(response) {

                        manageTable.ajax.reload(null, false); 

                        if(response.success === true) {
                        // $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                        //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        //   '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        // '</div>');

                        swal({
                            title: "Informasi",
                            text: response.messages,
                            icon: "success",
                            timer: "5000",
                            buttons: false,
                        });

                        // hide the modal
                        $("#editModal").modal('hide');
                        // reset the form 
                        $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

                        } else {

                        if(response.messages instanceof Object) {
                            $.each(response.messages, function(index, value) {
                            var id = $("#"+index);

                            id.closest('.form-group')
                            .removeClass('has-error')
                            .removeClass('has-success')
                            .addClass(value.length > 0 ? 'has-error' : 'has-success');
                            
                            id.after(value);

                            });
                        } else {
                            // $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                            //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                            //   '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                            // '</div>');

                            swal({
                            title: "Informasi",
                            text: response.messages,
                            icon: "error",
                            timer: "5000",
                            buttons: false,
                            });
                        }
                        }
                    }
                    }); 

                    return false;
                });

            }
        });
    }
    // remove functions 
    function removeFunc(id)
    {
        if(id) {
            $("#removeForm").on('submit', function() {

            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: { store_id:id }, 
                dataType: 'json',
                success:function(response) {

                    manageTable.ajax.reload(null, false); 

                    if(response.success === true) {
                        // $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                        //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        //   '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        // '</div>');
                        // hide the modal
                        $("#removeModal").modal('hide');

                    } else {

                        // $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                        //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        //   '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                        // '</div>'); 
                    }
                }
            }); 

            return false;
            });
        }
    }

    // clear functions 
    function clearFunc(id)
    {
        if(id) {
            $("#removeForm").on('submit', function() {

            var form = $(this);

            // remove the text-danger
            $(".text-danger").remove();

            $.ajax({
                url: form.attr('action'),
                type: form.attr('method'),
                data: { store_id:id }, 
                dataType: 'json',
                success:function(response) {

                    manageTable.ajax.reload(null, false); 

                    if(response.success === true) {
                        // $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                        //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        //   '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
                        // '</div>');
                        // hide the modal
                        $("#removeModal").modal('hide');

                    } else {

                        // $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                        //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                        //   '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                        // '</div>'); 
                    }
                }
            }); 

            return false;
            });
        }
    }

    function cari() {       
        var tex = document.getElementById("hasilscan").value;
        if(tex !==""){
            // document.getElementById("hasilscan").val(tex).focus();
            $.ajax({
            type: 'POST',
            //   url: 'cari.php',
            url: 'fetchBarangDataByKode/'+tex,
            //   data: {"hasilscan":tex},
            dataType: 'json',
            beforeSend:function(response) {
                // $('#message_info').html("Sedang memproses data, silahkan tunggu...");
                swal({
                    title:"", 
                    text:"Sedang memproses data, silahkan tunggu...",
                    showLoaderOnConfirm: true,
                    showCancelButton: true,
                    // icon: "<?= base_url() ?>assets/img/load.gif",
                    buttons: false,      
                    closeOnClickOutside: false,
                    timer: 30000,
                    //icon: "success"
                });
                
            },
            success:function(response) {
                swal.close()
                $('#message_info').html('');
                $("#kode_barang").val(response.kode_barang);
                $("#nama_barang").val(response.nama_barang);
                $("#spesifikasi_barang").val(response.spesifikasi);
                $("#kategori").val(response.kategori);
                $("#satuan").val(response.satuan);
                var image = document.getElementById('gambar_load'); 
                    image.src="https://ptmuarariau.com/sofia/assets/gambar_barang/"+response.foto_barang;
            },
            error: function(response){
                playSound2();
                swal({
                    title: "Informasi",
                    text: "Data tidak ditemukan",
                    icon: "error",
                    timer: "3000",
                    buttons: false,
                });
            }
            });
        }
    }

    function playSound1() {
    var audio = new Audio('http://codeskulptor-demos.commondatastorage.googleapis.com/GalaxyInvaders/alien_shoot.wav');
        audio.play();
    }

    function playSound2() {
    var audio = new Audio('http://commondatastorage.googleapis.com/codeskulptor-assets/jump.ogg');
        audio.play();
    }
</script>

<script>
    let selectedDeviceId = null;
    const codeReader = new ZXing.BrowserMultiFormatReader();
    const sourceSelect = $("#pilihKamera");

    $(document).on('change','#pilihKamera',function(){
        selectedDeviceId = $(this).val();
        if(codeReader){
            codeReader.reset()
            initScanner()
        }
    })

    function initScanner() {
        codeReader
        .listVideoInputDevices()
        .then(videoInputDevices => {
            videoInputDevices.forEach(device =>
                console.log(`${device.label}, ${device.deviceId}`)
            );

            if(videoInputDevices.length > 0){
                
                if(selectedDeviceId == null){
                    if(videoInputDevices.length > 1){
                        selectedDeviceId = videoInputDevices[1].deviceId
                    } else {
                        selectedDeviceId = videoInputDevices[0].deviceId
                    }
                }
                
                
                if (videoInputDevices.length >= 1) {
                    sourceSelect.html('');
                    videoInputDevices.forEach((element) => {
                        const sourceOption = document.createElement('option')
                        sourceOption.text = element.label
                        sourceOption.value = element.deviceId
                        if(element.deviceId == selectedDeviceId){
                            sourceOption.selected = 'selected';
                        }
                        sourceSelect.append(sourceOption)
                    })
            
                }

                codeReader
                    .decodeOnceFromVideoDevice(selectedDeviceId, 'previewKamera')
                    .then(result => {

                            //hasil scan
                            console.log(result.text)
                            $("#hasilscan").val(result.text);
                            playSound1();
                            cari();
                            document.getElementById('btn_scan').style.display = 'block';
                        
                            if(codeReader){
                                codeReader.reset()
                            }
                    })
                    .catch(err => console.error(err));
                
            } else {
                alert("Camera not found!")
            }
        })
        .catch(err => console.error(err));
    }


    if (navigator.mediaDevices) {
        

        initScanner()
        

    } else {
        alert('Cannot access camera.');
    }
    
</script>