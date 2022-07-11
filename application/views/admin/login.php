<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <title><?php echo $title ?></title>
   <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="icon" href="<?php echo base_url() ?>assets/admin/icon.png" sizes="32x32">
   <link href="<?php echo base_url() ?>assets/admin/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url() ?>assets/admin/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
   <script src="<?php echo base_url() ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js" type="text/javascript"></script>
</head>
<body class="login-page">
	<div class="login-box">
		<div class="login-logo">
        <b>Dinas Perhubungan</b>
      </div>
      <div class="box">
	      <div class="login-box-body">
	      	<p id="error" class="login-box-msg">Login untuk mengelola website</p>
				<?php
				echo validation_errors('<div class="callout callout-danger"><i class="icon fa fa-ban"></i>','</div>');
				if($this->session->flashdata('gagal')){
					?>
					<div class="callout callout-danger"><i class="icon fa fa-ban"></i> <?php echo $this->session->flashdata('gagal'); ?></div>
					<?php
				}else if($this->session->flashdata('sukses')){
					?>
					<div class="callout callout-info"><i class="icon fa fa-check"></i> <?php echo $this->session->flashdata('sukses'); ?></div>
					<?php
				}
				
				echo form_open(base_url('kelola'));
				?>
					<div class="form-group has-feedback">
               	<input type="text" id="username" name="username" class="form-control" autocomplete="off" placeholder="Username"  />
               	<span class="glyphicon glyphicon-user form-control-feedback"></span>
            	</div>
					<div class="form-group has-feedback">
	               <input type="password" id="password" name="password" class="form-control" autocomplete="off" placeholder="Password"  />
	               <span class="glyphicon glyphicon-lock form-control-feedback"></span>
	            </div>
			      <div class="row">
	               <div class="col-xs-8"></div>
	               <div class="col-xs-4">
	                  <input type="submit" class="btn btn-primary btn-block btn-flat" value="Log In" id="login"/>
	               </div>
	            </div>		
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	try{document.getElementById('username').focus();}catch(e){}
</script>
</html>