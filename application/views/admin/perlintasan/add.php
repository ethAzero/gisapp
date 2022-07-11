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
      <small>Add</small>
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
		echo form_open_multipart(base_url('admin/perlintasan/add'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nama perlintasan</label>
                        <input type="text" name="nmperlintasan" class="form-control" placeholder="Nama perlintasan">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nama Kabupaten / Kota</label>
                        <select name="kabkota" class="form-control">
                           <option value="">=== Nama Kabupaten / Kota ===</option>
                           <?php foreach ($kabkota as $key => $t): ?>
                              <option value="<?php echo $t->kd_kabkota ?>"><?php echo $t->nm_kabkota ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>    
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Jenis perlintasan</label>
                        <select name="jenisperlintasan" class="form-control">
                           <option value="">=== Jenis Perlintasan ===</option>
                           <option value="sebidang">Sebidang</option>
                           <option value="tidaksebidang">Tidak Sebidang</option>
                           <option value="underpass">Underpass</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Status penjagaan</label>
                        <input type="text" name="statuspenjagaan" class="form-control" placeholder="Status penjagaan">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Status jalan</label>
                        <select name="statusjalan" class="form-control">
                           <option value="">=== Status jalan ===</option>
                           <option value="provinsi">Provinsi</option>
                           <option value="nasional">Nasional</option>
                           <option value="kota">Kabupaten/Kota</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Lebar jalan</label>
                        <input type="text" name="lebarjalan" class="form-control" placeholder="Lebar jalan">
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Perkerasan</label>
                        <input type="text" name="perkerasan" class="form-control" placeholder="Perkerasan">
                     </div>              
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Palang pintu</label>
                        <select name="palangpintu" class="form-control">
                           <option value="">=== Ketersediaan Palang Pintu ===</option>
                           <option value="1">Ada</option>
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Andreas cross</label>
                        <select name="andreascross" class="form-control">
                           <option value="">=== Ketersediaan Andreas cross ===</option>
                           <option value="1">Ada</option>
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>   
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Rambu stop</label>
                        <select name="rambustop" class="form-control">
                           <option value="">=== Ketersediaan Rambu stop ===</option>
                           <option value="1">Ada</option>
                           <option value="0">Tidak ada</option>
                        </select>
                     </div> 
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Rambu peringatan</label>
                        <select name="rambuperingatan" class="form-control">
                           <option value="">=== Ketersediaan Rambu peringatan ===</option>
                           <option value="1">Ada</option>
                           <option value="0">Tidak ada</option>
                        </select>
                     </div> 
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Rambu peringatan 1</label>
                        <select name="rambuperingatan1" class="form-control">
                           <option value="">=== Ketersediaan Rambu peringatan 1 ===</option>
                           <option value="1">Ada</option>
                           <option value="0">Tidak ada</option>
                        </select>
                     </div> 
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Rambu peringatan 2</label>
                        <select name="rambuperingatan2" class="form-control">
                           <option value="">=== Ketersediaan Rambu peringatan 2 ===</option>
                           <option value="1">Ada</option>
                           <option value="0">Tidak ada</option>
                        </select>
                     </div> 
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">WL running text</label>
                        <select name="wlrunning" class="form-control">
                           <option value="">=== Ketersediaan WL running text ===</option>
                           <option value="1">Ada</option>
                           <option value="0">Tidak ada</option>
                        </select>
                     </div>   
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat Maps)</small>
                        <input type="text" name="korx" class="form-control" placeholder="X" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" name="kory" class="form-control" placeholder="Y" required>
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
               </div>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
</section>
</div>