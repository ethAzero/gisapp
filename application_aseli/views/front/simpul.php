<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-wrapper" class="fullscreenmap">
   <div id="map"></div>
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
      pelabuhan: {
         icon: iconBase + 'pelabuhan.png'
      }
   };
   var features = [ 
      <?php foreach ($pelabuhan as $key => $pelabuhan): ?>
         {
            position: new google.maps.LatLng(<?php echo $pelabuhan->lat ?>, <?php echo $pelabuhan->lang ?>),
            type: 'pelabuhan',
            pelabuhan: '<?php echo $pelabuhan->nm_pelabuhan ?>',
            balai: '<?php echo $pelabuhan->nm_kabkota ?>',
            image: '<?php if($pelabuhan->img_pelabuhan != null){echo base_url('assets/upload/pelabuhan/thumbs/'.$pelabuhan->img_pelabuhan);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'
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
                     '<div class="marker-company-thumbnail"><img src="'+ feature.image +'" alt="">' +
                     '</div>' +
                     '<div class="map-item-info">' +
                     '<h5 class="title">'+ feature.pelabuhan +'</h5>' +
                     '<div class="describe">' +
                        '<div class="grup-info">' +
                           '<label class="title">Lokasi</label>' +
                           '<label class="isi">' + feature.balai + '</label>' +
                        '</div>' +
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

   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';
   var icons = {
      bandara: {
         icon: iconBase + 'bandara.png'
      }
   };
   var features = [ 
      <?php foreach ($bandara as $key => $bandara): ?>
         {
            position: new google.maps.LatLng(<?php echo $bandara->lat ?>, <?php echo $bandara->lang ?>),
            type: 'bandara',
            bandara: '<?php echo $bandara->nm_bandara ?>',
            balai: '<?php echo $bandara->nm_kabkota ?>',
            image: '<?php if($bandara->img_bandara != null){echo base_url('assets/upload/bandara/thumbs/'.$bandara->img_bandara);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'
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
                     '<div class="marker-company-thumbnail"><div class="crop-to-square"><div class="crop-to-square-positioner"><img src="'+ feature.image +'" class="crop-to-square-img" alt=""></div></div></div>' +
                     '<div class="map-item-info">' +
                     '<h5 class="title">'+ feature.bandara +'</h5>' +
                     '<div class="describe">' +
                        '<div class="grup-info">' +
                           '<label class="title">Lokasi</label>' +
                           '<label class="isi">' + feature.balai + '</label>' +
                        '</div>' +
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

   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';
   var icons = {
      terminal: {
         icon: iconBase + 'terminal.png'
      }
   };
   var features = [ 
      <?php foreach ($terminal as $key => $terminal): ?>
         {
            position: new google.maps.LatLng(<?php echo $terminal->lat ?>, <?php echo $terminal->lang ?>),
            type: 'terminal',
            terminal: '<?php echo $terminal->nm_terminal ?>',
            balai: '<?php echo $terminal->nm_balai ?>',
            image: '<?php if($terminal->img_terminal != null){echo base_url('assets/upload/terminal/thumbs/'.$terminal->img_terminal);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'
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
                     '<div class="marker-company-thumbnail"><img src="'+ feature.image +'" alt="">' +
                     '</div>' +
                     '<div class="map-item-info">' +
                     '<h5 class="title">'+ feature.terminal +'</h5>' +
                     '<div class="describe">' +
                        '<div class="grup-info">' +
                           '<label class="title">Kewenangan</label>' +
                           '<label class="isi">' + feature.balai + '</label>' +
                        '</div>' +
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