  <link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\PDFStyles_Flujo_Efectivo_Iluminacion.css">


<table class="tab">
  <tr>
    <td class="tab-logo"><img height="100" width="300" src="..\Resources\Logos\Logo_ISA.png"></td>
    <td class="tab-datos"><b>ILUMINACION SUSTENTABLE AGS, S DE RL DE CV <br> <?php echo $mes." DE ".$anio ?></b></td>
    <td class="tab-datos"><b><label style="text-align: right;">Saldo Inicial (En Banco Mes Anterior)</label> <br>
       $<input type="number" id="saldo_mes_anterior" value="<?php echo $sal_ban_ant; ?>"></b></td>
  </tr>
</table>

<table class="tab2">
  <head>
  <tr>
    <td colspan="10"><b>DEPÓSITOS</b></td>
  </tr>
  <th class="tab2-depositos">FECHA</th>
  <th class="tab2-depositos">REF</th>
  <th class="tab2-depositos">IMPORTE</th>
  <th class="tab2-depositos">SUBTOTAL</th>
  <th class="tab2-depositos">IVA</th>
  <th class="tab2-depositos">CLIENTE</th>
  <th class="tab2-depositos">CONCEPTO</th>
  <th class="tab2-depositos2">TOTALES DEPÓSITOS</th>
  <th class="tab2-depositos2">SUBTOTAL</th>
  <th class="tab2-depositos2">IVA</th>
  </head>
  <body>
    <?php  //Lista de Pagos de Proyectos
    $suma_importes=0;
      foreach ($ingresos_venta_mov->result() as $row) {
        $suma_importes+=$row->venta_mov_monto;
        ?>
        <tr>
          <td class="tab2-lista"><?php echo $row->venta_mov_fecha; ?></td>
          <td class="tab2-lista"><input type="text" id="<?php echo "ref".$row->id_venta_mov;?>"></td>
          <td class="tab2-lista"><?php echo number_format($row->venta_mov_monto, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo number_format(($row->venta_mov_monto)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo number_format(($row->venta_mov_monto/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista">Movimiento(Pagos) - <?php echo $row->venta_mov_comentario ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
    <?php
      }
     ?>
     
    <?php //Lista de Pagos de Anticipos
      $suma_anticipos=0;
      foreach ($ingresos_anticipos->result() as $row) {
        $suma_anticipos+=$row->pagos_anticipo_cantidad;
        ?>
        <tr>
          <td class="tab2-lista"><?php echo $row->pagos_anticipo_fecha; ?></td>
          <td class="tab2-lista"><input type="text" id="<?php echo "ref".$row->id_pagos_anticipo;?>"></td>
          <td class="tab2-lista"><?php echo number_format($row->pagos_anticipo_cantidad, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo number_format(($row->pagos_anticipo_cantidad)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo number_format(($row->pagos_anticipo_cantidad/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista">Pago Anticipo - <?php echo $row->pagos_anticipo_coment ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
      <?php
      }
     ?>

         <?php //Lista de Pagos de SFV
      $suma_sfv=0;
      foreach ($ingresos_sfv->result() as $row) {
        $suma_sfv+=$row->lista_pago_sfv_total;
        ?>
        <tr>
          <td class="tab2-lista"><?php echo $row->lista_pago_sfv_fecha; ?></td>
          <td class="tab2-lista"><input type="text" id="<?php echo "ref".$row->id_lista_pago_sfv;?>"></td>
          <td class="tab2-lista"><?php echo number_format($row->lista_pago_sfv_total, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo number_format(($row->lista_pago_sfv_total)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo number_format(($row->lista_pago_sfv_total/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista">Pago SFV - <?php echo $row->lista_pago_sfv_coment ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
      <?php
      }
     ?>

  </body>
  <tfoot>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab2-total">$<?php echo number_format($suma_importes+$suma_anticipos+$suma_sfv, 2, '.', ',');?></td>
      <td class="tab2-total">$<?php echo number_format(($suma_importes+$suma_anticipos+$suma_sfv)/1.16, 2, '.', ',');?></td>
      <td class="tab2-total">$<?php echo number_format((($suma_importes+$suma_anticipos+$suma_sfv)/1.16)*0.16, 2, '.', ',');?></td>
    </tr>
  </tfoot>
</table>

<table class="tab3">
  <head>
  <tr>
    <td colspan="10"><b>RETIROS</b></td>
  </tr>
  <th class="tab3-retiros">FECHA</th>
  <th class="tab3-retiros">REF</th>
  <th class="tab3-retiros">IMPORTE</th>
  <th class="tab3-retiros">SUBTOTAL</th>
  <th class="tab3-retiros">IVA</th>
  <th class="tab3-retiros">RETENCION IVA</th>
  <th class="tab3-retiros">RETENCION ISR</th>
  <th class="tab3-retiros">IEPS</th>
  <th class="tab3-retiros">DAP</th>
  <th class="tab3-retiros">CONCEPTO</th>
  <th class="tab3-retiros2">TOTALES DEPÓSITOS</th>
  <th class="tab3-retiros2">SUBTOTAL</th>
  <th class="tab3-retiros2">IVA</th>
  </head>
  <body>
    <tr>
      <td class="tab3-lista">1</td>
      <td class="tab3-lista">2</td>
      <td class="tab3-lista">3</td>
      <td class="tab3-lista">4</td>
      <td class="tab3-lista">5</td>
      <td class="tab3-lista">6</td>
      <td class="tab3-lista">7</td>
      <td class="tab3-lista">8</td>
      <td class="tab3-lista">9</td>
      <td class="tab3-lista">10</td>
      <td class="tab3-lista2">11</td>
      <td class="tab3-lista2">12</td>
      <td class="tab3-lista2">13</td>
    </tr>
  </body>
</table>
