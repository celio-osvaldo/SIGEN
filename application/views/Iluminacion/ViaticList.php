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

<div class="card bg-card">
    <div class="margins">
       <div class="table-responsive">
        <table id="table_id" class="table table-striped table-hover display" style="font-size: 10pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                <tr>
                    <th>Fecha de reporte</th>
                    <th>Proyecto</th>
                    <th>Total de días</th>
                    <th>Fecha inicio</th>
                    <th>Fecha fin</th>
                    <th>Monto total</th>
                    <th>Detalles</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($report_viatics->result() as $row) {?>
                <tr>
                    <td id="<?php echo "fecha".$row->id_viaticos.""; ?>"><?php echo "".$row->viaticos_fecha.""; ?></td>
                    <td id="<?php echo "proyecto".$row->id_viaticos.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                    <td id="<?php echo "total_dias".$row->id_viaticos.""; ?>"><?php echo "".$row->viaticos_total_dias.""; ?></td>
                    <td id="<?php echo "fecha_ini".$row->id_viaticos.""; ?>"><?php echo "".$row->viaticos_fecha_ini.""; ?></td>
                    <td id="<?php echo "fecha_fin".$row->id_viaticos.""; ?>"><?php echo "".$row->viaticos_fecha_fin.""; ?></td>
                    <td id="<?php echo "monto".$row->id_viaticos.""; ?>">$<?php echo number_format($row->viaticos_total,5,'.',',').""; ?></td>
                    <td align="center"><a role="button" class="btn btn-outline-dark" onclick="Details(this.id)" id="<?php echo $row->id_viaticos; ?>"><img height="20" width="20" src="..\Resources\Icons\lupa.ico" alt="Editar" style="filter: invert(100%)" /></a>
                    </td>
                    <td>
                        <a role="button" class="btn btn-outline-dark" onclick="Edit_Registro(this.id)" id="<?php echo "".$row->id_viaticos.""; ?>"><img height="20" width="20" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                    </td>
                </tr>
            <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
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
                    <input class="form-control" type="hidden" name="idreport" id="idreport">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="label-control">Fecha de reporte:</label>
                            <input class="form-control" type="date" name="addEmitionDate" id="addEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                        </div>
                        <div class="col-md-9">
                            <label class="control-label">Proyecto:</label>
                            <select class="form-control" type="text" name="addClientName" id="addClientName" required="true">
                                <?php foreach ($works->result() as $row){ ?>
                                    <option selected value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
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
                            <label for="">Fecha final:</label>
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


<!-- edit report of viatics modal -->
<div class="modal fade" id="edit_newReport"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo reporte de viaticos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="edit_addReport">

          <div class="modal-body">
            <input class="form-control" type="text" hidden="true" name="edit_idreport" id="edit_idreport">
            <div class="row">
                <div class="col-md-3">
                    <label class="label-control">Fecha de reporte:</label>
                    <input class="form-control" type="date" name="edit_addEmitionDate" id="edit_addEmitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" required="true">
                </div>
                <div class="col-md-9">
                    <label class="control-label">Proyecto:</label>
                    <select class="form-control" type="text" name="edit_addClientName" id="edit_addClientName" required="true">
                        <?php foreach ($works->result() as $row){ ?>
                                 <option selected value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <label for="">Fecha de inicio:</label>
                    <input type="date" id="edit_addStartDate" name="edit_addStartDate" class="form-control" required="true" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    <input type="hidden" id="addCompany" name="addCompany" value="2">
                </div>
                <div class="col-md-2">
                    <input class="form-control" type="hidden" name="edit_totalDays" id="edit_totalDays">
                    <input type="hidden" name="edit_addMoney" id="edit_addMoney" class="form-control">
                </div>
                <div class="col-md-5">
                    <label for="">Fecha final:</label>
                    <input type="date" class="form-control" name="edit_AddDateEnd" id="edit_AddDateEnd" required="true" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-outline-success submitBtn" id="edit_saveReport">Guardar</button>
            <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancel">Cancelar</button>
        </div>
        </form>
    </div>
    </div>
</div>
<!-- end modal -->



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
            url: '<?php echo base_url(); ?>Iluminacion/AddViaticReport',
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


    $("#edit_addReport").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Iluminacion/UpdateViaticReport',
            data: $(this).serialize(),
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addReport').css("opacity",".5");
            },
            success: function(data){
                //alert(data);
                if(data){
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

      var date1 = $("#addStartDate");
      var date2 = $("#AddDateEnd");

      var nacimiento = moment(date1.val());
      var hoy = moment(date2.val());



      var anios = hoy.diff(nacimiento,"days");
      $("#totalDays").val(anios);

      console.log("Original Date:" + e.value);
      console.log("Out Date: " + date.format("YYYY/MM/DD"));
      console.log("res1 " + nacimiento);
      console.log("res2 " + hoy);
      console.log("diff " + anios);
    }

</script>

<script type="text/javascript">

  function Edit_Registro($id){
    var id_viaticos=$id;
    fecha=$("#fecha"+id_viaticos).text();
    proyecto=$("#proyecto"+id_viaticos).text();
    total_dias=$("#total_dias"+id_viaticos).text();
    fecha_inicio=$("#fecha_ini"+id_viaticos).text();
    fecha_fin=$("#fecha_fin"+id_viaticos).text();
    //monto=$("#monto"+id_viaticos).text();
    //importe=importe.replace(/\,/g, '');

    //alert(id_viaticos+" "+fecha+" "+proyecto+" "+total_dias+" "+fecha_inicio+" "+fecha_fin+" "+monto);

    $("#edit_newReport").modal();
    $("#edit_idreport").val(id_viaticos);
    $("#edit_addEmitionDate").val(fecha);
    $("#edit_addClientName option:contains("+proyecto+")").attr('selected', true);
    $("#edit_addStartDate").val(fecha_inicio);
    $("#edit_totalDays").val(total_dias);
    //$("#edit_addMoney").val(monto);
    $("#edit_AddDateEnd").val(fecha_fin);

    }


    function Details($id) {
   // alert('Ver Detalles');
   var id_viatico=$id;
   $("#page_content").load("DeatailsOfViatic",{id_viatico:id_viatico});
                      
 }
</script>