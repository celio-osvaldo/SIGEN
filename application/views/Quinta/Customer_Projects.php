<!--Mostrar lista de clientes y obras -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Eventos</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" onclick="Max_ID()" data-toggle="modal" data-target="#NewClientModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Evento</button>
  </div>

<div class="row">
    <div class="form-group row">
        <label class="col-md-6">Ver Eventos</label>
    <div class="col-md-6">
      <select multiple="multiple" class="multiple-select" id="estado_proyecto" placeholder="Seleccione">
          <option value="1" selected="true">Activo</option>
          <option value="2">Pagado</option>
          <option value="3">Cancelado</option>
      </select>
    </div>
  </div>
</div>
</div>
<div class="row">
  <div class="card bg-card" id="tbl_body"></div>
</div>



<!-- Modal Add Customer_Project -->
<div class="modal fade" id="NewClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <label class="label-control">Nombre Evento*</label>
            <input type="text" maxlength="150" name="" id="nom_obra" class="form-control input-sm">
          </div>
          <div class="col-md-4">
            <label class="label-control">Contrato</label>
             <input type="text" name="contrato" id="contrato" class="form-control" maxlength="200">
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label class="label-control">Cliente*</label>
            <select class="form-control" name="customer" id="customer">
              <option disabled selected>----Seleccionar Cliente----</option>
              <?php foreach ($customerlist->result() as $row){ ?>
              <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="label-control">Importe Total*</label>
            <input type="text" min="0" onblur="SeparaMiles(this.id)" name="" id="imp_obra" class="form-control input-sm">
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Fecha del Evento</label>
            <input type="date" name="fecha_evento" id="fecha_evento" class="form-control">
          </div>
          <div class="col-md-7">
            <label class="label-control">Tipo de Evento</label>
            <select class="form-control" name="tipo_evento" id="tipo_evento">
              <option disabled selected>----Seleccione tipo Evento----</option>
              <option value="Boda">Boda</option>
              <option value="XV Años">XV Años</option>
              <option value="Cumpleaños">Cumpleaños</option>
              <option value="Bautismo">Bautismo</option>
              <option value="Primera Comunión">Primera Comunión</option>
              <option value="Confirmación">Confirmación</option>
              <option value="Despedida Soltera">Despedida Soltera</option>
              <option value="Graduación">Graduación</option>
              <option value="Posada">Posada</option>
              <option value="Reunión Familiar">Reunión Familiar</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Cantidad de Personas</label>
            <input type="number" min="0"  name="cant_persona" id="cant_persona" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="label-control">Mobiliario</label>
            <select class="form-control" name="mobiliario" id="mobiliario">
              <option value="SI">SI</option>
              <option value="NO">NO</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="label-control">Permiso</label>
            <input type="text" name="permiso" id="permiso" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">Total Horas</label>
            <input type="number" min="0" name="total_horas" id="total_horas" step="0.5" class="form-control">
          </div>
          <div class="col-md-4.5">
            <label class="label-control">Hora Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control">
          </div>
          <div class="col-md-4.5">
            <label class="label-control">Hora Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="label-control">Fecha Final del Evento</label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="label-control">Anticipo Establecido</label>
            <input type="text" name="anticipo" id="anticipo" onblur="SeparaMiles(this.id)" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label>
            <textarea id="coment_obra" class="form-control input-sm" maxlength="200"></textarea>
          </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardarnuevo" data-dismiss="modal">Guardar</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal Edit Customer_Project -->
<div class="modal fade" id="EditClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" hidden="true" name="edit_id_obra" id="edit_id_obra">
        <div class="row">
          <div class="col-md-8">
            <label class="label-control">Nombre Evento*</label>
            <input type="text" maxlength="150" name="edit_nom_obra" id="edit_nom_obra" class="form-control input-sm">
          </div>
          <div class="col-md-4">
            <label class="label-control">Contrato</label>
             <input type="text" name="edit_contrato" id="edit_contrato" class="form-control" maxlength="200">
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            <label class="label-control">Cliente*</label>
            <select class="form-control" name="edit_customer" id="edit_customer">
              <option disabled selected>----Seleccionar Cliente----</option>
              <?php foreach ($customerlist->result() as $row){ ?>
              <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <label class="label-control">Importe Total*</label>
            <input type="text" onblur="SeparaMiles(this.id)" name="edit_imp_obra" id="edit_imp_obra" class="form-control input-sm">
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Fecha del Evento</label>
            <input type="date" name="edit_fecha_evento" id="edit_fecha_evento" class="form-control">
          </div>
          <div class="col-md-7">
            <label class="label-control">Tipo de Evento</label>
            <select class="form-control" name="edit_tipo_evento" id="edit_tipo_evento">
              <option disabled selected>----Seleccione tipo Evento----</option>
              <option value="Boda">Boda</option>
              <option value="XV Años">XV Años</option>
              <option value="Cumpleaños">Cumpleaños</option>
              <option value="Bautismo">Bautismo</option>
              <option value="Primera Comunión">Primera Comunión</option>
              <option value="Confirmación">Confirmación</option>
              <option value="Despedida Soltera">Despedida Soltera</option>
              <option value="Graduación">Graduación</option>
              <option value="Posada">Posada</option>
              <option value="Reunión Familiar">Reunión Familiar</option>
              <option value="Otro">Otro</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Cantidad de Personas</label>
            <input type="number" min="0"  name="edit_cant_persona" id="edit_cant_persona" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="label-control">Mobiliario</label>
            <select class="form-control" name="edit_mobiliario" id="edit_mobiliario">
              <option value="SI">SI</option>
              <option value="NO">NO</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="label-control">Permiso</label>
            <input type="text" name="edit_permiso" id="edit_permiso" class="form-control">
          </div>
        </div>
                <div class="row">
          <div class="col-md-3">
            <label class="label-control">Total Horas</label>
            <input type="number" min="0" name="edit_total_horas" id="edit_total_horas" step="0.5" class="form-control">
          </div>
          <div class="col-md-4.5">
            <label class="label-control">Hora Inicio</label>
            <input type="time" name="edit_hora_inicio" id="edit_hora_inicio" class="form-control">
          </div>
          <div class="col-md-4.5">
            <label class="label-control">Hora Fin</label>
            <input type="time" name="edit_hora_fin" id="edit_hora_fin" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="label-control">Fecha Final del Evento</label>
            <input type="date" name="edit_fecha_fin" id="edit_fecha_fin" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="label-control">Anticipo Establecido</label>
            <input type="text" name="edit_anticipo" id="edit_anticipo" onblur="SeparaMiles(this.id)" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label class="label-control">Estado</label>
            <select name="edit_estado_obra" id="edit_estado_obra" class="form-control">
              <option value="1" selected="true">Activo</option>
              <option value="2">Pagado</option>
              <option value="3">Cancelado</option>
            </select>

          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label>
            <textarea id="edit_coment_obra" class="form-control input-sm" maxlength="200"></textarea>
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateRegister" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Justifica Cambios Customer_Project -->
<div class="modal fade" id="JustificaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Justifica el cambio solicitado:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="txt_justifica" onkeyup="countChars(this);" class="form-control input-sm" maxlength="500"></textarea>
        <p id="charNum">Restan 500 caracteres</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Solicita_Cambio" data-dismiss="modal">Solicitar Cambio</button>
      </div>
    </div>
  </div>
</div>


<!--script para llenar la tabla con la libreria DataTable -->
<script type="text/javascript">
  $(document).ready( function () {
    tabla=$('#table_customer').DataTable();
  } );

$(function() {
    $('.multiple-select').multipleSelect()
  });

  $(function() {
    $('#estado_proyecto').change(function () {
      sel=document.getElementById("estado_proyecto");
        activo="";
        for (var i = 0; i < sel.options.length; i++) {
                if(sel.options[i].selected==true){
                  activo+=(i+1);
                }else{

                }
              }
          llena_tabla(activo);         
    }).change()
  });
</script>

<!--script Limpiar Ventana Modal Nuevo Cliente/Obra -->
<script type="text/javascript">
  $("#btncancelar").on("click",function(event){ 
    $("#nom_obra").val("");
    $("#imp_obra").val("");
    $("#coment_obra").val("");
  });

//funcion para Guardar nuevo cliente/obra
  $(document).ready(function(){
    $('#guardarnuevo').click(function(){
      nombre=$('#nom_obra').val();
      id_cliente=$('#customer').val();
      //alert(id_cliente);
      importe=$('#imp_obra').val();
      importe=importe.replace(/\,/g, '');
      fecha_evento=$("#fecha_evento").val();
      tipo_evento=$("#tipo_evento").val();
      cant_persona=$("#cant_persona").val();
      mobiliario=$("#mobiliario").val();
      permiso=$("#permiso").val();
      total_horas=$("#total_horas").val();
      hora_inicio=$("#hora_inicio").val();
      hora_fin=$("#hora_fin").val();
      anticipo=$("#anticipo").val().replace(/\,/g, '');
      fecha_fin=$("#fecha_fin").val();
      coment=$('#coment_obra').val();
      contrato=$('#contrato').val();

      importe_txt="("+NumeroALetras(importe)+")";
      anticipo_txt="("+NumeroALetras(anticipo)+")";
      resto=parseFloat(importe)-parseFloat(anticipo);
      resto_2=parseFloat(importe)-parseFloat(anticipo);
      resto_txt="("+NumeroALetras(resto)+")";


      if (nombre!=""&&importe!=""&&id_cliente!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/AddCustomerProject",
          data:{nombre:nombre, id_cliente:id_cliente, importe:importe,coment:coment, fecha_evento:fecha_evento, tipo_evento:tipo_evento, cant_persona:cant_persona, mobiliario:mobiliario, permiso:permiso, total_horas:total_horas, hora_inicio:hora_inicio, hora_fin:hora_fin, anticipo:anticipo, fecha_fin:fecha_fin, contrato:contrato, importe_txt:importe_txt, anticipo_txt:anticipo_txt, resto_2:resto_2, resto_txt:resto_txt},
          success:function(result){
            //alert(result);
            if(result==1){
              alert('Registro Agregado');
             CloseModal();
            }else{
              alert('Falló el servidor. Registro no agregado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Evento, Cliente e Importe");
      }
    });

    //Función para actualizar el registro
    $('#UpdateRegister').click(function(){
      act_nom=$("#edit_nom_obra").val();
      act_cliente=$("#edit_customer").val();
      act_cliente_txt=$('select[name="edit_customer"] option:selected').text();
      act_imp=$("#edit_imp_obra").val();
      act_imp=act_imp.replace(/\,/g, '');
      act_estado=$("#edit_estado_obra").val();
      act_coment=$("#edit_coment_obra").val();
      id=$("#edit_id_obra").val();
      contrato=$("#edit_contrato").val();

      fecha_evento=$("#edit_fecha_evento").val();
      tipo_evento=$("#edit_tipo_evento").val();
      cant_persona=$("#edit_cant_persona").val();
      mobiliario=$("#edit_mobiliario").val();
      permiso=$("#edit_permiso").val();

      total_horas=$("#edit_total_horas").val();
      hora_inicio=$("#edit_hora_inicio").val();
      hora_fin=$("#edit_hora_fin").val();
      anticipo=$("#edit_anticipo").val().replace(/\,/g, '');
      fecha_fin=$("#edit_fecha_fin").val();

      //Obtenemos los datos antes de la actualización para su registro en el historial
      nombre=$("#nom_obra"+id).text();
      cliente=$("#nom_cliente"+id).text();
      importe=$("#imp_obra"+id).text().replace(/\,/g, '');
      importe=importe.replace(/\$/g, '');
      estado=$("#estado_obra"+id).text();
      coment=$("#coment_obra"+id).text();

      importe_txt="("+NumeroALetras(importe)+")";
      anticipo_txt="("+NumeroALetras(anticipo)+")";
      resto=parseFloat(importe)-parseFloat(anticipo);
      resto_2=parseFloat(importe)-parseFloat(anticipo);
      resto_txt="("+NumeroALetras(resto)+")";


      //alert(act_cliente_txt+" "+nombre+" "+cliente+" "+importe+" "+estado+" "+coment);
        if (act_nom!=""&&act_imp!="") {//Verificamos que los campos no estén vacíos
          
          //alert(act_estado+" "+estado+" "+act_cliente_txt+" "+cliente+" "+act_imp+" "+importe);

            $.ajax({
            type:"POST",
            url:"<?php echo base_url();?>Quinta/EditCustomerProject",
            data:{act_nom:act_nom, act_cliente:act_cliente, act_imp:act_imp, act_estado:act_estado, act_coment:act_coment,id:id, fecha_evento:fecha_evento, tipo_evento:tipo_evento, cant_persona:cant_persona, mobiliario:mobiliario, permiso:permiso, total_horas:total_horas, hora_inicio:hora_inicio, hora_fin:hora_fin, anticipo:anticipo, fecha_fin:fecha_fin, contrato:contrato, importe_txt:importe_txt, anticipo_txt:anticipo_txt, resto_2:resto_2, resto_txt:resto_txt},
              success:function(result){
                //alert(result);
                if(result==1){
                  alert('Registro Actualizado');
                  CloseModal();
                  }else{
                    alert('Falló el servidor. Registro no actualizado');
                  }
                }
            });
        }else{
          alert("Debe ingresar nombre de Proyecto e Importe Total");
        } 
    });

    $('#Solicita_Cambio').click(function(){
      txt_justifica=$("#txt_justifica").val();
      nombre_old=$("#nom_obra"+id).text();
      cliente_old=$("#id_cliente"+id).text();
      importe_old=$("#imp_obra"+id).text().replace(/\,/g, '');
      importe_old=importe.replace(/\$/g, '');
      estado_old=$("#estado_obra"+id).text();
      coment_old=$("#coment_obra"+id).text();
      //alert(act_nom);
      if(txt_justifica!=""){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/EditCustomerProject_Admin",
          data:{act_nom:act_nom, nombre_old:nombre_old, act_cliente:act_cliente, cliente_old:cliente_old, act_imp:act_imp, importe_old:importe_old, act_estado:act_estado, estado_old:estado_old, act_coment:act_coment, coment_old:coment_old, id:id, txt_justifica:txt_justifica},
                success:function(result){
                  //alert(result);
                  if(result){
                    alert('Solicitud enviada al Administrador para actualizar los datos indicados.');
                    CloseModal();
                  }else{
                    alert('Falló el servidor. Solicitud para actualizar no enviada.');
                  }
                }
              });
           }else{
            alert("Actualización de datos no completada. Debe justificar los cambios solicitados ya que estos requieren autorización del Administrador.");
           }
    });

  });

  function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("CustomerProjects");
  }

//Función para Mostrar Modal de Editar un registro de Cliente/Obra
  function Edit($id){
    //alert("Editar "+$id);
    var nombre=$("#nom_obra"+$id).text();
    var cliente=$("#nom_cliente"+$id).text();
    var importe=$("#imp_obra"+$id).text().split("$");
    //importe[1]=importe[1].replace(/\,/g, '');
    var estado=$("#estado_obra"+$id).text();
    var coment=$("#coment_obra"+$id).text();
    var id=$id;
    var fecha_evento=$("#fecha_evento"+$id).text();
    var tipo_evento=$("#tipo_evento"+$id).text();
    var cant_persona=$("#cant_personas"+$id).text();
    var mobiliario=$("#mobiliario"+$id).text();
    var permiso=$("#permiso"+$id).text();
    var total_horas=$("#total_horas"+$id).text();
    var hora_inicio=$("#hora_inicio"+$id).text();
    var hora_fin=$("#hora_fin"+$id).text();
    var fecha_fin=$("#fecha_fin"+$id).text();
    var anticipo=$("#anticipo_estab"+$id).text().split("$");
    var contrato=$("#contrato"+$id).text();

    $("#EditClientModal").modal();
    $("#edit_nom_obra").val(nombre);
    $("#edit_customer option:contains("+cliente+")").attr('selected', true);
    $("#edit_imp_obra").val((importe[1]));
    $("#edit_estado_obra").val(estado);
    $("#edit_coment_obra").val(coment);
    $("#edit_id_obra").val(id);
    $("#edit_fecha_evento").val(fecha_evento);
    $("#edit_tipo_evento").val(tipo_evento);
    $("#edit_cant_persona").val(cant_persona);
    $("#edit_mobiliario").val(mobiliario);
    $("#edit_permiso").val(permiso);
    $("#edit_total_horas").val(total_horas);
    $("#edit_hora_inicio").val(hora_inicio);
    $("#edit_hora_fin").val(hora_fin);
    $("#edit_fecha_fin").val(fecha_fin);
    $("#edit_anticipo").val(anticipo[1]);
    $("#edit_contrato").val(contrato);
    }

  function Detalles($id){
    id_evento=$id;
    $("#page_content").load("Detalles_Evento",{id_evento:id_evento});
  }

  
  function Croquis($id){
    id_evento=$id;
    $("#page_content").load("Croquis",{id_evento:id_evento});
  }

  function llena_tabla($activo) {
   //alert('Ver Detalles');
   var activo=$activo;
   //alert(activo);
   $("#tbl_body").load("Customer_Project_tbl",{activo:activo});                
 }

 function Max_ID(){
  id_max_contrato="<?php echo $id_max_contrato->obra_cliente_contrato ?>";
    if(id_max_contrato==''){
    id_max_contrato="0/0";
  }
  id_max_contrato=id_max_contrato.split('/');
  anio=<?php echo date('Y'); ?>;
  next_id=parseInt(id_max_contrato[1])+1;
  $("#contrato").val(anio+'/'+next_id);
 }


function Unidades(num){
 
  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }
 
  return "";
}
 
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()
 
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)
 
  return strSin;
}//DecenasY()
 
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}//Centenas()
 
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}//Seccion()
 
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "MIL", "MIL");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}//Miles()
 
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}//Millones()
 
function NumeroALetras(num,centavos){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };
  if(centavos == undefined || centavos==false) {
    data.letrasMonedaPlural="PESOS";
    data.letrasMonedaSingular="PESOS";
  }else{
    data.letrasMonedaPlural="/100 M.N.";
    data.letrasMonedaSingular="/100 M.N.";
  }
 
  if (data.centavos > 0)
    data.letrasCentavos = data.centavos +"/100 M.N." ;
  else
    data.letrasCentavos = data.centavos +"0/100 M.N." ;
 
  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()



</script>



