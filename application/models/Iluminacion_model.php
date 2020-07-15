<?php		
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Iluminacion_model extends CI_Model
{

	public function __Construct(){
		parent::__construct();
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

  public function GetAllMeasurements(){
    $q = $this->db->get('unidades_de_medida');
    if($q -> num_rows() >0){
      return $q;
    }else{
      return false;
    }
  }

  public function GetInventorie_Products($idcompany){
    $this->db->select('id_prod_alm, prod_alm_nom, unidad_medida, prod_alm_modelo, prod_alm_prec_unit, prod_alm_precio_venta, prod_alm_exist, prod_alm_codigo, prod_alm_descripcion, prod_alm_coment');
    $this->db->from('producto_almacen');
    $this->db->join('unidades_de_medida','prod_alm_medida=id_uMedida');
    $this->db->where('empresa_id_empresa',$idcompany);
    $result=$this->db->get();
    return $result;
  }

  public function Edit_Product($id_prod,$data){
    $this->db->where('id_prod_alm',$id_prod);
    $this->db->update('producto_almacen', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function New_Product($data){
    $this->db->insert('producto_almacen', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function GetInventorie_Office($idcompany){
      	$this->db->select('id_prod, producto_consu_nom, unidad_medida, producto_consu_prec_unit, producto_consu_exist, producto_consu_ult_compra, producto_consu_periodicidad, producto_consu_prox_compra, catalogo_proveedor_empresa');
      	$this->db->from('producto_consumible');
      	$this->db->join('unidades_de_medida','producto_consu_medida=id_uMedida');
      	$this->db->join('catalogo_proveedor','producto_consu_ult_proveedor=id_catalogo_proveedor');
      	$this->db->where('producto_consumible.empresa_id_empresa',$idcompany);
      	$result=$this->db->get();
      	return $result;
  }

  public function GetAll_Provider($idcompany){
      	$this->db->select('id_catalogo_proveedor, catalogo_proveedor_nom_fiscal, catalogo_proveedor_empresa, rfc, catalogo_proveedor_contacto1, catalogo_proveedor_contacto2, catalogo_proveedor_puesto1, catalogo_proveedor_puesto2, catalogo_proveedor_tel1, catalogo_proveedor_tel2, catalogo_proveedor_cel1, catalogo_proveedor_cel2, catalogo_proveedor_email1, catalogo_proveedor_email2, catalogo_proveedor_coment');
      	$this->db->from('catalogo_proveedor');
      	$this->db->where('empresa_id_empresa', $idcompany);
      	$result=$this->db->get();
      	return $result;
  }

  public function   Update_Consumible($id, $data){
      	$this->db->where('id_prod', $id);
      	$this->db->update('producto_consumible', $data);
      	if ($this->db->affected_rows() > 0) {
      		return true;
      	} else{
      		return false;
      	}
  }

  public function New_Consumible($data){
      	$this->db->insert('producto_consumible', $data);
      	if ($this->db->affected_rows() > 0) {
      		return true;
      	} else{
      		return false;
      	}
  }


  public function GetAllCustomer_Project($idcompany){
  		$this->db->select('id_obra_cliente, obra_cliente_nombre,catalogo_cliente_empresa, obra_cliente_imp_total, obra_cliente_saldo, obra_cliente_pagado, obra_cliente_estado, obra_cliente_comentarios');
  		$this->db->from('obra_cliente');
      $this->db->join('catalogo_cliente','obra_cliente_id_cliente=id_catalogo_cliente');
  		$this->db->where('obra_cliente.empresa_id_empresa',$idcompany);
  		$query = $this->db->get();
  		return $query;			
  }

  public function Get_Customer_List($idcompany){
      $this->db->select('id_catalogo_cliente,catalogo_cliente_empresa');
      $this->db->from('catalogo_cliente');
      $this->db->where('empresa_id_empresa',$idcompany);
      $query=$this->db->get();
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

  public function SumPagos_Obra($id_obra){
    $this->db->select_sum('venta_mov_monto','suma_pagos');
    $this->db->from('venta_movimiento');
    $this->db->Where('obra_cliente_id_obra_cliente',$id_obra);
    $query = $this->db->get();
    $result = $query->row();
    return $result; 
  }

  public function Edit_CustomerProject($id,$data){
    $this->db->where('id_obra_cliente', $id);
    $this->db->update('obra_cliente', $data);
    if ($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 2;
    }
  }

	 public function GetAllCustomer_Payments($idcompany){
    $this->db->select('id_obra_cliente, obra_cliente_nombre,catalogo_cliente_empresa, obra_cliente_imp_total, obra_cliente_pagado, obra_cliente_saldo, obra_cliente_ult_pago, obra_cliente_comentarios');
      $this->db->from('obra_cliente');
      $this->db->join('catalogo_cliente','obra_cliente_id_cliente=id_catalogo_cliente');
      $this->db->where('obra_cliente.empresa_id_empresa',$idcompany);
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

  public function Total_obra($id_obra){
    $this->db->select('obra_cliente_imp_total');
    $this->db->from('obra_cliente');
    $this->db->where('id_obra_cliente',$id_obra);
    $query=$this->db->get();
    $result = $query->row();
    return $result;
  }

  public function Fecha_Ult_Pago($new_id_obra){
    $this->db->select_max('venta_mov_fecha');
    $this->db->from('venta_movimiento');
    $this->db->where('obra_cliente_id_obra_cliente',$new_id_obra);
    $query=$this->db->get();
    $result=$query->row();
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

	public function GetAllProducts($idcompany){
    $this->db->select('id_catalogo_producto, catalogo_producto_nombre, catalogo_producto_umedida, catalogo_producto_precio, catalogo_proveedor_empresa, catalogo_producto_fecha_actualizacion, empresa_id_empresa, unidad_medida, catalogo_proveedor_empresa_id_empresa, catalogo_producto_url_imagen');
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

  public function UpdateProduct($id, $data){
      $this->db->where('id_catalogo_producto', $id);
      $this->db->update('catalogo_producto', $data);
      if ($this->db->affected_rows() > 0) {
        return true;
      } else{
        return false;
      }
  }

  // this function can insert in any table of bd specifying th ename of table as parameter
  public function Insert($table, $data){
    $this->db->insert($table, $data);
    if ($this->db->affected_rows() > 0) {
       $id=$this->db->insert_id();
      return $id;
    } else{
      return false;
    }
  }

  public function Update_Viatic($id_viatico,$datos_suma){
    $this->db->where('id_viaticos', $id_viatico);
    $this->db->update('viaticos', $datos_suma);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function UpdateViaticList($id_lista_viatico, $data2){
    $this->db->where('id_lista_viatico', $id_lista_viatico);
    $this->db->update('lista_viatico', $data2);
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
    $this->db->order_by('catalogo_cliente_empresa', 'ASC');
    $result=$this->db->get();
    return $result;
  }

  public function GetAll_Cotizante($idcompany){
    $this->db->select('id_catalogo_cotizante, id_empresa, catalogo_cotizante_nombre, catalogo_cotizante_empresa, catalogo_cotizante_coment, catalogo_cotizante_tel, catalogo_cotizante_mail');
    $this->db->from('catalogo_cotizante');
    $this->db->where('id_empresa', $idcompany);
    $this->db->order_by('catalogo_cotizante_nombre', 'ASC');
    $result=$this->db->get();
    return $result;
  }
  
  public function GetAll_Anticipos(){
    $this->db->select('id_anticipo, obra_cliente_id_obra_cliente, catalogo_cliente_empresa, anticipo_fecha_deposito, anticipo_total, anticipo_pago, anticipo_resto, anticipo_status, anticipo_fecha_finiquito, anticipo_fecha_entrega, anticipo_coment');
    $this->db->from('anticipo');
    $this->db->join('catalogo_cliente', 'obra_cliente_id_obra_cliente=id_catalogo_cliente');
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

  public function New_Anticipo($data){
    $this->db->insert('anticipo',$data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }
  
  public function Update_Anticipo($data,$id_anticipo){
    $this->db->where('id_anticipo', $id_anticipo);
    $this->db->update('anticipo', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Add_Anticipo_product($data){
    $this->db->insert('prod_anticipo',$data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_Total_Anticipo($id_anticipo){
    $this->db->select_sum('(prod_anticipo_cantidad) * (prod_anticipo_precio_venta)','total');
    $this->db->from('prod_anticipo');
    $this->db->where('anticipo_id_anticipo',$id_anticipo);
     $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_Pagado_Anticipo($id_anticipo){
    $this->db->select('anticipo_pago');
    $this->db->from('anticipo');
    $this->db->where('id_anticipo',$id_anticipo);
     $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_Inventorie_Product($id_producto){
    $this->db->select('prod_alm_exist');
    $this->db->from('producto_almacen');
    $this->db->where('id_prod_alm',$id_producto);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Actualiza_producto($id_producto,$data){
    $this->db->where('id_prod_alm', $id_producto);
    $this->db->update('producto_almacen', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_Anticipo_Product_List($id_anticipo){
    $this->db->select('id_prod_anticipo, anticipo_id_anticipo, producto_almacen_id_prod_alm, prod_alm_nom, prod_anticipo_cantidad, prod_anticipo_precio_venta, prod_anticipo_coment');
    $this->db->from('prod_anticipo');
    $this->db->join('producto_almacen','producto_almacen_id_prod_alm=id_prod_alm');
    $this->db->where('anticipo_id_anticipo', $id_anticipo);
    $result=$this->db->get();
    return $result;
  }

  public function Get_Anticipo_Info($id_anticipo){
    $this->db->select('id_anticipo, obra_cliente_id_obra_cliente, catalogo_cliente_empresa, anticipo_fecha_deposito, anticipo_total, anticipo_pago, anticipo_resto, anticipo_status, anticipo_fecha_finiquito, anticipo_fecha_entrega, anticipo_coment');
    $this->db->from('anticipo');
    $this->db->join('catalogo_cliente','obra_cliente_id_obra_cliente=id_catalogo_cliente');
    $this->db->where('id_anticipo', $id_anticipo);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Update_Prod_Anticipo($data,$id_prod_ant){
    $this->db->where('id_prod_anticipo', $id_prod_ant);
    $this->db->update('prod_anticipo', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Delete_Product_Ant($id_prod_ant){
    $this->db->where('id_prod_anticipo', $id_prod_ant);
    $this->db->delete('prod_anticipo');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function AddPay_Anticipo($data){
    $this->db->insert('pagos_anticipo',$data);
    if ($this->db->affected_rows() > 0) {
      $id=$this->db->insert_id();
      return $id;
    } else{
      return false;
    }
  }

  public function UpdatePay_Anticipo($data,$id_pagos_anticipo){
    $this->db->where('id_pagos_anticipo', $id_pagos_anticipo);
    $this->db->update('pagos_anticipo', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_Fecha_pago($id_anticipo){
    $this->db->select_max('pagos_anticipo_fecha');
    $this->db->from('pagos_anticipo');
    $this->db->where('id_anticipo',$id_anticipo);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_Pagos($id_anticipo){
    $this->db->select_sum('pagos_anticipo_cantidad','total_pagos');
    $this->db->from('pagos_anticipo');
    $this->db->where('id_anticipo',$id_anticipo);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_Anticipo_Pay_List($id_anticipo){
    $this->db->select('id_pagos_anticipo, id_anticipo, pagos_anticipo_fecha, pagos_anticipo_cantidad, pagos_anticipo_coment, pagos_anticipo_url_comprobante');
    $this->db->from('pagos_anticipo');
    $this->db->where('id_anticipo',$id_anticipo);
    $result=$this->db->get();
    return $result;
  }

  public function Get_url_comprobante_Pago($id_pagos_anticipo){
     $this->db->select('pagos_anticipo_url_comprobante');
    $this->db->from('pagos_anticipo');
    $this->db->where('id_pagos_anticipo',$id_pagos_anticipo);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Delete_Pay_anticipo($id_pagos_anticipo){
    $this->db->where('id_pagos_anticipo', $id_pagos_anticipo);
    $this->db->delete('pagos_anticipo');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function GetAll_Pagos_SFV($id_empresa){
    $this->db->select('id_pago_sfv, pago_sfv_id_cliente, catalogo_cliente_empresa, (select count(id_lista_pago_sfv) from lista_pago_sfv where pago_sfv_id_pago_sfv=id_pago_sfv)as pagos_realizados, pago_sfv_id_empresa, pago_sfv_kwh, pago_sfv_estado, pago_sfv_cant_pagos, pago_sfv_fecha_ult_pago, pago_sfv_coment, pago_sfv_pagado, pago_sfv_saldo, pago_sfv_imp_total');
    $this->db->from('pago_sfv');
    $this->db->join('catalogo_cliente','pago_sfv_id_cliente=id_catalogo_cliente');
    $this->db->where('pago_sfv_id_empresa',$id_empresa);
    $result=$this->db->get();
    return $result;
  }

  public function New_SFV($data){
       $this->db->insert('pago_sfv',$data);
      if ($this->db->affected_rows() > 0) {
        return true;
        } else{
        return false;
        }
  }

  public function AddPay_SFV($data){
     $this->db->insert('lista_pago_sfv',$data);
      if ($this->db->affected_rows() > 0) {
      $id=$this->db->insert_id();
      return $id;
    } else{
      return false;
    }
  }

  public function Get_Total_Pagos_SFV($id_pago_sfv){
    $this->db->select_sum('lista_pago_sfv_total','total_pagos');
    $this->db->from('lista_pago_sfv');
    $this->db->where('pago_sfv_id_pago_sfv',$id_pago_sfv);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_last_pago_SFV($id_pago_sfv){
    $this->db->select_max('lista_pago_sfv_fecha');
    $this->db->from('lista_pago_sfv');
    $this->db->where('pago_sfv_id_pago_sfv',$id_pago_sfv );
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Update_SFV($data2,$id_pago_sfv){
    $this->db->where('id_pago_sfv', $id_pago_sfv);
    $this->db->update('pago_sfv', $data2);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function UpdatePay_SFV($data,$id_lista_pago_sfv){
    $this->db->where('id_lista_pago_sfv', $id_lista_pago_sfv);
    $this->db->update('lista_pago_sfv', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_SFV_Pay_List($id_pago_sfv){
    $this->db->select('id_lista_pago_sfv, pago_sfv_id_pago_sfv, lista_pago_sfv_num_pago, lista_pago_sfv_fecha, lista_pago_sfv_sub_total, lista_pago_sfv_iva, lista_pago_sfv_total, lista_pago_sfv_kwh_factu, lista_pago_sfv_saldo, lista_pago_sfv_coment, lista_pago_sfv_url_comprobante');
    $this->db->from('lista_pago_sfv');
    $this->db->where('pago_sfv_id_pago_sfv',$id_pago_sfv);
    $result=$this->db->get();
    return $result;
  }

  public function Get_SFV_info($id_pago_sfv){
    $this->db->select('id_pago_sfv, pago_sfv_id_cliente, catalogo_cliente_empresa, (select count(id_lista_pago_sfv) from lista_pago_sfv where pago_sfv_id_pago_sfv=id_pago_sfv)as pagos_realizados, pago_sfv_id_empresa, pago_sfv_kwh, pago_sfv_estado, pago_sfv_cant_pagos, pago_sfv_fecha_ult_pago, pago_sfv_coment, pago_sfv_pagado, pago_sfv_saldo, pago_sfv_imp_total');
    $this->db->from('pago_sfv');
    $this->db->join('catalogo_cliente','pago_sfv_id_cliente=id_catalogo_cliente');
    $this->db->where('id_pago_sfv',$id_pago_sfv);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Delete_Pay_sfv($id_lista_pago_sfv){
     $this->db->where('id_lista_pago_sfv', $id_lista_pago_sfv);
    $this->db->delete('lista_pago_sfv');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_url_comprobante_SFV($id_lista_pago_sfv){
    $this->db->select('lista_pago_sfv_url_comprobante');
    $this->db->from('lista_pago_sfv');
    $this->db->where('id_lista_pago_sfv',$id_lista_pago_sfv);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }


  public function GetCotizaciones_List($idcomp){
    $this->db->select('id_cotizacion, cotizacion_id_empresa, cotizacion_folio, catalogo_cliente_empresa, cotizacion_fecha, cotizacion_id_cliente, cotizacion_obra, cotizacion_total, cotizacion_iva, cotizacion_subtotal, cotizacion_comentario, cotizacion_tiempo_entrega, cotizacion_vigencia, cotizacion_elabora, cotizacion_estado, cotizacion_empresa, cotizacion_licitacion');
    $this->db->from('cotizacion');
    $this->db->join('empresa','cotizacion_id_empresa=id_empresa');
    $this->db->join('catalogo_cliente','cotizacion_id_cliente=id_catalogo_cliente');
    $this->db->where('cotizacion_id_empresa',$idcomp);
    $result=$this->db->get();
    return $result;
  }

  public function New_Cotizacion($data){
    $this->db->insert('cotizacion',$data);
      if ($this->db->affected_rows() > 0) {
        return true;
        } else{
        return false;
        }
  }

  public function Update_Cotizacion($id_cotizacion,$data){
    $this->db->where('id_cotizacion', $id_cotizacion);
    $this->db->update('cotizacion', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Add_Cotizacion_product($data){
    $this->db->insert('lista_cotizacion',$data);
      if ($this->db->affected_rows() > 0) {
        return true;
        } else{
        return false;
        }
  }

  public function Get_Importe_Cotizaciones($prod_id_cotizacion){
    $this->db->select_sum('lista_cotizacion_importe','importe_total');
    $this->db->from('lista_cotizacion');
    $this->db->where('lista_cotizacion_id_cotizacion',$prod_id_cotizacion);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function GetCotizacion_Info($id_cotizacion){
    $this->db->select('id_cotizacion, cotizacion_id_empresa, cotizacion_folio, cotizacion_fecha, cotizacion_id_cliente, catalogo_cliente_empresa, cotizacion_obra, cotizacion_total, cotizacion_iva, cotizacion_subtotal, cotizacion_tiempo_entrega, cotizacion_vigencia, cotizacion_elabora, cotizacion_estado, cotizacion_empresa, cotizacion_licitacion');
    $this->db->from('cotizacion');
    $this->db->join('catalogo_cliente','cotizacion_id_cliente=id_catalogo_cliente');
    $this->db->where('id_cotizacion',$id_cotizacion);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function GetCotizacion_Products($id_cotizacion){
    $this->db->select('id_lista_cotizacion, lista_cotizacion_id_cotizacion, lista_cotizacion_id_prod_alm, prod_alm_nom,  prod_alm_modelo,  prod_alm_descripcion, lista_cotizacion_cantidad, lista_cotizacion_precio_unit, lista_cotizacion_descuento, lista_cotizacion_importe');
    $this->db->from('lista_cotizacion');
    $this->db->join('producto_almacen','lista_cotizacion_id_prod_alm=id_prod_alm ');
    $this->db->where('lista_cotizacion_id_cotizacion',$id_cotizacion);
    $result=$this->db->get();
    return $result;
  }

  public function Update_Cotizacion_product($prod_id_cotizacion,$data){
    $this->db->where('id_lista_cotizacion', $prod_id_cotizacion);
    $this->db->update('lista_cotizacion', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Delete_Cotizacion_product($id_lista_cotizacion){
    $this->db->where('id_lista_cotizacion', $id_lista_cotizacion);
    $this->db->delete('lista_cotizacion');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_List_Recibo_entrega($id_empresa){
     $this->db->select('id_recibo_entrega, id_empresa, recibo_entrega_folio, recibo_entrega_id_cliente, catalogo_cliente_empresa, catalogo_cliente_contacto1, recibo_entrega_domicilio, recibo_entrega_origen, recibo_entrega_id_origen, recibo_entrega_fecha, recibo_entrega_estado');
    $this->db->from('recibo_entrega');
    $this->db->join('catalogo_cliente','recibo_entrega_id_cliente=id_catalogo_cliente ');
    $this->db->where('id_empresa',$id_empresa);
    $result=$this->db->get();
    return $result;
  }

  public function GetAll_Anticipos_activo(){
    $this->db->select('id_anticipo, obra_cliente_id_obra_cliente, catalogo_cliente_empresa, anticipo_fecha_deposito, anticipo_total, anticipo_pago, anticipo_resto, anticipo_status, anticipo_fecha_finiquito, anticipo_fecha_entrega, anticipo_coment');
    $this->db->from('anticipo');
    $this->db->join('catalogo_cliente', 'obra_cliente_id_obra_cliente=id_catalogo_cliente');
    $this->db->where('anticipo_status','Activo');
    $result=$this->db->get();
    return $result;
  }

  public function Get_Id_Cliente_anticipo($anticipo){
    $this->db->select('obra_cliente_id_obra_cliente');
    $this->db->from('anticipo');
    $this->db->where('id_anticipo',$anticipo);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_Id_Cliente_cotizacion($cotizacion){
    $this->db->select('cotizacion_id_cliente');
    $this->db->from('cotizacion');
    $this->db->where('id_cotizacion',$cotizacion);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Add_Recibo_Entrega($data){
    $this->db->insert('recibo_entrega',$data);
    if ($this->db->affected_rows() > 0) {
      $id=$this->db->insert_id();
      return $id;
    } else{
      return false;
    }
  }

  public function Add_Product_Recibo_Entrega($productos){
    $this->db->insert('lista_recibo_entrega',$productos);
      if ($this->db->affected_rows() > 0) {
        return true;
        } else{
        return false;
        }
  }

  public function Update_Recibo_Entrega($id_recibo_entrega,$data){
    $this->db->where('id_recibo_entrega', $id_recibo_entrega);
    $this->db->update('recibo_entrega', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function GetRecibo_Info($id_recibo_entrega){
    $this->db->select('id_recibo_entrega,catalogo_cliente_empresa, id_empresa, recibo_entrega_folio, recibo_entrega_id_cliente, recibo_entrega_domicilio, recibo_entrega_origen, recibo_entrega_id_origen, recibo_entrega_fecha, recibo_entrega_estado');
    $this->db->from('recibo_entrega');
    $this->db->join('catalogo_cliente','recibo_entrega_id_cliente=id_catalogo_cliente');
    $this->db->where('id_recibo_entrega',$id_recibo_entrega);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function GetRecibo_Products($id_recibo_entrega){
    $this->db->select('id_lista_recibo_entrega, lista_recibo_entrega_id_recibo_entrega, lista_recibo_entrega_cantidad, producto_almacen_id_prod_alm, prod_alm_descripcion, prod_alm_modelo, prod_alm_nom');
    $this->db->from('lista_recibo_entrega');
    $this->db->join('producto_almacen','producto_almacen_id_prod_alm=id_prod_alm');
    $this->db->where('lista_recibo_entrega_id_recibo_entrega',$id_recibo_entrega);
    $result=$this->db->get();
    return $result;
  }

  public function Delete_Product_Recibo($id_lista_recibo_entrega){
    $this->db->where('id_lista_recibo_entrega', $id_lista_recibo_entrega);
    $this->db->delete('lista_recibo_entrega');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Return_Product_Almacen($id_producto,$data){
    $this->db->where('id_prod_alm', $id_producto);
    $this->db->update('producto_almacen', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Delete_Lista_Recibo_Entrega($id_recibo_entrega){
    $this->db->where('lista_recibo_entrega_id_recibo_entrega', $id_recibo_entrega);
    $this->db->delete('lista_recibo_entrega');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Delete_Recibo_Entrega($id_recibo_entrega){
    $this->db->where('id_recibo_entrega', $id_recibo_entrega);
    $this->db->delete('recibo_entrega');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Update_Product_Recibo($id_lista_recibo_entrega,$data){
    $this->db->where('id_lista_recibo_entrega', $id_lista_recibo_entrega);
    $this->db->update('lista_recibo_entrega', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function GetAllCostOfSale($idcompany){
    $this->db->select('id_gasto_venta, obra_cliente_nombre, empresa_id_empresa, gasto_venta_fecha, gasto_venta_factura, gasto_venta_monto, gasto_venta_concepto, gasto_venta_observacion, gasto_venta_estado_pago, gasto_venta_fecha_pago, gasto_venta_url_factura');
    $this->db->from('obra_cliente');
    $this->db->join('empresa', 'empresa_id_empresa = id_empresa');
    $this->db->join('gasto_venta', 'obra_cliente_id_obra_cliente = id_obra_cliente');
    $this->db->where('empresa_id_empresa', $idcompany);
    $query = $this->db->get();
    return $query;
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

  public function GetAllWorks_Client($IdCompany){
    $this->db->where('empresa_id_empresa', $IdCompany);
    $q = $this->db->get('obra_cliente');
    if($q -> num_rows() >0){
      return $q;
    }else{
      return false;
    }
  }

  public function GetAllReportsOfPettyCash($id_empresa){

    $this->db->where('empresa_id_empresa', $id_empresa);
    $q = $this->db->get('lista_caja_chica');
    return $q;
  }

  public function Update_Caja_Chica($id_caja_chica, $data2){
    $this->db->where('id_lista_caja_chica', $id_caja_chica);
    $this->db->update('lista_caja_chica', $data2);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }


  public function GetPettyCashById($id_caja_chica){
    $this->db->select('id_caja_chica, empresa_id_empresa, caja_chica_total, caja_chica_saldo, caja_chica_mes');
    $this->db->from('caja_chica');
    $this->db->join('empresa', 'id_empresa = empresa_id_empresa');
    $this->db->where('id_caja_chica', $id_caja_chica);
    $result=$this->db->get();
    return $result;
  }

  public function ExpenceSum($id_caja_chica){
    $this->db->select_sum('lista_caja_chica_gasto','sumPayment');
    $this->db->from('lista_caja_chica');
    $this->db->where('caja_chica_id_caja_chica', $id_caja_chica);
    $query = $this->db->get();
    $result = $query->row();
    return $result; 
  }

  public function GetDetailsOfPettyCash($id_viatico){
    $this->db->select('id_lista_caja_chica, caja_chica_id_caja_chica, lista_caja_chica_fecha, lista_caja_chica_concepto, lista_caja_chica_reposicion, lista_caja_chica_gasto, lista_caja_chica_factura, lista_caja_chica_fecha_factura');
    $this->db->from('lista_caja_chica');
    $this->db->join('caja_chica', 'caja_chica_id_caja_chica = id_caja_chica');
    $this->db->join('empresa', 'empresa_id_empresa = id_empresa');
    $this->db->where('id_caja_chica', $id_viatico);
    $q = $this->db->get();
    return $q;
  }

  public function GetOthersExpens($idcompany){
    $this->db->where('empresa_id_empresa', $idcompany);
    $q = $this->db->get('otros_gastos');
    return $q;
  }

  public function UpdateExpendInfo($id, $data){
    $this->db->where('id_OGasto', $id);
    $this->db->update('otros_gastos', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function GetAllViaticsReports($idcompany){
    $this->db->select('id_viaticos, empresa_id_empresa, viaticos_fecha, viaticos_total_dias, viaticos_fecha_ini, viaticos_fecha_fin, viaticos_total, obra_cliente_nombre');
    $this->db->from('viaticos');
    $this->db->join('obra_cliente', 'obra_cliente_id_obra_cliente = id_obra_cliente');
    $this->db->join('empresa', 'empresa_id_empresa = id_empresa');
    $this->db->where('empresa_id_empresa', $idcompany);
    $result=$this->db->get();
    return $result;
  }

  public function ViaticPaymentsSum($id_viatico){
    $this->db->select_sum('lista_viatico_importe','sumPayment');
    $this->db->from('lista_viatico');
    $this->db->where('viaticos_id_viaticos', $id_viatico);
    $query = $this->db->get();
    $result = $query->row();
    return $result; 
  }

  public function UpdateViaticBalance($id, $total){
    $this->db->where('id_viaticos', $id);
    $this->db->set('viaticos_total', $total);
    $this->db->update('viaticos');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function GetViaticsById($id_viatico){
    $this->db->select('id_viaticos, empresa_id_empresa, viaticos_fecha, viaticos_total_dias, viaticos_fecha_ini, viaticos_fecha_fin, viaticos_total, obra_cliente_nombre');
    $this->db->from('viaticos');
    $this->db->join('obra_cliente', 'obra_cliente_id_obra_cliente = id_obra_cliente');
    $this->db->join('empresa', 'empresa_id_empresa = id_empresa');
    $this->db->where('id_viaticos', $id_viatico);
    $result=$this->db->get();
    return $result;
  }

  public function GetDetailsOfViatics($id_viatico){
    $this->db->select('id_viaticos, id_lista_viatico, lista_viatico_fecha, lista_viatico_concepto, lista_viatico_importe, lista_viatico_comprobante, lista_viatico_factura, empleado, lista_viatico_url_comprobante');
    $this->db->from('lista_viatico');
    $this->db->join('viaticos', 'id_viaticos = viaticos_id_viaticos');
    $this->db->join('obra_cliente', 'obra_cliente_id_obra_cliente = id_obra_cliente');
    $this->db->join('empresa', 'empresa_id_empresa = id_empresa');
    $this->db->where('id_viaticos', $id_viatico);
    $q = $this->db->get();
    return $q;
  }

  public function Get_sal_ban_ant($idcompany,$anio_ant,$mes_ant){
    $this->db->select('flujo_efectivo_saldo_fin');
    $this->db->from('flujo_efectivo');
    $this->db->where('empresa_id_empresa',$idcompany);
    $this->db->where('flujo_efectivo_mes',$mes_ant);
    $this->db->where('flujo_efectivo_anio',$anio_ant);
     $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_Ingresos_Pagos($idcompany,$anio,$mes){
    $this->db->select('id_venta_mov, venta_mov_fecha, venta_mov_comentario, venta_mov_factura, venta_mov_monto, obra_cliente_nombre, obra_cliente_empresa_id_empresa, venta_movimiento_url_factura, catalogo_cliente_empresa,venta_mov_referencia');
    $this->db->from('venta_movimiento');
    $this->db->join('obra_cliente','obra_cliente_id_obra_cliente=id_obra_cliente');
    $this->db->join('catalogo_cliente','obra_cliente_id_cliente=id_catalogo_cliente');
    $this->db->where('MONTH(venta_mov_fecha)',$mes);
    $this->db->where('YEAR(venta_mov_fecha)',$anio);
    $this->db->where('obra_cliente_empresa_id_empresa',$idcompany);
    $this->db->order_by('venta_mov_fecha');
    $result = $this->db->get();
    return $result;
  }

  public function Get_Ingresos_Anticipos($anio,$mes){
    $this->db->select('id_pagos_anticipo, anticipo.id_anticipo, pagos_anticipo_fecha, pagos_anticipo_cantidad, pagos_anticipo_coment, pagos_anticipo_url_comprobante, catalogo_cliente_empresa');
    $this->db->from('pagos_anticipo');
    $this->db->join('anticipo','anticipo.id_anticipo=pagos_anticipo.id_anticipo');
    $this->db->join('catalogo_cliente','obra_cliente_id_obra_cliente=id_catalogo_cliente');
    $this->db->where('MONTH(pagos_anticipo_fecha)',$mes);
    $this->db->where('YEAR(pagos_anticipo_fecha)',$anio);
    $this->db->order_by('pagos_anticipo_fecha');
    $result = $this->db->get();
    return $result;
  }

  public function Get_Ingresos_SFV($idcompany,$anio,$mes){
    $this->db->select('id_lista_pago_sfv, pago_sfv_id_pago_sfv, lista_pago_sfv_num_pago, lista_pago_sfv_fecha, lista_pago_sfv_sub_total, lista_pago_sfv_iva, lista_pago_sfv_total, lista_pago_sfv_kwh_factu, lista_pago_sfv_saldo, lista_pago_sfv_coment, lista_pago_sfv_url_comprobante, catalogo_cliente_empresa, lista_pago_sfv_referencia');
    $this->db->from('lista_pago_sfv');
    $this->db->join('pago_sfv','pago_sfv_id_pago_sfv=id_pago_sfv');
    $this->db->join('catalogo_cliente','pago_sfv_id_cliente=id_catalogo_cliente');
    $this->db->where('MONTH(lista_pago_sfv_fecha)',$mes);
    $this->db->where('YEAR(lista_pago_sfv_fecha)',$anio);
    $this->db->where('pago_sfv_id_empresa',$idcompany);
    $this->db->order_by('lista_pago_sfv_fecha');
    $result = $this->db->get();
    return $result;
  }

    public function Get_Egresos_Gasto_Venta($idcompany,$anio,$mes){
    $this->db->select('id_gasto_venta, obra_cliente_id_obra_cliente, obra_cliente_empresa_id_empresa, gasto_venta_fecha, gasto_venta_factura, gasto_venta_monto, gasto_venta_concepto, gasto_venta_observacion, gasto_venta_estado_pago, gasto_venta_fecha_pago, obra_cliente_nombre, gasto_venta_referencia, gasto_venta_iva_ret, gasto_venta_isr_ret, gasto_venta_ieps, gasto_venta_dap');
    $this->db->from('gasto_venta');
    $this->db->join('obra_cliente','obra_cliente_id_obra_cliente=id_obra_cliente');
    $this->db->where('MONTH(gasto_venta_fecha)',$mes);
    $this->db->where('YEAR(gasto_venta_fecha)',$anio);
    $this->db->where('obra_cliente_empresa_id_empresa',$idcompany);
    $this->db->order_by('gasto_venta_fecha');
    $result = $this->db->get();
    return $result;
  }

    public function Get_Egresos_Caja_Chica($idcompany,$anio,$mes){
    $this->db->select('id_lista_caja_chica, empresa_id_empresa, lista_caja_chica_fecha, lista_caja_chica_concepto, lista_caja_chica_reposicion, lista_caja_chica_gasto, lista_caja_chica_factura, lista_caja_chica_fecha_factura, lista_caja_chica_url_factura, lista_caja_chica_saldo, lista_caja_chica_referencia, lista_caja_chica_iva_ret, lista_caja_chica_isr_ret, lista_caja_chica_ieps, lista_caja_chica_dap');
    //$this->db->select_sum('venta_mov_monto','total_ingreso');
    $this->db->from('lista_caja_chica');
    //$this->db->join('caja_chica','caja_chica_id_caja_chica=id_caja_chica');
    $this->db->where('MONTH(lista_caja_chica_fecha)',$mes);
    $this->db->where('YEAR(lista_caja_chica_fecha)',$anio);
    $this->db->where('empresa_id_empresa',$idcompany);
    $this->db->order_by('lista_caja_chica_fecha');
    $result = $this->db->get();
    return $result;
  }

    public function Get_Egresos_Gasto_Viatico($idcompany,$anio,$mes){
    $this->db->select('id_lista_viatico, viaticos_id_viaticos, lista_viatico_fecha, empleado, lista_viatico_concepto, lista_viatico_importe, lista_viatico_comprobante, lista_viatico_factura, obra_cliente_empresa_id_empresa, obra_cliente_nombre, lista_viatico_referencia, lista_viatico_iva_ret, lista_viatico_isr_ret, lista_viatico_ieps, lista_viatico_dap');
    $this->db->from('lista_viatico');
    $this->db->join('viaticos','viaticos_id_viaticos=id_viaticos');
    $this->db->join('obra_cliente','obra_cliente_id_obra_cliente=id_obra_cliente');
    $this->db->where('MONTH(viaticos_fecha)',$mes);
    $this->db->where('YEAR(viaticos_fecha)',$anio);
    $this->db->where('obra_cliente_empresa_id_empresa',$idcompany);
    $this->db->order_by('viaticos_fecha');
    $result = $this->db->get();
    return $result;
  }

  public function Get_Egregos_Otros_Gastos($idcompany,$anio,$mes){
     $this->db->select('`id_OGasto, empresa_id_empresa, fecha_emision, concepto, saldo, comentario, folio, factura, fecha_pago_factura, otros_gastos_referencia, otros_gastos_iva_ret, otros_gastos_isr_ret, otros_gastos_ieps, otros_gastos_dap');
    $this->db->from('otros_gastos');
    $this->db->join('empresa','empresa_id_empresa=id_empresa');
    $this->db->where('MONTH(fecha_pago_factura)',$mes);
    $this->db->where('YEAR(fecha_pago_factura)',$anio);
    $this->db->where('empresa_id_empresa',$idcompany);
    $this->db->order_by('fecha_pago_factura');
    $result = $this->db->get();
    return $result;
  }

  public function UpdateCostSale($id, $data){
    $this->db->where('id_gasto_venta', $id);
    $this->db->update('gasto_venta', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_MAXFOLIO($company){
    $this->db->select_max('cotizacion_folio');//the name of fields to query in the login
    $this->db->from('cotizacion');
    $this->db->where('cotizacion_id_empresa', $company);#the field must match the entered parameter of password
    $query = $this->db->get();#the query is obtained and stored within the variable
    $result = $query->row();#the result displays in a row
    return $result;#if the query has data, returns the data query
  }

  public function Verifica_Flujo($idcompany,$anio,$mes){
    $this->db->select('id_flujo_efectivo');
    $this->db->from('flujo_efectivo');
    $this->db->where('empresa_id_empresa',$idcompany);
    $this->db->where('flujo_efectivo_mes',$mes);
    $this->db->where('flujo_efectivo_anio',$anio);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Guarda_Flujo($data){
    $this->db->insert('flujo_efectivo',$data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Update_Flujo($mes,$anio,$id_empresa,$data){
    $this->db->where('flujo_efectivo_mes',$mes);
    $this->db->where('flujo_efectivo_anio',$anio);
     $this->db->where('empresa_id_empresa',$id_empresa);
      $this->db->update('flujo_efectivo', $data);
      if ($this->db->affected_rows() > 0) {
        return true;
      } else{
        return false;
      }
  }

  public function Get_sal_ban_guardado($idcompany,$anio,$mes_letra){
    $this->db->select('flujo_efectivo_saldo_ini');
    $this->db->from('flujo_efectivo');
    $this->db->where('empresa_id_empresa',$idcompany);
    $this->db->where('flujo_efectivo_mes',$mes_letra);
    $this->db->where('flujo_efectivo_anio',$anio);
     $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Update_Ref_Venta_Mov($id,$ref){
    $this->db->where('id_venta_mov', $id);
    $this->db->set('venta_mov_referencia', $ref);
    $this->db->update('venta_movimiento');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Update_Ref_SFV($id,$ref){
    $this->db->where('id_lista_pago_sfv', $id);
    $this->db->set('lista_pago_sfv_referencia', $ref);
    $this->db->update('lista_pago_sfv');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

    public function Update_Ref_Gasto_venta($id,$ref,$iva_ret,$isr_ret,$ieps,$dap){
    $this->db->where('id_gasto_venta ', $id);
    $this->db->set('gasto_venta_referencia', $ref);
    $this->db->set('gasto_venta_iva_ret', $iva_ret);
    $this->db->set('gasto_venta_isr_ret', $isr_ret);
    $this->db->set('gasto_venta_ieps', $ieps);
    $this->db->set('gasto_venta_dap', $dap);
    $this->db->update('gasto_venta');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

    public function Update_Ref_Caja_Chica($id,$ref,$iva_ret,$isr_ret,$ieps,$dap){
    $this->db->where('id_lista_caja_chica ', $id);
    $this->db->set('lista_caja_chica_referencia', $ref);
    $this->db->set('lista_caja_chica_iva_ret', $iva_ret);
    $this->db->set('lista_caja_chica_isr_ret', $isr_ret);
    $this->db->set('lista_caja_chica_ieps', $ieps);
    $this->db->set('lista_caja_chica_dap', $dap);
    $this->db->update('lista_caja_chica');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

    public function Update_Ref_Viaticos($id,$ref,$iva_ret,$isr_ret,$ieps,$dap){
    $this->db->where('id_lista_viatico ', $id);
    $this->db->set('lista_viatico_referencia', $ref);
    $this->db->set('lista_viatico_iva_ret', $iva_ret);
    $this->db->set('lista_viatico_isr_ret', $isr_ret);
    $this->db->set('lista_viatico_ieps', $ieps);
    $this->db->set('lista_viatico_dap', $dap);
    $this->db->update('lista_viatico');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

    public function Update_Ref_Otros_Gastos($id,$ref,$iva_ret,$isr_ret,$ieps,$dap){
    $this->db->where('id_OGasto ', $id);
    $this->db->set('otros_gastos_referencia', $ref);
    $this->db->set('otros_gastos_iva_ret', $iva_ret);
    $this->db->set('otros_gastos_isr_ret', $isr_ret);
    $this->db->set('otros_gastos_ieps', $ieps);
    $this->db->set('otros_gastos_dap', $dap);
    $this->db->update('otros_gastos');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }


  public function Get_Product_Record($id_producto){
    $this->db->select('id_historial_precio_producto, historial_precio_producto_precio, id_producto, catalogo_producto_nombre, catalogo_producto_umedida,unidad_medida, catalogo_producto_precio, historial_fecha_actualizacion, historial_id_proveedor, catalogo_proveedor_empresa');
    $this->db->from('historial_precio_producto');
    $this->db->join('catalogo_proveedor','historial_id_proveedor=id_catalogo_proveedor');
    $this->db->join('catalogo_producto','id_producto=id_catalogo_producto');
    $this->db->join('unidades_de_medida', 'id_uMedida=catalogo_producto_umedida');
    $this->db->where('id_producto', $id_producto);
    $result=$this->db->get();
    return $result;
  }

  public function Get_Product_Info($id_producto){
    $this->db->select('id_catalogo_producto, catalogo_producto_nombre, catalogo_producto_umedida, catalogo_producto_precio, catalogo_proveedor_id_catalogo_proveedor, catalogo_proveedor_empresa_id_empresa, catalogo_producto_fecha_actualizacion, catalogo_producto_url_imagen,catalogo_proveedor_empresa');
    $this->db->from('catalogo_producto');
    $this->db->join('catalogo_proveedor','catalogo_proveedor_id_catalogo_proveedor=id_catalogo_proveedor');
    $this->db->where('id_catalogo_producto',$id_producto);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Check_Pass($id_usuario,$pass_actual){
    $this->db->select('id_usuario');
    $this->db->from('usuario');
    $this->db->where('id_usuario',$id_usuario);
    $this->db->where('usuario_pass',$pass_actual);
    $query=$this->db->get();
    if($query -> num_rows() >0){
      return true;
    }else{
      return false;
    }
    }

  public function Update_User($id_usuario,$data){
    $this->db->where('id_usuario',$id_usuario);
    $this->db->update('usuario', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }
  



#end model

}





