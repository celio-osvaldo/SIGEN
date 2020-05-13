<table class="tg">
  <tr>
    <th class="tg-0lax"><img height="75" width="200" src="Resources\Logos\Logo_ISA.png"></th>
    <th class="tg-baqh"><img height="20" width="20" src="Resources\Icons\locate.png">Sierra Fría #431-A C.P. 20127<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Col. Bosques del Prado Norte <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aguascalientes, Ags. <br>
      <img height="20" width="20" src="Resources\Icons\telephonecall.png">(449)9969502 <br>
      <img height="20" width="20" src="Resources\Icons\mail.png">ventas@iluminaags.com</th>
    <th class="tg-lqy6">
      <b>Fecha: <?php echo $cotizacion_info->cotizacion_fecha; ?></b><br>
      <b>Folio: <?php echo $cotizacion_info->cotizacion_folio; ?></b></th>
  </tr>
  <tr>
     <th class="tg-0lax"><b>Iluminación Sustentable AGS S. de R.L. de C.V.</b></th>
  </tr>
</table>

<table class="tg">
  <tr>
    <td class="tg-obra">ATENCIÓN</td>

    <td class="tg-obra">OBRA</td>
  </tr>
  <tr>
    <td class="tg-obra2"><?php echo $cotizacion_info->catalogo_cliente_empresa; ?></td>
    <td class="tg-obra2"><?php echo $cotizacion_info->cotizacion_obra; ?></td>
  </tr>
</table>
<table class="tg">
  <tr>
    <th class="tg-0lax">En base a su solicitud, me permito presentarle a continuación los siguientes productos:</th>
  </tr>
</table>
<table class="tg">
  <tr><b>
    <th class="tg-productos">MODELO</th>
    <th class="tg-productos">DESCRIPCIÓN</th>
    <th class="tg-productos">CANTIDAD</th>
    <th class="tg-productos">P/U</th>
    <th class="tg-productos">IMPORTE</th></b>
  </tr>
  <?php 
  foreach ($cotizacion_products->result() as $row) {
    ?>
      <tr>
        <td class="tg-productos2"><?php echo "".$row->prod_alm_modelo.""; ?></td>
        <td class="tg-productos2"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
        <td class="tg-productos2"><?php echo $row->lista_cotizacion_cantidad;?></td>
        <td class="tg-productos2">$<?php echo $row->lista_cotizacion_precio_unit;?></td>
        <td class="tg-productos2">$<?php echo $row->lista_cotizacion_importe;?></td>
      </tr>
    <?php 
  }
  ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td class="tg-subtotal">SUBTOTAL</td>
    <td class="tg-subtotal">$<?php echo $cotizacion_info->cotizacion_subtotal;?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td class="tg-iva">IVA</td>
    <td class="tg-iva">$<?php echo $cotizacion_info->cotizacion_iva;?></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <b><td class="tg-total">TOTAL</td></b>
    <td class="tg-total">$<?php echo $cotizacion_info->cotizacion_total;?></td>
</table>
<br>
<table class="tg2">
  <body>
    <tr class="tg-up">
      <td><b>VALOR AGREGADO</b></td>
    </tr>
    <tr>
      <td><img height="20" width="20" src="Resources\Icons\anticipo.png">Anticipo 50%, contra entrega 50%, precios en moneda nacional</td>
    </tr>
    <tr>
      <td><img height="20" width="20" src="Resources\Icons\entrega.png"> Entrega: <?php echo $cotizacion_info->cotizacion_tiempo_entrega;?> semanas</td>
    </tr>
    <tr>
      <td><img height="20" width="20" src="Resources\Icons\soporte.png">Soporte técnico a través de un sistema de reportes de daños o garantías vía web.</td>
    </tr>
    <tr class="tg-down">
      <td><img height="20" width="20" src="Resources\Icons\camion.png">Sin cargo adicional dentro de la Cd. de Aguascalientes/Costo de flete fuera de la Cd.</td>
    </tr>
</table>
<br>
<table class="tg3">
  <tr class="">
    <td >
      <img height="20" width="20" src="Resources\Icons\calendar.png">Cotización con vigencia de <?php echo $cotizacion_info->cotizacion_vigencia;?> días contando a partir de la fecha de emisión
    </td>
  </tr>
  <br><br>
  <tr>
    <td>ELABORÓ</td>
  </tr>
    <br><br><br><br><br>
      <tr>
    <td>__________________________________</td>
  </tr>
  <tr>
    <td><?php echo $cotizacion_info->cotizacion_elabora;?></td>
  </tr>
</table>


