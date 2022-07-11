<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Delinator extends CI_Controller {



	public function __construct(){

		parent::__construct();

		$this->load->model('home_model');

	}



	public function index(){

		$delinator = $this->home_model->delinator();

		$count = $this->home_model->rekapdelinator();

		$data = array('title' 		=> 'Fasilitas Delinator - Dinas Perhubungan Provinsi Jawa Tengah',

						'delinator'	=> $delinator,

						'count'		=> $count,

						'isi' 		=> 'front/delinator');

		$this->load->view('front/layout/wrapper',$data);

	}



	public function detail($id){

		$delinator = $this->home_model->delinatordetail($id);

		if($delinator == true){

			$data = array('title' 		=> 'Fasilitas Delinator - GIS DINHUB',

							'delinator'		=> $delinator,

							'isi' 		=> 'front/delinatordetail');

			$this->load->view('front/layout/wrapper',$data);	

		}else{

			$data = array('title' 		=> 'Data Tidak Ditemukan',

							'isi' 		=> 'front/404');

			$this->load->view('front/layout/wrapper',$data);	

		}

	}

}