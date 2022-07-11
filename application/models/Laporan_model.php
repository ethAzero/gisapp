<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->select('kd_jalan,no_ruas,nm_ruas,jln_panjang,nm_balai');
		$this->db->from('jalan');
		$this->db->join('balai','balai.kd_balai = jalan.kd_balai','LEFT');
		$this->db->order_by('jalan.no_ruas','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->select('kd_jalan,no_ruas,nm_ruas,jln_panjang,nm_balai');
		$this->db->from('jalan');
		$this->db->join('balai','balai.kd_balai = jalan.kd_balai','LEFT');
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}

	public function getRuas($id){
		$this->db->select('*');
		$this->db->from('jalan');
		$this->db->join('rambu','rambu.kd_jalan  = jalan.kd_jalan','LEFT');
		$this->db->join('rambu_tipe','rambu_tipe.id_rambu  = rambu.tipe','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
}