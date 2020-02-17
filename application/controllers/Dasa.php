<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DASA extends CI_Controller {

	public function Index()
	{
		#return view('welcome_message');
		$data['title']='DASASYS';
	   	$this->load->view('plantillas/header', $data);
		$this->load->view('DASA/Welcome');
       	$this->load->view('plantillas/footer');
	}
		public function LogIn()
	{
		redirect('/', 'refresh');
	}
	public function Logout(){

		@session_destroy();
		$this->LogIn();
	}

}
