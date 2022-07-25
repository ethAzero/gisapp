<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function detailbalai($id)
	{
		$query = $this->db->get_where('balai', array('kd_balai' => $id));
		return $query->row();
	}

	public function detailruas($balai, $jalan)
	{
		$query = $this->db->get_where('jalan', array('kd_balai' => $balai, 'kd_jalan' => $jalan));
		return $query->row();
	}

	public function jalanprovinsi($jalan)
	{
		$this->db->select('lintasan,nm_ruas');
		$this->db->from('jalan');
		$this->db->where('kd_jalan', $jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function listbalai()
	{
		$this->db->where('kd_balai !=', '07');
		$query = $this->db->get('balai');
		return $query->result();
	}

	public function jmlruasperbalai($id)
	{
		$this->db->select('count(kd_balai) AS jumlah, sum(jln_panjang) AS panjang');
		$query = $this->db->get_where('jalan', array('kd_balai' => $id));
		return $query->row();
	}

	public function percentapill($id)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT jalan.kd_jalan) AS percen FROM apil LEFT JOIN jalan ON apil.kd_jalan = jalan.kd_jalan WHERE apil.status != 'Kebutuhan' AND jalan.kd_balai = '$id'");
		return $query->row();
	}
	public function realapil($id)
	{
		$query = $this->db->query("SELECT COUNT(apil) AS jumlah FROM jalan WHERE apil = '1' AND kd_balai = '$id'");
		return $query->row();
	}
	public function progressapil($id)
	{
		$this->db->select('jalan.kd_balai, jalan.kd_jalan, jalan.nm_ruas, jalan.jln_panjang');
		$this->db->from('balai,jalan');
		$this->db->where('balai.kd_balai = jalan.kd_balai');
		$this->db->join('apil', 'apil.kd_jalan = jalan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$this->db->group_by('jalan.kd_jalan');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapapil($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM apil WHERE kd_jalan = $id");
		return $query->result();
	}
	public function viewapill($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('apil');
		return $query->result();
	}

	public function viewdelinator($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('delinator');
		return $query->result();
	}


	public function rekapdelinator($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM delinator WHERE kd_jalan = $id");
		return $query->result();
	}


	public function percentcermin($id)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT jalan.kd_jalan) AS percen FROM cermin LEFT JOIN jalan ON cermin.kd_jalan = jalan.kd_jalan WHERE cermin.status != 'Kebutuhan' AND  jalan.kd_balai = '$id'");
		return $query->row();
	}
	public function realcermin($id)
	{
		$query = $this->db->query("SELECT COUNT(cermin) AS jumlah FROM jalan WHERE cermin = '1' AND kd_balai = '$id'");
		return $query->row();
	}
	public function progresscermin($id)
	{
		$this->db->select('jalan.kd_balai,jalan.kd_jalan, jalan.nm_ruas, jalan.jln_panjang');
		$this->db->from('balai,jalan');
		$this->db->where('balai.kd_balai = jalan.kd_balai');
		$this->db->join('cermin', 'cermin.kd_jalan = jalan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$this->db->group_by('jalan.kd_jalan');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapcermin($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM cermin WHERE kd_jalan = $id");
		return $query->result();
	}
	public function viewcermin($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('cermin');
		return $query->result();
	}

	public function percentpju($id)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT jalan.kd_jalan) AS percen FROM pju LEFT JOIN jalan ON pju.kd_jalan = jalan.kd_jalan WHERE pju.status != 'Kebutuhan'  AND jalan.kd_balai = '$id'");
		return $query->row();
	}
	public function realpju($id)
	{
		$query = $this->db->query("SELECT COUNT(pju) AS jumlah FROM jalan WHERE pju = '1' AND kd_balai = '$id'");
		return $query->row();
	}
	public function progresspju($id)
	{
		$this->db->select('jalan.kd_balai,jalan.kd_jalan, jalan.nm_ruas, jalan.jln_panjang');
		$this->db->from('balai,jalan');
		$this->db->where('balai.kd_balai = jalan.kd_balai');
		$this->db->join('pju', 'pju.kd_jalan = jalan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$this->db->group_by('jalan.kd_jalan');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekappju($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM pju WHERE kd_jalan = $id");
		return $query->result();
	}
	public function viewpju($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('pju');
		return $query->result();
	}

	public function percentflash($id)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT jalan.kd_jalan) AS percen FROM flash LEFT JOIN jalan ON flash.kd_jalan = jalan.kd_jalan WHERE flash.status != 'Kebutuhan' AND jalan.kd_balai = '$id'");
		return $query->row();
	}
	public function realflash($id)
	{
		$query = $this->db->query("SELECT COUNT(flash) AS jumlah FROM jalan WHERE flash = '1' AND kd_balai = '$id'");
		return $query->row();
	}
	public function progressflash($id)
	{
		$this->db->select('jalan.kd_balai,jalan.kd_jalan, jalan.nm_ruas, jalan.jln_panjang');
		$this->db->from('balai,jalan');
		$this->db->where('balai.kd_balai = jalan.kd_balai');
		$this->db->join('flash', 'flash.kd_jalan = jalan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$this->db->group_by('jalan.kd_jalan');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapflash($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM flash WHERE kd_jalan = $id");
		return $query->result();
	}
	public function viewflash($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('flash');
		return $query->result();
	}

	public function percentrambu($id)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT jalan.kd_jalan) AS percen FROM rambu LEFT JOIN jalan ON rambu.kd_jalan = jalan.kd_jalan WHERE rambu.status != 'Kebutuhan' AND jalan.kd_balai = '$id'");
		return $query->row();
	}
	public function realrambu($id)
	{
		$query = $this->db->query("SELECT COUNT(rambu) AS jumlah FROM jalan WHERE rambu = '1' AND kd_balai = '$id'");
		return $query->row();
	}
	public function progressrambu($id)
	{
		$this->db->select('jalan.kd_balai,jalan.kd_jalan, jalan.nm_ruas, jalan.jln_panjang');
		$this->db->from('balai,jalan');
		$this->db->where('balai.kd_balai = jalan.kd_balai');
		$this->db->join('rambu', 'rambu.kd_jalan = jalan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$this->db->group_by('jalan.kd_jalan');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekaprambu($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM rambu WHERE kd_jalan = $id");
		return $query->result();
	}
	public function viewrambu($id)
	{
		$this->db->join('rambu_klasifikasi', 'rambu_klasifikasi.id_tabel = rambu.jenis', 'LEFT');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe', 'LEFT');
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('rambu');
		return $query->result();
	}

	public function percentrppj($id)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT jalan.kd_jalan) AS percen FROM rppj LEFT JOIN jalan ON rppj.kd_jalan = jalan.kd_jalan WHERE rppj.status != 'Kebutuhan' AND jalan.kd_balai = '$id'");
		return $query->row();
	}
	public function realrppj($id)
	{
		$query = $this->db->query("SELECT COUNT(rppj) AS jumlah FROM jalan WHERE rppj = '1' AND kd_balai = '$id'");
		return $query->row();
	}


	public function percentdrk($id)
	{
		$query = $this->db->query("SELECT COUNT(DISTINCT jalan.kd_jalan) AS percen FROM daerah_rawan LEFT JOIN jalan ON daerah_rawan.kd_jalan = jalan.kd_jalan WHERE daerah_rawan.status != '1' AND jalan.kd_balai = '$id'");
		return $query->row();
	}
	public function realdrk($id)
	{
		$query = $this->db->query("SELECT COUNT(drk) AS jumlah FROM jalan WHERE drk = '1' AND kd_balai = '$id'");
		return $query->row();
	}

	public function progressdrk($id)
	{
		$this->db->select('jalan.kd_balai,jalan.kd_jalan, jalan.nm_ruas, jalan.jln_panjang');
		$this->db->from('balai,jalan');
		$this->db->where('balai.kd_balai = jalan.kd_balai');
		$this->db->join('daerah_rawan', 'daerah_rawan.kd_jalan = jalan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$this->db->group_by('jalan.kd_jalan');
		$query = $this->db->get();
		return $query->result();
	}

	public function rekapdrk($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN status = '1' THEN 1 ELSE NULL END) AS terpasang,COUNT(CASE WHEN status = '0' THEN 1 ELSE NULL END) AS rusak FROM daerah_rawan WHERE kd_jalan = $id");
		return $query->result();
	}

	public function progressrppj($id)
	{
		$this->db->select('jalan.kd_balai,jalan.kd_jalan, jalan.nm_ruas, jalan.jln_panjang');
		$this->db->from('balai,jalan');
		$this->db->where('balai.kd_balai = jalan.kd_balai');
		$this->db->join('rppj', 'rppj.kd_jalan = jalan.kd_jalan', 'LEFT');
		$this->db->where('balai.kd_balai', $id);
		$this->db->group_by('jalan.kd_jalan');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekaprppj($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM rppj WHERE kd_jalan = $id");
		return $query->result();
	}
	public function viewrppj($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('rppj');
		return $query->result();
	}



	public function viewguardrail($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('guardrail');
		return $query->result();
	}
	public function rekapguardrail($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM guardrail WHERE kd_jalan = $id");
		return $query->result();
	}
	public function viewmarka($id)
	{
		$this->db->where('kd_jalan', $id);
		$query = $this->db->get('marka');
		return $query->result();
	}
	public function rekapmarka($id)
	{
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Baik' THEN 1 ELSE NULL END) AS baik, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM marka WHERE kd_jalan = $id");
		return $query->result();
	}

	//mengambil data notifikasi aduan

	public function get_aduanUnread()
	{
		$hakakses = $this->session->userdata('hakakses');
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
		tb_aduan.stat_read1,
		tb_aduan.stat_read2,
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
		if ($hakakses == '01' || $hakakses == '02' || $hakakses == '03' || $hakakses == '04' || $hakakses == '05' || $hakakses == '06') {
			$this->db->where('kabkota.kd_balai', $hakakses);
			$this->db->where('tb_aduan.stat_read1', 0);
		}
		if ($hakakses == 'S' || $hakakses == 'A') {
			$this->db->where('tb_aduan.stat_read2', 0);
		}

		return $this->db->count_all_results();
	}

	public function get_aduanByBalai()
	{
		$hakakses = $this->session->userdata('hakakses');
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
		tb_aduan.stat_read1,
		tb_aduan.stat_read2,
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
		if ($hakakses == '01' || $hakakses == '02' || $hakakses == '03' || $hakakses == '04' || $hakakses == '05' || $hakakses == '06') {
			$this->db->where('kabkota.kd_balai', $hakakses);
			$this->db->where('tb_aduan.stat_read1', 0);
		}
		if ($hakakses == 'S' || $hakakses == 'A') {
			$this->db->where('tb_aduan.stat_read2', 0);
		}
		$this->db->order_by('id_aduan', 'DESC');
		$this->db->limit(5);
		return $this->db->get()->result();
	}
	public function get_sumtanggapinfo()
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
		tb_aduan.stat_read1,
		tb_aduan.stat_read2,
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
		$this->db->where('stat_readtanggap', 0);
		$this->db->where('stat_tanggap', 1);
		return $this->db->count_all_results();
	}

	public function get_tanggapunread()
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
		tb_aduan.stat_read1,
		tb_aduan.stat_read2,
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
		$this->db->where('stat_readtanggap', 0);
		$this->db->where('stat_tanggap', 1);
		$this->db->order_by('id_aduan', 'DESC');
		$this->db->limit(5);
		return $this->db->get()->result();
	}

	public function jmlAduanByChannel()
	{
		$hakakses = $this->session->userdata('hakakses');
		date_default_timezone_set("Asia/Bangkok");
		$this->db->select('
		tb_aduan.id_chanel_aduan,
		tb_chanel_aduan.chanel_aduan,
		COUNT( tb_aduan.id_chanel_aduan ) AS jml_aduan,
		kabkota.kd_balai
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
		$this->db->where('YEAR(created_at)', date("Y"));
		$this->db->group_by('id_chanel_aduan');
		return $this->db->get()->result();
	}

	public function get_aduanBulanan()
	{
		$hakakses = $this->session->userdata('hakakses');
		date_default_timezone_set("Asia/Bangkok");
		$this->db->select('
		DATE_FORMAT(created_at,\'%M\') AS Bulan,
		DATE_FORMAT(created_at,\'%Y\') as Tahun,
		COUNT( tb_aduan.id_aduan) AS jml_aduan,
		CASE tb_aduan.stat_tanggap
			WHEN 1 THEN
				sum( tb_aduan.stat_tanggap)
			ELSE
			sum( tb_aduan.stat_tanggap)
		END AS jml_ditanggapi,
		CASE tb_aduan.stat_tangani
			WHEN 1 THEN
				sum( tb_aduan.stat_tangani)
			ELSE
			sum( tb_aduan.stat_tangani)
		END AS jml_ditangani,
		kabkota.kd_balai
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
		$this->db->where('YEAR(created_at)', date("Y"));
		$this->db->group_by('MONTH(created_at)');
		$this->db->group_by('YEAR(created_at)');
		return $this->db->get()->result();
	}

	public function get_aduanTahunan()
	{
		$hakakses = $this->session->userdata('hakakses');
		$this->db->select('
		DATE_FORMAT(created_at,\'%Y\') as Tahun,
		COUNT( tb_aduan.id_aduan) AS jml_aduan,
		CASE tb_aduan.stat_tanggap
			WHEN 1 THEN
				sum( tb_aduan.stat_tanggap)
			ELSE
				sum( tb_aduan.stat_tanggap)
		END AS jml_ditanggapi,
		CASE tb_aduan.stat_tangani
			WHEN 1 THEN
				sum( tb_aduan.stat_tangani)
			ELSE
				sum( tb_aduan.stat_tangani)
		END AS jml_ditangani,
		kabkota.kd_balai
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
		$this->db->group_by('YEAR(created_at)');
		return $this->db->get()->result();
	}
}
