<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Flash extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$flash = $this->home_model->flash();
		$count = $this->home_model->rekapflash();
		$data = array('title' 		=> 'Fasilitas Flash - Dinas Perhubungan Provinsi Jawa Tengah',
							'flash'		=> $flash,
							'count'		=> $count,
							'isi' 		=> 'front/flash');
		$this->load->view('front/layout/wrapper',$data);
	}
}