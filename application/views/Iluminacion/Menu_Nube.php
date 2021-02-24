<?php date_default_timezone_set("America/Mexico_City"); ?>
<div class="nav flex-column menu_nube">
	<div class="row">
		<div class="col-md-2">
			<img  src="<?php echo base_url() ?>Resources/Icons/nube.ico"><a>Nube SIGEN</a>
			<?php
			$listar=null;
			$directorio=opendir('Resources/Nube_Sigen/Iluminacion/');

			while ($elemento=readdir($directorio)) {
				if ($elemento!='.'&&$elemento!='..') {
					if(is_dir("Resources/Nube_Sigen/Iluminacion/".$elemento))
					{
						?>
						<!--href="<?php echo base_url() ?>Resources/Nube_Sigen/Iluminacion/<?php echo $elemento ?>/"-->
						<a style="font-size: 1rem" href="#" onclick="Carga_tabla(this.id)" id="<?php echo $elemento ?>" role="button" class="nav-link" ><img src="<?php echo base_url() ?>Resources/Icons/carpeta.ico" width="15px" ><?php echo $elemento ?></a>
						<?php

					}else{
						?>
							<!--	
								<a style="font-size: 0.6rem" class="nav-link" href="<?php echo base_url() ?>Resources/Nube_Sigen/Iluminacion/<?php echo $elemento ?>" target="_blank"><?php echo $elemento ?></a>
							-->
						<?php
					}
				}
			}
			?>

			<div>
				<hr>
				<a  class="nav-item nav-link disabled" >Almacenamiento</a>
				<a class="nav-item nav-link disabled" style="font-size: 0.6rem">usados de 1000MB</a>
			</div>
		</div>
		<div class="col-md-10">
			<!--Mostrar listado de Archivos en Nube SIGEN -->
			<div id="lista_nube">
				<div class="row">
					<div class="col-md-8">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#" role="button" onclick="Index_tabla()">Nube_Sigen</a></li>
								<?php 
								$liga = explode("/", $ruta);
								$liga2="";
								foreach ($liga as $row) {
									$liga2.=$row."/";
									$row2=$row;
								?>
								<li class="breadcrumb-item active" aria-current="page"><a href="#" role="button" onclick="Carga_tabla(this.id)" id="<?php echo $liga2 ?>"><?php echo $row2; ?></a></li>
								<?php
								}

								 ?>
								
							</ol>
						</nav>
					</div>
					<div class="col-md-4">
						<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#New_Carpeta"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nueva Carpeta</button>
						<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewInv_OfficeModal"><img src="<?php echo base_url() ?>Resources/Icons/cloud-upload-symbol_icon-icons.com_56540.ico">Subir Archivo</button>
					</div>
				</div>


				<div class="card bg-card">
					<div class="table-responsive">
						<table id="table_nube" class="table table-striped table-hover display" style="font-size: 10pt;">
							<thead class="bg-primary" style="color: #FFFFFF;" align="center">
								<tr>
									<th>Nombre</th>
									<th>Fecha de creación</th>
									<th>Tamaño</th>
									<th>Eliminar</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if($ruta!=""){
									$listar=null;
									$directorio=opendir('Resources/Nube_Sigen/Iluminacion/'.$ruta);

									while ($elemento=readdir($directorio)) {
										if ($elemento!='.'&&$elemento!='..') {
											?>
											<tr>
												<?php
												if(is_dir("Resources/Nube_Sigen/Iluminacion/".$ruta."/".$elemento))
												{
													?>
													<td> <a style="font-size: 1rem" href="#" onclick="Carga_tabla(this.id)" id="<?php echo $ruta."/".$elemento ?>" role="button" class="nav-link" ><img src="<?php echo base_url() ?>Resources/Icons/carpeta.ico" width="15px" ><?php echo $elemento ?></a></td>
													<td><?php echo date ("d/m/Y H:i:s", filectime("Resources/Nube_Sigen/Iluminacion/".$ruta."/".$elemento)); ?></td>
													<td>-</td>
													<td><a role="button" class="btn btn-outline-dark" onclick="Delete_Carpeta(this.id)" id="<?php echo $ruta."/".$elemento ?>" data-toggle="modal" data-target="#deletecarpeta"><img height="20" src="..\Resources\Icons\delete.ico" alt="Eliminar" style="filter: invert(100%)" /></a></td>

													<?php

												}else{
													?>
													<td> <a style="font-size: rem" class="nav-link" href="<?php echo base_url() ?>Resources/Nube_Sigen/Iluminacion/<?php echo $elemento ?>" target="_blank"><?php echo $elemento ?></a></td>
													<td><?php echo date ("d/m/Y H:i:s", filectime("Resources/Nube_Sigen/Iluminacion/".$ruta."/".$elemento)); ?></td>

													<?php $size=filesize("Resources/Nube_Sigen/Iluminacion/".$ruta."/".$elemento);
														if($size<1024){
															$size=1;
															$size_uni="KB";
														}else{
															if(($size/1024)<1024){
																$size=($size/1024);
																$size_uni="KB";
															}else{
																$size=$size/1024;
																if (($size/1024)<1024) {
																	$size=($size/1024);
																	$size_uni="MB";
																}
																else{
																	$size=$size/1024;
																		if (($size/1024)<1024) {
																			$size=($size/1024);
																			$size_uni="GB";
																		}

																	}
																}
															}
													 ?>
													<td><?php echo number_format($size,'2')." ".$size_uni;?></td>
													<td><a role="button" class="btn btn-outline-dark" onclick="Delete_Archivo(this.id)" id="<?php echo $ruta."/".$elemento ?>" data-toggle="modal" data-target="#deletearchivo"><img height="20" src="..\Resources\Icons\delete.ico" alt="Eliminar" style="filter: invert(100%)" /></a></td>
													<?php
												}
												?>
											</tr>
											<?php
										}
									}
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>


<!-- Delete Archivo -->
<div class="modal fade" id="Elimina_archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Archivo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<label class="label-control">Confirma que desea eliminar el archivo</label>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<input class="form-control" type="text" disabled="true" name="delete_nombre" id="delete_nombre">
        		<input class="form-control" type="text" disabled="true" hidden="true" name="delete_ruta" id="delete_ruta">
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="delete_archivo" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Delete Carpeta -->
<div class="modal fade" id="Elimina_carpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Carpeta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<label class="label-control">Confirma que desea eliminar la Carpeta</label>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<input class="form-control" type="text" disabled="true" name="delete_carpeta" id="delete_carpeta">
        		<input class="form-control" type="text" disabled="true" hidden="true" name="delete_ruta_carpeta" id="delete_ruta_carpeta">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-12 alert-danger">
        		<p>Se eliminará la carpeta seleccionada incluidas las subcarpetas y archivos contenidos. </p>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="deletecarpeta" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Crear Carpeta -->
<div class="modal fade" id="New_Carpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Nueva Carpeta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<label class="label-control">Ubicación para nueva carpeta</label>
        		<input class="form-control" type="text" disabled="true" name="ruta_nueva_carpeta" id="ruta_nueva_carpeta" value="Nube_Sigen/<?php echo $ruta ?>">
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<label class="label-control">Nombre de la carpeta</label>
        	</div>
        </div>
        <div class="row">
        	<div class="col-md-12">
        		<input class="form-control" type="text" maxlength="50" name="nueva_carpeta" id="nueva_carpeta">
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="crearcarpeta" data-dismiss="modal">Crear</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#table_nube').DataTable();

		$('#delete_archivo').click(function(){
			nom_archivo=$("#delete_ruta").val();
			$.ajax({
				type:"POST",
				url:"<?php echo base_url();?>Iluminacion/Borra_Archivo",
				data:{nom_archivo:nom_archivo},
				success:function(result){
					//alert(result);
	            	if(result){
	            		alert('Archivo Borrado');
	            	}else{
	            		alert('Falló el servidor. Archivo no borrado');
	            	}
	            	Carga_tabla('<?php echo $ruta ?>');
        		}	
    		});
		});

		$('#deletecarpeta').click(function(){
			nom_carpeta=$("#delete_ruta_carpeta").val();
			$.ajax({
				type:"POST",
				url:"<?php echo base_url();?>Iluminacion/Borra_Carpeta",
				data:{nom_carpeta:nom_carpeta},
				success:function(result){
					//alert(result);
	            	if(result){
	            		alert('Carpeta Borrada');
	            	}else{
	            		alert('Falló el servidor. Carpeta no borrada');
	            	}
	            	Carga_tabla('<?php echo $ruta ?>');
        		}	
    		});
		});
		
		$('#crearcarpeta').click(function(){
			ruta_carpeta=$("#ruta_nueva_carpeta").val();
			nom_carpeta=$("#nueva_carpeta").val();
			//alert(ruta_carpeta+" "+nom_carpeta);
			$.ajax({
				type:"POST",
				url:"<?php echo base_url();?>Iluminacion/Crea_Carpeta",
				data:{nom_carpeta:nom_carpeta, ruta_carpeta:ruta_carpeta},
				success:function(result){
					//alert(result);
	            	if(result){
	            		alert('Carpeta Creada');
	            	}else{
	            		alert('Falló el servidor. Carpeta no creada');
	            	}
	            	Carga_tabla('<?php echo $ruta ?>');
        		}	
    		});
		});

	});
	function Index_tabla(){
		$("#page_content").load("Ver_Nube");
	}

	function Carga_tabla($ruta){

	//var ruta=$ruta;
	if($ruta.charAt($ruta.length-1)=="/"){
		ruta = $ruta.substring(0, $ruta.length - 1);
	}else{
		ruta = $ruta;
	}
	//alert(ruta);
	$("#page_content").load("Carga_tabla",{ruta:ruta});
	}

	function Delete_Archivo($nom_archivo){
		//alert($nom_archivo);
		nom_archivo=$nom_archivo.split('/');
		$("#Elimina_archivo").modal();
    	$("#delete_nombre").val(nom_archivo[nom_archivo.length - 1]);
    	$("#delete_ruta").val($nom_archivo);
	}
	
	function Delete_Carpeta($nom_carpeta){
		//alert($nom_carpeta);
		nom_carpeta=$nom_carpeta.split('/');
		$("#Elimina_carpeta").modal();
    	$("#delete_carpeta").val(nom_carpeta[nom_carpeta.length - 1]);
    	$("#delete_ruta_carpeta").val($nom_carpeta);
	}
</script>