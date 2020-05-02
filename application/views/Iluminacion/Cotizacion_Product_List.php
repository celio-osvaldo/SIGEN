<!--Mostrar lista de Productos de Cotización -->

<div class="container">
  <button class="btn btn-success" onclick="Lista_Cotizaciones()">Regresar a Lista de Cotizaciones</button>
</div>
  <form action="<?php echo base_url();?>Iluminacion/Genera_PDF_Cotizacion" method="POST">
   <!-- Enviar el id de la cotización para generar el PDF -->
    <input class="btn btn-primary" type="submit" value="Generar PDF" name="btnDownload">
  </form>
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_cotizacion_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Productos de la Cotización </h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Folio:<hr><?php echo $cotizacion_info->cotizacion_folio; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Fecha:<hr><?php echo $cotizacion_info->cotizacion_fecha; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Cliente:<hr><?php echo $cotizacion_info->catalogo_cliente_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Obra:<hr><?php echo $cotizacion_info->cotizacion_obra; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Subtotal:<hr>$<?php echo $cotizacion_info->cotizacion_subtotal; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                IVA:<hr>$<?php echo $cotizacion_info->cotizacion_iva; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Total:<hr>$<?php echo $cotizacion_info->cotizacion_total; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Tiempo de <br>Entrega (días):<hr><?php echo $cotizacion_info->cotizacion_tiempo_entrega; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Vigencia <br>(días):<hr><?php echo $cotizacion_info->cotizacion_vigencia; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Elaboró:<hr><?php echo $cotizacion_info->cotizacion_elabora; ?>
              </h6>
            </span>
          </div>
        </div>
      </div>
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="true">id_cotizacion</th>
          <th>Nombre de Producto</th>
          <th hidden="true">id_producto</th>
          <th>Modelo</th>
          <th>Descripcion</th>
          <th>Cantidad de Productos</th>
          <th>Precio Unitario</th>
          <th>Descuento</th>
          <th>Importe</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($cotizacion_products->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_lista_cotizacion".$row->id_lista_cotizacion;?>"><?php echo "".$row->id_lista_cotizacion.""; ?></td>
            <td id="<?php echo "nombre".$row->id_lista_cotizacion;?>"><?php echo "".$row->prod_alm_nom.""; ?></td>
            <td hidden="true"id="<?php echo "id_producto".$row->id_lista_cotizacion;?>"><?php echo "".$row->lista_cotizacion_id_prod_alm.""; ?></td>
            <td id="<?php echo "modelo".$row->id_lista_cotizacion;?>"><?php echo "".$row->prod_alm_modelo.""; ?></td>
            <td id="<?php echo "descripcion".$row->id_lista_cotizacion;?>"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
            <td id="<?php echo "cantidad".$row->id_lista_cotizacion;?>"><?php echo $row->lista_cotizacion_cantidad;?></td>
            <td id="<?php echo "precio_unit".$row->id_lista_cotizacion;?>">$<?php echo $row->lista_cotizacion_precio_unit;?></td>
            <td id="<?php echo "descuento".$row->id_lista_cotizacion;?>"><?php echo $row->lista_cotizacion_descuento;?>%</td>
            <td id="<?php echo "importe".$row->id_lista_cotizacion;?>"><?php echo $row->lista_cotizacion_importe;?></td>
            <td>
              <a class="navbar-brand" onclick="EditProduct(this.id)" role="button" id="<?php echo $row->id_lista_cotizacion; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" title="Editar Producto" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeleteProduct(this.id)" role="button" id="<?php echo $row->id_lista_cotizacion; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\delete.ico" title="Eliminar Producto" style="filter: invert(100%)" /></button></a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_cotizacion_prod_list').DataTable();

  });
  
  function Lista_Cotizaciones(){
    $("#page_content").load("Cotizaciones");
  }


</script>