<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rppj extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('rppj_model');
		$this->load->model('jalan_model');
		$this->load->model('dashboard_model');
		$this->load->model('home_model');
	}

	public function jalanprovinsi($jalan){
		$jalan = $this->dashboard_model->jalanprovinsi($jalan);
		$data = array('jalan'		=> $jalan);
		$this->load->view('front/jalankml',$data);
	}

	public function index(){
		$hak = $this->session->userdata('hakakses');
		$count = $this->home_model->rekaprppj();
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$jalan = $this->jalan_model->listing();
		}else{
			$jalan = $this->jalan_model->loginbatas();
		}

		$i = $this->input;
		$cari	= $i->post('search');
		if (isset($cari)) {
			
			$sdel 		= $this->rppj_model->rppjbykd($cari);
			$kd_jalan	= $sdel[0]->kd_jalan;
			$jln 		= $this->rppj_model->jlnprovbykd($kd_jalan);
			$kd_balai	= $jln->kd_balai;

			$ruas 	= $this->dashboard_model->detailruas($kd_balai,$kd_jalan);
			// $view 	= $this->dashboard_model->viewrppj($jalan);
			$data = array(	'title' 		=> 'View RPPJ',
							'ruas'		=> $ruas,
							'view'		=> $sdel,
							'isi' 		=> 'admin/rppj/view_search');
			$this->load->view('admin/layout/wrapper',$data);
			// print_r($jln);exit();
		}else{
			$data = array('title' 	=> 'RPPJ',
								'jalan'	=> $jalan,
								'count'	=> $count,
								'isi'		=> 'admin/rppj/list');
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
		$list = $this->rppj_model->listing($jln);
		$data = array('title' 		=> 'Rppj - '.$jalan->nm_ruas,
							'list'		=> $list,
							'jalan'		=> $jalan,
							'listjalan'	=> $listjalan,
							'isi'			=> 'admin/rppj/detail');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add($balai,$jln){
		$jalan = $this->jalan_model->detail($jln);
		$urut = $this->rppj_model->kodeurut();
		if($urut->urutan == ''){
			$kodeurut = '00001';
		}else{
			$urut2 = ($urut->urutan) +1;
			$kodeurut  = sprintf("%05s", $urut2);
		}
		$valid = $this->form_validation;
		$valid->set_rules('korx','korx','required',
						array('required'	=> 'Koordinat X harus diisi'));
		$valid->set_rules('kory','kory','required',
						array('required'	=> 'Koordinat Y harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add RPPJ',
								'jalan'		=> $jalan,
								'isi' 		=> 'admin/rppj/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/rppj/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 	=> 'Add RPPJ',
										'error'	=> $this->upload->display_errors(),
										'isi' 	=> 'admin/rppj/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/rppj/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/rppj/thumbs/';
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
					$kode = 'RP'.$kodeurut;
					$data = array('kd_rppj'				=> $kode,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'	=> $i->post('tahun'),
										'km_lokasi	'		=> $i->post('kmlokasi'),
										'jenis'				=> $i->post('jenis'),
										'img_rppj'			=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->rppj_model->addrppj($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/rppj/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$kode = 'RP'.$kodeurut;
				$data = array('kd_rppj'				=> $kode,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'	=> $i->post('tahun'),
									'km_lokasi	'		=> $i->post('kmlokasi'),
									'jenis'				=> $i->post('jenis'),
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->rppj_model->addrppj($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/rppj/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}			
		}
	}

	public function edit($jln,$kd){
      $rppj = $this->rppj_model->detailrppj($jln,$kd);
      $jalan = $this->jalan_model->detail($jln);
      $valid = $this->form_validation;
		$valid->set_rules('korx','korx','required',
						array('required'	=> 'Koordinat X harus diisi'));
		$valid->set_rules('kory','kory','required',
						array('required'	=> 'Koordinat Y harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  => 'Edit RPPJ',
                        'rppj' 	=> $rppj,
                        'jalan' 	=> $jalan,
                        'isi'    => 'admin/rppj/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/rppj/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 	=> 'Edit RPPJ',
										'rppj' 	=> $rppj,
                        		'jalan' 	=> $jalan,
										'error'	=> $this->upload->display_errors(),
										'isi'		=> 'admin/rppj/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/rppj/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/rppj/thumbs/';
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
					
					if($rppj->img_rppj != ""){
						unlink('./assets/upload/rppj/'.$rppj->img_rppj);
						unlink('./assets/upload/rppj/thumbs/'.$rppj->img_rppj);
					}

					$i = $this->input;
					$data = array('kd_rppj'				=> $kd,
										'thn_pengadaan'	=> $i->post('tahun'),
										'km_lokasi	'		=> $i->post('kmlokasi'),
										'jenis'				=> $i->post('jenis'),
										'img_rppj'			=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->rppj_model->editrppj($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/rppj/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$data = array('kd_rppj'				=> $kd,
									'thn_pengadaan'	=> $i->post('tahun'),
									'km_lokasi	'		=> $i->post('kmlokasi'),
									'jenis'				=> $i->post('jenis'),
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->rppj_model->editrppj($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/rppj/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}
      }
   }

   public function delete($jln,$kd){
		$rppj = $this->rppj_model->detailrppj($jln,$kd);
		$jalan = $this->jalan_model->detail($jln);
		if($rppj->img_rppj != null){
			unlink('./assets/upload/rppj/'.$rppj->img_rppj);
			unlink('./assets/upload/rppj/thumbs/'.$rppj->img_rppj);
		}
		$data = array('kd_jalan' => $jln,'kd_rppj' => $kd);
      $this->rppj_model->deleterppj($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
		redirect(base_url('admin/rppj/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function viewrppj($id,$jalan) {
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewrppj($jalan);
		$data = array('title' 		=> 'View RPPJ',
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/rppj/view');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function tukar($jln,$kd){
      $jalan = $this->jalan_model->detail($jln);
      $i = $this->input;
		$data = array('kd_rppj'		=> $kd,
							'kd_jalan'	=> $i->post('kdruas'));
		$this->rppj_model->editrppj($data);
		$this->session->set_flashdata('sukses','Jalan Berhasil dipindah');
		redirect(base_url('admin/rppj/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function kml(){
		$rppj = $this->rppj_model->koordinatrppj();
		$data = array('title' 	=> 'kml',
							'rppj'	=> $rppj);
		$this->load->view('front/kml',$data);
	}

	public function cetak($kd){
		$rppj = $this->rppj_model->cetakpdf($kd);
		$jalan = $this->jalan_model->detail($kd);
		$data = array('nama' 	=> 'RPPJ',
							'rppj'	=> $rppj,
							'jalan'	=> $jalan);
		$this->load->view('admin/rppj/print', $data);
	}

	// function cetak($kd){	
	// 	$rppj = $this->rppj_model->cetakpdf($kd);
	// 	$jalan = $this->jalan_model->detail($kd);
	// 	$nmruas = url_title($jalan->nm_ruas, 'dash', TRUE);
	// 	$data = array('nama' 	=> 'RPPJ',
	// 						'rppj'	=> $rppj,
	// 						'jalan'	=> $jalan);
	// 	$this->load->view('admin/rppj/cetak', $data);
	// 	$tgl= date("d-m-Y");
	// 	$html = $this->output->get_output();      
	// 	$customPaper = array(0,0,210,330);
	// 	$this->load->library('Pdf');
	// 	$this->dompdf->load_html($html);
	// 	$this->dompdf->render();
	// 	$this->dompdf->set_paper($customPaper);
	// 	$this->dompdf->stream("Laporan-".strtoupper($data['nama'])."_".$nmruas."_".$tgl.".pdf",array('Attachment'=>0));
	// }
}