<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Delinator_model Extends CI_Model{



	public function __construct(){

		$this->load->database();

	}

	public function listing($jln){

		$this->db->where('kd_jalan',$jln);

		$query = $this->db->get('delinator');

		return $query->result();

	}

	public function loginbatas(){

		$this->db->select('*');

		$this->db->from('delinator');

		$this->db->join('jalan','delinator.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));

		$query = $this->db->get();

		return $query->result();

	}

	public function ruaslisting(){

		$this->db->select('*');

		$this->db->from('jalan');

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

		$this->db->from('delinator');

		$this->db->join('jalan','delinator.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}

	public function loginbatasbyidbalai($id){

		$this->db->select('*');

		$this->db->from('delinator');

		$this->db->join('jalan','delinator.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));

		$query = $this->db->get();

		return $query->result();

	}

	public function kodeurut(){

		$this->db->select('MAX(RIGHT(kd_delinator, 5)) AS urutan');

		$query = $this->db->get('delinator');

		return $query->row();

	}

	public function adddelinator($data){

		$this->db->insert('delinator',$data);

	}

	public function detaildelinator($jln,$kd){

		$query = $this->db->get_where('delinator',array('kd_jalan' => $jln,'kd_delinator' => $kd));

		return $query->row();

	}

	public function editdelinator($data){

		$this->db->where('kd_delinator',$data['kd_delinator']);

		$this->db->update('delinator',$data);

	}

	public function deletedelinator($data){

		$this->db->where('kd_jalan',$data['kd_jalan']);

		$this->db->where('kd_delinator',$data['kd_delinator']);

		$this->db->delete('delinator',$data);

	}

	public function koordinatdelinator(){

		$this->db->select('koordinat');

		$this->db->from('delinator');

		$query = $this->db->get();

		return $query->result();

	}

	public function cetakpdf($id){

		$this->db->select('*');

		$this->db->from('delinator');

		$this->db->join('jalan','delinator.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}


	public function delinatorbykd($kd){
		$this->db->like('kd_delinator', $kd);
		$query = $this->db->get('delinator');
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