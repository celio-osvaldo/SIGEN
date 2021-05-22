
<div class="row" >
  <div class="col-md-9" align="center">
    <h5>Detalle Evento</h5>
  </div>
  <div class="col-md-3" align="center">
    <button type="button" onclick="Regresar()" class="btn btn-success" >Regresar a lista de Eventos</button>
  </div>
</div>

<style type="text/css">
 hr{
  margin:3px;
  padding:0px;
  list-style-type:none;
}
</style>

<div class="row">
  <div class="col-md-12">
    <span class="badge badge-info col-md-2">
      Nombre Evento:<hr><?php echo $datos_evento->obra_cliente_nombre; ?>
    </span>
    <span class="badge badge-info col-md-2">
      Cliente:<hr><?php echo $datos_evento->catalogo_cliente_empresa; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Importe Total:<hr>$<?php echo number_format($datos_evento->obra_cliente_imp_total,2,'.',','); ?>
    </span>
    <span class="badge badge-info col-md-1">
      Total Pagado:<hr>$<?php echo number_format($datos_evento->obra_cliente_pagado,2,'.',','); ?>
    </span> 
    <span class="badge badge-info col-md-1">
      Anticipo Marcado:<hr>$<?php echo number_format($detalles_evento->evento_detalle_anticipo,2,'.',','); ?>
    </span>
    <span class="badge badge-info col-md-1">
      Saldo:<hr>$<?php echo number_format($datos_evento->obra_cliente_saldo,2,'.',','); ?>
    </span>
    <span class="badge badge-info col-md-1">
      Fecha Evento:<hr>
      Inicio: <?php echo $detalles_evento->evento_detalle_fecha; ?><br>
      Fin: <?php echo $detalles_evento->evento_detalle_fecha_fin; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Horario Evento:<hr>
      Inicio: <?php echo $detalles_evento->evento_detalle_hora_inicio; ?><br>
      Fin: <?php echo $detalles_evento->evento_detalle_hora_fin; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Total Horas:<hr><?php echo $detalles_evento->evento_detalle_total_horas; ?>
    </span>
  </div>  
</div>
<div class="row">
  <div class="col-md-12">
    <span class="badge badge-info col-md-1">
      Cantidad Personas:<hr><?php echo $detalles_evento->evento_detalle_personas; ?>
    </span>
    <span class="badge badge-info col-md-2">
      Tipo Evento:<hr><?php echo $detalles_evento->evento_detalle_tipo_evento; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Mobiliario:<hr><?php echo $detalles_evento->detalle_evento_mobiliario; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Permiso:<hr><?php echo $detalles_evento->evento_detalle_permiso; ?>
    </span>
    <span class="badge badge-info col-md-2">
      Estado:<hr> <?php 
      switch ($datos_evento->obra_cliente_estado) {
        case '1':
        echo 'Activo';
        break;
        case '2':
        echo 'Pagado';
        break;
        case '3':
        echo 'Cancelado';
        break;
        default:
        echo 'Error';
        break;
      }
      ?>
    </span>
    <span class="badge badge-info col-md-4">
      Comentario:<hr><?php echo $datos_evento->obra_cliente_comentarios; ?>
    </span> 
  </div>  
</div>

<div class="row"> 
  <div class="col-md-9" align="center">
    <h5>Lista de Mobiliario/Servicios</h5>
  </div>
  <div class="col align-self-end" align="right">
    <a class="btn btn-outline-secondary btn-sm" onclick="Add_mob_serv(this.id)" role="button" id="<?php echo $detalles_evento->evento_detalle_id_obra_cliente; ?>"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="30px" height="30px" alt="Agregar Mobiliario/Servicio al Evento" style="filter: invert(70%)">Agregar Mobiliario/Servicio al Evento</a>
  </div> 
</div>

<div class="card bg-card"> 
  <div class="table-responsive">
    <table id="table_Inv_Prod" class="table table-striped table-hover display" style="font-size: 9pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Nombre Mobiliario/Servicio</th>
          <th>Unidad de Medida</th>
          <th>Cantidad</th>
          <th>Comentario</th>
          <th>Editar</th>
        </tr>
      </thead>
      <tbody align="center">

       <?php 
       foreach ($detalles_mobiliario->result() as $row) {
         ?>
         <tr>
          <td id="<?php echo "prod_alm_nom".$row->id_evento_mobiliario;?>"><?php echo "".$row->prod_alm_nom.""; ?></td>
          <td id="<?php echo "unidad_medida".$row->id_evento_mobiliario;?>"><?php echo "".$row->unidad_medida.""; ?></td>
          <td id="<?php echo "evento_mobiliario_cantidad".$row->id_evento_mobiliario;?>"><?php echo $row->evento_mobiliario_cantidad; ?></td>
          <td id="<?php echo "evento_mobiliario_coment".$row->id_evento_mobiliario;?>"><?php echo $row->evento_mobiliario_coment; ?></td>
          <td>
            <a class="btn btn-outline-secondary" onclick="Edit(this.id)" role="button" id="<?php echo $row->id_evento_mobiliario; ?>"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" title="Editar" style="filter: invert(100%)" />
            </a>
            <a class="btn btn-outline-secondary" onclick="Delete(this.id)" role="button" id="<?php echo $row->id_evento_mobiliario; ?>"><img src="..\Resources\Icons\delete.ico" width="20px" title="Eliminar" style="filter: invert(100%)" />
            </a>
          </td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>

<!-- Modal Add Mobiliario/Servicio a Evento-->
<div class="modal fade" id="AddMob_ServModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Agregar Mobiliario/Servicio a Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Mobiliario/Servicio</label>
            <select class="form-control" id="prod_nombre">
              <option disabled selected>--Seleccionar Mobiliario/Servicio--</option>
              <?php foreach ($lista_mobiliario->result() as $row){ ?>
                <option value="<?php echo "".$row->id_prod_alm.""; ?>"><?php echo "".$row->prod_alm_nom.""; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">Cantidad</label>
            <input type="number" class="form-control" min="0"  id="prod_cantidad">
          </div>
          <div class="col-md-9">
            <label class="label-control">Comentarios</label> 
            <textarea id="coment" maxlength="200" class="form-control"></textarea>          
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Add_Mobil" data-dismiss="modal">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Mobiliario/Servicio a Evento-->
<div class="modal fade" id="EditMobiliarioModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Editar Mobiliario/Servicio a Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="id_evento_mobiliario" id="id_evento_mobiliario" hidden="true">
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Mobiliario/Servicio</label>
            <input type="text" name="edit_prod_alm_nom" id="edit_prod_alm_nom" disabled="true" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">Cantidad</label>
            <input type="number" class="form-control" min="0"  id="edit_evento_mobiliario_cantidad" name="edit_evento_mobiliario_cantidad">
          </div>
          <div class="col-md-5">
            <label class="label-control">Unidad de Medida</label>
            <input type="text" class="form-control" id="edit_unid_med" name="edit_unid_med" disabled="true">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label> 
            <textarea id="edit_evento_mobiliario_coment" name="edit_evento_mobiliario_coment" maxlength="200" class="form-control"></textarea>  
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Update_Mobil" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Mobiliario/Servicio a Evento-->
<div class="modal fade" id="DeleteMobiliarioModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red">
        <h5 class="modal-title">Eliminar Mobiliario/Servicio a Evento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="delete_id_evento_mobiliario" id="delete_id_evento_mobiliario" hidden="true">
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Producto</label>
            <input type="text" name="delete_prod_alm_nom" id="delete_prod_alm_nom" disabled="true" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">Cantidad</label>
            <input type="number" class="form-control" min="0" disabled="true" id="delete_evento_mobiliario_cantidad" name="delete_evento_mobiliario_cantidad">
          </div>
          <div class="col-md-5">
            <label class="label-control">Unidad de Medida</label>
            <input type="text" class="form-control" id="delete_unid_med" name="delete_unid_med" disabled="true">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label> 
            <textarea id="delete_evento_mobiliario_coment" name="delete_evento_mobiliario_coment" disabled="true" maxlength="200" class="form-control"></textarea>  
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Delete_Mobil" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready(function(){

      $('#table_Inv_Prod').DataTable({
        initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
        },
         /****** add this */
        "searching": true,
        // "autoFill": true,
        "language": {
            "lengthMenu": "Por página: _MENU_",
            "zeroRecords": "Sin resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ registros en total)",
            "search": "Búsqueda",
                "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          }
        },
    });

    $('#Add_Mobil').click(function(){
      id_evento=<?php echo $detalles_evento->evento_detalle_id_obra_cliente;; ?>;
      id_mob_serv=$("#prod_nombre").val();
      mob_serv_cantidad=$("#prod_cantidad").val();
      coment=$("#coment").val();
      if(mob_serv_cantidad>0&&id_mob_serv!=null){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/Add_Mob_Serv",
          data:{id_evento:id_evento, id_mob_serv:id_mob_serv, mob_serv_cantidad:mob_serv_cantidad, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Mobiliario/Servicio Agregado al Evento.');
            }else{
              alert('Falló el servidor. Mobiliario/Servicio no Agregado');
            }
            Update_Page(id_evento);
          }
        });
      }else{
        alert("Debe Ingresar por lo menos 1 Mobiliario/Servicio");
      }
    });

    $('#Update_Mobil').click(function(){
      id_evento=<?php echo $detalles_evento->evento_detalle_id_obra_cliente;; ?>;
      id_evento_mobiliario=$("#id_evento_mobiliario").val();
      mob_serv_cantidad=$("#edit_evento_mobiliario_cantidad").val();
      coment=$("#edit_evento_mobiliario_coment").val();
      if(mob_serv_cantidad>0){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/Update_Mob_Serv",
          data:{id_evento_mobiliario:id_evento_mobiliario, mob_serv_cantidad:mob_serv_cantidad, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Mobiliario/Servicio Actualizado.');
            }else{
              alert('Falló el servidor. Mobiliario/Servicio no Actualizado');
            }
            Update_Page(id_evento);
          }
        });
      }else{
        alert("Debe Ingresar por lo menos 1 Mobiliario/Servicio");
      }
    });

      $('#Delete_Mobil').click(function(){
        id_evento=<?php echo $detalles_evento->evento_detalle_id_obra_cliente;; ?>;
        id_evento_mobiliario=$("#delete_id_evento_mobiliario").val();
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/Delete_Mob_Serv",
          data:{id_evento_mobiliario:id_evento_mobiliario},
          success:function(result){
            //alert(result);
            if(result){
              alert('Mobiliario/Servicio Eliminado.');
            }else{
              alert('Falló el servidor. Mobiliario/Servicio no Eliminado');
            }
            Update_Page(id_evento);
          }
        });
    });


  });


  function Regresar(){
    $("#page_content").load("CustomerProjects");
  }
  function Add_mob_serv($id_evento){
    var id_evento=$id_evento;
    $("#AddMob_ServModal").modal();
  }

  function Update_Page($id_evento){
    id_evento=$id_evento;
    $("#page_content").load("Detalles_Evento",{id_evento:id_evento});
  }

  function Edit($id_evento_mobiliario){
    prod_alm_nom=$("#prod_alm_nom"+$id_evento_mobiliario).text();
    unidad_medida=$("#unidad_medida"+$id_evento_mobiliario).text();
    evento_mobiliario_cantidad=$("#evento_mobiliario_cantidad"+$id_evento_mobiliario).text();
    evento_mobiliario_coment=$("#evento_mobiliario_coment"+$id_evento_mobiliario).text();

    $("#EditMobiliarioModel").modal();
    $("#id_evento_mobiliario").val($id_evento_mobiliario);
    $("#edit_prod_alm_nom").val(prod_alm_nom);
    $("#edit_unid_med").val(unidad_medida);
    $("#edit_evento_mobiliario_cantidad").val(evento_mobiliario_cantidad);
    $("#edit_evento_mobiliario_coment").val(evento_mobiliario_coment);
  }
  
  function Delete($id_evento_mobiliario){
    prod_alm_nom=$("#prod_alm_nom"+$id_evento_mobiliario).text();
    unidad_medida=$("#unidad_medida"+$id_evento_mobiliario).text();
    evento_mobiliario_cantidad=$("#evento_mobiliario_cantidad"+$id_evento_mobiliario).text();
    evento_mobiliario_coment=$("#evento_mobiliario_coment"+$id_evento_mobiliario).text();

    $("#DeleteMobiliarioModel").modal();
    $("#delete_id_evento_mobiliario").val($id_evento_mobiliario);
    $("#delete_prod_alm_nom").val(prod_alm_nom);
    $("#delete_unid_med").val(unidad_medida);
    $("#delete_evento_mobiliario_cantidad").val(evento_mobiliario_cantidad);
    $("#delete_evento_mobiliario_coment").val(evento_mobiliario_coment);
  }

</script>