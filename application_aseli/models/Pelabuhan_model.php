<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pelabuhan_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->from('pelabuhan');
		$this->db->join('kabkota','kabkota.kd_kabkota = pelabuhan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->from('pelabuhan');
		$this->db->join('kabkota','kabkota.kd_kabkota = pelabuhan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function addpelabuhan($data){
		$this->db->insert('pelabuhan',$data);
	}
	public function pelabuhan($id){
		$this->db->from('pelabuhan');
		$this->db->join('kabkota','kabkota.kd_kabkota = pelabuhan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detailpelabuhan($id){
		$query = $this->db->get_where('pelabuhan',array('kd_pelabuhan' => $id));
		return $query->row();
	}
	public function editpelabuhan($data){
		$this->db->where('kd_pelabuhan',$data['kd_pelabuhan']);
		$this->db->update('pelabuhan',$data);
	}
	public function deletepelabuhan($data){
		$this->db->where('kd_pelabuhan',$data['kd_pelabuhan']);
		$this->db->delete('pelabuhan',$data);
	}
}