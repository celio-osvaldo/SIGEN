
<!--Mostrar lista de Recibos de Entrega -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Recibos de Entrega</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal"  onclick="Get_MAX_Folio_recibo()" data-target="#NewReciboModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Recibo de Entrega</button>
  </div>
</div>

<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_recibo" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Folio</th>
          <th>Empresa</th>
          <th hidden="true">Id_empresa</th>
          <th>Fecha de Entrega</th>
          <th>Domicilio de Entrega</th>
          <th>Estado de Entrega</th>
          <th>Editar</th>
          <th>Acciones</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($recibo_entrega->result() as $row) {
         ?>
         <tr>
          <td id="<?php echo "folio".$row->id_recibo_entrega;?>"><?php echo "".$row->recibo_entrega_folio.""; ?></td>
          <td id="<?php echo "empresa".$row->id_recibo_entrega;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
          <td hidden="true" id="<?php echo "id_empresa".$row->id_recibo_entrega;?>"><?php echo "".$row->recibo_entrega_id_cliente.""; ?></td>
          <td id="<?php echo "fecha".$row->id_recibo_entrega;?>"><?php echo "".$row->recibo_entrega_fecha.""; ?></td>
          <td id="<?php echo "domicilio".$row->id_recibo_entrega;?>"><?php echo "".$row->recibo_entrega_domicilio.""; ?></td>
          <td id="<?php echo "estado".$row->id_recibo_entrega;?>"><?php echo "".$row->recibo_entrega_estado.""; ?></td>
          <td>
            <a class="navbar-brand" href="#" onclick="EditRecibo(this.id)" role="button" id="<?php echo $row->id_recibo_entrega; ?>">
              <button class="btn btn-outline-secondary " title="Editar Registro"><img width="20px" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
              </button>
            </a>
            <a class="navbar-brand" onclick="DeleteRecibo(this.id)" role="button" id="<?php echo $row->id_recibo_entrega; ?>"><button class="btn btn-outline-secondary"><img width="20px" src="..\Resources\Icons\delete.ico" title="Eliminar Recibo de Entrega" width="20px" style="filter: invert(100%)" /></button></a>
          </td>
          <td style="text-align: right;">
            <a class="navbar-brand" href="#" onclick="Product_Details(this.id)" role="button" id="<?php echo $row->id_recibo_entrega; ?>"><button class="btn btn-outline-secondary" title="Ver Detalles de Productos"><img width="20px" src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)"></button>
            </a>
          </td>
          <td style="text-align: left;"> 
            <form action="<?php echo base_url();?>Iluminacion/Genera_PDF_Recibo_Entrega" method="POST" target='_blank'>
             <input type="text" hidden="false" id="id_lista_recibo_entrega" name="id_lista_recibo_entrega"  value="<?php echo $row->id_recibo_entrega; ?>">
             <input hidden="false" id="folio" type="text" name="folio" value="<?php echo $row->recibo_entrega_folio; ?>">
              <button class="btn btn-outline-secondary"  type="submit" title="Imprimir Recibo de Entrega"><img width="20px" src="..\Resources\Icons\imprimir.ico" width="20px" style="filter: invert(100%)"></button>
           </form>
         </td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>


<!-- Modal New Recibo -->
<div class="modal fade" id="NewReciboModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Recibo de Entrega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-4">
              <b><label>Folio</label></b>
              <input type="text" id="new_folio"  class="form-control" required="true">
            </div>
            <div class="form-group col-md-6">
              <b><label>Fecha de Entrega</label></b>
              <input type="date" id="new_fecha_entrega" class="form-control" required="true">
            </div>
          </div>
          <b><label>Origen de la entrega</label></b><br>
            <input type="radio" name="radio" checked="true" id="radio_nuevo" value="nuevo"><label>Sin Origen</label><br>
            <input type="radio" name="radio" id="radio_anticipo" value=""><label>Anticipo</label><br>
            <input type="radio" name="radio" id="radio_cotizacion" value=""><label>Cotización</label><br>
          <div id="cat_cliente">
            <b><label>Cliente</label></b>
            <select class="form-control" name="new_cliente" id="new_cliente">
              <option disabled selected>----Seleccionar Cliente----</option>
              <?php foreach ($catalogo_cliente->result() as $row){ ?>
              <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="cat_anticipo" hidden="true">
            <b><label>Anticipo</label></b>
            <select class="form-control" name="new_anticipo" id="new_anticipo">
              <option disabled selected>----Seleccionar Anticipo----</option>
              <?php foreach ($lista_anticipos->result() as $row){ ?>
              <option value="<?php echo "".$row->id_anticipo.""; ?>"><?php echo "".$row->catalogo_cliente_empresa." Total: $".$row->anticipo_total." Comentario: ".$row->anticipo_coment.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="cat_cotizacion" hidden="true">
            <b><label>Cotización</label></b>
            <select class="form-control" name="new_cotizacion" id="new_cotizacion">
              <option disabled selected>----Seleccionar Cotización----</option>
              <?php foreach ($lista_cotizaciones->result() as $row){ ?>
              <option value="<?php echo "".$row->id_cotizacion.""; ?>"><?php echo "Folio: ".$row->cotizacion_folio." Empresa: ".$row->cotizacion_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <br>
          <b><label>Domicilio de Entrega</label></b>
          <textarea id="new_domicilio" maxlength="150" class="form-control input-sm" required="true"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewRecibo" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edith Recibo -->
<div class="modal fade" id="EditReciboModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Recibo de Entrega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="edit_id_recibo_entrega" hidden="true">
        <label>Folio</label>
        <input type="text" id="edit_folio" class="form-control  input-sm col-md-4">
        <label>Empresa</label>
        <select class="form-control" id="edit_empresa">
          <option disabled selected>----Seleccionar Cliente----</option>
          <?php foreach ($catalogo_cliente->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
          <?php } ?>
        </select>
        <label>Estado</label>
        <select class="form-control input-sm col-md-6" id="edit_estado">
          <option value="Entrega Pendiente">Entrega Pendiente</option>
          <option value="Entregado">Entregado</option>
          <option value="Cancelado">Cancelado</option>
        </select>
        <label>Fecha de Entrega</label>
        <input type="date" id="edit_fecha_entrega" class="form-control input-sm col-md-6">
        <label>Domicilio de Entrega</label>
        <textarea id="edit_domicilio" maxlength="150" class="form-control input-sm" required="true"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateRecibo" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Recibo de Entrega -->
<div class="modal fade" id="DeleteReciboModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="titleDeleteReciboModal">Eliminar Recibo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6><label>Folio: </label><span class="badge badge-danger" id="delete_folio"></span></h6>
        <h6><label>Empresa: </label><span class="badge badge-danger" id="delete_empresa"></span></h6>
        <h6><label>Fecha de Entrega: </label><span class="badge badge-danger" id="delete_fecha_entrega"></span></h6>
        <h6><label>Domicilio de Entrega: </label><span class="badge badge-danger" id="delete_domicilio"></span></h6>
        <input type="text" id="delete_id_recibo_entrega" hidden="true">
        <h6 class="bg-warning"><p>Al eliminar el Recibo de Entrega, la cantidad de productos que se encontraban listados en este se agregará nuevamente al almacen como existencia.</p></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="Delete_Recibo" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  $(document).ready(function(){
    $('#table_recibo').DataTable({
        "order": [[ 0, "desc" ]]
    } );

    $('#radio_anticipo').click(function(){
      if($("#radio_anticipo").is(":checked")){
        $("#radio_anticipo").val("anticipo");
        $("#radio_cotizacion").val("");        
        $("#radio_nuevo").val("");
        $("#new_cliente").attr("disabled","true");
        $("#cat_cliente").attr("hidden","true");
        $("#cat_anticipo").removeAttr("hidden");
        $("#cat_cotizacion").attr("hidden","true");
      }      
    });
    $('#radio_cotizacion').click(function(){
      if($("#radio_cotizacion").is(":checked")){
        $("#radio_cotizacion").val("cotizacion");
        $("#radio_anticipo").val("");
        $("#radio_nuevo").val("");
        $("#new_cliente").attr("disabled","true");
        $("#cat_cliente").attr("hidden","true");
        $("#cat_anticipo").attr("hidden","true");
        $("#cat_cotizacion").removeAttr("hidden");
      }      
    });
    $('#radio_nuevo').click(function(){
      if($("#radio_nuevo").is(":checked")){
        $("#radio_nuevo").val("nuevo");
        $("#radio_cotizacion").val("");
        $("#radio_anticipo").val("");
        $("#new_cliente").removeAttr("disabled");
        $("#cat_cliente").removeAttr("hidden");
        $("#cat_anticipo").attr("hidden","true");
        $("#cat_cotizacion").attr("hidden","true");
      }      
    });

    $('#NewRecibo').click(function(){
      folio=$('#new_folio').val();
      fecha_ent=$('#new_fecha_entrega').val();
      origen_nuevo=$("#radio_nuevo").val();
      origen_anticipo=$("#radio_anticipo").val();
      origen_cotizacion=$("#radio_cotizacion").val();
      cliente=$("#new_cliente").val();
      anticipo=$("#new_anticipo").val();
      cotizacion=$("#new_cotizacion").val();
      domicilio=$("#new_domicilio").val();
      //alert("folio:"+folio+" fecha_ent: "+fecha_ent+" origen_nuevo: "+origen_nuevo+" origen_anticipo: "+origen_anticipo+" origen_coriza: "+origen_cotizacion+" cliente: "+cliente+" anticipo: "+anticipo+" cotizacion: "+cotizacion+" domicilio:"+domicilio);
      if(folio!=""&&fecha_ent!=""&&domicilio!=""){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/NewReciboEntrega",
          data:{folio:folio, fecha_ent:fecha_ent, origen_nuevo:origen_nuevo, origen_anticipo:origen_anticipo, origen_cotizacion:origen_cotizacion, cliente:cliente, anticipo:anticipo, cotizacion:cotizacion, domicilio:domicilio},
          success:function(result){
              //alert(result);
              if(result){
                alert('Nuevo Recibo de Entrega Agregado');
              }else{
                alert('Falló el servidor. Nuevo Recibo de Entrega no Agregado');
              }
              Update();
            }
          });
        }else{
          alert("Debe ingresar Folio, Fecha y domicilio");
        }
    });

    $('#UpdateRecibo').click(function(){
      id_recibo_entrega=$('#edit_id_recibo_entrega').val();
      folio=$('#edit_folio').val();
      fecha_entrega=$('#edit_fecha_entrega').val();
      id_empresa=$('#edit_empresa').val();
      estado=$('#edit_estado').val();
      domicilio=$('#edit_domicilio').val();
      //alert(cliente+estado+fecha_fin+fecha_ent+coment+id_anticipo);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/Update_ReciboEntrega",
        data:{id_recibo_entrega:id_recibo_entrega, folio:folio, fecha_entrega:fecha_entrega, id_empresa:id_empresa, estado:estado, domicilio:domicilio},
        success:function(result){
            //alert(result);
            if(result){
              alert('Recibio de Entrega Actualizado');
            }else{
              alert('Falló el servidor. Recibio de Entrega no Actualizado');
            }
            Update();
          }
        });
    });

        $('#Delete_Recibo').click(function(){
          id_recibo_entrega=$("#delete_id_recibo_entrega").val();
          var folio=$("#folio"+id_recibo_entrega).text();
          var fecha_entrega=$("#fecha"+id_recibo_entrega).text();
          var domicilio=$("#domicilio"+id_recibo_entrega).text();
          var empresa=$("#empresa"+id_recibo_entrega).text();
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/DeleteRecibo_Entrega",
          data:{id_recibo_entrega:id_recibo_entrega},
          success:function(result){
            //alert(result);
            if(result){
              alert('Recibo de Entrega Eliminado');
            }else{
              alert('Falló el servidor. Recibo de Entrega No Eliminado');
            }
          }
        });
      Update(); 
    });

        $('#Imprime').click(function(){
          id_recibo_entrega=$("#btn_imprime").val();
          var folio=$("#folio"+id_recibo_entrega).text();
          
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/Genera_PDF_Recibo_Entrega",
          data:{id_recibo_entrega:id_recibo_entrega, folio:folio},
          success:function(result){
            //alert(result);
            if(result){
              alert('Recibo de Entrega Generado');
            }else{
              alert('Falló el servidor. Recibo de Entrega No Generado');
            }
          }
        });
      Update(); 
    });


    });


function EditRecibo($id_recibo_entrega){
  var id_recibo_entrega=$id_recibo_entrega;
  var folio=$("#folio"+id_recibo_entrega).text();
  var fecha_entrega=$("#fecha"+id_recibo_entrega).text();
  var domicilio=$("#domicilio"+id_recibo_entrega).text();
  var id_empresa=$("#id_empresa"+id_recibo_entrega).text();
  var estado=$("#estado"+id_recibo_entrega).text();
  $('#EditReciboModal').modal();
  $("#edit_folio").val(folio);
  $("#edit_empresa").val(id_empresa).attr('selected', true);
  $("#edit_id_recibo_entrega").val(id_recibo_entrega);
  $("#edit_estado").val(estado).attr('selected',true);
  $("#edit_domicilio").val(domicilio);
  $("#edit_fecha_entrega").val(fecha_entrega);
}

  function DeleteRecibo($id_recibo_entrega){
    var id_recibo_entrega=$id_recibo_entrega;
    var folio=$("#folio"+id_recibo_entrega).text();
    var fecha_entrega=$("#fecha"+id_recibo_entrega).text();
    var domicilio=$("#domicilio"+id_recibo_entrega).text();
    var empresa=$("#empresa"+id_recibo_entrega).text();
    var estado=$("#estado"+id_recibo_entrega).text();
    $('#DeleteReciboModal').modal();
    $("#titleDeleteReciboModal").text("Eliminar Recibo de Entrega");
    $("#delete_folio").text(folio);
    $("#delete_empresa").text(empresa);
    $("#delete_fecha_entrega").text(fecha_entrega);
    $("#delete_domicilio").text(domicilio);
    $("#delete_id_recibo_entrega").val(id_recibo_entrega);
  }

function Product_Details($id_recibo_entrega){
  var id_recibo_entrega=$id_recibo_entrega;
  $("#page_content").load("Recibdo_Entrega_Lista_Producto",{id_recibo_entrega:id_recibo_entrega});
}


function Update(){
  $('#btncancelar').click();
  $("#page_content").load("Recibo_Entrega");
}

function Get_MAX_Folio_recibo(){
  $.ajax({
    type:"POST",
    url:"<?php echo base_url();?>Iluminacion/GETMAX_Folio_recibo",
     data:{},
      success:function(max_folio){
        //alert(max_folio);
        if (max_folio=="") {
          max_folio="ISA-0";
        }
            if(max_folio){
              folio=max_folio.split('-');
              folio_sig=parseInt(folio[1]);
              folio_sig++;
              //var anio = (new Date).getFullYear();
              $("#new_folio").val("ISA-"+folio_sig);
            }else{
              alert('Error. Intente de nuevo para generar Folio');
            }
       }
  });
}
  </script>