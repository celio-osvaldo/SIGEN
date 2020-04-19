<!--Mostrar lista de Pagos de Anticipo -->

<div class="container">
  <button class="btn btn-success" onclick="Lista_Anticipos()">Regresar a Lista de Anticipos</button>
</div>
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_anticipo_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Pagos en Anticipo </h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Cliente:<hr><?php echo $anticipo_info->catalogo_cliente_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Total de Anticipo:<hr>$<?php echo $anticipo_info->anticipo_total; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Total Pagado:<hr>$<?php echo $anticipo_info->anticipo_pago; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Saldo:<hr>$<?php echo $anticipo_info->anticipo_resto; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Comentarios:<hr><?php echo $anticipo_info->anticipo_coment; ?>
              </h6>
            </span>
          </div>
        </div>
      </div>
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="false">id_pagos_anticipo</th>
          <th>Fecha de Pago</th>
          <th>Cantidad de Pago</th>
          <th>Comentarios</th>
          <th>Comprobante</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($anticipo_pagos->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_pagos_anticipo".$row->id_pagos_anticipo;?>"><?php echo "".$row->id_pagos_anticipo.""; ?></td>
            <td id="<?php echo "fecha".$row->id_pagos_anticipo;?>"><?php echo "".$row->pagos_anticipo_fecha.""; ?></td>
            <td id="<?php echo "cantidad".$row->id_pagos_anticipo;?>">$<?php echo "".$row->pagos_anticipo_cantidad.""; ?></td>
            <td id="<?php echo "coment".$row->id_pagos_anticipo;?>"><?php echo "".$row->pagos_anticipo_coment.""; ?></td>
            <td id="<?php echo "comprobante".$row->id_pagos_anticipo;?>"><label hidden="true" id="<?php echo "url_".$row->id_pagos_anticipo;?>"><?php echo base_url().$row->pagos_anticipo_url_comprobante; ?></label> <a  onclick="ver_comprobante(this.id)" role="button" id="<?php echo $row->id_pagos_anticipo;?>"><button class="btn btn-outline-secondary" title="Ver comprobante de pago"><img src="..\Resources\Icons\frame_gallery_image_images_photo_picture_pictures_icon_123209.ico" style="filter: invert(100%)" /></button></a>
            </td>
            <td>
              <a class="navbar-brand" onclick="EditPay(this.id)" role="button" id="<?php echo $row->id_pagos_anticipo; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" title="Editar Pago" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeletePay(this.id)" role="button" id="<?php echo $row->id_pagos_anticipo; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\delete.ico" title="Eliminar Pago" style="filter: invert(100%)" /></button></a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
              <!--
// Show image preview
          $('#preview').append("<a href='<?php echo base_url() ?>"+response+"' target='_blank'><img src='<?php echo base_url() ?>"+response+"' width='100' height='100' style='display: inline-block;'></a>");
        -->
<!-- Modal Ver Comprobante de Pago -->
<div class="modal fade" id="ver_comprobanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titlecomprobanteModal">Comprobante de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Product Anticipo -->
<div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleProductModal">Editar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Cantidad</label>
        <input type="number" min="0" id="edit_cant" class="form-control input-sm">
        <label>Precio de Venta</label>
        <input type="number" min="0" id="edit_precio" class="form-control input-sm">
        <label>Comentarios</label>
        <textarea id="edit_coment" class="form-control input-sm" maxlength="200"></textarea>
        <input type="text" id="edit_id_prod_ant" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateProduct" data-dismiss="modal">Actualizar</button>
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
        <h6><label>Comentarios: </label><span class="badge badge-danger" id="delete_coment"></span></h6>
        <input type="text" id="delete_id_prod_ant" hidden="true">
        <h6 class="bg-warning"><p>Al eliminar el producto, la cantidad de este se agregará nuevamente al almacen como existencia.</p></h6>
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
    $('#table_anticipo_prod_list').DataTable();

        //Función para actualizar el registro de un Producto
        $('#UpdateProduct').click(function(){
          id_prod_ant=$("#edit_id_prod_ant").val();
          id_anticipo=$("#id_anticipo"+id_prod_ant).text();
          act_cantidad=$("#edit_cant").val();
          cant_anterior=$("#cantidad"+id_prod_ant).text();
          act_precio_venta=$("#edit_precio").val();
          precio_anterior=$("#precio"+id_prod_ant).text().split('$');
          act_coment=$("#edit_coment").val();
          id_producto=$("#id_producto"+id_prod_ant).text();
   //alert(id_anticipo+" "+id_prod_ant+" "+act_cantidad+" "+cant_anterior+" "+precio_anterior[1]+" idprod "+id_producto+" "+act_precio_venta);
      if (act_cantidad>0&&act_precio_venta>0) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/EditProduct_Anticipo",
          data:{id_anticipo:id_anticipo, id_prod_ant:id_prod_ant, id_producto:id_producto, act_cantidad:act_cantidad, cant_anterior:cant_anterior, act_precio_venta:act_precio_venta, precio_anterior:precio_anterior[1], act_coment:act_coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Registro Actualizado');
            }else{
              alert('Falló el servidor. Registro no actualizado');
            }
          }
        });
      }else{
        alert("Debe ingresar por lo menos 1 producto");
      }
      Update_Page(id_anticipo); 
    });

        
        $('#Delete_Product').click(function(){
          id_prod_ant=$("#delete_id_prod_ant").val();
          id_anticipo=$("#id_anticipo"+id_prod_ant).text();
          cantidad=$("#delete_cant").text();
          precio_venta=$("#delete_precio").text();
          coment=$("#delete_coment").text();
          id_producto=$("#id_producto"+id_prod_ant).text();
          alert(id_anticipo+" "+id_prod_ant+" "+cantidad+" "+precio_venta+" "+coment+" idprod "+id_producto);
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/DeleteProduct_Anticipo",
          data:{id_anticipo:id_anticipo, id_prod_ant:id_prod_ant, id_producto:id_producto, cantidad:cantidad, precio_venta:precio_venta, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Eliminado');
            }else{
              alert('Falló el servidor. Producto no eliminado');
            }
          }
        });
      Update_Page(id_anticipo); 
    });

  });

  function ver_comprobante($id_pagos_anticipo){
    var id_pagos_anticipo=$id_pagos_anticipo;
    var comprobante=$("#url_"+$id_pagos_anticipo).text().split(".");
    var url=$("#url_"+$id_pagos_anticipo).text();
    //alert(comprobante[0]+" "+comprobante[1]);
    if (comprobante[0]=="<?php echo base_url()?>") {
      alert("No se adjuntó comprobante de pago");
    }else{
      $('#ver_comprobanteModal').modal();
        $('#modal-body').append("<embed id='imagen_modal' frameborder='0' width='100%'' height='400px'>");    
      $('#imagen_modal').attr({"src" : url});
    }

  }


  function EditProduct($id_prod_anticipo){
    var id_prod_ant=$id_prod_anticipo;
    var nombre_prod=$("#nombre"+id_prod_ant).text();
    var cantidad=$("#cantidad"+id_prod_ant).text();
    var precio_venta=$("#precio"+id_prod_ant).text().split('$');
    var coment=$("#coment"+id_prod_ant).text();
    var id_producto=$("#id_producto"+id_prod_ant).text();
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
   
      var existencia=parseInt(existencia)+parseInt(cantidad);
    $('#EditProductModal').modal();
     $("#titleProductModal").text("Editar Producto: "+nombre_prod);
     $("#edit_cant").val(cantidad);
     $("#edit_cant").attr({"max" : existencia});
     $("#edit_precio").val(parseFloat(precio_venta[1]));
     $("#edit_coment").val(coment);
     $("#edit_id_prod_ant").val(id_prod_ant);
  }

  function DeleteProduct($id_prod_anticipo){
    var id_prod_ant=$id_prod_anticipo;
    var nombre_prod=$("#nombre"+id_prod_ant).text();
    var cantidad=$("#cantidad"+id_prod_ant).text();
    var precio_venta=$("#precio"+id_prod_ant).text().split('$');
    var coment=$("#coment"+id_prod_ant).text();
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
    $('#DeleteProductModal').modal();
     $("#titleDeleteProductModal").text("Eliminar Producto: "+nombre_prod)
     $("#delete_cant").text(cantidad);
     $("#delete_precio").text(parseFloat(precio_venta[1]));
     $("#delete_coment").text(coment);
     $("#delete_id_prod_ant").val(id_prod_ant);
  }

  function Update_Page($id_anticipo){
    id_anticipo=$id_anticipo;
    $("#page_content").load("Anticipo_Prod_List",{id_anticipo:id_anticipo});
  }

  function Lista_Anticipos(){
    $("#page_content").load("Anticipos");
  }

</script>