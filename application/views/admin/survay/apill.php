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

      .invalid-feedback {
         color: red;
      }
   </style>
</head>

<body class="skin-blue">
   <div class="wrapper">
      <header class="main-header">
         <a href="<?php echo base_url() ?>" target="_blank" class="logo">
            <span class="logo-lg"><b><?= $title; ?></b></span>
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
                  <form enctype="multipart/form-data" id="submit">
                     <div class="row">
                        <div class="col-md-9">
                           <div class="box">
                              <div class="box-body">
                                 <div class="row">
                                    <div class="form-group col-md-2">
                                       <label for="exampleInputEmail1">Lokasi</label><small> (Koordinat)</small>
                                       <input type="text" id="lat" name="korx" class="form-control" placeholder="lat" required>
                                       <input type="text" id="lng" name="kory" class="form-control" placeholder="lng" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                       <label for="exampleInputEmail1">Ruas Jalan</label>
                                       <input type="hidden" id="kdapill" name="kdapill" class="form-control">
                                       <input type="hidden" id="kdjalan" name="kdjalan" class="form-control" placeholder="Kode Jalan" required>
                                       <input type="text" id="ruasjalan" name="ruasjalan" class="form-control" placeholder="Ruas Jalan" required>
                                    </div>
                                    <div class="form-group col-md-2">
                                       <label for="exampleInputEmail1">Km Lokasi</label>
                                       <input type="text" name="kmlokasi" class="form-control" placeholder="Km Lokasi" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                       <label for="exampleInputEmail1">Jenis</label>
                                       <input type="text" name="jenis" class="form-control" placeholder="Jenis" required>
                                    </div>
                                    <div class="form-group col-md-5">
                                       <label for="exampleInputEmail1">Letak</label>
                                       <input type="text" name="letak" class="form-control" placeholder="Letak" required>
                                    </div>
                                    <div class="form-group col-md-3">
                                       <label for="exampleInputEmail1">Kondisi</label>
                                       <select name="status" class="form-control select2" required>
                                          <option value="Terpasang">Terpasang</option>
                                          <option value="Kebutuhan">Kebutuhan</option>
                                          <option value="Rusak">Rusak</option>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="box box-primary">
                              <div class="modal-footer">
                                 <a href="<?php echo base_url('admin/apil/detail/') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                                 <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> <span id="titik">Simpan</span> </button>
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
                  </form>
               </div>
            </div>
         </section>
      </div>
   </div>
</body>

</html>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/select2/select2.full.min.js" type="text/javascript"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() ?>assets/admin/plugins/growl/jquery.growl.js"></script>
<link href="<?php echo base_url() ?>assets/admin/plugins/growl/jquery.growl.css" rel="stylesheet" />
<script src="<?php echo base_url() ?>assets/admin/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/mapopsi.js"></script>
<script>
   let poly;
   let map;
   let latVal = () => $('[name="korx"]').val();
   let lngVal = () => $('[name="kory"]').val();
   $(document).ready(function() {
      // initmap();
      getLocation();
      $(".select2").select2();
   });

   function initmap(tengah) {
      // console.log(tengah)
      let map = new google.maps.Map(document.getElementById('map'), {
         zoom: 9, //default 18
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
         draggable: true,
      });

      google.maps.event.addListener(marker, 'dragend', function(evt) {
         $('[name="korx"]').val(evt.latLng.lat().toFixed(7));
         $('[name="kory"]').val(evt.latLng.lng().toFixed(7));
      });

      $.ajax({
         type: "GET",
         url: "<?php echo base_url('jl') ?>",
         dataType: "json",
         data: {
            perjal: 'apill',
         },
         success: function(data) {
            let ruasjalan = [];
            let namaruas = [];
            let kodejalan = [];
            let infoperjal = [];
            for (j = 0; j < data.ruasjalan.length; j++) {
               let explode = data.ruasjalan[j].lintasan.split('|');
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
               namaruas.push(data.ruasjalan[j].nmruas);
               kodejalan.push(data.ruasjalan[j].kdjalan);
            }


            //ruas jalan
            for (a = 0; a < data.ruasjalan.length; a++) {
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
                  $('[name="kdjalan"]').val(kode);
                  $('[name="ruasjalan"]').val(nama);
               });
            }

            //marker perlengkapan jalan
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

            let iconapill = '<?php echo base_url('assets/upload/apil/thumbs/') ?>';
            let infowindowperjal = null;

            data.perjal.forEach(element => {
               var feature = new google.maps.Marker({
                  position: new google.maps.LatLng(element.lat, element.lng),
                  icon: icons[element.status].icon,
                  map: map
               });

               var contentString = '' +
                  '<div class="marker-holder">' +
                  '<div class="marker-company-thumbnail"><div class="crop-to-square"><div class="crop-to-square-positioner"><a id="happy-img" data-toggle="modal" data-target="#exampleModal" data-id=""><img src="' + iconapill + element.image + '" class="crop-to-square-img" alt=""></a></div></div></div>' +
                  '<div class="map-item-info">' +
                  '<h5 class="title">Apill (' + element.kd_apill + ')</h5>' +
                  '<div class="describe">' +
                  '<div class="grup-info">' +
                  '<label class="title">Ruas</label>' +
                  '<label class="isi">' + element.nm_ruas + '</label>' +
                  '</div>' +
                  '<div class="grup-info">' +
                  '<label class="title">Jenis</label>' +
                  '<label class="isi">' + element.jenis + '</label>' +
                  '</div>' +
                  '<div class="grup-info">' +
                  '<label class="title">Letak</label>' +
                  '<label class="isi">' + element.letak + '</label>' +
                  '</div>' +
                  '<div class="grup-info">' +
                  '<label class="title">Status</label>' +
                  '<label class="isi">' + element.status + '</label>' +
                  '</div>' +
                  '</div>' +
                  '</div>' +
                  '<button onclick=' +
                  '\'edit({' +
                  'kd_apill: "' + element.kd_apill + '", ' +
                  'kd_jalan: "' + element.kd_jalan + '", ' +
                  'nm_ruas: "' + element.nm_ruas + '", ' +
                  'km_lokasi: "' + element.km_lokasi + '", ' +
                  'jenis: "' + element.jenis + '", ' +
                  'thn_pengadaan: "' + element.thn_pengadaan + '", ' +
                  'letak: "' + element.letak + '", ' +
                  'status: "' + element.status + '", ' +
                  'lat: "' + element.lat + '", ' +
                  'lng: "' + element.lng + '", ' +
                  'img: "' + element.image + '"})\'>' +
                  'edit</button>'
               '</div>' +
               '</div>';

               google.maps.event.addListener(feature, 'click', function() {
                  if (infowindowperjal) {
                     infowindowperjal.close();
                  }
                  infowindowperjal = new google.maps.InfoWindow();
                  infowindowperjal.setContent(contentString)
                  infowindowperjal.open(map, feature);
               });
            });

            // console.log(data.perjal[0]);
         },
      });
      addYourLocationButton(map, marker);
      $('[name="korx"]').val(tengah.lat);
      $('[name="kory"]').val(tengah.lng);
   }

   function edit(obj) {
      $('[name="korx"]').val(obj.lat);
      $('[name="kory"]').val(obj.lng);
      $('[name="kdapill"]').val(obj.kd_apill);
      $('[name="kdjalan"]').val(obj.kd_jalan);
      $('[name="ruasjalan"]').val(obj.nm_ruas);
      $('[name="kmlokasi"]').val(obj.km_lokasi);
      $('[name="jenis"]').val(obj.jenis);
      $('[name="letak"]').val(obj.letak);
      $('[name="status"]').val(obj.status).trigger('change');
      // console.log(obj);
   }

   $('#submit').validate({
      rules: {
         korx: {
            required: true
         },
         kory: {
            required: true
         },
         kdjalan: {
            required: true,
         },
         kmlokasi: {
            required: true,
            number: true
         },
         jenis: {
            required: true,
         },
         letak: {
            required: true,
         },
         status: {
            required: true,
         },
      },
      messages: {
         korx: "Koordinat X Tidak Harus diisi",
         kory: "Koordinat Y Tidak Harus diisi",
         ruasjalan: "Nama Ruas Harus dipilih",
         kmlokasi: "Kilometer Lokasi harus diisi",
         jenis: "Jenis harus diisi",
         letak: "Letak  harus diisi",
         status: "Status harus diisi",
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
         error.addClass('invalid-feedback');
         element.closest('.form-group').append(error);
      },
      highlight: function(element, errorClass, validClass) {
         $(element).addClass('is-invalid');
      },
      unhighlight: function(element, errorClass, validClass) {
         $(element).removeClass('is-invalid');
      }
   });

   $('#submit').submit(function(e) {
      e.preventDefault();
      if ($('#submit').valid()) {
         $.ajax({
            url: "<?= base_url('apill') ?>",
            type: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            cache: false,
            async: false,
            beforeSend: function() {
               $('#titik').html('Menyimpan');
            },
            success: function(data) {
               //if success close modal and reload ajax table
               // $('#modal-lg').modal('hide');
               $.growl.notice({
                  message: "Data Berhasil Disimpan"
               });
               $('#titik').html('Simpan');
               $('[name="kmlokasi"]').val('');
               $('[name="jenis"]').val('');
               $('[name="letak"]').val('');
               // alert(data);
            },
            error: function(jqXHR, textStatus, errorThrown) {
               alert('Error adding / update data');
            }
         });
      }
   })
</script>