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
		// print_r($list);exit();
		$data = array(
			'title' 		=> 'Dashboard',
			'list'		=> $list,
			'isi' 		=> 'admin/dashboard/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function get_aduanUnread()
	{
		$id_balai = $this->session->userdata('hakakses');
		$jumlah_aduan_unread = $this->dashboard_model->get_aduanUnread($id_balai);
		$aduanbybalai = $this->dashboard_model->get_aduanByBalai($id_balai);
		$aduan = array(
			'unread' => $jumlah_aduan_unread,
			'notif' => $aduanbybalai
		);
		echo json_encode($aduan);
	}
}
