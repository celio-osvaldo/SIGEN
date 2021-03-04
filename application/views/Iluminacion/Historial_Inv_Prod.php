
<div class="row" >
  <div class="col-md-9" align="center">
    <h5>Historial de Precio de Producto/Servicio</h5>
  </div>
  <div class="col-md-3" align="center">
    <button type="button" onclick="Regresar()" class="btn btn-success" >Regresar a Almacen de Productos</button>
  </div>
</div>

<div class="row" align="center">
  <div class="col-md-12">
    <span class="badge badge-info col-md-2">
      Nombre Producto:<hr><?php echo $Product_Inv_info->prod_alm_nom; ?>
    </span>
    <span class="badge badge-info col-md-2">
      Modelo:<hr><?php echo $Product_Inv_info->prod_alm_modelo; ?>
    </span>
    <span class="badge badge-info col-md-2">
      Existencia Actual:<hr><?php echo $Product_Inv_info->prod_alm_exist; ?>
    </span>
    <span class="badge badge-info col-md-2">
      Precio Unitario Actual:<hr>$<?php echo number_format($Product_Inv_info->prod_alm_prec_unit,2,'.',','); ?>
    </span> 
    <span class="badge badge-info col-md-2">
      Precio Venta Actual:<hr>$<?php echo number_format($Product_Inv_info->prod_alm_precio_venta,2,'.',','); ?>
    </span>
  </div>
</div>
<div class="row" align="center">
  <div class="col-md-12">
    <span class="badge badge-info col-md-6">
      Descripción:<hr><?php echo $Product_Inv_info->prod_alm_descripcion; ?>
    </span>
    <span class="badge badge-info col-md-4">
      Ultima Fecha de Actualización:<hr><?php echo $ult_fecha->historial_almacen_producto_fecha; ?>
    </span>
  </div>  
</div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_Inv_Prod" class="table table-striped table-hover display" style="font-size: 9pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>

          <th>Nombre Producto</th>
          <th>Unidad de Medida</th>
          <th>Existencia Anterior</th>
          <th>Existencia Nueva</th>
          <th>Precio Unitario anterior</th>
          <th>Precio de Venta anterior</th>
          <th>Precio Unitario Nuevo</th>
          <th>Precio de Venta Nuevo</th>
          <th>Tipo de Movimiento</th>
          <th>Procedencia</th>
          <th>Referencia</th>
          <th>Fecha de Actualización</th>
        </tr>
      </thead>
      <tbody>
       <?php 
       foreach ($historial_inv_prod->result() as $row) {
         ?>
         <tr>

          <td><?php echo "".$row->prod_alm_nom.""; ?></td>
          <td><?php echo "".$row->unidad_medida.""; ?></td>
          <td><?php echo $row->historial_almacen_producto_cantidad_old; ?></td>
          <td><?php echo $row->historial_almacen_producto_cantidad_new; ?></td>
          <td>$<?php echo number_format($row->prod_alm_prec_unit_old,2,'.',','); ?></td>
          <td>$<?php echo number_format($row->prod_alm_precio_venta_old,2,'.',','); ?></td>
          <td>$<?php echo number_format($row->prod_alm_prec_unit_new,2,'.',','); ?></td>
          <td>$<?php echo number_format($row->prod_alm_precio_venta_new,2,'.',',') ?></td>
          <td><?php echo $row->historial_almacen_producto_movimiento ?></td>
          <td><?php echo $row->historial_almacen_producto_procedencia ?></td>
          <td><?php echo $row->historial_almacen_producto_referencia ?></td>
          <td><?php echo $row->historial_almacen_producto_fecha ?></td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>


<script type="text/javascript">
  $(document).ready( function () {
    $('#table_Inv_Prod').DataTable();
  });

  function Regresar(){
    $("#page_content").load("InventarioProductos");
  }
</script>
