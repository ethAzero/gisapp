<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
.big-image{
   width: 100%!important;
}
.crop-to-square-img:hover{
   cursor: pointer;
}
</style>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Progress Apill <small><?php echo $ruas->nm_ruas.' ( '.angka($ruas->jln_panjang).' m)' ?></small></h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Progress</li>
      </ol>
   </section>

   <section class="content">
      <a href="<?php echo base_url('admin/progress/apill/'.$balai->kd_balai) ?>"><button class="btn btn-primary btn-flat"><i class="fa fa-reply"></i> Kembali</button></a>
      <br><br>
      <div class="box box-primary">
         <div class="box-body" style="height: 400px;">
            <div id="map"></div>
         </div>
      </div>
   </section>         
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
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

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc&callback=myMap"></script>
<script>
function myMap() {
   var tengah = {lat: -7.2051406, lng: 110.1389888};
   var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 9,
      center: tengah
   });

   var ctaLayer = new google.maps.KmlLayer({
      url: '<?php echo base_url();?>'+'admin/progress/jalanprovinsi/'+<?php echo $ruas->kd_jalan ?>+'?dummy='+(new Date()).getTime(),
      map: map
   });

   var iconBase = '<?php echo base_url('assets/theme/img/') ?>';
   var icons = {
      Terpasang: {
         icon: iconBase + 'apil_terpasang.png'
      },
      Kebutuhan: {
         icon: iconBase + 'apil_kebutuhan.png'
      },
      Rusak: {
         icon: iconBase + 'apil_rusak.png'
      }
   };
   var features = [ 
      <?php foreach ($view as $key => $apil): ?>
         {
            position: new google.maps.LatLng(<?php echo $apil->lat ?>, <?php echo $apil->lang ?>),
            type: '<?php echo $apil->status ?>',
            kode: '<?php echo $apil->kd_apil ?>',
            jenis: '<?php if($apil->jenis != null){echo $apil->jenis;}else{echo "-";}?>',
            letak: '<?php echo $apil->letak ?>',
            status: '<?php echo $apil->status ?>',
            image: '<?php if($apil->img_apil != null){echo base_url('assets/upload/apil/thumbs/'.$apil->img_apil);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>',
            imagezoom: '<?php if($apil->img_apil != null){echo base_url('assets/upload/apil/'.$apil->img_apil);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');} ?>'
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
                           '<h5 class="title">Apill ('+ feature.kode +')</h5>' +
                           '<div class="describe">' +
                              '<div class="grup-info">' +
                                 '<label class="title">Jenis</label>' +
                                 '<label class="isi">' + feature.jenis + '</label>' +
                              '</div>' +
                              '<div class="grup-info">' +
                                 '<label class="title">Letak</label>' +
                                 '<label class="isi">' + feature.letak + '</label>' +
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