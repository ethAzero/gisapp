<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
   <div class="sidebar-nav navbar-collapse">      
      <div class="userprofile text-center">
         <div class="userpic"> <img src="<?php echo base_url('assets/theme/img/jawatengah.png') ?>" alt="" class="userpicimg"></div>
         <h3 class="dinas-title">Dinas Perhubungan</h3>
         <p>Provinsi Jawa Tengah</p>
      </div>
      <div class="clearfix"></div>
      
      <ul class="nav" id="side-menu">
         <li> <a href="<?php echo base_url() ?>"><i class="fa fa-home fa-fw"></i> Beranda  </a> </li>
         <li> <a href="javascript:void(0)" class="menudropdown"><i class="fa fa-building"></i> Simpul<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li><a href="<?php echo base_url('terminal') ?>">Terminal</a></li>
               <li><a href="<?php echo base_url('sdp') ?>">SDP</a></li>
               <li><a href="<?php echo base_url('stasiun') ?>">Stasiun</a></li>
               <li><a href="<?php echo base_url('bandara') ?>">Bandara</a></li>
               <li><a href="<?php echo base_url('pelabuhan') ?>">Pelabuhan</a></li>
            </ul>
         </li>
         <li> <a href="javascript:void(0)" class="menudropdown"><i class="fa fa-train"></i> Perlintasan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li><a href="<?php echo base_url('perlintasan/sebidang') ?>">Sebidang</a></li>
               <li><a href="<?php echo base_url('perlintasan/tidaksebidang') ?>">Tidak Sebidang</a></li>
            </ul>
         </li>
         <li> <a href="<?php echo base_url('jalan') ?>"><i class="fa fa-road"></i> Jalan Provinsi</a> </li>
         <li> <a href="<?php echo base_url('shelter') ?>"><i class="fa fa-bus"></i> Shelter BRT</a> </li>
         <li> <a href="<?php echo base_url('daerahrawan') ?>"><i class="fa fa-exclamation-triangle"></i> Daerah Rawan</a> </li>
         <li> <a href="<?php echo base_url('atcs') ?>"><i class="fa fa-video-camera"></i> ATCS</a> </li>
         <li> <a href="javascript:void(0)" class="menudropdown"><i class="fa fa-map-signs fa-fw"></i> Perlengkapan Jalan<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
               <li><a href="<?php echo base_url('apil') ?>">Apill</a></li>
               <li><a href="<?php echo base_url('cermin') ?>">Cermin</a></li>
               <li><a href="<?php echo base_url('pju') ?>">PJU</a></li>
               <li><a href="<?php echo base_url('flash') ?>">Flash</a></li>
               <li><a href="<?php echo base_url('guardrail') ?>">Guardrail</a></li>
               <li><a href="<?php echo base_url('rambu') ?>">Rambu</a></li>
               <li><a href="<?php echo base_url('rppj') ?>">RPPJ</a></li>
               <li><a href="<?php echo base_url('marka') ?>">Marka</a></li>
            </ul>
         </li>
         <li> <a href="<?php echo base_url('trayek') ?>"><i class="fa fa-car fa-fw"></i> Trayek</a> </li>
        <br><br>
      </ul>
   </div>
</div>