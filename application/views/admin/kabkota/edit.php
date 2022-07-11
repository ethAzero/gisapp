<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
<section class="content-header">
   <h1>Kabupaten / Kota
      <small>Edit</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Kabupaten / Kota</li>
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
		echo form_open(base_url('admin/kabkota/edit/'.$detail->kd_kabkota));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Kode</label>
                        <input type="text" class="form-control" value="<?php echo $detail->kd_kabkota ?>" disabled >
                        <input type="hidden" name="kode" class="form-control" value="<?php echo $detail->kd_kabkota ?>">
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Nama Kota / Kabupaten</label>
                        <input type="text" name="nmkabkota" class="form-control" placeholder="Nama Kota / Kabupaten" value="<?php echo $detail->nm_kabkota ?>" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Balai</label>
                        <select name="kdbalai" class="form-control">
                           <option value="">Nama Balai Perhubungan</option>
                           <?php foreach ($balai as $key => $balai): ?>
                              <option value="<?php echo $balai->kd_balai ?>" <?php if($balai->kd_balai === $detail->kd_balai){echo "selected";} ?>><?php echo $balai->nm_balai ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/kabkota') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
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