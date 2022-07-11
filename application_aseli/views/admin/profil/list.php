<div class="content-wrapper">
   <section class="content-header">
      <h1>Profil
          <small>Profil Pengguna</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Profil</li>
      </ol>
   </section>

   <section class="content">
      <?php
         if($this->session->flashdata('sukses')){
            ?>
            <script type="text/javascript">
               $.growl.notice({ message: "<?php echo $this->session->flashdata('sukses') ?>" });
            </script>
            <?php
         }
         if($this->session->flashdata('error')){
            ?>
            <script type="text/javascript">
               $.growl.error({ message: "<?php echo $this->session->flashdata('error') ?>" });
            </script>
            <?php
         }
      ?>
      <div class="box box-primary">
         <div class="box-body">
           	<div class="col-md-2">
           		<div class="thumbnail">
               	<img class="img-responsive center-block" src="<?php echo base_url() ?>assets/admin/img/profile.png">
           		</div>
       		</div>
       		<div class="col-md-10">
           		<div class="control-group">
                   	<div class="controls">
                       	<span>Username</span>
                        <p><font size="6"><?php echo $this->session->userdata('username') ?></font></p>
                           <hr class="min2">
                        <p>Terakhir anda login: <b><?php echo tgl_indo($pengguna->last_login).' - '.jam_indo($pengguna->last_login) ?></b></p>
                        <div class="well well-sm">
                           <h4>Ganti password <span class="pull-right"><?php include('password.php'); ?></span></h4>
                        </div>
                   	</div>
               	</div>
           	</div>
           </div>
       </div>
   </div>
</div>