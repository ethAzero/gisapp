<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perlintasan_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	public function listing()
	{
		$this->db->from('perlintasan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = perlintasan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas()
	{
		$this->db->from('perlintasan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = perlintasan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$this->db->where('balai.kd_balai', $this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}
	public function addperlintasan($data)
	{
		$this->db->insert('perlintasan', $data);
	}
	public function perlintasan($id)
	{
		$this->db->from('perlintasan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = perlintasan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detailperlintasan($id)
	{
		$query = $this->db->get_where('perlintasan', array('kd_perlintasan' => $id));
		return $query->row();
	}
	public function editperlintasan($data)
	{
		$this->db->where('kd_perlintasan', $data['kd_perlintasan']);
		$this->db->update('perlintasan', $data);
	}
	public function deleteperlintasan($data)
	{
		$this->db->where('kd_perlintasan', $data['kd_perlintasan']);
		$this->db->delete('perlintasan', $data);
	}
	public function kodeurut()
	{
		$this->db->select('MAX(RIGHT(kd_perlintasan, 4)) AS urutan');
		$query = $this->db->get('perlintasan');
		return $query->row();
	}

	public function datadukung($id)
	{
		$query = $this->db->get_where('tb_dakung_perlintasan', array('kd_perlintasan' => $id));
		return $query->result();
	}

	public function adddetailperlintasan($data)
	{
		$this->db->insert('tb_dakung_perlintasan', $data);
	}
	public function deletedatadukung($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('tb_dakung_perlintasan');
	}

	public function detaildatadukung($id)
	{
		$this->db->from('tb_dakung_perlintasan');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}
}
