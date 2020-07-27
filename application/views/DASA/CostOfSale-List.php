<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Lista de Facturas Gasto de Obra</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Gasto de Obra</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-12">
            <div class="card bg-card">
            <div class="margins">
                <div class="table-responsive-lg">
                    <table id="table_id" class="table table-striped table-hover display" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>Folio Factura</th>
                            <th>Fecha de emisión</th>
                            <th>Cliente</th>
                            <th></th>
                            <th>Monto</th>
                            <th>Concepto</th>
                            <th>Observación</th>
                            <th>Estatus</th>
                            <th>Fecha de Pago</th>
                            <th>Factura</th>
                            <th hidden="true">url_factura</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><?php
                        foreach ($cost_sale->result() as $row) {?>
                            <td  id="<?php echo "bill".$row->id_gasto_venta.""; ?>"><?php echo $row->gasto_venta_factura.""; ?></td>
                            <td id="<?php echo "emition".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha.""; ?></td>
                            <td id="<?php echo "client".$row->id_gasto_venta.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                            <td>$</td>
                            <td id="<?php echo "amount".$row->id_gasto_venta.""; ?>"><?php echo number_format($row->gasto_venta_monto, 2, '.', ',').""; ?></td>
                            <td id="<?php echo "concept".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_concepto.""; ?></td>
                            <td id="<?php echo "comment".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_observacion.""; ?></td>
                            <td id="<?php echo "status".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_estado_pago.""; ?></td>
                            <td id="<?php echo "date".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha_pago.""; ?></td>
                            <td align="center" id="<?php echo "bill".$row->id_gasto_venta.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->id_gasto_venta.""; ?>"  onclick="Display_bill(this.id)"><img src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
                             <td hidden="true" id="<?php echo "url_factura".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_url_factura.""; ?></td>
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
        <form class="form-group" id="addcostSale">

          <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                             <?php foreach ($max->result() as $row){ ?>
                            <input type="hidden" name="idCost" id="idCost" value="<?php echo "".($row->id_gasto_venta + 1).""; ?>">
                            <?php } ?>
                            <label class="control-label">Folio Factura:</label>
                                <input class="form-control" type="text" name="addFolio" id="addFolio" required="true">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input type="date" class="form-control" name="addEmitionDate" id="addEmitionDate" >
                        </div>
                        <div class="col-md-12">
                            <label class = "control-label">Cliente:</label>
                            <select class="form-control" type="text" name="addClientName" id="addClientName" required="true">
                                <option selected>Seleccionar</option>
                                <?php foreach ($woks->result() as $row){ ?>
                                    <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
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
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="addAmount" id="addAmount" required="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Comentario:</label>
                            <textarea class="form-control" name="addComment" id="addComment" cols="10" rows="8"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="">Estatus:</label>
                            <select class="form-control" id="addStatus" name="addStatus">
                                <option selected>Seleccionar</option>
                                <option value="Autorización solicitada">Autorización solicitada</option>
                                <option value="Autorización aprobada">Autorización aprobada</option>
                                <option value="Autorización cancelada">Autorización cancelada</option>
                            </select>
                            <label for="">Fecha de pago:</label>
                            <input type="date" id="addDate" name="addDate" class="form-control" onchange="DateObtain(this)" required="true" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                            <label for="">Factura:</label>
                            <input type="file" class="form-control" name="addBill" id="addBill" accept="application/pdf, image/*">
                        </div>
                    </div>
                  </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="saveCost">Guardar</button>
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
        <h5 class="modal-title" id="exampleModalLabel">Editar costo de venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="editCost">
      <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Folio Factura:</label>
                            <input class="form-control" type="text" hidden="true" name="idE" id="idE">
                        <input type="text" class="form-control" name="folioE" id="folioE">
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <label class="label-control">Fecha de emisión:</label>
                        <input class="form-control" type="date" name="emitionDateE" id="emitionDateE" >  </div>
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
                        <label for="">Monto:</label><input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="amountE" id="amountE">
                        <input type="hidden" id="Company" name="Company" value="2">
                    </div>
                    <div class="col-md-6">
                        <label for="">Comentario:</label>
                        <textarea class="form-control" name="commentE" id="commentE" cols="10" rows="8"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="">Estatus:</label>
                        <!-- <input type="text" name="statusE" id="statusE" class="form-control" value="Autorización Solicitada"> -->
                        <select class="form-control" id="statusE" name="statusE">
                            <option value="Autorización solicitada">Autorización solicitada</option>
                            <option value="Autorización aprobada">Autorización aprobada</option>
                            <option value="Autorización cancelada">Autorización cancelada</option>
                        </select>
                        <label for="">Fecha de pago:</label>
                        <input type="date" id="dateE" name="dateE" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        <label for="">Factura:</label>
                        <input type="file" class="form-control" name="billE" id="billE" accept="application/pdf, image/*">
                        
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

<!-- change format date -->
<script>
    function DateObtain(e)
    {

      var date = moment(e.value);
      console.log("Original Date:" + e.value);
      console.log("Out Date: " + date.format("YYYY/MM/DD"));
    }
</script>

<!-- script by add new costofsale -->
<script>
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
                // $('.statusMsg').html('');

                if(data){
                    $('#addcostSale')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                                alert(data);
                    alert('Costo agregado correctamente');
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
        // var match= ["*"];
        if(!(imagefile)){
            alert('Please select a valid file (PDF).');
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
    $("#idE").val(id);
    $("#folioE").val(bill);
    $("#emitionDateE").val(emition);
    $("#clientNameE option:contains("+client+")").attr('selected', true);
    $("#amountE").val(amount);
    $("#conceptE").val(concept);
    $("#commentE").val(comment);
    //$("#billE").val(bill);
    $("#statusE option:contains("+status+")").attr('selected', true);
    $("#dateE").val(date);
    }

  function Update_Page(){
    $("#page_content").load("GetListCostOfSale");
  }
</script>

<!-- script by update cost -->
<script>
  $(document).ready(function(e){
    $("#editCost").on('submit', function(e){
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
                $('#editCost').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                //alert(data);
                if(data){
                    $('#editCost')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Se modificó la información exitosamente.');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#editCost').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#billE").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        // var match= ["*"];
        if(!(imagefile)){
            alert('Please select a valid file (PDF).');
            $("#billE").val('');
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

<!-- Bill modal -->
<div class="modal fade bd-example-modal-lg" id="viewBill" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <input type="hidden" class="form-control" name="folios" id="folios">
    <div class="modal-content">
      <div style="height: 600px;">
       <iframe width="100%" height="100%" id="showbill"></iframe>
       </div>
    </div>
  </div>
</div>

<!-- view bill script -->
<script>
  function Display_bill($id){
    var invoice=$id;
    var id=$id;
    var url = "<?php echo base_url()?>"+$("#url_factura"+id).text()+"?"+Date.now();
    //alert(url);
    if(url== "<?php echo base_url()?>"){
        alert("No se adjuntó Factura");
    }else{
        $("#viewBill").modal();
        $("#folios").val(invoice);
        // $("#folios").val(id);
        $("#showbill").prop("src", url);
    }
}

function SeparaMiles($id){
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