<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kebutuhanjalan extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library(array('excel'));
		$this->load->model('kebutuhanjalan_model');
	}


	public function index(){
		$list		=  $this->kebutuhanjalan_model->getkebutuhan();
		$data 		= array('title' 		=> 'Kebutuhan jalan',
							'list'			=> $list,
							'isi'			=> 'admin/kebutuhanjalan/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	

	public function import_excel(){
		
		if ($_FILES["fileExcel"]["name"] != '') {
			// print_r('tes');exit();
			$path = $_FILES["fileExcel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();	
				for($row=2; $row<=$highestRow; $row++)
				{
					$nm_daerah 		= $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$lat 			= $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$lang 			= $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$ket_daerah 	= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$ket_daerah 	= $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$status 		= $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$temp_data[] = array(
						'nm_daerah'		=> $nm_daerah,
						'lat'			=> $lat,
						'lang'			=> $lang,
						'ket_daerah'	=> $ket_daerah,
						'status'	=> $status
					); 	
				}
			}
			// print_r($temp_data);exit();
			$insert = $this->kebutuhanjalan_model->addkebutuhan($temp_data);
			if($insert){
				$this->session->set_flashdata('sukses', 'Data Berhasil di Import ke Database');
				redirect($_SERVER['HTTP_REFERER']);
			}else{
				$this->session->set_flashdata('error', 'Terjadi Kesalahan');
				redirect(base_url('admin/kebutuhanjalan/'));
			}
		}else{
			// print_r('tes1');exit();
			$this->session->set_flashdata('error', 'Tidak ada file yang masuk');
			redirect(base_url('admin/kebutuhanjalan/'));
			// echo "Tidak ada file yang masuk";
		}
	}

	public function edit($kd){
      	$kebjln 	= $this->kebutuhanjalan_model->detailkebutuhan($kd);
		// print_r($kebjln->lat);exit();

      	$valid 		= $this->form_validation;
		$valid->set_rules('korx','korx','required',
						array('required'	=> 'Koordinat X harus diisi'));
		$valid->set_rules('kory','kory','required',
						array('required'	=> 'Koordinat Y harus diisi'));
      	if($valid->run()==FALSE){
         	$data = array( 'title'  	=> 'Edit Kebutuhan Jalan',
                        	'kebjln' 	=> $kebjln,
                        	'isi'    	=> 'admin/kebutuhanjalan/edit');
         	$this->load->view('admin/layout/wrapper',$data);
      	}else{
      		if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/kebutuhanjalan/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg|xlsx|xls';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array(	'title' 	=> 'Edit Kebutuhan Jalan',
									'kebjln' 	=> $kebjln,
									'error'		=> $this->upload->display_errors(),
									'isi'		=> 'admin/kebutuhanjalan/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data				= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/kebutuhanjalan/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/kebutuhanjalan/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= FALSE;
					$config['width'] 				= 350;
					$config['height'] 			= 350;
					$config['x_axis'] 			= 0;
					$config['y_axis'] 			= 0;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					if($kebjln->img_daerah != ""){
						unlink('./assets/upload/kebutuhanjalan/'.$kebjln->img_daerah);
						unlink('./assets/upload/kebutuhanjalan/thumbs/'.$kebjln->img_daerah);
					}

					$i = $this->input;
					// print_r($i);exit();
					$data = array(		'no'				=> $kd,
										'nm_daerah'			=> $i->post('nmdaerah'),
										'ket_daerah'		=> $i->post('ket'),
										'img_daerah'		=> $upload_data['uploads']['file_name'],
										'status'			=> $i->post('status'),
										'lat'				=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->kebutuhanjalan_model->editkebutuhan($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/kebutuhanjalan/'));
				}
			}else{
				$i = $this->input;
				$data = array(	'no'				=> $kd,
								'nm_daerah'			=> $i->post('nmdaerah'),
								'ket_daerah'		=> $i->post('ket'),
								'status'			=> $i->post('status'),
								'lat'				=> $i->post('korx'),
								'lang'				=> $i->post('kory'));
				$this->kebutuhanjalan_model->editkebutuhan($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/kebutuhanjalan/'));
			}
      	}
   }

	public function delete($kd){
		$kebjln 	= $this->kebutuhanjalan_model->detailkebutuhan($kd);
		// print_r($kebjln);exit();
		if($kebjln->img_daerah != null){
			unlink('./assets/upload/kebutuhanjalan/'.$kebjln->img_daerah);
			unlink('./assets/upload/kebutuhanjalan/thumbs/'.$kebjln->img_daerah);
		}

		$data 		= array('no' => $kd);

      	$this->kebutuhanjalan_model->deletekebutuhan($data);
      	$this->session->set_flashdata('sukses','Berhasil dihapus');
		redirect(base_url('admin/kebutuhanjalan/'));
  	}



}
