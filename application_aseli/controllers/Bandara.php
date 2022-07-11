<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bandara extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$list = $this->home_model->bandara();
		$data = array('title' 	=> 'Bandara - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/bandara');
		$this->load->view('front/layout/wrapper',$data);
	}
}