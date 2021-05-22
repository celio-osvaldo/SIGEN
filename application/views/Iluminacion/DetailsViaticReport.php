<div class="row">
    <div class="col-md-8" align="center">
        <h3>Viáticos</h3>
    </div>
        <div class="col-md-2">
        <button class="btn btn-success btn-sm" onclick="Regresa_lista()">Regresar a lista de Viáticos</button>
        </div>
</div>

<div class="card bg-card">
    <div class="margins">
        <div class="table-responsive">
            <table  class="table table-hover" style="font-size: 10pt;">
                <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                    <tr>
                        <th>Fecha de reporte</th>
                        <th>Proyecto/Motivo</th>
                        <th>Total de días</th>
                        <th>Fecha inicio</th>
                        <th>Fecha fin</th>
                        <th>Total Gasto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($viatico->result() as $row) {?>
                    <tr>
                        <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_fecha; ?></td>
                        <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->obra_cliente_nombre; ?></td>
                        <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_total_dias; ?></td>
                        <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_fecha_ini; ?></td>
                        <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_fecha_fin; ?></td>
                        <td>$<?php echo number_format($total->sumPayment,5,'.',',') ?></td>
                                    <!-- <td align="center"><a role="button" class="btn btn-outline-dark" onclick="Details(this.id)" id="<?php echo $row->id_viaticos; ?>" data-toggle="modal" data-target="#editReport"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                                    </td> -->
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-7" align="center">
        <h3>Detalles de Viático</h3>
    </div>
    <div class="col-md-3">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newExpend"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Gasto</button>
    </div>
</div>
            
<div class="card bg-card">
    <div class="margins">
        <div class="table-responsive">
            <table id="table_id" class="table table-hover display" style="font-size: 8pt;">
                <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                    <tr>
                        <th>Folio Comprobante</th>
                        <th>Empleado</th>
                        <th>Fecha</th>
                        <th>Concepto</th>
                        <th class="dato">Importe</th>
                        <th>IVA</th>
                        <th>Ret IVA</th>
                        <th>Ret ISR</th>
                        <th>IEPS</th>
                        <th>DAP</th>
                        <th>Tipo de comprobante</th>
                        <th>Tipo de Referencia</th>
                        <th hidden="true">url_comprobante</th>
                        <th>Evidencia</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($detail->result() as $row) {?>
                    <tr>
                        <td id="<?php echo "comprobante".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_factura; ?></td>
                        <td id="<?php echo "empleado".$row->id_lista_viatico.""; ?>"><?php echo $row->empleado; ?></td>
                        <td id="<?php echo "fecha".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_fecha; ?></td>
                        <td id="<?php echo "concepto".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_concepto; ?></td>
                        <td id="<?php echo "importe".$row->id_lista_viatico.""; ?>">$<?php echo number_format($row->lista_viatico_importe,5,'.',','); ?></td>

                        <td id="<?php echo "iva".$row->id_lista_viatico.""; ?>">$<?php echo number_format($row->lista_viatico_iva,5,'.',','); ?></td>
                        <td id="<?php echo "ret_iva".$row->id_lista_viatico.""; ?>">$<?php echo number_format($row->lista_viatico_iva_ret,5,'.',','); ?></td>
                        <td id="<?php echo "ret_isr".$row->id_lista_viatico.""; ?>">$<?php echo number_format($row->lista_viatico_isr_ret,5,'.',','); ?></td>
                        <td id="<?php echo "ieps".$row->id_lista_viatico.""; ?>">$<?php echo number_format($row->lista_viatico_ieps,5,'.',','); ?></td>
                        <td id="<?php echo "dap".$row->id_lista_viatico.""; ?>">$<?php echo number_format($row->lista_viatico_dap,5,'.',','); ?></td>

                        <td id="<?php echo "tipo_comprobante".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_comprobante; ?></td>
                        <td id="<?php echo "tipo_ref".$row->id_lista_viatico.""; ?>"><?php echo "".$row->lista_viatico_referencia.""; ?></td>
                        <td hidden="true" id="<?php echo "url_comprobante".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_url_comprobante ?></td>
                        <td align="center" id="<?php echo "bill".$row->id_lista_viatico.""; ?>"><a role="button" onclick="Display_bill(this.id)" class="btn btn-outline-dark" id="<?php echo "".$row->id_lista_viatico.""; ?>"><img height="20" src="..\Resources\Icons\invoice_icon_128337.ico" alt="Editar" style="filter: invert(100%)"></a></td>
                        <td><a role="button" class="btn btn-outline-dark" onclick="Edit_Registro(this.id)" id="<?php echo "".$row->id_lista_viatico.""; ?>"><img height="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable({
            initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
        },
         /****** add this */
        "searching": true,
        // "autoFill": true,
        "language": {
            "lengthMenu": "Por página: _MENU_",
            "zeroRecords": "Sin resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ registros en total)",
            "search": "Búsqueda",
                "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          }
        },
        });
    });
</script>


<!-- new report of viatics modal -->
<div class="modal fade" id="newExpend"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo reporte de viaticos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="addReport">
            <div class="modal-body">
                <div>
                    <input type="hidden" name="addexpendId" id="addexpendId">
                    <?php foreach ($max->result() as $row){ ?>
                        <input class="form-control" type="hidden" name="maxid" id="maxid" value="<?php echo "".($row->id_lista_viatico + 1).""; ?>" required="true">
                            <?php } ?>
                            <?php foreach ($viatico->result() as $row) {?>
                        <input type="hidden" id="idViatic" name="idViatic" value="<?php echo $row->id_viaticos; ?>">
                            <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="label-control">Fecha de Reporte</label>
                        <input class="form-control" id="addDate" name="addDate" type="date" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Folio de Comprobante</label>
                        <input class="form-control" id="idComprobante" name="idComprobante" type="text" required="true">
                    </div>
                    <div class="col-md-6">
                        <label class="label-control">Nombre del empleado</label>
                        <input class="form-control" id="employ" name="employ" type="text" required="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="label-control">Concepto de gasto</label>
                        <input type="text" class="form-control" name="addconcept" id="addconcept" required="true" required="true">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Tipo de Comprobante</label>
                        <select class="form-control" id="addTypeVoucher" name="addTypeVoucher" required="true">
                            <option value="Cheque" selected="true">Cheque</option>
                            <option value="Factura">Factura</option>
                            <option value="Recibo">Recibo</option>
                            <option value="Ticket">Ticket</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                    <label class="label-control">Tipo Referencia Pago</label>
                        <select class="form-control" id="add_ref" name="add_ref" required="true" >
                            <option value="Transferencia" selected="true">Transferencia</option>
                            <option value="Deposito_cheque">Depósito en Cheque</option>
                            <option value="Efectivo">Efectivo</option>
                        </select>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-3">
                        <label>Importe</label>
                        <input type="text" onblur="Separa_Miles(this.id)" name="addImport" id="addImport" class="form-control" required="true">
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
                    <div class="col-md-6">
                        <label class="label-control">Evidencia</label>
                        <input type="file" class="form-control" id="addEvidence" name="addEvidence"  accept="application/pdf, image/*" >
                        <input type="hidden" name="" value="<?php echo $total->sumPayment ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="saveExpend">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancel">Cancelar</button>
            </div>

        </form>

    </div>
  </div>
</div>
<!-- end modal -->



<!-- Edit report of viatics modal -->
<div class="modal fade" id="edit_newExpend"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Registro de Viaticos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="edit_addReport">
            <div class="modal-body">
                <div>
                    <input type="text" hidden="true" name="edit_id_lista_viatico" id="edit_id_lista_viatico">
                    <?php foreach ($viatico->result() as $row) {?>
                        <input type="hidden" id="edit_idViatic" name="edit_idViatic" value="<?php echo $row->id_viaticos; ?>">
                    <?php } ?>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="label-control">Fecha de Reporte</label>
                        <input class="form-control" id="edit_addDate" name="edit_addDate" type="date" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Folio de Comprobante</label>
                        <input class="form-control" id="edit_idComprobante" name="edit_idComprobante" type="text" required="true">
                    </div>
                    <div class="col-md-6">
                        <label class="label-control">Nombre del empleado</label>
                        <input class="form-control" id="edit_employ" name="edit_employ" type="text" required="true">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="label-control">Concepto de gasto</label>
                        <input type="text" class="form-control" name="edit_addconcept" id="edit_addconcept" required="true" required="true">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Tipo de Comprobante</label>
                        <select class="form-control" id="edit_addTypeVoucher" name="edit_addTypeVoucher" required="true">
                            <option value="Cheque" selected="true">Cheque</option>
                            <option value="Factura">Factura</option>
                            <option value="Recibo">Recibo</option>
                            <option value="Ticket">Ticket</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                    <label class="label-control">Tipo Referencia Pago</label>
                        <select class="form-control" id="edit_ref" name="edit_ref" required="true" >
                            <option value="Transferencia" selected="true">Transferencia</option>
                            <option value="Deposito_cheque">Depósito en Cheque</option>
                            <option value="Efectivo">Efectivo</option>
                        </select>
                    </div>
                </div>
                <div class="row">                
                    <div class="col-md-3">
                        <label>Importe</label>
                        <input type="text" onblur="Separa_Miles(this.id)" name="edit_addImport" id="edit_addImport" class="form-control" required="true">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">IVA</label>
                        <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_iva" id="edit_iva" required="true" value="0.00000">
                    </div>
                     <div class="col-md-3">
                        <label class="label-control">Ret IVA</label>
                        <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_ret_iva" id="edit_ret_iva" required="true" value="0.00000">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">Ret ISR</label>
                        <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_ret_isr" id="edit_ret_isr" required="true" value="0.00000">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label class="label-control">IEPS</label>
                        <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_ieps" id="edit_ieps" required="true" value="0.00000">
                    </div>
                    <div class="col-md-3">
                        <label class="label-control">DAP</label>
                        <input type="text" onblur="Separa_Miles(this.id)" class="form-control" name="edit_dap" id="edit_dap" required="true" value="0.00000">
                    </div>
                    <div class="col-md-6">
                        <label class="label-control">Evidencia</label>
                        <input type="file" class="form-control" id="edit_addEvidence" name="edit_addEvidence"  accept="application/pdf, image/*" >
                        <input type="hidden" name="" value="<?php echo $total->sumPayment ?>">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="edit_saveExpend">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancel">Cancelar</button>
            </div>

        </form>

    </div>
  </div>
</div>
<!-- end modal -->






<!-- add viatic report script -->
<script>
$(document).ready(function(e){
    $("#addReport").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Iluminacion/AddViaticExpend',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addReport').css("opacity",".5");
            },
            success: function(data){
                if(data == 1){
                    $('#addReport')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Información del costo de venta actualizada');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#addReport').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });

    $("#edit_addReport").on('submit', function(e){ //Edit Viatic Report
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Iluminacion/UpdateViaticExpend',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addReport').css("opacity",".5");
            },
            success: function(data){
                if(data == 1){
                    $('#addReport')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Registro actualizado');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#addReport').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });




    
    //file type validation
    $("#addEvidence").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        if(!(imagefile)){
            alert('Please select a valid file (PDF).');
            $("#addEvidence").val('');
            return false;
        }else{
          //alert('imagen subida');
          return true;
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetAllViatics");
    $("#page_content").load("GetAllViatics");
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

  function Edit_Registro($id){
    var id_lista_viatico=$id;
    comprobante=$("#comprobante"+id_lista_viatico).text();
    empleado=$("#empleado"+id_lista_viatico).text();
    fecha=$("#fecha"+id_lista_viatico).text();
    concepto=$("#concepto"+id_lista_viatico).text();
    importe=$("#importe"+id_lista_viatico).text().split("$");
    //importe=importe.replace(/\,/g, '');
    tipo_comprobante=$("#tipo_comprobante"+id_lista_viatico).text();

    var iva=$("#iva"+id_lista_viatico).text().split("$");
    var ret_iva=$("#ret_iva"+id_lista_viatico).text().split("$");
    var ret_isr=$("#ret_isr"+id_lista_viatico).text().split("$");
    var ieps=$("#ieps"+id_lista_viatico).text().split("$");
    var dap=$("#dap"+id_lista_viatico).text().split("$");
    var tipo_ref=$("#tipo_ref"+id_lista_viatico).text();

    //alert(id_lista_viatico+" "+empleado+" "+fecha+" "+concepto+" "+importe+" "+tipo_comprobante);

    $("#edit_newExpend").modal();
    $("#edit_id_lista_viatico").val(id_lista_viatico);
    $("#edit_addDate").val(fecha);
    $("#edit_employ").val(empleado);
    $("#edit_idComprobante").val(comprobante);
    $("#edit_addconcept").val(concepto);
    $("#edit_addImport").val(importe[1]);
    $("#edit_addTypeVoucher option:contains("+tipo_comprobante+")").attr('selected', true);
    $("#edit_iva").val(iva[1]);
    $("#edit_ret_iva").val(ret_iva[1]);
    $("#edit_ret_isr").val(ret_isr[1]);
    $("#edit_ieps").val(ieps[1]);
    $("#edit_dap").val(dap[1]);
    $("#edit_ref").val(tipo_ref).attr('selected',true);

    }



    function Regresa_lista(){
        $("#page_content").load("GetAllViatics");
    }
</script>