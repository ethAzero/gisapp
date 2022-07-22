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
		$this->db->select('
		tb_aduan.id_aduan,
		tb_aduan.aduan,
		tb_aduan.id_kelurahan,
		tb_aduan.created_at AS created_at,
		tb_aduan.updated_at,
		tb_aduan.read_at,
		tb_aduan.tanggap_at,
		tb_aduan.kewenangan,
		tb_aduan.tanggapan,
		tb_aduan.kd_jalan,
		tb_aduan.stat_read,
		tb_aduan.stat_readtanggap,
		tb_aduan.stat_tanggap,
		tb_kelurahan.id_kecamatan,
		tb_kelurahan.nama AS nama_kelurahan,
		tb_kelurahan.jenis,
		tb_kecamatan.id_kota_kabupaten,
		tb_kecamatan.nama AS nama_kecamatan,
		kabkota.kd_balai,
		kabkota.nm_kabkota,
		balai.nm_balai,
		tb_aduan.id_chanel_aduan,
		tb_chanel_aduan.chanel_aduan
		');
		$this->db->from('tb_aduan');
		$this->db->join('tb_kelurahan', 'tb_aduan.id_kelurahan = tb_kelurahan.id');
		$this->db->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan = tb_kecamatan.id');
		$this->db->join('kabkota', 'tb_kecamatan.id_kota_kabupaten = kabkota.kd_kabkota');
		$this->db->join('balai', 'kabkota.kd_balai = balai.kd_balai');
		$this->db->join('tb_chanel_aduan', 'tb_aduan.id_chanel_aduan = tb_chanel_aduan.id');

		// jika hak akses sebagai balai maka data yang ditampilkan aduan per balai
		if ($hakakses != 'AD' and $hakakses != 'S' and $hakakses != '07' and $hakakses != 'PE' and $hakakses != 'JT' and $hakakses != 'AJ') {
			$this->db->where('kabkota.kd_balai', $hakakses);
		}
		$this->db->group_by('id_aduan');
		$this->db->order_by('created_at', 'DESC');
		return $this->db->get()->result();
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
		$this->db->select('
		tb_aduan.id_aduan AS id_aduan,
		tb_aduan.aduan,
		tb_aduan.id_kelurahan,
		tb_aduan.created_at,
		tb_aduan.updated_at,
		tb_aduan.read_at,
		tb_aduan.tanggap_at,
		tb_aduan.kewenangan,
		tb_aduan.tanggapan,
		tb_aduan.kd_jalan,
		tb_aduan.stat_read,
		tb_aduan.stat_readtanggap,
		tb_aduan.stat_tanggap,
		tb_aduan.kd_jalan,
		tb_kelurahan.id_kecamatan,
		tb_kelurahan.nama AS nama_kelurahan,
		tb_kelurahan.jenis,
		tb_kecamatan.id_kota_kabupaten,
		tb_kecamatan.nama AS nama_kecamatan,
		kabkota.kd_balai,
		kabkota.nm_kabkota,
		balai.nm_balai,
		tb_aduan.id_chanel_aduan,
		tb_chanel_aduan.chanel_aduan,
		');
		$this->db->from('tb_aduan');
		$this->db->join('tb_kelurahan', 'tb_aduan.id_kelurahan = tb_kelurahan.id');
		$this->db->join('tb_kecamatan', 'tb_kelurahan.id_kecamatan = tb_kecamatan.id');
		$this->db->join('kabkota', 'tb_kecamatan.id_kota_kabupaten = kabkota.kd_kabkota');
		$this->db->join('balai', 'kabkota.kd_balai = balai.kd_balai');
		$this->db->join('tb_chanel_aduan', 'tb_aduan.id_chanel_aduan = tb_chanel_aduan.id');
		$this->db->where('id_aduan', $id);

		return $this->db->get()->row();
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
