<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdp_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->from('sdp');
		$this->db->join('kabkota','kabkota.kd_kabkota = sdp.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->from('sdp');
		$this->db->join('kabkota','kabkota.kd_kabkota = sdp.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function addsdp($data){
		$this->db->insert('sdp',$data);
	}
	public function sdp($id){
		$this->db->from('sdp');
		$this->db->join('kabkota','kabkota.kd_kabkota = sdp.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detailsdp($id){
		$query = $this->db->get_where('sdp',array('kd_sdp' => $id));
		return $query->row();
	}
	public function editsdp($data){
		$this->db->where('kd_sdp',$data['kd_sdp']);
		$this->db->update('sdp',$data);
	}
	public function deletesdp($data){
		$this->db->where('kd_sdp',$data['kd_sdp']);
		$this->db->delete('sdp',$data);
	}
}