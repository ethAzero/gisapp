<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Daerahrawan extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('daerahrawan_model');
		$this->load->model('balai_model');
		$this->load->model('kabkota_model');
		$this->load->model('delinator_model');
		$this->load->model('jalan_model');
	}

	
	public function index(){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$list = $this->daerahrawan_model->listing();
		}else{
			$list = $this->daerahrawan_model->loginbatas();	
		}
		$data = array('title' 	=> 'Daerah Rawan',
							'list'	=> $list,
							'isi'		=> 'admin/daerahrawan/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$kabkota = $this->kabkota_model->listing();
		}else{
			$kabkota = $this->kabkota_model->loginbatas();	
		}
		$jalan = $this->daerahrawan_model->getjalan();	
		// print_r($jalan);exit();
		$valid = $this->form_validation;
		$valid->set_rules('kabkota','kabkota','required',
						array('required'	=> 'Nama Kabupaten / Kota harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Daerah Rawan',
								'kabkota'	=> $kabkota,
								'jln'		=> $jalan,
								'isi' 		=> 'admin/daerahrawan/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/daerahrawan/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 		=> 'Add Dae Rahrawan',
										'kabkota'	=> $kabkota,
										'error'		=> $this->upload->display_errors(),
										'isi' 		=> 'admin/daerahrawan/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/daerahrawan/'.$upload_data['uploads']['file_name']; 
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
					$data = array('kd_kabkota'			=> $i->post('kabkota'),
										'nm_daerah'			=> $i->post('nmdaerah'),
										'img_daerah'		=> $upload_data['uploads']['file_name'],
										'ket_daerah'		=> $i->post('ket'),
										'kd_jalan'			=> $i->post('jalan'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->daerahrawan_model->adddaerahrawan($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/daerahrawan'));
				}
			}else{
				// print_r($_POST);exit(); 
				$i = $this->input;
				$data = array('kd_kabkota'			=> $i->post('kabkota'),
									'nm_daerah'			=> $i->post('nmdaerah'),
									'ket_daerah'		=> $i->post('ket'),
									'kd_jalan'			=> $i->post('jalan'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->daerahrawan_model->adddaerahrawan($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/daerahrawan'));
			}			
		}
	}

	public function edit($id){
      $hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$kabkota = $this->kabkota_model->listing();
		}else{
			$kabkota = $this->kabkota_model->loginbatas();	
		}

		$jalan = $this->daerahrawan_model->getjalan();	
		// print_r($jalan);exit();
      	$daerahrawan 	= $this->daerahrawan_model->detaildaerahrawan($id);
      	$listddrk 		= $this->daerahrawan_model->list_detaildaerah($id);
      	// print_r($listddrk);exit();
      	$valid = $this->form_validation;
		$valid->set_rules('kabkota','kabkota','required',
						array('required'	=> 'Kabupaten / Kota harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  		=> 'Edit Daerah Rawan',
                        'daerahrawan' 	=> $daerahrawan,
                        'kabkota' 		=> $kabkota,
                        'jln' 			=> $jalan,
                        'list_ddrk' 	=> $listddrk,
                        'isi'    		=> 'admin/daerahrawan/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/daerahrawan/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '500';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 			=> 'Edit Daerah Rawan',
										'daerahrawan'	=> $daerahrawan,
                        				'kabkota' 		=> $kabkota,
                        				'jln' 			=> $$jalan,
										'error'			=> $this->upload->display_errors(),
										'isi'				=> 'admin/daerahrawan/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/daerahrawan/'.$upload_data['uploads']['file_name']; 
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
					
					if($daerahrawan->img_daerah != ""){
						unlink('./assets/upload/daerahrawan/'.$daerahrawan->img_daerah);
						unlink('./assets/upload/daerahrawan/thumbs/'.$daerahrawan->img_daerah);
					}

					$i = $this->input;
					$data = array('kd_daerah'			=> $id,
										'kd_kabkota'		=> $i->post('kabkota'),
										'nm_daerah'			=> $i->post('nmdaerah'),
										'img_daerah'		=> $upload_data['uploads']['file_name'],
										'ket_daerah'		=> $i->post('ket'),
										'kd_jalan'			=> $i->post('jalan'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->daerahrawan_model->editdaerahrawan($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/daerahrawan'));
				}
			}else{
				$i = $this->input;
				$data = array('kd_daerah'			=> $id,
									'kd_kabkota'		=> $i->post('kabkota'),
									'nm_daerah'			=> $i->post('nmdaerah'),
									'ket_daerah'		=> $i->post('ket'),
									'kd_jalan'			=> $i->post('jalan'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->daerahrawan_model->editdaerahrawan($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/daerahrawan'));
			}
      }
   }



   	public function add_ddrk($id){
      $hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$kabkota = $this->kabkota_model->listing();
		}else{
			$kabkota = $this->kabkota_model->loginbatas();	
		}

		$jalan = $this->daerahrawan_model->getjalan();	
		// print_r($jalan);exit();
      	$daerahrawan 	= $this->daerahrawan_model->detaildaerahrawan($id);
      	$listddrk 		= $this->daerahrawan_model->list_detaildaerah($id);
      	// print_r($listddrk);exit();
      	$valid = $this->form_validation;
		$valid->set_rules('kabkota','kabkota','required',
						array('required'	=> 'Kabupaten / Kota harus diisi'));
      
   	}



   public function delete($id){
		$daerahrawan = $this->daerahrawan_model->detaildaerahrawan($id);
		if($daerahrawan->img_daerah != null){
			unlink('./assets/upload/daerahrawan/'.$daerahrawan->img_daerah);
			unlink('./assets/upload/daerahrawan/thumbs/'.$daerahrawan->img_daerah);
		}
		$data = array('kd_daerah' => $id);
      $this->daerahrawan_model->deletedaerahrawan($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/daerahrawan'));
   }


 //   	public function cetak($kd){
	// 	$delinator = $this->delinator_model->cetakpdf($kd);

	// 	$jalan = $this->jalan_model->detail($kd);
	// 	$data = array(	'nama'		=> 'Delinator',
	// 				  	'delinator'	=> $delinator,
	// 					'jalan' 	=> $jalan);
	// 	$this->load->view('admin/delinator/print', $data);
	// }

	public function cetak(){
   		
		$list = $this->daerahrawan_model->listing1();
		
		// print_r($list);exit();	
		$data = array(	'nama'		=> 'Daerah Rawan',
					  	'list'		=> $list);
		$this->load->view('admin/daerahrawan/print', $data);
	}
}