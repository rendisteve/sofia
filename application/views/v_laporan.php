<div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Laporan Harian</h3>
        </div>
        
        <div class="card-body">
            <?php 
                // echo form_open('laporan/lap_harian')
            ?>
            <form action="laporan/lap_harian" method="post" target="_blank">
            <div class="row">
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Tanggal</label>
                        <select name="tanggal" class="form-control">
                            <?php 
                                $mulai = 1;
                                for ($i=$mulai; $i < $mulai + 31; $i++) { 
                                    // $sel = $i == date('Y') ? 'selected="selected"' : '';
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="bulan" class="form-control">
                            <?php 
                                $mulai = 1;
                                for ($i=$mulai; $i < $mulai + 12; $i++) { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="tahun" class="form-control">
                            <?php 
                                $mulai = date('Y') - 5;
                                for ($i=$mulai; $i < $mulai + 8; $i++) { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Proses</button>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Laporan Bulanan</h3>
        
        </div>

        <div class="card-body">
            <?php
                // echo form_open('laporan/lap_bulanan') 
            ?>
            <form action="laporan/lap_bulanan" method="post" target="_blank">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Bulan</label>
                        <select name="bulan" class="form-control">
                            <?php 
                                $mulai = 1;
                                for ($i=$mulai; $i < $mulai + 12; $i++) { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="tahun" class="form-control">
                            <?php 
                                $mulai = date('Y') - 5;
                                for ($i=$mulai; $i < $mulai + 8; $i++) { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Proses</button>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>

<div class="col-md-4">
    <div class="card card-primary">
        <div class="card-header">
        <h3 class="card-title">Laporan Tahunan</h3>

        </div>

        <div class="card-body">
            <?php 
                // echo form_open('laporan/lap_tahunan') 
            ?>
            <form action="laporan/lap_tahunan" method="post" target="_blank">
            <div class="row">
                <div class="col-sm-6">
                    <!-- text input -->
                    <div class="form-group">
                        <label>Tahun</label>
                        <select name="tahun" class="form-control">
                            <?php 
                                $mulai = date('Y') - 5;
                                for ($i=$mulai; $i < $mulai + 8; $i++) { 
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                    
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-sm-12">
                    <!-- text input -->
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-check"></i> Proses</button>
                    </div>
                </div>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>