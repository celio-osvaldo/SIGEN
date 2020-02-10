<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$data['error'] = $this->session->flashdata('error');
		$data['title']='DASASYS';
		$this->load->view('Log/in', $data);
	}

	public function LogDasa(){
		redirect('/Dasa/Index', 'refresh');
	}

}
