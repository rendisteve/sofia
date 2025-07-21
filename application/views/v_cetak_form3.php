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
		font: 14px/14px normal Calibri, Arial,sans-serif;
        font-weight: bold;
	}

    .font4 {
		font: 14px/14px normal Calibri, Arial,sans-serif;
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
                        <td class="text-center">F 12</td>
                    </tr>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <div class="row">
            <div class="col-12">
                <table cellpadding="1" cellspacing="1" width="100%" style="border: 1px solid; border-collapse:collapse" rules="none">
                    <thead class="font3">
                        <tr>
                            <td style="border: 0px solid; width: 25px;">&nbsp;</td>
                            <th colspan="5" class="text-center" style="height: 25px;">FORM</th>
                            <td style="border: 0px solid; width: 25px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            <th colspan="5" class="text-center" style="border-bottom: 2px solid; height: 25px;">PERMINTAAN BIAYA OPS</th>
                            <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            <th colspan="5">&nbsp;</th>
                            <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody class="font4">
                        <tr >
                            <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            <td style="border: 0px solid; width: 50px;">&nbsp;</td>
                            <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            <td style="border: 0px solid; width: 200px;">&nbsp;</td>
                            <td style="border: 0px solid; width: 100px;">&nbsp;</td>
                            <td style="border: 0px solid; width: 130px;">&nbsp;</td>
                            <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                        </tr>
                        <?php foreach ($form1 as $key => $value) { ?>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">KEPADA</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;"><?= $value->admin_keuangan?></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">PLAT NO KENDARAAN</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;"><?= $value->plat_nomor?></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">PEMILIK</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;"><?= $value->nama_pemilik?></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">CLUSTER</th>
                                <th class="text-center">:</th>
                                <th class="text-left" style="border-bottom: 1px dotted;"><?= $value->cluster?></th>
                                <td colspan="2" class="text-left" style="border-bottom: 1px dotted;"><?= $value->operator?> (<?= $value->jabatan?>)</td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">NO REKENING</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;"><?= $value->no_rekening?></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">BANK</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;"><?= $value->nama_bank ?></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">DI TRANSFER KEPADA</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;"><?= $value->atas_nama ?></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">JUMLAH</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;">Rp. <?= number_format($value->jumlah,0); ?></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                        <?php } ?>
                        <?php
                            $no = 1;
                            $grand_total = 0; 
                            foreach ($form as $key => $value) { 
                            $tot_harga = $value->volume * $value->harga;
                            $grand_total = $grand_total + $tot_harga;    
                            ?>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted;"><?= $value->barang_jasa; ?> (<?= number_format($value->harga,0); ?>)</td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                        <?php } ?>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">KEPERLUAN</th>
                                <th class="text-center">:</th>
                                <td colspan="3" class="text-left" style="border-bottom: 1px dotted"><?= $value->keperluan ?></th>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th class="text-left">KETERANGAN</th>
                                <th class="text-center">:</th>
                                <td valign="middle"colspan="3" class="text-left" style="border-bottom: 1px dotted"><?= $value->keterangan ?></th>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th colspan="5">&nbsp;</th>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th colspan="5">&nbsp;</th>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <?php foreach ($form1 as $key => $value) { ?>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <td class="text-left" >Pekanbaru, <?= format_hari_tanggal(date('Y-m-d')) ?></td>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="2" class="text-left" >Diperiksa Oleh</td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <td colspan="5">&nbsp;</td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <td colspan="5">&nbsp;</td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <td colspan="5">&nbsp;</td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <td class="text-left" ><b><u><?= $value->admin_kendaraan ?></u></b></td>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="2" class="text-left" ><b><u><?= $value->mgr_support ?></u></b></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <td class="text-left" >Admin Kendaraan</td>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="2" class="text-left" >Manager Support</u></td>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <tr style="height:25px">
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                                <th colspan="5">&nbsp;</th>
                                <td style="border: 0px solid; width: 5px;">&nbsp;</td>
                            </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-12">
                <button onclick="window.print()" class="btn btn-default"><i class="fas fa-print"></i> Print</button>
            </div>
        </div>
    </div>
    <!-- /.invoice -->
</div><!-- /.col -->

<script>
    var css = '@page { size: potrait; }',
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