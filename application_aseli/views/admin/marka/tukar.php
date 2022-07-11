<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<a href="#" data-toggle="modal" data-target="#tukar<?php echo $list->kd_marka ?>"><button class="btn btn-xs btn-flat btn-primary" data-toggle="tooltip" data-placement="top" title="Pindah Ruas Jalan"><i class="fa fa-exchange"></i></button></a>
<div id="tukar<?php echo $list->kd_marka ?>" class="modal fade" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header" style="background:#46b8da;color:#fff;text-align: left;">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title">Ubah Ruas Jalan</h4>
         </div>
         <?php echo form_open(base_url('admin/marka/tukar/'.$list->kd_jalan.'/'.$list->kd_marka));  ?>
         <div class="col-md-12">
            <div class="modal-body">
               <div class="row">
                  <div class="form-group col-md-12">
                     <label for="exampleInputEmail1">Kode Marka</label>
                     <input type="text" name="kode" maxlength="30" maxlength="4" disabled class="form-control" value="<?php echo $list->kd_marka ?>">
                  </div>
                  <div class="form-group col-md-12">
                     <input type="hidden" name="ruas" value="<?php echo $list->kd_jalan ?>">
                     <label for="exampleInputEmail1">Ruas Jalan Provinsi</label>
                     <select name="kdruas" class="form-control select2" required>
                           <option value="">==== Pilih Ruas Jalan Provinsi ====</option>
                        <?php foreach ($listjalan as $key => $j): ?>
                           <option value="<?php echo $j->kd_jalan ?>" <?php if($j->kd_jalan === $list->kd_jalan){echo "selected";} ?>><?php echo $j->nm_ruas ?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
               </div>
            </div>
         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
            <button class="btn btn-primary btn-flat" name="submit" type="submit" /><i class="fa fa-save"></i> Simpan</button>
         </div>
         <?php echo form_close(); ?>
      </div>
   </div>
</div>