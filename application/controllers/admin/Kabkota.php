<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabkota extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('kabkota_model');
		$this->load->model('balai_model');
	}
	
	public function index(){
		$list = $this->kabkota_model->listing();
		$data = array('title' 	=> 'Kabupaten / Kota',
							'list'	=> $list,
							'isi'		=> 'admin/kabkota/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$balai = $this->balai_model->listing();
		$valid = $this->form_validation;
		$valid->set_rules('kode','kode','required',
						array('required'	=> 'Kode Kabupaten / Kota harus diisi'));
		$valid->set_rules('kdbalai','kdbalai','required',
						array('required'	=> 'Balai harus diisi'));
		$valid->set_rules('nmkabkota','nmkabkota','required',
						array('required'	=> 'Nama Kabupaten / Kota harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Kabupaten / Kota',
								'balai'		=> $balai,
								'isi' 		=> 'admin/kabkota/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$data = array('kd_kabkota'		=> $i->post('kode'),
								'kd_balai'		=> $i->post('kdbalai'),
								'nm_kabkota'	=> $i->post('nmkabkota'));
			$this->kabkota_model->add($data);
			$this->session->set_flashdata('sukses','Berhasil ditambah');
			redirect(base_url('admin/kabkota'));	
		}
	}

	public function edit($id){
      $detail = $this->kabkota_model->detail($id);
      $balai = $this->balai_model->listing();
      $valid = $this->form_validation;
		$valid->set_rules('kdbalai','kdbalai','required',
						array('required'	=> 'Balai harus diisi'));
		$valid->set_rules('nmkabkota','nmkabkota','required',
						array('required'	=> 'Nama Kabupaten / Kota harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  => 'Edit Kabupaten / Kota',
                        'detail' => $detail,
                        'balai' 	=> $balai,
                        'isi'    => 'admin/kabkota/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
      	$i = $this->input;
			$data = array('kd_kabkota'		=> $id,
								'kd_balai'		=> $i->post('kdbalai'),
								'nm_kabkota'	=> $i->post('nmkabkota'));
			$this->kabkota_model->edit($data);
			$this->session->set_flashdata('sukses','Berhasil diubah');
			redirect(base_url('admin/kabkota'));
      }
   }

   public function delete($id){
		$data = array('kd_kabkota' => $id);
      $this->kabkota_model->delete($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/kabkota'));
   }

   public function exportexcel(){
		$balai = $this->balai_model->listing();
		$data = array(	'title' 	=> 'Data Wilayah Balai Perhubungan',
							'balai' 	=> $balai);
		$this->load->view('admin/kabkota/excel',$data);
  	}
}