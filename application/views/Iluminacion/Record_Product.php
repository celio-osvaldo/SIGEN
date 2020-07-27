
<div class="row">
  <div class="col">
    <h2 align="center">Historial de Precio de Producto/Servicio</h2>
    <div class="col" align="center">
      <span class="badge badge-info">
        <h6 align="center">
          Producto/Servicio:<hr><?php echo $product_info->catalogo_producto_nombre; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Proveedor Actual:<hr><?php echo $product_info->catalogo_proveedor_empresa; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Precio Actual:<hr>$<?php echo $product_info->catalogo_producto_precio; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Ultima Fecha de Actualización:<hr><?php echo $product_info->catalogo_producto_fecha_actualizacion; ?>
        </h6>
      </span>
    </div>
  </div>
</div>
<div align="center">
<button type="button" onclick="Regresar()" class="btn btn-success" >Regresar al Catálogo de Productos/Servicios</button>
</div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <div class="card bg-card">
            <div class="margins">
                <br>
                <div class="table-responsive">
                    <table id="table_record_product" class="table table-hover display table-striped" style="font-size: 10pt;">
                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
                        <tr>
                            <th>Producto/Servicio</th>
                            <th>Unidad de medida</th>
                            <th>Fecha de actualización</th>
                            <th>Proveedor</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($record_product->result() as $row) {?>
                            <tr>
                                <td id="<?php echo "name".$row->id_historial_precio_producto.""; ?>"><?php echo "".$row->catalogo_producto_nombre.""; ?>                                    
                                </td>
                                <td id="<?php echo "medida".$row->id_historial_precio_producto.""; ?>"><?php echo "".$row->unidad_medida.""; ?>                                    
                                </td>
                                <td id="<?php echo "fecha".$row->id_historial_precio_producto.""; ?>"><?php echo "".$row->historial_fecha_actualizacion.""; ?>                                    
                                </td>
                                <td id="<?php echo "proveedor".$row->id_historial_precio_producto.""; ?>"><?php echo "".$row->catalogo_proveedor_empresa."";?>                                    
                                </td>
                                <td id="<?php echo "precio".$row->id_historial_precio_producto.""; ?>">$<?php echo "".number_format($row->historial_precio_producto_precio, 5, '.', ',').""; ?>                                    
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
    <div class="col-md-1"></div>
</div>


<script type="text/javascript">
  $(document).ready( function () {
    $('#table_record_product').DataTable();
    });

  function Regresar(){
    $("#page_content").load("GetInventories");
  }
</script>
