<?php		
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
public function __Construct(){
	parent::__construct();
}

function UsersQuery($user, $pass){
		$this->db->select('empresa_nom, id_usuario, usuario_alias, usuario_nom, perm_escri, perm_lectura, nombre_tipo');//the name of fields to query in the login
      $this->db->from('empresa');#name of first table
      $this->db->join('us_empresa', 'id_empresa = empresa_id_empresa');#the relation into the first table and second table whit the fields that relation their
      $this->db->join('usuario', 'id_usuario = usuario_id_usuario');#the relation into the second table and thirth table whit the fields that relation their
      $this->db->join('catalog_users', 'usuario_tipo = id_tipo_usuario');
      $this->db->where('usuario_alias', $user);#the field must match the entered parameter of user
      $this->db->where('usuario_pass', $pass);#the field must match the entered parameter of password
      $query = $this->db->get();#the query is obtained and stored within the variable
      $result = $query->row();#the result displays in a row
      return $result;#if the query has data, returns the data query
  }

  function UserLogin($user, $pass){
    $this->db->select('id_usuario, usuario_alias, usuario_nom, usuario_tipo');//the name of fields to query in the login
      $this->db->from('usuario');#name of first table
      $this->db->where('usuario_pass', $pass);#the field must match the entered parameter of password
      $nom_alias = "(usuario_alias='$user' OR usuario_nom='$user')";
      $this->db->where($nom_alias);#the field must match the entered parameter of user
     // $this->db->or_where('usuario_nom',$user);
      $query = $this->db->get();#the query is obtained and stored within the variable
      $result = $query->row();#the result displays in a row
      return $result;#if the query has data, returns the data query
  }

    function UserCompanies($id_user){
    $this->db->select('id_empresa, empresa_nom, perm_lectura,perm_escri');//the name of fields to query in the login
      $this->db->from('us_empresa');#name of first table
      $this->db->join('empresa','empresa_id_empresa=id_empresa');
      $this->db->where('usuario_id_usuario', $id_user);#the field must match the entered parameter of password
      $query = $this->db->get();#the query is obtained and stored within the variable
      $result = $query->result_array();#the result displays in a row
      return $result;#if the query has data, returns the data query
  }


#end model
}