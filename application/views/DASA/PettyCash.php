<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Listado de caja chica</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Reporte</button>
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
                            <th>Fecha de emisión</th>
                            <th>Concepto</th>
                            <th>Tipo de movimiento</th>
                            <th>Saldo</th>
                            <th>Factura/Comprobante</th>
                            <th>Fecha de Factura</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><?php
                        foreach ($cash->result() as $row) {?>
                            <td><?php echo "".$row->lista_caja_chica_fecha.""; ?></td>
                            <td><?php echo "".$row->lista_caja_chica_concepto.""; ?></td>
                            <?php if ($row->lista_caja_chica_reposicion != ""){ ?>
                            <td>Ingreso</td>
                            <td><?php echo "".$row->lista_caja_chica_reposicion.""; ?></td>
                            <?php }else{ ?>
                            <td>Egreso</td>
                            <td><?php echo "".$row->lista_caja_chica_gasto.""; ?></td>
                            <?php } ?>
                            <td><?php echo "".$row->lista_caja_chica_factura.""; ?></td>
                            <td><?php echo "".$row->lista_caja_chica_fecha_factura.""; ?></td>
                            <td><form action="<?php echo base_url(); ?>Dasa/UpdateProductInfo" id="editProductInfo" method="POST">
                                        <input type="hidden" name="idproduct" value="">
                                        <button type="button" class="btn btn-outline-dark" name="acept" id="acept" data-toggle="modal" data-target="#EditBill"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
                                        </button>
                                    </form>
                            </td>
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
<div class="modal fade" id="NewBill" data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo reporte en caja chica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" action="<?php echo base_url(); ?>Dasa/AddReportPettyCash" method="POST">
      <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label class="control-label">Caja chica</label>
                        <?php foreach ($max->result() as $row){ ?>
                        <input class="form-control" type="text" name="cashI" id="cashI" value="<?php echo "".($row->id_lista_caja_chica + 1).""; ?>">
                        <?php } ?>
                        <label class="label-control">Fecha de emisión</label>
                        <input class="form-control" type="text" name="dateI" id="dateI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                        <label class = "control-label">Concepto</label>
                        <input class="form-control" type="text" name="conceptI" id="conceptI">
                        <label class="control-label">Tipo movimiento</label>
                        <input class="form-control" type="text" name="" id="" value="">
                        <label class="control-label">Saldo</label>
                        <input class="form-control" type="text" name="moneyI" id="moneyI" value="">
                    </div><div class="col-md-6">
                        <label class="control-label">Tipo movimiento</label>
                        <input class="form-control" type="text" name="" id="" value="">
                        <label class="control-label">Saldo</label>
                        <input class="form-control" type="text" name="moneyEI" id="moneyEI" value="">
                        <label class="label-control">Factura/Comprobante</label>
                        <input class="form-control" type="file" name="upBillI" id="upBillI" >
                        <label class = "control-label">Fecha factura</label>
                        <input class="form-control" type="text" name="dateBillI" id="dateBillI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>                    
                </div>
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

<!-- edit bill -->
<div class="modal fade" id="EditBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Factura</h5>
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
                <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                <label for="">Factura</label>
                <input class="form-control" type="text">
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
