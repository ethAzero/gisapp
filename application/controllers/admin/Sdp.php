<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sdp extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('sdp_model');
		$this->load->model('balai_model');
		$this->load->model('kabkota_model');
	}

	public function index()
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'PE')) {
			$list = $this->sdp_model->listing();
		} else {
			$list = $this->sdp_model->loginbatas();
		}
		$data = array(
			'title' 	=> 'sdp',
			'list'	=> $list,
			'isi'		=> 'admin/sdp/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function add()
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U')) {
			$kabkota = $this->kabkota_model->listing();
		} else {
			$kabkota = $this->kabkota_model->loginbatas();
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
				'title' 		=> 'Add sdp',
				'kabkota'	=> $kabkota,
				'isi' 		=> 'admin/sdp/add'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 		= './assets/upload/sdp/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 		=> 'Add sdp',
						'kabkota'	=> $kabkota,
						'error'		=> $this->upload->display_errors(),
						'isi' 		=> 'admin/sdp/add'
					);
					$this->load->view('admin/layout/wrapper', $data);
				} else {
					$upload_data					= array('uploads' => $this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/sdp/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/sdp/thumbs/';
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
					$data = array(
						'kd_kabkota'			=> $i->post('kabkota'),
						'nm_sdp'		=> $i->post('nmsdp'),
						'keterangan'	=> $i->post('ket'),
						'img_sdp'		=> $upload_data['uploads']['file_name'],
						'lat'					=> $i->post('korx'),
						'lang'				=> $i->post('kory')
					);
					$this->sdp_model->addsdp($data);
					$this->session->set_flashdata('sukses', 'Berhasil ditambah');
					redirect(base_url('admin/sdp'));
				}
			} else {
				$i = $this->input;
				$data = array(
					'kd_kabkota'			=> $i->post('kabkota'),
					'nm_sdp'		=> $i->post('nmsdp'),
					'keterangan'	=> $i->post('ket'),
					'lat'					=> $i->post('korx'),
					'lang'				=> $i->post('kory')
				);
				$this->sdp_model->addsdp($data);
				$this->session->set_flashdata('sukses', 'Berhasil ditambah');
				redirect(base_url('admin/sdp'));
			}
		}
	}

	public function edit($id)
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U')) {
			$kabkota = $this->kabkota_model->listing();
		} else {
			$kabkota = $this->kabkota_model->loginbatas();
		}
		$sdp 		= $this->sdp_model->detailsdp($id);
		$ddukung 	= $this->sdp_model->datadukung($id);
		// print_r($ddukung);exit();
		$valid = $this->form_validation;
		$valid->set_rules(
			'kabkota',
			'kabkota',
			'required',
			array('required'	=> 'Kabupaten / Kota harus diisi')
		);
		if ($valid->run() == FALSE) {
			$data = array(
				'title'  	=> 'Edit sdp',
				'sdp' 	=> $sdp,
				'kabkota' 	=> $kabkota,
				'ddukung' 	=> $ddukung,
				'isi'    	=> 'admin/sdp/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path'] 		= './assets/upload/sdp/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					$data = array(
						'title' 		=> 'Edit sdp',
						'sdp'	=> $sdp,
						'kabkota' 	=> $kabkota,
						'error'		=> $this->upload->display_errors(),
						'isi'			=> 'admin/sdp/edit'
					);
					$this->load->view('admin/layout/wrapper', $data);
				} else {
					$upload_data					= array('uploads' => $this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/sdp/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/sdp/thumbs/';
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

					if ($sdp->img_sdp != "") {
						unlink('./assets/upload/sdp/' . $sdp->img_sdp);
						unlink('./assets/upload/sdp/thumbs/' . $sdp->img_sdp);
					}

					$i = $this->input;
					$data = array(
						'kd_sdp'		=> $id,
						'kd_kabkota'	=> $i->post('kabkota'),
						'nm_sdp'		=> $i->post('nmsdp'),
						'keterangan'	=> $i->post('ket'),
						'img_sdp'	=> $upload_data['uploads']['file_name'],
						'lat'				=> $i->post('korx'),
						'lang'			=> $i->post('kory')
					);
					$this->sdp_model->editsdp($data);
					$this->session->set_flashdata('sukses', 'Berhasil diubah');
					redirect(base_url('admin/sdp'));
				}
			} else {
				$i = $this->input;
				$data = array(
					'kd_sdp'		=> $id,
					'kd_kabkota'	=> $i->post('kabkota'),
					'keterangan'	=> $i->post('ket'),
					'nm_sdp'	=> $i->post('nmsdp'),
					'lat'				=> $i->post('korx'),
					'lang'			=> $i->post('kory')
				);
				$this->sdp_model->editsdp($data);
				$this->session->set_flashdata('sukses', 'Berhasil diubah');
				redirect(base_url('admin/sdp'));
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
		$sdp 		= $this->sdp_model->detailsdp($id);
		$ddukung 	= $this->sdp_model->datadukung($id);
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
				'title'  	=> 'Edit sdp',
				'sdp' 		=> $sdp,
				'kabkota' 	=> $kabkota,
				'ddukung' 	=> $ddukung,
				'isi'    	=> 'admin/sdp/edit'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			// print_r($_FILES);exit();

			$config['upload_path'] 		= './assets/upload/sdp/datadukung/';
			$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg|doc|pdf|docx|xls|xlsx';
			// $config['max_size']			= '500';
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file_dukung')) {

				$data = array(
					'title' 		=> 'Edit sdp',
					'sdp'			=> $sdp,
					'kabkota' 		=> $kabkota,
					'ddukung' 		=> $ddukung,
					'errored'		=> $this->upload->display_errors(),
					'isi'			=> 'admin/sdp/edit'
				);
				$this->load->view('admin/layout/wrapper', $data);
			} else {
				$i = $this->input;
				$upload_data					= array('uploads' => $this->upload->data());
				$data = array(
					'kd_sdp'		=> $id,
					'data_dukung'	=> $i->post('nm_file'),
					'file_sdp'		=> $upload_data['uploads']['file_name']
				);
				$this->sdp_model->adddetailsdp($data);
				$this->session->set_flashdata('sukses', 'Berhasil diubah');
				redirect(base_url('admin/sdp/edit/' . $id));
			}
		}
	}

	public function delete($id)
	{
		$sdp = $this->sdp_model->detailsdp($id);
		if ($sdp->img_sdp != null) {
			unlink('./assets/upload/sdp/' . $sdp->img_sdp);
			unlink('./assets/upload/sdp/thumbs/' . $sdp->img_sdp);
		}
		$data = array('kd_sdp' => $id);
		$this->sdp_model->deletesdp($data);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		redirect(base_url('admin/sdp'));
	}


	public function deletedatadukung($id)
	{
		$sdp 	= $this->sdp_model->detaildatadukung($id);
		// print_r($sdp);exit();
		$kd 	= $sdp->kd_sdp;
		// print_r($sdp->file_sdp);exit();
		if ($sdp->file_sdp != null) {
			// print_r('expression');exit();
			unlink('./assets/upload/sdp/datadukung/' . $sdp->file_sdp);
		}
		// print_r('1');exit();
		$this->sdp_model->deletedatadukung($id);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		redirect(base_url('admin/sdp/edit/' . $kd));
	}
}
