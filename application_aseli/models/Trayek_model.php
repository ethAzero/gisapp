<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trayek_model Extends CI_Model{

	public function __construct(){
		$this->load->database();
	}
	public function koordinattrayek($level=''){
		$this->db->select('*');
		$this->db->from('trayek');
		$this->db->where('kd_trayek',$level);
		$query = $this->db->get();
		return $query->result();
	}

	function getTrayekData($level) { 
        $sql = "
            SELECT *
            FROM trayek
            WHERE nama_trayek LIKE '%$level%'
            ORDER BY nama_trayek ASC
        ";
        //var_dump($sql); die;
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) { 
            return $query->result(); 
        } 
    }

    public function getTrayek($filter="", $kode="", $search=""){
    	$filter_trayek = ($filter=="") ? "" : "AND kd_trayek = '$filter'";
        $kode_trayek = ($kode=="") ? "" : "AND kd_trayek = '$kode'";
        $search_trayek = ($search=="") ? "" : "AND nama_trayek = '$search'";

    	$sql = "
            SELECT *
            FROM trayek
            WHERE 
            	1=1
            	$filter_trayek
            	$kode_trayek
            	$search_trayek
            ORDER BY kd_trayek ASC
        ";
        //var_dump($sql); die;
        $query = $this->db->query($sql);
        if($query->num_rows() > 0) { 
            return $query->result(); 
        } 
    }

	public function listing(){
		$this->db->from('trayek');
		$query = $this->db->get();
		return $query->result();
	}

	public function addtrayek($data){
		$this->db->insert('trayek',$data);
	}

	public function kodeurut(){
		$this->db->select('MAX(RIGHT(kd_trayek, 4)) AS urutan');
		$query = $this->db->get('trayek');
		return $query->row();
	}

	public function loginbatas(){
		$this->db->from('terminal');
		$this->db->join('kabkota','kabkota.kd_kabkota = terminal.kd_kabkota','LEFT');
		$this->db->join('balai','balai.kd_balai = kabkota.kd_balai','LEFT');
		$this->db->where('balai.kd_balai',$this->session->userdata('hakakses'));
		$query = $this->db->get();
		return $query->result();
	}

	public function detailtrayek($id){
		$query = $this->db->get_where('trayek',array('kd_trayek' => $id));
		return $query->row();
	}
	public function edittrayek($data){
		$this->db->where('kd_trayek',$data['kd_trayek']);
		$this->db->update('trayek',$data);
	}
	public function deletetrayek($data){
		$this->db->where('kd_trayek',$data['kd_trayek']);
		$this->db->delete('trayek',$data);
	}
}