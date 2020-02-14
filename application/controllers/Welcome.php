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
		$_SESSION['Id_usuario']=$_REQUEST['usuario'];
		$_SESSION['Nom_us']=$_REQUEST['pass'];
		redirect('/Dasa/Index', 'refresh');

/*
		$Id_usuario=$_REQUEST['usuario'];
		$pass=$_REQUEST['pass'];
		$tipo_us;
	if($_REQUEST)
	{
		$resultado=$this->consultac->login($Id_usuario,$pass);

		if(is_array($resultado))
		{ 	
			$_SESSION['Id_usuario']=$resultado['Id_persona'];
			$_SESSION['Nom_us']=$resultado['Nombre'];
			$_SESSION['tipo_us']=$resultado['Tipo_Usuario'];
			$_SESSION['Nom_tipo']=$resultado['Descripcion'];
			if($_SESSION['tipo_us']==1){//administrador
			redirect("http://localhost/SGCE/control/Inicio_Admin","refresh");
			}
			else{
				if($_SESSION['tipo_us']==2){//profesor
					redirect("http://localhost/SGCE/control/Inicio_Profe","refresh");
				}else{//alumno
					redirect("http://localhost/SGCE/control/Inicio_Alum","refresh");
				}
				
			}
		}
		else
		{
			$data['error']="Usuario o contraseña incorrectos";
			//$data['nombres']="Usuario: ".$usuario." Contraseña: ".$pass;
			$this->load->view('plantillas/encabezado0',$data);
			$this->load->view('General/index');
			$this->load->view('plantillas/piedepagina');
		}
	}
	else {
			echo "Error";

		}
}
*/



	}

}
