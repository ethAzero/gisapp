<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Rambu_model Extends CI_Model{



	public function __construct(){

		$this->load->database();

	}

	public function listingd($jln){

		$this->db->where('kd_jalan',$jln);

		$query = $this->db->get('rambu');

		return $query->result();

	}

	public function listing($jln){

		$this->db->select('*');

		$this->db->from('rambu');

		$this->db->join('rambu_tipe','rambu_tipe.id_rambu = rambu.tipe','LEFT');

		$this->db->where('rambu.kd_jalan',$jln);

		$query = $this->db->get();

		return $query->result();

	}

	public function listingbyidbalai($id){

		$this->db->select('*');

		$this->db->from('rambu');

		$this->db->join('jalan','rambu.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}

	public function loginbatasbyidbalai($id){

		$this->db->select('*');

		$this->db->from('rambu');

		$this->db->join('jalan','rambu.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));

		$query = $this->db->get();

		return $query->result();

	}

	public function detailKlasifikasi(){

		$this->db->select('*');

		$this->db->from('rambu_klasifikasi');

		$query = $this->db->get();

		return $query->result();

	}

	public function detailJenis($value){

		$this->db->select('*');

		$this->db->from('rambu_jenis');

		$this->db->where('id_tabel',$value);

		$query = $this->db->get();

		return $query->result();

	}

	public function detailTipe($value){

		$this->db->select('*');

		$this->db->from('rambu_tipe');

		$this->db->where('id_jenis',$value);

		$query = $this->db->get();

		return $query->result();

	}

	public function loginbatas(){

		$this->db->select('*');

		$this->db->from('rambu');

		$this->db->join('jalan','rambu.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));

		$query = $this->db->get();

		return $query->result();

	}

	public function kodeurut(){

		$this->db->select('MAX(RIGHT(kd_rambu, 5)) AS urutan');

		$query = $this->db->get('rambu');

		return $query->row();

	}

	public function addrambu($data){

		$this->db->insert('rambu',$data);

	}

	public function detailrambu($jln,$kd){

		$query = $this->db->get_where('rambu',array('kd_jalan' => $jln,'kd_rambu' => $kd));

		return $query->row();

	}

	public function editrambu($data){

		$this->db->where('kd_rambu',$data['kd_rambu']);

		$this->db->update('rambu',$data);

	}

	public function deleterambu($data){

		$this->db->where('kd_jalan',$data['kd_jalan']);

		$this->db->where('kd_rambu',$data['kd_rambu']);

		$this->db->delete('rambu',$data);

	}

	public function koordinatrambu(){

		$this->db->select('koordinat');

		$this->db->from('rambu');

		$query = $this->db->get();

		return $query->result();

	}



	public function cetakpdf($id){

		$this->db->select('*');

		$this->db->from('rambu');

		$this->db->join('jalan','rambu.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->join('rambu_tipe','rambu.tipe = rambu_tipe.id_rambu','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}

	public function rambubykd($kd){
		$this->db->like('kd_rambu', $kd);
		$query = $this->db->get('rambu');
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