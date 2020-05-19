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
    $subtotal_depositos=0;
    $subtotal_retitos=0;
    $iva_depositos=0;
    $iva_retiros=0;
      foreach ($ingresos_venta_mov->result() as $row) {
        $suma_importes+=$row->venta_mov_monto;
        ?>
        <tr>
          <td class="tab2-lista" id="<?php echo "depositos_fecha".$row->id_venta_mov;?>"><?php echo $row->venta_mov_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "depositos_ref".$row->id_venta_mov;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
          <td class="tab2-lista" onchange="Iva_Cargo()" id="<?php echo "depositos_importe".$row->id_venta_mov;?>"><?php echo number_format($row->venta_mov_monto, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_subtotal".$row->id_venta_mov;?>"><?php echo number_format(($row->venta_mov_monto)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_iva".$row->id_venta_mov;?>"><?php echo number_format(($row->venta_mov_monto/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_cliente".$row->id_venta_mov;?>"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista" id="<?php echo "depositos_concepto".$row->id_venta_mov;?>">Movimiento(Pagos) - <?php echo $row->venta_mov_comentario ?></td>
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
          <td class="tab2-lista" id="<?php echo "depositos_fecha".$row->id_pagos_anticipo;?>"><?php echo $row->pagos_anticipo_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "depositos_ref".$row->id_pagos_anticipo;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
          <td class="tab2-lista" onchange="Iva_Cargo()" id="<?php echo "depositos_importe".$row->id_pagos_anticipo;?>"><?php echo number_format($row->pagos_anticipo_cantidad, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_subtotal".$row->id_pagos_anticipo;?>"><?php echo number_format(($row->pagos_anticipo_cantidad)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_iva".$row->id_pagos_anticipo;?>"><?php echo number_format(($row->pagos_anticipo_cantidad/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_cliente".$row->id_pagos_anticipo;?>"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista" id="<?php echo "depositos_concepto".$row->id_pagos_anticipo;?>">Pago Anticipo - <?php echo $row->pagos_anticipo_coment ?></td>
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
          <td class="tab2-lista" id="<?php echo "depositos_fecha".$row->id_lista_pago_sfv;?>"><?php echo $row->lista_pago_sfv_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "depositos_ref".$row->id_lista_pago_sfv;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
          </td>
          <td class="tab2-lista" onchange="Iva_Cargo()" id="<?php echo "depositos_importe".$row->id_lista_pago_sfv;?>"><?php echo number_format($row->lista_pago_sfv_total, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_subtotal".$row->id_lista_pago_sfv;?>"><?php echo number_format(($row->lista_pago_sfv_total)/1.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_iva".$row->id_lista_pago_sfv;?>"><?php echo number_format(($row->lista_pago_sfv_total/1.16)*0.16, 2, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_cliente".$row->id_lista_pago_sfv;?>"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista" id="<?php echo "depositos_concepto".$row->id_lista_pago_sfv;?>">Pago SFV - <?php echo $row->lista_pago_sfv_coment ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
      <?php
      }
     ?>

  </body>
  <?php 
    $total_depositos=($suma_importes+$suma_anticipos+$suma_sfv);
    $subtotal_depositos=($total_depositos)/1.16;
    $iva_depositos=$subtotal_depositos*0.16;
   ?>
  <tfoot>
    <tr>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td class="tab2-total" id="total_depositos">$<?php echo number_format($total_depositos, 2, '.', ',');?></td>
      <td class="tab2-total" id="subtotal_depositos">$<?php echo number_format($subtotal_depositos, 2, '.', ',');?></td>
      <td class="tab2-total" id="iva_depositos">$<?php echo number_format($iva_depositos, 2, '.', ',');?></td>
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
   <?php  //Lista de Pagos de Proyectos
      $suma_gastos_venta=0;
      $suma_retencion_iva=0;
      
      foreach ($egresos_gasto_venta->result() as $row) {
        $suma_gastos_venta+=$row->gasto_venta_monto;
    ?>
    <tr>
      <td class="tab3-lista" id="<?php echo "retiros_fecha".$row->id_gasto_venta;?>"><?php echo $row->gasto_venta_fecha_pago; ?></td>
      <td class="tab3-lista">
            <select id="<?php echo "retiros_ref".$row->id_gasto_venta;?>">
              <option value="Tranferencia">Tranferencia</option>
              <option value="Deposito_cheque">Depósito en Cheque</option>
              <option value="Efectivo">Efectivo</option>
            </select>            
      </td>
      <td class="tab3-lista" id="<?php echo "retiros_importe".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_monto, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_subtotal".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_monto/1.16, 2, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_iva".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_monto/1.16*0.16, 2, '.', ',');?></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" value="0.00" id="<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" id="<?php echo "retiros_reten_isr_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" id="<?php echo "retiros_ieps_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="SeparaMiles(this.id)" id="<?php echo "retiros_dap_".$row->id_gasto_venta;?>"></td>
      <td class="tab3-lista" id="<?php echo "retiros_concepto".$row->id_gasto_venta;?>">Costo Venta - <?php echo $row->gasto_venta_concepto ?></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
      <?php
      }
     ?>
    <tr>
      <td colspan="5"></td>
      <td class="tab3-lista2" ><input type="text" disabled="true" id="suma_retencion_iva" size="6"></td>
    </tr>
  </body>
  <?php 
    $total_retiros=$suma_gastos_venta;
    $subtotal_retiros=$total_retiros/1.16;
    $iva_retiros=$subtotal_retiros*0.16;
   ?>
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
      <td class="tab3-total" id="<?php echo "total_retiros";?>">$<?php echo number_format($total_retiros, 2, '.', ',');?></td>
      <td class="tab3-total" id="<?php echo "subtotal_retiros";?>">$<?php echo number_format($subtotal_retiros, 2, '.', ',');?></td>
      <td class="tab3-total" id="<?php echo "iva_retiros";?>">$<?php echo number_format($iva_retiros, 2, '.', ',');?></td>
    </tr>
    <tr>
      <td class="tab3-lista2" colspan="13"><hr style=";border-color:white;border-width: 4px; width: 100%"></td>

    </tr>
    <?php 
      $saldo_final=$total_depositos+$suma_gastos_venta;
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
      <td ><input class="tab3-final" type="text" disabled="true" id="saldo_final" value="$<?php echo number_format($saldo_final, 2, '.', ',');?>"></td>
      <td class="tab3-lista2"></td>
      <td class="tab3-lista2"></td>
    </tr>
    <tr>
      <td><input hidden="true" id="saldo_final_sin_formato" type="number" value="<?php echo $saldo_final ?>"></td>
    </tr>
    <?php 
      $iva_neteo=($iva_depositos-$iva_retiros);
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
      <td class="tab3-lista2"></td>
      <td></td>
      <td class="tab3-lista2"><b>NETEO DE IVA</b></td>
      <td class="tab3-lista2"><input class="tab3-final" type="text" disabled="true" id="neto_iva" value="<?php echo number_format($iva_neteo, 2, '.', ',');?>"></td>
    </tr>
    <?php 
      if ($iva_neteo>0.01) {
        $tipo_iva="IVA A CARGO";
      }else{
        $tipo_iva="IVA A FAVOR";
      }
      if ($iva_neteo<0) {
        $iva_cargo=$iva_neteo*-1;
      }else{
        $iva_cargo=$iva_neteo;
      }
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
      <td class="tab3-lista2"></td>
      <td></td>
      <td class="tab3-lista2" id="tipo_iva"><b><?php echo $tipo_iva ?></b></td>
      <td class="tab3-lista2"><input class="tab3-final" type="text" disabled="true" id="cargo_iva" value="<?php echo number_format($iva_cargo, 2, '.', ',');?>"></td>
    </tr>
    <tr>
      <td class="tab3-lista2" colspan="4"></td>
      <td class="tab3-lista2" colspan="9"><hr style=";border-color:black;border-width: 4px; width: 100%"></td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td>IVA RETENCION</td>
      <td colspan="2"></td>
      <td style="text-align: center" id="iva_retencion">0.00</td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td>IVA TOTAL A CARGO</td>
      <td colspan="2"></td>
      <td style="text-align: center" id="iva_total_cargo"></td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td>(-) IVA A FAVOR PERIODOS ANTERIORES</td>
      <td colspan="2"></td>
      <td style="text-align: center"><input type="text" onblur="SeparaMiles(this.id)" id="iva_favor_periodos_anteriores"></td>
    </tr>
    <tr>
      <td colspan="9"></td>
      <td bgcolor="#FFFF00">IVA NETO A CARGO</td>
      <td bgcolor="#FFFF00" colspan="2"></td>
      <td bgcolor="#FFFF00" style="text-align: center"><input type="text" id="iva_neto_cargo" disabled="true"></td>
    </tr>
    <tr>
      <td colspan="13"><br><br></td>
    </tr>
  </tfoot>
</table>


<script type="text/javascript">
 $(document).ready(function(){

  //alert("entró iva cargo");
   if($("#tipo_iva").text()=="IVA A CARGO"){
        $val1=$("#cargo_iva").val();
        $val2=$("#iva_retencion").text();
        $suma=parseFloat($val1)+parseFloat($val2);
        $("#iva_total_cargo").text($suma);
      }else{
        $val2=$("#iva_retencion").text();
         $suma=parseFloat($val2);
        $("#iva_total_cargo").text($suma);
      }
      $iva_cargo_total=$("#iva_total_cargo").text();
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores=0;
      }
      $suma=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
    $("#iva_neto_cargo").val($suma);  

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

  $("#suma_retencion_iva").change(function(){
      if($("#tipo_iva").text()=="IVA A CARGO"){
        $val1=$("#cargo_iva").val();
        $val2=$("#iva_retencion").text();

        $suma=parseFloat($val1)+parseFloat($val2);
        $("#iva_total_cargo").text($suma.toFixed(2));
      }else{
        $val2=$("#iva_retencion").text();
         $suma=pparseFloat($val2);
        $("#iva_total_cargo").text($suma.toFixed(2));
      }
  });

  });

 document.getElementById("saldo_mes_anterior").onblur =function (){
 if(this.value==""){
  this.value=0;
 }    
    this.value = parseFloat(this.value.replace(/,/g, ""))
                    .toFixed(2)
                    .toString()
                    .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    
   // document.getElementById("display").value = this.value.replace(/,/g, "")
}



function SeparaMiles($id){
  valor=$("#"+$id).val();
  if(valor==""){
    //alert("entro");
    valor=0;
    //alert(valor);
  }
  var resultado=valor.toLocaleString("en");
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  identifica_id=$id.split("_"); //retiros_reten_iva_

  if(identifica_id[2]=="iva"){
    var retencion_iva_suma=0;
    //alert("1.- "+retencion_iva_suma);
    <?php
    foreach ($egresos_gasto_venta->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>").val();
      if(valor_a_sumar==""){
        valor_a_sumar=0;
      }
      //alert("valor a sumar: "+valor_a_sumar);
      sumando=valor_a_sumar.replace(/\./g, '');
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, ''));
      //alert("suma total: "+(retencion_iva_suma)/100);
     <?php
      }
     ?>
     retencion_iva_suma=retencion_iva_suma/100;
     retencion_iva_suma=retencion_iva_suma.toLocaleString("en");
     $("#suma_retencion_iva").val(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
           //alert("entra 1 retencion iva"+retencion_iva_suma);
     if(parseFloat(retencion_iva_suma.replace(/\,/g, ''))>0.01){
      //alert("entra retencion iva"+retencion_iva_suma);
        $("#iva_retencion").text(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
     }else{
      $("#iva_retencion").text("0.00");
     }

       //alert("entró iva cargo");
   if($("#tipo_iva").text()=="IVA A CARGO"){

        $val1=$("#cargo_iva").val();
        $val2=$("#iva_retencion").text();

        $val1=$val1.replace(/\,/g, '');
        $val2=$val2.replace(/\,/g, '');
        $suma=parseFloat($val1)+parseFloat($val2);
        $suma=$suma.toLocaleString("en");
        $("#iva_total_cargo").text(parseFloat($suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }else{

        $val2=$("#iva_retencion").text();
         $suma=parseFloat($val2);
        $("#iva_total_cargo").text($suma.toFixed(2));
      }

      $iva_cargo_total=$("#iva_total_cargo").text();
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores=0;
      }

     $iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.replace(/\,/g, '');
      //alert("iva favor "+$iva_favor_periodos_anteriores+" iva cargo "+$iva_cargo_total);
      $suma_cargo=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      //alert("1 "+$suma_cargo);
      $suma_cargo=$suma_cargo.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma_cargo.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  }

  if(identifica_id[1]=="favor"){  //iva_favor_periodos_anteriores
    $iva_cargo_total=$("#iva_total_cargo").text();
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores=0;
      }
      $iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.replace(/\,/g, '');
      $suma=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      $suma=$suma.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }



}


</script>
