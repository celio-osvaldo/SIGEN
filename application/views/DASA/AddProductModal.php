<div class="modal fade" id="NewProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" action="<?php echo base_url(); ?>Dasa/" method="POST">
      <div class="modal-body">
                  <input type="number" name="id" id="id" disabled>
                  <input type="text" name="nameProductE" id="nameProductE">
                  <select name="medidaE" id="medidaE">
                    <option >----Seleccionar----</option>
                    <option value="Centímetros">Centímetros</option>
                    <option value="Gramos">Gramos</option>
                    <option value="Kilos">Kilos</option>
                    <option value="Libras">Libras</option>
                    <option value="Litros">Litros</option>
                    <option value="Metros">Metros</option>
                    <option value="Milimetros">Milimetros</option>
                    <option value="Onzas">Onzas</option>
                    <option value="Piezas">Piezas</option>
                    <option value="Toneladas">Toneladas</option>
                  </select>
                  <input type="number" name="priceE" id="priceE">
                  <select name="providerE" id="providerE">
                      <option>----Seleccionar----</option>
                  <?php foreach ($providers->result() as $row){ ?>
                      <option value="<?php echo "".$row->id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa.""; ?></option>
                  <?php } ?>
                  </select>
                  <input type="text" name="EnterpriseID" id="EnterpriseID">
                  <input type="hidden" name="dateE" id="dateE" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-success" id="guardarnuevo">Guardar</button>
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="btncancelar">Cancelar</button>
      </div>
                </form>
    </div>
  </div>
</div>