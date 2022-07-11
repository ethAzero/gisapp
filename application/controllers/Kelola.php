<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola extends CI_Controller {

	public function index()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$valid = $this->form_validation;
		$valid->set_rules('username','Username','required', array('required'	=> ' Username harus diisi'));
		$valid->set_rules('password','Password','required', array('required'	=> ' Password harus diisi'));

		if($valid->run()){
			$this->authlogin->login($username,$password, base_url('admin/dashboard'), base_url('kelola'));
		}

		$data = array('title' => 'Dinas Perhubungan');
		$this->load->view('admin/login',$data);
	}

	public function logout(){
		$this->authlogin->logout();
	}
}
