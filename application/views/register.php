<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Register Account!</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>assets/vendor/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-5 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">

            <div class="p-5">
              <div class="text-center">
                <?php
                if(validation_errors()){
                  ?>
                  <div class="alert alert-info text-center">
                   <?php echo validation_errors(); ?>
                 </div>
                 <?php
               }
               if($this->session->flashdata('message')){
                 ?>
                 <div class="alert alert-info text-center">
                  <?php echo $this->session->flashdata('message'); ?>
                </div>
                <?php
              } 
              ?>
              <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
            </div>
            <form class="user" method="POST" action="<?php echo base_url().'register/registerakun'; ?>">
             <div class="form-group">
              <input type="text" class="form-control form-control-user" id="nama_lengkap" name="nama_lengkap" value="<?php echo set_value('nama_lengkap'); ?>" placeholder=" Nama Lengkap" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="username" name="username" value="<?php echo set_value('username'); ?>" placeholder=" Username" required >
            </div>
            <div class="form-group">
              <input type="text" class="form-control form-control-user" id="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Email Address" required>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="password" class="form-control form-control-user" id="myInput1" id="password" name="password" placeholder="Password" required>
              </div>
              <div class="col-sm-6">
                <input type="password" class="form-control form-control-user" id="myInput2" id="password_confirm" name="password_confirm"  placeholder="Repeat Password" required>
              </div>
            </div>
            
            <div class="form-group">
              <div class="custom-control custom-checkbox small">
                <input type="checkbox" onclick="myFunction()" class="custom-control-input" id="customCheck">
                <script>
                 function myFunction() {
                   var x = document.getElementById("myInput1");
                   var z = document.getElementById("myInput2");

                   if (x.type === "password") {
                     x.type = "text";
                   } else {
                    x.type = "password";
                  }

                  if (z.type === "password") {
                   z.type = "text";
                 } else {
                  z.type = "password";
                }
              }
            </script>
            <label class="custom-control-label" for="customCheck">Show Password</label>
          </div>
        </div>
        
        <button type="register" name="register" class="btn btn-primary btn-user btn-block">
          Register Account
        </button>

      </form>
      <hr>
      <div class="text-center">
        <a class="small" href="forgot-password.html">Forgot Password?</a>
      </div>
      <div class="text-center">
        <a class="small" href="<?php echo base_url('login'); ?>">Already have an account? Login!</a>
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
