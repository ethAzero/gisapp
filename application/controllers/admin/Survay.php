<?php

use PhpOffice\PhpSpreadsheet\Worksheet\Row;

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
		$this->load->model('rambu_model');
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
		$data = array(
			'title' 	=> 'Survei Apill',
		);
		$this->load->view('admin/survay/apill', $data);
	}

	public function cermin()
	{
		$data = array(
			'title' 	=> 'Survei Cermin',
		);
		$this->load->view('admin/survay/cermin', $data);
	}

	public function delinator()
	{
		$data = array(
			'title' 	=> 'Survei Delinator',
		);
		$this->load->view('admin/survay/delinator', $data);
	}

	public function flash()
	{
		$data = array(
			'title' 	=> 'Survei Warning Light / Flash',
		);
		$this->load->view('admin/survay/flash', $data);
	}

	public function guardrail()
	{
		$data = array(
			'title' 	=> 'Survei Guardrail',
		);
		$this->load->view('admin/survay/guardrail', $data);
	}

	public function marka()
	{
		$data = array(
			'title' 	=> 'Survei Marka',
		);
		$this->load->view('admin/survay/marka', $data);
	}

	public function pju()
	{
		$data = array(
			'title' 	=> 'Survei PJU',
		);
		$this->load->view('admin/survay/pju', $data);
	}

	public function rambu()
	{
		$klasifikasi = $this->rambu_model->detailKlasifikasi();
		$tipe = $this->survay_model->tipeRambu('JR01');
		$data = array(
			'title' 	=> 'Survei Rambu',
			'klasifikasi' 	=> $klasifikasi,
			'tipe' 	=> $tipe,
		);
		$this->load->view('admin/survay/rambu', $data);
	}

	public function rppj()
	{
		$data = array(
			'title' 	=> 'Survei RPPJ',
		);
		$this->load->view('admin/survay/rppj', $data);
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
			} else if ($jenisperjal == 'cermin') {
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
			} else if ($jenisperjal == 'delinator') {
				$perjal = $this->survay_model->getDelinator($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'kd_delinator' => $perjal->kd_delinator,
						'kd_jalan' => $perjal->kd_jalan,
						'nm_ruas' => $perjal->nm_ruas,
						'km_lokasi' => $perjal->km_lokasi,
						'jenis' => $perjal->jenis,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'image' => $perjal->img_delinator
					);
				}
			} else if ($jenisperjal == 'flash') {
				$perjal = $this->survay_model->getFlash($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'kd_flash' => $perjal->kd_flash,
						'kd_jalan' => $perjal->kd_jalan,
						'nm_ruas' => $perjal->nm_ruas,
						'km_lokasi' => $perjal->km_lokasi,
						'jenis' => $perjal->jenis,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'image' => $perjal->img_flash
					);
				}
			} else if ($jenisperjal == 'guardrail') {
				$perjal = $this->survay_model->getGuardrail($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'kd_guardrail' => $perjal->kd_guardrail,
						'kd_jalan' => $perjal->kd_jalan,
						'nm_ruas' => $perjal->nm_ruas,
						'panjang' => $perjal->panjang,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'image' => $perjal->img_guardrail
					);
				}
			} else if ($jenisperjal == 'marka') {
				$perjal = $this->survay_model->getMarka($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'kd_marka' => $perjal->kd_marka,
						'kd_jalan' => $perjal->kd_jalan,
						'nm_ruas' => $perjal->nm_ruas,
						'panjang' => $perjal->panjang,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'image' => $perjal->img_marka
					);
				}
			} else if ($jenisperjal == 'pju') {
				$perjal = $this->survay_model->getPju($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'kd_pju' => $perjal->kd_pju,
						'kd_jalan' => $perjal->kd_jalan,
						'km_lokasi' => $perjal->km_lokasi,
						'jenis' => $perjal->jenis,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'nm_ruas' => $perjal->nm_ruas,
						'image' => $perjal->img_pju
					);
				}
			} else if ($jenisperjal == 'rppj') {
				$perjal = $this->survay_model->getRppj($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'kd_rppj' => $perjal->kd_rppj,
						'kd_jalan' => $perjal->kd_jalan,
						'km_lokasi' => $perjal->km_lokasi,
						'jenis' => $perjal->jenis,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'letak' => $perjal->letak,
						'status' => $perjal->status,
						'nm_ruas' => $perjal->nm_ruas,
						'image' => $perjal->img_rppj
					);
				}
			} else if ($jenisperjal == 'rambu') {
				$perjal = $this->survay_model->getRambu($row->kd_jalan);
				foreach ($perjal as $perjal) {
					$dataperjal[] = array(
						'kd_jalan' => $perjal->kd_jalan,
						'nm_ruas' => $perjal->nm_ruas,
						'kd_rambu' => $perjal->kd_rambu,
						'tipe_rambu' => $perjal->desk_tipe,
						'img_tipe' => $perjal->img_tipe,
						'jenis' => $perjal->jenis,
						'tipe' => $perjal->tipe,
						'thn_pengadaan' => $perjal->thn_pengadaan,
						'status' => $perjal->status,
						'lat' => $perjal->lat,
						'lng' => $perjal->lang,
						'image' => $perjal->img_rambu,
						'letak' => $perjal->posisi,
						'km_lokasi' => $perjal->km_lokasi,
						'kondisi' => $perjal->kondisi,
					);
				}
			}
		};

		if (!empty($dataperjal)) {
			echo json_encode(array('ruasjalan' => $datajalan, 'perjal' => $dataperjal));
		} else {
			echo json_encode(array('ruasjalan' => $datajalan, 'perjal' => NULL));
		}
		// echo json_encode(array_sum($dataperjal));
	}

	public function tipe()
	{
		$id_jenis = $_GET['klasifikasiVal'];
		$tipe = $this->survay_model->tipeRambu($id_jenis);
		echo json_encode($tipe);
	}
}
