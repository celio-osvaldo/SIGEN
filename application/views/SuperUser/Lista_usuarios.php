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
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewUser"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Usuario</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-12">
			<div class="card bg-card">
				<div class="container">
					<br>
					<div class="table-responsive-lg">
						<table id="table_users" class="table table-hover display table-striped" style="font-size: 10pt;">
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
									<th>Modificar</th>
								</tr>
							</thead>
							<tbody style="font-weight: bolder">
								<?php
								foreach ($users->result() as $row) {?>
									<?php if ($row->usuario_tipo==1){
									$tipo_usuario="Administrador";																	
									}else{$tipo_usuario="General";} ?>
									<tr>
										<td hidden="true" id="<?php echo "id_usuario"; ?>"><?php echo "".$row->id_usuario.""; ?></td>
										<td id="<?php echo "tipo_us".$row->id_usuario.""; ?>"><?php echo "".$tipo_usuario.""; ?></td>
										<td id="<?php echo "name".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_nom.""; ?></td>
										<td id="<?php echo "ap".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_ap.""; ?></td>
										<td id="<?php echo "am".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_am.""; ?></td>
										<td id="<?php echo "tel".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_tel.""; ?></td>
										<td id="<?php echo "email".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_email.""; ?></td>
										<td id="<?php echo "alias".$row->id_usuario.""; ?>"><?php echo "".$row->usuario_alias.""; ?>
										</td>
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
										<td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_usuario.""; ?>" data-toggle="modal" data-target="#productE"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
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
					<br>
				</div>
			</div>
		</div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_users').DataTable();
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
</script>
