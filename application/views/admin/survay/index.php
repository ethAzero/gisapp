<div class="content-wrapper">
   <section class="content">
      <?php
      $hakakses = $this->session->userdata('hakakses');
      if ($hakakses != 'AJ' and $hakakses != 'JT' and $hakakses != 'LL' and $hakakses != 'PE' and $hakakses != '07') { ?>
         <div class="row">
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="<?= base_url('/admin/survay/apill'); ?>">
                  <div class='info-box'> <span class="info-box-icon bg-purple"> <i class="fa fa-brand fa-road text-black"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>APILL</span> <span class='info-box-number'><small> Survay</small> APILL</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-orange"> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Cermin Tikung</span> <span class='info-box-number'><small> Survay</small> Cermin Tikung</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-Success "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Delinator</span> <span class='info-box-number'><small> Survay</small> Delinator</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-Warning "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>WL</span> <span class='info-box-number'><small> Survay</small> Warning Light</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-Danger "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>GR</span> <span class='info-box-number'><small> Survay</small> Guardrail</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-black "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Marka</span> <span class='info-box-number'><small> Survay</small> Marka Jalan</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-Gray "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>PJU</span> <span class='info-box-number'><small> Survay</small> PJU</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-Navy "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>Rambu</span> <span class='info-box-number'><small> Survay</small> Rambu</span> </div>
                  </div>
               </a>
            </div>
            <div class='col-md-3 col-sm-6 col-xs-12'>
               <a href="oke.html">
                  <div class='info-box'> <span class="info-box-icon bg-Purple "> <i class="fa fa-brand fa-road"></i></span>
                     <div class='info-box-content'> <span class='info-box-text'>RPPJ</span> <span class='info-box-number'><small> Survay</small> RPPJ</span> </div>
                  </div>
               </a>
            </div>
         </div>
</div>
<?php } ?>
</section>
</div>