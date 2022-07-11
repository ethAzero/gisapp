<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
      <h1>Flash <small><?php echo $jalan->nm_ruas ?> (<?php echo angka($jalan->jln_panjang); ?> m)</small></h1>
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
         <div class="table-toolbar">
            <div class="btn-group">
               <a href="<?php echo base_url('admin/flash') ?>"><button class="btn btn-primary btn-flat"><i class="fa fa-reply"></i> Kembali</button></a>
               <a href="<?php echo base_url('admin/flash/add/'.$jalan->kd_balai.'/'.$jalan->kd_jalan) ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
            </div>            
         </div>
         <br>
         <div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                  <th width="20">No</th>
                  <th width="100">Kode</th>
                  <th width="140">Tahun Pengadaan</th>
                  <th>Jenis</th>
                  <th>Status</th>
                  <th style="text-align:center" width="100">Letak</th>
                  <th style="text-align:center" width="100">Photo</th>
                  <th style="text-align:center">Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php $i=1; foreach($list as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td><?php echo $list->kd_flash ?></td>
                  <td><?php echo $list->thn_pengadaan ?></td>
                  <td><?php echo $list->jenis ?></td>
                  <td><?php echo $list->status ?></td>
                  <td style="text-align:center"><?php echo $list->letak ?></td>
                  <td align="center"><?php if($list->img_flash != ''){ echo "<span class='label label-primary' data-toggle='tooltip' data-placement='top' title='Ada Photo'>Ada Photo</span>";}else{echo "<span class='label label-danger' data-toggle='tooltip' data-placement='top' title='Belum Ada Photo'>Belum Ada</span>";} ?></td>
                  <td style="text-align:center;width:100px">
                     <a href="<?php echo base_url('admin/flash/edit/'.$list->kd_jalan.'/'.$list->kd_flash) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
                     <?php include('delete.php'); ?>
                     <?php include('tukar.php'); ?>
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