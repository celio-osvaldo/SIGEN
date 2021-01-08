<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quinta extends CI_Controller {

#views
	
	public function Index()
	{
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          	$data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          	$data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          	$data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | QM';
			$this->load->model('QM_model');
 			$company='QM';
			$idcompany=$this->QM_model->IdCompany($company);
 			$data['solicitudes']=$this->QM_model->Get_solicitudes($idcompany->id_empresa);
            $data['solicitudes_pago']=$this->QM_model->Get_solicitudes_pago($idcompany->id_empresa);
            $data['datos_empresa']=$this->QM_model->Get_datos_empresa($idcompany->id_empresa);
	   		$this->load->view('plantillas/header_QM', $data);
			$this->load->view('Quinta/Welcome');
       		$this->load->view('plantillas/footer_QM');
       	}else{
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


	public function Verifica_Sesion() //Después de 45 min de inactividad la sesión se cierra de manera automática
	{
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          echo true;
       	}
       	else{
       		echo false;
       	}
	}

	public function Configuracion(){
		   	$data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          	$data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          	$data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | QM';
			$this->load->model('QM_model');
 			$company='QM';
			$idcompany=$this->QM_model->IdCompany($company);
 			$data['solicitudes']=$this->QM_model->Get_solicitudes($idcompany->id_empresa);
            $data['solicitudes_pago']=$this->QM_model->Get_solicitudes_pago($idcompany->id_empresa);
            $data['datos_empresa']=$this->QM_model->Get_datos_empresa($idcompany->id_empresa);
	   		$this->load->view('plantillas/header_QM', $data);
			$this->load->view('Quinta/Configuracion',$data);
       		$this->load->view('plantillas/footer_QM');
		//$data=array('datos_empresa'=>$this->QM_model->Get_datos_empresa($idcompany->id_empresa));
		//var_dump($data);
	}


	public function Edit_Datos_Emp(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);

		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Logos/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		$id_empresa=$_POST["id_empresa"];
		$empresa_nom_fiscal=$_POST["empresa_nom"];
		$rfc=$_POST["rfc"];
		$domicilio=$_POST["domicilio"];
		$tel=$_POST["tel"];
		$email=$_POST["email"];
		$web=$_POST["sitio_web"];
		$whatsapp=$_POST["whatsapp"];

		$data = array('empresa_nom_fiscal' => $empresa_nom_fiscal,
			'empresa_rfc' => $rfc,
			'empresa_domic' => $domicilio,
			'emp_tel' => $tel,
			'emp_email' => $email,
			'emp_web' => $web,
			'emp_whatsapp' => $whatsapp);
		$result=0;
		if($this->QM_model->Update_datos($data,$idcompany->id_empresa)){
			$result+=1;
		}
		$url_imagen='Resources/Logos/Slogan_QM'.'.'.$file_extension;

			if(in_array($file_extension,$image_ext)&&$filename!=""){
  			// Upload file
				if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

					$data2 = array('empresa_logo' => $url_imagen);
					$this->QM_model->Update_datos($data2,$idcompany->id_empresa);
					echo true;

				}
			$result+=1;
			}
		echo $result;
	}

	public function InventarioProductos(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$data=array('inventario_productos'=>$this->QM_model->GetInventorie_Products($idcompany->id_empresa),
					'unidades_medida'=>$this->QM_model->GetAllMeasurements());
		//var_dump($data);
		$this->load->view('Quinta/Inventario_Productos',$data);
	}

	public function NewAlm_Product(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$data = array('empresa_id_empresa' => $idcompany->id_empresa,
						'prod_alm_nom' => $this->input->post('nom_prod'),
						'prod_alm_medida' => $this->input->post('unid_med'),
						'prod_alm_modelo' => $this->input->post('modelo'),
						'prod_alm_prec_unit' => $this->input->post('precio'),
						'prod_alm_exist' => $this->input->post('existencia'),
						'prod_alm_codigo' => $this->input->post('codigo'),
						'prod_alm_descripcion' => $this->input->post('descripcion'),
						'prod_alm_coment' => $this->input->post('coment'));
		if($this->QM_model->New_Product($data)){
			echo true;
		}else{
			echo false;
		}		
	}

	public function Update_Alm_Product(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$id_prod=$_POST["id_prod"];
		$data = array(
						'prod_alm_nom' => $this->input->post('nom_prod'),
						'prod_alm_medida' => $this->input->post('unid_med'),
						'prod_alm_modelo' => $this->input->post('modelo'),
						'prod_alm_prec_unit' => $this->input->post('precio'),
						'prod_alm_exist' => $this->input->post('existencia'),
						'prod_alm_codigo' => $this->input->post('codigo'),
						'prod_alm_descripcion' => $this->input->post('descripcion'),
						'prod_alm_coment' => $this->input->post('coment'));
		if($this->QM_model->Edit_Product($id_prod,$data)){
			echo true;
		}else{
			echo false;
		}		
	}
 public function Update_Inv_Prod(){
    	$this->load->model('QM_model');
        $company='QM';
        $id_prod=$_POST["id_prod"];
        $inv_tipo_mov=$_POST["inv_tipo_mov"];
        $inv_cant_prod=$_POST["inv_cant_prod"];
        $precio_unit_old=$_POST["precio_unit_old"];
        $inv_prec_new=$_POST["inv_prec_new"];
        //$precio_venta_old=$_POST["precio_venta_old"];
        //$inv_prec_venta_new=$_POST["inv_prec_venta_new"];
        $inv_procedencia=$_POST["inv_procedencia"];
        $inv_referencia=$_POST["inv_referencia"];
        $existencia_old=$_POST["existencia_old"];

        if($inv_tipo_mov=="alta"){
        	$nueva_exist=$existencia_old+$inv_cant_prod;
        }else{
        	$nueva_exist=$existencia_old-$inv_cant_prod;
        }
        date_default_timezone_set("America/Mexico_City");

        $data = array('id_prod_alm' => $id_prod,
        				'prod_alm_prec_unit_new' => $inv_prec_new,
        				//'prod_alm_precio_venta_new' => $inv_prec_venta_new,
        				'prod_alm_prec_unit_old' => $precio_unit_old,
        				//'prod_alm_precio_venta_old' => $precio_venta_old,
        				'historial_almacen_producto_cantidad_new' => $nueva_exist,
        				'historial_almacen_producto_cantidad_old' => $existencia_old,
        				'historial_almacen_producto_fecha' => date("Y/m/d"),
        				'historial_almacen_producto_movimiento' => $inv_tipo_mov,
        				'historial_almacen_producto_procedencia' => $inv_procedencia,
        				'historial_almacen_producto_referencia' => $inv_referencia);

        $table="historial_almacen_producto";
		$result=$this->QM_model->Insert($table,$data);

		if($result){
			$data2 = array('prod_alm_exist' => $nueva_exist,
							'prod_alm_prec_unit' => $inv_prec_new);
							//'prod_alm_precio_venta' => $inv_prec_venta_new
			$this->QM_model->Return_Product_Almacen($id_prod,$data2);
			echo true;
		}else{
			echo false;
		}
    }
    function Product_History(){
    	$this->load->model('QM_model');
		$id_prod=$_POST['id_prod'];
		$data = array('historial_inv_prod' => $this->QM_model->Get_Product_History($id_prod),
					'ult_fecha' => $this->QM_model->Ult_Fecha($id_prod),
					'Product_Inv_info' => $this->QM_model->Product_Inv_info($id_prod));
		$this->load->view('Quinta/Historial_Inv_Prod', $data);
    }
	public function InventarioOficina(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$data=array('inventario_oficina'=>$this->QM_model->GetInventorie_Office($idcompany->id_empresa),
					'unidades_medida'=>$this->QM_model->GetAllMeasurements(),
					'providers' => $this->QM_model->GetAll_Provider($idcompany->id_empresa));
		//var_dump($data);
		$this->load->view('Quinta/Inventario_Oficina',$data);
	}
	public function NewAlm_Consumible(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$periodicidad=$_POST["periodicidad"];
		$fecha_actual =$_POST["ult_compra"];
		if($periodicidad>0){
			//sumo días de periodicidad
			$prox_compra=date("Y-m-d",strtotime($fecha_actual."+ ".$periodicidad." days")); 
		}else{
			$prox_compra="0000-00-00";
		}
		//var_dump($periodicidad);
		//var_dump($fecha_actual);
		//var_dump($prox_compra);
		$data = array('empresa_id_empresa' => $idcompany->id_empresa,
						'producto_consu_nom' => $this->input->post('nom_prod'),
						'producto_consu_medida' => $this->input->post('unid_med'),
						'producto_consu_prec_unit' => $this->input->post('precio'),
						'producto_consu_exist' => $this->input->post('existencia'),
						'producto_consu_ult_compra' => $this->input->post('ult_compra'),
						'producto_consu_periodicidad' => $this->input->post('periodicidad'),
						'producto_consu_prox_compra' => $prox_compra,
						'producto_consu_ult_proveedor' => $this->input->post('proveedor'));
		if($this->QM_model->New_Consumible($data)){
			echo true;
		}else{
			echo false;
		}	
	}
	public function UpdateConsumible(){
		$this->load->model('QM_model');
		$id = $_POST["id_prod"];
		$periodicidad=$_POST["periodicidad"];
		$fecha_actual =$_POST["ult_compra"];
		if($periodicidad>0){
			//sumo días de periodicidad
			$prox_compra=date("Y-m-d",strtotime($fecha_actual."+ ".$periodicidad." days")); 
		}else{
			$prox_compra="0000-00-00";
		}
    	$data = array(
    					'producto_consu_nom' => $this->input->post('nom_prod'),
						'producto_consu_medida' => $this->input->post('unid_med'),
						'producto_consu_prec_unit' => $this->input->post('precio'),
						'producto_consu_exist' => $this->input->post('existencia'),
						'producto_consu_ult_compra' => $this->input->post('ult_compra'),
						'producto_consu_periodicidad' => $this->input->post('periodicidad'),
						'producto_consu_prox_compra' => $prox_compra,
						'producto_consu_ult_proveedor' => $this->input->post('proveedor'));
		if($this->QM_model->Update_Consumible($id, $data)){
			echo true;
		}else{
			echo false;
		}
	}
function Update_Inv_Consu(){
    	$this->load->model('QM_model');
    	$id_prod=$_POST["id_prod"];
    	$precio_unit_old=$_POST["precio_unit_old"];
    	$existencia_old=$_POST["existencia_old"];
    	$proveedor_old=$_POST["proveedor_old"];
    	$inv_tipo_mov=$_POST["inv_tipo_mov"];
    	$inv_cant_prod=$_POST["inv_cant_prod"];
    	$inv_prec_new=$_POST["inv_prec_new"];
    	$inv_procedencia=$_POST["inv_procedencia"];
    	$inv_referencia=$_POST["inv_referencia"];
    	$inv_proveedor_new=$_POST["inv_proveedor_new"];
    	$inv_fecha_compra_new=$_POST["inv_fecha_compra_new"];
    	$fecha_compra_old=$_POST["fecha_compra_old"];

    	 if($inv_tipo_mov=="alta"){
        	$nueva_exist=$existencia_old+$inv_cant_prod;
        }else{
        	$nueva_exist=$existencia_old-$inv_cant_prod;
        }
        date_default_timezone_set("America/Mexico_City");

        $data = array('id_prod_alm' => $id_prod,
        				'prod_alm_prec_unit_new' => $inv_prec_new,
        				'prod_alm_prec_unit_old' => $precio_unit_old,
        				'historial_almacen_producto_cantidad_new' => $nueva_exist,
        				'historial_almacen_producto_cantidad_old' => $existencia_old,
        				'historial_almacen_proveedor_old' => $proveedor_old,
        				'historial_almacen_proveedor_new' => $inv_proveedor_new,
        				'historial_almacen_producto_fecha' => $inv_fecha_compra_new,
        				'historial_almacen_producto_movimiento' => $inv_tipo_mov,
        				'historial_almacen_producto_procedencia' => $inv_procedencia,
        				'historial_almacen_producto_referencia' => $inv_referencia);

        $table="historial_almacen_consumible";
		$result=$this->QM_model->Insert($table,$data);

		if($result){
			$periodicidad=date_diff(date_create($fecha_compra_old),date_create($inv_fecha_compra_new));
			$prox_compra=date("Y-m-d",strtotime($inv_fecha_compra_new."+ ".$periodicidad->days." days")); 

			 if($inv_tipo_mov=="alta"){
        		$data2 = array('producto_consu_prec_unit' => $inv_prec_new,
						'producto_consu_exist' => $nueva_exist,
						'producto_consu_ult_compra' => $inv_fecha_compra_new,
						'producto_consu_periodicidad' => $periodicidad->days,
						'producto_consu_prox_compra' => $prox_compra,
						'producto_consu_ult_proveedor' => $inv_proveedor_new);
        	}else{
        		$data2 = array('producto_consu_exist' => $nueva_exist);
        	}

			
		$this->QM_model->Update_Consumible($id_prod, $data2);
			echo true;
		}else{
			echo false;
		}
    }
    function Product_History_Consu(){
    	$this->load->model('QM_model');
		$id_prod=$_POST['id_prod'];
		$data = array('historial_inv_prod' => $this->QM_model->Get_Product_History_Consu($id_prod),
					'ult_fecha' => $this->QM_model->Ult_Fecha_Consu($id_prod),
					'Product_Inv_info' => $this->QM_model->Product_Inv_info_Consu($id_prod));
		$this->load->view('Quinta/Historial_Inv_Consumible', $data);
    }


	public function Catalogo_Proveedor(){
		$this->load->model('QM_model');
		$company='QM';
		//var_dump($company);
		$idcompany=$this->QM_model->IdCompany($company);
		//var_dump($idcompany);
		$data=array('catalogo_proveedor'=>$this->QM_model->GetAll_Provider($idcompany->id_empresa),
					'catalogo_giro'=>$this->QM_model->Get_Giros());
		$this->load->view('Quinta/Cat_Provider',$data);
		//var_dump($data);
	}
	public function NewProvider(){
		$this->load->model('QM_model');
		$company='QM';
		$idcomp=$this->QM_model->IdCompany($company);
		$data = array('empresa_id_empresa' => $idcomp->id_empresa ,
						'catalogo_proveedor_nom_fiscal' => $this->input->post('nom_fiscal') ,
						'catalogo_proveedor_empresa' => $this->input->post('nom_comer'),
						'rfc' => $this->input->post('rfc'),
						'catalogo_proveedor_id_giro' => $this->input->post('giro'),
						'catalogo_proveedor_contacto1' => $this->input->post('cont1') ,
						'catalogo_proveedor_puesto1' => $this->input->post('puesto1') ,
						'catalogo_proveedor_tel1' => $this->input->post('tel1') ,
						'catalogo_proveedor_cel1' => $this->input->post('cel1') ,
						'catalogo_proveedor_email1' => $this->input->post('email1') ,
						'catalogo_proveedor_contacto2' => $this->input->post('cont2') ,
						'catalogo_proveedor_puesto2' => $this->input->post('puesto2') ,
						'catalogo_proveedor_tel2' => $this->input->post('tel2') ,
						'catalogo_proveedor_cel2' => $this->input->post('cel2') ,
						'catalogo_proveedor_email2' => $this->input->post('email2') ,
						'catalogo_proveedor_coment' => $this->input->post('coment'));
		if($this->QM_model->New_Provider($data)){
			echo true;
		}else{
			echo false;
	}
}
	public function UpdateProvider(){
		$this->load->model('QM_model');
		$id_prov=$_POST["id_cat"];
		$data = array('catalogo_proveedor_nom_fiscal' => $this->input->post('nom_fiscal') ,
						'catalogo_proveedor_id_giro' => $this->input->post('id_giro_proveedor'),
						'rfc' => $this->input->post('rfc'),
						'catalogo_proveedor_contacto1' => $this->input->post('cont1') ,
						'catalogo_proveedor_puesto1' => $this->input->post('puesto1') ,
						'catalogo_proveedor_tel1' => $this->input->post('tel1') ,
						'catalogo_proveedor_cel1' => $this->input->post('cel1') ,
						'catalogo_proveedor_email1' => $this->input->post('email1') ,
						'catalogo_proveedor_contacto2' => $this->input->post('cont2') ,
						'catalogo_proveedor_puesto2' => $this->input->post('puesto2') ,
						'catalogo_proveedor_tel2' => $this->input->post('tel2') ,
						'catalogo_proveedor_cel2' => $this->input->post('cel2') ,
						'catalogo_proveedor_email2' => $this->input->post('email2') ,
						'catalogo_proveedor_coment' => $this->input->post('coment'));
		if($this->QM_model->Update_Provider($id_prov,$data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function CustomerProjects(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);

		$data=array('proyectlist'=>$this->QM_model->GetAllCustomer_Project($idcompany->id_empresa),
					'customerlist'=>$this->QM_model->Get_Customer_List($idcompany->id_empresa),
					'id_max_contrato'=>$this->QM_model->Get_MAXFOLIO_contrato($idcompany->id_empresa));
		$this->load->view('Quinta/Customer_Projects',$data);
	}
	public function Customer_Project_tbl(){
		$this->load->model('QM_model');
		$company='QM';
		$activo=$_POST["activo"];
		$idcompany=$this->QM_model->IdCompany($company);
		$data=array('proyectlist'=>$this->QM_model->GetAllCustomer_Project($idcompany->id_empresa),
					'customerlist'=>$this->QM_model->Get_Customer_List($idcompany->id_empresa),
					'filtro'=>$activo);
		$this->load->view('Quinta/Customer_Projects_tbl',$data);
	}
	public function AddCustomerProject(){
		$this->load->model('QM_model');
		$nombre=$_POST["nombre"];
		$id_cliente=$_POST["id_cliente"];
		$importe=$_POST["importe"];
		$coment=$_POST["coment"];
		$fecha_evento=$_POST["fecha_evento"];
		$tipo_evento=$_POST["tipo_evento"];
		$cant_persona=$_POST["cant_persona"];
		$mobiliario=$_POST["mobiliario"];
		$permiso=$_POST["permiso"];
		$total_horas=$_POST["total_horas"];
		$hora_inicio=$_POST["hora_inicio"];
		$hora_fin=$_POST["hora_fin"];
		$anticipo=$_POST["anticipo"];
		$fecha_fin=$_POST["fecha_fin"];
		$contrato=$_POST["contrato"];
		$company='QM';

		$importe_txt=$_POST["importe_txt"];
		$anticipo_txt=$_POST["anticipo_txt"];
		$resto=$_POST["resto_2"];
		$resto_txt=$_POST["resto_txt"];


		$idcomp=$this->QM_model->IdCompany($company);
				$data=array('empresa_id_empresa' => $idcomp->id_empresa,
					'obra_cliente_nombre'=> $nombre,
					'obra_cliente_id_cliente'=>$id_cliente,
					'obra_cliente_imp_total'=>$importe,
					'obra_cliente_saldo'=>$importe,
					'obra_cliente_estado'=>1,
					'obra_cliente_comentarios'=>$coment,
					'obra_cliente_contrato' => $contrato);
		$id_evento=$this->QM_model->AddCustomer_Project($data);
		if ($id_evento) {
			$data2 = array('evento_detalle_id_obra_cliente' => $id_evento,
							'evento_detalle_fecha' => $fecha_evento,
							'evento_detalle_personas' => $cant_persona,
							'evento_detalle_tipo_evento' => $tipo_evento,
							'evento_detalle_permiso' => $permiso,
							'detalle_evento_mobiliario' =>  $mobiliario,
							'evento_detalle_total_horas' => $total_horas,
							'evento_detalle_hora_inicio' => $hora_inicio,
							'evento_detalle_hora_fin' => $hora_fin,
							'evento_detalle_fecha_fin' => $fecha_fin,
							'evento_detalle_anticipo' => $anticipo,
							'evento_detalle_anticipo_txt' => $anticipo_txt,
							'evento_detalle_monto_txt' => $importe_txt,
							'evento_detalle_resto' => $resto,
							'evento_detalle_resto_txt' => $resto_txt);
			$table="evento_detalle";
			$id_detalle=$this->QM_model->Insert($table, $data2);
			echo true;
		}else{
			echo false;
		}
	
	}


	public function Catalogo_Cliente(){
		$this->load->model('QM_model');
		$company='QM';
		//var_dump($company);
		$idcompany=$this->QM_model->IdCompany($company);
		//var_dump($idcompany);
		$data=array('catalogo_cliente'=>$this->QM_model->GetAll_Customer($idcompany->id_empresa));
		$this->load->view('Quinta/Cat_Customer',$data);
		//var_dump($data);
	}
	public function NewCustomer(){
		$this->load->model('QM_model');
		$company='QM';
		$idcomp=$this->QM_model->IdCompany($company);
		$data = array('empresa_id_empresa' => $idcomp->id_empresa ,
						'catalogo_cliente_empresa' => $this->input->post('nom_comer'),
						'catalogo_cliente_contacto1' => $this->input->post('cont1') ,
						'catalogo_cliente_tel1' => $this->input->post('tel1') ,
						'catalogo_cliente_cel1' => $this->input->post('cel1') ,
						'catalogo_cliente_email1' => $this->input->post('email1') ,
						'catalogo_cliente_contacto2' => $this->input->post('cont2') ,
						'catalogo_cliente_tel2' => $this->input->post('tel2') ,
						'catalogo_cliente_cel2' => $this->input->post('cel2') ,
						'catalogo_cliente_email2' => $this->input->post('email2') ,
						'catalogo_cliente_coment' => $this->input->post('coment'),
						'catalogo_cliente_calle' => $this->input->post('calle'),
						'catalogo_cliente_numero' => $this->input->post('numero'),
						'catalogo_cliente_colonia' => $this->input->post('colonia'),
						'catalogo_cliente_cp' => $this->input->post('cp'),
						'catalogo_cliente_mun_estado' => $this->input->post('mun_estado'));
		if($this->QM_model->New_Customer($data)){
			echo true;
		}else{
			echo false;
		}
	}
	public function UpdateCustomer(){
		$this->load->model('QM_model');
		$id_cust=$_POST["id_cat"];
		$data = array('catalogo_cliente_empresa' => $this->input->post('nom_comer'),
						'catalogo_cliente_contacto1' => $this->input->post('cont1') ,
						'catalogo_cliente_tel1' => $this->input->post('tel1') ,
						'catalogo_cliente_cel1' => $this->input->post('cel1') ,
						'catalogo_cliente_email1' => $this->input->post('email1') ,
						'catalogo_cliente_contacto2' => $this->input->post('cont2') ,
						'catalogo_cliente_tel2' => $this->input->post('tel2') ,
						'catalogo_cliente_cel2' => $this->input->post('cel2') ,
						'catalogo_cliente_email2' => $this->input->post('email2') ,
						'catalogo_cliente_coment' => $this->input->post('coment'),
						'catalogo_cliente_calle' => $this->input->post('calle'),
						'catalogo_cliente_numero' => $this->input->post('numero'),
						'catalogo_cliente_colonia' => $this->input->post('colonia'),
						'catalogo_cliente_cp' => $this->input->post('cp'),
						'catalogo_cliente_mun_estado' => $this->input->post('mun_estado'),);
		if($this->QM_model->Update_Customer($id_cust,$data)){
			echo true;
		}else{
			echo false;
		}
	}


	public function EditCustomerProject(){
		$this->load->model('QM_model');
		$act_nom=$_POST["act_nom"];
		$act_cliente=$_POST["act_cliente"];
		$act_imp=$_POST["act_imp"];
		$act_estado=$_POST["act_estado"];
		$act_coment=$_POST["act_coment"];
		$id=$_POST["id"];
		$contrato=$_POST["contrato"];

		$fecha_evento=$_POST["fecha_evento"];
		$tipo_evento=$_POST["tipo_evento"];
		$cant_persona=$_POST["cant_persona"];
		$mobiliario=$_POST["mobiliario"];
		$permiso=$_POST["permiso"];

		$total_horas=$_POST["total_horas"];
		$hora_inicio=$_POST["hora_inicio"];
		$hora_fin=$_POST["hora_fin"];
		$anticipo=$_POST["anticipo"];
		$fecha_fin=$_POST["fecha_fin"];

		$importe_txt=$_POST["importe_txt"];
		$anticipo_txt=$_POST["anticipo_txt"];
		$resto=$_POST["resto_2"];
		$resto_txt=$_POST["resto_txt"];


		$company='QM';
		$idcomp=$this->QM_model->IdCompany($company);
		$sum_pagos=$this->QM_model->SumPagos_Obra($id);
		if(is_null($sum_pagos->suma_pagos)){
			$suma_pagos=0;
		}else{
			$suma_pagos=$sum_pagos->suma_pagos;
		}
		$saldo=($act_imp-$suma_pagos);
		$data = array(
        'obra_cliente_nombre' => $act_nom,
        'obra_cliente_id_cliente'=>$act_cliente,
        'obra_cliente_imp_total' => $act_imp,
        'obra_cliente_pagado'=>$suma_pagos,
        'obra_cliente_saldo'=>$saldo,
        'obra_cliente_estado' => $act_estado,
        'obra_cliente_comentarios' => $act_coment,
    	'obra_cliente_contrato' => $contrato);

		$data2 = array('evento_detalle_fecha' => $fecha_evento,
						'evento_detalle_personas' => $cant_persona,
						'evento_detalle_tipo_evento' => $tipo_evento,
						'evento_detalle_permiso' => $permiso,
						'detalle_evento_mobiliario' => $mobiliario,
						'evento_detalle_total_horas' => $total_horas,
						'evento_detalle_hora_inicio' => $hora_inicio,
						'evento_detalle_hora_fin' => $hora_fin,
						'evento_detalle_fecha_fin' => $fecha_fin,
						'evento_detalle_anticipo' => $anticipo,
						'evento_detalle_anticipo_txt' => $anticipo_txt,
						'evento_detalle_monto_txt' => $importe_txt,
						'evento_detalle_resto' => $resto,
						'evento_detalle_resto_txt' => $resto_txt,);
		$this->QM_model->Edit_CustomerProject($id,$data);
		$this->QM_model->Edit_Evento_Detallest($id,$data2);
		echo true;
	}

	function Detalles_Evento(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$id_evento=$_POST["id_evento"];
		$data=array('datos_evento'=>$this->QM_model->Datos_evento($id_evento),
					'detalles_evento' => $this->QM_model->Detalles_evento($id_evento),
					'detalles_mobiliario' => $this->QM_model->Detalles_mobiliario($id_evento),
					'lista_mobiliario' => $this->QM_model->GetInventorie_Products($idcompany->id_empresa),
					'unidades_medida'=>$this->QM_model->GetAllMeasurements());

		$this->load->view('Quinta/Detalles_Evento_tbl',$data);
	}

	function Add_Mob_Serv(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$id_evento=$_POST["id_evento"];
		$id_mob_serv=$_POST["id_mob_serv"];
		$mob_serv_cantidad=$_POST["mob_serv_cantidad"];
		$coment=$_POST["coment"];
		$data = array('id_evento' => $id_evento,
						'id_mobiliario' => $id_mob_serv,
						'evento_mobiliario_cantidad' => $mob_serv_cantidad,
						'evento_mobiliario_coment' => $coment);
		$table="evento_mobiliario";
		echo $this->QM_model->Insert($table, $data);
	}

	function Update_Mob_Serv(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$id_evento_mobiliario=$_POST["id_evento_mobiliario"];

		$mob_serv_cantidad=$_POST["mob_serv_cantidad"];
		$coment=$_POST["coment"];
		$data = array('evento_mobiliario_cantidad' => $mob_serv_cantidad,
						'evento_mobiliario_coment' => $coment);
		echo $this->QM_model->Update_Mobiliario($id_evento_mobiliario, $data);
	}

	function Delete_Mob_Serv(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$id_evento_mobiliario=$_POST["id_evento_mobiliario"];

		echo $this->QM_model->Delete_Mobiliario($id_evento_mobiliario);
	}

		public function CustomerPayments(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$data=array('customerspays'=>$this->QM_model->GetAllCustomer_Payments($idcompany->id_empresa),
					'id_max_recibo'=> $this->QM_model->Get_MAXFOLIO_recibo($idcompany->id_empresa));
		$this->load->view('Quinta/Customer_Payments',$data);
	}
		public function Customer_Payments_tbl(){
		$this->load->model('QM_model');
		$company='QM';
		$activo=$_POST["activo"];
		$idcompany=$this->QM_model->IdCompany($company);
		$data=array('customerspays'=>$this->QM_model->GetAllCustomer_Payments($idcompany->id_empresa),
					'filtro'=>$activo);
		$this->load->view('Quinta/Customer_Payments_tbl',$data);
	}

	public function AddCustomersPay(){
		$this->load->model('QM_model');
		$new_id_obra=$_POST["id_obra"];
		$new_cant_pago=$_POST["cant_pago"];
		$new_fecha=$_POST["fecha"];
		$new_coment=$_POST["coment"];
		$cant_pago_letra=$_POST["cant_pago_letra"];
		$no_recibo=$_POST["no_recibo"];
		$company='QM';
		$idcomp=$this->QM_model->IdCompany($company);

		$data = array('obra_cliente_empresa_id_empresa' => $idcomp->id_empresa,
			'venta_mov_fecha' => $new_fecha,
			'venta_mov_comentario' => $new_coment,
			'venta_mov_monto' => $new_cant_pago,
			'obra_cliente_id_obra_cliente' => $new_id_obra,
			'venta_mov_monto_letra' => $cant_pago_letra,
			'venta_mov_factura' => $no_recibo);
		//var_dump($data);

		$result=$this->QM_model->AddCustomer_Pay($data);

		$sum_pagos=$this->QM_model->SumPagos_Obra($new_id_obra);
		$total_obra=$this->QM_model->Total_obra($new_id_obra);
		$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->suma_pagos);
		$fecha_ult_pago=$this->QM_model->Fecha_Ult_Pago($new_id_obra);
		//var_dump($fecha_ult_pago->venta_mov_fecha);
		$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
		$actualiza=$this->QM_model->UpdatePaysCustomer($new_id_obra,$saldo);
		//var_dump($saldo);
		echo $result;
	}

	public function Payments_List(){
		$this->load->model('QM_model');
		$company='QM';
		$id_obra=$_POST["id_obra"];
		$data2=$this->QM_model->Datos_obra($id_obra);
		$idcompany=$this->QM_model->IdCompany($company);
		$data=array('payments_list'=>$this->QM_model->GetPayments_List($id_obra),
					'obra'=>$data2);
		$this->load->view('Quinta/Customer_Payments_List',$data);
	}
	
	public function EditCustomerPay(){
		$id_movimiento=$_POST["id"];
		$this->load->model('QM_model');
		$data = array('venta_mov_fecha' => $this->input->post('act_fecha') ,
						'venta_mov_monto' => $this->input->post('act_imp'),
						'venta_mov_comentario' => $this->input->post('act_coment'),
						'venta_mov_monto_letra' => $this->input->post('cant_pago_letra'),
						'venta_mov_factura' => $this->input->post('no_recibo'));
		//var_dump($id_movimiento);
		if ($this->QM_model->UpdateProject_Pay($data,$id_movimiento)) {
			$id_obra=$this->QM_model->Id_Proyecto($id_movimiento);
			$sum_pagos=$this->QM_model->SumPagos_Obra($id_obra->obra_cliente_id_obra_cliente);
			$total_obra=$this->QM_model->Total_obra($id_obra->obra_cliente_id_obra_cliente);
			$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->suma_pagos);

			$fecha_ult_pago=$this->QM_model->Fecha_Ult_Pago($id_obra->obra_cliente_id_obra_cliente);

			$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
			$actualiza=$this->QM_model->UpdatePaysCustomer($id_obra->obra_cliente_id_obra_cliente,$saldo);
			echo 'actualizado';
		}else{
			echo 'error';
		}
	}

	public function Genera_PDF_Recibo_Pago(){
		$this->load->model('QM_model');
		$company='QM';
		$id_venta_mov=$_POST["id_venta_mov"];
		//$folio=$_POST["folio"];
		$idcomp=$this->QM_model->IdCompany($company);
		$data = array('recibo_info'=>$this->QM_model->GetRecibo_Info($id_venta_mov));
			//'recibo_products' => $this->QM_model->GetRecibo_Products($id_lista_recibo_entrega));

		$css=file_get_contents('assets/Personalized/css/Recibo_Pago_QM.css');
		$mpdf = new \Mpdf\Mpdf([
			"format" => "letter",
			 'orientation' => 'L'
			//'pagenumPrefix' => 'Hoja ',
			//'nbpgPrefix' => ' de '
		]);
		$hola="";
		$html = $this->load->view('Quinta/Recibo_Entrega_Formato',$data,true);
		//$mpdf->setFooter('{PAGENO}{nbpg}');
		$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->Output('Recibo_Pago_'.'.pdf','I'); 
	}

	public function Num_letras(){
		$this->load->model('QM_model');
		
		$this->load->view('Quinta/Num_letras');
	}


	public function Nuevo_Contrato(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);

		$id_contrato=$_POST["id_contrato"];
		$num_contrato=$_POST["num_contrato"];

		if($id_contrato==0){
			$data = array('id_max_contrato'=>$this->QM_model->Get_MAXFOLIO_contrato($idcompany->id_empresa));
			$this->load->view('Quinta/Formato_Contrato',$data);
		}else{
			$data2=array('datos_evento'=>$this->QM_model->Datos_evento($id_contrato),
					'detalles_evento' => $this->QM_model->Detalles_evento($id_contrato),
					'detalles_mobiliario' => $this->QM_model->Detalles_mobiliario($id_contrato),
					'lista_mobiliario' => $this->QM_model->GetInventorie_Products($idcompany->id_empresa),
					'unidades_medida'=>$this->QM_model->GetAllMeasurements(),
					'id_max_contrato'=>$this->QM_model->Get_MAXFOLIO_contrato($idcompany->id_empresa));
		//$this->load->view('Quinta/Formato_Contrato',$data2);
		}

		$css=file_get_contents('assets/Personalized/css/PDFStyles_Contrato_QM.css');
		$mpdf = new \Mpdf\Mpdf([
			"format" => "letter",
			'orientation' => 'P',
			'pagenumPrefix' => 'Hoja ',
			'nbpgPrefix' => ' de ',
			'margin_left' => 30,
		    'margin_right' => 30,
		    'margin_top' => 30,
		    'margin_bottom' => 30,


		]);
	$mpdf->defaultfooterline=0; //Eliminamos la línea del pie de página
	$mpdf->defaultheaderline=0; //Eliminamos la línea del encabezado
	$mpdf->setheader('
<table style="width: 100%">
	<tr>
		<td>
			<img style="filter: invert(50%)" src="Resources/Logos/logo_qm.png">
		</td>

		<td style="width: 80%">
			<label class="label-control" style="margin-top: 1em; font-style: gray; font-size: 14"><b>Quinta Monticello, Salón de Eventos.</b></label>
			<br>
			<hr style="height:2px; width: 98%;border-width:0;color:gray;background-color:gray; margin-top: 0.1em;">
		</td>
	</tr>
</table>');


		$html = $this->load->view('Quinta/Formato_Contrato',$data2,true);
		$mpdf->setFooter('<table class="tb_footer" style="text-align: center; width: 100%">
	<tr>
		<td>
			<img class="img_footer" style="height: 1.56cm; width: 3.34cm" src="Resources/Logos/QM.png">
		</td>
	</tr>
</table> {PAGENO}{nbpg}');
		$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->AddPage();
		$html2 = $this->load->view('Quinta/Reglamento_Contrato',$data2,true);
		$mpdf->WriteHTML($html2,\Mpdf\HTMLParserMode::HTML_BODY);

		$mpdf->AddPage();
		$html3 = $this->load->view('Quinta/Croquis_Evento',$data2,true);
		$mpdf->WriteHTML($html3,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->Output('Contrato_quinta_'.$num_contrato.'.pdf','I'); 
	}

	function Croquis(){
		$this->load->model('QM_model');
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$id_evento=$_POST["id_evento"];
		$data=array('datos_evento'=>$this->QM_model->Datos_evento($id_evento),
					'detalles_evento' => $this->QM_model->Detalles_evento($id_evento),
					'detalles_mobiliario' => $this->QM_model->Detalles_mobiliario($id_evento),
					'lista_mobiliario' => $this->QM_model->GetInventorie_Products($idcompany->id_empresa),
					'unidades_medida'=>$this->QM_model->GetAllMeasurements());

		$this->load->view('Quinta/Croquis_Evento_Edit',$data);
	}

	public function GetInventories(){
		$this->load->model('QM_model');
		$table = 'catalogo_producto';
		$id = 'id_catalogo_producto';
		$company='QM';
		$idcompany=$this->QM_model->IdCompany($company);
		$data = array('inventories' => $this->QM_model->GetAllProducts($idcompany->id_empresa),
						'providers' => $this->QM_model->GetAll_Provider($idcompany->id_empresa),
						'measure' => $this->QM_model->GetAllMeasurements(),
						'max'=>$this->QM_model->IDMAX($table, $id));
		$this->load->view('Quinta/Product_Catalog', $data);
	}

	public function AddProduct(){
		$this->load->model('QM_model');
		$company='QM';
		$idcomp=$this->QM_model->IdCompany($company);

		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Products&Services/QM/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas


		$table = 'catalogo_producto';
		$data = array('catalogo_producto_nombre'=> $this->input->post('nameProductInsert'),
			'catalogo_producto_umedida'=> $this->input->post('medidaInsert'),
			'catalogo_producto_precio'=> $this->input->post('priceInsert'),
			'catalogo_proveedor_id_catalogo_proveedor'=> $this->input->post('providerInsert'),
			'catalogo_proveedor_empresa_id_empresa'=> $idcomp->id_empresa,
			'catalogo_producto_fecha_actualizacion' => $this->input->post('dateInsert'));

		$id_producto=$this->QM_model->Insert($table, $data);

		$data_historial = array('id_producto' => $id_producto,
								'historial_fecha_actualizacion' => $this->input->post('dateInsert'),
								'historial_id_proveedor'=> $this->input->post('providerInsert'),
								'historial_precio_producto_precio' => $this->input->post('priceInsert'));
		$tabla_historial='historial_precio_producto';

		$this->QM_model->Insert($tabla_historial,$data_historial);

		$url_imagen='Resources/Products&Services/Qm/Product_Service_'.$id_producto.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_producto!=""&&$filename!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

				$data2 = array('catalogo_producto_url_imagen' => $url_imagen);
				$this->QM_model->UpdateProduct($id_producto, $data2);
				echo true;
			}else{
				echo false;
			}
    	}
    	echo true;
    }

public function UpdateInfoProduct(){
		$this->load->model('QM_model');
		$company='QM';
		$idcomp=$this->QM_model->IdCompany($company);
		$id = $_POST["idE"];
		$priceE=$_POST["priceE"];
		//$priceE=$priceE.replace(/\,/g, '');
		$priceE = str_replace(',', '', $priceE); 


		if (isset($_FILES['imageE']['name'])) {
			$filename = $_FILES['imageE']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Products&Services/QM/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas



		$url_imagen='Resources/Products&Services/QM/Product_Service_'.$id.'.'.$file_extension;

		if ($filename=="") {
			$id = $_POST["idE"];
			$data = array(
				'catalogo_producto_nombre' => $this->input->post('nameProductE'),
				'catalogo_producto_umedida' => $this->input->post('medidaE'),
				'catalogo_producto_precio'=>$priceE,
				'catalogo_proveedor_id_catalogo_proveedor' => $this->input->post('providerE'),
				'catalogo_producto_fecha_actualizacion' => $this->input->post('dateE'));

				$this->QM_model->UpdateProduct($id, $data);

                $data_historial = array('id_producto' => $id,
                'historial_fecha_actualizacion' => $this->input->post('dateE'),
                'historial_id_proveedor'=> $this->input->post('providerE'),
            	'historial_precio_producto_precio' => $priceE);
    			$tabla_historial='historial_precio_producto';

    			$this->QM_model->Insert($tabla_historial,$data_historial);

			echo true;
		}else{
			if(in_array($file_extension,$image_ext)&&$id!=""){
					// Upload file
				if(move_uploaded_file($_FILES['imageE']['tmp_name'],$url_imagen)){
					$id = $_POST["idE"];
					$data = array(
						'catalogo_producto_nombre' => $this->input->post('nameProductE'),
						'catalogo_producto_umedida' => $this->input->post('medidaE'),
						'catalogo_producto_precio'=>$priceE,
						'catalogo_proveedor_id_catalogo_proveedor' => $this->input->post('providerE'),
						'catalogo_producto_fecha_actualizacion' => $this->input->post('dateE'),
						'catalogo_producto_url_imagen' => $url_imagen);
					$this->QM_model->UpdateProduct($id, $data);
					echo true;
				}else{
					echo false;
				}
			}
		}
	}


	public function Product_Record(){
		$this->load->model('QM_model');
		$id_producto=$_POST['id_product'];
		$data = array('record_product' => $this->QM_model->Get_Product_Record($id_producto),
					  'product_info' => $this->QM_model->Get_Product_Info($id_producto));
		$this->load->view('Quinta/Record_Product', $data);

	}
	



}

