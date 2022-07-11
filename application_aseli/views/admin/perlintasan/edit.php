<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript">
   function ValidasiKoordinat() {
      var reglat = /^-([1-9]{1})\.[0-9]+$/;
      var reglang = /^([0-9]{3})\.[0-9]+$/;

      var x,y, text;
      x = document.getElementById("lat").value;
      y = document.getElementById("lng").value;
      
      if (!x.match(reglat)) {
         alert('Koordinat X Salah!');
         return false;
      }
      if (!y.match(reglang)) {
         alert('Koordinat Y Salah!');
         return false;
      }
      return true;
   }
</script>
<div class="content-wrapper">
<section class="content-header">
   <h1>Perlintasan
      <small>Edit</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Perlintasan</li>
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
		echo form_open_multipart(base_url('admin/perlintasan/edit/'.$perlintasan->kd_perlintasan));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nama perlintasan</label>
                        <input type="text" name="nmperlintasan" class="form-control" placeholder="Nama perlintasan" value="<?php echo $perlintasan->nm_perlintasan ?>">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Kabupaten / Kota</label>
                        <select name="kabkota" class="form-control">
                           <option value="">=== Kabupaten / Kota ===</option>
                           <?php foreach ($kabkota as $key => $t): ?>
                              <option value="<?php echo $t->kd_kabkota ?>" <?php if($t->kd_kabkota === $perlintasan->kd_kabkota) {echo "selected";} ?>><?php echo $t->nm_kabkota ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat Maps)</small>
                        <input type="text" name="korx" class="form-control" value="<?php echo $perlintasan->lat ?>" placeholder="X" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" name="kory" class="form-control" value="<?php echo $perlintasan->lang ?>" placeholder="Y" required>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/perlintasan') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group">
                     <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto Perlintasan" data-buttonBefore="true" data-iconName="fa fa-upload">
                     <small><p class="help-block">.JPG Max. 500 KB (800x500)</p></small>
                  </div>
                  <?php if($perlintasan->img_perlintasan != '') {?>
                  <img src="<?php echo base_url('assets/upload/perlintasan/thumbs/'.$perlintasan->img_perlintasan) ?>" class="img-responsive">
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
</section>
</div>