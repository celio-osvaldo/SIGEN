<div class="card bg-card">
 <div class="table-responsive">
  <br>
  <div class="table-responsive">
   <table id="table_solicitudes" class="table table-hover display table-striped" style="font-size: 10pt;">
    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
     <tr>
      <th>Id Solicitud Cambio</th>
      <th >Usuario</th>
      <th >Fecha de Solicitud</th>
      <th >Comentario</th>
      <th >Estado de Solicitud</th>
      <th >Acciones</th>
    </tr>
  </thead>
  <tbody style="font-weight: bolder;" align="center">
   <?php
   foreach ($solicitado->result() as $row) {?>								
    <tr>
     <td id="<?php echo "id_historial_proyecto_info"; ?>"><?php echo "INFO-".$row->id_historial_proyecto_info."";?></td>
     <td id="<?php echo "usuario".$row->id_historial_proyecto_info.""; ?>"><?php echo "".$row->usuario_nom."";?></td>
     <td id="<?php echo "fecha".$row->id_historial_proyecto_info.""; ?>"><?php echo "".$row->historial_proyecto_fecha_actualizacion."";?></td>
     <td id="<?php echo "coment".$row->id_historial_proyecto_info.""; ?>"><?php echo "".$row->historial_proyecto_coment_justifica."";?></td>
     <td id="<?php echo "estado".$row->id_historial_proyecto_info.""; ?>"><?php echo "".$row->estado."";?></td>	
     <?php if ($row->historial_proyecto_autoriza=="1"){ ?>
      <td><a role="button" class="btn btn-outline-dark" onclick="Responder_Solicitud(this.id)" id="<?php echo "".$row->id_historial_proyecto_info.""; ?>" ><img width="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Responder" style="filter: invert(100%)" /></a></td>						
    <?php }else{?>
      <td>Solicitud Procesada
      <?php }?>								
    </td>
  </tr>
<?php } ?>
<?php
foreach ($solicitado_pago->result() as $row) {?>								
  <tr>
   <td id="<?php echo "id_historial_proyecto_pago"; ?>"><?php echo "PAGO-".$row->id_historial_proyecto_pago."";?></td>
   <td id="<?php echo "usuario".$row->id_historial_proyecto_pago.""; ?>"><?php echo "".$row->usuario_nom."";?></td>
   <td id="<?php echo "fecha".$row->id_historial_proyecto_pago.""; ?>"><?php echo "".$row->historial_proyecto_pago_fecha_actualizacion."";?></td>
   <td id="<?php echo "coment".$row->id_historial_proyecto_pago.""; ?>"><?php echo "".$row->historial_proyecto_pago_justifica."";?></td>
   <td id="<?php echo "estado".$row->id_historial_proyecto_pago.""; ?>"><?php echo "".$row->estado."";?></td>	
   <?php if ($row->historial_proyecto_pago_autoriza=="1"){ ?>
    <td><a role="button" class="btn btn-outline-dark" onclick="Responder_Solicitud_pago(this.id)" id="<?php echo "".$row->id_historial_proyecto_pago.""; ?>" ><img width="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Responder" style="filter: invert(100%)" /></a></td>							
  <?php }else{?>
    <td>Solicitud Procesada
    <?php }?>								

  </td>
</tr>
<?php } ?>

<?php
foreach ($solicita_elimina_carpeta->result() as $row) {?>                
  <tr>
    <td id="<?php echo "id_borra_nube_carpeta"; ?>"><?php echo "Elimina-Carpeta-".$row->id_borra_nube."";?></td>
    <td id="<?php echo "usuario".$row->id_borra_nube.""; ?>"><?php echo "".$row->usuario_nom."";?></td>
    <td id="<?php echo "fecha".$row->id_borra_nube.""; ?>"><?php echo "".$row->borra_nube_fecha_solicitud."";?></td>
    <td id="<?php echo "coment".$row->id_borra_nube.""; ?>"><?php echo "".$row->borra_nube_comentario."";?></td>
    <td id="<?php echo "estado".$row->id_borra_nube.""; ?>"><?php echo "".$row->estado."";?></td>  
    <?php if ($row->borra_nube_id_estado=="1"){ ?>
      <td><a role="button" class="btn btn-outline-dark" onclick="Responder_Solicitud_elimina_carpeta(this.id)" id="<?php echo "".$row->id_borra_nube.""; ?>" ><img width="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Responder" style="filter: invert(100%)" /></a></td>               
    <?php }else{?>
      <td>Solicitud Procesada
      <?php }?>               

    </td>
  </tr>
<?php } ?>

<?php
foreach ($solicita_elimina_archivo->result() as $row) {?>                
  <tr>
    <td id="<?php echo "id_borra_nube_archivo"; ?>"><?php echo "Elimina-Archivo-".$row->id_borra_nube."";?></td>
    <td id="<?php echo "usuario".$row->id_borra_nube.""; ?>"><?php echo "".$row->usuario_nom."";?></td>
    <td id="<?php echo "fecha".$row->id_borra_nube.""; ?>"><?php echo "".$row->borra_nube_fecha_solicitud."";?></td>
    <td id="<?php echo "coment".$row->id_borra_nube.""; ?>"><?php echo "".$row->borra_nube_comentario."";?></td>
    <td id="<?php echo "estado".$row->id_borra_nube.""; ?>"><?php echo "".$row->estado."";?></td>  
    <?php if ($row->borra_nube_id_estado=="1"){ ?>
      <td><a role="button" class="btn btn-outline-dark" onclick="Responder_Solicitud_elimina_archivo(this.id)" id="<?php echo "".$row->id_borra_nube.""; ?>" ><img width="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Responder" style="filter: invert(100%)" /></a> </td>               
    <?php }else{?>
      <td>Solicitud Procesada
      <?php }?>               
    </td>
  </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>

<!-- Modal -->
<div id="AtiendeModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
      	<h4 class="modal-title">Atención a Solicitud de Cambio</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
      	<div class="row justify-content-md-center" style="font-size: 15pt;">
      		<label id="id_atn_sol" hidden="true"></label>
      		<label>Empresa:&nbsp;</label><label id="empresa"></label>
      		<label id="id_proyecto" hidden="true"></label>
      	</div>
      	
      	<div class="row justify-content-md-center" >
         <label>Nombre del Solicitante:&nbsp;</label><label id="lbl_solicitante"></label>   	
       </div>
       <div class="row">
         <label>Fecha de solicitud:&nbsp;</label><label id="lbl_fecha"></label>   	
       </div>
       <div id="proyecto">
        <div class="row">
         <label class="col-5">Nombre Proyecto Actual</label>
         <label class="col-1"></label>
         <label class="col-6" id>Nombre Proyecto Cambio</label>
       </div>
       <div class="row">
         <textarea id="proy_actual" class="col-5" disabled="true"></textarea>
         <label class="col-1"></label>
         <textarea type="text" id="proy_cambio" class="col-6" disabled="true"></textarea>
       </div>
     </div>
     <div id="cliente" >
      <div class="row">
       <label class="col-5">Cliente Actual</label>
       <label class="col-2"></label>
       <label class="col-5">Cliente Cambio</label>
     </div>
     <div class="row">
       <input type="text" id="cli_actual" class="col-5" disabled="true">
       <label class="col-2"></label>
       <input type="text" id="cli_cambio" class="col-5" disabled="true">
       <input type="text" id="cli_cambio_id" hidden="true"> 
     </div>
   </div>
   <div id="importe" > 
    <div class="row">
     <label class="col-5">Importe Actual</label>
     <label class="col-2"></label>
     <label class="col-5">Importe Cambio</label>
   </div>
   <div class="row">
     <input type="text" id="imp_actual" class="col-5" disabled="true">
     <label class="col-2"></label>
     <input type="text" id="imp_cambio" class="col-5" disabled="true">
   </div>
 </div>
 <div id="estado" >
  <div class="row">
   <label class="col-5">Estado Actual</label>
   <label class="col-2"></label>
   <label class="col-5">Estado Cambio</label>
 </div>
 <div class="row">
   <input type="text" id="estado_actual" class="col-5" disabled="true">
   <label class="col-2"></label>
   <input type="text" id="estado_cambio" class="col-5" disabled="true">
 </div>
</div>
<div id="coment" >
  <div class="row">
   <label class="col-5">Comentario Actual</label>
   <label class="col-2"></label>
   <label class="col-5">Comentario Cambio</label>
 </div>
 <div class="row">
   <textarea id="coment_actual" class="col-5" disabled="true"></textarea>
   <label class="col-2"></label>
   <textarea id="coment_cambio" class="col-5" disabled="true"></textarea>
 </div>
</div>
<div class="row">
  <label>Observaciones:</label>      		
</div>
<div class="row">
  <textarea id="txt_obs" disabled="true" class="col-md"></textarea>
</div>
<div class="row">
  <select id="respuesta" onchange="Activa_Boton()">
   <option value="0" selected="true">Seleccione una respuesta</option>
   <option value="2">Autorizar</option>
   <option value="3">Rechazar</option>
 </select>
</div>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
 <button type="button" class="btn btn-success"  id="btn_procesar" disabled="true" data-dismiss="modal">Procesar</button>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div id="AtiendeModal_pago" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
      	<h4 class="modal-title">Atención a Solicitud de Cambio</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
      	<div class="row justify-content-md-center" style="font-size: 15pt;">
      		<label id="id_atn_sol_pago" hidden="true"></label>
      		<label>Empresa:&nbsp;</label><label id="empresa_pago"></label>
      		<label id="id_pago" hidden="true"></label>
      	</div>
      	
      	<div class="row justify-content-md-center" >
         <label>Nombre del Solicitante:&nbsp;</label><label id="lbl_solicitante_pago"></label>   	
       </div>
       <div class="row">
         <label>Fecha de solicitud:&nbsp;</label><label id="lbl_fecha_pago"></label>   	
       </div>
       <div id="pago_fecha">
        <div class="row">
         <label class="col-5">Fecha de Pago Actual</label>
         <label class="col-1"></label>
         <label class="col-6">Fecha de Pago Cambio</label>
       </div>
       <div class="row">
         <input type="date" id="fecha_pago_old" class="col-5" disabled="true">
         <label class="col-1"></label>
         <input type="date" id="fecha_pago_new" class="col-6" disabled="true">
       </div>
     </div>
     <div id="monto">
      <div class="row">
       <label class="col-5">Monto Pagado Actual</label>
       <label class="col-2"></label>
       <label class="col-5">Monto Pagado Cambio</label>
     </div>
     <div class="row">
       <input type="text" id="monto_old" class="col-5" disabled="true">
       <label class="col-2"></label>
       <input type="text" id="monto_new" class="col-5" disabled="true">
     </div>
   </div>
   <div id="coment_pago"> 
    <div class="row">
     <label class="col-5">Comentario Actual</label>
     <label class="col-2"></label>
     <label class="col-5">Comentario Cambio</label>
   </div>
   <div class="row">
     <input type="text" id="comentario_old" class="col-5" disabled="true">
     <label class="col-2"></label>
     <input type="text" id="comentario_new" class="col-5" disabled="true">
   </div>
 </div>
 <div id="aplica_flujo" > 
  <div class="row">
    <label class="col-5">Aplica a Reporte de Flujo (Actual)</label>
    <label class="col-2"></label>
    <label class="col-5">Aplica a Reporte de Flujo (Cambio)</label>
  </div>
  <div class="row">
    <input type="text" id="aplica_flujo_old" class="col-5" disabled="true">
    <label class="col-2"></label>
    <input type="text" id="aplica_flujo_new" class="col-5" disabled="true">
  </div>
</div>
<div class="row">
  <label>Observaciones:</label>      		
</div>
<div class="row">
  <textarea id="txt_obs_pago" disabled="true" class="col-md"></textarea>
</div>
<div class="row">
  <select id="respuesta_pago" onchange="Activa_Boton()">
   <option value="0" selected="true">Seleccione una respuesta</option>
   <option value="2">Autorizar</option>
   <option value="3">Rechazar</option>
 </select>
</div>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
 <button type="button" class="btn btn-success"  id="btn_procesar_pago" disabled="true" data-dismiss="modal">Procesar</button>
</div>
</div>
</div>
</div>





<!-- Modal Elimna Carpeta-->
<div id="AtiendeModal_elimina_carpeta" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <h4 class="modal-title">Atención a Solicitud de Eliminar Carpeta en Nube SiGeN</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <label class="label-control">Empresa:&nbsp;</label>
          <label class="label-control"name="empresa_nube" id="empresa_nube" disabled="true"></label>
          <input type="text" name="id_borra_carpeta" id="id_borra_carpeta" hidden="true" disabled="true">
        </div>  
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <div class="col-md-12">
            <label>Carpeta a Eliminar </label>
            <input class="form-control" type="text" name="url_carpeta" id="url_carpeta" disabled="true">
          </div>
        </div>        
        <div class="row justify-content-md-center" >
          <label>Nombre del Solicitante:&nbsp;</label><label id="usuario_carpeta"></label>     
        </div>
        <div class="row justify-content-md-center">
          <label>Fecha de solicitud:&nbsp;</label>
          <input type="date" name="fecha_solicita_carpeta" id="fecha_solicita_carpeta" disabled="true">  
        </div>
        
        <div class="row">
          <label>Observaciones:</label>         
        </div>
        <div class="row">
          <textarea id="txt_coment_carpeta" disabled="true" class="col-md"></textarea>
        </div>
        <div class="row">
          <select id="respuesta_elimina_carpeta" onchange="Activa_Boton()">
            <option value="0" selected="true">Seleccione una respuesta</option>
            <option value="2">Autorizar</option>
            <option value="3">Rechazar</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success"  id="btn_procesar_elimina_carpeta" disabled="true" data-dismiss="modal">Procesar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Elimna Archivo-->
<div id="AtiendeModal_elimina_archivo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <h4 class="modal-title">Atención a Solicitud de Eliminar Archivo en Nube SiGeN</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <label class="label-control">Empresa:&nbsp;</label>
          <label class="label-control"name="empresa_nube_archivo" id="empresa_nube_archivo" disabled="true"></label>
          <input type="text" name="id_borra_archivo" id="id_borra_archivo" hidden="true" disabled="true">
        </div>  
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <div class="col-md-12">
            <label>Archivo a Eliminar </label>
            <input class="form-control" type="text" name="url_archivo" id="url_archivo" disabled="true">
          </div>
        </div>        
        
        <div class="row justify-content-md-center" >
          <label>Nombre del Solicitante:&nbsp;</label><label id="usuario_acrhivo"></label>     
        </div>
        <div class="row justify-content-md-center">
          <label>Fecha de solicitud:&nbsp;</label>
          <input type="date" name="fecha_solicita_archivo" id="fecha_solicita_archivo" disabled="true">  
        </div>
        
        <div class="row">
          <label>Observaciones:</label>         
        </div>
        <div class="row">
          <textarea id="txt_coment_archivo" disabled="true" class="col-md"></textarea>
        </div>
        <div class="row">
          <select id="respuesta_elimina_archivo" onchange="Activa_Boton()">
            <option value="0" selected="true">Seleccione una respuesta</option>
            <option value="2">Autorizar</option>
            <option value="3">Rechazar</option>
          </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success"  id="btn_procesar_elimina_archivo" disabled="true" data-dismiss="modal">Procesar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="ConfirmaModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
      	<h4 class="modal-title">Confirma Respuesta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
      	<div class="row justify-content-md-center" style="font-size: 15pt;">
      		<label>Confirme su respuesta: </label>
      	</div>
      	<div class="row justify-content-md-center" style="font-size: 15pt;">
      		<label id="respuesta_final" class="bg-warning"></label><label class="bg-warning">&nbsp; Solicitud</label>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success"  id="btn_confirma" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="ConfirmaModal_pago" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
      	<h4 class="modal-title">Confirma Respuesta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <div class="modal-body">
      	<div class="row justify-content-md-center" style="font-size: 15pt;">
      		<label>Confirme su respuesta: </label>
      	</div>
      	<div class="row justify-content-md-center" style="font-size: 15pt;">
      		<label id="respuesta_final_pago" class="bg-warning"></label><label class="bg-warning">&nbsp; Solicitud</label>
      	</div>
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success"  id="btn_confirma_pago" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="ConfirmaModal_elimina_carpeta" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <h4 class="modal-title">Confirma Respuesta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <label>Confirme su respuesta: </label>
        </div>
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <label id="respuesta_final_elimina_carpeta" class="bg-warning"></label><label class="bg-warning">&nbsp; Solicitud</label>
        </div>
        <div class="row justify-content-md-center" style="font-size: 13pt;">
          <label id="advertencia_elimina_carpeta" class="bg-danger"></label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success"  id="btn_confirma_elimina_carpeta" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="ConfirmaModal_elimina_archivo" class="modal fade" role="dialog">
  <div class="modal-dialog modal-md">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header" >
        <h4 class="modal-title">Confirma Respuesta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <label>Confirme su respuesta: </label>
        </div>
        <div class="row justify-content-md-center" style="font-size: 15pt;">
          <label id="respuesta_final_elimina_archivo" class="bg-warning"></label><label class="bg-warning">&nbsp; Solicitud</label>
        </div>
        <div class="row justify-content-md-center" style="font-size: 13pt;">
          <label id="advertencia_elimina_archivo" class="bg-danger"></label>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success"  id="btn_confirma_elimina_archivo" data-dismiss="modal">Confirmar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#table_solicitudes').DataTable({
      "order": [[ 5, "asc" ]]
    });

    $('#btn_procesar').click(function(){
    	respuesta=$("#respuesta").val();
    	respuesta_txt=$("#respuesta option:selected").text();
      id_historial=$('#id_atn_sol').text();
      $("#ConfirmaModal").modal();
      $("#respuesta_final").text(respuesta_txt);
    });

    $('#btn_procesar_pago').click(function(){
    	respuesta_pago=$("#respuesta_pago").val();
    	respuesta_txt_pago=$("#respuesta_pago option:selected").text();
      id_historial_pago=$('#id_atn_sol_pago').text();
      $("#ConfirmaModal_pago").modal();
      $("#respuesta_final_pago").text(respuesta_txt_pago);
    });

    $('#btn_procesar_elimina_carpeta').click(function(){
      respuesta_elimina_carpeta=$("#respuesta_elimina_carpeta").val();
      respuesta_txt_elimina_carpeta=$("#respuesta_elimina_carpeta option:selected").text();
      id_borra_nube_carpeta=$('#id_borra_carpeta').text();
      $("#ConfirmaModal_elimina_carpeta").modal();
      $("#respuesta_final_elimina_carpeta").text(respuesta_txt_elimina_carpeta);
      if (respuesta_txt_elimina_carpeta=="Autorizar") {
        $("#advertencia_elimina_carpeta").text("AL ELIMINAR UNA CARPETA LOS ARCHIVOS Y CARPETAS CONTENIDAS EN ELLA TAMBIÉN SERÁN ELIMINADOS");
      }else{
        $("#advertencia_elimina_carpeta").text("");
      }
    });

    $('#btn_procesar_elimina_archivo').click(function(){
      respuesta_elimina_archivo=$("#respuesta_elimina_archivo").val();
      respuesta_txt_elimina_archivo=$("#respuesta_elimina_archivo option:selected").text();
      id_borra_nube_archivo=$('#id_borra_archivo').text();
      $("#ConfirmaModal_elimina_archivo").modal();
      $("#respuesta_final_elimina_archivo").text(respuesta_txt_elimina_archivo);
      if (respuesta_txt_elimina_archivo=="Autorizar") {
        $("#advertencia_elimina_archivo").text("AL ELIMINAR EL ARCHIVO YA NO SERÁ RECUPERABLE");
      }else{
        $("#advertencia_elimina_archivo").text("");
      }
    });


    $('#btn_confirma').click(function(){
      id_historial=$('#id_atn_sol').text();
      respuesta=$("#respuesta").val();
    	 //alert(id_historial+" "+ respuesta);

      nom_proy_new=$("#proy_cambio").val();
      cliente_new=$("#cli_cambio_id").val();
      importe_new=$("#imp_cambio").val();
		  estado_new=$("#estado_cambio").val(); //1-Activo. 2-Pagado 3-Cancelado
		  if (estado_new=="Activo") {
        estado_new=1;
      }else{
       if(estado_new=="Pagado"){
        estado_new=2;
      }else{
        estado_new=3;
      }
    }
    coment_new=$("#coment_cambio").val();
    id_proyecto=$("#id_proyecto").text();
		//alert(id_historial+" "+respuesta+" "+nom_proy_new+" "+cliente_new+" "+importe_new+" "+estado_new+" "+coment_new);
    $.ajax({
      type:"POST",
      url:"<?php echo base_url();?>SuperUser/Procesa_Solicitud",
      data:{id_historial:id_historial, respuesta:respuesta, nom_proy_new:nom_proy_new, cliente_new:cliente_new, importe_new:importe_new, estado_new:estado_new, coment_new:coment_new, id_proyecto:id_proyecto},
      success:function(result){
            //alert(result);
            if(result){
              alert('Cambios realizados');
            }else{
              alert('Falló el servidor. Cambios no realizados');
            }
          }
        });
    Update_Page();
  });


    $('#btn_confirma_pago').click(function(){
      id_historial_pago=$('#id_atn_sol_pago').text();
      respuesta_pago=$("#respuesta_pago").val();
    	 //alert(id_historial+" "+ respuesta);

      fecha_pago_new=$("#fecha_pago_new").val();
      monto_new=$("#monto_new").val();
      comentario_new=$("#comentario_new").val();
      aplica_flujo_new=$("#aplica_flujo_new").val();
      if(aplica_flujo_new=="NO"){
        aplica_flujo_new=0;
      }else{
        aplica_flujo_new=1;
      }
      id_pago=$("#id_pago").text();
		//alert(id_historial_pago+" "+respuesta_pago+" "+fecha_pago_new+" "+monto_new+" "+comentario_new+" "+id_pago);
    $.ajax({
      type:"POST",
      url:"<?php echo base_url();?>SuperUser/Procesa_Solicitud_pago",
      data:{id_historial_pago:id_historial_pago, respuesta_pago:respuesta_pago, fecha_pago_new:fecha_pago_new, monto_new:monto_new, comentario_new:comentario_new, id_pago:id_pago, aplica_flujo_new:aplica_flujo_new},
      success:function(result){
            //alert(result);
            if(result=="cambio anterior"){
              alert("Solicitud similar realiza con anterioridad. Estado de solicitud Actualizado");
            }else{
              if(result){
              alert('Cambios realizados');
            }else{
              alert('Falló el servidor. Cambios no realizados');
            }
            }

          }
        });
    Update_Page();
  });

    $('#btn_confirma_elimina_carpeta').click(function(){
     id_borra_nube_carpeta=$('#id_borra_nube_carpeta').text().split('Elimina-Carpeta-');
     respuesta_elimina_carpeta=$("#respuesta_elimina_carpeta").val();

     id_borra_carpeta=id_borra_nube_carpeta[1];

     empresa_nube=$("#empresa_nube").text();
     url_carpeta=$("#url_carpeta").val();

        //alert(id_borra_carpeta+" "+ respuesta_elimina_carpeta+" "+empresa_nube+" "+url_carpeta);
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>SuperUser/Borra_Carpeta",
          data:{id_borra_carpeta:id_borra_carpeta, respuesta_elimina_carpeta:respuesta_elimina_carpeta, empresa_nube:empresa_nube, url_carpeta:url_carpeta },
          success:function(result){
            //alert(result);
            if(result){
              alert('Cambios realizados en Nube SiGeN');
            }else{
              alert('Falló el servidor. Cambios no realizados');
            }
          }
        });
        Update_Page();
      });

    $('#btn_confirma_elimina_archivo').click(function(){
     id_borra_nube_archivo=$('#id_borra_nube_archivo').text().split('Elimina-Archivo-');
     respuesta_elimina_archivo=$("#respuesta_elimina_archivo").val();

     id_borra_nube_archivo=id_borra_nube_archivo[1];

     empresa_nube=$("#empresa_nube_archivo").text();
     url_archivo=$("#url_archivo").val();

        //alert(id_borra_nube_archivo+" "+ respuesta_elimina_archivo+" "+empresa_nube+" "+url_archivo);
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>SuperUser/Borra_Archivo",
          data:{id_borra_nube_archivo:id_borra_nube_archivo, respuesta_elimina_archivo:respuesta_elimina_archivo, empresa_nube:empresa_nube, url_archivo:url_archivo },
          success:function(result){
            //alert(result);
            if(result){
              alert('Cambios realizados en Nube SiGeN');
            }else{
              alert('Falló el servidor. Cambios no realizados');
            }
          }
        });
        Update_Page();
      });


  });

function Responder_Solicitud($id_historial){
  <?php foreach ($solicitado->result() as $row2 ): ?>
   if (<?php echo $row2->id_historial_proyecto_info?>==$id_historial) {
    <?php switch ($row2->empresa_id_empresa) {
     case '1':
     $empresa="Iluminación";
     break;
     case '2':
     $empresa="DASA";
     break;
     case '3':
     $empresa="SALINAS";
     break;

     default:
						# code...
     break;
   } ?>
   cli_actual="<?php echo $row2->historial_proyecto_id_cliente_old ?>";
   cli_cambio="<?php echo $row2->historial_proyecto_id_cliente_new ?>";
   cli_cambio_id=cli_cambio;
   <?php foreach ($catalogo_cliente->result() as $clie): ?>
    if (<?php echo $clie->id_catalogo_cliente?>==cli_actual) {
     cli_actual="<?php echo $clie->catalogo_cliente_empresa?>";
   }
   if (<?php echo $clie->id_catalogo_cliente?>==cli_cambio) {
     cli_cambio="<?php echo $clie->catalogo_cliente_empresa?>";
   }
 <?php endforeach ?>
 nom_proy_actual="<?php echo $row2->historial_proyecto_nombre_old ?>";
 nom_proy_cambio="<?php echo $row2->historial_proyecto_nombre_new ?>";				
 imp_actual="<?php echo $row2->historial_proyecto_importe_old ?>";
 imp_cambio="<?php echo $row2->historial_proyecto_importe_new ?>";
 estado_actual="<?php echo $row2->historial_proyecto_estado_old ?>";
 estado_cambio="<?php echo $row2->historial_proyecto_estado_new ?>";
 coment_actual="<?php echo preg_replace('/[\r\n]+/', ' ', $row2->historial_proyecto_coment_old)?>"; 
 coment_cambio="<?php echo preg_replace('/[\r\n]+/', ' ', $row2->historial_proyecto_coment_new) ?>";
 id_proyecto="<?php echo $row2->id_obra_cliente ?>";
}
<?php endforeach ?>

if (estado_actual=="1") {
 estado_actual="Activo";
}else{
 if (estado_actual=="2") {
  estado_actual="Pagado";
}else{
  estado_actual="Cancelado";
}
}
if (estado_cambio=="1") {
 estado_cambio="Activo";
}else{
 if (estado_cambio=="2") {
  estado_cambio="Pagado";
}else{
  estado_cambio="Cancelado";
}
}

$("#AtiendeModal").modal();
$("#id_atn_sol").text($id_historial);
$("#id_proyecto").text(id_proyecto);
$("#empresa").text("<?php echo $empresa ?>");
$("#lbl_solicitante").text($("#usuario"+$id_historial).text());
$("#lbl_fecha").text($("#fecha"+$id_historial).text());
if(nom_proy_actual!=nom_proy_cambio){
 $("#proyecto").removeAttr('hidden');
 $("#proyecto").attr('style','background-color:#FFFB77');
}
$("#proy_actual").val(nom_proy_actual);
$("#proy_cambio").val(nom_proy_cambio);

if (cli_actual!=cli_cambio) {
 $("#cliente").removeAttr('hidden');
 $("#cliente").attr('style','background-color:#FFFB77');
}
$("#cli_actual").val(cli_actual);
$("#cli_cambio").val(cli_cambio);
$("#cli_cambio_id").val(cli_cambio_id);

if (imp_actual!=imp_cambio) {
 $("#importe").removeAttr('hidden');
 $("#importe").attr('style','background-color:#FFFB77');
}
$("#imp_actual").val(imp_actual);
$("#imp_cambio").val(imp_cambio);

if (estado_actual!=estado_cambio) {
 $("#estado").removeAttr('hidden');
 $("#estado").attr('style','background-color:#FFFB77');
}
$("#estado_actual").val(estado_actual);
$("#estado_cambio").val(estado_cambio);

if (coment_actual!=coment_cambio) {
 $("#coment").removeAttr('hidden');
 $("#coment").attr('style','background-color:#FFFB77');
}
$("#coment_actual").val(coment_actual);
$("#coment_cambio").val(coment_cambio);

$("#txt_obs").text($("#coment"+$id_historial).text());
$("#txt_obs").attr('style','background-color:#FFFB77');
}

function Responder_Solicitud_pago($id_historial){
  <?php foreach ($solicitado_pago->result() as $row_pago ){ ?>
   if (<?php echo $row_pago->id_historial_proyecto_pago?>==$id_historial) {
    empresa="<?php echo $row_pago->empresa_nom ?>";

    fecha_solicita="<?php echo $row_pago->historial_proyecto_pago_fecha_actualizacion ?>";
    comentario_old="<?php echo $row_pago->historial_proyecto_pago_coment_old?>";
    comentario_new="<?php echo $row_pago->historial_proyecto_pago_coment_new?>";
    monto_new="<?php echo $row_pago->historial_proyecto_pago_monto_new ?>";
    monto_old="<?php echo $row_pago->historial_proyecto_pago_monto_old ?>";
    fecha_pago_old="<?php echo $row_pago->historial_proyecto_pago_fecha_pago_old ?>";
    fecha_pago_new="<?php echo $row_pago->historial_proyecto_pago_fecha_pago_new ?>";
    historial_proyecto_pago_estim_estatus_old="<?php echo $row_pago->historial_proyecto_pago_estim_estatus_old ?>";
    historial_proyecto_pago_estim_estatus_new="<?php echo $row_pago->historial_proyecto_pago_estim_estatus_new ?>";
    id_pago="<?php echo $row_pago->historial_proyecto_pago_id_venta_mov ?>";
  }
<?php } ?>


$("#AtiendeModal_pago").modal();
$("#id_atn_sol_pago").text($id_historial);
$("#id_pago").text(id_pago);
$("#empresa_pago").text(empresa);
$("#lbl_solicitante_pago").text($("#usuario"+$id_historial).text());
$("#lbl_fecha_pago").text($("#fecha"+$id_historial).text());
if(fecha_pago_old!=fecha_pago_new){
 $("#pago_fecha").removeAttr('hidden');
 $("#pago_fecha").attr('style','background-color:#FFFB77');
}
$("#fecha_pago_old").val(fecha_pago_old);
$("#fecha_pago_new").val(fecha_pago_new);

if (monto_old!=monto_new) {
 $("#monto").removeAttr('hidden');
 $("#monto").attr('style','background-color:#FFFB77');
}
$("#monto_old").val(monto_old);
$("#monto_new").val(monto_new);

if (comentario_old!=comentario_new) {
 $("#coment_pago").removeAttr('hidden');
 $("#coment_pago").attr('style','background-color:#FFFB77');
}
$("#comentario_old").val(comentario_old);
$("#comentario_new").val(comentario_new);

if (historial_proyecto_pago_estim_estatus_old!=historial_proyecto_pago_estim_estatus_new) {
  $("#aplica_flujo").removeAttr('hidden');
  $("#aplica_flujo").attr('style','background-color:#FFFB77');
}
if(historial_proyecto_pago_estim_estatus_old=="0"){
 $("#aplica_flujo_old").val("NO");
}else{
 $("#aplica_flujo_old").val("SI");
}
if(historial_proyecto_pago_estim_estatus_new=="0"){
 $("#aplica_flujo_new").val("NO");
}else{
 $("#aplica_flujo_new").val("SI");
}



$("#txt_obs_pago").text($("#coment"+$id_historial).text());
}


  function Responder_Solicitud_elimina_carpeta($id_borra_nube_carpeta){//recibimos el id del usuario
    <?php foreach ($solicita_elimina_carpeta->result() as $row_elimina_carpeta ){ ?>
      if (<?php echo $row_elimina_carpeta->id_borra_nube?>==$id_borra_nube_carpeta) {
        empresa="<?php echo $row_elimina_carpeta->empresa_nom ?>";
        fecha_solicita="<?php echo $row_elimina_carpeta->borra_nube_fecha_solicitud ?>";
        usuario="<?php echo $row_elimina_carpeta->usuario_nom ?>";
        url_carpeta="<?php echo $row_elimina_carpeta->borra_nube_url_archivo?>";
        coment="<?php echo $row_elimina_carpeta->borra_nube_comentario ?>";   
        id_borrar="<?php echo $row_elimina_carpeta->id_borra_nube ?>";
      }
    <?php } ?>
    $("#AtiendeModal_elimina_carpeta").modal();
    $("#id_borra_carpeta").val(id_borrar);
    $("#usuario_carpeta").text(usuario);
    $("#url_carpeta").val(url_carpeta);
    $("#empresa_nube").text(empresa);
    $("#fecha_solicita_carpeta").val(fecha_solicita);
    $("#txt_coment_carpeta").val(coment)
  }

  function Responder_Solicitud_elimina_archivo($id_borra_nube_archivo){//recibimos el id del usuario
    <?php foreach ($solicita_elimina_archivo->result() as $row_elimina_archivo ){ ?>
      if (<?php echo $row_elimina_archivo->id_borra_nube?>==$id_borra_nube_archivo) {
        empresa="<?php echo $row_elimina_archivo->empresa_nom ?>";
        fecha_solicita="<?php echo $row_elimina_archivo->borra_nube_fecha_solicitud ?>";
        usuario="<?php echo $row_elimina_archivo->usuario_nom ?>";
        url_archivo="<?php echo $row_elimina_archivo->borra_nube_url_archivo?>";
        coment="<?php echo $row_elimina_archivo->borra_nube_comentario ?>";   
        id_borrar="<?php echo $row_elimina_archivo->id_borra_nube ?>";
      }
    <?php } ?>
    $("#AtiendeModal_elimina_archivo").modal();
    $("#id_borra_archivo").val(id_borrar);
    $("#usuario_acrhivo").text(usuario);
    $("#url_archivo").val(url_archivo);
    $("#empresa_nube_archivo").text(empresa);
    $("#fecha_solicita_archivo").val(fecha_solicita);
    $("#txt_coment_archivo").val(coment)
  }

  function Activa_Boton(){
   if ($("#respuesta").val()!="0"||$("#respuesta_pago").val()!="0"||$("#respuesta_elimina_carpeta").val()!="0"||$("#respuesta_elimina_archivo").val()!="0") {
    $("#btn_procesar").removeAttr('disabled');
    $("#btn_procesar_pago").removeAttr('disabled');
    $("#btn_procesar_elimina_carpeta").removeAttr('disabled');
    $("#btn_procesar_elimina_archivo").removeAttr('disabled');
  }else{
    $("#btn_procesar").attr('disabled','true');
    $("#btn_procesar_pago").attr('disabled','true');
    $("#btn_procesar_elimina_carpeta").attr('disabled','true');
    $("#btn_procesar_elimina_archivo").attr('disabled','true');
  }
}

function Update_Page(){
  $('.modal-backdrop').remove();
    location.reload(); //actualizamos la página completa y así se actualizan las notificaciones de cambios
    //$("#page_content").load("Lista_Solicitudes");
  }
</script>
