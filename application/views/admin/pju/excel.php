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
   .text-excel{
     mso-number-format:"\@";/*force text*/
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
<div class="cetak-title2">RUAS JALAN <?php echo $jalan->nm_ruas ?></div>
</div>

<table border="1" width="100%">
   <tbody>
      <tr style="font-weight:bold;">
         <td style="vertical-align:middle" width="40" height="40" align="center">No</td>
         <td style="vertical-align:middle" height="40" align="center">Kode PJU</td>
         <td style="vertical-align:middle" height="40" align="center">No Ruas</td>
         <td style="vertical-align:middle" height="40" align="center">Jenis</td>
         <td style="vertical-align:middle" height="40" align="center">Tahun Pemasangan</td>
         <td style="vertical-align:middle" height="40" align="center">Letak</td>
         <td style="vertical-align:middle" height="40" align="center">Status</td>
         <td style="vertical-align:middle" height="40" align="center">Latitude</td>
         <td style="vertical-align:middle" height="40" align="center">Langitude</td>
         
      </tr>
      <?php 
         $i=1;
         foreach ($pju as $key => $d): ?>
         <tr>
            <td width="40" align="center"><?php echo $i ?></td>
            <td width="90" align="left"><?php echo $d->kd_pju ?></td>
            <td width="80" align="center"><?php echo $d->no_ruas ?></td>
            <td width="100"><?php echo $d->jenis ?></td>
            <?php if($d->status =='Terpasang'){?>
            <td width="120"><?php echo $d->thn_pengadaan; ?></td>
            <?php }else{?>
            <td width="120"></td>
            <?php }?>
            <td width="70"><?php echo $d->letak ?></td>
            <td width="100"><?php echo $d->status ?></td>
            <td class="text-excel" width="100"><?php echo $d->lat ?></td>
            <td class="text-excel" width="100"><?php echo $d->lang ?></td>

         </tr>   
      <?php $i++; endforeach ?>
   </tbody>
</table>