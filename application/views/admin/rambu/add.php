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
         alert('Koordinat Latitude Salah!');
         return false;
      }
      if (!y.match(reglang)) {
         alert('Koordinat Longitude Salah!');
         return false;
      }
      return true;
   }
</script>
<style type="text/css">
  .form-control{
    display: block!important;
  }
</style>
<div class="content-wrapper">
<section class="content-header">
   <h1>Fasilitas Rambu
      <small>Add</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Rambu</li>
   </ol>
</section>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
      echo form_open_multipart(base_url('admin/rambu/add/'.$jalan->kd_balai.'/'.$jalan->kd_jalan), array('onsubmit' => 'return ValidasiKoordinat()'));
		?>

      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Tahun</label>
                        <input id="tahun" type="text" name="tahun" class="form-control" maxlength="4" placeholder="Tahun">
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Klasifikasi</label>
                        <select id="klasifikasi" name="klasifikasi" class="form-control" required>
                           <option value="">Pilih klasifikasi...</option>
                           <?php
                           foreach ($rambu as $row) {
                           ?>
                           <option value="<?php echo $row->id_tabel;?>"><?php echo $row->nm_perjal;?></option>
                           <?php
                           };
                           ?>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Status</label>
                        <select id="status" name="status" class="form-control" required>
                           <option value="">-Pilih Status-</option>
                           <option value="Terpasang">Terpasang</option>
                           <option value="Kebutuhan">Kebutuhan</option>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Posisi</label>
                        <select id="posisi" name="posisi" class="form-control" required>
                           <option value="">-Pilih Posisi-</option>
                           <option value="Kiri">Kiri</option>
                           <option value="Kanan">Kanan</option>
                           <option value="Tengah">Tengah</option>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Kondisi</label>
                        <select id="kondisi" name="kondisi" class="form-control" required>
                           <option value="">-Pilih Kondisi-</option>
                           <option value="Baik">Baik</option>
                           <option value="Sedang">Sedang</option>
                           <option value="Rusak">Rusak</option>
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat Maps)</small>
                        <input id="lat" type="text" name="korx" class="form-control" placeholder="Latittude (ex. -6.281928)" required>
                        <small><p class="help-block-small">Contoh: -7.676383</p></small>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input id="lng" type="text" name="kory" class="form-control" placeholder="Longitude(ex. 110.281928)" required>
                        <small><p class="help-block-small">Contoh: 110.676383</p></small>
                     </div>
                     <div class="form-group col-md-12">
                        <label for="exampleInputEmail1">Tipe Rambu</label>
                        <div id="tipe" class=""></div>
                        <input type="hidden" name="rambu_tipe" id="rambu_tipe">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/rambu/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan) ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button id="submit" type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
            <div class="box box-primary">
               <div class="box-body">
                  <div class="form-group">
                     <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto rambu" data-buttonBefore="true" data-iconName="fa fa-upload">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
   $( document ).ready(function() {
      //Ajax Get Option tipe
      $("#klasifikasi").change(function()
      { 
           // console.log($(this).val());
          var value = $(this).val();
          var html="";
          var urls= "<?php echo base_url();?>" + "assets/upload/img_rambu/";

          $.ajax({
             method: "POST",
             url: "<?php echo base_url();?>" + "admin/rambu/tipe",
             data:{
               <?=$this->security->get_csrf_token_name();?> : "<?=$this->security->get_csrf_hash();?>" ,
               data:value,
             },
             dataType: 'json',
             success: function(result){
               if(result.length >0){
                 for (i in result) {
                     var item = result[i];
                     html += '<div class="col-sm-2">';
                     html +=   '<div class="text-center"><center><img style="align:middle;" src="'+urls+item.img_tipe+'" class="img-responsive img-radio" width="90" height="90" ></center>';
                     html += '<br>'; 
                     html +=   '<input type="radio" name="group1" id="item'+item.id_rambu+'" value="'+item.id_rambu+'" class="radioClass"></div>';
                     html += '</div>';
                     // html += '<img src="'+urls+item.desk_tipe+item.img_tipe+'" class="img-responsive img-radio" width="90" height="90" >';
                     // html += '<option value="'+item.id_rambu+'" data-img-src="'+urls+item.desk_tipe+item.img_tipe+'">okok</option>';
                 }
                 // console.log(html);
               }else{
                     html += '<option value="">No Tipe</option>';
               }
              // console.log(html);
               $("#tipe").html(html);

               $("input[type='radio']").on('change', function () {
               var selectedValue = $("input[name='group1']:checked").val();
                if (selectedValue) {
                     $('#rambu_tipe').val(selectedValue);
                }
               });

             },
             error: function (xhr) {
                alert(JSON.stringify(xhr));
                if (xhr.responseText) {
                    var err = xhr.responseText;
                    if (err)
                        error('Cek Koneksi Internet Ya :)');
                    else
                        error({ Message: "Unknown server error." })
                }
                return;
            }
         });
      });
   });  
</script>