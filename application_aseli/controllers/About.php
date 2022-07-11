<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$meta 	= $this->home_model->meta();
		$nav		= $this->home_model->navcluster();
		$i = $this->input;
		$data = array('title' 		=> $meta->nm_website,
							'nav'			=> $nav,
							'meta'		=> $meta,
							'isi' 		=> 'front/about');
		$this->load->view('front/layout/wrapper',$data);
	}
}