<div class="row">
    <div class="col-md-1"></div>
  <div class="col-md-7">
    <h3 align="center">Catálogo de productos</h3>
  </div>
  <div class="col-md-4">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewProduct"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar producto</button>
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
                    <table id="table_id" class="table table-hover display table-striped" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Ud. medida</th>
                            <th>Precio</th>
                            <th>Proveedor</th>
                            <th>Fecha de act.</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($inventories->result() as $row) {?>
                            <tr>
                                <td><?php echo "".$row->id_catalogo_producto.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_nombre.""; ?></td>
                                <td><?php echo "".$row->unidad_medida.""; ?></td>
                                <td><?php echo "$ ".$row->catalogo_producto_precio.""; ?></td>
                                <td><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_fecha_actualizacion.""; ?></td>
                                 <td>
                                    <form action="<?php echo base_url(); ?>Salinas/UpdateProductInfo" id="editProductInfo" method="POST">
                                        <input type="hidden" name="idproduct" value="<?php echo "".$row->id_catalogo_producto.""; ?>">
                                        <button type="submit" class="btn btn-outline-secondary" name="acept" id="acept"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
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

<!-- modal add product -->
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
<!-- end modal -->

<br>



<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
