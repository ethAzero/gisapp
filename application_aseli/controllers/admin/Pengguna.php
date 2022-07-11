<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('pengguna_model');
		$this->load->model('balai_model');
	}

	public function index(){
		$pengguna = $this->pengguna_model->listing();
		$data = array('title' 		=> 'Pengguna',
							'pengguna'	=>	$pengguna,
							'isi' 		=> 'admin/pengguna/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function add(){
		$balai = $this->balai_model->listing();
		$valid = $this->form_validation;
		$valid->set_rules('username','Username','required|is_unique[ma_pengguna.username]',
						array('required'	=> 'Username harus diisi',
								'is_unique'	=> 'Username <strong>'.$this->input->post('username').'</strong> sudah digunakan'));
		$valid->set_rules('password','Password','required|max_length[32]|min_length[6]', 
						array('required'		=> 'Password harus diisi',
								'min_length'	=> 'Password minimal 6 karakter',
								'max_length'	=> 'Password maksimal 32 karakter'));
		if($valid->run()==FALSE){
			$data = array('title'	=>	'Add Pengguna',
								'balai'	=> $balai,
								'isi'		=>	'admin/pengguna/add');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			$data = array(	'username'		=> $i->post('username'),
								'password'		=> sha1($i->post('password')),
								'nm_pengguna'	=> $i->post('nmpengguna'),
								'akseslevel'	=>	$i->post('akseslevel')
							);
			$this->pengguna_model->add($data);
			$this->session->set_flashdata('sukses','Data pengguna telah ditambah');
			redirect(base_url('admin/pengguna'));
		}
	}

	public function edit($username){
		$pengguna = $this->pengguna_model->detail($username);
		$balai = $this->balai_model->listing();
		$valid = $this->form_validation;
		$valid->set_rules('idusername','Username','required', array('required'	=> 'Username harus diisi'));
		if($valid->run()==FALSE){
			$data = array(	'title'		=>	'Edit Pengguna',
								'pengguna'	=>	$pengguna,
								'balai'		=> $balai,
								'isi'			=>	'admin/pengguna/edit');
			$this->load->view('admin/layout/wrapper',$data);
		}else{
			$i = $this->input;
			if(strlen($i->post('password')) < 6 | strlen($i->post('password')) > 32){
				$data = array(	'username'		=> $i->post('idusername'),
									'nm_pengguna'	=> $i->post('nmpengguna'),
									'akseslevel'	=>	$i->post('akseslevel')
								);	
			}else{
				$data = array(	'username'		=> $i->post('idusername'),
									'password'		=> sha1($i->post('password')),
									'nm_pengguna'	=> $i->post('nmpengguna'),
									'akseslevel'	=>	$i->post('akseslevel')
								);
			}
			$this->pengguna_model->edit($data);
			$this->session->set_flashdata('sukses','Data pengguna telah diubah');
			redirect(base_url('admin/pengguna'));
		}
	}

	public function delete($username){
		$data = array('username' => $username);
		$this->pengguna_model->delete($data);
		$this->session->set_flashdata('sukses','Data pengguna telah dihapus');
		redirect(base_url('admin/pengguna'));
	}
}
