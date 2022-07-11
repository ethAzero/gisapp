<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pengguna_model');
	}

	public function index(){
		$pengguna = $this->pengguna_model->detail($this->session->userdata('username'));
		$data = array('title' 		=> 'Profil',
							'pengguna'	=> $pengguna,
							'isi' 		=> 'admin/profil/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function edit($username){
		$pengguna = $this->pengguna_model->detail($username);
		$i = $this->input;
		if(strlen($i->post('password')) < 6 | strlen($i->post('password')) > 32){
			$this->session->set_flashdata('error','Password Gagal diubah');
		}else{
			$data = array(	'username'		=> $username,
								'password'		=> sha1($i->post('password'))
							);
			$this->pengguna_model->ubah($data);
			$this->session->set_flashdata('sukses','Password telah diubah');
		}
		redirect(base_url('admin/profil'));
	}
}
