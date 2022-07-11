<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 600);
ini_set('memory_limit', '10240M');

class Rambu extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$rambu = $this->home_model->rambu();
		$count = $this->home_model->rekaprambu();
		$data = array('title' 	=> 'Perlengkapan Jalan - Dinas Perhubungan Provinsi Jawa Tengah',
							'rambu'	=> $rambu,
							'count'	=> $count,
							'isi' 	=> 'front/rambu');
		$this->load->view('front/layout/wrapper',$data);
	}
}