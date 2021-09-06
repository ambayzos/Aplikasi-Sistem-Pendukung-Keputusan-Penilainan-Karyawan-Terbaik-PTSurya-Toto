<div class="page-header">
  <h2>My Profile</h2>
</div>
<div class="col-lg-12">
  <div class="row">
    <div class="errors">
     <?php
     $msg = $this->session->flashdata('message');
     if (isset($msg)) {
      ?>
      <div class="alert alert-success alert-dismissable small">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <?php echo $msg; ?>
      </div>
      <?php
    }
    ?>
  </div>
  <div class="panel panel-default">
    <div class="panel-body" style="font-size: 16px;">

      <div class="row">
        <div class="col-sm-8 col-md-4 text-left"> 
         <div class="thumbnail">
          <img src="<?php echo base_url('assets/img/profile/').$user['image'];?>" class="img-thumbnail"   width="100" height="100" alt="imgae">
          <div class="caption">
           <h4>Nama : <small><?php echo $user['nama_lengkap'];?></small></h4>
           <h4>Username : <small><?php echo $user['username'];?></small></h4>
           <h4>Email : <small><?php echo $user['email'];?></small></h4>
           <h4>Level : <small><?php echo $user['level'];?></small></h4>

           <p><a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModalEdit" role="button">Edit</a>
           </div>
         </div>
       </div>
     </div>

   </div>

 </div>
</div>

<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit My Profile</h4>
      </div>
      <div class="modal-body">
        <?php echo form_open_multipart('user/update_profile');?>
        <!-- <form class="user" action="<?php echo base_url('pengguna/update_profile'); ?>" method="post"> -->
          <div class="form-group row">
            <div class="col-sm-12">
              <div class="row">
                <div class="col-sm-3">
                  <img src="<?php echo base_url('assets/img/profile/').$user['image'];?>" class="img-thumbnail">
                </div>
                <div class="col-sm-9">
                  <input style="font-size: 16px;"  type="file" id="image" name="image" required="masukkan file image">
                </div>
                
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="nama_lengkap" placeholder="Enter Nama Lengkap" name="nama_lengkap"  required="isi nama lengkap" value="<?php echo $user['nama_lengkap'] ?>">
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="username" placeholder="Enter username" name="username"   value="<?php echo $user['username']?>" readonly>
          </div>
          <div class="form-group">
            <input type="text" class="form-control form-control-user" id="email" name="email"  placeholder="Email Address" value="<?php echo $user['email'] ?>" readonly>
          </div>


          <div class="form-group">
            <input type="password" class="form-control form-control-user" id="myInput" name="password" placeholder="Password" value="<?php echo $user['password'] ?>" >
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox small">
             <input type="checkbox" onclick="myFunction()" class="custom-control-input" id="customCheck">
             <script>
               function myFunction() {
                 var x = document.getElementById("myInput");
                 if (x.type === "password") {
                   x.type = "text";
                 } else {
                  x.type = "password";
                }
              }
            </script>
            <label class="custom-control-label" for="customCheck" style="font-size: 16px;">Show Password</label>
          </div>

        </div>
        <input type="hidden" name="id_pengguna" value="<?php echo $user['id_pengguna'] ?>">
        <div class="modal-footer">

          <button class="btn btn-secondary" type="button close" data-dismiss="modal">Cancel</button>

          <button type="submit" class="btn btn-primary" value="pengguna">Simpan</button> 

        </div>
      </form>
    </div>

  </div>
</div>
</div>



</div>

</div>