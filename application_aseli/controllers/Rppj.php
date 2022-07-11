<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rppj extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$rppj = $this->home_model->rppj();
		$count = $this->home_model->rekaprppj();
		$data = array('title' 	=> 'Fasilitas RPPJ - Dinas Perhubungan Provinsi Jawa Tengah',
							'rppj'	=> $rppj,
							'count'	=> $count,
							'isi' 	=> 'front/rppj');
		$this->load->view('front/layout/wrapper',$data);
	}
}