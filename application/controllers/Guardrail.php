<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardrail extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$view = $this->home_model->guardrail();
		$count = $this->home_model->rekapguardrail();
		$data = array('title' 		=> 'Guardrail - Dinas Perhubungan Provinsi Jawa Tengah',
							'view'		=> $view,
							'count'		=> $count,
							'isi' 		=> 'front/guardrail');
		$this->load->view('front/layout/wrapper',$data);
	}
}