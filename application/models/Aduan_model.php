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
		$hakakses = $this->session->userdata('hakakses');
		if ($hakakses != 'AD' and $hakakses != 'S' and $hakakses != '07' and $hakakses != 'PE' and $hakakses != 'JT' and $hakakses != 'AJ') {
			$this->db->where('kd_balai', $hakakses);
		}
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get('v_aduan');
		return $query->result();
	}

	public function chanel()
	{
		$query = $this->db->get('tb_chanel_aduan');
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

	public function addtanggap($data)
	{
		$this->db->where('id_aduan', $data['id_aduan']);
		$this->db->update('tb_aduan', $data);
	}

	public function koordinatjalan($id)
	{

		$this->db->select('lintasan,nm_ruas');

		$this->db->from('jalan');

		$this->db->where('lintasan !=', '');
		$this->db->where('kd_balai', $id);

		$query = $this->db->get();

		return $query->result();
	}
}
