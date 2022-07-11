<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class SDP extends CI_Controller {



	public function __construct(){

		parent::__construct();

		$this->load->model('home_model');

	}



	public function index(){

		$list = $this->home_model->sdp();

		$data = array('title' 	=> 'Sungai Danau dan Penyebrangan - Dinas Perhubungan Provinsi Jawa Tengah',

							'list'	=> $list,

							'isi' 	=> 'front/sdp');

		$this->load->view('front/layout/wrapper',$data);

	}

}