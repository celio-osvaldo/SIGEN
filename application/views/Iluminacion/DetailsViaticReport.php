<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-8">
        <h3>Detalles de viático</h3>
    </div>
        <div class="col-md-2">
        <button class="btn btn-success btn-sm" onclick="Regresa_lista()">Regresar a lista de Viaticos</button>
    </div>
    <div class="col-md-1"></div>
</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="card bg-card">
                <div class="margins">
                    <div class="table-responsive-lg">
                        <table  class="table table-hover" style="font-size: 10pt;">
                            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                                <tr>
                                    <th>Fecha de reporte</th>
                                    <th>Proyecto/Motivo</th>
                                    <th>Total de días</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th></th>
                                    <th>Total Gasto</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><?php foreach ($viatico->result() as $row) {?>
                                    <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_fecha; ?></td>
                                    <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->obra_cliente_nombre; ?></td>
                                    <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_total_dias; ?></td>
                                    <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_fecha_ini; ?></td>
                                    <td id="<?php echo $row->id_viaticos; ?>"><?php echo $row->viaticos_fecha_fin; ?></td>
                                    <td>$</td>
                                    <td><?php echo number_format($total->sumPayment,5,'.',',') ?></td>
                                    <!-- <td align="center"><a role="button" class="btn btn-outline-dark" onclick="Details(this.id)" id="<?php echo $row->id_viaticos; ?>" data-toggle="modal" data-target="#editReport"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                                    </td> -->
                                </tr><?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-1"></div>
</div>
        <br>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-7">
                <h3>Detalles de viático</h3>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newExpend"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Gasto</button>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card bg-card">
                        <div class="margins">
                            <table id="table_id" class="table table-hover display" style="font-size: 10pt;">
                                <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                                    <tr>
                                        <th>Folio Comprobante</th>
                                        <th>Empleado</th>
                                        <th>Fecha</th>
                                        <th>Concepto</th>
                                        <th></th>
                                        <th class="dato">Importe</th>
                                        <th>Tipo de comprobante</th>
                                        <th hidden="true">url_comprobante</th>
                                        <th>Evidencia</th>
                                        <th>Editar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><?php foreach ($detail->result() as $row) {?>
                                        <td id="<?php echo "comprobante".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_factura; ?></td>
                                        <td id="<?php echo "empleado".$row->id_lista_viatico.""; ?>"><?php echo $row->empleado; ?></td>
                                        <td id="<?php echo "fecha".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_fecha; ?></td>
                                        <td id="<?php echo "concepto".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_concepto; ?></td>
                                        <td>$</td>
                                        <td id="<?php echo "importe".$row->id_lista_viatico.""; ?>"><?php echo number_format($row->lista_viatico_importe,5,'.',','); ?></td>
                                        <td id="<?php echo "tipo_comprobante".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_comprobante; ?></td>
                                        <td hidden="true" id="<?php echo "url_comprobante".$row->id_lista_viatico.""; ?>"><?php echo $row->lista_viatico_url_comprobante ?></td>
                                        <td align="center" id="<?php echo "bill".$row->id_lista_viatico.""; ?>"><a role="button" onclick="Display_bill(this.id)" class="btn btn-outline-dark" id="<?php echo "".$row->id_lista_viatico.""; ?>"><img src="..\Resources\Icons\invoice_icon_128337.ico" alt="Editar" style="filter: invert(100%)"></a></td>
                                        <td><a role="button" class="btn btn-outline-dark" onclick="Edit_Registro(this.id)" id="<?php echo "".$row->id_lista_viatico.""; ?>"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                                </td>
                                    </tr><?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <div class="col-md-1"></div>
        </div>


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
                <div class="row">

                    <div class="col-md-9">
                        <input type="hidden" name="addexpendId" id="addexpendId">
                        <?php foreach ($max->result() as $row){ ?>
                                <input class="form-control" type="hidden" name="maxid" id="maxid" value="<?php echo "".($row->id_lista_viatico + 1).""; ?>" required="true">
                            <?php } ?>
                            <?php foreach ($viatico->result() as $row) {?>
                            <input type="hidden" id="idViatic" name="idViatic" value="<?php echo $row->id_viaticos; ?>">
                            <?php } ?>
                    </div>

                    <div class="col-md-3">
                        <input class="form-control" id="addDate" name="addDate" type="date" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>

                    <div class="col-md-6">
                        <label>Nombre del empleado</label>
                        <input class="form-control" id="employ" name="employ" type="text" required="true">
                    </div>
                    <div class="col-md-6">
                        <label>Folio de Comprobante</label>
                        <input class="form-control" id="idComprobante" name="idComprobante" type="text" required="true">
                    </div>

                    <div class="col-md-6">
                        <label>Concepto de gasto</label>
                        <input type="text" class="form-control" name="addconcept" id="addconcept" required="true" required="true">
                    </div>
                    <div class="col-md-6">
                        <label>Importe</label>
                        <input type="text" onblur="Separa_Miles(this.id)" name="addImport" id="addImport" class="form-control" required="true">
                    </div>
                    <div class="col-md-6">
                        <label>Tipo de Comprobante</label>
                        <select class="form-control" id="addTypeVoucher" name="addTypeVoucher" required="true">
                            <option selected="Seleccionar"></option>
                            <option value="Cheque">Cheque</option>
                            <option value="Factura">Factura</option>
                            <option value="Recibo">Recibo</option>
                            <option value="Ticket">Ticket</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Evidencia</label>
                        <input type="file" class="form-control" id="addEvidence" name="addEvidence"  accept="application/pdf, image/*">
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
                <div class="row">

                    <div class="col-md-9">
                        <input type="text" hidden="true" name="edit_id_lista_viatico" id="edit_id_lista_viatico">
                        <?php foreach ($viatico->result() as $row) {?>
                            <input type="hidden" id="edit_idViatic" name="edit_idViatic" value="<?php echo $row->id_viaticos; ?>">
                        <?php } ?>
                    </div>

                    <div class="col-md-3">
                        <input class="form-control" id="edit_addDate" name="edit_addDate" type="date" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>

                    <div class="col-md-6">
                        <label>Nombre del empleado</label>
                        <input class="form-control" id="edit_employ" name="edit_employ" type="text" required="true">
                    </div>
                    <div class="col-md-6">
                        <label>Folio de Comprobante</label>
                        <input class="form-control" id="edit_idComprobante" name="edit_idComprobante" type="text" required="true">
                    </div>

                    <div class="col-md-6">
                        <label>Concepto de gasto</label>
                        <input type="text" class="form-control" name="edit_addconcept" id="edit_addconcept" required="true" required="true">
                    </div>
                    <div class="col-md-6">
                        <label>Importe</label>
                        <input type="text" onblur="Separa_Miles(this.id)" name="edit_addImport" id="edit_addImport" class="form-control" required="true">
                    </div>
                    <div class="col-md-6">
                        <label>Tipo de Comprobante</label>
                        <select class="form-control" id="edit_addTypeVoucher" name="edit_addTypeVoucher" required="true">
                            <option selected="Seleccionar"></option>
                            <option value="Cheque">Cheque</option>
                            <option value="Factura">Factura</option>
                            <option value="Recibo">Recibo</option>
                            <option value="Ticket">Ticket</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label>Evidencia</label>
                        <input type="file" class="form-control" id="edit_addEvidence" name="edit_addEvidence"  accept="application/pdf, image/*">
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
    var id_lista_viatico=$id;
    var url =$("#url_comprobante"+id_lista_viatico).text()+"?"+Date.now();
    //alert(url);
    if (url!="") {
        url="<?php echo base_url()?>"+url;
        $("#viewBill").modal();
        //$("#folios").val(invoice);
        // $("#folios").val(id);
        $("#showbill").prop("src", url);
    }else{
        alert("No se adjuntó comprobante");
    }

    }


  function Edit_Registro($id){
    var id_lista_viatico=$id;
    comprobante=$("#comprobante"+id_lista_viatico).text();
    empleado=$("#empleado"+id_lista_viatico).text();
    fecha=$("#fecha"+id_lista_viatico).text();
    concepto=$("#concepto"+id_lista_viatico).text();
    importe=$("#importe"+id_lista_viatico).text();
    //importe=importe.replace(/\,/g, '');
    tipo_comprobante=$("#tipo_comprobante"+id_lista_viatico).text();

    //alert(id_lista_viatico+" "+empleado+" "+fecha+" "+concepto+" "+importe+" "+tipo_comprobante);

    $("#edit_newExpend").modal();
    $("#edit_id_lista_viatico").val(id_lista_viatico);
    $("#edit_addDate").val(fecha);
    $("#edit_employ").val(empleado);
    $("#edit_idComprobante").val(comprobante);
    $("#edit_addconcept").val(concepto);
    $("#edit_addImport").val(importe);
    $("#edit_addTypeVoucher option:contains("+tipo_comprobante+")").attr('selected', true);

    }


   function Separa_Miles($id){
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



    function Regresa_lista(){
        $("#page_content").load("GetAllViatics");
    }
</script>