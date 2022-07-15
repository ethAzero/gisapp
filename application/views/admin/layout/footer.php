      <footer class="main-footer">
         <div class="pull-right hidden-xs">
            <b>Version</b> 2.5.0
         </div>
         <strong>Copyright &copy; 2017 <a href="http://perhubungan.jatengprov.go.id/" data-toggle="tooltip" data-placement="top" title="Dinas Perhubungan Provinsi Jawa Tengah" target="_blank">Dinas Perhubungan Jateng</a></strong> All rights reserved.
      </footer>
      </div>
      </body>

      </html>

      <script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/app.min.js" type="text/javascript"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/dataTables/jquery.dataTables.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/plugins/dataTables/dataTables.bootstrap.js"></script>
      <script src="<?php echo base_url() ?>assets/admin/js/filestyle.js"></script>
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
            $.ajax({
               url: "<?= base_url('/admin/dashboard/get_aduanUnread') ?>",
               type: 'post',
               dataType: 'json',
               success: function(data) {
                  let ulnotif = $('#notif_unread');
                  $('#num_warning1').text(data.unread);
                  $('#num_warning2').text(data.unread);
                  $('#num_warning1').toggle("highlight");

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
                     ulnotif.append('<li><a href=\'#\'><i class=\'fa fa-brand ' + fa + ' ' + fatext + '\'></i><label>' + data.notif[i].chanel_aduan + '</label> <br>' + data.notif[i].aduan + '</a></li>')
                  }
               }
            });
         }
      </script>