<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperUser extends CI_Controller {

	public function Index()
	{
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          $data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          $data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          $data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | ADMINISTRADOR';
	   		$this->load->view('plantillas/header_SU', $data);
			$this->load->view('SuperUser/Welcome');
       		$this->load->view('plantillas/footer');
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

	public function Users_List(){
		$this->load->model('SU_model');

		$data = array('users' => $this->SU_model->Get_All_Users(),
					  'permisos' => $this->SU_model->Get_All_Permisos());
		$this->load->view('SuperUser/Lista_usuarios', $data);

	}

	public function Actualiza_Permiso(){
		$this->load->model('SU_model');
		$id_usuario=$_POST["user"];
		$id_empresa=$_POST["id_empresa"];
		$permiso=$_POST["permiso"];

		if($permiso=="true"){
			$data = array('usuario_id_usuario' => $id_usuario,
			              'empresa_id_empresa' => $id_empresa,
			          	  'perm_lectura'=>1,
			          	  'perm_escri'=>1);
			echo $this->SU_model->Agrega_Permiso($data);
		}else{
			echo $this->SU_model->Elimina_Permiso($id_usuario,$id_empresa);
		}
		echo true;
		

	}

}
 