<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Surveirambu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('rambu_model');
		$this->load->model('survay_model');
	}

	// //real yg dibutuhkan

	public function add()
	{
		date_default_timezone_set("Asia/Bangkok");
		$tahun = date('Y');
		if (!$this->input->post('kdrambu')) {

			//jik kode_apill kosong maka tambah data baru
			$urut = $this->rambu_model->kodeurut();
			if ($urut->urutan == '') {
				$kodeurut = '00001';
			} else {
				$urut2 = ($urut->urutan) + 1;
				$kodeurut  = sprintf("%05s", $urut2);
			}

			if (!empty($_FILES['gambar']['name'])) {
				$kode = 'RB' . $kodeurut;
				$filename = $kode . '_' . $this->input->post('status') . '_' . time();
				$config['upload_path'] 		= './assets/upload/rambu/';
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
					$config['source_image'] 	= './assets/upload/rambu/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/rambu/thumbs/';
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

					$data = array(
						'kd_rambu'			=> $kode,
						'kd_jalan'			=> $this->input->post('kdjalan'),
						'jenis'			=> $this->input->post('jenis'),
						'tipe'			=> $this->input->post('tipe'),
						'thn_pengadaan'		=> $tahun,
						'status'			=> $this->input->post('status'),
						'km_lokasi	'		=> $this->input->post('kmlokasi'),
						'jenis'				=> $this->input->post('jenis'),
						'img_rambu'			=> $upload_data['uploads']['file_name'],
						'posisi'				=> $this->input->post('letak'),
						'kondisi'				=> $this->input->post('kondisi'),
						'lat'				=> $this->input->post('korx'),
						'lang'				=> $this->input->post('kory')
					);
					$this->rambu_model->addrambu($data);
					echo json_encode(array('method' => 'add'));
				}
			} else {
				$i = $this->input;
				$kode = 'RB' . $kodeurut;
				$data = array(
					'kd_rambu'			=> $kode,
					'kd_jalan'			=> $this->input->post('kdjalan'),
					'jenis'			=> $this->input->post('jenis'),
					'tipe'			=> $this->input->post('tipe'),
					'thn_pengadaan'		=> $tahun,
					'status'			=> $this->input->post('status'),
					'km_lokasi	'		=> $this->input->post('kmlokasi'),
					'jenis'				=> $this->input->post('jenis'),
					'posisi'				=> $this->input->post('letak'),
					'kondisi'				=> $this->input->post('kondisi'),
					'lat'				=> $this->input->post('korx'),
					'lang'				=> $this->input->post('kory')
				);
				$this->rambu_model->addrambu($data);
				echo json_encode(array('method' => 'add'));
			}
		} elseif ($this->input->post('kdrambu')) {
			//jik kode_apill tidak kosong maka edit data berdasarkan kode apil
			$date = new DateTime();
			$a = $date->getTimestamp();
			$updated_at = date('Y-m-d H:i:s', $a);

			//ambil data lama untuk disimpan ke history
			$kdrambu = $this->input->post('kdrambu');
			$kodejalan = $this->input->post('kdjalan');
			$datalama = $this->survay_model->getRambuById($kdrambu);
			$data = array(
				'kd_perjal'			=> $datalama->kd_rambu,
				'status'			=> $datalama->status,
				'img'				=> $datalama->img_rambu,
				'created_at'		=> $datalama->updated_at,
			);
			//history hanya akan ditambahkan jika status perlengkapan jalan berubah
			if ($datalama->status != $this->input->post('status')) {
				$this->survay_model->updatehistory($data);
			}

			if (!empty($_FILES['gambar']['name'])) {
				$filename = $kdrambu . '_' . $this->input->post('status') . '_' . time();
				$config['upload_path'] 		= './assets/upload/rambu/';
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
					$config['source_image'] 	= './assets/upload/rambu/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/rambu/thumbs/';
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

					if ($datalama->status == $this->input->post('status') && $datalama->img_rambu != '') {
						unlink('./assets/upload/rambu/' . $datalama->img_rambu);
						unlink('./assets/upload/rambu/thumbs/' . $datalama->img_rambu);
					}

					//jika data status tidak berubah data updated_at tidak berubah
					if ($datalama->status == $this->input->post('status')) {
						$data = array(
							'kd_jalan'			=> $this->input->post('kdjalan'),
							'jenis'			=> $this->input->post('jenis'),
							'tipe'			=> $this->input->post('tipe'),
							'thn_pengadaan'		=> $tahun,
							'status'			=> $this->input->post('status'),
							'km_lokasi	'		=> $this->input->post('kmlokasi'),
							'jenis'				=> $this->input->post('jenis'),
							'img_rambu'			=> $upload_data['uploads']['file_name'],
							'posisi'				=> $this->input->post('letak'),
							'kondisi'				=> $this->input->post('kondisi'),
							'lat'				=> $this->input->post('korx'),
							'lang'				=> $this->input->post('kory')
						);
					} else if ($datalama->status != $this->input->post('status')) {
						$data = array(
							'kd_jalan'			=> $this->input->post('kdjalan'),
							'jenis'			=> $this->input->post('jenis'),
							'tipe'			=> $this->input->post('tipe'),
							'thn_pengadaan'		=> $tahun,
							'status'			=> $this->input->post('status'),
							'km_lokasi	'		=> $this->input->post('kmlokasi'),
							'jenis'				=> $this->input->post('jenis'),
							'img_rambu'			=> $upload_data['uploads']['file_name'],
							'posisi'				=> $this->input->post('letak'),
							'kondisi'				=> $this->input->post('kondisi'),
							'lat'				=> $this->input->post('korx'),
							'lang'				=> $this->input->post('kory'),
							'updated_at'		=> $updated_at
						);
					}

					$this->rambu_model->editrambu($data);
					echo json_encode(array('method' => 'edit'));
				}
			} else {
				$i = $this->input;


				//jika data status tidak berubah data updated_at tidak berubah
				if ($datalama->status == $this->input->post('status')) {
					$data = array(
						'kd_jalan'			=> $this->input->post('kdjalan'),
						'jenis'			=> $this->input->post('jenis'),
						'tipe'			=> $this->input->post('tipe'),
						'thn_pengadaan'		=> $tahun,
						'status'			=> $this->input->post('status'),
						'km_lokasi	'		=> $this->input->post('kmlokasi'),
						'jenis'				=> $this->input->post('jenis'),
						'posisi'				=> $this->input->post('letak'),
						'kondisi'				=> $this->input->post('kondisi'),
						'lat'				=> $this->input->post('korx'),
						'lang'				=> $this->input->post('kory')
					);
				} else if ($datalama->status != $this->input->post('status')) {
					$data = array(
						'kd_jalan'			=> $this->input->post('kdjalan'),
						'jenis'			=> $this->input->post('jenis'),
						'tipe'			=> $this->input->post('tipe'),
						'thn_pengadaan'		=> $tahun,
						'status'			=> $this->input->post('status'),
						'km_lokasi	'		=> $this->input->post('kmlokasi'),
						'jenis'				=> $this->input->post('jenis'),
						'posisi'				=> $this->input->post('letak'),
						'kondisi'				=> $this->input->post('kondisi'),
						'lat'				=> $this->input->post('korx'),
						'lang'				=> $this->input->post('kory'),
						'updated_at'		=> $updated_at
					);
				}
				$this->rambu_model->editrambu($data);
				echo json_encode(array('method' => 'edit'));
			}
		}
	}
}
