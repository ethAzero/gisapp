<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Delinator extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('delinator_model');
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
		$count = $this->home_model->rekapdelinator();
		
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$jalan = $this->jalan_model->listing();

		}else{
			$jalan = $this->jalan_model->loginbatas();
		}


		$i = $this->input;
		$cari	= $i->post('search');
		if (isset($cari)) {
			
			$sdel 		= $this->delinator_model->delinatorbykd($cari);
			$kd_jalan	= $sdel[0]->kd_jalan;
			$jln 		= $this->delinator_model->jlnprovbykd($kd_jalan);
			$kd_balai	= $jln->kd_balai;

			$ruas 	= $this->dashboard_model->detailruas($kd_balai,$kd_jalan);
			// $view 	= $this->dashboard_model->viewdelinator($jalan);
			$data = array(	'title' 		=> 'View Delinator',
							'ruas'		=> $ruas,
							'view'		=> $sdel,
							'isi' 		=> 'admin/delinator/view_search');
			$this->load->view('admin/layout/wrapper',$data);
			// print_r($jln);exit();
		}else{
			$data = array(	'title' 	=> 'Delinator',
							'jalan'	=> $jalan,
							'count'	=> $count,
							'isi'	=> 'admin/delinator/list');
			$this->load->view('admin/layout/wrapper',$data);
		}
	}

	public function detail($balai,$jln){
		// print_r('tes');exit();
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$listjalan = $this->jalan_model->listing();
		}else{
			$listjalan = $this->jalan_model->loginbatas();
		}

		$jalan = $this->jalan_model->detail($jln);

		$list = $this->delinator_model->listing($jln);
		$data = array('title' 		=> 'Delinator - '.$jalan->nm_ruas,
							'list'		=> $list,
							'jalan'		=> $jalan,
							'listjalan'	=> $listjalan,
							'isi'		=> 'admin/delinator/detail');
		$this->load->view('admin/layout/wrapper',$data);


	}
	

	public function add($balai,$jln){
		$jalan = $this->jalan_model->detail($jln);
		$urut = $this->delinator_model->kodeurut();
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
			$data = array(	'title' 		=> 'Add Delinator',
								'jalan'		=> $jalan,
								'isi' 		=> 'admin/delinator/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/delinator/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')){
					$data = array(	'title' 	=> 'Add Delinator',
										'error'	=> $this->upload->display_errors(),
										'isi' 	=> 'admin/delinator/add');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/delinator/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/delinator/thumbs/';
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
					$kode = 'DL'.$kodeurut;
					$data = array('kd_delinator'			=> $kode,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'		=> $i->post('tahun'),
										'km_lokasi	'		=> $i->post('kmlokasi'),
										'jenis'				=> $i->post('jenis'),
										'img_delinator'		=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'				=> $i->post('status'),
										'lat'					=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->delinator_model->adddelinator($data);
					$this->session->set_flashdata('sukses','Berhasil ditambah');
					redirect(base_url('admin/delinator/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$kode = 'DL'.$kodeurut;
				$data = array('kd_delinator'			=> $kode,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'	=> $i->post('tahun'),
									'km_lokasi	'		=> $i->post('kmlokasi'),
									'jenis'				=> $i->post('jenis'),
									'letak'				=> $i->post('letak'),
									'status'				=> $i->post('status'),
									'lat'					=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->delinator_model->adddelinator($data);
				$this->session->set_flashdata('sukses','Berhasil ditambah');
				redirect(base_url('admin/delinator/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}			
		}
	}

	public function edit($jln,$kd){
      $delinator = $this->delinator_model->detaildelinator($jln,$kd);
      $jalan = $this->jalan_model->detail($jln);
      $valid = $this->form_validation;
		$valid->set_rules('korx','korx','required',
						array('required'	=> 'Koordinat X harus diisi'));
		$valid->set_rules('kory','kory','required',
						array('required'	=> 'Koordinat Y harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  		=> 'Edit delinator',
                        'delinator' 	=> $delinator,
                        'jalan' 		=> $jalan,
                        'isi'    		=> 'admin/delinator/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	if (!empty($_FILES['gambar']['name'])){
				$config['upload_path'] 		= './assets/upload/delinator/';
				$config['allowed_types'] 	= 'gif|jpg|jpeg|png|svg';
				$config['max_size']			= '1000';
				$this->load->library('upload', $config);
				if(! $this->upload->do_upload('gambar')) {
					$data = array('title' 	=> 'Edit delinator',
										'delinator' => $delinator,
                        				'jalan' 	=> $jalan,
										'error'		=> $this->upload->display_errors(),
										'isi'		=> 'admin/delinator/edit');
					$this->load->view('admin/layout/wrapper',$data);
				}else{
					$upload_data					= array('uploads' =>$this->upload->data());
					$config['image_library']	= 'gd2';
					$config['encrypt_name'] 	= TRUE;
					$config['source_image'] 	= './assets/upload/delinator/'.$upload_data['uploads']['file_name']; 
					$config['new_image'] 		= './assets/upload/delinator/thumbs/';
					$config['create_thumb'] 	= TRUE;
					$config['quality'] 			= "100%";
					$config['maintain_ratio'] 	= FALSE;
					$config['width'] 			= 350;
					$config['height'] 			= 350;
					$config['x_axis'] 			= 0;
					$config['y_axis'] 			= 0;
					$config['remove_spaces'] 	= TRUE;
					$config['thumb_marker'] 	= '';
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					
					if($delinator->img_delinator != ""){
						unlink('./assets/upload/delinator/'.$delinator->img_delinator);
						unlink('./assets/upload/delinator/thumbs/'.$delinator->img_delinator);
					}

					$i = $this->input;
					$data = array('kd_delinator'			=> $kd,
										'kd_jalan'			=> $jln,
										'thn_pengadaan'		=> $i->post('tahun'),
										'km_lokasi	'		=> $i->post('kmlokasi'),
										'jenis'				=> $i->post('jenis'),
										'img_delinator'		=> $upload_data['uploads']['file_name'],
										'letak'				=> $i->post('letak'),
										'status'			=> $i->post('status'),
										'lat'				=> $i->post('korx'),
										'lang'				=> $i->post('kory'));
					$this->delinator_model->editdelinator($data);
					$this->session->set_flashdata('sukses','Berhasil diubah');
					redirect(base_url('admin/delinator/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
				}
			}else{
				$i = $this->input;
				$data = array('kd_delinator'			=> $kd,
									'kd_jalan'			=> $jln,
									'thn_pengadaan'		=> $i->post('tahun'),
									'km_lokasi	'		=> $i->post('kmlokasi'),
									'jenis'				=> $i->post('jenis'),
									'letak'				=> $i->post('letak'),
									'status'			=> $i->post('status'),
									'lat'				=> $i->post('korx'),
									'lang'				=> $i->post('kory'));
				$this->delinator_model->editdelinator($data);
				$this->session->set_flashdata('sukses','Berhasil diubah');
				redirect(base_url('admin/delinator/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
			}
      }
   }

   public function delete($jln,$kd){
		$delinator = $this->delinator_model->detaildelinator($jln,$kd);
		$jalan = $this->jalan_model->detail($jln);
		if($delinator->img_delinator != null){
			unlink('./assets/upload/delinator/'.$delinator->img_delinator);
			unlink('./assets/upload/delinator/thumbs/'.$delinator->img_delinator);
		}
		$data = array('kd_jalan' => $jln,'kd_delinator' => $kd);
      $this->delinator_model->deletedelinator($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
		redirect(base_url('admin/delinator/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function viewdelinator($id,$jalan) {
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewdelinator($jalan);
		$data = array('title' 		=> 'View Delinator',
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/delinator/view');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function tukar($jln,$kd){
      $jalan = $this->jalan_model->detail($jln);
      $i = $this->input;
		$data = array(	'kd_apil'			=> $kd,
						'kd_jalan'		=> $i->post('kdruas'));
		$this->apil_model->editapil($data);
		$this->session->set_flashdata('sukses','Jalan Berhasil dipindah');
		redirect(base_url('admin/apil/detail/'.$jalan->kd_balai.'/'.$jalan->kd_jalan));
   }

   public function kml(){
		$apil = $this->delinator_model->koordinatdelinator();
		// print_r($apil);exit();
		$data = array('title' 	=> 'kml',
						'apil'	=> $apil);
		$this->load->view('front/kml',$data);
	}

	public function cetak($kd){
		$delinator = $this->delinator_model->cetakpdf($kd);

		$jalan = $this->jalan_model->detail($kd);
		$data = array(	'nama'		=> 'Delinator',
					  	'delinator'	=> $delinator,
						'jalan' 	=> $jalan);
		$this->load->view('admin/delinator/print', $data);
	}

	// function cetak($kd){	
	// 	$apil = $this->apil_model->cetakpdf($kd);
	// 	$jalan = $this->jalan_model->detail($kd);
	// 	$nmruas = url_title($jalan->nm_ruas, 'dash', TRUE);
	// 	$data = array('nama' 	=> 'Apil',
	// 						'apil'	=> $apil,
	// 						'jalan'	=> $jalan);
	// 	$this->load->view('admin/apil/cetak', $data);
	// 	$tgl= date("d-m-Y");
	// 	$html = $this->output->get_output();      
	// 	$this->load->library('Pdf');
	// 	$this->dompdf->load_html($html);
	// 	$this->dompdf->render();
	// 	$this->dompdf->stream("Laporan-".strtoupper($data['nama'])."_".$nmruas."_".$tgl.".pdf",array('Attachment'=>0));
	// }
}