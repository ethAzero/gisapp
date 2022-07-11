<div class="content-wrapper">
   <section class="content-header">
      <h1>Account
          <small>Ubah Password</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
         <li class="active">Account</li>
      </ol>
   </section>

   <section class="content">
      <div class="box box-primary">
         <div class="box-body">
           	<div class="col-md-2">
           		<div class="thumbnail">
               	<img class="img-responsive center-block" src="">
           		</div>
       		</div>
       		<div class="col-md-10">
           		<div class="control-group">
                   	<div class="controls">
                       	<span>Username</span>
                       	<p><font size="6"><?php echo $this->session->userdata('username') ?></font></p>
                           <hr class="min2">
                       	<p>Terakhir anda login: <b>2 sep 2016 - 10.00</b></p>
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