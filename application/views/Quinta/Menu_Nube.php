<?php date_default_timezone_set("America/Mexico_City"); ?>
<div class="nav flex-column menu_nube">
	<div class="row">
		<div class="col-md-2">
			<img  src="<?php echo base_url() ?>Resources/Icons/nube.ico"><a>Nube SIGEN</a>
			<?php
			$listar=null;
			$directorio=opendir('Resources/Nube_Sigen/QM/');

			while ($elemento=readdir($directorio)) {
				if ($elemento!='.'&&$elemento!='..') {
					if(is_dir("Resources/Nube_Sigen/QM/".$elemento))
					{
						?>
						<!--href="<?php echo base_url() ?>Resources/Nube_Sigen/QM/<?php echo $elemento ?>/"-->
						<a style="font-size: 1rem" href="#" onclick="Carga_tabla(this.id)" id="<?php echo $elemento ?>" role="button" class="nav-link" ><img src="<?php echo base_url() ?>Resources/Icons/carpeta.ico" width="15px" ><?php echo $elemento ?></a>
						<?php

					}else{
						?>

						<a style="font-size: 0.65rem" class="nav-link" href="<?php echo base_url() ?>Resources/Nube_Sigen/QM/<?php echo $ruta."/".$elemento ?>" download="<?php echo $elemento; ?>"  ><?php echo $elemento ?></a>
						<?php
					}
				}
			}
			?>
			
			<div>
				<hr>
				<a  class="nav-item nav-link disabled" >Almacenamiento</a>
				<a class="nav-item nav-link disabled" style="font-size: 0.6rem"><?php echo $size_dir; ?> usados de 5GB</a>
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
					<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#New_Archivo"><img src="<?php echo base_url() ?>Resources/Icons/cloud-upload-symbol_icon-icons.com_56540.ico">Subir Archivo</button>
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
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if($ruta!=""){
								$listar=null;
								$directorio=opendir('Resources/Nube_Sigen/QM/'.$ruta);

								while ($elemento=readdir($directorio)) {
									if ($elemento!='.'&&$elemento!='..') {
										?>
										<tr>
											<?php
											if(is_dir("Resources/Nube_Sigen/QM/".$ruta."/".$elemento))
											{
												?>
												<td> <a style="font-size: 1rem" href="#" onclick="Carga_tabla(this.id)" id="<?php echo $ruta."/".$elemento ?>" role="button" class="nav-link" ><img src="<?php echo base_url() ?>Resources/Icons/carpeta.ico" width="15px" ><?php echo $elemento ?></a></td>
												<td><?php echo date ("d/m/Y H:i:s", filectime("Resources/Nube_Sigen/QM/".$ruta."/".$elemento)); ?></td>
												<td>-</td>
												<td><a role="button" class="btn btn-outline-dark" onclick="Delete_Carpeta(this.id)" id="<?php echo $ruta."/".$elemento ?>" data-toggle="modal" data-target="#deletecarpeta"><img height="20" src="..\Resources\Icons\delete.ico" alt="Eliminar" style="filter: invert(100%)" /></a></td>

												<?php

											}else{
												?>
												<td> <a style="font-size: 1rem" class="nav-link" href="#" role="button" onclick="Carga_Vista(this.id)" id="Resources/Nube_Sigen/QM/<?php echo $ruta."/".$elemento ?>"  ><?php echo $elemento ?></a>

												</td>

												<td><?php echo date ("d/m/Y H:i:s", filectime("Resources/Nube_Sigen/QM/".$ruta."/".$elemento)); ?></td>

												<?php $size=filesize("Resources/Nube_Sigen/QM/".$ruta."/".$elemento);
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
												<td>
													<a role="button" class="btn btn-outline-dark" onclick="Delete_Archivo(this.id)" id="<?php echo $ruta."/".$elemento ?>" data-toggle="modal" data-target="#deletearchivo"><img height="20" src="..\Resources\Icons\delete.ico" title="Eliminar" style="filter: invert(100%)" /></a>
													<a role="button" class="btn btn-outline-dark" onclick="Descarga_Archivo(this.id)" id="<?php echo $ruta."/".$elemento ?>" data-toggle="modal" ><img height="20" src="..\Resources\Icons\download.ico" title="Descargar" style="filter: invert(100%)" /></a>
												</td>
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






<!-- Vista Previa -->
<div class="modal fade bd-example-modal-lg" id="Preeliminar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div style="height: 500px;">
				<iframe width="100%"  height="100%" id="vista_previa"></iframe>

			</div>
		</div>
	</div>
</div>

<!-- Sin Vista Previa -->
<div class="modal fade" id="NoPreliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Archivo sin Vista Previa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        	<img id="no_vista_previa">
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Vista Previa -->
<div class="modal fade bd-example-modal-lg" id="Descarga_Modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div style="height: 500px;">
				<iframe width="100%"  height="100%" id="descarga_ruta"></iframe>

			</div>
		</div>
	</div>
</div>

<a href="" id="descarga_iframe" download="true"><iframe id="" style="display:none;"></iframe></a>




<!-- Modal Justifica Borrado Archivo -->
<div class="modal fade" id="Elimina_archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Justifica para eliminar el archivo:</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
		        	<div class="col-md-12">
		        		<input class="form-control" type="text" disabled="true" name="delete_nombre" id="delete_nombre">
		        		<input class="form-control" type="text" disabled="true" hidden="true" name="delete_ruta_archivo" id="delete_ruta_archivo">
		        	</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<textarea id="txt_justifica_archivo" onkeyup="countChars(this);" class="form-control input-sm" maxlength="500"></textarea>
						<p id="charNum">Restan 500 caracteres</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 alert-danger">
						<p>Se eliminará el archivo seleccionado. </p>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
				<button type="button" class="btn btn-primary" id="Solicita_borrado_archivo" data-dismiss="modal">Solicitar Borrado</button>
			</div>
		</div>
	</div>
</div>




<!-- Modal Justifica Borrado Carpeta -->
<div class="modal fade" id="Elimina_carpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Justifica para eliminar la Carpeta:</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<input class="form-control" type="text" disabled="true" name="delete_carpeta" id="delete_carpeta">
						<input class="form-control" type="text" disabled="true" hidden="true" name="delete_ruta_carpeta" id="delete_ruta_carpeta">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<textarea id="txt_justifica_carpeta" onkeyup="countChars(this);" class="form-control input-sm" maxlength="500"></textarea>
						<p id="charNum">Restan 500 caracteres</p>
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
				<button type="button" class="btn btn-primary" id="Solicita_borrado_carpeta" data-dismiss="modal">Solicitar Borrado</button>
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

<!-- Subir Archivo -->
<div class="modal fade" id="New_Archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Subir Nuevo Archivo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form class="form-group" id="add_archivo">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<label class="label-control">Ubicación del archivo</label>
							<input class="form-control" type="text" name="nueva_ruta" id="nueva_ruta" readonly="true" value="Nube_Sigen/<?php echo $ruta ?>">
						</div>
					</div>
					<div class="row">
						<input type="file" class="form-control" name="add_file" id="add_file" accept="application/*, image/*">
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="wrapper mt-5" style="display: none;">
								<div class="progress progress_wrapper">
									<div class="progress-bar progress-bar-striped bg-info progress-bar-animated progress_bar" role="progressbar" style="width: 0%;">0%</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-outline-success submitBtn" id="savefile">Guardar</button>
                	<button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal Descarga_archivo -->

<div class="modal fade" id="Descarga_archivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Descarga Archivo</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label class="label-control">Archivo a descargar</label>
						<input class="form-control" type="text" disabled="true" name="descarga_nombre" id="descarga_nombre">
						<input class="form-control" type="text" disabled="true" hidden="true" name="descarga_ruta_archivo" id="descarga_ruta_archivo">
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label class="label-control">Contraseña para Descarga</label>
						<input class="form-control" required="true" type="password" name="pass_descarga" id="pass_descarga">
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
				<button type="button" class="btn btn-primary" id="Solicita_descarga_archivo" data-dismiss="modal">Solicitar Descarga</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#table_nube').DataTable();
		
		$('#crearcarpeta').click(function(){
			ruta_carpeta=$("#ruta_nueva_carpeta").val();
			nom_carpeta=$("#nueva_carpeta").val();
			//alert(ruta_carpeta+" "+nom_carpeta);
			$.ajax({
				type:"POST",
				url:"<?php echo base_url();?>Quinta/Crea_Carpeta",
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


    $('#Solicita_borrado_carpeta').click(function(){
    	txt_justifica=$("#txt_justifica_carpeta").val();
		delete_ruta_carpeta=$("#delete_ruta_carpeta").val();
      if(txt_justifica!=""){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/Solicita_Borra_carpeta",
          data:{txt_justifica:txt_justifica, delete_ruta_carpeta:delete_ruta_carpeta},
                success:function(result){
                  //alert(result);
                  if(result){
                    alert('Solicitud enviada al Administrador para eliminar la carpeta indicada.');
                  }else{
                    alert('Falló el servidor. Solicitud para eliminar carpeta no enviada.');
                  }
                  Carga_tabla('<?php echo $ruta ?>');
                }
              });
           }else{
            alert("ASolicitud de borrado no completada. Debe justificar los cambios solicitados ya que estos requieren autorización del Administrador.");
           }
    });

    $('#Solicita_borrado_archivo').click(function(){
    	txt_justifica=$("#txt_justifica_archivo").val();
		delete_ruta_archivo=$("#delete_ruta_archivo").val();
      if(txt_justifica!=""){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/Solicita_Borra_archivo",
          data:{txt_justifica:txt_justifica, delete_ruta_archivo:delete_ruta_archivo},
                success:function(result){
                  //alert(result);
                  if(result){
                    alert('Solicitud enviada al Administrador para eliminar el archivo indicado.');
                  }else{
                    alert('Falló el servidor. Solicitud para eliminar archivo no enviada.');
                  }
                  Carga_tabla('<?php echo $ruta ?>');
                }
              });
           }else{
            alert("Solicitud de borrado no completada. Debe justificar los cambios solicitados ya que estos requieren autorización del Administrador.");
           }
    });
    

    $('#Solicita_descarga_archivo').click(function(){
		descarga_ruta_archivo=$("#descarga_ruta_archivo").val();
		descarga_nombre=$("#descarga_nombre").val();
		pass_descarga=$("#pass_descarga").val();
      if(pass_descarga!=""){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/Solicita_descarga_archivo",
          data:{descarga_ruta_archivo:descarga_ruta_archivo, descarga_nombre:descarga_nombre, pass_descarga:pass_descarga},
                success:function(result){
                  //alert(result);
                  if(result){
                  	descargar(descarga_ruta_archivo);
                    alert('Archivo descargado');
                  }else{
                    alert('Debe indicar la contraseña correcta para descargar el archivo.');
                  }
                  Carga_tabla('<?php echo $ruta ?>');
                }
              });
           }else{
            alert("Debe indicar una contraseña para descargar el archivo.");
           }
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
    	$("#delete_ruta_archivo").val($nom_archivo);
	}
	
	function Delete_Carpeta($nom_carpeta){
		//alert($nom_carpeta);
		nom_carpeta=$nom_carpeta.split('/');
		$("#Elimina_carpeta").modal();
    	$("#delete_carpeta").val(nom_carpeta[nom_carpeta.length - 1]);
    	$("#delete_ruta_carpeta").val($nom_carpeta);
	}

	function Descarga_Archivo($nom_archivo){
		//alert($nom_archivo);
		nom_archivo=$nom_archivo.split('/');
		$("#Descarga_archivo").modal();
    	$("#descarga_nombre").val(nom_archivo[nom_archivo.length - 1]);
    	$("#descarga_ruta_archivo").val($nom_archivo);
	}

	function Carga_Vista($ruta){
		ruta=$ruta;
		//alert(ruta);
		tipo_archivo=ruta.split('.');
		if(tipo_archivo[1]=="pdf"){
			$("#Preeliminar").modal();
			$("#vista_previa").removeAttr('src');
			base_url="<?php echo base_url() ?>";
	    	$("#vista_previa").attr('src',base_url+ruta+"#toolbar=0&navpanes=0&scrollbar=0");
		}else{
			$("#NoPreliminar").modal();
			$("#no_vista_previa").removeAttr('src');
			ruta_nueva="<?php echo base_url() ?>Resources/Icons/not_previwe.ico";
    		$("#no_vista_previa").attr('src',ruta_nueva+"#toolbar=0&navpanes=0&scrollbar=0");
		}
	}

	function descargar($ruta){
		ruta="Resources/Nube_Sigen/QM/"+$ruta;
		base_url="<?php echo base_url() ?>";
			window.open(base_url+ruta, "_blank");
	}


</script>


<script>
$(document).ready(()=>{

		$("#add_archivo").on('submit', function(e){
			//alert("Entra");
			e.preventDefault();

			wrapper=$('.wrapper');
			progress_bar=$('.progress_bar');

			progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
			progress_bar.css('width','0%');
			progress_bar.html('Preparando...');
			wrapper.fadeIn();



			$.ajax({
				xhr: function(){
					let xhr= new window.XMLHttpRequest();
					xhr.upload.addEventListener("progress", function(e){
						if(e.lengthComputable){
							let percentComplete=Math.floor((e.loaded/e.total)*100);
							progress_bar.css('width', percentComplete+'%');
							progress_bar.html(percentComplete+'%');
						}
					},false);
					return xhr;
				},

				type: 'POST',
				url: '<?php echo base_url(); ?>Quinta/Add_File',
				data: new FormData(this),
				contentType: false,
				cache: false,
				processData:false,
				beforeSend: () => {
					$('#savefile').attr('disabled',true);
				}
			}).done(res=>{
				if(res){
					progress_bar.removeClass('bg-info').addClass('bg-success')
	            	progress_bar.html('Carga Completa');
	            	$('#add_archivo').trigger('reset');
	            	setTimeout(()=>{
	            		wrapper.fadeOut();
	            		progress_bar.removeClass('bg-success bg-danger').addClass('bg-info');
	            		progress_bar.css('width','0%');
	            		progress_bar.html('Preparando');
	            	},1500);
	            	//alert("Archivo Cargado con éxito");
				}else{
					progress_bar.removeClass('bg-success bg-info').addClass('bg-danger')
					progress_bar.css('width','100%');
	            	progress_bar.html('Error al Subir el Archivo');
	            	
				}

			}).fail(err=>{
				progress_bar.removeClass('bg-success bg-info').addClass('bg-danger')
	            progress_bar.html('Error de Carga');
	            alert("Error");
			}).always(res=>{
				if(res){
					alert("Archivo Cargado con éxito");
				}else{
					alert("Error al Subir el Archivo");
				}
				$('#add_archivo').css("opacity","");
	            $(".submitBtn").removeAttr("disabled");
	            $('.modal-backdrop').remove();
				Carga_tabla('<?php echo $ruta ?>');
			});
		});
	});


</script>