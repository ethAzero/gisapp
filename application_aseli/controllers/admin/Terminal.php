<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Terminal extends CI_Controller{



	public function __construct(){

		parent::__construct();

		$this->load->model('terminal_model');

		$this->load->model('balai_model');

		$this->load->model('kabkota_model');

	}

	

	public function index(){

		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'JT')){

			$list = $this->terminal_model->listing();

		}else{

			$list = $this->terminal_model->loginbatas();	

		}

		$data = array('title' 	=> 'Terminal',

							'list'	=> $list,

							'isi'		=> 'admin/terminal/list');

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

			$data = array(	'title' 		=> 'Add Terminal',

								'kabkota'	=> $kabkota,

								'isi' 		=> 'admin/terminal/add');

			$this->load->view('admin/layout/wrapper',$data);

		}else{

			if (!empty($_FILES['gambar']['name'])){

				$config['upload_path'] 		= './assets/upload/terminal/';

				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';

				$config['max_size']			= '500';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('gambar')){

					$data = array(	'title' 		=> 'Add Terminal',

										'kabkota'	=> $kabkota,

										'error'		=> $this->upload->display_errors(),

										'isi' 		=> 'admin/terminal/add');

					$this->load->view('admin/layout/wrapper',$data);

				}else{

					$upload_data					= array('uploads' =>$this->upload->data());

					$config['image_library']	= 'gd2';

					$config['encrypt_name'] 	= TRUE;

					$config['source_image'] 	= './assets/upload/terminal/'.$upload_data['uploads']['file_name']; 

					$config['new_image'] 		= './assets/upload/terminal/thumbs/';

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

										'nm_terminal'		=> $i->post('nmterminal'),

										'img_terminal'		=> $upload_data['uploads']['file_name'],

										'lat'					=> $i->post('korx'),

										'lang'				=> $i->post('kory'));

					$this->terminal_model->addterminal($data);

					$this->session->set_flashdata('sukses','Berhasil ditambah');

					redirect(base_url('admin/terminal'));

				}

			}else{

				$i = $this->input;

				$data = array('kd_kabkota'			=> $i->post('kabkota'),

									'nm_terminal'		=> $i->post('nmterminal'),

									'lat'					=> $i->post('korx'),

									'lang'				=> $i->post('kory'));

				$this->terminal_model->addterminal($data);

				$this->session->set_flashdata('sukses','Berhasil ditambah');

				redirect(base_url('admin/terminal'));

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

      $terminal = $this->terminal_model->detailterminal($id);

      $valid = $this->form_validation;

		$valid->set_rules('kabkota','kabkota','required',

						array('required'	=> 'Kabupaten / Kota harus diisi'));

      if($valid->run()==FALSE){

         $data = array( 'title'  	=> 'Edit Terminal',

                        'terminal' 	=> $terminal,

                        'kabkota' 	=> $kabkota,

                        'isi'    	=> 'admin/terminal/edit');

         $this->load->view('admin/layout/wrapper',$data);

      }else{

      	if (!empty($_FILES['gambar']['name'])){

				$config['upload_path'] 		= './assets/upload/terminal/';

				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';

				$config['max_size']			= '500';

				$this->load->library('upload', $config);

				if(! $this->upload->do_upload('gambar')) {

					$data = array('title' 		=> 'Edit Terminal',

										'terminal'	=> $terminal,

                        		'kabkota' 	=> $kabkota,

										'error'		=> $this->upload->display_errors(),

										'isi'			=> 'admin/terminal/edit');

					$this->load->view('admin/layout/wrapper',$data);

				}else{

					$upload_data					= array('uploads' =>$this->upload->data());

					$config['image_library']	= 'gd2';

					$config['encrypt_name'] 	= TRUE;

					$config['source_image'] 	= './assets/upload/terminal/'.$upload_data['uploads']['file_name']; 

					$config['new_image'] 		= './assets/upload/terminal/thumbs/';

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

					

					if($terminal->img_terminal != ""){

						unlink('./assets/upload/terminal/'.$terminal->img_terminal);

						unlink('./assets/upload/terminal/thumbs/'.$terminal->img_terminal);

					}



					$i = $this->input;

					$data = array('kd_terminal'		=> $id,

										'kd_kabkota'		=> $i->post('kabkota'),

										'nm_terminal'		=> $i->post('nmterminal'),

										'img_terminal'		=> $upload_data['uploads']['file_name'],

										'lat'					=> $i->post('korx'),

										'lang'				=> $i->post('kory'));

					$this->terminal_model->editterminal($data);

					$this->session->set_flashdata('sukses','Berhasil diubah');

					redirect(base_url('admin/terminal'));

				}

			}else{

				$i = $this->input;

				$data = array('kd_terminal'		=> $id,

									'kd_kabkota'		=> $i->post('kabkota'),

									'nm_terminal'		=> $i->post('nmterminal'),

									'lat'					=> $i->post('korx'),

									'lang'				=> $i->post('kory'));

				$this->terminal_model->editterminal($data);

				$this->session->set_flashdata('sukses','Berhasil diubah');

				redirect(base_url('admin/terminal'));

			}

      }

   }



   public function delete($id){

		$terminal = $this->terminal_model->detailterminal($id);

		if($terminal->img_terminal != null){

			unlink('./assets/upload/terminal/'.$terminal->img_terminal);

			unlink('./assets/upload/terminal/thumbs/'.$terminal->img_terminal);

		}

		$data = array('kd_terminal' => $id);

      $this->terminal_model->deleteterminal($data);

      $this->session->set_flashdata('sukses','Berhasil dihapus');

      redirect(base_url('admin/terminal'));

   }



   public function exportexcel(){

		$balai = $this->balai_model->listing();

		$data = array(	'title' 	=> 'Terminal Tipe B Provinsi Jawa Tengah',

							'balai' 	=> $balai);

		$this->load->view('admin/terminal/excel',$data);

  	}

}