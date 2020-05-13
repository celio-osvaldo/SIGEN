<!--Mostrar lista de Productos de Recibo de Entrega -->

<div class="container">
  <button class="btn btn-success" onclick="Lista_Recibos()">Regresar a Lista de Recibos de Entrega</button>
</div>
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_recibo_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Productos Recibo de Entrega</h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Folio:<hr><?php echo $recibo_info->recibo_entrega_folio; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Empresa:<hr><?php echo $recibo_info->catalogo_cliente_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Fecha de Entrega:<hr><?php echo $recibo_info->recibo_entrega_fecha; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Domicilio de Entrega:<hr><?php echo $recibo_info->recibo_entrega_domicilio; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Estado de Entrega:<hr><?php echo $recibo_info->recibo_entrega_estado; ?>
              </h6>
            </span>
          </div>
        </div>
      </div>
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="true">id_recibo_entrega</th>
          <th>Descripción del Producto</th>
          <th hidden="true">id_producto</th>
          <th>Cantidad de Productos</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($recibo_products->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_lista_recibo_entrega".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->id_lista_recibo_entrega.""; ?></td>
            <td id="<?php echo "descripcion_producto".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
            <td hidden="true" id="<?php echo "id_producto".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->producto_almacen_id_prod_alm.""; ?></td>
            <td id="<?php echo "cantidad".$row->id_lista_recibo_entrega;?>"><?php echo "".$row->lista_recibo_entrega_cantidad.""; ?></td>
            <td>
              <a class="navbar-brand" onclick="EditProduct(this.id)" role="button" id="<?php echo $row->id_lista_recibo_entrega; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" title="Editar Producto" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeleteProduct(this.id)" role="button" id="<?php echo $row->id_lista_recibo_entrega; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\delete.ico" title="Eliminar Producto" style="filter: invert(100%)" /></button></a>
            <form action="<?php echo base_url();?>Iluminacion/Genera_PDF_Recibo_Entrega" method="POST" target='_blank'>
             <input type="text" hidden="true" id="id_lista_recibo_entrega" name="id_lista_recibo_entrega" value="<?php echo $row->lista_recibo_entrega_id_recibo_entrega; ?>">
              <input hidden="true" type="text" id="folio" name="folio" value="<?php echo $recibo_info->recibo_entrega_folio; ?>">
             <button class="btn btn-outline-secondary" type="submit" title="Imprimir Cotización"><img src="..\Resources\Icons\imprimir.ico" width="20px" style="filter: invert(100%)"></button>
           </form>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
