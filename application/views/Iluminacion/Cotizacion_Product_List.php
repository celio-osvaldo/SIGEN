<!--Mostrar lista de Productos de Cotización -->

<div class="container">
  <div class="row">
    <div class="col">
      <button class="btn btn-success" onclick="Lista_Cotizaciones()">Regresar a Lista de Cotizaciones</button>
    </div>
    <div class="col">
      <form action="<?php echo base_url();?>Iluminacion/Genera_PDF_Cotizacion" method="POST" target='_blank'>
        <input hidden="true" type="text" id="id_cotizacion" name="id_cotizacion" value="<?php echo $cotizacion_info->id_cotizacion; ?>">
        <input hidden="true" type="text" id="folio" name="folio" value="<?php echo $cotizacion_info->cotizacion_folio; ?>">
        <input class="btn btn-primary" type="submit" value="Imprimir Cotización" name="btnDownload">
      </form> 
    </div>

   
 </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_cotizacion_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Productos de la Cotización </h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Folio:<hr><?php echo $cotizacion_info->cotizacion_folio; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Fecha:<hr><?php echo $cotizacion_info->cotizacion_fecha; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                 <?php if ($tipo=="cotizante"): ?>
                 Empresa:<hr><?php echo $cotizacion_info->catalogo_cotizante_empresa; ?>
                  <?php endif ?>
                  <?php if ($tipo=="cliente"): ?>
                 Empresa:<hr><?php echo $cotizacion_info->catalogo_cliente_empresa; ?>
                <?php endif ?>


              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Cliente:<hr><?php echo $cotizacion_info->cotizacion_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Obra:<hr><?php echo $cotizacion_info->cotizacion_obra; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Licitación:<hr><?php echo $cotizacion_info->cotizacion_licitacion; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Subtotal:<hr>$<?php echo number_format($cotizacion_info->cotizacion_subtotal,5,'.',','); ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                IVA:<hr>$<?php echo number_format($cotizacion_info->cotizacion_iva,5,'.',','); ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Total:<hr>$<?php echo number_format($cotizacion_info->cotizacion_total,5,'.',','); ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Tiempo de <br>Entrega (semanas):<hr><?php echo $cotizacion_info->cotizacion_tiempo_entrega; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Vigencia <br>(días):<hr><?php echo $cotizacion_info->cotizacion_vigencia; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Elaboró:<hr><?php echo $cotizacion_info->cotizacion_elabora; ?>
              </h6>
            </span>
          </div>
        </div>
      </div>
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="true">id_cotizacion</th>
          <th>Nombre de Producto</th>
          <th hidden="true">id_producto</th>
          <th>Modelo</th>
          <th>Descripcion</th>
          <th>Cantidad de Productos</th>
          <th>Precio Unitario</th>
          <th>Descuento</th>
          <th>Importe</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($cotizacion_products->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_lista_cotizacion".$row->id_lista_cotizacion;?>"><?php echo "".$row->id_lista_cotizacion.""; ?></td>
            <td id="<?php echo "nombre".$row->id_lista_cotizacion;?>"><?php echo "".$row->prod_alm_nom.""; ?></td>
            <td hidden="true"id="<?php echo "id_producto".$row->id_lista_cotizacion;?>"><?php echo "".$row->lista_cotizacion_id_prod_alm.""; ?></td>
            <td id="<?php echo "modelo".$row->id_lista_cotizacion;?>"><?php echo "".$row->prod_alm_modelo.""; ?></td>
            <td id="<?php echo "descripcion".$row->id_lista_cotizacion;?>"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
            <td id="<?php echo "cantidad".$row->id_lista_cotizacion;?>"><?php echo $row->lista_cotizacion_cantidad;?></td>
            <td id="<?php echo "precio_unit".$row->id_lista_cotizacion;?>">$<?php echo number_format($row->lista_cotizacion_precio_unit,5,'.',',');?></td>
            <td id="<?php echo "descuento".$row->id_lista_cotizacion;?>"><?php echo number_format($row->lista_cotizacion_descuento,2,'.',',');?>%</td>
            <td id="<?php echo "importe".$row->id_lista_cotizacion;?>">$<?php echo number_format($row->lista_cotizacion_importe,5,'.',',');?></td>
            <td>
              <a class="navbar-brand" onclick="EditProduct(this.id)" role="button" id="<?php echo $row->id_lista_cotizacion; ?>"><button class="btn btn-outline-secondary"><img width="20px" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" title="Editar Producto" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeleteProduct(this.id)" role="button" id="<?php echo $row->id_lista_cotizacion; ?>"><button class="btn btn-outline-secondary"><img width="20px" src="..\Resources\Icons\delete.ico" title="Eliminar Producto" style="filter: invert(100%)" /></button></a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


<!-- Modal Edit Product -->
<div class="modal fade" id="Edit_ProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="edit_prod_id_cotizacion" hidden="true">
        <input type="text" id="edit_id_lista_cotizacion" hidden="true">
        <label>Producto</label>
        <select class="form-control" id="edit_prod_nombre" disabled="true">
          <option disabled selected>----Seleccionar Producto----</option>
          <?php foreach ($inventario_productos->result() as $row){ ?>
            <option value="<?php echo "".$row->id_prod_alm.""; ?>"><?php echo "".$row->prod_alm_nom.""; ?></option>
          <?php } ?>
        </select>
         <div class="form-row">
          <div class="form-group col-md-4">
            <label>Cantidad</label>
            <input type="number" min="0" id="edit_prod_cantidad" class="form-control input-sm">
          </div>
          <div class="form-group col-md-4">
            <label>Precio Unitario</label>
            <input type="text" onblur="Separa_Miles(this.id)" id="edit_precio_unit" class="form-control input-sm">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Descuento (%)</label>
            <input type="number" id="edit_prod_descuento" min="0" max="100" class="form-control input-sm">
          </div>
          <div class="form-group col-md-4">
            <label>Importe</label>
            <input type="text" onblur="Separa_Miles(this.id)" id="edit_prod_total" disabled="true" class="form-control input-sm">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="EditProduct" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Product Anticipo -->
<div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="titleDeleteProductModal">Eliminar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6><label>Cantidad: </label><span class="badge badge-danger" id="delete_cant"></span></h6>
        <h6><label>Precio de Venta: $</label><span class="badge badge-danger" id="delete_precio"></span></h6>
        <h6><label>Descuento: </label><span class="badge badge-danger" id="delete_descuento"></span></h6>
        <h6><label>Importe: $</label><span class="badge badge-danger" id="delete_importe"></span></h6>
        <input type="text" id="delete_id_lista_cotizacion" hidden="true">
        <h6 class="bg-warning"><p>Al eliminar el producto, se actualizará el importe total de la Cotización</p></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="Delete_Product" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_cotizacion_prod_list').DataTable();


    $( "#edit_prod_cantidad" ).change(function() {
      var id_producto=$('#edit_prod_nombre').val();
      <?php foreach ($inventario_productos->result() as $key): ?>
        if (id_producto==<?php echo $key->id_prod_alm; ?>) {
          var precio_unitario=(<?php echo $key->prod_alm_prec_unit; ?>);
          var existencia=(<?php echo $key->prod_alm_exist; ?>);
          var precio_venta=(<?php echo $key->prod_alm_precio_venta; ?>);
        }
      <?php endforeach ?>
      $("#edit_precio_unit").val(precio_venta);
      //$("#edit_prod_cantidad").val(0);
      $("#edit_prod_cantidad").attr({"max" : existencia});
      $("#edit_prod_total").val($("#edit_prod_cantidad").val()*$("#edit_precio_unit").val().replace(/,/g, ""));
      var cantidad=$("#edit_prod_cantidad").val();
        var porcentaje=$("#edit_prod_descuento").val();
        if(porcentaje==""||porcentaje>100||porcentaje<0){
          porcentaje=100;
          $("#edit_prod_descuento").val(0);
        }else{
          porcentaje=100-porcentaje;
        }
      if (cantidad>existencia) {
        alert("Atención! \nCantidad no existente del producto! Existencia actual: "+existencia);
        var total=($("#edit_prod_cantidad").val()*$("#edit_precio_unit").val().replace(/,/g, "")).toFixed(5);
         total=((total*porcentaje)/100).toFixed(5);
        $("#edit_prod_total").val(total);
      }else{
        var total=($("#edit_prod_cantidad").val()*$("#edit_precio_unit").val().replace(/,/g, "")).toFixed(5);
         total=((total*porcentaje)/100).toFixed(5);
        $("#edit_prod_total").val(total);
      }
    });

     $( "#edit_precio_unit" ).change(function() {
      var porcentaje=$("#edit_prod_descuento").val();
        if(porcentaje==""||porcentaje>100||porcentaje<0){
          porcentaje=100;
          $("#edit_prod_descuento").val(0);
        }else{
          porcentaje=100-porcentaje;
        }
        var total=($("#edit_prod_cantidad").val()*$("#edit_precio_unit").val().replace(/,/g, "")).toFixed(5);
         total=((total*porcentaje)/100).toFixed(5);
        $("#edit_prod_total").val(total);
    });

    $( "#edit_prod_descuento" ).change(function() {
      var porcentaje=$("#edit_prod_descuento").val();
        if(porcentaje==""||porcentaje>100||porcentaje<0){
          porcentaje=100;
          $("#edit_prod_descuento").val(0);
        }else{
          porcentaje=100-porcentaje;
        }
        var total=($("#edit_prod_cantidad").val()*$("#edit_precio_unit").val().replace(/,/g, "")).toFixed(5);
        total=((total*porcentaje)/100).toFixed(5);
        $("#edit_prod_total").val(total);
    });


    $('#EditProduct').click(function(){
      edit_id_lista_cotizacion=$("#edit_id_lista_cotizacion").val();
      id_cotizacion=<?php echo $cotizacion_info->id_cotizacion; ?>;
      id_producto=$("#edit_prod_nombre").val();
      prod_cantidad=$("#edit_prod_cantidad").val();
      prod_precio_venta=$("#edit_precio_unit").val().replace(/,/g, "");
      prod_descuento=$("#edit_prod_descuento").val();
      total=$("#edit_prod_total").val();
      //alert(prod_id_cotizacion+" "+id_producto+" "+prod_cantidad+" "+prod_precio_venta+" "+total+" "+prod_descuento);
      if(prod_cantidad>0&&id_producto!=null){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/Edit_Cotizacion_Product",
          data:{id_cotizacion:id_cotizacion, edit_id_lista_cotizacion:edit_id_lista_cotizacion, id_producto:id_producto, prod_cantidad:prod_cantidad, prod_precio_venta:prod_precio_venta, total:total, prod_descuento:prod_descuento},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Editado.');
            }else{
              alert('Falló el servidor. Producto no Editado');
            }
            Update();
          }
        });
      }else{
        alert("Debe Ingresar por lo menos 1 producto");
      }
    });

        $('#Delete_Product').click(function(){
          id_lista_cotizacion=$("#delete_id_lista_cotizacion").val();
          id_cotizacion=<?php echo $cotizacion_info->id_cotizacion; ?>;
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/DeleteProduct_Cotizacion",
          data:{id_lista_cotizacion:id_lista_cotizacion, id_cotizacion:id_cotizacion},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Eliminado');
            }else{
              alert('Falló el servidor. Producto no eliminado');
            }
            Update();
          }
        });
      Update(); 

    });



  });
  
  function EditProduct($id_lista_cotizacion){
    id_lista_cotizacion=$id_lista_cotizacion;
    prod_id_cotizacion=$('#id_producto'+id_lista_cotizacion).text();
    cantidad=$('#cantidad'+id_lista_cotizacion).text();
    precio_unit=$('#precio_unit'+id_lista_cotizacion).text().split('$');
    precio_unit[1]=precio_unit[1].replace(/\,/g, '');
    descuento=$('#descuento'+id_lista_cotizacion).text().split('%');
    importe=$('#importe'+id_lista_cotizacion).text().split('$');
    importe[1]=importe[1].replace(/\,/g, '');
    //alert(importe[1]);
    $('#Edit_ProductModal').modal();
    $('#edit_id_lista_cotizacion').val(id_lista_cotizacion);    
    $('#edit_prod_id_cotizacion').val(prod_id_cotizacion);
    $("#edit_prod_cantidad").val(cantidad);
    $("#edit_precio_unit").val(precio_unit[1]);
    $("#edit_prod_descuento").val(descuento[0]);
    $("#edit_prod_total").val(importe[1]);
    $("#edit_prod_nombre").val(prod_id_cotizacion).attr('selected',true);
  }

  function DeleteProduct($id_lista_cotizacion){
    id_lista_cotizacion=$id_lista_cotizacion;
    nombre_prod=$("#nombre"+id_lista_cotizacion).text();
    cantidad=$('#cantidad'+id_lista_cotizacion).text();
    precio_unit=$('#precio_unit'+id_lista_cotizacion).text().split('$');
    descuento=$('#descuento'+id_lista_cotizacion).text().split('%');
    importe=$('#importe'+id_lista_cotizacion).text().split('$');
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
    $('#DeleteProductModal').modal();
     $("#titleDeleteProductModal").text("Eliminar Producto: "+nombre_prod);
     $("#delete_cant").text(cantidad);
     $("#delete_precio").text(parseFloat(precio_unit[1]));
     $("#delete_descuento").text(descuento[0]+"%");
     $("#delete_importe").text(importe[1]);
     $("#delete_id_lista_cotizacion").val(id_lista_cotizacion);
  }



  function Lista_Cotizaciones(){
    $("#page_content").load("Cotizaciones");
  }
function Update(){
   id_cotizacion=<?php echo $cotizacion_info->id_cotizacion; ?>;
  $('#btncancelar').click();
  $("#page_content").load("Cotizacion_Details",{id_cotizacion:id_cotizacion});
}



</script>