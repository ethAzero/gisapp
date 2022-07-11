<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller{

	public function index(){
		$data = array('title'	=> 'Account',
							'isi'		=> 'admin/account/list');
		$this->load->view('admin/layout/wrapper',$data);
	}
}