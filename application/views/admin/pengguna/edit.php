<div class="content-wrapper">
<section class="content-header">
   <h1>Pengguna
      <small>Edit Pengguna</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Pengguna</li>
   </ol>
</section>
<section class="content">
<div class="row">
   <div class="col-md-12">
   	<?php
		echo validation_errors('<div class="alert alert-warning">','</div>');
		echo form_open(base_url('admin/pengguna/edit/'.$pengguna->username));
		?>
      <div class="box box-primary">
         <div class="box-body">
            <div class="row">
               <input type="hidden" name="idusername" value="<?php echo $pengguna->username ?>">
               <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $pengguna->username ?>" disabled>                  
               </div>
               <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Password</label><small><font color="#696969"> (Min 6 Karakter, Max 32 Karakter)</font></small>
                  <input type="password" name="password" class="form-control" placeholder="Password" >
               </div>
               <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Nama Pengguna</label>
                  <input type="text" name="nmpengguna" class="form-control" placeholder="Nama Pengguna" value="<?php echo $pengguna->nm_pengguna ?>">
               </div>
               <div class="form-group col-md-6">
                  <label for="exampleInputEmail1">Level</label>
                  <select class="form-control" name="akseslevel">
	                  <option value="U" <?php if($pengguna->akseslevel=='U') {echo "selected";} ?>>User</option>
                     <option value="A" <?php if($pengguna->akseslevel=='A') {echo "selected";} ?>>Admin</option>
                     <?php foreach ($balai as $key => $balai): ?>
                        <option value="<?php echo $balai->kd_balai ?>" <?php if($balai->kd_balai === $pengguna->akseslevel){echo "selected";} ?>><?php echo $balai->nm_balai ?></option>
                     <?php endforeach ?>
                	</select>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <a href="<?php echo base_url('admin/pengguna') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
         </div>
      </div>
   </div>
</div>
</section>
<?php
echo form_close();
?>
</div>