<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
 
class Restapikey extends \Restserver\Libraries\REST_Controller {

	public function __construct() {
		parent::__construct();
		// Load User Model
		$this->load->model('restapi_model', 'RestapiModel');
		$this->load->model('user_model', 'UserModel');
	}

	public function loginuser_post(){
		header("Access-Control-Allow-Origin: *");

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
		}
		else {
		   // Load Login Function
		   $output = $this->RestapiModel->user_login($this->input->post('username'), $this->input->post('password'));
		   if (!empty($output) AND $output != FALSE) {
				// Load Authorization Token Library
				$this->load->library('Authorization_Token');

				// Generate Token
				$token_data['username'] = $output->username;
				$token_data['create_date'] = $output->create_date;
				$token_data['last_login'] = $output->last_login;
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

   public function login_post() {
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
				//$token_data['id'] = $output->id;
				$token_data['full_name'] = $output->full_name;
				// $token_data['username'] = $output->username;
				// $token_data['email'] = $output->email;
				// $token_data['created_at'] = $output->created_at;
				// $token_data['updated_at'] = $output->updated_at;
				$token_data['time'] = time();

				$user_token = $this->authorization_token->generateToken($token_data);

				$return_data = [
					//'user_id' => $output->id,
					'full_name' => $output->full_name,
					// 'email' => $output->email,
					// 'created_at' => $output->created_at,
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

   public function getapil_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();

		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->apil();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_apil;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['jenis'] = $output[$i]->jenis;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Apil"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }

   public function getcermin_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->cermin();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_cermin;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['jenis'] = $output[$i]->jenis;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Cermin"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }

   public function getflash_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->flash();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_flash;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['jenis'] = $output[$i]->jenis;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Flash"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }

   public function getguardrail_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->guardrail();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_guardrail;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['panjang'] = $output[$i]->panjang.' Beam';
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Guardrail"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }

   public function getmarka_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->marka();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_marka;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['letak'] = $output[$i]->letak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Marka"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }

   public function getpelabuhan_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->pelabuhan();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['title'] = $output[$i]->nm_pelabuhan;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Pelabuhan"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }

   public function getperlintasan_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->perlintasan();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_perlintasan;
				$data[$i]['namaperlintasan'] = $output[$i]->nm_perlintasan;
				$data[$i]['jenis'] = $output[$i]->jenis_perlintasan;
				$data[$i]['status'] = $output[$i]->status_penjagaan;
				$data[$i]['lebarjalan'] = $output[$i]->lebar_jalan.' Meter';
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Perlintasan"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }

   public function getlpju_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === TRUE) {

			$output = $this->RestapiModel->lpju();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_pju;
				$data[$i]['jenis'] = $output[$i]->jenis;
				$data[$i]['letak'] = $output[$i]->letak;
				$data[$i]['status'] = $output[$i]->status;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Perlintasan"
				];
				$this->response($message, REST_Controller::HTTP_OK);
			} else {
				// Error
				$message = [
				   'status' => FALSE,
				   'message' => "Not Found"
				];
				$this->response($message, REST_Controller::HTTP_NOT_FOUND);
		   }
      } else {
      	$this->response(['status' => FALSE, 'message' => $is_valid_token['message'] ], REST_Controller::HTTP_NOT_FOUND);
      }
   }
}