<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Facturas de Venta</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Costo</button>
  </div>
  <div class="col-md-1"></div>
</div>


            <div class="card bg-card">
            
                <br>
                <div class="table-responsive">
                    <table id="table_id" class="table table-striped table-hover display" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>No. Folio</th>
                            <th>Fecha de emisión</th>
                            <th>Cliente</th>
                            <th></th>
                            <th>Monto</th>
                            <th>Concepto</th>
                            <th>Observación</th>
                            <th>Factura</th>
                            <th>Estatus</th>
                            <th>Fecha de Pago</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><?php foreach ($cost_sale->result() as $row) {?>
                            <td id="<?php echo "bill".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_factura.""; ?></td>
                            <td id="<?php echo "emition".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha.""; ?></td>
                            <td id="<?php echo "client".$row->id_gasto_venta.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                            <td align="right">$</td>
                            <td id="<?php echo "amount".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_monto.""; ?></td>
                            <td id="<?php echo "concept".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_concepto.""; ?></td>
                            <td id="<?php echo "comment".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_observacion.""; ?></td>
                            <td align="center"><a role="button" class="btn btn-outline-dark" id="<?php echo "".$row->id_gasto_venta.""; ?>" data-toggle="modal" data-target="#showBill"><img src="..\Resources\Icons\invoice_icon_128337.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
                            <td id="<?php echo "status".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_estado_pago.""; ?></td>
                            <td id="<?php echo "date".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha_pago.""; ?></td>
                            <td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_gasto_venta.""; ?>" data-toggle="modal" data-target="#editCostSale"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
                        </tr><?php } ?>
                    </tbody>
                </table>
                </div>
                <br>
            
        </div>


<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>

<!-- modal new bill -->
<div class="modal fade" id="NewBill"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo costo de venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="addcostSale" enctype="multipart/form-data">

          <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Folio:</label>
                             <?php foreach ($max->result() as $row){ ?>
                                <input class="form-control" type="hidden" name="idCost" id="idCost" value="<?php echo "".($row->id_gasto_venta + 1).""; ?>" required="true">
                            <?php } ?>
                            <input type="text" name="addFolio" id="addFolio" class="form-control" required="true">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" type="text" name="addEmitionDate" id="addEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-12">
                            <label class = "control-label">Cliente:</label>
                            <select class="form-control" type="text" name="addClientName" id="addClientName" required="true">
                                <?php foreach ($woks->result() as $row){ ?>
                                    <option selected value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="">Concepto:</label>
                            <input type="text" id="addConcept" name="addConcept" class="form-control" required="true">
                            <input type="hidden" id="addCompany" name="addCompany" value="2">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label for="">Monto:
                            <input type="text" class="form-control" name="addAmount" id="addAmount" required="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Comentario:</label>
                            <textarea class="form-control" name="addComment" id="addComment" cols="10" rows="8"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha de pago:</label>
                            <input type="date" id="addDate" name="addDate" class="form-control" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                            <label for="">Estatus:</label>
                            <input type="text" name="addStatus" id="addStatus" class="form-control" value="Autorización Solicitada">
                            <label for="">Factura:</label>
                            <input class="form-control" name="addBill" id="addBill" type="file" accept="application/pdf" required="true">
                            
                        </div>
                    </div>
                  </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="saveCost">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancel">Cancelar</button>
            </div>

        </form>

    </div>
  </div>
</div>
<!-- end modal -->

<script type="text/javascript">
$(document).ready(function(e){
    $("#addcostSale").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Dasa/AddCostOfSale',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addcostSale').css("opacity",".5");
            },
            success: function(data){
                alert(data);
                if(data == 1){
                    $('#addcostSale')[0].reset();
                    alert('Información del costo de venta actualizada');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#addcostSale').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#addBill").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        if(!(imagefile)){
            alert('Please select a valid image file (PDF).');
            $("#addBill").val('');
            return false;
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetListCostOfSale");
  }
</script>

<script>
    function DateObtain(e)
    {
      var date = moment(e.value);
      console.log("Original Date:" + e.value);
      console.log("Out Date: " + fecha.format("YYYY/MM/DD"));
    }
</script>

<!-- modal new bill -->
<div class="modal fade" id="editCostSale"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo costo de venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="editcostSale" enctype="multipart/form-data">

          <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Folio:</label>
                             <?php foreach ($max->result() as $row){ ?>
                                <input class="form-control" type="hidden" name="idE" id="idE">
                            <?php } ?>
                            <input type="text" name="folioE" id="folioE" class="form-control" required="true">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" type="text" name="emitionDateE" id="emitionDateE" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-12">
                            <label class = "control-label">Cliente:</label>
                            <select class="form-control" type="text" name="clientNameE" id="clientNameE" required="true">
                                <?php foreach ($woks->result() as $row){ ?>
                                    <option selected value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-8">
                            <label for="">Concepto:</label>
                            <input type="text" id="conceptE" name="conceptE" class="form-control" required="true">
                            <input type="hidden" id="comanyE" name="comanyE" value="2">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label for="">Monto:
                            <input type="text" class="form-control" name="amountE" id="amountE" required="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Comentario:</label>
                            <textarea class="form-control" name="commentE" id="commentE" cols="10" rows="8"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha de pago:</label>
                            <input type="date" id="dateE" name="dateE" class="form-control" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                            <label for="">Estatus:</label>
                            <select class="form-control" id="statusE" name="statusE" required="true">
                            	<option value="Autorización Solicitada">Autorización Solicitada</option>
                            	<option value="Autorización Autorizada">Autorización Autorizada</option>
                            	<option value="Autorización Cancelada">Autorización Cancelada</option>
                            </select>
                            <label for="">Factura:</label>
                            <input class="form-control" name="billE" id="billE" type="file" accept="application/pdf">
                            
                        </div>
                    </div>
                  </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="saveCost">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="editCancel">Cancelar</button>
            </div>

        </form>

    </div>
  </div>
</div>
<!-- end modal -->

<!-- Script thats return data of an object selected -->
<script>
  function Edit_product($id){
    // alert("Editar "+$id);
    var id=$id;
    var folio=$("#bill"+$id).text();
    var emition=$("#emition"+$id).text();
    var client=$("#client"+$id).text();
    var amount=$("#amount"+$id).text();
    var concept=$("#concept"+$id).text();
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    var status=$("#status"+$id).text();
    var date=$("#date"+$id).text();

    $("#editCostSale").modal();
    $("#idE").val(id);
    $("#folioE").val(folio);
    $("#emitionDateE").val(emition);
    $("#clientNameE").val(client);
    $("#amountE").val(amount);
    $("#conceptE").val(concept);
    $("#commentE").val(comment);
    $("#billE").val(bill);
    $("#statusE").val(status);
    $("#dateE").val(date);
    }

  function Update_Page(){
    $("#page_content").load("GetListCostOfSale");
  }
</script>

<script>
$(document).ready(function(e){
    $("#editcostSale").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Dasa/EditCostOfSale',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#editcostSale').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                if(data == 1){
                    $('#editcostSale')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Información del costo de venta actualizada');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#editcostSale').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#addBill").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        if(!(imagefile)){
            alert('Please select a valid file (PDF).');
            $("#addBill").val('');
            return false;
        }else{
          //alert('imagen subida');
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetListCostOfSale");
  }
</script>

<!-- Bill display Modal -->
<div class="modal fade" id="showBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>