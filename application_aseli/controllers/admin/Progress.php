<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('dashboard_model');
	}

	public function jalanprovinsi($jalan){
		$jalan = $this->dashboard_model->jalanprovinsi($jalan);
		$data = array('jalan'		=> $jalan);
		$this->load->view('front/jalankml',$data);
	}

	public function index($id) {
		$balai = $this->dashboard_model->detailbalai($id);
		$jumlah = $this->dashboard_model->jmlruasperbalai($id);
		$percentapil = $this->dashboard_model->percentapill($id);
		$realapil = $this->dashboard_model->realapil($id);
		$percentcermin = $this->dashboard_model->percentcermin($id);
		$realcermin = $this->dashboard_model->realcermin($id);
		$percentpju = $this->dashboard_model->percentpju($id);
		$realpju = $this->dashboard_model->realpju($id);
		$percentflash = $this->dashboard_model->percentflash($id);
		$realflash = $this->dashboard_model->realflash($id);
		$percentrambu = $this->dashboard_model->percentrambu($id);
		$realrambu = $this->dashboard_model->realrambu($id);
		$percentrppj = $this->dashboard_model->percentrppj($id);
		$realrppj = $this->dashboard_model->realrppj($id);
		$data = array('title' 				=> 'Progress '.$balai->nm_balai,
							'balai'				=> $balai,
							'jumlah'				=> $jumlah,
							'percentapil'		=> $percentapil,
							'realapil'			=> $realapil,
							'percentcermin'	=> $percentcermin,
							'realcermin'		=> $realcermin,
							'percentpju'		=> $percentpju,
							'realpju'			=> $realpju,
							'percentflash'		=> $percentflash,
							'realflash'			=> $realflash,
							'percentrambu'		=> $percentrambu,
							'realrambu'			=> $realrambu,
							'percentrppj'		=> $percentrppj,
							'realrppj'			=> $realrppj,
							'isi' 				=> 'admin/progress/list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function apill($id) {
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressapil($id);
		$data = array('title' 		=> 'Progress Apill '.$balai->nm_balai,
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'isi' 		=> 'admin/progress/apill');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function viewapill($id,$jalan) {
		$balai 	= $this->dashboard_model->detailbalai($id);
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewapill($jalan);
		$data = array('title' 		=> 'Progress Apill',
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/progress/viewapill');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function excelapil($id){
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressapil($id);
		$data = array('balai'	=> $balai,
							'ruas' 	=> $ruas);
		$this->load->view('admin/progress/excelapill', $data);
	}

	public function cermin($id) {
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progresscermin($id);
		$data = array('title' 		=> 'Progress Cermin '.$balai->nm_balai,
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'isi' 		=> 'admin/progress/cermin');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function viewcermin($id,$jalan) {
		$balai 	= $this->dashboard_model->detailbalai($id);
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewcermin($jalan);
		$data = array('title' 		=> 'Progress Cermin',
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/progress/viewcermin');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function excelcermin($id){
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progresscermin($id);
		$data = array('balai'	=> $balai,
							'ruas' 	=> $ruas);
		$this->load->view('admin/progress/excelcermin', $data);
	}

	public function pju($id) {
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progresspju($id);
		$data = array('title' 		=> 'Progress PJU '.$balai->nm_balai,
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'isi' 		=> 'admin/progress/pju');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function viewpju($id,$jalan) {
		$balai 	= $this->dashboard_model->detailbalai($id);
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewpju($jalan);
		$data = array('title' 		=> 'Progress PJU',
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/progress/viewpju');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function excelpju($id){
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progresspju($id);
		$data = array('balai'	=> $balai,
							'ruas' 	=> $ruas);
		$this->load->view('admin/progress/excelpju', $data);
	}

	public function flash($id) {
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressflash($id);
		$data = array('title' 		=> 'Progress Flash '.$balai->nm_balai,
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'isi' 		=> 'admin/progress/flash');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function viewflash($id,$jalan) {
		$balai 	= $this->dashboard_model->detailbalai($id);
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewflash($jalan);
		$data = array('title' 		=> 'Progress Flash',
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/progress/viewflash');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function excelflash($id){
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressflash($id);
		$data = array('balai'	=> $balai,
							'ruas' 	=> $ruas);
		$this->load->view('admin/progress/excelflash', $data);
	}

	public function rambu($id) {
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressrambu($id);
		$data = array('title' 		=> 'Progress Rambu '.$balai->nm_balai,
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'isi' 		=> 'admin/progress/rambu');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function viewrambu($id,$jalan) {
		$balai 	= $this->dashboard_model->detailbalai($id);
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewrambu($jalan);
		$data = array('title' 		=> 'Progress Rambu',
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/progress/viewrambu');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function excelrambu($id){
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressrambu($id);
		$data = array('balai'	=> $balai,
							'ruas' 	=> $ruas);
		$this->load->view('admin/progress/excelrambu', $data);
	}

	public function rppj($id) {
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressrppj($id);
		$data = array('title' 		=> 'Progress RPPJ '.$balai->nm_balai,
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'isi' 		=> 'admin/progress/rppj');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function viewrppj($id,$jalan) {
		$balai 	= $this->dashboard_model->detailbalai($id);
		$ruas 	= $this->dashboard_model->detailruas($id,$jalan);
		$view 	= $this->dashboard_model->viewrppj($jalan);
		$data = array('title' 		=> 'Progress RPPJ',
							'balai'		=> $balai,
							'ruas'		=> $ruas,
							'view'		=> $view,
							'isi' 		=> 'admin/progress/viewrppj');
		$this->load->view('admin/layout/wrapper',$data);
	}
	public function excelrppj($id){
		$balai = $this->dashboard_model->detailbalai($id);
		$ruas = $this->dashboard_model->progressrppj($id);
		$data = array('balai'	=> $balai,
							'ruas' 	=> $ruas);
		$this->load->view('admin/progress/excelrppj', $data);
	}
}
