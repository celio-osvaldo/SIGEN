<table class="tab">
  <tr>
    <th class="tab-logo" colspan="3"><img height="100" width="300" src="Resources\Logos\Logo_ISA.png"></th>
    <th class="tab-datos" colspan="4">
      <b>Iluminación Sustentable AGS S. de R.L. de C.V.<br>
      Sierra Fría #431-A, Bosques del Prado Norte, <br>Aguascalientes, Ags. <br>
      Tel: (449) 996 95 02 <br>
      Cel: (449) 4426 1503 <br></b>
      ventas@iluminaags.com
    </th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td class="tab-fecha" colspan="1">Fecha</td>
    <td class="tab-fecha" colspan="3">No.</td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td class="tab-fecha2" colspan="1"><?php echo $recibo_info->recibo_entrega_fecha; ?></td>
    <td class="tab-fecha2" colspan="3"><?php echo $recibo_info->recibo_entrega_folio; ?></td>
  </tr>
  <tr>
      <td></td>
      <td></td>
      <td></td>
      <td colspan="1"></td>
    <td class="tab-fecha" colspan="3"><b>ENTREGA DE MATERIAL</b></td>
  </tr>
</table>
<br><br>
<table class="tab">
  <tr>
    <td class="tab-empresa">EMPRESA</td>
    <td class="tab-empresa2" colspan="4"><?php echo $recibo_info->catalogo_cliente_empresa; ?></td>
  </tr>
  <tr>
    <td class="tab-domicilio">DOMICILIO</td>
    <td class="tab-domicilio2" colspan="4"><?php echo $recibo_info->recibo_entrega_domicilio; ?></td>
  </tr>
</table>
<br><br>
<table class="tab">
  <tr><b>
    <th class="tab-descripcion">Descripción</th>
    <th class="tab-cantidad">Cantidad</th></b>
  </tr>
  <?php 
  foreach ($recibo_products->result() as $row) {
    ?>
      <tr>
        <td class="tab-descripcion2"><?php echo "".$row->prod_alm_descripcion.""; ?></td>
        <td class="tab-cantidad2"><?php echo $row->lista_recibo_entrega_cantidad;?></td>
      </tr>
    <?php 
  }
  ?>
</table>

<br><br>

<table class="tab">
    <tr>
      <td class="tab-soporte">
        <img height="30" width="30" src="Resources\Icons\soporte.png">
      </td>
      <td class="tab-soporte_text" colspan="3">Contamos con Soporte técnico a través de nuestro sistema de reportes o garantías vía web <br><a href="www.iluminaags.com">www.iluminaags.com</a></td>
    </tr>
</table>
<br>
<table class="tab">
  <tr>
    <td class="tab-entrega">ENTREGA</td>
    <td class="tab-recibe">RECIBE</td>
  </tr>
  <br><br><br><br>
    <tr>
    <td class="tab-entrega">________________________________</td>
    <td class="tab-recibe">________________________________</td>
  </tr>
  <tr>
    <td class="tab-entrega">Nombre y Firma</td>
    <td class="tab-recibe">Nombre y Firma</td>
  </tr>
  <br><br>
  <tr>
    <td class="tab-final" colspan="2"><b>Favor de especificar la cantidad y las condiciones en las que recibió el material.</b></td>
  </tr>
</table>