<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">


  <title>
    <?php echo $this->page->generateTitle(); ?>
  </title>


  <?php
  $this->page->generateCss();
  ?>

</head>

<body>

  <div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand navbar-top-links inline" href="#">
          <img  src="<?php echo base_url();?>assets/img/logo.svg"  alt="Toto Indonesia"></a>


        </div>
        <!-- /.navbar-header -->
        <a class="navbar-brand navbar-top-links text-center" href="#" style="margin-top: -5px">
          <h1 style="font-size: 12px; font-weight: bold;">Sistem Pendukung Kemputusan Penilaian Karyawan Terbaik</h1></a>


          <ul class="nav navbar-top-links navbar-right">

            <!-- /.dropdown -->
            <li class="dropdown">
              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= ucwords ($this->fungsi->user_login()->nama_lengkap)?></span>

                <img class="img-profile img-circle img-thumbnail"  src="<?php echo base_url('assets/img/profile/').$this->fungsi->user_login()->image ?>" width="28" height="27">
                <i class="fa fa-caret-down"></i>
              </a>
              <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo base_url('pengguna/my_profile');?>"><i class="fa fa-user fa-fw"></i> My Profile</a>
                </li>


                <li class="divider"></li>
                <li><a href="" data-toggle="modal" data-target="#myModalLogout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
              </ul>
              <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
          </ul>
          <!-- /.navbar-top-links -->


          <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
              <ul class="nav" id="side-menu">

               <li>
                <a href="#"><i class="fa fas fa-cogs fa-fw"></i>Kelola<span class="fa arrow "></span></a>
                <ul class="nav nav-second-level">

                  <li <?php if( $this->uri->segment(1) == 'karyawan'){
                    ?>
                    class="active"
                    <?php
                  }?>>

                  <a href="<?php echo site_url('karyawan');?>"><i class="fa fa-male fa-fw"></i> Karyawan</a>
                </li>

                <li <?php if( $this->uri->segment(1) == 'kriteria'){
                  ?>
                  class="active"
                  <?php
                }?>>

                <a href="<?php echo site_url('kriteria');?>"><i class="fa fa-eye fa-fw"></i> Kriteria</a>

              </li>

              <li <?php if( $this->uri->segment(1) == 'pengguna'){
               ?>
               class="active"
               <?php
             }?>>

             <a href="<?php echo site_url('pengguna');?>"><i class="fa fa-user fa-fw"></i> Pengguna</a>

           </li>
         </ul>
         <!-- /.nav-second-level -->
       </li>

       <li <?php if( $this->uri->segment(1) == 'pengguna'){
         ?>
         class="active"
         <?php
       }?>>

       <a href="<?php echo site_url('pengguna/my_profile');?>"><i class="fa fa-user fa-fw"></i> My Profile</a>
     </li>

     <li <?php if( $this->uri->segment(1) == 'rangking'){
      ?>
      class="active"
      <?php
    }?>
    ><a href="<?php echo site_url('rangking');?>"><i class="fa fa-dashboard fa-fw"></i> Rangking</a>
  </li>

  <li <?php if( $this->uri->segment(1) == 'logout'){
    ?>
    class="active"
    <?php
  }?>
  ><a href="" data-toggle="modal" data-target="#myModalLogout"><i class="fa fad fa-sign-out fa-fw"></i> Logout</a>
</li>




</ul>
</div>
<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>



<!-- Page Content -->
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header"><?php $this->load->view($view,$data);?></h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
  </div>

  <!-- /.container-fluid -->
</div>

<!-- /#page-wrapper -->

<!-- Trigger the modal with a button -->

<div class="modal fade" id="myModalLogout" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ready to Leave?</h4>
      </div>
      <div class="modal-body">
        <p>Pilih "Logout" di bawah ini jika Anda siap untuk mengakhiri sesi Anda saat ini..</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" href="<?php echo site_url('logout');?>">Logout</a>
      </div>
    </div>
  </div>
</div>


</div>

<!-- /#wrapper -->

<script>
  var base_url = "<?php echo site_url();?>";
</script>



<?php
$this->page->generateJs();
?>


</body>

<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span style="font-weight: bold; font-size: 10">Sistem Pendukung Keputusan Penilaian Karyawan Terbaik<br>
      Copyright &copy; SURYA TOTO Indonesia 2020  </span>
    </div>
  </div>
</footer>

</html>
