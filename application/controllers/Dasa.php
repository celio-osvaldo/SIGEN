<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DASA extends CI_Controller {

#views
	
	public function Index()
	{
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          	$data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          	$data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          	$data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | DASA';
			$this->load->model('Dasa_model');
 			$company='DASA';
			$idcompany=$this->Dasa_model->IdCompany($company);
 			$data['solicitudes']=$this->Dasa_model->Get_solicitudes($idcompany->id_empresa);
            $data['solicitudes_pago']=$this->Dasa_model->Get_solicitudes_pago($idcompany->id_empresa);
            $data['solicitudes_elimina_carpeta']=$this->Dasa_model->Get_solicitudes_elimina_carpeta();
            $data['solicitudes_elimina_archivo']=$this->Dasa_model->Get_solicitudes_elimina_archivo();
            $data['datos_empresa']=$this->Dasa_model->Get_datos_empresa($idcompany->id_empresa);
	   		$this->load->view('plantillas/header_dasa', $data);
			$this->load->view('DASA/Welcome');
       		$this->load->view('plantillas/footer_dasa');
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

	public function Configuracion(){
		   	$data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          	$data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          	$data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | DASA';
			$this->load->model('Dasa_model');
 			$company='DASA';
			$idcompany=$this->Dasa_model->IdCompany($company);
 			$data['solicitudes']=$this->Dasa_model->Get_solicitudes($idcompany->id_empresa);
            $data['solicitudes_pago']=$this->Dasa_model->Get_solicitudes_pago($idcompany->id_empresa);
            $data['solicitudes_elimina_carpeta']=$this->Dasa_model->Get_solicitudes_elimina_carpeta();
            $data['solicitudes_elimina_archivo']=$this->Dasa_model->Get_solicitudes_elimina_archivo();
            $data['datos_empresa']=$this->Dasa_model->Get_datos_empresa($idcompany->id_empresa);
	   		$this->load->view('plantillas/header_dasa', $data);
			$this->load->view('DASA/Configuracion',$data);
       		$this->load->view('plantillas/footer_dasa');
		//$data=array('datos_empresa'=>$this->Dasa_model->Get_datos_empresa($idcompany->id_empresa));
		//var_dump($data);
	}

	public function Edit_Datos_Emp(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);

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
		if($this->Dasa_model->Update_datos($data,$idcompany->id_empresa)){
			$result+=1;
		}
		$url_imagen='Resources/Logos/DASA_logo'.'.'.$file_extension;

			if(in_array($file_extension,$image_ext)&&$filename!=""){
  			// Upload file
				if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

					$data2 = array('empresa_logo' => $url_imagen);
					$this->Dasa_model->Update_datos($data2,$idcompany->id_empresa);
					echo true;

				}
			$result+=1;
			}
		echo $result;
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

	public function GetInventories(){
		$this->load->model('Dasa_model');
		$table = 'catalogo_producto';
		$id = 'id_catalogo_producto';
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data = array('inventories' => $this->Dasa_model->GetAllProducts($idcompany->id_empresa),
						'providers' => $this->Dasa_model->GetAll_Provider($idcompany->id_empresa),
						'measure' => $this->Dasa_model->GetAllMeasurements(),
						'max'=>$this->Dasa_model->IDMAX($table, $id));
		$this->load->view('DASA/Product_Catalog', $data);
	}

	public function CustomerProjects(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('proyectlist'=>$this->Dasa_model->GetAllCustomer_Project($idcompany->id_empresa),
					'customerlist'=>$this->Dasa_model->Get_Customer_List($idcompany->id_empresa));
		$this->load->view('DASA/Customer_Projects',$data);
	}

		public function CustomerPayments(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('customerspays'=>$this->Dasa_model->GetAllCustomer_Payments($idcompany->id_empresa));
		$this->load->view('DASA/Customer_Payments',$data);
	}

	public function Payments_List(){
		$this->load->model('Dasa_model');
		$id_obra=$_POST["id_obra"];
		$data2=$this->Dasa_model->Datos_obra($id_obra);
		$data=array('payments_list'=>$this->Dasa_model->GetPayments_List($id_obra),
					'obra'=>$data2);
		$this->load->view('DASA/Customer_Payments_List',$data);
	}

	public function OtherExpens(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('expens'=>$this->Dasa_model->GetOthersExpens($idcompany->id_empresa));
		$this->load->view('DASA/OtherCost', $data);
	}

	public function GetListCostOfSale(){
		$this->load->model('Dasa_model');
		$table = 'gasto_venta';
		$id = 'id_gasto_venta';
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('cost_sale'=>$this->Dasa_model->GetAllCostOfSale($idcompany->id_empresa),
					'woks'=>$this->Dasa_model->GetAllWorks_Client($idcompany->id_empresa),
					'max'=>$this->Dasa_model->IDMAX($table, $id));
		if($data['woks']){
			$this->load->view('DASA/CostOfSale-List', $data);
		}else{
			$this->load->view('DASA/CostOfSale-Error',);
		}
	//	var_dump($data['woks']);

	}

	public function GetAllViatics(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data = array('report_viatics' => $this->Dasa_model->GetAllViaticsReports($idcompany->id_empresa),
						'works'=>$this->Dasa_model->GetAllWorks_Client($idcompany->id_empresa));
		if($data['works']){
			$this->load->view('DASA/ViaticList',$data);
		}else{
			$this->load->view('DASA/ViaticList-Error',);
		}
	//	var_dump($data['woks']);	
	}

	public function DeatailsOfViatic(){
		$this->load->model('Dasa_model');
		$id_viatico=$_POST['id_viatico'];
		$data2=$this->Dasa_model->GetViaticsById($id_viatico);
		$table = 'lista_viatico';
		$id = 'id_lista_viatico';
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data1 = $this->Dasa_model->ViaticPaymentsSum($id_viatico);
		$data=array('viatico'=>$data2,
					'detail' =>$this->Dasa_model->GetDetailsOfViatics($id_viatico),
					'works'=>$this->Dasa_model->GetAllWorks_Client($idcompany->id_empresa),
					'max'=>$this->Dasa_model->IDMAX($table, $id),
					'total'=> $data1);
		$this->load->view('DASA/DetailsViaticReport', $data);
	}

	public function PettyCash(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$table = 'lista_caja_chica';
		$id = 'id_lista_caja_chica';
		$data=array('cash' => $this->Dasa_model->GetAllReportsOfPettyCash($idcompany->id_empresa),
					'max'=>$this->Dasa_model->IDMAX($table, $id));
		$this->load->view('DASA/PettyCash', $data);
	}

	public function Catalogo_Proveedor(){
		$this->load->model('Dasa_model');
		$company='DASA';
		//var_dump($company);
		$idcompany=$this->Dasa_model->IdCompany($company);
		//var_dump($idcompany);
		$data=array('catalogo_proveedor'=>$this->Dasa_model->GetAll_Provider($idcompany->id_empresa),
					'catalogo_giro'=>$this->Dasa_model->Get_Giros());
		$this->load->view('DASA/Cat_Provider',$data);
		//var_dump($data);
	}
	
	public function Catalogo_Cliente(){
		$this->load->model('Dasa_model');
		$company='DASA';
		//var_dump($company);
		$idcompany=$this->Dasa_model->IdCompany($company);
		//var_dump($idcompany);
		$data=array('catalogo_cliente'=>$this->Dasa_model->GetAll_Customer($idcompany->id_empresa));
		$this->load->view('DASA/Cat_Customer',$data);
		//var_dump($data);
	}

	public function InventarioProductos(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('inventario_productos'=>$this->Dasa_model->GetInventorie_Products($idcompany->id_empresa),
					'unidades_medida'=>$this->Dasa_model->GetAllMeasurements());
		//var_dump($data);
		$this->load->view('DASA/Inventario_Productos',$data);
	}


	public function InventarioOficina(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('inventario_oficina'=>$this->Dasa_model->GetInventorie_Office($idcompany->id_empresa),
					'unidades_medida'=>$this->Dasa_model->GetAllMeasurements(),
					'providers' => $this->Dasa_model->GetAll_Provider($idcompany->id_empresa));
		//var_dump($data);
		$this->load->view('DASA/Inventario_Oficina',$data);
	}

	public function FlujoEfectivo(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		//$data = array('' => , );
		$this->load->view('DASA/Report_Flujo_Efectivo');
	}



#actions

	public function AddCustomerProject(){
		$this->load->model('Dasa_model');
		$nombre=trim($_POST["nombre"]);
		$id_cliente=$_POST["id_cliente"];
		$importe=$_POST["importe"];
		$coment=trim($_POST["coment"]);
		$add_flujo=$_POST["addflujo"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
				$data=array('empresa_id_empresa' => $idcomp->id_empresa,
					'obra_cliente_nombre'=> $nombre,
					'obra_cliente_id_cliente'=>$id_cliente,
					'obra_cliente_imp_total'=>$importe,
					'obra_cliente_saldo'=>$importe,
					'obra_cliente_estado'=>1,
					'obra_cliente_comentarios'=>$coment,
					'obra_cliente_aplica_flujo' => $add_flujo);
		$result=$this->Dasa_model->AddCustomer_Project($data);
		echo $result;		
	}

	public function EditCustomerProject(){
		$this->load->model('Dasa_model');
		$act_nom=trim($_POST["act_nom"]);
		$act_cliente=$_POST["act_cliente"];
		$act_imp=$_POST["act_imp"];
		$act_estado=$_POST["act_estado"];
		$act_coment=trim($_POST["act_coment"]);
		$id=$_POST["id"];
		$act_addflujo=$_POST["act_addflujo"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$sum_pagos=$this->Dasa_model->SumPagos_Obra($id);
		if(is_null($sum_pagos->sum_pagos)){
			$suma_pagos=0;
		}else{
			$suma_pagos=$sum_pagos->sum_pagos;
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
        'obra_cliente_aplica_flujo'=> $act_addflujo);
		$result=$this->Dasa_model->Edit_CustomerProject($id,$data);
		echo $result;
	}

	public function EditCustomerProject_Admin(){
		$this->load->model('Dasa_model');
		$act_nom=trim($_POST["act_nom"]);
		$act_cliente=$_POST["act_cliente"];
		$act_imp=$_POST["act_imp"];
		$act_estado=$_POST["act_estado"];
		$act_coment=trim($_POST["act_coment"]);
		$txt_justifica=$_POST["txt_justifica"];
		$id=$_POST["id"];
		$act_addflujo=$_POST["act_addflujo"];

		$nombre_old=trim($_POST["nombre_old"]);
		$cliente_old=$_POST["cliente_old"];
		$importe_old=$_POST["importe_old"];
		$estado_old=$_POST["estado_old"];
		$coment_old=trim($_POST["coment_old"]);


		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);

		$data = array('id_obra_cliente' => $id,
		'historial_proyecto_fecha_actualizacion' => date("Y/m/d"),
        'historial_proyecto_nombre_new' => $act_nom,
        'historial_proyecto_nombre_old' => $nombre_old,
        'historial_proyecto_id_cliente_new'=>$act_cliente,
        'historial_proyecto_id_cliente_old'=>$cliente_old,
        'historial_proyecto_importe_new' => $act_imp,
        'historial_proyecto_importe_old' => $importe_old,
        'historial_proyecto_estado_new' => $act_estado,
        'historial_proyecto_estado_old' => $estado_old,
        'historial_proyecto_coment_new' => $act_coment,
        'historial_proyecto_coment_old' => $coment_old,
        'historial_proyecto_coment_justifica' => $txt_justifica,
    	'historial_proyecto_autoriza' => "1",
    	'historial_proyecto_usuario_solicita' => $this->session->userdata('id_usuario'),
    	'historial_proyecto_aplica_flujo' => $act_addflujo);

		$result=$this->Dasa_model->Add_Solicita_Update($data);
		echo $result;
	}


	public function AddProduct(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);

		if (isset($_FILES['file']['name'])) {
			$filename = $_FILES['file']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Products&Services/DASA/'.$filename;//Dirección para guardar la imagen/documento
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

		$id_producto=$this->Dasa_model->Insert($table, $data);

		$data_historial = array('id_producto' => $id_producto,
								'historial_fecha_actualizacion' => $this->input->post('dateInsert'),
								'historial_id_proveedor'=> $this->input->post('providerInsert'),
								'historial_precio_producto_precio' => $this->input->post('priceInsert'));
		$tabla_historial='historial_precio_producto';

		$this->Dasa_model->Insert($tabla_historial,$data_historial);

		$url_imagen='Resources/Products&Services/DASA/Product_Service_'.$id_producto.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_producto!=""&&$filename!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['file']['tmp_name'],$url_imagen)){

				$data2 = array('catalogo_producto_url_imagen' => $url_imagen);
				$this->Dasa_model->UpdateProduct($id_producto, $data2);
				echo true;
			}else{
				echo false;
			}
    	}
    	echo true;
    }

	public function AddCustomersPay(){
		$this->load->model('Dasa_model');
		$new_id_obra=$_POST["id_obra"];
		$new_cant_pago=$_POST["cant_pago"];
		$new_fecha=$_POST["fecha"];
		$new_coment=trim($_POST["coment"]);
		$addflujo=$_POST["addflujo"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$data = array('obra_cliente_empresa_id_empresa' => $idcomp->id_empresa,
			'venta_mov_fecha' => $new_fecha,
			'venta_mov_comentario' => $new_coment,
			'venta_mov_monto' => $new_cant_pago,
			'obra_cliente_id_obra_cliente' => $new_id_obra,
			'venta_mov_estim_estatus' => $addflujo);
		//var_dump($data);
		$result=$this->Dasa_model->AddCustomer_Pay($data);
		$sum_pagos=$this->Dasa_model->SumPagos_Obra($new_id_obra);
		$total_obra=$this->Dasa_model->Total_obra($new_id_obra);
		$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->sum_pagos);
		$fecha_ult_pago=$this->Dasa_model->Fecha_Ult_Pago($new_id_obra);
		//var_dump($fecha_ult_pago);
		$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->sum_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
		$actualiza=$this->Dasa_model->UpdatePaysCustomer($new_id_obra,$saldo);
		//var_dump($total_obra);
		echo $result;
	}

	public function AddCostOfSale(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$id_gasto_venta=$_POST['idCost'];
		$monto=$_POST["addAmount"];
		$monto=str_replace(',', '', $monto);
		$addflujo=$_POST['addflujo'];

		$iva=$_POST["add_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["add_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["add_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["add_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["add_dap"];
		$dap=str_replace(',', '', $dap);

		if (isset($_FILES['addBill']['name'])) {
			$filename = $_FILES['addBill']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/CostOfSale/DASA/'.$filename;//Dirección para guardar la imagen/documento
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
						'gasto_venta_fecha_pago' => $this->input->post('addDate'),
						'gasto_venta_aplica_flujo' => $addflujo,
						'gasto_venta_iva' => $iva,
						'gasto_venta_iva_ret' => $ret_iva,
						'gasto_venta_isr_ret' => $ret_isr,
						'gasto_venta_ieps' => $ieps,
						'gasto_venta_dap' => $dap,
						'gasto_venta_referencia'=> $this->input->post('add_ref'));

		$this->Dasa_model->Insert($table, $data);

		$url_imagen='Resources/Bills/CostOfSale/DASA/Cost_Sale_'.$id_gasto_venta.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_gasto_venta!=""&&$filename!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['addBill']['tmp_name'],$url_imagen)){
				$data2 = array('gasto_venta_url_factura' => $url_imagen);
				$this->Dasa_model->UpdateCostSale($id_gasto_venta, $data2);
			}
    	}
    	var_dump($id_gasto_venta);
		echo true;		
	}

	public function EditCostOfSale(){
		$this->load->model('Dasa_model');
       	$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$id_gasto_venta=$_POST['idE'];
		$monto=$_POST["amountE"];
		$monto=str_replace(',', '', $monto);
		$editflujo=$_POST['editflujo'];

		$iva=$_POST["edit_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["edit_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["edit_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["edit_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["edit_dap"];
		$dap=str_replace(',', '', $dap);

		if (isset($_FILES['billE']['name'])) {
			$filename = $_FILES['billE']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/CostOfSale/DASA/'.$filename;//Dirección para guardar la imagen/documento
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
						'gasto_venta_fecha_pago' => $this->input->post('dateE'),
						'gasto_venta_aplica_flujo' => $editflujo,
						'gasto_venta_iva' => $iva,
						'gasto_venta_iva_ret' => $ret_iva,
						'gasto_venta_isr_ret' => $ret_isr,
						'gasto_venta_ieps' => $ieps,
						'gasto_venta_dap' => $dap,
						'gasto_venta_referencia'=> $this->input->post('edit_ref'));
		$this->Dasa_model->UpdateCostSale($id_gasto_venta, $data);

		$url_imagen='Resources/Bills/CostOfSale/DASA/Cost_Sale_'.$id_gasto_venta.'.'.$file_extension;

		if(in_array($file_extension,$image_ext)&&$id_gasto_venta!=""&&$filename!=""){
  			// Upload file
			if(move_uploaded_file($_FILES['billE']['tmp_name'],$url_imagen)){
				$data2 = array('gasto_venta_url_factura' => $url_imagen);
				$this->Dasa_model->UpdateCostSale($id_gasto_venta, $data2);
			}
    	}

    	echo true;
				//var_dump($data);
	}

	public function UpdateExpend(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$id_otros_gastos=$_POST["idE"];
		$edit_flujo=$_POST["edit_flujo"];

		$monto=$_POST["editAmount"];
		$monto=str_replace(',', '', $monto); 

		$iva=$_POST["edit_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["edit_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["edit_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["edit_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["edit_dap"];
		$dap=str_replace(',', '', $dap);


		if (isset($_FILES['editBill']['name'])) {
			$filename = $_FILES['editBill']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/Expends/DASA/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas
		$url_imagen='Resources/Bills/Expends/DASA/otros_gastos_'.$id_otros_gastos.'.'.$file_extension;

		$data = array('empresa_id_empresa'=> $idcomp->id_empresa,
						'fecha_emision'=> $this->input->post('editEmitionDate'),
						'concepto'=> $this->input->post('editConcept'),
						'saldo'=> $monto,
						'comentario'=> $this->input->post('editComment'),
						'folio' => $this->input->post('editFolio'),
						'fecha_pago_factura' => $this->input->post('editDate'),
						'otros_gastos_aplica_flujo' => $edit_flujo,
						'otros_gastos_referencia'=>$this->input->post('edit_ref'),
						'otros_gastos_iva'=>$iva,
						'otros_gastos_iva_ret'=>$ret_iva,
						'otros_gastos_isr_ret'=>$ret_isr,
						'otros_gastos_ieps'=>$ieps,
						'otros_gastos_dap'=>$dap);
		        $this->Dasa_model->UpdateExpendInfo($id_otros_gastos, $data);

		if(in_array($file_extension,$image_ext)&&$id_otros_gastos!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
  				// Upload file
			if(move_uploaded_file($_FILES['editBill']['tmp_name'],$url_imagen)){
				$data2 = array('factura' => $url_imagen );
				$this->Dasa_model->UpdateExpendInfo($id_otros_gastos, $data2);
			}				
        }
        echo true;
	}

	public function AddReportPettyCash(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$radio=$_POST["exampleRadios"];
		$ingreso=$this->input->post('moneyI');
		$egreso=$this->input->post('moneyEI');
		$ingreso=str_replace(',', '', $ingreso);//Eliminamos las comas de la cantidad ingresada
		$egreso=str_replace(',', '', $egreso);//Eliminamos las comas de la cantidad ingresada
		$aplicaflujo=$_POST['add_flujo'];
		//var_dump($radio);
		$iva=$_POST["add_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["add_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["add_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["add_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["add_dap"];
		$dap=str_replace(',', '', $dap);

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
		$location = 'Resources/Bills/PettyCash/DASA/'.$filename;//Dirección para guardar la imagen/documento
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
						'lista_caja_chica_fecha_factura' => $this->input->post('dateBillI'),
						'lista_caja_chica_aplica_flujo' => $aplicaflujo,
						'lista_caja_chica_iva'=> $iva,
						'lista_caja_chica_iva_ret' => $ret_iva,
						'lista_caja_chica_isr_ret' => $ret_isr,
						'lista_caja_chica_ieps' => $ieps,
						'lista_caja_chica_dap' => $dap,
						'lista_caja_chica_referencia' => $this->input->post('add_ref')/*,
						'lista_caja_chica_saldo' => $saldo_caja*/);
		$id_caja_chica=$this->Dasa_model->Insert($table, $data);


		if(!is_null($id_caja_chica)){
			if(in_array($file_extension,$image_ext)&&$id_caja_chica!=""&&$filename!=""){
				$url_imagen='Resources/Bills/PettyCash/DASA/caja_chica_'.$id_caja_chica.'.'.$file_extension;
  					// Upload file
				if(move_uploaded_file($_FILES['upBillI']['tmp_name'],$url_imagen)){
					$data2 = array('lista_caja_chica_url_factura' => $url_imagen);//nombre del url
					$this->Dasa_model->Update_Caja_Chica($id_caja_chica, $data2);
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
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$edit_id_lista_caja_chica=$_POST["edit_id_lista_caja_chica"];
     	$edit_dateI=$_POST["edit_dateI"];
     	$edit_conceptI=trim($_POST["edit_conceptI"]);
     	$tipo=$_POST["edit_radio"];
     	$edit_money=$_POST["edit_money"];
     	$edit_money=str_replace(',', '', $edit_money);//Eliminamos las comas de la cantidad ingresada
     	$edit_folioBillI=$_POST["edit_folioBillI"];
     	$edit_dateBillI=$_POST["edit_dateBillI"];
     	$editflujo=$_POST["editflujo"];


     	$iva=$_POST["edit_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["edit_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["edit_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["edit_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["edit_dap"];
		$dap=str_replace(',', '', $dap);


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
		$location = 'Resources/Bills/PettyCash/DASA/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas
		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		if(in_array($file_extension,$image_ext)&&$edit_id_lista_caja_chica!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
			$url_imagen='Resources/Bills/PettyCash/DASA/caja_chica_'.$edit_id_lista_caja_chica.'.'.$file_extension;
  				// Upload file
			if(move_uploaded_file($_FILES['edit_upBillI']['tmp_name'],$url_imagen)){
				$data2 = array('lista_caja_chica_url_factura' => $url_imagen);//nombre del url
				$this->Dasa_model->Update_Caja_Chica($edit_id_lista_caja_chica, $data2);
			}				
        }

		$data = array('empresa_id_empresa'=> $idcomp->id_empresa,
						'lista_caja_chica_fecha'=> $edit_dateI, //fecha de emisión
						'lista_caja_chica_concepto'=> $edit_conceptI,
						'lista_caja_chica_reposicion'=> $monto_ingreso,
						'lista_caja_chica_gasto'=> $monto_egreso,
						'lista_caja_chica_factura' => $edit_folioBillI,
						'lista_caja_chica_fecha_factura' => $edit_dateBillI,
						'lista_caja_chica_aplica_flujo' => $editflujo,
						'lista_caja_chica_iva'=>$iva,
						'lista_caja_chica_iva_ret'=>$ret_iva,
						'lista_caja_chica_isr_ret'=>$ret_isr,
						'lista_caja_chica_ieps'=>$ieps,
						'lista_caja_chica_dap'=>$dap,
						'lista_caja_chica_referencia'=>$this->input->post('edit_ref'));
     $this->Dasa_model->Update_Caja_Chica($edit_id_lista_caja_chica, $data);


     echo true;  
	}

	public function EditCustomerPay(){
		$id_movimiento=$_POST["id"];
		$this->load->model('Dasa_model');
		$data = array('venta_mov_fecha' => $this->input->post('act_fecha') ,
						'venta_mov_monto' => $this->input->post('act_imp'),
						'venta_mov_comentario' => $this->input->post('act_coment'),
						'venta_mov_estim_estatus' => $this->input->post('act_aplica_flujo_new') );
		//var_dump($id_movimiento);
		if ($this->Dasa_model->UpdateProject_Pay($data,$id_movimiento)) {
			$id_obra=$this->Dasa_model->Id_Proyecto($id_movimiento);
			$sum_pagos=$this->Dasa_model->SumPagos_Obra($id_obra->obra_cliente_id_obra_cliente);
			$total_obra=$this->Dasa_model->Total_obra($id_obra->obra_cliente_id_obra_cliente);
			$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->sum_pagos);

			$fecha_ult_pago=$this->Dasa_model->Fecha_Ult_Pago($id_obra->obra_cliente_id_obra_cliente);
			
			$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->sum_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
			$actualiza=$this->Dasa_model->UpdatePaysCustomer($id_obra->obra_cliente_id_obra_cliente,$saldo);
			echo 'actualizado';
		}else{
			echo 'error';
		}
	}

public function EditCustomerPay_Admin(){
		$this->load->model('Dasa_model');
		$id=$_POST["id"];

		$act_fecha=$_POST["act_fecha"];
		$act_imp=$_POST["act_imp"];
		$act_coment=trim($_POST["act_coment"]);

		$fecha_old=$_POST["fecha_old"];
		$importe_old=$_POST["importe_old"];
		$coment_old=trim($_POST["coment_old"]);
		$act_aplica_flujo_new=$_POST["act_aplica_flujo_new"];
		$act_aplica_flujo_old=$_POST["act_aplica_flujo_old"];

		$txt_justifica=trim($_POST["txt_justifica"]);

		$data = array('historial_proyecto_pago_id_venta_mov' => $id,
					  'historial_proyecto_pago_fecha_actualizacion' => date("Y/m/d"),
					  'historial_proyecto_pago_coment_old' => $coment_old,
					  'historial_proyecto_pago_coment_new' => $act_coment,
					  'historial_proyecto_pago_monto_old' => $importe_old,
					  'historial_proyecto_pago_monto_new' => $act_imp,
					  'historial_proyecto_pago_fecha_pago_old' => $fecha_old,
					  'historial_proyecto_pago_fecha_pago_new' => $act_fecha ,
					  'historial_proyecto_pago_justifica' => $txt_justifica,
					  'historial_proyecto_pago_autoriza' => "1",
					  'historial_proyecto_pago_solicita' => $this->session->userdata('id_usuario'),
					  'historial_proyecto_pago_estim_estatus_old' => $act_aplica_flujo_old,
					  'historial_proyecto_pago_estim_estatus_new' => $act_aplica_flujo_new);
		$table="historial_proyecto_pago";
		$result=$this->Dasa_model->Insert($table,$data);
		echo $result;
	}

	public function UpdateProvider(){
		$this->load->model('Dasa_model');
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
		if($this->Dasa_model->Update_Provider($id_prov,$data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function NewProvider(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
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
		if($this->Dasa_model->New_Provider($data)){
			echo true;
		}else{
			echo false;
		}
	}
	
	public function UpdateCustomer(){
		$this->load->model('Dasa_model');
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
		if($this->Dasa_model->Update_Customer($id_cust,$data)){
			echo true;
		}else{
			echo false;
		}
	}

		public function NewCustomer(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
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
		if($this->Dasa_model->New_Customer($data)){
			echo true;
		}else{
			echo false;
		}
	}
	
	public function Update_Alm_Product(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
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
		if($this->Dasa_model->Edit_Product($id_prod,$data)){
			echo true;
		}else{
			echo false;
		}		
	}

	public function NewAlm_Product(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data = array('empresa_id_empresa' => $idcompany->id_empresa,
						'prod_alm_nom' => $this->input->post('nom_prod'),
						'prod_alm_medida' => $this->input->post('unid_med'),
						'prod_alm_modelo' => $this->input->post('modelo'),
						'prod_alm_prec_unit' => $this->input->post('precio'),
						'prod_alm_exist' => $this->input->post('existencia'),
						'prod_alm_codigo' => $this->input->post('codigo'),
						'prod_alm_descripcion' => $this->input->post('descripcion'),
						'prod_alm_coment' => $this->input->post('coment'));
		if($this->Dasa_model->New_Product($data)){
			echo true;
		}else{
			echo false;
		}		
	}

	public function UpdateInfoProduct(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
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
		$location = 'Resources/Products&Services/DASA/'.$filename;//Dirección para guardar la imagen/documento
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas



		$url_imagen='Resources/Products&Services/DASA/Product_Service_'.$id.'.'.$file_extension;

		if ($filename=="") {
			$id = $_POST["idE"];
			$data = array(
				'catalogo_producto_nombre' => $this->input->post('nameProductE'),
				'catalogo_producto_umedida' => $this->input->post('medidaE'),
				'catalogo_producto_precio'=>$priceE,
				'catalogo_proveedor_id_catalogo_proveedor' => $this->input->post('providerE'),
				'catalogo_proveedor_empresa_id_empresa' => $this->input->post('EnterpriseIDE'),
				'catalogo_producto_fecha_actualizacion' => $this->input->post('dateE'));
			$this->Dasa_model->UpdateProduct($id, $data);

                $data_historial = array('id_producto' => $id,
                'historial_fecha_actualizacion' => $this->input->post('dateE'),
                'historial_id_proveedor'=> $this->input->post('providerE'),
            	'historial_precio_producto_precio' => $priceE);
    			$tabla_historial='historial_precio_producto';

    			$this->Dasa_model->Insert($tabla_historial,$data_historial);

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
						'catalogo_proveedor_empresa_id_empresa' => $this->input->post('EnterpriseIDE'),
						'catalogo_producto_fecha_actualizacion' => $this->input->post('dateE'),
						'catalogo_producto_url_imagen' => $url_imagen);
					$this->Dasa_model->UpdateProduct($id, $data);
					echo true;
				}else{
					echo false;
				}
			}
		}
	}

	public function Product_Record(){
		$this->load->model('Dasa_model');
		$id_producto=$_POST['id_product'];
		$data = array('record_product' => $this->Dasa_model->Get_Product_Record($id_producto),
					  'product_info' => $this->Dasa_model->Get_Product_Info($id_producto));
		$this->load->view('DASA/Record_Product', $data);

	}


	public function AddNewExpend(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$monto=$_POST["addAmount"];
		$monto=str_replace(',', '', $monto); 
		$add_flujo=$_POST["add_flujo"];

		$iva=$_POST["add_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["add_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["add_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["add_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["add_dap"];
		$dap=str_replace(',', '', $dap);

		if (isset($_FILES['addBill']['name'])) {
			$filename = $_FILES['addBill']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/Expends/DASA/'.$filename;//Dirección para guardar la imagen/documento
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
						'fecha_pago_factura' => $this->input->post('addDate'),
						'otros_gastos_aplica_flujo' => $add_flujo,
						'otros_gastos_referencia'=>$this->input->post('add_ref'),
						'otros_gastos_iva'=>$iva,
						'otros_gastos_iva_ret'=>$ret_iva,
						'otros_gastos_isr_ret'=>$ret_isr,
						'otros_gastos_ieps'=>$ieps,
						'otros_gastos_dap'=>$dap);

		$id_otros_gastos=$this->Dasa_model->Insert($table, $data);
		$url_imagen='Resources/Bills/Expends/DASA/otros_gastos_'.$id_otros_gastos.'.'.$file_extension;
	

		if(in_array($file_extension,$image_ext)&&$id_otros_gastos!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
  				// Upload file
			if(move_uploaded_file($_FILES['addBill']['tmp_name'],$url_imagen)){
				$data2 = array('factura' => $url_imagen);//nombre del url
				$this->Dasa_model->UpdateExpendInfo($id_otros_gastos, $data2);
			}				
        }
        echo true;		
	}
	
	public function NewAlm_Consumible(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
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
		if($this->Dasa_model->New_Consumible($data)){
			echo true;
		}else{
			echo false;
		}	
	}

	public function UpdateConsumible(){
		$this->load->model('Dasa_model');
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
		if($this->Dasa_model->Update_Consumible($id, $data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function AddViaticReport(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$totalDays=$_POST["totalDays"];
		$totalDays++;
		$addflujo=$_POST["addflujo"];

		$table = 'viaticos';
		$data = array('obra_cliente_id_obra_cliente' => $this->input->post('addClientName'),
						'obra_cliente_empresa_id_empresa' => $idcompany->id_empresa,
						'viaticos_fecha' => $this->input->post('addEmitionDate'),
						'viaticos_total_dias' => $totalDays,
						'viaticos_fecha_ini' => $this->input->post('addStartDate'),
						'viaticos_fecha_fin' => $this->input->post('AddDateEnd'),
						'viaticos_total' => $this->input->post('addMoney'),
						'viaticos_aplica_flujo' => $addflujo);
		if ($this->Dasa_model->Insert($table, $data)) {
        	echo true;
        }else{
        	echo false;
        }
	}

	public function UpdateViaticReport(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$id_viatico=$_POST["edit_idreport"];
		$edit_aplicaflujo=$_POST["edit_aplicaflujo"];

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
						'viaticos_fecha_fin' => $this->input->post('edit_AddDateEnd'),
						'viaticos_aplica_flujo' => $edit_aplicaflujo);

		if ($this->Dasa_model->Update_Viatic($id_viatico, $data)) {
        	echo true;
        }else{
        	echo false;
        }
	}


	public function AddViaticExpend(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$id_viatico=$_POST["idViatic"];

		$monto=$_POST["addImport"];
		$monto=str_replace(',', '', $monto); 

		$iva=$_POST["add_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["add_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["add_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["add_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["add_dap"];
		$dap=str_replace(',', '', $dap);


		if (isset($_FILES['addEvidence']['name'])) {
			$filename = $_FILES['addEvidence']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/ViaticExpends/DASA/'.$filename;//Dirección para guardar la imagen/documento
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
						'lista_viatico_factura' => $this->input->post('idComprobante'),
						'lista_viatico_iva'=>$iva,
						'lista_viatico_iva_ret'=>$ret_iva,
						'lista_viatico_isr_ret'=>$ret_isr,
						'lista_viatico_ieps'=>$ieps,
						'lista_viatico_dap'=>$dap,
						'lista_viatico_referencia'=>$this->input->post('add_ref'));

		$id_lista_viatico=$this->Dasa_model->Insert($table, $data);

		$url_imagen='Resources/Bills/ViaticExpends/DASA/viaticos_'.$id_lista_viatico.'.'.$file_extension;
	

		if(in_array($file_extension,$image_ext)&&$id_lista_viatico!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
  				// Upload file
			if(move_uploaded_file($_FILES['addEvidence']['tmp_name'],$url_imagen)){
				$data2 = array('lista_viatico_url_comprobante' => $url_imagen);//nombre del url
				$this->Dasa_model->UpdateViaticList($id_lista_viatico, $data2);
			}				
        }
        	//realizar la suma de los viaticos 
		$Suma_viaticos = $this->Dasa_model->ViaticPaymentsSum($id_viatico);      

		$datos_suma = array('viaticos_total' => $Suma_viaticos->sumPayment , ); 

		$this->Dasa_model->Update_Viatic($id_viatico,$datos_suma); 

		echo true;
	}


	public function UpdateViaticExpend(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$id_viatico=$_POST["edit_idViatic"];
		$id_lista_viatico=$_POST["edit_id_lista_viatico"];

		$monto=$_POST["edit_addImport"];
		$monto=str_replace(',', '', $monto); 

		$iva=$_POST["edit_iva"];
		$iva=str_replace(',', '', $iva);
		$ret_iva=$_POST["edit_ret_iva"];
		$ret_iva=str_replace(',', '', $ret_iva);
		$ret_isr=$_POST["edit_ret_isr"];
		$ret_isr=str_replace(',', '', $ret_isr);
		$ieps=$_POST["edit_ieps"];
		$ieps=str_replace(',', '', $ieps);
		$dap=$_POST["edit_dap"];
		$dap=str_replace(',', '', $dap);


		if (isset($_FILES['edit_addEvidence']['name'])) {
			$filename = $_FILES['edit_addEvidence']['name'];//imageE
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = 'Resources/Bills/ViaticExpends/DASA/'.$filename;//Dirección para guardar la imagen/documento
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
						'lista_viatico_factura' => $this->input->post('edit_idComprobante'),
						'lista_viatico_iva'=>$iva,
						'lista_viatico_iva_ret'=>$ret_iva,
						'lista_viatico_isr_ret'=>$ret_isr,
						'lista_viatico_ieps'=>$ieps,
						'lista_viatico_dap'=>$dap,
						'lista_viatico_referencia'=>$this->input->post('edit_ref'));

		$this->Dasa_model->UpdateViaticList($id_lista_viatico, $data);

		$url_imagen='Resources/Bills/ViaticExpends/DASA/viaticos_'.$id_lista_viatico.'.'.$file_extension;
	

		if(in_array($file_extension,$image_ext)&&$id_lista_viatico!=""&&$filename!=""){
			if (file_exists($url_imagen)){
  				unlink($url_imagen);
  			} 
  				// Upload file
			if(move_uploaded_file($_FILES['edit_addEvidence']['tmp_name'],$url_imagen)){
				$data2 = array('lista_viatico_url_comprobante' => $url_imagen);//nombre del url
				$this->Dasa_model->UpdateViaticList($id_lista_viatico, $data2);
			}				
        }
        	//realizar la suma de los viaticos 
		$Suma_viaticos = $this->Dasa_model->ViaticPaymentsSum($id_viatico);      

		$datos_suma = array('viaticos_total' => $Suma_viaticos->sumPayment , ); 

		$this->Dasa_model->Update_Viatic($id_viatico,$datos_suma); 

		echo true;
	}

	public function EditViaticReport(){
		$this->load->model('Dasa_model');
		$data = array('id_lista_viatico' => $this->input->post('addexpendId'),
						'viaticos_id_viaticos'=> $this->input->post('idViatic'),
						'lista_viatico_fecha'=> $this->input->post('addDate'),
						'empleado'=> $this->input->post('employ'),
						'lista_viatico_concepto'=> $this->input->post('addconcept'),
						'lista_viatico_importe'=> $this->input->post('addImport'),
						'lista_viatico_comprobante'=> $this->input->post('addTypeVoucher'),
						'lista_viatico_factura' => $upload_file);

	}

	public function Reporte_flujo_efectivo(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
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


		if(is_null($this->Dasa_model->Verifica_Flujo($idcompany->id_empresa,$anio,$mes_letra))){
			$saldo_ant=$this->Dasa_model->Get_sal_ban_ant($idcompany->id_empresa,$anio_ant,$mes_ant_letra);//Si no existe un registro de flujo de efectivo para el mes actual, entonces busca el saldo en banco del mes anterior
			if(isset($saldo_ant->flujo_efectivo_saldo_fin)){
				$saldo_anterior=$saldo_ant->flujo_efectivo_saldo_fin;
			}else{
				$saldo_anterior=0.00;
			}				
				$tipo_saldo="anterior";
			
		}else{
			$saldo_guardado=$this->Dasa_model->Get_sal_ban_guardado($idcompany->id_empresa,$anio,$mes_letra);//si ya existe un registro del mes actual, entonces toma el último saldo de banco guardado en el registro del flujo de efectivo
			//$saldo_ant=0.99;
			$tipo_saldo="guardado";
		}	
		

		if($tipo_saldo=="anterior"){
			$data = array('ingresos_venta_mov' => $this->Dasa_model->Get_Ingresos_Pagos($idcompany->id_empresa,$anio,$mes),
					      'sal_ban_ant'=>$saldo_anterior,
					      'egresos_caja_chica' => $this->Dasa_model->Get_Egresos_Caja_Chica($idcompany->id_empresa,$anio,$mes),
					      'egresos_gasto_venta' => $this->Dasa_model->Get_Egresos_Gasto_Venta($idcompany->id_empresa,$anio,$mes),
					      'egresos_viatico' => $this->Dasa_model->Get_Egresos_Gasto_Viatico($idcompany->id_empresa,$anio,$mes),
					      'egresos_otros_gastos' => $this->Dasa_model->Get_Egregos_Otros_Gastos($idcompany->id_empresa,$anio,$mes),
					      'mes'=>$mes_letra,
					  	   'anio'=>$anio );
		}else{
			$data = array('ingresos_venta_mov' => $this->Dasa_model->Get_Ingresos_Pagos($idcompany->id_empresa,$anio,$mes),
					  	   'sal_ban_ant'=> $saldo_guardado->flujo_efectivo_saldo_ini,
					  	   'egresos_caja_chica' => $this->Dasa_model->Get_Egresos_Caja_Chica($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_gasto_venta' => $this->Dasa_model->Get_Egresos_Gasto_Venta($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_viatico' => $this->Dasa_model->Get_Egresos_Gasto_Viatico($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_otros_gastos' => $this->Dasa_model->Get_Egregos_Otros_Gastos($idcompany->id_empresa,$anio,$mes),
					  	   'mes'=>$mes_letra,
					  	   'anio'=>$anio );
		}	
		//var_dump($data);
		$this->load->view('DASA/Tabla_flujo_efectivo', $data);
	}

	public function Save_Reporte_flujo(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$anio=$_POST["anio"];
		$mes=$_POST["mes"];
		if(is_null($this->Dasa_model->Verifica_Flujo($idcompany->id_empresa,$anio,$mes))){
			$data = array('empresa_id_empresa' =>$idcompany->id_empresa ,
						  'flujo_efectivo_mes' =>$mes ,
						  'flujo_efectivo_anio' =>$anio ,
						  'flujo_efectivo_saldo_ini' =>$this->input->post('saldo_ini') ,
						  'flujo_efectivo_saldo_fin' =>$this->input->post('saldo_fin') ,
						  'flujo_efectivo_total_ingreso' =>$this->input->post('ingreso') ,
						  'flujo_efectivo_total_egreso' =>$this->input->post('egresos'));
			$result=$this->Dasa_model->Guarda_Flujo($data);
			echo $result;
		}else{
			$data = array('flujo_efectivo_saldo_ini' =>$this->input->post('saldo_ini') ,
						  'flujo_efectivo_saldo_fin' =>$this->input->post('saldo_fin') ,
						  'flujo_efectivo_total_ingreso' =>$this->input->post('ingreso') ,
						  'flujo_efectivo_total_egreso' =>$this->input->post('egresos'));
			$this->Dasa_model->Update_Flujo($mes,$anio,$idcompany->id_empresa,$data);
			echo "existe";
		}
	}

	public function FlujoEfectivo_Proyecto(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data = array('proyectos' => $this->Dasa_model->GetAllCustomer_Project($idcompany->id_empresa) , );
		$this->load->view('DASA/Report_Flujo_Efectivo_proyecto',$data);
	}

	public function Reporte_flujo_efectivo_proyecto(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$id_obra_cliente=$_POST["id_obra_cliente"];

		$data = array('ingresos_venta_mov' => $this->Dasa_model->Get_Ingresos_Pagos_proyecto($id_obra_cliente),
					  	   //'egresos_caja_chica' => $this->Dasa_model->Get_Egresos_Caja_Chica($idcompany->id_empresa,$anio,$mes),
					  	   'egresos_gasto_venta' => $this->Dasa_model->Get_Egresos_Gasto_Venta_proyecto($id_obra_cliente),
					  	   //'egresos_viatico' => $this->Dasa_model->Get_Egresos_Gasto_Viatico($idcompany->id_empresa,$anio,$mes),
					  	   //'egresos_otros_gastos' => $this->Dasa_model->Get_Egregos_Otros_Gastos($idcompany->id_empresa,$anio,$mes)
					  	);
		//var_dump($data);
		$this->load->view('DASA/Tabla_flujo_efectivo_proyecto', $data);

	}

	public function customer_payments_tbl_body(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$activo=$_POST["activo"];
		//$activo=explode('*', $activo);
		$data=array('customerspays'=>$this->Dasa_model->GetAllCustomer_Payments($idcompany->id_empresa),
					'filtro'=>$activo);
		$this->load->view('DASA/customer_payments_tbl_body',$data);
	}

	public function Customer_Projects_tbl_body(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$activo=$_POST["activo"];
		$data=array('proyectlist'=>$this->Dasa_model->GetAllCustomer_Project($idcompany->id_empresa),
					'customerlist'=>$this->Dasa_model->Get_Customer_List($idcompany->id_empresa),
					'filtro'=>$activo);
		$this->load->view('DASA/Customer_Projects_tbl_body',$data);
	}

    public function Lista_Solicitudes(){
        $this->load->model('Dasa_model');
        $company='DASA';
        $idcompany=$this->Dasa_model->IdCompany($company);
        $data = array('solicitado' => $this->Dasa_model->Cambio_Solicitado($idcompany->id_empresa) ,
                      'solicitado_pago' => $this->Dasa_model->Cambio_Solicitado_pago($idcompany->id_empresa), 
                      'catalogo_cliente' => $this->Dasa_model->Cat_Cliente(),
                      'catalogo_autoriza' =>$this->Dasa_model->Cat_autoriza());
        $this->load->view('DASA/ListaSolicitudes', $data);
    }

    public function Estimacion_tbl(){
        $this->load->model('Dasa_model');
        $company='DASA';
        $idcompany=$this->Dasa_model->IdCompany($company);
        $id_obra=$_POST["id_obra"];
		$data2=$this->Dasa_model->Datos_obra($id_obra);
		$data=array('payments_list'=>$this->Dasa_model->GetPayments_List($id_obra),
					'obra'=>$data2);
		$this->load->view('DASA/Estimacion_tabla',$data);
    }

    public function Guarda_estimacion(){
    	$this->load->model('Dasa_model');
        $company='DASA';
        $idcompany=$this->Dasa_model->IdCompany($company);

        $folio_txt=$_POST["folio_txt"];
      	$estatus_id=$_POST["estatus_id"];
      	$amortizacion=$_POST["amortizacion"];
      	$anticipo_amort=$_POST["anticipo_amort"];
      	$fecha=$_POST["fecha"];
      	$id_venta_mov=$_POST["id_venta_mov"];
      	$id_obra_cliente=$_POST["id_obra_cliente"];
      	$deducciones=$_POST["deducciones"];

      	$data = array('venta_mov_factura' => $folio_txt,
      				  'venta_mov_estim_estatus' => $estatus_id,
      				  'venta_mov_estim_amor_ant' => $amortizacion,
      				  'venta_mov_estim_ant_amort' => $anticipo_amort,
      				  'venta_mov_estim_fecha' => $fecha );
      	$data2 = array('obra_cliente_deducciones' => $deducciones );

      	$this->Dasa_model->Edit_CustomerProject($id_obra_cliente,$data2);
      	
      	echo ($this->Dasa_model->UpdateProject_Pay($data,$id_venta_mov));
    }

 public function Update_Inv_Prod(){
    	$this->load->model('Dasa_model');
        $company='DASA';
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
		$result=$this->Dasa_model->Insert($table,$data);

		if($result){
			$data2 = array('prod_alm_exist' => $nueva_exist,
							'prod_alm_prec_unit' => $inv_prec_new);
							//'prod_alm_precio_venta' => $inv_prec_venta_new
			$this->Dasa_model->Return_Product_Almacen($id_prod,$data2);
			echo true;
		}else{
			echo false;
		}
    }

    function Product_History(){
    	$this->load->model('Dasa_model');
		$id_prod=$_POST['id_prod'];
		$data = array('historial_inv_prod' => $this->Dasa_model->Get_Product_History($id_prod),
					'ult_fecha' => $this->Dasa_model->Ult_Fecha($id_prod),
					'Product_Inv_info' => $this->Dasa_model->Product_Inv_info($id_prod));
		$this->load->view('DASA/Historial_Inv_Prod', $data);
    }

function Update_Inv_Consu(){
    	$this->load->model('Dasa_model');
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
		$result=$this->Dasa_model->Insert($table,$data);

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

			
		$this->Dasa_model->Update_Consumible($id_prod, $data2);
			echo true;
		}else{
			echo false;
		}
    }

    function Product_History_Consu(){
    	$this->load->model('Dasa_model');
		$id_prod=$_POST['id_prod'];
		$data = array('historial_inv_prod' => $this->Dasa_model->Get_Product_History_Consu($id_prod),
					'ult_fecha' => $this->Dasa_model->Ult_Fecha_Consu($id_prod),
					'Product_Inv_info' => $this->Dasa_model->Product_Inv_info_Consu($id_prod));
		$this->load->view('DASA/Historial_Inv_Consumible', $data);
    }

public function Ver_Nube(){
    	$this->load->model('Dasa_model');
    	$company='DASA';
    	$idcompany=$this->Dasa_model->IdCompany($company);
    	$url_base=base_url();
    	$directorio="Resources/Nube_Sigen/".$company;
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
			if ($_dirSize=="") {
				$_dirSize=0;
			}
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
$this->load->view('DASA/Menu_Nube',$data);
}

    public function Carga_tabla(){
		$this->load->model('Dasa_model');
            	$company='DASA';
    	$idcompany=$this->Dasa_model->IdCompany($company);
    	$url_base=base_url();

    	$direccion="Resources/Nube_Sigen/".$company;
    	//var_dump(filesize($direccion));
		$directorio="Resources/Nube_Sigen/".$company;
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
			if ($_dirSize=="") {
				$_dirSize=0;
			}
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
 

        $this->load->view('DASA/Menu_Nube',$data);
    }

    public function Borra_Archivo(){
    	$nom_archivo=$_POST["nom_archivo"];
    	$borrar="Resources/Nube_Sigen/DASA/".$nom_archivo;
    	if (unlink($borrar)) {
    		echo true;
    	}else{
    		echo false;
    	}
    }

   
    public function Crea_Carpeta(){
    	$nom_carpeta=$_POST["nom_carpeta"];
    	$ruta_carpeta=$_POST["ruta_carpeta"];
    	$ruta_carpeta=explode('Nube_Sigen/',$ruta_carpeta);
    	$crear="Resources/Nube_Sigen/DASA/".$ruta_carpeta[1]."/".$nom_carpeta;
    	if (!file_exists($crear)) {
		    mkdir($crear);
		    echo true;
		}else{
			echo false;
		}
    }


	public function Add_File(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);

		$ruta_nuevo_archivo=$_POST["nueva_ruta"];
		$ruta_nuevo_archivo=explode('Nube_Sigen/',$ruta_nuevo_archivo);
		if (isset($_FILES['add_file']['name'])) {
			$filename = $_FILES['add_file']['name'];
		} else {
			$filename="";
		}

		//Obtenemos el nombre del documento que subiremos
		$location = "Resources/Nube_Sigen/DASA/".$ruta_nuevo_archivo[1]."/".$filename;
		// file extension
		$file_extension = pathinfo($location, PATHINFO_EXTENSION);//obtenermos la extension del documento
		$file_extension = strtolower($file_extension);//cambiamos la extension del documento a minusculas

		// Valid image extensions
		//$image_ext = array("jpg","png","jpeg","gif","pdf");//Array con las extensiones permitidas

		$url_imagen="Resources/Nube_Sigen/DASA/".$ruta_nuevo_archivo[1]."/".$filename;

		$upload=move_uploaded_file($_FILES['add_file']['tmp_name'],$url_imagen);
		if(!$upload){
			echo false;
			}else{
				echo true;
			}
	}

	public function Solicita_Borra_carpeta(){
		$this->load->model('Dasa_model');
		$txt_justifica=trim($_POST["txt_justifica"]);
		$delete_ruta_carpeta=$_POST["delete_ruta_carpeta"];

		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		date_default_timezone_set("America/Mexico_City");
		$data = array('borra_nube_id_usuario' => $this->session->userdata('id_usuario'),
        'borra_nube_empresa' => $idcomp->id_empresa,
        'borra_nube_url_archivo' => $delete_ruta_carpeta,
        'borra_nube_fecha_solicitud' => date("Y/m/d"),
        'borra_nube_comentario'=>$txt_justifica,
        'borra_nube_id_estado'=>"1");

		$result=$this->Dasa_model->Add_Solicita_Borra_carpeta($data);
		echo $result;
	}

	public function Solicita_Borra_archivo(){
		$this->load->model('Dasa_model');
		$txt_justifica=trim($_POST["txt_justifica"]);
		$delete_ruta_archivo=$_POST["delete_ruta_archivo"];

		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		date_default_timezone_set("America/Mexico_City");
		$data = array('borra_nube_id_usuario' => $this->session->userdata('id_usuario'),
        'borra_nube_empresa' => $idcomp->id_empresa,
        'borra_nube_url_archivo' => $delete_ruta_archivo,
        'borra_nube_fecha_solicitud' => date("Y/m/d"),
        'borra_nube_comentario'=>$txt_justifica,
        'borra_nube_id_estado'=>"1");

		$result=$this->Dasa_model->Add_Solicita_Borra_archivo($data);
		echo $result;
	}


	public function Solicita_descarga_archivo(){
		$this->load->model('Dasa_model');
		$descarga_ruta_archivo=$_POST["descarga_ruta_archivo"];
		$descarga_nombre=$_POST["descarga_nombre"];
		$pass_descarga=$_POST["pass_descarga"];

		$pass_su_descarga = $this->Dasa_model->Pass_download($pass_descarga);//invoke the funtion into the model
          
         if(password_verify($pass_descarga, $pass_su_descarga->usuario_pass_descarga)){
         	echo true;
         }else{
         	echo false;
         }

	}


#end conntroller
}	