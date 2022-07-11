<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelter extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		// $list = $this->home_model->shelter();
		// print_r($list);exit();
		$list 		= $this->home_model->listshelter();
		$all_arah 	= $this->home_model->all_arah_shelter();
		// print_r($all_arah);exit();
		$count 		= $this->home_model->rekapshelter();
		// print_r($count);exit();	
		$data 		= array('title' 	=> 'Shelter BRT Trans Jateng - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'		=> $list,
							'listarah'	=> $all_arah,
							'count'		=> $count,
							'isi' 		=> 'front/shelter');
		$this->load->view('front/layout/wrapper',$data);
	}
}