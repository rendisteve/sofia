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
        <h3 class="card-title">List Gudang</h3>

        <div class="card-tools">
            <button class="btn btn-primary" data-toggle="modal" data-target="#addModal"><i class="fas fa-plus"></i> Tambah</button>
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

            <table class="table table-bordered table-condensed table-hover table-striped" id="table_gudang" width="100%">
                <thead class="text-center">
                    <tr>
                        <th>Action</th>
                        <th>Status</th>
                        <th>Nama Gudang</th>
                        <th>Alamat Gudang</th>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <h4 class="modal-title">Tambah Gudang</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
      </div>

      <form role="form" action="<?php echo base_url('Logistik/createLokasi') ?>" method="post" id="createForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="brand_name">Nama Gudang</label>
            <input type="text" class="form-control" id="nama_gudang" name="nama_gudang" placeholder="Nama Gudang" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="brand_name">Alamat Gudang</label>
            <input type="text" class="form-control" id="alamat_gudang" name="alamat_gudang" placeholder="Alamat Gudang" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="active">Status</label>
            <select class="form-control" id="active" name="active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
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
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit Gudang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Logistik/updateLokasi') ?>" method="post" id="updateForm">

        <div class="modal-body">

          <div class="form-group">
            <label for="edit_brand_name">Nama Gudang</label>
            <input type="text" class="form-control" id="edit_nama_gudang" name="edit_nama_gudang" placeholder="Nama Gudang" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_brand_name">Alamat Gudang</label>
            <input type="text" class="form-control" id="edit_alamat_gudang" name="edit_alamat_gudang" placeholder="Alamat Gudang" autocomplete="off">
          </div>
          <div class="form-group">
            <label for="edit_active">Status</label>
            <select class="form-control" id="edit_active" name="edit_active">
              <option value="1">Active</option>
              <option value="2">Inactive</option>
            </select>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Gudang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" action="<?php echo base_url('Logistik/removeLokasi') ?>" method="post" id="removeForm">
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
  manageTable = $('#table_gudang').DataTable({
    dom: 'Bfrtip',
    "scrollY":        400,
    "scrollX":        true,
    "scrollCollapse": true,
    "paging":         true,
    "fixedColumns":   true,
        buttons: [
            'csv', 'excel', 'print'
        ], 
    'ajax': 'fetchLokasiData',
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
    url: 'fetchLokasiDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#edit_nama_gudang").val(response.nama_gudang);
      $("#edit_alamat_gudang").val(response.alamat);
      $("#edit_active").val(response.active);

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