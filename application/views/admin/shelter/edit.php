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
   <h1>Shelter
      <small>Edit</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Shelter</li>
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
		echo form_open_multipart(base_url('admin/shelter/edit/'.$shelter->kd_shelter), array('onsubmit' => 'return ValidasiKoordinat()'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nama Shelter</label>
                        <input type="text" name="nmshelter" class="form-control" value="<?php echo $shelter->nm_shelter ?>" placeholder="Nama Shelter" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Status</label>
                        <select name="status" class="form-control" required>
                           <option value="P" <?php if($shelter->status === 'P'){echo "selected";} ?>>PROVINSI</option>
                           <option value="PR" <?php if($shelter->status === 'PR'){echo "selected";} ?>>PERUSAHAAN</option>
                           <option value="K" <?php if($shelter->status === 'K'){echo "selected";} ?>>KOTA</option>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Tipe</label>
                        <input type="text" name="tipe" class="form-control" value="<?php echo $shelter->tipe ?>" placeholder="Tipe Shelter">
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Arah</label>
                        <select name="arah" class="form-control" required>
                           <option value="">==== Arah ====</option>
                           <!-- <option value="P" <?php if($shelter->arah === 'P'){echo "selected";} ?>>Point</option>
                           <option value="TB" <?php if($shelter->arah === 'TB'){echo "selected";} ?>>Tawang - Bawen</option>
                           <option value="BT" <?php if($shelter->arah === 'BT'){echo "selected";} ?>>Bawen - Tawang</option>
 -->
                           <?php foreach($arah as $a){?>
                           <option value="<?=$a->kd_arah?>" <?php if($shelter->arah === $a->kd_arah){echo "selected";} ?>><?=$a->nm_arah?></option>
                           <?php } ?>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat Maps)</small>
                        <input type="text" id="lat" name="korx" class="form-control" value="<?php echo $shelter->lat ?>" placeholder="X" required>
                        <small><p class="help-block-small">Contoh: -7.676383</p></small>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" id="lng" name="kory" class="form-control" value="<?php echo $shelter->lang ?>" placeholder="Y" required>
                        <small><p class="help-block-small">Contoh: 110.676383</p></small>
                     </div> 
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/shelter') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group">
                     <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto bandara" data-buttonBefore="true" data-iconName="fa fa-upload">
                     <small><p class="help-block">.JPG Max. 500 KB (800x500)</p></small>
                  </div>
                  <?php if($shelter->img_shelter != '') {?>
                  <img src="<?php echo base_url('assets/upload/shelter/thumbs/'.$shelter->img_shelter) ?>" class="img-responsive">
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