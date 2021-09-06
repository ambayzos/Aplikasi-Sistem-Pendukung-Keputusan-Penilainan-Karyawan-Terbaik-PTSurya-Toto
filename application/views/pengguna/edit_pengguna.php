<div class="page-header">
  <h2>Edit Pengguna</h2>
</div>
<div class="col-md-12">
  <div class="row">
    <div class="errors">
      <?php
//           
      $errors = $this->session->flashdata('errors');
      if (isset($errors)) {
        foreach ($errors as $error) {
          ?>
          <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?php echo $error; ?>
          </div>
          <?php
        }
      }
      ?>
    </div>
    <div class="panel panel-default">
      <div class="panel-body" style="font-size: 16px;">
        <div class="row">
          <div class="col-lg-4">
            <?php foreach ($data as $d) {?>
              <form role="form" action="<?php echo base_url(). 'pengguna/update_data'; ?>" method="post">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                  <input type="text" class="form-control form-control-user" id="nama_lengkap" placeholder="Enter Nama Lengkap" name="nama_lengkap" required="isi nama lengkap" value="<?php echo $d->nama_lengkap ?>">
                </div>
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" class="form-control form-control-user" id="username" placeholder="Enter username" name="username" required="isi username" value="<?php echo $d->username ?>" >
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="text" class="form-control form-control-user" id="email" name="email"  placeholder="Email Address" value="<?php echo $d->email ?>" required>
                </div>
                <div class="form-group">
                  <label for="level" style="font-size: 16px;">Level:</label>
                  <select id="inputState"  name="level" class="form-control">
                   <option <?php echo ($d->level == 'admin') ? "selected": "" ?>>Admin</option>
                   <option <?php echo ($d->level == 'user') ? "selected": "" ?>>User</option>
                 </select>                
               </div>
               <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control form-control-user" id="myInput" name="password" placeholder="Password" value="<?php echo $d->password ?>" >
              </div>
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
           <div class="form-group">
            <label>Status </label>
            <select id="inputState"  name="active" class="form-control">
             <option <?php echo ($d->active == '1')  ? "selected": "" ?> value="1">True</option>
             <option <?php echo ($d->active == '0') ? "selected": "" ?>value="0">False</option>
           </select>
         </div>
         <input type="hidden" name="id_pengguna" value="<?php echo $d->id_pengguna ?>">

         <div class="panel-footer">
          <button type="submit" class="btn btn-primary">Simpan</button>
          <a href="<?= base_url('pengguna');?>"  class="btn btn-danger">Cencel</a>
          <!-- <button type="reset" class="btn btn-warning">Reset</button> -->
          
        </div>
      </form>
    <?php }?>

  </div>

</div>
<!-- /.row (nested) -->

</div>

</div>
</div>




</div>

</div>