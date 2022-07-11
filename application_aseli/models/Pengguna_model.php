<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listing(){
		$this->db->where('akseslevel !=','S');
		$query = $this->db->get('ma_pengguna');
		return $query->result();
	}

	public function add($data){
		$this->db->insert('ma_pengguna',$data);
	}
	
	public function detail($username){
		$query = $this->db->get_where('ma_pengguna',array('username' => $username));
		return $query->row();
	}

	public function edit($data){
		$this->db->where('username',$data['username']);
		$this->db->update('ma_pengguna',$data);
	}

	public function ubah($data){
		$this->db->where('username',$data['username']);
		$this->db->update('ma_pengguna',$data);
	}	
	
	public function delete($data){
		$this->db->where('username',$data['username']);
		$this->db->delete('ma_pengguna',$data);
	} 
}
