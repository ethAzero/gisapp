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
		// $this->db->from('apil');
		// $query = $this->db->get();
		// return $query->result();

		$this->db->select('*');
		$this->db->from('apil');
		$this->db->join('jalan', 'jalan.kd_jalan = apil.kd_jalan', 'LEFT');
		$this->db->where('apil.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function updatehistory($data)
	{
		$this->db->insert('history', $data);
	}
}
