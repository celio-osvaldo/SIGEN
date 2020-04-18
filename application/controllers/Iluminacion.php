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
		$fecha_ult_pago=$this->Dasa_model->Fecha_Ult_Pago($new_id_obra);
		$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
		$actualiza=$this->Iluminacion_model->UpdatePaysCustomer($new_id_obra,$saldo);
		//var_dump($total_obra);
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

			$fecha_ult_pago=$this->Dasa_model->Fecha_Ult_Pago($id_obra->obra_cliente_id_obra_cliente);

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
		$data = array('obra_cliente_id_obra_cliente' => $this->input->post('cliente') ,
					  'anticipo_status' => $this->input->post('estado'),
					  'anticipo_fecha_finiquito'=> $this->input->post('fecha_fin'),
					  'anticipo_fecha_entrega' => $this->input->post('fecha_ent'),
					  'anticipo_coment' =>$this->input->post('coment'));
		if($this->Iluminacion_model->Update_Anticipo($data,$id_anticipo)){
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
				$this->Iluminacion_model->Actualiza_producto($id_producto,$existencia);
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
		$result="";

		$filename = $_FILES['file']['name'];//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Pagos_Anticipo/Iluminacion/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas
		$response = 0;
		$data = array('id_anticipo' => $id_anticipo,
			'pagos_anticipo_fecha' => $fecha,
			'pagos_anticipo_cantidad' => $cantidad,
			'pagos_anticipo_coment' => $coment);

		$id_pagos_anticipo=$this->Iluminacion_model->AddPay_Anticipo($data);


			$total=$this->Iluminacion_model->Get_Total_Anticipo($id_anticipo);

			$pagado=$this->Iluminacion_model->Get_Pagos($id_anticipo);
			$fecha_pago=$this->Iluminacion_model->Get_Fecha_pago($id_anticipo);
			$resto=(($total->total)-($pagado->total_pagos));
			$data2 = array('anticipo_pago' => round($pagado->total_pagos,2),
							'anticipo_resto' => $resto,
							'anticipo_fecha_deposito' => $fecha_pago->pagos_anticipo_fecha);
			$this->Iluminacion_model->Update_Anticipo($data2,$id_anticipo);
		$url_imagen='Resources/Pagos_Anticipo/Iluminacion/Anticipo_Pago_'.$id_pagos_anticipo.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_pagos_anticipo!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

				$data = array('pagos_anticipo_url_comprobante' => $url_imagen);
				$this->Iluminacion_model->Url_Pay_Anticipo($data,$id_pagos_anticipo);
				$result = "ok-ok";
			}else{
				$result="error-ok";
			}
		}
		echo $result;
	}


}
 