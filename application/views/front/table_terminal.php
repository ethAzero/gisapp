<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="page-wrapper">
	<div class="row">
		<?php if($list != ''){?>
		<div class="col-md-12  header-wrapper" >
		  	<h1 class="page-header">Detail <?=$list->nm_terminal?></h1>
		  	<br>
		  	<img src="<?php  if($list->img_terminal != null){echo base_url('assets/upload/terminal/thumbs/'.$list->img_terminal);}else{echo base_url('assets/theme/img/map-marker-logo.jpg');}?>" style="width:100%;">
		  	<br>
		  	<br>
		  	<h3>Keterangan:</h3>
		  	<p class="page-subtitle"><?=$list->keterangan?></p>
		  	<br>
		  	
		</div>
		<?php }?>
		<dvi class="col-md-12 header-wrapper card">
			<h3>Data Dukung:</h3>
		  	<table class="table	datatable">
		  		<thead>
		  			<tr>
		  				<th style="width:8%;">No</th>
		  				<th >Data Dukung</th>
		  				<th style="width:30%;">File</th>
		  			</tr>
		  		</thead>
		  		<tbody>
		  			<?php $i=1; foreach($ddukung as $terminal){?>
		  			<tr>
			  			<td><?=$i?></td>
			  			<td><?=$terminal->data_dukung?></td>
			  			<td><a href="<?php echo base_url('assets/upload/terminal/datadukung/').$terminal->file_terminal?>"><?=$terminal->file_terminal?></a></td>
			  		</tr>
			  		 <?php $i++; } ?>
		  		</tbody>
		  	</table>
		</div>
	</div>
	<br>
	<br>
</div>
