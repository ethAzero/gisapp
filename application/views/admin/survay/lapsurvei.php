<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="content-wrapper">
   <section class="content-header">
      <h1>Laporan Survei</h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Laporan Survei</li>
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
            <div class="box box-primary">
               <div class="box-header with-border">
                  <div class="col-md-6">
                     <label>Jenis Perlengkapan Jalan </label>
                     <select name="jenisperjal" id="jenisperjal" class="form-control select2" style="width: 100%;">
                        <option value="apil">APILL</option>
                        <option value="cermin">Cermin Tikung</option>
                        <option value="delinator">Delinator</option>
                        <option value="flash">Warning Light</option>
                        <option value="guardrail">Guardrail</option>
                        <option value="marka">Marka Jalan</option>
                        <option value="pju">PJU</option>
                        <option value="rambu">Rambu</option>
                        <option value="rppj">RPPJ</option>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label>Ruas Jalan</label>
                     <select name="nmruas" id="nmruas" class="form-control select2" style="width: 100%;">
                        <?php foreach ($ruasjalan as $ruasjalan) : ?>
                           <option value="<?php echo $ruasjalan->kd_jalan ?>"><?php echo $ruasjalan->nm_ruas ?></option>
                        <?php endforeach ?>
                     </select>
                  </div>
                  <div class="col-md-6">
                     <label>Tanggal Survei</label>
                     <div class="input-group date">
                        <div class="input-group-addon">
                           <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="tanggal">
                     </div>
                  </div>
                  <div class="col-md-6">
                     <label></label>
                     <div class="input-group date">
                        <button class="btn btn-primary btn-flat" onclick="loadlapsurvei()"><i class="fa fa-file-excel-o"></i> Tampilkan</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="box box-primary">
         <div class="box-body">
            <div class="table-responsive">
               <table class="table table-striped table-bordered table-hover" id="tabellaporan">
                  <button onclick="cetak()" hidden id="cetakexcel">Export ke Excel</button>
                  <p></p>
               </table>
            </div>
         </div>
      </div>
   </section>
</div>