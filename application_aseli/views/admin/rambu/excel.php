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
   }
   .cetak-title3{
      font-size: 10px;
      text-align: center;
   }
   .header{
      margin-bottom: 20px;
   }
</style>
<?php
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Rambu.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div class="header">
<div class="cetak-title2">INVENTARISASI RAMBU</div>
<div class="cetak-title2">DINAS PERHUBUNGAN PROVINSI JAWA TENGAH</div>
</div>

<table border="1" width="100%">
   <tbody>
      <?php foreach ($balai as $key => $balai): ?>
      <tr style="font-weight:bold;">
         <td style="vertical-align:middle" width="40" height="30" align="center"><?php echo $balai->kd_balai ?></td>
         <td style="vertical-align:middle" colspan="3"><?php echo $balai->nm_balai ?></td>
      </tr>
      <tr><td></td>
         <td width="100" align="center">Baik</td>
         <td width="100" align="center">Rusak</td>
         <td width="100" align="center">Kebutuhan</td>
      </tr>
      <?php $status = $this->rambu_model->statusrambu($balai->kd_balai);?>
         <tr><td></td>
            <td width="100" align="center"><?php echo $status->terpasang ?></td>
            <td width="100" align="center"><?php echo $status->rusak ?></td>
            <td width="100" align="center"><?php echo $status->kebutuhan ?></td>
         </tr>   
      <?php endforeach ?>
   </tbody>
</table>