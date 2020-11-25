<div class="table-responsive">
  <table id="table_customer" class="table table-striped table-hover display" style="font-size: 9pt;">
    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
      <tr>
        <th>Evento</th>
        <th>Cliente</th>
        <th hidden="true">id_cliente</th>
        <th>Importe Total</th>
        <th>Pagado</th>
        <th>Saldo</th>
        <th hidden="true">Estado_id</th>
        <th>Fecha de Evento</th>
        <th>Total Horas</th>
        <th>Horario del Evento</th>
        <th>Anticipo Establecido</th>
        <th>Cantidad de Personas</th>
        <th>Tipo de Evento</th>
        <th>Mobiliario</th>
        <th>Permiso</th>
        <th>Estado</th>
        <th>Comentarios</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
     <?php
     foreach ($proyectlist->result() as $row) {
       if(stristr($filtro, $row->obra_cliente_estado)){?>
      <tr id="<?php echo "fila".$row->id_obra_cliente; ?>">          
        <td id="<?php echo "nom_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
        <td id="<?php echo "nom_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
        <td hidden="true" id="<?php echo "id_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_id_cliente.""; ?></td>
        <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_imp_total,2,'.',',').""; ?></td>
        <td id="<?php echo "total_pago_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_pagado,2,'.',',').""; ?></td>
        <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_saldo,2,'.',',').""; ?></td>
        <td>
          Inicio:<ul style="font-size: 8pt" id="<?php echo "fecha_evento".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_fecha ?></ul>
          Fin:<ul style="font-size: 8pt" id="<?php echo "fecha_fin".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_fecha_fin ?></ul>
        </td>
        <td id="<?php echo "total_horas".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_total_horas ?></td>
        <td>
          Inicio:<ul id="<?php echo "hora_inicio".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_hora_inicio ?></ul>
          Fin:<ul id="<?php echo "hora_fin".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_hora_fin ?></ul>
        </td>
        <td id="<?php echo "anticipo_estab".$row->id_obra_cliente;?>">$<?php echo number_format($row->evento_detalle_anticipo,2,'.',',') ?></td>
        <td id="<?php echo "cant_personas".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_personas ?></td>
        <td id="<?php echo "tipo_evento".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_tipo_evento ?></td>
        <td id="<?php echo "mobiliario".$row->id_obra_cliente;?>"><?php echo $row->detalle_evento_mobiliario ?></td>
        <td id="<?php echo "permiso".$row->id_obra_cliente;?>"><?php echo $row->evento_detalle_permiso ?></td>
        <td id="<?php echo "estado_obra".$row->id_obra_cliente;?>" hidden="true"><?php echo "".$row->obra_cliente_estado.""; ?></td>
        <td id="nom_estadp">
          <?php 
          switch ($row->obra_cliente_estado) {
            case '1':
            echo 'Activo';
            break;
            case '2':
            echo 'Pagado';
            break;
            case '3':
            echo 'Cancelado';
            break;
            default:
            echo 'Error';
            break;
          }
          ?>
        </td>
        <td id="<?php echo "coment_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_comentarios.""; ?></td>
        <td>
          <a class="btn btn-outline-secondary" onclick="Detalles(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" title="Detalles" style="filter: invert(100%)" />
          </button></a>
          <a class="btn btn-outline-secondary" onclick="Edit(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" title="Editar Generales" style="filter: invert(100%)" />
          </button></a>
        </td>
      </tr>
    <?php 
      }
    } ?>
  </tbody>
</table>
</div>

<style type="text/css">
   ul{
margin:0;
padding:0;
list-style-type:none;
}
</style>

<script type="text/javascript">
   $(document).ready( function () {
    $('#table_customer').DataTable();
  } );
</script>