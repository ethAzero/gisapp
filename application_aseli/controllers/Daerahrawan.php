<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Daerahrawan extends CI_Controller {



	public function __construct(){

		parent::__construct();

		$this->load->model('home_model');

	}



	public function index(){
		$list = $this->home_model->daerahrawan();
		$data = array('title' 		=> 'Daerah Rawan - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'		=> $list,
							'isi' 		=> 'front/daerahrawan');
		$this->load->view('front/layout/wrapper',$data);

	}

}