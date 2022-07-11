<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jalan_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function listing(){
		$this->db->select('kd_jalan,no_ruas,jln_fungsi,nm_ruas,jln_panjang,nm_balai,jalan.kd_balai');
		$this->db->from('jalan');
		$this->db->join('balai','balai.kd_balai = jalan.kd_balai','LEFT');
		$this->db->order_by('jalan.no_ruas','ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->select('kd_jalan,nm_ruas,jln_panjang,nm_balai,jalan.kd_balai');
		$this->db->from('jalan');
		$this->db->join('balai','balai.kd_balai = jalan.kd_balai','LEFT');
		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}

	public function jalan($id){

		$query = $this->db->get_where('jalan',array('kd_balai' => $id));

		return $query->result();

	}

	public function viewjalan(){

		$this->db->order_by('no_ruas','ASC');

		$query = $this->db->get('jalan');

		return $query->result();

	}

	public function viewjalan2(){

		$this->db->select('*');

		$this->db->from('jalan');

		$this->db->join('balai','balai.kd_balai = jalan.kd_balai','LEFT');

		$this->db->order_by('jalan.kd_balai','ASC');

		$query = $this->db->get();

		return $query->result();

	}

	public function kodeurut(){

		$this->db->select('MAX(RIGHT(kd_jalan, 3)) AS urutan');

		$query = $this->db->get('jalan');

		return $query->row();

	}

	public function add($data){

		$this->db->insert('jalan',$data);

	}

	public function detail($id){

		$query = $this->db->get_where('jalan',array('kd_jalan' => $id));

		return $query->row();

	}

	public function edit($data){

		$this->db->where('kd_jalan',$data['kd_jalan']);

		$this->db->update('jalan',$data);

	}

	public function delete($data){

		$this->db->where('kd_jalan',$data['kd_jalan']);

		$this->db->delete('jalan',$data);

	}



	public function koordinatjalan(){

		$this->db->select('lintasan,nm_ruas');

		$this->db->from('jalan');

		$this->db->where('lintasan !=','');

		$query = $this->db->get();

		return $query->result();

	}

}