<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<style type="text/css">
   @media (max-width: 768px) {
      .ui-autocomplete {
         width: auto;
         max-width: calc(92% - 22px);
         margin-left: 10px;
      }
   }

   .ui-autocomplete {
      max-height: 200px;
      overflow-y: auto;
      /* prevent horizontal scrollbar */
      overflow-x: hidden;
      /* add padding to account for vertical scrollbar */
      padding-right: 20px;
   }

   .ui-autocomplete-row {
      padding: 8px;
      background-color: #f4f4f4;
      border-bottom: 1px solid #ccc;
   }

   .ui-autocomplete-row:hover {
      background-color: #ddd;
   }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Aduan
         <small>Edit</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Aduan</li>
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
            echo form_open_multipart(base_url('admin/aduan/edit/' . $detail->id_aduan));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Chanel Aduan</label>
                              <select name="chanel" id="chanel" class="form-control select2" style="width: 100%;">
                                 <option value="">Chanel Aduan</option>
                                 <option value="<?= $detail->id_chanel_aduan; ?>" selected><?= $detail->chanel_aduan; ?></option>
                                 <?php foreach ($chanel as $key => $chanel) : ?>
                                    <option value="<?php echo $chanel->id ?>"><?php echo $chanel->chanel_aduan ?></option>
                                 <?php endforeach ?>
                              </select>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Desa / Kelurahan</label>
                              <input type="text" name="nm_desa" id="nm_desa" autocomplete="off" class="form-control" placeholder="Nama Desa / Kelurahan" value="<?= $detail->nama_kelurahan; ?>">
                              <input type="hidden" name="id_desa" class="form-control" value="<?= $detail->id_kelurahan; ?> " required>
                              <input type="hidden" name="id_aduan" class="form-control" value="<?= $detail->id_aduan; ?>" required>
                           </div>
                           <div class=" form-group col-md-4">
                              <label for="exampleInputEmail1">Kecamatan</label>
                              <input type="text" name="nm_kec" class="form-control" placeholder="Nama Kecamatan" value="<?= $detail->nama_kecamatan; ?>" required disabled>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Nama Kota / Kabupaten</label>
                              <input type="text" name="nm_kabkota" class="form-control" placeholder="Nama Kabupaten / Kota" value="<?= $detail->nm_kabkota; ?>" required disabled>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Wilayah Kerja</label>
                              <input type="text" name="nm_balai" class="form-control" placeholder="Nama Balai" value="<?= $detail->nm_balai; ?>" required disabled>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Aduan</label>
                              <textarea class="form-control" name="aduan" rows="3" placeholder="Aduan ..."><?= $detail->aduan; ?></textarea>
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
                           <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto Aduan" data-buttonBefore="true" data-iconName="fa fa-upload">
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
<script src="<?php echo base_url() ?>assets/admin/plugins/jquery-ui/jquery-ui.js"></script>
<script>
   $(document).ready(function() {
      $('#nm_desa').autocomplete({
         source: "<?= base_url('/admin/aduan/data_wilayah') ?>",
         delay: 500,
         minLength: 1,
         select: function(event, ui) {
            $('[name="id_desa"]').val(ui.item.id);
            $('[name="nm_kec"]').val(ui.item.nama_kecamatan);
            $('[name="nm_kabkota"]').val(ui.item.nm_kabkota);
            $('[name="nm_balai"]').val(ui.item.nm_balai);
            // $('#coba').val(x);
            console.log(ui.item.nama_kelurahan);
         },
      }).data('ui-autocomplete')._renderItem = function(ul, item) {
         return $("<li class='ui-autocomplete-row'>")
            .data("item.autocomplete", item)
            .append(item.jenis + " " + item.nama_kelurahan + " Kec. " + item.nama_kecamatan + " " + item.nm_kabkota)
            .appendTo(ul);
      };
   });
</script>