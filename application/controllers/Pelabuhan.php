<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelabuhan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$list = $this->home_model->pelabuhan();
		$data = array('title' 	=> 'Pelabuhan - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/pelabuhan');
		$this->load->view('front/layout/wrapper',$data);
	}
}