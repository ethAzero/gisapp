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

   var ctaLayer = new google.maps.KmlLayer({
      url: '<?php echo base_url();?>'+'jalan/jalankml'+'?dummy='+(new Date()).getTime(),
      map: map
   });



   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';

   var icons = {

      Lokasi: {

         icon: iconBase + 'rawan.png'

      }

   };

   var features = [ 

      <?php foreach ($list as $key => $list): ?>

         {

            position: new google.maps.LatLng(<?php echo $list->lat ?>, <?php echo $list->lang ?>),

            type: 'Lokasi',

            nama: '<?php echo $list->nm_daerah ?>',

            ket: '<?php echo $list->ket_daerah ?>',

            image: '<?php if($list->img_daerah != null){echo base_url('assets/upload/list/daerahrawan/'.$list->img_daerah);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'

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

                           '<h5 class="title">'+ feature.nama +'</h5>' +

                           '<div class="describe">' +

                              '<div class="grup-info">' +

                                 '<label class="title">Keterangan</label>' +

                                 '<label class="isi">' + feature.ket + '</label>' +

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