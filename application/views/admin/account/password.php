<a href="#" data-toggle="modal" data-target="#hapus<?php echo "string";  ?>"><button class="btn btn-xs btn-default btn-flat" data-toggle="tooltip" data-placement="top" title="Ganti Password"><i class="fa fa-pencil"></i></button></a>
<div id="hapus<?php echo "string";  ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Ganti Password</h4>
         </div>
         <div class="box">
         <div class="box-body">
            <?php echo form_open(); ?>
            <div class="row">
            <div class="form-group col-md-12">
               <label for="exampleInputEmail1">Password</label><font color="#696969"> (Min 6 Karakter, Max 32 Karakter)</font></small>
               <input type="password" name="password" class="form-control" placeholder="Password" >
            </div>
            </div>
            <?php echo form_close(); ?>
         </div>
         </div>
         <div class="modal-footer">
            <a href="<?php echo base_url('') ?>" class="btn btn-info btn-flat" id="hapus-true">Ya</a>
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
         </div>
      </div>
   </div>
</div>