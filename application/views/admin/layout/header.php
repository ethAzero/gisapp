<header class="main-header">
   <a href="<?php echo base_url() ?>" target="_blank" class="logo">
      <span class="logo-mini"><b>D</b>H</span>
      <span class="logo-lg"><b>Dinas Perhubungan</b></span>
   </a>
   <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
         <span class="sr-only">Toggle navigation</span>
      </a>
      
      <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
         <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <img src="<?php echo base_url() ?>assets/admin/img/photo.png" class="user-image" alt="User Image" />
               <span class="hidden-xs">Admin</span>
            </a>
            <ul class="dropdown-menu">
               <li class="user-header">
                  <img src="<?php echo base_url() ?>assets/admin/img/profile.png" class="img-circle" alt="User Image" />
                  <p><?php echo $this->session->userdata('nama'); ?></p>
               </li>
               <li class="user-footer">
                  <div class="pull-left">
                     <a href="<?php echo base_url('admin/profil') ?>" class="btn btn-default btn-flat">Profil</a>
                  </div>
                  <div class="pull-right">
                     <a href="<?php echo base_url('kelola/logout') ?>" class="btn btn-default btn-flat">Log out</a>
                  </div>
               </li>
            </ul>
         </li>
         <li><div id="kosong"></div></li>
      </ul>
      </div>
   </nav>
</header>