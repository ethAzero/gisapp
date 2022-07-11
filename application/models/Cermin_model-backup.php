<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cermin_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->select('*');
		$this->db->from('cermin');
		$this->db->join('jalan','cermin.kd_jalan = jalan.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->select('*');
		$this->db->from('cermin');
		$this->db->join('jalan','cermin.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function listingbyidbalai($id){
		$this->db->select('*');
		$this->db->from('cermin');
		$this->db->join('jalan','cermin.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatasbyidbalai($id){
		$this->db->select('*');
		$this->db->from('cermin');
		$this->db->join('jalan','cermin.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function kodeurut(){
		$this->db->select('MAX(RIGHT(kd_cermin, 4)) AS urutan');
		$query = $this->db->get('cermin');
		return $query->row();
	}
	public function addcermin($data){
		$this->db->insert('cermin',$data);
	}
	public function detailcermin($id){
		$query = $this->db->get_where('cermin',array('kd_cermin' => $id));
		return $query->row();
	}
	public function editcermin($data){
		$this->db->where('kd_cermin',$data['kd_cermin']);
		$this->db->update('cermin',$data);
	}
	public function deletecermin($data){
		$this->db->where('kd_cermin',$data['kd_cermin']);
		$this->db->delete('cermin',$data);
	}
}