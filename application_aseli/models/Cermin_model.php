<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cermin_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing($jln){
		$this->db->where('kd_jalan',$jln);
		$query = $this->db->get('cermin');
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
	public function ruaslisting(){
		$this->db->select('*');
		$this->db->from('jalan');
		$query = $this->db->get();
		return $query->result();
	}
	public function ruasbatas(){
		$this->db->select('*');
		$this->db->from('jalan');
		$this->db->where('kd_balai',$this->session->userdata('hakakses'));
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
		$this->db->select('MAX(RIGHT(kd_cermin, 5)) AS urutan');
		$query = $this->db->get('cermin');
		return $query->row();
	}
	public function addcermin($data){
		$this->db->insert('cermin',$data);
	}
	public function detailcermin($jln,$kd){
		$query = $this->db->get_where('cermin',array('kd_jalan' => $jln,'kd_cermin' => $kd));
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
	public function koordinatcermin(){
		$this->db->select('koordinat');
		$this->db->from('cermin');
		$query = $this->db->get();
		return $query->result();
	}
	public function cetakpdf($id){
		$this->db->select('*');
		$this->db->from('cermin');
		$this->db->join('jalan','cermin.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}
}