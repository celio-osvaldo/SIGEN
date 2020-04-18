
<!--Mostrar lista de Anticipos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Anticipos</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewAnticipoModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Anticipo</button>
  </div>
</div>

      <div class="card bg-card">
        <div class="table-responsive">
          <table id="table_anticipo" class="table table-striped table-hover display" style="font-size: 10pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
              <tr>
                <th>Nombre del Cliente</th>
                <th hidden="true" >idcliente</th>
                <th>Importe Total</th>
                <th>Pagado</th>
                <th>Saldo</th>
                <th>Estado</th>
                <th>Fecha Finiquito</th>
                <th>Fecha de Entrega</th>
                <th>Comentarios</th>
                <th>Editar</th>
                <th>Acciones Productos</th>
                <th>Acciones Pagos</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($lista_anticipos->result() as $row) {
               ?>
               <tr>
                <td id="<?php echo "nom_cliente".$row->id_anticipo;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
                <td id="<?php echo "id_cliente".$row->id_anticipo;?>" hidden="true"><?php echo "".$row->obra_cliente_id_obra_cliente.""; ?></td>
                <td id="<?php echo "importe_total".$row->id_anticipo;?>">$<?php echo "".$row->anticipo_total.""; ?></td>
                <td id="<?php echo "pagado".$row->id_anticipo;?>">$<?php echo "".$row->anticipo_pago.""; ?></td>
                <td id="<?php echo "saldo".$row->id_anticipo;?>">$<?php echo "".$row->anticipo_resto.""; ?></td>
                <td id="<?php echo "estado".$row->id_anticipo;?>"><?php echo "".$row->anticipo_status.""; ?></td>
                <td id="<?php echo "fecha_fin".$row->id_anticipo;?>"><?php echo "".$row->anticipo_fecha_finiquito.""; ?></td>
                <td id="<?php echo "fecha_ent".$row->id_anticipo;?>"><?php echo "".$row->anticipo_fecha_entrega.""; ?></td>
                <td id="<?php echo "coment".$row->id_anticipo;?>"><?php echo "".$row->anticipo_coment.""; ?></td>

                <td>
                  <a class="navbar-brand" href="#" onclick="EditAnticipo(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>">
                  <button class="btn btn-outline-secondary " title="Editar Registro"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
                  </button>
                  </a>
                </td>

                <td>
                  <a class="navbar-brand" href="#" onclick="Add_Product(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Agregar Producto"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="20px" alt="Agregar" style="filter: invert(100%)"></button>
                  </a>
                  <a class="navbar-brand" href="#" onclick="Product_Details(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Ver Detalles de Productos"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)"></button>
                  </a>
                </td>

                <td>
                  <a class="navbar-brand" href="#" onclick="Add_Pago(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Agregar Pago"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="20px" alt="Agregar" style="filter: invert(100%)"></button>
                  </a>
                  <a class="navbar-brand" href="#" onclick="Pago_Details(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Ver detalles de Pagos"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)"></button>
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

<!-- Modal New Anticipo -->
<div class="modal fade" id="NewAnticipoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Anticipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Cliente</label>
         <select class="form-control" name="new_cliente" id="new_cliente">
                    <option disabled selected>----Seleccionar Cliente----</option>
                  <?php foreach ($catalogo_cliente->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                  <?php } ?>
          </select>
        <label>Fecha Finiquito</label><br>   
        <input type="date" id="new_fecha_fin" class="form-control input-sm"><br>
        <label>Fecha de Entrega</label><br>
        <input type="date" id="new_fecha_entrega" class="form-control input-sm"><br>
        <label>Comentarios</label><br>
        <textarea id="new_coment" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewAnticipo" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edith Anticipo -->
<div class="modal fade" id="EditAnticipoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Anticipo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="edit_id_anticipo" hidden="true">
        <label>Cliente</label>
         <select class="form-control" id="edit_cliente">
                    <option disabled selected>----Seleccionar Cliente----</option>
                  <?php foreach ($catalogo_cliente->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                  <?php } ?>
          </select>
        <label>Estado</label>
        <select class="form-control" id="edit_estado">
          <option value="Activo">Activo</option>
          <option value="Pagado">Pagado</option>
          <option value="Cancelado">Cancelado</option>
        </select>
        <label>Fecha Finiquito</label><br>   
        <input type="date" id="edit_fecha_fin" class="form-control input-sm"><br>
        <label>Fecha de Entrega</label><br>
        <input type="date" id="edit_fecha_entrega" class="form-control input-sm"><br>
        <label>Comentarios</label><br>
        <textarea id="edit_coment" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateAnticipo" data-dismiss="modal">Aceptar</button>
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
        <input type="text" id="prod_id_anticipo" hidden="true">
        <label>Producto</label>
         <select class="form-control" id="prod_nombre">
                    <option disabled selected>----Seleccionar Producto----</option>
                  <?php foreach ($inventario_productos->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_prod_alm.""; ?>"><?php echo "".$row->prod_alm_nom.""; ?></option>
                  <?php } ?>
          </select>
        <label>Cantidad</label><br>
        <input type="number" min="0" max="0" id="prod_cantidad"><br>
        <label>Precio Venta</label><br>
        <input type="number" id="prod_precio"><br>
        <label>Total</label><br>
        <input type="number" id="prod_total" disabled="true"><br>
        <label>Comentarios</label><br>
        <textarea id="prod_coment" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="AddProduct" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Add Pay -->
<div class="modal fade" id="Add_PayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Agregar Pago de Anticipo<label id="title_pago"></label></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="pago_prod_id_anticipo" hidden="true">
        <label>Cantidad</label><br>
        <input type="number" min="0" id="pago_cantidad"><br>
        <label>Fecha</label><br>
        <input type="date" id="pago_fecha"><br>
        <label>Comprobante de Pago</label><br>
                <!-- Form -->
        <form method='post' action='' enctype="multipart/form-data">
          <input type="file" id="pago_imagen" accept="application/pdf, image/*" class="form-control"><br>
        </form>
        
        <label>Comentarios</label><br>
        <textarea id="pago_coment" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="AddPay" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>  
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#uploadModal">Upload file</button>

<!-- Modal -->
<div id="uploadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">File upload form</h4>
      </div>
      <div class="modal-body">
        <!-- Form -->
        <form method='post' action='' enctype="multipart/form-data">
          Select file : <input type='file' name='file' id='file' class='form-control' ><br>
          <input type='button' class='btn btn-info' value='Upload' id='btn_upload'>
        </form>

        <!-- Preview-->
        <div id='preview'></div>
      </div>
 
    </div>

  </div>
</div>

<script type="text/javascript">

  $(document).ready(function(){
    $('#table_anticipo').DataTable();



$('#btn_upload').click(function(){

    var fd = new FormData();
    var files = $('#file')[0].files[0];
    fd.append('file',files);

    // AJAX request
    $.ajax({
      url: '<?php echo base_url();?>Iluminacion/Add_Pay',
      type: 'post',
      data: fd,
      contentType: false,
      processData: false,
      success: function(response){
        alert(response);
        if(response != 0){
          // Show image preview
          $('#preview').append("<a href='<?php echo base_url() ?>"+response+"' target='_blank'><img src='<?php echo base_url() ?>"+response+"' width='100' height='100' style='display: inline-block;'></a>");
        }else{
          alert('file not uploaded');
        }
      }
    });
  });






    $('#NewAnticipo').click(function(){
      cliente=$('#new_cliente').val();
      fecha_fin=$('#new_fecha_fin').val();
      fecha_ent=$('#new_fecha_entrega').val();
      coment=$('#new_coment').val();
      //alert(cliente+fecha_fin+fecha_ent+coment);
      $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/NewAnticipo",
          data:{cliente:cliente, fecha_fin:fecha_fin, fecha_ent:fecha_ent, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Nuevo anticipo Agregado');
            }else{
              alert('Falló el servidor. Nuevo Anticipo no Agregado');
            }
            Update();
          }
        });
    });

    $('#UpdateAnticipo').click(function(){
      id_anticipo=$('#id_anticipo').val();
      cliente=$('#edit_cliente').val();
      estado=$('#edit_estado').val();
      fecha_fin=$('#edit_fecha_fin').val();
      fecha_ent=$('#edit_fecha_entrega').val();
      coment=$('#edit_coment').val();
      id_anticipo=$('#edit_id_anticipo').val();
      //alert(cliente+estado+fecha_fin+fecha_ent+coment+id_anticipo);
      $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/Update_Anticipo",
          data:{id_anticipo:id_anticipo, cliente:cliente, estado:estado, fecha_fin:fecha_fin, fecha_ent:fecha_ent, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Anticipo Actualizado');
            }else{
              alert('Falló el servidor. Anticipo no Actualizado');
            }
            Update();
          }
        });
    });

    $('#AddProduct').click(function(){
      id_anticipo=$("#prod_id_anticipo").val();
      id_producto=$("#prod_nombre").val();
      prod_cantidad=$("#prod_cantidad").val();
      prod_precio_venta=$("#prod_precio").val();
      total=$("#prod_total").val();
      coment=$("#prod_coment").val();
      //alert(id_anticipo+" "+id_producto+" "+prod_cantidad+" "+prod_precio_venta+" "+total+" "+coment);
      if(prod_cantidad>0&&id_producto!=null){
      $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/Add_Product",
          data:{id_anticipo:id_anticipo, id_producto:id_producto, prod_cantidad:prod_cantidad, prod_precio_venta:prod_precio_venta, total:total, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Producto Agregado al Anticipo. Almacen de Productos Actualizado.');
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
      $("#prod_total").val($("#prod_cantidad").val()*$("#prod_precio").val());
    });

    $( "#prod_cantidad" ).change(function() {
      $("#prod_total").val($("#prod_cantidad").val()*$("#prod_precio").val());
    });

    $( "#prod_precio" ).change(function() {
      $("#prod_total").val($("#prod_cantidad").val()*$("#prod_precio").val());
    });

    $('#AddPay').click(function(){
      id_anticipo=$("#pago_prod_id_anticipo").val();
      cantidad=$("#pago_cantidad").val();
      fecha=$("#pago_fecha").val();
      coment=$("#pago_coment").val();
      var datos = new FormData();
      var files = $('#pago_imagen')[0].files[0];
      datos.append('file',files);
      datos.append('id_anticipo',id_anticipo);
      datos.append('cantidad',cantidad);
      datos.append('fecha',fecha);
      datos.append('coment',coment);
      //alert(id_anticipo+" "+cantidad+" "+fecha+" "+coment);
      if(true){
      $.ajax({
          url: '<?php echo base_url();?>Iluminacion/Add_Pay',
          type: 'post',
          data: datos,
          contentType: false,
          processData: false,
          success:function(result){
            //alert(result);
            if(result=="ok-ok"){
              alert('Pago agregado. Imagen Guardada');
            }else{
              if(result=="error-ok"){
                alert('Pago agregado. Imagen No guardada\nFormatos aceptados: jpg, png, jpeg, gif , pdf');
              }else{
                alert('Error. Pago no agregado. Imagen no guardada');
              }
              
            }
            Update();
          }
        });
      }else{
        alert("Debe Ingresar una cantidad mayor a 0 (cero) y una fecha válida");
      }
      

    });


  });


  function EditAnticipo($id_anticipo){
    var id_ant=$id_anticipo;
    var id_cliente=$("#id_cliente"+id_ant).text();
    var estado=$("#estado"+id_ant).text();
    var fecha_fin=$("#fecha_fin"+id_ant).text();
    var fecha_ent=$("#fecha_ent"+id_ant).text();
    var coment=$("#coment"+id_ant).text();
    $('#EditAnticipoModal').modal();
     $("#edit_cliente").val(id_cliente).attr('selected', true);
     $("#edit_id_anticipo").val(id_ant);
     $("#edit_estado").val(estado).attr('selected',true);
     $("#edit_fecha_fin").val(fecha_fin);
     $("#edit_fecha_entrega").val(fecha_ent);
     $("#edit_coment").val(coment);
  }

  function Add_Product($id_anticipo){
    var id_ant=$id_anticipo;
    $('#Add_ProductModal').modal();
    $("#prod_id_anticipo").val(id_ant);
  }

  function Product_Details($id_anticipo){
    var id_anticipo=$id_anticipo;
   $("#page_content").load("Anticipo_Prod_List",{id_anticipo:id_anticipo});
  }

  function Add_Pago($id_anticipo){
    var id_ant=$id_anticipo;
    var cliente=$("#nom_cliente"+id_ant).text();
    $('#Add_PayModal').modal();
    $("#pago_prod_id_anticipo").val(id_ant);   
    //$("#title_pago").text("Cliente: "+cliente);
  }

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("Anticipos");
  }

</script>