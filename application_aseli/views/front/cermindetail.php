<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="admin-content-main">
   <div class="title-detail">Detail Cermin</div>
   <div class="box-detail">
      <div class="row">
         <div class="col-md-3">
            <?php if ($cermin->img_cermin != null): ?>
               <img class="image-full" src="<?php echo base_url('assets/upload/cermin/'.$cermin->img_cermin) ?>">  
            <?php else: ?>
               <img class="image-full" src="<?php echo base_url('assets/theme/img/map-marker-logo.jpg') ?>">  
            <?php endif ?>
         </div>
         <div class="col-md-9">
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-2 small-title">Kode</div>
                  <div class="col-md-10"><?php echo $cermin->kd_cermin ?></div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-2 small-title">Ruas Jalan</div>
                  <div class="col-md-10"><?php echo $cermin->nm_ruas ?></div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-2 small-title">Jenis</div>
                  <div class="col-md-10"><?php echo $cermin->jenis ?></div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-2 small-title">Letak</div>
                  <div class="col-md-10"><?php echo $cermin->letak ?></div>
                  </div>
               </div>
               <div class="col-md-12">
                  <div class="row">
                  <div class="col-md-2 small-title">Status</div>
                  <div class="col-md-10"><?php echo $cermin->status ?></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
