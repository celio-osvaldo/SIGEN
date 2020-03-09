<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DASA extends CI_Controller {

	public function Index()
	{
		if ($this->session->userdata('usuario_alias')) {#verified if a user is logged and don´t lose the session
          $data['alias'] = $this->session->userdata('usuario_alias');#Return the name alias of user for showing
          $data['type'] = $this->session->userdata('nombre_tipo');#it will know who type of user start session and show its navbar
          $data['corp'] = $this->session->userdata('empresa_nom');#for applicated the color in navbar
			$data['title']='SiGeN | DASA';
	   		$this->load->view('plantillas/header_dasa', $data);
			//s$this->load->view('DASA/Welcome');
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
		$data = array('inventories' => $this->Dasa_model->GetAllProducts(),
						'providers' => $this->Dasa_model->GetAllProviders(),
						'measure' => $this->Dasa_model->GetAllMeasurements());
		$this->load->view('DASA/InventoriesList', $data);
		$this->load->view('DASA/AddProductModal', $data);
	}

	public function UpdateProductInfo(){
		$this->load->model('Dasa_model');
		$id=$_POST['idproduct'];
		$data = array('product' => $this->Dasa_model->GetProductByID($id));
		$this->load->view('DASA/editProductForm', $data);
	}

	public function CustomerProjects(){
		$this->load->model('Dasa_model');
		$company='DASA';
		$idcompany=$this->Dasa_model->IdCompany($company);
		$data=array('customerslist'=>$this->Dasa_model->GetAllCustomer_Project($idcompany->id_empresa));
		$this->load->view('DASA/Customer_Projects',$data);
	}


#actions

	public function AddCustomerProject(){
		$this->load->model('Dasa_model');
		$nombre=$_POST["nombre"];
		$importe=$_POST["importe"];
		$coment=$_POST["coment"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);
				$data=array('empresa_id_empresa' => $idcomp->id_empresa,
					'obra_cliente_nombre'=> $nombre,
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
		$act_imp=$_POST["act_imp"];
		$act_estado=$_POST["act_estado"];
		$act_coment=$_POST["act_coment"];
		$id=$_POST["id"];
		$company='DASA';
		$idcomp=$this->Dasa_model->IdCompany($company);

		$data = array(
        'obra_cliente_nombre' => $act_nom,
        'obra_cliente_imp_total' => $act_imp,
        'obra_cliente_estado' => $act_estado,
        'obra_cliente_comentarios' => $act_coment
			);
		$result=$this->Dasa_model->Edit_CustomerProject($id,$data);
		echo $result;
	}

	public function SendDataProductEdit(){
		$id = $this->input->post('idE');
		$data = array('catalogo_producto_nombre'=> $this->input->post('nameProductE'),
						'catalogo_producto_umedida'=> $this->input->post('medidaE'),
						'catalogo_producto_precio'=> $this->input->post('priceE'),
						 'catalogo_proveedor_id_catalogo_proveedor'=> $this->input->post('providerE'),
						'catalogo_producto_fecha_actualizacion' => $this->input->post('dateE'));

		$this->load->model('Dasa_model');
		if($this->Dasa_model->UpdateProduct($id, $data) == true){
		$this->Index();
			echo "<script>alert('Producto modificado correctamente. Verifique en la tabla');window.location.assign('Index') </script>";
		} else{
			echo "<script>alert('Ocurrio un error al agregar. Intente nuevamente');window.location.assign('Index') </script>";
		}
	}

	public function AddProduct(){
		$data = array('id_catalogo_producto' => $this->input->post('id'),
						'catalogo_producto_nombre'=> $this->input->post('nameProduct'),
						'catalogo_producto_umedida'=> $this->input->post('medida'),
						'catalogo_producto_precio'=> $this->input->post('price'),
						 'catalogo_proveedor_id_catalogo_proveedor'=> $this->input->post('provider'),
						 'catalogo_proveedor_empresa_id_empresa'=> $this->input->post('EnterpriseID'),
						'catalogo_producto_fecha_actualizacion' => $this->input->post('date'),
						'catalogo_producto_url_imagen' => $this->input->post('image'));
		$this->load->model('Dasa_model');
		if($this->Dasa_model->InsertProduct($data) == true){
			$this->Index();
			echo "<script>alert('Producto agregado correctamente. Verifique en la tabla');window.location.assign('Index') </script>";
		} else{
			echo "<script>alert('Ocurrio un error al agregar. Intente nuevamente');window.location.assign('Index') </script>";
		}
	}

}
 