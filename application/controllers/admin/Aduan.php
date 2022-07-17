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
		$detail = $this->aduan_model->detail($id);
		$data = array(
			'title' 	=> 'Aduan Detail',
			'detail' => $detail,
			'isi'		=> 'admin/aduan/detail'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function listing()
	{
		$wilayah = $this->aduan_model->listing("mangun");
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
				'id_kelurahan'		=> $i->post('id_desa'),
				'stat_read'	=> 0,
				'stat_tanggap'	=> 0
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

	public function delete($id)
	{
		$data = array('kd_kabkota' => $id);
		$this->aduan_model->delete($data);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		redirect(base_url('admin/kabkota'));
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
}
