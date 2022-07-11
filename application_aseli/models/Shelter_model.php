<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelter_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$query = $this->db->get('shelter');
		return $query->result();
	}
	public function addshelter($data){
		$this->db->insert('shelter',$data);
	}
	public function detailshelter($id){
		$query = $this->db->get_where('shelter',array('kd_shelter' => $id));
		return $query->row();
	}
	public function editshelter($data){
		$this->db->where('kd_shelter',$data['kd_shelter']);
		$this->db->update('shelter',$data);
	}
	public function deleteshelter($data){
		$this->db->where('kd_shelter',$data['kd_shelter']);
		$this->db->delete('shelter',$data);
	}
}