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
      return 1;
    } else{
      return 2;
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

}

 ?>
