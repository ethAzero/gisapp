<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
<section class="content-header">
   <h1>Jalan Provinsi
      <small>Add</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Jalan Provinsi</li>
   </ol>
</section>

<section class="content">
<div class="row">
   <div class="col-md-12">
   	<?php
		echo validation_errors('<div class="alert alert-warning">','</div>');
      if(isset($error)){
         echo '<div class="alert alert-warning">';
         echo $error;
         echo '</div>';
      }
		echo form_open(base_url('admin/jalan/add'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Nomor Ruas</label>
                        <input type="text" name="nmrruas" class="form-control" placeholder="Nomor Ruas" maxlength="3" required>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Fungsi</label>
                        <input type="text" name="jlnfungsi" class="form-control" placeholder="Fungsi">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Kelas</label>
                        <input type="text" name="jlnkelas" class="form-control" placeholder="Kelas">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Panjang Jalan</label>
                        <input type="text" name="jlnpanjang" class="form-control" placeholder="Panjang Jalan" required>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Wilayah</label>
                        <select name="balai" class="form-control" data-placeholder="Wilayah" required>
                           <option value="">Balai</option>
                           <?php foreach ($balai as $key => $balai): ?>
                              <option value="<?php echo $balai->kd_balai ?>"><?php echo $balai->nm_balai ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nama Ruas</label>
                        <input type="text" name="nmruas" class="form-control" placeholder="Nama Ruas" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Awal Jalan</label><small> (Koordinat Maps)</small>
                        <input type="text" name="startx" class="form-control" placeholder="X" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" name="starty" class="form-control" placeholder="Y" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Akhir Jalan</label><small> (Koordinat Maps)</small>
                        <input type="text" name="endx" class="form-control" placeholder="X" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" name="endy" class="form-control" placeholder="Y" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Rute</label>
                        <textarea name="lintasan" class="form-control noresize"></textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/jalan') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
</section>
</div>