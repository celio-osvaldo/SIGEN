  <link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\PDFStyles_Flujo_Efectivo_Iluminacion.css">


<table class="tab">
  <tr>
    <td class="tab-logo"><img height="100" width="300" src="..\Resources\Logos\Logo_ISA.png"></td>
    <td class="tab-datos"><b>ILUMINACION SUSTENTABLE AGS, S DE RL DE CV <br> <?php echo $mes." DE ".$anio ?></b></td>
    <td class="tab-datos"><b><label style="text-align: right;">Saldo Inicial (En Banco Mes Anterior)</label> <br>
       $<input type="text" id="saldo_mes_anterior"  pattern="[0-9]*" value="<?php echo $sal_ban_ant; ?>"></b></td>
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
    $saldo_final=0;
    $saldo_final+=$sal_ban_ant;
      foreach ($ingresos_venta_mov->result() as $row) {
        $suma_importes+=$row->venta_mov_monto;
        ?>
        <tr>
          <td class="tab2-lista"><?php echo $row->venta_mov_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "ref".$row->id_venta_mov;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
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
          <td class="tab2-lista">
            <select id="<?php echo "ref".$row->id_pagos_anticipo;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
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
          <td class="tab2-lista">
            <select id="<?php echo "ref".$row->id_lista_pago_sfv;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
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
<?php 
$saldo_final+=($suma_importes+$suma_anticipos+$suma_sfv) ?>

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
   <?php  //Lista de Pagos de Proyectos
      $suma_gastos_venta=0;
      foreach ($egresos_gasto_venta->result() as $row) {
        $suma_gastos_venta+=$row->gasto_venta_monto;
    ?>
    <tr>
      <td class="tab3-lista"><?php echo $row->gasto_venta_fecha_pago; ?></td>
      <td class="tab3-lista">
            <select id="<?php echo "ref".$row->id_gasto_venta;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
      </td>
      <td class="tab3-lista"><?php echo number_format($row->gasto_venta_monto, 2, '.', ',');?></td>
      <td class="tab3-lista"><?php echo number_format($row->gasto_venta_monto/1.16, 2, '.', ',');?></td>
      <td class="tab3-lista"><?php echo number_format($row->gasto_venta_monto/1.16*0.16, 2, '.', ',');?></td>
      <td class="tab3-lista"><input size="2" type="text" onblur="SeparaMiles(this.id)" id="<?php echo "ret_iva".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" id="<?php echo "ret_isr".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" id="<?php echo "ieps".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" id="<?php echo "dap".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista">Gasto Venta - <?php echo $row->gasto_venta_concepto ?></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
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
      <td></td>
      <td></td>
      <td></td>
      <td class="tab3-total">$<?php echo number_format($suma_gastos_venta, 2, '.', ',');?></td>
      <td class="tab3-total">$<?php echo number_format(($suma_gastos_venta)/1.16, 2, '.', ',');?></td>
      <td class="tab3-total">$<?php echo number_format((($suma_gastos_venta)/1.16)*0.16, 2, '.', ',');?></td>
    </tr>
    <tr>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
      <td class="tab3-lista2"><hr></td>
    </tr>
    <?php 
      $saldo_final-=$suma_gastos_venta;
     ?>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab3-lista2"><b>SALDO FINAL</b></td>
      <td ><input class="tab3-final" type="text" disabled="true" id="saldo_final" value="<?php echo number_format($saldo_final, 2, '.', ',');?>"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
    <tr>
      <td><input hidden="true" id="saldo_final_sin_formato" type="number" value="<?php echo $saldo_final ?>"></td>
    </tr>
  </tfoot>
</table>


<script type="text/javascript">
 $(document).ready(function(){
         //Función para actualizar el saldo final
         $('#saldo_mes_anterior').change(function(){
          var saldo=$('#saldo_mes_anterior').val();
          if (saldo=="") {
            saldo=0;
          }
          var saldo_total=$("#saldo_final_sin_formato").val();
          var saldo2=parseFloat(saldo_total)+parseFloat(saldo); 
          //alert(new Intl.NumberFormat("en-US").format(saldo2));
          //saldo2=saldo2.toFixed(2);
          var resultado=saldo2.toLocaleString("en");
          $("#saldo_final").val("$"+parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
        });
  });

 document.getElementById("saldo_mes_anterior").onblur =function (){    
    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
   // document.getElementById("display").value = this.value.replace(/,/g, "")
    
}

function SeparaMiles($id){
  valor=$("#"+$id).val();
  $("#"+$id).val(parseFloat(valor.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

}


</script>
