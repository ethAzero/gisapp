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
      <h1>Rekomendasi DRK
         <small>Add</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li>Daerah Rawan</li>
         <li class="active">Rekomendasi DRK</li>
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
            echo form_open(base_url('admin/daerahrawan/rekomadd/') . $listdrk->kd_daerah, array('onsubmit' => 'return ValidasiKoordinat()'));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Jenis Rekomendasi</label>
                              <select name="jenisrekom" class="select2 form-control">
                                 <option value="">=== Jenis Rekomendasi ===</option>
                                 <option value="Cermin Tikung">Cermin Tikung</option>
                                 <option value="Delinator">Delinator</option>
                                 <option value="Warning Light">Warning Light</option>
                                 <option value="Guardrail">Guardrail</option>
                                 <option value="Marka">Marka</option>
                                 <option value="LPJU">LPJU</option>
                                 <option value="Rambu">Rambu</option>
                                 <option value="RPPJ">RPPJ</option>
                                 <option value="Lainnya">Lainnya</option>
                              </select>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Satuan</label>
                              <input type="hidden" name="satuan" class="form-control" placeholder="Satuan">
                              <input type="text" name="satuanfake" class="form-control" placeholder="Satuan" disabled>
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Kebutuhan</label>
                              <input type="text" name="kebutuhan" class="form-control" placeholder="Kebutuhan">
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
                              <textarea name="ket" class="form-control noresize" rows="5" placeholder="Keterangan diisi deskripsi dari jenis rekomendasi, ex : Jenis Rekom Rambu, maka Keterangan diisi dengan rambu hati-hati "></textarea>
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
               </div>
            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
   </section>
</div>