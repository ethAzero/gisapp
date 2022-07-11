<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daerahrawan_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota','kabkota.kd_kabkota = daerah_rawan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota','kabkota.kd_kabkota = daerah_rawan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function adddaerahrawan($data){
		$this->db->insert('daerah_rawan',$data);
	}
	public function daerahrawan($id){
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota','kabkota.kd_kabkota = daerah_rawan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detaildaerahrawan($id){
		$query = $this->db->get_where('daerah_rawan',array('kd_daerah' => $id));
		return $query->row();
	}
	public function editdaerahrawan($data){
		$this->db->where('kd_daerah',$data['kd_daerah']);
		$this->db->update('daerah_rawan',$data);
	}
	public function deletedaerahrawan($data){
		$this->db->where('kd_daerah',$data['kd_daerah']);
		$this->db->delete('daerah_rawan',$data);
	}


	public function getjalan(){

		
		$this->db->order_by('nm_ruas','ASC');
		$query = $this->db->get('jalan');

		return $query->result();

	}

	public function list_detaildaerah(){
		$this->db->from('detail_drk');
		$this->db->join('daerah_rawan','detail_drk.kd_daerah = daerah_rawan.kd_daerah','INNER');
		$query = $this->db->get();
		return $query->result();
	}

	public function add_detaildaerah($data){
		$this->db->insert('detail_drk',$data);
	}

	public function listing1(){
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota','kabkota.kd_kabkota = daerah_rawan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->join('jalan','jalan.kd_jalan = daerah_rawan.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	
}