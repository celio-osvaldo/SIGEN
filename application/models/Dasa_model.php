<?php		
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Dasa_model extends CI_Model
{
	public function __Construct(){
		parent::__construct();
	}

	public function GetAllProducts(){
		$this->db->select('id_catalogo_producto, catalogo_producto_nombre, catalogo_producto_umedida, catalogo_producto_precio, empresa_id_empresa, catalogo_proveedor_empresa, catalogo_producto_fecha_actualizacion');
		$this->db->from('catalogo_producto');
      	$this->db->join('catalogo_proveedor', 'catalogo_proveedor_id_catalogo_proveedor = id_catalogo_proveedor');
      	$this->db->join('empresa', 'empresa_id_empresa = id_empresa');
      	$this->db->where('empresa_id_empresa = 1');
      	$this->db->order_by('catalogo_producto_nombre', 'asc');
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

	public function AddCustomer_Project($data){
		$this->db->insert('obra_cliente',$data);
		return 1;
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
		$this-> db -> where('id_catalogo_producto', $id);#name of field o ftable to modificade
		$this-> db -> update('catalogo_producto', $data);#Name of table to update
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

	public function GetAllProviders(){
		$this->db->Where('empresa_id_empresa = 1');
		$q = $this->db->get('catalogo_proveedor');
		if($q -> num_rows() >0){
			return $q;
		}else{
			return false;
		}
	}


#end model	
}