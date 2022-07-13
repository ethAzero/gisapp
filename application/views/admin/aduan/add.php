<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style type="text/css">
   .ui-autocomplete {
      max-height: 200px;
      max-width: 100%;
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
<!--<link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/jquery.typeahead.min.css">-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<div class="content-wrapper">
   <section class="content-header">
      <h1>Aduan
         <small>Add</small>
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
            echo form_open(base_url('admin/kabkota/add'));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Desa / Kelurahan</label>
                              <input type="text" name="nm_desa" id="nm_desa" autocomplete="off" class="form-control" placeholder="Nama Desa / Kelurahan">
                              <input type="text" name="coba" id="coba" class="form-control" placeholder="coba" required>
                              <input type="hidden" name="id_desa" class="form-control" placeholder="nama Desa / Kelurahan" required>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Kecamatan</label>
                              <input type="text" name="nm_kec" class="form-control" placeholder="Nama Kecamatan" required disabled>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Nama Kota / Kabupaten</label>
                              <input type="text" name="nm_kabkota" class="form-control" placeholder="Nama Kabupaten / Kota" required disabled>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Wilayah Kerja</label>
                              <input type="text" name="nm_balai" class="form-control" placeholder="Nama Balai" required disabled>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Aduan</label>
                              <textarea class="form-control" name="aduan" rows="3" placeholder="Aduan ..."></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="box box-primary">
                     <div class="modal-footer">
                        <a href="<?php echo base_url('admin/kabkota') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
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
<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
<script>
   $(document).ready(function() {
      $('#nm_desa').autocomplete({
         source: "<?= base_url('/admin/aduan/data_wilayah') ?>",
         delay: 500,
         minLength: 1,
         select: function(event, ui) {
            let x = ui.item.nama_kelurahan;
            //$('[name="coba"]').val(x);
            $('#coba').val(x);
            console.log(ui.item.nama_kelurahan);
         },
      }).data('ui-autocomplete')._renderItem = function(ul, item) {
         return $("<li class='ui-autocomplete-row'>")
            //.attr("data-value", item.value)
            //.data("item.autocomplete", item)
            .append(item.jenis + " " + item.nama_kelurahan + " Kec. " + item.nama_kecamatan + " " + item.nm_kabkota)
            .appendTo(ul);
      };
   });
</script>