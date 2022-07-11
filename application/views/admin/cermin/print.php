<?php  $today = date("d-m-Y"); ?>
<!DOCTYPE html>
<html moznomarginboxes mozdisallowselectionprint>
<head>
   <title>Laporan_<?php echo $nama;?>_<?php echo $today;?></title>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/css/cetak.css') ?>">
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
            <div class="top-title">INVENTARISASI SARPRAS <?php echo $nama ?></div>
            <div class="no-title1">RUAS JALAN <?php echo $jalan->nm_ruas ?></div>
            <div class="no-title2"><?php echo angka($jalan->jln_panjang); ?> m</div>
         </div>
         <table>
          <thead>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Kode Cermin</th>
              <th colspan="2">Koordinat GPS</th>
              <th rowspan="2">Jenis</th>
              <th rowspan="2">Km</th>
              <th rowspan="2">Thn Pengadaan</th>
              <th rowspan="2">Letak</th>
              <th rowspan="2">Kondisi</th>
              <th rowspan="2">Gambar</th>
            </tr>
            <tr>
              <th>X (Lattitude)</th>
              <th>Y (Longitude)</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          foreach ($cermin as $row) {
          $image = ($row->img_cermin) ? '<img src="../../../assets/upload/cermin/'.$row->img_cermin.'" width="80" >': '' ;
          if($row->lat){
          ?>  
            <tr>
              <td style="text-align: center;"><?php echo $no;?></td>
              <td><?php echo $row->kd_cermin;?></td>
              <td><?php echo $row->lat;?></td>
              <td><?php echo $row->lang;?></td>
              <td><?php echo $row->jenis;?></td>
              <td><?php echo $row->km_lokasi;?></td>
              <td><?php echo $row->thn_pengadaan;?></td>
              <td><?php echo $row->letak;?></td>
              <td><?php echo $row->status;?></td>
              <td><?php echo $image;?></td>
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