<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<a href="#" data-toggle="modal" data-target="#hapus<?php echo $list->kd_marka ?>"><button class="btn btn-xs btn-flat btn-danger" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fa fa-trash"></i></button></a>
<div id="hapus<?php echo $list->kd_marka ?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
             <h4 class="modal-title">Konfirmasi</h4>
         </div>
         <div class="modal-body" style="background:#46b8da;color:#fff">
             Apakah Anda ingin menghapus data ini?
         </div>
         <div class="modal-footer">
             <a href="<?php echo base_url('admin/marka/delete/'.$list->kd_jalan.'/'.$list->kd_marka) ?>" class="btn btn-info btn-flat" id="hapus-true">Ya</a>
             <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
         </div>
      </div>
   </div>
</div>