<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<style type="text/css">
   .cetak-title1 {
      font-size: 15px;
      text-align: center;
   }

   .cetak-title2 {
      font-size: 18px;
      text-align: center;
      font-weight: bold;
   }

   .cetak-title3 {
      font-size: 10px;
      text-align: center;
   }

   .header {
      margin-bottom: 20px;
   }

   .text-excel {
      mso-number-format: "\@";
      /*force text*/
   }

   img {
      width: 150px;
      height: 100px;
      object-fit: scale-down;
   }
</style>
<?php

$hakakses = $this->session->userdata('hakakses');
if ($hakakses == 01) {
   $balai = "BALAI PENGELOLA SARANA PRASARANA PERHUBUNGAN WILAYAH I KELAS A";
} else if ($hakakses == 02) {
   $balai = "BALAI PENGELOLA SARANA PRASARANA PERHUBUNGAN WILAYAH II KELAS B";
} else if ($hakakses == 03) {
   $balai = "BALAI PENGELOLA SARANA PRASARANA PERHUBUNGAN WILAYAH III KELAS A";
} else if ($hakakses == 04) {
   $balai = "BALAI PENGELOLA SARANA PRASARANA PERHUBUNGAN WILAYAH IV KELAS A";
} else if ($hakakses == 05) {
   $balai = "BALAI PENGELOLA SARANA PRASARANA PERHUBUNGAN WILAYAH V KELAS B";
} else if ($hakakses == 06) {
   $balai = "BALAI PENGELOLA SARANA PRASARANA PERHUBUNGAN WILAYAH VI KELAS A";
}

if ($jenisperjal == 'apil') {
   $jenisperjaltext = 'APILL';
} else if ($jenisperjal == 'cermin') {
   $jenisperjaltext = 'Cermin Tikung';
} else if ($jenisperjal == 'delinator') {
   $jenisperjaltext = 'Delinator';
} else if ($jenisperjal == 'flash') {
   $jenisperjaltext = 'Warning Light';
} else if ($jenisperjal == 'guardrail') {
   $jenisperjaltext = 'Guardrail';
} else if ($jenisperjal == 'marka') {
   $jenisperjaltext = 'Marka Jalan';
} else if ($jenisperjal == 'pju') {
   $jenisperjaltext = 'Penerangan Jalan Umum (PJU)';
} else if ($jenisperjal == 'rambu') {
   $jenisperjaltext = 'Rambu';
} else if ($jenisperjal == 'rppj') {
   $jenisperjaltext = 'RPPJ';
}

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $jenisperjal . ".xls");
header("Pragma: no-cache");
header("Content-Transfer-Encoding: BINARY");
header("Expires: 0");
?>
<div class="header">
   <div class="cetak-title2">DATA SURVEI <?= strtoupper($jenisperjaltext) ?></div>
   <div class="cetak-title2"><?= $balai ?></div>
   <div class="cetak-title2">PADA RUAS JALAN <?php echo $ruasjalan->nm_ruas ?></div>
   <br>
   <diV>Tanggal : <?= $tanggal ?></diV>
   <p></p>
</div>

<table border="1" width="100%">
   <tbody>
      <tr style="font-weight:bold;">
         <td style="vertical-align:middle" width="40" height="40" align="center">No</td>
         <?php foreach ($columns as $columns) : ?>
            <td style="vertical-align:middle" height="40" align="center"><?= $columns ?></td>
         <?php endforeach ?>
      </tr>
      <?php
      $i = 1;
      if ($jenisperjal == 'apil') {
         foreach ($dataperjal as $dataperjal) : ?>
            <tr>
               <td width="40" align="center" style="vertical-align:top"><?php echo $i ?></td>
               <td width="90" style="vertical-align:top"><?php echo $dataperjal->kd_apil ?></td>
               <td width="90" style="vertical-align:top" align="center"><?php echo $dataperjal->km_lokasi ?></td>
               <td width="200" style="vertical-align:top"><?php echo $dataperjal->jenis ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->letak ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->status ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lang ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lat ?></td>
               <td width="500" style="vertical-align:top; padding:10px" height="200" align="center">
                  <?php if ($dataperjal->img_apil != '') { ?>
                     <img src="<?php echo base_url('assets/upload/apil/thumbs/') . $dataperjal->img_apil ?>" width="15%">
                  <?php } else {
                     echo '-';
                  } ?>
               </td>
            </tr>
         <?php $i++;
         endforeach;
      } else if ($jenisperjal == 'pju') {
         foreach ($dataperjal as $dataperjal) : ?>
            <tr>
               <td width="40" align="center" style="vertical-align:top"><?php echo $i ?></td>
               <td width="90" style="vertical-align:top"><?php echo $dataperjal->kd_pju ?></td>
               <td width="90" style="vertical-align:top" align="center"><?php echo $dataperjal->km_lokasi ?></td>
               <td width="200" style="vertical-align:top"><?php echo $dataperjal->jenis ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->letak ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->status ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lang ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lat ?></td>
               <td width="500" style="vertical-align:top; padding:10px" height="200" align="center">
                  <?php if ($dataperjal->img_pju != '') { ?>
                     <img src="<?php echo base_url('assets/upload/pju/thumbs/') . $dataperjal->img_pju ?>" width="15%">
                  <?php } else {
                     echo '-';
                  } ?>
               </td>
            </tr>
         <?php $i++;
         endforeach;
      } else if ($jenisperjal == 'cermin') {
         foreach ($dataperjal as $dataperjal) : ?>
            <tr>
               <td width="40" align="center" style="vertical-align:top"><?php echo $i ?></td>
               <td width="90" style="vertical-align:top"><?php echo $dataperjal->kd_cermin ?></td>
               <td width="90" style="vertical-align:top" align="center"><?php echo $dataperjal->km_lokasi ?></td>
               <td width="200" style="vertical-align:top"><?php echo $dataperjal->jenis ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->letak ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->status ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lang ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lat ?></td>
               <td width="500" style="vertical-align:top; padding:10px" height="200" align="center">
                  <?php if ($dataperjal->img_cermin != '') { ?>
                     <img src="<?php echo base_url('assets/upload/cermin/thumbs/') . $dataperjal->img_cermin ?>" width="15%">
                  <?php } else {
                     echo '-';
                  } ?>
               </td>
            </tr>
         <?php $i++;
         endforeach;
      } else if ($jenisperjal == 'delinator') {
         foreach ($dataperjal as $dataperjal) : ?>
            <tr>
               <td width="40" align="center" style="vertical-align:top"><?php echo $i ?></td>
               <td width="90" style="vertical-align:top"><?php echo $dataperjal->kd_delinator ?></td>
               <td width="90" style="vertical-align:top" align="center"><?php echo $dataperjal->km_lokasi ?></td>
               <td width="200" style="vertical-align:top"><?php echo $dataperjal->jenis ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->letak ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->status ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lang ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lat ?></td>
               <td width="500" style="vertical-align:top; padding:10px" height="200" align="center">
                  <?php if ($dataperjal->img_delinator != '') { ?>
                     <img src="<?php echo base_url('assets/upload/delinator/thumbs/') . $dataperjal->img_delinator ?>" width="15%">
                  <?php } else {
                     echo '-';
                  } ?>
               </td>
            </tr>
         <?php $i++;
         endforeach;
      } else if ($jenisperjal == 'flash') {
         foreach ($dataperjal as $dataperjal) : ?>
            <tr>
               <td width="40" align="center" style="vertical-align:top"><?php echo $i ?></td>
               <td width="90" style="vertical-align:top"><?php echo $dataperjal->kd_flash ?></td>
               <td width="90" style="vertical-align:top" align="center"><?php echo $dataperjal->km_lokasi ?></td>
               <td width="200" style="vertical-align:top"><?php echo $dataperjal->jenis ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->letak ?></td>
               <td width="100" style="vertical-align:top"><?php echo $dataperjal->status ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lang ?></td>
               <td width="150" style="vertical-align:top" class="text-excel"><?php echo $dataperjal->lat ?></td>
               <td width="500" style="vertical-align:top; padding:10px" height="200" align="center">
                  <?php if ($dataperjal->img_flash != '') { ?>
                     <img src="<?php echo base_url('assets/upload/flash/thumbs/') . $dataperjal->img_flash ?>" width="15%">
                  <?php } else {
                     echo '-';
                  } ?>
               </td>
            </tr>
      <?php $i++;
         endforeach;
      } ?>
   </tbody>
</table>