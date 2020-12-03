<div class="table-responsive">
  <table id="table_customer" class="table table-striped table-hover display" style="font-size: 10pt;">
    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
      <tr>
        <th>Contrato</th>
        <th>Proyecto</th>
        <th>Cliente</th>
        <th>Importe Total</th>
        <th>Pagado</th>
        <th>Saldo</th>
        <th>Último Pago</th>
        <th>Comentarios</th>
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
         <td id="<?php echo "contrato".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_contrato.""; ?></td>
         <td id="<?php echo "nom_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
         <td id="<?php echo "nom_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
         <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_imp_total,2,'.',',').""; ?></td>
         <td id="<?php echo "pagado_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_pagado,2,'.',',').""; ?></td>
         <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_saldo,2,'.',',').""; ?></td>
         <td id="<?php echo "ult_pago_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_ult_pago.""; ?></td>
         <td id="<?php echo "coment_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_comentarios.""; ?></td>
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
    $('#table_customer').DataTable();
  } );
</script>