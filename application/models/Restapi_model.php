<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Restapi_Model extends CI_Model{

   public function user_login($username, $password) {
      $this->db->where('username', $username);
      $this->db->where('aktif', 'Y');
      $q = $this->db->get('userapi');

      if( $q->num_rows()) {
         $user_pass = $q->row('password');
         if(sha1($password) === $user_pass) {
            return $q->row();
         }
         return FALSE;
      }else{
         return FALSE;
      }
   }

   public function apil(){
      $this->db->select('*');
      $this->db->from('apil');
      $this->db->join('jalan','jalan.kd_jalan = apil.kd_jalan','LEFT');
      $query = $this->db->get();
      return $query->result();
   }

   public function cermin(){
      $this->db->select('*');
      $this->db->from('cermin');
      $this->db->join('jalan','jalan.kd_jalan = cermin.kd_jalan','LEFT');
      $query = $this->db->get();
      return $query->result();
   }

   public function flash(){
      $this->db->select('*');
      $this->db->from('flash');
      $this->db->join('jalan','jalan.kd_jalan = flash.kd_jalan','LEFT');
      $query = $this->db->get();
      return $query->result();
   }
   public function guardrail(){
      $this->db->select('*');
      $this->db->from('guardrail');
      $this->db->join('jalan','jalan.kd_jalan = guardrail.kd_jalan','LEFT');
      $query = $this->db->get();
      return $query->result();
   }
   public function rppj(){
      $this->db->select('*');
      $this->db->from('rppj');
      $this->db->join('jalan','jalan.kd_jalan = rppj.kd_jalan','LEFT');
      $query = $this->db->get();
      // print_r($query);exit();
      return $query->result();
   }
   public function rambu(){
      $this->db->select('kd_rambu,rambu.kd_jalan,jalan.nm_ruas,nm_perjal,status,lat,lang,img_rambu');
      $this->db->from('rambu');
      $this->db->join('jalan','jalan.kd_jalan = rambu.kd_jalan','LEFT');
      $this->db->join('rambu_klasifikasi','rambu_klasifikasi.id_tabel = rambu.jenis','LEFT');
      $query = $this->db->get();
      return $query->result();
   }
   public function marka(){
      $this->db->select('*');
      $this->db->from('marka');
      $this->db->join('jalan','jalan.kd_jalan = marka.kd_jalan','LEFT');
      $query = $this->db->get();
      return $query->result();
   }
   public function pelabuhan(){
      $query = $this->db->get('pelabuhan');
      return $query->result();
   }
   public function perlintasan(){
      $query = $this->db->get('perlintasan');
      return $query->result();
   }
   public function lpju(){
      $this->db->select('kd_pju,pju.kd_jalan,jalan.nm_ruas,jenis,letak,status,lat,lang,img_pju');
      $this->db->from('pju');
      $this->db->join('jalan','jalan.kd_jalan = pju.kd_jalan','LEFT');
      $query = $this->db->get();
      return $query->result();
   }
   public function shelter(){
      $this->db->where('status','P');
      $query = $this->db->get('shelter');
      return $query->result();
   }
   public function stasiun(){
      $query = $this->db->get('stasiun');
      return $query->result();
   }
   public function bandara(){
      $query = $this->db->get('bandara');
      return $query->result();
   }
   public function terminal(){
      $query = $this->db->get('terminal');
      return $query->result();
   }
   public function sdp(){
      $query = $this->db->get('sdp');
      return $query->result();
   }
}
