<script type="text/javascript">
	function Bloquea_CheckBox($id_usuario){
	//alert("entró"+$id_usuario);
	id_us=$id_usuario;
	$("#dasa_check"+id_us).prop("checked", true);
	$("#dasa_check"+id_us).prop("disabled", true);
	$("#iluminacion_check"+id_us).prop("checked", true);
	$("#iluminacion_check"+id_us).prop("disabled", true);
	$("#salinas_check"+id_us).prop("checked", true);
	$("#salinas_check"+id_us).prop("disabled", true);
  $("#qm_check"+id_us).prop("checked", true);
  $("#qm_check"+id_us).prop("disabled", true);
}
	function Verifica_CheckBox($id_usuario){
	//alert("usuario: "+$id_usuario);
	//id_us=$id_usuario;
	<?php 
		foreach ($permisos->result() as $row2) {?> 
			if ("<?php echo $row2->usuario_id_usuario; ?>"==$id_usuario) {
				if("<?php echo $row2->empresa_id_empresa; ?>"==1){
					$("#iluminacion_check"+$id_usuario).prop("checked",true);
				}
				if("<?php echo $row2->empresa_id_empresa; ?>"==2){
					$("#dasa_check"+$id_usuario).prop("checked",true);
				}
				if("<?php echo $row2->empresa_id_empresa; ?>"==3){
					$("#salinas_check"+$id_usuario).prop("checked",true);
				}
        if("<?php echo $row2->empresa_id_empresa; ?>"==4){
          $("#qm_check"+$id_usuario).prop("checked",true);
        }
				
			}
				

		<?php }
	 ?>
}
</script>

<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Lista de Usuarios</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#New_User"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Usuario</button>
  </div>
</div>

<div class="row">
  <div class="card bg-card">
    <div class="col-md-12">
      <div class="table-responsive">
        <table id="table_users" class="table table-hover display table-striped" style="font-size: 8pt;">
         <thead class="bg-primary" style="color: #FFFFFF;" align="center">
          <tr>
           <th hidden="true">id_usuario</th>
           <th>Tipo Usuario</th>
           <th>Nombre</th>
           <th>Apellido Paterno</th>
           <th>Apellido Materno</th>
           <th>Teléfono</th>
           <th>Email</th>
           <th>Alias</th>
           <th>DASA</th>
           <th>SALINAS</th>
           <th>ILUMINACIÓN</th>
           <th>QUINTA MONTICELLO</th>
           <th>MODIFICAR DATOS</th>
           <th>REESTABLECER CONTRASEÑA</th>
           <th>ELIMINAR USUARIO</th>
         </tr>
       </thead>
       <tbody style="font-weight: bolder">
        <?php
        foreach ($users->result() as $row) {?>
         <?php if ($row->usuario_tipo==1){
           $tipo_usuario="Administrador";																	
         }else{$tipo_usuario="General";} ?>
         <tr>
          <td hidden="true" id="<?php echo "id_usuario"; ?>"><?php echo "".$row->id_usuario."";?></td>
          <td id="<?php echo "tipo_us".$row->id_usuario.""; ?>"><?php echo "".$tipo_usuario."";?></td>
          <td id="<?php echo "name".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_nom."";?></td>
          <td id="<?php echo "ap".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_ap."";?></td>
          <td id="<?php echo "am".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_am."";?></td>
          <td id="<?php echo "tel".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_tel."";?></td>
          <td id="<?php echo "email".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_email."";?></td>
          <td id="<?php echo "alias".$row->id_usuario; ?>"><?php echo $row->usuario_alias;?></td>
          <td>
           <div class="custom-control custom-switch">
             <input type="checkbox" class="custom-control-input" onchange="Check_Estado(this.id)" id="<?php echo "dasa_check".$row->id_usuario.""; ?>">
             <label class="custom-control-label" for="<?php echo "dasa_check".$row->id_usuario.""; ?>"></label>
           </div>
         </td>
         <td>
           <div class="custom-control custom-switch">
             <input type="checkbox" class="custom-control-input" onchange="Check_Estado(this.id)"  id="<?php echo "salinas_check".$row->id_usuario.""; ?>">
             <label class="custom-control-label" for="<?php echo "salinas_check".$row->id_usuario.""; ?>"></label>
           </div>
         </td>
         <td>
           <div class="custom-control custom-switch">
             <input type="checkbox" class="custom-control-input" onchange="Check_Estado(this.id)"  id="<?php echo "iluminacion_check".$row->id_usuario.""; ?>">
             <label class="custom-control-label" for="<?php echo "iluminacion_check".$row->id_usuario.""; ?>"></label>
           </div>
         </td>
         <td>
           <div class="custom-control custom-switch">
             <input type="checkbox" class="custom-control-input" onchange="Check_Estado(this.id)"  id="<?php echo "qm_check".$row->id_usuario.""; ?>">
             <label class="custom-control-label" for="<?php echo "qm_check".$row->id_usuario.""; ?>"></label>
           </div>
         </td>
         <td><a role="button" class="btn btn-outline-dark" onclick="Edit_User(this.id)" id="<?php echo "".$row->id_usuario.""; ?>" ><img width="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
         </td>

         <td><a role="button" class="btn btn-outline-dark" onclick="Change_Pass(this.id)" id="<?php echo "".$row->id_usuario.""; ?>"><img width="20" src="..\Resources\Icons\pass_change.ico" alt="Cambiar Contraseña" style="filter: invert(100%)" /></a>
         </td>
         <td><a role="button" class="btn btn-outline-dark" onclick="Delete_User(this.id)" id="<?php echo "".$row->id_usuario.""; ?>"><img width="20" src="..\Resources\Icons\delete.ico" alt="Eliminar Usuario" style="filter: invert(100%)" /></a>
         </td>
       </tr>
       <?php if ($row->usuario_tipo==1){
         echo "<script>";
         echo "Bloquea_CheckBox(".$row->id_usuario;
         echo ");";
         echo "</script>";
       }else{
         echo "<script>";
         echo "Verifica_CheckBox(".$row->id_usuario;
         echo ");";
         echo "</script>";
       } ?>

     <?php } ?>
   </tbody>
 </table>
</div>
</div>
</div>
</div>

<!-- Modal New User -->
<div class="modal fade" id="New_User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<label>Tipo de Usuario</label>
      	<select id="new_tipo" class="form-control col-4">
      		<option value="1">Administrador</option>
      		<option value="2">General</option>
      	</select>
      	<div class="form-row">
          <div class="form-group col-md-6">
            <label>Nombre</label>
            <input type="text" id="new_nombre" class="form-control">
          </div>
          <div class="form-group col-md-5">
            <label>Alias</label>
            <input type="text" id="new_alias" class="form-control">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Apellido Paterno</label>
            <input type="text" id="new_ap" class="form-control ">
          </div>
          <div class="form-group col-md-5">
            <label>Apellido Materno</label>
            <input type="text" id="new_am" class="form-control ">
          </div>
        </div>
        <label>Teléfono</label>
        <input type="text" id="new_tel" class="form-control col-6">        
        <label>Email</label>
        <input type="email" required="true" id="new_email" class="form-control col-8">
      </div>
      <hr>
      <p style="background: yellow"><b>La contraseña de ingreso será el alias que indique</b></p>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewUser" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit User -->
<div class="modal fade" id="Edit_User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="text" id="edit_id_usuario" hidden="true">
      	<label>Tipo de Usuario</label>
      	<select id="edit_tipo" class="form-control col-4">
      		<option value="1">Administrador</option>
      		<option value="2">General</option>
      	</select>
      	<div class="form-row">
          <div class="form-group col-md-6">
            <label>Nombre</label>
            <input type="text" id="edit_nombre" class="form-control">
          </div>
          <div class="form-group col-md-5">
            <label>Alias</label>
            <input type="text" id="edit_alias" class="form-control">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Apellido Paterno</label>
            <input type="text" id="edit_ap" class="form-control ">
          </div>
          <div class="form-group col-md-5">
            <label>Apellido Materno</label>
            <input type="text" id="edit_am" class="form-control ">
          </div>
        </div>
        <label>Teléfono</label>
        <input type="text" id="edit_tel" class="form-control col-6">        
        <label>Email</label>
        <input type="email"  id="edit_email" class="form-control col-8">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateUser" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Password -->
<div class="modal fade" id="Edit_Pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reestablecer Contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="text" id="pass_id_usuario" hidden="true">
        <label>Nombre</label>
        <input type="text" id="pass_nombre" disabled="true" class="form-control col-8"> 
        <label>Email</label>
        <input type="email"  id="pass_email" disabled="true" class="form-control col-8">
        <hr>
        <p style="background: yellow"><b>La nueva contraseña será enviada al correo arriba indicado.</b></p>
        <p style="background: yellow"><b>Recuerde revisar su bandeja de Correo No Deseado.</b></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdatePass" data-dismiss="modal">Reestablecer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete User -->
<div class="modal fade" id="Delete_User" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="text" id="delete_id_usuario" hidden="true">
        <label>Nombre de Usuario</label>
        <input type="text" id="delete_nombre" disabled="true" class="form-control col-8"> 
        <label>Email</label>
        <input type="email"  id="delete_email" disabled="true" class="form-control col-8">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="DeleteUser" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_users').DataTable();

    
        //Función para ingresar un nuevo usuario
        $('#NewUser').click(function(){
          nombre=$("#new_nombre").val();
          ap=$("#new_ap").val();
          am=$("#new_am").val();
          tipo_usuario=$("#new_tipo").val();
          alias=$("#new_alias").val();
          tel=$("#new_tel").val();
          email=$("#new_email").val();
          //alert(id_usuario+" "+nombre+" "+ap+" "+am+" "+tipo_usuario+" "+alias+" "+tel+" "+email);
          if(nombre!=""&&alias!=""){
            $.ajax({
              url: '<?php echo base_url();?>SuperUser/New_User',
              type: 'post',
              data: {nombre:nombre, ap:ap, am:am, tipo_usuario:tipo_usuario, alias:alias, tel:tel, email:email},
              success:function(result){
            //alert(result);
            if(result){
            	alert("Usuario Ingresado");
            	Update_Page(); 
            }else{
            	alert("Error en el servidor. Usuario no Ingresado");
            }

          }
        });
          }else{
            alert("Debe ingresar nombre de usuario y alias");
          }     
          Update_Page(); 
        });

        //Función para actualizar los datos de usuario
        $('#UpdateUser').click(function(){
          id_usuario=$("#edit_id_usuario").val();
          nombre=$("#edit_nombre").val();
          ap=$("#edit_ap").val();
          am=$("#edit_am").val();
          tipo_usuario=$("#edit_tipo").val();
          alias=$("#alias"+id_usuario).text();
          tel=$("#edit_tel").val();
          email=$("#edit_email").val();
          //alert(id_usuario+" "+nombre+" "+ap+" "+am+" "+tipo_usuario+" "+alias+" "+tel+" "+email);
          if(nombre!=""){
            $.ajax({
              url: '<?php echo base_url();?>SuperUser/Edit_User',
              type: 'post',
              data: {id_usuario:id_usuario, nombre:nombre, ap:ap, am:am, tipo_usuario:tipo_usuario, alias:alias, tel:tel, email:email},
              success:function(result){
            //alert(result);
            if(result){
            	alert("Datos Actualizados");
            	Update_Page(); 
            }else{
            	alert("Error en el servidor. Datos no Actualizados");
            }

          }
        });
          }else{
            alert("Debe ingresar nombre de usuario");
          }     
          Update_Page(); 
        });

        //Función para actualizar la contraseña
        $('#UpdatePass').click(function(){
          id_usuario=$("#pass_id_usuario").val();
          nombre=$("#pass_nombre").val();
          alias=$("#pass_alias").val();
          email=$("#pass_email").val();
          //alert(id_usuario+" "+nombre+" "+ap+" "+am+" "+tipo_usuario+" "+alias+" "+tel+" "+email);
          $.ajax({
            url: '<?php echo base_url();?>SuperUser/Edit_Pass',
            type: 'post',
            data: {id_usuario:id_usuario, nombre:nombre, email:email, alias:alias},
            success:function(result){
            alert(result);
            if(result){
             alert("Correo enviado:");
             Update_Page(); 
           }else{
             alert("Error en el servidor. Correo no enviado");
           }
         }
       });    
          Update_Page(); 
        });
        
        //Función para eliminar un usuario
        $('#DeleteUser').click(function(){
          id_usuario=$("#delete_id_usuario").val();
          nombre=$("#delete_nombre").val();
          alias=$("#delete_alias").val();
          email=$("#delete_email").val();
          //alert(id_usuario+" "+nombre+" "+ap+" "+am+" "+tipo_usuario+" "+alias+" "+tel+" "+email);
          $.ajax({
            url: '<?php echo base_url();?>SuperUser/Delete_User',
            type: 'post',
            data: {id_usuario:id_usuario, nombre:nombre, email:email, alias:alias},
            success:function(result){
            //alert(result);
            if(result){
             alert("Usuario Eliminado");
             Update_Page(); 
           }else{
             alert("Error en el servidor. Usuario No Eliminado");
           }
         }
       });    
          Update_Page(); 
        });


      });

function Check_Estado($id){
	id=$id;
	id_usuario=id.split("_check");
	permiso=$("#"+id).prop('checked');
	//id_usuario[0] nombre de la empresa
	//id_usuario[1] id del usuario
	//alert(id+" "+permiso+" "+id_usuario[0]+" "+id_usuario[1]);
	user=id_usuario[1];
	switch(id_usuario[0]){
		case "dasa":
   id_empresa=2;
   break;
   case "salinas":
   id_empresa=3;
   break;
   case "iluminacion":
   id_empresa=1;
   case "qm":
   id_empresa=4;
   break;
 }
	//alert(user+" "+id_empresa+" "+permiso);
  $.ajax({
    type:"POST",
    url: '<?php echo base_url();?>SuperUser/Actualiza_Permiso',
    data: {user:user, id_empresa:id_empresa, permiso:permiso},
    success:function(result){
        //alert(result);
        alert("Permiso Actualizado");
        //Update_Page(id_anticipo); 
      }
    });
}


function Edit_User($id_user){
	id_usuario=$id_user;
	tipo_us=$("#tipo_us"+$id_user).text();
	nombre=$("#name"+$id_user).text();
	ap=$("#ap"+$id_user).text();
	am=$("#am"+$id_user).text();
	tel=$("#tel"+$id_user).text();
	email=$("#email"+$id_user).text();
	alias=$("#alias"+$id_user).text();

	$("#Edit_User").modal();
	$("#edit_id_usuario").val(id_usuario);
  $("#edit_tipo option:contains("+tipo_us+")").attr('selected', true);
  $("#edit_nombre").val(nombre);
  $("#edit_ap").val(ap);
  $("#edit_am").val(am);
  $("#edit_tel").val(tel);
  $("#edit_email").val(email);
  $("#edit_alias").val(alias);
}

function Change_Pass($id_user){
	id_usuario=$id_user;
	tipo_us=$("#tipo_us"+$id_user).text();
	nombre=$("#name"+$id_user).text();
	ap=$("#ap"+$id_user).text();
	am=$("#am"+$id_user).text();
	tel=$("#tel"+$id_user).text();
	email=$("#email"+$id_user).text();
	alias=$("#alias"+$id_user).text();
	if(email!=""){
		$("#Edit_Pass").modal();
		$("#pass_id_usuario").val(id_usuario);
   $("#pass_nombre").val(nombre+" "+ap+" "+am);
   $("#pass_email").val(email);
 }else{
  alert("Para Reestablecer Contraseña es necesario que registre el email del Usuario");
}
}

function Delete_User($id_user){
	id_usuario=$id_user;
	tipo_us=$("#tipo_us"+$id_user).text();
	nombre=$("#name"+$id_user).text();
	ap=$("#ap"+$id_user).text();
	am=$("#am"+$id_user).text();
	tel=$("#tel"+$id_user).text();
	email=$("#email"+$id_user).text();
	alias=$("#alias"+$id_user).text();
  $("#Delete_User").modal();
  $("#delete_id_usuario").val(id_usuario);
  $("#delete_nombre").val(nombre+" "+ap+" "+am);
  $("#delete_email").val(email);
}

function Update_Page(){
  $("#page_content").load("Users_List");
}

</script>
