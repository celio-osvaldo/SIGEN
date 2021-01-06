

<?php date_default_timezone_set("America/Mexico_City") ?>

<table style="width: 100%">
  <tr>
    <td>
      <table class="td" style="width:100%; border-collapse: collapse; font-family: Geneva; font-size: 12;  ">
        <tr class="td">
          <td class="t1-1" style="border-left: 1px solid black; border-top: 1px solid black"><b>NO.</b></td>
          <td class="t1-2" style="border-top: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->venta_mov_factura ?></td>
        </tr>
        <tr class="td">
          <td class="t1-1" style="border-left: 1px solid black; "><b>FECHA</b></td>
          <td class="t1-2" style=" border-right: 1px solid black"><?php echo $recibo_info->venta_mov_fecha; ?></td>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black; "><b>MONTO</b></td>
          <td class="t1-2" style=" border: 1px solid black">$<?php echo number_format($recibo_info->venta_mov_monto,2,'.',','); ?></td>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black; "><b>CONCEPTO</b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->venta_mov_comentario ?></td>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black;border-bottom: 1px solid black "><b>RENTA SALON</b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->evento_detalle_fecha ?></td>
        </tr>
        <tr>
          <td colspan="2" class="t1-1" style="border-left: 1px solid black;border-bottom: 1px solid black; border-right: 1px solid black "><b><?php echo $recibo_info->evento_detalle_tipo_evento ?></b></td>
        
        </tr>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black; "><b>NOMBRE:</b></td>
          <td class="t1-2" style="border-right: 1px solid black"></td>
        </tr>
        <tr>
          <td class="t1-1" style=" border-bottom: 1px solid black;border-left: 1px solid black; "><b><?php echo $recibo_info->catalogo_cliente_empresa ?></b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"></td>
        </tr>
        <tr>
           <td class="t1-1" style="border-left: 1px solid black;border-bottom: 1px solid black "><b>CONTRATO:</b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->obra_cliente_contrato ?></td>
        </tr>
      </table>
    </td>


    <td>
<table class="td" style="width:100%; border-collapse: collapse; font-family: Geneva; font-size: 14  ; background-image: url(<?php echo base_url() ?>Resources/Logos/qm_recibo.png); background-repeat: no-repeat; ">
  <tr class="td">

    <td class="t2-1" style="border-left: 1px solid black; border-top: 1px solid black " ></td>
    <td class="t2-2" style="border-top: 1px solid black; font-family: Geneva; font-size: 9pt " colspan="2"><b>Quinta Monticello, Salón de Eventos.</b></td>

    <td class="t2-4" style="border-top: 1px solid black"></td>
    <td class="t2-5" style="border-top: 1px solid black"></td>
    <td class="t2-6" style="border-top: 1px solid black; font-size: 10pt"><b>RECIBO:</b></td>
    <td class="t2-7" style="border-top: 1px solid black"></td>
    <td class="t2-8" style="border-top: 1px solid black; border-right: 1px solid black; font-size: 12pt"><?php echo $recibo_info->venta_mov_factura ?></td>
  </tr>
  <tr>

    <td class="t2-1" style="border-left: 1px solid black"></td>
    <td class="t2-2"></td>
    <td class="t2-3"></td>
    <td class="t2-4">Día</td>
    <td class="t2-5"></td>
    <td class="t2-6">Mes</td>
    <td class="t2-7"></td>
    <td class="t2-8" style="border-right: 1px solid black">Año</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black; text-align: center"></td>
    <td></td>
    <td style="font-size: 14pt"><b>RECIBO</b></td>
    <td style="border: 1px solid black; text-align: center"><?php echo date("d", strtotime($recibo_info->venta_mov_fecha)); ?></td>
    <td></td>
    <td style="border: 1px solid black; text-align: center"><?php echo date("m", strtotime($recibo_info->venta_mov_fecha)); ?></td>
    <td></td>
    <td style="border: 1px solid black; text-align: center"><?php echo date("yy", strtotime($recibo_info->venta_mov_fecha)); ?></td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black; font-size: 12pt">Recibí de:</td>
    <td colspan="5" style="border-bottom: 1px dotted black"><b><?php echo $recibo_info->catalogo_cliente_empresa ?></b></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
 <td style="border-left: 1px solid black; font-size: 12pt">la cantidad de:</td>
    <td colspan="5" style="border-bottom: 1px dotted black"><b>$<?php echo number_format($recibo_info->venta_mov_monto,2,'.',','); ?>(<?php echo $recibo_info->venta_mov_monto_letra; ?>)</b></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
 <td style="border-left: 1px solid black; font-size: 12pt">por concepto de:</td>
    <td colspan="5" style="border-bottom: 1px dotted black"><b><?php echo $recibo_info->venta_mov_comentario ?> </b></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
 <td style="border-left: 1px solid black; font-size: 12pt; text-align: center; color: white">.</td>
    <td colspan="5" style="border-bottom: 1px dotted black"></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
<td style="border-left: 1px solid black; font-size: 12pt; text-align: center; color: white">.</td>
    <td colspan="5" style="border-bottom: 1px dotted black"></td>
    <td></td>
    <td style="border-right: 1px solid black; "></td>
  </tr>
  <tr>

    <td style="border-left: 1px solid black">CLIENTE</td>
    <td></td>
    <td></td>
    <td></td>
    <td style="border-bottom: 1px solid black"></td>
    <td style="border-bottom: 1px solid black"></td>
    <td style="border-bottom: 1px solid black"></td>
    <td style="border-right: 1px solid black; border-bottom: 1px solid black"></td>
  </tr>
  <tr>

    <td style="border-right: 1px solid black;; border-left: 1px solid black; border-bottom: 1px solid black; text-align: center" colspan="8">Constitución no. 500, Col. San Pedro. Teocaltiche, Jalisco.</td>
  </tr>
</table>
</td>
  </tr>
</table>
  

<?php date_default_timezone_set("America/Mexico_City") ?>

<br>
<hr>
<br>
<br>

<table style="width: 100%">
  <tr>
    <td>
      <table class="td" style="width:100%; border-collapse: collapse; font-family: Geneva; font-size: 12;  ">
        <tr class="td">
          <td class="t1-1" style="border-left: 1px solid black; border-top: 1px solid black"><b>NO.</b></td>
          <td class="t1-2" style="border-top: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->venta_mov_factura ?></td>
        </tr>
        <tr class="td">
          <td class="t1-1" style="border-left: 1px solid black; "><b>FECHA</b></td>
          <td class="t1-2" style=" border-right: 1px solid black"><?php echo $recibo_info->venta_mov_fecha; ?></td>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black; "><b>MONTO</b></td>
          <td class="t1-2" style=" border: 1px solid black">$<?php echo number_format($recibo_info->venta_mov_monto,2,'.',','); ?></td>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black; "><b>CONCEPTO</b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->venta_mov_comentario ?></td>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black;border-bottom: 1px solid black "><b>RENTA SALON</b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->evento_detalle_fecha ?></td>
        </tr>
        <tr>
          <td colspan="2" class="t1-1" style="border-left: 1px solid black;border-bottom: 1px solid black; border-right: 1px solid black "><b><?php echo $recibo_info->evento_detalle_tipo_evento ?></b></td>
        
        </tr>
        </tr>
        <tr>
          <td class="t1-1" style="border-left: 1px solid black; "><b>NOMBRE:</b></td>
          <td class="t1-2" style="border-right: 1px solid black"></td>
        </tr>
        <tr>
          <td class="t1-1" style=" border-bottom: 1px solid black;border-left: 1px solid black; "><b><?php echo $recibo_info->catalogo_cliente_empresa ?></b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"></td>
        </tr>
        <tr>
           <td class="t1-1" style="border-left: 1px solid black;border-bottom: 1px solid black "><b>CONTRATO:</b></td>
          <td class="t1-2" style=" border-bottom: 1px solid black; border-right: 1px solid black"><?php echo $recibo_info->obra_cliente_contrato ?></td>
        </tr>
      </table>
    </td>


    <td>
<table class="td" style="width:100%; border-collapse: collapse; font-family: Geneva; font-size: 14; background-image: url(<?php echo base_url() ?>Resources/Logos/qm_recibo.png); background-repeat: no-repeat; ">
  <tr class="td">

    <td class="t2-1" style="border-left: 1px solid black; border-top: 1px solid black " ></td>
    <td class="t2-2" style="border-top: 1px solid black; font-family: Geneva; font-size: 9pt " colspan="2"><b>Quinta Monticello, Salón de Eventos.</b></td>

    <td class="t2-4" style="border-top: 1px solid black"></td>
    <td class="t2-5" style="border-top: 1px solid black"></td>
    <td class="t2-6" style="border-top: 1px solid black; font-size: 10pt"><b>RECIBO:</b></td>
    <td class="t2-7" style="border-top: 1px solid black"></td>
    <td class="t2-8" style="border-top: 1px solid black; border-right: 1px solid black; font-size: 12pt"><?php echo $recibo_info->venta_mov_factura ?></td>
  </tr>
  <tr>

    <td class="t2-1" style="border-left: 1px solid black"></td>
    <td class="t2-2"></td>
    <td class="t2-3"></td>
    <td class="t2-4">Día</td>
    <td class="t2-5"></td>
    <td class="t2-6">Mes</td>
    <td class="t2-7"></td>
    <td class="t2-8" style="border-right: 1px solid black">Año</td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black; text-align: center"></td>
    <td></td>
    <td style="font-size: 14pt"><b>RECIBO</b></td>
    <td style="border: 1px solid black; text-align: center"><?php echo date("d", strtotime($recibo_info->venta_mov_fecha)); ?></td>
    <td></td>
    <td style="border: 1px solid black; text-align: center"><?php echo date("m", strtotime($recibo_info->venta_mov_fecha)); ?></td>
    <td></td>
    <td style="border: 1px solid black; text-align: center"><?php echo date("yy", strtotime($recibo_info->venta_mov_fecha)); ?></td>
  </tr>
  <tr>
    <td style="border-left: 1px solid black; font-size: 12pt">Recibí de:</td>
    <td colspan="5" style="border-bottom: 1px dotted black"><b><?php echo $recibo_info->catalogo_cliente_empresa ?></b></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
 <td style="border-left: 1px solid black; font-size: 12pt">la cantidad de:</td>
    <td colspan="5" style="border-bottom: 1px dotted black"><b>$<?php echo number_format($recibo_info->venta_mov_monto,2,'.',','); ?>(<?php echo $recibo_info->venta_mov_monto_letra; ?>)</b></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
 <td style="border-left: 1px solid black; font-size: 12pt">por concepto de:</td>
    <td colspan="5" style="border-bottom: 1px dotted black"><b><?php echo $recibo_info->venta_mov_comentario ?> </b></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
 <td style="border-left: 1px solid black; font-size: 12pt; text-align: center; color: white">.</td>
    <td colspan="5" style="border-bottom: 1px dotted black"></td>
    <td></td>
    <td style="border-right: 1px solid black"></td>
  </tr>
  <tr>
<td style="border-left: 1px solid black; font-size: 12pt; text-align: center; color: white">.</td>
    <td colspan="5" style="border-bottom: 1px dotted black"></td>
    <td></td>
    <td style="border-right: 1px solid black; "></td>
  </tr>
  <tr>

    <td style="border-left: 1px solid black">QM</td>
    <td></td>
    <td></td>
    <td></td>
    <td style="border-bottom: 1px solid black"></td>
    <td style="border-bottom: 1px solid black"></td>
    <td style="border-bottom: 1px solid black"></td>
    <td style="border-right: 1px solid black; border-bottom: 1px solid black"></td>
  </tr>
  <tr>

    <td style="border-right: 1px solid black;; border-left: 1px solid black; border-bottom: 1px solid black; text-align: center" colspan="8">Constitución no. 500, Col. San Pedro. Teocaltiche, Jalisco.</td>
  </tr>
</table>
</td>
  </tr>
</table>
  

