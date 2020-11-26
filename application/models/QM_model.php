<?php		
if(! defined('BASEPATH')) exit('No direct script access allowed');

class QM_model extends CI_Model
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

  public function Get_datos_empresa($idcompany){
    $this->db->select('id_empresa, empresa_nom, empresa_nom_fiscal, empresa_rfc, empresa_domic, emp_tel, emp_email, empresa_logo, emp_whatsapp, emp_web');//the name of fields to query in the login
    $this->db->from('empresa');
    $this->db->where('id_empresa', $idcompany);#the field must match the entered parameter of password
    $result=$this->db->get();
    return $result;
  }


  public function Get_solicitudes_pago($id_empresa){
    $this->db->select('count(id_historial_proyecto_pago) as num_solic_pago');
    $this->db->FROM('historial_proyecto_pago'); 
    $this->db->join('venta_movimiento','historial_proyecto_pago_id_venta_mov=id_venta_mov');
    $this->db->WHERE('historial_proyecto_pago_autoriza','1');
    $this->db->WHERE('obra_cliente_empresa_id_empresa',$id_empresa);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Cambio_Solicitado($id_empresa){
    $this->db->select('id_historial_proyecto_info, historial_proyecto_info.id_obra_cliente, historial_proyecto_fecha_actualizacion, historial_proyecto_nombre_old, historial_proyecto_nombre_new, historial_proyecto_id_cliente_old, historial_proyecto_id_cliente_new, historial_proyecto_importe_old, historial_proyecto_importe_new, historial_proyecto_estado_old, historial_proyecto_estado_new, historial_proyecto_coment_old, historial_proyecto_coment_new, historial_proyecto_coment_justifica, historial_proyecto_autoriza, historial_proyecto_usuario_solicita, historial_proyecto_usuario_admin, usuario_nom, estado, empresa_id_empresa');
    $this->db->FROM('historial_proyecto_info'); 
    $this->db->JOIN('obra_cliente','historial_proyecto_info.id_obra_cliente=obra_cliente.id_obra_cliente');
    $this->db->JOIN('usuario','historial_proyecto_usuario_solicita=id_usuario');
    $this->db->JOIN('autoriza','id_autoriza=historial_proyecto_autoriza');
     $this->db->WHERE('empresa_id_empresa',$id_empresa);
    //$this->db->WHERE('historial_proyecto_autoriza','1');
    $query=$this->db->get();
    return $query;
  }


  public function Cambio_Solicitado_pago($id_empresa){
    $this->db->select('id_historial_proyecto_pago, historial_proyecto_pago_id_venta_mov, historial_proyecto_pago_fecha_actualizacion, historial_proyecto_pago_coment_old, historial_proyecto_pago_coment_new, historial_proyecto_pago_monto_old, historial_proyecto_pago_monto_new, historial_proyecto_pago_fecha_pago_old, historial_proyecto_pago_fecha_pago_new, historial_proyecto_pago_justifica, historial_proyecto_pago_autoriza, historial_proyecto_pago_solicita, historial_proyecto_pago_admin, usuario_nom, estado, obra_cliente_empresa_id_empresa,empresa_nom');
    $this->db->FROM('historial_proyecto_pago'); 
    $this->db->JOIN('venta_movimiento','historial_proyecto_pago.historial_proyecto_pago_id_venta_mov=venta_movimiento.id_venta_mov');
    $this->db->JOIN('usuario','historial_proyecto_pago_solicita=id_usuario');
    $this->db->JOIN('autoriza','id_autoriza=historial_proyecto_pago_autoriza');
    $this->db->JOIN('empresa','obra_cliente_empresa_id_empresa=id_empresa');
    $this->db->WHERE('obra_cliente_empresa_id_empresa',$id_empresa);
    //$this->db->WHERE('historial_proyecto_autoriza','1');
    $query=$this->db->get();
    return $query;
  }

  public function Get_solicitudes($id_empresa){
    $this->db->select('count(id_historial_proyecto_info) as num_solic');
    $this->db->FROM('historial_proyecto_info'); 
    $this->db->join('obra_cliente','historial_proyecto_info.id_obra_cliente=obra_cliente.id_obra_cliente');
    $this->db->WHERE('historial_proyecto_autoriza','1');
    $this->db->WHERE('empresa_id_empresa',$id_empresa);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function GetInventorie_Products($idcompany){
    $this->db->select('id_prod_alm, prod_alm_nom, unidad_medida, prod_alm_modelo, prod_alm_prec_unit, prod_alm_exist, prod_alm_codigo, prod_alm_descripcion, prod_alm_coment, id_uMedida');
    $this->db->from('producto_almacen');
    $this->db->join('unidades_de_medida','prod_alm_medida=id_uMedida');
    $this->db->where('empresa_id_empresa',$idcompany);
    $result=$this->db->get();
    return $result;
  }

    public function GetAllMeasurements(){
        $q = $this->db->get('unidades_de_medida');
        if($q -> num_rows() >0){
            return $q;
        }else{
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
    public function Edit_Product($id_prod,$data){
      $this->db->where('id_prod_alm',$id_prod);
      $this->db->update('producto_almacen', $data);
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
  public function Return_Product_Almacen($id_producto,$data){
    $this->db->where('id_prod_alm', $id_producto);
    $this->db->update('producto_almacen', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }
  public function Get_Product_History($id_producto){
    $this->db->select('id_historial_almacen_producto, historial_almacen_producto.id_prod_alm, prod_alm_prec_unit_new, prod_alm_prec_unit_old, historial_almacen_producto_cantidad_new, historial_almacen_producto_cantidad_old, historial_almacen_producto_fecha, historial_almacen_producto_movimiento, historial_almacen_producto_procedencia, historial_almacen_producto_referencia, prod_alm_nom, unidad_medida');
    $this->db->from('historial_almacen_producto');
    $this->db->join('producto_almacen','historial_almacen_producto.id_prod_alm=producto_almacen.id_prod_alm');
    $this->db->join('unidades_de_medida', 'id_uMedida=prod_alm_medida');
    $this->db->where('historial_almacen_producto.id_prod_alm', $id_producto);
    $this->db->order_by('historial_almacen_producto_fecha', 'DESC');
    $result=$this->db->get();
    return $result;
  }

  public function Ult_Fecha($id_prod){
    $this->db->select_max('historial_almacen_producto_fecha');
    $this->db->from('historial_almacen_producto');
    $this->db->where('id_prod_alm', $id_prod);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Product_Inv_info($id_producto){
    $this->db->select('id_prod_alm, prod_alm_nom, prod_alm_modelo, prod_alm_prec_unit, prod_alm_exist, prod_alm_descripcion');
    $this->db->from('producto_almacen');
    $this->db->where('id_prod_alm', $id_producto);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
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
    $this->db->select('id_catalogo_proveedor, catalogo_proveedor_nom_fiscal, catalogo_proveedor_empresa, catalogo_proveedor_id_giro, nombre_giro, rfc, catalogo_proveedor_contacto1, catalogo_proveedor_contacto2, catalogo_proveedor_puesto1, catalogo_proveedor_puesto2, catalogo_proveedor_tel1, catalogo_proveedor_tel2, catalogo_proveedor_cel1, catalogo_proveedor_cel2, catalogo_proveedor_email1, catalogo_proveedor_email2, catalogo_proveedor_coment');
    $this->db->from('catalogo_proveedor');
    $this->db->join('catalogo_giro_proveedor','catalogo_proveedor_id_giro=id_catalogo_giro');
    $this->db->where('empresa_id_empresa', $idcompany);
    $result=$this->db->get();
    return $result;
  }
    public function New_Consumible($data){
    $this->db->insert('producto_consumible', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }
    public function Update_Consumible($id, $data){
      $this->db->where('id_prod', $id);
      $this->db->update('producto_consumible', $data);
      if ($this->db->affected_rows() > 0) {
        return true;
      } else{
        return false;
      }
  }
public function Get_Product_History_Consu($id_producto){
    $this->db->select('id_historial_almacen_producto, historial_almacen_consumible.id_prod_alm, prod_alm_prec_unit_new, prod_alm_prec_unit_old, historial_almacen_producto_cantidad_new, historial_almacen_producto_cantidad_old, historial_almacen_proveedor_old, historial_almacen_proveedor_new, historial_almacen_producto_fecha, historial_almacen_producto_movimiento, historial_almacen_producto_procedencia, historial_almacen_producto_referencia, producto_consu_nom, unidad_medida, catalogo_proveedor_empresa');
    $this->db->from('historial_almacen_consumible');
    $this->db->join('producto_consumible','historial_almacen_consumible.id_prod_alm=producto_consumible.id_prod');
    $this->db->join('unidades_de_medida', 'id_uMedida=producto_consu_medida');
    $this->db->join('catalogo_proveedor', 'id_catalogo_proveedor=historial_almacen_proveedor_new');
    $this->db->where('historial_almacen_consumible.id_prod_alm', $id_producto);
    $this->db->order_by('historial_almacen_producto_fecha', 'DESC');
    $result=$this->db->get();
    return $result;
  }

  public function Product_Inv_info_Consu($id_producto){
    $this->db->select('id_prod, producto_consu_nom, producto_consu_medida, producto_consu_prec_unit, producto_consu_exist, producto_consu_ult_compra, producto_consu_periodicidad, producto_consu_prox_compra, producto_consu_ult_proveedor, unidad_medida, catalogo_proveedor_empresa');
    $this->db->from('producto_consumible');
    $this->db->join('unidades_de_medida', 'id_uMedida=producto_consu_medida');
    $this->db->join('catalogo_proveedor', 'id_catalogo_proveedor=producto_consu_ult_proveedor');
    $this->db->where('id_prod', $id_producto);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Ult_Fecha_Consu($id_prod){
    $this->db->select_max('historial_almacen_producto_fecha');
    $this->db->from('historial_almacen_consumible');
    $this->db->where('id_prod_alm', $id_prod);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }


  public function Get_Giros(){
    $this->db->select('id_catalogo_giro, nombre_giro');
    $this->db->from('catalogo_giro_proveedor');
    $result=$this->db->get();
    return $result;
  }
    public function New_Provider($data){
    $this->db->insert('catalogo_proveedor', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
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

  public function GetAllCustomer_Project($idcompany){
      $this->db->select('id_obra_cliente, obra_cliente_nombre,catalogo_cliente_empresa, obra_cliente_imp_total, obra_cliente_saldo, obra_cliente_pagado, obra_cliente_estado, obra_cliente_comentarios, obra_cliente_id_cliente, id_evento_detalle, evento_detalle_id_obra_cliente, evento_detalle_fecha, evento_detalle_personas, evento_detalle_tipo_evento, evento_detalle_permiso, detalle_evento_mobiliario, evento_detalle_total_horas, evento_detalle_hora_inicio, evento_detalle_hora_fin, evento_detalle_fecha_fin, evento_detalle_anticipo');
      $this->db->from('obra_cliente');
      $this->db->join('catalogo_cliente','obra_cliente_id_cliente=id_catalogo_cliente');
      $this->db->join('evento_detalle','evento_detalle_id_obra_cliente=id_obra_cliente');
      $this->db->where('obra_cliente.empresa_id_empresa',$idcompany);
      $this->db->order_by('obra_cliente_nombre');
      $query = $this->db->get();
      return $query;      
  }

  public function Get_Customer_List($idcompany){
      $this->db->select('id_catalogo_cliente,catalogo_cliente_empresa');
      $this->db->from('catalogo_cliente');
      $this->db->where('empresa_id_empresa',$idcompany);
      $this->db->order_by('catalogo_cliente_empresa');
      $query=$this->db->get();
      return $query;
  }

  public function AddCustomer_Project($data){
    $this->db->insert('obra_cliente',$data);
    if ($this->db->affected_rows() > 0) {
       $id=$this->db->insert_id();
      return $id;
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

  public function New_Customer($data){
    $this->db->insert('catalogo_cliente', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
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
 
   public function Edit_Evento_Detallest($id,$data2){
    $this->db->where('evento_detalle_id_obra_cliente', $id);
    $this->db->update('evento_detalle', $data2);
    if ($this->db->affected_rows() > 0){
      return 1;
    }else{
      return 2;
    }
  }

  public function Datos_evento($id_evento){
    $this->db->select('id_obra_cliente, obra_cliente_nombre,catalogo_cliente_empresa, obra_cliente_imp_total, obra_cliente_saldo, obra_cliente_pagado, obra_cliente_estado, obra_cliente_comentarios, obra_cliente_id_cliente');
    $this->db->from('obra_cliente');
    $this->db->where('id_obra_cliente',$id_evento);
    $this->db->join('catalogo_cliente','obra_cliente_id_cliente=id_catalogo_cliente');
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }
 
  public function  Detalles_evento($id_evento){
    $this->db->select('id_evento_detalle, evento_detalle_id_obra_cliente, evento_detalle_fecha, evento_detalle_personas, evento_detalle_tipo_evento, evento_detalle_permiso, detalle_evento_mobiliario, evento_detalle_total_horas, evento_detalle_hora_inicio, evento_detalle_hora_fin, evento_detalle_fecha_fin, evento_detalle_anticipo');
    $this->db->from('evento_detalle');
    $this->db->where('evento_detalle_id_obra_cliente',$id_evento);
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }
  
  public function  Detalles_mobiliario($id_evento){
    $this->db->select('id_evento_mobiliario, id_evento, id_mobiliario, evento_mobiliario_cantidad, evento_mobiliario_coment, prod_alm_nom, prod_alm_modelo, prod_alm_descripcion, unidad_medida, prod_alm_exist');
    $this->db->from('evento_mobiliario');
    $this->db->join('producto_almacen','id_mobiliario=id_prod_alm');
    $this->db->join('unidades_de_medida', 'id_uMedida=prod_alm_medida');
    $this->db->where('id_evento',$id_evento);
     $result=$this->db->get();
    return $result;
  }

   public function GetAllCustomer_Payments($idcompany){
    $this->db->select('id_obra_cliente, obra_cliente_nombre,catalogo_cliente_empresa, obra_cliente_imp_total, obra_cliente_pagado, obra_cliente_saldo, obra_cliente_ult_pago, obra_cliente_comentarios, obra_cliente_estado');
      $this->db->from('obra_cliente');
      $this->db->join('catalogo_cliente','obra_cliente_id_cliente=id_catalogo_cliente');
      $this->db->where('obra_cliente.empresa_id_empresa',$idcompany);
      //$this->db->where('obra_cliente_estado',1);
      $this->db->order_by('obra_cliente_nombre');
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



}



?>