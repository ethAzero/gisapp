<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marka_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listing($jln){
		$this->db->where('kd_jalan',$jln);
		$query = $this->db->get('marka');
		return $query->result();
	}

	public function loginbatas(){
		$this->db->select('*');
		$this->db->from('marka');
		$this->db->join('jalan','marka.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}

	public function kodeurut(){
		$this->db->select('MAX(RIGHT(kd_marka, 5)) AS urutan');
		$query = $this->db->get('marka');
		return $query->row();
	}

	public function addmarka($data){
		$this->db->insert('marka',$data);
	}

	public function detailmarka($jln,$gd){
		$query = $this->db->get_where('marka',array('kd_jalan' => $jln,'kd_marka' => $gd));
		return $query->row();
	}

	public function deletemarka($data){
		$this->db->where('kd_marka',$data['kd_marka']);
		$this->db->delete('marka',$data);
	}

	public function editmarka($data){
		$this->db->where('kd_marka',$data['kd_marka']);
		$this->db->update('marka',$data);
	}

	public function koordinatmarka(){
		$this->db->select('koordinat');
		$this->db->from('marka');
		$query = $this->db->get();
		return $query->result();
	}

	public function cetakpdf($id){
		$this->db->select('*');
		$this->db->from('marka');
		$this->db->join('jalan','marka.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function markabykd($kd){
		$this->db->like('kd_marka', $kd);
		$query = $this->db->get('marka');
		return $query->result();
	}

	public function jalanprovinsi($jalan){
		$this->db->select('lintasan,nm_ruas');
		$this->db->from('jalan');
		$this->db->where('kd_jalan',$jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function jlnprovbykd($jln){
		$this->db->where('kd_jalan',$jln);
		$query = $this->db->get('jalan');
		return $query->row();

	}
}