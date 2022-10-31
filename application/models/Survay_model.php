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
		if ($hakakses != 'LL') {
			$this->db->where('kd_balai', $hakakses);
		}
		$query = $this->db->get();
		return $query->result();
	}

	public function detailjalan($kd_jalan)
	{
		$this->db->select('kd_jalan,nm_ruas');
		$this->db->from('jalan');
		$this->db->where('kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->row();
	}

	public function getApill($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('apil');
		$this->db->join('jalan', 'jalan.kd_jalan = apil.kd_jalan', 'LEFT');
		$this->db->where('apil.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getCermin($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('cermin');
		$this->db->join('jalan', 'jalan.kd_jalan = cermin.kd_jalan', 'LEFT');
		$this->db->where('cermin.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getDelinator($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('delinator');
		$this->db->join('jalan', 'jalan.kd_jalan = delinator.kd_jalan', 'LEFT');
		$this->db->where('delinator.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getFlash($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('flash');
		$this->db->join('jalan', 'jalan.kd_jalan = flash.kd_jalan', 'LEFT');
		$this->db->where('flash.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getGuardrail($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('guardrail');
		$this->db->join('jalan', 'jalan.kd_jalan = guardrail.kd_jalan', 'LEFT');
		$this->db->where('guardrail.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getMarka($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('marka');
		$this->db->join('jalan', 'jalan.kd_jalan = marka.kd_jalan', 'LEFT');
		$this->db->where('marka.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getPju($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('pju');
		$this->db->join('jalan', 'jalan.kd_jalan = pju.kd_jalan', 'LEFT');
		$this->db->where('pju.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRambu($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('rambu');
		$this->db->join('jalan', 'jalan.kd_jalan = rambu.kd_jalan', 'LEFT');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe', 'LEFT');
		$this->db->where('rambu.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRambuById($id)
	{
		$this->db->select('*');
		$this->db->from('rambu');
		$this->db->join('jalan', 'jalan.kd_jalan = rambu.kd_jalan', 'LEFT');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe', 'LEFT');
		$this->db->where('rambu.kd_rambu', $id);
		$query = $this->db->get();
		return $query->row();
	}

	public function getRppj($kd_jalan)
	{
		$this->db->select('*');
		$this->db->from('rppj');
		$this->db->join('jalan', 'jalan.kd_jalan = rppj.kd_jalan', 'LEFT');
		$this->db->where('rppj.kd_jalan', $kd_jalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function tipeRambu($id_jenis)
	{
		$this->db->select('*');
		$this->db->from('rambu_tipe');
		$this->db->where('rambu_tipe.id_jenis', $id_jenis);
		$query = $this->db->get();
		return $query->result();
	}

	public function updatehistory($data)
	{
		$this->db->insert('history', $data);
	}

	//PJU
	public function datalaporanpju($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_pju as `Photo`, kd_pju as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('pju');
		$this->db->join('jalan', 'jalan.kd_jalan = pju.kd_jalan', 'LEFT');
		$this->db->where('DATE(pju.updated_at)', $tanggalsurvei);
		$this->db->where('pju.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelpju($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_pju, km_lokasi, jenis, letak, status, lang, lat, img_pju');
		$this->db->from('pju');
		$this->db->join('jalan', 'jalan.kd_jalan = pju.kd_jalan', 'LEFT');
		$this->db->where('DATE(pju.updated_at)', $tanggalsurvei);
		$this->db->where('pju.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function columnspju($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_pju as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_pju as `Photo`');
		$this->db->from('pju');
		$this->db->join('jalan', 'jalan.kd_jalan = pju.kd_jalan', 'LEFT');
		$this->db->where('DATE(pju.updated_at)', $tanggalsurvei);
		$this->db->where('pju.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//Apill
	public function datalaporanapil($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_apil as `Photo`, kd_apil as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('apil');
		$this->db->join('jalan', 'jalan.kd_jalan = apil.kd_jalan', 'LEFT');
		$this->db->where('DATE(apil.updated_at)', $tanggalsurvei);
		$this->db->where('apil.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelapil($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_apil, km_lokasi, jenis, letak, status, lang, lat, img_apil');
		$this->db->from('apil');
		$this->db->join('jalan', 'jalan.kd_jalan = apil.kd_jalan', 'LEFT');
		$this->db->where('DATE(apil.updated_at)', $tanggalsurvei);
		$this->db->where('apil.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}

	public function columnsapil($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_apil as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_apil as `Photo`');
		$this->db->from('apil');
		$this->db->join('jalan', 'jalan.kd_jalan = apil.kd_jalan', 'LEFT');
		$this->db->where('DATE(apil.updated_at)', $tanggalsurvei);
		$this->db->where('apil.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//Cermin
	public function datalaporancermin($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_cermin as `Photo`, kd_cermin as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('cermin');
		$this->db->join('jalan', 'jalan.kd_jalan = cermin.kd_jalan', 'LEFT');
		$this->db->where('DATE(cermin.updated_at)', $tanggalsurvei);
		$this->db->where('cermin.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelcermin($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_cermin, km_lokasi, jenis, letak, status, lang, lat, img_cermin');
		$this->db->from('cermin');
		$this->db->join('jalan', 'jalan.kd_jalan = cermin.kd_jalan', 'LEFT');
		$this->db->where('DATE(cermin.updated_at)', $tanggalsurvei);
		$this->db->where('cermin.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}
	public function columnscermin($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_cermin as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_cermin as `Photo`');
		$this->db->from('cermin');
		$this->db->join('jalan', 'jalan.kd_jalan = cermin.kd_jalan', 'LEFT');
		$this->db->where('DATE(cermin.updated_at)', $tanggalsurvei);
		$this->db->where('cermin.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//Delinator
	public function datalaporandelinator($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_delinator as `Photo`, kd_delinator as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('delinator');
		$this->db->join('jalan', 'jalan.kd_jalan = delinator.kd_jalan', 'LEFT');
		$this->db->where('DATE(delinator.updated_at)', $tanggalsurvei);
		$this->db->where('delinator.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function exceldelinator($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_delinator, km_lokasi, jenis, letak, status, lang, lat, img_delinator');
		$this->db->from('delinator');
		$this->db->join('jalan', 'jalan.kd_jalan = delinator.kd_jalan', 'LEFT');
		$this->db->where('DATE(delinator.updated_at)', $tanggalsurvei);
		$this->db->where('delinator.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}
	public function columnsdelinator($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_delinator as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_delinator as `Photo`');
		$this->db->from('delinator');
		$this->db->join('jalan', 'jalan.kd_jalan = delinator.kd_jalan', 'LEFT');
		$this->db->where('DATE(delinator.updated_at)', $tanggalsurvei);
		$this->db->where('delinator.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//flash
	public function datalaporanflash($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_flash as `Photo`, kd_flash as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('flash');
		$this->db->join('jalan', 'jalan.kd_jalan = flash.kd_jalan', 'LEFT');
		$this->db->where('DATE(flash.updated_at)', $tanggalsurvei);
		$this->db->where('flash.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelflash($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_flash, km_lokasi, jenis, letak, status, lang, lat, img_flash');
		$this->db->from('flash');
		$this->db->join('jalan', 'jalan.kd_jalan = flash.kd_jalan', 'LEFT');
		$this->db->where('DATE(flash.updated_at)', $tanggalsurvei);
		$this->db->where('flash.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}
	public function columnsflash($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_flash as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_flash as `Photo`');
		$this->db->from('flash');
		$this->db->join('jalan', 'jalan.kd_jalan = flash.kd_jalan', 'LEFT');
		$this->db->where('DATE(flash.updated_at)', $tanggalsurvei);
		$this->db->where('flash.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//guardrail
	public function datalaporanguardrail($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_guardrail as `Photo`, kd_guardrail as `Kode`, panjang as `Panjang (beam)`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('guardrail');
		$this->db->join('jalan', 'jalan.kd_jalan = guardrail.kd_jalan', 'LEFT');
		$this->db->where('DATE(guardrail.updated_at)', $tanggalsurvei);
		$this->db->where('guardrail.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelguardrail($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_guardrail, jenis, panjang, letak, status, lang, lat, img_guardrail');
		$this->db->from('guardrail');
		$this->db->join('jalan', 'jalan.kd_jalan = guardrail.kd_jalan', 'LEFT');
		$this->db->where('DATE(guardrail.updated_at)', $tanggalsurvei);
		$this->db->where('guardrail.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}
	public function columnsguardrail($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_guardrail as `Kode`, jenis as `Jenis`, panjang as `Panjang (beam)`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_guardrail as `Photo`');
		$this->db->from('guardrail');
		$this->db->join('jalan', 'jalan.kd_jalan = guardrail.kd_jalan', 'LEFT');
		$this->db->where('DATE(guardrail.updated_at)', $tanggalsurvei);
		$this->db->where('guardrail.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//marka
	public function datalaporanmarka($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_marka as `Photo`, kd_marka as `Kode`, jenis as `Jenis`, panjang as `Panjang (m\')`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('marka');
		$this->db->join('jalan', 'jalan.kd_jalan = marka.kd_jalan', 'LEFT');
		$this->db->where('DATE(marka.updated_at)', $tanggalsurvei);
		$this->db->where('marka.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelmarka($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_marka, jenis, panjang, letak, status, lang, lat, img_marka');
		$this->db->from('marka');
		$this->db->join('jalan', 'jalan.kd_jalan = marka.kd_jalan', 'LEFT');
		$this->db->where('DATE(marka.updated_at)', $tanggalsurvei);
		$this->db->where('marka.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}
	public function columnsmarka($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_marka as `Kode`, jenis as `Jenis`, panjang as `Panjang (m\')`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_marka as `Photo`');
		$this->db->from('marka');
		$this->db->join('jalan', 'jalan.kd_jalan = marka.kd_jalan', 'LEFT');
		$this->db->where('DATE(marka.updated_at)', $tanggalsurvei);
		$this->db->where('marka.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//rambu
	public function datalaporanrambu($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_rambu as `Photo`, kd_rambu as `Kode`, km_lokasi as `KM Lokasi`, rambu_klasifikasi.nm_perjal as `Jenis Rambu`, rambu_tipe.desk_tipe as `Kode Rambu`, status as `Status`, posisi as `Posisi`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('rambu');
		$this->db->join('jalan', 'jalan.kd_jalan = rambu.kd_jalan', 'LEFT');
		$this->db->join('rambu_klasifikasi', 'rambu_klasifikasi.id_tabel = rambu.jenis');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe');
		$this->db->where('DATE(rambu.updated_at)', $tanggalsurvei);
		$this->db->where('rambu.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelrambu($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_rambu, km_lokasi, rambu_klasifikasi.nm_perjal as `jenis_rambu`, rambu_tipe.desk_tipe as `kode_rambu`, rambu_tipe.img_tipe as `img_tipe`, status, posisi, lang, lat , img_rambu');
		$this->db->from('rambu');
		$this->db->join('jalan', 'jalan.kd_jalan = rambu.kd_jalan', 'LEFT');
		$this->db->join('rambu_klasifikasi', 'rambu_klasifikasi.id_tabel = rambu.jenis');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe');
		$this->db->where('DATE(rambu.updated_at)', $tanggalsurvei);
		$this->db->where('rambu.kd_jalan', $ruasjalan);
		$this->db->order_by('kd_rambu', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
	public function columnsrambu($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_rambu as `Kode`, km_lokasi as `KM Lokasi`, rambu_klasifikasi.nm_perjal as `Jenis Rambu`, rambu_tipe.desk_tipe as `Kode Rambu`, status as `Status`, posisi as `Posisi`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_rambu as `Photo`');
		$this->db->from('rambu');
		$this->db->join('jalan', 'jalan.kd_jalan = rambu.kd_jalan', 'LEFT');
		$this->db->join('rambu_klasifikasi', 'rambu_klasifikasi.id_tabel = rambu.jenis');
		$this->db->join('rambu_tipe', 'rambu_tipe.id_rambu = rambu.tipe');
		$this->db->where('DATE(rambu.updated_at)', $tanggalsurvei);
		$this->db->where('rambu.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}

	//rppj
	public function datalaporanrppj($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('img_rppj as `Photo`, kd_rppj as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`');
		$this->db->from('rppj');
		$this->db->join('jalan', 'jalan.kd_jalan = rppj.kd_jalan', 'LEFT');
		$this->db->where('DATE(rppj.updated_at)', $tanggalsurvei);
		$this->db->where('rppj.kd_jalan', $ruasjalan);
		$query = $this->db->get();

		$columns = [];
		foreach ($query->list_fields() as $field) {
			$datafield = array(
				'data' => $field,
				'title' => $field
			);
			array_push($columns, $datafield);
		}
		return array('data' => $query->result(), 'columns' => $columns);
	}

	public function excelrppj($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_rppj, km_lokasi, jenis, letak, status, lang, lat, img_rppj');
		$this->db->from('rppj');
		$this->db->join('jalan', 'jalan.kd_jalan = rppj.kd_jalan', 'LEFT');
		$this->db->where('DATE(rppj.updated_at)', $tanggalsurvei);
		$this->db->where('rppj.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->result();
	}
	public function columnsrppj($ruasjalan, $tanggalsurvei)
	{
		$this->db->select('kd_rppj as `Kode`, km_lokasi as `KM Lokasi`, jenis as `Jenis`, letak as `Letak`, status as `Status`, lang as `Longitude (X)`, lat as `Lattitude (Y)`, img_rppj as `Photo`');
		$this->db->from('rppj');
		$this->db->join('jalan', 'jalan.kd_jalan = rppj.kd_jalan', 'LEFT');
		$this->db->where('DATE(rppj.updated_at)', $tanggalsurvei);
		$this->db->where('rppj.kd_jalan', $ruasjalan);
		$query = $this->db->get();
		return $query->list_fields();
	}
}
