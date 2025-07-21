</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
  
<!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Dept. Support
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2023 PT. Muara Riau
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- <script src="<?=base_url()?>template/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="<?=base_url()?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="<?=base_url()?>template/dist/js/adminlte.min.js"></script> -->
<script>
    $(document).ready(function(){
        $("#load").fadeOut();
    });
</script>
<script>
   $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
  });
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

    $(function () {
        $("#example2").DataTable({
        "scrollY":        400,
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns":   true,
        // "fixedColumns":  {left: 5},
        "columnDefs": [{orderable: false, targets: "no-sort"}],
        "bDestroy": true,
        "columns" : [
            { "width": "5px"},
            { "width": "60px"},
            { "width": "100px"},
            { "width": "100px"},
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
            { "width": "50px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "70px"},
            { "width": "70px"},
            { "width": "70px"},
            { "width": "70px"}
        ],
        "buttons": ["csv", "excel", "colvis"],
        "lengthMenu": [10, 25, 50, 100 ]
        }).buttons().container().appendTo('#example3A_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#example2A").DataTable({
        "scrollY":        400,
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns":   true,
        // "fixedColumns":  {left: 5},
        "columnDefs": [{orderable: false, targets: "no-sort"}],
        "bDestroy": true,
        "columns" : [
            { "width": "5px"},
            { "width": "60px"},
            { "width": "100px"},
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
            { "width": "50px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "70px"},
            { "width": "70px"},
            { "width": "70px"},
            { "width": "70px"}
        ],
        "buttons": ["csv", "excel", "colvis"],
        "lengthMenu": [10, 25, 50, 100 ]
        }).buttons().container().appendTo('#example3A_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#examplep2h").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        // "buttons": ["csv", "excel", "colvis"],
        "lengthMenu": [5, 10, 50, 100 ]
        }).buttons().container().appendTo('#examplep2h_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#examplep2h1").DataTable({
        "responsive": true, "lengthChange": true, "autoWidth": false,
        // "buttons": ["csv", "excel", "colvis"],
        "lengthMenu": [5, 10, 50, 100 ]
        }).buttons().container().appendTo('#examplep2h1_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#example3").DataTable({
        "scrollY":        400,
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns":   true,
        // "fixedColumns":  {left: 5},
        "columnDefs": [{orderable: false, targets: "no-sort"}],
        "bDestroy": true,
        "columns" : [
            { "width": "5px"},
            { "width": "60px"},
            { "width": "80px"},
            { "width": "80px"},
            { "width": "80px"},
            { "width": "150px"},
            { "width": "100px"},
            { "width": "70px"},
            { "width": "100px"},
            { "width": "50px"},
            { "width": "250px"},
            { "width": "250px"},
            { "width": "80px"},
            { "width": "100px"},
            { "width": "120px"},
            { "width": "120px"},
            { "width": "120px"}
        ],
        "buttons": ["csv", "excel", "colvis"],
        "lengthMenu": [5, 10, 25, 50, 100 ]
        }).buttons().container().appendTo('#example3A_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#example3A").DataTable({
        "scrollY":        400,
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns":   true,
        // "fixedColumns":  {left: 5},
        "columnDefs": [{orderable: false, targets: "no-sort"}],
        "bDestroy": true,
        "columns" : [
            { "width": "5px"},
            { "width": "80px"},
            { "width": "80px"},
            { "width": "80px"},
            { "width": "100px"},
            { "width": "50px"},
            { "width": "250px"},
            { "width": "20px"},
            { "width": "20px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "250px"},
            { "width": "250px"},
            { "width": "100px"},
            // { "width": "50px"},
            { "width": "120px"},
            { "width": "120px"},
            { "width": "120px"}
        ],
        "buttons": ["csv", "excel", "colvis"],
        "lengthMenu": [5, 10, 25, 50, 100 ]
        }).buttons().container().appendTo('#example3a_wrapper .col-md-6:eq(0)');
    });

    $(function () {
        $("#example3B").DataTable({
        "scrollY":        400,
        "scrollX":        true,
        "scrollCollapse": true,
        "paging":         true,
        "fixedColumns":   true,
        // "fixedColumns":  {left: 5},
        "columnDefs": [{orderable: false, targets: "no-sort"}],
        "bDestroy": true,
        "columns" : [
            { "width": "5px"},
            { "width": "80px"},
            { "width": "80px"},
            { "width": "80px"},
            { "width": "100px"},
            { "width": "50px"},
            { "width": "250px"},
            { "width": "20px"},
            { "width": "20px"},
            { "width": "50px"},
            { "width": "50px"},
            { "width": "250px"},
            { "width": "250px"},
            { "width": "100px"},
            { "width": "50px"},
            { "width": "120px"},
            { "width": "120px"},
            { "width": "120px"}
        ],
        "buttons": ["csv", "excel", "colvis"],
        "lengthMenu": [5, 10, 25, 50, 100 ]
        }).buttons().container().appendTo('#example3B_wrapper .col-md-6:eq(0)');
    });


</script>

<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    // $('.filter-container').filterizr({gutterPixels: 3});
    // $('.btn[data-filter]').on('click', function() {
    //   $('.btn[data-filter]').removeClass('active');
    //   $(this).addClass('active');
    // });
  })
</script>

<script>
  window.setTimeout(function () { 
    $(".alert").fadeTo(500,0).slideUp(500,function () { 
      $(this).remove();
    });
  },3000)
</script>
</body>
</html>