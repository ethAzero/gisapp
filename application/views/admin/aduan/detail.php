<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />
<style type="text/css">
   @media (max-width: 768px) {
      .ui-autocomplete {
         width: auto;
         max-width: calc(92% - 22px);
         margin-left: 10px;
      }
   }

   .ui-autocomplete {
      max-height: 200px;
      overflow-y: auto;
      /* prevent horizontal scrollbar */
      overflow-x: hidden;
      /* add padding to account for vertical scrollbar */
      padding-right: 20px;
   }

   .ui-autocomplete-row {
      padding: 8px;
      background-color: #f4f4f4;
      border-bottom: 1px solid #ccc;
   }

   .ui-autocomplete-row:hover {
      background-color: #ddd;
   }
</style>

<div class="content-wrapper">
   <section class="content-header">
      <h1>Aduan
         <small>Detail</small>
      </h1>
      <ol class="breadcrumb">
         <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
         <li class="active">Aduan Detail</li>
      </ol>
   </section>

   <section class="content">
      <a href="<?php echo base_url('admin/aduan/') ?>"><button class="btn btn-primary btn-flat"><i class="fa fa-reply"></i> Kembali</button></a>
      <br></br>
      <div class="row">
         <div class="col-md-12">
            <div class="box box-widget widget-user-2">
               <div class="box-header with-border">
                  <div class="widget-user-header">
                     <div class="col-md-10">
                        <?php
                        if ($detail->id_chanel_aduan == 1) {
                           $fa = "fa-warning";
                           $fatext = "text-yellow";
                        } else if ($detail->id_chanel_aduan == 2) {
                           $fa = "fa-instagram";
                           $fatext = "text-red";
                        } else if ($detail->id_chanel_aduan == 3) {
                           $fa = "fa-whatsapp";
                           $fatext = "text-green";
                        } else {
                           $fa = "fa-twitter";
                           $fatext = "text-blue";
                        };
                        ?>
                        <h3 class="widget-user-username"><i class="fa fa-brand <?= $fa . ' ' . $fatext ?>" style="padding-right: 10px;"></i><label>Chanel <?= $detail->chanel_aduan; ?></label></h3>
                     </div>
                     <div class="col-md-2 align-self-center">
                        <?php
                        if ($this->session->userdata('hakakses') != 'AD' and $this->session->userdata('hakakses') != '07' and $this->session->userdata('hakakses') != 'PE' and $this->session->userdata('hakakses') != 'JT' and $this->session->userdata('hakakses') != 'AJ') { ?>
                           <?php if ($detail->stat_tanggap != 1) {
                              echo "<h4><a href=\"" . base_url('admin/aduan/addtanggap/' . $detail->id_aduan) . "\"><button class=\"btn btn-xs btn-flat btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Tanggapi\">Tanggapi</button></a></h4>";
                           } else {
                              echo "<h4><a href=\"" . base_url('admin/aduan/addtanggap/' . $detail->id_aduan) . "\"><button class=\"btn btn-xs btn-flat btn-success\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit Tanggapan\">Edit Tanggapan</button></a></h4>";
                           } ?>
                        <?php } ?>
                     </div>
                     <table class="table table-condensed">
                        <tr class="">
                           <td width="20%">Tanggal Laporan</td>
                           <td width="2%">:</td>
                           <td widt="78%"><?= $detail->created_at; ?></td>
                        </tr>
                        <tr class="">
                           <td width="20%">Dibaca</td>
                           <td width="2%">:</td>
                           <td widt="78%">
                              <?php
                              if ($detail->stat_read == 0) {
                                 echo "<i class=\"fa fa-times text-red\"></i>";
                              } else {
                                 echo $detail->read_at . " <i class=\"fa fa-check text-green\"></i>";
                              }
                              ?>
                           </td>
                        </tr>
                        <tr>
                           <td>Ditanggapi</td>
                           <td>:</td>
                           <td>
                              <?php
                              if ($detail->stat_tanggap == 0) {
                                 echo "<i class=\"fa fa-times text-red\"></i>";
                              } else {
                                 echo $detail->tanggap_at . " <i class=\"fa fa-check text-green\"></i>";
                              }
                              ?>
                           </td>
                        </tr>
                        <tr>
                           <td>Lokasi</td>
                           <td>:</td>
                           <td><?= $detail->jenis . ' ' . $detail->nama_kelurahan . ' Kec. ' . $detail->nama_kecamatan . ' Kab. ' . $detail->nm_kabkota; ?></td>
                        </tr>
                        <tr>
                           <td>Wilayah Kerja</td>
                           <td>:</td>
                           <td><?= $detail->nm_balai; ?></td>
                        </tr>
                     </table>
                  </div>
               </div>
               <div class="box-footer">
                  <h4><label> Isi Aduan</label></h3>
                     <?= $detail->aduan; ?>
               </div>
               <div class="box-footer">
                  <h4><label>Tanggapan </label></h3>
                     <?php
                     if ($detail->stat_tanggap == 0) {
                        echo "<span>Belum Ditanggapi </span><i class=\"fa fa-times text-red\"></i>";
                     } else {
                        echo $detail->tanggapan; //ganti isi tanggapan
                     }
                     ?>
               </div>
            </div>
         </div>
   </section>
</div>
</script>