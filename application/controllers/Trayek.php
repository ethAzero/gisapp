<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trayek extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('home_model');
		$this->load->model('trayek_model');
	}

	public function index(){
		$list = $this->trayek_model->listing();
		$data = array('title' 	=> 'Trayek - Dinas Perhubungan Provinsi Jawa Tengah',
							'list'	=> $list,
							'isi' 	=> 'front/trayek');
		$this->load->view('front/layout/wrapper',$data);
	}

	public function kml(){
		$filter = $this->input->get('filter');
		$kode = $this->input->get('kode');
		$search = $this->input->get('search');
		$trayek = $this->trayek_model->getTrayek($filter,$kode,$search);
		$data = array('title' 		=> 'kml',
							'view'		=> $trayek);
		$this->load->view('front/trayekkml',$data);
	}

	public function getTrayekData() { 
        $level = $this->input->get('term'); 
        $query = $this->trayek_model->getTrayekData($level); 
        echo json_encode($query);  
    }
}