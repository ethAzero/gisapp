<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atcs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$list = $this->home_model->atcs();
		$data = array('title' 		=> 'ATCS - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'		=> $list,
							'isi' 		=> 'front/atcs');
		$this->load->view('front/layout/wrapper',$data);
	}
}