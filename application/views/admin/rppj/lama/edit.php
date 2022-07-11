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
   <h1>Fasilitas RPPJ
      <small>Edit</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">RPPJ</li>
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
		echo form_open_multipart(base_url('admin/rppj/edit/'.$rppj->kd_rppj), array('onsubmit' => 'return ValidasiKoordinat()'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Tahun</label>
                        <input type="text" name="tahun" maxlength="4" class="form-control" placeholder"Tahun" value="<?php echo $rppj->thn_pengadaan ?>">
                     </div>
                     <div cass="form-group col-md-5">
                        <label for="exampleInputEmail1">Ruas Jalan</label>
                        <select name="ruas" class="form-control">
                           <option value="">=== Nama Ruas Jalan ===</option>
                           <?php foreach ($jalan as $key => $jalan): ?>
                              <option value="<?php echo $jalan->kd_jalan ?>" <?php if($jalan->kd_jalan=== $rppj->kd_jalan) {echo "selected";} ?> ><?php echo $jalan->nm_ruas ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Km Lokasi</label>
                        <input type="text" name="kmlokasi" class="form-control" value="<?php echo $rppj->km_lokasi ?>" placeholder="Km Lokasi" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Jenis</label>
                        <input type="text" name="jenis" class="form-control" value="<?php echo $rppj->jenis ?>" placeholder="Jenis">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Letak</label>
                        <select name="letak" class="form-control">
                           <option value="kanan" <?php if($rppj->letak === 'kanan'){echo "selected";} ?>>Kanan</option>
                           <option value="kiri" <?php if($rppj->letak === 'kiri'){echo "selected";} ?>>Kiri</option>
                        </select>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Status</label>
                        <select name="status" class="form-control">
                           <option value="Terpasang" <?php if($rppj->status === 'Terpasang'){echo "selected";} ?>>Terpasang</option>
                           <option value="Kebutuhan" <?php if($rppj->status === 'Kebutuhan'){echo "selected";} ?>>Kebutuhan</option>
                           <option value="Rusak" <?php if($rppj->status === 'Rusak'){echo "selected";} ?>>Rusak</option>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat Maps)</small>
                        <input type="text" id="lat" name="korx" class="form-control" value="<?php echo $rppj->lat ?>" placeholder="X" required>
                        <small><p class="help-block-small">Contoh: -7.676383</p></small>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" id="lng" name="kory" class="form-control" value="<?php echo $rppj->lang ?>" placeholder="Y" required>
                        <small><p class="help-block-small">Contoh: 110.676383</p></small>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/rppj') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group">
                     <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto rppj" data-buttonBefore="true" data-iconName="fa fa-upload">
                     <small><p class="help-block">.JPG Max. 1 Mb (800x500)</p></small>
                  </div>
                  <?php if($rppj->img_rppj != '') {?>
                  <img src="<?php echo base_url('assets/upload/rppj/thumbs/'.$rppj->img_rppj) ?>" class="img-responsive">
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