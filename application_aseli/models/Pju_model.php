<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pju_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing($jln){
		$this->db->where('kd_jalan',$jln);
		$query = $this->db->get('pju');
		return $query->result();
	}

	public function loginbatas(){
		$this->db->select('*');
		$this->db->from('pju');
		$this->db->join('jalan','pju.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function kodeurut(){
		$this->db->select('MAX(RIGHT(kd_pju, 5)) AS urutan');
		$query = $this->db->get('pju');
		return $query->row();
	}
	public function addpju($data){
		$this->db->insert('pju',$data);
	}
	public function detailpju($jln,$kd){
		$query = $this->db->get_where('pju',array('kd_jalan' => $jln,'kd_pju' => $kd));
		return $query->row();
	}
	public function editpju($data){
		$this->db->where('kd_pju',$data['kd_pju']);
		$this->db->update('pju',$data);
	}
	public function deletepju($data){
		$this->db->where('kd_jalan',$data['kd_jalan']);
		$this->db->where('kd_pju',$data['kd_pju']);
		$this->db->delete('pju',$data);
	}
	public function koordinatpju(){
		$this->db->select('koordinat');
		$this->db->from('pju');
		$query = $this->db->get();
		return $query->result();
	}
	public function cetakpdf($id){
		$this->db->select('*');
		$this->db->from('pju');
		$this->db->join('jalan','pju.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function cetakexcel($id){
		$this->db->select('*');
		$this->db->from('pju');
		$this->db->join('jalan','pju.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}
}