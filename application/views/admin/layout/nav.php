<aside class="main-sidebar">
   <section class="sidebar">
      <ul class="sidebar-menu">
         <li class="<?= ($this->uri->segment(2) == 'dashboard') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
         <?php if (($this->session->userdata('hakakses') == 'AD')) { ?>
            <li class="<?= ($this->uri->segment(2) == 'aduan') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/aduan') ?>"><i class="fa fa-bullhorn"></i><span>Aduan</span></a></li>
         <?php } ?>

         <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') == 'JT') | ($this->session->userdata('hakakses') == 'PE') | ($this->session->userdata('hakakses') == 'LL')) { ?>

            <li class="<?= (($this->uri->segment(2) == 'terminal') | ($this->uri->segment(2) == 'stasiun') | ($this->uri->segment(2) == 'bandara') | ($this->uri->segment(2) == 'sdp') | ($this->uri->segment(2) == 'pelabuhan') | ($this->uri->segment(2) == 'perlintasan')) ? 'active' : '' ?>">
               <a href="#"><i class="fa fa-th-large"></i><span>Simpul</span> <i class="fa fa-angle-left pull-right"></i></a>
               <ul class="treeview-menu">
                  <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') === 'JT')) { ?>
                     <li class="<?= ($this->uri->segment(2) == 'terminal') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/terminal') ?>"><i class="fa fa-circle-o"></i> Terminal</a></li>
                  <?php } ?>
                  <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') === 'PE')) { ?>
                     <li class="<?= ($this->uri->segment(2) == 'sdp') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/sdp') ?>"><i class="fa fa-circle-o"></i> SDP</a></li>
                  <?php } ?>
                  <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') === 'JT')) { ?>
                     <li class="<?= ($this->uri->segment(2) == 'perlintasan') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/perlintasan') ?>"><i class="fa fa-circle-o"></i> Perlintasan</a></li>
                     <li class="<?= ($this->uri->segment(2) == 'stasiun') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/stasiun') ?>"><i class="fa fa-circle-o"></i> Stasiun</a></li>
                     <li class="<?= ($this->uri->segment(2) == 'bandara') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/bandara') ?>"><i class="fa fa-circle-o"></i> Bandara</a></li>
                  <?php } ?>
                  <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') === 'PE')) { ?>
                     <li class="<?= ($this->uri->segment(2) == 'pelabuhan') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/pelabuhan') ?>"><i class="fa fa-circle-o"></i> Pelabuhan</a></li>
                  <?php } ?>
               </ul>
            </li>
         <?php } ?>
         <?php if ($this->session->userdata('hakakses') != '07' and $this->session->userdata('hakakses') != 'PE' and $this->session->userdata('hakakses') != 'JT' and $this->session->userdata('hakakses') != 'AJ' and $this->session->userdata('hakakses') != 'AD') { ?>
            <li class="<?= ($this->uri->segment(2) == 'daerahrawan') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/daerahrawan') ?>"><i class="fa fa-th-large"></i><span>Daerah Rawan</span></a></li>
            <li class="<?= ($this->uri->segment(2) == 'atcs') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/atcs') ?>"><i class="fa fa-th-large"></i><span>ATCS</span></a></li>
         <?php } ?>

         <!-- <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') == 'LL')) { ?> -->
         <!-- <li class="<?= ($this->uri->segment(2) == 'keperluanjalan') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/kebutuhanjalan') ?>"><i class="fa fa-th-large"></i><span>Daerah Rawan Kecelakaan LL</span></a></li> -->
         <!--  <?php } ?> -->

         <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') === 'AJ')) { ?>
            <li class="<?= ($this->uri->segment(2) == 'trayek') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/trayek') ?>"><i class="fa fa-th-large"></i><span>Trayek</span></a></li>
         <?php } ?>
         <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') === '07')) { ?>
            <li class="<?= ($this->uri->segment(2) == 'shelter') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/shelter') ?>"><i class="fa fa-th-large"></i><span>Shelter</span></a></li>
         <?php } ?>
         <?php if (($this->session->userdata('hakakses') != '07') and ($this->session->userdata('hakakses') != 'PE') and ($this->session->userdata('hakakses') != 'JT') and ($this->session->userdata('hakakses') != 'AJ') and $this->session->userdata('hakakses') != 'AD') { ?>
            <li class="<?= (($this->uri->segment(2) == 'cermin') | ($this->uri->segment(2) == 'apil') | ($this->uri->segment(2) == 'marka') | ($this->uri->segment(2) == 'guardrail') | ($this->uri->segment(2) == 'flash') | ($this->uri->segment(2) == 'pju') | ($this->uri->segment(2) == 'rppj') | ($this->uri->segment(2) == 'rambu')) ? 'active' : '' ?>">
               <a href="#"><i class="fa fa-th-large"></i><span>Perlengkapan Jalan</span> <i class="fa fa-angle-left pull-right"></i></a>
               <ul class="treeview-menu">
                  <li class="<?= ($this->uri->segment(2) == 'apil') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/apil') ?>"><i class="fa fa-circle-o"></i> Apill</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'delinator') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/delinator') ?>"><i class="fa fa-circle-o"></i> Delinator</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'cermin') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/cermin') ?>"><i class="fa fa-circle-o"></i> Cermin</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'pju') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/pju') ?>"><i class="fa fa-circle-o"></i> PJU</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'flash') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/flash') ?>"><i class="fa fa-circle-o"></i> Flash</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'guardrail') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/guardrail') ?>"><i class="fa fa-circle-o"></i> Guardrail</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'rambu') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/rambu') ?>"><i class="fa fa-circle-o"></i> Rambu</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'rppj') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/rppj') ?>"><i class="fa fa-circle-o"></i> RPPJ</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'marka') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/marka') ?>"><i class="fa fa-circle-o"></i> Marka</a></li>
               </ul>
            </li>
         <?php } ?>
         <!-- <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') != '07') and ($this->session->userdata('hakakses') != 'PE') and ($this->session->userdata('hakakses') != 'JT') and ($this->session->userdata('hakakses') != 'AJ')) { ?>
         <li class="<?= (($this->uri->segment(2) == 'laporan')) ? 'active' : '' ?>">
            <a href="#"><i class="fa fa-th-large"></i><span>Laporan</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
               <li class="<?= ($this->uri->segment(2) == 'laporan') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/laporan/ruas') ?>"><i class="fa fa-circle-o"></i>Laporan Ruas</a></li>
            </ul>
         </li> -->
      <?php } ?>
      <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A') | ($this->session->userdata('hakakses') == 'LL')) { ?>
         <li class="<?= (($this->uri->segment(2) == 'kabkota') | ($this->uri->segment(2) == 'kecamatan') | ($this->uri->segment(2) == 'jalan') | ($this->uri->segment(2) == 'balai')) ? 'active' : '' ?>">
            <a href="#"><i class="fa fa-th-large"></i><span>Master Data</span> <i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
               <?php if (($this->session->userdata('hakakses') == 'S') | ($this->session->userdata('hakakses') == 'A')) { ?>
                  <li class="<?= ($this->uri->segment(2) == 'balai') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/balai') ?>"><i class="fa fa-circle-o"></i> Balai</a></li>
                  <li class="<?= ($this->uri->segment(2) == 'kabkota') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/kabkota') ?>"><i class="fa fa-circle-o"></i> Kota/Kabupaten</a></li>
               <?php } ?>
               <li class="<?= ($this->uri->segment(2) == 'jalan') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/jalan') ?>"><i class="fa fa-circle-o"></i> Jalan Provinsi</a></li>
            </ul>
         </li>
      <?php } ?>
      <?php if ($this->session->userdata('hakakses') == 'S') { ?>
         <li class="<?= ($this->uri->segment(2) == 'pengguna') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/pengguna') ?>"><i class="fa fa-users"></i><span>Pengguna</span> </a></li>
      <?php } ?>
      <?php if (($this->session->userdata('hakakses') === 'S') | $this->session->userdata('hakakses') === 'A') { ?>
         <li class="<?= ($this->uri->segment(2) == 'setting') ? 'active' : '' ?>"><a href="<?php echo base_url('admin/setting') ?>"><i class="fa fa-gear"></i><span>Setting</span> </a></li>
      <?php } ?>

      </ul>
   </section>
</aside>