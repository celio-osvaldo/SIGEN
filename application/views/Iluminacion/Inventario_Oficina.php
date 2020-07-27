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
          <th>Editar</th>
          <th>Nombre Producto</th>
          <th>Unidad de Medida</th>
          <th>Existencia</th>
          <th>Precio Unitario</th>
          <th>Fecha Última Compra</th>
          <th>Periodicidad de Compra</th>
          <th>Prox. Fecha de Compra Estimada</th>
          <th>Último Proveedor</th>
        </tr>
      </thead>
      <tbody>
       <?php 
        foreach ($inventario_oficina->result() as $row) {
         ?>
         <tr>
          <td><a class="navbar-brand" href="#" onclick="EditOffice(this.id)" role="button" id="<?php echo $row->id_prod; ?>">
            <button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
            </button>
          </a></td>
          <td id="<?php echo "nom_prod".$row->id_prod;?>"><?php echo "".$row->producto_consu_nom.""; ?></td>
          <td id="<?php echo "unid_med".$row->id_prod;?>"><?php echo "".$row->unidad_medida.""; ?></td>
          <td id="<?php echo "existencia".$row->id_prod;?>"><?php echo "".$row->producto_consu_exist.""; ?></td>
          <td id="<?php echo "precio".$row->id_prod;?>">$<?php echo number_format($row->producto_consu_prec_unit,5,'.',',').""; ?></td>
          <td id="<?php echo "ult_compra".$row->id_prod;?>"><?php echo "".$row->producto_consu_ult_compra.""; ?></td>
          <td id="<?php echo "periodicidad".$row->id_prod;?>"><?php echo "".$row->producto_consu_periodicidad."-días"; ?></td>
          <td id="<?php echo "prox_compra".$row->id_prod;?>"><?php echo "".$row->producto_consu_prox_compra.""; ?></td>
          <td id="<?php echo "ult_proveed".$row->id_prod;?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
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
        <label>Nombre Producto</label>
        <input type="text" id="new_nom_prod" class="form-control input-sm">
        <label>Unidad de Medida</label>
         <select class="form-control" name="new_unid_med" id="new_unid_med">
                    <option disabled selected>----Seleccionar Unidad Medida----</option>
                  <?php foreach ($unidades_medida->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Existencia</label><br>   
        <input type="number" id="new_exist" class="form-control input-sm"><br>
        <label>Precio Unitario</label><br>
        <input type="text" onblur="Separa_Miles(this.id)" id="new_prec" class="form-control input-sm"><br>
        <label>Fecha Última Compra</label><br>
        <input type="date" id="new_ult_comp" class="form-control input-sm"><br>
        <label>Periodicidad de Compra</label><br>
        <input type="number" id="new_periodic" class="form-control input-sm"><br>
        <label>Proveedor</label><br>
        <select class="form-control" name="new_provider" id="new_provider">
                    <option disabled selected>----Seleccionar Proveedor----</option>
                  <?php foreach ($providers->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                  <?php } ?>
                  </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewConsumible" data-dismiss="modal">Actualizar</button>
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
         <label>Nombre Producto</label>
        <input type="text" id="edit_nom_prod" class="form-control input-sm">
        <label>Unidad de Medida</label>
         <select class="form-control" name="edit_unid_med" id="edit_unid_med">
                    <option disabled selected>----Seleccionar Unidad Medida----</option>
                  <?php foreach ($unidades_medida->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                  <?php } ?>
                  </select>
        <label>Existencia</label><br>   
        <input type="number" id="edit_exist" class="form-control input-sm"><br>
        <label>Precio Unitario</label><br>
        <input type="text" onblur="Separa_Miles(this.id)" id="edit_prec" class="form-control input-sm"><br>
        <label>Fecha Última Compra</label><br>
        <input type="date" id="edit_ult_comp" class="form-control input-sm"><br>
        <label>Periodicidad de Compra</label><br>
        <input type="number" id="edit_periodic" class="form-control input-sm"><br>
        <label>Proveedor</label><br>
        <select class="form-control" name="edit_provider" id="edit_provider">
                    <option disabled selected>----Seleccionar Proveedor----</option>
                  <?php foreach ($providers->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                  <?php } ?>
                  </select>
        <input type="text" id="edit_id_product" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateConsumible" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  $(document).ready( function () {
    $('#table_Inv_Office').DataTable();

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

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("InventarioOficina");
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