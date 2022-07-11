<div class="content-wrapper">
<section class="content-header">
   <h1>Tagline</h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Tagline</li>
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
?>
<div class="row">
   <div class="col-md-12">
   	<?php
		echo validation_errors('<div class="alert alert-warning">','</div>');
		form_open_multipart(base_url('admin/tagline'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab1" data-toggle="tab">Text</a></li>
                  <li><a href="#tab2" data-toggle="tab">Image</a></li>
                  <li><a href="#tab3" data-toggle="tab">Detail</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="tab1">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <textarea name="tagline" class="form-control summernote noresize"><?php echo $tagline->home_text ?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-7">
                              <input type="file" name="gambar" accept=".jpg" class="filestyle" data-buttonText="Upload Image" data-buttonBefore="true" data-iconName="fa fa-upload">
                              <small><p class="help-block">.jpg Max. 200 Kb (216x78 pixel)</p></small>
                           </div>
                           <div class="form-group col-md-5">
                              <img src="<?php echo base_url('assets/upload/image/'.$tagline->home_img) ?>" class="img-responsive center-block">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab3">
                     <div class="box-body">
                        <div class="row">
                           <div class="col-md-12">
                              <input name="detail" class="tagsinput" type="text" value="<?php echo $tagline->home_tag ?>" data-role="tagsinput" placeholder="add Keterangan" />
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="box">
               <div class="box-body">
                  <div class="form-group col-md-12">
                     <div class="row">
                        <div class="modal-kanan">
                           <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php echo form_close(); ?>
   </div>
</div>
</section>
</div>