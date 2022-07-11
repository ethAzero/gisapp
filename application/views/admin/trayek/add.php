<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
<section class="content-header">
   <h1>Trayek
      <small>Add</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Trayek</li>
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
		echo form_open_multipart(base_url('admin/trayek/add'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Kode Trayek</label>
                        <input type="text" name="kode" class="form-control" placeholder="Kode Trayek">
                     </div>
                     <div class="form-group col-md-8">
                        <label for="exampleInputEmail1">Nama Trayek</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama Trayek">
                     </div>
                     <div class="form-group col-md-12">
                        <label for="exampleFormControlTextarea1">Koordinat</label>
                        <textarea class="form-control" id="koordinat" name="koordinat" rows="3"></textarea>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/trayek') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
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