<?php
$this->authlogin->cek_login();
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <title><?php echo $title ?></title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="icon" href="<?php echo base_url() ?>assets/admin/icon.png" sizes="32x32">
   <link href="<?php echo base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/select2/select2.css" rel="stylesheet" />
   <link href="<?php echo base_url() ?>assets/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
   <style>
      #map {
         height: 100% !important;
         width: 100% !important;
      }
   </style>
</head>

<body class="skin-blue">
   <div class="wrapper">
      <header class="main-header">
         <a href="<?php echo base_url() ?>" target="_blank" class="logo">
            <span class="logo-mini"><b>D</b>H</span>
            <span class="logo-lg"><b>Survay <?= $title; ?></b></span>
         </a>
         <nav class="navbar navbar-static-top" role="navigation">
            <div class="navbar-custom-menu">
               <ul class="nav navbar-nav">
                  <li class="dropdown user user-menu">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php echo base_url() ?>assets/admin/img/photo.png" class="user-image" alt="User Image" />
                        <span class="hidden-xs">Admin</span>
                     </a>
                     <ul class="dropdown-menu">
                        <li class="user-header">
                           <img src="<?php echo base_url() ?>assets/admin/img/profile.png" class="img-circle" alt="User Image" />
                           <p><?php echo $this->session->userdata('nama'); ?></p>
                        </li>
                        <li class="user-footer">
                           <div class="pull-left">
                              <a href="<?php echo base_url('admin/profil') ?>" class="btn btn-default btn-flat">Profil</a>
                           </div>
                           <div class="pull-right">
                              <a href="<?php echo base_url('kelola/logout') ?>" class="btn btn-default btn-flat">Log out</a>
                           </div>
                        </li>
                     </ul>
                  </li>
                  <li>
                     <div id="kosong"></div>
                  </li>
               </ul>
            </div>
         </nav>
      </header>
      <div class="wrapper">
         <section class="content no-padding">
            <div class="row">
               <div class="col-md-12" style="height: 400px;">
                  <div id="map"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <?php
                  echo validation_errors('<div class="alert alert-warning">', '</div>');
                  if (isset($error)) {
                     echo '<div class="alert alert-warning">';
                     echo $error;
                     echo '</div>';
                  }
                  echo form_open_multipart(base_url('admin/survay/addapill/'), array('onsubmit' => 'return ValidasiKoordinat()'));
                  ?>
                  <div class="row" style="padding: 0px;">
                     <div class="col-md-12">

                     </div>
                     <div class="col-md-3">
                        <div class="box box-primary">
                           <div class="modal-footer">
                              <a href="<?php echo base_url('admin/survay') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                              <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                           </div>
                        </div>
                        <div class="box box-primary">
                           <div class="box-body">
                              <div class="form-group">
                                 <input type="file" name="gambar" accept=".jpg, .jpeg" class="filestyle" data-buttonText="Foto April" data-buttonBefore="true" data-iconName="fa fa-upload">
                                 <small>
                                    <p class="help-block">.JPG Max. 1 Mb (800x500)</p>
                                 </small>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php echo form_close(); ?>
               </div>
            </div>
         </section>
      </div>
   </div>
</body>

</html>
<script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/select2/select2.full.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc"></script>
<script src="https://cdn.klokantech.com/maptilerlayer/v1/index.js"></script>
<script>
   let poly;
   let map;
   $(document).ready(function() {
      // initmap();
      getLocation();
   });

   function addYourLocationButton(map, marker) {
      var controlDiv = document.createElement('div');

      var firstChild = document.createElement('button');
      firstChild.style.backgroundColor = '#fff';
      firstChild.style.border = 'none';
      firstChild.style.outline = 'none';
      firstChild.style.width = '28px';
      firstChild.style.height = '28px';
      firstChild.style.borderRadius = '2px';
      firstChild.style.boxShadow = '0 1px 4px rgba(0,0,0,0.3)';
      firstChild.style.cursor = 'pointer';
      firstChild.style.marginRight = '10px';
      firstChild.style.padding = '0';
      firstChild.title = 'Your Location';
      controlDiv.appendChild(firstChild);

      var secondChild = document.createElement('div');
      secondChild.style.margin = '5px';
      secondChild.style.width = '18px';
      secondChild.style.height = '18px';
      secondChild.style.backgroundImage = 'url(https://maps.gstatic.com/tactile/mylocation/mylocation-sprite-2x.png)';
      secondChild.style.backgroundSize = '180px 18px';
      secondChild.style.backgroundPosition = '0 0';
      secondChild.style.backgroundRepeat = 'no-repeat';
      firstChild.appendChild(secondChild);

      google.maps.event.addListener(map, 'center_changed', function() {
         secondChild.style['background-position'] = '0 0';
      });

      firstChild.addEventListener('click', function() {
         var imgX = '0',
            animationInterval = setInterval(function() {
               imgX = imgX === '-18' ? '0' : '-18';
               secondChild.style['background-position'] = imgX + 'px 0';
            }, 500);

         if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
               var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
               map.setCenter(latlng);
               clearInterval(animationInterval);
               secondChild.style['background-position'] = '-144px 0';
            });
         } else {
            clearInterval(animationInterval);
            secondChild.style['background-position'] = '0 0';
         }
      });

      controlDiv.index = 1;
      map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(controlDiv);
   }

   function getLocation() {
      if (navigator.geolocation) {
         navigator.geolocation.getCurrentPosition(function(position) {
            var tengah = {
               lat: position.coords.latitude,
               lng: position.coords.longitude,
            };
            initmap(tengah);
         });
      } else {
         x.innerHTML = "Geolocation is not supported by this browser.";
      }
   }

   function initmap(tengah) {
      console.log(tengah)
      let map = new google.maps.Map(document.getElementById('map'), {
         zoom: 18,
         center: tengah,
         zoomControl: false,
         disableDefaultUI: true,
         fullscreenControl: true,
         mapTypeControl: true,
      });

      const icon = {
         url: '<?= base_url('assets/admin/img/walking.gif'); ?>', // url
         scaledSize: new google.maps.Size(50, 50), // scaled size
      };

      var marker = new google.maps.Marker({
         position: tengah,
         icon: icon,
         map: map,
      });

      $.ajax({
         type: "GET",
         url: "<?php echo base_url('admin/survay/jalan') ?>",
         dataType: "json",
         success: function(data) {
            let ruasjalan = [];
            let namaruas = [];
            let kodejalan = [];
            for (j = 0; j < data.length; j++) {
               let explode = data[j].lintasan.split('|');
               const arr = explode.map(coor => {
                  return coor.replace(",", "#").split("#"); // replace will only replace the first comma
               });
               let coordarray = [];
               for (i = 0; i < arr.length; i++) {
                  let lat = arr[i][1];
                  let lng = arr[i][0];
                  let linecoord = {
                     'lat': parseFloat(lat),
                     'lng': parseFloat(lng)
                  };
                  coordarray.push(linecoord);
               }
               ruasjalan.push(coordarray);
               namaruas.push(data[j].nmruas);
               kodejalan.push(data[j].kdjalan);
            }
            for (a = 0; a < data.length; a++) {
               let randomnumber = Math.floor(Math.random() * 7);

               let colors = ["#FF0000", "#00ffff", "#FF00ff", "#Ffff00", "#555555", "#222222"];
               let routeLine = new google.maps.Polyline({
                  path: ruasjalan[a],
                  strokeColor: colors[randomnumber],
                  strokeOpacity: 2.0,
                  strokeWeight: 4,
               });
               routeLine.setMap(map);
               let nama = namaruas[a];
               let kode = kodejalan[a];
               var infowindow = new google.maps.InfoWindow()
               routeLine.addListener('click', function(event) {
                  infowindow.setContent('Ruas Jl. ' +
                     nama);
                  infowindow.open(map);
                  infowindow.setPosition(event.latLng);
               });
            }
            console.log(ruasjalan);
         },
      });
      addYourLocationButton(map, marker);
   }
</script>