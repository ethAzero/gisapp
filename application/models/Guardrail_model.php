<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Guardrail_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listing($jln){
		$this->db->where('kd_jalan',$jln);
		$query = $this->db->get('guardrail');
		return $query->result();
	}

	public function loginbatas(){
		$this->db->select('*');
		$this->db->from('guardrail');
		$this->db->join('jalan','guardrail.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}

	public function kodeurut(){
		$this->db->select('MAX(RIGHT(kd_guardrail, 5)) AS urutan');
		$query = $this->db->get('guardrail');
		return $query->row();
	}

	public function addguardrail($data){
		$this->db->insert('guardrail',$data);
	}

	public function detailguardrail($jln,$gd){
		$query = $this->db->get_where('guardrail',array('kd_jalan' => $jln,'kd_guardrail' => $gd));
		return $query->row();
	}

	public function deleteguardrail($data){
		$this->db->where('kd_guardrail',$data['kd_guardrail']);
		$this->db->delete('guardrail',$data);
	}

	public function editguardrail($data){
		$this->db->where('kd_guardrail',$data['kd_guardrail']);
		$this->db->update('guardrail',$data);
	}

	public function koordinatguardrail(){
		$this->db->select('koordinat');
		$this->db->from('guardrail');
		$query = $this->db->get();
		return $query->result();
	}

	public function cetakpdf($id){
		$this->db->select('*');
		$this->db->from('guardrail');
		$this->db->join('jalan','guardrail.kd_jalan = jalan.kd_jalan','LEFT');
		$this->db->where('jalan.kd_jalan',$id);
		$query = $this->db->get();
		return $query->result();
	}

		public function guardrailbykd($kd){
		$this->db->like('kd_guardrail', $kd);
		$query = $this->db->get('guardrail');
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