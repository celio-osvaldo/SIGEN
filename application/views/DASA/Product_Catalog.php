<!-- modall edit bill -->
<div class="modal fade" id="productE" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de los datos de produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <!-- <form class="form-group" id="addproduct" method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>Dasa/UpdateInfoProduct"> -->
                    <?php echo form_open_multipart('Dasa/UpdateInfoProduct', 'id="addproduct"') ?>
                    <div class="row">
                      <input class="form-control" type="hidden" id="idE" name="idE">
                      <div class="col-md-6">
                        <label class="label-control">Nombre del producto</label>
                        <input class="form-control" type="text" id="nameProductE" name="nameProductE" required="true">
                      </div>

                      <div class="col-md-4">
                        <label class="label-control">Unidad de medida</label>
                        <select class="custom-select" id="medidaE" name="medidaE" required="true">
                          <option value="">Seleccionar</option>
                          <?php foreach ($measure->result() as $row){ ?>
                          <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="col-md-2">
                        <label class="label-control">Precio</label>
                        <input class="form-control" type="text" id="priceE" name="priceE" required="true">
                      </div>

                      <div class="col-md-12">
                        <label class="label-control">Proveedor</label>
                        <select class="custom-select" id="providerE" name="providerE" required="true">
                        <?php foreach ($providers->result() as $row){ ?>
                            <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                        <?php } ?>
                        </select>
                        <input class="form-control" type="hidden" name="EnterpriseIDE" name="EnterpriseIDE" id="EnterpriseIDE" value="2">
                      </div>
                      <input type="text" name="imageE" id="imageE">
                      <input type="hidden" id="dateE" name="dateE" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">

                      <div class="modal-footer">
                        <input type="submit" class="btn btn-outline-success" id="saveData" value="Guardar">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancelar">Cancelar</button>
                      </div>

                </div>

                <!-- </form> -->
                <?php form_close() ?>
      </div>
      <!-- <div class="modal-footer"> -->
      <!-- </div> -->
    </div>
  </div>
</div>
<!-- end modal -->
<!-- script by update product -->
<script>
  $(document).ready(function () {
    $("#editproduct").bind("submit",function(){
        // Catch button of save
        var btnSend = $("#saveData");
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data:$(this).serialize(),
            beforeSend: function(){//Send data to server
                // btnSend.text("Actualizando..."); Change when data is send
                btnSend.val("Actualizando...");
                btnSend.attr("disabled","disabled");//the disabled property is added to avoid a double click and send the information two or more times
            },
            complete:function(data){//restore default values whet the request ended
                btnSend.val("Actualizado");
                btnSend.removeAttr("disabled");
            },
            success: function(data){//if data is succesful show alerts
                // alert(data);
                if(data==1){
                  alert('Información del producto actualizada');
                  CloseModal();
                }else{
                  alert('Falló el servidor. Producto no agregado. Verifique que la información sea correcta');
                }
            },
            error: function(data){//execute when request fails
                alert("Falló el servidor. Registro no agregado");
            }
        });
        return false;
    });
});
function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetInventories");
  }
</script>

<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Catálogo de productos</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewProduct"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar producto</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="container">
            <div class="card bg-card">
            <div class="container">
                <br>
                <div class="table-responsive-lg">
                    <table id="tableProductCatalog_id" class="table table-hover display table-striped" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>ud. medida</th>
                            <th></th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Fecha de act.</th>
                            <th>Imágen</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($inventories->result() as $row) {?>
                            <tr>
                                <td><?php echo "".$row->id_catalogo_producto.""; ?></td>
                                <td id="<?php echo "name".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_nombre.""; ?></td>
                                <td id="<?php echo "medida".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->unidad_medida.""; ?></td>
                                <td>$</td>
                                <td id="<?php echo "price".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_precio.""; ?></td>
                                <td id="<?php echo "provider".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
                                <td id="<?php echo "date".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_fecha_actualizacion.""; ?></td>
                                <td id="<?php echo "image".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_url_imagen.""; ?></td>
                                <td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_catalogo_producto.""; ?>" data-toggle="modal" data-target="#productE"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                <br>
            </div>
        </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>



<br>


<!-- modal add product -->
<div class="modal fade" id="NewProduct" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                  <!-- <form class="form-group" id="editproduct" method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>Dasa/AddProduct"> -->
                    <?php echo form_open_multipart('Dasa/AddProduct', 'id="editproduct"') ?>
                    <div class="row">
                      <input class="form-control" type="hidden" id="idInsert" name="idInsert">
                      <div class="col-md-6">
                        <label class="label-control">Nombre del producto</label>
                        <input class="form-control" type="text" id="nameProductInsert" name="nameProductInsert" required="true">
                      </div>

                      <div class="col-md-4">
                        <label class="label-control">Unidad de medida</label>
                        <select class="custom-select" id="medidaInsert" name="medidaInsert" required="true">
                          <option value="">Seleccionar</option>
                          <?php foreach ($measure->result() as $row){ ?>
                          <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="col-md-2">
                        <label class="label-control">Precio</label>
                        <input class="form-control" type="number" id="priceInsert" name="priceInsert" required="true">
                      </div>

                      <div class="col-md-12">
                        <label class="label-control">Proveedor</label>
                        <select class="custom-select" id="providerInsert" name="providerInsert" required="true">
                        <?php foreach ($providers->result() as $row){ ?>
                            <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                        <?php } ?>
                        </select>
                        <input class="form-control" type="hidden" name="EnterpriseIDInsert" name="EnterpriseIDInsert" id="EnterpriseIDInsert" value="2">
                      </div>

                      <input type="hidden" id="dateInsert" name="dateInsert" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">

                      <div class="modal-footer">
                        <input type="submit" class="btn btn-outline-success" id="saveProduct" value="Guardar">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancelar">Cancelar</button>
                      </div>

                </div>

                <!-- </form> -->
                <?php form_close() ?>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->


<script type="text/javascript">
  $(document).ready( function () {
    $('#tableProductCatalog_id').DataTable();
  });
</script>

<!-- script by add new product -->
<script>
$(document).ready(function () {
    $("#addproduct").bind("submit",function(){
        // Catch button of save
        var btnSend = $("#saveProduct");
        $.ajax({
            type: $(this).attr("method"),
            url: $(this).attr("action"),
            data:$(this).serialize(),
            beforeSend: function(){//Send data to server
                // btnSend.text("Guardando..."); Change when data is send
                btnSend.val("Guardando...");
                btnSend.attr("disabled","disabled");//the disabled property is added to avoid a double click and send the information two or more times
            },
            complete:function(data){//restore default values whet the request ended
                btnSend.val("Guardado");
                btnSend.removeAttr("disabled");
            },
            success: function(data){//if data is succesful show alerts
                // alert(data);
                if(data==1){
                  alert('Producto Agregado');
                  CloseModal();
                }else{
                  alert('Falló el servidor. Producto no agregado. Verifique que la información sea correcta');
                }
            },
            error: function(data){//execute when request fails
                alert("Falló el servidor. Registro no agregado");
            }
        });
        return false;
    });
});
function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetInventories");
  }
</script>

<!-- Script thats return data of an object selected -->
<script>
  function Edit_product($id){
    // alert("Editar "+$id);
    var name_product=$("#name"+$id).text();
    var uds_medida=$("#medida"+$id).text();
    var price=$("#price"+$id).text();
    var provider=$("#provider"+$id).text();
    // var company=$("#company"+$id).val();
    var image=$("#image"+$id).text();
    // var date=$("#date"+$id).text();
    var id=$id;

    $("#productE").modal();
    $("#nameProductE").val(name_product);
    $("#medidaE").val(uds_medida);
    $("#priceE").val(price);
    $("#providerE").val(provider);
    // $("#EnterpriseIDE").val(company);
    $("#imageE").val(image);
    // $("#dateE").val(date);
    $("#idE").val(id);
    }

  function Update_Page(){
    $("#page_content").load("GetInventories");
  }
</script>
