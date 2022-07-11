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

      <h1>Penerangan Jalan Umum</h1>

      <?php 

      $hak = $this->session->userdata('hakakses');

      if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){ ?>

      <div class="rekap-jumlah">

         <?php foreach ($count as $key => $count): 
               $terpasangtotal=$count->terpasang+$count->rusak;
         ?>
            <div><span class="kotak">Jumlah Terpasang<span> : <?php echo $terpasangtotal ?></div>
            <div><span class="kotak">Baik<span> : <?php echo $count->terpasang ?></div>
            <div><span class="kotak">Rusak<span> : <?php echo $count->rusak ?></div>
            <div><span class="kotak">Kebutuhan<span> : <?php echo $count->kebutuhan ?></div>
         <?php endforeach ?>

      </div>

      <?php } ?>

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

   <div class="box box-prmary">
      <div class="box-body">
         <?php
         echo validation_errors('<div class="alert alert-warning">','</div>');
         if(isset($error)){
            echo '<div class="alert alert-warning">';
            echo $error;
            echo '</div>';
         }
         echo form_open_multipart(base_url('admin/pju/'));
         ?>
            <div class="col-md-10 col-lg-10 col-sm-12 col-xs-12">
               <input type="text" name="search" class="form-control" placeholder="Masukan kode pju">
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
                  <th rowspan="2" style="text-align:center;vertical-align:middle;" width="20">No</th>
                  <th rowspan="2" style="text-align:center;vertical-align:middle;">Ruas Jalan</th>
                  <th rowspan="2" style="text-align:center;vertical-align:middle;" >Panjang</th>
                  <th rowspan="2" style="text-align:center;vertical-align:middle;" >Wilayah</th>
                  <th colspan="3" style="text-align:center;vertical-align:middle;" >Terpasang</th>
                  <th rowspan="2" style="text-align:center;vertical-align:middle;" >Kebutuhan</th>
                  <th rowspan="2" style="text-align:center;vertical-align:middle;">Aksi</th>
               </tr>
               <tr>
                  <th style="text-align:center;vertical-align:middle;" width="70">Baik</th>
                  <th style="text-align:center;vertical-align:middle;" width="40">Rusak</th>
                  <th style="text-align:center;vertical-align:middle;" width="40">Jml Terpasang</th>
               </tr>

            </thead>

            <tbody>

               <?php $i=1; foreach($jalan as $list){?>

               <tr class="odd gradeX">

                  <td align="center"><?php echo $i ?></td>

                  <td><?php echo $list->nm_ruas ?></td>

                  <td style="text-align:right"><?php $km = $list->jln_panjang / 1000; echo sprintf("%03s", $km) ?> Km</td>

                  <td style="text-align:center"><?php echo ubahbalai($list->nm_balai); ?></td>

                  <?php $jml = $this->dashboard_model->rekappju($list->kd_jalan); ?>

                  <?php foreach ($jml as $key => $jml): 
                        $terpasangperruas=$jml->terpasang+$jml->rusak;
                  ?>

                  <td align="center"><?php echo $jml->terpasang ?></td>
                  <td align="center"><?php echo $jml->rusak ?></td>
                  <td align="center"><?php echo $terpasangperruas ?></td>
                  <td align="center"><?php echo $jml->kebutuhan ?></td>
                  

                  <?php endforeach ?>

                  <td style="text-align:center;width:110px">

                     <a href="<?php echo base_url('admin/pju/detail/'.$list->kd_balai.'/'.$list->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Input Data"><i class="fa fa-map-o"></i></button></a>

                     <a href="<?php echo base_url('admin/pju/view/'.$list->kd_balai.'/'.$list->kd_jalan) ?>"><button class="btn btn-xs btn-flat btn-primary" data-toggle="tooltip" data-placement="top" title="View"><i class="fa fa-eye"></i></button></a>

                     <a href="<?php echo base_url('admin/pju/cetakexcel/'.$list->kd_jalan) ?>" target="_blank"><button class="btn btn-xs btn-flat btn-success" data-toggle="tooltip" data-placement="top" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button></a>

                     <a onclick="popupCenter('<?php echo base_url('admin/pju/cetak2/'.$list->kd_jalan) ?>', 'Cetak',900,550);" href="javascript:void(0);"><button class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i></button></a>

                     <?php $hak = $this->session->userdata('hakakses');

                     if($hak == 'ZZ'){ ?>

                     <a href="<?php echo base_url('admin/pju/cetak/'.$list->kd_jalan) ?>" target="_blank"><button class="btn btn-xs btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button></a>

                     <?php } ?>

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