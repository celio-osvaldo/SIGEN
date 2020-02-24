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
		$data['title']='SiGeN';#the title of the tab that you are.
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
               'nombre_tipo' => $users->nombre_tipo,
               'GetSession' => true);//If last data are true the next function will execute
            $this->session->set_userdata($usuario_data);//Varable session content the array for validate form
            redirect('Welcome/GetSession');//once time that all data is validates the function redirect to GetSession for know wich view should show.
         } else {

         	$this->session->set_flashdata('error', 'Usuario y/o contraseña incorrectos.');//if not exist the user, just show an error in the view


            redirect('/');//redirect to index for the user can correctly log
         } 
    } 
    // else{
    //         $this->Index();#Any case ever show Index view;
    //      }
   }

   public function GetSession() {//function for redirect to users at respective interface
      switch($this->session->userdata('empresa_nom')){//according to company that the user will redirect to interface that it belong

         case 'DASA'://if the user belon DASA option
            if ($this->session->userdata('nombre_tipo') == "Super") {#validation for permissions of super user
               redirect('Welcome/Companies');#rdirect to main view of super user
            }
            else{#if not super user logged redirect to view for simple user
         	redirect('Welcome/LogDasa');#will redirect to function of LogDasa
            }
         break;

         case 'ILUMINACIÓN'://if the user belon Iluminacion option
            if ($this->session->userdata('perm_escri') == 1 && $this->session->userdata('perm_lectura') == 1) {
               redirect('Welcome/Companies');
            }
            else{
         	  redirect('Welcome/LogIluminacion');#will redirect to function of LogDasa
            }
         break;

         case 'SALINAS'://if the user belon salinas option
            if ($this->session->userdata('perm_escri') == 1 && $this->session->userdata('perm_lectura') == 1) {
               redirect('Welcome/Companies');
            }
            else{

               redirect('Welcome/LogSalinas');#will redirect to function of LogDasa
            }
         break;

         default:

         redirect('Welcome/Index');//If doesn´t exist user will redirect to Index view
      }
   }

	public function LogDasa(){
		// $_SESSION['Id_usuario']=$_REQUEST['usuario'];
		// $_SESSION['Nom_us']=$_REQUEST['pass'];
		redirect('/DASA/Index', 'refresh');
	}

	public function LogIluminacion(){
		redirect('/Iluminacion/Index', 'refresh');
	}

	public function LogSalinas(){
		redirect('/Salinas/Index', 'refresh');
	}

	public function Companies(){
      if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
		    $data['title']='SiGeN';#the title of the tab that you are.
          $data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          $data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
		    $this->load->view('plantillas/header', $data);
		    $this->load->view('Log/companies');
         $this->load->view('plantillas/footer');
      }
      else{#if not there a session started or if it is destroy ever redirect to login
         redirect('Welcome/Index');
      }
	}


#end controller
}
