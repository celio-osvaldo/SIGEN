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
            <div class="card bg-card">
            <div class="margins">
                <br>
                <div class="table-responsive">
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
                                <td id=""><?php echo "".$row->id_catalogo_producto.""; ?></td>
                                <td id="<?php echo "name".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_nombre.""; ?></td>
                                <td id="<?php echo "medida".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->unidad_medida.""; ?></td>
                                <td>$</td>
                                <td id="<?php echo "price".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_precio.""; ?></td>
                                <td id="<?php echo "provider".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
                                <td id="<?php echo "date".$row->id_catalogo_producto.""; ?>"><?php echo "".$row->catalogo_producto_fecha_actualizacion.""; ?></td>
                                <td id="<?php echo "image".$row->id_catalogo_producto.""; ?>"><a role="button" class="btn btn-outline-dark" onclick="Display_product(this.id)" id="<?php echo "".$row->id_catalogo_producto.""; ?>" data-toggle="modal" data-target="#imgProduct"><img src="<?php echo base_url() ?>Resources/Icons/frame_gallery_image_images_photo_picture_pictures_icon_123209.ico" alt=""></a></td>
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
    <div class="col-md-1"></div>
</div>

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
      <form class="form-group" id="addproduct" enctype="multipart/form-data">
          <div class="modal-body">
                    <div class="row">
                      <?php foreach ($max->result() as $row){ ?>
                      <input class="form-control" type="hidden" id="idInsert" name="idInsert" value="<?php echo "".($row->id_catalogo_producto + 1).""; ?>">
                      <?php } ?>
                      <div class="col-md-6">
                        <label class="label-control">Nombre del producto</label>
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
                        <input class="form-control" type="number" id="priceInsert" name="priceInsert" required="true">
                      </div>

                      <div class="col-md-6">
                        <label class="label-control">Proveedor</label>
                        <select class="custom-select" id="providerInsert" name="providerInsert" required="true">
                        <?php foreach ($providers->result() as $row){ ?>
                            <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                        <?php } ?>
                        </select>
                        <input class="form-control" type="hidden" name="enterpriseIDInsert" id="enterpriseIDInsert" value="2">
                      </div>

                      <div class="col-md-6">
                        <label>Imágen</label>
                        <input type="hidden" id="dateInsert" name="dateInsert" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        <input class="form-control" type="file" name="imageInsert" id="imageInsert" required="true" accept="image/jpeg">
                      </div>

                </div>
              </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-success submitBtn" id="saveProduct">Guardar</button>
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
                </div>
        </form>
      </div>
    </div>
  </div>
<!-- end modal -->

<!-- modal edit product -->
<div class="modal fade" id="productE" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edición de los datos de produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

         <form class="form-group" id="editproduct" method="POST" enctype="multipart/form-data" action="<?php echo base_url()?>Dasa/UpdateInfoProduct">
              <div class="modal-body">
                    <div class="row">
                      <input class="form-control" type="hidden" id="idE" name="idE">
                      <div class="col-md-6">
                        <label class="label-control">Nombre del producto</label>
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
                        <input class="form-control" type="text" id="priceE" name="priceE" required="true">
                      </div>

                      <div class="col-md-6">
                        <label class="label-control">Proveedor</label>
                        <select class="custom-select" id="providerE" name="providerE" required="true">
                        <?php foreach ($providers->result() as $row){ ?>
                            <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                        <?php } ?>
                        </select>
                        <input class="form-control" type="hidden" name="EnterpriseIDE" name="EnterpriseIDE" id="EnterpriseIDE" value="2">
                      </div>
                      <input type="hidden" id="dateE" name="dateE" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">

                      <div class="col-md-6">
                        <label>Imágen</label>
                        <input class="form-control" type="file" name="imageE" id="imageE" >
                      </div>

                </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-success submitBtn" id="editProduct">Guardar</button>
                  <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
                </div>
        </form>
    </div>
  </div>
</div>
<!-- end modal -->

<!-- modal image product -->
<div class="modal fade" id="imgProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 id="nameproduct"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- <input type="text" name="imageV" id="imageV"> -->
          <img id="productImg" class="img-fluid rounded">
      </div>
      <div class="modal-footer">
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

<!-- new product script -->
<script>
$(document).ready(function(e){
    $("#addproduct").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Dasa/AddProduct',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addproduct').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                if(data == 1){
                    $('#addproduct')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Producto agregado');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#addproduct').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#imageInsert").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpg"];
        if(!((imagefile==match[0]))){
            alert('Selecciona el formato de imagen válido (JPG).');
            $("#imageInsert").val('');
            return false;
        }else{
          // alert('imagen subida');
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetInventories");
  }
</script>


<!-- edit product script -->
<script>
$(document).ready(function(e){
    $("#editproduct").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Dasa/UpdateInfoProduct',
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
                if(data == 1){
                    $('#editproduct')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Información del costo de venta actualizada');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#editproduct').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#imageInsert").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#imageInsert").val('');
            return false;
        }else{
          alert('imagen subida');
        }
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
    $("#medidaE option:contains("+uds_medida+")").attr('selected', true);
    $("#priceE").val(price);
    $("#providerE option:contains("+provider+")").attr('selected', true);
    // $("#EnterpriseIDE").val(company);
    $("#imageE").val(image);
    // $("#dateE").val(date);
    $("#idE").val(id);
    }

  function Update_Page(){
    $("#page_content").load("GetInventories");
  }
</script>

<!-- image of product selected script -->
<script>
  function Display_product($id){
    var image=$("#image"+$id).text();
    var name_product=$("#name"+$id).text();
    var id=$id;
    var url = "<?php echo base_url()?>Resources/Products&Services/DASA/"+id+".jpg";

    $("#imgProduct").modal();
    $("#imageV").val(image);
    $("#imageV").val(id);
    $("#nameproduct").val(name_product);
    $("#productImg").prop("src", url);
    }
</script>