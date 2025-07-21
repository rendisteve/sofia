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
?>
<div class="col-12">
    <!-- Main content -->
    <div class="invoice p-3 mb-3 body">
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
                                }
                            ?>
                            <th colspan="14" class="text-center" style="border: 2px solid; height: 25px;">LAMPIRAN FOTO PERINTAH BAYAR LAIN LAIN <?= $value->plat_nomor;?> TANGGAL <?= format_hari_tanggal($value->tgl_transaksi);?></th>
                        </tr>
                        <tr>
                            <th colspan="14">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody class="font4">
                        <?php
                            foreach ($form1 as $key => $value) { 
                            ?>
                            <tr >
                                <th class="text-center" style="border: 1px solid; height: 20px;">FOTO 1</th>
                                <th class="text-center" style="border: 1px solid; height: 20px;">FOTO 2</th>
                            </tr>
                            <tr>
                                <?php 
                                    if ($value->foto1 == '') { ?>
                                        <td class="text-center" style="border: 1px solid;"><img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load8" width="200px"></td>
                                    <?php }else{ ?>
                                        <td class="text-center" style="border: 1px solid; padding: 5px"><img src="<?= base_url('assets/gambar/lampiran_transaksi/'.$value->foto1)?>" id="gambar_load8" width="100%"></td>
                            
                                    <?php } ?>
                                    <?php 
                                    if ($value->foto1 == '') { ?>
                                        <td class="text-center" style="border: 1px solid;"><img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load8" width="200px"></td>
                                    <?php }else{ ?>
                                        <td class="text-center" style="border: 1px solid; padding: 5px;"><img src="<?= base_url('assets/gambar/lampiran_transaksi/'.$value->foto2)?>" id="gambar_load8" width="100%"></td>
                            
                                    <?php } ?>
                            
                            <tr>
                                <th colspan="2" class="text-center" style="height: 20px;">&nbsp;</th>
                            </tr>
                            <tr>
                                <th class="text-center" style="border: 1px solid; height: 20px;">FOTO 3</th>
                                <th class="text-center" style="border: 1px solid; height: 20px;">FOTO 4</th>
                            </tr>
                            <tr>
                                <?php
                                if ($value->foto1 == '') { ?>
                                    <td class="text-center" style="border: 1px solid;"><img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load8" width="200px"></td>
                                <?php }else{ ?>
                                    <td class="text-center" style="border: 1px solid; padding: 5px;"><img src="<?= base_url('assets/gambar/lampiran_transaksi/'.$value->foto3)?>" id="gambar_load8" width="100%"></td>
                        
                                <?php } ?>
                                <?php 
                                if ($value->foto1 == '') { ?>
                                    <td class="text-center" style="border: 1px solid;"><img src="<?= base_url('assets/gambar/noimage.png')?>" id="gambar_load8" width="200px"></td>
                                <?php }else{ ?>
                                    <td class="text-center" style="border: 1px solid; padding: 5px;"><img src="<?= base_url('assets/gambar/lampiran_transaksi/'.$value->foto4)?>" id="gambar_load8" width="100%"></td>
                        
                                <?php } ?>
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