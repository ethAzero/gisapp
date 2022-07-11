<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<div class="content-wrapper">
	<section class="content-header">
      <h1>Laporan ruas</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Flash</li>
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
    		<!-- <div class="table-toolbar">
            <div class="btn-group">
               <a href="<?php echo base_url('admin/flash/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
            </div>            
         </div> -->
         <br>
   		<div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                  <th width="20">No</th>
                  <th width="70">Kode</th>
                  <th>Ruas Jalan</th>
                  <th>Balai Wilayah</th>
                  <th style="text-align:center">Aksi</th>
               </tr>
            </thead>
            <tbody>
            	<?php $i=1; foreach($list as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td align="center"><?php echo $list->no_ruas ?></td>
                  <td><?php echo $list->nm_ruas ?></td>
                  <td><?php echo $list->nm_balai ?></td>
                  <td style="text-align:center;width:100px">
                     <a href="<?php echo base_url('admin/laporan/cetak_laporan_ruas/'.$list->kd_jalan)?>" target="_blank"><button class="btn btn-xs btn-flat btn-success" data-toggle="tooltip" data-placement="top" title="Print Laporan"><i class="fa fa-print"></i></button></a>                
                  </td>
               </tr>        
               <?php $i++; } ?>
           </tbody>
         </table>
         </div>
    	</div>
   </div>
   </section>
</div>