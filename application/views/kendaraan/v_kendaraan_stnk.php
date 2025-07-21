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
    $user = $this->m_user->get_all_data();
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
                        <th>Masa STNK</th>
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
                        <!-- <th>Masa KIR</th> -->
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
        // { "width": "50px"},
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
    'ajax': 'fetchKendaraanStnk',
  });
});
</script>