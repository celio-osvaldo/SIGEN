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

	public function Edit_User(){
		$this->load->model('SU_model');
		$id_usuario=$_POST["id_usuario"];
        $nombre=$_POST["nombre"];
        $ap=$_POST["ap"];
        $am=$_POST["am"];
        $tipo_usuario=$_POST["tipo_usuario"];
        $alias=$_POST["alias"];
        $tel=$_POST["tel"];
        $email=$_POST["email"];

        $data = array('usuario_tipo' => $tipo_usuario,
         			  'usuario_nom' => $nombre,
         			  'usuario_ap' => $ap,
         			  'usuario_am' => $am,
         			  'usuario_tel' =>$tel,
         			  'usuario_email' => $email,
         			  'usuario_alias' => $alias);
        if($this->SU_model->Update_User($id_usuario,$data)){
        	if($tipo_usuario==1){
        		for ($i=1; $i<=3 ; $i++) { 
        			$this->SU_model->Elimina_Permiso($id_usuario,$i);
        			$data2 = array('usuario_id_usuario' => $id_usuario,
			              'empresa_id_empresa' => $i,
			          	  'perm_lectura'=>1,
			          	  'perm_escri'=>1);
        			$this->SU_model->Agrega_Permiso($data2);
        		}
        	}
        	echo true;
        }else{
        	echo false;
        }
	}

	public function Edit_Pass(){
		$this->load->model('SU_model');
		$id_usuario=$_POST["id_usuario"];
        $nombre=$_POST["nombre"];
        $email=$_POST["email"];
        $alias=$_POST["alias"];

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
		$pass=substr(str_shuffle($permitted_chars), 0, 8);

        $asunto="Nueva Contraseña SIGEN";
        $carta=$nombre;
        $carta.="\nA continuación se muestra su nueva contraseña de acceso al sistema SIGEN.\n";
        $carta.="Usuario: ";
        $carta.=$alias;
        $carta.="\nContraseña: ";
        $carta.=$pass;
        $carta.="\n\nSi usted no solicitó el cambio de contraseña, por favor contacte al administrador.";

        if(mail($email, $asunto, $carta)){
        	$data = array('usuario_pass' => $pass );
        	$this->SU_model->Update_User($id_usuario,$data);
        	echo true;
        }else{
        	echo false;
        }
	}

	public function New_User(){
		$this->load->model('SU_model');
        $nombre=$_POST["nombre"];
        $ap=$_POST["ap"];
        $am=$_POST["am"];
        $tipo_usuario=$_POST["tipo_usuario"];
        $alias=$_POST["alias"];
        $tel=$_POST["tel"];
        $email=$_POST["email"];

        $data = array('usuario_tipo' => $tipo_usuario,
         			  'usuario_nom' => $nombre,
         			  'usuario_ap' => $ap,
         			  'usuario_am' => $am,
         			  'usuario_tel' =>$tel,
         			  'usuario_email' => $email,
         			  'usuario_alias' => $alias,
         			  'usuario_pass' => $alias);
        $new_id=$this->SU_model->New_User($data);
        if($new_id){
        	if($tipo_usuario==1){
        		for ($i=1; $i<=3 ; $i++) {
        			$data2 = array('usuario_id_usuario' => $new_id,
			              'empresa_id_empresa' => $i,
			          	  'perm_lectura'=>1,
			          	  'perm_escri'=>1);
        			$this->SU_model->Agrega_Permiso($data2);
        		}
        	}
        	echo true;
        }else{
        	echo false;
        }
	}
	
	public function Delete_User(){
		$this->load->model('SU_model');
		$id_usuario=$_POST["id_usuario"];

        if($this->SU_model->Delete_User($id_usuario)){
        	$this->SU_model->Delete_all_Permissions($id_usuario);
        	echo true;
        }else{
        	echo false;
        }
	}

}
 