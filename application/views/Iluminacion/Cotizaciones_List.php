
<!--Mostrar lista de Anticipos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Cotizaciones</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" onclick="Get_MAX_Folio()" data-target="#NewCotizacionModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nueva Cotización</button>
  </div>
</div>

<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_cotizacion" class="table table-striped table-hover display" style="font-size: 8pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="true">id_cotización</th>
          <th>Folio</th>
          <th>Fecha</th>
          <th>Empresa</th>
          <th hidden="true">id_cliente</th>
          <th >Obra</th>
          <th>Cliente (Atención)</th>
          <th>Licitacion</th>
          <th>Subtotal</th>
          <th>IVA</th>
          <th>Total</th>
          <th>Comentarios</th>
          <th>Tiempo Entrega (semanas)</th>
          <th>Vigencia (días)</th>
          <th>Elaboró</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($lista_cotizaciones->result() as $row) {
          $tipo_cot_clie=explode("-", $row->cotizacion_id_cliente);
          if($tipo_cot_clie[0]=="cot"){
            foreach ($catalogo_cotizante->result() as $cotizante) {
              if ($tipo_cot_clie[1]==$cotizante->id_catalogo_cotizante) {
                $nom_clie_cot=$cotizante->catalogo_cotizante_nombre;
                $id_clie_cot=$row->cotizacion_id_cliente;
              }
            }            
          }else{ 
            foreach ($catalogo_cliente->result() as $cliente) {
              if ($cliente->id_catalogo_cliente==$tipo_cot_clie[0]) {
                $nom_clie_cot=$cliente->catalogo_cliente_empresa;
                $id_clie_cot=$cliente->id_catalogo_cliente;
              }
            }
          }
         ?>
         <tr>
          <td hidden="true" id="<?php echo "id_cotizacion".$row->id_cotizacion;?>"><?php echo "".$row->id_cotizacion.""; ?></td>
          <td id="<?php echo "folio".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_folio.""; ?></td>
          <td id="<?php echo "fecha".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_fecha.""; ?></td>

          <td id="<?php echo "empresa".$row->id_cotizacion;?>"><?php echo "".$nom_clie_cot.""; ?></td>
          <td hidden="true" id="<?php echo "id_cliente".$row->id_cotizacion;?>"><?php echo "".$id_clie_cot.""; ?></td>
          <td id="<?php echo "obra".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_obra.""; ?></td>



          <td id="<?php echo "cliente".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_empresa.""; ?></td>
          <td id="<?php echo "licitacion".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_licitacion.""; ?></td>
          <td id="<?php echo "subtotal".$row->id_cotizacion;?>">$<?php echo number_format($row->cotizacion_subtotal,5,'.',',').""; ?></td>
          <td id="<?php echo "iva".$row->id_cotizacion;?>">$<?php echo number_format($row->cotizacion_iva,5,'.',',').""; ?></td>
          <td id="<?php echo "total".$row->id_cotizacion;?>">$<?php echo number_format($row->cotizacion_total,5,'.',',').""; ?></td>
          <td id="<?php echo "coment".$row->id_cotizacion;?>"><?php echo $row->cotizacion_comentario ?></td>
          <td id="<?php echo "tiempo_entrega".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_tiempo_entrega.""; ?></td>
          <td id="<?php echo "vigencia".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_vigencia.""; ?></td>
          <td id="<?php echo "elabora".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_elabora.""; ?></td>
          <td id="<?php echo "estado".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_estado.""; ?></td>

          <td>
            <div class="row">
              
           <a class="btn btn-outline-secondary" onclick="EditCotizacion(this.id)" role="button" id="<?php echo $row->id_cotizacion; ?>">
            <img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
            </a>
            <a class="btn btn-outline-secondary" onclick="Add_Product(this.id)" role="button" id="<?php echo $row->id_cotizacion; ?>"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="20px" alt="Agregar" style="filter: invert(100%)">
            </a>
            <a class="btn btn-outline-secondary"  onclick="Details_Cotizacion(this.id)" role="button" id="<?php echo $row->id_cotizacion; ?>"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)">
            </a>
            <form action="<?php echo base_url();?>Iluminacion/Genera_PDF_Cotizacion" method="POST" target='_blank'>
             <input type="text" hidden="true" id="id_cotizacion" name="id_cotizacion" value="<?php echo $row->id_cotizacion; ?>">
              <input hidden="true" type="text" id="folio" name="folio" value="<?php echo $row->cotizacion_folio; ?>">
             <button class="btn btn-outline-secondary" type="submit" title="Imprimir Cotización"><img src="..\Resources\Icons\imprimir.ico" width="20px" style="filter: invert(100%)"></button>
           </form>
            </div>
         </td>



        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>

<!-- Modal New Cotización -->
<div class="modal fade" id="NewCotizacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Cotización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Folio</label>
            <input type="text" id="new_folio" class="form-control">
          </div>
          <div class="form-group col-md-5">
            <label>Fecha de Elaboración</label>
            <input type="date" id="new_fecha_elabora" class="form-control">
          </div>
        </div>
        <div class="radio">
          <label><input onclick="Ver_Catalogo(this.id)" checked="true" type="radio" name="radio_btn" id="radio_btn" value="cliente">Catálogo Clientes</label>
        </div>
        <div class="radio">
          <label><input onclick="Ver_Catalogo(this.id)"  type="radio" name="radio_btn" id="radio_btn" value="cotizante">Catálogo Cotizantes</label>
        </div>
        <label>Empresa</label>
        <select class="form-control" id="new_cliente">
          <option disabled selected>----Seleccionar Empresa----</option>
          <?php foreach ($catalogo_cliente->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
          <?php } ?>
        </select>

        <select class="form-control" id="new_cotizante" hidden="true">
          <option disabled selected>----Seleccionar Cotizante----</option>
          <?php foreach ($catalogo_cotizante->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cotizante.""; ?>"><?php echo "".$row->catalogo_cotizante_nombre.""; ?></option>
          <?php } ?>
        </select>

        <label>Obra</label><br>
        <input type="text" maxlength="200" id="new_obra" class="form-control input-sm">
        <label>Atención (Cliente)</label>
        <input type="text" maxlength="200" id="new_empresa" class="form-control input-sm">
        <label>Licitación</label>
        <input type="text" maxlength="200" id="new_licitacion" class="form-control input-sm">
        <label>Comentarios</label>
        <textarea  maxlength="200" id="new_coment" class="form-control input-sm"></textarea>
        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Tiempo de Entrega (semanas)</label>
            <input type="number" id="new_tiem_entrega" class="form-control input-sm">
          </div>
          <div class="form-group col-md-4">
            <label>Vigencia (días)</label>
            <input type="number" id="new_vigencia" class="form-control input-sm">
          </div>
          <label>Nombre de quien Elabora Cotización</label>
          <input type="text" maxlength="200" id="new_elabora" class="form-control input-sm">
          <label>Estado de Cotización</label>
          <select class="form-control" id="new_estado">
            <option value="Activo">Activo</option>
            <option value="Vencido">Vencido</option>
            <option value="Cancelado">Cancelado</option>
            <option value="Entregado">Entregado</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
          <button type="button" class="btn btn-primary" id="NewCotizacion" data-dismiss="modal">Aceptar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Cotización -->
<div class="modal fade" id="EditCotizacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Cotización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <input type="text" id="edit_id_cotizacion" hidden="true">
            <label>Folio</label>
            <input type="text" id="edit_folio" class="form-control">
          </div>
          <div class="form-group col-md-5">
            <label>Fecha de Elaboración</label>
            <input type="date" id="edit_fecha_elabora" class="form-control">
          </div>
        </div>
        <div class="radio">
          <label><input onclick="Ver_Catalogo_2(this.id)"  type="radio" name="edit_radio_btn" id="edit_radio_btn" value="cliente">Catálogo Clientes</label>
        </div>
        <div class="radio">
          <label><input onclick="Ver_Catalogo_2(this.id)"  type="radio" name="edit_radio_btn" id="edit_radio_btn" value="cotizante">Catálogo Cotizantes</label>
        </div>

        <label>Empresa</label>

        <select class="form-control" id="edit_cliente">
          <option disabled selected>----Seleccionar Empresa----</option>
          <?php foreach ($catalogo_cliente->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
          <?php } ?>
        </select>

        <select class="form-control" id="edit_cotizante" hidden="true">
          <option disabled selected>----Seleccionar Cotizante----</option>
          <?php foreach ($catalogo_cotizante->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cotizante.""; ?>"><?php echo "".$row->catalogo_cotizante_nombre.""; ?></option>
          <?php } ?>
        </select>


        <label>Obra</label><br>
        <input type="text" maxlength="200" id="edit_obra" class="form-control input-sm">
        <label>Atención (Cliente)</label><br>
        <input type="text" maxlength="200" id="edit_empresa" class="form-control input-sm">
        <label>Licitación</label><br>
        <input type="text" maxlength="200" id="edit_licitacion" class="form-control input-sm">
        <label>Comentarios</label>
        <input type="text" maxlength="200" id="edit_coment" class="form-control input-sm">
        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Tiempo de Entrega (días)</label>
            <input type="number" id="edit_tiem_entrega" class="form-control input-sm">
          </div>
          <div class="form-group col-md-4">
            <label>Vigencia (días)</label>
            <input type="number" id="edit_vigencia" class="form-control input-sm">
          </div>
          <label>Nombre de quien Elabora Cotización</label>
          <input type="text" maxlength="200" id="edit_elabora" class="form-control input-sm">
          <label>Estado de Cotización</label>
          <select class="form-control" id="edit_estado">
            <option value="Activo">Activo</option>
            <option value="Vencido">Vencido</option>
            <option value="Cancelado">Cancelado</option>
            <option value="Entregado">Entregado</option>
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
          <button type="button" class="btn btn-primary" id="UpdateCotizacion" data-dismiss="modal">Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal Add Product -->
<div class="modal fade" id="Add_ProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="prod_id_cotizacion" hidden="true">
        <label>Producto</label>
        <select class="form-control" id="prod_nombre">
          <option disabled selected>----Seleccionar Producto----</option>
          <?php foreach ($inventario_productos->result() as $row){ ?>
            <option value="<?php echo "".$row->id_prod_alm.""; ?>"><?php echo "".$row->prod_alm_nom.""; ?></option>
          <?php } ?>
        </select>
         <div class="form-row">
          <div class="form-group col-md-4">
            <label>Cantidad</label>
            <input type="number" min="0" max="0" id="prod_cantidad" class="form-control input-sm">
          </div>
          <div class="form-group col-md-4">
            <label>Precio Venta</label>
            <input type="text" onblur="Separa_Miles(this.id)" id="prod_precio" class="form-control input-sm">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Descuento (%)</label>
            <input type="number" id="prod_descuento" min="0" max="100" class="form-control input-sm">
          </div>
          <div class="form-group col-md-4">
            <label>Total</label>
            <input type="text" onblur="Separa_Miles(this.id)" id="prod_total" disabled="true" class="form-control input-sm">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="AddProduct" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_cotizacion').DataTable({
      "bSort": true,
    });

    $('#NewCotizacion').click(function(){
      new_folio=$('#new_folio').val();
      new_fecha_elabora=$('#new_fecha_elabora').val();
      if ($('input:radio[name=radio_btn]:checked').val()=="cliente") 
      {
        new_cliente=$('#new_cliente').val();
      }else{
        new_cliente="cot-"+$('#new_cotizante').val();
      }
      new_obra=$('#new_obra').val();
      new_tiem_entrega=$('#new_tiem_entrega').val();
      new_vigencia=$('#new_vigencia').val();
      new_elabora=$('#new_elabora').val();
      new_estado=$('#new_estado').val();
      new_empresa=$('#new_empresa').val();
      new_licitacion=$('#new_licitacion').val();
      new_coment=$('#new_coment').val();
      //alert(cliente+fecha_fin+fecha_ent+coment);
      if(new_folio!=""&&new_fecha_elabora!=""&&new_cliente!=""){
        $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/New_Cotizacion",
        data:{new_folio:new_folio, new_fecha_elabora:new_fecha_elabora, new_cliente:new_cliente, new_obra:new_obra, new_tiem_entrega:new_tiem_entrega, new_vigencia:new_vigencia, new_elabora:new_elabora, new_estado:new_estado, new_empresa:new_empresa, new_licitacion:new_licitacion, new_coment:new_coment},
        success:function(result){
            //alert(result);
            if(result){
              alert('Nueva cotización Agregada');
            }else{
              alert('Falló el servidor. Nueva cotización no Agregada');
            }
            Update();
          }
        });
      }else{
        alert("Debe indicar Folio, fecha de elaboracion, cliente");
      }

    });


    $('#UpdateCotizacion').click(function(){
      id_cotizacion=$('#edit_id_cotizacion').val();
      folio=$('#edit_folio').val();
      fecha_elabora=$('#edit_fecha_elabora').val();

      if ($('input:radio[name=edit_radio_btn]:checked').val()=="cliente") 
      {
        cliente=$('#edit_cliente').val();
      }else{
        cliente="cot-"+$('#edit_cotizante').val();
      }

      obra=$('#edit_obra').val();
      tiem_entrega=$('#edit_tiem_entrega').val();
      vigencia=$('#edit_vigencia').val();
      elabora=$('#edit_elabora').val();
      estado=$('#edit_estado').val();
      licitacion=$('#edit_licitacion').val();
      coment=$('#edit_coment').val()
      empresa=$('#edit_empresa').val();
      //alert(cliente+estado+fecha_fin+fecha_ent+coment+id_anticipo);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/Update_Cotizacion",
        data:{id_cotizacion:id_cotizacion, folio:folio, fecha_elabora:fecha_elabora, cliente:cliente, obra:obra, tiem_entrega:tiem_entrega, vigencia:vigencia, elabora:elabora, estado:estado,licitacion:licitacion, empresa:empresa, coment:coment},
        success:function(result){
            //alert(result);
            if(result){
              alert('Cotización Actualizada');
            }else{
              alert('Falló el servidor. Cotización no Actualizada');
            }
            Update();
          }
        });
    });

    $( "#prod_nombre" ).change(function() {
      var id_producto=$('#prod_nombre').val();
      <?php foreach ($inventario_productos->result() as $key): ?>
        if (id_producto==<?php echo $key->id_prod_alm; ?>) {
          var precio_unitario=(<?php echo $key->prod_alm_prec_unit; ?>);
          var existencia=(<?php echo $key->prod_alm_exist; ?>);
          var precio_venta=(<?php echo $key->prod_alm_precio_venta; ?>);
        }
      <?php endforeach ?>
      $("#prod_precio").val(0);
      $("#prod_cantidad").val(0);
      $("#prod_precio").val(precio_venta);
      $("#prod_cantidad").attr({"max" : existencia});
      $("#prod_total").val($("#prod_cantidad").val()*$("#prod_precio").val().replace(/,/g, ""));
    });

    $( "#prod_cantidad" ).change(function() {
      var cantidad=$("#prod_cantidad").val();
      var id_producto=$('#prod_nombre').val();
      <?php foreach ($inventario_productos->result() as $key): ?>
        if (id_producto==<?php echo $key->id_prod_alm; ?>) {
          var existencia=(<?php echo $key->prod_alm_exist; ?>);
        }
      <?php endforeach ?>

        var porcentaje=$("#prod_descuento").val();
        if(porcentaje==""||porcentaje>100||porcentaje<0){
          porcentaje=100;
          $("#prod_descuento").val(0);
        }else{
          porcentaje=100-porcentaje;
        }
      if (cantidad>existencia) {
        alert("Atención! \nCantidad no existente del producto! Existencia actual: "+existencia);
        var total=($("#prod_cantidad").val()*$("#prod_precio").val().replace(/,/g, "")).toFixed(5);
         total=((total*porcentaje)/100).toFixed(5);
        $("#prod_total").val(total);
      }else{
        var total=($("#prod_cantidad").val()*$("#prod_precio").val().replace(/,/g, "")).toFixed(5);
         total=((total*porcentaje)/100).toFixed(5);
        $("#prod_total").val(total);
      }
    });

    $( "#prod_precio" ).change(function() {
      var porcentaje=$("#prod_descuento").val();
        if(porcentaje==""||porcentaje>100||porcentaje<0){
          porcentaje=100;
          $("#prod_descuento").val(0);
        }else{
          porcentaje=100-porcentaje;
        }
        var total=($("#prod_cantidad").val()*$("#prod_precio").val().replace(/,/g, "")).toFixed(5);
         total=((total*porcentaje)/100).toFixed(5);
        $("#prod_total").val(total);
    });

    $( "#prod_descuento" ).change(function() {
      var porcentaje=$("#prod_descuento").val();
        if(porcentaje==""||porcentaje>100||porcentaje<0){
          porcentaje=100;
          $("#prod_descuento").val(0);
        }else{
          porcentaje=100-porcentaje;
        }
        var total=($("#prod_cantidad").val()*$("#prod_precio").val().replace(/,/g, "")).toFixed(5);
        total=((total*porcentaje)/100).toFixed(5);
        $("#prod_total").val(total);
    });


    $('#AddProduct').click(function(){
      prod_id_cotizacion=$("#prod_id_cotizacion").val();
      id_producto=$("#prod_nombre").val();
      prod_cantidad=$("#prod_cantidad").val();
      prod_precio_venta=$("#prod_precio").val();
      prod_descuento=$("#prod_descuento").val();
      total=$("#prod_total").val();
      //alert(prod_id_cotizacion+" "+id_producto+" "+prod_cantidad+" "+prod_precio_venta+" "+total+" "+prod_descuento);
      if(prod_cantidad>0&&id_producto!=null){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/Add_Cotizacion_Product",
          data:{prod_id_cotizacion:prod_id_cotizacion, id_producto:id_producto, prod_cantidad:prod_cantidad, prod_precio_venta:prod_precio_venta, total:total, prod_descuento:prod_descuento},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Agregado a la Cotización.');
            }else{
              alert('Falló el servidor. Producto no Agregado');
            }
            Update();
          }
        });
      }else{
        alert("Debe Ingresar por lo menos 1 producto");
      }
    });


  });

  function EditCotizacion($id_cotizacion){
    id_cotizacion=$id_cotizacion;
    folio=$('#folio'+id_cotizacion).text();
    fecha_elabora=$('#fecha'+id_cotizacion).text();
    cliente=$('#id_cliente'+id_cotizacion).text();
    obra=$('#obra'+id_cotizacion).text();
    tiem_entrega=$('#tiempo_entrega'+id_cotizacion).text();
    vigencia=$('#vigencia'+id_cotizacion).text();
    elabora=$('#elabora'+id_cotizacion).text();
    estado=$('#estado'+id_cotizacion).text();
    licitacion=$('#licitacion'+id_cotizacion).text();
    empresa=$('#empresa'+id_cotizacion).text();
    coment=$('#coment'+id_cotizacion).text();

    clie_coti=cliente.split("-");

    $('#EditCotizacionModal').modal();
    $('#edit_id_cotizacion').val(id_cotizacion);
    $("#edit_folio").val(folio);
    $("#edit_fecha_elabora").val(fecha_elabora);
    if (clie_coti[0]=="cot") {
       $("#edit_cotizante").removeAttr("hidden");
       $("input[name=edit_radio_btn][value='cotizante']").prop("checked",true);
       $("#edit_cliente").attr('hidden','true');
       $("#edit_cotizante").val(clie_coti[1]).attr('selected',true);
    }else{
      $("#edit_cliente").removeAttr("hidden");
      $("input[name=edit_radio_btn][value='cliente']").prop("checked",true);
      $("#edit_cotizante").attr('hidden','true');
      $("#edit_cliente").val(clie_coti[0]).attr('selected',true);
    }

    $("#edit_obra").val(obra);
    $("#edit_empresa").val(empresa);
    $("#edit_coment").val(coment);
    $("#edit_licitacion").val(licitacion);
    $("#edit_tiem_entrega").val(tiem_entrega);
    $("#edit_vigencia").val(vigencia);
    $("#edit_elabora").val(elabora);
    $("#edit_estado").val(estado).attr('selected',true);
  }

function Add_Product($id_cotizacion){
  var id_cotizacion=$id_cotizacion;
  $('#Add_ProductModal').modal();
  $("#prod_id_cotizacion").val(id_cotizacion);
}

function Details_Cotizacion($id_cotizacion){
  var id_cotizacion=$id_cotizacion;
  $("#page_content").load("Cotizacion_Details",{id_cotizacion:id_cotizacion});
}

function Update(){
  $('#btncancelar').click();
  $("#page_content").load("Cotizaciones");
}



function Get_MAX_Folio(){
  $.ajax({
    type:"POST",
    url:"<?php echo base_url();?>Iluminacion/GETMAX_Folio",
     data:{},
      success:function(max_folio){
            if(max_folio){
              folio=max_folio.split('-');
              folio_sig=parseInt(folio[1]);
              folio_sig++;
              var anio = (new Date).getFullYear();
              $("#new_folio").val("ISA"+anio+"-"+folio_sig);
            }else{
              alert('Error. Intente de nuevo para generar Folio');
            }
       }
  });
}

function Ver_Catalogo($id_btn){
  var id=$id_btn;
  //alert($('input:radio[name='+id+']:checked').val());
  if($('input:radio[name='+id+']:checked').val()=="cliente"){
    $("#new_cliente").removeAttr("hidden");
    $("#new_cotizante").attr('hidden','true');
  }else{
    $("#new_cotizante").removeAttr("hidden");
    $("#new_cliente").attr('hidden','true');
  }
}

function Ver_Catalogo_2($id_btn){
  var id=$id_btn;
  //alert($('input:radio[name='+id+']:checked').val());
  if($('input:radio[name='+id+']:checked').val()=="cliente"){
    $("#edit_cliente").removeAttr("hidden");
    $("#edit_cotizante").attr('hidden','true');
  }else{
    $("#edit_cotizante").removeAttr("hidden");
    $("#edit_cliente").attr('hidden','true');
  }
}


</script>