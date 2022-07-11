<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<style type="text/css">

.dropdown.dropdown-lg .dropdown-menu {

    margin-top: -1px;

    padding: 6px 20px;

}

.input-group-btn .btn-group {

    display: flex !important;

}

.btn-group .btn {

    border-radius: 0;

    margin-left: -1px;

}

.btn-group .btn:last-child {

    border-top-right-radius: 4px;

    border-bottom-right-radius: 4px;

}

.btn-group .form-horizontal .btn[type="submit"] {

  border-top-left-radius: 4px;

  border-bottom-left-radius: 4px;

}

.form-horizontal .form-group {

    margin-left: 0;

    margin-right: 0;

}

.form-group .form-control:last-child {

    border-top-left-radius: 4px;

    border-bottom-left-radius: 4px;

}



@media screen and (min-width: 768px) {

    #adv-search {

        width: 500px;

        margin: 0 auto;

    }

    .dropdown.dropdown-lg {

        position: static !important;

    }

    .dropdown.dropdown-lg .dropdown-menu {

        min-width: 500px;

    }

}

#map{

	height: 200px!important;

}

</style>

<link rel="stylesheet" href="<?php echo base_url();?>assets/theme/css/jquery-ui.css">

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="<?php echo base_url();?>assets/theme/js/jquery-ui.js"></script>

<div id="page-wrapper" class="fullscreenmap">

			<br>

   			<div class="input-group" id="adv-search">

            	<input id="search" type="text" class="form-control" placeholder="Cari trayek" />

                <div class="input-group-btn">

                    <div class="btn-group" role="group">

                        <div class="dropdown dropdown-lg">

                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="margin-right:0px!important;"><span class="caret"></span></button>

                            <div class="dropdown-menu dropdown-menu-right" role="menu">

                                <form class="form-horizontal" role="form">

                                  <div class="form-group">

                                    <label for="filter">Filter by</label>

                                    <select class="form-control" id="filter">

                                      <option value="" selected>Semua Trayek</option>

                                    <?php 

                                    foreach ($list as $row) {

                                    ?>

                                        <option value="<?php echo $row->kd_trayek;?>"><?php echo $row->nama_trayek;?></option>

                                    <?php

                                    };?>

                                    </select>

                                  </div>

                                  <div class="form-group">

                                    <label for="contain">Kode Trayek</label>

                                    <input id="kode_trayek" class="form-control" type="text" />

                                  </div>

                                  <!-- <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button> -->

                                </form>

                            </div>

                        </div>

                        <button id="findButton" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>

                    </div>

                </div>

            </div>

            <br>

            <div id="map"></div>

</div>

<script>

function myMap() {

   var tengah = {lat: -7.3904214, lng: 110.0176238};

   var map = new google.maps.Map(document.getElementById('map'), {

      zoom: 9,

      center: tengah

   });



   $("#findButton").on("click", function(){

            var filter = $('#filter').val();

            var kode = $('#kode_trayek').val();

            var search = $('#search').val() ;

            

            var ctaLayer = new google.maps.KmlLayer({

             url: '<?php echo base_url();?>'+'trayek/kml'+'?dummy='+(new Date()).getTime()+'&filter='+filter+'&kode='+kode+'&search='+search,

             map: map

            });

            console.log(ctaLayer);

  });

   

   

}







$("#search").autocomplete({

      source: function (request, response) {

                $.getJSON("<?php echo site_url('trayek/getTrayekData'); ?>?term=" + request.term, function (data) {

                    response($.map(data, function (value, key) {

                        return {

                            label: value.nama_trayek

                        };

                    }));

                });

            },

      select: function( event, ui ) {

                event.preventDefault();

                $("#search").val(ui.item.label);

            },

            // minLength: 2,

      delay: 100

});

</script>