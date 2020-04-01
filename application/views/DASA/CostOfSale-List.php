<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Facturas de Venta</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Factura</button>
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
                        <tr><?php
                        foreach ($cost_sale->result() as $row) {?>
                            <td><?php echo "".$row->id_gasto_venta.""; ?></td>
                            <td id="<?php echo "emition".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha.""; ?></td>
                            <td id="<?php echo "client".$row->id_gasto_venta.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                            <td>$</td>
                            <td id="<?php echo "amount".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_monto.""; ?></td>
                            <td id="<?php echo "concept".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_concepto.""; ?></td>
                            <td id="<?php echo "comment".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_observacion.""; ?></td>
                            <td id="<?php echo "bill".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_factura.""; ?></td>
                            <td id="<?php echo "status".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_estado_pago.""; ?></td>
                            <td id="<?php echo "date".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha_pago.""; ?></td>
                            <td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_gasto_venta.""; ?>" data-toggle="modal" data-target="#editCostSale"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
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

<!-- modal new bill -->
<div class="modal fade" id="NewBill"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" action="<?php echo base_url(); ?>Dasa/AddCostOfSale" method="POST" id="addcostSale">

          <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="control-label">Folio:</label>
                             <?php foreach ($max->result() as $row){ ?>
                                <input class="form-control" type="number" name="addFolio" id="addFolio" value="<?php echo "".($row->id_gasto_venta + 1).""; ?>" required="true">
                            <?php } ?>
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
                            <!-- <input type="text" id="addCompany" name="addCompany" value="2"> -->
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label for="">Monto:
                            <input type="number" class="form-control" name="addAmount" id="addAmount" required="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Comentario:</label>
                            <textarea class="form-control" name="addComment" id="addComment" cols="10" rows="8"></textarea>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="">Factura:</label>
                            <input class="form-control" name="addBill" id="addBill" type="text"> -->
                            <label for="">Estatus:</label>
                            <input type="text" name="addStatus" id="addStatus" class="form-control" value="Autorización Solicitada">
                            <label for="">Fecha de pago:</label>
                            <input type="date" id="addDate" name="addDate" class="form-control" onchange="DateObtain(this)" required="true">
                            
                        </div>
                    </div>
                  </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success" id="saveCost">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
            </div>

        </form>

    </div>
  </div>
</div>
<!-- end modal -->

<!-- edit bill -->
<div class="modal fade" id="editCostSale"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="editCost" action="<?php echo base_url(); ?>Dasa/EditCostOfSale" method="POST">
      <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Folio:</label>
                         <?php foreach ($max->result() as $row){ ?>
                            <input class="form-control" type="number" name="folioE" id="folioE" value="<?php echo "".($row->id_gasto_venta + 1).""; ?>">
                        <?php } ?>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <label class="label-control">Fecha de emisión:</label>
                        <input class="form-control" type="text" name="emitionDateE" id="emitionDateE"  value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-md-12">
                        <label class = "control-label">Cliente:</label>
                        <select class="form-control" type="text" name="clientNameE" id="clientNameE" required="true">
                            <option>Seleccionar</option>
                            <?php foreach ($woks->result() as $row){ ?>
                                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="">Concepto:</label>
                        <input type="text" id="conceptE" name="conceptE" class="form-control">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <label for="">Monto:</label><input type="text" class="form-control" name="amountE" id="amountE">
                    </div>
                    <div class="col-md-6">
                        <label for="">Comentario:</label>
                        <textarea class="form-control" name="commentE" id="commentE" cols="10" rows="8"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="">Factura:</label>
                        <input class="form-control" name="billE" id="billE" type="text">
                        <label for="">Estatus:</label>
                        <input type="text" name="statusE" id="statusE" class="form-control" value="Autorización Solicitada">
                        <label for="">Fecha de pago:</label>
                        <input type="date" id="dateE" name="dateE" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                        
                    </div>
                </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success" id="updateCost">Guardar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
      </div>
                </form>
    </div>
  </div>
</div>
<!-- end modal -->

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
<script>
    function DateObtain(e)
    {

      var date = moment(e.value);
      console.log("Original Date:" + e.value);
      console.log("Out Date: " + fecha.format("YYYY/MM/DD"));
    }
</script>

<!-- script by add new costofsale -->
<script>
$(document).ready(function () {
    $("#addcostSale").bind("submit",function(){
        // Catch button of save
        var btnSend = $("#saveCost");
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
                alert(data);
                btnSend.val("Guardado");
                btnSend.removeAttr("disabled");
            },
            success: function(data){//if data is succesful show alerts
                alert(data);
                if(data==1){
                  alert('Costo de venta agregado');
                  CloseModal();
                }else{
                  alert('Falló el servidor. Costo de venta no agregado. Verifique que la información sea correcta');
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
    $("#page_content").load("GetListCostOfSale");
  }
</script>

<!-- Script thats return data of an object selected -->
<script>
  function Edit_product($id){
    // alert("Editar "+$id);
    var id=$id;
    var emition=$("#emition"+$id).text();
    var client=$("#client"+$id).text();
    var amount=$("#amount"+$id).text();
    var concept=$("#concept"+$id).text();
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    var status=$("#status"+$id).text();
    var date=$("#date"+$id).text();

    $("#editCostSale").modal();
    $("#folioE").val(id);
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

<!-- script by update cost -->
<script>
  $(document).ready(function () {
    $("#editCost").bind("submit",function(){
        // Catch button of save
        var btnSend = $("#updateCost");
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
                  alert('Información del costo de venta actualizada');
                  CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
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
    $("#page_content").load("GetListCostOfSale");
  }
</script>