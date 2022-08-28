<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survay extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('survay_model');
		$this->load->model('jalan_model');
		$this->load->model('apil_model');
		$this->load->model('dashboard_model');
		$this->load->model('home_model');
	}

	public function index()
	{
		$data = array(
			'title' 	=> 'Aduan',
			'isi'		=> 'admin/survay/index'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	// public function apill()
	// {
	// 	$jalan = $this->survay_model->koordinatjalan();

	// 	$data = array(
	// 		'title' 	=> 'Survay Apill',
	// 	);
	// 	$this->load->view('admin/survay/apill', $data);
	// 	// echo json_encode($jalan);
	// }

	public function apill()
	{
		$data = array(
			'title' 	=> 'Survay Apill',
		);
		$this->load->view('admin/survay/apill', $data);
	}

	public function cermin()
	{
		$data = array(
			'title' 	=> 'Survay Cermin',
		);
		$this->load->view('admin/survay/cermin', $data);
	}


	public function jalan()
	{
		$jenisperjal = $_GET['perjal'];
		$jalan = $this->survay_model->koordinatjalan();

		foreach ($jalan as $row) {
			$datajalan[] = array(
				'kdjalan' =>  $row->kd_jalan,
				'nmruas' =>  $row->nm_ruas,
				'lintasan' => preg_replace('/\s+/', '|', $row->lintasan),
			);
			if ($jenisperjal == 'apill') {
				// $perjal[] = array($this->survay_model->getApill($row->kd_jalan));
				$perjal = $this->survay_model->getApill($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'kd_apill' => $perjal->kd_apil,
						'kd_jalan' => $perjal->kd_jalan,
						'km_lokasi' => $perjal->km_lokasi,
						'jenis' => $perjal->jenis,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'nm_ruas' => $perjal->nm_ruas,
						'image' => $perjal->img_apil
					);
				}
			}
			if ($jenisperjal == 'cermin') {
				// $perjal[] = array($this->survay_model->getApill($row->kd_jalan));
				$perjal = $this->survay_model->getCermin($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'kd_cermin' => $perjal->kd_cermin,
						'kd_jalan' => $perjal->kd_jalan,
						'nm_ruas' => $perjal->nm_ruas,
						'km_lokasi' => $perjal->km_lokasi,
						'jenis' => $perjal->jenis,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'image' => $perjal->img_cermin
					);
				}
			}
		};
		echo json_encode(array('ruasjalan' => $datajalan, 'perjal' => $dataperjal));
		// echo json_encode($perjal);
	}
}
