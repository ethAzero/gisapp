<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trayek extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('trayek_model');
		$this->load->model('jalan_model');
	}
	
	public function index(){
		$list = $this->trayek_model->listing();
		$data = array('title' 	=> 'Terminal',
							'list'	=> $list,
							'isi'		=> 'admin/trayek/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$jalan = $this->jalan_model->listing();
		$valid = $this->form_validation;
		$valid->set_rules('kode','kode','required',
						array('required'	=> 'Kode Trayek harus diisi'));
		$valid->set_rules('nama','nama','required',
						array('required'	=> 'Nama Trayek harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title' 		=> 'Add Trayek',
								'jalan'		=> $jalan,
								'isi' 		=> 'admin/trayek/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$data = array('kd_trayek'			=> $i->post('kode'),
								'nama_trayek'		=> $i->post('nama'),
								'koordinat'			=> $i->post('koordinat'));
			$this->trayek_model->addtrayek($data);
			$this->session->set_flashdata('sukses','Berhasil ditambah');
			redirect(base_url('admin/trayek'));
		}
	}

	public function edit($id){
      $hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'AJ')){
			$jalan = $this->jalan_model->listing();
		}else{
			$jalan = $this->jalan_model->loginbatas();
		}
      $trayek = $this->trayek_model->detailtrayek($id);
      $valid = $this->form_validation;
		$valid->set_rules('nama','nama','required',
						array('required'	=> 'Nama Trayek harus diisi'));
      if($valid->run()==FALSE){
         $data = array( 'title'  	=> 'Edit Trayek',
                        'trayek' 	=> $trayek,
                        'jalan' 		=> $jalan,
                        'isi'    	=> 'admin/trayek/edit');
         $this->load->view('admin/layout/wrapper',$data);
      }else{
   		$i = $this->input;
			$data = array('kd_trayek'			=> $id,
								'nama_trayek'		=> $i->post('nama'),
								'koordinat'			=> $i->post('koordinat'));
			$this->trayek_model->edittrayek($data);
			$this->session->set_flashdata('sukses','Berhasil diubah');
			redirect(base_url('admin/trayek'));
      }
   }

   public function delete($id){
		$data = array('kd_trayek' => $id);
      $this->trayek_model->deletetrayek($data);
      $this->session->set_flashdata('sukses','Berhasil dihapus');
      redirect(base_url('admin/trayek'));
   }
}