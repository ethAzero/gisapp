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
header("Content-Disposition: attachment; filename=Jalan.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<div class="header">
<div class="cetak-title2">JALAN PROVINSI</div>
<div class="cetak-title2">DINAS PERHUBUNGAN PROVINSI JAWA TENGAH</div>
</div>

<table border="1" width="100%">
   <tbody>
      <tr style="font-weight:bold;">
         <td style="vertical-align:middle" width="40" height="40" align="center">No</td>
         <td style="vertical-align:middle" height="40" align="center">Nomor Ruas</td>
         <td style="vertical-align:middle" height="40" align="center">Sub Ruas</td>
         <td style="vertical-align:middle" height="40" align="center">Nama Ruas</td>
         <td style="vertical-align:middle" height="40" align="center">Panjang Ruas</td>
         <td style="vertical-align:middle" height="40" align="center">Balai</td>
         <td style="vertical-align:middle" height="40" align="center">Apil</td>
         <td style="vertical-align:middle" height="40" align="center">Cermin</td>
         <td style="vertical-align:middle" height="40" align="center">Pju</td>
         <td style="vertical-align:middle" height="40" align="center">Flash</td>
         <td style="vertical-align:middle" height="40" align="center">Rambu</td>
         <td style="vertical-align:middle" height="40" align="center">RPPJ</td>
      </tr>
      <?php 
         $i=1;
         foreach ($jalan as $key => $k): ?>
         <tr>
            <td width="40" align="center"><?php echo $i ?></td>
            <td width="50" align="center"><?php echo $k->no_ruas ?></td>
            <td width="50" align="center"><?php echo $k->jln_fungsi ?></td>
            <td width="470"><?php echo $k->nm_ruas ?></td>
            <td width="70"><?php echo angka($k->jln_panjang); ?></td>
            <td width="250"><?php echo $k->nm_balai ?></td>
            <?php if ($k->apil == '1'): ?>
               <td width="70" align="center" style="background-color: #FF9800">&nbsp;</td>   
            <?php else: ?>
               <td width="70" align="center">&nbsp;</td>   
            <?php endif ?>
            <?php if ($k->cermin == '1'): ?>
               <td width="70" align="center" style="background-color: #FF9800">&nbsp;</td>   
            <?php else: ?>
               <td width="70" align="center">&nbsp;</td>   
            <?php endif ?>
            <?php if ($k->pju == '1'): ?>
               <td width="70" align="center" style="background-color: #FF9800">&nbsp;</td>   
            <?php else: ?>
               <td width="70" align="center">&nbsp;</td>   
            <?php endif ?>
            <?php if ($k->flash == '1'): ?>
               <td width="70" align="center" style="background-color: #FF9800">&nbsp;</td>   
            <?php else: ?>
               <td width="70" align="center">&nbsp;</td>   
            <?php endif ?>
            <?php if ($k->rambu == '1'): ?>
               <td width="70" align="center" style="background-color: #FF9800">&nbsp;</td>   
            <?php else: ?>
               <td width="70" align="center">&nbsp;</td>   
            <?php endif ?>
            <?php if ($k->rppj == '1'): ?>
               <td width="70" align="center" style="background-color: #FF9800">&nbsp;</td>   
            <?php else: ?>
               <td width="70" align="center">&nbsp;</td>   
            <?php endif ?>
         </tr>   
      <?php $i++; endforeach ?>
   </tbody>
</table>