<?php  $today = date("d-m-Y"); 

?>
<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
   <title>Laporan_<?php echo $today;?></title>
   <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/cetak.css') ?>"> -->
   <link rel="stylesheet" type="text/css" href="../../assets/admin/css/cetak.css">
   <script type="text/javascript">
   function PrintFunction(divName) {
      var printContents = document.getElementById(divName).innerHTML;
      var originalContents = document.body.innerHTML;
      document.body.innerHTML = printContents;
      window.print();
      document.body.innerHTML = originalContents;
      window.close();
   }
   </script>
</head>
<body>
   <div class="tombol-print"><button class="btn btn-primary" onclick="PrintFunction('kertasf4')">Print</button></div>
   <page style="font: arial; font-size: 12pt;">
      <div id="kertasf4">
         <div class="body-content">
            <div class="top-title">REKAPITULASI DAERAH RAWAN </div>
         </div>
        
         <table>
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Nama Daerah Rawan</th>
              <th rowspan="2">Kabupaten / Kota</th>
              <th rowspan="2">Nama Ruas Jalan</th>
              <th colspan="2">Koordinat GPS</th>
              <th rowspan="2">Gambar</th>
              <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
              <th>X (Lattitude)</th>
              <th>Y (Longitude)</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          foreach ($list as $row) {
          
            $image = ($row->img_daerah) ? '<img src="../../../assets/upload/daerahrawan/'.$row->img_daerah.'" width="80" >': '' ;
          
          if($row != ''){
          ?>  
            <tr>
              <td align="center"><?php echo $no ?></td>
              <td><?php echo $row->nm_daerah ?></td>
              <td><?php echo $row->nm_kabkota ?></td>
              <td><?php echo $row->nm_ruas ?></td>
              <td><?php echo $row->lat ?></td>
              <td><?php echo $row->lang ?></td>
              <td><?php echo $image ?></td>
               <td><?php echo $row->ket_daerah ?></td>
            </tr>      
          <?php 
          $no++;
          }else{
          ?>
            <tr>
              <td colspan="10">Data Tidak Tersedia</td>
            </tr>
          <?php 
          }
          };?>

          </tbody>
        </table>
      </div>
   </page>
   </body>
</html>