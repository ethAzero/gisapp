<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bandara_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->from('bandara');
		$this->db->join('kabkota','kabkota.kd_kabkota = bandara.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->from('bandara');
		$this->db->join('kabkota','kabkota.kd_kabkota = bandara.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function addbandara($data){
		$this->db->insert('bandara',$data);
	}
	public function bandara($id){
		$this->db->from('bandara');
		$this->db->join('kabkota','kabkota.kd_kabkota = bandara.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detailbandara($id){
		$query = $this->db->get_where('bandara',array('kd_bandara' => $id));
		return $query->row();
	}
	public function editbandara($data){
		$this->db->where('kd_bandara',$data['kd_bandara']);
		$this->db->update('bandara',$data);
	}
	public function deletebandara($data){
		$this->db->where('kd_bandara',$data['kd_bandara']);
		$this->db->delete('bandara',$data);
	}
}