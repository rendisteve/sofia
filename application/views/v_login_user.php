<!DOCTYPE html>
<style> 
body, html {
  height: 100%;
}

* {
  box-sizing: border-box;
}

.bg-img {
  /* The image used */
  background-image: url("<?= base_url() ?>/assets/img/bg_login.jpg");

  /* Control the height of the image */
  min-height: 380px;

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}

/* Add styles to the form container */
.container {
  position: absolute;
  right: 0;
  margin: 20px;
  max-width: 300px;
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
  input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit button */
.btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.btn:hover {
  opacity: 1;
}
</style>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?= base_url() ?>assets/img/logo_sofia.png"
        style="width: 185px;" alt="logo">
  <title>SOFIA | <?= $title;?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>template/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url()?>template/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page bg-img">
<div class="login-box">
  <div class="login-logo">
    <!-- <a href="<?= base_url()?>"><b>System Operational</b> Fiture Asset</a> -->
    <div class="text-center">
      <img src="<?= base_url() ?>assets/img/logo_sofia.png"
        style="width: 185px;" alt="logo">
      <h4 class="mt-1 mb-5 pb-1 text-white"><b>System Operational</b> Fiture Asset</a></h4>
    </div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Silahkan Login</p>

        <?php
            echo validation_errors('<div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>', '</div>');

            if ($this->session->flashdata('error')){
                echo '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-ban"></i> Alert!</h5>';
                echo $this->session->flashdata('error');
                echo '</div>'; 
            }

            if ($this->session->flashdata('pesan')){
                echo '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> Success!</h5>';
                echo $this->session->flashdata('pesan');
                echo '</div>'; 
            }

            echo form_open('auth/login_user')
        ?>
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
              <!-- <a href="<?= base_url() ?>" class="btn btn-success btn-block">Website</a> -->
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-primary btn-block">Log In</button>
          </div>
          <!-- /.col -->
        </div>
      <?php echo form_close()?>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= base_url()?>template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url()?>template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url()?>template/dist/js/adminlte.min.js"></script>
<script>
  window.setTimeout(function () { 
    $(".alert").fadeTo(500,0).slideUp(500,function () { 
      $(this).remove();
    });
  },3000)
</script>
</body>
</html>