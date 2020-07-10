<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Catálogo de Productos/Servicios</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewProduct"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar producto/servicio</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-12">
            <div class="card bg-card">
            <div class="margins">
                <br>
                <div class="table-responsive">
                    <table id="tableProductCatalog_id" class="table table-hover display table-striped" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                        <!--    <th>Código</th>   -->
                            <th>Nombre</th>
                            <th>Unidad de medida</th>
                            <th></th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Fecha de act.</th>
                            <th>Imagen</th>
                            <th>Modificar</th>
                            <th>Historial de Precios</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($inventories->result() as $row) {?>
                            <tr>
                              <!--  <td id=""><?php echo "".$row->id_catalogo_producto.""; ?></td>   -->
                                <td id="<?php echo "name".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_nombre.""; ?></td>
                                <td id="<?php echo "medida".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->unidad_medida.""; ?></td>
                                <td>$</td>
                                <td id="<?php echo "price".$row->id_catalogo_producto.""; ?>"><?php echo "".number_format($row->catalogo_producto_precio, 2, '.', ',').""; ?></td>
                                <td id="<?php echo "provider".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
                                <td id="<?php echo "date".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_fecha_actualizacion.""; ?></td>
                                <td id="<?php echo "image".$row->id_catalogo_producto.""; ?>"><a role="button" class="btn btn-outline-dark" onclick="Display_product(this.id)" id="<?php echo "".$row->catalogo_producto_url_imagen.""; ?>" data-toggle="modal" data-target="#imgProduct"><img src="<?php echo base_url() ?>Resources/Icons/frame_gallery_image_images_photo_picture_pictures_icon_123209.ico" alt=""></a></td>
                                <td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_catalogo_producto.""; ?>" data-toggle="modal" data-target="#productE"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                                </td>
                                <td>
                                  <a role="button" class="btn btn-outline-dark" onclick="Record_Product(this.id)" id="<?php echo "".$row->id_catalogo_producto.""; ?>"><img src="..\Resources\Icons\historial.ico" alt="Historial" style="filter: invert(100%)" /></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>

<!-- modal add product -->
<div class="modal fade" id="NewProduct" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto/Servicio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <label class="label-control">Nombre del producto/servicio</label>
            <input class="form-control" type="text" id="nameProductInsert" name="nameProductInsert" required="true">
          </div>

          <div class="col-md-4">
            <label class="label-control">Unidad de medida</label>
            <select class="custom-select" id="medidaInsert" name="medidaInsert" required="true">
              <option selected>Seleccionar</option>
              <?php foreach ($measure->result() as $row){ ?>
                <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
              <?php } ?>
            </select> 
          </div>

          <div class="col-md-2">
            <label class="label-control">Precio</label>
            <input class="form-control" type="text" onblur="Separa_Miles(this.id)" id="priceInsert" name="priceInsert" required="true">
          </div>

          <div class="col-md-6">
            <label class="label-control">Proveedor</label>
            <select class="custom-select" id="providerInsert" name="providerInsert" required="true">
              <?php foreach ($providers->result() as $row){ ?>
                <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="col-md-6">
            <label>Imagen</label>
            <input type="hidden" id="dateInsert" name="dateInsert" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
            <input class="form-control" type="file" name="imageInsert" id="imageInsert" accept="application/pdf, image/*">
          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success submitBtn" id="saveProduct">Guardar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<!-- end modal -->

<!-- modal edit product -->
<div class="modal fade" id="productE" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de los datos de producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

         <form class="form-group" id="editproduct" method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>Iluminacion/UpdateInfoProduct">
              <div class="modal-body">
                    <div class="row">
                      <input class="form-control" type="hidden" id="idE" name="idE">
                      <div class="col-md-6">
                        <label class="label-control">Nombre del producto/servicio</label>
                        <input class="form-control" type="text" id="nameProductE" name="nameProductE" required="true">
                      </div>

                      <div class="col-md-4">
                        <label class="label-control">Unidad de medida</label>
                        <select class="custom-select" id="medidaE" name="medidaE" required="true">
                          <?php foreach ($measure->result() as $row){ ?>
                          <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                          <?php } ?>
                        </select>
                      </div>

                      <div class="col-md-2">
                        <label class="label-control">Precio</label>
                        <input class="form-control" type="text" onblur="Separa_Miles(this.id)" id="priceE" name="priceE" required="true">
                      </div>

                      <div class="col-md-6">
                        <label class="label-control">Proveedor</label>
                        <select class="custom-select" id="providerE" name="providerE" required="true">
                        <?php foreach ($providers->result() as $row){ ?>
                            <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                        <?php } ?>
                        </select>
                      </div>
                      <input type="hidden" id="dateE" name="dateE" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">

                      <div class="col-md-6">
                        <label>Imagen</label>
                        <input class="form-control" type="file" name="imageE" id="imageE" accept="application/pdf, image/*" >
                      </div>

                </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-success submitBtn"  id="editProduct">Guardar</button>
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelarEdit">Cancelar</button>
                </div>
        </form>
    </div>
  </div>
</div>
<!-- end modal -->

<!-- modal image product -->
<!-- Modal Ver Comprobante de Pago -->
<div class="modal fade" id="Img_Product_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titlecomprobanteModal">Imagen de Producto/servicio</h5>
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
<!-- end modal -->

<script type="text/javascript">
  $(document).ready( function () {
    $('#tableProductCatalog_id').DataTable();

$('#saveProduct').click(function(){
  nameProductInsert=$("#nameProductInsert").val();
  medidaInsert=$("#medidaInsert").val();
  priceInsert=$("#priceInsert").val().replace(/\,/g, '');
  providerInsert=$("#providerInsert").val();
  dateInsert=$("#dateInsert").val();
   //alert(priceInsert);

  var datos = new FormData();
  var files = $('#imageInsert')[0].files[0];
  datos.append('file',files);
  datos.append('nameProductInsert',nameProductInsert);
  datos.append('medidaInsert',medidaInsert);
  datos.append('priceInsert',priceInsert);
  datos.append('providerInsert',providerInsert);
  datos.append('dateInsert',dateInsert);
   //alert(nameProductInsert+" "+medidaInsert+" "+priceInsert+" "+providerInsert+" "+dateInsert);
   if(nameProductInsert!=""&&priceInsert!=""){
    $.ajax({
      url: '<?php echo base_url();?>Iluminacion/AddProduct',
      type: 'post',
      data: datos,
      contentType: false,
      processData: false,
      success:function(result){
            //alert(result);
            if(result){
            alert("Producto Agregado");
            Update_Page();      
            }else{
              alert("Error del Servidor. Producto no Agregado. Intentelo nuevamente");
            }

          }
        });
  }else{
    alert("Debe ingresar un nombre de producto e indicar su precio");
  }     
  Update_Page(); 
  CloseModal();
});



  });
</script>

<!-- new product script -->
<script>


</script>


<!-- edit product script -->
<script>
$(document).ready(function(e){
    $("#editproduct").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Iluminacion/UpdateInfoProduct',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#editproduct').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                //alert(data);
                if(data){
                    $('#editproduct')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Información del producto actualizada');
                   // CloseModal();
                   // Update_Page(); 
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                  //CloseModal();
                }
                $("#btncancelarEdit").click();
                //Update_Page();
                CloseModal2();
            }
        });
        Update_Page();
    });


});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewProduct').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetInventories");
  }

function CloseModal2(){
    $('#btncancelar').click();
    $('#productE').modal("hide");
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
    price=price.replace(/\,/g, '');
    var provider=$("#provider"+$id).text();
    // var company=$("#company"+$id).val();
    var image=$("#image"+$id).text();
    // var date=$("#date"+$id).text();
    var id=$id;

    $("#productE").modal();
    $("#nameProductE").val(name_product);
    $("#medidaE option:contains("+uds_medida+")").attr('selected', true);
    $("#priceE").val(price);
    $("#providerE option:contains("+provider+")").attr('selected', true);
    // $("#EnterpriseIDE").val(company);
    $("#imageE").val(image);
    // $("#dateE").val(date);
    $("#idE").val(id);
    }

    function Record_Product($id_product){
      id_product=$id_product;
      $("#page_content").load("Product_Record",{id_product:id_product});
    }

  function Update_Page(){
    $("#page_content").load("GetInventories");
  }
</script>

<!-- image of product selected script -->
<script>


  function Display_product($id){
    //var id_pagos_anticipo=$id_pagos_anticipo;
    //var comprobante=$("#url_"+$id_pagos_anticipo).text().split(".");
    var url="<?php echo base_url()?>"+$id;
    //alert($id);
    //alert(comprobante[0]+" "+comprobante[1]);
    if ($id==""||$id=="N/A") {
      alert("No se adjuntó Imagen");
    }else{
      $('#Img_Product_Modal').modal();
        $('#modal-body').append("<embed id='imagen_modal' frameborder='0' width='100%'' height='400px'>");    
      $('#imagen_modal').attr({"src" : url});
    }
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