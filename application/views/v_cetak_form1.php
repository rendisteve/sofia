<style>
    .inner {
        border: 1px solid;
    }

    .font1 {
		font: 8px/14px normal Arial,sans-serif;
	}

    .font2 {
		font: 20px/14px normal Calibri, Arial,sans-serif;
	}

    .font3 {
		font: 11px/14px normal Calibri, Arial,sans-serif;
        font-weight: bold;
	}

    .font4 {
		font: 11px/14px normal Calibri, Arial,sans-serif;
        /* font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;  */
	}
</style>

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
    return "$tanggal $bulan $tahun";
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
    $jam = date( 'H:i:s', strtotime($waktu));
    
    //untuk menampilkan hari, tanggal bulan tahun jam
    //return "$hari, $tanggal $bulan $tahun $jam";

    //untuk menampilkan hari, tanggal bulan tahun
    return "$bulan $tahun";
}
?>
<div class="col-12">
    <!-- Main content -->
    <div class="invoice p-3 mb-3 body">
        <div class="row invoice-info">
            <div class="col-sm-6 invoice-col font1">
                <address>
                <strong>PT.MUARA RIAU</strong><br>
                JL.SM Amin No.169 K , PEKANBARU 28293<br>
                Telp 0761-7608229, Fax : 0761-6700212 email : sekretariat@muarariau.com<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
            </div>
            <!-- /.col -->
            <div class="col-sm-1 invoice-col font2">
                <table border="1" height="40" width="70">
                    <tr>
                        <td class="text-center">F 08</td>
                    </tr>
                </table>
            </div>
            <!-- /.col -->
        </div>

        <div class="row">
            <div class="col-12">
                <table cellpadding="0" cellspacing="0" width="100%" style="border: 1px; " rules="none">
                    <thead class="font3">
                        <tr>
                            <?php
                                foreach ($form1 as $key => $value) { 
                                    if ($value->status_kepemilikan == 1) {
                                        $status_pemilik = 'KANTOR';
                                    }elseif ($value->status_kepemilikan == 2) {
                                        $status_pemilik = 'PEMILIK';
                                    }
                                    $cluster = $value->cluster;
                                    $periode = $value->tgl_transaksi;
                                }
                            ?>
                            <th colspan="14" class="text-center" style="border: 2px solid; height: 25px;">FORM REQUEST SPAREPART KENDARAAN DIBEBANKAN OLEH <?= $status_pemilik ?></th>
                        </tr>
                        <tr>
                            <th colspan="14">&nbsp;</th>
                        </tr>
                        <tr>
                            <th colspan="14">CLUSTER : <?= $cluster; ?> </th>
                        </tr>
                        <tr>
                            <th colspan="14">PERIODE : <?= format_hari_tanggal1($periode); ?></th>
                        </tr>
                        <tr >
                            <th colspan="8" class="text-center" style="border: 1px solid; height: 20px;">STATUS KENDARAAN</th>
                            <th colspan="5" class="text-center" style="border: 1px solid; height: 20px;">SPAREPART YANG DIPERLUKAN</th>
                            <th rowspan="2" class="text-center" style="border: 1px solid; height: 20px;">Keterangan</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">No</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Merk Kendaraan</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Pemilik</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">No Plat</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">KM Awal</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">KM Akhir</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Tgl Terakhir Request</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Operator</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Part Name</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Qty</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Unit</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Est. Harga Satuan</th>
                            <th class="text-center" style="border: 1px solid; padding: 2px;">Total Harga</th>
                        </tr>
                    </thead>
                    <tbody class="font4">
                        <?php
                            $no = 1;
                            $grand_total = 0; 
                            foreach ($form as $key => $value) { 
                            $tot_harga = $value->volume * $value->harga;
                            $grand_total = $grand_total + $tot_harga;  
                            
                            $last_transaksi = $this->m_transaksi->get_data_by_id_kendaraan_limit1a($value->id_kendaraan);
                            ?>
                            <tr>
                                <?php if ($no == 1) { ?>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 30px;"><?= $no ?></td>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 120px;"><?= $value->jenis_kendaraan; ?></td>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 100px;"><?= $value->nama_pemilik; ?></td>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 100px;"><?= $value->plat_nomor; ?></td>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 50px;"><?= $last_transaksi->kilometer_kendaraan; ?></td>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 50px;"><?= $value->kilometer_kendaraan; ?></td>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 100px;"><?= format_hari_tanggal($last_transaksi->tgl_transaksi); ?></td>
                                    <td rowspan="<?= $row ?>" class="text-center" style="border: 1px solid; width: 100px;"><?= $value->operator.' ('.$value->jabatan.')'; ?></td>
                                <?php }
                                if ($no > 1) {

                                } ?> 
                                <td style="border: 1px solid; width: 200px; padding: 2px;"><?= $value->barang_jasa; ?></td>
                                <td class="text-center" style="border: 1px solid; width: 40px;"><?= $value->volume; ?></td>
                                <td class="text-center" style="border: 1px solid; width: 80px;"><?= $value->satuan; ?></td>
                                <td class="text-right" style="border: 1px solid; width: 80px; padding: 2px;"><?= number_format($value->harga,0); ?></td>
                                <td class="text-right" style="border: 1px solid; width: 80px; padding: 2px;"><?= number_format($tot_harga,0); ?></td>
                                <?php if ($no == 1) { ?>
                                    <td rowspan="<?= $row ?>" style="border: 1px solid; width: 200px; padding: 5px;"><?= $value->keterangan;?> </td>
                                <?php }
                                if ($no > 1) {

                                } 
                                $no++;?>
                            </tr>
                                
                        <?php } ?>
                            <tr class="font3">
                                <td colspan="11">&nbsp;</td>
                                <td class="text-right" style="border: 2px solid; width: 80px; padding: 2px;">Total</td>
                                <td class="text-right" style="border: 2px solid; width: 80px; padding: 2px;"><?= number_format($grand_total,0); ?></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <th colspan="14">&nbsp;</th>
                            </tr>
                            <?php foreach ($form1 as $key => $value) { ?>
                            <tr class="font3">
                                <td colspan="11">&nbsp;</td>
                                <td colspan="3" style="border: 2px solid; width: 80px;">Transfer Ke Rek : <?= $value->no_rekening; ?> <?= $value->nama_bank; ?> <?= $value->atas_nama; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-left" >Pekanbaru, <?= format_hari_tanggal(date('Y-m-d')) ?></td>
                                <th colspan="11">&nbsp;</th>
                            </tr>
                            <tr>
                                <th colspan="14">&nbsp;</th>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-left" >Yang Mengajukan</td>
                                <td colspan="5" class="text-left" >Disetujui Oleh</td>
                                <td colspan="4" class="text-left" >Diperiksa Oleh</td>
                                <td colspan="4" class="text-left" >Admin Keuangan</td>
                            </tr>
                            <tr>
                                <th colspan="14">&nbsp;</th>
                            </tr>
                            <tr>
                                <th colspan="14">&nbsp;</th>
                            </tr>
                            <tr>
                                <th colspan="14">&nbsp;</th>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-left" ><b><u><?= $value->admin_kendaraan ?></u></b></td>
                                <td colspan="5" class="text-left" ><b><u><?= $value->mgr_ops ?></u></b></td>
                                <td colspan="4" class="text-left" ><b><u><?= $value->mgr_support ?></u></b></td>
                                <td colspan="4" class="text-left" ><b><u><?= $value->admin_keuangan ?></u></b></td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-left" >Admin Kendaraan</td>
                                <td colspan="5" class="text-left" >Manager Operasional</td>
                                <td colspan="4" class="text-left" >Manager Support</td>
                                <td colspan="4" class="text-left" >Admin Keuangan</td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->
<br>
<div class="col-12">
    <div class="row no-print">
        <div class="col-12">
            <button onclick="window.print()" class="btn btn-info"><i class="fas fa-print"></i> Print</button>
        </div>
    </div>
</div>

<script>
    var css = '@page { size: landscape; }',
    head = document.head || document.getElementsByTagName('head')[0],
    style = document.createElement('style');

style.type = 'text/css';
style.media = 'print';

if (style.styleSheet){
  style.styleSheet.cssText = css;
} else {
  style.appendChild(document.createTextNode(css));
}

head.appendChild(style);
</script>