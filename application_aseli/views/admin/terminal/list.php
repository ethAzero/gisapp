<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
      <h1>Terminal</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Terminal</li>
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
    		<div class="table-toolbar">
            <div class="btn-group">
               <a href="<?php echo base_url('admin/terminal/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
               <a href="<?php echo base_url('admin/terminal/exportexcel') ?>" target="_blank"><button class="btn btn-primary btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</button></a>
            </div>            
         </div>
         <br>
   		<div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                  <th width="20">No</th>
                  <th>Nama Terminal</th>
                  <th>Nama Balai</th>
                  <th>Kabupaten / Kota</th>
                  <th style="text-align:center">Aksi</th>
               </tr>
            </thead>
            <tbody>
            	<?php $i=1; foreach($list as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td><?php echo $list->nm_terminal ?></td>
                  <td><?php echo $list->nm_balai ?></td>
                  <td><?php echo $list->nm_kabkota ?></td>
                  <td style="text-align:center;width:100px">
                     <a href="<?php echo base_url('admin/terminal/edit/'.$list->kd_terminal) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
                     <?php include('delete.php'); ?>
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