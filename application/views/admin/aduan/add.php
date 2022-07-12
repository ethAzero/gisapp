<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="<?= base_url() ?>assets/admin/css/jquery.typeahead.min.css">
<div class="content-wrapper">
   <section class="content-header">
      <h1>Aduan
         <small>Add</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Aduan</li>
      </ol>
   </section>

   <section class="content">
      <div class="row">
         <div class="col-md-12">
            <?php
            echo validation_errors('<div class="alert alert-warning">', '</div>');
            if (isset($error)) {
               echo '<div class="alert alert-warning">';
               echo $error;
               echo '</div>';
            }
            echo form_open(base_url('admin/kabkota/add'));
            ?>
            <div class="row">
               <div class="col-md-9">
                  <div class="box">
                     <div class="box-body">
                        <div class="row">
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Desa / Kelurahan</label>
                              <div class="typeahead__container">
                                 <div class="typeahead__field">
                                    <div class="typeahead__query">
                                       <input class="form-control js-typeahead" name="q" autocomplete="off">
                                    </div>
                                    <div class="typeahead__button">
                                       <button type="submit" class="form-control">
                                          <span class="fa fa-search"></span>
                                       </button>
                                    </div>
                                 </div>
                              </div>
                              <input type="text" name="nm_desa" class="form-control" placeholder="Nama Desa / Kelurahan" required>
                              <input type="hidden" name="id_desa" class="form-control" placeholder="nama Desa / Kelurahan" required>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Kecamatan</label>
                              <input type="text" name="nm_kec" class="form-control" placeholder="Nama Kecamatan" required disabled>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Nama Kota / Kabupaten</label>
                              <input type="text" name="nm_kabkota" class="form-control" placeholder="Nama Kabupaten / Kota" required disabled>
                           </div>
                           <div class="form-group col-md-4">
                              <label for="exampleInputEmail1">Wilayah Kerja</label>
                              <input type="text" name="nm_balai" class="form-control" placeholder="Nama Balai" required disabled>
                           </div>
                           <div class="form-group col-md-12">
                              <label for="exampleInputEmail1">Aduan</label>
                              <textarea class="form-control" name="aduan" rows="3" placeholder="Aduan ..."></textarea>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-md-3">
                  <div class="box box-primary">
                     <div class="modal-footer">
                        <a href="<?php echo base_url('admin/kabkota') ?>"><button type="button" class="btn btn-default btn-flat"><i class="fa fa-reply"></i> Batal</button></a>
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
<script src="<?= base_url() ?>assets/admin/js/jquery.typeahead.min.js"></script>
<script>
   $.typeahead({
      input: '.js-typeahead',
      minLength: 1,
      order: "asc",
      dynamic: true,
      delay: 500,
      backdrop: {
         "background-color": "#fff"
      },
      template: function(query, item) {

         var color = "#777";
         if (item.status === "owner") {
            color = "#ff1493";
         }

         return '<span class="row">' +
            '<span class="avatar">' +
            '<img src="{{avatar}}">' +
            "</span>" +
            '<span class="username">{{username}} <small style="color: ' + color + ';">({{status}})</small></span>' +
            '<span class="id">({{id}})</span>' +
            "</span>"
      },
      emptyTemplate: "no result for {{query}}",
      source: {
         user: {
            display: "nama_kelurahan",
            href: "https://www.github.com/{{username|slugify}}",
            data: [{
               "id": 415849,
               "username": "an inserted user that is not inside the database",
               "avatar": "https://avatars3.githubusercontent.com/u/415849",
               "status": "contributor"
            }],
            ajax: function(query) {
               return {
                  type: "GET",
                  url: "<?= base_url('/admin/aduan/data_wilayah') ?>",
                  path: "data.wilayah",
                  data: {
                     q: "{{query}}"
                  },
                  callback: {
                     done: function(data) {
                        for (var i = 0; i < data.data.wilayah.length; i++) {
                           if (data.data.wilayah[i].nama_kelurahan === 'running-coder') {
                              data.data.wilayah[i].jenis = 'owner';
                           } else {
                              data.data.wilayah[i].id = 'contributor';
                           }
                        }
                        return data;
                     }
                  }
               }
            }

         },
         project: {
            display: "project",
            href: function(item) {
               return '/' + item.project.replace(/\s+/g, '').toLowerCase() + '/documentation/'
            },
            ajax: [{
               type: "GET",
               url: "<?= base_url('/admin/aduan/data_wilayah') ?>",
               data: {
                  q: "{{query}}"
               }
            }, "data.project"],
            template: '<span>' +
               '<span class="project-logo">' +
               '<img src="{{image}}">' +
               '</span>' +
               '<span class="project-information">' +
               '<span class="project">{{project}} <small>{{version}}</small></span>' +
               '<ul>' +
               '<li>{{demo}} Demos</li>' +
               '<li>{{option}}+ Options</li>' +
               '<li>{{callback}}+ Callbacks</li>' +
               '</ul>' +
               '</span>' +
               '</span>'
         }
      },
      callback: {
         onClick: function(node, a, item, event) {

            // You can do a simple window.location of the item.href
            alert(JSON.stringify(item));

         },
         onSendRequest: function(node, query) {
            console.log('request is sent')
         },
         onReceiveRequest: function(node, query) {
            console.log('request is received')
         }
      },
      debug: true
   });
</script>