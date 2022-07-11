<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelter extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$list = $this->home_model->shelter();
		$count = $this->home_model->rekapshelter();
		$data = array('title' 	=> 'Shelter BRT Trans Jateng - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'count'	=> $count,
							'isi' 	=> 'front/shelter');
		$this->load->view('front/layout/wrapper',$data);
	}
}