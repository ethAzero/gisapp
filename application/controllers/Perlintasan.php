<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perlintasan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$list = $this->home_model->perlintasan();
		$data = array('title' 	=> 'Perlintasan Kereta Api - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/perlintasan');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function sebidang(){
		$list = $this->home_model->perlintasan_sebidang();
		$data = array('title' 	=> 'Perlintasan Kereta Api Sebidang - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/perlintasan_sebidang');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function tidaksebidang(){
		$list = $this->home_model->perlintasan_tidak_sebidang();
		$data = array('title' 	=> 'Perlintasan Kereta Api Tidak Sebidang - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/perlintasan_tidak_sebidang');
		$this->load->view('front/layout/wrapper',$data);
	}
}