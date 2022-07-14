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

		$this->db->select('*, nama_kelurahan as label');
		$this->db->like('nama_kelurahan', $nama_kelurahan, 'after');
		$query = $this->db->get('v_wilayah');
		return $query->result();
	}

	public function add($data)
	{
		$this->db->insert('tb_aduan', $data);
	}

	public function detail($id)
	{
		$this->db->select('*');
		$this->db->where('id_aduan', $id);
		$query = $this->db->get('v_aduan');
		return $query->row();
	}

	public function edit($data)
	{
		$this->db->where('id_aduan', $data['id_aduan']);
		$this->db->update('tb_aduan', $data);
	}
}
