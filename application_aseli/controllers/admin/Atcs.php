<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Atcs extends CI_Controller{



	public function __construct(){

		parent::__construct();

		$this->load->model('atcs_model');

		$this->load->model('kabkota_model');

	}

	

	public function index(){

		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$list = $this->kabkota_model->listing();

		}else{

			$list = $this->kabkota_model->loginbatas();

		}

		$data = array('title' 	=> 'ATCS',

							'list'	=> $list,

							'isi'		=> 'admin/atcs/list');

		$this->load->view('admin/layout/wrapper',$data);

	}



	public function cctv($id){

		$hak = $this->session->userdata('hakakses');

		$detail = $this->kabkota_model->detail($id);

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$list = $this->atcs_model->listing($id);

		}else{

			$list = $this->atcs_model->loginbatas($id);

		}

		$data = array('title' 	=> 'ATCS',

							'list'	=> $list,

							'detail'	=> $detail,

							'isi'		=> 'admin/atcs/cctv');

		$this->load->view('admin/layout/wrapper',$data);

	}



	public function addatcs($id){

		$hak = $this->session->userdata('hakakses');

		$detail = $this->kabkota_model->detail($id);

		$valid = $this->form_validation;

		$valid->set_rules('title','title','required',

						array('required'	=> 'Title harus diisi'));

		if($valid->run()==FALSE){

			$data = array(	'title' 		=> 'Add ATCS',

								'detail'		=> $detail,

								'isi' 		=> 'admin/atcs/add');

			$this->load->view('admin/layout/wrapper',$data);

		}else{

			$i = $this->input;

			$data = array('kd_kabkota'		=> $id,

								'nm_atcs'		=> $i->post('title'),

								'lat'				=> $i->post('korx'),

								'lang'			=> $i->post('kory'),

								'source'			=> $i->post('source'));

			$this->atcs_model->addatcs($data);

			$this->session->set_flashdata('sukses','Berhasil ditambah');

			redirect(base_url('admin/atcs/cctv/'.$detail->kd_kabkota));			

		}

	}



	public function editatcs($id){

      $atcs = $this->atcs_model->detail($id);

      $valid = $this->form_validation;

		$valid->set_rules('title','title','required',

						array('required'	=> 'Title harus diisi'));

      if($valid->run()==FALSE){

         $data = array( 'title'  	=> 'Edit ATCS',

                        'atcs' 		=> $atcs,

                        'isi'    	=> 'admin/atcs/edit');

         $this->load->view('admin/layout/wrapper',$data);

      }else{

      	$i = $this->input;

			$data = array('kd_atcs'			=> $id,

								'kd_kabkota'	=> $i->post('kabkota'),

								'nm_atcs'		=> $i->post('title'),

								'lat'				=> $i->post('korx'),

								'lang'			=> $i->post('kory'),

								'source'			=> $i->post('source'));

			$this->atcs_model->editatcs($data);

			$this->session->set_flashdata('sukses','Berhasil diubah');

			redirect(base_url('admin/atcs/cctv/'.$atcs->kd_kabkota));

      }

   }



   public function delete($id){

		$atcs = $this->atcs_model->detail($id);

		$data = array('kd_atcs' => $id);

      $this->atcs_model->deleteatcs($data);

      $this->session->set_flashdata('sukses','Berhasil dihapus');

      redirect(base_url('admin/atcs/cctv/'.$atcs->kd_kabkota));

   }

}