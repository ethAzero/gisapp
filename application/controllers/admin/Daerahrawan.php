<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Daerahrawan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('daerahrawan_model');
		$this->load->model('balai_model');
		$this->load->model('kabkota_model');
		$this->load->model('delinator_model');
		$this->load->model('jalan_model');
	}


	public function index()
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'LL')) {
			$list = $this->daerahrawan_model->listing();
		} else {
			$list = $this->daerahrawan_model->loginbatas();
		}
		$data = array(
			'title' 	=> 'Daerah Rawan',
			'list'	=> $list,
			'isi'		=> 'admin/daerahrawan/list'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function add()
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak == 'LL')) {
			if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'LL')) {
				$kabkota = $this->kabkota_model->listing();
			} else {
				$kabkota = $this->kabkota_model->loginbatas();
			}
			$jalan = $this->daerahrawan_model->getjalan();
			// print_r($jalan);exit();
			$valid = $this->form_validation;
			$valid->set_rules(
				'kabkota',
				'kabkota',
				'required',
				array('required'	=> 'Nama Kabupaten / Kota harus diisi')
			);
			if ($valid->run() == FALSE) {
				$data = array(
					'title' 		=> 'Add Daerah Rawan',
					'kabkota'	=> $kabkota,
					'jln'		=> $jalan,
					'isi' 		=> 'admin/daerahrawan/add'
				);
				$this->load->view('admin/layout/wrapper', $data);
			} else {
				if (!empty($_FILES['gambar']['name'])) {
					$config['upload_path'] 		= './assets/upload/daerahrawan/';
					$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
					$config['max_size']			= '500';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('gambar')) {
						$data = array(
							'title' 		=> 'Add Dae Rahrawan',
							'kabkota'	=> $kabkota,
							'error'		=> $this->upload->display_errors(),
							'isi' 		=> 'admin/daerahrawan/add'
						);
						$this->load->view('admin/layout/wrapper', $data);
					} else {
						$upload_data					= array('uploads' => $this->upload->data());
						$config['image_library']	= 'gd2';
						$config['encrypt_name'] 	= TRUE;
						$config['source_image'] 	= './assets/upload/daerahrawan/' . $upload_data['uploads']['file_name'];
						$config['new_image'] 		= './assets/upload/daerahrawan/thumbs/';
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
							'kd_kabkota'		=> $i->post('kabkota'),
							'nm_daerah'			=> $i->post('nmdaerah'),
							'img_daerah'		=> $upload_data['uploads']['file_name'],
							'ket_daerah'		=> $i->post('ket'),
							'kd_jalan'			=> $i->post('jalan'),
							'status_jalan'		=> $i->post('statusjalan'),
							'lat'				=> $i->post('korx'),
							'lang'				=> $i->post('kory'),
							'status'			=> 1
						);

						$this->daerahrawan_model->adddaerahrawan($data);
						$this->session->set_flashdata('sukses', 'Berhasil ditambah');
						redirect(base_url('admin/daerahrawan'));
					}
				} else {
					// print_r($_POST);exit(); 
					$i = $this->input;
					$data = array(
						'kd_kabkota'			=> $i->post('kabkota'),
						'nm_daerah'			=> $i->post('nmdaerah'),
						'ket_daerah'		=> $i->post('ket'),
						'kd_jalan'			=> $i->post('jalan'),
						'status_jalan'		=> $i->post('statusjalan'),
						'lat'					=> $i->post('korx'),
						'lang'				=> $i->post('kory'),
						'status'			=> 1
					);
					$this->daerahrawan_model->adddaerahrawan($data);
					$this->session->set_flashdata('sukses', 'Berhasil ditambah');
					redirect(base_url('admin/daerahrawan'));
				}
			}
		} else {
			redirect(base_url('admin/daerahrawan/denied403'));
		}
	}

	public function edit($id)
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak == 'LL')) {
			if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'LL')) {
				$kabkota = $this->kabkota_model->listing();
			} else {
				$kabkota = $this->kabkota_model->loginbatas();
			}

			$jalan = $this->daerahrawan_model->getjalan();
			// print_r($jalan);exit();
			$daerahrawan 	= $this->daerahrawan_model->detaildaerahrawan($id);
			$listddrk 		= $this->daerahrawan_model->list_detaildaerah($id);
			// print_r($listddrk);exit();
			$valid = $this->form_validation;
			$valid->set_rules(
				'nmdaerah',
				'nmdaerah',
				'required',
				array('required'	=> 'Nama DRK Harus Diisi')
			);
			$valid->set_rules(
				'kabkota',
				'kabkota',
				'required',
				array('required'	=> 'Kabupaten / Kota harus diisi')
			);
			$valid->set_rules(
				'statusjalan',
				'statusjalan',
				'required',
				array('required'	=> 'Status Jalan Harus Dipilih')
			);

			if ($valid->run() == FALSE) {
				$data = array(
					'title'  		=> 'Edit Daerah Rawan',
					'daerahrawan' 	=> $daerahrawan,
					'kabkota' 		=> $kabkota,
					'jln' 			=> $jalan,
					'list_ddrk' 	=> $listddrk,
					'isi'    		=> 'admin/daerahrawan/edit'
				);
				$this->load->view('admin/layout/wrapper', $data);
			} else {
				if (!empty($_FILES['gambar']['name'])) {
					$config['upload_path'] 		= './assets/upload/daerahrawan/';
					$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
					$config['max_size']			= '500';
					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('gambar')) {
						$data = array(
							'title' 		=> 'Edit Daerah Rawan',
							'daerahrawan'	=> $daerahrawan,
							'kabkota' 		=> $kabkota,
							'jln' 			=> $$jalan,
							'error'			=> $this->upload->display_errors(),
							'isi'			=> 'admin/daerahrawan/edit'
						);
						$this->load->view('admin/layout/wrapper', $data);
					} else {
						$upload_data				= array('uploads' => $this->upload->data());
						$config['image_library']	= 'gd2';
						$config['encrypt_name'] 	= TRUE;
						$config['source_image'] 	= './assets/upload/daerahrawan/' . $upload_data['uploads']['file_name'];
						$config['new_image'] 		= './assets/upload/daerahrawan/thumbs/';
						$config['create_thumb'] 	= TRUE;
						$config['quality'] 			= "100%";
						$config['maintain_ratio'] 	= TRUE;
						$config['width'] 			= 360;
						$config['height'] 			= 200;
						$config['x_axis'] 			= 0;
						$config['y_axis'] 			= 0;
						$config['remove_spaces'] 	= TRUE;
						$config['thumb_marker'] 	= '';
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();

						if ($daerahrawan->img_daerah != "") {
							unlink('./assets/upload/daerahrawan/' . $daerahrawan->img_daerah);
							unlink('./assets/upload/daerahrawan/thumbs/' . $daerahrawan->img_daerah);
						}

						$i = $this->input;
						$data = array(
							'kd_daerah'			=> $id,
							'kd_kabkota'		=> $i->post('kabkota'),
							'nm_daerah'			=> $i->post('nmdaerah'),
							'img_daerah'		=> $upload_data['uploads']['file_name'],
							'ket_daerah'		=> $i->post('ket'),
							'kd_jalan'			=> $i->post('jalan'),
							'status_jalan'		=> $i->post('statusjalan'),
							'lat'				=> $i->post('korx'),
							'lang'				=> $i->post('kory')
						);
						$this->daerahrawan_model->editdaerahrawan($data);
						$this->session->set_flashdata('sukses', 'Berhasil diubah');
						redirect(base_url('admin/daerahrawan'));
					}
				} else {
					$i = $this->input;
					$data = array(
						'kd_daerah'			=> $id,
						'kd_kabkota'		=> $i->post('kabkota'),
						'nm_daerah'			=> $i->post('nmdaerah'),
						'ket_daerah'		=> $i->post('ket'),
						'kd_jalan'			=> $i->post('jalan'),
						'status_jalan'		=> $i->post('statusjalan'),
						'lat'				=> $i->post('korx'),
						'lang'				=> $i->post('kory')
					);
					$this->daerahrawan_model->editdaerahrawan($data);
					$this->session->set_flashdata('sukses', 'Berhasil diubah');
					redirect(base_url('admin/daerahrawan'));
				}
			}
		} else {
			redirect(base_url('admin/daerahrawan/denied403'));
		}
	}

	public function tanganidrk($id)
	{
		if (
			$this->session->userdata('hakakses') == '01' ||
			$this->session->userdata('hakakses') == '02' ||
			$this->session->userdata('hakakses') == '03' ||
			$this->session->userdata('hakakses') == '04' ||
			$this->session->userdata('hakakses') == '05' ||
			$this->session->userdata('hakakses') == '06'
		) {
			$i = $this->input;
			if (!$i->post('tahuntangani')) {
				date_default_timezone_set("Asia/Bangkok");
				$date = new DateTime();
				$a = $date->getTimestamp();
				$b = date('Y-m-d H:i:s', $a);
			} else {
				$b = $i->post('tahuntangani');
			}
			$data = array(
				'kd_daerah'			=> $id,
				'status_drk'		=> 2,
				'updated_at'		=> $b
			);
			$this->daerahrawan_model->editdaerahrawan($data);
			$this->session->set_flashdata('sukses', 'Status DRK Berhasil Ditangani');
			$this->session->set_flashdata('tab', 'detail');
			redirect(base_url('admin/daerahrawan/details/') . $id);
		} else {
			redirect(base_url('admin/daerahrawan/denied403'));
		}
	}


	public function add_ddrk($id)
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak === 'S') | ($hak === 'A') | ($hak === 'U') | ($hak === 'LL')) {
			$kabkota = $this->kabkota_model->listing();
		} else {
			$kabkota = $this->kabkota_model->loginbatas();
		}

		$jalan = $this->daerahrawan_model->getjalan();
		// print_r($jalan);exit();
		$daerahrawan 	= $this->daerahrawan_model->detaildaerahrawan($id);
		$listddrk 		= $this->daerahrawan_model->list_detaildaerah($id);
		// print_r($listddrk);exit();
		$valid = $this->form_validation;
		$valid->set_rules(
			'kabkota',
			'kabkota',
			'required',
			array('required'	=> 'Kabupaten / Kota harus diisi')
		);
	}



	public function delete($id)
	{
		$hak = $this->session->userdata('hakakses');
		if (($hak == 'LL')) {
			$cekrekom = $this->daerahrawan_model->cekrekom($id);
			$cekkejadian = $this->daerahrawan_model->cekkejadian($id);

			if ($cekrekom != 0 and $cekkejadian != 0) {
				$this->session->set_flashdata('error', 'Data tidak Dapat Dihapus Karena Data Rekomendasi dan Kejadian Sudah Diisi');
				redirect(base_url('admin/daerahrawan'));
			} elseif ($cekrekom == 0 and $cekkejadian == 0) {
				$daerahrawan = $this->daerahrawan_model->detaildaerahrawan($id);
				if ($daerahrawan->img_daerah != null) {
					unlink('./assets/upload/daerahrawan/' . $daerahrawan->img_daerah);
					unlink('./assets/upload/daerahrawan/thumbs/' . $daerahrawan->img_daerah);
				}
				$data = array('kd_daerah' => $id);
				$this->daerahrawan_model->deletedaerahrawan($data);
				$this->session->set_flashdata('sukses', 'Berhasil dihapus');
				redirect(base_url('admin/daerahrawan'));
			}
		} else {
			redirect(base_url('admin/daerahrawan/denied403'));
		}
	}

	public function cetak()
	{

		$list = $this->daerahrawan_model->listing1();

		// print_r($list);exit();	
		$data = array(
			'nama'		=> 'Daerah Rawan',
			'list'		=> $list
		);
		$this->load->view('admin/daerahrawan/print', $data);
	}

	public function details($id)
	{
		$listdrk = $this->daerahrawan_model->detaildaerahrawan($id);
		$listrekom = $this->daerahrawan_model->listrekom($id);
		$listkejadian = $this->daerahrawan_model->detailkejadian($id);
		$data = array(
			'title' 	=> 'Details Daerah Rawan',
			'listdrk'	=> $listdrk,
			'listrekom'	=> $listrekom,
			'listkejadian'	=> $listkejadian,
			'isi'		=> 'admin/daerahrawan/details'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}

	public function rekomadd($id)
	{
		$listdrk = $this->daerahrawan_model->detaildaerahrawan($id);
		$valid = $this->form_validation;
		$valid->set_rules(
			'jenisrekom',
			'jenisrekom',
			'required',
			array('required'	=> 'Jenis Rekomendasi / Kota harus diisi')
		);
		$valid->set_rules(
			'kebutuhan',
			'kebutuhan',
			'required',
			array('required'	=> 'Jumlah Kebutuhan / Kota harus diisi')
		);
		$valid->set_rules(
			'ket',
			'ket',
			'required',
			array('required'	=> 'Keterangan / Kota harus diisi')
		);
		if ($valid->run() == FALSE) {
			$data = array(
				'title' 	=> 'Add Rekomendasi',
				'listdrk'	=> $listdrk,
				'isi' 		=> 'admin/daerahrawan/addrekom'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i = $this->input;
			$data = array(
				'kd_daerah'		=> $id,
				'jenis_rekom'		=> $i->post('jenisrekom'),
				'satuan'			=> $i->post('satuan'),
				'jml_kebutuhan'		=> $i->post('kebutuhan'),
				'ket'				=> $i->post('ket'),
				'status'			=> 0,
				'lat'				=> $i->post('korx'),
				'lang'				=> $i->post('kory')
			);
			$this->daerahrawan_model->addrekomdrk($data);
			$this->session->set_flashdata('sukses', 'Berhasil ditambah');
			$this->session->set_flashdata('tab', 'rekom');
			redirect(base_url('admin/daerahrawan/details/') . $id);
		}
	}
	public function rekomedit($iddrk, $idrekom)
	{
		$listrekom = $this->daerahrawan_model->detailrekomdrk($idrekom);
		$valid = $this->form_validation;
		$valid->set_rules(
			'jenisrekom',
			'jenisrekom',
			'required',
			array('required'	=> 'Jenis Rekomendasi / Kota harus diisi')
		);
		$valid->set_rules(
			'kebutuhan',
			'kebutuhan',
			'required',
			array('required'	=> 'Jumlah Kebutuhan / Kota harus diisi')
		);
		$valid->set_rules(
			'ket',
			'ket',
			'required',
			array('required'	=> 'Keterangan / Kota harus diisi')
		);
		if ($valid->run() == FALSE) {
			$data = array(
				'title' 	=> 'Add Rekomendasi',
				'listrekom'	=> $listrekom,
				'isi' 		=> 'admin/daerahrawan/editrekom'
			);
			$this->load->view('admin/layout/wrapper', $data);
		} else {
			$i = $this->input;
			$data = array(
				'id'				=> $idrekom,
				'jenis_rekom'		=> $i->post('jenisrekom'),
				'satuan'			=> $i->post('satuan'),
				'jml_kebutuhan'		=> $i->post('kebutuhan'),
				'ket'				=> $i->post('ket'),
				'status'			=> 0,
				'lat'				=> $i->post('korx'),
				'lang'				=> $i->post('kory')
			);
			$this->daerahrawan_model->editrekomdrk($data);
			$this->session->set_flashdata('sukses', 'Berhasil ditambah');
			$this->session->set_flashdata('tab', 'rekom');
			redirect(base_url('admin/daerahrawan/details/' . $iddrk));
		}
		// echo json_encode($listrekom);
	}

	public function tanganirekom($iddrk, $idrekom)
	{
		$i = $this->input;
		$data = array(
			'id'			=> $idrekom,
			'jml_terpasang'	=> $i->post('terpasang'),
			'status'		=> 1
		);
		$this->daerahrawan_model->editrekomdrk($data);
		$this->session->set_flashdata('sukses', 'Status Rekom Berhasil Dirubah');
		$this->session->set_flashdata('tab', 'rekom');
		redirect(base_url('admin/daerahrawan/details/') . $iddrk);
		// echo $iddrk . $idrekom;
	}

	public function deleterekom($iddrk, $idrekom)
	{
		$data = array('id' => $idrekom);
		$this->daerahrawan_model->deleterekom($data);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		$this->session->set_flashdata('tab', 'rekom');
		redirect(base_url('admin/daerahrawan/details/') . $iddrk);
	}

	public function kejadianadd($id)
	{
		$i = $this->input;
		$data = array(
			'kd_daerah'		=> $id,
			'tahun'			=> $i->post('tahun'),
			'jml_kejadian'	=> $i->post('jmlkejadian'),
			'md'			=> $i->post('md'),
			'lb'			=> $i->post('lb'),
			'lr'			=> $i->post('lr'),
			'materil'		=> $i->post('materil'),
		);
		$this->daerahrawan_model->addkejadiandrk($data);
		$this->session->set_flashdata('sukses', 'Berhasil ditambah');
		$this->session->set_flashdata('tab', 'kejadian');
		redirect(base_url('admin/daerahrawan/details/') . $id);
	}

	public function kejadianedit($iddrk, $idkejadian)
	{
		$i = $this->input;
		$data = array(
			'id_kejadian' 	=> $idkejadian,
			'tahun'			=> $i->post('tahun'),
			'jml_kejadian'	=> $i->post('jmlkejadian'),
			'md'			=> $i->post('md'),
			'lb'			=> $i->post('lb'),
			'lr'			=> $i->post('lr'),
			'materil'		=> $i->post('materil'),
		);
		$this->daerahrawan_model->editkejadiandrk($data);
		$this->session->set_flashdata('sukses', 'Berhasil dirubah');
		$this->session->set_flashdata('tab', 'kejadian');
		redirect(base_url('admin/daerahrawan/details/') . $iddrk);
	}

	public function deletekejadian($iddrk, $idkejadian)
	{
		$data = array('id_kejadian' => $idkejadian);
		$this->daerahrawan_model->deletekejadian($data);
		$this->session->set_flashdata('sukses', 'Berhasil dihapus');
		$this->session->set_flashdata('tab', 'kejadian');
		redirect(base_url('admin/daerahrawan/details/') . $iddrk);
	}

	public function denied403()
	{
		$data = array(
			'title' 		=> 'Akses Ditolak',
			'isi' 		=> 'admin/daerahrawan/403'
		);
		$this->load->view('admin/layout/wrapper', $data);
	}
}
