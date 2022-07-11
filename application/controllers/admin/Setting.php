<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->load->model('setting_model');
	}

	public function index(){
		$setting 	= $this->setting_model->detail();
		$valid 		= $this->form_validation;
		$valid->set_rules('nmwebsite','Nama Website','required',
						array('required'	=> 'Nama Website harus diisi'));
		$valid->set_rules('deskripsi','Deskripsi','required',
						array('required'	=> 'Deskripsi Website harus diisi'));
		
		if($valid->run()) {
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/image/';
				$config['allowed_types'] 	= 'gif|jpg|png|svg';
				$config['max_size']			= '200';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 		=> 'Setting`',
										'setting'	=> $setting,
										'error'		=> $this->upload->display_errors(),
										'isi'			=>	'admin/setting/list');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= TRUE;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					if($setting->logo_website != ""){
						unlink('./assets/upload/image/'.$setting->logo_website);
					}
					
					$i = $this->input;
					$data = array('id_setting'			=> '1',
										'nm_website'		=> $i->post('nmwebsite'),
										'desk_website'		=> $i->post('deskripsi'),
										'about'				=> $i->post('about'),
										'telp_website'		=> $i->post('telpwebsite'),
										'email_website'	=> $i->post('emailwebsite'),
										'almt_website'		=> $i->post('almtwebsite'),
										'maps_location'	=> $i->post('maps'),
										'tag_website'		=> $i->post('tags'),
										'logo_website'		=> $upload_data['uploads']['file_name'],
										'online'				=>	$i->post('online'));
					$this->setting_model->edit($data);
					$this->session->set_flashdata('sukses','Berhasil disimpan');
					redirect(base_url('admin/setting'));
				}
			}else{
				$i = $this->input;
	         $data = array('id_setting'			=> '1',
									'nm_website'		=> $i->post('nmwebsite'),
									'desk_website'		=> $i->post('deskripsi'),
									'about'				=> $i->post('about'),
									'tag_website'		=> $i->post('tags'),
									'telp_website'		=> $i->post('telpwebsite'),
									'email_website'	=> $i->post('emailwebsite'),
									'almt_website'		=> $i->post('almtwebsite'),
									'maps_location'	=> $i->post('maps'),
									'online'				=>	$i->post('online'));
				$this->setting_model->edit($data);
				$this->session->set_flashdata('sukses','Berhasil disimpan');
				redirect(base_url('admin/setting'));
			}
		}
		$data = array('title' 		=> 'Setting',
							'setting'	=> $setting,
							'isi'			=>	'admin/setting/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function tagline(){
		$tagline 	= $this->setting_model->detail();		
		if(!empty($_POST)){
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/image/';
				$config['allowed_types'] 	= 'gif|jpg|png|svg';
				$config['max_size']			= '200';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 		=> 'Tag Line',
										'tagline'	=> $tagline,
										'error'		=> $this->upload->display_errors(),
										'isi'			=>	'admin/setting/tagline');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/image/'.$upload_data['uploads']['file_name']; 
					$config['quality'] 			= "70%";
					$config['maintain_ratio'] 	= TRUE;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					if($tagline->home_img != ""){
						unlink('./assets/upload/image/'.$tagline->home_img);
					}
					
					$i = $this->input;
					$data = array('id_setting'		=> '1',
										'home_text'		=> $i->post('tagline'),
										'home_tag'		=> $i->post('detail'),
										'home_img'		=> $upload_data['uploads']['file_name']);
					$this->setting_model->edit($data);
					$this->session->set_flashdata('sukses','Berhasil disimpan');
					redirect(base_url('admin/tagline'));
				}
			}else{
				$i = $this->input;
	         $data = array('id_setting'		=> '1',
									'home_text'		=> $i->post('tagline'),
									'home_tag'		=> $i->post('detail'));
				$this->setting_model->edit($data);
				$this->session->set_flashdata('sukses','Berhasil disimpan');
				redirect(base_url('admin/tagline'));
			}
		}
		$data = array('title' 		=> 'Tag Line',
							'tagline'	=> $tagline,
							'isi'			=>	'admin/setting/tagline');
		$this->load->view('admin/layout/wrapper',$data);
	}
}