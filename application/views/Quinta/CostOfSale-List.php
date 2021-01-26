<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Lista de Gasto de Eventos</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Gasto de Evento</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="card bg-card">
    <div class="margins">
       <div class="table-responsive">
        <table id="table_id" class="table table-striped table-hover display" style="font-size: 9pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                <tr>
                <th>Folio Factura</th>
                    <th>Fecha de Emisión</th>
                    <th>Evento</th>
                    <th>Monto</th>
            <!--
                    <th>IVA</th>
                    <th>Ret IVA</th>
                    <th>Ret ISR</th>
                    <th>IEPS</th>
                    <th>DAP</th>
                -->
                    <th>Concepto</th>
                    <th>Comentarios</th>
            <!--
                    <th>Estatus</th>
            -->
                    <th>Fecha de Pago</th>
                    <th>Tipo Referencia</th>
            <!--       <th>Aplicar a Flujo Efectivo</th> -->
                    <th>Factura</th>
                    <th hidden="true">url_factura</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($cost_sale->result() as $row) {?>
                    <tr>
                    <td  id="<?php echo "bill".$row->id_gasto_venta.""; ?>"><?php echo $row->gasto_venta_factura.""; ?></td>
                    <td id="<?php echo "emition".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha.""; ?></td>
                    <td id="<?php echo "client".$row->id_gasto_venta.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                    <td id="<?php echo "amount".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_monto, 2, '.', ',').""; ?></td>
<!--
                    <td id="<?php echo "iva".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_iva,2,'.',','); ?></td>
                    <td id="<?php echo "ret_iva".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_iva_ret,2,'.',','); ?></td>
                    <td id="<?php echo "ret_isr".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_isr_ret,2,'.',','); ?></td>
                    <td id="<?php echo "ieps".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_ieps,2,'.',','); ?></td>
                    <td id="<?php echo "dap".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_dap,2,'.',','); ?></td>
-->
                    <td id="<?php echo "concept".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_concepto.""; ?></td>
                    <td id="<?php echo "comment".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_observacion.""; ?></td>
                    
<!--                    <td id="<?php echo "status".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_estado_pago.""; ?></td>
-->
                    <td id="<?php echo "date".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha_pago.""; ?></td>
                    <td id="<?php echo "tipo_ref".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_referencia.""; ?></td>

<!--                    <td id="<?php echo "aplica_flujo".$row->id_gasto_venta; ?>">
                     <?php if ($row->gasto_venta_aplica_flujo=="1"): ?>
                         <img src="<?php echo base_url() ?>Resources/Icons/paloma.ico">
                         <label hidden="true">1</label>
                     <?php endif?>
                     <?php if ($row->gasto_venta_aplica_flujo=="0"): ?>
                         <img src="<?php echo base_url() ?>Resources/Icons/tacha.ico">
                         <label hidden="true">0</label>
                     <?php endif?>

                 </td>
-->
                 <td align="center" id="<?php echo "bill".$row->id_gasto_venta.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->id_gasto_venta.""; ?>"  onclick="Display_bill(this.id)"><img width="20px" src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico"  style="filter: invert(100%)"></a></td>
                 <td hidden="true" id="<?php echo "url_factura".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_url_factura.""; ?></td>
                 <td>
                    <a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_gasto_venta.""; ?>" data-toggle="modal" data-target="#editCostSale"><img width="20px" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                     <a role="button" class="btn btn-outline-dark" onclick="Delete_pago(this.id)" id="<?php echo "".$row->id_gasto_venta.""; ?>" data-toggle="modal" data-target="#deletenomina"><img height="20" src="..\Resources\Icons\delete.ico" alt="Eliminar" style="filter: invert(100%)" /></a>
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
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Gasto</h5>
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
        <label class="control-label">Folio Factura/Nota:</label>
        <input class="form-control" type="text" name="addFolio" id="addFolio" required="true">
    </div>
    <div class="col-md-4">
        <label class="label-control">Fecha de emisión:</label>
        <input type="date" class="form-control" name="addEmitionDate" id="addEmitionDate" >
    </div>
    <div class="col-md-5">
        <label class = "control-label">Evento:</label>
        <select class="form-control" type="text" name="addClientName" id="addClientName" required="true">
            <option selected disabled="true">---Seleccionar Evento---</option>
            <?php foreach ($woks->result() as $row){ ?>
                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
            <?php } ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-9">
        <label for="">Concepto de Gasto:</label>
        <input maxlength="200" type="text" id="addConcept" name="addConcept" class="form-control" required="true">
        <input type="hidden" id="addCompany" name="addCompany" value="2">
    </div>

    <div class="col-md-3">
        <label class="label-control">Monto</label>
        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="addAmount" id="addAmount" required="true">
    </div>
</div>
<!--

                        <div class="col-md-4">
                            <label class="label-control">Estatus:</label>
                            <select class="form-control" id="addStatus" name="addStatus">
                                <option selected>Seleccionar</option>
                                <option value="Autorización solicitada">Autorización solicitada</option>
                                <option value="Autorización aprobada">Autorización aprobada</option>
                                <option value="Autorización cancelada">Autorización cancelada</option>
                            </select>
                        </div>
                        <div class=" col-md-4">
                            <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                            <select class="form-control" id="addflujo" name="addflujo">
                                <option value="1">SI</option>
                                <option value="0">NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <label class="label-control">IVA</label>
                            <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="add_iva" id="add_iva" required="true" value="0.00000">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">Ret IVA</label>
                            <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="add_ret_iva" id="add_ret_iva" required="true" value="0.00000">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">Ret ISR</label>
                            <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="add_ret_isr" id="add_ret_isr" required="true" value="0.00000">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">IEPS</label>
                            <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="add_ieps" id="add_ieps" required="true" value="0.00000">
                        </div>
                        <div class="col-md-3">
                            <label class="label-control">DAP</label>
                            <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="add_dap" id="add_dap" required="true" value="0.00000">
                        </div>
                    -->
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Fecha de pago:</label>
                            <input type="date" id="addDate" name="addDate" class="form-control" onchange="DateObtain(this)" required="true" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>
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
                            <textarea class="form-control" name="addComment" id="addComment" cols="6" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label class="label-control">Factura:</label>
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
                        <div class="col-md-2">
                            <label class="control-label">Folio Factura:</label>
                            <input class="form-control" type="text" hidden="true" name="idE" id="idE">
                            <input type="text" class="form-control" name="folioE" id="folioE">
                        </div>
                        <div class="col-md-4">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" type="date" name="emitionDateE" id="emitionDateE" >
                        </div>
                        <div class="col-md-6">
                            <label class = "control-label">Cliente:</label>
                            <select class="form-control" type="text" name="clientNameE" id="clientNameE" required="true">
                                <option>Seleccionar</option>
                                <?php foreach ($woks->result() as $row){ ?>
                                    <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-9">
                            <label for="">Concepto:</label>
                            <textarea id="conceptE" name="conceptE" class="form-control"></textarea>
                        </div>

    <!--
                    <div class="col-md-4">
                        <label for="">Estatus:</label>
                         <input type="text" name="statusE" id="statusE" class="form-control" value="Autorización Solicitada"> 
                        <select class="form-control" id="statusE" name="statusE">
                            <option value="Autorización solicitada">Autorización solicitada</option>
                            <option value="Autorización aprobada">Autorización aprobada</option>
                            <option value="Autorización cancelada">Autorización cancelada</option>
                        </select>
                    </div>
                    <div class=" col-md-4">
                        <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                        <select class="form-control" id="editflujo" name="editflujo">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                -->

                        <div class="col-md-3">
                            <label for="">Monto:</label><input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="amountE" id="amountE">
                        </div>
                    </div>

    <!--
                     <div class="col-md-3">
                        <label class="label-control">IVA</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_iva" id="edit_iva" required="true" >
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Ret IVA</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_iva" id="edit_ret_iva" required="true" >
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Ret ISR</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_isr" id="edit_ret_isr" required="true" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="label-control">IEPS</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ieps" id="edit_ieps" required="true" >
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">DAP</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_dap" id="edit_dap" required="true" >
                    </div>
                -->
                    <div class="row">
                        <div class="col-md-3">
                           <label for="">Fecha de pago:</label>
                           <input type="date" id="dateE" name="dateE" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="label-control">Referencia:</label>
                            <select id="edit_ref" name="edit_ref" class="form-control">
                                <option value="Transferencia">Transferencia</option>
                                <option value="Deposito_cheque">Depósito en Cheque</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="">Comentario:</label>
                            <textarea class="form-control" name="commentE" id="commentE" cols="10" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <label for="">Factura:</label>
                            <input type="file" class="form-control" name="billE" id="billE" accept="application/pdf, image/*">
                        </div>                            
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success" id="updateCost">Actualizar</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end modal -->





<!-- Delete bill -->
<div class="modal fade" id="deleteCostSale"data-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: red">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar costo de venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-group" id="deleteCost">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label">Folio Factura:</label>
                            <input class="form-control" type="text" hidden="true" name="deleteidE" id="deleteidE">
                            <input disabled="true" type="text" class="form-control" name="deletefolioE" id="deletefolioE">
                        </div>
                        <div class="col-md-4">
                            <label class="label-control">Fecha de emisión:</label>
                            <input disabled="true" class="form-control" type="date" name="deleteemitionDateE" id="deleteemitionDateE" >
                        </div>
                        <div class="col-md-6">
                            <label class = "control-label">Cliente:</label>
                            <select disabled="true" class="form-control" type="text" name="deleteclientNameE" id="deleteclientNameE" required="true">
                                <option>Seleccionar</option>
                                <?php foreach ($woks->result() as $row){ ?>
                                    <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-9">
                            <label for="">Concepto:</label>
                            <textarea disabled="true" id="deleteconceptE" name="deleteconceptE" class="form-control"></textarea>
                        </div>

    <!--
                    <div class="col-md-4">
                        <label for="">Estatus:</label>
                         <input type="text" name="statusE" id="statusE" class="form-control" value="Autorización Solicitada"> 
                        <select class="form-control" id="statusE" name="statusE">
                            <option value="Autorización solicitada">Autorización solicitada</option>
                            <option value="Autorización aprobada">Autorización aprobada</option>
                            <option value="Autorización cancelada">Autorización cancelada</option>
                        </select>
                    </div>
                    <div class=" col-md-4">
                        <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                        <select class="form-control" id="editflujo" name="editflujo">
                            <option value="1">SI</option>
                            <option value="0">NO</option>
                        </select>
                    </div>
                -->

                        <div class="col-md-3">
                            <label for="">Monto:</label>
                            <input disabled="true" type="text" onblur="SeparaMiles(this.id)" class="form-control" name="deleteamountE" id="deleteamountE">
                        </div>
                    </div>

    <!--
                     <div class="col-md-3">
                        <label class="label-control">IVA</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_iva" id="edit_iva" required="true" >
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Ret IVA</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_iva" id="edit_ret_iva" required="true" >
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Ret ISR</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ret_isr" id="edit_ret_isr" required="true" >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="label-control">IEPS</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_ieps" id="edit_ieps" required="true" >
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">DAP</label>
                        <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_dap" id="edit_dap" required="true" >
                    </div>
                -->
                    <div class="row">
                        <div class="col-md-3">
                           <label for="">Fecha de pago:</label>
                           <input disabled="true" type="date" id="deletedateE" name="deletedateE" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="label-control">Referencia:</label>
                            <select disabled="true" id="edeleteref" name="deleteref" class="form-control">
                                <option value="Transferencia">Transferencia</option>
                                <option value="Deposito_cheque">Depósito en Cheque</option>
                                <option value="Efectivo">Efectivo</option>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label for="">Comentario:</label>
                            <textarea disabled="true" class="form-control" name="deletecommentE" id="deletecommentE" cols="10" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-success" >Eliminar</button>
                    <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
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
            url: '<?php echo base_url(); ?>Quinta/AddCostOfSale',
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
                               // alert(data);
                    alert('Gasto agregado correctamente');
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
            alert('Seleccione un archivo válido(PDF).');
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
    var amount=$("#amount"+$id).text().split('$');
    var concept=$("#concept"+$id).text();
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    //var status=$("#status"+$id).text();
    var date=$("#date"+$id).text();

    /*var editflujo=$("#aplica_flujo"+id).text().trim();
    if(editflujo==0){
        editflujo="NO";
    }else{
        editflujo="SI";
    }
    var iva=$("#iva"+id).text().split("$");
    var ret_iva=$("#ret_iva"+id).text().split("$");
    var ret_isr=$("#ret_isr"+id).text().split("$");
    var ieps=$("#ieps"+id).text().split("$");
    var dap=$("#dap"+id).text().split("$");
    */
    var tipo_ref=$("#tipo_ref"+id).text();

//alert(tipo_ref);
    if(tipo_ref==""||tipo_ref=="Tranferencia"){
        tipo_ref="Transferencia";
        //alert("entró");
    }


    $("#editCostSale").modal();
    $("#idE").val(id);
    $("#folioE").val(bill);
    $("#emitionDateE").val(emition);
    $("#clientNameE option:contains("+client+")").attr('selected', true);
    //$("#editflujo option:contains("+editflujo+")").attr('selected', true);
    $("#amountE").val(amount[1]);
    $("#conceptE").val(concept);
    $("#commentE").val(comment);
    //$("#billE").val(bill);
    //$("#statusE option:contains("+status+")").attr('selected', true);
    $("#dateE").val(date);

    //$("#edit_iva").val(iva[1]);
    //$("#edit_ret_iva").val(ret_iva[1]);
    //$("#edit_ret_isr").val(ret_isr[1]);
    //$("#edit_ieps").val(ieps[1]);
    //$("#edit_dap").val(dap[1]);
    $("#edit_ref").val(tipo_ref).attr('selected',true);
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
            url: '<?php echo base_url(); ?>Quinta/EditCostOfSale',
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
    
        $("#deleteCost").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Quinta/DeleteCostOfSale',
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
                if(data){
                    $('#deleteCost')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Registro eliminado exitosamente.');
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
    $("#billE").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        // var match= ["*"];
        if(!(imagefile)){
            alert('Seleccione un archivo válido (PDF).');
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
    url_verifica=url.split("?");
    //alert(url_verifica[0]);
    if(url_verifica[0]=="<?php echo base_url()?>"){
        alert("No se adjuntó Factura");
    }else{
        $("#viewBill").modal();
        $("#folios").val(invoice);
        // $("#folios").val(id);
        $("#showbill").prop("src", url);
    }
}

  function Delete_pago($id){
    // alert("Editar "+$id);
    var id=$id;
    var emition=$("#emition"+$id).text();
    var client=$("#client"+$id).text();
    var amount=$("#amount"+$id).text().split('$');
    var concept=$("#concept"+$id).text();
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    //var status=$("#status"+$id).text();
    var date=$("#date"+$id).text();

    /*var editflujo=$("#aplica_flujo"+id).text().trim();
    if(editflujo==0){
        editflujo="NO";
    }else{
        editflujo="SI";
    }
    var iva=$("#iva"+id).text().split("$");
    var ret_iva=$("#ret_iva"+id).text().split("$");
    var ret_isr=$("#ret_isr"+id).text().split("$");
    var ieps=$("#ieps"+id).text().split("$");
    var dap=$("#dap"+id).text().split("$");
    */
    var tipo_ref=$("#tipo_ref"+id).text();

//alert(tipo_ref);
    if(tipo_ref==""||tipo_ref=="Tranferencia"){
        tipo_ref="Transferencia";
        //alert("entró");
    }


    $("#deleteCostSale").modal();
    $("#deleteidE").val(id);
    $("#deletefolioE").val(bill);
    $("#deleteemitionDateE").val(emition);
    $("#deleteclientNameE option:contains("+client+")").attr('selected', true);
    //$("#editflujo option:contains("+editflujo+")").attr('selected', true);
    $("#deleteamountE").val(amount[1]);
    $("#deleteconceptE").val(concept);
    $("#deletecommentE").val(comment);
    //$("#billE").val(bill);
    //$("#statusE option:contains("+status+")").attr('selected', true);
    $("#deletedateE").val(date);

    //$("#edit_iva").val(iva[1]);
    //$("#edit_ret_iva").val(ret_iva[1]);
    //$("#edit_ret_isr").val(ret_isr[1]);
    //$("#edit_ieps").val(ieps[1]);
    //$("#edit_dap").val(dap[1]);
    $("#deleteref").val(tipo_ref).attr('selected',true);
    }


</script>