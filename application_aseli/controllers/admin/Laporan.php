<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Laporan extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('laporan_model');
		$this->load->model('apil_model');
		$this->load->model('cermin_model');
		$this->load->model('pju_model');
		$this->load->model('flash_model');
		$this->load->model('guardrail_model');
		$this->load->model('rambu_model');
		$this->load->model('rppj_model');
	}
	
	public function index(){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$list = $this->laporan_model->listing();
		}else{
			$list = $this->laporan_model->loginbatas();	
		}
		$data = array('title' 	=> 'Laporan',
							'list'	=> $list,
							'isi'		=> 'admin/laporan/ruas_list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	public function ruas(){
		$hak = $this->session->userdata('hakakses');
		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){
			$list = $this->laporan_model->listing();
		}else{
			$list = $this->laporan_model->loginbatas();	
		}
		$data = array('title' 	=> 'Laporan',
							'list'	=> $list,
							'isi'		=> 'admin/laporan/ruas_list');
		$this->load->view('admin/layout/wrapper',$data);
	}

	function cetak_laporan_ruas($id)
	{	
		$data['ruas'] = $this->laporan_model->getRuas($id);
		foreach ($data['ruas'] as $row) {
			$nama = $row->nm_ruas;
			$km	  = $row->km_lokasi;
		}
		$data['nama'] = $nama;
		$data['km']   = $km;
		$this->load->view('admin/laporan/cetak_ruas', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}

	function cetak_apil($id)
	{	
		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$data['apil'] = $this->apil_model->listingbyidbalai($id);

		}else{

			$data['apil'] = $this->apil_model->loginbatasbyidbalai($id);

		}
		
		$data['nama'] = 'Apill';
		$this->load->view('admin/laporan/cetak_apil', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}

	function cetak_cermin($id)
	{	
		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$data['cermin'] = $this->cermin_model->listingbyidbalai($id);

		}else{

			$data['cermin'] = $this->cermin_model->loginbatasbyidbalai($id);

		}
		
		$data['nama'] = 'Cermin';
		$this->load->view('admin/laporan/cetak_cermin', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}

	function cetak_pju($id)
	{	
		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$data['pju'] = $this->pju_model->listingbyidbalai($id);

		}else{

			$data['pju'] = $this->pju_model->loginbatasbyidbalai($id);

		}
		
		$data['nama'] = 'PJU';
		$this->load->view('admin/laporan/cetak_pju', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}

	function cetak_flash($id)
	{	
		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$data['flash'] = $this->flash_model->listingbyidbalai($id);

		}else{

			$data['flash'] = $this->flash_model->loginbatasbyidbalai($id);

		}
		
		$data['nama'] = 'Flash';
		$this->load->view('admin/laporan/cetak_flash', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}

	function cetak_guardrail()
	{	
		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$data['guardrail'] = $this->guardrail_model->listing();

		}else{

			$data['guardrail'] = $this->guardrail_model->loginbatas();

		}
		
		$data['nama'] = 'Guardrail';
		$this->load->view('admin/laporan/cetak_guardrail', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}

	function cetak_rambu($id)
	{	
		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$data['rambu'] = $this->rambu_model->listingbyidbalai($id);

		}else{

			$data['rambu'] = $this->rambu_model->loginbatasbyidbalai($id);

		}
		
		$data['nama'] = 'Rambu';
		$this->load->view('admin/laporan/cetak_rambu', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}

	function cetak_rppj($id)
	{	
		$hak = $this->session->userdata('hakakses');

		if(($hak === 'S')|($hak === 'A')|($hak === 'U')|($hak === 'LL')){

			$data['rppj'] = $this->rppj_model->listingbyidbalai($id);

		}else{

			$data['rppj'] = $this->rppj_model->loginbatasbyidbalai($id);

		}
		
		$data['nama'] = 'Rppj';
		$this->load->view('admin/laporan/cetak_rppj', $data);

		$tgl= date("d-m-Y");
	    // -----SIMPAN PDF DENGAN DOMPDF-----
	    // dapatkan output html  
	    $html = $this->output->get_output();      
	    // Load/panggil library dompdfnya
	    $this->load->library('Pdf');
	    // Convert to PDF
	    $this->dompdf->load_html($html);
	    $this->dompdf->render();
	    // file_put_contents("/path/to/file.pdf", $output);
	    //utk menampilkan preview pdf
	    $this->dompdf->stream("Laporan-".strtoupper($nama)."_".$tgl.".pdf",array('Attachment'=>0));
	    //atau jika tidak ingin menampilkan (tanpa) preview di halaman browser
	    //$this->dompdf->stream("welcome.pdf");
	}
}