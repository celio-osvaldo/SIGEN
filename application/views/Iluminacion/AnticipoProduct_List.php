<!--Mostrar lista de Productos de Anticipo -->

<div class="container">
  <button class="btn btn-success" onclick="Lista_Anticipos()">Regresar a Lista de Proyectos en Tránsito</button>
</div>
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_anticipo_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Productos del Proyecto en Tránsito </h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Cliente:<hr><?php echo $anticipo_info->catalogo_cliente_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Importe total de Proyecto en Tránsito:<hr>$<?php echo number_format($anticipo_info->anticipo_total,5,'.',','); ?>
              </h6>
            </span>
           <!-- <span class="badge badge-info">
              <h6 align="center">
                Total Pagado:<hr>$<?php echo number_format($anticipo_info->anticipo_pago,2,'.',','); ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Saldo:<hr>$<?php echo number_format($anticipo_info->anticipo_resto,2,'.',','); ?>
              </h6>
            </span> -->
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
          <th hidden="true">id_anticipo</th>
          <th>Nombre de Producto</th>
          <th hidden="true">id_producto</th>
          <th>Cantidad de Productos</th>
          <th>Precio de Venta</th>
          <th>Comentarios</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($anticipo_productos->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_anticipo".$row->id_prod_anticipo;?>"><?php echo "".$row->anticipo_id_anticipo.""; ?></td>
            <td id="<?php echo "nombre".$row->id_prod_anticipo;?>"><?php echo "".$row->prod_alm_nom.""; ?></td>
            <td hidden="true" id="<?php echo "id_producto".$row->id_prod_anticipo;?>"><?php echo "".$row->producto_almacen_id_prod_alm.""; ?></td>
            <td id="<?php echo "cantidad".$row->id_prod_anticipo;?>"><?php echo "".$row->prod_anticipo_cantidad.""; ?></td>
            <td id="<?php echo "precio".$row->id_prod_anticipo;?>">$<?php echo number_format($row->prod_anticipo_precio_venta,5,'.',',').""; ?></td>
            <td id="<?php echo "coment".$row->id_prod_anticipo;?>"><?php echo $row->prod_anticipo_coment;?></td>
            <td>
              <a class="navbar-brand" onclick="EditProduct(this.id)" role="button" id="<?php echo $row->id_prod_anticipo; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" title="Editar Producto" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeleteProduct(this.id)" role="button" id="<?php echo $row->id_prod_anticipo; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\delete.ico" title="Eliminar Producto" style="filter: invert(100%)" /></button></a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
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
        <input type="text" onblur="Separa_Miles(this.id)" id="edit_precio" class="form-control input-sm">
        <label>Comentarios</label>
        <textarea id="edit_coment" class="form-control input-sm" maxlength="200"></textarea>
        <input type="text" id="edit_id_prod_ant" hidden="true">
      </div>
      <h6 class="bg-warning"><p>Al eliminar/agregar el producto, la cantidad de este se agregará/descontará a la existenia en almacen.</p></h6>
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
          act_precio_venta=act_precio_venta.replace(/\,/g, '');
          precio_anterior=$("#precio"+id_prod_ant).text().split('$');
          precio_anterior[1]=precio_anterior[1].replace(/\,/g, '');
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
      $('EditProductModal').removeClass('modal-open');
      $('.modal-backdrop').remove();
      Update_Page(id_anticipo); 
    });

        
        $('#Delete_Product').click(function(){
          id_prod_ant=$("#delete_id_prod_ant").val();
          id_anticipo=$("#id_anticipo"+id_prod_ant).text();
          cantidad=$("#delete_cant").text();
          precio_venta=$("#delete_precio").text();
          precio_venta=precio_venta.replace(/\,/g, '');
          coment=$("#delete_coment").text();
          id_producto=$("#id_producto"+id_prod_ant).text();
          //alert(id_anticipo+" "+id_prod_ant+" "+cantidad+" "+precio_venta+" "+coment+" idprod "+id_producto);
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
            Update_Page(id_anticipo);
          }
        });
      Update_Page(id_anticipo); 
    });

  });


  function EditProduct($id_prod_anticipo){
    var id_prod_ant=$id_prod_anticipo;
    var nombre_prod=$("#nombre"+id_prod_ant).text();
    var cantidad=$("#cantidad"+id_prod_ant).text();
    var precio_venta=$("#precio"+id_prod_ant).text().split('$');
    //precio_venta=precio_venta.replace(/\,/g, '');
    var coment=$("#coment"+id_prod_ant).text();
    var id_producto=$("#id_producto"+id_prod_ant).text();
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
    <?php foreach ($inventario_productos->result() as $key): ?>
        if (id_producto==<?php echo $key->id_prod_alm; ?>) {
          var precio_unitario=(<?php echo $key->prod_alm_prec_unit; ?>);
          var existencia=(<?php echo $key->prod_alm_exist; ?>);
          var precio_venta=(<?php echo $key->prod_alm_precio_venta; ?>);
        }
      <?php endforeach ?>
      var existencia=parseInt(existencia)+parseInt(cantidad);
    $('#EditProductModal').modal();
     $("#titleProductModal").text("Editar Producto: "+nombre_prod);
     $("#edit_cant").val(cantidad);
     $("#edit_cant").attr({"max" : existencia});
     $("#edit_precio").val(parseFloat(precio_venta));
     $("#edit_coment").val(coment);
     $("#edit_id_prod_ant").val(id_prod_ant);
  }

  function DeleteProduct($id_prod_anticipo){
    var id_prod_ant=$id_prod_anticipo;
    var nombre_prod=$("#nombre"+id_prod_ant).text();
    var cantidad=$("#cantidad"+id_prod_ant).text();
    var precio_venta=$("#precio"+id_prod_ant).text().split('$');
    precio_venta[1]=precio_venta[1].replace(/\,/g, '');
    var coment=$("#coment"+id_prod_ant).text();
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
    $('#DeleteProductModal').modal();
     $("#titleDeleteProductModal").text("Eliminar Producto: "+nombre_prod);
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

function Separa_Miles($id){
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