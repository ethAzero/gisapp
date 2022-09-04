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
}
