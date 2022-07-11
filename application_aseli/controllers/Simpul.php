<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Simpul extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$pelabuhan = $this->home_model->pelabuhan();
		$bandara = $this->home_model->bandara();
		$terminal = $this->home_model->terminal();
		$data = array('title' 		=> 'Simpul - Dinas Perhubungan Provinsi Jawa Tengah',
							'pelabuhan'	=> $pelabuhan,
							'bandara'	=> $bandara,
							'terminal'	=> $terminal,
							'isi' 		=> 'front/simpul');
		$this->load->view('front/layout/wrapper',$data);
	}
}