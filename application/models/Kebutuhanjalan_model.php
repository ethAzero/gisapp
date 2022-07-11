<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Kebutuhanjalan_model Extends CI_Model{



	public function __construct(){

		$this->load->database();

	}


	public function getkebutuhan(){

		$this->db->select('*');

		$this->db->from('keperluan_jalan');

		$query = $this->db->get();

		return $query->result();

	}

	public function addkebutuhan($data){

		$insert = $this->db->insert_batch('keperluan_jalan',$data);

		if($insert){
			return true;
		}

	}

	public function detailkebutuhan($id){

		$this->db->select('*');

		$this->db->from('keperluan_jalan');

		$this->db->where('no',$id);

		$query = $this->db->get();

		return $query->row();

	}

	public function deletekebutuhan($data){

		$this->db->where('no',$data['no']);
		$this->db->delete('keperluan_jalan',$data);

	}

	public function editkebutuhan($data){

		$this->db->where('no',$data['no']);

		$this->db->update('keperluan_jalan',$data);

	}

	public function listingbyidbalai($id){

		$this->db->select('*');

		$this->db->from('apil');

		$this->db->join('jalan','apil.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}

	public function loginbatasbyidbalai($id){

		$this->db->select('*');

		$this->db->from('apil');

		$this->db->join('jalan','apil.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$this->db->where('jalan.kd_balai',$this->session->userdata('hakakses'));

		$query = $this->db->get();

		return $query->result();

	}

	public function kodeurut(){

		$this->db->select('MAX(RIGHT(kd_apil, 5)) AS urutan');

		$query = $this->db->get('apil');

		return $query->row();

	}

	public function addapil($data){

		$this->db->insert('apil',$data);

	}

	public function detailapil($jln,$kd){

		$query = $this->db->get_where('apil',array('kd_jalan' => $jln,'kd_apil' => $kd));

		return $query->row();

	}

	public function editapil($data){

		$this->db->where('kd_apil',$data['kd_apil']);

		$this->db->update('apil',$data);

	}

	public function deleteapil($data){

		$this->db->where('kd_jalan',$data['kd_jalan']);

		$this->db->where('kd_apil',$data['kd_apil']);

		$this->db->delete('apil',$data);

	}

	public function koordinatapil(){

		$this->db->select('koordinat');

		$this->db->from('apil');

		$query = $this->db->get();

		return $query->result();

	}

	public function cetakpdf($id){

		$this->db->select('*');

		$this->db->from('apil');

		$this->db->join('jalan','apil.kd_jalan = jalan.kd_jalan','LEFT');

		$this->db->where('jalan.kd_jalan',$id);

		$query = $this->db->get();

		return $query->result();

	}


	public function apilbykd($kd){
		$this->db->like('kd_apil', $kd);
		$query = $this->db->get('apil');
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