<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
<section class="content-header">
   <h1>Balai
      <small>Add Balai</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Balai</li>
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
		echo form_open_multipart(base_url('admin/balai/add'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Kode Balai</label>
                        <input type="text" name="kdbalai" class="form-control" placeholder="Kode Balai" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nama Balai</label>
                        <input type="text" name="nmbalai" class="form-control" placeholder="Nama Balai" required>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Telepon Balai</label>
                        <input type="text" name="telpbalai" class="form-control" placeholder="Telepon Balai" required>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Koordinat Maps</label><small> (Latitude)</small>
                        <input type="text" name="latitude" class="form-control" placeholder="Latitude" required>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Koordinat Maps</label><small> (Longitude)</small>
                        <input type="text" name="longitude" class="form-control" placeholder="Longitude" required>
                     </div>
                     <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Alamat Balai</label>
                        <input type="text" name="almtbalai" class="form-control" placeholder="Alamat Balai" required>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/balai') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group">
                     <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto Balai" data-buttonBefore="true" data-iconName="fa fa-upload">
                     <small><p class="help-block">.JPG Max. 500 KB (800x500)</p></small>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
</section>
</div>