<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Daerahrawan extends CI_Controller {



	public function __construct(){

		parent::__construct();

		$this->load->model('home_model');

	}



	public function index(){
		// print_r('tes');exit();
		$list = $this->home_model->daerahrawan();
		// print_r($list);exit();
		$data = array('title' 		=> 'Daerah Rawan - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'		=> $list,
							'isi' 		=> 'front/daerahrawan');
		$this->load->view('front/layout/wrapper',$data);

	}

}