
<!--Mostrar lista de clientes y obras -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Proyectos</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewClientModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Proyecto</button>
  </div>
</div>

      <div class="card bg-card">
        <div class="table-responsive">
          <table id="table_customer" class="table table-striped table-hover display" style="font-size: 10pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
              <tr>
                <th>Proyecto</th>
                <th>Cliente</th>
                <th>Importe Total</th>
                <th>Pagado</th>
                <th>Saldo</th>
                <th hidden="true">Estado_id</th>
                <th>Estado</th>
                <th>Comentarios</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
             <?php
             foreach ($proyectlist->result() as $row) {?>
              <tr>          
                <td id="<?php echo "nom_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                <td id="<?php echo "nom_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
                <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_imp_total,2,'.',',').""; ?></td>
                <td id="<?php echo "total_pago_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_pagado,2,'.',',').""; ?> </td>
                <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_saldo,2,'.',',').""; ?></td>

                <td id="<?php echo "estado_obra".$row->id_obra_cliente;?>" hidden="true"><?php echo "".$row->obra_cliente_estado.""; ?></td>

                <td id="nom_estadp">
                  <?php 
                  switch ($row->obra_cliente_estado) {
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
                </td>
                <td id="<?php echo "coment_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_comentarios.""; ?></td>
                <td>
                  <a class="navbar-brand" onclick="Edit(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
                    </button></a>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>





<!-- Modal Add Customer_Project -->
<div class="modal fade" id="NewClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre Proyecto</label>
        <input type="text" name="" id="nom_obra" class="form-control input-sm">
         <label class="label-control">Cliente</label>
                  <select class="form-control" name="customer" id="customer">
                    <option disabled selected>----Seleccionar Cliente----</option>
                  <?php foreach ($customerlist->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Importe Total</label>
        <input type="text" onblur="SeparaMiles(this.id)" name="" id="imp_obra" class="form-control input-sm">
        <label>Comentarios</label>
        <textarea id="coment_obra" class="form-control input-sm" maxlength="200"></textarea>
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
        <h5 class="modal-title" id="exampleModalLabel">Modificar Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre de Proyecto</label>
        <input type="text" name="" id="edit_nom_obra" class="form-control input-sm">
        <label class="label-control">Cliente</label>
                  <select class="form-control" name="edit_customer" id="edit_customer">
                  <?php foreach ($customerlist->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Importe Total</label>
        <input type="text" onblur="SeparaMiles(this.id)" name="" id="edit_imp_obra" class="form-control input-sm">
        <label>Estado</label><br>   
        <select id="edit_estado_obra">
          <option value="1">Activo</option>
          <option value="2">Pagado</option>
          <option value="3">Cancelado</option>
        </select><br>
        <label>Comentarios</label>
        <textarea id="edit_coment_obra" class="form-control input-sm" maxlength="200"></textarea>
        <input type="text" id="edit_id_obra" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateRegister" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<!--script para llenar la tabla con la libreria DataTable -->
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_customer').DataTable();
  } );
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
      coment=$('#coment_obra').val();

      if (nombre!=""&&importe!=""&&id_cliente!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/AddCustomerProject",
          data:{nombre:nombre, id_cliente:id_cliente, importe:importe,coment:coment},
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
        alert("Debe ingresar nombre de Proyecto, Cliente e Importe");
      }
    });

    //Función para actualizar el registro
    $('#UpdateRegister').click(function(){
    act_nom=$("#edit_nom_obra").val();
    act_cliente=$("#edit_customer").val();
    act_imp=$("#edit_imp_obra").val();
    act_imp=act_imp.replace(/\,/g, '');
    act_estado=$("#edit_estado_obra").val();
    act_coment=$("#edit_coment_obra").val();
    id=$("#edit_id_obra").val();
    //alert(act_nom+act_imp+act_estado+act_coment);
      if (act_nom!=""&&act_imp!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/EditCustomerProject",
          data:{act_nom:act_nom, act_cliente:act_cliente, act_imp:act_imp, act_estado:act_estado, act_coment:act_coment,id:id},
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
    importe[1]=importe[1].replace(/\,/g, '');
    var estado=$("#estado_obra"+$id).text();
    var coment=$("#coment_obra"+$id).text();
    var id=$id;
    $("#EditClientModal").modal();
    $("#edit_nom_obra").val(nombre);
    $("#edit_customer option:contains("+cliente+")").attr('selected', true);
    $("#edit_imp_obra").val(parseFloat(importe[1]));
    $("#edit_estado_obra").val(estado);
    $("#edit_coment_obra").val(coment);
    $("#edit_id_obra").val(id);
    }

function SeparaMiles($id){
  valor=$("#"+$id).val();
    valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){
    //alert("entro");
    valor=0.00;
    //alert(valor);
  }
  var resultado=valor.toLocaleString("en");
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }


</script>



