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
      $query = $this->db->get('apil');
      return $query->result();
   }

   public function cermin(){
      $query = $this->db->get('cermin');
      return $query->result();
   }

   public function flash(){
      $query = $this->db->get('flash');
      return $query->result();
   }
   public function guardrail(){
      $query = $this->db->get('guardrail');
      return $query->result();
   }
   public function marka(){
      $query = $this->db->get('marka');
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
      $query = $this->db->get('pju');
      return $query->result();
   }
}
