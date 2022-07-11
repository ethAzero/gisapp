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
      atcs: {
         icon: iconBase + 'atcs.png'
      }
   };
   var features = [ 
      <?php foreach ($list as $key => $list): ?>
         {
            position: new google.maps.LatLng(<?php echo $list->lat ?>, <?php echo $list->lang ?>),
            type: 'atcs',
            atcs: '<?php echo $list->nm_atcs ?>',
            kabkota: '<?php echo $list->nm_kabkota ?>',
            source: '<?php echo $list->source ?>',
            image: '<?php echo base_url('assets/theme/img/video.jpg'); ?>'
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
                     '<h5 class="title">'+ feature.atcs +'</h5>' +
                     '<div class="marker-company-thumbnail"><div class="max-size"><a href="'+ feature.source +'" target="_blank"><img src="'+ feature.image +'" alt=""></a></div>' +
                     '</div>' +
                     '<div class="map-item-kanan">' +                    
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