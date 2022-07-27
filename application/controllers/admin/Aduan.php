<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aduan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('aduan_model');
		$this->load->model('balai_model');
	}

	public function index()
	{
		$list = $this->aduan_model->listing();
		$data = array(
			'title' 	=> 'Aduan',
			'list'	=> $list,
			'isi'		=> 'admin/aduan/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function detail($id)
	{
		$hakakses = $this->session->userdata('hakakses');
		// jika hak akses sebagai balai
		if ($hakakses == '01' || $hakakses == '02' || $hakakses == '03' || $hakakses == '04' || $hakakses == '05' || $hakakses == '06') {
			$chek = $this->aduan_model->detail($id);
			if ($chek->stat_read1 != 1) {
				date_default_timezone_set("Asia/Bangkok");
				$date = new DateTime();
				$a = $date->getTimestamp();
				$b = date('Y-m-d H:i:s', $a);
				$data = array(
					'id_aduan' => $id,
					'stat_read1'	=> 1,
					'read_at' => $b
				);
				$this->aduan_model->edit($data);
			};
		} else if ($this->session->userdata('hakakses') == 'AD') { // jika hak akses sebagai admin aduan
			$chek = $this->aduan_model->detail($id);
			if ($chek->stat_readtanggap != 1) {
				$data = array(
					'id_aduan' => $id,
					'stat_readtanggap'	=> 1
				);
				$this->aduan_model->edit($data);
			};
		} else if ($hakakses == 'S' || $hakakses == 'A') { // jika hak akses sebagai admin dan superadmin
			$chek = $this->aduan_model->detail($id);
			if ($chek->stat_read2 != 1) {
				date_default_timezone_set("Asia/Bangkok");
				$data = array(
					'id_aduan' => $id,
					'stat_read2'	=> 1,
				);
				$this->aduan_model->edit($data);
			};
		}
		$detail = $this->aduan_model->detail($id);
		$data = array(
			'title' 	=> 'Aduan Detail',
			'detail' => $detail,
			'isi'		=> 'admin/aduan/detail'
		);
		$this->load->view('admin/layout/wrapper', $data);
		// echo json_encode($detail->kewenangan);
	}

	public function listing()
	{
		$wilayah = $this->aduan_model->listing();
		echo json_encode($wilayah);
	}

	public function data_wilayah()
	{
		$nama_kelurahan = $_GET['term'];
		$wilayah = $this->aduan_model->getKelurahan($nama_kelurahan);
		echo json_encode($wilayah);
	}

	public function add()
	{
		$aduan = $this->aduan_model->listing();
		$chanel = $this->aduan_model->chanel();
		$valid = $this->form_validation;
		$valid->set_rules(
			'chanel',
			'chanel',
			'required',
			array('required'	=> 'chanel aduan harus dipilih')
		);
		$valid->set_rules(
			'nm_desa',
			'nm_desa',
			'required',
			array('required'	=> 'nama kelurahan harus diisi')
		);
		$valid->set_rules(
			'aduan',
			'aduan',
			'required',
			array('required'	=> 'silahkan untuk  mengisi aduan / laporan')
		);
		if ($valid->run() == FALSE) {
			$data = array(
				'title' 		=> 'Add Aduan',
				'chanel'	=> $chanel,
				'list'		=> $aduan,
				'isi' 		=> 'admin/aduan/add'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i = $this->input;
			$data = array(
				'id_chanel_aduan' => $i->post('chanel'),
				'aduan'		=> $i->post('aduan'),
				'id_kelurahan'	=> $i->post('id_desa'),
				'stat_read1'	=> 0, // status baca oleh balai
				'stat_read2'	=> 0, // status baca oleh admin dan superadmin 
				'stat_tanggap'	=> 0,
				'stat_readtanggap'	=> 0,
				'stat_tangani'	=> 0,
				'kewenangan'	=> 0,
			);
			$this->aduan_model->add($data);
			$this->session->set_flashdata('sukses', 'Berhasil ditambah');
			redirect(base_url('admin/aduan'));
		}
	}

	public function edit($id)
	{
		$detail = $this->aduan_model->detail($id);
		$chanel = $this->aduan_model->chanel();
		$aduan = $this->aduan_model->listing();
		$valid = $this->form_validation;
		$valid->set_rules(
			'chanel',
			'chanel',
			'required',
			array('required'	=> 'chanel aduan harus dipilih')
		);
		$valid->set_rules(
			'nm_desa',
			'nm_desa',
			'required',
			array('required'	=> 'nama kelurahan harus diisi')
		);
		$valid->set_rules(
			'aduan',
			'aduan',
			'required',
			array('required'	=> 'silahkan untuk  mengisi aduan / laporan')
		);
		if ($valid->run() == FALSE) {
			$data = array(
				'title'  => 'Edit Aduan',
				'chanel'	=> $chanel,
				'detail' => $detail,
				'aduan' 	=> $aduan,
				'isi'    => 'admin/aduan/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i = $this->input;
			$data = array(
				'id_aduan' => $i->post('id_aduan'),
				'id_chanel_aduan' => $i->post('chanel'),
				'aduan'		=> $i->post('aduan'),
				'id_kelurahan'		=> $i->post('id_desa'),
				'stat_read'	=> 0
			);
			$this->aduan_model->edit($data);
			$this->session->set_flashdata('sukses', 'Berhasil diubah');
			redirect(base_url('admin/aduan'));
		}
	}

	// public function delete($id)
	// {
	// 	$data = array('kd_kabkota' => $id);
	// 	$this->aduan_model->delete($data);
	// 	$this->session->set_flashdata('sukses', 'Berhasil dihapus');
	// 	redirect(base_url('admin/kabkota'));
	// }

	// untuk event tanggap
	public function addtanggap($id)
	{
		$chek = $this->aduan_model->detail($id);
		if ($chek->stat_read1 != 1) {
			date_default_timezone_set("Asia/Bangkok");
			$date = new DateTime();
			$a = $date->getTimestamp();
			$b = date('Y-m-d H:i:s', $a);
			$data = array(
				'id_aduan' => $id,
				'stat_read1'	=> 1,
				'read_at' => $b
			);
			$this->aduan_model->edit($data);
		};
		$aduanById = $this->aduan_model->detail($id);
		$valid = $this->form_validation;
		$valid->set_rules(
			'kewenangan',
			'kewenangan',
			'required',
			array('required'	=> 'kewenangan harus dipilih')
		);
		$valid->set_rules(
			'id_ruas',
			'id_ruas',
			'required',
			array('required'	=> 'Ruas Jalan harus diisi')
		);
		$valid->set_rules(
			'tanggapan',
			'tanggapan',
			'required',
			array('required'	=> 'Tanggapan harus diisi')
		);
		if ($valid->run() == FALSE) {
			$data = array(
				'title' 		=> 'Add Tanggapan',
				'list'		=> $aduanById,
				'isi' 		=> 'admin/aduan/addtanggap'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i = $this->input;
			date_default_timezone_set("Asia/Bangkok");
			$date = new DateTime();
			$a = $date->getTimestamp();
			$b = date('Y-m-d H:i:s', $a);
			if ($i->post('kewenangan') == 1) {
				$data = array(
					'id_aduan' => $id,
					'kewenangan'	=> $i->post('kewenangan'),
					'tanggapan'		=> $i->post('tanggapan'),
					'stat_tanggap'	=> 1,
					'stat_tangani'	=> 0,
					'tanggap_at' 	=> $b,
					'tangani_at' 	=> null,
					'kd_jalan'	=> $i->post('id_ruas'),
				);
			} else if ($i->post('kewenangan') == 2) {
				$data = array(
					'id_aduan' => $id,
					'kewenangan'	=> $i->post('kewenangan'),
					'tanggapan'		=> $i->post('tanggapan'),
					'stat_tanggap'	=> 1,
					'stat_tangani'	=> 1,
					'tanggap_at' 	=> $b,
					'tangani_at' 	=> $b,
					'kd_jalan'	=> $i->post('id_ruas'),
				);
			}
			$this->aduan_model->addtanggap($data);
			$this->session->set_flashdata('sukses', 'Berhasil ditambah');
			redirect(base_url('admin/aduan'));
		}
	}


	public function exportexcel()
	{
		$balai = $this->balai_model->listing();
		$data = array(
			'title' 	=> 'Data Wilayah Balai Perhubungan',
			'balai' 	=> $balai
		);
		$this->load->view('admin/kabkota/excel', $data);
	}

	public function jalankml()
	{
		$kd_balai = "01";
		$jalan = $this->aduan_model->koordinatjalan($kd_balai);
		$data = array(
			'title' 		=> 'Jalan Provinsi',
			'jalan'		=> $jalan
		);
		$this->load->view('front/jalankml', $data);
	}
}
