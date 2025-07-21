<!DOCTYPE html>
<html lang="en">
<head>
    <style>
      marquee{
      font-size: 24px;
      font-weight: 800;
      color: #8ebf42;
      font-family: sans-serif;
      }
      #load{
      width: 100%;
      height: 100%;
      position: fixed;
      text-indent: 100%;
      background: #e0e0e0 url('<?= base_url() ?>assets/img/load.gif') no-repeat center;
      z-index: 1;
      opacity: 0.8;
      background-size: 40%;
      }
    </style>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?= base_url() ?>assets/img/logo_sofia.png"
        style="width: 185px;" alt="logo">
    <title>SOFIA | <?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> -->
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/fontawesome-free/css/all.min.css"> -->
    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css"> -->
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> -->
    <!-- JQVMap -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/jqvmap/jqvmap.min.css"> -->
    <!-- Theme style -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css"> -->
    <!-- overlayScrollbars -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css"> -->
    <!-- Daterange picker -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/daterangepicker/daterangepicker.css"> -->
    <!-- summernote -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/summernote/summernote-bs4.min.css"> -->
    <!-- Select2 -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css"> -->
    <!-- Ekko Lightbox -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/ekko-lightbox/ekko-lightbox.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script> -->

    <!-- DataTables -->
    <!-- <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->

  <!-- //////////////////////////// -->


    <!-- Javascrip -->
    <!-- jQuery -->
    <!-- <script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script> -->
    <!-- Bootstrap 4 -->
    <!-- <script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- AdminLTE App -->
    <!-- <script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script> -->
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="<?= base_url() ?>template/dist/js/demo.js"></script> -->

    <!-- REQUIRED SCRIPTS -->
    <!-- overlayScrollbars -->
    <!-- <script src="<?= base_url() ?>template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->

    <!-- PAGE PLUGINS -->
    <!-- jQuery Mapael -->
    <!-- <script src="<?= base_url() ?>template/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="<?= base_url() ?>template/plugins/raphael/raphael.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/jquery-mapael/maps/usa_states.min.js"></script> -->
    <!-- ChartJS -->
    <!-- <script src="<?= base_url() ?>template/plugins/chart.js/Chart.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> -->
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <!-- <script src="<?= base_url() ?>template/dist/js/pages/dashboard2.js"></script> -->
    <!-- <script src="<?= base_url() ?>template/dist/js/pages/dashboard3.js"></script> -->

    <!-- DataTables  & Plugins -->
    <!-- <script src="<?= base_url() ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/jszip/jszip.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> -->

    <!-- SweetAlert2 -->
    <!-- <link rel="stylesheet" href="<?= base_url()?>template/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css"> -->

    <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>template/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.5/css/dataTables.dateTime.min.css">
  <link rel="stylesheet" href="https://code.highcharts.com/css/highcharts.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/summernote/summernote-bs4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/ekko-lightbox/ekko-lightbox.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"/>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url() ?>template/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
  <link type="text/css" href="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/css/dataTables.checkboxes.css" rel="stylesheet" />

  



<!-- ///////////////////// -->
<!-- Javascrip -->
<!-- jQuery -->
<!-- <script src="<?= base_url() ?>template/plugins/jquery/jquery.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url() ?>template/dist/js/demo.js"></script> -->

<!-- REQUIRED SCRIPTS -->
<!-- overlayScrollbars -->
<script src="<?= base_url() ?>template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url() ?>template/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url() ?>template/plugins/raphael/raphael.min.js"></script>
<script src="<?= base_url() ?>template/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="<?= base_url() ?>template/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url() ?>template/plugins/chart.js/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url() ?>template/dist/js/pages/dashboard2.js"></script> -->
<!-- <script src="<?= base_url() ?>template/dist/js/pages/dashboard3.js"></script> -->

<!-- DataTables  & Plugins -->
<script src="<?= base_url() ?>template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>template/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url() ?>template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url() ?>template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url() ?>template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<!-- Select2 -->
<script src="<?= base_url() ?>template/plugins/select2/js/select2.full.min.js"></script>
<!-- Ekko Lightbox -->
<script src="<?= base_url() ?>template/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>


<!-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> -->

<script src="<?= base_url() ?>template/plugins/daterangepicker/daterangepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.5.5/js/dataTables.dateTime.min.js"></script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js"></script>

    
</head>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<!-- <div id="load">Loading...</div> -->
<div class="d-flex justify-content-center">
  <div id="load">
    <span>Loading...</span>
  </div>
</div>
