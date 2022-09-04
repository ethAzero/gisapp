<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style type="text/css">
   .big-image {
      width: 100% !important;
   }

   .crop-to-square-img:hover {
      cursor: pointer;
   }
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Tanggapan
         <small>Add</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Tanggapan</li>
      </ol>
   </section>

   <section class="content">
      <a href="<?php echo base_url('admin/aduan/') ?>"><button class="btn btn-primary btn-flat"><i class="fa fa-reply"></i> Kembali</button></a>
      <br><br>
      <div class="row">
         <div class="col-md-12">
            <?php
            echo validation_errors('<div class="alert alert-warning">', '</div>');
            if (isset($error)) {
               echo '<div class="alert alert-warning">';
               echo $error;
               echo '</div>';
            }
            echo form_open(base_url('admin/aduan/addtanggap/' . $list->id_aduan));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Aduan</label>
                              <textarea class="form-control" name="aduan" rows="3" placeholder="Aduan..." disabled><?= $list->aduan; ?></textarea>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Kewenangan</label>
                              <select name="kewenangan" class="form-control select2" style="width: 100%;">
                                 <?php if ($list->kewenangan == 1) {
                                    $listext = "Kewenangan"; ?>
                                    <option value="<?= $list->kewenangan; ?>" selected><?= $listext ?></option>
                                    <option value="2">Bukan Kewenangan</option>
                                 <?php } elseif ($list->kewenangan == 2) {
                                    $listext = "Bukan Kewenangan"; ?>
                                    <option value="1">Kewenangan</option>
                                    <option value="<?= $list->kewenangan; ?>" selected><?= $listext ?></option>
                                 <?php } else { ?>
                                    <option value="">--Pilih Kewenangan--</option>
                                    <option value="1">Kewenangan</option>
                                    <option value="2">Bukan Kewenangan</option>
                                 <?php } ?>
                              </select>
                           </div>
                           <div id="peta">
                              <div class="form-group col-md-12">
                                 <label for="exampleInputEmail1">Ruas Jalan</label>
                                 <div class="box-body" style="height: 400px;">
                                    <div id="map"></div>
                                 </div>
                              </div>
                              <div class="form-group col-md-12">
                                 <label for="exampleInputEmail1">Nama Ruas Jalan</label>
                                 <input type="text" name="ruas" class="form-control" placeholder="Nama Ruas Jalan" value="<?= $list->kd_jalan ?>" disabled>
                                 <input type="hidden" name="id_ruas" class="form-control" placeholder="id ruas" value="<?= $list->kd_jalan ?>">
                              </div>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Tanggapan</label>
                              <textarea class="form-control" name="tanggapan" rows="3" placeholder="Tanggapan ..."><?= $list->tanggapan; ?></textarea>
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
               </div>
            </div>
            <?php echo form_close(); ?>
         </div>
      </div>
</div>

</section>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <img id="prev-image">
         </div>
      </div>
   </div>
</div>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc&callback=myMap"></script>
<script src="<?php echo base_url() ?>assets/admin/js/mapopsi.js"></script>
<script>
   let kewenanganVal = () => $('[name="kewenangan"]').val();
   let ruasVal = () => $('[name="ruas"]').val();
   let stat_tanggap = "<?= $list->stat_tanggap; ?>";
   let kd_jalan = "<?= $list->kd_jalan; ?>";
   let peta = $('#peta');
   $(document).ready(function() {
      if (stat_tanggap != 0) {
         $('[name="id_ruas"]').val(kd_jalan);
         if (kewenanganVal() == 1) {
            peta.show();
            getLocation();

         } else {
            $('[name="id_ruas"]').val('0');
            peta.hide();
         }
      } else {
         $('[name="id_ruas"]').val('0');
         peta.hide();
      }
   })

   $('[name="kewenangan"]').change(function() {

      if (kewenanganVal() == 1) {
         $('[name="ruas"]').val('');
         $('[name="id_ruas"]').val('');
         peta.show();
         getLocation();
      } else {
         $('[name="id_ruas"]').val('0');
         peta.hide();
      }
      console.log(kewenanganVal());
   });

   function initmap(tengah) {
      // var tengah = {
      //    lat: -7.2051406,
      //    lng: 110.1389888
      // };
      var map = new google.maps.Map(document.getElementById('map'), {
         zoom: 8,
         center: tengah,
      });

      $.ajax({
         type: "GET",
         url: "<?php echo base_url('jl') ?>",
         dataType: "json",
         data: {
            perjal: 'apill',
         },
         success: function(data) {
            let ruasjalan = [];
            let namaruas = [];
            let kodejalan = [];
            let infoperjal = [];
            for (j = 0; j < data.ruasjalan.length; j++) {
               let explode = data.ruasjalan[j].lintasan.split('|');
               const arr = explode.map(coor => {
                  return coor.replace(",", "#").split("#"); // replace will only replace the first comma
               });
               let coordarray = [];
               for (i = 0; i < arr.length; i++) {
                  let lat = arr[i][1];
                  let lng = arr[i][0];
                  let linecoord = {
                     'lat': parseFloat(lat),
                     'lng': parseFloat(lng)
                  };
                  coordarray.push(linecoord);
               }
               ruasjalan.push(coordarray);
               namaruas.push(data.ruasjalan[j].nmruas);
               kodejalan.push(data.ruasjalan[j].kdjalan);
            }


            //ruas jalan
            for (a = 0; a < data.ruasjalan.length; a++) {
               let randomnumber = Math.floor(Math.random() * 7);

               let colors = ["#FF0000", "#00ffff", "#FF00ff", "#Ffff00", "#555555", "#222222"];
               let routeLine = new google.maps.Polyline({
                  path: ruasjalan[a],
                  strokeColor: colors[randomnumber],
                  strokeOpacity: 2.0,
                  strokeWeight: 4,
               });
               routeLine.setMap(map);
               let nama = namaruas[a];
               let kode = kodejalan[a];
               var infowindow = new google.maps.InfoWindow()
               routeLine.addListener('click', function(event) {
                  infowindow.setContent('Ruas Jl. ' +
                     nama);
                  infowindow.open(map);
                  infowindow.setPosition(event.latLng);
                  $('[name="id_ruas"]').val(kode);
                  $('[name="ruas"]').val(kode + ' - ' + nama);
               });
            }
            // console.log(data.perjal[0]);
         },
      });
   };
</script>