<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authlogin {
	
	var $CI = NULL;
	public function __construct() {
		$this->CI =& get_instance();
	}
	
	public function login($username, $password) {
		$query = $this->CI->db->get_where('ma_pengguna', array(
														'username' 	=> $username, 
														'password' 	=> sha1($password),
														'status' 	=>	'A'));
		if($query->num_rows() == 1) {
			$row 		= $this->CI->db->query('SELECT * FROM ma_pengguna WHERE username = "'.$username.'"');
			$admin 		= $row->row();
			$authlogin 	= $admin->authlogin;
			$username 	= $admin->username;
			$nama		= $admin->nm_pengguna;
			$level		= $admin->akseslevel;
			$status		= $admin->status;
			$this->CI->session->set_userdata('username', $username); 
			$this->CI->session->set_userdata('hakakses', $level); 
			$this->CI->session->set_userdata('nama', $nama);
			$this->CI->session->set_userdata('status', $status);
			$this->CI->session->set_userdata('authlogin', uniqid(rand()));
			$data = array(	'authlogin'		=> uniqid(rand()));
			$this->CI->db->where('username',$username);
			$this->CI->db->update('ma_pengguna',$data);
			redirect(base_url('admin/dashboard'));
		}else{
			$this->CI->session->set_flashdata('gagal','Oopss.. Username / password salah');
			redirect(base_url('kelola'));
		}
		return false;
	}
	
	public function cek_login() {
		if($this->CI->session->userdata('username') == '' && 
			$this->CI->session->userdata('hakakses')=='') {
			$this->CI->session->set_flashdata('gagal','Oops...silakan login dulu');
			redirect(base_url('kelola'));
		}	
	}
	
	public function logout() {
		$username = $this->CI->session->userdata('username');
		date_default_timezone_set("Asia/Jakarta");
		$now = date('Y-m-d H:i:s');
		$data = array('last_login'	=>	$now);
		$this->CI->db->where('username',$username);
		$this->CI->db->update('ma_pengguna',$data);
		$this->CI->session->unset_userdata('username');
		$this->CI->session->unset_userdata('hakakses');
		$this->CI->session->unset_userdata('nama');
		$this->CI->session->unset_userdata('authlogin');
		$this->CI->session->set_flashdata('sukses','Terimakasih, Anda berhasil logout');
		redirect(base_url('kelola'));
	}
}