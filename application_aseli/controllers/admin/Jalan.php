<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jalan extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('balai_model');
		$this->load->model('jalan_model');
	}
	
	public function index(){
		$list = $this->jalan_model->listing();
		$data = array('title' 	=> 'Ruas Jalan Provinsi',
							'list'	=> $list,
							'isi'		=> 'admin/jalan/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$balai = $this->balai_model->listing();
		$urut = $this->jalan_model->kodeurut();
		$valid = $this->form_validation;
		$valid->set_rules('nmrruas','nmrruas','required',
						array('required'	=> 'Nomor Ruas harus diisi'));
		$valid->set_rules('nmruas','nmruas','required',
						array('required'	=> 'Nama Ruas harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Jalan Provinsi',
								'balai'		=> $balai,
								'isi' 		=> 'admin/jalan/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			if($urut->urutan == ''){
				$kodeurut = '001';
			}else{
				$urut2 = ($urut->urutan) +1;
				$kodeurut  = sprintf("%03s", $urut2);
			}		
			$kode 	= '33'.$i->post('balai').''.$kodeurut;
			$start 	= $i->post('startx').','.$i->post('starty');
			$end 		= $i->post('endx').','.$i->post('endy');
			$data = array('kd_jalan'		=> $kode,
								'kd_balai'		=> $i->post('balai'),
								'no_ruas'		=> $i->post('nmrruas'),
								'jln_fungsi'	=> $i->post('jlnfungsi'),
								'jln_kelas'		=> $i->post('jlnkelas'),
								'jln_panjang'	=> $i->post('jlnpanjang'),
								'nm_ruas'		=> $i->post('nmruas'),
								'jln_start'		=> $start,
								'jln_end'		=> $end,
								'lintasan'		=> $i->post('lintasan'));
			$this->jalan_model->add($data);
			$this->session->set_flashdata('sukses','Berhasil ditambah');
			redirect(base_url('admin/jalan'));	
		}
	}

	public function edit($id){
      $detail = $this->jalan_model->detail($id);
      $balai = $this->balai_model->listing();
      $valid = $this->form_validation;
		$valid->set_rules('nmruas','nmruas','required',
						array('required'	=> 'Nama Ruas harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  	=> 'Edit Jalan Provinsi',
                        'detail' 	=> $detail,
                        'balai' 		=> $balai,
                        'isi'    	=> 'admin/jalan/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	$i = $this->input;
			$start 	= $i->post('startx').','.$i->post('starty');
			$end 		= $i->post('endx').','.$i->post('endy');
			$iapil = $i->post('apil');
			if($iapil == '1'){
				$p_apil = '1';
			}else{
				$p_apil = '0';
			}
			$icermin = $i->post('cermin');
			if($icermin == '1'){
				$p_cermin = '1';
			}else{
				$p_cermin = '0';
			}
			$ipju = $i->post('pju');
			if($ipju == '1'){
				$p_pju = '1';
			}else{
				$p_pju = '0';
			}
			$iflash = $i->post('flash');
			if($iflash == '1'){
				$p_flash = '1';
			}else{
				$p_flash = '0';
			}
			$irambu = $i->post('rambu');
			if($irambu == '1'){
				$p_rambu = '1';
			}else{
				$p_rambu = '0';
			}
			$irppj = $i->post('rppj');
			if($irppj == '1'){
				$p_rppj = '1';
			}else{
				$p_rppj = '0';
			}
			$data = array('kd_jalan'		=> $id,
								'kd_balai'		=> $i->post('balai'),
								'jln_kelas'		=> $i->post('jlnkelas'),
								'jln_panjang'	=> $i->post('jlnpanjang'),
								'nm_ruas'		=> $i->post('nmruas'),
								'jln_start'		=> $start,
								'jln_end'		=> $end,
								'apil'			=> $p_apil,
								'cermin'			=> $p_cermin,
								'pju'				=> $p_pju,
								'flash'			=> $p_flash,
								'rambu'			=> $p_rambu,
								'rppj'			=> $p_rppj,
								'lintasan'		=> $i->post('lintasan'));
			$this->jalan_model->edit($data);
			$this->session->set_flashdata('sukses','Berhasil diubah');
			redirect(base_url('admin/jalan'));
      }
   }

   public function delete($id){
		$data = array('kd_jalan' => $id);
      $this->jalan_model->delete($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/jalan'));
   }

   public function exportexcel(){
		$jalan = $this->jalan_model->viewjalan2();
		$data = array(	'title' 	=> 'Data Jalan Provinsi',
							'jalan' 	=> $jalan);
		$this->load->view('admin/jalan/excel',$data);
  	}

  	public function kml(){
		$jalan = $this->jalan_model->koordinatjalan();
		$data = array('title' 	=> 'kml',
							'jalan'	=> $jalan);
		$this->load->view('front/jalankml',$data);
	}
}