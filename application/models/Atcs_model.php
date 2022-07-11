<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Atcs_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing($id){
		$this->db->from('atcs');
		$this->db->join('kabkota','kabkota.kd_kabkota = atcs.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('kabkota.kd_kabkota',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas($id){
		$this->db->from('atcs');
		$this->db->join('kabkota','kabkota.kd_kabkota = atcs.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('kabkota.kd_kabkota',$id);
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function addatcs($data){
		$this->db->insert('atcs',$data);
	}
	public function atcs($id){
		$this->db->from('atcs');
		$this->db->join('kabkota','kabkota.kd_kabkota = atcs.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detailatcs($id){
		$query = $this->db->get_where('atcs',array('kd_atcs' => $id));
		return $query->row();
	}
	public function editatcs($data){
		$this->db->where('kd_atcs',$data['kd_atcs']);
		$this->db->update('atcs',$data);
	}
	public function detail($id){
		$this->db->from('atcs');
		$this->db->join('kabkota','kabkota.kd_kabkota = atcs.kd_kabkota','LEFT');
		$this->db->where('atcs.kd_atcs',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function deleteatcs($data){
		$this->db->where('kd_atcs',$data['kd_atcs']);
		$this->db->delete('atcs',$data);
	}
}