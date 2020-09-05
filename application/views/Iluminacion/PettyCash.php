<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Listado de reportes en Caja Chica</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newReport"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Reporte</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="card bg-card">
    <div class="margins">
       <div class="table-responsive">
        <table id="table_id" class="table table-striped table-hover display" style="font-size: 8pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                <tr>
                    <th>Fecha de emisión</th>
                    <th>Concepto</th>
                    <th hidden="true">Tipo de movimiento</th>
                    <th>Monto</th>
                    <th>IVA</th>
                    <th>Ret IVA</th>
                    <th>Ret ISR</th>
                    <th>IEPS</th>
                    <th>DAP</th>
                    <th>Folio de factura</th>
                    <th>Fecha de Factura</th>
                    <th>Tipo Referencia</th>
                    <th>Factura/Comprobante</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <tr><?php
                foreach ($cash->result() as $row) {?>
                    <td id="<?php echo "dateR".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_fecha.""; ?></td>
                    <td id="<?php echo "concept".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_concepto.""; ?></td>

                    <?php if ($row->lista_caja_chica_reposicion != "0"){ ?>
                        <td hidden="true" id="<?php echo "tipo".$row->id_lista_caja_chica.""; ?>">Ingreso</td>
                        <td id="<?php echo "money".$row->id_lista_caja_chica.""; ?>"><?php echo number_format($row->lista_caja_chica_reposicion,5,'.',',').""; ?></td>
                    <?php }else{ ?>
                        <td hidden="true" id="<?php echo "tipo".$row->id_lista_caja_chica.""; ?>">Egreso</td>
                        <td id="<?php echo "money".$row->id_lista_caja_chica.""; ?>">$<?php echo number_format($row->lista_caja_chica_gasto,5,'.',',').""; ?></td>
                    <?php } ?>


                    <td id="<?php echo "iva".$row->id_lista_caja_chica.""; ?>">$<?php echo number_format($row->lista_caja_chica_iva,5,'.',','); ?></td>
                    <td id="<?php echo "ret_iva".$row->id_lista_caja_chica.""; ?>">$<?php echo number_format($row->lista_caja_chica_iva_ret,5,'.',','); ?></td>
                    <td id="<?php echo "ret_isr".$row->id_lista_caja_chica.""; ?>">$<?php echo number_format($row->lista_caja_chica_isr_ret,5,'.',','); ?></td>
                    <td id="<?php echo "ieps".$row->id_lista_caja_chica.""; ?>">$<?php echo number_format($row->lista_caja_chica_ieps,5,'.',','); ?></td>
                    <td id="<?php echo "dap".$row->id_lista_caja_chica.""; ?>">$<?php echo number_format($row->lista_caja_chica_dap,5,'.',','); ?></td>

                    <td id="<?php echo "bill".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_factura.""; ?></td>
                    <td id="<?php echo "dateB".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_fecha_factura.""; ?></td>
                    <td id="<?php echo "tipo_ref".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_referencia.""; ?></td>
                    <td align="center" id="<?php echo "bill_url".$row->id_lista_caja_chica.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->lista_caja_chica_url_factura.""; ?>" onclick="Display_bill(this.id)"><img height="20" width="20" src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
                    <td><a role="button" class="btn btn-outline-dark" onclick="Edit_Registro(this.id)" id="<?php echo "".$row->id_lista_caja_chica.""; ?>"><img width="20" height="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>


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
  <form class="form-group" id="addReport" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <!-- <label class="control-label">Caja chica</label> -->
                <?php foreach ($max->result() as $row){ ?>
                    <input class="form-control" type="hidden" name="cashI" id="cashI" value="<?php echo "".($row->id_lista_caja_chica + 1).""; ?>">
                <?php } ?>
                <label class="label-control">Fecha de emisión</label>
                <input class="form-control" type="date" name="dateI" id="dateI">
            </div>
            <div class="col-md-4">
                <label class="label-control">Folio Factura/Comprobante</label>
                <input class="form-control" type="text" name="folioBillI" id="folioBillI" required="true">
            </div>
            <div class="col-md-4">
                <label class="label-control">Referencia:</label>
                <select id="add_ref" name="add_ref" class="form-control">
                    <option value="Transferencia" selected="true">Transferencia</option>
                    <option value="Deposito_cheque">Depósito en Cheque</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">Monto</label>
                <div id="tm1" style="display:;">
                    <input class="form-control" onblur="Separa_Miles(this.id)" type="text" name="moneyEI" id="moneyEI">
                </div>
                <div id="tm2" style="display:none;">
                    <input class="form-control" type="text" name="moneyI" id="moneyI">
                </div>
            </div>
            <div class="col-md-3">
                <label class="label-control">IVA</label>
                <input value="0.00000" class="form-control" type="text" name="add_iva" id="add_iva" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret IVA</label>
                <input value="0.00000" class="form-control" type="text" name="add_ret_iva" id="add_ret_iva" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret ISR</label>
                <input value="0.00000" class="form-control" type="text" name="add_ret_isr" id="add_ret_isr" onblur="Separa_Miles(this.id)">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="label-control">IEPS</label>
                <input value="0.00000" class="form-control" type="text" name="add_ieps" id="add_ieps" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-3">
                <label class="label-control">DAP</label>
                <input value="0.00000" class="form-control" type="text" name="add_dap" id="add_dap" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-6">
             <label class = "control-label">Concepto</label>
             <input class="form-control" type="text" name="conceptI" id="conceptI" required="true" required="true">
         </div>
     </div>
     <div class="row">
        <div class="col-md-4">
            <label class = "control-label">Fecha factura</label>
            <input class="form-control" type="date" name="dateBillI" id="dateBillI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
        </div>
        <div class="col-md-6">
            <label class="label-control">Factura/Comprobante</label>
            <input class="form-control" type="file" name="upBillI" id="upBillI" accept="application/pdf, image/*">
        </div>

    </div>

    <div class="col-md-6">
        <div class="row">
            <div hidden="true" class="col-md-6">
                <label for="">Tipo de movimiento</label>
                <div class="form-check">
                  <input class="form-check-input moviment" type="radio" name="exampleRadios" id="exampleRadios" value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Egreso
                </label>
            </div>
            <div class="form-check">
              <input class="form-check-input moviment" type="radio" name="exampleRadios" id="exampleRadios" value="option2">
              <label class="form-check-label" for="exampleRadios2">Ingreso</label>
          </div>
      </div>
  </div>
</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-outline-success submitBtn" id="saveReport">Guardar</button>
    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
</div>
</form>
</div>
</div>
</div>
<!-- end modal -->


<!-- modal edit report -->
<div class="modal fade" id="edit_Report" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar reporte de caja chica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form class="form-group" id="editReport" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-4">
                <input class="form-control" type="text" hidden="true" name="edit_id_lista_caja_chica" id="edit_id_lista_caja_chica">
                <label class="label-control">Fecha de emisión</label>
                <input class="form-control" type="date" name="edit_dateI" id="edit_dateI">
            </div>
            <div class="col-md-4">
                <label class="label-control">Folio Factura/Comprobante</label>
                <input class="form-control" type="text" name="edit_folioBillI" id="edit_folioBillI" required="true">
            </div>
            <div class="col-md-4">
                <label class="label-control">Referencia:</label>
                <select id="edit_ref" name="edit_ref" class="form-control">
                    <option value="Transferencia" selected="true">Transferencia</option>
                    <option value="Deposito_cheque">Depósito en Cheque</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">Monto</label>
                <div id="tm1" style="display:;">
                    <input class="form-control" onblur="Separa_Miles(this.id)" type="text" name="edit_money" id="edit_money">
                </div>
                <div id="tm2" style="display:none;">
                    <input class="form-control" type="text" name="edit_moneyI" id="edit_moneyI">
                </div>
            </div>
            <div class="col-md-3">
                <label class="label-control">IVA</label>
                <input class="form-control" type="text" name="edit_iva" id="edit_iva" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret IVA</label>
                <input class="form-control" type="text" name="edit_ret_iva" id="edit_ret_iva" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-3">
                <label class="label-control">Ret ISR</label>
                <input class="form-control" type="text" name="edit_ret_isr" id="edit_ret_isr" onblur="Separa_Miles(this.id)">
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <label class="label-control">IEPS</label>
                <input class="form-control" type="text" name="edit_ieps" id="edit_ieps" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-3">
                <label class="label-control">DAP</label>
                <input class="form-control" type="text" name="edit_dap" id="edit_dap" onblur="Separa_Miles(this.id)">
            </div>
            <div class="col-md-6">
             <label class = "control-label">Concepto</label>
             <input class="form-control" type="text" name="edit_conceptI" id="edit_conceptI" required="true" required="true">
         </div>
     </div>
     <div class="row">
        <div class="col-md-4">
            <label class = "control-label">Fecha factura</label>
            <input class="form-control" type="date" name="edit_dateBillI" id="edit_dateBillI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
        </div>
        <div class="col-md-6">
            <label class="label-control">Factura/Comprobante</label>
            <input class="form-control" type="file" name="edit_upBillI" id="edit_upBillI" accept="application/pdf, image/*">
        </div>

    </div>

    <div class="col-md-6">
        <div class="row">
            <div hidden="true" class="col-md-6">
                <label for="">Tipo de movimiento</label>
                <div class="form-check">
                  <input class="form-check-input moviment" type="radio" name="edit_exampleRadios" id="edit_exampleRadios" value="option1" checked>
                  <label class="form-check-label" for="exampleRadios1">
                    Egreso
                </label>
            </div>
            <div class="form-check">
              <input class="form-check-input moviment" type="radio" name="edit_exampleRadios" id="edit_exampleRadios" value="option2">
              <label class="form-check-label" for="exampleRadios2">Ingreso</label>
          </div>
      </div>
  </div>
</div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-outline-success submitBtn" id="EditReport">Actualizar</button>
    <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
</div>
</form>
</div>
</div>
</div>
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

<!-- script by add new report in petty cash -->
<script>
$(document).ready(function(e){
    $("#addReport").on('submit', function(e){
        e.preventDefault();
        //alert($('input:radio[name=exampleRadios]:checked').val());
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Iluminacion/AddReportPettyCash',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addReport').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                if(msg == 'ok'){
                    alert('Falló el servidor. Reporte no agregado. Verifique que la información sea correcta');
                    CloseModal();
                }else{
                    alert("Reporte subido satisfactoriamente");

                    CloseModal();
                    
                }
                $('#addReport').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });


    $("#editReport").on('submit', function(e){
        e.preventDefault();
        //alert($('input:radio[name=edit_radio]:checked').val());
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Iluminacion/UpdateReportPettyCash',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#editReport').css("opacity",".5");
            },
            success: function(msg){
                $('.statusMsg').html('');
                //alert(msg);
                if(msg == 'ok'){
                    alert('Falló el servidor. Reporte no actualizado. Verifique que la información sea correcta');
                    CloseModal();
                    Update_Page();
                }else{
                    alert("Reporte actualizado satisfactoriamente");
                    CloseModal();
                    Update_Page();                    
                }
                $('#editReport').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
        Update_Page();
    });


    
    //file type validation
    $("#upBillI").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        // var match= ["*"];
        if(!(imagefile)){
            alert('Please select a valid image file (PDF).');
            $("#upBillI").val('');
            return false;
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("PettyCash");
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

<!-- view bill script -->
<script>
  function Display_bill($id){
     var url="<?php echo base_url()?>"+$id+"?"+Date.now();
    var id=$id;
    //var url = "<?php echo base_url()?>Resources/Bills/PettyCash/Iluminacion/"+invoice+".pdf";

    //$("#folios").val(url);
    // $("#folios").val(id);
    if($id==""||$id=="N/A") {
      alert("No se adjuntó Imagen");
    }else{
         $("#viewBill").modal();
        $("#showbill").prop("src", url);
    }

}

function Edit_Registro($id_lista_caja_chica){
    id_lista_caja_chica=$id_lista_caja_chica;
    fecha_em=$("#dateR"+id_lista_caja_chica).text();
    concepto=$("#concept"+id_lista_caja_chica).text();
    tipo=$("#tipo"+id_lista_caja_chica).text();
    monto=$("#money"+id_lista_caja_chica).text().split("$");;
    factura=$("#bill"+id_lista_caja_chica).text();
    fecha_factura=$("#dateB"+id_lista_caja_chica).text();
    var iva=$("#iva"+id_lista_caja_chica).text().split("$");
    var ret_iva=$("#ret_iva"+id_lista_caja_chica).text().split("$");
    var ret_isr=$("#ret_isr"+id_lista_caja_chica).text().split("$");
    var ieps=$("#ieps"+id_lista_caja_chica).text().split("$");
    var dap=$("#dap"+id_lista_caja_chica).text().split("$");
    var tipo_ref=$("#tipo_ref"+id_lista_caja_chica).text();
    //alert(id_lista_caja_chica+" "+fecha_em+" "+concepto+" "+tipo+" "+monto+" "+factura);

     $("#edit_Report").modal();
     $("#edit_id_lista_caja_chica").val(id_lista_caja_chica);
     $("#edit_dateI").val(fecha_em);
     $("#edit_conceptI").val(concepto);
     if(tipo=="Ingreso"){
        $("#edit_radio_ingreso").prop( "checked", true );
         $("#edit_radio_egreso").prop( "checked", false );
     }else{
        $("#edit_radio_egreso").prop( "checked", true );
        $("#edit_radio_ingreso").prop( "checked", false );
     }

     $("#edit_money").val(monto[1]);
    $("#edit_iva").val(iva[1]);
    $("#edit_ret_iva").val(ret_iva[1]);
    $("#edit_ret_isr").val(ret_isr[1]);
    $("#edit_ieps").val(ieps[1]);
    $("#edit_dap").val(dap[1]);
    $("#edit_ref").val(tipo_ref).attr('selected',true);

     $("#edit_folioBillI").val(factura);
     $("#edit_dateBillI").val(fecha_factura);
}

function Update_Page(){
    $("#page_content").load("PettyCash");
 }


</script>