<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<script type="text/javascript" language="javascript">
   function ValidasiKoordinat() {
      var reglat = /^-([1-9]{1})\.[0-9]+$/;
      var reglang = /^([0-9]{3})\.[0-9]+$/;

      var x, y, text;
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
      <h1>Daerah Rawan
         <small>Add</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Daerah Rawan</li>
      </ol>
   </section>

   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <?php
            echo validation_errors('<div class="alert alert-warning">', '</div>');
            if (isset($error)) {
               echo '<div class="alert alert-warning">';
               echo $error;
               echo '</div>';
            }
            echo form_open_multipart(base_url('admin/daerahrawan/add'), array('onsubmit' => 'return ValidasiKoordinat()'));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Nama Daerah Rawan</label>
                              <input type="text" name="nmdaerah" class="form-control" placeholder="Nama Daerah">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Nama Kabupaten / Kota</label>
                              <select name="kabkota" class="select2 form-control">
                                 <option value="">=== Nama Kabupaten / Kota ===</option>
                                 <?php foreach ($kabkota as $key => $t) : ?>
                                    <option value="<?php echo $t->kd_kabkota ?>"><?php echo $t->nm_kabkota ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Status Jalan</label>
                              <select name="statusjalan" class="form-control select2">
                                 <option value="">=== Status Jalan ===</option>
                                 <option value="1">Ruas Jl. Kab/Kota</option>
                                 <option value="2">Ruas Jl. Provinsi</option>
                                 <option value="3">Ruas Jl. Nasional</option>
                              </select>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Nama Ruas Jalan</label>
                              <select name="jalan" class=" select2 form-control">
                                 <option value="">=== Ruas Jalan ===</option>
                                 <?php foreach ($jln as $key => $t) : ?>
                                    <option value="<?php echo $t->kd_jalan ?>"><?php echo $t->nm_ruas ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                           <div class="form-group col-md-3">
                              <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat Maps)</small>
                              <input type="text" id="lat" name="korx" class="form-control" placeholder="X" required>
                              <small>
                                 <p class="help-block-small">Contoh: -7.676383</p>
                              </small>
                           </div>
                           <div class="form-group col-md-3">
                              <label for="exampleInputEmail1">&nbsp;</label>
                              <input type="text" id="lng" name="kory" class="form-control" placeholder="Y" required>
                              <small>
                                 <p class="help-block-small">Contoh: 110.676383</p>
                              </small>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Keterangan</label>
                              <textarea name="ket" class="form-control noresize" rows="5"></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="box box-primary">
                     <div class="modal-footer">
                        <a href="<?php echo base_url('admin/daerahrawan') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                     </div>
                  </div>
                  <div class="box box-primary">
                     <div class="box-body">
                        <div class="form-group">
                           <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto Daerah Rawan" data-buttonBefore="true" data-iconName="fa fa-upload">
                           <small>
                              <p class="help-block">.JPG Max. 500 KB (800x500)</p>
                           </small>
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