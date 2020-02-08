<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		#return view('welcome_message');
	   $data['titulo']='DASASYS';
	   $this->load->view('Plantillas/header', $data);
	   
       $this->load->view('Plantillas/footer');
	}

	//--------------------------------------------------------------------

}
