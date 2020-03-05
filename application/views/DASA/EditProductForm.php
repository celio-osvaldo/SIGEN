<br>
<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="container">
            <div class="card bg-card">
            <div class="container">
                <br>
                <form class="form-group" action="<?php echo base_url(); ?>Dasa/SendDataProductEdit" method="POST">
                <?php foreach ($product->result() as $row){ ?>
                  <input type="number" name="id" id="id" value="<?php echo "".$row->id_catalogo_producto.""; ?>" disabled>
                  <input type="text" name="nameProductE" id="nameProductE" value="<?php echo "".$row->catalogo_producto_nombre.""; ?>">
                  <select name="medidaE" id="medidaE">
                    <option value="<?php echo "".$row->catalogo_producto_umedida.""; ?>"><?php echo "".$row->catalogo_producto_umedida.""; ?></option>
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
                  <input type="number" name="priceE" id="priceE" value="<?php echo "".$row->catalogo_producto_precio.""; ?>">
                  <select name="providerE" id="providerE">
                      <option value="<?php echo "".$row->catalogo_proveedor_id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_id_catalogo_proveedor.""; ?></option>
                    <?php } ?>
                  </select>
                  <input type="hidden" name="dateE" id="dateE" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-primary">Save changes</button>
                </form>
              </div>
              <div class="modal-footer">
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
      </div>
