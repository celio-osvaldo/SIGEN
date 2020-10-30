<?php 	
if(! defined('BASEPATH')) exit('No direct script access allowed');

class SU_model extends CI_Model
{
	public function __Construct(){
		parent::__construct();
	}

	public function Get_All_Users(){
    $this->db->select('id_usuario, usuario_tipo, usuario_nom, usuario_ap, usuario_am, usuario_tel, usuario_email, usuario_alias');
     //empresa_id_empresa, perm_lectura, perm_escri, empresa_nom');
    $this->db->from('usuario');
   // $this->db->join('us_empresa', 'id_usuario=usuario_id_usuario');
    //$this->db->join('empresa', 'empresa_id_empresa=id_empresa');
    $query = $this->db->get();
    if($query -> num_rows() >0){
      return $query;
    }else{
      return $query;
    }
	}

  public function Agrega_Permiso($data){
    $this->db->insert('us_empresa',$data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }
  public function Elimina_Permiso($id_usuario,$id_empresa){
    $this->db->where('usuario_id_usuario', $id_usuario);
    $this->db->where('empresa_id_empresa', $id_empresa);
    $this->db->delete('us_empresa');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_All_Permisos(){
    $this->db->select('usuario_id_usuario, empresa_id_empresa, perm_lectura, perm_escri');
    $this->db->from('us_empresa');
     $query = $this->db->get();
    if($query -> num_rows() >0){
      return $query;
    }else{
      return $query;
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
  
  public function New_User($data){
    $this->db->insert('usuario',$data);
    if ($this->db->affected_rows() > 0) {
      $id=$this->db->insert_id();
      return $id;
    } else{
      return false;
    }
  }
  public function Delete_User($id_user){
    $this->db->where('id_usuario', $id_user);
    $this->db->delete('usuario');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Delete_all_Permissions($id_user){
    $this->db->where('usuario_id_usuario', $id_user);
    $this->db->delete('us_empresa');
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_solicitudes(){
    $this->db->select('count(id_historial_proyecto_info) as num_solic');
    $this->db->FROM('historial_proyecto_info'); 
    $this->db->WHERE('historial_proyecto_autoriza','1');
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Get_solicitudes_pago(){
    $this->db->select('count(id_historial_proyecto_pago) as num_solic_pago');
    $this->db->FROM('historial_proyecto_pago'); 
    $this->db->WHERE('historial_proyecto_pago_autoriza','1');
    $query=$this->db->get();
    $result=$query->row();
    return $result;
  }

  public function Cambio_Solicitado(){
    $this->db->select('id_historial_proyecto_info, historial_proyecto_info.id_obra_cliente, historial_proyecto_fecha_actualizacion, historial_proyecto_nombre_old, historial_proyecto_nombre_new, historial_proyecto_id_cliente_old, historial_proyecto_id_cliente_new, historial_proyecto_importe_old, historial_proyecto_importe_new, historial_proyecto_estado_old, historial_proyecto_estado_new, historial_proyecto_coment_old, historial_proyecto_coment_new, historial_proyecto_coment_justifica, historial_proyecto_autoriza, historial_proyecto_usuario_solicita, historial_proyecto_usuario_admin, usuario_nom, estado, empresa_id_empresa');
    $this->db->FROM('historial_proyecto_info'); 
    $this->db->JOIN('obra_cliente','historial_proyecto_info.id_obra_cliente=obra_cliente.id_obra_cliente');
    $this->db->JOIN('usuario','historial_proyecto_usuario_solicita=id_usuario');
    $this->db->JOIN('autoriza','id_autoriza=historial_proyecto_autoriza');
    //$this->db->WHERE('historial_proyecto_autoriza','1');
    $query=$this->db->get();
    return $query;
  }


  public function Cambio_Solicitado_pago(){
    $this->db->select('id_historial_proyecto_pago, historial_proyecto_pago_id_venta_mov, historial_proyecto_pago_fecha_actualizacion, historial_proyecto_pago_coment_old, historial_proyecto_pago_coment_new, historial_proyecto_pago_monto_old, historial_proyecto_pago_monto_new, historial_proyecto_pago_fecha_pago_old, historial_proyecto_pago_fecha_pago_new, historial_proyecto_pago_justifica, historial_proyecto_pago_autoriza, historial_proyecto_pago_solicita, historial_proyecto_pago_admin, usuario_nom, estado, obra_cliente_empresa_id_empresa,empresa_nom, historial_proyecto_pago_estim_estatus_old, historial_proyecto_pago_estim_estatus_new');
    $this->db->FROM('historial_proyecto_pago'); 
    $this->db->JOIN('venta_movimiento','historial_proyecto_pago.historial_proyecto_pago_id_venta_mov=venta_movimiento.id_venta_mov');
    $this->db->JOIN('usuario','historial_proyecto_pago_solicita=id_usuario');
    $this->db->JOIN('autoriza','id_autoriza=historial_proyecto_pago_autoriza');
    $this->db->JOIN('empresa','obra_cliente_empresa_id_empresa=id_empresa');
    //$this->db->WHERE('historial_proyecto_autoriza','1');
    $query=$this->db->get();
    return $query;
  }



  public function Cat_Cliente(){
    $this->db->select('id_catalogo_cliente, catalogo_cliente_nom_fiscal, catalogo_cliente_empresa, catalogo_cliente_rfc, catalogo_cliente_contacto1, catalogo_cliente_contacto2, catalogo_cliente_puesto1, catalogo_cliente_puesto2, catalogo_cliente_tel1, catalogo_cliente_tel2, catalogo_cliente_cel1, catalogo_cliente_cel2, catalogo_cliente_email1, catalogo_cliente_email2, catalogo_cliente_coment');
    $this->db->from('catalogo_cliente');
    $this->db->order_by('catalogo_cliente_empresa', 'ASC');
    $result=$this->db->get();
    return $result;
  }

  public function Cat_autoriza(){
    $this->db->select('id_autoriza, estado');
    $this->db->from('autoriza');
     $query = $this->db->get();
    if($query -> num_rows() >0){
      return $query;
    }else{
      return $query;
    }
  }

  public function Update_Historial_Proy($id_historial,$data){
    $this->db->where('id_historial_proyecto_info',$id_historial);
    $this->db->update('historial_proyecto_info', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Update_Historial_Proy_pago($id_historial,$data){
    $this->db->where('id_historial_proyecto_pago',$id_historial);
    $this->db->update('historial_proyecto_pago', $data);
    if ($this->db->affected_rows() > 0) {
      return true;
    } else{
      return false;
    }
  }

  public function Get_Companies(){
    $this->db->select('id_empresa, empresa_nom');
    $this->db->from('empresa');
    $query = $this->db->get();
    if($query -> num_rows() >0){
      return $query;
    }else{
      return $query;
    }
  }


}

 ?>
