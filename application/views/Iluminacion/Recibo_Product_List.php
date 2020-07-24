<!--Mostrar lista de Productos de Recibo de Entrega -->

<div class="row">
  <div class="col-9">
    <button class="btn btn-success" onclick="Lista_Recibos()">Regresar a Lista de Recibos de Entrega</button>
  </div>
  <div class="col-3">
    <form action="<?php echo base_url();?>Iluminacion/Genera_PDF_Recibo_Entrega" method="POST" target='_blank'>
     <input type="text" hidden="true" id="id_lista_recibo_entrega" name="id_lista_recibo_entrega" value="<?php echo $recibo_info->id_recibo_entrega; ?>">
     <input hidden="true" type="text" id="folio" name="folio" value="<?php echo $recibo_info->recibo_entrega_folio; ?>">
     <button class="btn btn-primary" type="submit" title="Imprimir Cotización">Imprimir Recibo de Entrega</button>
   </form>
 </div>
</div>
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_recibo_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Productos Recibo de Entrega</h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Folio:<hr><?php echo $recibo_info->recibo_entrega_folio; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Empresa:<hr><?php echo $recibo_info->catalogo_cliente_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Fecha de Entrega:<hr><?php echo $recibo_info->recibo_entrega_fecha; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Domicilio de Entrega:<hr><?php echo $recibo_info->recibo_entrega_domicilio; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Estado de Entrega:<hr><?php echo $recibo_info->recibo_entrega_estado; ?>
              </h6>
            </span>
          </div>
        </div>
      </div>
      <div class="col align-self-end" align="right">
        <a class="navbar-brand" onclick="AddProduct(this.id)" role="button" id="<?php echo $recibo_info->id_recibo_entrega; ?>"><button class="btn btn-outline-secondary btn-sm"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="30px" height="30px" alt="Agregar Producto al Recibo" style="filter: invert(100%)">Agregar Nuevo Producto al Recibo de Entrega</button></a>
      </div>        
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="true">id_recibo_entrega</th>
          <th>Descripción del Producto</th>
          <th hidden="true">id_producto</th>
          <th>Cantidad de Productos</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($recibo_products->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_lista_recibo_entrega".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->id_lista_recibo_entrega.""; ?></td>
            <td id="<?php echo "descripcion_producto".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
            <td hidden="true" id="<?php echo "id_producto".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->producto_almacen_id_prod_alm.""; ?></td>
            <td id="<?php echo "cantidad".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->lista_recibo_entrega_cantidad.""; ?></td>
            <td>
              <a class="navbar-brand" onclick="EditProduct(this.id)" role="button" id="<?php echo $row->id_lista_recibo_entrega; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" title="Editar Producto" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeleteProduct(this.id)" role="button" id="<?php echo $row->id_lista_recibo_entrega; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\delete.ico" title="Eliminar Producto" width="20px" style="filter: invert(100%)" /></button></a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<!-- Modal Delete Product Recibo Entrega -->
<div class="modal fade" id="DeleteProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="titleDeleteProductModal">Eliminar Producto del Recibido de Entrega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6><label>Descripcion: </label><span class="badge badge-danger" id="delete_descripcion"></span></h6>
        <h6><label>Cantidad: </label><span class="badge badge-danger" id="delete_cantidad"></span></h6>
        <input type="text" id="delete_id_lista_recibo_entrega" hidden="true">
        <h6 class="bg-warning"><p>Al eliminar el producto, la cantidad de este se agregará nuevamente al almacen como existencia.</p></h6> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="Delete_Product" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Add Product Recibo Entrega -->
<div class="modal fade" id="AddProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleDeleteProductModal">Agregar Producto al Recibido de Entrega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <label>Producto</label>
        <select class="form-control" id="prod_nombre">
          <option disabled selected>----Seleccionar Producto----</option>
          <?php foreach ($inventario_productos->result() as $row){ ?>
            <option value="<?php echo "".$row->id_prod_alm.""; ?>"><?php echo "".$row->prod_alm_nom.""; ?></option>
          <?php } ?>
        </select>
        <label>Cantidad</label><br>
        <input type="number" class="form-control col-4" min="0" max="0" id="prod_cantidad"><br><br>
        <h6 class="bg-warning"><p>Al agregar el producto, la cantidad de este se descontará del almacen de existencias.</p></h6> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Add_Product" data-dismiss="modal">Agregar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Product Recibo Entrega -->
<div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleDeleteProductModal">Editar Producto del Recibido de Entrega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6><label>Descripción: </label></h6>
          <h5><span class="badge badge-info" id="Edit_descripcion"></span></h5>
        <h6><label>Cantidad: </label><input type="number" class="form-control col-4" min="0" id="Edit_cantidad"></h6>
        <input type="text" id="Edit_id_lista_recibo_entrega" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-success" id="Update_Product" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_recibo_prod_list').DataTable();

        $('#Delete_Product').click(function(){
          id_lista_recibo_entrega=$("#delete_id_lista_recibo_entrega").val();
          cantidad=$("#delete_cantidad").text();
          id_producto=$("#id_producto"+id_lista_recibo_entrega).text();
          id_recibo_entrega=<?php echo $recibo_info->id_recibo_entrega; ?>;
          //alert(id_lista_recibo_entrega+" "+cantidad+" "+id_producto+" "+id_recibo_entrega);
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/DeleteProduct_Recibo_Entrega",
          data:{id_lista_recibo_entrega:id_lista_recibo_entrega, cantidad:cantidad, id_producto:id_producto, id_recibo_entrega:id_recibo_entrega},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Eliminado');
            }else{
              alert('Falló el servidor. Producto no eliminado');
            }
          }
        });
      Update_Page(id_recibo_entrega); 
    });

    $('#Add_Product').click(function(){
      id_recibo_entrega=<?php echo $recibo_info->id_recibo_entrega; ?>;
      id_producto=$("#prod_nombre").val();
      prod_cantidad=$("#prod_cantidad").val();
     //alert(id_recibo_entrega+" "+id_producto+" "+prod_cantidad);
      if(prod_cantidad>0&&id_producto!=null){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/Add_Product_Recibo",
          data:{id_recibo_entrega:id_recibo_entrega, id_producto:id_producto, prod_cantidad:prod_cantidad},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Agregado al Recibo de Entrega. Almacen de Productos Actualizado.');
            }else{
              alert('Falló el servidor. Producto no Agregado');
            }
            Update_Page(id_recibo_entrega);
          }
        });
      }else{
        alert("Debe Ingresar por lo menos 1 producto");
      }
    });

        $('#Update_Product').click(function(){
          id_lista_recibo_entrega=$("#Edit_id_lista_recibo_entrega").val();
          cantidad=$("#Edit_cantidad").val();
          id_producto=$("#id_producto"+id_lista_recibo_entrega).text();
          id_recibo_entrega=<?php echo $recibo_info->id_recibo_entrega; ?>;
          cantidad_anterior=$("#cantidad"+id_lista_recibo_entrega).text();
          //alert(id_lista_recibo_entrega+" "+cantidad+" "+cantidad_anterior+" "+id_producto+" "+id_recibo_entrega);
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/UpdateProduct_Recibo_Entrega",
          data:{id_lista_recibo_entrega:id_lista_recibo_entrega, cantidad:cantidad, cantidad_anterior:cantidad_anterior, id_producto:id_producto, id_recibo_entrega:id_recibo_entrega},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Actualizado');
            }else{
              alert('Falló el servidor. Producto no Actualizado');
            }
            Update_Page(id_recibo_entrega); 
          }
        });
      Update_Page(id_recibo_entrega); 
    });

  });


  function DeleteProduct($id_lista_recibo_entrega){
    var id_lista_recibo_entrega=$id_lista_recibo_entrega;
    var id_producto=$("#id_producto"+id_lista_recibo_entrega).text();
    var descripcion_producto=$("#descripcion_producto"+id_lista_recibo_entrega).text();
    var cantidad=$("#cantidad"+id_lista_recibo_entrega).text();
    $('#DeleteProductModal').modal();
     $("#titleDeleteProductModal").text("Eliminar Producto");
     $("#delete_descripcion").text(descripcion_producto);
     $("#delete_cantidad").text(cantidad);
     $("#delete_id_lista_recibo_entrega").val(id_lista_recibo_entrega);
  }

  function EditProduct($id_lista_recibo_entrega){
    var id_lista_recibo_entrega=$id_lista_recibo_entrega;
    var id_producto=$("#id_producto"+id_lista_recibo_entrega).text();
    var descripcion_producto=$("#descripcion_producto"+id_lista_recibo_entrega).text();
    var cantidad=$("#cantidad"+id_lista_recibo_entrega).text();
    $('#EditProductModal').modal();
     $("#Edit_descripcion").text(descripcion_producto);
     $("#Edit_cantidad").val(cantidad);
     $("#Edit_id_lista_recibo_entrega").val(id_lista_recibo_entrega);
  }

  function AddProduct($id_recibo_entrega){
    var id_recibo_entrega=$id_recibo_entrega;
    $("#AddProductModal").modal();
  }

  function Lista_Recibos(){
    $("#page_content").load("Recibo_Entrega");
  }

  function Update_Page($id_recibo_entrega){
    id_recibo_entrega=$id_recibo_entrega;
    $("#page_content").load("Recibdo_Entrega_Lista_Producto",{id_recibo_entrega:id_recibo_entrega});
  }

</script>