<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Reportes de Viáticos</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newReport"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Reporte</button>
  </div>
  <div class="col-md-1"></div>
</div>

        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card bg-card">
                    <div class="margins">
                        <br>
                        <div class="table-responsive-lg">
                            <table id="table_id" class="table table-striped table-hover display" style="font-size: 10pt;">
                            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                                <tr>
                                    <th>Fecha de reporte</th>
                                    <th>Proyecto/Motivo</th>
                                    <th>Total de días</th>
                                    <th>Fecha inicio</th>
                                    <th>Fecha fin</th>
                                    <th></th>
                                    <th>Total Gasto</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr><?php foreach ($report_viatics->result() as $row) {?>
                                    <td><?php echo "".$row->viaticos_fecha.""; ?></td>
                                    <td><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                                    <td><?php echo "".$row->viaticos_total_días.""; ?></td>
                                    <td><?php echo "".$row->viaticos_fecha_ini.""; ?></td>
                                    <td><?php echo "".$row->viaticos_fecha_fin.""; ?></td>
                                    <td>$</td>
                                    <td><?php echo "".$row->viaticos_total.""; ?></td>
                                    <td align="center"><a role="button" class="btn btn-outline-dark" onclick="Details(this.id)" id="<?php echo $row->id_viaticos; ?>"><img src="..\Resources\Icons\lupa.ico" alt="Editar" style="filter: invert(100%)" /></a>
                                    </td>
                                </tr><?php } ?>
                            </tbody>
                            </table>
                        </div>
                        <br>
                    </div>
            </div>
            </div>
            <div class="col-md-1"></div>
        </div>

<!-- new report of viatics modal -->
<div class="modal fade" id="newReport"data-backdrop="static" tabindex="-1" role="dialog">
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
                        <div class="col-md-3">
                            <input class="form-control" type="hidden" name="idreport" id="idreport">
                            <input type="hidden" name="employ" id="employ">
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-3">
                            <label class="label-control">Fecha de reporte:</label>
                            <input class="form-control" type="text" name="addEmitionDate" id="addEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>

                        <div class="col-md-12">
                            <label class="control-label">Proyecto:</label>
                            <select class="form-control" type="text" name="addClientName" id="addClientName" required="true">
                                <?php foreach ($works->result() as $row){ ?>
                                <option selected value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-5">
                            <label for="">Fecha de inicio:</label>
                            <input type="date" id="addStartDate" name="addStartDate" class="form-control" required="true" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                            <input type="hidden" id="addCompany" name="addCompany" value="2">
                        </div>

                        <div class="col-md-2">
                            <input class="form-control" type="hidden" name="totalDays" id="totalDays">
                            <input type="hidden" name="addMoney" id="addMoney" class="form-control">
                        </div>
   
                        <div class="col-md-5">
                            <label for="">Fecha final::
                            <input type="date" class="form-control" name="AddDateEnd" id="AddDateEnd" required="true" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        </div>

                  </div>
              </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="saveReport">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancel">Cancelar</button>
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

<!-- <script>
    $(document).ready(function(){
        $("#acept").click(function(){
            $("#page_content").load("DeatailsOfViatic");
        });
    });
</script> -->

<!-- script by add new report in petty cash -->
<script>
$(document).ready(function(e){
    $("#addReport").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Dasa/AddViaticReport',
            data: $(this).serialize(),
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addReport').css("opacity",".5");
            },
            success: function(data){
                if(data == 1){
                    $('#addReport')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Información del reporte de viatico actualizada');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#addReport').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
});

function CloseModal(){
    $('#cancel').click();
    $('#newReport').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetAllViatics");
  }
</script>

<script>
    function DateObtain(e)
    {
      var date = moment(e.value);
      console.log("Original Date:" + e.value);
      console.log("Out Date: " + fecha.format("YYYY/MM/DD"));
    }
</script>

<script type="text/javascript">
    function Details($id) {
   alert('Ver Detalles');
   var id_viatico=$id;
   $("#page_content").load("DeatailsOfViatic",{id_viatico:id_viatico});
                      
 }
</script>