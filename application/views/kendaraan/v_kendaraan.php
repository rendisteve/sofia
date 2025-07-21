<style>
  .table-condensed{
    font-size: 12px;
  }
  th {
    font-size: 14px;
  }

  div.dt-top-container {
    display: grid;
    grid-template-columns: auto auto auto;
    }

    div.dt-center-in-div {
    margin: 0 auto;
    }

    div.dt-filter-spacer {
    margin: 10px 0;
    }
</style>
<?php
    date_default_timezone_set('Asia/Jakarta');
    $user = $this->m_user->get_all_data_user();
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
            <a href="<?= base_url('kendaraan/add')?>" type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>
            Tambah</a>
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
            <table class="table table-bordered table-condensed" id="table_kendaraan">
                <thead class="text-center">
                    <tr>
                        <th>Action</th>
                        <th>Jatuh Tempo STNK</th>
                        <th>Jatuh Tempo KIR</th>
                        <th>Jatuh Tempo Rental</th>
                        <!-- <th>Jatuh Tempo Service</th> -->
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
                <tbody class="text-center">
    
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>

<!-- Modal add operator -->
<div class="modal fade" id="operator">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Operator</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('Kendaraan/operator') ?>" method="post" id="updateForm">
                <?php
                // echo form_open('kendaraan/operator');
                ?>
                    <div class="form-group">
                        <label>Kendaraan</label>
                        <input name="o_id_kendaraan" id="o_id_kendaraan" hidden>
                        <input type="text" name="o_plat_nomor" id="o_plat_nomor" class="form-control" placeholder="Plat Nomor" required>
                    </div>

                    <div class="form-group">
                        <label>Cluster</label>
                        <input name="cluster" type="text" class="form-control" placeholder="Cluster" value="<?= set_value('cluster') ?>">
                    </div>

                    <div class="form-group">
                        <!-- <label>Nama </label>
                        <input name="operator" type="text" class="form-control" placeholder="Nama" value="<?= set_value('operator') ?>"> -->
                        <label for="operator" class="control-label">Operator</label>
                        <select class="form-control" name="operator" data-plugin="select_hrm" data-placeholder="Operator">
                            <option value=""></option>
                            <?php foreach($user as $operator) {?>
                                <option value="<?php echo $operator->user_id?>"> <?php echo $operator->first_name.' '.$operator->last_name;?></option>
                            <?php } ?>
                        </select>
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

<?php 
// foreach ($kendaraan as $key => $value) { 
    // if ($value->status == 1) { 
?>
    <div class="modal fade" id="operator1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Operator</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form role="form" action="<?php echo base_url('Kendaraan/operator1') ?>" method="post" id="updateForm1">
                    <?php
                    // echo form_open('kendaraan/operator1/'.$value->id_histori);
                    // if ($value->tanggal != "") {
                    //     $string_val = explode('-', $value->tanggal);  
                    // }else{
                    //     $string_val = explode('-', '0000-00-00');
                    // }
                    // $tahun =  $string_val[0];
                    // $bulan =  $string_val[1];
                    // $tanggal =  $string_val[2];

                    ?>
                        <div class="form-group">
                            <label>Kendaraan</label>
                            <input name="id_histori" id="id_histori" hidden>
                            <input name="id_kendaraan" id="id_kendaraan" hidden>
                            <input type="text" name="plat_nomor" id="plat_nomor" class="form-control" placeholder="Plat Nomor" required>
                        </div>

                        <!-- <div class="form-group">
                            <label>Cluster</label>
                            <input name="cluster" id="cluster" type="text" class="form-control" placeholder="Cluster" required>
                        </div> -->

                        <div class="form-group">
                            <label>Cluster</label>
                            <input name="cluster" type="text" class="form-control" placeholder="Cluster" value="<?= set_value('cluster') ?>">
                        </div>

                        <div class="form-group">
                            <!-- <label>Nama </label>
                            <input name="operator" type="text" class="form-control" placeholder="Nama" value="<?= set_value('operator') ?>"> -->
                            <label for="operator" class="control-label">Operator</label>
                            <select class="form-control" name="operator" id="operator" data-plugin="select_hrm" data-placeholder="Operator">
                                <option value=""></option>
                                <?php foreach($user as $operator) {?>
                                    <option value="<?php echo $operator->user_id ?>"><?php echo $operator->first_name.' '.$operator->last_name;?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <!-- <div class="form-group">
                            <label>Jabatan/Posisi </label>
                            <input name="jabatan" id="jabatan" type="text" class="form-control" placeholder="Jabatan/Posisi" required>
                        </div> -->

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
                                            for ($i=$mulai; $i < $mulai + 31; $i++) {  ?>
                                                <option value="<?php echo $i ?>"><?php echo $i;?></option>
                                        <?php } ?>
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
                                            for ($i=$mulai; $i < $mulai + 12; $i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i;?></option>
                                        <?php } ?>
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
                                            for ($i=$mulai; $i < $mulai + 50; $i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i;?></option>
                                        <?php } ?>
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
<?php 
// }
// } 
?>

<!-- /.modal hapus-->
<?php 

// foreach ($kendaraan as $key => $value) { 
?>
<!-- <div class="modal fade" id="delete<?= $value->id ?>">
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
    </div>
</div> -->
<?php 
// } 
?>

<script type="text/javascript">
var manageTable;
$(document).ready(function() {
  $("#storeNav").addClass('active');
  // initialize the datatable 
  manageTable = $('#table_kendaraan').DataTable({
    // dom: 'Bfrtip',
    dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"f><ip>',
    buttons: [ 'csv', 'excel', 'pdf', 'print' ],
    "scrollY":        400,
    "scrollX":        true,
    "scrollCollapse": true,
    "paging":         false,
    "fixedColumns":   true,
    "columnDefs": [{orderable: false, targets: "no-sort"}],
    "bDestroy": true,
    columns : [
        { "width": "60px"},
        { "width": "100px"},
        { "width": "100px"},
        { "width": "100px"},
        { "width": "100px"},
        { "width": "70px"},
        { "width": "100px"},
        { "width": "100px"},
        { "width": "100px"},
        { "width": "100px"},
        { "width": "180px"},
        { "width": "100px"},
        { "width": "200px"},
        { "width": "50px"},
        { "width": "50px"},
        { "width": "120px"},
        { "width": "120px"},
        { "width": "120px"},
        { "width": "150px"},
        { "width": "50px"},
        { "width": "150px"},
        { "width": "50px"},
        { "width": "50px"},
        { "width": "50px"},
        { "width": "50px"},
        { "width": "50px"},
        { "width": "70px"},
        { "width": "70px"},
        { "width": "70px"},
        { "width": "70px"}],
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All']
        ],

        // { "width": "50px", "targets": [13, 14, 19, 21, 22, 23, 24, 25] },
        // { "width": "60px", "targets": [0] },
        // { "width": "70px", "targets": [ 5, 26, 27, 28, 29 ] },
        // { "width": "100px", "targets": [ 1, 2, 3, 4, 6, 7, 8, 9, 11 ] },
        // { "width": "120px", "targets": [ 8, 15, 16, 17 ] },
        // { "width": "150px", "targets": [ 18, 20 ] },
        // { "width": "180px", "targets": [ 10 ] },
        // { "width": "200px", "targets": [ 12 ] },
        // { "className": "text-center", "targets": '_all' }], 
    'ajax': 'Kendaraan/fetchKendaraanData',
  });
});

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: 'Kendaraan/fetchKendaraanDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#o_id_kendaraan").val(response.idkendaraan);
      $("#o_plat_nomor").val(response.plat_nomor);
    //   $("#edit_active").val(response.active);

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
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
              $("#operator").modal('hide');
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

function editFunc1(id)
{ 
  $.ajax({
    url: 'Kendaraan/fetchKendaraanDataById1/'+id,
    type: 'post',
    dataType: 'json',
    success:function(response) {

      $("#id_histori").val(response.id_histori);
      $("#id_kendaraan").val(response.idkendaraan);
      $("#plat_nomor").val(response.plat_nomor);
      $("#cluster").val(response.cluster);
      $("#operator").val(response.operator);
      $("#jabatan").val(response.jabatan);
    //   $("#edit_active").val(response.active);

      // submit the edit from 
      $("#updateForm1").unbind('submit').bind('submit', function() {
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
              $("#operator1").modal('hide');
              // reset the form 
              $("#updateForm1 .form-group").removeClass('has-error').removeClass('has-success');

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
</script>