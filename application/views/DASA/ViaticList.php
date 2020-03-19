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
        <div class="container">
            <div class="card bg-card">
            <div class="container">
                <br>
                <div class="table-responsive-lg">
                    <table id="table_id" class="table table-striped table-hover display" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>No. Reporte</th>
                            <th>Fecha de reporte</th>
                            <th>Proyecto/Motivo</th>
                            <th>Total de días</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Total Gasto</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>>
                                <input type="hidden" name="idproduct" value="">
                                <a role="button" class="btn btn-outline-dark" name="acept" id="acept" data-toggle="modal" data-target="#EditBill"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
                                </a>
                            </td>
                        </tr>
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

<!-- modal new report of viatics -->
<div class="modal fade" id="newReport" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" action="<?php echo base_url(); ?>Dasa/AddProduct" method="POST">
      <div class="modal-body">
                <label class="control-label">Folio</label>
                <input class="form-control" type="text" name="folio" id="folio">
                <label class="label-control">Fecha de emisión</label>
                <input class="form-control" type="text" name="emitionDate" id="emitionDate" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>" disable>
                <label class = "control-label">Cliente</label>
                <input class="form-control" type="text" name="clientName" id="clientName">
                <label for="">Concepto</label>
                <input type="text" class="form-control">
                <label for="">Monto: $</label>
                <input type="text" class="form-control">
                <label for="">Comentario</label>
                <textarea class="form-control" name="" id="" cols="10" rows="10"></textarea>
                <label for="">Factura</label>
                <input class="form-control" type="file" accept="application/pdf, .xml">
                <label for="">Estatus</label>
                <select name="" id="" class="form-control">
                    <option value="">----Seleccionar----</option>
                </select>
                <label for="">Fecha de pago</label>
                <input type="date" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success" id="guardarnuevo">Guardar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
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
<script>
    $(document).ready(function(){
        $("#acept").click(function(){
            $("#page_content").load("DeatailsOfViatic");
        });
    });
</script>
