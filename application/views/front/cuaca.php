<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
   #map{
      height: 200px!important;
   }
</style>
<div id="page-wrapper" class="fullscreenmap">
   <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0">
      <?php if ($ket->ket == TRUE): ?>
         <div class="text-center">Prakiraan Cuaca Berlaku mulai <?php echo tgl_indo($ket->tgl_ket_start); ?> - <?php echo jam_indo($ket->tgl_ket_start); ?> WIB s/d <?php echo tgl_indo($ket->tgl_ket_end); ?> - <?php echo jam_indo($ket->tgl_ket_end); ?> WIB</div>
      <?php else: ?>
         <div class="text-center">Menunggu proses data</div>
      <?php endif ?>
   </nav>
   <div id="map"></div>
</div>
<div class="feedback">
   <button class="btn btn-primary feedbackbtn"><i class="fa  fa-info"></i></button>
   <div class="panel panel-primary">
      <div class="panel-heading">
         <div class="page-header small">INFO</div>
      </div>
      <div class="legenda">
         <div class="panel-info-legenda">
            <div class="info-panel">
            <?php if ($ket->ket == TRUE): ?>
               <?php  echo $ket->ket ?>
            <?php else: ?>
            <?php endif ?>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
function myMap() {
   var tengah = {lat: -7.2051406, lng: 110.1389888};
   var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: tengah
   });

   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';
   var icons = {
      B: {
         icon: iconBase + 'berawan.png'
      },
      CB: {
         icon: iconBase + 'cerah-berawan.png'
      },
      BT: {
         icon: iconBase + 'berawan-tebal.png'
      },
      HR: {
         icon: iconBase + 'hujan-ringan.png'
      },
      HS: {
         icon: iconBase + 'hujan-sedang.png'
      },
      HL: {
         icon: iconBase + 'hujan-petir.png'
      },
      HRL: {
         icon: iconBase + 'hujan-lokal.png'
      }
   };
   var features = [ 
      <?php foreach ($list as $key => $list): ?>
         {
            position: new google.maps.LatLng(<?php echo $list->lat ?>, <?php echo $list->lang ?>),
            type: '<?php if($list->ket_cuaca == 'Hujan Ringan - Sedang'){ echo "HS";} else if($list->ket_cuaca == 'Hujan Ringan'){ echo "HR";}else if($list->ket_cuaca == 'Hujan Sedang - Lebat'){ echo "HL";}else if($list->ket_cuaca == 'Berawan'){ echo "B";}else if($list->ket_cuaca == 'Cerah Berawan'){ echo "CB";}else if($list->ket_cuaca == 'Hujan Ringan lokal'){ echo "HRL";} ?>',
            kabkota: '<?php echo $list->nm_kota ?>',
            cuaca: '<?php echo $list->ket_cuaca ?>',
            arah: '<?php echo $list->arah_kec ?>',
            suhu: '<?php echo $list->suhu ?>',
            kelembaban: '<?php echo $list->kelem_udara ?>'
         },
      <?php endforeach ?>
   ];

   features.forEach(function(feature) {
      var marker = new google.maps.Marker({
         position: feature.position,
         icon: icons[feature.type].icon,
         map: map
      });
      var contentString = '' +
                     '<div class="marker-holder">' +
                     '<h5 class="title">'+ feature.kabkota +'</h5>' +
                     '<div class="describe">' +
                        '<div class="grup-info">' +
                           '<label class="title">Cuaca</label>' +
                           '<label class="isi">' + feature.cuaca + '</label>' +
                        '</div>' +
                        '<div class="grup-info">' +
                           '<label class="title">Arah & Kecepatan Angin Permukaan (km/jam)</label>' +
                           '<label class="isi">' + feature.arah + '</label>' +
                        '</div>' +
                        '<div class="grup-info">' +
                           '<label class="title">Suhu</label>' +
                           '<label class="isi">' + feature.suhu + ' &deg;C</label>' +
                        '</div>' +
                        '<div class="grup-info">' +
                           '<label class="title">Kelembaban Udara</label>' +
                           '<label class="isi">' + feature.kelembaban + ' %</label>' +
                        '</div>' +
                     '</div>' +
                     '</div>' +
                     '</div>' +
                     '</div>';

      var infowindow = new google.maps.InfoWindow({
         content: contentString
      });
      marker.addListener('click', function() {
         infowindow.open(map, marker);
      });
   });
}
</script>