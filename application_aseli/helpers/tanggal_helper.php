<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('tgl_sekarang')){
   function tgl_sekarang(){
      date_default_timezone_set("Asia/Jakarta");
      $tgl_sekarang = date('Y-m-d H:i:s');
      return $tgl_sekarang;
   }
}

if ( ! function_exists('hari_ini')){
   function hari_ini(){
      date_default_timezone_set('Asia/Jakarta');
      $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
      $hari = date("w");
      $hari_ini = $seminggu[$hari];
      return $hari_ini;
   }
}

if ( ! function_exists('angka')){
   function angka($nominal){
      $jadi=number_format($nominal,0,',','.');
      return $jadi;
   }
}

if ( ! function_exists('tgl_indo')){
   function tgl_indo($tgl){
      date_default_timezone_set('Asia/Jakarta');
      $date    = date('Y-m-d', strtotime($tgl));
      $pecah   = explode("-",$date);
      $tanggal = $pecah[2];
      $bulan   = bulan($pecah[1]);
      $tahun   = $pecah[0];
      return $tanggal.' '.$bulan.' '.$tahun;
   }
}

if ( ! function_exists('balai')){
   function balai($balai){
      $pecah   = explode(" ",$balai);
      $space1  = $pecah[0];
      $space2  = $pecah[1];
      $space3  = $pecah[2];
      $space4  = $pecah[3];
      return $space1.' '.$space3.' '.$space4;
   }
}

if ( ! function_exists('jam_indo'))
{
   function jam_indo($tgl)
   {
      $jam     = date('H:i:s', strtotime($tgl));
      return $jam;
   }
}

if ( ! function_exists('hanya_tanggal'))
{
   function hanya_tanggal($tgl)
   {
      date_default_timezone_set('Asia/Jakarta');
      $date    = date('Y-m-d', strtotime($tgl));
      $pecah   = explode("-",$date);
      $tanggal = $pecah[2];
      return $tanggal;
   }
}

if ( ! function_exists('hanya_bulan'))
{
   function hanya_bulan($tgl)
   {
      date_default_timezone_set('Asia/Jakarta');
      $date    = date('Y-m-d', strtotime($tgl));
      $pecah   = explode("-",$date);
      $bulan   = bulan($pecah[1]);
      return $bulan;
   }
}

if ( ! function_exists('bulan_singkat'))
{
   function bulan_singkat($bln)
   {
      switch ($bln)
      {
         case 1:
            return "Jan";
            break;
         case 2:
            return "Feb";
            break;
         case 3:
            return "Mar";
            break;
         case 4:
            return "Apr";
            break;
         case 5:
            return "Mei";
            break;
         case 6:
            return "Jun";
            break;
         case 7:
            return "Jul";
            break;
         case 8:
            return "Agus";
            break;
         case 9:
            return "Sep";
           break;
         case 10:
            return "Okt";
            break;
         case 11:
            return "Nop";
            break;
         case 12:
            return "Des";
            break;
      }
   }
}

if ( ! function_exists('bulan'))
{
   function bulan($bln)
   {
      switch ($bln)
      {
         case 1:
            return "Januari";
            break;
         case 2:
            return "Februari";
            break;
         case 3:
            return "Maret";
            break;
         case 4:
            return "April";
            break;
         case 5:
            return "Mei";
            break;
         case 6:
            return "Juni";
            break;
         case 7:
            return "Juli";
            break;
         case 8:
            return "Agustus";
            break;
         case 9:
            return "September";
            break;
         case 10:
            return "Oktober";
            break;
         case 11:
            return "Nopember";
            break;
         case 12:
            return "Desember";
            break;
      }
   }
}

if ( ! function_exists('nama_hari'))
{
    function nama_hari($tanggal)
    {
        $ubah = gmdate($tanggal, time()+60*60*8);
        $pecah = explode("-",$ubah);
        $tgl = $pecah[2];
        $bln = $pecah[1];
        $thn = $pecah[0];

        $nama = date("l", mktime(0,0,0,$bln,$tgl,$thn));
        $nama_hari = "";
        if($nama=="Sunday") {$nama_hari="Minggu";}
        else if($nama=="Monday") {$nama_hari="Senin";}
        else if($nama=="Tuesday") {$nama_hari="Selasa";}
        else if($nama=="Wednesday") {$nama_hari="Rabu";}
        else if($nama=="Thursday") {$nama_hari="Kamis";}
        else if($nama=="Friday") {$nama_hari="Jumat";}
        else if($nama=="Saturday") {$nama_hari="Sabtu";}
        return $nama_hari;
    }
}

if ( ! function_exists('hitung_mundur'))
{
    function hitung_mundur($wkt)
    {
        $waktu=array(   365*24*60*60    => "tahun",
                        30*24*60*60     => "bulan",
                        7*24*60*60      => "minggu",
                        24*60*60        => "hari",
                        60*60           => "jam",
                        60              => "menit",
                        1               => "detik");

        $hitung = strtotime(gmdate ("Y-m-d H:i:s", time () +60 * 60 * 8))-$wkt;
        $hasil = array();
        if($hitung<5)
        {
            $hasil = 'kurang dari 5 detik yang lalu';
        }
        else
        {
            $stop = 0;
            foreach($waktu as $periode => $satuan)
            {
                if($stop>=6 || ($stop>0 && $periode<60)) break;
                $bagi = floor($hitung/$periode);
                if($bagi > 0)
                {
                    $hasil[] = $bagi.' '.$satuan;
                    $hitung -= $bagi*$periode;
                    $stop++;
                }
                else if($stop>0) $stop++;
            }
            $hasil=implode(' ',$hasil).' yang lalu';
        }
        return $hasil;
    }
}

if (! function_exists('fn_titik')){
   function fn_titik($titik){
      $angka = number_format($titik,0,".",".");
      return $angka;
   }
}

if ( ! function_exists('ubahbalai')){
   function ubahbalai($nmbalai){
      $pecah   = explode(" ",$nmbalai);
      $nama1   = $pecah[0];
      $nama2   = $pecah[3];
      return $nama1.' '.$nama2;
   }
}