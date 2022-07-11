<?php

defined('BASEPATH') OR exit('No direct script access allowed');

?>

<script>

function popupCenter(url, title, w, h) {

   var left = (screen.width/2)-(w/2);

   var top = (screen.height/2)-(h/2);

   return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);

} 

</script>

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

   <div class="box box-prmary">
      <div class="box-body">
         <?php
         echo validation_errors('<div class="alert alert-warning">','</div>');
         if(isset($error)){
            echo '<div class="alert alert-warning">';
            echo $error;
            echo '</div>';
         }
         echo form_open_multipart(base_url('admin/guardrail/'));
         ?>
            <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12">
               <input type="text" name="search" class="form-control" placeholder="Masukan kode guardrail">
            </div>
            <div class="col-md-2 col-lg-2 col-sm-12 col-xs-12">
               <button type="submit" class="btn btn-primary btn-flat form-control"><i class="fa fa-search"></i> Cari</button>
            </div>
            
          <?php 
          echo form_close(); 
          ?> 
      </div>
   </div>

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

                     <a onclick="popupCenter('<?php echo base_url('admin/guardrail/cetak/'.$list->kd_jalan) ?>', 'Cetak',900,550);" href="javascript:void(0);"><button class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i></button></a>

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