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

            <div class="row">
               <div class="col-md-12">
                  <ul class="timeline">
                     <!-- timeline aduan dibuat-->
                     <li class="time-label">
                        <span class="bg-red">
                           <?php
                           date_default_timezone_set("Asia/Bangkok");
                           //$aduandate = strtotime($detail->created_at);
                           echo "Aduan Dibuat " . date('d F Y', strtotime($detail->created_at));
                           ?>
                        </span>
                     </li>

                     <!-- Isi Aduan-->

                     <li>
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
                        <i class="fa <?= $fa . ' ' . $fatext ?> bg-white"></i>
                        <div class="timeline-item">
                           <span class="time"><i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($detail->created_at)); ?></span>
                           <h3 class="timeline-header"><a href="#">Melalui : </a> <?= $detail->chanel_aduan; ?></h3>
                           <div class="timeline-body">
                              <?= $detail->aduan; ?>
                           </div>
                        </div>
                     </li>

                     <!-- Status Dibaca -->
                     <?php if ($detail->stat_read1 == 0) { ?>
                        <li>
                           <i class="fa fa-times bg-red"></i>
                           <div class="timeline-item">
                              <h3 class="timeline-header"><a href="#">Belum Dibaca</a></h3>
                           </div>
                        </li>
                     <?php } else if ($detail->stat_read1 == 1) { ?>
                        <li>
                           <i class="fa fa-check bg-green"></i>
                           <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($detail->read_at)); ?></span>
                              <h3 class="timeline-header"><a href="#">Dibaca <?= date('d F Y', strtotime($detail->created_at)) ?></a></h3>
                           </div>
                        </li>
                     <?php } ?>
                     <!-- akhir aduan dibuat -->

                     <!-- awal aduan Divalidasi -->
                     <?php
                     if ($detail->stat_tanggap == 0) { ?>
                        <li class="time-label">
                           <span class="bg-red">
                              Aduan Belum Divalidasi
                           </span>
                        </li>
                        <?php if (
                           $this->session->userdata('hakakses') == '01' ||
                           $this->session->userdata('hakakses') == '02' ||
                           $this->session->userdata('hakakses') == '03' ||
                           $this->session->userdata('hakakses') == '04' ||
                           $this->session->userdata('hakakses') == '05' ||
                           $this->session->userdata('hakakses') == '06'
                        ) { ?>
                           <li>
                              <i class="fa fa-plus bg-aqua"></i>
                              <div class="timeline-item">
                                 <span class="time"><i class="fa fa-exclamation-circle"></i> klik text disamping</span>
                                 <h3 class="timeline-header"><a href="<?= base_url('admin/aduan/addtanggap/' . $detail->id_aduan) ?>">Validasi Sekarang!</a></h3>
                              </div>
                           </li>
                        <?php } ?>
                     <?php } else if ($detail->stat_tanggap == 1) { ?>
                        <li class="time-label">
                           <span class="bg-orange">
                              Divalidasi <?= date('d F Y', strtotime($detail->tanggap_at)); ?>
                           </span>
                        </li>
                        <!-- Tanggapan -->
                        <li>
                           <i class="fa fa-reply bg-purple"></i>
                           <div class="timeline-item">
                              <span class="time"><i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($detail->tanggap_at)); ?></span>
                              <h3 class="timeline-header"><a href="#">Tanggapan</a></h3>
                              <div class="timeline-body">
                                 <?= $detail->tanggapan; ?>
                              </div>
                           </div>
                        </li>
                        <!-- Kewenangan -->
                        <li>
                           <?php if ($detail->kewenangan == 1) { ?>
                              <i class="fa fa-check bg-green"></i>
                              <div class="timeline-item">
                                 <h3 class="timeline-header"><a href="#">Kewenangan</a></h3>
                              </div>
                           <?php } else if ($detail->kewenangan == 2) { ?>
                              <i class="fa fa-times bg-red"></i>
                              <div class="timeline-item">
                                 <h3 class="timeline-header"><a href="#">Bukan Kewenangan</a></h3>
                              </div>
                           <?php } ?>
                        </li>
                        <!-- lokasi -->
                        <li>
                           <i class="fa fa-map-marker bg-red"></i>
                           <div class="timeline-item">
                              <h3 class="timeline-header"><a href="#">Lokasi Aduan</a></h3>
                              <div class="timeline-body">
                                 <?php if ($detail->kewenangan == 1) { ?>
                                    Kode Ruas Jalan : <?= $jalan->kd_jalan; ?> <br>
                                    Ruas Jalan Provinsi : <?= $jalan->nm_ruas; ?> <br>
                                 <?php } ?>

                                 <?= $detail->jenis . ' ' . $detail->nama_kelurahan . ' Kec. ' . $detail->nama_kecamatan . ' Kab. ' . $detail->nm_kabkota; ?>
                              </div>
                           </div>
                        </li>
                        <li>
                           <i class="fa fa-home bg-maroon"></i>
                           <div class="timeline-item">
                              <h3 class="timeline-header"><a href="#">Wilayah Kerja</a></h3>
                              <div class="timeline-body">
                                 <?= $detail->nm_balai; ?>
                              </div>
                           </div>
                        </li>
                        <?php if (
                           $this->session->userdata('hakakses') == '01' ||
                           $this->session->userdata('hakakses') == '02' ||
                           $this->session->userdata('hakakses') == '03' ||
                           $this->session->userdata('hakakses') == '04' ||
                           $this->session->userdata('hakakses') == '05' ||
                           $this->session->userdata('hakakses') == '06'
                        ) { ?>
                           <li>
                              <i class="fa fa-pencil bg-aqua"></i>
                              <div class="timeline-item">
                                 <span class="time"><i class="fa fa-exclamation-circle"></i> klik text disamping</span>
                                 <h3 class="timeline-header"><a href="<?= base_url('admin/aduan/addtanggap/' . $detail->id_aduan) ?>">Edit Validasi</a></h3>
                              </div>
                           </li>
                        <?php } ?>
                        <!-- awal aduan Ditangani -->
                        <?php
                        if ($detail->stat_tangani == 0) { ?>
                           <li class="time-label">
                              <span class="bg-red">
                                 Aduan Belum Ditangani
                              </span>
                           </li>
                           <?php if (
                              $this->session->userdata('hakakses') == '01' ||
                              $this->session->userdata('hakakses') == '02' ||
                              $this->session->userdata('hakakses') == '03' ||
                              $this->session->userdata('hakakses') == '04' ||
                              $this->session->userdata('hakakses') == '05' ||
                              $this->session->userdata('hakakses') == '06'
                           ) { ?>
                              <li>
                                 <i class="fa fa-pencil bg-aqua"></i>
                                 <div class="timeline-item">
                                    <span class="time"><i class="fa fa-exclamation-circle"></i> klik text disamping</span>
                                    <h3 class="timeline-header"><a href="<?= base_url('admin/aduan/addtangani/' . $detail->id_aduan) ?>">Tangani Sekarang!</a></h3>
                                 </div>
                              </li>
                           <?php } ?>
                        <?php } else if ($detail->stat_tangani == 1) { ?>
                           <li class="time-label">
                              <span class="bg-green">
                                 Ditangani <?= date('d F Y', strtotime($detail->tangani_at)); ?>
                              </span>
                           </li>
                           <?php if ($detail->kewenangan == 1) { ?>
                              <!-- Tanggapan -->
                              <li>
                                 <i class="fa fa-reply bg-purple"></i>
                                 <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($detail->tangani_at)); ?></span>
                                    <h3 class="timeline-header"><a href="#">Penanganan</a></h3>
                                    <div class="timeline-body">
                                       <?= $detail->tanggapan; ?>
                                    </div>
                                 </div>
                              </li>
                              <!-- Detail Penanganan-->
                              <li>
                                 <i class="fa fa-camera bg-purple"></i>
                                 <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 2 days ago</span>
                                    <h3 class="timeline-header"><a href="#">Detail Penanganan</a></h3>
                                    <div class="timeline-body">
                                       <img src="http://placehold.it/150x100" alt="..." class="margin">
                                       <img src="http://placehold.it/150x100" alt="..." class="margin">
                                       <img src="http://placehold.it/150x100" alt="..." class="margin">
                                       <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                 </div>
                              </li>
                              <li>
                                 <i class="fa fa-check bg-green"></i>
                                 <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($detail->tangani_at)); ?></span>
                                    <h3 class="timeline-header"><a href="#">Sudah Ditangani</a></h3>
                                 </div>
                              </li>
                              <?php if (
                                 $this->session->userdata('hakakses') == '01' ||
                                 $this->session->userdata('hakakses') == '02' ||
                                 $this->session->userdata('hakakses') == '03' ||
                                 $this->session->userdata('hakakses') == '04' ||
                                 $this->session->userdata('hakakses') == '05' ||
                                 $this->session->userdata('hakakses') == '06'
                              ) { ?>
                                 <li>
                                    <i class="fa fa-pencil bg-aqua"></i>
                                    <div class="timeline-item">
                                       <span class="time"><i class="fa fa-exclamation-circle"></i> klik text disamping</span>
                                       <h3 class="timeline-header"><a href="<?= base_url('admin/aduan/edittangani/' . $detail->id_aduan) ?>">Edit Penanganan</a></h3>
                                    </div>
                                 </li>
                              <?php } ?>
                           <?php } else if ($detail->kewenangan == 2) { ?>
                              <li>
                                 <i class="fa fa-check bg-green"></i>
                                 <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= date('H:i:s', strtotime($detail->tangani_at)); ?></span>
                                    <h3 class="timeline-header"><a href="#">Sudah Ditangani</a></h3>
                                 </div>
                              </li>
                           <?php } ?>
                        <?php } ?>
                     <?php } ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </section>

</div>
</section>
</div>
</script>