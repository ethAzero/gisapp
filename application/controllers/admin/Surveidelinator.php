<?php
defined('BASEPATH') or exit('No direct script access allowed');

class surveidelinator extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('delinator_model');
		$this->load->model('survay_model');
	}

	// //real yg dibutuhkan

	public function add()
	{
		date_default_timezone_set("Asia/Bangkok");
		$tahun = date('Y');
		if (!$this->input->post('kddelinator')) {

			//jik kode_cermin kosong maka tambah data baru
			$urut = $this->delinator_model->kodeurut();
			if ($urut->urutan == '') {
				$kodeurut = '00001';
			} else {
				$urut2 = ($urut->urutan) + 1;
				$kodeurut  = sprintf("%05s", $urut2);
			}

			if (!empty($_FILES['gambar']['name'])) {
				$kode = 'DL' . $kodeurut;
				$filename = $kode . '_' . $this->input->post('status') . '_' . time();
				$config['upload_path'] 		= './assets/upload/delinator/';
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
					$config['source_image'] 	= './assets/upload/delinator/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/delinator/thumbs/';
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
						'kd_delinator'			=> $kode,
						'kd_jalan'			=> $this->input->post('kdjalan'),
						'thn_pengadaan'		=> $tahun,
						'km_lokasi	'		=> $this->input->post('kmlokasi'),
						'jenis'				=> $this->input->post('jenis'),
						'img_delinator'		=> $upload_data['uploads']['file_name'],
						'letak'				=> $this->input->post('letak'),
						'status'			=> $this->input->post('status'),
						'lat'				=> $this->input->post('korx'),
						'lang'				=> $this->input->post('kory')
					);
					$this->delinator_model->adddelinator($data);
					echo json_encode(array('method' => 'add'));
				}
			} else {
				$i = $this->input;
				$kode = 'DL' . $kodeurut;
				$data = array(
					'kd_delinator'			=> $kode,
					'kd_jalan'			=> $i->post('kdjalan'),
					'thn_pengadaan'		=> $tahun,
					'km_lokasi	'		=> $i->post('kmlokasi'),
					'jenis'				=> $i->post('jenis'),
					'letak'				=> $i->post('letak'),
					'status'			=> $i->post('status'),
					'lat'				=> $i->post('korx'),
					'lang'				=> $i->post('kory')
				);
				$this->delinator_model->adddelinator($data);
				echo json_encode(array('method' => 'add'));
			}
		} elseif ($this->input->post('kddelinator')) {
			//jik kode_cermin tidak kosong maka edit data berdasarkan kode cermin
			$date = new DateTime();
			$a = $date->getTimestamp();
			$updated_at = date('Y-m-d H:i:s', $a);

			//ambil data lama untuk disimpan ke history
			$kodedelinator = $this->input->post('kddelinator');
			$kodejalan = $this->input->post('kdjalan');
			$datalama = $this->delinator_model->detaildelinator($kodejalan, $kodedelinator);
			$data = array(
				'kd_perjal'			=> $datalama->kd_delinator,
				'status'			=> $datalama->status,
				'img'				=> $datalama->img_delinator,
				'created_at'		=> $datalama->updated_at,
			);
			//history hanya akan ditambahkan jika status perlengkapan jalan berubah
			if ($datalama->status != $this->input->post('status')) {
				$this->survay_model->updatehistory($data);
			}

			if (!empty($_FILES['gambar']['name'])) {
				$filename = $kodedelinator . '_' . $this->input->post('status') . '_' . time();
				$config['upload_path'] 		= './assets/upload/delinator/';
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
					$config['source_image'] 	= './assets/upload/delinator/' . $upload_data['uploads']['file_name'];
					$config['new_image'] 		= './assets/upload/delinator/thumbs/';
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

					if ($datalama->status == $this->input->post('status') && $datalama->img_delinator != '') {
						unlink('./assets/upload/delinator/' . $datalama->img_delinator);
						unlink('./assets/upload/delinator/thumbs/' . $datalama->img_delinator);
					}

					//jika data status tidak berubah data updated_at tidak berubah
					if ($datalama->status == $this->input->post('status')) {
						$data = array(
							'kd_delinator'			=> $this->input->post('kddelinator'),
							'kd_jalan'			=> $this->input->post('kdjalan'),
							'km_lokasi	'		=> $this->input->post('kmlokasi'),
							'jenis'				=> $this->input->post('jenis'),
							'img_delinator'			=> $upload_data['uploads']['file_name'],
							'letak'				=> $this->input->post('letak'),
							'status'			=> $this->input->post('status'),
							'lat'				=> $this->input->post('korx'),
							'lang'				=> $this->input->post('kory'),
						);
					} else if ($datalama->status != $this->input->post('status')) {
						$data = array(
							'kd_delinator'			=> $this->input->post('kddelinator'),
							'kd_jalan'			=> $this->input->post('kdjalan'),
							'km_lokasi	'		=> $this->input->post('kmlokasi'),
							'jenis'				=> $this->input->post('jenis'),
							'img_delinator'			=> $upload_data['uploads']['file_name'],
							'letak'				=> $this->input->post('letak'),
							'status'			=> $this->input->post('status'),
							'lat'				=> $this->input->post('korx'),
							'lang'				=> $this->input->post('kory'),
							'updated_at'		=> $updated_at
						);
					}

					$this->delinator_model->editdelinator($data);
					echo json_encode(array('method' => 'edit'));
				}
			} else {
				$i = $this->input;

				//jika data status tidak berubah data updated_at tidak berubah
				if ($datalama->status == $this->input->post('status')) {
					$data = array(
						'kd_delinator'			=> $this->input->post('kddelinator'),
						'kd_jalan'			=> $i->post('kdjalan'),
						'km_lokasi	'		=> $i->post('kmlokasi'),
						'jenis'				=> $i->post('jenis'),
						'letak'				=> $i->post('letak'),
						'status'			=> $i->post('status'),
						'lat'				=> $i->post('korx'),
						'lang'				=> $i->post('kory')
					);
				} else if ($datalama->status != $this->input->post('status')) {
					$data = array(
						'kd_delinator'			=> $this->input->post('kddelinator'),
						'kd_jalan'			=> $i->post('kdjalan'),
						'km_lokasi	'		=> $i->post('kmlokasi'),
						'jenis'				=> $i->post('jenis'),
						'letak'				=> $i->post('letak'),
						'status'			=> $i->post('status'),
						'lat'				=> $i->post('korx'),
						'lang'				=> $i->post('kory'),
						'updated_at'		=> $updated_at
					);
				}
				$this->delinator_model->editdelinator($data);
				echo json_encode(array('method' => 'edit'));
			}
		}
	}
}
