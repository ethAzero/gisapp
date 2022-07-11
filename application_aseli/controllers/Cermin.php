<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cermin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){
		$cermin = $this->home_model->cermin();
		$count = $this->home_model->rekapcermin();
		$data = array('title' 		=> 'Fasilitas Cermin - Dinas Perhubungan Provinsi Jawa Tengah',
							'cermin'		=> $cermin,
							'count'		=> $count,
							'isi' 		=> 'front/cermin');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function detail($id){
		$cermin = $this->home_model->cermindetail($id);
		if($cermin == true){
			$data = array('title' 		=> 'Fasilitas Cermin - GIS DINHUB',
								'cermin'		=> $cermin,
								'isi' 		=> 'front/cermindetail');
			$this->load->view('front/layout/wrapper',$data);	
		}else{
			$data = array('title' 		=> 'Data Tidak Ditemukan',
								'isi' 		=> 'front/404');
			$this->load->view('front/layout/wrapper',$data);	
		}
	}
}