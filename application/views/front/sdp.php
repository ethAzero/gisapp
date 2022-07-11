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

      sdp: {

         icon: iconBase + 'sdp.png'

      }

   };

   var features = [ 

      <?php foreach ($list as $key => $list): ?>

         {

            position: new google.maps.LatLng(<?php echo $list->lat ?>, <?php echo $list->lang ?>),

            type: 'sdp',

            sdp: '<?php echo $list->nm_sdp ?>',

            kota: '<?php echo $list->nm_kabkota ?>',

            ket_sdp: '<?php echo $list->keterangan ?>',

            ddukung: '<?php echo base_url('sdp/detail/'.$list->kd_sdp);?>',

            image: '<?php if($list->img_sdp != null){echo base_url('assets/upload/sdp/thumbs/'.$list->img_sdp);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'

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

                     '<div class="marker-company-thumbnail"><img src="'+ feature.image +'" alt="" style="width:150px;height:150px;">' +

                     '</div>' +

                     '<div class="map-item-info">' +

                     '<h5 class="title">'+ feature.sdp +'</h5>' +

                     '<div class="describe">' +

                        '<div class="grup-info">' +

                           '<label class="title">Lokasi</label>' +

                           '<label class="isi">' + feature.kota + '</label>' +

                        '</div>' +

                        '<div class="grup-info">' +

                           '<label class="title">Keterangan</label>' +

                           '<label class="isi">' + feature.ket_sdp + '</label>' +

                        '</div>' +


                        '<div class="grup-info">' +

                           '<label class="title">Detail Data Dukung :</label>' +

                           '<label class="isi"><a href="' + feature.ddukung + '">' + feature.ddukung + '</a></label>' +

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

</script>s