<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index(){		
		$cermin = $this->home_model->cermin();
		$data = array('title' 		=> 'Sistem Informasi Geografis - Dinas Perhubungan Provinsi Jawa Tengah',
							'cermin'		=> $cermin,
							'isi' 		=> 'front/home');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function cermin(){		
		$cermin = $this->home_model->cermin();
		$data = array('title' 		=> 'Fasilitas Cermin - GIS DINHUB',
							'cermin'		=> $cermin,
							'isi' 		=> 'front/cermin');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function flash(){		
		$flash = $this->home_model->flash();
		$data = array('title' 		=> 'Fasilitas Flash - GIS DINHUB',
							'flash'		=> $flash,
							'isi' 		=> 'front/flash');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function jalan(){
		$data = array('title' 		=> 'Jalan Provinsi',
							'isi' 		=> 'front/jalan');
		$this->load->view('front/layout/wrapper',$data);
	}
	public function jalankml(){
		$jalan = $this->jalan_model->koordinatjalan();
		$data = array('title' 		=> 'Jalan Provinsi',
							'jalan'		=> $jalan);
		$this->load->view('front/jalankml',$data);
	}
}