<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardrail extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('guardrail_model');
		$this->load->model('jalan_model');
		$this->load->model('home_model');
		$this->load->model('dashboard_model');
	}

	public function jalanprovinsi($jalan){
		$jalan = $this->dashboard_model->jalanprovinsi($jalan);
		$data = array('jalan'		=> $jalan);
		$this->load->view('front/jalankml',$data);
	}
	
	public function index(){
		$hak = $this->session->userdata('hakakses');
		$count = $this->home_model->rekapguardrail();
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$jalan = $this->jalan_model->listing();
		}else{
			$jalan = $this->jalan_model->loginbatas();
		}
		$data = array('title' 	=> 'Guardrail',
							'jalan'	=> $jalan,
							'count'	=> $count,
							'isi'		=> 'admin/guardrail/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function detail($balai,$jln){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$listjalan = $this->jalan_model->listing();
		}else{
			$listjalan = $this->jalan_model->loginbatas();
		}
		$jalan = $this->jalan_model->detail($jln);
		$list = $this->guardrail_model->listing($jln);
		$data = array('title' 		=> 'Guardrail - '.$jalan->nm_ruas,
							'list'		=> $list,
							'jalan'		=> $jalan,
							'listjalan'	=> $listjalan,
							'isi'			=> 'admin/guardrail/detail');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add($balai,$jln){
		$jalan = $this->jalan_model->detail($jln);
		$urut = $this->guardrail_model->kodeurut();
		if($urut->urutan == ''){
			$kodeurut = '00001';
		}else{
			$urut2 = ($urut->urutan) +1;
			$kodeurut  = sprintf("%05s", $urut2);
		}
		$valid = $this->form_validation;
		$valid->set_rules('panjang','panjang','required',
						array('required'	=> 'Panjang Guardrail harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Guardrail',
								'jalan'		=> $jalan,
								'isi' 		=> 'admin/guardrail/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/guardrail/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 	=> 'Add Guardrail',
										'error'	=> $this->upload->display_errors(),
										'isi' 	=> 'admin/guardrail/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/guardrail/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/guardrail/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= TRUE;
					$config['width'] 				= 350;
					$config['height'] 			= 350;
					$config['x_axis'] 			= 0;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$i = $this->input;
					$kode = 'GD'.$kodeurut;
					$data = array('kd_guardrail'		=> $kode,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'	=> $i->post('tahun'),
										'panjang'			=> $i->post('panjang'),
										'img_guardrail'	=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->guardrail_model->addguardrail($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/guardrail/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$kode = 'GD'.$kodeurut;
				$data = array('kd_guardrail'		=> $kode,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'	=> $i->post('tahun'),
									'panjang'			=> $i->post('panjang'),
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->guardrail_model->addguardrail($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/guardrail/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}			
		}
	}

	public function edit($jln,$gd){
      $guardrail = $this->guardrail_model->detailguardrail($jln,$gd);
      $jalan = $this->jalan_model->detail($jln);
      $valid = $this->form_validation;
		$valid->set_rules('panjang','panjang','required',
						array('required'	=> 'Panjang Guardrail harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  	=> 'Edit Guardrail',
                        'guardrail' => $guardrail,
                        'jalan' 		=> $jalan,
                        'isi'    	=> 'admin/guardrail/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/guardrail/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 		=> 'Edit Guardrail',
										'guardrail' => $guardrail,
                        		'jalan' 		=> $jalan,
										'error'		=> $this->upload->display_errors(),
										'isi'			=> 'admin/guardrail/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/guardrail/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/guardrail/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= FALSE;
					$config['width'] 				= 350;
					$config['height'] 			= 350;
					$config['x_axis'] 			= 10;
					$config['y_axis'] 			= 10;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					if($guardrail->img_guardrail != ""){
						unlink('./assets/upload/guardrail/'.$guardrail->img_guardrail);
						unlink('./assets/upload/guardrail/thumbs/'.$guardrail->guardrail);
					}

					$i = $this->input;
					$data = array('kd_guardrail'		=> $gd,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'	=> $i->post('tahun'),
										'panjang'			=> $i->post('panjang'),
										'img_guardrail'	=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->guardrail_model->editguardrail($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/guardrail/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$data = array('kd_guardrail'		=> $gd,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'	=> $i->post('tahun'),
									'panjang'			=> $i->post('panjang'),
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->guardrail_model->editguardrail($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/guardrail/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}
      }
   }

	public function delete($jln,$gd){
		$guardrail = $this->guardrail_model->detailguardrail($jln,$gd);
		$jalan = $this->jalan_model->detail($jln);
		if($guardrail->img_guardrail != null){
			unlink('./assets/upload/guardrail/'.$guardrail->img_guardrail);
			unlink('./assets/upload/guardrail/thumbs/'.$guardrail->img_guardrail);
		}
		$data = array('kd_jalan' => $jln,'kd_guardrail' => $gd);
      $this->guardrail_model->deleteguardrail($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/guardrail/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function viewguardrail($id,$jalan) {
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewguardrail($jalan);
		$data = array('title' 		=> 'View Guardrail',
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/guardrail/view');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function tukar($jln,$kd){
      $jalan = $this->jalan_model->detail($jln);
      $i = $this->input;
		$data = array('kd_guardrail'	=> $kd,
							'kd_jalan'		=> $i->post('kdruas'));
		$this->guardrail_model->editguardrail($data);
		$this->session->set_flashdata('sukses','Jalan Berhasil dipindah');
		redirect(base_url('admin/guardrail/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function kml(){
		$guardrail = $this->guardrail_model->koordinatguardrail();
		$data = array('title' 		=> 'kml',
							'guardrail'	=> $guardrail);
		$this->load->view('front/kml',$data);
	}

	function cetak($kd){	
		$guardrail = $this->guardrail_model->cetakpdf($kd);
		$jalan = $this->jalan_model->detail($kd);
		$nmruas = url_title($jalan->nm_ruas, 'dash', TRUE);
		$data = array('nama' 		=> 'Guardrail',
							'guardrail'	=> $guardrail,
							'jalan'		=> $jalan);
		$this->load->view('admin/guardrail/cetak', $data);
		$tgl= date("d-m-Y");
		$html = $this->output->get_output();      
		$this->load->library('Pdf');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan-".strtoupper($data['nama'])."_".$nmruas."_".$tgl.".pdf",array('Attachment'=>0));
	}
}