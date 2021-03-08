
<!--Mostrar lista de Anticipos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Proyectos en Tránsito</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewAnticipoModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Proyecto en Tránsito</button>
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
        <!--  <th>Pagado</th>  -->
     <!--     <th>Saldo</th>   -->
          <th>Estado</th>
          <th>Fecha Finiquito</th>
          <th>Fecha de Entrega</th>
          <th>Comentarios</th>
          <th>Acciones</th>
          <th>Acciones Productos</th>
        <!--  <th>Acciones Pagos</th>  -->
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($lista_anticipos->result() as $row) {
         ?>
         <tr>
          <td id="<?php echo "nom_cliente".$row->id_anticipo;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
          <td id="<?php echo "id_cliente".$row->id_anticipo;?>" hidden="true"><?php echo "".$row->obra_cliente_id_obra_cliente.""; ?></td>
          <td id="<?php echo "importe_total".$row->id_anticipo;?>">$<?php echo number_format($row->anticipo_total,5,'.',',').""; ?></td>
    <!--      <td id="<?php echo "pagado".$row->id_anticipo;?>">$<?php echo number_format($row->anticipo_pago,5,'.',',').""; ?></td>  -->
    <!--      <td id="<?php echo "saldo".$row->id_anticipo;?>">$<?php echo number_format($row->anticipo_resto,5,'.',',').""; ?></td>  -->
          <td id="<?php echo "estado".$row->id_anticipo;?>"><?php echo "".$row->anticipo_status.""; ?></td>
          <td id="<?php echo "fecha_fin".$row->id_anticipo;?>"><?php echo "".$row->anticipo_fecha_finiquito.""; ?></td>
          <td id="<?php echo "fecha_ent".$row->id_anticipo;?>"><?php echo "".$row->anticipo_fecha_entrega.""; ?></td>
          <td id="<?php echo "coment".$row->id_anticipo;?>"><?php echo "".$row->anticipo_coment.""; ?></td>

          <td>
            <a class="navbar-brand" href="#" onclick="EditAnticipo(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>">
              <button class="btn btn-outline-secondary " title="Editar Registro"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
              </button>
            </a>
            <a class="btn btn-outline-secondary" role="button" onclick="Enviar_proyecto(this.id)" id="<?php echo $row->id_anticipo; ?>" title="Enviar como Proyecto"><img src="..\Resources\Icons\enviar.ico" style="filter: invert(100%)" width="20px"></a>
          </td>

          <td>
            <a class="navbar-brand" href="#" onclick="Add_Product(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Agregar Producto"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="20px" alt="Agregar" style="filter: invert(100%)"></button>
            </a>
            <a class="navbar-brand" href="#" onclick="Product_Details(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Ver Detalles de Productos"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)"></button>
            </a>
          </td>

      <!--    <td>
            <a class="navbar-brand" href="#" onclick="Add_Pago(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Agregar Pago"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="20px" alt="Agregar" style="filter: invert(100%)"></button>
            </a>
            <a class="navbar-brand" href="#" onclick="Pago_Details(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>"><button class="btn btn-outline-secondary" title="Ver detalles de Pagos"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)"></button>
            </a>
          </td>   -->

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
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Proyecto en Tránsito</h5>
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
        <h5 class="modal-title" id="exampleModalLabel">Editar Proyecto en Tránsito</h5>
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
          <option value="Enviado a Proyecto">Enviado a Proyecto</option>
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
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Cantidad</label>
            <input type="number" class="form-control" onclick="Separa_Miles('prod_total')" onblur="Separa_Miles('prod_total')" min="0" max="0" id="prod_cantidad">
          </div>
          <div class="col-md-5">
            <label class="label-control">Precio Venta</label><br>
            <input class="form-control" type="text" onblur="Separa_Miles(this.id)"  id="prod_precio">
          </div>
        </div>

        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Total</label><br>
            <input class="form-control" type="text" onload="Separa_Miles(this.id)" id="prod_total" disabled="true">
          </div>
        </div>
       
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label><br>
            <textarea class="form-control" id="prod_coment" maxlength="150" class="form-control input-sm"></textarea>
          </div>
        </div>     
      </div>
      <!--
      <div class="bg-warning">
        <p><b>Los productos ingresados serán descontados del inventario de almacen</b></p>
      </div>
    -->
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
        <input type="text" onblur="Separa_Miles(this.id)" class="col-md-5"  id="pago_cantidad"><br>
        <label>Fecha</label><br>
        <input type="date" id="pago_fecha"><br>
        <label>Comprobante de Pago</label><br>
        <!-- Form -->
        <form method='post' enctype="multipart/form-data">
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


<!-- Modal Enviar como Proyecto -->
<div class="modal fade" id="Envia_ProyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Confirme que enviará el registro como Proyecto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" name="id_proy_transito" id="id_proy_transito" hidden="true">
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Cliente</label>
            <input type="text" name="nombre_clie" id="nombre_clie" disabled="true" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Importe Total</label>
            <input type="text" name="imp_total" id="imp_total" disabled="true" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label>
            <textarea name="comentarios" id="comentarios" disabled="true" class="form-control"></textarea>
          </div>
        </div>

<!--
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="collapse" aria-haspopup="true" aria-expanded="false" data-target="#collapseExample">Total de Productos:&nbsp;<label id="tot_prod"></label></button>

        <div class="collapse" id="collapseExample">
          <div class="card card-body">
            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
          </div>
        </div>
    -->    

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Add_Proyecto" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>  



<script type="text/javascript">

  $(document).ready(function(){
    $('#table_anticipo').DataTable();


    $('#Add_Proyecto').click(function(){
      id_proy_tran=$("#id_proy_transito").val();
      nombre_clie=$("#nom_cliente"+id_proy_tran).text();
      id_cliente=$("#id_cliente"+id_proy_tran).text();
      imp_total=$("#importe_total"+id_proy_tran).text().replace(/\,/g, '');
      imp_total=imp_total.replace(/\$/g, '')
      comentarios=$("#coment"+id_proy_tran).text();

      //alert(imp_total);

      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/Cambiar_a_Proyecto",
        data:{id_proy_tran:id_proy_tran, nombre_clie:nombre_clie, id_cliente:id_cliente, imp_total:imp_total, comentarios:comentarios},
        success:function(result){
            //alert(result);
            if(result){
              alert('Proyecto de Tránsito agregado a Lista de Proyecto');
            }else{
              alert('Falló el servidor. No fue posible enviar el Proyecto de Tránsito al Listado de Proyectos');
            }
            Update();
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
      estado_anterior=$('#estado'+id_anticipo).text();
      //alert(estado_anterior+" id: "+id_anticipo);
      //alert(cliente+estado+fecha_fin+fecha_ent+coment+id_anticipo);
      if(estado=="Cancelado"){
        //alert("Proyecto en Tránsito Cancelado, la cantidad de productos regresará al almacen como existencia");
      }
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/Update_Anticipo",
        data:{id_anticipo:id_anticipo, cliente:cliente, estado:estado, estado_anterior:estado_anterior, fecha_fin:fecha_fin, fecha_ent:fecha_ent, coment:coment},
        success:function(result){
            //alert(result);
            if(result){
              alert('Proyecto en Tránsito Actualizado');
            }else{
              alert('Falló el servidor. Proyecto en Tránsito no Actualizado');
            }
            Update();
          }
        });
      Update();
    });

    $('#AddProduct').click(function(){
      id_anticipo=$("#prod_id_anticipo").val();
      id_producto=$("#prod_nombre").val();
      prod_cantidad=$("#prod_cantidad").val();
      prod_precio_venta=$("#prod_precio").val();
      prod_precio_venta=prod_precio_venta.replace(/\,/g, '');
      total=$("#prod_total").val();
      total=total.replace(/\,/g, '');
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
              alert('Producto Agregado al Anticipo.');
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
          //precio_unitario=precio_unitario.replace(/\,/g, '');
          var existencia=(<?php echo $key->prod_alm_exist; ?>);
          var precio_venta=(<?php echo $key->prod_alm_precio_venta; ?>);
          //alert(precio_venta);
          //precio_venta=precio_venta.replace(/\,/g, '');
        }
      <?php endforeach ?>
      $("#prod_precio").val(0);
      $("#prod_cantidad").val(0);
      $("#prod_precio").val(precio_venta);
      $("#prod_cantidad").attr({"max" : existencia});
      total=$("#prod_cantidad").val().replace(/\,/g, '')*$("#prod_precio").val().replace(/\,/g, '');
      total=total.toLocaleString("en");
      $("#prod_total").val(parseFloat(total.replace(/,/g, "")).toFixed(5).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });

    $( "#prod_cantidad" ).change(function() {
     total=$("#prod_cantidad").val().replace(/\,/g, '')*$("#prod_precio").val().replace(/\,/g, '');
      total=total.toLocaleString("en");
      $("#prod_total").val(parseFloat(total.replace(/,/g, "")).toFixed(5).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });

    $( "#prod_precio" ).change(function() {
      total=$("#prod_cantidad").val().replace(/\,/g, '')*$("#prod_precio").val().replace(/\,/g, '');
      total=total.toLocaleString("en");
      $("#prod_total").val(parseFloat(total.replace(/,/g, "")).toFixed(5).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });

    $('#AddPay').click(function(){
      id_anticipo=$("#pago_prod_id_anticipo").val();
      cantidad=$("#pago_cantidad").val();
      cantidad=cantidad.replace(/\,/g, '');
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
      if(cantidad>0&&fecha!=""){
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
                if(result=="ok"){
                  alert('Pago Agregado. No se adjuntó Imagen');
                }else{
                  alert('Error. Pago no agregado. Imagen no guardada');
                }                
              }              
            }
          }
        });
      }else{
        alert("Debe Ingresar una cantidad mayor a 0 (cero) y una fecha válida");
      }
      Update();  
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
  $("#title_pago").text("Cliente: "+cliente);
  }

function Pago_Details($id_anticipo){
  var id_anticipo=$id_anticipo;
  $("#page_content").load("Anticipo_Pagos_List",{id_anticipo:id_anticipo});
}

function Enviar_proyecto($id_proy_tran){

  nombre_clie=$("#nom_cliente"+$id_proy_tran).text();
  id_cliente=$("#id_cliente"+$id_proy_tran).text();
  imp_total=$("#importe_total"+$id_proy_tran).text();
  comentarios=$("#coment"+$id_proy_tran).text();
  id_proy_tran=$id_proy_tran;
  $.ajax({
    type:"POST",
    url:"<?php echo base_url();?>Iluminacion/Datos_transito",
    data:{id_proy_tran:id_proy_tran},
    dataType: 'json',
    success:function($datos_proy){

        $('#Envia_ProyModal').modal();
        $('#id_proy_transito').val($id_proy_tran);
        $('#nombre_clie').val(nombre_clie);
        $('#imp_total').val(imp_total);
        $('#comentarios').val(comentarios);
        //$('#tot_prod').text($datos_proy.cantidad_prod['tot_prod']);
          }
        });


  
}

function Update(){
  $('#btncancelar').click();
  $("#page_content").load("Anticipos");
}





</script>