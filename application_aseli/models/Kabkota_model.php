<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabkota_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->select('kd_kabkota,nm_kabkota,nm_balai');
		$this->db->from('kabkota');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->select('kd_kabkota,nm_kabkota,nm_balai');
		$this->db->from('kabkota');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function listkabkota(){
		$query = $this->db->get('kabkota');
		return $query->result();
	}
	public function kabkota($id){
		$query = $this->db->get_where('kabkota',array('kd_balai' => $id));
		return $query->result();
	}
	public function add($data){
		$this->db->insert('kabkota',$data);
	}
	public function detail($id){
		$query = $this->db->get_where('kabkota',array('kd_kabkota' => $id));
		return $query->row();
	}
	public function edit($data){
		$this->db->where('kd_kabkota',$data['kd_kabkota']);
		$this->db->update('kabkota',$data);
	}
	public function delete($data){
		$this->db->where('kd_kabkota',$data['kd_kabkota']);
		$this->db->delete('kabkota',$data);
	}
}