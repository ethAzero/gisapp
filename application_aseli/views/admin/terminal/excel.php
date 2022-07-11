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

header("Content-Disposition: attachment; filename=TerminalTipeB.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<div class="header">

<div class="cetak-title2">TERMINAL TIPE B PROVINSI JAWA TENGAH</div>

<div class="cetak-title2">DINAS PERHUBUNGAN PROVINSI JAWA TENGAH</div>

</div>



<table border="1" width="100%">

   <tbody>

      <?php foreach ($balai as $key => $balai): ?>

      <tr style="font-weight:bold;">

         <td style="vertical-align:middle" width="40" height="30" align="center"><?php echo $balai->kd_balai ?></td>

         <td style="vertical-align:middle" colspan="3"><?php echo $balai->nm_balai ?></td>

      </tr>

      <?php 

         $terminal = $this->terminal_model->terminal($balai->kd_balai);

         $i=1;

         foreach ($terminal as $key => $k): ?>

         <tr><td></td>

            <td width="40" align="center"><?php echo $i ?></td>

            <td width="300"><?php echo $k->nm_terminal ?></td>

            <td width="200"><?php echo $k->nm_kabkota ?></td>

         </tr>   

      <?php $i++; endforeach ?>

      <?php endforeach ?>

   </tbody>

</table>