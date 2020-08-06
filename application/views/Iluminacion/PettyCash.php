<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Listado de reportes en caja chica</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newReport"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Reporte</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-12">
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
                            <th hidden="true">Tipo de movimiento</th>
                            <th></th>
                            <th>Monto</th>
                            <th>Folio de factura</th>
                            <th>Fecha de Factura</th>
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
                            <td>$</td>
                            <td id="<?php echo "money".$row->id_lista_caja_chica.""; ?>"><?php echo number_format($row->lista_caja_chica_reposicion,5,'.',',').""; ?></td>
                            <?php }else{ ?>
                            <td hidden="true" id="<?php echo "tipo".$row->id_lista_caja_chica.""; ?>">Egreso</td>
                            <td>$</td>
                            <td id="<?php echo "money".$row->id_lista_caja_chica.""; ?>"><?php echo number_format($row->lista_caja_chica_gasto,5,'.',',').""; ?></td>
                            <?php } ?>

                            <td id="<?php echo "bill".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_factura.""; ?></td>
                            <td id="<?php echo "dateB".$row->id_lista_caja_chica.""; ?>"><?php echo "".$row->lista_caja_chica_fecha_factura.""; ?></td>
                            <td align="center" id="<?php echo "bill_url".$row->id_lista_caja_chica.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->lista_caja_chica_url_factura.""; ?>" onclick="Display_bill(this.id)"><img src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
                            <td><a role="button" class="btn btn-outline-dark" onclick="Edit_Registro(this.id)" id="<?php echo "".$row->id_lista_caja_chica.""; ?>"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
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
  <form class="form-group" id="addReport" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col-md-6">
                <!-- <label class="control-label">Caja chica</label> -->
                <?php foreach ($max->result() as $row){ ?>
                    <input class="form-control" type="hidden" name="cashI" id="cashI" value="<?php echo "".($row->id_lista_caja_chica + 1).""; ?>">
                <?php } ?>
                <label class="label-control">Fecha de emisión</label>
                <input class="form-control" type="date" name="dateI" id="dateI">
                <label class = "control-label">Concepto</label>
                <input class="form-control" type="text" name="conceptI" id="conceptI" required="true" required="true">
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
                      <label class="form-check-label" for="exampleRadios2">
                        Ingreso
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label">Saldo</label>
                <div id="tm1" style="display:;">
                    <input class="form-control" onblur="Separa_Miles(this.id)" type="text" name="moneyEI" id="moneyEI">
                </div>
                <div id="tm2" style="display:none;">
                    <input class="form-control" type="text" name="moneyI" id="moneyI">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label class="label-control">Folio Factura/Comprobante</label>
        <input class="form-control" type="text" name="folioBillI" id="folioBillI" required="true">
    </div>
    <div class="col-md-4">
        <label class="label-control">Factura/Comprobante</label>
        <input class="form-control" type="file" name="upBillI" id="upBillI" accept="application/pdf, image/*">
    </div>
    <div class="col-md-4">
        <label class = "control-label">Fecha factura</label>
        <input class="form-control" type="date" name="dateBillI" id="dateBillI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
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
            <div class="col-md-6">
                <!-- <label class="control-label">Caja chica</label> -->
                <input class="form-control" type="text" hidden="true" name="edit_id_lista_caja_chica" id="edit_id_lista_caja_chica">
                <label class="label-control">Fecha de emisión</label>
                <input class="form-control" type="date" name="edit_dateI" id="edit_dateI">
                <label class = "control-label">Concepto</label>
                <input class="form-control" type="text" name="edit_conceptI" id="edit_conceptI" required="true" required="true">
            </div>

            <div class="col-md-6">
                <div class="row">
                    <div hidden="true" class="col-md-6">
                        <label for="">Tipo de movimiento</label>
                        <div class="form-check">
                          <input class="form-check-input moviment" type="radio" name="edit_radio" id="edit_radio_egreso" value="option1">
                          <label class="form-check-label" for="exampleRadios1">
                            Egreso
                        </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input moviment" type="radio" name="edit_radio" id="edit_radio_ingreso" value="option2">
                      <label class="form-check-label" for="exampleRadios2">
                        Ingreso
                    </label>
                </div>
            </div>
            <div class="col-md-6">
                <label class="control-label">Saldo</label>
  
                    <input class="form-control" type="text"  onblur="Separa_Miles(this.id)" name="edit_money" id="edit_money">

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label class="label-control">Folio Factura/Comprobante</label>
        <input class="form-control" type="text" name="edit_folioBillI" id="edit_folioBillI" required="true">
    </div>
    <div class="col-md-4">
        <label class="label-control">Factura/Comprobante</label>
        <input class="form-control" type="file" name="edit_upBillI" id="edit_upBillI" accept="application/pdf, image/*">
    </div>
    <div class="col-md-4">
        <label class = "control-label">Fecha factura</label>
        <input class="form-control" type="date" name="edit_dateBillI" id="edit_dateBillI">
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
    monto=$("#money"+id_lista_caja_chica).text();
    factura=$("#bill"+id_lista_caja_chica).text();
    fecha_factura=$("#dateB"+id_lista_caja_chica).text();
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

     $("#edit_money").val(monto);
     $("#edit_folioBillI").val(factura);
     $("#edit_dateBillI").val(fecha_factura);
}

function Update_Page(){
    $("#page_content").load("PettyCash");
 }


</script>