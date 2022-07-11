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
      bandara: {
         icon: iconBase + 'bandara.png'
      }
   };
   var features = [ 
      <?php foreach ($list as $key => $list): ?>
         {
            position: new google.maps.LatLng(<?php echo $list->lat ?>, <?php echo $list->lang ?>),
            type: 'bandara',
            bandara: '<?php echo $list->nm_bandara ?>',
            balai: '<?php echo $list->nm_kabkota ?>',
            image: '<?php if($list->img_bandara != null){echo base_url('assets/upload/bandara/thumbs/'.$list->img_bandara);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'
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
}
</script>