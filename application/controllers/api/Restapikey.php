<?php defined('BASEPATH') OR exit('No direct script access allowed');

use Restserver\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
 
class Restapikey extends \Restserver\Libraries\REST_Controller {

	public function __construct() {
		parent::__construct();
		// Load User Model
		$this->load->model('restapi_model', 'RestapiModel');
		$this->load->model('user_model', 'UserModel');
		$this->load->model('home_model', 'HomeModel');
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
				$token_data['id'] = $output->id;
				$token_data['full_name'] = $output->full_name;
				$token_data['username'] = $output->username;
				$token_data['email'] = $output->email;
				$token_data['created_at'] = $output->created_at;
				$token_data['updated_at'] = $output->updated_at;
				$token_data['time'] = time();

				$user_token = $this->authorization_token->generateToken($token_data);

				$return_data = [
					'user_id' => $output->id,
					'full_name' => $output->full_name,
					'email' => $output->email,
					'created_at' => $output->created_at,
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->apil();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_apil;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['jenis'] = $output[$i]->jenis;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_apil != ''){
					$data[$i]['images'] = base_url('assets/upload/apil/'.$output[$i]->img_apil);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
				
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->cermin();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_cermin;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['jenis'] = $output[$i]->jenis;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_cermin != ''){
					$data[$i]['images'] = base_url('assets/upload/cermin/'.$output[$i]->img_cermin);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->flash();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_flash;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['jenis'] = $output[$i]->jenis;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_flash != ''){
					$data[$i]['images'] = base_url('assets/upload/flash/'.$output[$i]->img_flash);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->guardrail();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_guardrail;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['panjang'] = $output[$i]->panjang.' Beam';
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_guardrail != ''){
					$data[$i]['images'] = base_url('assets/upload/guardrail/'.$output[$i]->img_guardrail);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
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

   public function getrppj_get() {
		header("Access-Control-Allow-Origin: *");


		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();

		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->rppj();


			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_rppj;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['jenis'] = $output[$i]->jenis;
				$data[$i]['letak'] = $output[$i]->letak;
				$data[$i]['status'] = $output[$i]->status;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_rppj != ''){
					$data[$i]['images'] = base_url('assets/upload/rppj/'.$output[$i]->img_rppj);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data RPPJ"
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

   public function getrambu_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->rambu();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_rambu;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['jenis'] = $output[$i]->nm_perjal;
				$data[$i]['status'] = $output[$i]->status;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_rambu != ''){
					$data[$i]['images'] = base_url('assets/upload/rambu/'.$output[$i]->img_rambu);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Rambu"
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->marka();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_marka;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['kondisi'] = $output[$i]->status;
				$data[$i]['letak'] = $output[$i]->letak;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_marka != ''){
					$data[$i]['images'] = base_url('assets/upload/marka/'.$output[$i]->img_marka);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->pelabuhan();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['title'] = $output[$i]->nm_pelabuhan;
				$data[$i]['kodekota'] = $output[$i]->kd_kabkota;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_pelabuhan != ''){
					$data[$i]['images'] = base_url('assets/upload/pelabuhan/'.$output[$i]->img_pelabuhan);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->perlintasan();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_perlintasan;
				$data[$i]['kodekota'] = $output[$i]->kd_kabkota;
				$data[$i]['namaperlintasan'] = $output[$i]->nm_perlintasan;
				$data[$i]['jenis'] = $output[$i]->jenis_perlintasan;
				$data[$i]['status'] = $output[$i]->status_penjagaan;
				$data[$i]['lebarjalan'] = $output[$i]->lebar_jalan.' Meter';
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_perlintasan != ''){
					$data[$i]['images'] = base_url('assets/upload/perlintasan/'.$output[$i]->img_perlintasan);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
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
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->lpju();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kode'] = $output[$i]->kd_pju;
				$data[$i]['kodekota'] = substr($output[$i]->kd_jalan, 0,4);
				$data[$i]['ruas'] = $output[$i]->nm_ruas;
				$data[$i]['jenis'] = $output[$i]->jenis;
				$data[$i]['letak'] = $output[$i]->letak;
				$data[$i]['status'] = $output[$i]->status;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_pju != ''){
					$data[$i]['images'] = base_url('assets/upload/pju/'.$output[$i]->img_pju);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
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

   public function getshelter_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->shelter();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['nama'] = $output[$i]->nm_shelter;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_shelter != ''){
					$data[$i]['images'] = base_url('assets/upload/shelter/'.$output[$i]->img_shelter);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Shelter"
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

   public function getstasiun_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->stasiun();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kodekota'] = $output[$i]->kd_kabkota;
				$data[$i]['nama'] = $output[$i]->nm_stasiun;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_stasiun != ''){
					$data[$i]['images'] = base_url('assets/upload/stasiun/'.$output[$i]->img_stasiun);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Stasiun"
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

   public function getbandara_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->bandara();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kodekota'] = $output[$i]->kd_kabkota;
				$data[$i]['nama'] = $output[$i]->nm_bandara;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_bandara != ''){
					$data[$i]['images'] = base_url('assets/upload/bandara/'.$output[$i]->img_bandara);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Stasiun"
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

   public function getterminal_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->terminal();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kodekota'] = $output[$i]->kd_kabkota;
				$data[$i]['nama'] = $output[$i]->nm_terminal;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_terminal != ''){
					$data[$i]['images'] = base_url('assets/upload/terminal/'.$output[$i]->img_terminal);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Terminal"
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

   public function getsdp_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->RestapiModel->sdp();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kodekota'] = $output[$i]->kd_kabkota;
				$data[$i]['nama'] = $output[$i]->nm_sdp;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_sdp != ''){
					$data[$i]['images'] = base_url('assets/upload/sdp/'.$output[$i]->img_sdp);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Data Sungai Danau dan Penyebrangan"
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
   public function getdaerahrawan_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->daerahrawan();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['kodekota'] = $output[$i]->kd_kabkota;
				$data[$i]['nama'] = $output[$i]->nm_daerah;
				$data[$i]['latitude'] = $output[$i]->lat;
				$data[$i]['longitude'] = $output[$i]->lang;
				if($output[$i]->img_daerah != ''){
					$data[$i]['images'] = base_url('assets/upload/daerahrawan/'.$output[$i]->img_daerah);
				}else{
					$data[$i]['images'] = base_url('assets/upload/not-available.jpg');
				}
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Daerah Rawan Kecelakaan"
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


   public function getcountapil_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapapil();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Apil"
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
   public function getcountcermin_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapcermin();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Cermin"
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
   public function getcountflash_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapflash();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Flash"
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
   public function getcountguardrail_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapguardrail();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Guardrail"
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
   public function getcountmarka_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapmarka();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Marka"
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
   public function getcountlpju_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekappju();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data LPJU"
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
   public function getcountrppj_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekaprppj();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data RPPJ"
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
   public function getcountrambu_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekaprambu();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['terpasang'] = $output[$i]->terpasang;
				$data[$i]['kebutuhan'] = $output[$i]->kebutuhan;
				$data[$i]['rusak'] = $output[$i]->rusak;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Rambu"
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
   public function getcountterminal_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapterminal();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['jumlah'] = $output[$i]->jumlah;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Terminal Tipe-B"
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
   public function getcountsdp_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapsdp();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['jumlah'] = $output[$i]->jumlah;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Sungai,Danau dan Penyebrangan"
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
   public function getcountdaerahrawan_get() {
		header("Access-Control-Allow-Origin: *");

		$this->load->library('Authorization_Token');

		$is_valid_token = $this->authorization_token->validateToken();
		if (!empty($is_valid_token) AND $is_valid_token['status'] === FALSE) {

			$output = $this->HomeModel->rekapdaerahrawan();

			$data = [];
			for ($i=0; $i < count($output) ; $i++) {
				$data[$i]['jumlah'] = $output[$i]->jumlah;
			}

			if ($output > 0 AND !empty($output)) {
				// Success
				$message = [
					'status' => true,
					'data' => $data,
					'message' => "Show Jumlah Data Daerah Rawan Kecelakaan"
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