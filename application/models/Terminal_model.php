<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terminal_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->from('terminal');
		$this->db->join('kabkota','kabkota.kd_kabkota = terminal.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas(){
		$this->db->from('terminal');
		$this->db->join('kabkota','kabkota.kd_kabkota = terminal.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function addterminal($data){
		$this->db->insert('terminal',$data);
	}
	public function terminal($id){
		$this->db->from('terminal');
		$this->db->join('kabkota','kabkota.kd_kabkota = terminal.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detailterminal($id){
		$query = $this->db->get_where('terminal',array('kd_terminal' => $id));
		return $query->row();
	}
	public function editterminal($data){
		$this->db->where('kd_terminal',$data['kd_terminal']);
		$this->db->update('terminal',$data);
	}
	public function deleteterminal($data){
		$this->db->where('kd_terminal',$data['kd_terminal']);
		$this->db->delete('terminal',$data);
	}


	public function datadukung($id){
		$query = $this->db->get_where('detail_terminal',array('kd_terminal' => $id));
		return $query->result();
	}

	public function adddetailterminal($data){
		$this->db->insert('detail_terminal',$data);
	}

	public function deletedatadukung($id){
		$this->db->where('id',$id);
		$this->db->delete('detail_terminal');
	}

	public function detaildatadukung($id){
		$this->db->from('detail_terminal');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->row();
	}
}