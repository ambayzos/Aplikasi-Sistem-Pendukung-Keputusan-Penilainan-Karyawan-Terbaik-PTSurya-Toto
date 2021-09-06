
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login SPK</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>assets/vendor/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <?php
                    if($this->session->flashdata('message')){
                     ?>
                     <div class="alert alert-info text-center">
                      <?php echo $this->session->flashdata('message'); ?>
                    </div>
                    <?php
                  }

                  if($this->session->flashdata('fail')){
                   ?>
                   <div class="alert alert-danger text-center">
                    <?php echo $this->session->flashdata('fail'); ?>
                  </div>
                  <?php
                }
                ?>
                <img class="text-gray-900 mb-4" style="width:30%; height: 7%;" src="<?php echo base_url();?>assets/img/logo.svg" alt="totoindonesia">
                <h1 style="font-size: 14px; font-weight: bold;" class="h4 text-gray-900 mb-4">Sistem Pendukung Keputusan <br> Penilaian Karyawan Terbaik</h1>
              </div>
              <form class="user" id="Login" action="<?php echo base_url('login');?>" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" name="username"  placeholder="Enter username..." required value="">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                </div>
                <font color="red"><?php echo $this->session->flashdata('Gagallogin') ?></font>
                <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                  Login
                  
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url ('forgotpass/forgotpassword'); ?>">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('register');?>">Create an Account!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

</div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url();?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url();?>assets/vendor/js/sb-admin-2.min.js"></script>

</body>

</html>
