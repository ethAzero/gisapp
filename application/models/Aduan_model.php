<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aduan_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	public function listing()
	{
		$query = $this->db->get('v_aduan');
		return $query->result();
	}
	public function getKelurahan($nama_kelurahan)
	{

		$this->db->like('nama_kelurahan', $nama_kelurahan, 'after');
		$query = $this->db->get('v_wilayah');
		return $query->result();
	}
}
