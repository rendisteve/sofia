<style>
  /* .table-condensed{
    font-size: 14px;
  }
  th {
    font-size: 16px;
  } */
    /* table {page-break-before: always;  
        font-size: 100px;} 
    tr{page-break-inside: avoid;  
        page-break-after: auto;}   */
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

    $CI = &get_instance();
    $CI->load->model('Permission_model');
    $role_id = $CI->session->userdata('role_id');
?>
<div class="col-md-12">
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">List Barang Keluar Gudang</h3>

        <div class="card-tools">
            <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#addModal" data-backdrop="static" data-keyboard="false"><i class="fas fa-plus"></i> Tambah</button> -->
            <a href="<?php echo base_url('Logistik/create_barang_masuk') ?>" class="btn btn-primary" data-placement="top" title="Tambah Data">Tambah</a>
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

            <table border="0" cellspacing="5" cellpadding="5">
                <tbody>
                    <tr>
                        <td>Mulai Tanggal:</td>
                        <td><input type="text" id="min" name="min"></td>
                    
                        <td>Sampai Tanggal:</td>
                        <td><input type="text" id="max" name="max"></td>
                    </tr>
                </tbody>
            </table>
            
            <table class="table table-bordered table-condensed table-hover table-striped" id="table_barang" width="100%">
                <thead class="text-center">
                    <tr>
                        <th>Date</th>
                        <th>Tanggal</th>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Qty</th>
                        <?php
                            if ($role_id !=  "7") { ?>
                                <th>Harga</th>
                                <th>Total</th>
                        <?php }
                        ?>
                        <th>Dari Gudang</th>
                        <th>Dari Penyimpanan</th>
                        <th>Keperluan</th>
                        <th>Object</th>
                        <!-- <th>Tower</th>
                        <th>Genset</th>
                        <th>Excavator</th>
                        <th>Hauler</th>
                        <th>Kendaraan Air</th> -->
                        <th>Keterangan</th>
                        <th>Staff/Admin</th>
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

<div class="modal fade" tabindex="-1" role="dialog" id="detailModal">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Barang Masuk</h4>
        <!-- <p id="message_info"></p> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <!-- <form role="form" action="<?php echo base_url('Logistik/updateBarangMasuk') ?>" method="post" id="validasiForm"> -->
      <form role="form" method="post" id="validasiForm">
        <div class="modal-body">
            <div class="table-responsive-xl responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="table_barang1" width="100%">
                    <thead class="text-center">
                        <tr>
                            <th>ACTION</th>
                            <th>STATUS</th>
                            <th>QR CODE</th>
                            <th>KODE BARANG</th>
                            <th style="width: auto;">NAMA BARANG</th>
                            <th>SPESIFIKASI</th>
                            <th>KATEGORI</th>
                            <th>SATUAN</th>
                            <th>QTY</th>
                            <th>GUDANG</th>
                            <th>PENYIMPANAN</th>
                            <th>KETERANGAN</th>
                            <th>STAFF/ADMIN</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          <!-- <button type="button" class="btn btn-primary" id="btn_update">Validasi</button> -->
          <a id="myLink1" href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print Besar</a>
          <a id="myLink2" href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print Sedang</a>
          <a id="myLink3" href="#" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print Kecil</a>
        </div>
      </form>



    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
var manageTable;
var manageTable1;
$(document).ready(function() {
  $("#storeNav").addClass('active');
  // initialize the datatable 
  manageTable = $('#table_barang').DataTable({
    dom: 'Bfrtip',
    "scrollY":        400,
    "scrollX":        true,
    "scrollCollapse": true,
    "paging":         true,
    "bDestroy": true,
    "fixedColumns":   true,
        // buttons: [
        //     'csv', 'excel', 'print'
        // ], 
        buttons: [
                {
                    extend: 'excelHtml5',
                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
 
                        sheet.querySelectorAll('row c[r^="C"]').forEach((el) => {
                            el.setAttribute('s', '2');
                        });
                    }
                }, 'print'
            ], 
    'ajax': 'fetchGudangBarangKeluarData',
    'order': [],
    columnDefs: [{ visible: false, targets: 0 }]
  });

    let minDate, maxDate;
 
    // Custom filtering function which will search data in column four between two values
    $('#table_barang').DataTable.ext.search.push(function (settings, data, dataIndex) {
        let min = minDate.val();
        let max = maxDate.val();
        let date = new Date(data[0]);
    
        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    });
    
    // Create date inputs
    minDate = new DateTime('#min', {
        format: 'DD-MM-YYYY'
    });
    maxDate = new DateTime('#max', {
        format: 'DD-MM-YYYY'
    });
    
    // DataTables initialisation
    // let table = new DataTable('#table_barang');
    
    // Refilter the table
    document.querySelectorAll('#min, #max').forEach((el) => {
        el.addEventListener('change', () => manageTable.draw());
    });
  
});

function detailFunc(id)
{
    $('#message_info').html(id); 
    manageTable1 = $('#table_barang1').DataTable({
    "scrollY":        400,
    "scrollX":        true,
    "scrollCollapse": true,
    "paging":         true,
    "fixedColumns":   true,
    "bDestroy": true,
    "bSort": false,
    dom: 'Bfrtip',
        buttons: [
            {
                extend: 'print',
                exportOptions: {stripHtml: false, columns: [2]},
                customize: function ( win ) {
                    $(win.document.body)
                        .css( 'font-size', '10pt' );
            /*            .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'    
                        ); */

                    $(win.document.body).find( 'table' )
                        .addClass( 'compact' )
                        .css( 'font-size', 'inherit' )
                        .width('100%');
                }
            }
        ], 
    "responsive": true,
    "processing": true,

    'columnDefs': [
         {
            'targets': 0,
            'checkboxes': {
               'selectRow': true
            }
         }
      ],
      'select': {
         'style': 'multi'
      },
    'language':{ 
       "loadingRecords": "&nbsp;",
       "processing": "Loading..."
    },
    'ajax': 'getBarangMasukGudangID/'+id,
    'order': []
  });
    var link1 = document.getElementById('myLink1');
        link1.setAttribute('href', 'print_label_gudang100mm/'+id);
    var link2 = document.getElementById('myLink2');
        link2.setAttribute('href', 'print_label_gudang80mm/'+id);
    var link3 = document.getElementById('myLink3');
        link3.setAttribute('href', 'print_label_gudang58mm/'+id);

  $('#detailModal').modal({
    backdrop: 'static',
    });

    // $('#select_all').click(function(e) {
    //     if ($(this).is(":checked")) {
    //         $('.select_all_item').prop('checked', true);
    //     } else {
    //         $('.select_all_item').prop('checked', false);
    //     }
    // });
}

// Handle form submission event
$("#table_barang1").on('change',"input[type='checkbox']",function(e){
// $('#btn_update').on('click', function(e){
    var form = $('validasiForm');

    var rows_selected = manageTable1.column(0).checkboxes.selected();

    // Iterate over all selected checkboxes
    $.each(rows_selected, function(index, rowId){
        // Create a hidden element
        $(form).append(
            $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'id[]')
            .val(rowId)
        );
    });

    if ($('#validasiForm input[type="checkbox"]:checked'.length)) {
        var new_selection = rows_selected.join("||");
        // var new_selection = rows_selected;
        var string = new_selection;
        // alert(string);
        $.ajax({
            url: "updateBarangMasuk",
            type: "post",
            data: { string:string }, 
            dataType: 'json',
                success:function(response) {

                    manageTable1.ajax.reload(null, false); 

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
                    // $("#removeModal").modal('hide');

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
    }else{
        swal({
            title: "Informasi",
            text: "Belum ada yang dipilih",
            icon: "warning",
            timer: "5000",
            buttons: false
        });
    }
    $('input[name = "id\[\]"]', form).remove();
    e.preventDefault();
});

function validasiFunc(id)
{
    $.ajax({
    url: "updateBarangMasuk",
    type: "post",
    data: { store_id:id }, 
    dataType: 'json',
        success:function(response) {

            manageTable1.ajax.reload(null, false); 

            // if(response.success === true) {
            // // $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            // //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            // //   '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            // // '</div>');
            // swal({
            //     title: "Informasi",
            //     text: response.messages,
            //     icon: "success",
            //     timer: "5000",
            //     buttons: false,
            // });

            // // hide the modal
            // // $("#removeModal").modal('hide');

            // } else {

            // // $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
            // //   '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            // //   '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            // // '</div>'); 

            // swal({
            //     title: "Informasi",
            //     text: response.messages,
            //     icon: "error",
            //     timer: "5000",
            //     buttons: false,
            //     });
            // }
        }
    }); 

    $('#detailModal').modal('show');


    return false;
}

$('#btn-submit1').on('click', function(e){
   e.preventDefault();

   var data = table.$('input[type="checkbox"]').serializeArray();

   // Include extra data if necessary
   // data.push({'name': 'extra_param', 'value': 'extra_value'});

   $.ajax({
      url: '/path/to/your/script.php',
      data: data
   }).done(function(response){
      console.log('Response', response);
   });
});

$('#validasiForm1').on('submit', function(e){
   e.preventDefault();

   var data = manageTable1.$('input[type="checkbox"]').serializeArray();

   // Include extra data if necessary
   // data.push({'name': 'extra_param', 'value': 'extra_value'});

   alert(data.push({'name': 'extra_param', 'value': 'extra_value'}));

//    $.ajax({
//       url: form.attr('action'),
//       data: data
//    }).done(function(response){
//       console.log('Response', response);
//    });
});

// Handle form submission event
$('#frm-example1').on('submit', function(e){
    var form = this;

    var rows_selected = table.column(0).checkboxes.selected();

    // Iterate over all selected checkboxes
    $.each(rows_selected, function(index, rowId){
        // Create a hidden element
        $(form).append(
            $('<input>')
            .attr('type', 'hidden')
            .attr('name', 'id[]')
            .val(rowId)
        );
    });
});
</script>