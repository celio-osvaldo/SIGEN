<!--Mostrar Inventario de Productos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Almacén de Productos</h3>
  </div>
    <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewInv_ProdModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Producto</button>
  </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_Inv_Prod" class="table table-striped table-hover display" style="font-size: 9pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Acciones</th>
          <th>Nombre Producto</th>
          <th>Unidad de Medida</th>
          <th>Modelo</th>
          <th>Precio Unitario</th>
          <th>Precio de Venta</th>
          <th>Existencia</th>
          <th>Cógido Producto</th>
          <th>Descripción del Producto</th>
          <th>Comentario</th>
          <th>Historial</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        foreach ($inventario_productos->result() as $row) {
         ?>
         <tr>
          <td>
            <button title="Editar" class="btn btn-outline-secondary" onclick="EditProduct(this.id)" role="button" id="<?php echo $row->id_prod_alm; ?>"><img width="20" height="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></button>
            <button title="Actualiza Inventario" class="btn btn-outline-secondary" onclick="Act_Invent(this.id)" role="button" id="<?php echo $row->id_prod_alm; ?>"><img width="20" height="20" src="..\Resources\Icons\inventario.ico" alt="Ingresar Inventario"/></button>
          </td>
          <td id="<?php echo "nom_prod".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_nom.""; ?></td>
          <td id="<?php echo "unid_med".$row->id_prod_alm;?>"><?php echo "".$row->unidad_medida.""; ?></td>
          <td id="<?php echo "modelo".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_modelo.""; ?></td>
          <td id="<?php echo "precio".$row->id_prod_alm;?>">$<?php echo number_format($row->prod_alm_prec_unit,2,'.',',').""; ?></td>
          <td id="<?php echo "precio_venta".$row->id_prod_alm;?>">$<?php echo number_format($row->prod_alm_precio_venta,2,'.',',').""; ?></td>
          <td id="<?php echo "existencia".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_exist.""; ?></td>
          <td id="<?php echo "codigo".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_codigo.""; ?></td>
          <td id="<?php echo "descripcion".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
          <td id="<?php echo "coment".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_coment.""; ?></td>
          <td><button title="Historial" class="btn btn-outline-secondary" onclick="Product_History(this.id)" role="button" id="<?php echo $row->id_prod_alm; ?>"><img width="20" height="20" src="..\Resources\Icons\historial.ico" alt="Historial"/></button></td>
         </tr>
         <?php 
       }
       ?>
     </tbody>
   </table>
 </div>
</div>

<!-- Modal New Product -->
<div class="modal fade" id="NewInv_ProdModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre Producto</label>
        <input type="text" maxlength="300" id="new_nom_prod" class="form-control input-sm">
        <label>Unidad de Medida</label>
         <select class="form-control" name="new_unid_med" id="new_unid_med">
                    <option disabled selected>----Seleccionar Unidad Medida----</option>
                  <?php foreach ($unidades_medida->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                  <?php } ?>
          </select>
        <label>Modelo</label><br>   
        <input type="text" id="new_model" maxlength="300" class="form-control input-sm">
        <div class="row">
          <div  class="col-md-5">
            <label class="label-control">Precio Unitario</label>
            <input type="text" id="new_prec" onblur="Separa_Miles(this.id)" class="form-control">
          </div>
          <div class="col-md-5">
            <label class="label-control">Precio de Venta</label>
            <input type="text" id="new_prec_venta" onblur="Separa_Miles(this.id)" class="form-control ">
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label>Existencia</label>
            <input type="number" id="new_exist" class="form-control">
          </div>
          <div class="col-md-5">
            <label>Cógido de Producto</label>
            <input type="text" id="new_cod" maxlength="45" class="form-control">
          </div>
        </div>     
        <label>Descripción del Producto</label>
        <input type="text" id="new_descrip" maxlength="600" class="form-control">
        <label>Comentarios</label><br>
        <textarea id="new_coment" maxlength="400" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewProduct" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Product -->
<div class="modal fade" id="EditProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Nombre Producto</label>
            <input type="text" id="edit_nom_prod" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label class="label-control">Unidad de Medida</label>
           <select class="form-control" name="edit_unid_med" id="edit_unid_med">
            <option disabled selected>----Seleccionar Unidad Medida----</option>
            <?php foreach ($unidades_medida->result() as $row){ ?>
              <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
            <?php } ?>
          </select>
        </div>
        <div class="col-md-8">
          <label class="label-control">Modelo</label>
          <input type="text" id="edit_model" class="form-control input-sm">
        </div>
      </div>
        <div class="row">
          <div class="col-md-6">
            <label class="label-control">Precio Unitario</label>
            <input type="text" id="edit_prec" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
          <div class="col-md-6">
            <label class="label-control">Precio de Venta</label>
            <input type="text" id="edit_prec_venta" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Existencia</label>
            <input disabled="true" type="number" id="edit_exist" class="form-control input-sm">
          </div>
          <div class="col-md-6">
            <label class="label-control">Cógido de Producto</label>
            <input type="text" id="edit_cod" class="form-control input-sm">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Descripción del Producto</label>
            <textarea rows="3" id="edit_descrip" maxlength="600" class="form-control input-sm"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label><br>
            <textarea rows="1" id="edit_coment" maxlength="400" class="form-control input-sm"></textarea>
          </div>
        </div>
        <input type="text" id="edit_id_product" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateProduct" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Update Inventorie -->
<div class="modal fade" id="UpdateInventorieProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Inventario de Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background-color: #6BF57A">
        <div class="row" style="background-color: #C1C1C1">
          <div class="col-md-12">
            <label class="label-control">Nombre Producto</label>
            <input disabled="true" type="text" id="inv_nom_prod" class="form-control">
          </div>
        </div>
        <div class="row"style="background-color: #C1C1C1">
          <div class="col-md-3">
            <label class="label-control">Unidad de Medida</label>
           <select disabled="true" class="form-control" name="inv_unid_med" id="inv_unid_med">
            <option disabled selected>----Seleccionar Unidad Medida----</option>
            <?php foreach ($unidades_medida->result() as $row){ ?>
              <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
            <?php } ?>
          </select>
        </div>
          <div class="col-md-3">
            <label class="label-control">Existencia Actual</label>
            <input disabled="true" type="number" id="inv_exist" class="form-control input-sm">
          </div>
          <div class="col-md-3">
            <label class="label-control">Precio Unit. Actual</label>
            <input disabled="true" type="text" id="inv_prec" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
          <div class="col-md-3">
            <label class="label-control">Precio Venta Actual</label>
            <input disabled="true" type="text" id="inv_prec_venta" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-3">
            <label class="label-control">Movimiento a Realizar</label>
            <select class="form-control" name="inv_tipo_mov" id="inv_tipo_mov">
              <option value="alta">Alta</option>
              <option value="baja">Baja</option>
            </select>
          </div>
          <div class="col-md-3">
            <label class="label-control">Producto a Agregar/Restar</label>
            <input type="number" name="inv_cant_prod" min="0" value="1" id="inv_cant_prod" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="label-control">Precio Unit. Nuevo</label>
            <input type="text" id="inv_prec_new" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
          <div class="col-md-3">
            <label class="label-control">Precio Venta Nuevo</label>
            <input  type="text" id="inv_prec_venta_new" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-5">
            <label>Procedencia</label>
              <select class="form-control" name="inv_procedencia" id="inv_procedencia">
                <option value="compra">Adquisición</option>
                <option value="devolucion">Devolución</option>
                <option value="venta">Venta</option>
                <option value="ajuste">Ajuste de Inventario</option>
              </select>
          </div>
          <div class="col-md-7">
            <label>Referencia (Factura, Pedido, etc.)</label>
            <input type="text" maxlength="200" name="inv_referencia" id="inv_referencia" class="form-control">
          </div>
        </div>
        <input type="text" id="inv_id_product" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="InvProduct" data-dismiss="modal">Actualizar Inventario</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready( function () {
    $('#table_Inv_Prod').DataTable();

    $('#UpdateProduct').click(function(){
      nom_prod=$("#edit_nom_prod").val();
      unid_med=$("#edit_unid_med").val();
      modelo=$("#edit_model").val();
      precio=$("#edit_prec").val();
      precio=precio.replace(/\,/g, '');
      precio_venta=$("#edit_prec_venta").val();
      precio_venta=precio_venta.replace(/\,/g, '');
      existencia=$("#edit_exist").val();
      codigo=$("#edit_cod").val();
      descripcion=$("#edit_descrip").val();
      coment=$("#edit_coment").val();
      id_prod=$("#edit_id_product").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_prod!=""&&unid_med!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/Update_Alm_Product",
          data:{id_prod:id_prod, nom_prod:nom_prod, unid_med:unid_med, modelo:modelo, precio:precio, precio_venta:precio_venta, existencia:existencia, codigo:codigo, descripcion:descripcion, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Registro Actualizado');
             Update();
            }else{
              alert('Falló el servidor. Registro no Actualizado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Producto y Unidad de Medida");
      }
    });


    $('#InvProduct').click(function(){
      unid_med=$("#inv_unid_med").val();
      precio_unit_old=$("#inv_prec").val();
      precio_unit_old=precio_unit_old.replace(/\,/g, '');
      precio_venta_old=$("#inv_prec_venta").val();
      precio_venta_old=precio_venta_old.replace(/\,/g, '');
      existencia_old=$("#inv_exist").val();
      id_prod=$("#inv_id_product").val();
      inv_tipo_mov=$("#inv_tipo_mov").val();
      inv_cant_prod=$("#inv_cant_prod").val();
      inv_prec_new=$("#inv_prec_new").val().replace(/\,/g, '');
      inv_prec_venta_new=$("#inv_prec_venta_new").val().replace(/\,/g, '');
      inv_procedencia=$("#inv_procedencia").val();
      inv_referencia=$("#inv_referencia").val();

      //alert(unid_med+" "+precio_unit_old+" "+precio_venta_old+" "+existencia_old+" "+id_prod);
      //alert(inv_tipo_mov+" "+inv_cant_prod+" "+inv_prec_new+" "+inv_prec_venta_new+" "+inv_procedencia+" "+inv_referencia);

      if(inv_tipo_mov=="alta"){
        nueva_exist=parseInt(existencia_old)+parseInt(inv_cant_prod);
      }else{
         nueva_exist=parseInt(existencia_old)-parseInt(inv_cant_prod);
      }
      if (nueva_exist>=0) {
        if (inv_cant_prod!=""&&inv_cant_prod!=0&&inv_cant_prod>0) {//Verificamos que los campos no estén vacíos
          $.ajax({
            type:"POST",
            url:"<?php echo base_url();?>Iluminacion/Update_Inv_Prod",
            data:{id_prod:id_prod, inv_tipo_mov:inv_tipo_mov, inv_cant_prod:inv_cant_prod, precio_unit_old:precio_unit_old, inv_prec_new:inv_prec_new, precio_venta_old:precio_venta_old, inv_prec_venta_new:inv_prec_venta_new, inv_procedencia:inv_procedencia, inv_referencia:inv_referencia, existencia_old:existencia_old},
            success:function(result){
              //alert(result);
              if(result){
                alert('Inventario Actualizado');
               Update();
              }else{
                alert('Falló el servidor. Inventario no Actualizado');
              }
            }
          });
        }else{
          alert("Debe ingresar cantidad de Producto mayor a 0");
        }
      }else{
        alert("No puede descontar más productos de los indicados en el inventario como existencia actual");
      }

    });



    $('#NewProduct').click(function(){
      nom_prod=$("#new_nom_prod").val();
      unid_med=$("#new_unid_med").val();
      modelo=$("#new_model").val();
      precio=$("#new_prec").val();
      precio=precio.replace(/\,/g, '');
      precio_venta=$("#new_prec_venta").val();
      precio_venta=precio_venta.replace(/\,/g, '');
      existencia=$("#new_exist").val();
      codigo=$("#new_cod").val();
      descripcion=$("#new_descrip").val();
      coment=$("#new_coment").val();
      //alert(nom_prod+unid_med+modelo+precio+existencia+codigo+descripcion+coment);
      if (nom_prod!=""&&unid_med!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/NewAlm_Product",
          data:{nom_prod:nom_prod, unid_med:unid_med, modelo:modelo, precio:precio,precio_venta:precio_venta, existencia:existencia, codigo:codigo, descripcion:descripcion, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Registro Agregado');
             Update();
            }else{
              alert('Falló el servidor. Registro no Agregado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Producto y Unidad de Medida");
      }
    });

  });
</script>

<script type="text/javascript">
  //Función para Mostrar Modal de Editar un registro de Cliente/Obra
 
 function EditProduct($id_product){
    //alert("Editar "+$id_catalogo_proveedor);
    var id_producto=$id_product;
    var nom_prod=$("#nom_prod"+id_producto).text();
    var unid_med=$("#unid_med"+id_producto).text();
    var modelo=$("#modelo"+id_producto).text();
    var precio=$("#precio"+id_producto).text().split('$');
    precio[1]=precio[1].replace(/\,/g, '');
    var precio_venta=$("#precio_venta"+id_producto).text().split('$');
    precio_venta[1]=precio_venta[1].replace(/\,/g, '');
    var existencia=$("#existencia"+id_producto).text();
    var codigo=$("#codigo"+id_producto).text();
    var descripcion=$("#descripcion"+id_producto).text();
    var coment=$("#coment"+id_producto).text();
    //alert(precio[1]+" "+precio_venta[1]);
    //alert(nom_prod+unid_med+modelo+precio+existencia+codigo+descripcion+coment);
    $("#EditProductModal").modal();
    $("#edit_nom_prod").val(nom_prod);
    $("#edit_unid_med option:contains("+unid_med+")").attr('selected', true);
    $("#edit_model").val(modelo);
    $("#edit_prec").val(parseFloat(precio[1]));
    $("#edit_prec_venta").val(parseFloat(precio_venta[1]));
    $("#edit_exist").val(existencia);
    $("#edit_cod").val(codigo);
    $("#edit_descrip").val(descripcion);
    $("#edit_coment").val(coment);
    $("#edit_id_product").val(id_producto);
    }

  function Act_Invent($id_product){
    var id_producto=$id_product;
    var nom_prod=$("#nom_prod"+id_producto).text();
    var unid_med=$("#unid_med"+id_producto).text();
    var modelo=$("#modelo"+id_producto).text();
    var precio=$("#precio"+id_producto).text().split('$');
    precio[1]=precio[1].replace(/\,/g, '');
    var precio_venta=$("#precio_venta"+id_producto).text().split('$');
    precio_venta[1]=precio_venta[1].replace(/\,/g, '');
    var existencia=$("#existencia"+id_producto).text();
    var codigo=$("#codigo"+id_producto).text();
    var descripcion=$("#descripcion"+id_producto).text();
    var coment=$("#coment"+id_producto).text();
    //alert(precio[1]+" "+precio_venta[1]);
    //alert(nom_prod+unid_med+modelo+precio+existencia+codigo+descripcion+coment);
    $("#UpdateInventorieProductModal").modal();
    $("#inv_nom_prod").val(nom_prod);
    $("#inv_unid_med option:contains("+unid_med+")").attr('selected', true);
    $("#inv_prec").val(parseFloat(precio[1]));
    $("#inv_prec_venta").val(parseFloat(precio_venta[1]));
    $("#inv_prec_new").val(parseFloat(precio[1]));
    $("#inv_prec_venta_new").val(parseFloat(precio_venta[1]));
    $("#inv_exist").val(existencia);
    $("#inv_id_product").val(id_producto);
  }

  function Product_History($id_prod){
    id_prod=$id_prod;
    //alert(id_prod);
    $("#page_content").load("Product_History", {id_prod:id_prod});
  }

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("InventarioProductos");
  }



</script>