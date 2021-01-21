<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-7">
        <h3 align="center">Listado Nómina</h3>
    </div>
    <div class="col-md-4">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Pago Nómina</button>
    </div>
</div>

<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_Nomina" class="table table-striped table-hover display" style="font-size: 9pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
            <th>Fecha de Pago</th>
            <th>Id_empleado</th>
            <th>Concepto de Pago</th>
            <th>Monto</th>
            <th>Comentario</th>
            <th>Factura</th>
            <th hidden="true">url_factura</th>
            <th>Modificar</th>
        </tr>
    </thead>
    <tbody>
        <tr><?php
        foreach ($lista_nomina->result() as $row) {?>
            <td id="<?php echo "fecha".$row->id_gasto_nomina.""; ?>"><?php echo "".$row->gasto_nomina_fecha.""; ?></td>
            <td id="<?php echo "id_empleado".$row->id_gasto_nomina.""; ?>"><?php echo "".$row->gasto_nomina_id_empleado.""; ?></td>
            <td id="<?php echo "concepto".$row->id_gasto_nomina.""; ?>"><?php echo "".$row->gasto_nomina_concepto.""; ?></td>
            <td id="<?php echo "monto".$row->id_gasto_nomina.""; ?>">$<?php echo number_format($row->gasto_nomina_monto,2,'.',',').""; ?></td>
            <td id="<?php echo "comentario".$row->id_gasto_nomina.""; ?>"><?php echo "".$row->gasto_nomina_comentario.""; ?></td>
            <td align="center" id="<?php echo "factura".$row->id_gasto_nomina.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->id_gasto_nomina.""; ?>"  onclick="Display_bill(this.id)"><img height="20" src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
            <td hidden="true" id="<?php echo "url_factura".$row->id_gasto_nomina.""; ?>"><?php echo $row->gasto_nomina_url_comprobante ?></td>
            <td><a role="button" class="btn btn-outline-dark" onclick="Edit_pago(this.id)" id="<?php echo "".$row->id_gasto_nomina.""; ?>" data-toggle="modal" data-target="#editnomina"><img height="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
        </tr>
    <?php } ?>
</tbody>
</table>
</div>
</div>



<!-- modal new bill -->
<div class="modal fade" id="NewBill"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro de Nómina</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="newExpend">
          <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Fecha de pago:</label>
                            <input class="form-control" type="date" name="new_fecha" id="new_fecha" value="<?php date_default_timezone_set("America/Mexico_City"); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-9">
                            <label class="label-control">Empleado:</label>
                            <input type="text" name="new_empleado" id="new_empleado" class="form-control" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">Concepto de Pago:</label>
                            <input type="text" maxlength="200" id="new_concepto" name="new_concepto" class="form-control" required="true">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Monto:</label>
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="new_monto" id="new_monto" required="true">
                        </div>
                        <div class="col-md-9">
                            <label class="label-control">Comentario:</label>
                            <textarea type="text" class="form-control" name="new_comentario" id="new_comentario" maxlength="300"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
        <h5 class="modal-title" id="exampleModalLabel">Nueva factura</h5>
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
            <div class=" col-md-4">
                <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                <select class="form-control" id="edit_flujo" name="edit_flujo">
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <label for="">Concepto:</label>
                <input type="text" id="editConcept" name="editConcept" class="form-control" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">Monto</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="editAmount" id="editAmount" required="true">
            </div>
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
            <div class="col-md-3">
                <label for="">Fecha de pago:</label>
                <input type="date" id="editDate" name="editDate" class="form-control" onchange="DateObtain(this)" required="true" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
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
            <div class="col-md-6">
                <label class="label-control">Comentario:</label>
                <textarea class="form-control" id="editComment" name="editComment" cols="6" rows="2"></textarea>
            </div>
            <div class="col-md-6">
                <label class="label-control">Factura:</label>
                <input type="file" class="form-control" name="editBill" id="editBill" accept="application/pdf, image/*">
            </div>                            
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success submitBtn" id="updateCost">Guardar</button>
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
        $('#table_Nomina').DataTable();
    } );
</script>



<!-- script by add new costofsale -->
<script>
$(document).ready(function(e){
    $("#newExpend").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Quinta/AddNew_Nomina',
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
                    alert('Registro de Nómina agregado correctamente');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información ingresada sea correcta');
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
    $("#page_content").load("Nomina");
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
    $("#edit_flujo option:contains("+edit_flujo+")").attr('selected', true);
    $("#edit_iva").val(iva[1]);
    $("#edit_ret_iva").val(ret_iva[1]);
    $("#edit_ret_isr").val(ret_isr[1]);
    $("#edit_ieps").val(ieps[1]);
    $("#edit_dap").val(dap[1]);
    $("#edit_ref").val(tipo_ref).attr('selected',true);

   // $("#editBill").val(enviroment);
    }

  function Update_Page(){
    $("#page_content").load("Nomina");
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
            url: '<?php echo base_url(); ?>Dasa/UpdateExpend',
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
    $("#page_content").load("Nomina");
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