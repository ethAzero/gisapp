<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
	<section class="content-header">
      <h1>Fasilitas RPPJ</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">RPPJ</li>
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
  
            <div class="row">
                  <div class="col-sm-4"><a href="<?php echo base_url('admin/rppj/add') ?>"><button class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button></a></div>
                  <div class="col-sm-4">
                     <select class="form-control" id="nm_ruas">
                        <option value="">--Pilih Nama Ruas--</option>
                        <?php foreach ($ruas as $row) {
                        ?>
                        <option value="<?php echo $row->kd_jalan;?>"><?php echo $row->nm_ruas;?></option>
                        <?php };?>
                     </select>
                  </div>
                  <div class="col-sm-4">
                     <a id="cetak"><button class="btn btn-primary btn-flat"><i class="fa fa-print"></i> Cetak</button></a>
                  </div>
               </div>     
         </div>
         <br>
   		<div class="table-responsive">
         <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
               <tr>
                  <th width="20">No</th>
                  <th width="70">Kode</th>
                  <th>Ruas Jalan</th>
                  <th>Jenis</th>
                  <th>Letak</th>
                  <th>Status</th>
                  <th style="text-align:center">Aksi</th>
               </tr>
            </thead>
            <tbody>
            	<?php $i=1; foreach($list as $list){?>
               <tr class="odd gradeX">
                  <td align="center"><?php echo $i ?></td>
                  <td align="center"><?php echo $list->kd_rppj ?></td>
                  <td><?php echo $list->nm_ruas ?></td>
                  <td><?php echo $list->jenis ?></td>
                  <td><?php echo $list->letak ?></td>
                  <td><?php echo $list->status ?></td>
                  <td style="text-align:center;width:100px">
                     <a href="<?php echo base_url('admin/rppj/edit/'.$list->kd_rppj) ?>"><button class="btn btn-xs btn-flat btn-warning" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-pencil"></i></button></a>
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
<script type="text/javascript">
    $( document ).ready(function() {
        $("#cetak").click(function() {
            var base_url   = '<?php echo base_url();?>' + 'admin/laporan/cetak_rppj/';
            var cik        = $('#nm_ruas').val();
            // var path       = cik;
            // $('#cetak').attr("href", base_url(path));
            window.location.href = base_url + cik;
            // alert(cik);
        });

    });
</script>