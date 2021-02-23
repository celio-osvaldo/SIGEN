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
				<a class="nav-item nav-link disabled" style="font-size: 0.6rem">500MB usados de 1000MB</a>
			</div>
		</div>
		<div class="col-md-10">
			<!--Mostrar listado de Archivos en Nube SIGEN -->
<div id="lista_nube">
    <div class="row">
      <div class="col-md-7">
       <!-- <h3 align="center">Almacenamiento en Nube SIGEN</h3><br>  -->

       <a href="#">Ubicación Actual: Nube_Sigen/Iluminacion/<?php echo $ruta; ?></a>
     </div>
     <div class="col-md-5">
      <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewInv_OfficeModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nueva Carpeta</button>
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
            <th>Vista previa</th>
            <th>Descargar</th>
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
                  <td> <a style="font-size: 1rem" href="#" onclick="Carga_tabla(this.id)" id="<?php echo $elemento ?>" role="button" class="nav-link" ><img src="<?php echo base_url() ?>Resources/Icons/carpeta.ico" width="15px" ><?php echo $elemento ?></a></td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                  <td>5</td>
                  <td>6</td>
                  <!--href="<?php echo base_url() ?>Resources/Nube_Sigen/Iluminacion/<?php echo $elemento ?>/"-->

                  <?php

                }else{
                  ?>
                  <td> <a style="font-size: rem" class="nav-link" href="<?php echo base_url() ?>Resources/Nube_Sigen/Iluminacion/<?php echo $elemento ?>" target="_blank"><?php echo $elemento ?></a></td>
                  <td>2</td>
                  <td>3</td>
                  <td>4</td>
                  <td>5</td>
                  <td>6</td>
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


<script type="text/javascript">

  $(document).ready(function(){

   });

function Carga_tabla($ruta){
	//alert($ruta);
	var ruta=$ruta;
   $("#page_content").load("Carga_tabla",{ruta:ruta});
}
  
</script>


<script type="text/javascript">

  $(document).ready(function(){
    $('#table_nube').DataTable();
  });
</script>
