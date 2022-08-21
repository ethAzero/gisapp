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
		// $this->session->set_flashdata('sukses', 'Berhasil ditambah');
		$urut = $this->apil_model->kodeurut();
		if ($urut->urutan == '') {
			$kodeurut = '00001';
		} else {
			$urut2 = ($urut->urutan) + 1;
			$kodeurut  = sprintf("%05s", $urut2);
		}

		$valid = $this->form_validation;
		$valid->set_rules(
			'korx',
			'korx',
			'required',
			array('required'	=> 'Koordinat X harus diisi')
		);
		$valid->set_rules(
			'kory',
			'kory',
			'required',
			array('required'	=> 'Koordinat Y harus diisi')
		);
		$valid->set_rules(
			'kdjalan',
			'kdjalan',
			'required',
			array('required'	=> 'Ruas Jalan Harus Dipilih! Silahkan Klik Ruas Jalan Pada Peta')
		);
		if ($valid->run() == FALSE) {
			$data = array(
				'title' 	=> 'Survay Apill',
			);
			$this->load->view('admin/survay/apill', $data);
		} else {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 		= './assets/upload/apil/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 	=> 'Add apil',
						'error'	=> $this->upload->display_errors(),
						'isi' 	=> 'admin/apil/add'
					);
					$this->load->view('admin/layout/wrapper', $data);
				} else {
					$upload_data					= array('uploads' => $this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/apil/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/apil/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= TRUE;
					$config['width'] 				= 360;
					$config['height'] 			= 200;
					$config['x_axis'] 			= 0;
					$config['y_axis'] 			= 0;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$i = $this->input;
					$kode = 'AP' . $kodeurut;
					date_default_timezone_set("Asia/Bangkok");
					$tahun = date('Y');
					$data = array(
						'kd_apil'			=> $kode,
						'kd_jalan'			=> $i->post('kdjalan'),
						'thn_pengadaan'		=> $tahun,
						'km_lokasi	'		=> $i->post('kmlokasi'),
						'jenis'				=> $i->post('jenis'),
						'img_apil'			=> $upload_data['uploads']['file_name'],
						'letak'				=> $i->post('letak'),
						'status'			=> $i->post('status'),
						'lat'				=> $i->post('korx'),
						'lang'				=> $i->post('kory')
					);
					$this->apil_model->addapil($data);
					$this->session->set_flashdata('sukses', 'Berhasil ditambah');
					$data = array(
						'title' 	=> 'Survay Apill',
					);
					redirect(base_url('admin/survay/apill', $data));
				}
			} else {
				$i = $this->input;
				$kode = 'AP' . $kodeurut;
				date_default_timezone_set("Asia/Bangkok");
				$tahun = date('Y');
				$data = array(
					'kd_apil'			=> $kode,
					'kd_jalan'			=> $i->post('kdjalan'),
					'thn_pengadaan'		=> $tahun,
					'km_lokasi	'		=> $i->post('kmlokasi'),
					'jenis'				=> $i->post('jenis'),
					'letak'				=> $i->post('letak'),
					'status'			=> $i->post('status'),
					'lat'				=> $i->post('korx'),
					'lang'				=> $i->post('kory')
				);
				$this->apil_model->addapil($data);
				$this->session->set_flashdata('sukses', 'Berhasil ditambah');
				$data = array(
					'title' 	=> 'Survay Apill',
				);
				redirect(base_url('admin/survay/apill', $data));
			}
		}
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
