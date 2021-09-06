<div class="page-header">
  <h4>Halaman Olah Pengguna</h4>
</div>
<div class="col-lg-12">
 <?php
 $msg = $this->session->flashdata('message');
 if (isset($msg)) {
  ?>
  <div class="alert alert-success alert-dismissable">
    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <?php echo $msg; ?>
  </div>
  <?php
}
?>
<div class="row">
 
  <div class="panel panel-primary" style="font-size: 16px;">
    <div class="panel-heading">List Pengguna</div>
    <div class="panel-content" >
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr >
              <th>No</th>
              <th>Nama</th>
              <th>Username</th>
              <th>Password</th>
              <th>Level</th>
              <th>Email</th>
              <th>Active</th>
              <th>Pilihan</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($pengguna as $u) {
              ?>
              <tr>
               <td><?php echo $no++ ;?></td>
               <td><?php echo $u->nama_lengkap ;?></td>
               <td><?php echo $u->username ;?></td>
               <td><?php echo $u->password ;?></td>
               <td><?php echo $u->level ;?></td>
               <td><?php echo $u->email ;?></td>
               <td><?php echo $u->active ? 'True' : 'False'; ?></td>
               <td>
                <a class="btn btn-primary btn-xs"
                href="<?php echo site_url('pengguna/edit_pengguna/'.$u->id_pengguna) ?>"
                role="button">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Ubah
              </a>

              <!-- Indicates a dangerous or potentially negative action -->
              <button type="button" data-toggle="modal" class="btn btn-danger btn-xs"
              data-target="#modalDelete">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus
            </button>
          </td>
        </tr>
        <?php
      }
      
      ?>
    </tbody>
  </table>
</div>
</div>

</div>

</div>

<div class="row">
  <div class="form-group">
    <a href="<?php echo site_url('pengguna/tambah') ?>" type="button" class="btn btn-primary">Tambah
    Pengguna</a>
  </div>

</div>

</div>

<div class="modal fade" tabindex="-1" role="dialog" id="modalDelete">
  <div class="modal-dialog" role="document">
    <div class="modal-content" style="font-size: 16px;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Konfirmasi hapus data</h4>
        </div>
        <div class="modal-body">
          <p>Apakah anda yakin menghapus data ini ? </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a class="btn btn-danger" href="<?php echo('pengguna/hapus/'.$u->id_pengguna);?>">Delete</a>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
