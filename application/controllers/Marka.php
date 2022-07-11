<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marka extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$view = $this->home_model->marka();
		$count = $this->home_model->rekapmarka();
		$data = array('title' 		=> 'Marka - Dinas Perhubungan Provinsi Jawa Tengah',
							'view'		=> $view,
							'count'		=> $count,
							'isi' 		=> 'front/marka');
		$this->load->view('front/layout/wrapper',$data);
	}
}