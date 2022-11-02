<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Daerahrawan_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}
	public function listing()
	{
		$this->db->select('daerah_rawan.kd_daerah,
		daerah_rawan.kd_kabkota,
		daerah_rawan.kd_jalan,
		daerah_rawan.nm_daerah,
		daerah_rawan.lat,
		daerah_rawan.lang,
		daerah_rawan.ket_daerah,
		daerah_rawan.img_daerah,
		daerah_rawan.`status`,
		daerah_rawan.status_jalan,
		daerah_rawan.status_drk,
		jalan.nm_ruas,
		kabkota.nm_kabkota,
		kabkota.kd_balai');
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = daerah_rawan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$this->db->join('jalan', 'jalan.kd_jalan = daerah_rawan.kd_jalan', 'LEFT');
		$this->db->where('daerah_rawan.`status`', 1);
		$query = $this->db->get();
		return $query->result();
	}
	public function loginbatas()
	{
		$this->db->select('daerah_rawan.kd_daerah,
		daerah_rawan.kd_kabkota,
		daerah_rawan.kd_jalan,
		daerah_rawan.nm_daerah,
		daerah_rawan.lat,
		daerah_rawan.lang,
		daerah_rawan.ket_daerah,
		daerah_rawan.img_daerah,
		daerah_rawan.`status`,
		daerah_rawan.status_jalan,
		daerah_rawan.status_drk,
		jalan.nm_ruas,
		kabkota.nm_kabkota,
		kabkota.kd_balai');
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = daerah_rawan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$this->db->join('jalan', 'jalan.kd_jalan = daerah_rawan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $this->session->userdata('hakakses'));
		$this->db->where('daerah_rawan.`status`', 1);
		$query = $this->db->get();
		return $query->result();
	}
	public function adddaerahrawan($data)
	{
		$this->db->insert('daerah_rawan', $data);
	}
	public function daerahrawan($id)
	{
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = daerah_rawan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function detaildaerahrawan($id)
	{
		$this->db->select('daerah_rawan.kd_daerah,
		daerah_rawan.kd_kabkota,
		daerah_rawan.kd_jalan,
		daerah_rawan.nm_daerah,
		daerah_rawan.lat,
		daerah_rawan.lang,
		daerah_rawan.ket_daerah,
		daerah_rawan.img_daerah,
		daerah_rawan.`status`,
		daerah_rawan.status_jalan,
		daerah_rawan.status_drk,
		jalan.nm_ruas,
		kabkota.nm_kabkota,
		kabkota.kd_balai');
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = daerah_rawan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$this->db->join('jalan', 'jalan.kd_jalan = daerah_rawan.kd_jalan', 'LEFT');
		$this->db->where('kd_daerah', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function listrekom($id)
	{
		$this->db->from('tb_rekom_drk');
		$this->db->where('kd_daerah', $id);
		$query = $this->db->get();
		return $query->result();
	}
	public function editdaerahrawan($data)
	{
		$this->db->where('kd_daerah', $data['kd_daerah']);
		$this->db->update('daerah_rawan', $data);
	}
	public function deletedaerahrawan($data)
	{
		$this->db->where('kd_daerah', $data['kd_daerah']);
		$this->db->delete('daerah_rawan', $data);
	}


	public function getjalan()
	{

		$this->db->order_by('nm_ruas', 'ASC');
		if ($this->session->userdata('hakakses') != "LL") {
			$this->db->where('kd_balai', $this->session->userdata('hakakses'));
		}
		$query = $this->db->get('jalan');

		return $query->result();
	}

	public function list_detaildaerah()
	{
		$this->db->from('tb_rekom_drk');
		$this->db->join('daerah_rawan', 'tb_rekom_drk.kd_daerah = daerah_rawan.kd_daerah', 'INNER');
		$query = $this->db->get();
		return $query->result();
	}

	public function add_detaildaerah($data)
	{
		$this->db->insert('tb_rekom_drk', $data);
	}

	public function listing1()
	{
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota', 'kabkota.kd_kabkota = daerah_rawan.kd_kabkota', 'LEFT');
		$this->db->join('balai', 'balai.kd_balai = kabkota.kd_balai', 'LEFT');
		$this->db->join('jalan', 'jalan.kd_jalan = daerah_rawan.kd_jalan', 'LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	public function addrekomdrk($data)
	{
		$this->db->insert('tb_rekom_drk', $data);
	}
	public function editrekomdrk($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('tb_rekom_drk', $data);
	}
	public function detailrekomdrk($id)
	{
		$this->db->from('tb_rekom_drk');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	public function detailkejadian($id)
	{
		$this->db->from('tb_kejadian_drk');
		$this->db->where('kd_daerah', $id);
		$query = $this->db->get();
		return $query->result();
	}
}
