<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <?php 
    $today = date("d-m-Y");
    ?>
    <title>Laporan_<?php echo $nama;?>_<?php echo $today;?></title>
    <style type="text/css">
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  /*width: 21cm;  */
  /*height: 29.7cm; */
  /*margin: 0 auto; */
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.9em;
}

#company {
  /*float: right;*/
  position: relative;
  text-align: right;
  padding-top: -58px;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  background-color: #fff;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  border: 1px solid black;
  text-align: center;
  padding: 0;
  margin: 0;
}

table th {
  border: 1px solid black;
  padding: 6px;
  margin: 0;
  color: #000;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 6px;
  margin: 0;
  text-align: center;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}

.kaki{
  bottom: 0;
  border-top: 1px solid #C1CED9;
  text-align: center;
  color: #5D6975;
  margin-top: 70px;
}

.content{
  padding-top: 35px;
}
.rotate{
 /* transform: 

     45 is really 360 - 45 
    rotate(-90deg);*/
  margin: 0px;
  text-transform: uppercase;;
}
    </style>
  </head>
  <body>
    <table class="table table-bordered">
          <thead>
            <tr>
               <th colspan="10" style="text-align: center;border: 0;">
                  <div style="text-transform: uppercase; font-weight: bold;font-size: 23px;" class="">INVENTARISASI SARPRAS <?php echo $nama ?></div>
                  <div style="font-size: 14px;">RUAS JALAN <?php echo $jalan->nm_ruas ?></div>
                  <div style="margin-bottom: 20px;font-style: italic;"><?php echo angka($jalan->jln_panjang); ?> m</div>
               </th>
            </tr>
            <tr>
              <th rowspan="2">No</th>
              <th rowspan="2">Kode Flash</th>
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
          foreach ($flash as $row) {
          $image = ($row->img_flash) ? '<img src="assets/upload/flash/'.$row->img_flash.'" width="80" >': '' ;

          if($row->lat){
          ?>  
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $row->kd_flash;?></td>
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
  </body>
</html>