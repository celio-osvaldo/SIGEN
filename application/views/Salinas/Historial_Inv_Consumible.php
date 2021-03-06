
<div class="row" >
  <div class="col-md-9" align="center">
    <h5>Historial de Inventario de Consumible</h5>
  </div>
  <div class="col-md-3" align="center">
    <button type="button" onclick="Regresar()" class="btn btn-success" >Regresar a Almacen de Consumibles</button>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <span class="badge badge-info col-md-2">
      Nombre Consumible:<hr><?php echo $Product_Inv_info->producto_consu_nom; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Unidad Medida:<hr><?php echo $Product_Inv_info->unidad_medida; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Existencia Actual:<hr><?php echo $Product_Inv_info->producto_consu_exist; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Precio Actual:<hr>$<?php echo number_format($Product_Inv_info->producto_consu_prec_unit,5,'.',','); ?>
    </span> 
    <span class="badge badge-info col-md-2">
      Último Proveedor:<hr><?php echo $Product_Inv_info->catalogo_proveedor_empresa; ?>
    </span>

    <span class="badge badge-info col-md-1">
    Última Compra:<hr><?php echo $Product_Inv_info->producto_consu_ult_compra; ?>
    </span>
    <span class="badge badge-info col-md-2">
    Próxima Compra Estimada:<hr><?php echo $Product_Inv_info->producto_consu_prox_compra; ?>
    </span>
    <span class="badge badge-info col-md-1">
      Periodicidad:<hr><?php echo $Product_Inv_info->producto_consu_periodicidad; ?> días
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
          <th>Precio Unitario Nuevo</th>
          <th>Proveedor Anterior</th>
          <th>Proveedor Nuevo</th>
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

          <td><?php echo "".$row->producto_consu_nom.""; ?></td>
          <td><?php echo "".$row->unidad_medida.""; ?></td>
          <td><?php echo $row->historial_almacen_producto_cantidad_old; ?></td>
          <td><?php echo $row->historial_almacen_producto_cantidad_new; ?></td>
          <td>$<?php echo number_format($row->prod_alm_prec_unit_old,5,'.',','); ?></td>
          <td>$<?php echo number_format($row->prod_alm_prec_unit_new,5,'.',','); ?></td>
          <td><?php echo $row->historial_almacen_proveedor_old; ?></td>
          <td><?php echo $row->catalogo_proveedor_empresa; ?></td>
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
    $("#page_content").load("InventarioOficina");
  }
</script>
