<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Facturas de Venta</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewBill"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Factura</button>
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
                            <th>No. Folio</th>
                            <th>Fecha de emisión</th>
                            <th>Cliente</th>
                            <th>Monto</th>
                            <th>Concepto</th>
                            <th>Observación</th>
                            <th>Factura</th>
                            <th>Estatus</th>
                            <th>Fecha de Pago</th>
                            <th>Modificar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><?php
                        foreach ($bill->result() as $row) {?>
                            <td><?php echo "".$row->id_gasto_venta.""; ?></td>
                            <td><?php echo "".$row->gasto_venta_fecha.""; ?></td>
                            <td><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                            <td><?php echo "".$row->gasto_venta_monto.""; ?></td>
                            <td><?php echo "".$row->gasto_venta_concepto.""; ?></td>
                            <td><?php echo "".$row->gasto_venta_observacion.""; ?></td>
                            <td><?php echo "".$row->gasto_venta_factura.""; ?></td>
                            <td><?php echo "".$row->gasto_venta_estado_pago.""; ?></td>
                            <td><?php echo "".$row->gasto_venta_fecha_pago.""; ?></td>
                            <td><form action="<?php echo base_url(); ?>Dasa/UpdateProductInfo" id="editProductInfo" method="POST">
                                        <input type="hidden" name="idproduct" value="id_gasto_venta">
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
        <form class="form-group" action="<?php echo base_url(); ?>Dasa/AddBillOfSale" method="POST">
      <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Folio:</label>
                         <?php foreach ($max->result() as $row){ ?>
                            <input class="form-control" type="number" name="folioI" id="folioI" value="<?php echo "".($row->id_gasto_venta + 1).""; ?>">
                        <?php } ?>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <label class="label-control">Fecha de emisión:</label>
                        <input class="form-control" type="text" name="emitionDateI" id="emitionDateI" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-md-12">
                        <label class = "control-label">Cliente:</label>
                        <select class="form-control" type="text" name="clientNameI" id="clientNameI" required="true">
                            <option>Seleccionar</option>
                            <?php foreach ($woks->result() as $row){ ?>
                                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="">Concepto:</label>
                        <input type="text" id="conceptI" name="conceptI" class="form-control">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <label for="">Monto:<input type="text" class="form-control" name="amountI" id="amountI">
                    </div>
                    <div class="col-md-6">
                        <label for="">Comentario:</label>
                        <textarea class="form-control" name="coment" id="coment" cols="10" rows="8"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="">Factura:</label>
                        <input class="form-control" name="billI" id="billI" type="text">
                        <label for="">Estatus:</label>
                        <input type="text" name="statusI" id="statusI" class="form-control" value="Autorización Solicitada">
                        <label for="">Fecha de pago:</label>
                        <input type="date" id="dateI" name="dateI" class="form-control" onchange="DateObtain(this)">
                        
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
<div class="modal fade" id="EditBill"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva factura</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" action="<?php echo base_url(); ?>Dasa/AddBillOfSale" method="POST">
      <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <label class="control-label">Folio:</label>
                         <?php foreach ($max->result() as $row){ ?>
                            <input class="form-control" type="number" name="folioE" id="folioE" value="<?php echo "".($row->id_gasto_venta + 1).""; ?>">
                        <?php } ?>
                    </div>
                    <div class="col-md-6"></div>
                    <div class="col-md-3">
                        <label class="label-control">Fecha de emisión:</label>
                        <input class="form-control" type="text" name="emitionDateE" id="emitionDateE"  value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                    </div>
                    <div class="col-md-12">
                        <label class = "control-label">Cliente:</label>
                        <select class="form-control" type="text" name="clientNameE" id="clientNameE" required="true">
                            <option>Seleccionar</option>
                            <?php foreach ($woks->result() as $row){ ?>
                                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label for="">Concepto:</label>
                        <input type="text" id="conceptE" name="conceptE" class="form-control">
                    </div>
                    <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <label for="">Monto:</label><input type="text" class="form-control" name="amountE" id="amountE">
                    </div>
                    <div class="col-md-6">
                        <label for="">Comentario:</label>
                        <textarea class="form-control" name="comenE" id="comenE" cols="10" rows="8"></textarea>
                    </div>
                    <div class="col-md-6">
                        <label for="">Factura:</label>
                        <input class="form-control" name="billE" id="billE" type="text">
                        <label for="">Estatus:</label>
                        <input type="text" name="statusE" id="statusE" class="form-control" value="Autorización Solicitada">
                        <label for="">Fecha de pago:</label>
                        <input type="date" id="dateE" name="dateE" class="form-control" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}">
                        
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

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
<script>
    function DateObtain(e)
    {

      var date = moment(e.value);
      console.log("Original Date:" + e.value);
      console.log("Out Date: " + fecha.format("YYYY/MM/DD"));
    }
</script>