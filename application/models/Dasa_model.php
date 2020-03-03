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
      	$this->db->where('empresa_id_empresa = 2');
      	$this->db->order_by('catalogo_producto_nombre', 'asc');
      	$query = $this->db->get();
      	if($query -> num_rows() >0){
			return $query;
		}else{
			return $query;
		}
	}
}