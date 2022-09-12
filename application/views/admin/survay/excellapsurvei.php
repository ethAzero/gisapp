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
</style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=PJU.xls");
header("Pragma: no-cache");
header("Content-Transfer-Encoding: BINARY");
header("Expires: 0");
?>
<div class="header">
   <div class="cetak-title2">PENERANGAN JALAN UMUM</div>
   <div class="cetak-title2">DINAS PERHUBUNGAN PROVINSI JAWA TENGAH</div>
   <div class="cetak-title2">RUAS JALAN <?php echo $ruasjalan->nm_ruas ?></div>
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
      foreach ($dataperjal as $dataperjal) : ?>
         <tr>
            <td width="40" align="center"><?php echo $i ?></td>
            <td width="90" align="left"><?php echo $dataperjal->kd_pju ?></td>
            <td width="90" align="left"><?php echo $dataperjal->kd_jalan ?></td>
            <td width="90" align="left"><?php echo $dataperjal->nm_ruas ?></td>
            <td width="90" align="left"><?php echo $dataperjal->km_lokasi ?></td>
            <td width="90" align="left"><img src="<?php echo base_url('assets/upload/pju/thumbs/') . $dataperjal->img_pju ?>"></td>
         </tr>
      <?php $i++;
      endforeach ?>
   </tbody>
</table>