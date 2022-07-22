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
		$jmlAduanByChannel = $this->dashboard_model->jmlAduanByChannel();
		// print_r($list);exit();
		$data = array(
			'title' 		=> 'Dashboard',
			'list'		=> $list,
			'jmlAduanByChannel' => $jmlAduanByChannel,
			'isi' 		=> 'admin/dashboard/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
		// echo json_encode($jmlAduanByChannel);
	}

	// bagian aduan
	public function get_aduanUnread()
	{
		// $id_balai = $this->session->userdata('hakakses');
		$jumlah_aduan_unread = $this->dashboard_model->get_aduanUnread();
		$aduanbybalai = $this->dashboard_model->get_aduanByBalai();
		$aduan = array(
			'unread' => $jumlah_aduan_unread,
			'notif' => $aduanbybalai
		);
		echo json_encode($aduan);
	}
	public function get_aduanTanggap()
	{
		$jumlah_tanggap_unread = $this->dashboard_model->get_sumtanggapinfo();
		$listtanggap = $this->dashboard_model->get_tanggapunread();
		$aduan = array(
			'unread' => $jumlah_tanggap_unread,
			'notif' => $listtanggap
		);
		echo json_encode($aduan);
	}
}
