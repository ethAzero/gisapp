<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdp extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('sdp_model');
		$this->load->model('balai_model');
		$this->load->model('kabkota_model');
	}
	
	public function index(){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')){
			$list = $this->sdp_model->listing();
		}else{
			$list = $this->sdp_model->loginbatas();	
		}
		$data = array('title' 	=> 'sdp',
							'list'	=> $list,
							'isi'		=> 'admin/sdp/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')){
			$kabkota = $this->kabkota_model->listing();
		}else{
			$kabkota = $this->kabkota_model->loginbatas();	
		}
		$valid = $this->form_validation;
		$valid->set_rules('kabkota','kabkota','required',
						array('required'	=> 'Nama Kabupaten / Kota harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add sdp',
								'kabkota'	=> $kabkota,
								'isi' 		=> 'admin/sdp/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/sdp/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 		=> 'Add sdp',
										'kabkota'	=> $kabkota,
										'error'		=> $this->upload->display_errors(),
										'isi' 		=> 'admin/sdp/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/sdp/'.$upload_data['uploads']['file_name']; 
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
					$data = array('kd_kabkota'			=> $i->post('kabkota'),
										'nm_sdp'		=> $i->post('nmsdp'),
										'img_sdp'		=> $upload_data['uploads']['file_name'],
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->sdp_model->addsdp($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/sdp'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_kabkota'			=> $i->post('kabkota'),
									'nm_sdp'		=> $i->post('nmsdp'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->sdp_model->addsdp($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/sdp'));
			}			
		}
	}

	public function edit($id){
      $hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')){
			$kabkota = $this->kabkota_model->listing();
		}else{
			$kabkota = $this->kabkota_model->loginbatas();	
		}
      $sdp = $this->sdp_model->detailsdp($id);
      $valid = $this->form_validation;
		$valid->set_rules('kabkota','kabkota','required',
						array('required'	=> 'Kabupaten / Kota harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  	=> 'Edit sdp',
                        'sdp' 	=> $sdp,
                        'kabkota' 	=> $kabkota,
                        'isi'    	=> 'admin/sdp/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/sdp/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 		=> 'Edit sdp',
										'sdp'	=> $sdp,
                        		'kabkota' 	=> $kabkota,
										'error'		=> $this->upload->display_errors(),
										'isi'			=> 'admin/sdp/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/sdp/'.$upload_data['uploads']['file_name']; 
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
					
					if($sdp->img_sdp != ""){
						unlink('./assets/upload/sdp/'.$sdp->img_sdp);
						unlink('./assets/upload/sdp/thumbs/'.$sdp->img_sdp);
					}

					$i = $this->input;
					$data = array('kd_sdp'		=> $id,
										'kd_kabkota'	=> $i->post('kabkota'),
										'nm_sdp'	=> $i->post('nmsdp'),
										'img_sdp'	=> $upload_data['uploads']['file_name'],
										'lat'				=> $i->post('korx'),
										'lang'			=> $i->post('kory'));
					$this->sdp_model->editsdp($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/sdp'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_sdp'		=> $id,
									'kd_kabkota'	=> $i->post('kabkota'),
									'nm_sdp'	=> $i->post('nmsdp'),
									'lat'				=> $i->post('korx'),
									'lang'			=> $i->post('kory'));
				$this->sdp_model->editsdp($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/sdp'));
			}
      }
   }

   public function delete($id){
		$sdp = $this->sdp_model->detailsdp($id);
		if($sdp->img_sdp != null){
			unlink('./assets/upload/sdp/'.$sdp->img_sdp);
			unlink('./assets/upload/sdp/thumbs/'.$sdp->img_sdp);
		}
		$data = array('kd_sdp' => $id);
      $this->sdp_model->deletesdp($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/sdp'));
   }
}