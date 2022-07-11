<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<section class="content-header">
      <h1>Penerangan Jalan Umum</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Pju</li>
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
   		<div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                  <th width="20">No</th>
                  <th>Ruas Jalan</th>
                  <th width="220">Wilayah</th>
                  <th width="100">Panjang Jalan</th>
                  <th style="text-align:center">Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php $i=1; foreach($jalan as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td><?php echo $list->nm_ruas ?></td>
                  <td><?php echo $list->nm_balai ?></td>
                  <td style="text-align:right"><?php $km = $list->jln_panjang / 1000; echo sprintf("%03s", $km) ?> Km</td>
                  <td style="text-align:center;width:100px">
                     <a href="<?php echo base_url('admin/pju/view/'.$list->kd_balai.'/'.$list->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></button></a>
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