<div class="content-wrapper">
   <section class="content">
      <?php
      $hakakses = $this->session->userdata('hakakses');
      if ($hakakses != 'AJ' and $hakakses != 'JT' and $hakakses != 'LL' and $hakakses != 'PE' and $hakakses != '07') { ?>
         <div class="row">
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/apill'); ?>">
                  <div class='info-box'> <span class="info-box-icon bg-red"> <i class="fa fa-brand icon-apill text-black"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>APILL</span> <span class='info-box-number'><small> Survei</small> APILL</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/cermin'); ?>">
                  <div class='info-box'> <span class="info-box-icon"> <i class="fa fa-brand icon-cermin"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Cermin Tikung</span> <span class='info-box-number'><small> Survei</small> Cermin Tikung</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/delinator'); ?>">
                  <div class='info-box'> <span class="info-box-icon bg-green"> <i class="fa fa-brand icon-delinator"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Delinator</span> <span class='info-box-number'><small> Survei</small> Delinator</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/flash'); ?>">
                  <div class='info-box'> <span class="info-box-icon"> <i class="fa fa-brand icon-flash"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>WL</span> <span class='info-box-number'><small> Survei</small> Warning Light</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/guardrail'); ?>">
                  <div class='info-box'> <span class="info-box-icon bg-teal "> <i class="fa fa-brand icon-guardrail"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>GR</span> <span class='info-box-number'><small> Survei</small> Guardrail</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/marka'); ?>">
                  <div class='info-box'> <span class="info-box-icon bg-black "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Marka</span> <span class='info-box-number'><small> Survei</small> Marka Jalan</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/pju'); ?>">
                  <div class='info-box'> <span class="info-box-icon bg-blue "> <i class="fa fa-brand icon-pju"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>PJU</span> <span class='info-box-number'><small> Survei</small> PJU</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/rambu'); ?>">
                  <div class='info-box'> <span class="info-box-icon bg-Navy "> <i class="fa fa-brand icon-rambu"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Rambu</span> <span class='info-box-number'><small> Survei</small> Rambu</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/rppj'); ?>">
                  <div class='info-box'> <span class="info-box-icon "> <i class="fa fa-brand icon-rppj"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>RPPJ</span> <span class='info-box-number'><small> Survei</small> RPPJ</span> </div>
                  </div>
               </a>
            </div>
         </div>
</div>
<?php } ?>
</section>
</div>