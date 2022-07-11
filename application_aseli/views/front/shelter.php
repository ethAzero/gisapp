<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-wrapper" class="fullscreenmap">
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
            <table class="">
            <?php foreach ($count as $key => $count): ?>
               <tr>
                  <td><img src="<?php echo base_url('assets/theme/img/shelter_bawen_tawang.png') ?>">Arah Bawen - Tawang : <?php echo $count->BT ?> Shelter</td>
               </tr>
               <tr>
                  <td><img src="<?php echo base_url('assets/theme/img/shelter_tawang_bawen.png') ?>">Arah Tawang - Bawen : <?php echo $count->TB ?> Shelter</td>
               </tr>
               <tr>
                  <td><img src="<?php echo base_url('assets/theme/img/point.png') ?>">Awal / Akhir </td>
               </tr>
            <?php endforeach ?>
            </table>
         </div>
      </div>
   </div>
</div>
<script>
function myMap() {
   var tengah = {lat: -7.108491, lng: 110.4848261};
   var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 11,
      center: tengah
   });

   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';
   var icons = {
      TB: {
         icon: iconBase + 'shelter_tawang_bawen.png'
      },
      BT: {
         icon: iconBase + 'shelter_bawen_tawang.png'
      },
      P: {
         icon: iconBase + 'point.png'
      }
   };
   var features = [ 
      <?php foreach ($list as $key => $list): ?>
         {
            position: new google.maps.LatLng(<?php echo $list->lat ?>, <?php echo $list->lang ?>),
            type: '<?php echo $list->arah ?>',
            shelter: '<?php echo $list->nm_shelter ?>',
            status: '<?php if($list->status == 'P'){echo "PROVINSI";}elseif($list->status == 'K'){echo "KOTA";}elseif($list->status == 'PR'){echo "PERUSAHAAN";}else{echo "-";}?>',
            tipe: '<?php if($list->tipe != null){echo $list->tipe;}else{echo "-";}?>',
            arah: '<?php if($list->arah == 'P'){echo "POINT";}elseif($list->arah == 'TB'){echo "TAWANG - BAWEN";}elseif($list->arah == 'BT'){echo "BAWEN - TAWANG";}else{echo "-";}?>',
            image: '<?php if($list->img_shelter != null){echo base_url('assets/upload/shelter/thumbs/'.$list->img_shelter);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'
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
                     '<h5 class="title">'+ feature.shelter +'</h5>' +
                     '<div class="describe">' +
                        '<div class="grup-info">' +
                           '<label class="title">Status</label>' +
                           '<label class="isi">' + feature.status + '</label>' +
                        '</div>' +
                        '<div class="grup-info">' +
                           '<label class="title">Tipe</label>' +
                           '<label class="isi">' + feature.tipe + '</label>' +
                        '</div>' +
                        '<div class="grup-info">' +
                           '<label class="title">Arah</label>' +
                           '<label class="isi">' + feature.arah + '</label>' +
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