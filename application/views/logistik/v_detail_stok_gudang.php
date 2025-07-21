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
        <h3 class="card-title">Stok Gudang</h3>
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

            <table class="table table-bordered table-condensed table-hover table-striped" id="table_barang" width="100%">
                <thead class="text-center">
                    <tr>
                        <th>Penyimpanan</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Spesifikasi</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Min</th>
                        <th>Max</th>
                        <th>Stok</th>
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
        <h4 class="modal-title">Penyimpanan Barang</h4>
        <!-- <p id="message_info"></p> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
        <div class="modal-body">
            <div class="table-responsive-xl responsive" style="overflow-x:auto;">
                <table class="table table-bordered table-hover table-striped" id="table_barang1" width="100%">
                    <thead class="text-center">
                        <tr>
                            <th>Penyimpanan</th>
                            <th>Qty Masuk</th>
                            <th>Qty Keluar</th>
                            <th>Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
        </div>

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
    "fixedColumns":   true,
        buttons: [
            'csv', 'excel', 'print'
        ], 
    'ajax': '<?= base_url('logistik/fetchStokBarangData/').$id; ?>',
    'order': []
  });
});

function detailFunc(id_gudang, id_barang)
{
    manageTable1 = $('#table_barang1').DataTable({
    "scrollY":        400,
    "scrollX":        true,
    "scrollCollapse": true,
    "paging":         true,
    "fixedColumns":   true,
    "bDestroy": true,
    "bSort": false,
    "dom": 'tip',
    "responsive": true,
    "processing": true,
    'language':{ 
       "loadingRecords": "&nbsp;",
       "processing": "Loading..."
    },
    'ajax': '../getPenyimpananBarangID/'+id_gudang+'/'+id_barang,
    'order': []
  });

  $('#detailModal').modal({
    backdrop: 'static',
    });
}
</script>