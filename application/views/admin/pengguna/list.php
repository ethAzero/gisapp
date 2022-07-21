<div class="content-wrapper">
   <section class="content-header">
      <h1>Pengguna
         <small>Pengguna Website</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Pengguna</li>
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
      ?>
      <div class="box box-primary">
         <div class="box-body">
            <div class="table-toolbar">
               <div class="btn-group">
                  <a href="<?php echo base_url('admin/pengguna/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a>
               </div>
            </div>
            <br>
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                  <thead>
                     <tr>
                        <th width="20">No</th>
                        <th>Username</th>
                        <th>Nama Pengguna</th>
                        <th>Level</th>
                        <th style="text-align:center">Status</th>
                        <th style="text-align:center">Aksi</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php $i = 1;
                     foreach ($pengguna as $pengguna) { ?>
                        <tr class="odd gradeX">
                           <td align="center"><?php echo $i ?></td>
                           <td><?php echo $pengguna->username ?></td>
                           <td><?php echo $pengguna->nm_pengguna ?></td>
                           <td width="12%"><?php if ($pengguna->akseslevel == 'A') {
                                                echo "Admin";
                                             } else {
                                                echo "User";
                                             } ?></td>
                           <td width="8%"><?php if ($pengguna->status == 'A') {
                                             echo "<span class='label label-primary' data-toggle='tooltip' data-placement='top' title='aktif'>Aktif</span>";
                                          } else {
                                             echo "<span class='label label-danger' data-toggle='tooltip' data-placement='top' title='blokir'>Non Aktif</span>";
                                          } ?></td>
                           <td style="text-align:center;width:70px">
                              <a href="<?php echo base_url('admin/pengguna/edit/' . $pengguna->username) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
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