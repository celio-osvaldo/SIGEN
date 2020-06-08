<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Iluminacion extends CI_Controller {

#views

	public function Index()
	{
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          $data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          $data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          $data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | Iluminacion';
	   		$this->load->view('plantillas/header_iluminacion', $data);
			$this->load->view('Iluminacion/Welcome');
       		$this->load->view('plantillas/footer_iluminacion');
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

	public function InventarioProductos(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data=array('inventario_productos'=>$this->Iluminacion_model->GetInventorie_Products($idcompany->id_empresa),
					'unidades_medida'=>$this->Iluminacion_model->GetAllMeasurements());
		//var_dump($data);
		$this->load->view('Iluminacion/Inventario_Productos',$data);
	}

	public function Update_Alm_Product(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$id_prod=$_POST["id_prod"];
		$data = array(
						'prod_alm_nom' => $this->input->post('nom_prod'),
						'prod_alm_medida' => $this->input->post('unid_med'),
						'prod_alm_modelo' => $this->input->post('modelo'),
						'prod_alm_prec_unit' => $this->input->post('precio'),
						'prod_alm_precio_venta' => $this->input->post('precio_venta'),
						'prod_alm_exist' => $this->input->post('existencia'),
						'prod_alm_codigo' => $this->input->post('codigo'),
						'prod_alm_descripcion' => $this->input->post('descripcion'),
						'prod_alm_coment' => $this->input->post('coment'));
		if($this->Iluminacion_model->Edit_Product($id_prod,$data)){
			echo true;
		}else{
			echo false;
		}		
	}

	public function NewAlm_Product(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data = array('empresa_id_empresa' => $idcompany->id_empresa,
						'prod_alm_nom' => $this->input->post('nom_prod'),
						'prod_alm_medida' => $this->input->post('unid_med'),
						'prod_alm_modelo' => $this->input->post('modelo'),
						'prod_alm_prec_unit' => $this->input->post('precio'),
						'prod_alm_precio_venta' => $this->input->post('precio_venta'),
						'prod_alm_exist' => $this->input->post('existencia'),
						'prod_alm_codigo' => $this->input->post('codigo'),
						'prod_alm_descripcion' => $this->input->post('descripcion'),
						'prod_alm_coment' => $this->input->post('coment'));
		if($this->Iluminacion_model->New_Product($data)){
			echo true;
		}else{
			echo false;
		}		
	}


	public function InventarioOficina(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data=array('inventario_oficina'=>$this->Iluminacion_model->GetInventorie_Office($idcompany->id_empresa),
					'unidades_medida'=>$this->Iluminacion_model->GetAllMeasurements(),
					'providers' => $this->Iluminacion_model->GetAll_Provider($idcompany->id_empresa));
		//var_dump($company);
		//var_dump($idcompany);
		//var_dump($data['inventario_oficina']);
		$this->load->view('Iluminacion/Inventario_Oficina',$data);
	}

	public function UpdateConsumible(){
		$this->load->model('Iluminacion_model');
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
		if($this->Iluminacion_model->Update_Consumible($id, $data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function NewAlm_Consumible(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
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
		if($this->Iluminacion_model->New_Consumible($data)){
			echo true;
		}else{
			echo false;
		}	
	}

	public function CustomerProjects(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data=array('proyectlist'=>$this->Iluminacion_model->GetAllCustomer_Project($idcompany->id_empresa),
					'customerlist'=>$this->Iluminacion_model->Get_Customer_List($idcompany->id_empresa));
		$this->load->view('Iluminacion/Customer_Projects',$data);
	}

	public function AddCustomerProject(){
		$this->load->model('Iluminacion_model');
		$nombre=$_POST["nombre"];
		$id_cliente=$_POST["id_cliente"];
		$importe=$_POST["importe"];
		$coment=$_POST["coment"];
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
				$data=array('empresa_id_empresa' => $idcomp->id_empresa,
					'obra_cliente_nombre'=> $nombre,
					'obra_cliente_id_cliente'=>$id_cliente,
					'obra_cliente_imp_total'=>$importe,
					'obra_cliente_saldo'=>$importe,
					'obra_cliente_estado'=>1,
					'obra_cliente_comentarios'=>$coment);
		$result=$this->Iluminacion_model->AddCustomer_Project($data);
		echo $result;		
	}

	public function EditCustomerProject(){
		$this->load->model('Iluminacion_model');
		$act_nom=$_POST["act_nom"];
		$act_cliente=$_POST["act_cliente"];
		$act_imp=$_POST["act_imp"];
		$act_estado=$_POST["act_estado"];
		$act_coment=$_POST["act_coment"];
		$id=$_POST["id"];
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$sum_pagos=$this->Iluminacion_model->SumPagos_Obra($id);
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
        'obra_cliente_comentarios' => $act_coment
			);
		$result=$this->Iluminacion_model->Edit_CustomerProject($id,$data);
		echo $result;
	}

		public function CustomerPayments(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data=array('customerspays'=>$this->Iluminacion_model->GetAllCustomer_Payments($idcompany->id_empresa));
		$this->load->view('Iluminacion/Customer_Payments',$data);
	}

	public function AddCustomersPay(){
		$this->load->model('Iluminacion_model');
		$new_id_obra=$_POST["id_obra"];
		$new_cant_pago=$_POST["cant_pago"];
		$new_fecha=$_POST["fecha"];
		$new_coment=$_POST["coment"];
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);

		$data = array('obra_cliente_empresa_id_empresa' => $idcomp->id_empresa,
			'venta_mov_fecha' => $new_fecha,
			'venta_mov_comentario' => $new_coment,
			'venta_mov_monto' => $new_cant_pago,
			'obra_cliente_id_obra_cliente' => $new_id_obra);
		//var_dump($data);

		$result=$this->Iluminacion_model->AddCustomer_Pay($data);

		$sum_pagos=$this->Iluminacion_model->SumPagos_Obra($new_id_obra);
		$total_obra=$this->Iluminacion_model->Total_obra($new_id_obra);
		$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->suma_pagos);
		$fecha_ult_pago=$this->Iluminacion_model->Fecha_Ult_Pago($new_id_obra);
		//var_dump($fecha_ult_pago->venta_mov_fecha);
		$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
		$actualiza=$this->Iluminacion_model->UpdatePaysCustomer($new_id_obra,$saldo);
		//var_dump($saldo);
		echo $result;
	}

	public function Payments_List(){
		$this->load->model('Iluminacion_model');
		$id_obra=$_POST["id_obra"];
		$data2=$this->Iluminacion_model->Datos_obra($id_obra);
		$data=array('payments_list'=>$this->Iluminacion_model->GetPayments_List($id_obra),
					'obra'=>$data2);
		$this->load->view('Iluminacion/Customer_Payments_List',$data);
	}

	public function EditCustomerPay(){
		$id_movimiento=$_POST["id"];
		$this->load->model('Iluminacion_model');
		$data = array('venta_mov_fecha' => $this->input->post('act_fecha') ,
						'venta_mov_monto' => $this->input->post('act_imp'),
						'venta_mov_comentario' => $this->input->post('act_coment') );
		//var_dump($id_movimiento);
		if ($this->Iluminacion_model->UpdateProject_Pay($data,$id_movimiento)) {
			$id_obra=$this->Iluminacion_model->Id_Proyecto($id_movimiento);
			$sum_pagos=$this->Iluminacion_model->SumPagos_Obra($id_obra->obra_cliente_id_obra_cliente);
			$total_obra=$this->Iluminacion_model->Total_obra($id_obra->obra_cliente_id_obra_cliente);
			$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->suma_pagos);

			$fecha_ult_pago=$this->Iluminacion_model->Fecha_Ult_Pago($id_obra->obra_cliente_id_obra_cliente);

			$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
			$actualiza=$this->Iluminacion_model->UpdatePaysCustomer($id_obra->obra_cliente_id_obra_cliente,$saldo);
			echo 'actualizado';
		}else{
			echo 'error';
		}
	}

	public function Catalogo_Proveedor(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		//var_dump($company);
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		//var_dump($idcompany);
		$data=array('catalogo_proveedor'=>$this->Iluminacion_model->GetAll_Provider($idcompany->id_empresa));
		$this->load->view('Iluminacion/Cat_Provider',$data);
		//var_dump($data);
	}

	public function UpdateProvider(){
		$this->load->model('Iluminacion_model');
		$id_prov=$_POST["id_cat"];
		$data = array('catalogo_proveedor_nom_fiscal' => $this->input->post('nom_fiscal') ,
						'catalogo_proveedor_empresa' => $this->input->post('nom_comer'),
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
		if($this->Iluminacion_model->Update_Provider($id_prov,$data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function NewProvider(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('empresa_id_empresa' => $idcomp->id_empresa ,
						'catalogo_proveedor_nom_fiscal' => $this->input->post('nom_fiscal') ,
						'catalogo_proveedor_empresa' => $this->input->post('nom_comer'),
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
		if($this->Iluminacion_model->New_Provider($data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function GetInventories(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data = array('inventories' => $this->Iluminacion_model->GetAllProducts($idcompany->id_empresa),
						'providers' => $this->Iluminacion_model->GetAll_Provider($idcompany->id_empresa),
						'measure' => $this->Iluminacion_model->GetAllMeasurements());
		$this->load->view('Iluminacion/Product_Catalog', $data);
	}

	public function UpdateInfoProduct(){
		$this->load->model('Iluminacion_model');
		$id = $_POST["idE"];
    	$data = array(
    					'catalogo_producto_nombre' => $this->input->post('nameProductE'),
				        'catalogo_producto_umedida' => $this->input->post('medidaE'),
				        'catalogo_producto_precio'=>$this->input->post('priceE'),
				        'catalogo_proveedor_id_catalogo_proveedor' => $this->input->post('providerE'),
				        'catalogo_proveedor_empresa_id_empresa' => $this->input->post('EnterpriseIDE'),
				        'catalogo_producto_fecha_actualizacion' => $this->input->post('dateE'),
				        'catalogo_producto_url_imagen' => $this->input->post('imageE'));
		if($this->Iluminacion_model->UpdateProduct($id, $data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function AddProduct(){
		$table = 'catalogo_producto';
		$data = array('id_catalogo_producto' => $this->input->post('idInsert'),
			'catalogo_producto_nombre'=> $this->input->post('nameProductInsert'),
			'catalogo_producto_umedida'=> $this->input->post('medidaInsert'),
			'catalogo_producto_precio'=> $this->input->post('priceInsert'),
			'catalogo_proveedor_id_catalogo_proveedor'=> $this->input->post('providerInsert'),
			'catalogo_proveedor_empresa_id_empresa'=> $this->input->post('EnterpriseIDInsert'),
			'catalogo_producto_fecha_actualizacion' => $this->input->post('dateInsert'));
		$this->load->model('Iluminacion_model');
		$result = $this->Iluminacion_model->Insert($table, $data);
		echo $result;
	}

	public function Catalogo_Cliente(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		//var_dump($company);
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		//var_dump($idcompany);
		$data=array('catalogo_cliente'=>$this->Iluminacion_model->GetAll_Customer($idcompany->id_empresa));
		$this->load->view('Iluminacion/Cat_Customer',$data);
		//var_dump($data);
	}

	public function UpdateCustomer(){
		$this->load->model('Iluminacion_model');
		$id_cust=$_POST["id_cat"];
		$data = array('catalogo_cliente_nom_fiscal' => $this->input->post('nom_fiscal') ,
						'catalogo_cliente_empresa' => $this->input->post('nom_comer'),
						'catalogo_cliente_rfc' => $this->input->post('rfc'),
						'catalogo_cliente_contacto1' => $this->input->post('cont1') ,
						'catalogo_cliente_puesto1' => $this->input->post('puesto1') ,
						'catalogo_cliente_tel1' => $this->input->post('tel1') ,
						'catalogo_cliente_cel1' => $this->input->post('cel1') ,
						'catalogo_cliente_email1' => $this->input->post('email1') ,
						'catalogo_cliente_contacto2' => $this->input->post('cont2') ,
						'catalogo_cliente_puesto2' => $this->input->post('puesto2') ,
						'catalogo_cliente_tel2' => $this->input->post('tel2') ,
						'catalogo_cliente_cel2' => $this->input->post('cel2') ,
						'catalogo_cliente_email2' => $this->input->post('email2') ,
						'catalogo_cliente_coment' => $this->input->post('coment'));
		if($this->Iluminacion_model->Update_Customer($id_cust,$data)){
			echo true;
		}else{
			echo false;
		}
	}


	public function NewCustomer(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('empresa_id_empresa' => $idcomp->id_empresa ,
						'catalogo_cliente_nom_fiscal' => $this->input->post('nom_fiscal') ,
						'catalogo_cliente_empresa' => $this->input->post('nom_comer'),
						'catalogo_cliente_rfc' => $this->input->post('rfc'),
						'catalogo_cliente_contacto1' => $this->input->post('cont1') ,
						'catalogo_cliente_puesto1' => $this->input->post('puesto1') ,
						'catalogo_cliente_tel1' => $this->input->post('tel1') ,
						'catalogo_cliente_cel1' => $this->input->post('cel1') ,
						'catalogo_cliente_email1' => $this->input->post('email1') ,
						'catalogo_cliente_contacto2' => $this->input->post('cont2') ,
						'catalogo_cliente_puesto2' => $this->input->post('puesto2') ,
						'catalogo_cliente_tel2' => $this->input->post('tel2') ,
						'catalogo_cliente_cel2' => $this->input->post('cel2') ,
						'catalogo_cliente_email2' => $this->input->post('email2') ,
						'catalogo_cliente_coment' => $this->input->post('coment'));
		if($this->Iluminacion_model->New_Customer($data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function Anticipos(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data=array('inventario_productos'=>$this->Iluminacion_model->GetInventorie_Products($idcomp->id_empresa),
					'unidades_medida'=>$this->Iluminacion_model->GetAllMeasurements(),
					'catalogo_cliente'=>$this->Iluminacion_model->GetAll_Customer($idcomp->id_empresa),
					'lista_anticipos'=>$this->Iluminacion_model->GetAll_Anticipos());
		//var_dump($data);
		$this->load->view('Iluminacion/Lista_Anticipos',$data);
	}

	public function NewAnticipo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('obra_cliente_id_obra_cliente' => $this->input->post('cliente') ,
					  'anticipo_status' => 'Activo',
					  'anticipo_fecha_finiquito'=> $this->input->post('fecha_fin'),
					  'anticipo_fecha_entrega' => $this->input->post('fecha_ent'),
					  'anticipo_coment' =>$this->input->post('coment'));
		if($this->Iluminacion_model->New_Anticipo($data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function Update_Anticipo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_anticipo=$_POST["id_anticipo"];
		$estado_anterior=$_POST["estado_anterior"];
		$estado_nuevo=$_POST["estado"];
		$data = array('obra_cliente_id_obra_cliente' => $this->input->post('cliente') ,
					  'anticipo_status' => $this->input->post('estado'),
					  'anticipo_fecha_finiquito'=> $this->input->post('fecha_fin'),
					  'anticipo_fecha_entrega' => $this->input->post('fecha_ent'),
					  'anticipo_coment' =>$this->input->post('coment'));
		if($this->Iluminacion_model->Update_Anticipo($data,$id_anticipo)){
			if($estado_anterior=="Activo"&&$estado_nuevo=="Cancelado"){//Si se cambia de estado de activo a Cancelado, se regresa la cantidad 															 	//de productos al almacen como invnetario.
				$productos=$this->Iluminacion_model->Get_Anticipo_Product_List($id_anticipo);
				//$resultado="entra1";
				foreach ($productos->result() as $row) {
					$prod_inventario=$this->Iluminacion_model->Get_Inventorie_Product($row->producto_almacen_id_prod_alm);
					$nueva_existencia=($prod_inventario->prod_alm_exist)+$row->prod_anticipo_cantidad;
					$existencia = array('prod_alm_exist' => $nueva_existencia );
					$this->Iluminacion_model->Actualiza_producto($row->producto_almacen_id_prod_alm,$existencia);
				}
			}

			if($estado_anterior=="Cancelado"&&$estado_nuevo=="Activo"){
				$productos=$this->Iluminacion_model->Get_Anticipo_Product_List($id_anticipo);
				//$resultado="entra2";
				foreach ($productos->result() as $row) {
					$prod_inventario=$this->Iluminacion_model->Get_Inventorie_Product($row->producto_almacen_id_prod_alm);
					$nueva_existencia=($prod_inventario->prod_alm_exist)-$row->prod_anticipo_cantidad;
					$existencia = array('prod_alm_exist' => $nueva_existencia );
					$this->Iluminacion_model->Actualiza_producto($row->producto_almacen_id_prod_alm,$existencia);
				}
			}

			echo true;
		}else{
			echo false;
		}
	}

	public function Add_Product(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		
		$id_anticipo=$_POST["id_anticipo"];
		$id_producto=$_POST["id_producto"];
		$data = array('anticipo_id_anticipo' =>$this->input->post('id_anticipo') ,
					  'producto_almacen_id_prod_alm' =>$this->input->post('id_producto') ,
					  'prod_anticipo_cantidad' =>$this->input->post('prod_cantidad') ,
					  'prod_anticipo_precio_venta' =>$this->input->post('prod_precio_venta') ,
					  'prod_anticipo_coment' =>$this->input->post('coment'));

		if($this->Iluminacion_model->Add_Anticipo_product($data)){

			$total=$this->Iluminacion_model->Get_Total_Anticipo($id_anticipo);
			$pagado=$this->Iluminacion_model->Get_Pagado_Anticipo($id_anticipo);
			$resto=(($total->total)-($pagado->anticipo_pago));
			$data2 = array('anticipo_total' => round($total->total,2),
							'anticipo_resto' => $resto );
			$this->Iluminacion_model->Update_Anticipo($data2,$id_anticipo);
			$prod_inventario=$this->Iluminacion_model->Get_Inventorie_Product($id_producto);
			$nueva_existencia=($prod_inventario->prod_alm_exist)-($this->input->post('prod_cantidad'));
			$existencia = array('prod_alm_exist' => $nueva_existencia );
			$this->Iluminacion_model->Actualiza_producto($id_producto,$existencia);
			echo true;
		}else{
			echo false;
		}
	}

	public function Anticipo_Prod_List(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_anticipo=$_POST["id_anticipo"];
		$data = array('anticipo_productos' => $this->Iluminacion_model->Get_Anticipo_Product_List($id_anticipo),
					  'anticipo_info' => $this->Iluminacion_model->Get_Anticipo_Info($id_anticipo),
					  'inventario_productos'=>$this->Iluminacion_model->GetInventorie_Products($idcomp->id_empresa));
		$this->load->view('Iluminacion/AnticipoProduct_List',$data);
	}

	public function EditProduct_Anticipo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_prod_ant=$_POST["id_prod_ant"];
		$id_producto=$_POST["id_producto"];
		$act_cantidad=$_POST["act_cantidad"];
		$cant_anterior=$_POST["cant_anterior"];
		$act_precio_venta=$_POST["act_precio_venta"];
		$precio_anterior=$_POST["precio_anterior"];
		$act_coment=$_POST["act_coment"];
		$id_anticipo=$_POST["id_anticipo"];
		$data = array('prod_anticipo_cantidad' => $act_cantidad ,
					  'prod_anticipo_precio_venta' => $act_precio_venta,
					  'prod_anticipo_coment' => $act_coment);

		if ($this->Iluminacion_model->Update_Prod_Anticipo($data,$id_prod_ant)) {
			$prod_inventario=$this->Iluminacion_model->Get_Inventorie_Product($id_producto);
			if($act_cantidad>$cant_anterior){
				$resta=$act_cantidad-$cant_anterior;
				$nueva_existencia=($prod_inventario->prod_alm_exist)-$resta;
				$existencia = array('prod_alm_exist' => $nueva_existencia );
				//$this->Iluminacion_model->Actualiza_producto($id_producto,$existencia);
			}else{
				$suma=$cant_anterior-$act_cantidad;
				$nueva_existencia=($prod_inventario->prod_alm_exist)+$suma;
				$existencia = array('prod_alm_exist' => $nueva_existencia );
				$this->Iluminacion_model->Actualiza_producto($id_producto,$existencia);
			}
		}
			$total=$this->Iluminacion_model->Get_Total_Anticipo($id_anticipo);
			$pagado=$this->Iluminacion_model->Get_Pagado_Anticipo($id_anticipo);
			$resto=(($total->total)-($pagado->anticipo_pago));
			$data2 = array('anticipo_total' => round($total->total,2),
							'anticipo_resto' => $resto );
			$this->Iluminacion_model->Update_Anticipo($data2,$id_anticipo);
			echo true;
	}

	public function DeleteProduct_Anticipo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_prod_ant=$_POST["id_prod_ant"];
		$id_producto=$_POST["id_producto"];
		$cantidad=$_POST["cantidad"];
		$precio_venta=$_POST["precio_venta"];
		$coment=$_POST["coment"];
		$id_anticipo=$_POST["id_anticipo"];

		if ($this->Iluminacion_model->Delete_Product_Ant($id_prod_ant)) {
			$prod_inventario=$this->Iluminacion_model->Get_Inventorie_Product($id_producto);
			$nueva_existencia=($prod_inventario->prod_alm_exist)+$cantidad;
			$existencia = array('prod_alm_exist' => $nueva_existencia );
			$this->Iluminacion_model->Actualiza_producto($id_producto,$existencia);
			$total=$this->Iluminacion_model->Get_Total_Anticipo($id_anticipo);
			$pagado=$this->Iluminacion_model->Get_Pagado_Anticipo($id_anticipo);
			$resto=(($total->total)-($pagado->anticipo_pago));
			$data2 = array('anticipo_total' => round($total->total,2),
				'anticipo_resto' => $resto );
			$this->Iluminacion_model->Update_Anticipo($data2,$id_anticipo);
			echo true;
		}else{
			echo false;
		}
	}

	public function Add_Pay(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_anticipo=$_POST['id_anticipo'];
		$cantidad=$_POST["cantidad"];
		$fecha=$_POST["fecha"];
		$coment=$_POST["coment"];
		$result="ok";


		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Pagos_Anticipo/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		$data = array('id_anticipo' => $id_anticipo,
			'pagos_anticipo_fecha' => $fecha,
			'pagos_anticipo_cantidad' => $cantidad,
			'pagos_anticipo_coment' => $coment);

		$id_pagos_anticipo=$this->Iluminacion_model->AddPay_Anticipo($data);


		$total=$this->Iluminacion_model->Get_Total_Anticipo($id_anticipo);

		$pagado=$this->Iluminacion_model->Get_Pagos($id_anticipo);
		$fecha_pago=$this->Iluminacion_model->Get_Fecha_pago($id_anticipo);
		$resto=(($total->total)-($pagado->total_pagos));
		if($resto<=0){
			$estado="Pagado";
		}else{
			$estado="Activo";
		}
		$data2 = array('anticipo_pago' => round($pagado->total_pagos,2),
						'anticipo_resto' => $resto,
						'anticipo_status' => $estado,
						'anticipo_fecha_deposito' => $fecha_pago->pagos_anticipo_fecha);
		$this->Iluminacion_model->Update_Anticipo($data2,$id_anticipo);
		$url_imagen='Resources/Pagos_Anticipo/Iluminacion/Anticipo_Pago_'.$id_pagos_anticipo.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_pagos_anticipo!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

				$data = array('pagos_anticipo_url_comprobante' => $url_imagen);
				$this->Iluminacion_model->UpdatePay_Anticipo($data,$id_pagos_anticipo);
				$result = "ok-ok";
			}else{
				$result="error-ok";
			}
		}else{
			$result="ok";
		}
		echo $result;
	}

	public function Anticipo_Pagos_List(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_anticipo=$_POST["id_anticipo"];
		$data = array('anticipo_pagos' => $this->Iluminacion_model->Get_Anticipo_Pay_List($id_anticipo),
					  'anticipo_info' => $this->Iluminacion_model->Get_Anticipo_Info($id_anticipo));
		$this->load->view('Iluminacion/AnticipoPay_List',$data);
	}

	public function EditPay_Anticipo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_anticipo=$_POST['id_anticipo'];
		$cantidad=$_POST["cantidad"];
		$fecha=$_POST["fecha"];
		$coment=$_POST["coment"];
		$id_pagos_anticipo=$_POST["id_pagos_anticipo"];

		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
		} else {
			$filename="";
		}
		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Pagos_Anticipo/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas
		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas
		$data = array('pagos_anticipo_fecha' => $fecha,
					  'pagos_anticipo_cantidad' => $cantidad,
					  'pagos_anticipo_coment' => $coment);

		$this->Iluminacion_model->UpdatePay_Anticipo($data,$id_pagos_anticipo);

		$total=$this->Iluminacion_model->Get_Total_Anticipo($id_anticipo);
		$pagado=$this->Iluminacion_model->Get_Pagos($id_anticipo);
		$fecha_pago=$this->Iluminacion_model->Get_Fecha_pago($id_anticipo);
		$resto=(($total->total)-($pagado->total_pagos));
		if($resto<=0){
			$estado="Pagado";
		}else{
			$estado="Activo";
		}
		$data2 = array('anticipo_pago' => round($pagado->total_pagos,2),
						'anticipo_resto' => round($resto,2),
						'anticipo_status' => $estado,
						'anticipo_fecha_deposito' => $fecha_pago->pagos_anticipo_fecha);
		$this->Iluminacion_model->Update_Anticipo($data2,$id_anticipo);

		$url_imagen='Resources/Pagos_Anticipo/Iluminacion/Anticipo_Pago_'.$id_pagos_anticipo.'.'.$file_extension;
		
		$ruta='Resources/Pagos_Anticipo/Iluminacion/';

		if(in_array($file_extension,$image_ext)&&$id_pagos_anticipo!=""){
  			// Upload file
  			foreach ($image_ext as $ext) {
  				$url_imagen2='Resources/Pagos_Anticipo/Iluminacion/Anticipo_Pago_'.$id_pagos_anticipo.'.'.$ext;
  				if (file_exists($url_imagen2)){
  					unlink($url_imagen2);
  				}  				
  			}		

			if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

				$data = array('pagos_anticipo_url_comprobante' => $url_imagen);
				$this->Iluminacion_model->UpdatePay_Anticipo($data,$id_pagos_anticipo);
				$result = "ok-ok";
			}
		}
		echo true;
	}

	public function DeletePay_Anticipo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_anticipo=$_POST["id_anticipo"];
		$id_pagos_anticipo=$_POST["id_pagos_anticipo"];

		$url_comprobante=$this->Iluminacion_model->Get_url_comprobante_Pago($id_pagos_anticipo);

		if($this->Iluminacion_model->Delete_Pay_anticipo($id_pagos_anticipo)){
			if (file_exists($url_comprobante->pagos_anticipo_url_comprobante)){
  					unlink($url_comprobante->pagos_anticipo_url_comprobante);
  				}
  			$total=$this->Iluminacion_model->Get_Total_Anticipo($id_anticipo);
			$pagado=$this->Iluminacion_model->Get_Pagos($id_anticipo);
			$fecha_pago=$this->Iluminacion_model->Get_Fecha_pago($id_anticipo);
			$resto=(($total->total)-($pagado->total_pagos));
			if($resto<=0){
				$estado="Pagado";
			}else{
				$estado="Activo";
			}
			$data2 = array('anticipo_pago' => round($pagado->total_pagos,2),
						'anticipo_resto' => round($resto,2),
						'anticipo_status' => $estado,
						'anticipo_fecha_deposito' => $fecha_pago->pagos_anticipo_fecha);
			$this->Iluminacion_model->Update_Anticipo($data2,$id_anticipo);
			echo true;
		}else{
			echo false;
		}
	}

	public function Pagos_SFV(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data=array('catalogo_cliente'=>$this->Iluminacion_model->GetAll_Customer($idcomp->id_empresa),
					'lista_pagos_sfv'=>$this->Iluminacion_model->GetAll_Pagos_SFV($idcomp->id_empresa));
		$this->load->view('Iluminacion/Lista_SFV',$data);
	}

	public function NewSFV(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('pago_sfv_id_cliente' => $this->input->post('cliente') ,
					  'pago_sfv_id_empresa' => $idcomp->id_empresa,
					  'pago_sfv_kwh'=> $this->input->post('kwh'),
					  'pago_sfv_estado' => 'Activo',
					  'pago_sfv_cant_pagos' => $this->input->post('cant_pagos'),
					  'pago_sfv_coment' =>$this->input->post('coment'),
					  'pago_sfv_imp_total' => $this->input->post('imp_total'),
					  'pago_sfv_saldo' => $this->input->post('imp_total'),);
		if($this->Iluminacion_model->New_SFV($data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function UpdateSFV(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_pago_sfv=$_POST["id_pago_sfv"];
		$imp_total=$_POST["imp_total"];
		$estado=$_POST["estado"];
		$suma_pagos=$this->Iluminacion_model->Get_Total_Pagos_SFV($id_pago_sfv); //total_pagos

		$resto=($imp_total-($suma_pagos->total_pagos));

		if($estado!="Cancelado"){
			if($resto<=0){
				$estado="Pagado";
			}else{
				$estado="Activo";
			}
		}

		$data = array('pago_sfv_id_cliente' => $this->input->post('cliente'),
					  'pago_sfv_kwh'=> $this->input->post('kwh'),
					  'pago_sfv_estado' => $estado,
					  'pago_sfv_cant_pagos' => $this->input->post('cant_pagos'),
					  'pago_sfv_coment' =>$this->input->post('coment'),
					  'pago_sfv_imp_total' => $imp_total,
					  'pago_sfv_saldo' => $resto);


		if($this->Iluminacion_model->Update_SFV($data,$id_pago_sfv)){
			echo true;
		}else{
			echo false;
		}

	}

	public function Add_Pay_SFV(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_pago_sfv=$_POST["id_pago_sfv"];
		$num_pago=$_POST["num_pago"];
		$fecha=$_POST["fecha"];
		$importe_total=$_POST["importe_total"];
		$pago_total=$_POST["pago_total"];
		$subtotal=$_POST["subtotal"];
		$iva=$_POST["iva"];
		$kwh_total=$_POST["kwh_total"];
		$coment=$_POST["coment"];
		$result="ok";


		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/SFV/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		$saldo=(($importe_total)-($pago_total));
		$data = array('pago_sfv_id_pago_sfv' => $id_pago_sfv,
					  'lista_pago_sfv_num_pago' => $num_pago,
					  'lista_pago_sfv_fecha' => $fecha,
					  'lista_pago_sfv_sub_total' => $subtotal,
					  'lista_pago_sfv_iva' => $iva,
					  'lista_pago_sfv_total' => $pago_total,
					  'lista_pago_sfv_saldo' => $saldo,
				      'lista_pago_sfv_kwh_factu' => $kwh_total,
					  'lista_pago_sfv_coment' => $coment);

		$id_lista_pago_sfv=$this->Iluminacion_model->AddPay_SFV($data);


		$suma_pagos=$this->Iluminacion_model->Get_Total_Pagos_SFV($id_pago_sfv); //total_pagos

		$fecha_pago=$this->Iluminacion_model->Get_last_pago_SFV($id_pago_sfv);//última fecha de pago
		$resto=(($importe_total)-($suma_pagos->total_pagos));

		if($resto<=0){
			$estado="Pagado";
		}else{
			$estado="Activo";
		}


		$data2 = array('pago_sfv_fecha_ult_pago' => $fecha_pago->lista_pago_sfv_fecha,
						'pago_sfv_saldo' => $resto,
						'pago_sfv_estado' => $estado,
						'pago_sfv_pagado' => $suma_pagos->total_pagos);


		$update=$this->Iluminacion_model->Update_SFV($data2,$id_pago_sfv);
		$url_imagen='Resources/SFV/Iluminacion/SFV_Pago_'.$id_lista_pago_sfv.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_lista_pago_sfv!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

				$data = array('lista_pago_sfv_url_comprobante' => $url_imagen);
				$this->Iluminacion_model->UpdatePay_SFV($data,$id_lista_pago_sfv);
				$result = "ok-ok";
			}else{
				$result="error-ok";
			}
		}else{
			$result="ok";
		}
		echo $result;
	}

	public function SFV_Pay_List(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_pago_sfv=$_POST["id_pago_sfv"];
		$data = array('sfv_lista_pago' => $this->Iluminacion_model->Get_SFV_Pay_List($id_pago_sfv),
					  'sfv_info' => $this->Iluminacion_model->Get_SFV_info($id_pago_sfv));
		$this->load->view('Iluminacion/SFVPay_List',$data);
	}

	public function Edit_Pay_SFV(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_pago_sfv=$_POST["id_pago_sfv"];
		$id_lista_pago_sfv=$_POST["id_lista_pago_sfv"];
		$importe_total=$_POST["importe_total"];
		$fecha=$_POST["fecha"];
		$pago_total=$_POST["pago_total"];
		$subtotal=$_POST["subtotal"];
		$iva=$_POST["iva"];
		$kwh_total=$_POST["kwh_total"];
		$coment=$_POST["coment"];
		$result="ok";


		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/SFV/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		$saldo=($importe_total-$pago_total);

		$data = array('lista_pago_sfv_fecha' => $fecha,
					  'lista_pago_sfv_sub_total' => $subtotal,
					  'lista_pago_sfv_iva' => $iva,
					  'lista_pago_sfv_total' => $pago_total,
				      'lista_pago_sfv_kwh_factu' => $kwh_total,
					  'lista_pago_sfv_coment' => $coment);

		$this->Iluminacion_model->UpdatePay_SFV($data,$id_lista_pago_sfv);


		$suma_pagos=$this->Iluminacion_model->Get_Total_Pagos_SFV($id_pago_sfv); //total_pagos

		$fecha_pago=$this->Iluminacion_model->Get_last_pago_SFV($id_pago_sfv);//última fecha de pago
		$resto=($importe_total-($suma_pagos->total_pagos));

		if($resto<=0){
			$estado="Pagado";
		}else{
			$estado="Activo";
		}


		$data2 = array('pago_sfv_fecha_ult_pago' => $fecha_pago->lista_pago_sfv_fecha,
						'pago_sfv_saldo' => $resto,
						'pago_sfv_estado' => $estado,
						'pago_sfv_pagado' => $suma_pagos->total_pagos);


		$update=$this->Iluminacion_model->Update_SFV($data2,$id_pago_sfv);
		$url_imagen='Resources/SFV/Iluminacion/SFV_Pago_'.$id_lista_pago_sfv.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_lista_pago_sfv!=""){
  			// Upload file
  			foreach ($image_ext as $ext) {
  				$url_imagen2='Resources/SFV/Iluminacion/SFV_Pago_'.$id_lista_pago_sfv.'.'.$ext;
  				if (file_exists($url_imagen2)){
  					unlink($url_imagen2);
  				}  				
  			}		

			if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

				$data = array('lista_pago_sfv_url_comprobante' => $url_imagen);
				$this->Iluminacion_model->UpdatePay_SFV($data,$id_lista_pago_sfv);
				$result = "ok-ok";
			}else{
				$result="error-ok";
			}
		}else{
			$result="ok";
		}
		echo $result;
	}

	public function DeletePay_SFV(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_lista_pago_sfv=$_POST["id_lista_pago_sfv"];
		$id_pago_sfv=$_POST["id_pago_sfv"];
		$importe_total=$_POST["importe_total"];

		$url_comprobante=$this->Iluminacion_model->Get_url_comprobante_SFV($id_lista_pago_sfv);
		$result="";
		if($this->Iluminacion_model->Delete_Pay_sfv($id_lista_pago_sfv)){
			if (file_exists($url_comprobante->lista_pago_sfv_url_comprobante)){
				$result="si existe archivo";
  					unlink($url_comprobante->lista_pago_sfv_url_comprobante);
  				}
  		$suma_pagos=$this->Iluminacion_model->Get_Total_Pagos_SFV($id_pago_sfv); //total_pagos

		$fecha_pago=$this->Iluminacion_model->Get_last_pago_SFV($id_pago_sfv);//última fecha de pago
		$resto=($importe_total-($suma_pagos->total_pagos));

		if($resto<=0){
			$estado="Pagado";
		}else{
			$estado="Activo";
		}
		$data2 = array('pago_sfv_fecha_ult_pago' => $fecha_pago->lista_pago_sfv_fecha,
						'pago_sfv_saldo' => $resto,
						'pago_sfv_estado' => $estado,
						'pago_sfv_pagado' => $suma_pagos->total_pagos);
		$update=$this->Iluminacion_model->Update_SFV($data2,$id_pago_sfv);
			echo $url_comprobante->lista_pago_sfv_url_comprobante;
		}else{
			echo false;
		}
	}

	public function Cotizaciones(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('catalogo_cliente'=>$this->Iluminacion_model->GetAll_Customer($idcomp->id_empresa),
					  'inventario_productos'=>$this->Iluminacion_model->GetInventorie_Products($idcomp->id_empresa),
					  'lista_cotizaciones'=>$this->Iluminacion_model->GetCotizaciones_List($idcomp->id_empresa));
		$this->load->view('Iluminacion/Cotizaciones_List',$data);
	}

		public function New_Cotizacion(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('cotizacion_id_empresa' => $idcomp->id_empresa ,
					  'cotizacion_folio' => $this->input->post('new_folio'),
					  'cotizacion_fecha'=> $this->input->post('new_fecha_elabora'),
					  'cotizacion_id_cliente' =>  $this->input->post('new_cliente'),
					  'cotizacion_obra' => $this->input->post('new_obra'),
					  'cotizacion_tiempo_entrega' =>$this->input->post('new_tiem_entrega'),
					  'cotizacion_vigencia' => $this->input->post('new_vigencia'),
					  'cotizacion_elabora' => $this->input->post('new_elabora'),
					  'cotizacion_estado' => $this->input->post('new_estado'),
					  'cotizacion_empresa' => $this->input->post('new_empresa'),
					  'cotizacion_licitacion' => $this->input->post('new_licitacion'));
		if($this->Iluminacion_model->New_Cotizacion($data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function Update_Cotizacion(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('cotizacion_folio' => $this->input->post('folio'),
					  'cotizacion_fecha'=> $this->input->post('fecha_elabora'),
					  'cotizacion_id_cliente' =>  $this->input->post('cliente'),
					  'cotizacion_obra' => $this->input->post('obra'),
					  'cotizacion_tiempo_entrega' =>$this->input->post('tiem_entrega'),
					  'cotizacion_vigencia' => $this->input->post('vigencia'),
					  'cotizacion_elabora' => $this->input->post('elabora'),
					  'cotizacion_estado' => $this->input->post('estado'),
					  'cotizacion_licitacion' => $this->input->post('licitacion'),
					  'cotizacion_empresa'=> $this->input->post('empresa'));
		$id_cotizacion=$_POST["id_cotizacion"];
		if($this->Iluminacion_model->Update_Cotizacion($id_cotizacion,$data)){
			echo true;
		}else{
			echo false;
		}
	}


	public function Add_Cotizacion_Product(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$prod_id_cotizacion=$_POST["prod_id_cotizacion"];
		$data = array('lista_cotizacion_id_cotizacion' =>$this->input->post('prod_id_cotizacion') ,
					  'lista_cotizacion_id_prod_alm' =>$this->input->post('id_producto') ,
					  'lista_cotizacion_cantidad' =>$this->input->post('prod_cantidad') ,
					  'lista_cotizacion_precio_unit' =>$this->input->post('prod_precio_venta') ,
					  'lista_cotizacion_importe' =>$this->input->post('total'),
					  'lista_cotizacion_descuento'=> $this->input->post('prod_descuento'));

		if($this->Iluminacion_model->Add_Cotizacion_product($data)){

			$subtotal=$this->Iluminacion_model->Get_Importe_Cotizaciones($prod_id_cotizacion);
			$iva=round(($subtotal->importe_total*0.16),2);
			$total=($subtotal->importe_total)+$iva;
			$data2 = array('cotizacion_total' => $total ,
					  'cotizacion_iva' => $iva ,
					  'cotizacion_subtotal' => round($subtotal->importe_total,2));
			$this->Iluminacion_model->Update_Cotizacion($prod_id_cotizacion,$data2);
		}
		echo true;
	}

	public function Cotizacion_Details(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_cotizacion=$_POST["id_cotizacion"];
		$data = array('cotizacion_info'=>$this->Iluminacion_model->GetCotizacion_Info($id_cotizacion),
			 		  'inventario_productos'=>$this->Iluminacion_model->GetInventorie_Products($idcomp->id_empresa),
					  'cotizacion_products' => $this->Iluminacion_model->GetCotizacion_Products($id_cotizacion));
		$this->load->view('Iluminacion/Cotizacion_Product_List',$data);
	}

	public function Cotizacion_formato(){
		$this->load->view('Iluminacion/Cotizacion_Formato');
	}

	public function Genera_PDF_Cotizacion(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$id_cotizacion=$_POST["id_cotizacion"];
		$folio=$_POST["folio"];
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('cotizacion_info'=>$this->Iluminacion_model->GetCotizacion_Info($id_cotizacion),
			'cotizacion_products' => $this->Iluminacion_model->GetCotizacion_Products($id_cotizacion));

		$css=file_get_contents('assets/Personalized/css/PDFStyles.css');
		$mpdf = new \Mpdf\Mpdf([
			"format" => "letter",
			'pagenumPrefix' => 'Hoja ',
			'nbpgPrefix' => ' de '
		]);
		$html = $this->load->view('Iluminacion/Cotizacion_Formato',$data,true);
		$mpdf->setFooter('{PAGENO}{nbpg}');
		$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->Output('Cotizacion_'.$folio.'.pdf','I'); 
	}

	public function Edit_Cotizacion_Product(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$edit_id_lista_cotizacion=$_POST["edit_id_lista_cotizacion"];
		$id_cotizacion=$_POST["id_cotizacion"];
		$data = array('lista_cotizacion_cantidad' =>$this->input->post('prod_cantidad') ,
					  'lista_cotizacion_precio_unit' =>$this->input->post('prod_precio_venta') ,
					  'lista_cotizacion_importe' =>$this->input->post('total'),
					  'lista_cotizacion_descuento'=> $this->input->post('prod_descuento'));

		if($this->Iluminacion_model->Update_Cotizacion_product($edit_id_lista_cotizacion,$data)){

			$subtotal=$this->Iluminacion_model->Get_Importe_Cotizaciones($id_cotizacion);
			$iva=round(($subtotal->importe_total*0.16),2);
			$total=($subtotal->importe_total)+$iva;
			$data2 = array('cotizacion_total' => $total ,
					  'cotizacion_iva' => $iva ,
					  'cotizacion_subtotal' => round($subtotal->importe_total,2));
			$this->Iluminacion_model->Update_Cotizacion($id_cotizacion,$data2);
			echo true;
		}else{
			echo false ;
		}
		
	}

	public function DeleteProduct_Cotizacion(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_lista_cotizacion=$_POST["id_lista_cotizacion"];
		$id_cotizacion=$_POST["id_cotizacion"];
		if($this->Iluminacion_model->Delete_Cotizacion_product($id_lista_cotizacion)){

			$subtotal=$this->Iluminacion_model->Get_Importe_Cotizaciones($id_cotizacion);
			$iva=round(($subtotal->importe_total*0.16),2);
			$total=($subtotal->importe_total)+$iva;
			$data2 = array('cotizacion_total' => $total ,
					  'cotizacion_iva' => $iva ,
					  'cotizacion_subtotal' => round($subtotal->importe_total,2));
			$this->Iluminacion_model->Update_Cotizacion($id_cotizacion,$data2);
			echo true;
		}else{
			echo false ;
		}
	}

	public function Recibo_Entrega(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('catalogo_cliente'=>$this->Iluminacion_model->GetAll_Customer($idcomp->id_empresa),
					  'inventario_productos'=>$this->Iluminacion_model->GetInventorie_Products($idcomp->id_empresa),
					  'lista_anticipos'=>$this->Iluminacion_model->GetAll_Anticipos_activo(),
					  'lista_cotizaciones'=>$this->Iluminacion_model->GetCotizaciones_List($idcomp->id_empresa),
					  'recibo_entrega'=>$this->Iluminacion_model->Get_List_Recibo_entrega($idcomp->id_empresa));
		$this->load->view('Iluminacion/Lista_Recibos_Entrega',$data);	
	}

	public function NewReciboEntrega(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$folio=$_POST["folio"];
		$fecha_ent=$_POST["fecha_ent"];
		$origen_nuevo=$_POST["origen_nuevo"];
		$origen_anticipo=$_POST["origen_anticipo"];
		$origen_cotizacion=$_POST["origen_cotizacion"];
		$cliente=$_POST["cliente"];
		$anticipo=$_POST["anticipo"];
		$cotizacion=$_POST["cotizacion"];
		$domicilio=$_POST["domicilio"];

		if($origen_nuevo=="nuevo"){
			$id_cliente=$cliente;
			$origen=$origen_nuevo;
			$id_origen="";
		}
		if($origen_anticipo=="anticipo"){
			$id_c=$this->Iluminacion_model->Get_Id_Cliente_anticipo($anticipo);
			$id_cliente=$id_c->obra_cliente_id_obra_cliente;
			$origen=$origen_anticipo;
			$id_origen=$anticipo;
		}
		if($origen_cotizacion=="cotizacion"){
			$id_c=$this->Iluminacion_model->Get_Id_Cliente_cotizacion($cotizacion);
			$id_cliente=$id_c->cotizacion_id_cliente;
			$origen=$origen_cotizacion;
			$id_origen=$cotizacion;
		}

		$data = array('id_empresa' => $idcomp->id_empresa,
			'recibo_entrega_folio' => $folio,
			'recibo_entrega_id_cliente' => $id_cliente ,
			'recibo_entrega_domicilio' => $domicilio,
			'recibo_entrega_origen' => $origen,
			'recibo_entrega_id_origen' => $id_origen,
			'recibo_entrega_fecha' => $fecha_ent,
			'recibo_entrega_estado' => "Entrega Pendiente");
		$id_recibo_entrega=$this->Iluminacion_model->Add_Recibo_Entrega($data);
		if($id_recibo_entrega!=false){
			if($origen_anticipo=="anticipo"){
				$lista_productos=$this->Iluminacion_model->Get_Anticipo_Product_List($id_origen);
				foreach ($lista_productos->result() as $row) {
					$productos = array('lista_recibo_entrega_id_recibo_entrega' => $id_recibo_entrega,
						'lista_recibo_entrega_cantidad' => $row->prod_anticipo_cantidad,
						'producto_almacen_id_prod_alm' => $row->producto_almacen_id_prod_alm);
					$this->Iluminacion_model->Add_Product_Recibo_Entrega($productos);
					$cantidad_producto=$row->prod_anticipo_cantidad;
					$id_producto=$row->producto_almacen_id_prod_alm;
					$existencia_producto=$this->Iluminacion_model->Get_Inventorie_Product($id_producto); //Obtenemos la existencia actual del producto
					$nueva_existencia=(($existencia_producto->prod_alm_exist)-($cantidad_producto)); //Sumamos la existencia actual mas la cantidad del recibo
					$data = array('prod_alm_exist' => $nueva_existencia, );
					$this->Iluminacion_model->Return_Product_Almacen($id_producto,$data);
				}
			}
			if($origen_cotizacion=="cotizacion"){
				$lista_productos=$this->Iluminacion_model->GetCotizacion_Products($id_origen);
				foreach ($lista_productos->result() as $row) {
					$productos = array('lista_recibo_entrega_id_recibo_entrega' => $id_recibo_entrega,
						'lista_recibo_entrega_cantidad' => $row->lista_cotizacion_cantidad,
						'producto_almacen_id_prod_alm' => $row->lista_cotizacion_id_prod_alm);
					$this->Iluminacion_model->Add_Product_Recibo_Entrega($productos);
					
					$cantidad_producto=$row->lista_cotizacion_cantidad;
					$id_producto=$row->lista_cotizacion_id_prod_alm;
					$existencia_producto=$this->Iluminacion_model->Get_Inventorie_Product($id_producto); //Obtenemos la existencia actual del producto
					$nueva_existencia=(($existencia_producto->prod_alm_exist)-($cantidad_producto)); //Sumamos la existencia actual mas la cantidad del recibo
					$data = array('prod_alm_exist' => $nueva_existencia, );
					$this->Iluminacion_model->Return_Product_Almacen($id_producto,$data);
				}
			}
			echo true;
		}else{
			echo false;
		}
	}

	public function Update_ReciboEntrega(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_recibo_entrega=$_POST["id_recibo_entrega"];
		$folio=$_POST["folio"];
		$fecha_ent=$_POST["fecha_entrega"];
		$id_cliente=$_POST["id_empresa"];
		$domicilio=$_POST["domicilio"];
		$estado=$_POST["estado"];

		$data = array('recibo_entrega_folio' => $folio,
			'recibo_entrega_id_cliente' => $id_cliente ,
			'recibo_entrega_domicilio' => $domicilio,
			'recibo_entrega_fecha' => $fecha_ent,
			'recibo_entrega_estado' => $estado);
		if($this->Iluminacion_model->Update_Recibo_Entrega($id_recibo_entrega,$data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function Recibdo_Entrega_Lista_Producto(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_recibo_entrega=$_POST["id_recibo_entrega"];
		$data = array('recibo_info'=>$this->Iluminacion_model->GetRecibo_Info($id_recibo_entrega),
			 		  'inventario_productos'=>$this->Iluminacion_model->GetInventorie_Products($idcomp->id_empresa),
					  'recibo_products' => $this->Iluminacion_model->GetRecibo_Products($id_recibo_entrega));
		$this->load->view('Iluminacion/Recibo_Product_List',$data);
	}

	public function DeleteProduct_Recibo_Entrega(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_lista_recibo_entrega=$_POST["id_lista_recibo_entrega"];
		$id_recibo_entrega=$_POST["id_recibo_entrega"];
		$cantidad=$_POST["cantidad"];
		$id_producto=$_POST["id_producto"];

		if($this->Iluminacion_model->Delete_Product_Recibo($id_lista_recibo_entrega)){ //Eliminarmos el producto del listado del recibio de entrega
			$prod_inventario=$this->Iluminacion_model->Get_Inventorie_Product($id_producto);
			$nueva_existencia=(($prod_inventario->prod_alm_exist)+($cantidad));
			$data = array('prod_alm_exist' => $nueva_existencia, );
			$this->Iluminacion_model->Return_Product_Almacen($id_producto,$data); //Regresamos al inventario la cantidad de Productos
			echo true;
		}else{
			echo false;
		}

	}

	public function DeleteRecibo_Entrega(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_recibo_entrega=$_POST["id_recibo_entrega"];

		$lista_productos=$this->Iluminacion_model->GetRecibo_Products($id_recibo_entrega);
		foreach ($lista_productos->result() as $row) {
			$cantidad_producto=$row->lista_recibo_entrega_cantidad; //Obtenemos la cantidad de producto en el recibo de entrega
			$id_producto=$row->producto_almacen_id_prod_alm; //Obtenemos el id del producto
			$existencia_producto=$this->Iluminacion_model->Get_Inventorie_Product($id_producto); //Obtenemos la existencia actual del producto
			$nueva_existencia=(($existencia_producto->prod_alm_exist)+($cantidad_producto)); //Sumamos la existencia actual mas la cantidad del recibo
			$data = array('prod_alm_exist' => $nueva_existencia, );
			$this->Iluminacion_model->Return_Product_Almacen($id_producto,$data); //Regresamos al inventario la cantidad de Productos
		}

		//Eliminamos la lista de productos del Recibo de Entrega
		$this->Iluminacion_model->Delete_Lista_Recibo_Entrega($id_recibo_entrega);
		//Eliminamos el Recibo de Entrega
		$this->Iluminacion_model->Delete_Recibo_Entrega($id_recibo_entrega);

		echo true;
	}

	public function Add_Product_Recibo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_recibo_entrega=$_POST["id_recibo_entrega"];
		$id_producto=$_POST["id_producto"];
		$prod_cantidad=$_POST["prod_cantidad"];

		$productos = array('lista_recibo_entrega_id_recibo_entrega' => $id_recibo_entrega,
			'lista_recibo_entrega_cantidad' => $prod_cantidad,
			'producto_almacen_id_prod_alm' => $id_producto);
		if($this->Iluminacion_model->Add_Product_Recibo_Entrega($productos)){
			$cantidad_producto=$prod_cantidad;
			$existencia_producto=$this->Iluminacion_model->Get_Inventorie_Product($id_producto); //Obtenemos la existencia actual del producto
			$nueva_existencia=(($existencia_producto->prod_alm_exist)-($cantidad_producto)); //Sumamos la existencia actual mas la cantidad del recibo
			$data2 = array('prod_alm_exist' => $nueva_existencia, );
			$this->Iluminacion_model->Return_Product_Almacen($id_producto,$data2);
			echo true;
			}else{
				echo false;
			}
		}

	public function UpdateProduct_Recibo_Entrega(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_lista_recibo_entrega=$_POST["id_lista_recibo_entrega"];
		$cantidad=$_POST["cantidad"];
		$cantidad_anterior=$_POST["cantidad_anterior"];
		$id_producto=$_POST["id_producto"];

		$data = array('lista_recibo_entrega_cantidad' => $cantidad );
		$this->Iluminacion_model->Update_Product_Recibo($id_lista_recibo_entrega,$data);

		$existencia_producto=$this->Iluminacion_model->Get_Inventorie_Product($id_producto); //Obtenemos la existencia actual del producto
		if($cantidad_anterior>$cantidad){
			$cantidad_producto=($cantidad_anterior-$cantidad);
			$nueva_existencia=(($existencia_producto->prod_alm_exist)+($cantidad_producto)); //Sumamos la existencia actual mas la cantidad del recibo
		}else{
			$cantidad_producto=($cantidad-$cantidad_anterior);
			$nueva_existencia=(($existencia_producto->prod_alm_exist)-($cantidad_producto)); //Sumamos la existencia actual mas la cantidad del recibo
		}	
		
		$data2 = array('prod_alm_exist' => $nueva_existencia, );
		$this->Iluminacion_model->Return_Product_Almacen($id_producto,$data2); //Regresamos al inventario la cantidad de Productos
	
		echo true;
	}

	public function Genera_PDF_Recibo_Entrega(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$id_lista_recibo_entrega=$_POST["id_lista_recibo_entrega"];
		$folio=$_POST["folio"];
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$data = array('recibo_info'=>$this->Iluminacion_model->GetRecibo_Info($id_lista_recibo_entrega),
			'recibo_products' => $this->Iluminacion_model->GetRecibo_Products($id_lista_recibo_entrega));

		$css=file_get_contents('assets/Personalized/css/PDFStyles_Recibo_Entrega.css');
		$mpdf = new \Mpdf\Mpdf([
			"format" => "letter",
			'pagenumPrefix' => 'Hoja ',
			'nbpgPrefix' => ' de '
		]);
		$html = $this->load->view('Iluminacion/Recibo_Entrega_Formato',$data,true);
		$mpdf->setFooter('{PAGENO}{nbpg}');
		$mpdf->WriteHTML($css,\Mpdf\HTMLParserMode::HEADER_CSS);
		$mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);
		$mpdf->Output('Recibo_Entrega_'.$folio.'.pdf','I'); 
	}

	public function Flujo_Efectivo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		//$data = array('' => , );
		$this->load->view('Iluminacion/Report_Flujo_Efectivo');
	}

public function Reporte_flujo_efectivo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$anio=$_POST["anio"];
		$mes=$_POST["mes"];
		switch ($mes) {
			case '01':
				$mes_letra="ENERO";
				break;
			case '02':
				$mes_letra="FEBRERO";
				break;
			case '03':
				$mes_letra="MARZO";
				break;
			case '04':
				$mes_letra="ABRIL";
				break;
			case '05':
				$mes_letra="MAYO";
				break;
			case '06':
				$mes_letra="JUNIO";
				break;
			case '07':
				$mes_letra="JULIO";
				break;
			case '08':
				$mes_letra="AGOSTO";
				break;
			case '09':
				$mes_letra="SEPTIEMBRE";
				break;
			case '10':
				$mes_letra="OCTUBRE";
				break;
			case '11':
				$mes_letra="NOVIEMBRE";
				break;
			case '12':
				$mes_letra="DICIEMBRE";
				break;			
			default:
				
				break;
		}
		if($mes==01){
			$mes_ant=12;
			$anio_ant=$anio-1;
		}else{
			$mes_ant=$mes-1;
			$anio_ant=$anio;
		}
		switch ($mes_ant) {
			case '01':
				$mes_ant_letra="ENERO";
				break;
			case '02':
				$mes_ant_letra="FEBRERO";
				break;
			case '03':
				$mes_ant_letra="MARZO";
				break;
			case '04':
				$mes_ant_letra="ABRIL";
				break;
			case '05':
				$mes_ant_letra="MAYO";
				break;
			case '06':
				$mes_ant_letra="JUNIO";
				break;
			case '07':
				$mes_ant_letra="JULIO";
				break;
			case '08':
				$mes_ant_letra="AGOSTO";
				break;
			case '09':
				$mes_ant_letra="SEPTIEMBRE";
				break;
			case '10':
				$mes_ant_letra="OCTUBRE";
				break;
			case '11':
				$mes_ant_letra="NOVIEMBRE";
				break;
			case '12':
				$mes_ant_letra="DICIEMBRE";
				break;			
			default:
				# code...
				break;
		}

		if(is_null($this->Iluminacion_model->Verifica_Flujo($idcompany->id_empresa,$anio,$mes_letra))){
			$saldo_ant=$this->Iluminacion_model->Get_sal_ban_ant($idcompany->id_empresa,$anio_ant,$mes_ant_letra);//Si no existe un registro de flujo de efectivo para el mes actual, entonces busca el saldo en banco del mes anterior
			if(isset($saldo_ant->flujo_efectivo_saldo_fin)){
				$saldo_anterior=$saldo_ant->flujo_efectivo_saldo_fin;
			}else{
				$saldo_anterior=0.00;
			}				
				$tipo_saldo="anterior";
			
		}else{
			$saldo_guardado=$this->Iluminacion_model->Get_sal_ban_guardado($idcompany->id_empresa,$anio,$mes_letra);//si ya existe un registro del mes actual, entonces toma el último saldo de banco guardado en el registro del flujo de efectivo
			//$saldo_ant=0.99;
			$tipo_saldo="guardado";
		}	
		

		if($tipo_saldo=="anterior"){
			$data = array('ingresos_venta_mov' => $this->Iluminacion_model->Get_Ingresos_Pagos($idcompany->id_empresa,$anio,$mes),
					      'sal_ban_ant'=>$saldo_anterior,
					      'ingresos_anticipos' => $this->Iluminacion_model->Get_Ingresos_Anticipos($anio,$mes),
					      'ingresos_sfv' => $this->Iluminacion_model->Get_Ingresos_SFV($idcompany->id_empresa,$anio,$mes),
					      'egresos_caja_chica' => $this->Iluminacion_model->Get_Egresos_Caja_Chica($idcompany->id_empresa,$anio,$mes),
					      'egresos_gasto_venta' => $this->Iluminacion_model->Get_Egresos_Gasto_Venta($idcompany->id_empresa,$anio,$mes),
					      'egresos_viatico' => $this->Iluminacion_model->Get_Egresos_Gasto_Viatico($idcompany->id_empresa,$anio,$mes),
					      'egresos_otros_gastos' => $this->Iluminacion_model->Get_Egregos_Otros_Gastos($idcompany->id_empresa,$anio,$mes),
					      'mes'=>$mes_letra,
					  	   'anio'=>$anio );
		}else{
			$data = array('ingresos_venta_mov' => $this->Iluminacion_model->Get_Ingresos_Pagos($idcompany->id_empresa,$anio,$mes),
					  	   'sal_ban_ant'=> $saldo_guardado->flujo_efectivo_saldo_ini,
					  	   'ingresos_anticipos' => $this->Iluminacion_model->Get_Ingresos_Anticipos($anio,$mes),
					  	   'ingresos_sfv' => $this->Iluminacion_model->Get_Ingresos_SFV($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_caja_chica' => $this->Iluminacion_model->Get_Egresos_Caja_Chica($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_gasto_venta' => $this->Iluminacion_model->Get_Egresos_Gasto_Venta($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_viatico' => $this->Iluminacion_model->Get_Egresos_Gasto_Viatico($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_otros_gastos' => $this->Iluminacion_model->Get_Egregos_Otros_Gastos($idcompany->id_empresa,$anio,$mes),
					  	   'mes'=>$mes_letra,
					  	   'anio'=>$anio );
		}	
		//var_dump($data);
		$this->load->view('Iluminacion/Tabla_flujo_efectivo', $data);
	}


	public function GetListCostOfSale(){
		$this->load->model('Iluminacion_model');
		$table = 'gasto_venta';
		$id = 'id_gasto_venta';
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data=array('cost_sale'=>$this->Iluminacion_model->GetAllCostOfSale($idcompany->id_empresa),
					'works'=>$this->Iluminacion_model->GetAllWorks_Client($idcompany->id_empresa),
					'max'=>$this->Iluminacion_model->IDMAX($table, $id));
		if($data['works']){
			$this->load->view('Iluminacion/CostOfSale-List', $data);
		}else{
			$this->load->view('Iluminacion/CostOfSale-Error',);
		}
		//var_dump($data['works']);
	}


	public function AddCostOfSale(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_gasto_venta=$_POST['idCost'];
		$monto=$_POST["addAmount"];
		$monto=str_replace(',', '', $monto);

		if (isset($_FILES['addBill']['name'])) {
			$filename = $_FILES['addBill']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/CostOfSale/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		$table = 'gasto_venta';
		$data = array('id_gasto_venta' => $id_gasto_venta,
						'obra_cliente_id_obra_cliente'=> $this->input->post('addClientName'),
						'obra_cliente_empresa_id_empresa'=> $idcomp->id_empresa,
						'gasto_venta_fecha'=> $this->input->post('addEmitionDate'),
						'gasto_venta_factura'=> $this->input->post('addFolio'),
						'gasto_venta_monto'=> $monto,
						'gasto_venta_concepto' => $this->input->post('addConcept'),
						'gasto_venta_observacion' => $this->input->post('addComment'),
						'gasto_venta_estado_pago' => $this->input->post('addStatus'),
						'gasto_venta_fecha_pago' => $this->input->post('addDate'));

		$this->Iluminacion_model->Insert($table, $data);

		$url_imagen='Resources/Bills/CostOfSale/Iluminacion/Cost_Sale_'.$id_gasto_venta.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_gasto_venta!=""&&$filename!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['addBill']['tmp_name'],$url_imagen)){
				$data2 = array('gasto_venta_url_factura' => $url_imagen);
				$this->Iluminacion_model->UpdateCostSale($id_gasto_venta, $data2);
			}
    	}
    	var_dump($id_gasto_venta);
		echo true;		
	}

	public function EditCostOfSale(){
		$this->load->model('Iluminacion_model');
       	$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_gasto_venta=$_POST['idE'];
		$monto=$_POST["amountE"];
		$monto=str_replace(',', '', $monto);

		if (isset($_FILES['billE']['name'])) {
			$filename = $_FILES['billE']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/CostOfSale/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas



		$data = array('obra_cliente_id_obra_cliente'=> $this->input->post('clientNameE'),
						'obra_cliente_empresa_id_empresa'=> $idcomp->id_empresa,
						'gasto_venta_fecha'=> $this->input->post('emitionDateE'),
						'gasto_venta_factura'=> $this->input->post('folioE'),
						'gasto_venta_monto'=> $monto,
						'gasto_venta_concepto' => $this->input->post('conceptE'),
						'gasto_venta_observacion' => $this->input->post('commentE'),
						'gasto_venta_estado_pago' => $this->input->post('statusE'),
						'gasto_venta_fecha_pago' => $this->input->post('dateE'));
		$this->Iluminacion_model->UpdateCostSale($id_gasto_venta, $data);

		$url_imagen='Resources/Bills/CostOfSale/Iluminacion/Cost_Sale_'.$id_gasto_venta.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_gasto_venta!=""&&$filename!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['billE']['tmp_name'],$url_imagen)){
				$data2 = array('gasto_venta_url_factura' => $url_imagen);
				$this->Iluminacion_model->UpdateCostSale($id_gasto_venta, $data2);
			}
    	}

    	echo true;
				//var_dump($data);
	}

	public function PettyCash(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$table = 'lista_caja_chica';
		$id = 'id_lista_caja_chica';
		$data=array('cash' => $this->Iluminacion_model->GetAllReportsOfPettyCash($idcompany->id_empresa),
					'max'=>$this->Iluminacion_model->IDMAX($table, $id));
		$this->load->view('Iluminacion/PettyCash', $data);
	}

	public function PettyCashDetails(){
		$this->load->model('Iluminacion_model');
		$id_caja_chica=$_POST['id_caja_chica'];
		$data2=$this->Iluminacion_model->GetPettyCashById($id_caja_chica);
		$table = 'lista_caja_chica';
		$id = 'id_lista_caja_chica';
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data1 = $this->Iluminacion_model->ExpenceSum($id_caja_chica);
		$data=array('cash'=>$data2,
					'detail' =>$this->Iluminacion_model->GetDetailsOfPettyCash($id_caja_chica),
					'works'=>$this->Iluminacion_model->GetAllWorks_Client($idcompany->id_empresa),
					'max'=>$this->Iluminacion_model->IDMAX($table, $id),
					'total'=> $data1);
		$this->load->view('Iluminacion/PettyCash-Details', $data);
	}

	public function AddReportPettyCash(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$radio=$_POST["exampleRadios"];
		$ingreso=$this->input->post('moneyI');
		$egreso=$this->input->post('moneyEI');
		$ingreso=str_replace(',', '', $ingreso);//Eliminamos las comas de la cantidad ingresada
		$egreso=str_replace(',', '', $egreso);//Eliminamos las comas de la cantidad ingresada
		//var_dump($radio);

		if($radio=="option1"){
			$reposicion=0;
			$gasto=$egreso;
		}else{
			$reposicion=$ingreso;
			$gasto=0;
		}

		if (isset($_FILES['upBillI']['name'])) {
			$filename = $_FILES['upBillI']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/PettyCash/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		//$saldo_caja=  Verificar si se obtendrá un saldo de caja chica

		$table = 'lista_caja_chica';
		$data = array('empresa_id_empresa'=> $idcomp->id_empresa,
						'lista_caja_chica_fecha'=> $this->input->post('dateI'), //fecha de emisión
						'lista_caja_chica_concepto'=> $this->input->post('conceptI'),
						'lista_caja_chica_reposicion'=> $reposicion,
						'lista_caja_chica_gasto'=> $gasto,
						'lista_caja_chica_factura' => $this->input->post('folioBillI'),
						'lista_caja_chica_fecha_factura' => $this->input->post('dateBillI')/*,
						'lista_caja_chica_saldo' => $saldo_caja*/);
		$id_caja_chica=$this->Iluminacion_model->Insert($table, $data);


		if(!is_null($id_caja_chica)){
			if(in_array($file_extension,$image_ext)&&$id_caja_chica!=""&&$filename!=""){
				$url_imagen='Resources/Bills/PettyCash/Iluminacion/caja_chica_'.$id_caja_chica.'.'.$file_extension;
  					// Upload file
				if(move_uploaded_file($_FILES['upBillI']['tmp_name'],$url_imagen)){
					$data2 = array('lista_caja_chica_url_factura' => $url_imagen);//nombre del url
					$this->Iluminacion_model->Update_Caja_Chica($id_caja_chica, $data2);
					echo $radio;
				}				
        	}else{
        	echo false;
        	}
		}else{
			echo false;
		}
	}

public function UpdateReportPettyCash(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$edit_id_lista_caja_chica=$_POST["edit_id_lista_caja_chica"];
     	$edit_dateI=$_POST["edit_dateI"];
     	$edit_conceptI=$_POST["edit_conceptI"];
     	$tipo=$_POST["edit_radio"];
     	$edit_money=$_POST["edit_money"];
     	$edit_money=str_replace(',', '', $edit_money);//Eliminamos las comas de la cantidad ingresada
     	$edit_folioBillI=$_POST["edit_folioBillI"];
     	$edit_dateBillI=$_POST["edit_dateBillI"];
     	if($tipo=="option2"){//Verificamos si el radio seleccionado es el de la opción 2 (Ingreso)
        	$monto_ingreso=$edit_money;
        	$monto_egreso=0;
     	}else{
       		$monto_ingreso=0;
        	$monto_egreso=$edit_money;
     	}


     	if (isset($_FILES['edit_upBillI']['name'])) {
			$filename = $_FILES['edit_upBillI']['name'];
		} else {
			$filename="";
		}
		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/PettyCash/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas
		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		if(in_array($file_extension,$image_ext)&&$edit_id_lista_caja_chica!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
			$url_imagen='Resources/Bills/PettyCash/Iluminacion/caja_chica_'.$edit_id_lista_caja_chica.'.'.$file_extension;
  				// Upload file
			if(move_uploaded_file($_FILES['edit_upBillI']['tmp_name'],$url_imagen)){
				$data2 = array('lista_caja_chica_url_factura' => $url_imagen);//nombre del url
				$this->Iluminacion_model->Update_Caja_Chica($edit_id_lista_caja_chica, $data2);
			}				
        }

		$data = array('empresa_id_empresa'=> $idcomp->id_empresa,
						'lista_caja_chica_fecha'=> $edit_dateI, //fecha de emisión
						'lista_caja_chica_concepto'=> $edit_conceptI,
						'lista_caja_chica_reposicion'=> $monto_ingreso,
						'lista_caja_chica_gasto'=> $monto_egreso,
						'lista_caja_chica_factura' => $edit_folioBillI,
						'lista_caja_chica_fecha_factura' => $edit_dateBillI);
     $this->Iluminacion_model->Update_Caja_Chica($edit_id_lista_caja_chica, $data);


     echo true;  
	}



	public function OtherExpens(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data=array('expens'=>$this->Iluminacion_model->GetOthersExpens($idcompany->id_empresa));
		$this->load->view('Iluminacion/OtherCost', $data);
	}

	public function AddNewExpend(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$monto=$_POST["addAmount"];
		$monto=str_replace(',', '', $monto); 


		if (isset($_FILES['addBill']['name'])) {
			$filename = $_FILES['addBill']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/Expends/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas
		$table = 'otros_gastos';
		$data = array('empresa_id_empresa'=> $idcompany->id_empresa,
						'fecha_emision'=> $this->input->post('addEmitionDate'),
						'concepto'=> $this->input->post('addConcept'),
						'saldo'=> $monto,
						'comentario'=> $this->input->post('addComment'),
						'folio' => $this->input->post('addFolio'),
						'fecha_pago_factura' => $this->input->post('addDate'));

		$id_otros_gastos=$this->Iluminacion_model->Insert($table, $data);
		$url_imagen='Resources/Bills/Expends/Iluminacion/otros_gastos_'.$id_otros_gastos.'.'.$file_extension;
	

		if(in_array($file_extension,$image_ext)&&$id_otros_gastos!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
  				// Upload file
			if(move_uploaded_file($_FILES['addBill']['tmp_name'],$url_imagen)){
				$data2 = array('factura' => $url_imagen);//nombre del url
				$this->Iluminacion_model->UpdateExpendInfo($id_otros_gastos, $data2);
			}				
        }
        echo true;		
	}

	public function UpdateExpend(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcomp=$this->Iluminacion_model->IdCompany($company);
		$id_otros_gastos=$_POST["idE"];

		$monto=$_POST["editAmount"];
		$monto=str_replace(',', '', $monto); 


		if (isset($_FILES['editBill']['name'])) {
			$filename = $_FILES['editBill']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/Expends/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas
		$url_imagen='Resources/Bills/Expends/Iluminacion/otros_gastos_'.$id_otros_gastos.'.'.$file_extension;

		$data = array('empresa_id_empresa'=> $idcomp->id_empresa,
						'fecha_emision'=> $this->input->post('editEmitionDate'),
						'concepto'=> $this->input->post('editConcept'),
						'saldo'=> $monto,
						'comentario'=> $this->input->post('editComment'),
						'folio' => $this->input->post('editFolio'),
						'fecha_pago_factura' => $this->input->post('editDate'));
		        $this->Iluminacion_model->UpdateExpendInfo($id_otros_gastos, $data);

		if(in_array($file_extension,$image_ext)&&$id_otros_gastos!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
  				// Upload file
			if(move_uploaded_file($_FILES['editBill']['tmp_name'],$url_imagen)){
				$data2 = array('factura' => $url_imagen );
				$this->Iluminacion_model->UpdateExpendInfo($id_otros_gastos, $data2);
			}				
        }


        echo true;


	}

	public function GetAllViatics(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data = array('report_viatics' => $this->Iluminacion_model->GetAllViaticsReports($idcompany->id_empresa),
						'works'=>$this->Iluminacion_model->GetAllWorks_Client($idcompany->id_empresa));
		if($data['works']){
			$this->load->view('Iluminacion/ViaticList',$data);
		}else{
			$this->load->view('Iluminacion/ViaticList-Error',);
		}
	//	var_dump($data['woks']);
		
	}

	public function DeatailsOfViatic(){
		$this->load->model('Iluminacion_model');
		$id_viatico=$_POST['id_viatico'];
		$data2=$this->Iluminacion_model->GetViaticsById($id_viatico);
		$table = 'lista_viatico';
		$id = 'id_lista_viatico';
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$data1 = $this->Iluminacion_model->ViaticPaymentsSum($id_viatico);
		$data=array('viatico'=>$data2,
					'detail' =>$this->Iluminacion_model->GetDetailsOfViatics($id_viatico),
					'works'=>$this->Iluminacion_model->GetAllWorks_Client($idcompany->id_empresa),
					'max'=>$this->Iluminacion_model->IDMAX($table, $id),
					'total'=> $data1);
		$this->load->view('Iluminacion/DetailsViaticReport', $data);
	}

	public function AddViaticReport(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$totalDays=$_POST["totalDays"];
		$totalDays++;

		$table = 'viaticos';
		$data = array('obra_cliente_id_obra_cliente' => $this->input->post('addClientName'),
						'obra_cliente_empresa_id_empresa' => $idcompany->id_empresa,
						'viaticos_fecha' => $this->input->post('addEmitionDate'),
						'viaticos_total_dias' => $totalDays,
						'viaticos_fecha_ini' => $this->input->post('addStartDate'),
						'viaticos_fecha_fin' => $this->input->post('AddDateEnd'),
						'viaticos_total' => $this->input->post('addMoney'));
		if ($this->Iluminacion_model->Insert($table, $data)) {
        	echo true;
        }else{
        	echo false;
        }
	}

	public function UpdateViaticReport(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$id_viatico=$_POST["edit_idreport"];

		$date1 = new DateTime($_POST["edit_addStartDate"]); 
		$date2 =  new DateTime($_POST["edit_AddDateEnd"]);

		$totalDays = $date1->diff($date2);
		$dias=$totalDays->days;
		$dias++;
				var_dump($dias);
		$table = 'viaticos';
		$data = array('obra_cliente_id_obra_cliente' => $this->input->post('edit_addClientName'),
						'obra_cliente_empresa_id_empresa' => $idcompany->id_empresa,
						'viaticos_fecha' => $this->input->post('edit_addEmitionDate'),
						'viaticos_total_dias' => $dias,
						'viaticos_fecha_ini' => $this->input->post('edit_addStartDate'),
						'viaticos_fecha_fin' => $this->input->post('edit_AddDateEnd'));

		if ($this->Iluminacion_model->Update_Viatic($id_viatico, $data)) {
        	echo true;
        }else{
        	echo false;
        }
	}

	public function AddViaticExpend(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);
		$id_viatico=$_POST["idViatic"];

		$monto=$_POST["addImport"];
		$monto=str_replace(',', '', $monto); 


		if (isset($_FILES['addEvidence']['name'])) {
			$filename = $_FILES['addEvidence']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/ViaticExpends/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas


		$table = 'lista_viatico';
		$data = array('viaticos_id_viaticos'=> $this->input->post('idViatic'),
						'lista_viatico_fecha'=> $this->input->post('addDate'),
						'empleado'=> $this->input->post('employ'),
						'lista_viatico_concepto'=> $this->input->post('addconcept'),
						'lista_viatico_importe'=> $monto,
						'lista_viatico_comprobante'=> $this->input->post('addTypeVoucher'),
						'lista_viatico_factura' => $this->input->post('idComprobante'));

		$id_lista_viatico=$this->Iluminacion_model->Insert($table, $data);

		$url_imagen='Resources/Bills/ViaticExpends/Iluminacion/viaticos_'.$id_lista_viatico.'.'.$file_extension;
	

		if(in_array($file_extension,$image_ext)&&$id_lista_viatico!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
  				// Upload file
			if(move_uploaded_file($_FILES['addEvidence']['tmp_name'],$url_imagen)){
				$data2 = array('lista_viatico_url_comprobante' => $url_imagen);//nombre del url
				$this->Iluminacion_model->UpdateViaticList($id_lista_viatico, $data2);
			}				
        }
        	//realizar la suma de los viaticos 
		$Suma_viaticos = $this->Iluminacion_model->ViaticPaymentsSum($id_viatico);      

		$datos_suma = array('viaticos_total' => $Suma_viaticos->sumPayment , ); 

		$this->Iluminacion_model->Update_Viatic($id_viatico,$datos_suma); 

		echo true;
	}

public function UpdateViaticExpend(){
	$this->load->model('Iluminacion_model');
	$company='ILUMINACION';
	$idcompany=$this->Iluminacion_model->IdCompany($company);
	$id_viatico=$_POST["edit_idViatic"];
	$id_lista_viatico=$_POST["edit_id_lista_viatico"];

	$monto=$_POST["edit_addImport"];
	$monto=str_replace(',', '', $monto); 


	if (isset($_FILES['edit_addEvidence']['name'])) {
			$filename = $_FILES['edit_addEvidence']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/ViaticExpends/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas


		$table = 'lista_viatico';
		$data = array('viaticos_id_viaticos'=> $id_viatico,
			'lista_viatico_fecha'=> $this->input->post('edit_addDate'),
			'empleado'=> $this->input->post('edit_employ'),
			'lista_viatico_concepto'=> $this->input->post('edit_addconcept'),
			'lista_viatico_importe'=> $monto,
			'lista_viatico_comprobante'=> $this->input->post('edit_addTypeVoucher'),
			'lista_viatico_factura' => $this->input->post('edit_idComprobante'));

		$this->Iluminacion_model->UpdateViaticList($id_lista_viatico, $data);

		$url_imagen='Resources/Bills/ViaticExpends/Iluminacion/viaticos_'.$id_lista_viatico.'.'.$file_extension;


		if(in_array($file_extension,$image_ext)&&$id_lista_viatico!=""&&$filename!=""){
			if (file_exists($url_imagen)){
				unlink($url_imagen);
			} 
  				// Upload file
			if(move_uploaded_file($_FILES['edit_addEvidence']['tmp_name'],$url_imagen)){
				$data2 = array('lista_viatico_url_comprobante' => $url_imagen);//nombre del url
				$this->Iluminacion_model->UpdateViaticList($id_lista_viatico, $data2);
			}				
		}
        	//realizar la suma de los viaticos 
		$Suma_viaticos = $this->Iluminacion_model->ViaticPaymentsSum($id_viatico);      

		$datos_suma = array('viaticos_total' => $Suma_viaticos->sumPayment ); 

		$this->Iluminacion_model->Update_Viatic($id_viatico,$datos_suma); 

		echo true;
	}

public function GETMAX_Folio(){
	$this->load->model('Iluminacion_model');
	$company='ILUMINACION';
	$idcompany=$this->Iluminacion_model->IdCompany($company);
	$max_folio=$this->Iluminacion_model->Get_MAXFOLIO($idcompany->id_empresa);
	//var_dump($max_folio);
	echo $max_folio->cotizacion_folio;
}

	public function Save_Reporte_flujo(){
		$this->load->model('Iluminacion_model');
		$company='ILUMINACION';
		$idcompany=$this->Iluminacion_model->IdCompany($company);

		$anio=$_POST["anio"];
		$mes=$_POST["mes"];

		if(is_null($this->Iluminacion_model->Verifica_Flujo($idcompany->id_empresa,$anio,$mes))){
			$data = array('empresa_id_empresa' =>$idcompany->id_empresa ,
						  'flujo_efectivo_mes' =>$mes ,
						  'flujo_efectivo_anio' =>$anio ,
						  'flujo_efectivo_saldo_ini' =>$this->input->post('saldo_ini') ,
						  'flujo_efectivo_saldo_fin' =>$this->input->post('saldo_fin') ,
						  'flujo_efectivo_total_ingreso' =>$this->input->post('total_depositos') ,
						  'flujo_efectivo_total_egreso' =>$this->input->post('total_retiros'),
						  'flujo_efectivo_subtotal_ingreso' => $this->input->post('subtotal_depositos'),
						  'flujo_efectivo_subtotal_egreso' => $this->input->post('subtotal_retiros'),
						  'flujo_efectivo_iva_ingreso' => $this->input->post('iva_depositos'),
						  'flujo_efectivo_iva_egreso' => $this->input->post('iva_retiros'),
						  'flujo_efectivo_neteo_iva' => $this->input->post('neto_iva'),
						  'flujo_efectivo_tipo_iva' => $this->input->post('tipo_iva'),
						  'flujo_efectivo_iva_cargo_favor' => $this->input->post('iva_cargo_favor'),
						  'flujo_efectivo_iva_retencion' => $this->input->post('iva_retencion'),
						  'flujo_efectivo_iva_total_cargo' => $this->input->post('iva_total_cargo'),
						  'flujo_efectivo_iva_favor_panterior' => $this->input->post('iva_favor_periodos_anteriores'),
						  'flujo_efectivo_iva_neto_cargo' => $this->input->post('iva_neto_cargo'));
			$result=$this->Iluminacion_model->Guarda_Flujo($data);
			echo $result;
		}else{
			$data = array('flujo_efectivo_saldo_ini' =>$this->input->post('saldo_ini') ,
						  'flujo_efectivo_saldo_fin' =>$this->input->post('saldo_fin') ,
						  'flujo_efectivo_total_ingreso' =>$this->input->post('total_depositos') ,
						  'flujo_efectivo_total_egreso' =>$this->input->post('total_retiros'),
						  'flujo_efectivo_subtotal_ingreso' => $this->input->post('subtotal_depositos'),
						  'flujo_efectivo_subtotal_egreso' => $this->input->post('subtotal_retiros'),
						  'flujo_efectivo_iva_ingreso' => $this->input->post('iva_depositos'),
						  'flujo_efectivo_iva_egreso' => $this->input->post('iva_retiros'),
						  'flujo_efectivo_neteo_iva' => $this->input->post('neto_iva'),
						  'flujo_efectivo_tipo_iva' => $this->input->post('tipo_iva'),
						  'flujo_efectivo_iva_cargo_favor' => $this->input->post('iva_cargo_favor'),
						  'flujo_efectivo_iva_retencion' => $this->input->post('iva_retencion'),
						  'flujo_efectivo_iva_total_cargo' => $this->input->post('iva_total_cargo'),
						  'flujo_efectivo_iva_favor_panterior' => $this->input->post('iva_favor_periodos_anteriores'),
						  'flujo_efectivo_iva_neto_cargo' => $this->input->post('iva_neto_cargo'));
			$this->Iluminacion_model->Update_Flujo($mes,$anio,$idcompany->id_empresa,$data);
			echo "existe";
		}


	}







#end controller
}
 