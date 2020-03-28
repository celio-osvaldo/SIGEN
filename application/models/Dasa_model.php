<?php		
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Dasa_model extends CI_Model
{
	public function __Construct(){
		parent::__construct();
	}

	public function GetAllProducts($idcompany){
		$this->db->select('id_catalogo_producto, catalogo_producto_nombre, catalogo_producto_umedida, catalogo_producto_precio, catalogo_proveedor_empresa, catalogo_producto_fecha_actualizacion, empresa_id_empresa, unidad_medida');
		$this->db->from('catalogo_producto');
    $this->db->join('unidades_de_medida', 'id_uMedida = catalogo_producto_umedida');
    $this->db->join('catalogo_proveedor', 'catalogo_proveedor_id_catalogo_proveedor = id_catalogo_proveedor');
    $this->db->join('empresa', 'empresa_id_empresa = id_empresa');
    $this->db->where('empresa_id_empresa', $idcompany);
    $query = $this->db->get();
    if($query -> num_rows() >0){
			return $query;
		}else{
			return $query;
		}
	}

	public function IdCompany($company){
	   	$this->db->select('id_empresa');//the name of fields to query in the login
      	$this->db->from('us_empresa');#name of first table
      	$this->db->join('empresa','empresa_id_empresa=id_empresa');
      	$this->db->where('empresa_nom', $company);#the field must match the entered parameter of password
      	$query = $this->db->get();#the query is obtained and stored within the variable
      	$result = $query->row();#the result displays in a row
      	return $result;#if the query has data, returns the data query
  		}

  	public function GetAllCustomer_Project($idcompany){
  		$this->db->select('id_obra_cliente, obra_cliente_nombre, obra_cliente_imp_total, obra_cliente_saldo, obra_cliente_pagado, obra_cliente_estado, obra_cliente_comentarios');
  		$this->db->from('obra_cliente');
  		$this->db->where('empresa_id_empresa',$idcompany);
  		$query = $this->db->get();
  		return $query;			
  	}

	public function AddCustomer_Project($data){
		$this->db->insert('obra_cliente',$data);
    if ($this->db->affected_rows() > 0) {
      return 1;
    } else{
      return 2;
    }
	}

  public function Edit_CustomerProject($id,$data){
    $this->db->where('id_obra_cliente', $id);
    $this->db->update('obra_cliente', $data);
    if ($this->db->affected_rows() > 0) {
      return 1;
    } else{
      return 2;
    }
  }

	public function GetProductByID($id){
      	$this->db->where('id_catalogo_producto = ', $id);
		$q = $this->db->get('catalogo_producto');
      	if($q -> num_rows() >0){
			return $q;
		}else{
			return false;
		}
	}

	public function UpdateProduct($id, $data){
		$this->db-> where('id_catalogo_producto', $id);#name of field o ftable to modificade
		$this->db-> update('catalogo_producto', $data);#Name of table to update
		if ($this ->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}

	public function InsertProduct($data){
		$this->db->insert('catalogo_producto', $data);
		if ($this->db->affected_rows() > 0) {
			return true;
		} else{
			return false;
		}
	}

	public function GetAllMeasurements(){
		$q = $this->db->get('unidades_de_medida');
		if($q -> num_rows() >0){
			return $q;
		}else{
			return false;
		}
	}

	 public function GetAllCustomer_Payments($idcompany){
    $this->db->select('id_obra_cliente, obra_cliente_nombre, obra_cliente_imp_total, obra_cliente_pagado, obra_cliente_saldo, obra_cliente_ult_pago, obra_cliente_comentarios');
      $this->db->from('obra_cliente');
      $this->db->where('empresa_id_empresa',$idcompany);
      $this->db->where('obra_cliente_estado',1);
      $query = $this->db->get();
      return $query; 
  }

  public function AddCustomer_Pay($data){
  	$this->db->insert('venta_movimiento', $data);
  	if ($this->db->affected_rows() > 0) {
			return 1;
		} else{
			return 2;
		}

  }

  public function SumPagos_Obra($id_obra){
    $this->db->select_sum('venta_mov_monto','suma_pagos');
    $this->db->from('venta_movimiento');
    $this->db->Where('obra_cliente_id_obra_cliente',$id_obra);
    $query = $this->db->get();
    $result = $query->row();
    return $result; // Produces: SELECT SUM(age) as age FROM members
  }

  public function Total_obra($id_obra){
    $this->db->select('obra_cliente_imp_total');
    $this->db->from('obra_cliente');
    $this->db->where('id_obra_cliente',$id_obra);
    $query=$this->db->get();
    $result = $query->row();
    return $result;
  }

  public function UpdatePaysCustomer($id_obra,$data){
    $this->db->where('id_obra_cliente', $id_obra);
    $this->db->update('obra_cliente', $data);
    if ($this->db->affected_rows() > 0) {
      return 1;
    } else{
      return 2;
    }
  }

  public function Datos_obra($id_obra){
  	$this->db->select('obra_cliente_nombre, obra_cliente_imp_total, obra_cliente_pagado, obra_cliente_saldo, obra_cliente_comentarios');
  	$this->db->from('obra_cliente');
  	$this->db->Where('id_obra_cliente',$id_obra);
  	$query=$this->db->get();
  	$result=$query->row();
  	return $result;
  }

  public function GetPayments_List($id_obra){
  	$this->db->select('id_venta_mov, venta_mov_fecha, venta_mov_comentario, venta_mov_monto');
  	$this->db->from('venta_movimiento');
  	$this->db->where('obra_cliente_id_obra_cliente',$id_obra);
  	$this->db->order_by('venta_mov_fecha');
  	$result=$this->db->get();
  	return $result;
  }

  public function GetBills(){
    $this->db->select('id_gasto_venta, obra_cliente_nombre, empresa_nom, gasto_venta_fecha, gasto_venta_factura, gasto_venta_monto, gasto_venta_concepto, gasto_venta_observacion, gasto_venta_estado_pago, gasto_venta_fecha_pago');
    $this->db->from('obra_cliente');
        $this->db->join('empresa', 'empresa_id_empresa = id_empresa');
        $this->db->join('gasto_venta', 'obra_cliente_id_obra_cliente = id_obra_cliente');
        $this->db->where('empresa_nom = "DASA"');
        $query = $this->db->get();
        if($query -> num_rows() >0){
      return $query;
    }else{
      return false;
    }
  }

  function IDMAX($table, $id){
    $this->db->select_max($id);
    $q = $this->db->get($table);
    if($q->num_rows() > 0){
      return $q;
    }else{
      return $q;
    }
  }

  public function GetAllWorks_Client(){
    $q = $this->db->get('obra_cliente');
    if($q -> num_rows() >0){
      return $q;
    }else{
      return false;
    }
  }

  public function GetAllReportsOfPettyCash(){
    $cash = 1;
    $this->db->where('caja_chica_id_caja_chica', $cash);
    $q = $this->db->get('lista_caja_chica');
    if($q -> num_rows() >0){
      return $q;
    }else{
      return $q;
    }
  }

  public function UpdateProject_Pay($data,$id){
    $this->db->where('id_venta_mov', $id);
    $this->db->update('venta_movimiento', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Id_Proyecto($id_movimiento){
    $this->db->select('obra_cliente_id_obra_cliente');
    $this->db->from('venta_movimiento');
    $this->db->where('id_venta_mov',$id_movimiento);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function GetAll_Provider($idcompany){
    $this->db->select('id_catalogo_proveedor, catalogo_proveedor_nom_fiscal, catalogo_proveedor_empresa, rfc, catalogo_proveedor_contacto1, catalogo_proveedor_contacto2, catalogo_proveedor_puesto1, catalogo_proveedor_puesto2, catalogo_proveedor_tel1, catalogo_proveedor_tel2, catalogo_proveedor_cel1, catalogo_proveedor_cel2, catalogo_proveedor_email1, catalogo_proveedor_email2, catalogo_proveedor_coment');
    $this->db->from('catalogo_proveedor');
    $this->db->where('empresa_id_empresa', $idcompany);
    $result=$this->db->get();
    return $result;
  }

  public function Update_Provider($id_prov,$data){
    $this->db->where('id_catalogo_proveedor', $id_prov);
    $this->db->update('catalogo_proveedor', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

    public function New_Provider($data){
    $this->db->insert('catalogo_proveedor', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function GetAll_Customer($idcompany){
    $this->db->select('id_catalogo_cliente, catalogo_cliente_nom_fiscal, catalogo_cliente_empresa, catalogo_cliente_rfc, catalogo_cliente_contacto1, catalogo_cliente_contacto2, catalogo_cliente_puesto1, catalogo_cliente_puesto2, catalogo_cliente_tel1, catalogo_cliente_tel2, catalogo_cliente_cel1, catalogo_cliente_cel2, catalogo_cliente_email1, catalogo_cliente_email2, catalogo_cliente_coment');
    $this->db->from('catalogo_cliente');
    $this->db->where('empresa_id_empresa', $idcompany);
    $result=$this->db->get();
    return $result;
  }

    public function Update_Customer($id_cust,$data){
    $this->db->where('id_catalogo_cliente', $id_cust);
    $this->db->update('catalogo_cliente', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

      public function New_Customer($data){
    $this->db->insert('catalogo_cliente', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }
  

}