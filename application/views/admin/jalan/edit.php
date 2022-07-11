<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="content-wrapper">
<section class="content-header">
   <h1>Jalan Provinsi
      <small>Edit</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Jalan Provinsi</li>
   </ol>
</section>

<section class="content">
<div class="row">
   <div class="col-md-12">
   	<?php
		echo validation_errors('<div class="alert alert-warning">','</div>');
      if(isset($error)){
         echo '<div class="alert alert-warning">';
         echo $error;
         echo '</div>';
      }
		echo form_open(base_url('admin/jalan/edit/'.$detail->kd_jalan));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="box">
               <div class="box-body">
                  <div class="row">
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Nomor Ruas</label>
                        <input type="text" name="nmrruas" class="form-control" placeholder="Nomor Ruas" value="<?php echo $detail->no_ruas ?>" maxlength="3" disabled>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Fungsi</label>
                        <input type="text" name="jlnfungsi" class="form-control" value="<?php echo $detail->jln_fungsi ?>" placeholder="Fungsi" disabled>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Kelas</label>
                        <input type="text" name="jlnkelas" class="form-control" value="<?php echo $detail->jln_kelas ?>" placeholder="Kelas">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Panjang Jalan</label>
                        <input type="text" name="jlnpanjang" class="form-control" value="<?php echo $detail->jln_panjang ?>" placeholder="Panjang Jalan" required>
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Wilayah</label>
                        <select name="balai" class="form-control" required>
                           <option value="">Wilayah</option>
                           <?php foreach ($balai as $key => $balai): ?>
                              <option value="<?php echo $balai->kd_balai ?>" <?php if($detail->kd_balai === $balai->kd_balai){echo "selected";} ?>><?php echo $balai->nm_balai ?></option>
                           <?php endforeach ?>
                        </select>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Nama Ruas</label>
                        <input type="text" name="nmruas" class="form-control" value="<?php echo $detail->nm_ruas ?>" placeholder="Nama Ruas" required>
                     </div>
                     <?php
                        $pecah   = explode(",",$detail->jln_start);
                        $startx = $pecah[0];
                        $starty = $pecah[1];
                     ?>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Awal Jalan</label><small> (Koordinat Maps)</small>
                        <input type="text" name="startx" class="form-control" value="<?php echo $startx ?>" placeholder="X" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" name="starty" class="form-control" value="<?php echo $starty ?>" placeholder="Y" required>
                     </div>
                     <?php
                        $pecah   = explode(",",$detail->jln_end);
                        $endx = $pecah[0];
                        $endy = $pecah[1];
                     ?>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Akhir Jalan</label><small> (Koordinat Maps)</small>
                        <input type="text" name="endx" class="form-control" value="<?php echo $endx ?>" placeholder="X" required>
                     </div>
                     <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">&nbsp;</label>
                        <input type="text" name="endy" class="form-control" value="<?php echo $endy ?>" placeholder="Y" required>
                     </div>
                     <div class="form-group col-md-6">
                        <label for="exampleInputEmail1">Rute</label>
                        <textarea name="lintasan" class="form-control noresize"><?php echo $detail->lintasan ?></textarea>
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Apil</label>
                        <input name="apil" value="1" type="checkbox" <?php if($detail->apil == '1'){echo "checked";} ?> class="minimal">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Cermin</label>
                        <input name="cermin" value="1" type="checkbox" <?php if($detail->cermin == '1'){echo "checked";} ?> class="minimal">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">PJU</label>
                        <input name="pju" value="1" type="checkbox" <?php if($detail->pju == '1'){echo "checked";} ?> class="minimal">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Flash</label>
                        <input name="flash" value="1" type="checkbox" <?php if($detail->flash == '1'){echo "checked";} ?> class="minimal">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">Rambu</label>
                        <input name="rambu" value="1" type="checkbox" <?php if($detail->rambu == '1'){echo "checked";} ?> class="minimal">
                     </div>
                     <div class="form-group col-md-2">
                        <label for="exampleInputEmail1">RPPJ</label>
                        <input name="rppj" value="1" type="checkbox" <?php if($detail->rppj == '1'){echo "checked";} ?> class="minimal">
                     </div>
                     <div class="form-group col-md-4">
                        <label for="exampleInputEmail1">Daerah Rawan Kecelakaan</label>
                        <input name="drk" value="1" type="checkbox" <?php if($detail->drk == '1'){echo "checked";} ?> class="minimal">
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box box-primary">
               <div class="modal-footer">
                  <a href="<?php echo base_url('admin/jalan') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
                  <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
               </div>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
</section>
</div>