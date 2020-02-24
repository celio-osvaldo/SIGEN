<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperUser extends CI_Controller {

	public function Companies(){
      if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
		    $data['title']='SiGeN';#the title of the tab that you are.
          $data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          $data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          $data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
		    $this->load->view('plantillas/header', $data);
		    $this->load->view('SuperUser/companies');
         $this->load->view('plantillas/footer');
      }
      else{#if not there a session started or if it is destroy ever redirect to login
         redirect('Welcome/Index');
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

}
 