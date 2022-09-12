<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Survay_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function koordinatjalan()
	{
		$hakakses = $this->session->userdata('hakakses');
		$this->db->select('kd_jalan,nm_ruas,lintasan');
		$this->db->from('jalan');
		$this->db->where('lintasan !=', '');
		$this->db->where('kd_balai', $hakakses);
		$query = $this->db->get();
		return $query->result();
	}

	public function detailjalan($kd_jalan)
	{
		$this->db->select('kd_jalan,nm_ruas');
		$this->db->from('jalan');
		$this->db->where('kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->row();
	}

	public function getApill($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('apil');
		$this->db->join('jalan', 'jalan.kd_jalan = apil.kd_jalan', 'LEFT');
		$this->db->where('apil.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCermin($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('cermin');
		$this->db->join('jalan', 'jalan.kd_jalan = cermin.kd_jalan', 'LEFT');
		$this->db->where('cermin.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getDelinator($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('delinator');
		$this->db->join('jalan', 'jalan.kd_jalan = delinator.kd_jalan', 'LEFT');
		$this->db->where('delinator.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getFlash($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('flash');
		$this->db->join('jalan', 'jalan.kd_jalan = flash.kd_jalan', 'LEFT');
		$this->db->where('flash.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getGuardrail($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('guardrail');
		$this->db->join('jalan', 'jalan.kd_jalan = guardrail.kd_jalan', 'LEFT');
		$this->db->where('guardrail.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getMarka($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('marka');
		$this->db->join('jalan', 'jalan.kd_jalan = marka.kd_jalan', 'LEFT');
		$this->db->where('marka.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getPju($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('pju');
		$this->db->join('jalan', 'jalan.kd_jalan = pju.kd_jalan', 'LEFT');
		$this->db->where('pju.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRambu($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('rambu');
		$this->db->join('jalan', 'jalan.kd_jalan = rambu.kd_jalan', 'LEFT');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe', 'LEFT');
		$this->db->where('rambu.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRambuById($id)
	{
		$this->db->select('*');
		$this->db->from('rambu');
		$this->db->join('jalan', 'jalan.kd_jalan = rambu.kd_jalan', 'LEFT');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe', 'LEFT');
		$this->db->where('rambu.kd_rambu', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getRppj($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('rppj');
		$this->db->join('jalan', 'jalan.kd_jalan = rppj.kd_jalan', 'LEFT');
		$this->db->where('rppj.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function tipeRambu($id_jenis)
	{
		$this->db->select('*');
		$this->db->from('rambu_tipe');
		$this->db->where('rambu_tipe.id_jenis', $id_jenis);
		$query = $this->db->get();
		return $query->result();
	}

	public function updatehistory($data)
	{
		$this->db->insert('history', $data);
	}

	public function datalaporanpju($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_pju as Kode PJU,
		pju.kd_jalan as Kode Jalan, 
		nm_ruas as Ruas Jalan,
		km_lokasi as Km Lokasi,
		img_pju as Photo
		');
		$this->db->from('pju');
		$this->db->join('jalan', 'jalan.kd_jalan = pju.kd_jalan', 'LEFT');
		$this->db->where('DATE(pju.updated_at)', $tanggalsurvei);
		$this->db->where('pju.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelpju($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_pju,
		pju.kd_jalan, 
		nm_ruas,
		km_lokasi,
		img_pju
		');
		$this->db->from('pju');
		$this->db->join('jalan', 'jalan.kd_jalan = pju.kd_jalan', 'LEFT');
		$this->db->where('DATE(pju.updated_at)', $tanggalsurvei);
		$this->db->where('pju.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}
	public function datalaporanapil($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_apil as Kode APILL,
		apil.kd_jalan as Kode Jalan, 
		nm_ruas as Ruas Jalan,
		km_lokasi as Km Lokasi,
		img_apil as Photo
		');
		$this->db->from('apil');
		$this->db->join('jalan', 'jalan.kd_jalan = apil.kd_jalan', 'LEFT');
		$this->db->where('DATE(apil.updated_at)', $tanggalsurvei);
		$this->db->where('apil.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}
}
