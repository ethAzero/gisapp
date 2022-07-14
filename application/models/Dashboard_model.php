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

	public function get_jml_aduan_unread()
	{
		$this->db->where('kd_balai', 01);
		$this->db->where('stat_read', 0);
		$query = $this->db->get('v_aduan')->num_rows();
		//$row = $query->getNumRows();;
		return $query;
	}
}
