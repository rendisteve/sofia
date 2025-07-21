</div>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<div class="row">
    <div class="col-lg-2 col-6">
    <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3><?= $total_kendaraan?></h3>
                <p>Total Kendaraan</p>

                <h3><?= $total_asset?></h3>
                <p>Asset</p>

                <h3><?= $total_rental?></h3>
                <p>Rental</p>

                <h3><?= $total_nonasset?></h3>
                <p>Non Assset</p>
            </div>
            <div class="icon">
                <i class="fas fa-car-side"></i>
            </div>
            <a href="<?= base_url('kendaraan')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-md-10 col-sm-6 col-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning"><i class="far fa-clock"></i></span>
            
            <div class="info-box-content">
               <span class="info-box-number" id="date_time"></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Alarm</h3>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $alarm_stnk; ?></h3>
                                <p>Alarm STNK</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard"></i>
                            </div>
                            <a href="<?= base_url('kendaraan/stnk')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $alarm_kir?></h3>
                                <p>Alarm KIR</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-clipboard"></i>
                            </div>
                            <a href="<?= base_url('kendaraan/kir')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $alarm_service?></h3>
                                <p>Alarm Service</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <a href="<?= base_url('kendaraan/service/alarm')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $alarm_rental?></h3>
                                <p>Alarm Rental</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                            <a href="<?= base_url('kendaraan/rental')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- 

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>150</h3>

                                <p>Pelanggan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-people-arrows"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $total_kategori?></h3>

                                <p>Kategori</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-list"></i>
                            </div>
                            <a href="<?= base_url('kategori')?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("#load").fadeOut();
    });
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script> -->
<script type="text/javascript">
// var timestamp = '<?=date("d/m/y : H:i:s", time());?>';
// function updateTime(){
//   $('#time').html(Date(timestamp));
//   timestamp++;
// }
// $(function(){
//   setInterval(updateTime, 1000);
// });
function date_time(id)
{
date    = new Date;
tahun   = date.getFullYear();
bulan   = date.getMonth();
tanggal = date.getDate();
hari    = date.getDay();

namabulan = new Array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
namahari  = new Array('Minggu','Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');

h = date.getHours();
if(h<10) { h = "0"+h; }
m = date.getMinutes();
if(m<10) { m = "0"+m; }
s = date.getSeconds();
if(s<10) { s = "0"+s; }

//susun dengan format baru
result = namahari[hari]+', '+tanggal+' '+namabulan[bulan]+' '+tahun+' / '+h+':'+m+':'+s;
document.getElementById(id).innerHTML = result;
setTimeout('date_time("'+id+'");','1000');
}
</script>
<script type="text/javascript">window.onload = date_time('date_time');</script>