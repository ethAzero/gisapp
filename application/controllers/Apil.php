<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$apil = $this->home_model->apil();
		$count = $this->home_model->rekapapil();
		$data = array('title' 		=> 'Fasilitas Apil - Dinas Perhubungan Provinsi Jawa Tengah',
							'apil'		=> $apil,
							'count'		=> $count,
							'isi' 		=> 'front/apil');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function detail($id){
		$apil = $this->home_model->apildetail($id);
		if($apil == true){
			$data = array('title' 		=> 'Fasilitas Apil - GIS DINHUB',
							'apil'		=> $apil,
							'isi' 		=> 'front/apildetail');
			$this->load->view('front/layout/wrapper',$data);	
		}else{
			$data = array('title' 		=> 'Data Tidak Ditemukan',
							'isi' 		=> 'front/404');
			$this->load->view('front/layout/wrapper',$data);	
		}
	}
}