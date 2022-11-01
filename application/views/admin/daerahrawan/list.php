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
      <h1>Daerah Rawan</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Daerah Rawan</li>
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
      <div class="box box-primary">
         <div class="box-body">
            <div class="table-toolbar">
               <div class="btn-group">
                  <a href="<?php echo base_url('admin/daerahrawan/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
               </div>
               <div class="btn-group">
                  <a onclick="popupCenter('../../admin/daerahrawan/cetak', 'Cetak',900,550);" href="javascript:void(0);"><button class="btn btn-flat btn-info" data-toggle="tooltip" data-placement="top" title="Print"><i class="fa fa-print"></i> Cetak</button></a>
               </div>
            </div>
            <br>
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                     <tr>
                        <th width="20">No</th>
                        <th>Nama Daerah Rawan</th>
                        <th>Nama Ruas Jalan</th>
                        <th>Status Jalan</th>
                        <th>Kabupaten / Kota</th>
                        <th>Status DRK</th>
                        <th style="text-align:center">Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;
                     foreach ($list as $list) { ?>
                        <tr class="odd gradeX">
                           <td align="center"><?php echo $i ?></td>
                           <td><?php echo $list->nm_daerah ?></td>
                           <td><?php echo $list->nm_ruas ?></td>
                           <td>
                              <?php
                              if ($list->status_jalan == 1) {
                                 echo "Ruas Jl. Kab/Kota";
                              } elseif ($list->status_jalan == 2) {
                                 echo "Ruas Jl. Provinsi";
                              } elseif ($list->status_jalan == 3) {
                                 echo "Ruas Jl. Nasional";
                              }
                              ?>
                           </td>
                           <td><?php echo $list->nm_kabkota ?></td>
                           <td>
                              <?php
                              if ($list->status_drk == null || $list->status_drk == 1) {
                                 echo "Belum Ditangani";
                              } elseif ($list->status_jalan == 2) {
                                 echo "Sudah Ditangani";
                              }
                              ?>
                           </td>
                           <td style="text-align:center;width:100px">
                              <a href="<?php echo base_url('admin/daerahrawan/details/' . $list->kd_daerah) ?>"><button class="btn btn-xs btn-flat btn-success" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-book"></i></button></a>
                              <a href="<?php echo base_url('admin/daerahrawan/edit/' . $list->kd_daerah) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
                              <?php include('delete.php'); ?>
                           </td>
                        </tr>
                     <?php $i++;
                     } ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </section>
</div>