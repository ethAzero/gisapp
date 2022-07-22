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
            $('#dataTables-example').dataTable();
            $('#dataTables-example1').DataTable({
               dom: 'Bfrtip',
               buttons: [
                  'copy', 'csv', 'excel', 'pdf', 'print'
               ]
            });
            $(".select2").select2();

            jml_notif_unread();
            setInterval(jml_notif_unread, 1000)
         });

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
                  for (let i = 0; i <= data.notif.length; ++i) {
                     let fa;
                     let $fatext;
                     if (data.notif[i].id_chanel_aduan == 1) {
                        fa = "fa-warning";
                        fatext = "text-yellow";
                     } else if (data.notif[i].id_chanel_aduan == 2) {
                        fa = "fa-instagram";
                        fatext = "text-red";
                     } else if (data.notif[i].id_chanel_aduan == 3) {
                        fa = "fa-whatsapp";
                        fatext = "text-green";
                     } else {
                        fa = "fa-twitter";
                        fatext = "text-blue";
                     };
                     ulnotif.append('<li><a href=\'<?php echo base_url('admin/aduan/detail') ?>/' + data.notif[i].id_aduan + '\'><i class=\'fa fa-brand ' + fa + ' ' + fatext + '\'></i><label>' + data.notif[i].chanel_aduan + '</label> <br>' + data.notif[i].aduan + '</a></li>')
                  }
               }
            });
         }
      </script>
      <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc&callback=myMap"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/app.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/dataTables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/dataTables/dataTables.bootstrap.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/filestyle.js"></script>
      <script type="text/javascript" src="<?php echo base_url() ?>assets/theme/js/apps.js"></script>