

<script src="..\assets\multiple-select-1.5.2\dist\multiple-select.min.js"></script>
<link rel="stylesheet" type="text/css" href="..\assets\multiple-select-1.5.2\dist\multiple-select.min.css">



<div class="row">
  <div class="col-md-8">
    <h3 align="center">Lista de Costo de Venta</h3>
  </div>
  <div class="col-md-4" align="right">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Costo</button>
  </div>
</div>


<div class="row">
    <div class="form-group row">
        <label class="col-md-7">
          Mostrar/Ocultar Columnas
        </label>
    <div class="col-md-4">
      <select multiple="multiple" class="multiple-select" id="muestra_oculta" placeholder="Seleccione Columna">
          <option value="0">Folio Factura</option>
          <option value="1">Fecha de Emisión</option>
          <option value="2">Cliente</option>
          <option value="3">Monto</option>
          <option value="4">IVA</option>
          <option value="5">Ret IVA</option>
          <option value="6">Ret ISR</option>
          <option value="7">IEPS</option>
          <option value="8">DAP</option>
          <option value="9">Concepto</option>
          <option value="10">Observación</option>
          <option value="11">Estatus</option>
          <option value="12">Fecha de Pago</option>
          <option value="13">Referencia</option>
          <option value="14">Factura</option>
          <option value="15">Modificar</option>
      </select>
    </div>
  </div>
</div>




<div class="card bg-card">
    <div class="margins">
     <div class="table-responsive">
        <table id="table_id" class="table table-striped table-hover display" style="font-size: 8pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                <tr>
                    <th>Folio Factura</th>
                    <th>Fecha de Emisión</th>
                    <th>Cliente</th>
                    <th>Monto</th>
                    <th>IVA</th>
                    <th>Ret IVA</th>
                    <th>Ret ISR</th>
                    <th>IEPS</th>
                    <th>DAP</th>
                    <th>Concepto</th>
                    <th>Observación</th>
                    <th>Estatus</th>
                    <th>Fecha de Pago</th>
                    <th>Tipo Referencia</th>
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
                    <td id="<?php echo "amount".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_monto, 5, '.', ',').""; ?></td>

                    <td id="<?php echo "iva".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_iva,5,'.',','); ?></td>
                    <td id="<?php echo "ret_iva".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_iva_ret,5,'.',','); ?></td>
                    <td id="<?php echo "ret_isr".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_isr_ret,5,'.',','); ?></td>
                    <td id="<?php echo "ieps".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_ieps,5,'.',','); ?></td>
                    <td id="<?php echo "dap".$row->id_gasto_venta.""; ?>">$<?php echo number_format($row->gasto_venta_dap,5,'.',','); ?></td>

                    <td id="<?php echo "concept".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_concepto.""; ?></td>
                    <td id="<?php echo "comment".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_observacion.""; ?></td>
                    <td id="<?php echo "status".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_estado_pago.""; ?></td>
                    <td id="<?php echo "date".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_fecha_pago.""; ?></td>
                    <td id="<?php echo "tipo_ref".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_referencia.""; ?></td>
                    <td align="center" id="<?php echo "bill".$row->id_gasto_venta.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->id_gasto_venta.""; ?>"  onclick="Display_bill(this.id)"><img width="20px" src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
                    <td hidden="true" id="<?php echo "url_factura".$row->id_gasto_venta.""; ?>"><?php echo "".$row->gasto_venta_url_factura.""; ?></td>
                    <td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_gasto_venta.""; ?>" data-toggle="modal" data-target="#editCostSale"><img width="20px" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<br>
</div>
</div>

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
                        <div class="col-md-2">
                             <?php foreach ($max->result() as $row){ ?>
                            <input type="hidden" name="idCost" id="idCost" value="<?php echo "".($row->id_gasto_venta + 1).""; ?>">
                            <?php } ?>
                            <label class="control-label">Folio Factura:</label>
                                <input class="form-control" type="text" name="addFolio" id="addFolio" required="true">
                        </div>
                        <div class="col-md-4">
                            <label class="label-control">Fecha de emisión:</label>
                            <input type="date" class="form-control" name="addEmitionDate" id="addEmitionDate" >
                        </div>
                        <div class="col-md-6">
                            <label class = "control-label">Cliente:</label>
                            <select class="form-control" type="text" name="addClientName" id="addClientName" required="true">
                                <option selected>Seleccionar</option>
                                <?php foreach ($works->result() as $row){ ?>
                                    <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Concepto:</label>
                            <input type="text" id="addConcept" name="addConcept" class="form-control" required="true">
                            <input type="hidden" id="addCompany" name="addCompany" value="2">
                        </div>
                        <div class="col-md-6">
                            <label for="">Estatus:</label>
                            <select class="form-control" id="addStatus" name="addStatus">
                                <option selected>Seleccionar</option>
                                <option value="Autorización solicitada">Autorización solicitada</option>
                                <option value="Autorización aprobada">Autorización aprobada</option>
                                <option value="Autorización cancelada">Autorización cancelada</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Monto</label>
                            <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="addAmount" id="addAmount" required="true">
                        </div>
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
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="label-control">Comentario:</label>
                            <textarea class="form-control" name="addComment" id="addComment" cols="6" rows="2"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="label-control">Factura:</label>
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
                        <?php foreach ($works->result() as $row){ ?>
                            <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="">Concepto:</label>
                    <input type="text" id="conceptE" name="conceptE" class="form-control">
                </div>
                <div class="col-md-6">
                    <label for="">Estatus:</label>
                    <!-- <input type="text" name="statusE" id="statusE" class="form-control" value="Autorización Solicitada"> -->
                    <select class="form-control" id="statusE" name="statusE">
                        <option value="Autorización solicitada">Autorización solicitada</option>
                        <option value="Autorización aprobada">Autorización aprobada</option>
                        <option value="Autorización cancelada">Autorización cancelada</option>
                    </select>
                </div>
            </div>
                <div class="row">
                    <div class="col-md-3">
                     <label for="">Monto:</label><input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="amountE" id="amountE">
                 </div>
                 <div class="col-md-3">
                    <label class="label-control">IVA</label>
                    <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_iva" id="edit_iva" required="true" >
                </div>
                <div class="col-md-3">
                    <label class="label-control">Ret IVA</label>
                    <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_ret_iva" id="edit_ret_iva" required="true" >
                </div>
                <div class="col-md-3">
                    <label class="label-control">Ret ISR</label>
                    <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_ret_isr" id="edit_ret_isr" required="true" >
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label class="label-control">IEPS</label>
                    <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_ieps" id="edit_ieps" required="true" >
                </div>
                <div class="col-md-3">
                    <label class="label-control">DAP</label>
                    <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_dap" id="edit_dap" required="true" >
                </div>
                <div class="col-md-3">
                   <label for="">Fecha de pago:</label>
                   <input type="date" id="dateE" name="dateE" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
               </div>
               <div class="col-md-3">
                <label class="label-control">Referencia:</label>
                <select id="edit_ref" name="edit_ref" class="form-control">
                    <option value="Transferencia">Transferencia</option>
                    <option value="Deposito_cheque">Depósito en Cheque</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="">Comentario:</label>
                <textarea class="form-control" name="commentE" id="commentE" cols="10" rows="2"></textarea>
            </div>
            <div class="col-md-6">
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
        tabla=$('#table_id').DataTable({
        "order": [[ 1, "desc" ]]
    });
    });



  $(function() {
    $('.multiple-select').multipleSelect()
  });


  $(function() {
    $('#muestra_oculta').multipleSelect("checkAll").change(function () {
      sel=document.getElementById("muestra_oculta");
        col_selec="";
        for (var i = 0; i < sel.options.length; i++) {
                if(sel.options[i].selected==true){
                    col_selec+=sel.options[i].value+"*";
                     
                    tabla.column(sel.options[i].value).visible(1);
                }else{
                     tabla.column(sel.options[i].value).visible(0);
                }
              }         
    }).change()
  });


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
            url: '<?php echo base_url(); ?>Iluminacion/AddCostOfSale',
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
                    //alert(data);
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
    var amount=$("#amount"+$id).text().split("$");
    var amount=amount[1];
    var concept=$("#concept"+$id).text();
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    var status=$("#status"+$id).text();
    var date=$("#date"+$id).text();
    var iva=$("#iva"+id).text().split("$");
    var ret_iva=$("#ret_iva"+id).text().split("$");
    var ret_isr=$("#ret_isr"+id).text().split("$");
    var ieps=$("#ieps"+id).text().split("$");
    var dap=$("#dap"+id).text().split("$");
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
    $("#amountE").val(amount);
    $("#conceptE").val(concept);
    $("#commentE").val(comment);
    //$("#billE").val(bill);
    $("#statusE option:contains("+status+")").attr('selected', true);
    $("#dateE").val(date);
    $("#edit_iva").val(iva[1]);
    $("#edit_ret_iva").val(ret_iva[1]);
    $("#edit_ret_isr").val(ret_isr[1]);
    $("#edit_ieps").val(ieps[1]);
    $("#edit_dap").val(dap[1]);
    $("#edit_ref").val(tipo_ref).attr('selected',true);
    //$("#edit_ref option:contains("+tipo_ref+")").attr('selected', true);

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
            url: '<?php echo base_url(); ?>Iluminacion/EditCostOfSale',
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
    url_verifica=url.split('?');
    //alert(url_verifica[0]);

    if(url_verifica[0]== "<?php echo base_url()?>"){
        alert("No se adjuntó Factura");
    }else{
        $("#viewBill").modal();
        $("#folios").val(invoice);
        // $("#folios").val(id);
        $("#showbill").prop("src", url);
    }
}


</script>