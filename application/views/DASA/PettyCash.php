<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Listado de caja chica</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newReport"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Reporte</button>
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
                            <th>Fecha de emisión</th>
                            <th>Concepto</th>
                            <th>Tipo de movimiento</th>
                            <th></th>
                            <th>Saldo</th>
                            <th>Folio de factura</th>
                            <th>Factura/Comprobante</th>
                            <th>Fecha de Factura</th>
                            <!-- <th>Modificar</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr><?php
                        foreach ($cash->result() as $row) {?>
                            <td id="<?php echo "dateR".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_fecha.""; ?></td>
                            <td id="<?php echo "concept".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_concepto.""; ?></td>
                            <?php if ($row->lista_caja_chica_reposicion != "0"){ ?>
                            <td>Ingreso</td>
                            <td>$</td>
                            <td id="<?php echo "money".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_reposicion.""; ?></td>
                            <?php }else{ ?>
                            <td>Egreso</td>
                            <td>$</td>
                            <td id="<?php echo "money".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_gasto.""; ?></td>
                            <?php } ?>
                            <td><?php echo "".$row->lista_caja_chica_factura.""; ?></td>
                            <td align="center"><img src="<?php echo base_url(); ?>Resources/Icons/cloud-upload-symbol_icon-icons.com_56540.ico" alt="Subir Factura"></td>
                            <td id="<?php echo "dateB".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_fecha_factura.""; ?></td>
                            <!-- <td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_lista_caja_chica.""; ?>" data-toggle="modal" data-target="#editCostSale"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td> -->
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

<!-- modal new report -->
<div class="modal fade" id="newReport" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo reporte en caja chica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="addReport" action="<?php echo base_url(); ?>Dasa/AddReportPettyCash" method="POST">
      <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <label class="control-label">Caja chica</label> -->
                        <?php foreach ($max->result() as $row){ ?>
                        <input class="form-control" type="hidden" name="cashI" id="cashI" value="<?php echo "".($row->id_lista_caja_chica + 1).""; ?>">
                        <?php } ?>
                        <label class="label-control">Fecha de emisión</label>
                        <input class="form-control" type="text" name="dateI" id="dateI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        <label class = "control-label">Concepto</label>
                        <input class="form-control" type="text" name="conceptI" id="conceptI" required="true">
                    </div>

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Tipo de movimiento</label>
                                <div class="form-check">
                                  <input class="form-check-input moviment" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                  <label class="form-check-label" for="exampleRadios1">
                                    Egreso
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input moviment" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                  <label class="form-check-label" for="exampleRadios2">
                                    Ingreso
                                  </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Saldo</label>
                                <div id="tm1" style="display:;">
                                    <input class="form-control" type="text" name="moneyEI" id="moneyEI">
                                </div>
                                <div id="tm2" style="display:none;">
                                    <input class="form-control" type="text" name="moneyI" id="moneyI">
                                </div>
                            </div>
                        </div>
                        <!-- <label class="label-control">Factura/Comprobante</label> -->
                        <!-- <input class="form-control" type="hidden" name="upBillI" id="upBillI" >
                        <br>
                        <label class = "control-label">Fecha factura</label>
                        <input class="form-control" type="date" name="dateBillI" id="dateBillI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>"> -->
                    </div>                    
                </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success" id="saveReport">Guardar</button>
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

<!-- script by add new costofsale -->
<script>
$(document).ready(function () {
    $("#addReport").bind("submit",function(){
        // Catch button of save
        var btnSend = $("#saveReport");
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
                alert(data);
                if(data==1){
                  alert('Reporte de caja chica agregado');
                  CloseModal();
                }else{
                  alert('Falló el servidor. Reporte no agregado. Verifique que la información sea correcta');
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

<script type="text/javascript">
   $(document).ready(function(){
        $(".moviment").click(function(evento){
          
            var value = $(this).val();
          
            if(value == 'option1'){
                $("#tm1").css("display", "block");
                $("#tm2").css("display", "none");
            }else{
                $("#tm1").css("display", "none");
                $("#tm2").css("display", "block");
            }
    });
});
</script>