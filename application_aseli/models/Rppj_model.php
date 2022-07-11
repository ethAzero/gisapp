<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rppj_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing($jln){
		$this->db->where('kd_jalan',$jln);
		$query = $this->db->get('rppj');
		return $query->result();
	}
	public function loginbatas(){
		$this->db->select('*');
		$this->db->from('rppj');
		$this->db->join('jalan','rppj.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
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
		$this->db->from('rppj');
		$this->db->join('jalan','rppj.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatasbyidbalai($id){
		$this->db->select('*');
		$this->db->from('rppj');
		$this->db->join('jalan','rppj.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function kodeurut(){
		$this->db->select('MAX(RIGHT(kd_rppj, 5)) AS urutan');
		$query = $this->db->get('rppj');
		return $query->row();
	}
	public function addrppj($data){
		$this->db->insert('rppj',$data);
	}
	public function detailrppj($jln,$kd){
		$query = $this->db->get_where('rppj',array('kd_jalan' => $jln,'kd_rppj' => $kd));
		return $query->row();
	}
	public function editrppj($data){
		$this->db->where('kd_rppj',$data['kd_rppj']);
		$this->db->update('rppj',$data);
	}
	public function deleterppj($data){
		$this->db->where('kd_rppj',$data['kd_rppj']);
		$this->db->delete('rppj',$data);
	}
	public function koordinatrppj(){
		$this->db->select('koordinat');
		$this->db->from('rppj');
		$query = $this->db->get();
		return $query->result();
	}
	public function cetakpdf($id){
		$this->db->select('*');
		$this->db->from('rppj');
		$this->db->join('jalan','rppj.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}
}