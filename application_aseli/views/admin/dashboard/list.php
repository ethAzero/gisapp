<div class="content-wrapper">
	<section class="content-header">
	   <h1>Dashboard
	      <small>Control panel</small>
	   </h1>
	   <ol class="breadcrumb">
	      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active">Dashboard</li>
	   </ol>
	</section>

	<section class="content">
	   <div class="row">
			<?php if(($this->session->userdata('hakakses') == 'S') OR ($this->session->userdata('hakakses') == 'A') OR ($this->session->userdata('hakakses') == 'LL')){ ?>
			<?php foreach ($list as $key => $list): ?>
			<a href="<?php echo base_url('admin/progress/'.$list->kd_balai); ?>">
			<div class="col-md-3 col-sm-6 col-xs-12">
          	<div class="info-box bg-blue">
	            <span class="info-box-icon"><i class="fa fa-building"></i></span>
	            <div class="info-box-content">
	              	<span class="info-box-text">&nbsp;</span>
	              	<span class="info-box-number"><?php echo balai($list->nm_balai); ?></span>
	              	<div class="progress">
	                	<div class="progress-bar" style="width: 100%"></div>
	              	</div>
	               <span class="progress-description small">
	               	<?php $jml = $this->dashboard_model->jmlruasperbalai($list->kd_balai); ?>
	               	<?php echo $jml->jumlah ?> Ruas Jalan (<?php echo angka($jml->panjang) ?> m)
	               </span>
	            </div>
          	</div>
        	</div>
        	</a>
			<?php endforeach ?>
			<?php } ?>
	   </div>
	</section>         
</div>