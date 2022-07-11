<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('memory_limit', '10240M');
class Pju extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$pju = $this->home_model->pju();
		$count = $this->home_model->rekappju();
		$data = array('title' 	=> 'Fasilitas PJU - Dinas Perhubungan Provinsi Jawa Tengah',
							'pju'		=> $pju,
							'count'	=> $count,
							'isi' 	=> 'front/pju');
		$this->load->view('front/layout/wrapper',$data);
	}
}