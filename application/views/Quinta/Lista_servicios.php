<div class="row">
    <div class="col-md-8">
        <h3 align="center">Listado de Gastos Servicios/Mantenimientos</h3>
    </div>
    <div class="col-md-4">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Pago Servicio/Mantenimiento</button>
    </div>
</div>

<div class="card bg-card">
    <div class="table-responsive">
        <table id="table_Servicio" class="table table-striped table-hover display" style="font-size: 9pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                <tr>
                    <th>Folio</th>
                    <th>Fecha de Pago</th>
                    <th>Concepto de Pago</th>
                    <th>Monto</th>
                    <th>Tipo de Pago</th>
                    <th>Comentario</th>
                    <th>Factura</th>
                    <th hidden="true">url_factura</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($lista_nomina->result() as $row) {?>
                    <tr>
                        <td id="<?php echo "folio".$row->id_serv_mtto.""; ?>"><?php echo "".$row->serv_mtto_folio.""; ?></td>
                        <td id="<?php echo "fecha".$row->id_serv_mtto.""; ?>"><?php echo "".$row->serv_mtto_fecha_emision.""; ?></td>
                        <td id="<?php echo "concepto".$row->id_serv_mtto.""; ?>"><?php echo "".$row->serv_mtto_concepto.""; ?></td>
                        <td id="<?php echo "monto".$row->id_serv_mtto.""; ?>">$<?php echo number_format($row->serv_mtto_monto,2,'.',',').""; ?></td>
                        <td id="<?php echo "referencia".$row->id_serv_mtto.""; ?>"><?php echo "".$row->serv_mtto_referencia_pago.""; ?></td>
                        <td id="<?php echo "comentario".$row->id_serv_mtto.""; ?>"><?php echo "".$row->serv_mtto_comentario.""; ?></td>
                        <td align="center" id="<?php echo "factura".$row->id_serv_mtto.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->id_serv_mtto.""; ?>"  onclick="Display_bill(this.id)"><img height="20" src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
                        <td hidden="true" id="<?php echo "url_factura".$row->id_serv_mtto.""; ?>"><?php echo $row->serv_mtto_url_factura ?></td>
                        <td>
                            <a role="button" class="btn btn-outline-dark" onclick="Edit_nomina(this.id)" id="<?php echo "".$row->id_serv_mtto.""; ?>" data-toggle="modal" data-target="#editnomina"><img height="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                            <a role="button" class="btn btn-outline-dark" onclick="Delete_pago(this.id)" id="<?php echo "".$row->id_serv_mtto.""; ?>" data-toggle="modal" data-target="#deletenomina"><img height="20" src="..\Resources\Icons\delete.ico" alt="Eliminar" style="filter: invert(100%)" /></a>
                        </td>
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
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro de Gasto Servicio/Mantenimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form class="form-group" id="newExpend">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">Folio Factura/Nota:</label>
                <input type="text" name="new_folio" id="new_folio" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="label-control">Fecha de pago:</label>
                <input class="form-control" type="date" name="new_fecha" id="new_fecha" value="<?php date_default_timezone_set("America/Mexico_City"); echo date("Y-m-d"); ?>" required="true">
            </div>
            <div class="col-md-3">
                <label class="label-control">Monto:</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="new_monto" id="new_monto" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="label-control">Concepto de Pago:</label>
                <input type="text" maxlength="200" id="new_concepto" name="new_concepto" class="form-control" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label-control">Tipo de Pago:</label>
                <select id="add_ref" name="add_ref" class="form-control">
                    <option value="Transferencia" selected="true">Transferencia</option>
                    <option value="Deposito_cheque">Depósito en Cheque</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>
            <div class="col-md-8">
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
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" >Cancelar</button>
    </div>
</form>

</div>
</div>
</div>
<!-- end modal -->


<!-- edit bill -->
<div class="modal fade" id="editserv_mtto"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Datos Pago Servicio/Mtto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form class="form-group" id="edit_serv_mtto">
      <div class="modal-body">
        <input type="text" name="edit_id_serv_mtto" id="edit_id_serv_mtto" hidden="true">
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">Folio Factura/Nota:</label>
                <input type="text" name="edit_folio" id="edit_folio" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="label-control">Fecha de pago:</label>
                <input class="form-control" type="date" name="edit_fecha" id="edit_fecha"  required="true">
            </div>
            <div class="col-md-3">
                <label class="label-control">Monto:</label>
                <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="edit_monto" id="edit_monto" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="label-control">Concepto de Pago:</label>
                <input type="text" maxlength="200" id="edit_concepto" name="edit_concepto" class="form-control" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label-control">Tipo de Pago:</label>
                <select id="edit_ref" name="edit_ref" class="form-control">
                    <option value="Transferencia" selected="true">Transferencia</option>
                    <option value="Deposito_cheque">Depósito en Cheque</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="label-control">Comentario:</label>
                <textarea type="text" class="form-control" name="edit_comentario" id="edit_comentario" maxlength="300"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="label-control">Factura:</label>
                <input type="file" class="form-control" name="editBill" id="editBill" accept="application/pdf, image/*">
            </div>                            
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success submitBtn" id="update_nomina">Actualizar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" >Cancelar</button>
    </div>
</form>
</div>
</div>
</div>
<!-- end modal -->




<!-- delete bill -->
<div class="modal fade" id="deleteserv_mtto"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: red;">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Registro Pago Servicio/Mantenimiento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <form class="form-group" id="delete_serv_mtto">
      <div class="modal-body" disabled="true">
        <div class="modal-body">
        <input type="text" name="delete_id_serv_mtto" id="delete_id_serv_mtto" hidden="true">
        <div class="row">
            <div class="col-md-3">
                <label class="label-control">Folio Factura/Nota:</label>
                <input type="text" disabled="true" name="delete_folio" id="delete_folio" class="form-control">
            </div>
            <div class="col-md-3">
                <label class="label-control">Fecha de pago:</label>
                <input class="form-control" disabled="true" type="date" name="delete_fecha" id="delete_fecha"  required="true">
            </div>
            <div class="col-md-3">
                <label class="label-control">Monto:</label>
                <input type="text" disabled="true" onblur="SeparaMiles(this.id)" class="form-control" name="delete_monto" id="delete_monto" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="label-control">Concepto de Pago:</label>
                <input type="text" disabled="true" maxlength="200" id="delete_concepto" name="delete_concepto" class="form-control" required="true">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="label-control">Tipo de Pago:</label>
                <select disabled="true" id="delete_ref" name="delete_ref" class="form-control">
                    <option value="Transferencia" selected="true">Transferencia</option>
                    <option value="Deposito_cheque">Depósito en Cheque</option>
                    <option value="Efectivo">Efectivo</option>
                </select>
            </div>
            <div class="col-md-8">
                <label class="label-control">Comentario:</label>
                <textarea disabled="true" type="text" class="form-control" name="delete_comentario" id="delete_comentario" maxlength="300"></textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success submitBtn" >Eliminar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" >Cancelar</button>
    </div>
</form>
</div>
</div>
</div>



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




<!-- script by add new costofsale -->
<script>
    $(document).ready(function(e){
        $('#table_Servicio').DataTable({
            "bSort": true,
            "order": [ 0, "desc" ]
        });
        $("#newExpend").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>Quinta/AddNew_Servicio',
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
                    alert('Registro de pago Servicio/Mantenimiento agregado correctamente');
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

    $("#edit_serv_mtto").on('submit', function(e){
        e.preventDefault();
        //fecha=$("#editDate").val();
        //fecha2=$("#editEmitionDate").val();
        //alert(fecha+" "+fecha2);
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Quinta/Update_Serv_Mtto',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#edit_serv_mtto').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                //alert(data);
                if(data == 1){
                    $('#edit_serv_mtto')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Reporte de Pago Servicio/Mantenimiento modificado correctamente');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
              }
              $('#edit_serv_mtto').css("opacity","");
              $(".submitBtn").removeAttr("disabled");
          }
      });
    });

    $("#delete_serv_mtto").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Quinta/Delete_Serv_Mtto',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#deleteserv_mtto').css("opacity",".5");
            },
            success: function(data){
                // $('.statusMsg').html('');
                //alert(data);
                if(data){
                    $('#delete_serv_mtto')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Reporte de Pago de Servicio/Mantenimiento eliminado correctamente');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Intentelo nuevamente');
              }
              $('#delete_serv_mtto').css("opacity","");
              $(".submitBtn").removeAttr("disabled");
          }
      });
    });
});


function Edit_nomina($id){
    var id=$id;
    fecha=$("#fecha"+id).text();
    folio=$("#folio"+id).text();
    concepto=$("#concepto"+id).text();
    monto=$("#monto"+id).text().replace('$','');
    comentario=$("#comentario"+id).text();
    referencia=$("#referencia"+id).text();

    $("#editserv_mtto").modal();
    $("#edit_id_serv_mtto").val(id);
    $("#edit_fecha").val(fecha);
    $("#edit_folio").val(folio);
    $("#edit_concepto").val(concepto);
    $("#edit_monto").val(monto);
    $("#edit_comentario").val(comentario); 
    $("#edit_ref").val(referencia).attr('selected',true);   
}

function Delete_pago($id_gasto_serv_mtto){
    var id=$id_gasto_serv_mtto;
    fecha=$("#fecha"+id).text();
    folio=$("#folio"+id).text();
    concepto=$("#concepto"+id).text();
    monto=$("#monto"+id).text().replace('$','');
    comentario=$("#comentario"+id).text();
    referencia=$("#referencia"+id).text();
    url_factura=$("#url_factura"+id).text();


   $("#deleteserv_mtto").modal();
    $("#delete_id_serv_mtto").val(id);
    $("#delete_fecha").val(fecha);
    $("#delete_folio").val(folio);
    $("#delete_concepto").val(concepto);
    $("#delete_monto").val(monto);
    $("#delete_comentario").val(comentario); 
    $("#delete_ref").val(referencia).attr('selected',true);   
}

function Update_Page(){
    $("#page_content").load("Servicios");
}

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("Servicios");
}

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