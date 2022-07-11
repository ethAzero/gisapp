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
    <header class="clearfix">
     <!--  <h1>Laporan Ruas</h1> -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th colspan="2"><img src="assets/admin/img/profile.png" width="80"></th>
              <th colspan="3">DETAIL TAMPILAN <br/>INVENTARISASI RUAS JALAN PROVINSI</th>
              <th>INVENTARISASI <br/>RUAS JALAN</th>
              <th><img src="assets/admin/img/dinhub.png" width="80"></th>
            </tr>
            <tr>
              <th>No</th>
              <th>Nama Ruas</th>
              <th colspan="3">Geometrik Jalan</th>
              <th colspan="2">Visualisasi</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td rowspan="23">1</td>
              <td rowspan="23"><span class="rotate"><?php echo $nama;?></span></td>
              <td rowspan="2">Km</td>
              <td>Awal</td>
              <td>Akhir</td>
              <td colspan="2" rowspan="12"><img src="assets/admin/img/dinhub.png" width="80"></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Status Jalan</td>
              <td colspan="2">Provinsi</td>
            </tr>
            <tr>
              <td>Fungsi Jalan</td>
              <!-- <td colspan="2">Kolektor</td> -->
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Panjang Lokasi (m)</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Lebar</td>
              <!-- <td colspan="2">6</td> -->
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Jumlah</td>
              <td>Lajur</td>
              <!-- <td>2</td> -->
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td>Jalur</td>
              <!-- <td>2</td> -->
              <td></td>
            </tr>
            <tr>
              <td>Tipe Jalan</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Lebar Efektif Jalan (m)</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Lebar Medan</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Lebar Bahu</td>
              <td>Kiri (m)</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td>Kanan (m)</td>
              <td></td>
              <td colspan="2">Penampang Melintang Jalan</td>
            </tr>
            <tr>
              <td></td>
              <td>Total</td>
              <td></td>
              <td colspan="2" rowspan="10"><img src="assets/admin/img/dinhub.png" width="80"></td>
            </tr>
            <tr>
              <td>Hambatan Samping</td>
              <!-- <td colspan="2">Rendah</td> -->
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Jenis Pekerjaan</td>
              <!-- <td colspan="2">Aspal</td> -->
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Kondisi Jalan</td>
              <!-- <td colspan="2">Baik</td> -->
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Lebar Parkir (m)</td>
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Model Arus (arah)</td>
              <!-- <td colspan="2">2 Arah</td> -->
              <td colspan="2"></td>
            </tr>
            <tr>
              <td>Lebar Trotoar</td>
              <td>Kiri (m)</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td>Kanan (m)</td>
              <td></td>
            </tr>
            <tr>
              <td>Drainase</td>
              <td>Kiri (m)</td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td>Kanan (m)</td>
              <td></td>
            </tr>
          </tbody>
        </table>


        

     
    <!-- </footer> -->

  </body>
  <body>
    <table class="table table-bordered">
          <thead>
            <tr>
              <th colspan="10" style="text-align: center;border: 0;">INVENTARISASI SARPRAS JALAN TERPASANG DAN KEBUTUHAN</th>
            </tr>
            <tr>
              <th colspan="2" style="text-align: left;border: 0;">Ruas Jalan</th>
              <th colspan="8" style="text-align: left;border: 0;">: <?php echo $nama;?></th>
            </tr>
            <tr>
              <th colspan="2" style="text-align: left;border: 0;">Panjang</th>
              <th colspan="8" style="text-align: left;border: 0;">: </th>
            </tr>
            <tr>
              <th colspan="2" style="text-align: left;border: 0;">Kilometer</th>
             <!--  <th colspan="8" style="text-align: left;border: 0;">: Mgl 1,5 s/d Mgl 2,5</th> -->
             <th colspan="8" style="text-align: left;border: 0;">: <?php echo $km;?></th>
            </tr>
            <tr>
              <th rowspan="2">No</th>
              <th colspan="2">Koordinat GPS</th>
              <th rowspan="2">Km</th>
              <th colspan="2">Terpasang</th>
              <th colspan="2">Kebutuhan</th>
              <th rowspan="2">Gambar</th>
              <th rowspan="2">Kondisi</th>
              <th rowspan="2">Keterangan</th>
            </tr>
            <tr>
              <th>X (Lattitude)</th>
              <th>Y (Longitude)</th>
              <th>Kiri</th>
              <th>Kanan</th>
              <th>Kiri</th>
              <th>Kanan</th>
            </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          foreach ($ruas as $row) {
          $image = ($row->img_tipe) ? '<img src="assets/upload/img_rambu/'.$row->img_tipe.'" width="80" >': '' ;

          if($row->lat){
          ?>  
            <tr>
              <td><?php echo $no;?></td>
              <td><?php echo $row->lat;?></td>
              <td><?php echo $row->lang;?></td>
              <td><?php echo $row->km_lokasi;?></td>
              <td><?php if($row->status == 'Terpasang' && $row->posisi == 'Kiri'){ echo "Ada"; }else{ echo "";}?></td>
              <td><?php if($row->status == 'Terpasang' && $row->posisi == 'Kanan'){ echo "Ada"; }else{ echo "";}?></td>
              <td><?php if($row->status == 'Kebutuhan' && $row->posisi == 'Kiri'){ echo "Ada"; }else{ echo "";}?></td>
              <td><?php if($row->status == 'Kebutuhan' && $row->posisi == 'Kanan'){ echo "Ada"; }else{ echo "";}?></td>
              <td><?php echo $image;?></td>
              <td><?php echo $row->kondisi;?></td>
              <td><?php echo $row->keterangan;?></td>
            </tr>
          <?php 
          $no++;
          }else{
          ?>
            <tr>
              <td colspan="11">Data Tidak Tersedia</td>
            </tr>
          <?php 
          }
          };?>
          </tbody>
        </table>
  </body>
</html>