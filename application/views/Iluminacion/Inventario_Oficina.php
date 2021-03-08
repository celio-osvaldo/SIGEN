<!--Mostrar Inventario de Consumibles Oficina -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Almacén de Consumibles de Oficina</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewInv_OfficeModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Consumible</button>
  </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_Inv_Office" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Acciones</th>
          <th>Nombre Producto</th>
          <th>Unidad de Medida</th>
          <th>Existencia</th>
          <th>Precio Unitario</th>
          <th>Fecha Última Compra</th>
          <th>Periodicidad de Compra</th>
          <th>Prox. Fecha de Compra Estimada</th>
          <th>Último Proveedor</th>
          <th>Historial</th>
        </tr>
      </thead>
      <tbody>
       <?php 
       foreach ($inventario_oficina->result() as $row) {
         ?>
         <tr>
          <td>
            <button title="Editar" class="btn btn-outline-secondary" onclick="EditOffice(this.id)" role="button" id="<?php echo $row->id_prod; ?>"><img width="20" height="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></button>
            <button title="Actualiza Inventario" class="btn btn-outline-secondary" onclick="Act_Invent(this.id)" role="button" id="<?php echo $row->id_prod; ?>"><img width="20" height="20" src="..\Resources\Icons\inventario.ico" alt="Ingresar Inventario"/></button>
          </td>
          <td id="<?php echo "nom_prod".$row->id_prod;?>"><?php echo "".$row->producto_consu_nom.""; ?></td>
          <td id="<?php echo "unid_med".$row->id_prod;?>"><?php echo "".$row->unidad_medida.""; ?></td>
          <td id="<?php echo "existencia".$row->id_prod;?>"><?php echo "".$row->producto_consu_exist.""; ?></td>
          <td id="<?php echo "precio".$row->id_prod;?>">$<?php echo number_format($row->producto_consu_prec_unit,5,'.',',').""; ?></td>
          <td id="<?php echo "ult_compra".$row->id_prod;?>"><?php echo "".$row->producto_consu_ult_compra.""; ?></td>
          <td id="<?php echo "periodicidad".$row->id_prod;?>"><?php echo "".$row->producto_consu_periodicidad."-días"; ?></td>
          <td id="<?php echo "prox_compra".$row->id_prod;?>"><?php echo "".$row->producto_consu_prox_compra.""; ?></td>
          <td id="<?php echo "ult_proveed".$row->id_prod;?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
          <td><button title="Historial" class="btn btn-outline-secondary" onclick="Product_History(this.id)" role="button" id="<?php echo $row->id_prod; ?>"><img width="20" height="20" src="..\Resources\Icons\historial.ico" alt="Historial"/></button></td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>

<!-- Modal New Consumible -->
<div class="modal fade" id="NewInv_OfficeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Consumible</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Nombre Producto</label>
            <input type="text" id="new_nom_prod" class="form-control input-sm">
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Unidad de Medida</label>
            <select class="form-control" name="new_unid_med" id="new_unid_med">
              <option disabled selected>---Unidad Medida---</option>
              <?php foreach ($unidades_medida->result() as $row){ ?>
                <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
              <?php } ?>
            </select>            
          </div>
          <div class="col-md-3">
            <label class="label-control">Existencia</label>
            <input type="number" id="new_exist" class="form-control input-sm">
          </div>
          <div class="col-md-4">
            <label class="label-control">Precio Unitario</label>
            <input type="text" onblur="Separa_Miles(this.id)" id="new_prec" class="form-control input-sm">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="label-control">Fecha Última Compra</label>
            <input type="date" id="new_ult_comp" class="form-control input-sm">
          </div>
          <div class="col-md-6">
            <label class="label-control">Periodicidad de Compra (días)</label>
            <input type="number" id="new_periodic" class="form-control input-sm">
          </div>
        </div> 
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Proveedor</label>
            <select class="form-control" name="new_provider" id="new_provider">
              <option disabled selected>----Seleccionar Proveedor----</option>
              <?php foreach ($providers->result() as $row){ ?>
                <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewConsumible" data-dismiss="modal">Agregar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Consumible -->
<div class="modal fade" id="EditConsumibleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <input type="text" id="edit_nom_prod" class="form-control input-sm">
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
          <div class="col-md-4">
           <label class="label-control">Existencia</label>   
           <input disabled="true" type="number" id="edit_exist" class="form-control input-sm">
         </div>
         <div class="col-md-4">
          <label>Precio Unitario</label>
          <input type="text" onblur="Separa_Miles(this.id)" id="edit_prec" class="form-control input-sm">
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <label>Fecha Última Compra</label>
          <input type="date" id="edit_ult_comp" class="form-control input-sm">
        </div>
        <div class="col-md-6">
          <label class="label-control">Periodicidad de Compra</label>
          <input type="number" id="edit_periodic" class="form-control input-sm">
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <label class="label-control">Proveedor</label>
          <select class="form-control" name="edit_provider" id="edit_provider">
            <option disabled selected>----Seleccionar Proveedor----</option>
            <?php foreach ($providers->result() as $row){ ?>
              <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
            <?php } ?>
          </select>
        </div>
      </div>
      <input type="text" id="edit_id_product" hidden="true">
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
      <button type="button" class="btn btn-primary" id="UpdateConsumible" data-dismiss="modal">Actualizar</button>
    </div>
  </div>
</div>
</div>


<!-- Modal Update Inventorie -->
<div class="modal fade" id="UpdateInventorieProductModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Inventario de Consumible</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" style="background-color: #6BF57A">
        <div class="row" style="background-color: #C1C1C1">
          <div class="col-md-12">
            <label class="label-control">Nombre Consumible</label>
            <input disabled="true" type="text" id="inv_nom_prod" class="form-control">
          </div>
        </div>
        <div class="row" style="background-color: #C1C1C1">
          <div class="col-md-4">
            <label class="label-control">Unidad de Medida</label>
           <select disabled="true" class="form-control" name="inv_unid_med" id="inv_unid_med">
            <option disabled selected>----Seleccionar Unidad Medida----</option>
            <?php foreach ($unidades_medida->result() as $row){ ?>
              <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
            <?php } ?>
          </select>
        </div>
          <div class="col-md-4">
            <label class="label-control">Existencia Actual</label>
            <input disabled="true" type="number" id="inv_exist" class="form-control input-sm">
          </div>
          <div class="col-md-4">
            <label class="label-control">Precio Unit. Actual</label>
            <input disabled="true" type="text" id="inv_prec" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
        </div>
        <div class="row" style="background-color: #C1C1C1">
          <div class="col-md-6">
            <label class="label-control">Último Proveedor</label>
            <input disabled="true" type="text" id="inv_proveedor" name="inv_proveedor" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="label-control">Fecha de última Compra</label>
            <input disabled="true" type="text" id="inv_fecha_compra" name="inv_fecha_compra" class="form-control">
          </div>          
        </div>

        <div class="row" >
          <div class="col-md-4">
            <label class="label-control">Movimiento a Realizar</label>
            <select class="form-control" name="inv_tipo_mov" id="inv_tipo_mov" onchange="Verifica_Mov()">
              <option value="alta">Alta</option>
              <option value="baja">Baja</option>
            </select>
          </div>
          <div class="col-md-4">
            <label class="label-control">Cantidad a Agregar/Restar</label>
            <input type="number" name="inv_cant_prod" min="0" value="1" id="inv_cant_prod" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="label-control">Precio Unitario Nuevo</label>
            <input type="text" id="inv_prec_new" onblur="Separa_Miles(this.id)" class="form-control input-sm">
          </div>
        </div>
        <div class="row" >
          <div class="col-md-5">
            <label>Procedencia</label>
              <select class="form-control" name="inv_procedencia" id="inv_procedencia">
                <option value="compra">Adquisición</option>
                <option value="traspaso">Traspaso</option>
                <option value="consumo">Consumo</option>
                <option value="ajuste">Ajuste de Inventario</option>
              </select>
          </div>
          <div class="col-md-7">
            <label>Referencia (Factura, Pedido, etc.)</label>
            <input type="text" maxlength="200" name="inv_referencia" id="inv_referencia" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-7">
            <label class="label-control">Proveedor</label>
            <select class="form-control" name="inv_proveedor_new" id="inv_proveedor_new">
              <option disabled selected>----Seleccionar Proveedor----</option>
              <?php foreach ($providers->result() as $row){ ?>
                <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-5">
            <label class="label-control">Fecha del Movimiento</label>
            <input class="form-control" type="date" name="inv_fecha_compra_new" id="inv_fecha_compra_new">
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
    $('#table_Inv_Office').DataTable();


    $('#InvProduct').click(function(){
      id_prod=$("#inv_id_product").val();
      precio_unit_old=$("#inv_prec").val().replace(/\,/g, '');
      existencia_old=$("#inv_exist").val();
      proveedor_old=$("#inv_proveedor").val();
      fecha_compra_old=$("#inv_fecha_compra").val();

      inv_tipo_mov=$("#inv_tipo_mov").val();
      inv_cant_prod=$("#inv_cant_prod").val();
      inv_prec_new=$("#inv_prec_new").val().replace(/\,/g, '');
     
      inv_procedencia=$("#inv_procedencia").val();
      inv_referencia=$("#inv_referencia").val();
      inv_proveedor_new=$("#inv_proveedor_new").val();
      inv_fecha_compra_new=$("#inv_fecha_compra_new").val();

      //alert(proveedor_old, inv_proveedor_new);

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
            url:"<?php echo base_url();?>Iluminacion/Update_Inv_Consu",
            data:{id_prod:id_prod, precio_unit_old:precio_unit_old, existencia_old:existencia_old, proveedor_old:proveedor_old, fecha_compra_old:fecha_compra_old, inv_tipo_mov:inv_tipo_mov, inv_cant_prod:inv_cant_prod, inv_prec_new:inv_prec_new, inv_procedencia: inv_procedencia, inv_referencia:inv_referencia, inv_proveedor_new:inv_proveedor_new, inv_fecha_compra_new:inv_fecha_compra_new},
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
          alert("Debe ingresar cantidad de Consumible mayor a 0");
        }
      }else{
        alert("No puede descontar más Consumibles de los indicados en el inventario como existencia actual");
      }

    });



    $('#UpdateConsumible').click(function(){
      nom_prod=$("#edit_nom_prod").val();
      unid_med=$("#edit_unid_med").val();
      existencia=$("#edit_exist").val();
      precio=$("#edit_prec").val();
      precio=precio.replace(/\,/g, '');
      ult_compra=$("#edit_ult_comp").val();
      periodicidad=$("#edit_periodic").val();
      proveedor=$("#edit_provider").val();
      id_prod=$("#edit_id_product").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_prod!=""&&unid_med!=null&&proveedor!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/UpdateConsumible",
          data:{id_prod:id_prod, nom_prod:nom_prod, unid_med:unid_med, existencia:existencia, precio:precio, ult_compra:ult_compra, periodicidad:periodicidad, proveedor:proveedor},
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
        alert("Debe ingresar nombre de Consumible y Unidad de Medida");
      }
    });

    $('#NewConsumible').click(function(){
      nom_prod=$("#new_nom_prod").val();
      unid_med=$("#new_unid_med").val();
      existencia=$("#new_exist").val();
      precio=$("#new_prec").val();
      precio=precio.replace(/\,/g, '');
      ult_compra=$("#new_ult_comp").val();
      periodicidad=$("#new_periodic").val();
      proveedor=$("#new_provider").val();
      //alert(nom_prod+unid_med+modelo+precio+existencia+codigo+descripcion+coment);
      if (nom_prod!=""&&unid_med!=null&&proveedor!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/NewAlm_Consumible",
          data:{nom_prod:nom_prod, unid_med:unid_med, existencia:existencia, precio:precio, ult_compra:ult_compra, periodicidad:periodicidad, proveedor:proveedor},
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
        alert("Debe ingresar nombre de Consumible, Unidad de Medida y Proveedor");
      }
    });

  });
</script>

<script type="text/javascript">
  //Función para Mostrar Modal de Editar un registro de Cliente/Obra
  function EditOffice($id_product){
    //alert("Editar "+$id_catalogo_proveedor);
    var id_producto=$id_product;
    var nom_prod=$("#nom_prod"+id_producto).text();
    var unid_med=$("#unid_med"+id_producto).text();
    var existencia=$("#existencia"+id_producto).text();
    var precio=$("#precio"+id_producto).text().split('$');
    precio[1]=precio[1].replace(/\,/g, '');
    var ult_compra=$("#ult_compra"+id_producto).text();
    var periodicidad=$("#periodicidad"+id_producto).text().split('-');
    var proveedor=$("#ult_proveed"+id_producto).text();
    //alert(nom_prod+unid_med+modelo+precio+existencia+codigo+descripcion+coment);
    $("#EditConsumibleModal").modal();
    $("#edit_nom_prod").val(nom_prod);
    $("#edit_unid_med option:contains("+unid_med+")").attr('selected', true);
    $("#edit_exist").val(existencia);
    $("#edit_prec").val(parseFloat(precio[1]));
    $("#edit_ult_comp").val(ult_compra);
    $("#edit_periodic").val(periodicidad[0]);
    $("#edit_provider option:contains("+proveedor+")").attr('selected', true);
    $("#edit_id_product").val(id_producto);
    }


  function Act_Invent($id_product){
    var id_producto=$id_product;
    var nom_prod=$("#nom_prod"+id_producto).text();
    var unid_med=$("#unid_med"+id_producto).text();
    var precio=$("#precio"+id_producto).text().split('$');
    precio[1]=precio[1].replace(/\,/g, '');    
    var existencia=$("#existencia"+id_producto).text();
    ult_compra=$("#ult_compra"+id_producto).text();
    periodicidad=$("#periodicidad"+id_producto).text();
    prox_compra=$("#prox_compra"+id_producto).text();
    ult_proveed=$("#ult_proveed"+id_producto).text();
    

    $("#UpdateInventorieProductModal").modal();
    $("#inv_nom_prod").val(nom_prod);
    $("#inv_unid_med option:contains("+unid_med+")").attr('selected', true);
    $("#inv_prec").val(parseFloat(precio[1]));
    
    $("#inv_prec_new").val(parseFloat(precio[1]));
    
    $("#inv_exist").val(existencia);
    $("#inv_proveedor").val(ult_proveed);
    $("#inv_fecha_compra").val(ult_compra);
    $("#inv_proveedor_new option:contains("+ult_proveed+")").attr('selected', true);

    $("#inv_id_product").val(id_producto);
  } 

function Verifica_Mov(){
  inv_tipo_mov=$("#inv_tipo_mov").val();
  //alert(inv_tipo_mov);
  if (inv_tipo_mov=="baja") {
    $("#inv_prec_new").attr('disabled','true');
    $("#inv_proveedor_new").attr('disabled','true');
  }else{
    $("#inv_prec_new").removeAttr('disabled');
    $("#inv_proveedor_new").removeAttr('disabled');
  }
}
  function Product_History($id_prod){
    id_prod=$id_prod;
    //alert(id_prod);
    $("#page_content").load("Product_History_Consu", {id_prod:id_prod});
  }

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("InventarioOficina");
  }



</script>