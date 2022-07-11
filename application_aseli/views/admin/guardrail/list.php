<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="content-wrapper">
	<section class="content-header">
      <h1>Guardrail</h1>
      <?php 
      $hak = $this->session->userdata('hakakses');
      if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){ ?>
      <div class="rekap-jumlah">
         <?php foreach ($count as $key => $count): ?>
            <div><span class="kotak">Terpasang<span> : <?php echo $count->terpasang ?></div>
            <div><span class="kotak">Kebutuhan<span> : <?php echo $count->kebutuhan ?></div>
            <div><span class="kotak">Rusak<span> : <?php echo $count->rusak ?></div>
         <?php endforeach ?>
      </div>
      <?php } ?>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Guardrail</li>
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
                  <th width="70">Panjang</th>
                  <th width="70">Wilayah</th>
                  <th width="70">Terpasang</th>
                  <th width="70">Kebutuhan</th>
                  <th width="40">Rusak</th>
                  <th style="text-align:center">Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php $i=1; foreach($jalan as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td><?php echo $list->nm_ruas ?></td>
                  <td style="text-align:right"><?php $km = $list->jln_panjang / 1000; echo sprintf("%03s", $km) ?> Km</td>
                  <td style="text-align:center"><?php echo ubahbalai($list->nm_balai); ?></td>
                  <?php $jml = $this->dashboard_model->rekapguardrail($list->kd_jalan); ?>
                  <?php foreach ($jml as $key => $jml): ?>
                  <td align="center"><?php echo $jml->terpasang ?></td>
                  <td align="center"><?php echo $jml->kebutuhan ?></td>
                  <td align="center"><?php echo $jml->rusak ?></td>
                  <?php endforeach ?>
                  <td style="text-align:center;width:100px">
                     <a href="<?php echo base_url('admin/guardrail/detail/'.$list->kd_balai.'/'.$list->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Input Data"><i class="fa fa-map-o"></i></button></a>
                     <a href="<?php echo base_url('admin/guardrail/view/'.$list->kd_balai.'/'.$list->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></button></a>
                     <a href="<?php echo base_url('admin/guardrail/cetak/'.$list->kd_jalan) ?>" target="_blank"><button class="btn btn-xs btn-flat btn-primary" data-toggle="tooltip" data-placement="top" title="Cetak"><i class="fa fa-print"></i></button></a>
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