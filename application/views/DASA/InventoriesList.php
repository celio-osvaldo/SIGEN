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
                                <td><?php echo "".$row->catalogo_producto_umedida.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_precio.""; ?></td>
                                <td><?php echo "".$row->catalogo_proveedor_empresa.""; ?></td>
                                <td><?php echo "".$row->catalogo_producto_fecha_actualizacion.""; ?></td>
                                 <td>
                                    <form action="<?php echo base_url(); ?>Dasa/UpdateProductInfo" id="editProductInfo" method="POST">
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

<br>

<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
    } );
</script>
