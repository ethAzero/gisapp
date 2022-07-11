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
                  <td><img src="<?php echo base_url('assets/theme/img/rambu_terpasang.png') ?>"><?php echo $count->terpasang ?> Terpasang</td>
               </tr>
               <tr>
                  <td><img src="<?php echo base_url('assets/theme/img/rambu_kebutuhan.png') ?>"><?php echo $count->kebutuhan ?> Kebutuhan</td>
               </tr>
               <tr>
                  <td><img src="<?php echo base_url('assets/theme/img/rambu_rusak.png') ?>"><?php echo $count->rusak ?> Rusak</td>
               </tr>
            <?php endforeach ?>
            </table>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->
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

   var ctaLayer = new google.maps.KmlLayer({
   url: '<?php echo base_url();?>'+'jalan/jalankml'+'?dummy='+(new Date()).getTime(),
   map: map
   });

   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';
   var icons = {
      Terpasang: {
         icon: iconBase + 'rambu_terpasang.png'
      },
      Kebutuhan: {
         icon: iconBase + 'rambu_kebutuhan.png'
      },
      Rusak: {
         icon: iconBase + 'rambu_rusak.png'
      }
   };
   var features = [ 
      <?php foreach ($rambu as $key => $rambu): ?>
         {
            position: new google.maps.LatLng(<?php echo $rambu->lat ?>, <?php echo $rambu->lang ?>),
            type: '<?php echo $rambu->status ?>',
            kode: '<?php echo $rambu->kd_rambu ?>',
            ruas: '<?php echo $rambu->nm_ruas ?>',
            jenis: '<?php if($rambu->jenis != null){echo $rambu->nm_perjal;}else{echo "-";}?>',
            status: '<?php echo $rambu->status ?>',
            image: '<?php echo base_url('assets/upload/img_rambu/'.$rambu->img_tipe) ?>',
            imagezoom: '<?php echo base_url('assets/upload/rambu/'.$rambu->img_rambu) ?>'
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
                           '<h5 class="title">Rambu ('+ feature.kode +')</h5>' +
                           '<div class="describe">' +
                              '<div class="grup-info">' +
                                 '<label class="title">Ruas</label>' +
                                 '<label class="isi">' + feature.ruas + '</label>' +
                              '</div>' +
                              '<div class="grup-info">' +
                                 '<label class="title">Jenis</label>' +
                                 '<label class="isi">' + feature.jenis + '</label>' +
                              '</div>' +
                              '<div class="grup-info">' +
                                 '<label class="title">Status</label>' +
                                 '<label class="isi">' + feature.status + '</label>' +
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