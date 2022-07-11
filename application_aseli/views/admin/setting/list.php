<div class="content-wrapper">
<section class="content-header">
   <h1>Setting
      <small>Setting Website</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Setting</li>
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
		echo form_open_multipart(base_url('admin/setting'));
		?>
      <div class="row">
         <div class="col-md-9">
            <div class="nav-tabs-custom">
               <ul class="nav nav-tabs">
                  <li class="active"><a href="#tab1" data-toggle="tab">Info Website</a></li>
                  <li><a href="#tab2" data-toggle="tab">Profil</a></li>
                  <li><a href="#tab3" data-toggle="tab">Image</a></li>
                  <li><a href="#tab4" data-toggle="tab">Maps</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane active" id="tab1">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Nama Website</label>
                              <input type="text" name="nmwebsite" class="form-control" placeholder="Nama Website" value="<?php echo $setting->nm_website ?>" >
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Telepon</label>
                              <input type="text" name="telpwebsite" class="form-control" placeholder="Telepon" value="<?php echo $setting->telp_website ?>" >
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Deskripsi</label>
                              <input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi Website" value="<?php echo $setting->desk_website ?>" >
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Email</label>
                              <input type="text" name="emailwebsite" class="form-control" placeholder="Email" value="<?php echo $setting->email_website ?>" >
                           </div>
                           <div class="form-group col-md-6">
                              <label for="exampleInputEmail1">Alamat</label>
                              <input type="text" name="almtwebsite" class="form-control" placeholder="Alamat" value="<?php echo $setting->almt_website ?>" >
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Keyword</label>
                              <input name="tags" class="tagsinput" type="text" value="<?php echo $setting->tag_website ?>" data-role="tagsinput" placeholder="add tags" />
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab2">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <textarea name="about" class="form-control summernote noresize"><?php echo $setting->about ?></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab3">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-7">
                              <input type="file" name="gambar" accept=".JPG" class="filestyle" data-buttonText="Upload Image" data-buttonBefore="true" data-iconName="fa fa-upload">
                              <small><p class="help-block">.JPG Max. 200 Kb (800x600 pixel)</p></small>
                           </div>
                           <div class="form-group col-md-5">
                              <img src="<?php echo base_url('assets/upload/image/'.$setting->logo_website) ?>" class="img-responsive center-block">
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane" id="tab4">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Embed Google Maps</label>
                              <textarea name="maps" class="form-control noresize"><?php echo $setting->maps_location ?></textarea>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Preview</label>
                              <?php if($setting->maps_location != null) { ?>
                                 <div class="maps-preview"><iframe src="<?php echo $setting->maps_location ?>" allowfullscreen></iframe></div>
                              <?php } ?>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="col-md-3">
            <div class="box">
               <div class="box-header">
               <h3 class="box-title">Online</h3>
                  <div class="box-tools pull-right">
                     <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
               </div>
               <div class="box-body">
                  <div class="form-group col-md-5">
                     <div class="row">
                        <select class="form-control" name="online">
                           <option value="Y" <?php if($setting->online == 'Y') {echo "selected";} ?>>Online</option>
                           <option value="N" <?php if($setting->online == 'N') {echo "selected";} ?>>Offline</option>
                        </select>
                     </div>
                  </div>
                  <div class="form-group col-md-7">
                     <div class="row">
                        <button type="submit" class="btn btn-primary btn-flat posisikanan"><i class="fa fa-save"></i> Simpan</button>
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