<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model{
	
	public function __construct(){
		$this->load->database();
	}

	public function detail(){
		$query = $this->db->get_where('ma_setting',array('id_setting' => '1'));
		return $query->row();
	}

	public function edit($data){
		$this->db->where('id_setting',$data['id_setting']);
		$this->db->update('ma_setting',$data);
	}
}