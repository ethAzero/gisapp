<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marka extends CI_Controller{


	public function __construct(){
		parent::__construct();
		$this->load->model('marka_model');
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
		$count = $this->home_model->rekapmarka();
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$jalan = $this->jalan_model->listing();
		}else{
			$jalan = $this->jalan_model->loginbatas();
		}

		$i = $this->input;
		$cari	= $i->post('search');
		if (isset($cari)) {
			
			$sdel 		= $this->marka_model->markabykd($cari);
			$kd_jalan	= $sdel[0]->kd_jalan;
			$jln 		= $this->marka_model->jlnprovbykd($kd_jalan);
			$kd_balai	= $jln->kd_balai;

			$ruas 	= $this->dashboard_model->detailruas($kd_balai,$kd_jalan);
			// $view 	= $this->dashboard_model->viewmarka($jalan);
			$data = array(	'title' 	=> 'View marka',
							'ruas'		=> $ruas,
							'view'		=> $sdel,
							'isi' 		=> 'admin/marka/view_search');
			$this->load->view('admin/layout/wrapper',$data);
			// print_r($jln);exit();
		}else{
			$data = array('title' 	=> 'Marka',
								'jalan'	=> $jalan,
								'count'	=> $count,
								'isi'		=> 'admin/marka/list');
			$this->load->view('admin/layout/wrapper',$data);
		}
	}

	public function detail($balai,$jln){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$listjalan = $this->jalan_model->listing();
		}else{
			$listjalan = $this->jalan_model->loginbatas();
		}
		$jalan = $this->jalan_model->detail($jln);
		$list = $this->marka_model->listing($jln);
		$data = array('title' 		=> 'Marka - '.$jalan->nm_ruas,
							'list'		=> $list,
							'jalan'		=> $jalan,
							'listjalan'	=> $listjalan,
							'isi'			=> 'admin/marka/detail');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add($balai,$jln){
		$jalan = $this->jalan_model->detail($jln);
		$urut = $this->marka_model->kodeurut();
		if($urut->urutan == ''){
			$kodeurut = '00001';
		}else{
			$urut2 = ($urut->urutan) +1;
			$kodeurut  = sprintf("%05s", $urut2);
		}
		$valid = $this->form_validation;
		$valid->set_rules('letak','letak','required',
						array('required'	=> 'Letak Marka harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Marka',
								'jalan'		=> $jalan,
								'isi' 		=> 'admin/marka/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/marka/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 	=> 'Add Marka',
										'error'	=> $this->upload->display_errors(),
										'isi' 	=> 'admin/marka/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/marka/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/marka/thumbs/';
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
					$kode = 'MK'.$kodeurut;
					$data = array('kd_marka'			=> $kode,
										'kd_jalan'			=> $jln,
										'img_marka'	=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->marka_model->addmarka($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/marka/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$kode = 'MK'.$kodeurut;
				$data = array('kd_marka'			=> $kode,
									'kd_jalan'			=> $jln,
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->marka_model->addmarka($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/marka/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}			
		}
	}

	public function edit($jln,$id){
      $marka = $this->marka_model->detailmarka($jln,$id);
      $jalan = $this->jalan_model->detail($jln);
      $valid = $this->form_validation;
		$valid->set_rules('letak','letak','required',
						array('required'	=> 'Letak Marka harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  	=> 'Edit marka',
                        'marka' 		=> $marka,
                        'jalan' 		=> $jalan,
                        'isi'    	=> 'admin/marka/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/marka/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 		=> 'Edit Marka',
										'marka' 		=> $marka,
                        		'jalan' 		=> $jalan,
										'error'		=> $this->upload->display_errors(),
										'isi'			=> 'admin/marka/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/marka/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/marka/thumbs/';
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
					
					if($marka->img_marka != ""){
						unlink('./assets/upload/marka/'.$marka->img_marka);
						unlink('./assets/upload/marka/thumbs/'.$marka->marka);
					}

					$i = $this->input;
					$data = array('kd_marka'			=> $id,
										'kd_jalan'			=> $jln,
										'img_marka'			=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->marka_model->editmarka($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/marka/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$data = array('kd_marka'			=> $id,
									'kd_jalan'			=> $jln,
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->marka_model->editmarka($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/marka/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}
      }
   }



	public function delete($jln,$id){
		$marka = $this->marka_model->detailmarka($jln,$id);
		$jalan = $this->jalan_model->detail($jln);
		if($marka->img_marka != null){
			unlink('./assets/upload/marka/'.$marka->img_marka);
			unlink('./assets/upload/marka/thumbs/'.$marka->img_marka);
		}
		$data = array('kd_jalan' => $jln,'kd_marka' => $id);
      $this->marka_model->deletemarka($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/marka/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function tukar($jln,$kd){
      $jalan = $this->jalan_model->detail($jln);
      $i = $this->input;
		$data = array('kd_marka'	=> $kd,
							'kd_jalan'	=> $i->post('kdruas'));
		$this->marka_model->editmarka($data);
		$this->session->set_flashdata('sukses','Jalan Berhasil dipindah');
		redirect(base_url('admin/marka/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function viewmarka($id,$jalan) {
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewmarka($jalan);
		$data = array('title' 		=> 'View Marka',
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/marka/view');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function cetak($kd){
		$marka = $this->marka_model->cetakpdf($kd);
		$jalan = $this->jalan_model->detail($kd);
		$data = array('nama' 	=> 'Marka',
							'marka'	=> $marka,
							'jalan'	=> $jalan);
		$this->load->view('admin/marka/print', $data);
	}

	// function cetak($kd){	
	// 	$marka = $this->marka_model->cetakpdf($kd);
	// 	$jalan = $this->jalan_model->detail($kd);
	// 	$nmruas = url_title($jalan->nm_ruas, 'dash', TRUE);
	// 	$data = array('nama' 	=> 'Marka',
	// 						'marka'	=> $marka,
	// 						'jalan'	=> $jalan);
	// 	$this->load->view('admin/marka/cetak', $data);
	// 	$tgl= date("d-m-Y");
	// 	$html = $this->output->get_output();      
	// 	$this->load->library('Pdf');
	// 	$this->dompdf->load_html($html);
	// 	$this->dompdf->render();
	// 	$this->dompdf->stream("Laporan-".strtoupper($data['nama'])."_".$nmruas."_".$tgl.".pdf",array('Attachment'=>0));
	// }
}