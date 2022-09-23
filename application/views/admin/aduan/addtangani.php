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
      <h1><?= $title ?>
         <small>Add</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Apill</li>
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
            echo form_open_multipart(base_url('admin/aduan/addtangani/' . $list->id_aduan));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Aduan</label>
                              <textarea class="form-control" name="aduan" rows="3" placeholder="Aduan..." disabled>Isi Aduan : <?= $list->aduan; ?>&#13;&#10;Lokasi Aduan : <?= $list->jenis . ' ' . $list->nama_kelurahan . ' Kec. ' . $list->nama_kecamatan . ' Kab. ' . $list->nm_kabkota; ?></textarea>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Validasi</label>
                              <textarea class="form-control" name="tanggapan" rows="3" placeholder="Tanggapan ..." disabled>Tanggapan : <?= $list->tanggapan; ?>&#13;&#10;Lokasi Aduan : Ruas Jl. <?= $jalan->nm_ruas; ?>&#13;&#10;<?= $list->jenis . ' ' . $list->nama_kelurahan . ' Kec. ' . $list->nama_kecamatan . ' Kab. ' . $list->nm_kabkota; ?>
                              </textarea>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Penanganan</label>
                              <textarea class="form-control" name="penanganan" rows="3" placeholder="Penanganan ..."><?= $list->penanganan; ?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="box box-primary">
                     <div class="modal-footer">
                        <a href="<?php echo base_url('admin/aduan') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                     </div>
                  </div>
                  <div class="box box-primary">
                     <div class="box-body">
                        <div class="form-group">
                           <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto Penanganan" data-buttonBefore="true" data-iconName="fa fa-upload">
                           <small>
                              <p class="help-block">.JPG Max. 1 Mb (800x500)</p>
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