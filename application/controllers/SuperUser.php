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
            $this->load->model('SU_model');
            $data['solicitudes']=$this->SU_model->Get_solicitudes();
            $data['solicitudes_pago']=$this->SU_model->Get_solicitudes_pago();
            $data['solicitudes_elimina_carpeta']=$this->SU_model->Get_solicitudes_elimina_carpeta();
            $data['solicitudes_elimina_archivo']=$this->SU_model->Get_solicitudes_elimina_archivo();
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
        		for ($i=1; $i<=4 ; $i++) { 
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

        $pass_cifrado=password_hash($pass, PASSWORD_DEFAULT, array("cost"=>12));

        $asunto="Nueva Contraseña SIGEN";
        $carta=$nombre;
        $carta.="\nA continuación se muestra su nueva contraseña de acceso al sistema SIGEN.\n";
        $carta.="Usuario: ";
        $carta.=$alias;
        $carta.="\nContraseña: ";
        $carta.=$pass;
        $carta.="\n\nSi usted no solicitó el cambio de contraseña, por favor contacte al administrador.";

        if(mail($email, $asunto, $carta)){
        	$data = array('usuario_pass' => $pass_cifrado );
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

        $pass_cifrado=password_hash($alias, PASSWORD_DEFAULT, array("cost"=>12));

        $data = array('usuario_tipo' => $tipo_usuario,
         			  'usuario_nom' => $nombre,
         			  'usuario_ap' => $ap,
         			  'usuario_am' => $am,
         			  'usuario_tel' =>$tel,
         			  'usuario_email' => $email,
         			  'usuario_alias' => $alias,
         			  'usuario_pass' => $pass_cifrado);
        $new_id=$this->SU_model->New_User($data);
        if($new_id){
        	if($tipo_usuario==1){
        		for ($i=1; $i<=4 ; $i++) {
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

    public function Lista_Solicitudes(){
        $this->load->model('SU_model');
        $data = array('solicitado' => $this->SU_model->Cambio_Solicitado() ,
                      'solicitado_pago' => $this->SU_model->Cambio_Solicitado_pago(), 
                      'solicita_elimina_carpeta' => $this->SU_model->Solicita_Elimina_carpeta(),
                      'solicita_elimina_archivo' => $this->SU_model->Solicita_Elimina_archivo(),
                      'catalogo_cliente' => $this->SU_model->Cat_Cliente(),
                      'catalogo_autoriza' =>$this->SU_model->Cat_autoriza());
        $this->load->view('SuperUser/ListaSolicitudes', $data);
    }

    public function Procesa_Solicitud(){
        $this->load->model('SU_model');
        $id_historial=$_POST["id_historial"];
        $respuesta=$_POST["respuesta"]; //2.-Autorizado 3.-Cancelado
        $nom_proy_new=$_POST["nom_proy_new"];
        $cliente_new=$_POST["cliente_new"];
        $importe_new=$_POST["importe_new"];
        $estado_new=$_POST["estado_new"];; //1-Activo. 2-Pagado 3-Cancelado
        $coment_new=trim($_POST["coment_new"]);
        $id_proyecto=$_POST["id_proyecto"];

        if($respuesta=="2"){
            $this->load->model('Iluminacion_model');
           $sum_pagos=$this->Iluminacion_model->SumPagos_Obra($id_proyecto);
            if(is_null($sum_pagos->suma_pagos)){
                $suma_pagos=0;
            }else{
                $suma_pagos=$sum_pagos->suma_pagos;
            }
            $saldo=($importe_new-$suma_pagos);
            $data = array(
            'obra_cliente_nombre' => $nom_proy_new,
            'obra_cliente_id_cliente'=>$cliente_new,
            'obra_cliente_imp_total' => $importe_new,
            'obra_cliente_pagado'=>$suma_pagos,
            'obra_cliente_saldo'=>$saldo,
            'obra_cliente_estado' => $estado_new,
            'obra_cliente_comentarios' => $coment_new);
            $result=$this->Iluminacion_model->Edit_CustomerProject($id_proyecto,$data);
            if ($result) {
                $data2 = array('historial_proyecto_autoriza' => $respuesta,
                               'historial_proyecto_usuario_admin'=> $this->session->userdata('id_usuario') );
                $this->SU_model->Update_Historial_Proy($id_historial,$data2);
            }
            echo true;
        }else{
            $data2 = array('historial_proyecto_autoriza' => $respuesta,
                           'historial_proyecto_usuario_admin'=> $this->session->userdata('id_usuario') );
                $this->SU_model->Update_Historial_Proy($id_historial,$data2);
            echo true;
        }
    }


    public function Procesa_Solicitud_pago(){
        $this->load->model('SU_model');
        $id_historial_pago=$_POST["id_historial_pago"];
        $id_pago=$_POST["id_pago"];
        $respuesta_pago=$_POST["respuesta_pago"];//2.-Autorizado 3.-Cancelado

        $fecha_pago_new=$_POST["fecha_pago_new"];
        $monto_new=$_POST["monto_new"];
        $comentario_new=trim($_POST["comentario_new"]);

        $aplica_flujo_new=$_POST["aplica_flujo_new"];

        //var_dump($respuesta_pago);
        $data0 = array('venta_mov_fecha' => $fecha_pago_new,
                'venta_mov_monto' => $monto_new,
                'venta_mov_comentario' => $comentario_new,
                'venta_mov_estim_estatus' => $aplica_flujo_new );

        $verifica_cambio = array('datos' =>$this->SU_model->Verifica_Cambio($data0,$id_pago));

        if ($verifica_cambio['datos']->venta_mov_fecha!=$fecha_pago_new||$verifica_cambio['datos']->venta_mov_monto!=$monto_new||$verifica_cambio['datos']->venta_mov_comentario!=$comentario_new||$verifica_cambio['datos']->venta_mov_estim_estatus!=$aplica_flujo_new) {
                    if($respuesta_pago=="2"){
            $this->load->model('Iluminacion_model');
            $data = array('venta_mov_fecha' => $fecha_pago_new ,
                'venta_mov_monto' => $monto_new,
                'venta_mov_comentario' => $comentario_new,
                'venta_mov_estim_estatus' => $aplica_flujo_new );
                    //var_dump($id_movimiento);
            if ($this->Iluminacion_model->UpdateProject_Pay($data,$id_pago)) {
                $id_obra=$this->Iluminacion_model->Id_Proyecto($id_pago);
                $sum_pagos=$this->Iluminacion_model->SumPagos_Obra($id_obra->obra_cliente_id_obra_cliente);
                $total_obra=$this->Iluminacion_model->Total_obra($id_obra->obra_cliente_id_obra_cliente);
                $resta=($total_obra->obra_cliente_imp_total-$sum_pagos->suma_pagos);

                $fecha_ult_pago=$this->Iluminacion_model->Fecha_Ult_Pago($id_obra->obra_cliente_id_obra_cliente);

                $saldo=array('obra_cliente_saldo' => $resta,
                    'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
                    'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
                $result=$this->Iluminacion_model->UpdatePaysCustomer($id_obra->obra_cliente_id_obra_cliente,$saldo);


                $data2 = array('historial_proyecto_pago_autoriza' => $respuesta_pago,
                 'historial_proyecto_pago_admin'=> $this->session->userdata('id_usuario') );
                $this->SU_model->Update_Historial_Proy_pago($id_historial_pago,$data2);

                echo true;
            }else{
                echo false;
            }
        }else{
            $data2 = array('historial_proyecto_pago_autoriza' => $respuesta_pago,
             'historial_proyecto_pago_admin'=> $this->session->userdata('id_usuario') );
            $this->SU_model->Update_Historial_Proy_pago($id_historial_pago,$data2);
            echo true;
        }
        }else{
            $data2 = array('historial_proyecto_pago_autoriza' => $respuesta_pago,
                 'historial_proyecto_pago_admin'=> $this->session->userdata('id_usuario') );
                $this->SU_model->Update_Historial_Proy_pago($id_historial_pago,$data2);

            echo "cambio anterior";
        }

    }


    public function Flujo_Efectivo(){
        $this->load->model('SU_model');
        $empresas = array('companies' =>$this->SU_model->Get_Companies() );
        $this->load->view('SuperUser/Report_Flujo_Efectivo',$empresas);
    }


    public function Flujo_Efectivo_proyecto(){
        $this->load->model('SU_model');
        $this->load->model('Dasa_model');
        $idcompany_dasa=$this->Dasa_model->IdCompany('DASA');

        $this->load->model('Salinas_model');
        $idcompany_salinas=$this->Salinas_model->IdCompany('SALINAS');

        $this->load->model('Iluminacion_model');
        $idcompany_ilumina=$this->Iluminacion_model->IdCompany('ILUMINACION');

        $data = array('proyectos_dasa' => $this->Dasa_model->GetAllCustomer_Project($idcompany_dasa->id_empresa),
                      'proyectos_salinas' => $this->Salinas_model->GetAllCustomer_Project($idcompany_salinas->id_empresa),
                      'proyectos_ilumina' => $this->Iluminacion_model->GetAllCustomer_Project($idcompany_ilumina->id_empresa),
                      'sfv_ilumina' => $this->Iluminacion_model->GetAllCustomer_SFV($idcompany_ilumina->id_empresa),
                      'companies' =>$this->SU_model->Get_Companies());

        $this->load->view('SuperUser/Report_Flujo_Efectivo_proyecto',$data);
    }

    public function Borra_Carpeta(){
        $this->load->model('SU_model');
        $id_borra_carpeta=$_POST["id_borra_carpeta"];
        $respuesta_elimina_carpeta=$_POST["respuesta_elimina_carpeta"];

        $empresa_nube=$_POST["empresa_nube"];
        $url_carpeta=$_POST["url_carpeta"];

        if($respuesta_elimina_carpeta=="2"){//Verificamos si la solicitud se autorizó

            $dir="Resources/Nube_Sigen/".$empresa_nube."/".$url_carpeta;

            $it = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
            foreach($files as $file) {
                if ($file->isDir()){
                    rmdir($file->getRealPath());
                } else {
                    unlink($file->getRealPath());
                }
            }
            if(rmdir($dir)){
           $data = array('borra_nube_id_estado' => $respuesta_elimina_carpeta,
                            'borra_nube_id_autoriza'=> $this->session->userdata('id_usuario'));
            $this->SU_model->Update_Solicita_Elimina($id_borra_carpeta,$data);
            echo true;
        }else{
            echo false;
        }
        }else{
            //Se deberá actualizar el estado de la solicitud
            $data = array('borra_nube_id_estado' => $respuesta_elimina_carpeta,
                            'borra_nube_id_autoriza'=> $this->session->userdata('id_usuario') );
            echo $this->SU_model->Update_Solicita_Elimina($id_borra_carpeta,$data);
        }
    }
    
    public function Borra_Archivo(){
        $this->load->model('SU_model');
        $id_borra_archivo=$_POST["id_borra_nube_archivo"];
        $respuesta_elimina_archivo=$_POST["respuesta_elimina_archivo"];

        $empresa_nube=$_POST["empresa_nube"];
        $url_archivo=$_POST["url_archivo"];

        if($respuesta_elimina_archivo=="2"){//Verificamos si la solicitud se autorizó

            $dir="Resources/Nube_Sigen/".$empresa_nube."/".$url_archivo;
            if (file_exists($dir)) {
                if(unlink($dir)){
                $data = array('borra_nube_id_estado' => $respuesta_elimina_archivo,
                             'borra_nube_id_autoriza'=> $this->session->userdata('id_usuario') );
                $this->SU_model->Update_Solicita_Elimina_Archivo($id_borra_archivo,$data);
                echo true;
            }
            }else{
                //Se deberá actualizar el estado de la solicitud
            $data = array('borra_nube_id_estado' => $respuesta_elimina_archivo,
                         'borra_nube_id_autoriza'=> $this->session->userdata('id_usuario'));
            echo $this->SU_model->Update_Solicita_Elimina_Archivo($id_borra_archivo,$data);
            }
        }else{
            //Se deberá actualizar el estado de la solicitud
            $data = array('borra_nube_id_estado' => $respuesta_elimina_archivo,
                             'borra_nube_id_autoriza'=> $this->session->userdata('id_usuario') );
            echo $this->SU_model->Update_Solicita_Elimina_Archivo($id_borra_archivo,$data);
        }
    }

   public function Ver_Nube(){
        $this->load->model('SU_model');
        $url_base=base_url();
        $directorio="Resources/Nube_Sigen/";
        $ruta= $directorio;
        $_eltamano=0;

        function listar_directorios_ruta($ruta){ // abre funcion
            global $_eltamano;
            if ($dh = opendir($ruta)) { // abre opendir
                while (($file = readdir($dh)) !== false) { // abrewile
                    $laruta=$ruta.'/'.$file;
                    if($file != '.' && $file!= '..' && !is_link($laruta)){ // pregunta si es archivo o directorio
                        if (is_dir($laruta)){ // es directorio
                            listar_directorios_ruta($laruta."/");
                        } // cierra si es directorio
                            else if(is_file($laruta)){ // pregunta si es archivo
                                $tamano=filesize($laruta);
                                $_eltamano+=$tamano;
                            } // cierra si es archivo
                    } // cierra si es directorio o archivo
                } // cierra while
            } // cierra opendir
            closedir($dh);
            return $_eltamano;
        } // cierra funcion

        $_final=listar_directorios_ruta($ruta);

        //var_dump($_final);

        function sizeFormat($_dirSize)
        {
            if($_dirSize < 1024)
            {
                return $_dirSize." Bytes.";
            }
            else if($_dirSize < (1024*1024))
            {
                $_dirSize = round($_dirSize/1024,1);
                return $_dirSize." KB.";
            }
            else
            {
                $_dirSize = round($_dirSize/(1024*1024),1);
                return $_dirSize + 0.1." MB.";
            }
        }    
$data = array('ruta' => "",
    'size_dir' => sizeFormat($_final));
        $this->load->view('SuperUser/Menu_Nube',$data);
    }

    public function Carga_tabla(){
        $this->load->model('SU_model');
        $url_base=base_url();
        //var_dump(disk_free_space('C:\xampp\htdocs\SIGEN\Resources'));
        $directorio="Resources/Nube_Sigen/";
        $ruta= $directorio;
        $_eltamano=0;

        function listar_directorios_ruta($ruta){ // abre funcion
            global $_eltamano;
            if ($dh = opendir($ruta)) { // abre opendir
                while (($file = readdir($dh)) !== false) { // abrewile
                    $laruta=$ruta.'/'.$file;
                    if($file != '.' && $file!= '..' && !is_link($laruta)){ // pregunta si es archivo o directorio
                        if (is_dir($laruta)){ // es directorio
                            listar_directorios_ruta($laruta."/");
                        } // cierra si es directorio
                            else if(is_file($laruta)){ // pregunta si es archivo
                                $tamano=filesize($laruta);
                                $_eltamano+=$tamano;
                            } // cierra si es archivo
                    } // cierra si es directorio o archivo
                } // cierra while
            } // cierra opendir
            closedir($dh);
            return $_eltamano;
        } // cierra funcion

        $_final=listar_directorios_ruta($ruta);

        //var_dump($_final);

        function sizeFormat($_dirSize)
        {
            if($_dirSize < 1024)
            {
                return $_dirSize." Bytes.";
            }
            else if($_dirSize < (1024*1024))
            {
                $_dirSize = round($_dirSize/1024,1);
                return $_dirSize." KB.";
            }
            else
            {
                $_dirSize = round($_dirSize/(1024*1024),1);
                return $_dirSize + 0.1." MB.";
            }
        }    

        $ruta=$_POST['ruta'];
        $data = array('ruta' => $ruta,
                    'size_dir' => sizeFormat($_final));

        $this->load->view('SuperUser/Menu_Nube',$data);
    }

    public function Crea_Carpeta(){
        $nom_carpeta=$_POST["nom_carpeta"];
        $ruta_carpeta=$_POST["ruta_carpeta"];
        $crear="Resources/".$ruta_carpeta."/".$nom_carpeta;
        if (!file_exists($crear)) {
            mkdir($crear);
            echo true;
        }else{
            echo false;
        }
    }

    public function Add_File(){
        $this->load->model('SU_model');

        $ruta_nuevo_archivo=$_POST["nueva_ruta"];

        if (isset($_FILES['add_file']['name'])) {
            $filename = $_FILES['add_file']['name'];
        } else {
            $filename="";
        }

        //Obtenemos el nombre del documento que subiremos
        $location = "Resources/".$ruta_nuevo_archivo."/".$filename;
        // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
        $file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

        // Valid image extensions
        //$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

        $url_imagen="Resources/".$ruta_nuevo_archivo."/".$filename;

        if(move_uploaded_file($_FILES['add_file']['tmp_name'],$url_imagen)){
            echo true;
            }else{
                echo false;
            }
    }

    public function Solicita_Borra_carpeta(){
        $this->load->model('SU_model');
        $txt_justifica=trim($_POST["txt_justifica"]);
        $delete_ruta_carpeta=$_POST["delete_ruta_carpeta"];

        $nom_company=explode('/', $delete_ruta_carpeta);
        $company=$nom_company[0];
        //var_dump($company);
        $idcomp=$this->SU_model->IdCompany($company);

        $url=explode($nom_company[0].'/', $delete_ruta_carpeta);

        date_default_timezone_set("America/Mexico_City");
        $data = array('borra_nube_id_usuario' => $this->session->userdata('id_usuario'),
        'borra_nube_empresa' => $idcomp->id_empresa,
        'borra_nube_url_archivo' => $url[1],
        'borra_nube_fecha_solicitud' => date("Y/m/d"),
        'borra_nube_comentario'=>$txt_justifica,
        'borra_nube_id_estado'=>"1");

        $result=$this->SU_model->Add_Solicita_Borra_carpeta($data);
        echo $result;
    }

    public function Solicita_Borra_archivo(){
        $this->load->model('SU_model');
        $txt_justifica=trim($_POST["txt_justifica"]);
        $delete_ruta_archivo=$_POST["delete_ruta_archivo"];

        $nom_company=explode('/', $delete_ruta_archivo);
        $company=$nom_company[0];
        $idcomp=$this->SU_model->IdCompany($company);
        $url=explode($nom_company[0].'/', $delete_ruta_archivo);

        date_default_timezone_set("America/Mexico_City");
        $data = array('borra_nube_id_usuario' => $this->session->userdata('id_usuario'),
        'borra_nube_empresa' => $idcomp->id_empresa,
        'borra_nube_url_archivo' => $url[1],
        'borra_nube_fecha_solicitud' => date("Y/m/d"),
        'borra_nube_comentario'=>$txt_justifica,
        'borra_nube_id_estado'=>"1");

        $result=$this->SU_model->Add_Solicita_Borra_archivo($data);
        echo $result;
    }

    public function Solicita_descarga_archivo(){
        $this->load->model('SU_model');
        $descarga_ruta_archivo=$_POST["descarga_ruta_archivo"];
        $descarga_nombre=$_POST["descarga_nombre"];
        $pass_descarga=$_POST["pass_descarga"];

        $pass_su_descarga = $this->SU_model->Pass_download($pass_descarga);//invoke the funtion into the model
          
         if(password_verify($pass_descarga, $pass_su_descarga->usuario_pass_descarga)){
            echo true;
         }else{
            echo false;
         }
    }

    public function Cambia_Password(){
        $this->load->model('SU_model');

        $pass_nuevo=$_POST["password"];
        $id_usuario= $this->session->userdata('id_usuario');
        $mensaje="Error";

        //Verificamos el password actual
        $password_encriptado_actual=$this->SU_model->Check_Pass_download($id_usuario);

        if(password_verify($pass_nuevo, $password_encriptado_actual->usuario_pass_descarga)){
            $mensaje="Contraseña Indicada igual a la anterior. Debe indicar una contraseña diferente";
        }else{

            $pass_cifrado=password_hash($pass_nuevo, PASSWORD_DEFAULT);
            $data = array('usuario_pass_descarga' => $pass_cifrado );
                $this->SU_model->Update_User($id_usuario,$data);
            $mensaje="Contraseña Actualizada";
        }
        echo $mensaje;
    }


 //End Controller
}
 