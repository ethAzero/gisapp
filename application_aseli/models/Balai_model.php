<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Balai_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$query = $this->db->get('balai');
		return $query->result();
	}
	public function listbalai(){
		$this->db->where('kd_balai !=','07');
		$query = $this->db->get('balai');
		return $query->result();
	}
	public function addbalai($data){
		$this->db->insert('balai',$data);
	}
	public function detailbalai($id){
		$query = $this->db->get_where('balai',array('kd_balai' => $id));
		return $query->row();
	}
	public function editbalai($data){
		$this->db->where('kd_balai',$data['kd_balai']);
		$this->db->update('balai',$data);
	}
	public function deletebalai($data){
		$this->db->where('kd_balai',$data['kd_balai']);
		$this->db->delete('balai',$data);
	}
}