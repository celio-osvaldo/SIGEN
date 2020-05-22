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
		$this->load->view('DASA/CostOfSale-List', $data);
	}

	public function GetAllViatics(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data = array('report_viatics' => $this->Dasa_model->GetAllViaticsReports($idcompany->id_empresa),
						'works'=>$this->Dasa_model->GetAllWorks_Client($idcompany->id_empresa));
		$this->load->view('DASA/ViaticList',$data);
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
		$table = 'lista_caja_chica';
		$id = 'id_lista_caja_chica';
		$this->load->model('Dasa_model');
		$data=array('cash' => $this->Dasa_model->GetAllReportsOfPettyCash(),
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
		$fecha_ult_pago=$this->Dasa_model->Fecha_Ult_Pago($new_id_obra);
		//var_dump($fecha_ult_pago);
		$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
		$actualiza=$this->Dasa_model->UpdatePaysCustomer($new_id_obra,$saldo);
		//var_dump($total_obra);
		echo $result;
	}

	public function AddCostOfSale(){
		$this->load->model('Dasa_model');

		$file = 'addBill';//The name of input that select file
        $config['upload_path'] = "./Resources/Bills/CostOfSale/DASA/";//Path of where uploadthe file
        $config['file_name'] = $this->input->post('addFolio');//name of file
        $config['overwrite'] = false;//allow or not allow overwrite a file
        $config['allowed_types'] = "pdf";//type of files allowed to upload
        $config['max_size'] = "5000";//max size of the file allowed

        $this->load->library('upload', $config);//use for allow the upload files at server

        if (!$this->upload->do_upload($file)) {//if there is a error while upload. shows the error in the view
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

		$upload_file = $config['file_name'] = $this->input->post('addFolio');
		$table = 'gasto_venta';
		$data = array('id_gasto_venta' => $this->input->post('idCost'),
						'obra_cliente_id_obra_cliente'=> $this->input->post('addClientName'),
						'obra_cliente_empresa_id_empresa'=> $this->input->post('addCompany'),
						'gasto_venta_fecha'=> $this->input->post('addEmitionDate'),
						'gasto_venta_factura'=> $upload_file,
						'gasto_venta_monto'=> $this->input->post('addAmount'),
						'gasto_venta_concepto' => $this->input->post('addConcept'),
						'gasto_venta_observacion' => $this->input->post('addComment'),
						'gasto_venta_estado_pago' => $this->input->post('addStatus'),
						'gasto_venta_fecha_pago' => $this->input->post('addDate'));

		if($this->Dasa_model->Insert($table, $data)){
			$data['uploadSuccess'] = $this->upload->data();
        	echo true;
        }else{
        	echo false;
		}
	}

	public function EditCostOfSale(){
		$this->load->model('Dasa_model');
		$id = $_POST['idE'];
		$data = array('obra_cliente_id_obra_cliente'=> $this->input->post('clientNameE'),
						'obra_cliente_empresa_id_empresa'=> $this->input->post('Company'),
						'gasto_venta_fecha'=> $this->input->post('emitionDateE'),
						'gasto_venta_factura'=> $this->input->post('folioE'),
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

	public function UpdateExpend(){
		$this->load->model('Dasa_model');
		$idcompany = 2;
		$id = $_POST['idE'];
		$data = array('empresa_id_empresa'=> $this->input->post('editCompany'),
						'fecha_emision'=> $this->input->post('editEmitionDate'),
						'concepto'=> $this->input->post('editConcept'),
						'saldo'=> $this->input->post('editAmount'),
						'comentario'=> $this->input->post('editComment'),
						'folio' => $this->input->post('editFolio'),
						'factura' => $this->input->post('editFolio'),
						'fecha_pago_factura' => $this->input->post('editDate'));

		if($this->Dasa_model->UpdateExpendInfo($id, $data)){
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

			$fecha_ult_pago=$this->Dasa_model->Fecha_Ult_Pago($id_obra->obra_cliente_id_obra_cliente);
			
			$saldo=array('obra_cliente_saldo' => $resta,
					'obra_cliente_pagado'=>$sum_pagos->suma_pagos,
					'obra_cliente_ult_pago'=>$fecha_ult_pago->venta_mov_fecha);
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

	public function AddNewExpend(){
		$this->load->model('Dasa_model');
		$file = 'addBill';//The name of input that select file
        $config['upload_path'] = "./Resources/Bills/Expends/DASA/";//Path of where uploadthe file
        $config['file_name'] = $this->input->post('addFolio');//name of file
        $config['overwrite'] = true;//allow or not allow overwrite a file
        $config['allowed_types'] = "pdf";//type of files allowed to upload
        $config['max_size'] = "5000";//max size of the file allowed

        $this->load->library('upload', $config);//use for allow the upload files at server

        if (!$this->upload->do_upload($file)) {//if there is a error while upload. shows the error in the view
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

        $upload_file = $config['file_name'] = $this->input->post('addFolio');
		$table = 'otros_gastos';
		$data = array('id_OGasto' => $this->input->post('cashI'),
						'empresa_id_empresa'=> $this->input->post('addCompany'),
						'fecha_emision'=> $this->input->post('addEmitionDate'),
						'concepto'=> $this->input->post('addConcept'),
						'saldo'=> $this->input->post('addAmount'),
						'comentario'=> $this->input->post('addComment'),
						'folio' => $this->input->post('addFolio'),
						'factura' => $upload_file,
						'fecha_pago_factura' => $this->input->post('addDate'));
		if ($this->Dasa_model->Insert($table, $data)) {
        	$data['uploadSuccess'] = $this->upload->data();
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

	public function AddViaticReport(){
		$this->load->model('Dasa_model');
		$table = 'viaticos';
		$data = array('id_viaticos' => $this->input->post('idreport'),
						'obra_cliente_id_obra_cliente' => $this->input->post('addClientName'),
						'obra_cliente_empresa_id_empresa' => $this->input->post('addCompany'),
						'viaticos_fecha' => $this->input->post('addEmitionDate'),
						'viaticos_total_días' => $this->input->post('totalDays'),
						'viaticos_fecha_ini' => $this->input->post('addStartDate'),
						'viaticos_fecha_fin' => $this->input->post('AddDateEnd'),
						'viaticos_total' => $this->input->post('addMoney'));
		if ($this->Dasa_model->Insert($table, $data)) {
        	echo true;
        }else{
        	echo false;
        }
	}

	public function AddViaticExpend(){
		$this->load->model('Dasa_model');
		$file = 'addEvidence';//The name of input that select file
        $config['upload_path'] = "./Resources/Bills/ViaticExpends/DASA/";//Path of where uploadthe file
        $config['file_name'] = $this->input->post('maxid');//name of file
        $config['overwrite'] = true;//allow or not allow overwrite a file
        $config['allowed_types'] = "pdf";//type of files allowed to upload
        $config['max_size'] = "5000";//max size of the file allowed

        $this->load->library('upload', $config);//use for allow the upload files at server

        if (!$this->upload->do_upload($file)) {//if there is a error while upload. shows the error in the view
            $data['uploadError'] = $this->upload->display_errors();
            echo $this->upload->display_errors();
            return;
        }

		$upload_file = $config['file_name'] = $this->input->post('maxid');
		$table = 'lista_viatico';
		$data = array('id_lista_viatico' => $this->input->post('addexpendId'),
						'viaticos_id_viaticos'=> $this->input->post('idViatic'),
						'lista_viatico_fecha'=> $this->input->post('addDate'),
						'empleado'=> $this->input->post('employ'),
						'lista_viatico_concepto'=> $this->input->post('addconcept'),
						'lista_viatico_importe'=> $this->input->post('addImport'),
						'lista_viatico_comprobante'=> $this->input->post('addTypeVoucher'),
						'lista_viatico_factura' => $upload_file);

		if($this->Dasa_model->Insert($table, $data)){
			$data['uploadSuccess'] = $this->upload->data();
        	echo true;
	    }else{
	        echo false;
		}
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
				# code...
				break;
		}
		if($mes==01){
			$mes_ant=12;
			$anio_ant=$anio-1;
		}else{
			$mes_ant=$mes-1;
			$anio_ant=$anio;
		}

		$saldo_ant=$this->Dasa_model->Get_sal_ban_ant($idcompany->id_empresa,$anio_ant,$mes_ant);
		

		if(is_null($saldo_ant)){
			$data = array('ingresos_venta_mov' => $this->Dasa_model->Get_Ingresos_Pagos($idcompany->id_empresa,$anio,$mes),
					      'sal_ban_ant'=>0,
					      'egresos_caja_chica' => $this->Dasa_model->Get_Egresos_Caja_Chica($idcompany->id_empresa,$anio,$mes),
					      'egresos_gasto_venta' => $this->Dasa_model->Get_Egresos_Gasto_Venta($idcompany->id_empresa,$anio,$mes),
					      'egresos_viatico' => $this->Dasa_model->Get_Egresos_Gasto_Viatico($idcompany->id_empresa,$anio,$mes),
					      'egresos_otros_gastos' => $this->Dasa_model->Get_Egregos_Otros_Gastos($idcompany->id_empresa,$anio,$mes),
					      'mes'=>$mes_letra,
					  	   'anio'=>$anio );
		}else{
			$data = array('ingresos_venta_mov' => $this->Dasa_model->Get_Ingresos_Pagos($idcompany->id_empresa,$anio,$mes),
					  	   'sal_ban_ant'=> $saldo_ant,
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
						  'flujo_efectivo_total_egreso' =>$this->input->post('egresos') , );
			$result=$this->Dasa_model->Guarda_Flujo($data);
			echo $result;
		}else{
			echo "existe";
		}


	}


#end conntroller
}