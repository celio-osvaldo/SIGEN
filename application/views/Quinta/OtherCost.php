<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-7">
        <h3 align="center">Listado de Gastos</h3>
    </div>
    <div class="col-md-4">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Registro de Gasto</button>
    </div>
</div>

<div class="card bg-card">
    <div class="margins">
     <div class="table-responsive">
        <table id="table_id" class="table table-striped table-hover display" style="font-size: 10pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                <tr>
                    <th>No. Folio</th>
                    <th>Fecha de Emisión</th>
                    <th>Concepto</th>
                    <th>Monto</th>
                           <!--
                            <th>IVA</th>
                            <th>Ret IVA</th>
                            <th>Ret ISR</th>
                            <th>IEPS</th>
                            <th>DAP</th>
                        -->
                        <th>Comentario</th>
                        <th>Fecha de Pago</th>
                        <th>Tipo Referencia</th>
                            <!--
                            <th>Aplicar a Flujo Efectivo</th>
                        -->
                        <th>Factura</th>
                        <th hidden="true">url_factura</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($expens->result() as $row) {?>
                        <tr>
                            <td id="<?php echo "bill".$row->id_OGasto.""; ?>"><?php echo "".$row->folio.""; ?></td>
                            <td id="<?php echo "emition".$row->id_OGasto.""; ?>"><?php echo "".$row->fecha_emision.""; ?></td>
                            <td id="<?php echo "concept".$row->id_OGasto.""; ?>"><?php echo "".$row->concepto.""; ?></td>
                            <td id="<?php echo "expend".$row->id_OGasto.""; ?>">$<?php echo number_format($row->saldo,2,'.',',').""; ?></td>

<!--
                        <td id="<?php echo "iva".$row->id_OGasto.""; ?>">$<?php echo number_format($row->otros_gastos_iva,2,'.',','); ?></td>
                        <td id="<?php echo "ret_iva".$row->id_OGasto.""; ?>">$<?php echo number_format($row->otros_gastos_iva_ret,2,'.',','); ?></td>
                        <td id="<?php echo "ret_isr".$row->id_OGasto.""; ?>">$<?php echo number_format($row->otros_gastos_isr_ret,2,'.',','); ?></td>
                        <td id="<?php echo "ieps".$row->id_OGasto.""; ?>">$<?php echo number_format($row->otros_gastos_ieps,2,'.',','); ?></td>
                        <td id="<?php echo "dap".$row->id_OGasto.""; ?>">$<?php echo number_format($row->otros_gastos_dap,2,'.',','); ?></td>
                    -->
                    <td id="<?php echo "comment".$row->id_OGasto.""; ?>"><?php echo "".$row->comentario.""; ?></td>
                    <td id="<?php echo "dateEx".$row->id_OGasto.""; ?>"><?php echo "".$row->fecha_pago_factura.""; ?></td>
                    <td id="<?php echo "tipo_ref".$row->id_OGasto.""; ?>"><?php echo "".$row->otros_gastos_referencia.""; ?></td>
<!--
                            <td id="<?php echo "aplica_flujo".$row->id_OGasto; ?>">
                               <?php if ($row->otros_gastos_aplica_flujo=="1"): ?>
                                   <img src="<?php echo base_url() ?>Resources/Icons/paloma.ico">
                                   <label hidden="true">1</label>
                               <?php endif?>
                               <?php if ($row->otros_gastos_aplica_flujo=="0"): ?>
                                   <img src="<?php echo base_url() ?>Resources/Icons/tacha.ico">
                                   <label hidden="true">0</label>
                               <?php endif?>
                                
                            </td>
                        -->
                        <td align="center" id="<?php echo "factura".$row->id_OGasto.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->id_OGasto.""; ?>"  onclick="Display_bill(this.id)"><img height="20" src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
                        <td hidden="true" id="<?php echo "url_factura".$row->id_OGasto.""; ?>"><?php echo $row->factura ?></td>
                        <td>
                            <div class="row">
                                <a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_OGasto.""; ?>" data-toggle="modal" data-target="#editCostSale"><img height="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                                <a role="button" class="btn btn-outline-dark" onclick="Delete_pago(this.id)" id="<?php echo "".$row->id_OGasto.""; ?>" data-toggle="modal" data-target="#deleteCostSale"><img height="20" src="..\Resources\Icons\delete.ico" alt="Eliminar" style="filter: invert(100%)" /></a>
                            </div>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<!-- modal new bill -->
<div class="modal fade" id="NewBill"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro de Gasto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="newExpend">

          <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id">
                            <label class="label-control">Folio Factura/Comprobante:</label>
                            <input class="form-control" type="text" name="addFolio" id="addFolio" value="" required="true">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" type="date" name="addEmitionDate" id="addEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-3">
                            <label for="">Fecha de pago:</label>
                            <input type="date" id="addDate" name="addDate" class="form-control" onchange="DateObtain(this)" required="true" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>
<!--
                        <div class=" col-md-4">
                            <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                            <select class="form-control" id="add_flujo" name="add_flujo">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
-->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Concepto:</label>
                            <input type="text" maxlength="200" id="addConcept" name="addConcept" class="form-control" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Monto</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="addAmount" id="addAmount" required="true">
                        </div>
<!--
                        <div class="col-md-3">
                            <label class="label-control">IVA</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="add_iva" id="add_iva" required="true" value="0.00">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">Ret IVA</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="add_ret_iva" id="add_ret_iva" required="true" value="0.00">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">Ret ISR</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="add_ret_isr" id="add_ret_isr" required="true" value="0.00">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">IEPS</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="add_ieps" id="add_ieps" required="true" value="0.00">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">DAP</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="add_dap" id="add_dap" required="true" value="0.00">
                        </div>
-->

                        <div class="col-md-3">
                            <label class="label-control">Referencia:</label>
                            <select id="add_ref" name="add_ref" class="form-control">
                                <option value="Transferencia" selected="true">Transferencia</option>
                                <option value="Deposito_cheque">Depósito en Cheque</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="label-control">Comentario:</label>
                            <textarea class="form-control" id="addComment" name="addComment" cols="6" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-8">
                            <label class="label-control">Comprobante:</label>
                            <input type="file" class="form-control" name="addBill" id="addBill" accept="application/pdf, image/*">
                        </div>                            
                    </div>


                  </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="saveCost">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" >Cancelar</button>
            </div>

        </form>

    </div>
  </div>
</div>
<!-- end modal -->


<div class="modal fade" id="editCostSale"data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Actualizar Registro de Pago</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" id="editCost">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="idE" id="idE">
                            <label class="control-label">Folio Factura/Comprobante:</label>
                            <input class="form-control" type="text" name="editFolio" id="editFolio" value="" required="true">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" type="date" name="editEmitionDate" id="editEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-3">
                            <label for="">Fecha de pago:</label>
                            <input type="date" id="editDate" name="editDate" class="form-control" onchange="DateObtain(this)" required="true" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>
<!--
            <div class=" col-md-4">
                <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                <select class="form-control" id="edit_flujo" name="edit_flujo">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
        -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Concepto:</label>
                            <input type="text" id="editConcept" name="editConcept" class="form-control" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Monto</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="editAmount" id="editAmount" required="true">
                        </div>
<!--
            <div class="col-md-3">
                <label class="label-control">IVA</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_iva" id="edit_iva" required="true">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret IVA</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_iva" id="edit_ret_iva" required="true">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret ISR</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_isr" id="edit_ret_isr" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">IEPS</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ieps" id="edit_ieps" required="true">
            </div>
            <div class="col-md-2">
                <label class="label-control">DAP</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_dap" id="edit_dap" required="true">
            </div>
        -->

                        <div class="col-md-4">
                            <label class="label-control">Referencia:</label>
                            <select id="edit_ref" name="edit_ref" class="form-control">
                                <option value="Transferencia" selected="true">Transferencia</option>
                                <option value="Deposito_cheque">Depósito en Cheque</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                                <label class="label-control">Comentario:</label>
                                <textarea class="form-control" id="editComment" name="editComment" cols="6" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <label class="label-control">Comprobante:</label>
                            <input type="file" class="form-control" name="editBill" id="editBill" accept="application/pdf, image/*">
                        </div>                            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success submitBtn" id="updateCost">Actualizar</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit bill -->
<!-- end modal -->


<!--Delete Registro-->

<div class="modal fade" id="deleteCostSale"data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: red">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro de Gasto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" id="deleteCost">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="hidden" name="delete_idE" id="delete_idE">
                            <label class="control-label">Folio Factura/Comprobante:</label>
                            <input class="form-control" disabled="true" type="text" name="delete_Folio" id="delete_Folio" value="" required="true">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" disabled="true" type="date" name="delete_EmitionDate" id="delete_EmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-3">
                            <label for="">Fecha de pago:</label>
                            <input type="date" disabled="true" id="delete_Date" name="delete_Date" class="form-control" onchange="DateObtain(this)" required="true" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>
<!--
            <div class=" col-md-4">
                <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                <select class="form-control" id="edit_flujo" name="edit_flujo">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
        -->
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Concepto:</label>
                            <input disabled="true" type="text" id="delete_Concept" name="delete_Concept" class="form-control" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Monto</label>
                            <input disabled="true" type="text" onblur="SeparaMiles(this.id)" class="form-control" name="delete_Amount" id="delete_Amount" required="true">
                        </div>
<!--
            <div class="col-md-3">
                <label class="label-control">IVA</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_iva" id="edit_iva" required="true">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret IVA</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_iva" id="edit_ret_iva" required="true">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret ISR</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_isr" id="edit_ret_isr" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">IEPS</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ieps" id="edit_ieps" required="true">
            </div>
            <div class="col-md-2">
                <label class="label-control">DAP</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_dap" id="edit_dap" required="true">
            </div>
        -->

                        <div class="col-md-4">
                            <label class="label-control">Referencia:</label>
                            <select disabled="true" id="delete_ref" name="delete_ref" class="form-control">
                                <option value="Transferencia" selected="true">Transferencia</option>
                                <option value="Deposito_cheque">Depósito en Cheque</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                                <label class="label-control">Comentario:</label>
                                <textarea disabled="true" class="form-control" id="delete_Comment" name="delete_Comment" cols="6" rows="2"></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success submitBtn" >Eliminar</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit bill -->
<!-- end modal -->



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
<!-- end modal -->

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>


<!-- change format date script -->
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
    $("#newExpend").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Quinta/AddNewExpend',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#newExpend').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                //alert(data);
                if(data == 1){
                    $('#newExpend')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Reporte de gasto agregado correctamente');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#newExpend').css("opacity","");
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
            alert('Seleccione un archivo válido (PDF).');
            $("#addBill").val('');
            return false;
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("OtherExpens");
  }
</script>

<!-- Script thats return data of an object selected -->
<script>
  function Edit_product($id){
    // alert("Editar "+$id);
    var id=$id;
    var enviroment=$("#bill"+$id).text();
    var emition=$("#emition"+$id).text();
    var concept=$("#concept"+$id).text();
    var expend=$("#expend"+$id).text().split('$');
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    var dateEx=$("#dateEx"+$id).text();
/*    
    var edit_flujo=$("#aplica_flujo"+id).text().trim();;
    if(edit_flujo==0){
        edit_flujo="NO";
    }else{
        edit_flujo="SI";
    }

    var iva=$("#iva"+id).text().split("$");
    var ret_iva=$("#ret_iva"+id).text().split("$");
    var ret_isr=$("#ret_isr"+id).text().split("$");
    var ieps=$("#ieps"+id).text().split("$");
    var dap=$("#dap"+id).text().split("$");
*/
    var tipo_ref=$("#tipo_ref"+id).text();
        //alert(edit_flujo);

    $("#editCostSale").modal();
    $("#idE").val(id);
    $("#editFolio").val(enviroment);
    $("#editEmitionDate").val(emition);
    $("#editConcept").val(concept);
    $("#editAmount").val(expend[1]);
    $("#editComment").val(comment);
    $("#editDate").val(dateEx);
    //$("#edit_flujo option:contains("+edit_flujo+")").attr('selected', true);
    //$("#edit_iva").val(iva[1]);
    //$("#edit_ret_iva").val(ret_iva[1]);
    //$("#edit_ret_isr").val(ret_isr[1]);
    //$("#edit_ieps").val(ieps[1]);
    $//("#edit_dap").val(dap[1]);
    $("#edit_ref").val(tipo_ref).attr('selected',true);

   // $("#editBill").val(enviroment);
    }

  function Delete_pago($id){
    // alert("Editar "+$id);
    var id=$id;
    var enviroment=$("#bill"+$id).text();
    var emition=$("#emition"+$id).text();
    var concept=$("#concept"+$id).text();
    var expend=$("#expend"+$id).text().split('$');
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    var dateEx=$("#dateEx"+$id).text();
/*
    var edit_flujo=$("#aplica_flujo"+id).text().trim();;
    if(edit_flujo==0){
        edit_flujo="NO";
    }else{
        edit_flujo="SI";
    }

    var iva=$("#iva"+id).text().split("$");
    var ret_iva=$("#ret_iva"+id).text().split("$");
    var ret_isr=$("#ret_isr"+id).text().split("$");
    var ieps=$("#ieps"+id).text().split("$");
    var dap=$("#dap"+id).text().split("$");
*/
    var tipo_ref=$("#tipo_ref"+id).text();
        //alert(edit_flujo);

    $("#deleteCostSale").modal();
    $("#delete_idE").val(id);
    $("#delete_Folio").val(enviroment);
    $("#delete_EmitionDate").val(emition);
    $("#delete_Concept").val(concept);
    $("#delete_Amount").val(expend[1]);
    $("#delete_Comment").val(comment);
    $("#delete_Date").val(dateEx);
    //$("#edit_flujo option:contains("+edit_flujo+")").attr('selected', true);
    //$("#edit_iva").val(iva[1]);
    //$("#edit_ret_iva").val(ret_iva[1]);
    //$("#edit_ret_isr").val(ret_isr[1]);
    //$("#edit_ieps").val(ieps[1]);
    $//("#edit_dap").val(dap[1]);
    $("#delete_ref").val(tipo_ref).attr('selected',true);

   // $("#editBill").val(enviroment);
    }

  function Update_Page(){
    $("#page_content").load("OtherExpens");
  }
</script>

<!-- script by update cost -->
<script>
  $(document).ready(function(e){
    $("#editCost").on('submit', function(e){
        e.preventDefault();
        //fecha=$("#editDate").val();
        //fecha2=$("#editEmitionDate").val();
        //alert(fecha+" "+fecha2);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Quinta/UpdateExpend',
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
                if(data == 1){
                    $('#editCost')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Reporte de gasto modificado correctamente');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#editCost').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });


    $("#deleteCost").on('submit', function(e){
        e.preventDefault();
        //fecha=$("#editDate").val();
        //fecha2=$("#editEmitionDate").val();
        //alert(fecha+" "+fecha2);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Quinta/DeleteExpend',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#deleteCost').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                //alert(data);
                if(data == 1){
                    $('#deleteCost')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Reporte de gasto Eliminado correctamente');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#deleteCost').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#editBill").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        // var match= ["*"];
        if(!(imagefile)){
            alert('Seleccione un archivo válido (PDF).');
            $("#editBill").val('');
            return false;
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("OtherExpens");
  }
</script>

<!-- view bill script -->
<script>
  function Display_bill($id){
    var url="<?php echo base_url()?>"+$("#url_factura"+$id).text()+"?"+Date.now();
    var verifica=url.split("?");
    //alert(verifica[1]);
    if(verifica[0]!="<?php echo base_url()?>"){
         $("#viewBill").modal();
       // $("#folios").val(invoice);
        // $("#folios").val(id);
        $("#showbill").prop("src", url);
    }else{
        alert("No se adjuntó factura/comprobante");
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