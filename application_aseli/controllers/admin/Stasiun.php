<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Stasiun extends CI_Controller{



	public function __construct(){

		parent::__construct();

		$this->load->model('stasiun_model');

		$this->load->model('balai_model');

		$this->load->model('kabkota_model');

	}

	

	public function index(){

		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'JT')){

			$list = $this->stasiun_model->listing();

		}else{

			$list = $this->stasiun_model->loginbatas();	

		}

		$data = array('title' 	=> 'Stasiun',

							'list'	=> $list,

							'isi'		=> 'admin/stasiun/list');

		$this->load->view('admin/layout/wrapper',$data);

	}



	public function add(){

		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'JT')){

			$kabkota = $this->kabkota_model->listing();

		}else{

			$kabkota = $this->kabkota_model->loginbatas();	

		}

		$valid = $this->form_validation;

		$valid->set_rules('kabkota','kabkota','required',

						array('required'	=> 'Nama Kabupaten / Kota harus diisi'));

		if($valid->run()==FALSE){

			$data = array(	'title' 		=> 'Add Stasiun',

								'kabkota'	=> $kabkota,

								'isi' 		=> 'admin/stasiun/add');

			$this->load->view('admin/layout/wrapper',$data);

		}else{

			if (!empty($_FILES['gambar']['name'])){

				$config['upload_path'] 		= './assets/upload/stasiun/';

				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';

				$config['max_size']			= '500';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('gambar')){

					$data = array(	'title' 		=> 'Add Stasiun',

										'kabkota'	=> $kabkota,

										'error'		=> $this->upload->display_errors(),

										'isi' 		=> 'admin/stasiun/add');

					$this->load->view('admin/layout/wrapper',$data);

				}else{

					$upload_data					= array('uploads' =>$this->upload->data());

					$config['image_library']	= 'gd2';

					$config['encrypt_name'] 	= TRUE;

					$config['source_image'] 	= './assets/upload/stasiun/'.$upload_data['uploads']['file_name']; 

					$config['new_image'] 		= './assets/upload/stasiun/thumbs/';

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

					$data = array('kd_kabkota'			=> $i->post('kabkota'),

										'nm_stasiun'		=> $i->post('nmstasiun'),

										'img_stasiun'		=> $upload_data['uploads']['file_name'],

										'lat'					=> $i->post('korx'),

										'lang'				=> $i->post('kory'));

					$this->stasiun_model->addstasiun($data);

					$this->session->set_flashdata('sukses','Berhasil ditambah');

					redirect(base_url('admin/stasiun'));

				}

			}else{

				$i = $this->input;

				$data = array('kd_kabkota'			=> $i->post('kabkota'),

									'nm_stasiun'		=> $i->post('nmstasiun'),

									'lat'					=> $i->post('korx'),

									'lang'				=> $i->post('kory'));

				$this->stasiun_model->addstasiun($data);

				$this->session->set_flashdata('sukses','Berhasil ditambah');

				redirect(base_url('admin/stasiun'));

			}			

		}

	}



	public function edit($id){

      $hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'JT')){

			$kabkota = $this->kabkota_model->listing();

		}else{

			$kabkota = $this->kabkota_model->loginbatas();	

		}

      $stasiun = $this->stasiun_model->detailstasiun($id);

      $valid = $this->form_validation;

		$valid->set_rules('kabkota','kabkota','required',

						array('required'	=> 'Kabupaten / Kota harus diisi'));

      if($valid->run()==FALSE){

         $data = array( 'title'  	=> 'Edit Stasiun',

                        'stasiun' 	=> $stasiun,

                        'kabkota' 	=> $kabkota,

                        'isi'    	=> 'admin/stasiun/edit');

         $this->load->view('admin/layout/wrapper',$data);

      }else{

      	if (!empty($_FILES['gambar']['name'])){

				$config['upload_path'] 		= './assets/upload/stasiun/';

				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';

				$config['max_size']			= '500';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('gambar')) {

					$data = array('title' 		=> 'Edit Stasiun',

										'stasiun'	=> $stasiun,

                        		'kabkota' 	=> $kabkota,

										'error'		=> $this->upload->display_errors(),

										'isi'			=> 'admin/stasiun/edit');

					$this->load->view('admin/layout/wrapper',$data);

				}else{

					$upload_data					= array('uploads' =>$this->upload->data());

					$config['image_library']	= 'gd2';

					$config['encrypt_name'] 	= TRUE;

					$config['source_image'] 	= './assets/upload/stasiun/'.$upload_data['uploads']['file_name']; 

					$config['new_image'] 		= './assets/upload/stasiun/thumbs/';

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

					

					if($stasiun->img_stasiun != ""){

						unlink('./assets/upload/stasiun/'.$stasiun->img_stasiun);

						unlink('./assets/upload/stasiun/thumbs/'.$stasiun->img_stasiun);

					}



					$i = $this->input;

					$data = array('kd_stasiun'		=> $id,

										'kd_kabkota'	=> $i->post('kabkota'),

										'nm_stasiun'	=> $i->post('nmstasiun'),

										'img_stasiun'	=> $upload_data['uploads']['file_name'],

										'lat'				=> $i->post('korx'),

										'lang'			=> $i->post('kory'));

					$this->stasiun_model->editstasiun($data);

					$this->session->set_flashdata('sukses','Berhasil diubah');

					redirect(base_url('admin/stasiun'));

				}

			}else{

				$i = $this->input;

				$data = array('kd_stasiun'		=> $id,

									'kd_kabkota'	=> $i->post('kabkota'),

									'nm_stasiun'	=> $i->post('nmstasiun'),

									'lat'				=> $i->post('korx'),

									'lang'			=> $i->post('kory'));

				$this->stasiun_model->editstasiun($data);

				$this->session->set_flashdata('sukses','Berhasil diubah');

				redirect(base_url('admin/stasiun'));

			}

      }

   }



   public function delete($id){

		$stasiun = $this->stasiun_model->detailstasiun($id);

		if($stasiun->img_stasiun != null){

			unlink('./assets/upload/stasiun/'.$stasiun->img_stasiun);

			unlink('./assets/upload/stasiun/thumbs/'.$stasiun->img_stasiun);

		}

		$data = array('kd_stasiun' => $id);

      $this->stasiun_model->deletestasiun($data);

      $this->session->set_flashdata('sukses','Berhasil dihapus');

      redirect(base_url('admin/stasiun'));

   }



   public function exportexcel(){

		$balai = $this->balai_model->listing();

		$data = array(	'title' 	=> 'Stasiun di Provinsi Jawa Tengah',

							'balai' 	=> $balai);

		$this->load->view('admin/stasiun/excel',$data);

  	}

}