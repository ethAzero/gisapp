<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jalan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('jalan_model');
	}

	public function index(){
		$count = $this->home_model->rekapjalan();
		$data = array('title' 		=> 'Jalan Provinsi',
							'count'		=> $count,
							'isi' 		=> 'front/jalan');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function jalankml(){
		$jalan = $this->jalan_model->koordinatjalan();
		$data = array('title' 		=> 'Jalan Provinsi',
							'jalan'		=> $jalan);
		$this->load->view('front/jalankml',$data);
	}
}