<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Aduan</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Aduan</li>
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
                  <?php if ($this->session->userdata('hakakses') == 'AD') { ?>
                     <a href="<?php echo base_url('admin/aduan/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
                  <?php } ?>
                  <a href="<?php echo base_url('admin/kabkota/exportexcel') ?>" target="_blank"><button class="btn btn-primary btn-flat"><i class="fa fa-file-excel-o"></i> Export Excel</button></a>
               </div>
            </div>
            <br>
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                     <tr>
                        <th width="3%">No</th>
                        <th width="40%">Aduan</th>
                        <th width="20%">Lokasi</th>
                        <th width="20%">Chanel Aduan</th>
                        <th width="20%">Status</th>
                        <th style="text-align:center">Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;
                     foreach ($list as $list) { ?>
                        <tr class="odd gradeX">
                           <td align="center"><?php echo $i ?></td>
                           <td><?php echo $list->aduan ?></td>
                           <td>
                              <?php echo $list->jenis . ' : ' . $list->nama_kelurahan ?><br>
                              <?php echo 'Kecamatan : ' . $list->nama_kecamatan ?><br>
                              <?php echo $list->nm_kabkota ?>
                              <?php echo 'WilKer : ' . $list->nm_balai ?><br>
                           </td>
                           <td><?= $list->chanel_aduan; ?></td>
                           <td>
                              <?php if ($list->stat_read1 == 0) {
                                 echo "Dibaca : <i class=\"fa fa-times text-red\"></i><br>";
                              } else {
                                 echo "Dibaca : <i class=\"fa fa-check text-green\"></i><br>";
                              } ?>
                              <?php if ($list->stat_tanggap == 0) {
                                 echo "Ditanggapi : <i class=\"fa fa-times text-red\" aria-hidden=\"true\"></i><br>";
                              } else {
                                 echo "Ditanggapi : <i class=\"fa fa-check text-green\"></i><br>";
                              } ?>
                              <?php
                              if ($list->stat_tangani == 0) {
                                 echo "Ditangani : <i class=\"fa fa-times text-red\"></i>";
                              } else if ($list->stat_tangani == 1) {
                                 echo "Ditangani : <i class=\"fa fa-check text-green\"></i>";
                              }
                              ?>
                           </td>
                           <td style="text-align:center;width:100px">
                              <?php
                              if ($this->session->userdata('hakakses') == '01' || $this->session->userdata('hakakses') == '02' || $this->session->userdata('hakakses') == '03' || $this->session->userdata('hakakses') == '04' || $this->session->userdata('hakakses') == '05' || $this->session->userdata('hakakses') == '06') { ?>
                                 <a href="<?php echo base_url('admin/aduan/detail/' . $list->id_aduan) ?>"><button class="btn btn-xs btn-flat btn-maroon" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-list-alt"></i></button></a>
                                 <?php
                                 if ($list->stat_tanggap != 1) { ?>
                                    <a href="<?php echo base_url('admin/aduan/addtanggap/' . $list->id_aduan) ?>"><button class="btn btn-xs btn-flat btn-purple" data-toggle="tooltip" data-placement="top" title="Tanggapi"><i class="fa fa-reply"></i></button></a>
                                 <?php } ?>
                              <?php } else if ($this->session->userdata('hakakses') == 'AD') { ?>
                                 <a href="<?php echo base_url('admin/aduan/edit/' . $list->id_aduan) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                 <a href="<?php echo base_url('admin/aduan/detail/' . $list->id_aduan) ?>"><button class="btn btn-xs btn-flat btn-maroon" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-list-alt"></i></button></a>
                                 <?php include('delete.php'); ?>
                              <?php } else if ($this->session->userdata('hakakses') == 'S' || $this->session->userdata('hakakses') == 'A') { ?>
                                 <a href="<?php echo base_url('admin/aduan/detail/' . $list->id_aduan) ?>"><button class="btn btn-xs btn-flat btn-maroon" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fa fa-list-alt"></i></button></a>
                              <?php } ?>
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