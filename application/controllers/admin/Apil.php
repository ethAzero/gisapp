<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Apil extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('apil_model');
		$this->load->model('jalan_model');
		$this->load->model('dashboard_model');
		$this->load->model('home_model');
	}

	public function jalanprovinsi($jalan)
	{
		$jalan = $this->dashboard_model->jalanprovinsi($jalan);
		$data = array('jalan'		=> $jalan);
		$this->load->view('front/jalankml', $data);
	}

	public function index()
	{
		$hak = $this->session->userdata('hakakses');
		$count = $this->home_model->rekapapil();
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'LL')) {
			$jalan = $this->jalan_model->listing();
		} else {
			$jalan = $this->jalan_model->loginbatas();
		}

		$i 			= $this->input;
		$cari	= $i->post('search');
		if (isset($cari)) {

			$sapil 		= $this->apil_model->apilbykd($cari);

			$kd_jalan	= $sapil[0]->kd_jalan;
			$jln 		= $this->apil_model->jlnprovbykd($kd_jalan);
			$kd_balai	= $jln->kd_balai;

			$ruas 	= $this->dashboard_model->detailruas($kd_balai, $kd_jalan);
			// $view 	= $this->dashboard_model->viewdelinator($jalan);
			$data = array(
				'title' 	=> 'View Apil',
				'ruas'		=> $ruas,
				'view'		=> $sapil,
				'isi' 		=> 'admin/apil/view_search'
			);
			$this->load->view('admin/layout/wrapper', $data);
			// print_r($jln);exit();
		} else {
			$data = array(
				'title' 	=> 'Apill',
				'jalan'	=> $jalan,
				'count'	=> $count,
				'isi'		=> 'admin/apil/list'
			);
			$this->load->view('admin/layout/wrapper', $data);
		}
	}

	public function detail($balai, $jln)
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'LL')) {
			$listjalan = $this->jalan_model->listing();
		} else {
			$listjalan = $this->jalan_model->loginbatas();
		}
		$jalan = $this->jalan_model->detail($jln);
		$list = $this->apil_model->listing($jln);
		$data = array(
			'title' 		=> 'Apill - ' . $jalan->nm_ruas,
			'list'		=> $list,
			'jalan'		=> $jalan,
			'listjalan'	=> $listjalan,
			'isi'			=> 'admin/apil/detail'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}


	public function add($balai, $jln)
	{
		$jalan = $this->jalan_model->detail($jln);
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
		if ($valid->run() == FALSE) {
			$data = array(
				'title' 		=> 'Add Apil',
				'jalan'		=> $jalan,
				'isi' 		=> 'admin/apil/add'
			);
			$this->load->view('admin/layout/wrapper', $data);
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
					$data = array(
						'kd_apil'				=> $kode,
						'kd_jalan'			=> $jln,
						'thn_pengadaan'	=> $i->post('tahun'),
						'km_lokasi	'		=> $i->post('kmlokasi'),
						'jenis'				=> $i->post('jenis'),
						'img_apil'			=> $upload_data['uploads']['file_name'],
						'letak'				=> $i->post('letak'),
						'status'				=> $i->post('status'),
						'lat'					=> $i->post('korx'),
						'lang'				=> $i->post('kory')
					);
					$this->apil_model->addapil($data);
					$this->session->set_flashdata('sukses', 'Berhasil ditambah');
					redirect(base_url('admin/apil/detail/' . $jalan->kd_balai . '/' . $jalan->kd_jalan));
				}
			} else {
				$i = $this->input;
				$kode = 'AP' . $kodeurut;
				$data = array(
					'kd_apil'				=> $kode,
					'kd_jalan'			=> $jln,
					'thn_pengadaan'	=> $i->post('tahun'),
					'km_lokasi	'		=> $i->post('kmlokasi'),
					'jenis'				=> $i->post('jenis'),
					'letak'				=> $i->post('letak'),
					'status'				=> $i->post('status'),
					'lat'					=> $i->post('korx'),
					'lang'				=> $i->post('kory')
				);
				$this->apil_model->addapil($data);
				$this->session->set_flashdata('sukses', 'Berhasil ditambah');
				redirect(base_url('admin/apil/detail/' . $jalan->kd_balai . '/' . $jalan->kd_jalan));
			}
		}
	}

	public function edit($jln, $kd)
	{
		$apil = $this->apil_model->detailapil($jln, $kd);
		$jalan = $this->jalan_model->detail($jln);
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
		if ($valid->run() == FALSE) {
			$data = array(
				'title'  => 'Edit apil',
				'apil' 	=> $apil,
				'jalan' 	=> $jalan,
				'isi'    => 'admin/apil/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 		= './assets/upload/apil/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 	=> 'Edit apil',
						'apil' 	=> $apil,
						'jalan' 	=> $jalan,
						'error'	=> $this->upload->display_errors(),
						'isi'		=> 'admin/apil/edit'
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
					$config['maintain_ratio'] 	= FALSE;
					$config['width'] 				= 350;
					$config['height'] 			= 350;
					$config['x_axis'] 			= 0;
					$config['y_axis'] 			= 0;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					if ($apil->img_apil != "") {
						unlink('./assets/upload/apil/' . $apil->img_apil);
						unlink('./assets/upload/apil/thumbs/' . $apil->img_apil);
					}

					$i = $this->input;
					$data = array(
						'kd_apil'				=> $kd,
						'kd_jalan'			=> $jln,
						'thn_pengadaan'	=> $i->post('tahun'),
						'km_lokasi	'		=> $i->post('kmlokasi'),
						'jenis'				=> $i->post('jenis'),
						'img_apil'			=> $upload_data['uploads']['file_name'],
						'letak'				=> $i->post('letak'),
						'status'				=> $i->post('status'),
						'lat'					=> $i->post('korx'),
						'lang'				=> $i->post('kory')
					);
					$this->apil_model->editapil($data);
					$this->session->set_flashdata('sukses', 'Berhasil diubah');
					redirect(base_url('admin/apil/detail/' . $jalan->kd_balai . '/' . $jalan->kd_jalan));
				}
			} else {
				$i = $this->input;
				$data = array(
					'kd_apil'				=> $kd,
					'kd_jalan'			=> $jln,
					'thn_pengadaan'	=> $i->post('tahun'),
					'km_lokasi	'		=> $i->post('kmlokasi'),
					'jenis'				=> $i->post('jenis'),
					'letak'				=> $i->post('letak'),
					'status'				=> $i->post('status'),
					'lat'					=> $i->post('korx'),
					'lang'				=> $i->post('kory')
				);
				$this->apil_model->editapil($data);
				$this->session->set_flashdata('sukses', 'Berhasil diubah');
				redirect(base_url('admin/apil/detail/' . $jalan->kd_balai . '/' . $jalan->kd_jalan));
			}
		}
	}

	public function delete($jln, $kd)
	{
		$apil = $this->apil_model->detailapil($jln, $kd);
		$jalan = $this->jalan_model->detail($jln);
		if ($apil->img_apil != null) {
			unlink('./assets/upload/apil/' . $apil->img_apil);
			unlink('./assets/upload/apil/thumbs/' . $apil->img_apil);
		}
		$data = array('kd_jalan' => $jln, 'kd_apil' => $kd);
		$this->apil_model->deleteapil($data);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		redirect(base_url('admin/apil/detail/' . $jalan->kd_balai . '/' . $jalan->kd_jalan));
	}

	public function viewapil($id, $jalan)
	{
		$ruas 	= $this->dashboard_model->detailruas($id, $jalan);
		$view 	= $this->dashboard_model->viewapill($jalan);
		$data = array(
			'title' 		=> 'View Apill',
			'ruas'		=> $ruas,
			'view'		=> $view,
			'isi' 		=> 'admin/apil/view'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function tukar($jln, $kd)
	{
		$jalan = $this->jalan_model->detail($jln);
		$i = $this->input;
		$data = array(
			'kd_apil'			=> $kd,
			'kd_jalan'		=> $i->post('kdruas')
		);
		$this->apil_model->editapil($data);
		$this->session->set_flashdata('sukses', 'Jalan Berhasil dipindah');
		redirect(base_url('admin/apil/detail/' . $jalan->kd_balai . '/' . $jalan->kd_jalan));
	}

	public function kml()
	{
		$apil = $this->apil_model->koordinatapil();
		$data = array(
			'title' 	=> 'kml',
			'apil'	=> $apil
		);
		$this->load->view('front/kml', $data);
	}

	public function cetak($kd)
	{
		$apil = $this->apil_model->cetakpdf($kd);
		$jalan = $this->jalan_model->detail($kd);
		$data = array(
			'nama'		=> 'Apil',
			'apil'	=> $apil,
			'jalan' 	=> $jalan
		);
		$this->load->view('admin/apil/print', $data);
	}

	// function cetak($kd){	
	// 	$apil = $this->apil_model->cetakpdf($kd);
	// 	$jalan = $this->jalan_model->detail($kd);
	// 	$nmruas = url_title($jalan->nm_ruas, 'dash', TRUE);
	// 	$data = array('nama' 	=> 'Apil',
	// 						'apil'	=> $apil,
	// 						'jalan'	=> $jalan);
	// 	$this->load->view('admin/apil/cetak', $data);
	// 	$tgl= date("d-m-Y");
	// 	$html = $this->output->get_output();      
	// 	$this->load->library('Pdf');
	// 	$this->dompdf->load_html($html);
	// 	$this->dompdf->render();
	// 	$this->dompdf->stream("Laporan-".strtoupper($data['nama'])."_".$nmruas."_".$tgl.".pdf",array('Attachment'=>0));
	// }
}
