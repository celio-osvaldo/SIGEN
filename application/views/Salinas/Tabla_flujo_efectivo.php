<div style="text-align: right;">
  <label style="text-align: right;">Saldo Final en Banco Mes Anterior $</label>
  <input type="text" onblur="SeparaMiles(this.id)" id="saldo_mes_anterior" value="<?php echo number_format($sal_ban_ant,2,'.',','); ?>">
</div> 
<label hidden="true" id="fecha_letra"><?php echo $mes." del ".$anio ?></label>  

<table id="table_flujo_efectivo" class="table table-striped table-hover display" style="font-size: 10pt;">
  <thead class="bg-primary" style="color: #FFFFFF;" align="center">
    <tr>
     <!-- <th>No.</th>  -->
     <th>Fecha</th>
     <th>Concepto</th>
     <th>Proveedor/Cliente</th>
     <th>Cargos (-)</th>
     <th>Abonos(+)</th>
     <th>Ubicación</th>
     <th id="banco_mes_anterior">Saldo Banco Mes Anterior: <hr>$<?php echo number_format($sal_ban_ant,2,'.',','); ?></th>
   </tr>
 </thead>
 <tbody>
  <!--Datos de Ingresos -->
  <?php  $no=1; $saldo_total=$sal_ban_ant; 
    $suma_ingresos=0;
    $suma_egresos=0;
    foreach ($ingresos_venta_mov->result() as $row) {
     if ($row->venta_mov_estim_estatus=="1") {
         $saldo_total+=$row->venta_mov_monto;
    $suma_ingresos+=$row->venta_mov_monto;
  ?>
    <tr>
     <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
     <td id="<?php echo "fecha".$row->id_venta_mov;?>"><?php echo "".$row->venta_mov_fecha.""; ?> </td>
     <td id="<?php echo "concepto".$row->id_venta_mov;?>"><?php echo "Pago Proyecto: ".$row->venta_mov_comentario.""; ?></td>
     <td id="<?php echo "cliente".$row->id_venta_mov;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
     <td></td>
     <td id="<?php echo "abono".$row->id_venta_mov;?>">$<?php echo number_format($row->venta_mov_monto,2,'.',',').""; ?></td>
     <td id="<?php echo "proyecto".$row->id_venta_mov;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
     <td></td>
   </tr>
   <?php 
   $no++;
      } 
 } ?> 

 <!--Datos de Egresos Caja Chica-->
 <?php  $no=1; foreach ($egresos_caja_chica->result() as $row) {
  if($row->lista_caja_chica_gasto==0){
    $caja_chica=$row->lista_caja_chica_reposicion;
  }else{
    $caja_chica=$row->lista_caja_chica_gasto;
  }
  $saldo_total-=$caja_chica;
  $suma_egresos+=$caja_chica;
  ?>
  <tr>
   <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
   <td id="<?php echo "fecha".$row->id_lista_caja_chica;?>"><?php echo "".$row->lista_caja_chica_fecha.""; ?> </td>
   <td id="<?php echo "concepto".$row->id_lista_caja_chica;?>"><?php echo "Caja Chica: ".$row->lista_caja_chica_concepto.""; ?></td>
   <td id="<?php echo "cliente".$row->id_lista_caja_chica;?>"><?php echo "".$row->lista_caja_chica_concepto.""; ?></td>
   <td id="<?php echo "cargo".$row->id_lista_caja_chica;?>">$<?php echo number_format($caja_chica,2,'.',',').""; ?></td>
   <td></td>
   <td id="<?php echo "proyecto".$row->id_lista_caja_chica;?>"><?php echo "".$row->lista_caja_chica_concepto.""; ?></td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?>

<!--Datos de Egresos Gasto Venta-->
<?php  $no=1; foreach ($egresos_gasto_venta->result() as $row) {
  $saldo_total-=$row->gasto_venta_monto;
  $suma_egresos+=$row->gasto_venta_monto;
  ?>
  <tr>
   <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
   <td id="<?php echo "fecha".$row->id_gasto_venta;?>"><?php echo "".$row->gasto_venta_fecha.""; ?> </td>
   <td id="<?php echo "concepto".$row->id_gasto_venta;?>"><?php echo "Gasto Venta:".$row->gasto_venta_concepto.""; ?></td>
   <td id="<?php echo "cliente".$row->id_gasto_venta;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
   <td id="<?php echo "cargo".$row->id_gasto_venta;?>">$<?php echo number_format($row->gasto_venta_monto,2,'.',',').""; ?></td>
   <td></td>
   <td id="<?php echo "proyecto".$row->id_gasto_venta;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?>

<!--Datos de Egresos Viaticos-->
<?php  $no=1; foreach ($egresos_viatico->result() as $row) {
  $saldo_total-=$row->lista_viatico_importe;
  $suma_egresos+=$row->lista_viatico_importe;
  ?>
  <tr>
   <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
   <td id="<?php echo "fecha".$row->id_lista_viatico;?>"><?php echo "".$row->lista_viatico_fecha.""; ?> </td>
   <td id="<?php echo "concepto".$row->id_lista_viatico;?>"><?php echo "Empleado: ".$row->empleado."<br>Concepto:".$row->lista_viatico_concepto; ?></td>
   <td id="<?php echo "cliente".$row->id_lista_viatico;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
   <td id="<?php echo "cargo".$row->id_lista_viatico;?>">$<?php echo number_format($row->lista_viatico_importe,2,'.',',').""; ?></td>
   <td></td>
   <td id="<?php echo "proyecto".$row->id_lista_viatico;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?>

<!--Datos de Egresos Otros Gastos-->
<?php  $no=1; foreach ($egresos_otros_gastos->result() as $row) {
  $saldo_total-=$row->saldo;
  $suma_egresos+=$row->saldo
  ?>
  <tr>
   <td id="<?php echo "fecha".$row->id_OGasto;?>"><?php echo "".$row->fecha_pago_factura.""; ?> </td>
   <td id="<?php echo "concepto".$row->id_OGasto;?>"><?php echo "".$row->concepto.""; ?></td>
   <td id="<?php echo "cliente".$row->id_OGasto;?>"><?php echo "".$row->concepto.""; ?></td>
   <td id="<?php echo "cargo".$row->id_OGasto;?>">$<?php echo number_format($row->saldo,2,'.',',').""; ?></td>
   <td></td>
   <td id="<?php echo "proyecto".$row->id_OGasto;?>">Otros Gastos</td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?>
</tbody>
<tfoot>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th id="cargo_total">Total Egreso: $<?php echo number_format($suma_egresos,2,'.',',')?></th>
    <th id="abono_total">Total Ingreso: $<?php echo number_format($suma_ingresos,2,'.',',')?></th>
    <th id="saldo_total">Saldo Final en Banco: $<?php echo number_format($saldo_total,2,'.',',')?></th>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>
      <button class="btn btn-success" onclick="Almacena_Rep()">Almacenar Reporte</button>     
    </td>
  </tr>
</tfoot>
</table>

<script type="text/javascript">
  $(document).ready( function () {

    $('#table_flujo_efectivo').DataTable( 
    { 
      dom: 'Blfrtip',
      buttons: [ 
        {
            extend: 'excel',
            title: 'Flujo de Efectivo\n Empresa: SALINAS \n'+$('#fecha_letra').text(),
            orientation: 'landscape',
            pageSize: 'LETTER',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            },
            header: true,
            footer: true
        },
        {
            extend: 'pdf',
            title: 'Flujo de Efectivo\n Empresa: SALINAS \n'+$('#fecha_letra').text(),
            orientation: 'landscape',
            pageSize: 'LETTER',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            },
            header: true,
            footer: true
        },
                {
            extend: 'copy',
            title: 'Flujo de Efectivo\n Empresa: SALINAS \n'+$('#fecha_letra').text(),
            orientation: 'landscape',
            pageSize: 'LETTER',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            },
            header: true,
            footer: true
        }]
      });



    $('#saldo_mes_anterior').change(function(){
          $saldo=$('#saldo_mes_anterior').val();
          $saldo=$saldo.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
          if($saldo==""||isNaN($saldo)){
            $saldo=0.00;
          }
          <?php foreach ($ingresos_venta_mov->result() as $row){ ?>
            $monto=<?php echo $row->venta_mov_monto; ?>;
            if($saldo==""){
              $saldo=0;
            }
            $nuevo_saldo=parseFloat($monto)+parseFloat($saldo);
            $('#saldo'+<?php echo $row->id_venta_mov;?>).text($nuevo_saldo);
          <?php } ?>
          $total_cargo=$('#cargo_total').text().replace(/\,/g, '').split('$');
          $total_abono=$('#abono_total').text().replace(/\,/g, '').split('$');
          if($total_cargo[1]==""){
            $total_cargo[1]=0;
          }
          if($total_abono[1]==""){
            $total_abono[1]=0;
          }


          //$saldo=$saldo.toLocaleString("en");
          //$saldo=(parseFloat($saldo.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

          //alert($saldo);
          $saldo_total=(parseFloat($saldo)-parseFloat($total_cargo[1])+parseFloat($total_abono[1]));
          $saldo=$saldo.toLocaleString("en");
          $saldo=(parseFloat($saldo.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));

          $saldo_total=$saldo_total.toLocaleString("en");
           $saldo_total=(parseFloat($saldo_total.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));



          $('#saldo_total').text("Saldo Final en Banco: $"+$saldo_total);
          $('#banco_mes_anterior').html("Saldo Banco Mes Anterior: "+'<hr>'+"$"+($saldo));
          
        });
  });


  function Almacena_Rep() {
   // alert("Almacenar");
    var fecha=$('#fecha_letra').text().split(' del ');
    //alert(mes[0]+" "+mes[1]);
    var mes=fecha[0];
    var anio=fecha[1];
    var saldo_ini=$('#banco_mes_anterior').text().split('Saldo Banco Mes Anterior: $');
    saldo_ini[1]=saldo_ini[1].replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
    var saldo_fin=$('#saldo_total').text().split('Saldo Final en Banco: $');
    saldo_fin[1]=saldo_fin[1].replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
    var ingreso=$('#abono_total').text().split('Total Ingreso: $');
    ingreso[1]=ingreso[1].replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
    var egresos=$('#cargo_total').text().split('Total Egreso: $');
    egresos[1]=egresos[1].replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
    //alert(mes+" "+anio+" "+saldo_ini[1]+" "+saldo_fin[1]+" "+ingreso[1]+" "+egresos[1]);

    $.ajax({
      type:"POST",
      url:"<?php echo base_url();?>Salinas/Save_Reporte_flujo",
      data:{mes:mes, anio:anio, saldo_ini:saldo_ini[1], saldo_fin:saldo_fin[1], ingreso:ingreso[1], egresos:egresos[1]},
      success:function(result){
            //alert(result);
            if(result){
              alert('Registro Actualizado');
            }else{
              alert('Falló el servidor. Registro no actualizado');
            }
          }
        });
  }


function SeparaMiles($id){
  valor=$("#"+$id).val();
    valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){
    //alert("entro");
    valor=0.00;
    //alert(valor);
  }
  var resultado=valor.toLocaleString("en");
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }


</script>