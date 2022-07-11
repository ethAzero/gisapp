<div class="content-wrapper">
	<section class="content-header">
	   <h1>Progress <?php echo $balai->nm_balai ?> <small>(<?php echo $jumlah->jumlah ?> Ruas Jalan)</small></h1>
	   <ol class="breadcrumb">
	      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active">Progress</li>
	   </ol>
	</section>

	<section class="content">
		<a href="<?php echo base_url('admin/dashboard') ?>"><button class="btn btn-primary btn-flat"><i class="fa fa-reply"></i> Kembali</button></a>
		<br><br>
	   <div class="row">
			<div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	              	<h3><?php if($realapil->jumlah == true){ $percent = ($percentapil->percen / $realapil->jumlah * 100); echo sprintf('%0.0f', $percent);}else{echo "0";}  ?><sup style="font-size: 20px"> %</sup></h3>
	              	<p>Apill (<?php echo $percentapil->percen.'/'.$realapil->jumlah.'/'.$jumlah->jumlah  ?>)</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-road"></i>
	            </div>
	            <a href="<?php echo base_url('admin/progress/apill/'.$balai->kd_balai) ?>" class="small-box-footer">
	              Detail <i class="fa fa-arrow-circle-right"></i>
	            </a>
          	</div>
        	</div>
        	
			<div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	              	<h3><?php if($realcermin->jumlah == true){ $percent = ($percentcermin->percen / $realcermin->jumlah * 100); echo sprintf('%0.0f', $percent);}else{echo "0";} ?><sup style="font-size: 20px"> %</sup></h3>
	              	<p>Cermin (<?php echo $percentcermin->percen.'/'.$realcermin->jumlah.'/'.$jumlah->jumlah  ?>)</p>
	            </div>
	            <div class="icon">
	              	<i class="fa fa-road"></i>
	            </div>
	            <a href="<?php echo base_url('admin/progress/cermin/'.$balai->kd_balai) ?>" class="small-box-footer">
	              Detail <i class="fa fa-arrow-circle-right"></i>
	            </a>
          	</div>
        	</div>

        	<div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	              	<h3><?php if($realpju->jumlah == true){ $percent = ($percentpju->percen / $realpju->jumlah * 100); echo sprintf('%0.0f', $percent);}else{echo "0";} ?><sup style="font-size: 20px"> %</sup></h3>
	              	<p>PJU (<?php echo $percentpju->percen.'/'.$realpju->jumlah.'/'.$jumlah->jumlah  ?>)</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-road"></i>
	            </div>
	            <a href="<?php echo base_url('admin/progress/pju/'.$balai->kd_balai) ?>" class="small-box-footer">
	              Detail <i class="fa fa-arrow-circle-right"></i>
	            </a>
          	</div>
        	</div>

        	<div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	              	<h3><?php if($realflash->jumlah == true){ $percent = ($percentflash->percen / $realflash->jumlah * 100); echo sprintf('%0.0f', $percent);}else{echo "0";} ?><sup style="font-size: 20px"> %</sup></h3>
	              	<p>Flash (<?php echo $percentflash->percen.'/'.$realflash->jumlah.'/'.$jumlah->jumlah  ?>)</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-road"></i>
	            </div>
	            <a href="<?php echo base_url('admin/progress/flash/'.$balai->kd_balai) ?>" class="small-box-footer">
	              Detail <i class="fa fa-arrow-circle-right"></i>
	            </a>
          	</div>
        	</div>

        	<div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	              	<h3><?php if($realrambu->jumlah == true){ $percent = ($percentrambu->percen / $realrambu->jumlah * 100); echo sprintf('%0.0f', $percent);}else{echo "0";} ?><sup style="font-size: 20px"> %</sup></h3>
	              	<p>Rambu (<?php echo $percentrambu->percen.'/'.$realrambu->jumlah.'/'.$jumlah->jumlah  ?>)</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-road"></i>
	            </div>
	            <a href="<?php echo base_url('admin/progress/rambu/'.$balai->kd_balai) ?>" class="small-box-footer">
	              Detail <i class="fa fa-arrow-circle-right"></i>
	            </a>
          	</div>
        	</div>

        	<div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	             	<h3><?php if($realrppj->jumlah == true){ $percent = ($percentrppj->percen / $realrppj->jumlah * 100); echo sprintf('%0.0f', $percent);}else{echo "0";} ?><sup style="font-size: 20px"> %</sup></h3>
	              	<p>RPPJ (<?php echo $percentrppj->percen.'/'.$realrppj->jumlah.'/'.$jumlah->jumlah  ?>)</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-road"></i>
	            </div>
	            <a href="<?php echo base_url('admin/progress/rppj/'.$balai->kd_balai) ?>" class="small-box-footer">
	              Detail <i class="fa fa-arrow-circle-right"></i>
	            </a>
          	</div>
        	</div>

        	<div class="col-lg-3 col-xs-6">
          	<div class="small-box bg-aqua">
	            <div class="inner">
	             	<h3><?php if($realdrk->jumlah == true){ $percent = ($percentdrk->percen / $realdrk>jumlah * 100); echo sprintf('%0.0f', $percent);}else{echo "0";} ?><sup style="font-size: 20px"> %</sup></h3>
	              	<p>Daerah Rawan (<?php echo $percentdrk->percen.'/'.$realdrk->jumlah.'/'.$jumlah->jumlah  ?>)</p>
	            </div>
	            <div class="icon">
	              <i class="fa fa-road"></i>
	            </div>
	            <a href="<?php echo base_url('admin/progress/daerahrawan/'.$balai->kd_balai) ?>" class="small-box-footer">
	              Detail <i class="fa fa-arrow-circle-right"></i>
	            </a>
          	</div>
        	</div>

	   </div>
	</section>         
</div>