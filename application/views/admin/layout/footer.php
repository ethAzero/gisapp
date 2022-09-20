      <footer class="main-footer">
         <div class="pull-right hidden-xs">
            <b>Version</b> 2.5.0
         </div>
         <strong>Copyright &copy; <?php date_default_timezone_set("Asia/Bangkok");
                                    echo date('Y'); ?> <a href="http://perhubungan.jatengprov.go.id/" data-toggle="tooltip" data-placement="top" title="Dinas Perhubungan Provinsi Jawa Tengah" target="_blank">Dinas Perhubungan Jateng</a></strong> All rights reserved.
      </footer>
      </div>
      </body>

      </html>
      <script type="text/javascript">
         function loader(id1, id2) {
            $(id1).html('<center><img width=\'50px\' height=\'50px\' src="<?= base_url('assets/admin/img/loaders1.gif'); ?>" /> <br />Memuat Data...</center>');
            $(id2).html('<center><img width=\'50px\' height=\'50px\' src="<?= base_url('assets/admin/img/loaders1.gif'); ?>" /> <br />Memuat Data...</center>');
         }

         function removeLoader(id1, id2) {
            $(id1).html("");
            $(id2).html("");
         }

         let tahunVal = () => $('#tahun').val();
         let bidangbalaiVal = () => $('#bidangbalai').val();


         $(document).ready(function() {
            $(".gallery").latae({
               loader: '<?php echo base_url() ?>assets/admin/img/loader.gif',
               init: function() {
                  console.log('bonjour');
               },
               loadPicture: function(event, img) {
                  console.log($(img));
               },
               resize: function(event, gallery) {
                  console.log(gallery);
               },
               displayTitle: false
            });

            $(".select2").select2();
            $('#datepicker').datepicker({
               autoclose: true,
               format: 'yyyy-mm-dd'
            });

            getDataFilter(tahunVal(), bidangbalaiVal());
            jml_notif_unread();
            setInterval(jml_notif_unread, 1000);
            charttahun();
         });

         function getDataFilter(tahun, bidangbalai) {
            $.ajax({
               type: "GET",
               url: "<?= base_url('/admin/dashboard/getDataFilter') ?>",
               data: {
                  tahunVal: tahun,
                  bidangbalaiVal: bidangbalai
               },
               dataType: "json",
               beforeSend: function() {
                  $('#loader1').html("");
                  $('#loader2').html("");
                  loader("#loader1", "#loader2");
               },
               success: function(data) {
                  // alert(data.chartbulan.length);
                  let aduanbychanel = $('#aduanbychanel');
                  let aduanbulanan = $('#tidakada');
                  aduanbychanel.html('');
                  aduanbulanan.html('');

                  let chartStatus = Chart.getChart("chartMonthly");
                  if (chartStatus != undefined) {
                     chartStatus.destroy();
                  }
                  var chartCanvas = $('#chartMonthly'); //<canvas> id
                  chartInstance = new Chart(chartCanvas, config = {
                     type: 'line',
                     data: data.chartbulan,
                     options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        aspectRatio: 4,
                        plugins: {
                           legend: {
                              position: 'bottom',
                           }
                        }
                     }
                  }, );

                  if (data.chanel.length != 0) {
                     let fa;
                     let $fatext;
                     data.chanel.forEach((chanel) => {
                        if (chanel.id_chanel_aduan === '1') {
                           fa = "fa-warning";
                           bgcolor = "bg-yellow";
                        } else if (chanel.id_chanel_aduan === '2') {
                           fa = "fa-instagram";
                           bgcolor = "bg-red";
                        } else if (chanel.id_chanel_aduan === '3') {
                           fa = "fa-whatsapp";
                           bgcolor = "bg-green";
                        } else {
                           fa = "fa-twitter";
                           bgcolor = "bg-blue";
                        };
                        aduanbychanel.append('<div class = \'col-md-3 col-sm-6 col-xs-12\'> <div class = \'info-box\'> <span class = \"info-box-icon ' + bgcolor + '\" > <i class = "fa fa-brand ' + fa + '\"></i></span> <div class = \'info-box-content\'> <span class = \'info-box-text\'>' + chanel.chanel_aduan + '</span> <span class = \'info-box-number\'>' + chanel.jml_aduan + '<small> Aduan</small></span> </div > </div> </div >');
                        removeLoader("#loader1", "#loader2");
                     });
                  } else {
                     aduanbychanel.append('<div class =\'col-md-12 col-sm-12 col-xs-12\'><div class =\'info-box\'> <center style=\'padding-top:35px\'><i class=\'fa fa-info fa-solid text-red\'> Tidak Ada Data Aduan</i></center></div></div><br>');
                     //aduanbulanan.height('300px');
                     aduanbulanan.html('<div class =\'col-md-12 col-sm-12 col-xs-12\' style=\'position:absolute; padding-top:130px;\'><center><i class=\'fa fa-info fa-solid text-red\'> Tidak Ada Data Aduan</i></center></div>');
                     removeLoader("#loader1", "#loader2");
                  };
               },
            })
         }

         function jml_notif_unread() {
            hakakses = "<?= $this->session->userdata('hakakses'); ?>";
            if (hakakses == 'AD') {
               url = "<?= base_url('/admin/dashboard/get_aduanTanggap') ?>";
            } else if (hakakses == '01' || hakakses == '02' || hakakses == '03' || hakakses == '04' || hakakses == '04' || hakakses == '06' || hakakses == 'S' || hakakses == 'A') {
               url = "<?= base_url('/admin/dashboard/get_aduanUnread') ?>";
            };

            $.ajax({
               url: url,
               type: 'post',
               dataType: 'json',
               success: function(data) {
                  let ulnotif = $('#notif_unread');
                  if (data.unread == 0) {
                     $('#num_warning1').hide();
                     if (hakakses == 'AD') {
                        $('#num_warning2').text("Belum Ada Tanggapan Baru");
                     } else if (hakakses == '01' || hakakses == '02' || hakakses == '03' || hakakses == '04' || hakakses == '04' || hakakses == '06' || hakakses == 'S' || hakakses == 'A') {
                        $('#num_warning2').text("Belum Ada Aduan Baru");
                     };
                     $('#num_warning3').hide();
                  } else {
                     $('#num_warning1').text(data.unread);
                     if (hakakses == 'AD') {
                        $('#num_warning2').text("Terdapat " + data.unread + " Tanggapan Belum Dibaca");
                     } else if (hakakses == '01' || hakakses == '02' || hakakses == '03' || hakakses == '04' || hakakses == '04' || hakakses == '06' || hakakses == 'S' || hakakses == 'A') {
                        $('#num_warning2').text("Terdapat " + data.unread + " Aduan Baru");
                     };

                     $('#num_warning3').text(data.unread);
                     $('#num_warning1').toggle("highlight");
                     $('#num_warning3').toggle("highlight");
                  }

                  ulnotif.html('');
                  let fa;
                  let fatext;
                  data.notif.forEach((notif) => {
                     if (notif.id_chanel_aduan === '1') {
                        fa = "fa-warning";
                        fatext = "text-yellow";
                     } else if (notif.id_chanel_aduan === '2') {
                        fa = "fa-instagram";
                        fatext = "text-red";
                     } else if (notif.id_chanel_aduan === '3') {
                        fa = "fa-whatsapp";
                        fatext = "text-green";
                     } else if (notif.id_chanel_aduan === '4') {
                        fa = "fa-twitter";
                        fatext = "text-blue";
                     };
                     ulnotif.append('<li><a href=\'<?php echo base_url('admin/aduan/detail') ?>/' + notif.id_aduan + '\'><i class=\'fa fa-brand ' + fa + ' ' + fatext + '\'></i><label>' + notif.chanel_aduan + '</label> <br>' + notif.aduan + '</a></li>')
                  });
               }
            });
         }

         function loadlapsurvei() {
            tanggalVal = $("#datepicker").val();
            koderuasVal = $("#nmruas").val();
            jenisperjalVal = $("#jenisperjal").val();

            if (jenisperjalVal == 'apil') {
               baseimage = '<?= base_url('assets/upload/apil/thumbs/') ?>';
            } else if (jenisperjalVal == 'pju') {
               baseimage = '<?= base_url('assets/upload/pju/thumbs/') ?>';
            } else if (jenisperjalVal == 'cermin') {
               baseimage = '<?= base_url('assets/upload/cermin/thumbs/') ?>';
            } else if (jenisperjalVal == 'delinator') {
               baseimage = '<?= base_url('assets/upload/delinator/thumbs/') ?>';
            } else if (jenisperjalVal == 'flash') {
               baseimage = '<?= base_url('assets/upload/flash/thumbs/') ?>';
            } else if (jenisperjalVal == 'guardrail') {
               baseimage = '<?= base_url('assets/upload/guardrail/thumbs/') ?>';
            } else if (jenisperjalVal == 'marka') {
               baseimage = '<?= base_url('assets/upload/marka/thumbs/') ?>';
            } else if (jenisperjalVal == 'rambu') {
               baseimage = '<?= base_url('assets/upload/rambu/thumbs/') ?>';
            } else if (jenisperjalVal == 'rppj') {
               baseimage = '<?= base_url('assets/upload/rppj/thumbs/') ?>';
            };

            $.ajax({
               type: 'GET',
               url: '<?= base_url('getLapSurvei') ?>',
               data: {
                  jenisperjal: jenisperjalVal,
                  ruasjalan: koderuasVal,
                  tanggal: tanggalVal,
               },
               dataType: 'JSON',
               success: function(d) {
                  $("#tabellaporan").DataTable({
                     destroy: true,
                     data: d.data.data,
                     columns: d.data.columns,
                     columnDefs: [{
                        'targets': 0,
                        'render': function(data, type, row, meta) {
                           if (data === '') {
                              return '-';
                           } else {
                              return '<img height="75%" width="75%" src="' + baseimage + data + '"/>';
                           }
                        },
                     }]
                  });
                  console.log(d);
                  $("#cetakexcel").show();
               }
            });
         }

         function cetak() {
            tanggalVal = $("#datepicker").val();
            koderuasVal = $("#nmruas").val();
            jenisperjalVal = $("#jenisperjal").val();
            url = '<?= base_url('cetaklapsurvei') ?>';
            window.location.href = '' + url + '?jenisperjal=' + jenisperjalVal + '&ruasjalan=' + koderuasVal + '&tanggal=' + tanggalVal;
         }

         let charttahun = () => $.ajax({
            url: "<?= base_url('/admin/dashboard/get_YearlyChart') ?>",
            type: 'GET',
            dataType: 'json',
            success: function(DataChart) {
               const ChartAduanTahunan = new Chart(
                  document.getElementById('chartPie'),
                  config = {
                     type: 'bar',
                     data: DataChart,
                     options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        aspectRatio: 2,
                        plugins: {
                           legend: {
                              position: 'bottom',
                           }
                        }
                     }
                  },
               );
            },
         });
      </script>

      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/app.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/datepicker/bootstrap-datepicker.min.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/dataTables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/chartjs/chart.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/dataTables/dataTables.bootstrap.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/filestyle.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>assets/theme/js/apps.js"></script>