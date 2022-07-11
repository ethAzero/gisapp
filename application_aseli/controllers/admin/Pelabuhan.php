<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelabuhan extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('pelabuhan_model');
		$this->load->model('balai_model');
		$this->load->model('kabkota_model');
	}
	
	public function index(){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')){
			$list = $this->pelabuhan_model->listing();
		}else{
			$list = $this->pelabuhan_model->loginbatas();	
		}
		$data = array('title' 	=> 'Pelabuhan',
							'list'	=> $list,
							'isi'		=> 'admin/pelabuhan/list');
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
			$data = array(	'title' 		=> 'Add Pelabuhan',
								'kabkota'	=> $kabkota,
								'isi' 		=> 'admin/pelabuhan/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/pelabuhan/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 		=> 'Add pelabuhan',
										'kabkota'	=> $kabkota,
										'error'		=> $this->upload->display_errors(),
										'isi' 		=> 'admin/pelabuhan/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/pelabuhan/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/pelabuhan/thumbs/';
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
										'nm_pelabuhan'		=> $i->post('nmpelabuhan'),
										'img_pelabuhan'	=> $upload_data['uploads']['file_name'],
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->pelabuhan_model->addpelabuhan($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/pelabuhan'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_kabkota'			=> $i->post('kabkota'),
									'nm_pelabuhan'		=> $i->post('nmpelabuhan'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->pelabuhan_model->addpelabuhan($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/pelabuhan'));
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
      $pelabuhan = $this->pelabuhan_model->detailpelabuhan($id);
      $valid = $this->form_validation;
		$valid->set_rules('kabkota','kabkota','required',
						array('required'	=> 'Kabupaten / Kota harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  	=> 'Edit Pelabuhan',
                        'pelabuhan' => $pelabuhan,
                        'kabkota' 	=> $kabkota,
                        'isi'    	=> 'admin/pelabuhan/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/pelabuhan/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 		=> 'Edit pelabuhan',
										'pelabuhan'	=> $pelabuhan,
                        		'kabkota' 	=> $kabkota,
										'error'		=> $this->upload->display_errors(),
										'isi'			=> 'admin/pelabuhan/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/pelabuhan/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/pelabuhan/thumbs/';
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
					
					if($pelabuhan->img_pelabuhan != ""){
						unlink('./assets/upload/pelabuhan/'.$pelabuhan->img_pelabuhan);
						unlink('./assets/upload/pelabuhan/thumbs/'.$pelabuhan->img_pelabuhan);
					}

					$i = $this->input;
					$data = array('kd_pelabuhan'		=> $id,
										'kd_kabkota'		=> $i->post('kabkota'),
										'nm_pelabuhan'		=> $i->post('nmpelabuhan'),
										'img_pelabuhan'	=> $upload_data['uploads']['file_name'],
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->pelabuhan_model->editpelabuhan($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/pelabuhan'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_pelabuhan'		=> $id,
									'kd_kabkota'		=> $i->post('kabkota'),
									'nm_pelabuhan'		=> $i->post('nmpelabuhan'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->pelabuhan_model->editpelabuhan($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/pelabuhan'));
			}
      }
   }

   public function delete($id){
		$pelabuhan = $this->pelabuhan_model->detailpelabuhan($id);
		if($pelabuhan->img_pelabuhan != null){
			unlink('./assets/upload/pelabuhan/'.$pelabuhan->img_pelabuhan);
			unlink('./assets/upload/pelabuhan/thumbs/'.$pelabuhan->img_pelabuhan);
		}
		$data = array('kd_pelabuhan' => $id);
      $this->pelabuhan_model->deletepelabuhan($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/pelabuhan'));
   }
}