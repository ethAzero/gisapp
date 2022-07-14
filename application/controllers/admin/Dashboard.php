<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function index()
	{

		$list = $this->dashboard_model->listbalai();
		$jumlah_aduan_unread = $this->dashboard_model->get_jml_aduan_unread();
		// print_r($list);exit();
		$data = array(
			'title' 		=> 'Dashboard',
			'aduan_unread' => $jumlah_aduan_unread,
			'list'		=> $list,
			'isi' 		=> 'admin/dashboard/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}
}
