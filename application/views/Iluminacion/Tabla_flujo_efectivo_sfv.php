 <link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\PDFStyles_Flujo_Efectivo_Iluminacion.css">


<table class="tab">
  <tr>
    <td class="tab-logo"><img height="100" width="300" src="..\Resources\Logos\Logo_ISA.png"></td>
    <td class="tab-datos"><b>ILUMINACION SUSTENTABLE AGS, S DE RL DE CV <br> Reporte  por Proyecto</b></td>
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
    $subtotal_depositos=0;
    $subtotal_retiros=0;
    $iva_depositos=0;
    $iva_retiros=0;
    

    //Lista de Pagos de SFV
      $suma_sfv=0;
      foreach ($ingresos_sfv->result() as $row) {
        $suma_sfv+=$row->lista_pago_sfv_total;
        ?>
        <tr>
          <td class="tab2-lista" id="<?php echo "depositos_fecha_sfv".$row->id_lista_pago_sfv;?>"><?php echo $row->lista_pago_sfv_fecha; ?></td>
          <td class="tab2-lista">
            <select id="<?php echo "depositos_ref_sfv".$row->id_lista_pago_sfv;?>">
              <?php if ($row->lista_pago_sfv_referencia=="Transferencia"){ ?>
                <option value="Transferencia" selected="true">Transferencia</option>
              <?php } else{ ?>
                <option value="Transferencia">Transferencia</option>
              <?php } ?>

              <?php if ($row->lista_pago_sfv_referencia=="Deposito_cheque"){ ?>
                <option value="Deposito_cheque" selected="true">Depósito en Cheque</option>
              <?php } else{ ?>
                <option value="Deposito_cheque">Depósito en Cheque</option>
              <?php } ?>

              <?php if ($row->lista_pago_sfv_referencia=="Efectivo"){ ?>
                <option value="Efectivo" selected="true">Efectivo</option>
              <?php } else{ ?>
                <option value="Efectivo">Efectivo</option>
              <?php } ?>
            </select>            
          </td>
          <td class="tab2-lista" onchange="Iva_Cargo()" id="<?php echo "depositos_importe_sfv".$row->id_lista_pago_sfv;?>"><?php echo number_format($row->lista_pago_sfv_total, 5, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_subtota_sfv".$row->id_lista_pago_sfv;?>"><?php echo number_format(($row->lista_pago_sfv_total)/1.16, 5, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_iva_sfv".$row->id_lista_pago_sfv;?>"><?php echo number_format(($row->lista_pago_sfv_total/1.16)*0.16, 5, '.', ',');?></td>
          <td class="tab2-lista" id="<?php echo "depositos_cliente_sfv".$row->id_lista_pago_sfv;?>"><?php echo $row->catalogo_cliente_empresa; ?></td>
          <td class="tab2-lista" id="<?php echo "depositos_concepto_sfv".$row->id_lista_pago_sfv;?>">Pago SFV - <?php echo $row->lista_pago_sfv_coment ?></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
          <td class="tab2-lista2"></td>
        </tr>
      <?php
      }
     ?>

  </body>
  <?php 
    $total_depositos=($suma_importes+$suma_sfv);
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
      <td class="tab2-total" id="total_depositos">$<?php echo number_format($total_depositos, 5, '.', ',');?></td>
      <td class="tab2-total" id="subtotal_depositos">$<?php echo number_format($subtotal_depositos, 5, '.', ',');?></td>
      <td class="tab2-total" id="iva_depositos">$<?php echo number_format($iva_depositos, 5, '.', ',');?></td>
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
  <th class="tab3-retiros2">TOTALES RETIROS</th>
  <th class="tab3-retiros2">SUBTOTAL</th>
  <th class="tab3-retiros2">IVA</th>
  </head>
  <body>
   <?php  //Lista de Pagos de Proyectos
      $suma_gastos_venta=0;
     $suma_retencion_iva=0;
      
      foreach ($egresos_gasto_venta->result() as $row) {
        $suma_gastos_venta+=$row->gasto_venta_monto;
        $suma_retencion_iva+=$row->gasto_venta_iva_ret;
        $iva_retiros+=$row->gasto_venta_iva;


        //Verificar que operación realizar para calcular el Subtotal

        if ( number_format($row->gasto_venta_iva, 5, '.', ',')=="0.0000") {
          $subtotal=0.00000;
        }else{
          if (number_format($row->gasto_venta_iva_ret,2,'.',',')!="0.00000"&&number_format($row->gasto_venta_isr_ret,2,'.',',')!="0.00000") {
            //Se aplica la fórmula para obtener el subtotal=Importe-IVA+Ret_IVA+Ret_ISR
            $subtotal=$row->gasto_venta_monto-$row->gasto_venta_iva+$row->gasto_venta_iva_ret+$row->gasto_venta_isr_ret;
          }else{
            $subtotal=$row->gasto_venta_monto-$row->gasto_venta_iva-$row->gasto_venta_ieps;
          }
        }

      $subtotal_retiros+=$subtotal;

    ?>
    <tr>
      <td class="tab3-lista" id="<?php echo "retiros_fecha_gastos".$row->id_gasto_venta;?>"><?php echo $row->gasto_venta_fecha_pago; ?></td>
      <td class="tab3-lista">
            <select id="<?php echo "retiros_ref".$row->id_gasto_venta;?>">
              <?php if ($row->gasto_venta_referencia=="Transferencia"){ ?>
                <option value="Transferencia" selected="true">Transferencia</option>
              <?php } else{ ?>
                <option value="Transferencia">Transferencia</option>
              <?php } ?>

              <?php if ($row->gasto_venta_referencia=="Deposito_cheque"){ ?>
                <option value="Deposito_cheque" selected="true">Depósito en Cheque</option>
              <?php } else{ ?>
                <option value="Deposito_cheque">Depósito en Cheque</option>
              <?php } ?>

              <?php if ($row->gasto_venta_referencia=="Efectivo"){ ?>
                <option value="Efectivo" selected="true">Efectivo</option>
              <?php } else{ ?>
                <option value="Efectivo">Efectivo</option>
              <?php } ?>
            </select>            
      </td>

      <td class="tab3-lista" id="<?php echo "retiros_importe_gastos".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_monto, 5, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_subtotal_gastos".$row->id_gasto_venta;?>"><?php echo  number_format($subtotal, 5, '.', ',');?></td>
      <td class="tab3-lista" id="<?php echo "retiros_iva_gastos".$row->id_gasto_venta;?>"><?php echo number_format($row->gasto_venta_iva, 5, '.', ',');?></td>
      <td class="tab3-lista"><input size="6" type="text" onblur="Separa_Miles(this.id)" value="<?php echo number_format($row->gasto_venta_iva_ret,2,'.',',') ?>" id="<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>">
      </td>
      <td class="tab3-lista"><input size="6" type="text" onblur="Separa_Miles(this.id)" value="<?php echo number_format($row->gasto_venta_isr_ret,2,'.',',') ?>" id="<?php echo "retiros_reten_isr_".$row->id_gasto_venta;?>">
      </td>
      <td class="tab3-lista"><input size="6" type="text" onblur="Separa_Miles(this.id)" value="<?php echo number_format($row->gasto_venta_ieps,2,'.',',') ?>" id="<?php echo "retiros_ieps_".$row->id_gasto_venta;?>">
      </td>
      <td class="tab3-lista"><input size="6" type="text" onblur="Separa_Miles(this.id)" value="<?php echo number_format($row->gasto_venta_dap,2,'.',',') ?>" id="<?php echo "retiros_dap_".$row->id_gasto_venta;?>">
      </td>
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
      <td class="tab3-lista2"><input type="text" disabled="true" id="suma_retencion_iva" size="6" value="<?php echo number_format($suma_retencion_iva, 5, '.', ',') ?>"></td>
    </tr>
  </body>
  <?php 
    $total_retiros=$suma_gastos_venta;
    //$subtotal_retiros=$total_retiros-$iva_retiros;
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
      <td class="tab3-total" id="<?php echo "total_retiros";?>">$<?php echo number_format($total_retiros, 5, '.', ',');?></td>
      <td class="tab3-total" id="<?php echo "subtotal_retiros";?>">$<?php echo number_format($subtotal_retiros, 5, '.', ',');?></td>
      <td class="tab3-total" id="<?php echo "iva_retiros";?>">$<?php echo number_format($iva_retiros, 5, '.', ',');?></td>
    </tr>
    <tr>
      <td class="tab3-lista2" colspan="13"><hr style=";border-color:white;border-width: 4px; width: 100%"></td>

    </tr>
    <?php 
      $saldo_final=$total_depositos-$suma_gastos_venta;
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
      <td ><input class="tab3-final" type="text" disabled="true" id="saldo_final" value="$<?php echo number_format($saldo_final, 5, '.', ',');?>"></td>
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

  //alert("entró iva cargo");
   if($("#tipo_iva").text()=="IVA A CARGO"){
        $val1=$("#cargo_iva").val();
        $val2=$("#iva_retencion").text();


        $val1=$val1.replace(/\,/g, '');
        $val2=$val2.replace(/\,/g, '');
        $suma=parseFloat($val1)+parseFloat($val2);
        $suma=$suma.toLocaleString("en");
        $("#iva_total_cargo").text(parseFloat($suma.toString().replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }else{
        $val2=$("#iva_retencion").text();
        $val2=$val2.replace(/\,/g, '');
         $suma=parseFloat($val2);
         $("#iva_total_cargo").text(parseFloat($suma.toString().replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }
      $iva_cargo_total=$("#iva_total_cargo").text();
      if($iva_cargo_total==""){
        $iva_cargo_total=0.00;
      }
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores=0;
      }

      //$iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.toString().replace(/\,/g, '');
      $suma=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      $suma=$suma.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma.toString().replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

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



function Separa_Miles($id){
  valor=$("#"+$id).val();
    valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){
    //alert("entro");
    valor=0.00;
    //alert(valor);
  }
  var resultado=valor.toLocaleString("en");
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  identifica_id=$id.split("_"); //retiros_reten_iva_

  if(identifica_id[2]=="iva"){
    var retencion_iva_suma=0;
    //alert("1.- "+retencion_iva_suma);

    //recorremos los inputs de retiros_reten_iva para sumarlos; estos son los de egresos de Gasto Venta
    <?php
    foreach ($egresos_gasto_venta->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>").val();
      if(valor_a_sumar==""){
        valor_a_sumar="0,000.00";
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
        $("#iva_total_cargo").text(parseFloat($suma.toString().replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
      }else{

        $val2=$("#iva_retencion").text();
         $suma=parseFloat($val2);
        $("#iva_total_cargo").text($suma.toFixed(2));
      }

      $iva_cargo_total=$("#iva_total_cargo").text();
      if($iva_cargo_total==""){
        $iva_cargo_total="0,000.00";
      }
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores="0,000.00";
      }

      $iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.toString().replace(/\,/g, '');
      //alert("iva favor "+$iva_favor_periodos_anteriores+" iva cargo "+$iva_cargo_total);
      $suma_cargo=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      //alert("1 "+$suma_cargo);
      $suma_cargo=$suma_cargo.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma_cargo.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }

  if(identifica_id[1]=="favor"){  //iva_favor_periodos_anteriores
      $iva_cargo_total=$("#iva_total_cargo").text();
      if($iva_cargo_total==""){
         $iva_cargo_total="0,000.00";
      }
      $iva_favor_periodos_anteriores=$("#iva_favor_periodos_anteriores").val();
      if($iva_favor_periodos_anteriores==""){
        $iva_favor_periodos_anteriores="0,000.00";
      }
      $iva_favor_periodos_anteriores=$iva_favor_periodos_anteriores.replace(/\,/g, '');
      $iva_cargo_total=$iva_cargo_total.toString().replace(/\,/g, '');
      $suma=parseFloat($iva_favor_periodos_anteriores)+parseFloat($iva_cargo_total);
      $suma=$suma.toLocaleString("en");
    $("#iva_neto_cargo").val(parseFloat($suma.toString().replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }
}

function Separa_Miles2($id){ //Funcion para separar la cantidad ingresada con indicadores en miles
  valor=$("#"+$id).val();//obtenemos el id del input del cual se ingresa un valor
  valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){//verificamos si el valor ingresado es vacío o si es una cadena no numérica para cambiarlo por ceros
    valor=0.00;
  }
//cambiamos la cadena a tipo String con el formato de indioma Inglés ya que este contiene semapador de miles con comas
  var resultado=valor.toLocaleString("en");
  //Regresamos el valor de la variable al input pero ya con un formato de separador de miles y 2 decimales
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));


  identifica_id=$id.split("_"); //retiros_reten_iva_ Separamos el String del id recibido en un arreglo

if(identifica_id[2]=="iva"){ //Verificamos si en la posicion 2 del arreglo el string es igual a "iva", para hacer la suma de la retencion de iva
  retencion_iva_suma=0; //iniciamos la variable para la suma de retencion de iva
    <?php
    //recorremos los inputs de retiros_reten_iva para sumarlos; estos son los de egresos de gasto venta
    foreach ($egresos_gasto_venta->result() as $row) {
    ?>
      valor_a_sumar=$("#<?php echo "retiros_reten_iva_".$row->id_gasto_venta;?>").val();
      if(valor_a_sumar==""||isNaN(valor)){//Verificamos si el dato es vacio o no numérico lo cambiamos por ceros
        valor_a_sumar="0,000.00";
      }
      sumando=valor_a_sumar.replace(/\./g, ''); //eliminamos los puntos decimales
      retencion_iva_suma+=parseFloat(sumando.replace(/\,/g, '')); //eliminamos las comas y realizamos la suma
    <?php
    }
    ?>

   



    retencion_iva_suma=retencion_iva_suma/100; //dividimos entre 100 para determinar los puntos decimales
    //cambiamos la cadena a tipo String con el formato de indioma Inglés ya que este contiene semapador de miles con comas
    retencion_iva_suma=retencion_iva_suma.toLocaleString("en");
    //Ingresamos el valor de la suma de retención de iva al input de retencion de iva suma, con el formato de separador de miles y 2 decimales
    $("#suma_retencion_iva").val(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    //Verificamos si la suma de retención de iva es mayo a 0.01, ingresamos el valor de la suma al input de iva_retencion
    if(parseFloat(retencion_iva_suma.replace(/\,/g, ''))>0.01){
      $("#iva_retencion").text(parseFloat(retencion_iva_suma.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    }else{
      $("#iva_retencion").text("0.00");
    }


  }//Fin del if(identifica_id[2]=="iva")
}

</script>
