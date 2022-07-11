<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index() {
		$list = $this->dashboard_model->listbalai();
		$data = array('title' 		=> 'Dashboard',
							'list'		=> $list,
							'isi' 		=> 'admin/dashboard/list');
		$this->load->view('admin/layout/wrapper',$data);
	}
}
