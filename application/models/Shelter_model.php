<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shelter_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function listing(){
		$this->db->join('arah_shelter', 'shelter.arah = arah_shelter.kd_arah', 'inner');
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

	public function listarah(){
		$this->db->order_by('created_at','ASC');
		$query = $this->db->get('arah_shelter');
		return $query->result();
	}
}