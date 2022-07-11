<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
      <h1>Ruas Jalan Provinsi</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Ruas Jalan Provinsi</li>
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
               <?php if(($this->session->userdata('hakakses') == 'S')|($this->session->userdata('hakakses') == 'A')){ ?>
               <a href="<?php echo base_url('admin/jalan/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
               <?php } ?>
               <a href="<?php echo base_url('admin/jalan/exportexcel') ?>" target="_blank"><button class="btn btn-primary btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</button></a>
            </div>            
         </div>
         <br>
   		<div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                  <th width="20">No</th>
                  <th width="100">Nomor Ruas</th>
                  <th width="100">Sub Ruas</th>
                  <th>Ruas Jalan</th>
                  <th width="220">Wilayah</th>
                  <th width="100">Panjang Jalan</th>
                  <?php if(($this->session->userdata('hakakses') == 'S')|($this->session->userdata('hakakses') == 'A')|($this->session->userdata('hakakses') == 'LL')){ ?>
                  <th style="text-align:center">Aksi</th>
                  <?php } ?>
               </tr>
            </thead>
            <tbody>
            	<?php $i=1; foreach($list as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td align="center"><?php echo $list->no_ruas ?></td>
                  <td align="center"><?php echo $list->jln_fungsi ?></td>
                  <td><?php echo $list->nm_ruas ?></td>
                  <td><?php echo $list->nm_balai ?></td>
                  <td style="text-align:right"><?php $km = $list->jln_panjang / 1000; echo sprintf("%03s", $km) ?> Km</td>
                  <td style="text-align:center;width:100px">
                  <?php if (($this->session->userdata('hakakses') == 'S')|($this->session->userdata('hakakses') == 'A')): ?>
                  	<a href="<?php echo base_url('admin/jalan/edit/'.$list->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
                     <?php include('delete.php'); ?>
                  <?php elseif (($this->session->userdata('hakakses') == 'LL')): ?>
                  	<a href="<?php echo base_url('admin/jalan/edit/'.$list->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
                  <?php endif ?>
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