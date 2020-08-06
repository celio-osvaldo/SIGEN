
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
                <th hidden="true">id_cliente</th>
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
                <td hidden="true" id="<?php echo "id_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_id_cliente.""; ?></td>
                <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_imp_total,5,'.',',').""; ?></td>
                <td id="<?php echo "total_pago_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_pagado,5,'.',',').""; ?> </td>
                <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_saldo,5,'.',',').""; ?></td>

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
        <input type="text" maxlength="150" name="" id="nom_obra" class="form-control input-sm">
         <label class="label-control">Cliente</label>
                  <select class="form-control" name="customer" id="customer">
                    <option disabled selected>----Seleccionar Cliente----</option>
                  <?php foreach ($customerlist->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Importe Total</label>
        <input type="text" onblur="Separa_Miles(this.id)" name="" id="imp_obra" class="form-control input-sm">
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
        <input type="text" maxlength="150" id="edit_nom_obra" class="form-control input-sm">
        <label class="label-control">Cliente</label>
                  <select class="form-control" name="edit_customer" id="edit_customer">
                  <?php foreach ($customerlist->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Importe Total</label>
        <input type="text" onblur="Separa_Miles(this.id)" name="edit_imp_obra" id="edit_imp_obra" class="form-control input-sm">
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
      act_cliente_txt=$('select[name="edit_customer"] option:selected').text();
      act_imp=$("#edit_imp_obra").val();
      act_imp=act_imp.replace(/\,/g, '');
      act_estado=$("#edit_estado_obra").val();
      act_coment=$("#edit_coment_obra").val();
      id=$("#edit_id_obra").val();

      //Obtenemos los datos antes de la actualización para su registro en el historial
      nombre=$("#nom_obra"+id).text();
      cliente=$("#nom_cliente"+id).text();
      importe=$("#imp_obra"+id).text().replace(/\,/g, '');
      importe=importe.replace(/\$/g, '');
      estado=$("#estado_obra"+id).text();
      coment=$("#coment_obra"+id).text();


      //alert(act_cliente_txt+" "+nombre+" "+cliente+" "+importe+" "+estado+" "+coment);
        if (act_nom!=""&&act_imp!="") {//Verificamos que los campos no estén vacíos
          
          //alert(act_estado+" "+estado+" "+act_cliente_txt+" "+cliente+" "+act_imp+" "+importe);
          
          if(act_cliente_txt!=cliente||act_imp!=importe||act_estado!=estado){
             $("#JustificaModal").modal();//Abrimos modal para solicitar la justificación del cambio

          }else{
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
          }
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
      //alert(cliente_old);
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
    $("#EditClientModal").modal();
    $("#edit_nom_obra").val(nombre);
    $("#edit_customer option:contains("+cliente+")").attr('selected', true);
    $("#edit_imp_obra").val((importe[1]));
    $("#edit_estado_obra").val(estado);
    $("#edit_coment_obra").val(coment);
    $("#edit_id_obra").val(id);
    }

function countChars(obj){
    var maxLength = 500;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById("charNum").innerHTML = '<span style="color: red;">Has excedido los '+maxLength+' caracteres permitidos.</span>';
    }else{
        document.getElementById("charNum").innerHTML = 'Restan '+charRemain+' caracteres ';
    }
}



</script>



