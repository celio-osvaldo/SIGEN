<div class="table-responsive">
  <table id="table_customer" class="table table-striped table-hover display" style="font-size: 10pt;">
    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
      <tr>
        <th>Proyecto</th>
        <th>Cliente</th>
        <th>Importe Total</th>
        <th>Pagado</th>
        <th>Saldo</th>
        <th>Último Pago</th>
        <th>Comentarios</th>
        <th>Aplica a Flujo Efectivo</th>
        <th>Registrar Pago</th>
        <th>Detalles de Pagos</th>


      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($customerspays->result() as $row) {
         if(stristr($filtro, $row->obra_cliente_estado)){
       ?>
       <tr>
         <td id="<?php echo "nom_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
         <td id="<?php echo "nom_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
         <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_imp_total,5,'.',',').""; ?></td>
         <td id="<?php echo "pagado_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_pagado,5,'.',',').""; ?></td>
         <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_saldo,5,'.',',').""; ?></td>
         <td id="<?php echo "ult_pago_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_ult_pago.""; ?></td>
         <td id="<?php echo "coment_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_comentarios.""; ?></td>



           <td id="<?php echo "aplica_flujo".$row->id_obra_cliente; ?>">
             <?php if ($row->obra_cliente_aplica_flujo=="1"): ?>
               <img src="<?php echo base_url() ?>Resources/Icons/paloma.ico">
               <label hidden="true">1</label>
             <?php endif?>
             <?php if ($row->obra_cliente_aplica_flujo=="0"): ?>
               <img src="<?php echo base_url() ?>Resources/Icons/tacha.ico">
               <label hidden="true">0</label>
             <?php endif?>

           </td>

         <td>
          <a class="navbar-brand" href="#" onclick="AddPay(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico"></a>
        </td>
        <td>
          <a class="navbar-brand" href="#" onclick="Details(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><img src="..\Resources\Icons\lupa.ico"></a>
        </td>
      </tr>
      <?php 
    }
  }
    ?>
  </tbody>
</table>
</div>

<script type="text/javascript">
   $(document).ready( function () {
    $('#table_customer').DataTable({
        initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
        },
         /****** add this */
        "searching": true,
        // "autoFill": true,
        "language": {
            "lengthMenu": "Por página: _MENU_",
            "zeroRecords": "Sin resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ registros en total)",
            "search": "Búsqueda",
                "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          }
        },
    });
  } );
</script>