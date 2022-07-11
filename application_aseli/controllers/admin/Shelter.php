<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelter extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('shelter_model');
	}
	
	public function index(){
		$list = $this->shelter_model->listing();
		$data = array('title' 	=> 'Shelter',
							'list'	=> $list,
							'isi'		=> 'admin/shelter/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$valid = $this->form_validation;
		$valid->set_rules('nmshelter','nmshelter','required',
						array('required'	=> 'Nama Shelter harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Shelter',
								'isi' 		=> 'admin/shelter/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/shelter/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 		=> 'Add Shelter',
										'error'		=> $this->upload->display_errors(),
										'isi' 		=> 'admin/shelter/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/shelter/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/shelter/thumbs/';
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
					$data = array('nm_shelter'		=> $i->post('nmshelter'),
										'img_shelter'	=> $upload_data['uploads']['file_name'],
										'status'			=> $i->post('status'),
										'tipe'			=> $i->post('tipe'),
										'arah'			=> $i->post('arah'),
										'lat'				=> $i->post('korx'),
										'lang'			=> $i->post('kory'));
					$this->shelter_model->addshelter($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/shelter'));
				}
			}else{
				$i = $this->input;
				$data = array('nm_shelter'		=> $i->post('nmshelter'),
									'status'			=> $i->post('status'),
									'tipe'			=> $i->post('tipe'),
									'arah'			=> $i->post('arah'),
									'lat'				=> $i->post('korx'),
									'lang'			=> $i->post('kory'));
				$this->shelter_model->addshelter($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/shelter'));
			}			
		}
	}

	public function edit($id){
      $shelter = $this->shelter_model->detailshelter($id);
      $valid = $this->form_validation;
		$valid->set_rules('nmshelter','nmshelter','required',
						array('required'	=> 'Nama Shelter harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  	=> 'Edit Shelter',
                        'shelter' 	=> $shelter,
                        'isi'    	=> 'admin/shelter/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/shelter/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 		=> 'Edit shelter',
										'shelter'	=> $shelter,
                        		'kabkota' 	=> $kabkota,
										'error'		=> $this->upload->display_errors(),
										'isi'			=> 'admin/shelter/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/shelter/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/shelter/thumbs/';
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
					
					if($shelter->img_shelter != ""){
						unlink('./assets/upload/shelter/'.$shelter->img_shelter);
						unlink('./assets/upload/shelter/thumbs/'.$shelter->img_shelter);
					}

					$i = $this->input;
					$data = array('kd_shelter'		=> $id,
										'nm_shelter'	=> $i->post('nmshelter'),
										'img_shelter'	=> $upload_data['uploads']['file_name'],
										'status'			=> $i->post('status'),
										'tipe'			=> $i->post('tipe'),
										'arah'			=> $i->post('arah'),
										'lat'				=> $i->post('korx'),
										'lang'			=> $i->post('kory'));
					$this->shelter_model->editshelter($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/shelter'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_shelter'		=> $id,
									'nm_shelter'	=> $i->post('nmshelter'),
									'status'			=> $i->post('status'),
									'tipe'			=> $i->post('tipe'),
									'arah'			=> $i->post('arah'),
									'lat'				=> $i->post('korx'),
									'lang'			=> $i->post('kory'));
				$this->shelter_model->editshelter($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/shelter'));
			}
      }
   }

   public function delete($id){
		$shelter = $this->shelter_model->detailshelter($id);
		if($shelter->img_shelter != null){
			unlink('./assets/upload/shelter/'.$shelter->img_shelter);
			unlink('./assets/upload/shelter/thumbs/'.$shelter->img_shelter);
		}
		$data = array('kd_shelter' => $id);
      $this->shelter_model->deleteshelter($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/shelter'));
   }
}