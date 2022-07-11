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
   $(document).ready(function () {
      $(".gallery").latae({
         loader : '<?php echo base_url() ?>assets/admin/img/loader.gif',
         init : function() { console.log('bonjour'); },
         loadPicture : function(event, img) { console.log($(img)); },
         resize : function(event, gallery) { console.log(gallery); },
         displayTitle: false
      });
      $('#dataTables-example').dataTable();
      $('#dataTables-example1').DataTable( {
           dom: 'Bfrtip',
           buttons: [
               'copy', 'csv', 'excel', 'pdf', 'print'
           ]
      } );
      $(".select2").select2();
   });
</script>