
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_anticipo_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Nombre de Producto</th>
          <th>Cantidad de Productos</th>
          <th>Precio de Venta</th>
          <th>Comentarios</th>
          <th>Editar</th>

        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($anticipo_productos->result() as $row) {
          ?>
          <tr>
            <td id="<?php echo "nombre".$row->anticipo_id_anticipo;?>"><?php echo "".$row->prod_alm_nom.""; ?></td>
            <td id="<?php echo "cantidad".$row->anticipo_id_anticipo;?>"><?php echo "".$row->prod_anticipo_cantidad.""; ?></td>
            <td id="<?php echo "precio".$row->anticipo_id_anticipo;?>">$<?php echo "".$row->prod_anticipo_precio_venta.""; ?></td>
            <td id="<?php echo "coment".$row->anticipo_id_anticipo;?>"><?php echo $row->prod_anticipo_coment;?></td>
          <td>
            <a class="navbar-brand" onclick="" role="button" id="<?php echo $row->anticipo_id_anticipo; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></button></a>
          </td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>