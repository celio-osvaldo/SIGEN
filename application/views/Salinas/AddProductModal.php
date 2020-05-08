<div class="modal fade" id="NewProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" action="<?php echo base_url(); ?>Salinas/AddProduct" method="POST">
      <div class="modal-body">
                  <input class="form-control" type="hidden" name="id" id="id" disabled>
                  <label class="label-control">Nombre del producto</label>
                  <input class="form-control" type="text" name="nameProduct" id="nameProduct" required="true">
                  <label class="label-control">Unidad de medida</label>
                  <select class="form-control" name="medida" id="medida" required="true">
                    <option >----Seleccionar----</option>
                    <?php foreach ($measure->result() as $row){ ?>
                    <option value="<?php echo "".$row->id_uMedida.""; ?>"><?php echo "".$row->unidad_medida.""; ?></option>
                    <?php } ?>
                  </select>
                  <label class="label-control">Precio</label>
                  <input class="form-control" type="number" name="price" id="price">
                  <label class="label-control">Proveedor</label>
                  <select class="form-control" name="provider" id="provider">
                      <option>----Seleccionar----</option>
                  <?php foreach ($providers->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                  <?php } ?>
                  </select>
                  <input class="form-control" type="hidden" name="EnterpriseID" id="EnterpriseID" value="1">
                  <input type="hidden" name="date" id="date" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                  <input type="hidden" name="image" id="image">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-success" id="guardarnuevo">Guardar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
      </div>
                </form>
    </div>
  </div>
</div>