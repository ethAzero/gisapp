<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$list = $this->home_model->terminal();
		$data = array('title' 	=> 'Terminal - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/terminal');
		$this->load->view('front/layout/wrapper',$data);
	}
}