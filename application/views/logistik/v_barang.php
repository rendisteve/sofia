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
        <h3 class="card-title">List Barang</h3>

        <div class="card-tools">
            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Tambah</button> -->
            <a href="<?php echo base_url('Logistik/createBarang') ?>" class="btn btn-primary" data-placement="top" title="Tambah Data">Tambah</a>
        </div>
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

            <table class="table table-bordered table-condensed table-hover table-striped" id="table_barang" width="100%">
                <thead class="text-center">
                    <tr>
                        <th>Action</th>
                        <th width= "100px">Kode Barang</th>
                        <th>Qrcode</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th width= "180px">Spesifikasi</th>
                        <th>Kategori</th>
                        <th width= "50px">Satuan</th>
                        <th>Min</th>
                        <th>Max</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="addModal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h4 class="modal-title">Tambah Barang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>

      <form enctype="multipart/form-data" action="<?php echo base_url('Logistik/createBarang') ?>" method="POST" id="createForm">

        <div class="modal-body">
          <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="brand_name">Nama Barang</label>
                <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Nama Barang" autocomplete="off">
              </div>

              <div class="form-group">
                <label for="exampleFormControlTextarea1">Spesifikasi Barang</label>
                <textarea class="form-control" id="spesifikasi_barang" name="spesifikasi_barang" rows="3"></textarea>
              </div>

              <div class="form-group">
                <label for="category">Kategori</label>
                <select class="form-control select_group" id="kategori" name="kategori">
                  <?php foreach ($kategori as $k => $v): ?>
                    <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_kategori'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>

              <div class="form-group">
                <label for="category">Satuan</label>
                <select class="form-control select_group" id="satuan" name="satuan">
                  <?php foreach ($satuan as $s => $v): ?>
                    <option value="<?php echo $v['id'] ?>"><?php echo $v['nama_satuan'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Foto Barang</label>
                <input type="file" name="userfile" class="form-control" id="preview_gambar1" required>
              </div>

              <div class="form-group">
                  <img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load1" width="300px">
              </div>

              
            </div>
          </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>

      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog modal-l" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Cetak Label Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <form role="form" action="<?php echo base_url('Logistik/print_label') ?>" method="post" id="updateForm">
        <div class="modal-body">
          <div class="form-group">
              <label for="brand_name">Kode Barang</label>
              <input type="text" class="form-control" id="edit_kode_barang" name="edit_kode_barang" placeholder="Kode Barang" autocomplete="off">
          </div>
          <!-- <div class="form-group">
              <label for="qty">Jumlah Cetak</label>
              <input type="number" min="0" name="edit_jumlah" id="edit_jumlah" class="form-control" placeholder="Jumlah Cetak">
          </div> -->
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <a id="myLink1" href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print Besar</a>
          <a id="myLink2" href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print Sedang</a>
          <a id="myLink3" href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print Kecil</a>
          <!-- <button type="submit" class="btn btn-primary">Print</button> -->
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Logistik/removeBarang') ?>" method="post" id="removeForm">
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

<script type="text/javascript">
var manageTable;
$(document).ready(function() {
  $("#storeNav").addClass('active');
  // initialize the datatable 
  manageTable = $('#table_barang').DataTable({
    dom: 'Bfrtip',
    "scrollY":        400,
    "scrollX":        true,
    "scrollCollapse": true,
    "paging":         false,
    "fixedColumns":   true,
        buttons: [
            'csv', 'excel', 'print'
        ], 
    'ajax': 'fetchBarangData',
    'order': []
  });

  // submit the create from 
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

          swal({
            title: "Informasi",
            text: response.messages,
            icon: "success",
            timer: "5000",
            buttons: false,
          });


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
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchBarangDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_kode_barang").val(response.kode_barang);
      var link1 = document.getElementById('myLink1');
          link1.setAttribute('href', 'print_label100mm/'+id);
      var link2 = document.getElementById('myLink2');
          link2.setAttribute('href', 'print_label80mm/'+id);
      var link3 = document.getElementById('myLink3');
        link3.setAttribute('href', 'print_label58mm/'+id);

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        // $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {
            success = true;
          }
        }); 
        if(success){ //AND THIS CHANGED
          window.open('')
        }

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
            swal({
              title: "Informasi",
              text: response.messages,
              icon: "success",
              timer: "5000",
              buttons: false,
            });

            // hide the modal
            $("#removeModal").modal('hide');

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
      }); 

      return false;
    });
  }
}
</script>

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