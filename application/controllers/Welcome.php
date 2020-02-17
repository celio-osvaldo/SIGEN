<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __Construct(){
		parent :: __construct();
		$this->load->model('Login_model');#invoke the model to use in this controller
	}

	public function Index()#the main view of system shows the login
	{
		$data['error'] = $this->session->flashdata('error');#if the users doesn't have access or incorrectly enters their credentials, an error will be displayed in the view.
		$data['title']='DASASYS';#the title of the tab that you are.
		$this->load->view('Log/in', $data);#the view of login
	}

	public function SetSession() {//function that send data of user to server
      if ($this->input->post()) {
         $user = $this->input->post('user');//the name of input in the view for user
         $pass = $this->input->post('pass');//the name of input in the view for password
         $users = $this->Login_model->UsersQuery($user, $pass);//invoke the funtion into the model
         if (isset($users)) {#if the query is realized
            $usuario_data = array(#its created an array with the fields to validated for login
               'id_usuario' => $id_usuario->id_usuario,#the field of table must be same in the parameter
               'empresa_nom' => $users->empresa_nom,#the field of table must be same in the parameter
               'usuario_alias' => $users->usuario_alias,#the field of table must be same in the parameter
               'usuario_nom' => $users->usuario_nom,#the field of table must be same in the parameter
               'GetSession' => true);//If last data are true the next function will execute
            $this->session->set_userdata($usuario_data);//Varable session content the array for validate form
            redirect('Welcome/GetSession');//once time that all data is validates the function redirect to GetSession for know wich view should show.
         } else {
         	$this->session->set_flashdata('error', 'Usuario y/o contraseña incorrectos.');//if not exist the user, just show an error in the view
            redirect('Welcome/Index');//redirect to index for the user can correctly log
         } 
    } else{
         	$this->Index();#Any case ever show Index view;
         }
   }

   public function GetSession() {//function for redirect to users at respective interface
      switch($this->session->userdata('empresa_nom')){//according to company that the user will redirect to interface that it belong

         case 'DASA'://if the user belon DASA option
         	redirect('Welcome/LogDasa');#will redirect to function of LogDasa
         break;

         case 'ILUMINACIÓN'://if the user belon Iluminacion option
         	redirect('Welcome/LogIluminacion');#will redirect to function of LogDasa
         break;

         case 'SALINAS'://if the user belon salinas option
         redirect('Welcome/LogSalinas');#will redirect to function of LogDasa
         break;

         default:
         redirect('Welcome/Index');//If doesn´t exist user will redirect to Index view
      }
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

	public function LogIluminacion(){
		redirect('/Iluminacion/Index', 'refresh');
	}

	public function LogSalinas(){
		redirect('/Salinas/Index', 'refresh');
	}


#end controller
}
