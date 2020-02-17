<?php		
if(! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model
{
public function __Construct(){
	parent::__construct();
}

function UsersQuery($user, $pass){
		$this->db->select('empresa_nom, id_usuario, usuario_alias, usuario_nom');//the name of fields to query in the login
      $this->db->from('empresa');#name of first table
      $this->db->join('us_empresa', 'id_empresa = empresa_id_empresa');#the relation into the first table and second table whit the fields that relation their
      $this->db->join('usuario', 'id_usuario = usuario_id_usuario');#the relation into the second table and thirth table whit the fields that relation their
      $this->db->where('usuario_alias', $user);#the field must match the entered parameter of user
      $this->db->where('usuario_pass', $pass);#the field must match the entered parameter of password
      $query = $this->db->get();#the query is obtained and stored within the variable
      $result = $query->row();#the result displays in a row
      return $result;#if the query has data, returns the data query
  }
#end model
}