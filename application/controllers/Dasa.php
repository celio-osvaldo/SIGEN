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
	   		$this->load->view('plantillas/header_dasa', $data);
			$this->load->view('DASA/Welcome');
       		$this->load->view('plantillas/footer_dasa');
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

	public function GetInventories(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data = array('inventories' => $this->Dasa_model->GetAllProducts($idcompany->id_empresa),
						'providers' => $this->Dasa_model->GetAll_Provider($idcompany->id_empresa),
						'measure' => $this->Dasa_model->GetAllMeasurements());
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

	public function test(){
		$this->load->model('Dasa_model');
		$table = 'gasto_venta';
		$id = 'id_gasto_venta';
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('woks'=>$this->Dasa_model->GetAllWorks_Client(),
					'max'=>$this->Dasa_model->IDMAX($table, $id));
		$this->load->view('DASA/EditProductForm', $data);
	}

	public function GetListCostOfSale(){
		$this->load->model('Dasa_model');
		$table = 'gasto_venta';
		$id = 'id_gasto_venta';
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('cost_sale'=>$this->Dasa_model->GetAllCostOfSale($idcompany->id_empresa),
					'woks'=>$this->Dasa_model->GetAllWorks_Client(),
					'max'=>$this->Dasa_model->IDMAX($table, $id));
		$this->load->view('Dasa/CostOfSale-List', $data);
	}

	public function GetAllViatics(){
		$this->load->view('Dasa/ViaticList');
	}

	public function DeatailsOfViatic(){
		$this->load->view('Dasa/DetailsViaticReport');
	}

	public function PettyCash(){
		$table = 'lista_caja_chica';
		$id = 'id_lista_caja_chica';
		$this->load->model('Dasa_model');
		$data=array('cash' => $this->Dasa_model->GetAllReportsOfPettyCash(),
					'max'=>$this->Dasa_model->IDMAX($table, $id));
		$this->load->view('Dasa/PettyCash', $data);
	}

	public function Catalogo_Proveedor(){
		$this->load->model('Dasa_model');
		$company='DASA';
		//var_dump($company);
		$idcompany=$this->Dasa_model->IdCompany($company);
		//var_dump($idcompany);
		$data=array('catalogo_proveedor'=>$this->Dasa_model->GetAll_Provider($idcompany->id_empresa));
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



#actions

	public function AddCustomerProject(){
		$this->load->model('Dasa_model');
		$nombre=$_POST["nombre"];
		$id_cliente=$_POST["id_cliente"];
		$importe=$_POST["importe"];
		$coment=$_POST["coment"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
				$data=array('empresa_id_empresa' => $idcomp->id_empresa,
					'obra_cliente_nombre'=> $nombre,
					'obra_cliente_id_cliente'=>$id_cliente,
					'obra_cliente_imp_total'=>$importe,
					'obra_cliente_saldo'=>$importe,
					'obra_cliente_estado'=>1,
					'obra_cliente_comentarios'=>$coment);
		$result=$this->Dasa_model->AddCustomer_Project($data);
		echo $result;		
	}

	public function EditCustomerProject(){
		$this->load->model('Dasa_model');
		$act_nom=$_POST["act_nom"];
		$act_cliente=$_POST["act_cliente"];
		$act_imp=$_POST["act_imp"];
		$act_estado=$_POST["act_estado"];
		$act_coment=$_POST["act_coment"];
		$id=$_POST["id"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$sum_pagos=$this->Dasa_model->SumPagos_Obra($id);
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
		$result=$this->Dasa_model->Edit_CustomerProject($id,$data);
		echo $result;
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
		$this->load->model('Dasa_model');
		$result = $this->Dasa_model->Insert($table, $data);
		echo $result;
	}

	public function UploadImage(){
		$image = 'imageI';//The name of input that select file
        $config['upload_path'] = ".\Resources\Products&Services\DASA";//Path of where uploadthe file
        $config['file_name'] = $this->input->post('idI');//name of file
        $config['overwrite'] = true;//allow or not allow overwrite a file
        $config['allowed_types'] = "gif|jpg|jpeg|png";//type of files allowed to upload
        $config['max_size'] = "5000";//max size of the file allowed
        $config['max_width'] = "2080";//max of width of image
    	$config['max_height'] = "2000";//max of height of image

        $this->load->library('upload', $config);//use for allow the upload files at server

        if (!$this->upload->do_upload($image)) {//if there is a error while upload. shows the error in the view
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }
	}

	public function AddCustomersPay(){
		$this->load->model('Dasa_model');
		$new_id_obra=$_POST["id_obra"];
		$new_cant_pago=$_POST["cant_pago"];
		$new_fecha=$_POST["fecha"];
		$new_coment=$_POST["coment"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
		$data = array('obra_cliente_empresa_id_empresa' => $idcomp->id_empresa,
			'venta_mov_fecha' => $new_fecha,
			'venta_mov_comentario' => $new_coment,
			'venta_mov_monto' => $new_cant_pago,
			'obra_cliente_id_obra_cliente' => $new_id_obra);
		//var_dump($data);
		$result=$this->Dasa_model->AddCustomer_Pay($data);
		$sum_pagos=$this->Dasa_model->SumPagos_Obra($new_id_obra);
		$total_obra=$this->Dasa_model->Total_obra($new_id_obra);
		$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->suma_pagos);
		$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$new_fecha);
		$actualiza=$this->Dasa_model->UpdatePaysCustomer($new_id_obra,$saldo);
		//var_dump($total_obra);
		echo $result;
	}

	public function AddCostOfSale(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		// $idcompany=2;
		$table = 'gasto_venta';
		$data = array('id_gasto_venta' => $this->input->post('addFolio'),
						'obra_cliente_id_obra_cliente'=> $this->input->post('addClientName'),
						'obra_cliente_empresa_id_empresa'=> $idcompany,
						'gasto_venta_fecha'=> $this->input->post('addEmitionDate'),
						'gasto_venta_factura'=> $this->input->post('addBill'),
						'gasto_venta_monto'=> $this->input->post('addAmount'),
						'gasto_venta_concepto' => $this->input->post('addConcept'),
						'gasto_venta_observacion' => $this->input->post('addComment'),
						'gasto_venta_estado_pago' => $this->input->post('addStatus'),
						'gasto_venta_fecha_pago' => $this->input->post('addDate'));

		$result = $this->Dasa_model->Insert($table, $data);
		echo $result;
	}

	public function EditCostOfSale(){
		$this->load->model('Dasa_model');
		$idcompany = 2;
		$id = $_POST['folioE'];
		$data = array('obra_cliente_id_obra_cliente'=> $this->input->post('clientNameE'),
						'obra_cliente_empresa_id_empresa'=> $idcompany,
						'gasto_venta_fecha'=> $this->input->post('emitionDateE'),
						'gasto_venta_factura'=> $this->input->post('billE'),
						'gasto_venta_monto'=> $this->input->post('amountE'),
						'gasto_venta_concepto' => $this->input->post('conceptE'),
						'gasto_venta_observacion' => $this->input->post('commentE'),
						'gasto_venta_estado_pago' => $this->input->post('statusE'),
						'gasto_venta_fecha_pago' => $this->input->post('dateE'));

		if($this->Dasa_model->UpdateCostSale($id, $data)){
			echo true;
		}else{
			echo false;
		}
	}

	public function AddReportPettyCash(){
		$this->load->model('Dasa_model');
		$file = 'upBillI';//The name of input that select file
        $config['upload_path'] = "./Resources/Bills/PettyCash/DASA/";//Path of where uploadthe file
        $config['file_name'] = $this->input->post('folioBillI');//name of file
        $config['overwrite'] = true;//allow or not allow overwrite a file
        $config['allowed_types'] = "pdf";//type of files allowed to upload
        $config['max_size'] = "5000";//max size of the file allowed

        $this->load->library('upload', $config);//use for allow the upload files at server

        if (!$this->upload->do_upload($file)) {//if there is a error while upload. shows the error in the view
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $upload_file = $config['file_name'] = $this->input->post('folioBillI');
		$table = 'lista_caja_chica';
		$cash = 1;
		$data = array('id_lista_caja_chica' => $this->input->post('cashI'),
						'caja_chica_id_caja_chica'=> $cash,
						'lista_caja_chica_fecha'=> $this->input->post('dateI'),
						'lista_caja_chica_concepto'=> $this->input->post('conceptI'),
						'lista_caja_chica_reposicion'=> $this->input->post('moneyI'),
						'lista_caja_chica_gasto'=> $this->input->post('moneyEI'),
						'lista_caja_chica_factura' => $upload_file,
						'lista_caja_chica_fecha_factura' => $this->input->post('dateBillI'));
		// $result = $this->Dasa_model->Insert($table, $data);
		// echo $result;
		if ($this->Dasa_model->Insert($table, $data)) {
        	$data['uploadSuccess'] = $this->upload->data();
        	echo true;
        }else{
        	echo false;
        }
	}

	public function EditCustomerPay(){
		$id_movimiento=$_POST["id"];
		$this->load->model('Dasa_model');
		$data = array('venta_mov_fecha' => $this->input->post('act_fecha') ,
						'venta_mov_monto' => $this->input->post('act_imp'),
						'venta_mov_comentario' => $this->input->post('act_coment') );
		//var_dump($id_movimiento);
		if ($this->Dasa_model->UpdateProject_Pay($data,$id_movimiento)) {
			$id_obra=$this->Dasa_model->Id_Proyecto($id_movimiento);
			$sum_pagos=$this->Dasa_model->SumPagos_Obra($id_obra->obra_cliente_id_obra_cliente);
			$total_obra=$this->Dasa_model->Total_obra($id_obra->obra_cliente_id_obra_cliente);
			$resta=($total_obra->obra_cliente_imp_total-$sum_pagos->suma_pagos);
			$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos);
			$actualiza=$this->Dasa_model->UpdatePaysCustomer($id_obra->obra_cliente_id_obra_cliente,$saldo);
			echo 'actualizado';
		}else{
			echo 'error';
		}
	}

	public function UpdateProvider(){
		$this->load->model('Dasa_model');
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
		$id = $_POST["idE"];
    	$data = array(
    					'catalogo_producto_nombre' => $this->input->post('nameProductE'),
				        'catalogo_producto_umedida' => $this->input->post('medidaE'),
				        'catalogo_producto_precio'=>$this->input->post('priceE'),
				        'catalogo_proveedor_id_catalogo_proveedor' => $this->input->post('providerE'),
				        'catalogo_proveedor_empresa_id_empresa' => $this->input->post('EnterpriseIDE'),
				        'catalogo_producto_fecha_actualizacion' => $this->input->post('dateE'),
				        'catalogo_producto_url_imagen' => $this->input->post('imageE'));
		if($this->Dasa_model->UpdateProduct($id, $data)){
			echo true;
		}else{
			echo false;
		}
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


#end conntroller
}
 