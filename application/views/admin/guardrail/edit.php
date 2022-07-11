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
   <h1>Guardrail - <?php echo $guardrail->kd_guardrail ?>
      <small>Edit</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Guardrail</li>
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
		echo form_open_multipart(base_url('admin/guardrail/edit/'.$guardrail->kd_jalan.'/'.$guardrail->kd_guardrail), array('onsubmit' => 'return ValidasiKoordinat()'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Tahun</label>
                        <input type="text" name="tahun" maxlength="4" value="<?php echo $guardrail->thn_pengadaan ?>" class="form-control" maxlength="4" placeholder="Tahun">
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Panjang</label><small> (beam)</small>
                        <input type="text" name="panjang" value="<?php echo $guardrail->panjang ?>" class="form-control" placeholder="Panjang">
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Letak</label>
                        <select name="letak" class="form-control" required>
                           <option value="">===== Letak =====</option>
                           <option value="Kanan" <?php if($guardrail->letak === 'Kanan'){echo "selected";} ?>>Kanan</option>
                           <option value="Kiri" <?php if($guardrail->letak === 'Kiri'){echo "selected";} ?>>Kiri</option>
                           <option value="Kiri dan Kanan" <?php if($guardrail->letak === 'Kiri dan Kanan'){echo "selected";} ?>>Kiri dan Kanan</option>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Kondisi</label>
                        <select name="status" class="form-control" required>
                           <option value="">=== Kondisi ===</option>
                           <option value="Terpasang" <?php if($guardrail->status === 'Terpasang'){echo "selected";} ?>>Terpasang</option>
                           <option value="Kebutuhan" <?php if($guardrail->status === 'Kebutuhan'){echo "selected";} ?>>Kebutuhan</option>
                           <option value="Rusak" <?php if($guardrail->status === 'Rusak'){echo "selected";} ?>>Rusak</option>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat)</small>
                        <input type="text" id="lat" name="korx" value="<?php echo $guardrail->lat ?>" class="form-control" placeholder="X" required>
                        <small><p class="help-block-small">Contoh: -7.676383</p></small>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" id="lng" name="kory" value="<?php echo $guardrail->lang ?>" class="form-control" placeholder="Y" required>
                        <small><p class="help-block-small">Contoh: 110.676383</p></small>
                     </div>

                     
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/guardrail/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan) ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group">
                     <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto Guardrail" data-buttonBefore="true" data-iconName="fa fa-upload">
                     <small><p class="help-block">.JPG Max. 1 Mb (800x500)</p></small>
                  </div>
                  <?php if($guardrail->img_guardrail != '') {?>
                  <img src="<?php echo base_url('assets/upload/guardrail/thumbs/'.$guardrail->img_guardrail) ?>" class="img-responsive">
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