<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stasiun_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->from('stasiun');
		$this->db->join('kabkota','kabkota.kd_kabkota = stasiun.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->from('stasiun');
		$this->db->join('kabkota','kabkota.kd_kabkota = stasiun.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function addstasiun($data){
		$this->db->insert('stasiun',$data);
	}
	public function stasiun($id){
		$this->db->from('stasiun');
		$this->db->join('kabkota','kabkota.kd_kabkota = stasiun.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detailstasiun($id){
		$query = $this->db->get_where('stasiun',array('kd_stasiun' => $id));
		return $query->row();
	}
	public function editstasiun($data){
		$this->db->where('kd_stasiun',$data['kd_stasiun']);
		$this->db->update('stasiun',$data);
	}
	public function deletestasiun($data){
		$this->db->where('kd_stasiun',$data['kd_stasiun']);
		$this->db->delete('stasiun',$data);
	}
}