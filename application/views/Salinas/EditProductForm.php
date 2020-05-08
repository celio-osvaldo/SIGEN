 <form class="form-group" id="editCost" action="<?php echo base_url(); ?>Salinas/EditCostOfSale" method="POST">
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
                        <textarea class="form-control" name="commentE" id="commentE" cols="10" rows="8"></textarea>
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
        <button type="submit" class="btn btn-outline-success" id="updateCost">Guardar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
      </div>
                </form>