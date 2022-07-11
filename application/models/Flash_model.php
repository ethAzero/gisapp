<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Flash_model Extends CI_Model{



	public function __construct(){

		$this->load->database();

	}

	public function listing($jln){

		$this->db->where('kd_jalan',$jln);

		$query = $this->db->get('flash');

		return $query->result();

	}

	public function loginbatas(){

		$this->db->select('*');

		$this->db->from('flash');

		$this->db->join('jalan','flash.kd_jalan = jalan.kd_jalan','LEFT');

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

	public function listingbyidbalai($id){

		$this->db->select('*');

		$this->db->from('flash');

		$this->db->join('jalan','flash.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}

	public function loginbatasbyidbalai($id){

		$this->db->select('*');

		$this->db->from('flash');

		$this->db->join('jalan','flash.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));

		$query = $this->db->get();

		return $query->result();

	}

	public function kodeurut(){

		$this->db->select('MAX(RIGHT(kd_flash, 5)) AS urutan');

		$query = $this->db->get('flash');

		return $query->row();

	}

	public function addflash($data){

		$this->db->insert('flash',$data);

	}

	public function detailflash($jln,$kd){

		$query = $this->db->get_where('flash',array('kd_jalan' => $jln,'kd_flash' => $kd));

		return $query->row();

	}

	public function editflash($data){

		$this->db->where('kd_flash',$data['kd_flash']);

		$this->db->update('flash',$data);

	}

	public function deleteflash($data){

		$this->db->where('kd_flash',$data['kd_flash']);

		$this->db->delete('flash',$data);

	}

	public function koordinatflash(){

		$this->db->select('koordinat');

		$this->db->from('flash');

		$query = $this->db->get();

		return $query->result();

	}

	public function cetakpdf($id){

		$this->db->select('*');

		$this->db->from('flash');

		$this->db->join('jalan','flash.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}


	public function flashbykd($kd){
		$this->db->like('kd_flash', $kd);
		$query = $this->db->get('flash');
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