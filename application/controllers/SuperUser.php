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
        $coment_new=$_POST["coment_new"];
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
        $comentario_new=$_POST["comentario_new"];

        $aplica_flujo_new=$_POST["aplica_flujo_new"];

        //var_dump($respuesta_pago);
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


 //End Controller
}
 