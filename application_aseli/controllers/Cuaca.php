<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuaca extends CI_Controller {

   public function __construct(){
      parent::__construct();
      $this->load->model('home_model');
   }

   public function index(){
      date_default_timezone_set("Asia/Jakarta");
      $waktu = date('Y-m-d H:i:s');
      $list = $this->home_model->prakiraancuaca($waktu);
      $ket = $this->home_model->keterangancuaca($waktu);
      $data = array('title'   => 'Prakiraan Cuaca Jawa Tengah - Dinas Perhubungan Provinsi Jawa Tengah',
                     'list'   => $list,
                     'ket'    => $ket,
                     'isi'    => 'front/cuaca');
      $this->load->view('front/layout/wrapper',$data);
   }
}