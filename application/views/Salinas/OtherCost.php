<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Listado de otros gastos</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Gasto</button>
  </div>
  <div class="col-md-1"></div>
</div>

<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-12">
        <div class="container">
            <div class="card bg-card">
            <div class="margins">
                <div class="table-responsive-lg">
                    <table id="table_id" class="table table-striped table-hover display" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>No. Folio</th>
                            <th>Fecha de emisión</th>
                            <th>Concepto</th>
                            <th></th>
                            <th>Monto</th>
                            <th>Comentario</th>
                            <th>Fecha de Pago</th>
                            <th>Factura</th>
                            <th>url_factura</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><?php
                        foreach ($expens->result() as $row) {?>
                            <td id="<?php echo "bill".$row->id_OGasto.""; ?>"><?php echo "".$row->folio.""; ?></td>
                            <td id="<?php echo "emition".$row->id_OGasto.""; ?>"><?php echo "".$row->fecha_emision.""; ?></td>
                            <td id="<?php echo "concept".$row->id_OGasto.""; ?>"><?php echo "".$row->concepto.""; ?></td>
                            <td>$</td>
                            <td id="<?php echo "expend".$row->id_OGasto.""; ?>"><?php echo number_format($row->saldo,2,'.',',').""; ?></td>
                            <td id="<?php echo "comment".$row->id_OGasto.""; ?>"><?php echo "".$row->comentario.""; ?></td>
                            <td id="<?php echo "dateEx".$row->id_OGasto.""; ?>"><?php echo "".$row->fecha_pago_factura.""; ?></td>
                            <td align="center" id="<?php echo "factura".$row->id_OGasto.""; ?>"><a role="button" class="btn btn-outline-dark openfile" id="<?php echo "".$row->id_OGasto.""; ?>"  onclick="Display_bill(this.id)"><img src="<?php echo base_url() ?>Resources/Icons/invoice_icon_128337.ico" style="filter: invert(100%)"></a></td>
                            <td id="<?php echo "url_factura".$row->id_OGasto.""; ?>"><?php echo $row->factura ?></td>
                            <td><a role="button" class="btn btn-outline-dark" onclick="Edit_product(this.id)" id="<?php echo "".$row->id_OGasto.""; ?>" data-toggle="modal" data-target="#editCostSale"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a></td>
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
        <form class="form-group" id="newExpend">

          <div class="modal-body">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="hidden" name="id" id="id">
                            <label class="control-label">Folio Factura/Comprobante:</label>
                            <input class="form-control" type="text" name="addFolio" id="addFolio" value="" required="true">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" type="date" name="addEmitionDate" id="addEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-8">
                            <label for="">Concepto:</label>
                            <input type="text" id="addConcept" name="addConcept" class="form-control" required="true">
                            <input type="hidden" id="addCompany" name="addCompany" value="2">
                        </div>
                        <div class="col-md-8">
                            <label for="">Comentario:</label>
                            <textarea id="addComment" name="addComment" class="form-control" required="true"></textarea>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label for="">Monto:
                            <input type="text" onblur="SeparaMiles(this.id)" class="form-control" name="addAmount" id="addAmount" required="true">
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha de pago:</label>
                            <input type="date" id="addDate" name="addDate" class="form-control" onchange="DateObtain(this)" required="true" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="">Comprobante:</label>
                            <input class="form-control" name="addBill" id="addBill" type="file" accept="application/pdf, image/*">
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
                    <div class="col-md-3">
                            <input type="hidden" name="idE" id="idE">
                            <label class="control-label">Folio Factura/Comprobante:</label>
                            <input class="form-control" type="text" name="editFolio" id="editFolio" value="" required="true">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de emisión:</label>
                            <input class="form-control" type="date" name="editEmitionDate" id="editEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-8">
                            <label for="">Concepto:</label>
                            <input type="text" id="editConcept" name="editConcept" class="form-control" required="true">
                            <input type="hidden" id="editCompany" name="editCompany" value="2">
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-3">
                            <label for="">Monto:
                            <input type="text" class="form-control" onblur="SeparaMiles(this.id)" name="editAmount" id="editAmount" required="true">
                        </div>
                    <div class="col-md-6">
                        <label for="">Comentario:</label>
                        <textarea class="form-control" name="editComment" id="editComment" cols="8" rows="4" required="true"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="">Fecha de pago:</label>
                        <input type="date" id="editDate" name="editDate" class="form-control" required="true" >
                        <label for="">Comprobante:</label>
                        <input class="form-control" name="editBill" id="editBill" type="file" accept="application/pdf, image/*">
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
            url: '<?php echo base_url(); ?>Salinas/AddNewExpend',
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
                alert(data);
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
            alert('Please select a valid image file (PDF).');
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
    var expend=$("#expend"+$id).text();
    var comment=$("#comment"+$id).text();
    var bill=$("#bill"+$id).text();
    var dateEx=$("#dateEx"+$id).text();

    $("#editCostSale").modal();
    $("#idE").val(id);
    $("#editFolio").val(enviroment);
    $("#editEmitionDate").val(emition);
    $("#editConcept").val(concept);
    $("#editAmount").val(expend);
    $("#editComment").val(comment);
    $("#editDate").val(dateEx);
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
            url: '<?php echo base_url(); ?>Salinas/UpdateExpend',
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
            alert('Please select a valid image file (PDF).');
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
    var url="<?php echo base_url()?>"+$("#url_factura"+$id).text();
    var verifica=url.split(".");
    //alert(verifica[1]);
    if(verifica[1]){
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