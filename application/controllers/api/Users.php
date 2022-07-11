<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
 
class Users extends \Restserver\Libraries\REST_Controller {
   public function __construct() {
      parent::__construct();
      // Load User Model
      $this->load->model('user_model', 'UserModel');
   }

   public function login_post(){
      header("Access-Control-Allow-Origin: *");

      # XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)
      $_POST = $this->security->xss_clean($_POST);

      # Form Validation
      $this->form_validation->set_rules('username', 'Username', 'trim|required');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|max_length[100]');
      
      if ($this->form_validation->run() == FALSE) {
         // Form Validation Errors
         $message = array(
            'status' => false,
            'error' => $this->form_validation->error_array(),
            'message' => validation_errors()
         );

         $this->response($message, REST_Controller::HTTP_NOT_FOUND);
      } else {
         // Load Login Function
         $output = $this->UserModel->user_login($this->input->post('username'), $this->input->post('password'));
         if (!empty($output) AND $output != FALSE) {
            // Load Authorization Token Library
            $this->load->library('Authorization_Token');

            // Generate Token
            $token_data['id'] = $output->id;
            $token_data['full_name'] = $output->full_name;
            $token_data['username'] = $output->username;
            $token_data['email'] = $output->email;
            $token_data['created_at'] = $output->created_at;
            $token_data['updated_at'] = $output->updated_at;
            $token_data['time'] = time();

            $user_token = $this->authorization_token->generateToken($token_data);

            $return_data = [
               'token' => $user_token,
            ];

            // Login Success
            $message = [
               'status' => true,
               'data' => $return_data,
               'message' => "Token Created"
            ];
            $this->response($message, REST_Controller::HTTP_OK);
         } else {
            // Login Error
            $message = [
               'status' => FALSE,
               'message' => "Invalid Username or Password"
               ];
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
         }
      }
   }
}