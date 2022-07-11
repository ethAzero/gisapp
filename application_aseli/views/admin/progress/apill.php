<div class="content-wrapper">
	<section class="content-header">
	   <h1>Progress Apill <?php echo $balai->nm_balai ?></h1>
	   <ol class="breadcrumb">
	      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
	      <li class="active">Progress</li>
	   </ol>
	</section>

	<section class="content">
		<a href="<?php echo base_url('admin/progress/'.$balai->kd_balai) ?>"><button class="btn btn-primary btn-flat"><i class="fa fa-reply"></i> Kembali</button></a>
		<a href="<?php echo base_url('admin/progress/excelapil/'.$balai->kd_balai) ?>" target="_blank"><button class="btn btn-success btn-flat" data-toggle="tooltip" data-placement="top" title="Export Excel"><i class="fa fa-file-excel-o"></i> Excel</button></a>
		<br><br>
	   <div class="box box-primary">
	    	<div class="box-body">
	   		<div class="table-responsive">
	         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
	            <thead>
	               <tr>
	                  <th width="20">No</th>
	                  <th>Nama Ruas Jalan</th>
	                  <th width="100">Panjang Ruas</th>
	                  <th width="70">Terpasang</th>
	                  <th width="70">Kebutuhan</th>
	                  <th width="40">Rusak</th>
	                  <th width="40">View</th>
	               </tr>
	            </thead>
	            <tbody>
	            <?php $i=1; foreach($ruas as $ruas){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td><?php echo $ruas->nm_ruas ?></td>
                  <td style="text-align:right"><?php echo angka($ruas->jln_panjang);?></td>
                  <?php $jml = $this->dashboard_model->rekapapil($ruas->kd_jalan); ?>
                  <?php foreach ($jml as $key => $jml): ?>
               	<td align="center"><?php echo $jml->terpasang ?></td>
               	<td align="center"><?php echo $jml->kebutuhan ?></td>
               	<td align="center"><?php echo $jml->rusak ?></td>
               	<td><a href="<?php echo base_url('admin/progress/apill/view/'.$ruas->kd_balai.'/'.$ruas->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></button></a></td>	
                  <?php endforeach ?>
               </tr>        
               <?php $i++; } ?>	
	          	</tbody>
	         </table>
	         </div>
	    	</div>
	   </div>
	</section>         
</div>