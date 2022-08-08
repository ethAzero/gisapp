<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survay extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('survay_model');
		$this->load->model('jalan_model');
	}

	public function index()
	{

		$data = array(
			'title' 	=> 'Aduan',
			'isi'		=> 'admin/survay/index'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function apill()
	{
		$jalan = $this->survay_model->koordinatjalan();


		$data = array(
			'title' 	=> 'Apill',
			'isi'		=> 'admin/survay/apill',
		);
		$this->load->view('admin/survay/apill', $data);
		// echo json_encode($jalan);
	}

	public function jalan()
	{
		$jalan = $this->survay_model->koordinatjalan();

		$data = array(
			'title' 	=> 'Apill',
			'isi'		=> 'admin/survay/apill',
		);

		foreach ($jalan as $row) {
			// $lintasan[] = [preg_split('~,(?=\d+\.)~', $row->lintasan)];
			$datajalan[] = array(
				'kdjalan' =>  $row->kd_jalan,
				'nmruas' =>  $row->nm_ruas,
				'lintasan' => preg_replace('/\s+/', '|', $row->lintasan),
			);
		};
		echo json_encode($datajalan);
	}
}
