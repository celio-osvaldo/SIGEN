<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DASA extends CI_Controller {

	public function Index()
	{
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          $data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          $data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          $data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | DASA';
	   		$this->load->view('plantillas/header_dasa', $data);
			//s$this->load->view('DASA/Welcome');
       		$this->load->view('plantillas/footer_dasa');
       	}
       	else{
       		$this->session->set_flashdata('error', 'No ha iniciado Sesión');//if not exist the user, just show an error in the view
       		redirect('/');
       	}
	}
		public function LogIn()
	{
		redirect('/', 'refresh');
	}
	public function Logout(){

		@session_destroy();
		$this->LogIn();
	}

	public function GetInventories(){
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          $data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          $data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          $data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | DASA';
	   		//$this->load->view('plantillas/header_dasa', $data);
			$this->load->view('DASA/InventoriesList');
       		//$this->load->view('plantillas/footer_dasa');
       	}
       	else{
       		$this->session->set_flashdata('error', 'No ha iniciado Sesión');//if not exist the user, just show an error in the view
       		redirect('/');
       	}
	}

	public function CustomerProjects(){
		$this->load->view('DASA/Customer_Projects');
	}



}
 