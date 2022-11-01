<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<script>
   function popupCenter(url, title, w, h) {

      var left = (screen.width / 2) - (w / 2);

      var top = (screen.height / 2) - (h / 2);

      return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

   }
</script>

<div class="content-wrapper">
   <section class="content-header">
      <h1>Detail DRK</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li>Daerah Rawan</li>
         <li class="active">Details</li>
      </ol>
   </section>

   <section class="content">
      <?php
      if ($this->session->flashdata('sukses')) {
      ?>
         <script type="text/javascript">
            $.growl.notice({
               message: "<?php echo $this->session->flashdata('sukses') ?>"
            });
         </script>
      <?php
      }
      if ($this->session->flashdata('error')) {
      ?>
         <script type="text/javascript">
            $.growl.error({
               message: "<?php echo $this->session->flashdata('error') ?>"
            });
         </script>
      <?php
      }
      ?>
      <div class="row">
         <div class="col-md-12">

            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab_1" data-toggle="tab">Details</a></li>
                  <li><a href="#tab_2" data-toggle="tab">Data Rekomendasi</a></li>
                  <li><a href="#tab_3" data-toggle="tab">Data Kejadian</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="tab_1">
                     <?php
                     if ($listdrk->img_daerah != '') {
                     ?>
                        <div class="box-body">
                           <img src="<?= base_url('assets/upload/daerahrawan/thumbs/') . $listdrk->img_daerah ?>" alt="..." class="margin" width="35%">
                        </div>
                     <?php   }
                     ?>
                     <h3 class="box-title">
                        Status Penanganan: <?php
                                             if ($listdrk->status_drk == 1 || $listdrk->status_drk == null) {
                                                echo "<i class=\"fa fa-times text-red\" title=\"Belum Ditangani\"></i>";
                                             } elseif ($listdrk->status_drk == 2) {
                                                echo "<i class=\"fa fa-check text-green\" title=\"Sudah Ditangani\"></i>";
                                             }
                                             ?>
                     </h3>
                     <h5>Daerah Rawan : <?= $listdrk->nm_daerah; ?></h5>
                     <h5>Kabupaten / Kota : <?= $listdrk->nm_kabkota; ?></h5>
                     <h5></i> Ruas Jalan : <?= $listdrk->nm_ruas; ?></h5>
                     <h5></i> Status Jalan : <?php
                                             if ($listdrk->status_jalan == 1) {
                                                echo "Ruas Jl. Kab/Kota";
                                             } elseif ($listdrk->status_jalan == 2) {
                                                echo "Ruas Jl. Provinsi";
                                             } elseif ($listdrk->status_jalan == 3) {
                                                echo "Ruas Jl. Nasional";
                                             }
                                             ?></h5>
                     <h5></i> Permasalahan (Hazard / Risk) : <?= $listdrk->ket_daerah; ?></h5>
                     <?php
                     if ($listdrk->status_drk != 2) {
                     ?>
                        <br>
                        <div class="table-toolbar">
                           <div class="btn-group">
                              <a href="<?php echo base_url('admin/daerahrawan/tanganidrk/') . $listdrk->kd_daerah ?>"><button class="btn btn-success btn-flat">Tangani</button></a>
                           </div>
                        </div>
                     <?php } ?>
                  </div>

                  <div class="tab-pane" id="tab_2">
                     <div class="box-body no-padding">
                        <table class="table table-striped">
                           <tr>
                              <th style="width: 10px">No</th>
                              <th>Rekomendasi</th>
                              <th>satuan</th>
                              <th>Jumlah Kebutuhan</th>
                              <th>Jumlah Terpasang</th>
                              <th>Keterangan</th>
                              <th>Progress</th>
                              <th style="width: 40px">Label</th>
                              <th>Aksi</th>
                           </tr>
                           <?php
                           $i = 1;
                           foreach ($listrekom as $listrekom) {
                           ?>
                              <tr>
                                 <td><?= $i ?></td>
                                 <td><?= $listrekom->jenis_rekom ?></td>
                                 <td><?= $listrekom->satuan ?></td>
                                 <td><?= $listrekom->jml_kebutuhan ?></td>
                                 <td><?= $listrekom->jml_terpasang ?></td>
                                 <td><?= $listrekom->ket ?></td>
                                 <td>
                                    <?php
                                    $prosentasecapaian = ($listrekom->jml_terpasang / $listrekom->jml_kebutuhan) * 100;
                                    if ($prosentasecapaian <= 50) {
                                       $color1 = 'progress-bar-danger';
                                       $color2 = 'bg-red';
                                    } else if ($prosentasecapaian > 50 and $prosentasecapaian <= 75) {
                                       $color1 = 'progress-bar-warning';
                                       $color2 = 'bg-orange';
                                    } elseif ($prosentasecapaian >= 76) {
                                       $color1 = 'progress-bar-success';
                                       $color2 = 'bg-green';
                                    }
                                    ?>
                                    <div class="progress progress-xs">
                                       <div class="progress-bar <?= $color1 ?>" style="width: <?= $prosentasecapaian ?>%"></div>
                                    </div>
                                 </td>
                                 <td><span class="badge <?= $color2 ?>"><?= number_format($prosentasecapaian, 2) ?>%</span></td>
                                 <td>
                                    <a href="<?php echo base_url('admin/daerahrawan/rekomedit/' . $listdrk->kd_daerah . '/' . $listrekom->id) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                    <!-- <?php include('delete.php'); ?> -->
                                 </td>
                              </tr>
                           <?php $i++;
                           } ?>

                        </table>
                     </div>
                     <br>
                     <div class="table-toolbar">
                        <div class="btn-group">
                           <a href="<?php echo base_url('admin/daerahrawan/rekomadd/') . $listdrk->kd_daerah ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
                        </div>
                     </div>
                  </div>

                  <div class="tab-pane" id="tab_3">
                     <h1>Under Construction</h1>
                  </div>

               </div>

            </div>

         </div>
      </div>
</div>
</section>
</div>