<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<style type="text/css">
   .cetak-title1{
      font-size: 15px;
      text-align: center;
   }
   .cetak-title2{
      font-size: 18px;
      text-align: center;
      font-weight: bold;
      text-transform: uppercase;
   }
   .cetak-title3{
      font-size: 10px;
      text-align: center;
   }
   .header{
      margin-bottom: 20px;
   }
   .text-excel{
     mso-number-format:"\@";/*force text*/
   }
</style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=progresspju.xls");
header("Pragma: no-cache");
header("Content-Transfer-Encoding: BINARY");
header("Expires: 0");
?>
<div class="header">
<div class="cetak-title2">PROGRESS PJU</div>
<div class="cetak-title2">DINAS PERHUBUNGAN PROVINSI JAWA TENGAH</div>
<div class="cetak-title2"><?php echo $balai->nm_balai ?></div>
</div>

<table border="1" width="100%">
   <tbody>
      <tr style="font-weight:bold;">
         <td style="vertical-align:middle" width="40" height="40" align="center">No</td>
         <td style="vertical-align:middle" height="40" align="center">Nama Ruas Jalan</td>
         <td style="vertical-align:middle" height="40" align="center">Panjang Ruas</td>
         <td style="vertical-align:middle" height="40" align="center">Terpasang</td>
         <td style="vertical-align:middle" height="40" align="center">Kebutuhan</td>
         <td style="vertical-align:middle" height="40" align="center">Rusak</td>
      </tr>
      <?php 
         $i=1;
         foreach ($ruas as $key => $ruas): ?>
         <tr>
            <td width="40" align="center"><?php echo $i ?></td>
            <td width="450" align="left"><?php echo $ruas->nm_ruas ?></td>
            <td width="100" align="right"><?php echo angka($ruas->jln_panjang);?> m</td>
            <?php $jml = $this->dashboard_model->rekappju($ruas->kd_jalan); ?>
            <?php foreach ($jml as $key => $jml): ?>
            <td align="center" width="90"><?php echo $jml->terpasang ?></td>
            <td align="center" width="90"><?php echo $jml->kebutuhan ?></td>
            <td align="center" width="90"><?php echo $jml->rusak ?></td>
            <?php endforeach ?>
         </tr>   
      <?php $i++; endforeach ?>
   </tbody>
</table>