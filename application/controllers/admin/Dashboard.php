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
	// notifikasi aduan baru yang belum dibaca oleh balai
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

	// notifikasi tanggapan aduan baru belum dibaca oleh superadmin, admin dan admin aduan
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

	//mengambil data aduan perbulan untuk ditampilkan pada chart
	public function get_MonthlyChart()
	{
		$aduanbulanan = $this->dashboard_model->get_aduanBulanan();
		foreach ($aduanbulanan as $row) {
			$bulan[] = $row->Bulan;
			$jml_aduan[] = $row->jml_aduan;
			$jml_ditanggapi[] = $row->jml_ditanggapi;
			$jml_ditangani[] = $row->jml_ditangani;
		};

		$data = [
			'labels' => $bulan,
			'datasets' => [
				[
					'label' => 'Jumlah Aduan ',
					'backgroundColor' => 'red',
					'borderColor' => 'red',
					'data' => $jml_aduan,
					'tension' => 0.4
				],
				[
					'label' => 'Jumlah Ditanggapi ',
					'backgroundColor' => 'yellow',
					'borderColor' => 'yellow',
					'data' => $jml_ditanggapi,
					'tension' => 0.4
				],
				[
					'label' => 'Jumlah Ditangani ',
					'backgroundColor' => 'green',
					'borderColor' => 'green',
					'data' => $jml_ditangani,
					'tension' => 0.4
				]
			]
		];
		echo json_encode($data);
	}

	public function get_YearlyChart()
	{
		$aduantahunan = $this->dashboard_model->get_aduanTahunan();
		foreach ($aduantahunan as $row) {
			$tahun[] = $row->Tahun;
			$jml_aduan[] = $row->jml_aduan;
			$jml_ditanggapi[] = $row->jml_ditanggapi;
			$jml_ditangani[] = $row->jml_ditangani;
		};

		$data = [
			'labels' => $tahun,
			'datasets' => [
				[
					'label' => 'Jumlah Aduan ',
					'backgroundColor' => 'red',
					'borderColor' => 'red',
					'data' => $jml_aduan
				],
				[
					'label' => 'Jumlah Ditanggapi ',
					'backgroundColor' => 'yellow',
					'borderColor' => 'yellow',
					'data' => $jml_ditanggapi
				],
				[
					'label' => 'Jumlah Ditangani ',
					'backgroundColor' => 'green',
					'borderColor' => 'green',
					'data' => $jml_ditangani
				]
			]
		];
		echo json_encode($data);
	}
}
