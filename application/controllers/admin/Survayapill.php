<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survayapill extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('apil_model');
		$this->load->model('jalan_model');
		$this->load->model('dashboard_model');
		$this->load->model('home_model');
	}

	//real yg dibutuhkan
	public function add()
	{
		if (!$this->input->post('kdapill')) {
			//jik kode_apill kosong maka tambah data baru
			$urut = $this->apil_model->kodeurut();
			if ($urut->urutan == '') {
				$kodeurut = '00001';
			} else {
				$urut2 = ($urut->urutan) + 1;
				$kodeurut  = sprintf("%05s", $urut2);
			}

			if (!empty($_FILES['gambar']['name'])) {
				$kode = 'AP' . $kodeurut;
				$filename = $kode . '_' . time();
				$config['upload_path'] 		= './assets/upload/apil/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$config['file_name'] = $filename;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('gambar')) {
					json_encode($this->upload->display_errors());
				} else {
					$upload_data				= array('uploads' => $this->upload->data());
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


					date_default_timezone_set("Asia/Bangkok");
					$tahun = date('Y');
					$data = array(
						'kd_apil'			=> $kode,
						'kd_jalan'			=> $this->input->post('kdjalan'),
						'thn_pengadaan'		=> $tahun,
						'km_lokasi	'		=> $this->input->post('kmlokasi'),
						'jenis'				=> $this->input->post('jenis'),
						'img_apil'			=> $upload_data['uploads']['file_name'],
						'letak'				=> $this->input->post('letak'),
						'status'			=> $this->input->post('status'),
						'lat'				=> $this->input->post('korx'),
						'lang'				=> $this->input->post('kory')
					);
					$this->apil_model->addapil($data);
					json_encode(array('sukses' => '1'));
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
				// json_encode(array('sukses' => '1'));
			}
		} elseif ($this->input->post('kdapill')) {
			//jik kode_apill tidak kosong maka edit data berdasarkan kode apil
			echo $this->input->post('kdapill');
		};

		// var_dump($_FILES);

	}
}
