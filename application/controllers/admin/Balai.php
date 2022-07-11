<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balai extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('balai_model');
	}
	
	public function index(){
		$balai = $this->balai_model->listing();
		$data = array('title' 	=> 'Balai',
							'balai'	=> $balai,
							'isi'		=> 'admin/balai/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$valid = $this->form_validation;
		$valid->set_rules('kdbalai','kdbalai','required',
						array('required'	=> 'Kode Balai harus diisi'));
		$valid->set_rules('nmbalai','nmbalai','required',
						array('required'	=> 'Nama Balai harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Balai',
								'isi' 		=> 'admin/balai/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/balai/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 	=> 'Add Balai',
										'error'	=> $this->upload->display_errors(),
										'isi' 	=> 'admin/balai/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/balai/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/balai/thumbs/';
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
					$data = array('kd_balai'		=> $i->post('kdbalai'),
										'nm_balai'		=> $i->post('nmbalai'),
										'almt_balai'	=> $i->post('almtbalai'),
										'telp_balai'	=> $i->post('telpbalai'),
										'img_balai'		=> $upload_data['uploads']['file_name'],
										'lat_balai'		=> $i->post('latitude'),
										'lang_balai'	=> $i->post('longitude'));
					$this->balai_model->addbalai($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/balai'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_balai'		=> $i->post('kdbalai'),
									'nm_balai'		=> $i->post('nmbalai'),
									'almt_balai'	=> $i->post('almtbalai'),
									'telp_balai'	=> $i->post('telpbalai'),
									'lat_balai'		=> $i->post('latitude'),
									'lang_balai'	=> $i->post('longitude'));
				$this->balai_model->addbalai($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/balai'));
			}			
		}
	}

	public function edit($id){
      $balai = $this->balai_model->detailbalai($id);
      $valid = $this->form_validation;
		$valid->set_rules('nmbalai','nmbalai','required',
						array('required'	=> 'Nama Balai harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  => 'Edit Balai',
                        'balai' 	=> $balai,
                        'isi'    => 'admin/balai/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/balai/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 	=> 'Edit Balai',
										'balai'	=>	$balai,
										'error'	=> $this->upload->display_errors(),
										'isi'		=> 'admin/balai/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/balai/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/balai/thumbs/';
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
					
					if($balai->img_balai != ""){
						unlink('./assets/upload/balai/'.$balai->img_balai);
						unlink('./assets/upload/balai/thumbs/'.$balai->img_balai);
					}

					$i = $this->input;
					$data = array('kd_balai'		=> $id,
										'nm_balai'		=> $i->post('nmbalai'),
										'almt_balai'	=> $i->post('almtbalai'),
										'telp_balai'	=> $i->post('telpbalai'),
										'img_balai'		=> $upload_data['uploads']['file_name'],
										'lat_balai'		=> $i->post('latitude'),
										'lang_balai'	=> $i->post('longitude'));
					$this->balai_model->editbalai($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/balai'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_balai'		=> $id,
									'nm_balai'		=> $i->post('nmbalai'),
									'almt_balai'	=> $i->post('almtbalai'),
									'telp_balai'	=> $i->post('telpbalai'),
									'lat_balai'		=> $i->post('latitude'),
									'lang_balai'	=> $i->post('longitude'));
				$this->balai_model->editbalai($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/balai'));
			}
      }
   }

   public function delete($id){
		$balai = $this->balai_model->detailbalai($id);
		if($balai->img_balai != null){
			unlink('./assets/upload/balai/'.$balai->img_balai);
			unlink('./assets/upload/balai/thumbs/'.$balai->img_balai);
		}
		$data = array('kd_balai' => $id);
      $this->balai_model->deletebalai($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/balai'));
   }
}