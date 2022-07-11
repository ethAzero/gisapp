<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{

	public function __construct(){
		$this->load->database();
	}

	public function meta(){
		$query = $this->db->get_where('ma_setting',array('id_setting' => '1'));
		return $query->row();
	}

	public function cermin(){
		$this->db->from('cermin');
		$this->db->join('jalan','jalan.kd_jalan = cermin.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapcermin(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM cermin");
		return $query->result();
	}

	public function cermindetail($id){
		$this->db->from('cermin');
		$this->db->join('jalan','jalan.kd_jalan = cermin.kd_jalan','LEFT');
		$this->db->where('kd_cermin',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function apil(){
		$this->db->from('apil');
		$this->db->join('jalan','jalan.kd_jalan = apil.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapapil(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM apil");
		return $query->result();
	}

	public function delinator(){
		$this->db->from('delinator');
		$this->db->join('jalan','jalan.kd_jalan = delinator.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	public function rekapdelinator(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM delinator");
		return $query->result();
	}

	public function pju(){
		$this->db->from('pju');
		$this->db->join('jalan','jalan.kd_jalan = pju.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekappju(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM pju");
		return $query->result();
	}

	public function guardrail(){
		$this->db->from('guardrail');
		$this->db->join('jalan','jalan.kd_jalan = guardrail.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapguardrail(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM guardrail");
		return $query->result();
	}

	public function marka(){
		$this->db->from('marka');
		$this->db->join('jalan','jalan.kd_jalan = marka.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapmarka(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Baik' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM marka");
		return $query->result();
	}

	public function flash(){
		$this->db->from('flash');
		$this->db->join('jalan','jalan.kd_jalan = flash.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapflash(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM flash");
		return $query->result();
	}

	public function rambu(){
		$this->db->from('rambu');
		$this->db->join('jalan','jalan.kd_jalan = rambu.kd_jalan','LEFT');
		$this->db->join('rambu_klasifikasi','rambu_klasifikasi.id_tabel = rambu.jenis','LEFT');
		$this->db->join('rambu_tipe','rambu_tipe.id_rambu = rambu.tipe','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekaprambu(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM rambu");
		return $query->result();
	}

	public function rppj(){
		$this->db->from('rppj');
		$this->db->join('jalan','jalan.kd_jalan = rppj.kd_jalan','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekaprppj(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN STATUS = 'Terpasang' THEN 1 ELSE NULL END) AS terpasang, COUNT(CASE WHEN STATUS = 'Kebutuhan' THEN 1 ELSE NULL END) AS kebutuhan, COUNT(CASE WHEN STATUS = 'Rusak' THEN 1 ELSE NULL END) AS rusak FROM rppj");
		return $query->result();
	}

	public function terminal(){
		$this->db->from('terminal');
		$this->db->join('kabkota','kabkota.kd_kabkota = terminal.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapterminal(){
		$this->db->select('count(kd_terminal) AS jumlah');
		$query = $this->db->get('terminal');
		return $query->result();
	}
	public function stasiun(){
		$this->db->from('stasiun');
		$this->db->join('kabkota','kabkota.kd_kabkota = stasiun.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function bandara(){
		$this->db->from('bandara');
		$this->db->join('kabkota','kabkota.kd_kabkota = bandara.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function pelabuhan(){
		$this->db->from('pelabuhan');
		$this->db->join('kabkota','kabkota.kd_kabkota = pelabuhan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekappelabuhan(){
		$this->db->select('count(kd_pelabuhan) AS jumlah');
		$query = $this->db->get('pelabuhan');
		return $query->result();
	}

	public function sdp(){
		$this->db->from('sdp');
		$this->db->join('kabkota','kabkota.kd_kabkota = sdp.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapsdp(){
		$this->db->select('count(kd_sdp) AS jumlah');
		$query = $this->db->get('sdp');
		return $query->result();
	}
	public function perlintasan(){
		$this->db->from('perlintasan');
		$this->db->join('kabkota','kabkota.kd_kabkota = perlintasan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function perlintasan_sebidang(){
		$this->db->from('perlintasan');
		$this->db->join('kabkota','kabkota.kd_kabkota = perlintasan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('jenis_perlintasan','sebidang');
		$query = $this->db->get();
		return $query->result();
	}
	public function perlintasan_tidak_sebidang(){
		$this->db->from('perlintasan');
		$this->db->join('kabkota','kabkota.kd_kabkota = perlintasan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('jenis_perlintasan','tidaksebidang');
		$query = $this->db->get();
		return $query->result();
	}
	public function shelter(){
		$query = $this->db->get('shelter');
		return $query->result();
	}
	public function rekapshelter(){
		$query = $this->db->query("SELECT COUNT(CASE WHEN arah = 'BT' THEN 1 ELSE NULL END) AS BT, COUNT(CASE WHEN arah = 'TB' THEN 1 ELSE NULL END) AS TB, COUNT(CASE WHEN arah = 'PWTPBR' THEN 1 ELSE NULL END) AS PWTPBR, COUNT(CASE WHEN arah = 'PBRPWT' THEN 1 ELSE NULL END) AS PBRPWT FROM shelter");
		return $query->result();
	}

	// public function rekapshelter(){
	// 	$query = $this->db->query("SELECT COUNT(CASE WHEN arah_shelter.jns_shelter = 'masuk' THEN 1 ELSE NULL END) AS MASUK, COUNT(CASE WHEN arah_shelter.jns_shelter = 'keluar' THEN 1 ELSE NULL END) AS KELUAR FROM shelter INNER JOIN arah_shelter ON shelter.arah = arah_shelter.kd_arah");
	// 	return $query->result();
	// }

	public function rekapjalan(){
		$query = $this->db->query("SELECT COUNT(kd_jalan) AS jumlah, SUM(jln_panjang) AS panjang FROM jalan");
		return $query->result();
	}

	public function atcs(){
		$this->db->from('atcs');
		$this->db->join('kabkota','kabkota.kd_kabkota = atcs.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}

	public function daerahrawan(){
		$this->db->from('daerah_rawan');
		$this->db->join('kabkota','kabkota.kd_kabkota = daerah_rawan.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$query = $this->db->get();
		return $query->result();
	}
	public function rekapdaerahrawan(){
		$this->db->select('count(kd_daerah) AS jumlah');
		$query = $this->db->get('daerah_rawan');
		return $query->result();
	}

	public function daerahrawanll(){
		$this->db->from('keperluan_jalan');
		$query = $this->db->get();
		return $query->result();
	}

	public function prakiraancuaca($tgl){
		$this->db->select('*');
		$this->db->from('bmkg_lokasi');
		$this->db->join('bmkg_cuaca','bmkg_lokasi.id_kota = bmkg_cuaca.id_kota','LEFT');
		$this->db->where('bmkg_cuaca.tgl_cuaca_end >=',$tgl);
		$this->db->where('bmkg_cuaca.tgl_cuaca_start <=',$tgl);
		$query = $this->db->get();
		return $query->result();
	}
	public function keterangancuaca($tgl){
		$this->db->where('tgl_ket_end >=',$tgl);
		$this->db->where('tgl_ket_start <=',$tgl);
		$query = $this->db->get('bmkg_keterangan');
		return $query->row();
	}

	public function listshelter(){
		$this->db->select('*');
		$this->db->from('shelter');
		$this->db->join('arah_shelter','shelter.arah = arah_shelter.kd_arah','INNER');
		$query = $this->db->get();
		return $query->result();
	}


	public function all_arah_shelter(){
		$query = $this->db->query("SELECT * FROM arah_shelter WHERE kd_arah != 'P' ORDER BY created_at ASC");
		return $query->result();
	}


	public function jml_arah_shelter($id){
		// print_r("SELECT * FROM arah_shelter WHERE kd_arah = '$id'");exit();
		$query = $this->db->query("SELECT * FROM shelter WHERE arah = '$id'");
		return $query->num_rows();
	}



	public function datadukung_terminal($id){
		$query = $this->db->get_where('detail_terminal',array('kd_terminal' => $id));
		return $query->result();
	}

	public function detailterminal($id){
		$query = $this->db->get_where('terminal',array('kd_terminal' => $id));
		return $query->row();
	}	


	public function datadukung_sdp($id){
		$this->db->from('detail_sdp');
		$this->db->where('kd_sdp',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function detailsdp($id){
		$query = $this->db->get_where('sdp',array('kd_sdp' => $id));
		return $query->row();
	}

}