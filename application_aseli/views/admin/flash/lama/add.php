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
   <h1>Fasilitas Flash
      <small>Add</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Flash</li>
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
		echo form_open_multipart(base_url('admin/flash/add'), array('onsubmit' => 'return ValidasiKoordinat()'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Tahun</label>
                        <input type="text" name="tahun" maxlength="4" class="form-control" maxlength="4" placeholder="Tahun">
                     </div>
                     <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Ruas Jalan</label>
                        <select name="ruas" class="form-control">
                           <option value="">=== Nama Ruas Jalan ===</option>
                           <?php foreach ($jalan as $key => $jalan): ?>
                              <option value="<?php echo $jalan->kd_jalan ?>"><?php echo $jalan->nm_ruas ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Km Lokasi</label>
                        <input type="text" name="kmlokasi" class="form-control" placeholder="Km Lokasi" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Jenis</label>
                        <input type="text" name="jenis" class="form-control" placeholder="Jenis">
                     </div>
                     <div class="form-group col-md-5">
                        <label for="exampleInputEmail1">Letak</label>
                        <input type="text" name="letak" class="form-control" placeholder="Letak">
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Kondisi</label>
                        <select name="status" class="form-control">
                           <option value="Terpasang">Terpasang</option>
                           <option value="Kebutuhan">Kebutuhan</option>
                           <option value="Rusak">Rusak</option>
                        </select>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat)</small>
                        <input type="text" id="lat" name="korx" class="form-control" placeholder="X" required>
                        <small><p class="help-block-small">Contoh: -7.676383</p></small>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" id="lng" name="kory" class="form-control" placeholder="Y" required>
                        <small><p class="help-block-small">Contoh: 110.676383</p></small>
                     </div>
                  </div>
               </div>
           </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/flash') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group">
                     <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto flash" data-buttonBefore="true" data-iconName="fa fa-upload">
                     <small><p class="help-block">.JPG Max. 1 Mb (800x500)</p></small>
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