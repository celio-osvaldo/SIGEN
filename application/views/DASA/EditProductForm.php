<br>
<div class="row">
    
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="container">
            <div class="card bg-card">
            <div class="container">
                <br>
                <form action="<?php echo base_url(); ?>Dasa/SendDataProductEdit" method="POST">
                <?php foreach ($product->result() as $row){ ?>
                  <input type="hidden" name="idE" id="idE" value="<?php echo "".$row->id_catalogo_producto.""; ?>" disabled>
                  <input type="text" name="nameProductE" id="nameProductE" value="<?php echo "".$row->catalogo_producto_nombre.""; ?>">
                  <select name="medidaE" id="medidaE">
                    <option value="<?php echo "".$row->catalogo_producto_umedida.""; ?>"><?php echo "".$row->catalogo_producto_umedida.""; ?></option>
                  </select>
                  <input type="number" name="priceE" id="priceE" value="<?php echo "".$row->catalogo_producto_precio.""; ?>">
                  <select name="providerE" id="providerE">
                      <option value="<?php echo "".$row->catalogo_proveedor_id_catalogo_proveedor.""; ?>"><?php echo "".$row->catalogo_proveedor_id_catalogo_proveedor.""; ?></option>
                    <?php } ?>
                  </select>
                  <input class="form-control" type="hidden" name="EnterpriseID" id="EnterpriseID" value="1">
                  <input type="text" name="dateE" id="dateE" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>">
                  <input type="hidden" name="image" id="image">
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
