<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
.big-image{
   width: 100%!important;
   max-height: 350px!important;
}
</style>
<div id="page-wrapper" class="fullscreenmap">
   <div id="map"></div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview Image</h5>
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
<script>
function myMap() {
   var tengah = {lat: -7.2051406, lng: 110.1389888};
   var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: tengah
   });

   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';
   var icons = {
      perlintasan: {
         icon: iconBase + 'perlintasan.png'
      }
   };
   var features = [ 
      <?php foreach ($list as $key => $list): ?>
         {
            position: new google.maps.LatLng(<?php echo $list->lat ?>, <?php echo $list->lang ?>),
            type: 'perlintasan',
            perlintasan: '<?php echo $list->nm_perlintasan ?>',
            kota: '<?php echo $list->nm_kabkota ?>',
            image: '<?php if($list->img_perlintasan != null){echo base_url('assets/upload/perlintasan/thumbs/'.$list->img_perlintasan);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>',
            imagezoom: '<?php echo base_url('assets/upload/perlintasan/'.$list->img_perlintasan) ?>'
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
                     '<div class="marker-company-thumbnail"><div class="crop-to-square"><div class="crop-to-square-positioner"><a id="happy-img" data-toggle="modal" data-target="#exampleModal" data-id="'+ feature.imagezoom +'"><img src="'+ feature.image +'" class="crop-to-square-img" alt=""></a></div></div></div>' +
                     '<div class="map-item-info">' +
                     '<h5 class="title">'+ feature.perlintasan +'</h5>' +
                     '<div class="describe">' +
                        '<div class="grup-info">' +
                           '<label class="title">Lokasi</label>' +
                           '<label class="isi">' + feature.kota + '</label>' +
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

   $(document).on("click", "#happy-img", function () {
      var preview = $(this).data('id');
      $("#prev-image").attr("src", preview).addClass("big-image");
   });
}
</script>