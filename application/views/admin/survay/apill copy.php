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
            echo form_open_multipart(base_url('admin/survay/addapill/'), array('onsubmit' => 'return ValidasiKoordinat()'));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <div class="box-body" style="height: 400px;">
                                 <div id="map"></div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="box box-primary">
                     <div class="modal-footer">
                        <a href="<?php echo base_url('admin/survay') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                        <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                     </div>
                  </div>
                  <div class="box box-primary">
                     <div class="box-body">
                        <div class="form-group">
                           <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto April" data-buttonBefore="true" data-iconName="fa fa-upload">
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

<script>
   let poly;
   let map;
   $(document).ready(function() {
      getcok();
   });

   function getcok() {
      $.ajax({
         type: "GET",
         url: "<?php echo base_url('admin/survay/jalan') ?>",
         dataType: "json",
         beforeSend: function() {
            // $('#loader1').html("");
            // $('#loader2').html("");
            // loader("#loader1", "#loader2");
         },
         success: function(data) {

            let tengah = {
               lat: -7.2051406,
               lng: 110.1389888
            };
            let map = new google.maps.Map(document.getElementById('map'), {
               zoom: 8,
               center: tengah,
               zoomControl: false,
               disableDefaultUI: true,
               fullscreenControl: true,
               mapTypeControl: true,
            });

            let ruasjalan = [];
            let namaruas = [];
            let kodejalan = [];
            for (j = 0; j < data.length; j++) {
               let explode = data[j].lintasan.split('|');
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
               namaruas.push(data[j].nmruas);
               kodejalan.push(data[j].kdjalan);
            }
            for (a = 0; a < data.length; a++) {
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
               });
            }
            console.log(ruasjalan);
         },
      })
   }
</script>