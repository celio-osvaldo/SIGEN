<table class="tg">
  <tr>
     <td class="tg-logo">Iluminación Sustentable AGS S. de R.L. de C.V.</td>
  </tr>
  <tr>
    <td class="tg-logo"  rowspan="5"><img height="75" width="200" src="Resources\Logos\Logo_ISA.png"></td>
    <td class="tg-empresa"  rowspan="5"><img height="20" width="20" src="Resources\Icons\locate.png">Sierra Fría #431-A C.P. 20127<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Col. Bosques del Prado Norte Aguascalientes, Ags. <br>
      <img height="20" width="20" src="Resources\Icons\mail.png"><a href="ventas@iluminaags.com">ventas@iluminaags.com</a>      
  </tr>
  <tr>
     <td class="tg-fecha">
        <p><b>FECHA <br></b></p></td>
  </tr>
  <tr>
    <td class="tg-fecha2"><?php echo $cotizacion_info->cotizacion_fecha; ?>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td class="tg-fecha"><b>COTIZACIÓN <br></b></td>
  </tr>
  <tr>
    <td>
      <img height="20" width="20" src="Resources\Icons\telephonecall.png">449 996 9502
    </td>
    <td>
      <img height="20" width="20" src="Resources\Icons\whatsapp.png">449 426 1503</td>
    </td>
    <td class="tg-fecha2"><?php echo $cotizacion_info->cotizacion_folio; ?> </td>
  </tr>
</table>
<br><br>
<table class="tg">
  <tr>
    <td class="tg-obra">Atención</td>
    <td></td>
    <td class="tg-obra" rowspan="2">Empresa</td>
    <?php if ($tipo=="cotizante"): ?>
       <td class="tg-obra2" rowspan="2"><?php echo $cotizacion_info->catalogo_cotizante_empresa; ?></td>
    <?php endif ?>
    <?php if ($tipo=="cliente"): ?>
       <td class="tg-obra2" rowspan="2"><?php echo $cotizacion_info->catalogo_cliente_empresa; ?></td>
    <?php endif ?>
   
  </tr>
  <tr>
    <td class="tg-obra2"><?php echo $cotizacion_info->cotizacion_empresa; ?></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td class="tg-obra">Licitación</td>
    <td></td>
    <td class="tg-obra" rowspan="2">OBRA</td>
    <td class="tg-obra2" rowspan="2"><?php echo $cotizacion_info->cotizacion_obra; ?></td>
  </tr>
  <tr>
       <td class="tg-obra2"><?php echo $cotizacion_info->cotizacion_licitacion; ?></td>
  </tr>
</table>
<table class="tg">
  <tr>
    <th class="tg-logo">En base a su solicitud, me permito presentarle a continuación los siguientes productos:</th>
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
    if ($row->lista_cotizacion_descuento>0) {
    $descuento=$row->lista_cotizacion_descuento;
    $prec_unit=$row->lista_cotizacion_precio_unit;
    $cantidad=$row->lista_cotizacion_cantidad;
    $tot_desc=($descuento*$prec_unit*$cantidad)/100;
    $importe=$row->lista_cotizacion_importe+$tot_desc;
    }else{
      $importe=$row->lista_cotizacion_importe;
    }
    ?>
      <tr>
        <td class="tg-productos2"><?php echo "".$row->prod_alm_modelo.""; ?></td>
        <td class="tg-productos2"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
        <td class="tg-productos2"><?php echo $row->lista_cotizacion_cantidad;?></td>
        <td class="tg-productos2">$<?php echo number_format($row->lista_cotizacion_precio_unit,5,'.',',');?></td>
        <td class="tg-productos2">$<?php echo number_format($importe,5,'.',',');?></td>
      </tr>
    <?php 
        if ($row->lista_cotizacion_descuento>0) {
      
      ?>
        <tr>
      <td></td>
      <td></td>
      <td class="tg-iva">DESCUENTOS</td>
      <td class="tg-iva"><?php echo number_format($descuento,5,'.',',')?>%</td>
      <td class="tg-iva">$<?php echo number_format($tot_desc,5,'.',',')?></td>
    </tr>
    <?php
    }
  }

  ?>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td class="tg-subtotal">SUBTOTAL</td>
    <td class="tg-subtotal">$<?php echo number_format($cotizacion_info->cotizacion_subtotal,5,'.',',');?></td>
  </tr>
  <tr>
    <td class="tg-anticipo" colspan="2" rowspan="2"><?php echo $cotizacion_info->cotizacion_comentario ?></td>
    <td></td>
    <td class="tg-iva">IVA</td>
    <td class="tg-iva">$<?php echo number_format($cotizacion_info->cotizacion_iva,5,'.',',');?></td>
  </tr>
  <tr>
    <td></td>
    <b><td class="tg-total">TOTAL</td></b>
    <td class="tg-total">$<?php echo number_format($cotizacion_info->cotizacion_total,5,'.',',');?></td>
</table>
<br>
<table class="tg">
    <tr>
      <td class="tg-anticipo2"><img height="30" width="30" src="Resources\Icons\anticipo.png"></td>
      <td class="tg-anticipo">
        <b>Anticipo</b> 50% al confirmar pedido <br>
        <b>Finiquito</b> 50% para programar entrega
      </td>
      <td class="tg-anticipo2"><img height="30" width="30" src="Resources\Icons\entrega.png"></td>
      <td class="tg-entrega">
        <b>Tiempo de entrega:</b><br>
        <?php echo $cotizacion_info->cotizacion_tiempo_entrega;?> semanas a partir del pago de anticipo
      </td>
    </tr>
    <tr>
      <td><br><br></td>
    </tr>
    <tr>
      <td class="tg-anticipo2">
        <img height="30" width="30" src="Resources\Icons\soporte.png">
      </td>
      <td class="tg-entrega" colspan="3">Contamos con Soporte técnico a través de nuestro sistema de reportes o garantías vía web <br><a href="www.iluminaags.com">www.iluminaags.com</a></td>
    </tr>
    <tr>
      <td>
        
      </td>
      <td colspan="3">
        *Precios sujetos a variación por el tipo de cambio del dólar (USD)
      </td>
    </tr>
    
</table>
<br>
<table class="tg3">
  <tr class="">
    <td >
      <img height="30" width="30" src="Resources\Icons\calendar.png">Cotización con vigencia de <?php echo $cotizacion_info->cotizacion_vigencia;?> días contando a partir de la fecha de emisión
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


