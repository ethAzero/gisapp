<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
      <h1>Kebutuhan Jalan</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Kebutuhan Jalan</li>
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


   <div class="box box-prmary">
      <div class="box-body">
         <?php
         echo validation_errors('<div class="alert alert-warning">','</div>');
         if(isset($error)){
            echo '<div class="alert alert-warning">';
            echo $error;
            echo '</div>';
         }
         echo form_open_multipart(base_url('admin/kebutuhanjalan/import_excel'), array('onsubmit' => 'return ValidasiKoordinat()'));
         ?>
            <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12">
               <input type="file" name="fileExcel" class="filestyle" data-buttonText="Data Kebutuhan Jalan" data-buttonBefore="true" data-iconName="fa fa-upload">
            </div>
            <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
               <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Tambah Data</button>
            </div>
            
          <?php 
          echo form_close(); 
          ?> 
      </div>
   </div>

	<div class="box box-primary">
    	<div class="box-body">
    		<div class="table-toolbar">
            <div class="btn-group">
               <!-- <a href="<?php echo base_url('admin/kebutuhanjalan/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a> -->
            </div>            
         </div>
         <br>
   		<div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                  <th width="20">No</th>
                  <th>Nama Daerah</th>
                  <th>Status</th>
                  <th>Latitude</th>
                  <th>Langitude</th>
                  <th>Foto</th>
                  <th style="text-align:center">Aksi</th>
               </tr>
            </thead>
            <tbody>
            	<?php $i=1; foreach($list as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td><?php echo $list->nm_daerah ?></td>
                  <td>
                  <?php 
                     if($list->status == '0'){ echo 'Tidak Baik';}
                     else if($list->status == '0'){ echo 'Baik';} 
                     else{ echo 'Survey Gabungan';}
                  ?>  
                  </td>
                  <td><?php echo $list->lat ?></td>
                  <td><?php echo $list->lang ?></td>
                  <td><?php echo $list->img_daerah ?></td>
                  <td style="text-align:center;width:100px">
                     <a href="<?php echo base_url('admin/kebutuhanjalan/edit/'.$list->no) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
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