<div class="table-responsive">
  <table id="table_customer" class="table table-striped table-hover display" style="font-size: 9pt;">
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
        <th>Reporte Estimación</th>

      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($customerspays->result() as $row) {
        if(stristr($filtro, $row->obra_cliente_estado)){
          ?>

          <tr id="<?php echo "fila".$row->id_obra_cliente;?>">
           <td id="<?php echo "nom_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
           <td id="<?php echo "nom_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
           <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_imp_total,2,'.',',').""; ?></td>
           <td id="<?php echo "pagado_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_pagado,2,'.',',').""; ?></td>
           <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_saldo,2,'.',',').""; ?></td>
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
          <td>
            <a class="navbar-brand" href="#" onclick="Estimacion(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><img src="..\Resources\Icons\hoja.ico"></a>
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
  $(document).ready(function() {
    $('#table_customer').DataTable();
  } );
</script>