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
    <table id="table_Inv_Prod" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Editar</th>
          <th>Nombre Producto</th>
          <th>Unidad de Medida</th>
          <th>Modelo</th>
          <th>Precio Unitario</th>
          <th>Existencia</th>
          <th>Cógido Producto</th>
          <th>Descripción del Producto</th>
          <th>Comentario</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        foreach ($inventario_productos->result() as $row) {
         ?>
         <tr>
          <td><a class="navbar-brand" href="#" onclick="EditProduct(this.id)" role="button" id="<?php echo $row->id_prod_alm; ?>">
            <button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
            </button>
          </a></td>
          <td id="<?php echo "nom_prod".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_nom.""; ?></td>
          <td id="<?php echo "unid_med".$row->id_prod_alm;?>"><?php echo "".$row->unidad_medida.""; ?></td>
          <td id="<?php echo "modelo".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_modelo.""; ?></td>
          <td id="<?php echo "precio".$row->id_prod_alm;?>">$<?php echo "".$row->prod_alm_prec_unit.""; ?></td>
          <td id="<?php echo "existencia".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_exist.""; ?></td>
          <td id="<?php echo "codigo".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_codigo.""; ?></td>
          <td id="<?php echo "descripcion".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
          <td id="<?php echo "coment".$row->id_prod_alm;?>"><?php echo "".$row->prod_alm_coment.""; ?></td>
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
        <input type="text" id="new_nom_prod" class="form-control input-sm">
        <label>Unidad de Medida</label>
         <select class="form-control" name="new_unid_med" id="new_unid_med">
                    <option disabled selected>----Seleccionar Unidad Medida----</option>
                  <?php foreach ($unidades_medida->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Modelo</label><br>   
        <input type="text" id="new_model" class="form-control input-sm"><br>
        <label>Precio Unitario</label><br>
        <input type="number" id="new_prec" class="form-control input-sm"><br>
        <label>Existencia</label><br>
        <input type="number" id="new_exist" class="form-control input-sm"><br>
        <label>Cógido de Producto</label><br>
        <input type="text" id="new_cod" class="form-control input-sm"><br>
        <label>Descripción del Producto</label><br>
        <input type="text" id="new_descrip" maxlength="100" class="form-control input-sm"><br>
        <label>Comentarios</label><br>
        <textarea id="new_coment" maxlength="150" class="form-control input-sm"></textarea>
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
        <label>Nombre Producto</label>
        <input type="text" id="edit_nom_prod" class="form-control input-sm">
        <label>Unidad de Medida</label>
         <select class="form-control" name="edit_unid_med" id="edit_unid_med">
                    <option disabled selected>----Seleccionar Unidad Medida----</option>
                  <?php foreach ($unidades_medida->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Modelo</label><br>   
        <input type="text" id="edit_model" class="form-control input-sm"><br>
        <label>Precio Unitario</label><br>
        <input type="number" id="edit_prec" class="form-control input-sm"><br>
        <label>Existencia</label><br>
        <input type="number" id="edit_exist" class="form-control input-sm"><br>
        <label>Cógido de Producto</label><br>
        <input type="text" id="edit_cod" class="form-control input-sm"><br>
        <label>Descripción del Producto</label><br>
        <input type="text" id="edit_descrip" maxlength="100" class="form-control input-sm"><br>
        <label>Comentarios</label><br>
        <textarea id="edit_coment" maxlength="150" class="form-control input-sm"></textarea>
        <input type="text" id="edit_id_product" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateProduct" data-dismiss="modal">Actualizar</button>
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
      existencia=$("#edit_exist").val();
      codigo=$("#edit_cod").val();
      descripcion=$("#edit_descrip").val();
      coment=$("#edit_coment").val();
      id_prod=$("#edit_id_product").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_prod!=""&&unid_med!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Salinas/Update_Alm_Product",
          data:{id_prod:id_prod, nom_prod:nom_prod, unid_med:unid_med, modelo:modelo, precio:precio, existencia:existencia, codigo:codigo, descripcion:descripcion, coment:coment},
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

    $('#NewProduct').click(function(){
      nom_prod=$("#new_nom_prod").val();
      unid_med=$("#new_unid_med").val();
      modelo=$("#new_model").val();
      precio=$("#new_prec").val();
      existencia=$("#new_exist").val();
      codigo=$("#new_cod").val();
      descripcion=$("#new_descrip").val();
      coment=$("#new_coment").val();
      //alert(nom_prod+unid_med+modelo+precio+existencia+codigo+descripcion+coment);
      if (nom_prod!=""&&unid_med!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Salinas/NewAlm_Product",
          data:{nom_prod:nom_prod, unid_med:unid_med, modelo:modelo, precio:precio, existencia:existencia, codigo:codigo, descripcion:descripcion, coment:coment},
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
    var unid_med=$("#unid_med"+id_producto).val();
    var modelo=$("#modelo"+id_producto).text();
    var precio=$("#precio"+id_producto).text().split('$');
    var existencia=$("#existencia"+id_producto).text();
    var codigo=$("#codigo"+id_producto).text();
    var descripcion=$("#descripcion"+id_producto).text();
    var coment=$("#coment"+id_producto).text();
    //alert(nom_prod+unid_med+modelo+precio+existencia+codigo+descripcion+coment);
    $("#EditProductModal").modal();
    $("#edit_nom_prod").val(nom_prod);
    $("#edit_unid_med option:contains("+unid_med+")").attr('selected', true);
    $("#edit_model").val(modelo);
    $("#edit_prec").val(parseFloat(precio[1]));
    $("#edit_exist").val(existencia);
    $("#edit_cod").val(codigo);
    $("#edit_descrip").val(descripcion);
    $("#edit_coment").val(coment);
    $("#edit_id_product").val(id_producto);
    }

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("InventarioProductos");
  }

</script>