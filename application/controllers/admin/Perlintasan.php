<?php

defined('BASEPATH') or exit('No direct script access allowed');



class Perlintasan extends CI_Controller
{



	public function __construct()
	{
		parent::__construct();
		$this->load->model('perlintasan_model');
		$this->load->model('balai_model');
		$this->load->model('kabkota_model');
	}



	public function index()
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') || ($hak === 'A') || ($hak === 'U') || ($hak === 'JT')) {
			$list = $this->perlintasan_model->listing();
		} else {

			$list = $this->perlintasan_model->loginbatas();
		}

		$data = array(
			'title' 	=> 'Perlintasan',
			'list'	=> $list,
			'isi'		=> 'admin/perlintasan/list'
		);

		$this->load->view('admin/layout/wrapper', $data);
	}





	public function add()
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'JT')) {
			$kabkota = $this->kabkota_model->listing();
		} else {
			$kabkota = $this->kabkota_model->loginbatas();
		}

		$urut = $this->perlintasan_model->kodeurut();
		if ($urut->urutan == '') {
			$kodeurut = '0001';
		} else {
			$urut2 = ($urut->urutan) + 1;
			$kodeurut  = sprintf("%04s", $urut2);
		}

		$valid = $this->form_validation;
		$valid->set_rules(
			'kabkota',
			'kabkota',
			'required',
			array('required'	=> 'Nama Kabupaten / Kota harus diisi')
		);

		if ($valid->run() == FALSE) {
			$data = array(
				'title' 		=> 'Add Perlintasan',
				'kabkota'	=> $kabkota,
				'isi' 		=> 'admin/perlintasan/add'
			);

			$this->load->view('admin/layout/wrapper', $data);
		} else {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 		= './assets/upload/perlintasan/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 		=> 'Add perlintasan',
						'kabkota'	=> $kabkota,
						'error'		=> $this->upload->display_errors(),
						'isi' 		=> 'admin/perlintasan/add'
					);

					$this->load->view('admin/layout/wrapper', $data);
				} else {
					$upload_data					= array('uploads' => $this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/perlintasan/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/perlintasan/thumbs/';
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
					$kode = 'PL' . $kodeurut;
					$data = array(
						'kd_perlintasan'	=> $kode,
						'kd_kabkota'			=> $i->post('kabkota'),
						'nm_perlintasan'	=> $i->post('nmperlintasan'),
						'jenis_perlintasan'	=> $i->post('jenisperlintasan'),
						'status_penjagaan'	=> $i->post('statuspenjagaan'),
						'status_jalan'		=> $i->post('statusjalan'),
						'lebar_jalan'		=> $i->post('lebarjalan'),
						'perkerasan'		=> $i->post('perkerasan'),
						'palang_pintu'		=> $i->post('palangpintu'),
						'andreas_cross'		=> $i->post('andreascross'),
						'rambu_stop'		=> $i->post('rambustop'),
						'rambu_peringatan'	=> $i->post('rambuperingatan'),
						'rambu_peringatan1'	=> $i->post('rambuperingatan1'),
						'rambu_peringatan2'	=> $i->post('rambuperingatan2'),
						'wl_running_text'	=> $i->post('wlrunning'),
						'img_perlintasan'	=> $upload_data['uploads']['file_name'],
						'lat'					=> $i->post('korx'),
						'lang'				=> $i->post('kory')
					);

					$this->perlintasan_model->addperlintasan($data);
					$this->session->set_flashdata('sukses', 'Berhasil ditambah');
					redirect(base_url('admin/perlintasan'));
				}
			} else {
				$i = $this->input;
				$kode = 'PL' . $kodeurut;
				$data = array(
					'kd_perlintasan'	=> $kode,
					'kd_kabkota'			=> $i->post('kabkota'),
					'nm_perlintasan'	=> $i->post('nmperlintasan'),
					'jenis_perlintasan'	=> $i->post('jenisperlintasan'),
					'status_penjagaan'	=> $i->post('statuspenjagaan'),
					'status_jalan'		=> $i->post('statusjalan'),
					'lebar_jalan'		=> $i->post('lebarjalan'),
					'perkerasan'		=> $i->post('perkerasan'),
					'palang_pintu'		=> $i->post('palangpintu'),
					'andreas_cross'		=> $i->post('andreascross'),
					'rambu_stop'		=> $i->post('rambustop'),
					'rambu_peringatan'	=> $i->post('rambuperingatan'),
					'rambu_peringatan1'	=> $i->post('rambuperingatan1'),
					'rambu_peringatan2'	=> $i->post('rambuperingatan2'),
					'wl_running_text'	=> $i->post('wlrunning'),
					'lat'				=> $i->post('korx'),
					'lang'				=> $i->post('kory')
				);
				$this->perlintasan_model->addperlintasan($data);
				$this->session->set_flashdata('sukses', 'Berhasil ditambah');
				redirect(base_url('admin/perlintasan'));
			}
		}
	}



	public function edit($id)
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'JT')) {
			$kabkota = $this->kabkota_model->listing();
		} else {
			$kabkota = $this->kabkota_model->loginbatas();
		}

		$perlintasan = $this->perlintasan_model->detailperlintasan($id);
		$ddukung 	= $this->perlintasan_model->datadukung($id);
		$valid = $this->form_validation;

		$valid->set_rules(
			'kabkota',
			'kabkota',
			'required',
			array('required'	=> 'Kabupaten / Kota harus diisi')
		);

		if ($valid->run() == FALSE) {
			$data = array(
				'title'  	=> 'Edit Perlintasan',
				'perlintasan' 	=> $perlintasan,
				'kabkota' 	=> $kabkota,
				'ddukung' 	=> $ddukung,
				'isi'    	=> 'admin/perlintasan/edit'
			);

			$this->load->view('admin/layout/wrapper', $data);
		} else {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 		= './assets/upload/perlintasan/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 		=> 'Edit Perlintasan',
						'perlintasan'	=> $perlintasan,
						'kabkota' 	=> $kabkota,
						'error'		=> $this->upload->display_errors(),
						'isi'			=> 'admin/perlintasan/edit'
					);

					$this->load->view('admin/layout/wrapper', $data);
				} else {
					$upload_data					= array('uploads' => $this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/perlintasan/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/perlintasan/thumbs/';
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

					if ($perlintasan->img_perlintasan != "") {
						unlink('./assets/upload/perlintasan/' . $perlintasan->img_perlintasan);
						unlink('./assets/upload/perlintasan/thumbs/' . $perlintasan->img_perlintasan);
					}

					$i = $this->input;
					$data = array(
						'kd_perlintasan'	=> $id,
						'kd_kabkota'		=> $i->post('kabkota'),
						'nm_perlintasan'	=> $i->post('nmperlintasan'),
						'img_perlintasan'	=> $upload_data['uploads']['file_name'],
						'lat'					=> $i->post('korx'),
						'lang'				=> $i->post('kory'),
						'ket'				=> $i->post('ket')
					);

					$this->perlintasan_model->editperlintasan($data);
					$this->session->set_flashdata('sukses', 'Berhasil diubah');
					redirect(base_url('admin/perlintasan'));
				}
			} else {
				$i = $this->input;
				$data = array(
					'kd_perlintasan'	=> $id,
					'kd_kabkota'		=> $i->post('kabkota'),
					'nm_perlintasan'	=> $i->post('nmperlintasan'),
					'lat'					=> $i->post('korx'),
					'lang'				=> $i->post('kory'),
					'ket'				=> $i->post('ket')
				);

				$this->perlintasan_model->editperlintasan($data);
				$this->session->set_flashdata('sukses', 'Berhasil diubah');
				redirect(base_url('admin/perlintasan'));
			}
		}
	}

	public function datadukung($id)
	{
		// print_r($_POST);exit();
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U')) {
			$kabkota = $this->kabkota_model->listing();
		} else {
			$kabkota = $this->kabkota_model->loginbatas();
		}
		$perlintasan = $this->perlintasan_model->detailperlintasan($id);
		$ddukung 	= $this->perlintasan_model->datadukung($id);
		// print_r($ddukung);exit();
		$valid = $this->form_validation;
		$valid->set_rules(
			'nm_file',
			'nm_file',
			'required',
			array('required'	=> 'Nama File harus diisi')
		);
		if ($valid->run() == FALSE) {
			// print_r('tes');exit();
			$data = array(
				'title'  	=> 'Edit Perlintasan',
				'perlintasan' 		=> $perlintasan,
				'kabkota' 	=> $kabkota,
				'ddukung' 	=> $ddukung,
				'isi'    	=> 'admin/perlintasan/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			// print_r($_FILES);exit();

			$config['upload_path'] 		= './assets/upload/perlintasan/datadukung/';
			$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg|doc|pdf|docx|xls|xlsx';
			// $config['max_size']			= '500';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_dukung')) {

				$data = array(
					'title'  	=> 'Edit Perlintasan',
					'perlintasan'	=> $perlintasan,
					'kabkota' 		=> $kabkota,
					'ddukung' 		=> $ddukung,
					'errored'		=> $this->upload->display_errors(),
					'isi'			=> 'admin/perlintasan/edit'
				);
				$this->load->view('admin/layout/wrapper', $data);
			} else {
				$i = $this->input;
				$upload_data					= array('uploads' => $this->upload->data());
				$data = array(
					'kd_perlintasan'		=> $id,
					'data_dukung'	=> $i->post('nm_file'),
					'file_perlintasan'		=> $upload_data['uploads']['file_name']
				);
				$this->perlintasan_model->adddetailperlintasan($data);
				$this->session->set_flashdata('sukses', 'Berhasil diubah');
				redirect(base_url('admin/perlintasan/edit/' . $id));
			}
		}
	}


	public function delete($id)
	{
		$perlintasan = $this->perlintasan_model->detailperlintasan($id);
		if ($perlintasan->img_perlintasan != null) {
			unlink('./assets/upload/perlintasan/' . $perlintasan->img_perlintasan);
			unlink('./assets/upload/perlintasan/thumbs/' . $perlintasan->img_perlintasan);
		}
		$data = array('kd_perlintasan' => $id);
		$this->perlintasan_model->deleteperlintasan($data);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		redirect(base_url('admin/perlintasan'));
	}

	public function deletedatadukung($id)
	{
		$perlintasan 	= $this->perlintasan_model->detaildatadukung($id);
		$kd 	= $perlintasan->kd_perlintasan;
		if ($perlintasan->file_perlintasan != null) {
			unlink('./assets/upload/perlintasan/datadukung/' . $perlintasan->file_perlintasan);
		}
		$this->perlintasan_model->deletedatadukung($id);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		redirect(base_url('admin/perlintasan/edit/' . $kd));
		// echo $id;
	}
}
