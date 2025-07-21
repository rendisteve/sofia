</div>
<?php date_default_timezone_set('Asia/Jakarta'); ?>
<?php
$CI = &get_instance();
$CI->load->model('Permission_model');
$role_id = $CI->session->userdata('role_id');
$permissions = $CI->Permission_model->get_user_permissions($role_id);
$permissions = explode(',', $permissions[0]);
?>
<div class="row">
    <div class="col-md-12 col-sm-6 col-3">
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
<?php if (in_array('element_dashboard', $permissions)) : ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Element Logistik</h3>
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $total_gudang; ?></h3>
                                <p>Gudang</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-warehouse"></i>
                            </div>
                            <a href="<?= base_url('logistik/lokasi_gudang')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3><?= $total_penyimpanan?></h3>
                                <p>Penyimpanan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-pallet"></i>
                            </div>
                            <a href="<?= base_url('logistik/penyimpanan')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $total_kategori_barang?></h3>
                                <p>Kategori</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tags"></i>
                            </div>
                            <a href="<?= base_url('logistik/kategori')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>

                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $total_satuan?></h3>
                                <p>Satuan</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-tag"></i>
                            </div>
                            <a href="<?= base_url('logistik/satuan')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
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
<?php endif; ?>

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <!-- /.card-tools -->
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (in_array('total_barang', $permissions)) : ?>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3><?= $total_barang?></h3>
                                <p>Total Barang</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <a href="<?= base_url('logistik/barang')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3><?= $barang_masuk?></h3>
                                <p>Total Barang Masuk</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <a href="<?= base_url('logistik/masuk')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-2 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3><?= $barang_keluar?></h3>
                                <p>Total Barang Keluar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-dolly"></i>
                            </div>
                            <a href="<?= base_url('logistik/keluar')?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (in_array('report_grafik', $permissions)) : ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
            <h3 class="card-title">Report Grafik</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <table border="0" cellspacing="5" cellpadding="5">
                    <tbody>
                        <tr>
                            <td>Per Bulan:</td>
                            <td><input type="text" id="min" name="min"></td>
                        </tr>
                        <tr>
                            <td>Per Tahun:</td>
                            <td><input type="text" id="max" name="max"></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <h3>List Total Harga Barang Masuk</h3>
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <table id="dt-table" class="table table-bordered table-condensed table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Periode</th>
                                <th>Staf/Admin</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach ($graph as $data) { ?>
                                    <tr>
                                        <td><?= $data['waktu'];?></td>
                                        <td><?= $data['first_name'].' '.$data['last_name'];?></td>
                                        <td><?= number_format($data['total'],0,".",",");?></td>
                                    </tr>
                            <?php    }
                            ?>
                            <tr>
                                <td>2024-11-01</td>
                                <td>A</td>
                                <td>1,409,517,397 </td>
                            </tr>
                            <tr>
                                <td>2024-12-01</td>
                                <td>B</td>
                                <td>1,339,180,127</td>
                            </tr>
                            <tr>
                                <td>2025-01-01</td>
                                <td>C</td>
                                <td>324,459,463</td>
                            </tr>
                            <tr>
                                <td>2025-01-01</td>
                                <td>D</td>
                                <td>263,991,379</td>
                            </tr>
                            <tr>
                                <td>2025-01-01</td>
                                <td>E</td>
                                <td>209,288,278</td>
                            </tr>
                            
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div id="chart1"></div>
                    </div>
                </div>

                <br><hr><br>
                <h3>List Total Harga Barang Keluar</h3>
                <div class="row">
                    <div class="col-lg-6 col-6">
                        <table id="dt-table1" class="table table-bordered table-condensed table-hover table-striped">
                                <thead>
                                <tr>
                                    <th>Periode</th>
                                    <th>Staf/Admin</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    foreach ($graph1 as $data) { ?>
                                        <tr>
                                            <td><?= $data['waktu'];?></td>
                                            <td><?= $data['first_name'].' '.$data['last_name'];?></td>
                                            <td><?= number_format($data['total'],0,".",",");?></td>
                                        </tr>
                                <?php    }
                                ?>
                                <tr>
                                    <td>2024-12-01</td>
                                    <td>A</td>
                                    <td>1,409,517,397 </td>
                                </tr>
                                <tr>
                                    <td>2024-10-01</td>
                                    <td>B</td>
                                    <td>1,339,180,127</td>
                                </tr>
                                <tr>
                                    <td>2025-01-01</td>
                                    <td>C</td>
                                    <td>324,459,463</td>
                                </tr>
                                <tr>
                                    <td>2025-02-01</td>
                                    <td>D</td>
                                    <td>263,991,379</td>
                                </tr>
                                <tr>
                                    <td>2025-01-01</td>
                                    <td>E</td>
                                    <td>209,288,278</td>
                                </tr>
                                
                                </tbody>
                            </table>
                    </div>
                    <div class="col-lg-6 col-6">
                        <div id="chart2"></div>
                    </div>  
                </div>
                    
                
                    <!-- <table class="table table-bordered table-condensed table-hover table-striped" id="table_barang" width="100%">
                    <thead class="text-center">
                        <tr>
                            <th>Date</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table> -->
                <!-- <div id="demo-output" style="margin-bottom: 1em;" class="chart-display"></div> -->
                <div id="chart" style="margin-bottom: 1em;" class="chart-display"></div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-2 col-6">
    <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <!-- <h3><?= $total_kendaraan?></h3>
                <p>Total Kendaraan</p> -->

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

                    <!-- <div class="col-lg-2 col-6">
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
                    </div> -->
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

<!-- PIE CHART -->
<!-- <div class="row">
    <div class="col-md-12">
        <div class="card card-danger">
            <div class="card-header">
                <h3 class="card-title">Grafik Total Harga Barang Masuk dan Keluar</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> -->


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js" integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
        let draw = false;

    $(document).ready(function(){
        init();
        
        $("#load").fadeOut();
        // var manageTable;
        // var manageTable1;
        // $("#storeNav").addClass('active');
        // // initialize the datatable 
        // manageTable = $('#table_barang').DataTable({
        //     dom: 'Bfrtip',
        //     "scrollY":        400,
        //     "scrollX":        true,
        //     "scrollCollapse": true,
        //     "paging":         true,
        //     "bDestroy": true,
        //     "fixedColumns":   true,
        //         // buttons: [
        //         //     'csv', 'excel', 'print'
        //         // ],
        //         buttons: [
        //                 {
        //                     extend: 'excelHtml5',
        //                     customize: function (xlsx) {
        //                         var sheet = xlsx.xl.worksheets['sheet1.xml'];
        
        //                         sheet.querySelectorAll('row c[r^="C"]').forEach((el) => {
        //                             el.setAttribute('s', '2');
        //                         });
        //                     }
        //                 }, 'print'
        //             ], 
        //     'ajax': 'dashboard/fetchGudangBarangMasukData',
        //     'order': []
        // });

        // Create DataTable
        // const table = new DataTable('#table_barang');
        
        // Create chart
        // const chart = Highcharts.chart('demo-output', {
        //     chart: {
        //         type: 'pie',
        //         styledMode: true,
        //         backgroundColor: "#ffffff"
        //     },
        //     title: {
        //         text: 'Staff Count Per Position'
        //     },
        //     series: [
        //         {
        //             data: chartData(manageTable)
        //         }
        //     ]
        // });
        
        // // On each draw, update the data in the chart
        // manageTable.on('draw', function () {
        //     chart.series[0].setData(chartData(manageTable));
        // });
        
        // function chartData(manageTable) {
        //     var counts = {};
        
        //     // Count the number of entries for each position
        //     manageTable
        //         .column(1, { search: 'applied' })
        //         .data()
        //         .each(function (val) {
        //             if (counts[val]) {
        //                 counts[val] += 1;
        //             }
        //             else {
        //                 counts[val] = 1;
        //             }
        //         });
        
        //     return Object.entries(counts).map((e) => ({
        //         name: e[0],
        //         y: e[1]
        //     }));
        // };

        function init() {
            // initialize DataTables
            const table = $("#dt-table").DataTable();
            const table1 = $("#dt-table1").DataTable();
            // get table data
            const tableData = getTableData(table);
            const tableData1 = getTableData1(table1);
            // create Highcharts
            createHighcharts(tableData);
            createHighcharts1(tableData1);
            // table events
            setTableEvents(table);
            setTableEvents1(table1);
            let minDate, maxDate;
 
            // Create date inputs
            minDate = new DateTime('#min', {
                format: 'MM-YYYY',
            });
            maxDate = new DateTime('#max', {
                format: 'YYYY'
            });
            
            // DataTables initialisation
            // let table = new DataTable('#table_barang');
            
            // Refilter the table
            // document.querySelectorAll('#min, #min').forEach((el) => {
            //     el.addEventListener('change', () => manageTable.draw());
            // });
            $('#min').on('change', function() {
                let str = $(this).val().split("-");
                var month = str[0];
                var year = str[1];
                filterValue = year + '-' + month; // Format for YYYY-MM
                table.column(0).search(filterValue).draw();
                table1.column(0).search(filterValue).draw();
            });

            $('#max').on('change', function() {
                // let str = $(this).val().split("-");
                // var month = str[0];
                var year = $(this).val();
                filterValue = year; // Format for YYYY-MM
                table.column(0).search(filterValue).draw();
                table1.column(0).search(filterValue).draw();
            });
        };

        function getTableData(table) {
            const dataArray = [],
                countryArray = [],
                populationArray = [];

            // loop table rows
            table.rows({ search: "applied" }).every(function() {
                const data = this.data();
                countryArray.push(data[1]);
                populationArray.push(parseInt(data[2].replace(/\,/g, "")));
            });
            // store all data in dataArray
            dataArray.push(countryArray, populationArray);

            return dataArray;
        }

        function getTableData1(table1) {
            const dataArray = [],
                countryArray = [],
                populationArray = [];

            // loop table rows
            table1.rows({ search: "applied" }).every(function() {
                const data = this.data();
                countryArray.push(data[1]);
                populationArray.push(parseInt(data[2].replace(/\,/g, "")));
            });
            // store all data in dataArray
            dataArray.push(countryArray, populationArray);

            return dataArray;
        }

        function createHighcharts(data) {
            Highcharts.setOptions({
                lang: {
                thousandsSep: ","
                }
            });

            Highcharts.chart("chart1", {
                chart: {
                type: 'pie',
                styledMode: true,
                borderColor: '#ffffff',
                borderWidth: 2
                },
                title: {
                text: "Grafik"
                },
                subtitle: {
                text: "Total Harga Barang Masuk"
                },
                xAxis: [
                {
                    categories: data[0],
                    labels: {
                    rotation: -45
                    }
                }
                ],
                yAxis: [
                {
                    // first yaxis
                    title: {
                    text: "Population (2017)"
                    }
                }
                ],
                series: [
                {
                    name: "Population (2017)",
                    color: "#0071A7",
                    data: data[1],
                }
                ],
                tooltip: {
                formatter: function() {
                    var sliceIndex = this.point.index;
                    var sliceName = this.series.chart.axes[0].categories[sliceIndex];
                    return 'Total Untuk <b>' + sliceName +
                    '</b> : <b>' + this.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</b>';
                }
                },
                plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                    enabled: true,
                    format: '{point.y:,.0f}'
                    }
                }
                },
                legend: {
                enabled: true,
                labelFormatter: function() {
                    var legendIndex = this.index;
                    var legendName = this.series.chart.axes[0].categories[legendIndex];

                    return legendName;
                }
                },
                credits: {
                enabled: false
                },
                noData: {
                style: {
                    fontSize: "16px"
                }
                }
            });
        }

        function createHighcharts1(data) {
            Highcharts.setOptions({
                lang: {
                thousandsSep: ","
                }
            });

            Highcharts.chart("chart2", {
                chart: {
                type: 'pie',
                styledMode: true,
                borderColor: '#ffffff',
                borderWidth: 2
                },
                title: {
                text: "Grafik"
                },
                subtitle: {
                text: "Total Harga Barang Keluar"
                },
                xAxis: [
                {
                    categories: data[0],
                    labels: {
                    rotation: -45
                    }
                }
                ],
                yAxis: [
                {
                    // first yaxis
                    title: {
                    text: "Population (2017)"
                    }
                }
                ],
                series: [
                {
                    name: "Population (2017)",
                    color: "#0071A7",
                    data: data[1],
                }
                ],
                tooltip: {
                formatter: function() {
                    var sliceIndex = this.point.index;
                    var sliceName = this.series.chart.axes[0].categories[sliceIndex];
                    return 'Total Untuk <b>' + sliceName +
                    '</b> : <b>' + this.y.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + '</b>';
                }
                },
                plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    showInLegend: true,
                    dataLabels: {
                    enabled: true,
                    format: '{point.y:,.0f}'
                    }
                }
                },
                legend: {
                enabled: true,
                labelFormatter: function() {
                    var legendIndex = this.index;
                    var legendName = this.series.chart.axes[0].categories[legendIndex];

                    return legendName;
                }
                },
                credits: {
                enabled: false
                },
                noData: {
                style: {
                    fontSize: "16px"
                }
                }
            });
        }

        function setTableEvents(table) {
            // listen for page clicks
            table.on("page", () => {
                draw = true;
            });

            // listen for updates and adjust the chart accordingly
            table.on("draw", () => {
                if (draw) {
                draw = false;
                } else {
                const tableData = getTableData(table);
                createHighcharts(tableData);
                }
            });
        }

        function setTableEvents1(table1) {
            // listen for page clicks
            table1.on("page", () => {
                draw = true;
            });

            // listen for updates and adjust the chart accordingly
            table1.on("draw", () => {
                if (draw) {
                draw = false;
                } else {
                const tableData1 = getTableData1(table1);
                createHighcharts1(tableData1);
                }
            });
        }
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

// var donutDataMasuk = {
//     labels: [
//         <?php
//         if (count($graph)>0) {
//             foreach ($graph as $data) {
//             echo "'" .$data['first_name'].' '.$data['last_name']. "',";
//             }
//         }
//         ?>
//     ],
//     datasets: [{
//         label: 'Total Harga Barang Masuk',
//         backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
//         borderColor: '##93C3D2',
//         data: [
//             <?php
//             if (count($graph)>0) {
//                 foreach ($graph as $data) {
//                 echo $data['total'] . ", ";
//                 }
//             }
//             ?>
//         ],
//         datalabels: {
//             // color: 'white',
//             // // rotation: 90,
//             // font: {
//             //     weight: 'fold'
//             // },
//             // formatter: function(value, context) {
//             //     if(parseInt(value) >= 1000){
//             //         return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
//             //     } else {
//             //         return + value;
//             //     }
//             // },
//             // borderColor: 'white',
//             // borderRadius: 25,
//             // borderWidth: 2,
//             labels: {
//                 value: {
//                     align: 'bottom',
//                     weight: 'fold',
//                     color: 'black',
//                     backgroundColor: function(ctx) {
//                     var value = ctx.dataset.data[ctx.dataIndex];
//                     return value > 50 ? 'white' : null;
//                     },
//                     borderColor: 'white',
//                     borderWidth: 2,
//                     borderRadius: 4,
//                     formatter: function(value, ctx) {
//                         if(parseInt(value) >= 1000){
//                             return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
//                         } else {
//                             return + value;
//                         }
//                     },
//                     padding: 4
//                 }
//             }
//         }
//     }],
//     options: {
//         plugins: {
//             tooltip: {
//                 callbacks: {
//                     label: function (tooltipItem) {
//                         return numeral(tooltipItem.parsed.y).format('$0.0,00');
//                     }
//                 }
//             }
//         }
//     }
// }
// //-------------
// //- PIE CHART -
// //-------------
// // Get context with jQuery - using jQuery's .get() method.
// var pieChartCanvas = $('#pieChartMasuk').get(0).getContext('2d')
// var pieData        = donutDataMasuk;
// var pieOptions     = {
//     maintainAspectRatio : false,
//     responsive : true,
//     plugins: {
//             legend: {
//                 position: 'bottom',
//             },
//             title: {
//                 display: true,
//                 text: 'Grafik Total Harga Barang Masuk',
//                 font: {
//                         size: 14,
//                         weight: 'bold'
//                     }
//             }
//         }
// }
// //Create pie or douhnut chart
// // You can switch between pie and douhnut using the method below.
// new Chart(pieChartCanvas, {
//     type: 'pie',
//     data: pieData,
//     options: pieOptions,
//     plugins: [ChartDataLabels]
// });

// var donutDataKeluar = {
//     labels: [
//         <?php
//         if (count($graph1)>0) {
//             foreach ($graph1 as $data) {
//             echo "'" .$data['first_name'].' '.$data['last_name']. "',";
//             }
//         }
//         ?>
//     ],
//     datasets: [{
//         label: 'Total Harga Barang Keluar',
//         backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
//         borderColor: '##93C3D2',
//         data: [
//             <?php
//             if (count($graph1)>0) {
//                 foreach ($graph1 as $data) {
//                 echo $data['total'] . ", ";
//                 }
//             }
//             ?>
//         ],
//         datalabels: {
//             labels: {
//                 value: {
//                     align: 'bottom',
//                     weight: 'fold',
//                     color: 'black',
//                     backgroundColor: function(ctx) {
//                     var value = ctx.dataset.data[ctx.dataIndex];
//                     return value > 50 ? 'white' : null;
//                     },
//                     borderColor: 'white',
//                     borderWidth: 2,
//                     borderRadius: 4,
//                     formatter: function(value, ctx) {
//                         if(parseInt(value) >= 1000){
//                             return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
//                         } else {
//                             return + value;
//                         }
//                     },
//                     padding: 4
//                 }
//             }
//         }
//     }],
//     options: {
//         plugins: {
//             tooltip: {
//                 callbacks: {
//                     label: function (tooltipItem) {
//                         return numeral(tooltipItem.parsed.y).format('$0.0,00');

//                     }
//                 }
//             }
//         }
//     }
// }
// //-------------
// //- PIE CHART -
// //-------------
// // Get context with jQuery - using jQuery's .get() method.
// var pieChartCanvas = $('#pieChartKeluar').get(0).getContext('2d')
// var pieData        = donutDataKeluar;
// var pieOptions     = {
//     maintainAspectRatio : false,
//     responsive : true,
//     plugins: {
//             legend: {
//                 position: 'bottom',
//             },
//             title: {
//                 display: true,
//                 text: 'Grafik Total Harga Barang Keluar',
//                 font: {
//                         size: 14,
//                         weight: 'bold'
//                     }
//             }
//         }
// }
// //Create pie or douhnut chart
// // You can switch between pie and douhnut using the method below.
// new Chart(pieChartCanvas, {
//     type: 'pie',
//     data: pieData,
//     options: pieOptions,
//     plugins: [ChartDataLabels]
// })
</script>
<script type="text/javascript">window.onload = date_time('date_time');</script>