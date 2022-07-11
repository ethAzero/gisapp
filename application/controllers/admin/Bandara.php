<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Bandara extends CI_Controller{



	public function __construct(){

		parent::__construct();

		$this->load->model('bandara_model');

		$this->load->model('balai_model');

		$this->load->model('kabkota_model');

	}

	

	public function index(){

		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'JT')){

			$list = $this->bandara_model->listing();

		}else{

			$list = $this->bandara_model->loginbatas();	

		}

		$data = array('title' 	=> 'Bandara',

							'list'	=> $list,

							'isi'		=> 'admin/bandara/list');

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

			$data = array(	'title' 		=> 'Add Bandara',

								'kabkota'	=> $kabkota,

								'isi' 		=> 'admin/bandara/add');

			$this->load->view('admin/layout/wrapper',$data);

		}else{

			if (!empty($_FILES['gambar']['name'])){

				$config['upload_path'] 		= './assets/upload/bandara/';

				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';

				$config['max_size']			= '500';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('gambar')){

					$data = array(	'title' 		=> 'Add Bandara',

										'kabkota'	=> $kabkota,

										'error'		=> $this->upload->display_errors(),

										'isi' 		=> 'admin/bandara/add');

					$this->load->view('admin/layout/wrapper',$data);

				}else{

					$upload_data					= array('uploads' =>$this->upload->data());

					$config['image_library']	= 'gd2';

					$config['encrypt_name'] 	= TRUE;

					$config['source_image'] 	= './assets/upload/bandara/'.$upload_data['uploads']['file_name']; 

					$config['new_image'] 		= './assets/upload/bandara/thumbs/';

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

										'nm_bandara'		=> $i->post('nmbandara'),

										'img_bandara'		=> $upload_data['uploads']['file_name'],

										'lat'					=> $i->post('korx'),

										'lang'				=> $i->post('kory'));

					$this->bandara_model->addbandara($data);

					$this->session->set_flashdata('sukses','Berhasil ditambah');

					redirect(base_url('admin/bandara'));

				}

			}else{

				$i = $this->input;

				$data = array('kd_kabkota'			=> $i->post('kabkota'),

									'nm_bandara'		=> $i->post('nmbandara'),

									'lat'					=> $i->post('korx'),

									'lang'				=> $i->post('kory'));

				$this->bandara_model->addbandara($data);

				$this->session->set_flashdata('sukses','Berhasil ditambah');

				redirect(base_url('admin/bandara'));

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

      $bandara = $this->bandara_model->detailbandara($id);

      $valid = $this->form_validation;

		$valid->set_rules('kabkota','kabkota','required',

						array('required'	=> 'Kabupaten / Kota harus diisi'));

      if($valid->run()==FALSE){

         $data = array( 'title'  	=> 'Edit bandara',

                        'bandara' 	=> $bandara,

                        'kabkota' 	=> $kabkota,

                        'isi'    	=> 'admin/bandara/edit');

         $this->load->view('admin/layout/wrapper',$data);

      }else{

      	if (!empty($_FILES['gambar']['name'])){

				$config['upload_path'] 		= './assets/upload/bandara/';

				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';

				$config['max_size']			= '500';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('gambar')) {

					$data = array('title' 		=> 'Edit bandara',

										'bandara'	=> $bandara,

                        		'kabkota' 	=> $kabkota,

										'error'		=> $this->upload->display_errors(),

										'isi'			=> 'admin/bandara/edit');

					$this->load->view('admin/layout/wrapper',$data);

				}else{

					$upload_data					= array('uploads' =>$this->upload->data());

					$config['image_library']	= 'gd2';

					$config['encrypt_name'] 	= TRUE;

					$config['source_image'] 	= './assets/upload/bandara/'.$upload_data['uploads']['file_name']; 

					$config['new_image'] 		= './assets/upload/bandara/thumbs/';

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

					

					if($bandara->img_bandara != ""){

						unlink('./assets/upload/bandara/'.$bandara->img_bandara);

						unlink('./assets/upload/bandara/thumbs/'.$bandara->img_bandara);

					}



					$i = $this->input;

					$data = array('kd_bandara'		=> $id,

										'kd_kabkota'	=> $i->post('kabkota'),

										'nm_bandara'	=> $i->post('nmbandara'),

										'img_bandara'	=> $upload_data['uploads']['file_name'],

										'lat'				=> $i->post('korx'),

										'lang'			=> $i->post('kory'));

					$this->bandara_model->editbandara($data);

					$this->session->set_flashdata('sukses','Berhasil diubah');

					redirect(base_url('admin/bandara'));

				}

			}else{

				$i = $this->input;

				$data = array('kd_bandara'		=> $id,

									'kd_kabkota'	=> $i->post('kabkota'),

									'nm_bandara'	=> $i->post('nmbandara'),

									'lat'				=> $i->post('korx'),

									'lang'			=> $i->post('kory'));

				$this->bandara_model->editbandara($data);

				$this->session->set_flashdata('sukses','Berhasil diubah');

				redirect(base_url('admin/bandara'));

			}

      }

   }



   public function delete($id){

		$bandara = $this->bandara_model->detailbandara($id);

		if($bandara->img_bandara != null){

			unlink('./assets/upload/bandara/'.$bandara->img_bandara);

			unlink('./assets/upload/bandara/thumbs/'.$bandara->img_bandara);

		}

		$data = array('kd_bandara' => $id);

      $this->bandara_model->deletebandara($data);

      $this->session->set_flashdata('sukses','Berhasil dihapus');

      redirect(base_url('admin/bandara'));

   }

}