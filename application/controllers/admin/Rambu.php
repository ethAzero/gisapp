<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 6000);
ini_set('memory_limit', '10240M');

class Rambu extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('rambu_model');
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
		$count = $this->home_model->rekaprambu();
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$jalan = $this->jalan_model->listing();
		}else{
			$jalan = $this->jalan_model->loginbatas();
		}
		$i = $this->input;
		$cari	= $i->post('search');
		if (isset($cari)) {
			
			$sdel 		= $this->rambu_model->rambubykd($cari);
			$kd_jalan	= $sdel[0]->kd_jalan;
			$jln 		= $this->rambu_model->jlnprovbykd($kd_jalan);
			$kd_balai	= $jln->kd_balai;

			$ruas 	= $this->dashboard_model->detailruas($kd_balai,$kd_jalan);
			// $view 	= $this->dashboard_model->viewrambu($jalan);
			$data = array(	'title' 	=> 'View Rambu',
							'ruas'		=> $ruas,
							'view'		=> $sdel,
							'isi' 		=> 'admin/rambu/view_search');
			$this->load->view('admin/layout/wrapper',$data);
			// print_r($jln);exit();
		}else{
			$data = array('title' 	=> 'Fasilitas Rambu',
								'jalan'	=> $jalan,
								'count'	=> $count,
								'isi'		=> 'admin/rambu/list');
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
		$list = $this->rambu_model->listing($jln);
		$data = array('title' 		=> 'Rambu - '.$jalan->nm_ruas,
							'list'		=> $list,
							'jalan'		=> $jalan,
							'listjalan'	=> $listjalan,
							'isi'			=> 'admin/rambu/detail');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add($balai,$jln){
		$jalan = $this->jalan_model->detail($jln);
		$urut = $this->rambu_model->kodeurut();
		$rambu = $this->rambu_model->detailKlasifikasi();
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
			$data = array(	'title' 		=> 'Add Rambu',
								'jalan'		=> $jalan,
								'rambu'		=> $rambu,
								'isi' 		=> 'admin/rambu/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/rambu/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 	=> 'Add rambu',
										'error'	=> $this->upload->display_errors(),
										'isi' 	=> 'admin/rambu/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/rambu/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/rambu/thumbs/';
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
					$kode = 'RB'.$kodeurut;
					$data = array('kd_rambu'			=> $kode,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'	=> $i->post('tahun'),
										'jenis		'		=> $i->post('klasifikasi'),
										'tipe'				=> $i->post('rambu_tipe'),
										'img_rambu'			=> $upload_data['uploads']['file_name'],
										'status'				=> $i->post('status'),
										'posisi'				=> $i->post('posisi'),
										'kondisi'			=> $i->post('kondisi'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->rambu_model->addrambu($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/rambu/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$kode = 'RB'.$kodeurut;
				$data = array('kd_rambu'			=> $kode,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'	=> $i->post('tahun'),
									'jenis		'		=> $i->post('klasifikasi'),
									'tipe'				=> $i->post('rambu_tipe'),
									'status'				=> $i->post('status'),
									'posisi'				=> $i->post('posisi'),
									'kondisi'			=> $i->post('kondisi'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->rambu_model->addrambu($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/rambu/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}			
		}
	}

	public function edit($jln,$kd){
      $rambus = $this->rambu_model->detailKlasifikasi();
      $rambu = $this->rambu_model->detailrambu($jln,$kd);
      $jalan = $this->jalan_model->detail($jln);
      $valid = $this->form_validation;
		$valid->set_rules('korx','korx','required',
						array('required'	=> 'Koordinat X harus diisi'));
		$valid->set_rules('kory','kory','required',
						array('required'	=> 'Koordinat Y harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  => 'Edit Rambu',
                        'rambu' 	=> $rambu,
                        'rambus' => $rambus,
                        'jalan' 	=> $jalan,
                        'isi'    => 'admin/rambu/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/rambu/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 	=> 'Edit Rambu',
										'rambu' 	=> $rambu,
                        		'jalan' 	=> $jalan,
										'error'	=> $this->upload->display_errors(),
										'isi'		=> 'admin/rambu/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/rambu/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/rambu/thumbs/';
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
					
					if($rambu->img_rambu != ""){
						unlink('./assets/upload/rambu/'.$rambu->img_rambu);
						unlink('./assets/upload/rambu/thumbs/'.$rambu->img_rambu);
					}

					$i = $this->input;
					if(!empty($i->post('rambu_tipe'))){
						$data = array('kd_rambu'			=> $kd,
											'thn_pengadaan'	=> $i->post('tahun'),
											'jenis'				=> $i->post('klasifikasi'),
											'tipe'				=> $i->post('rambu_tipe'),
											'img_rambu'			=> $upload_data['uploads']['file_name'],
											'status'				=> $i->post('status'),
											'posisi'				=> $i->post('posisi'),
											'kondisi'			=> $i->post('kondisi'),
											'lat'					=> $i->post('korx'),
											'lang'				=> $i->post('kory'));
					}else{
						$data = array('kd_rambu'			=> $kd,
											'thn_pengadaan'	=> $i->post('tahun'),
											'jenis'				=> $i->post('klasifikasi'),
											'img_rambu'			=> $upload_data['uploads']['file_name'],
											'status'				=> $i->post('status'),
											'posisi'				=> $i->post('posisi'),
											'kondisi'			=> $i->post('kondisi'),
											'lat'					=> $i->post('korx'),
											'lang'				=> $i->post('kory'));
					}
					$this->rambu_model->editrambu($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/rambu/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				if(!empty($i->post('rambu_tipe'))){
					$data = array('kd_rambu'			=> $kd,
										'thn_pengadaan'	=> $i->post('tahun'),
										'jenis		'		=> $i->post('klasifikasi'),
										'tipe'				=> $i->post('rambu_tipe'),
										'status'				=> $i->post('status'),
										'posisi'				=> $i->post('posisi'),
										'kondisi'			=> $i->post('kondisi'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
				}else{
					$data = array('kd_rambu'			=> $kd,
										'thn_pengadaan'	=> $i->post('tahun'),
										'jenis		'		=> $i->post('klasifikasi'),
										'status'				=> $i->post('status'),
										'posisi'				=> $i->post('posisi'),
										'kondisi'			=> $i->post('kondisi'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
				}
				$this->rambu_model->editrambu($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/rambu/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}
      }
   }

   public function delete($jln,$kd){
		$rambu = $this->rambu_model->detailrambu($jln,$kd);
		$jalan = $this->jalan_model->detail($jln);
		if($rambu->img_rambu != null){
			unlink('./assets/upload/rambu/'.$rambu->img_rambu);
			unlink('./assets/upload/rambu/thumbs/'.$rambu->img_rambu);
		}
		$data = array('kd_jalan' => $jln,'kd_rambu' => $kd);
      $this->rambu_model->deleterambu($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/rambu/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function tukar($jln,$kd){
      $jalan = $this->jalan_model->detail($jln);
      $i = $this->input;
		$data = array('kd_rambu'		=> $kd,
							'kd_jalan'		=> $i->post('kdruas'));
		$this->rambu_model->editrambu($data);
		$this->session->set_flashdata('sukses','Jalan Berhasil dipindah');
		redirect(base_url('admin/rambu/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function klasifikasi(){
		$rambu = $this->rambu_model->detailKlasifikasi();
		echo json_encode($rambu);
   }

   public function tipe(){
   	$value = $this->input->post('data');
		$rambu = $this->rambu_model->detailTipe($value);
		echo json_encode($rambu);
   }

   public function viewrambu($id,$jalan) {
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewrambu($jalan);
		$data = array('title' 		=> 'View Rambu',
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/rambu/view');
		$this->load->view('admin/layout/wrapper',$data);
	}

   public function kml(){
		$rambu = $this->rambu_model->koordinatrambu();
		$data = array('title' 		=> 'kml',
							'rambu'		=> $rambu);
		$this->load->view('front/kml',$data);
	}

	// function cetak($kd){	
	// 	$rambu = $this->rambu_model->cetakpdf($kd);
	// 	$jalan = $this->jalan_model->detail($kd);
	// 	$nmruas = url_title($jalan->nm_ruas, 'dash', TRUE);
	// 	$data = array('nama' 	=> 'Rambu',
	// 						'rambu'	=> $rambu,
	// 						'jalan'	=> $jalan);
	// 	$this->load->view('admin/rambu/cetak', $data);
	// 	$tgl= date("d-m-Y");
	// 	$html = $this->output->get_output();      
	// 	$this->load->library('Pdf');
	// 	$this->dompdf->load_html($html);
	// 	$this->dompdf->render();
	// 	$this->dompdf->stream("Laporan-".strtoupper($data['nama'])."_".$nmruas."_".$tgl.".pdf",array('Attachment'=>0));
	// }

	public function cetak($kd){
		$rambu = $this->rambu_model->cetakpdf($kd);
		$jalan = $this->jalan_model->detail($kd);
		$data = array('nama'		=> 'Rambu',
							'rambu'	=> $rambu,
							'jalan' 	=> $jalan);
		$this->load->view('admin/rambu/print', $data);
	}

}