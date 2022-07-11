<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stasiun extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$list = $this->home_model->stasiun();
		$data = array('title' 	=> 'Stasiun - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/stasiun');
		$this->load->view('front/layout/wrapper',$data);
	}
}