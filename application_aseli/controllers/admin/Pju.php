<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 600);
ini_set('memory_limit', '10240M');
class Pju extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('pju_model');
		$this->load->model('apil_model');
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
		$count = $this->home_model->rekappju();
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$jalan = $this->jalan_model->listing();
		}else{
			$jalan = $this->jalan_model->loginbatas();
		}
		$data = array('title' 	=> 'Penerangan Jalan Umum',
							'jalan'	=> $jalan,
							'count'	=> $count,
							'isi'		=> 'admin/pju/list');
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
		$list = $this->pju_model->listing($jln);
		$data = array('title' 		=> 'Penerangan Jalan Umum - '.$jalan->nm_ruas,
							'list'		=> $list,
							'jalan'		=> $jalan,
							'listjalan'	=> $listjalan,
							'isi'			=> 'admin/pju/detail');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add($balai,$jln){
		$jalan = $this->jalan_model->detail($jln);
		$urut = $this->pju_model->kodeurut();
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
			$data = array(	'title' 		=> 'Add PJU',
								'jalan'		=> $jalan,
								'isi' 		=> 'admin/pju/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/pju/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 	=> 'Add PJU',
										'error'	=> $this->upload->display_errors(),
										'isi' 	=> 'admin/pju/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/pju/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/pju/thumbs/';
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
					$kode = 'PJ'.$kodeurut;
					$data = array('kd_pju'				=> $kode,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'	=> $i->post('tahun'),
										'km_lokasi	'		=> $i->post('kmlokasi'),
										'jenis'				=> $i->post('jenis'),
										'img_pju'			=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->pju_model->addpju($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/pju/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$kode = 'PJ'.$kodeurut;
				$data = array('kd_pju'				=> $kode,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'	=> $i->post('tahun'),
									'km_lokasi	'		=> $i->post('kmlokasi'),
									'jenis'				=> $i->post('jenis'),
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->pju_model->addpju($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/pju/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}			
		}
	}

	public function edit($jln,$kd){
      $pju = $this->pju_model->detailpju($jln,$kd);
      $jalan = $this->jalan_model->detail($jln);
      $valid = $this->form_validation;
		$valid->set_rules('korx','korx','required',
						array('required'	=> 'Koordinat X harus diisi'));
		$valid->set_rules('kory','kory','required',
						array('required'	=> 'Koordinat Y harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  => 'Edit Penerangan Jalan Umum',
                        'pju' 	=> $pju,
                        'jalan' 	=> $jalan,
                        'isi'    => 'admin/pju/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/pju/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 	=> 'Edit Penerangan Jalan Umum',
										'pju' 	=> $pju,
                        		'jalan' 	=> $jalan,
										'error'	=> $this->upload->display_errors(),
										'isi'		=> 'admin/pju/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/pju/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/pju/thumbs/';
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
		
					if($pju->img_pju != ""){
						unlink('./assets/upload/pju/'.$pju->img_pju);
						unlink('./assets/upload/pju/thumbs/'.$pju->img_pju);
					}

					$i = $this->input;
					$data = array('kd_pju'				=> $kd,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'	=> $i->post('tahun'),
										'km_lokasi	'		=> $i->post('kmlokasi'),
										'jenis'				=> $i->post('jenis'),
										'img_pju'			=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->pju_model->editpju($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/pju/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$data = array('kd_pju'				=> $kd,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'	=> $i->post('tahun'),
									'km_lokasi	'		=> $i->post('kmlokasi'),
									'jenis'				=> $i->post('jenis'),
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->pju_model->editpju($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/pju/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}
      }
   }

   public function delete($jln,$kd){
		$pju = $this->pju_model->detailpju($jln,$kd);
		$jalan = $this->jalan_model->detail($jln);
		if($pju->img_pju != null){
			unlink('./assets/upload/pju/'.$pju->img_pju);
			unlink('./assets/upload/pju/thumbs/'.$pju->img_pju);
		}
		$data = array('kd_jalan' => $jln,'kd_pju' => $kd);
      $this->pju_model->deletepju($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/pju/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function viewpju($id,$jalan) {
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewpju($jalan);
		$data = array('title' 		=> 'View Penerangan Jalan Umum',
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/pju/view');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function tukar($jln,$kd){
      $jalan = $this->jalan_model->detail($jln);
      $i = $this->input;
		$data = array('kd_pju'		=> $kd,
							'kd_jalan'	=> $i->post('kdruas'));
		$this->pju_model->editpju($data);
		$this->session->set_flashdata('sukses','Jalan Berhasil dipindah');
		redirect(base_url('admin/pju/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function kml(){
		$pju = $this->pju_model->koordinatpju();
		$data = array('title' 	=> 'kml',
							'pju'		=> $pju);
		$this->load->view('front/kml',$data);
	}

	function cetak($kd){	
		$pju = $this->pju_model->cetakpdf($kd);
		$jalan = $this->jalan_model->detail($kd);
		$nmruas = url_title($jalan->nm_ruas, 'dash', TRUE);
		$data = array('nama' 	=> 'Penerangan Jalan Umum',
							'pju'		=> $pju,
							'jalan'	=> $jalan);
		$this->load->view('admin/pju/cetak', $data);
		$tgl= date("d-m-Y");
		$html = $this->output->get_output();      
		$this->load->library('Pdf');
		$this->dompdf->load_html($html);
		$this->dompdf->render();
		$this->dompdf->stream("Laporan-".strtoupper($data['nama'])."_".$nmruas."_".$tgl.".pdf",array('Attachment'=>0));
	}

	public function cetak2($kd){
		$pju = $this->pju_model->cetakexcel($kd);
		$jalan = $this->jalan_model->detail($kd);
		$data = array('nama'		=> 'Penerangan Jalan Umum',
							'pju'		=> $pju,
							'jalan' 	=> $jalan);
		$this->load->view('admin/pju/print', $data);
	}

	public function cetakexcel($kd){
		$pju = $this->pju_model->cetakexcel($kd);
		$jalan = $this->jalan_model->detail($kd);
		$data = array('pju'		=> $pju,
							'jalan' => $jalan);
		$this->load->view('admin/pju/excel', $data);
	}
}