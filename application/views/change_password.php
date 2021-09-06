
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Forgot Password</title>

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
                    if($this->session->flashdata('forgotpassword')){
                     ?>
                     <div class="alert alert-danger text-center">
                      <?php echo $this->session->flashdata('forgotpassword'); ?>
                    </div>
                    <?php
                  }

                  if($this->session->flashdata('reset')){
                   ?>
                   <div class="alert alert-info text-center">
                    <?php echo $this->session->flashdata('reset'); ?>
                  </div>
                  <?php
                }

                ?>
                
                <h1 style="font-size: 14px; font-weight: bold;" class="h4 text-gray-900 mb-4">Change your password! ?</h1>
                <h5><?php echo  $this->session->userdata('reset_email'); ?></h5>
              </div>
              <form class="user" id="Login" action="<?php echo base_url('forgotpass/changePassword');?>" method="post">
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="myInput1" id="password1" name="password1"  placeholder="Enter new password.." >
                  <?= form_error('password1', '<small
                  class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-user" id="myInput2" id="password2" name="password2"  placeholder="Repeat password.." >
                  <?= form_error('password2', '<small
                  class="text-danger pl-3">', '</small>'); ?>
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
            
            <font color="red"><?php echo $this->session->flashdata('Gagallogin') ?></font>
            <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
              Change Password
              
            </button>
          </form>
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
