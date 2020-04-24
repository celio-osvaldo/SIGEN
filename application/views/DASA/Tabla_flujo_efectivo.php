<div style="text-align: right;">
  <label style="text-align: right;">Saldo Final en Banco Mes Anterior $</label>
  <input type="number" id="saldo_mes_anterior" value="<?php echo $sal_ban_ant; ?>">
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
     <th id="banco_mes_anterior">Saldo Banco Mes Anterior: <hr>$<?php echo $sal_ban_ant; ?></th>
   </tr>
 </thead>
 <tbody>
  <!--Datos de Ingresos -->
  <?php  $no=1; $saldo_total=$sal_ban_ant; foreach ($ingresos_venta_mov->result() as $row) {
    $saldo_total+=$row->venta_mov_monto;?>
    <tr>
     <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
     <td id="<?php echo "fecha".$row->id_venta_mov;?>"><?php echo "".$row->venta_mov_fecha.""; ?> </td>
     <td id="<?php echo "concepto".$row->id_venta_mov;?>"><?php echo "Pago Proyecto: ".$row->venta_mov_comentario.""; ?>
     <td id="<?php echo "cliente".$row->id_venta_mov;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?>
     <td></td>
     <td id="<?php echo "abono".$row->id_venta_mov;?>">$<?php echo "".$row->venta_mov_monto.""; ?>
     <td id="<?php echo "proyecto".$row->id_venta_mov;?>"><?php echo "".$row->obra_cliente_nombre.""; ?>
   </td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?> 

  <!--Datos de Egresos Caja Chica-->
  <?php  $no=1; foreach ($egresos_caja_chica->result() as $row) {
    $saldo_total-=$row->lista_caja_chica_gasto;?>
    <tr>
     <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
     <td id="<?php echo "fecha".$row->id_lista_caja_chica;?>"><?php echo "".$row->lista_caja_chica_fecha.""; ?> </td>
     <td id="<?php echo "concepto".$row->id_lista_caja_chica;?>"><?php echo "Caja Chica: ".$row->lista_caja_chica_concepto.""; ?>
     <td id="<?php echo "cliente".$row->id_lista_caja_chica;?>"><?php echo "".$row->lista_caja_chica_concepto.""; ?>
     <td id="<?php echo "cargo".$row->id_lista_caja_chica;?>">$<?php echo "".$row->lista_caja_chica_gasto.""; ?>
     <td></td>
     <td id="<?php echo "proyecto".$row->id_lista_caja_chica;?>"><?php echo "".$row->lista_caja_chica_concepto.""; ?>
   </td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?>

  <!--Datos de Egresos Gasto Venta-->
  <?php  $no=1; foreach ($egresos_gasto_venta->result() as $row) {
    $saldo_total-=$row->gasto_venta_monto;?>
    <tr>
     <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
     <td id="<?php echo "fecha".$row->id_gasto_venta;?>"><?php echo "".$row->gasto_venta_fecha.""; ?> </td>
     <td id="<?php echo "concepto".$row->id_gasto_venta;?>"><?php echo "Gasto Venta:".$row->gasto_venta_concepto.""; ?>
     <td id="<?php echo "cliente".$row->id_gasto_venta;?>"><?php echo "".$row->obra_cliente_nombre.""; ?>
     <td id="<?php echo "cargo".$row->id_gasto_venta;?>">$<?php echo "".$row->gasto_venta_monto.""; ?>
     <td></td>
     <td id="<?php echo "proyecto".$row->id_gasto_venta;?>"><?php echo "".$row->obra_cliente_nombre.""; ?>
   </td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?>

  <!--Datos de Egresos Viaticos-->
  <?php  $no=1; foreach ($egresos_viatico->result() as $row) {
    $saldo_total-=$row->lista_viatico_importe;?>
    <tr>
     <!--       <td id="<?php// echo "no".$no;?>"><?php echo $no; ?>  </td> -->
     <td id="<?php echo "fecha".$row->id_lista_viatico;?>"><?php echo "".$row->lista_viatico_fecha.""; ?> </td>
     <td id="<?php echo "concepto".$row->id_lista_viatico;?>"><?php echo "Empleado: ".$row->empleado."<br>Concepto:".$row->lista_viatico_concepto; ?>
     <td id="<?php echo "cliente".$row->id_lista_viatico;?>"><?php echo "".$row->obra_cliente_nombre.""; ?>
     <td id="<?php echo "cargo".$row->id_lista_viatico;?>">$<?php echo "".$row->lista_viatico_importe.""; ?>
     <td></td>
     <td id="<?php echo "proyecto".$row->id_lista_viatico;?>"><?php echo "".$row->obra_cliente_nombre.""; ?>
   </td>
   <td></td>
 </tr>
 <?php 
 $no++;
} ?>

  <!--Datos de Egresos Otros Gastos-->
  <?php  $no=1; foreach ($egresos_otros_gastos->result() as $row) {
    $saldo_total-=$row->saldo;?>
    <tr>
     <td id="<?php echo "fecha".$row->id_OGasto;?>"><?php echo "".$row->fecha_pago_factura.""; ?> </td>
     <td id="<?php echo "concepto".$row->id_OGasto;?>"><?php echo "".$row->concepto.""; ?>
     <td id="<?php echo "cliente".$row->id_OGasto;?>"><?php echo "".$row->concepto.""; ?>
     <td id="<?php echo "cargo".$row->id_OGasto;?>">$<?php echo "".$row->saldo.""; ?>
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
    <th id="cargo"></th>
    <th id="abono"></th>
    <th id="saldo"></th>
  </tr>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>
    <button class="btn btn-success" onclick="Almacena_Rep()">Almacenar Reporte</button>     
    </th>
  </tr>
</tfoot>

</table>
</div>
</div>

<script type="text/javascript">
  $(document).ready( function () {
    $('#table_flujo_efectivo').DataTable( 
    { 
      dom: 'Bfrtip',
      buttons: [ 
        {
            extend: 'pdf',
            title: 'Flujo de Efectivo\n Empresa: DASA\n'+$('#fecha_letra').text(),
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
            title: 'Flujo de Efectivo\n Empresa: DASA\n'+$('#fecha_letra').text(),
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            },
            header: true,
            footer: true
        }

    ],
    //Suma de Ingresos)
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
              return typeof i === 'string' ?
              i.replace(/[\$,]/g, '')*1 :
              typeof i === 'number' ?
              i : 0;
            };
            // Total over all pages
            total_ing = api //Sumamos todas los valores de la columna Abonos
            .column( 4 )
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

            total_eg = api //Sumamos todas los valores de la columna Cargos
            .column( 3 )
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );
            // Update footer
            $( api.column( 3 ).footer() ).html(
              'Total Egreso: $'+ total_eg
              );
            $( api.column( 4 ).footer() ).html(
              'Total Ingreso: $'+ total_ing
              );
            $( api.column( 5 ).footer() ).html(
              'Saldo Final en Banco: $'+ (  parseFloat($('#saldo_mes_anterior').val())+total_ing-total_eg)
              );
          }
        }
        );


    $('#saldo_mes_anterior').change(function(){
          //alert($('#saldo_mes_anterior').val());
          //$sal_ban_ant=>$('#saldo_mes_anterior').val();
          $saldo=$('#saldo_mes_anterior').val();
          <?php foreach ($ingresos_venta_mov->result() as $row){ ?>
            $monto=<?php echo $row->venta_mov_monto; ?>;
            if($saldo==""){
              $saldo=0;
            }
            $nuevo_saldo=parseFloat($monto)+parseFloat($saldo);
            $('#saldo'+<?php echo $row->id_venta_mov;?>).text($nuevo_saldo);
          <?php } ?>
          $total_cargo=$('#cargo').text().split('$');
          $total_abono=$('#abono').text().split('$');
          if($total_cargo[1]==""){
            $total_cargo[1]=0;
          }
          if($total_abono[1]==""){
            $total_abono[1]=0;
          }
          $('#saldo').text("Saldo Final en Banco: $"+(parseFloat($saldo)-parseFloat($total_cargo[1])+parseFloat($total_abono[1])));
          $('#banco_mes_anterior').html("Saldo Banco Mes Anterior: "+'<hr>'+"$"+(parseFloat($saldo)));
          
        });
  });

  function Almacena_Rep() {
   // alert("Almacenar");
    var fecha=$('#fecha_letra').text().split(' del ');
    //alert(mes[0]+" "+mes[1]);
    var mes=fecha[0];
    var anio=fecha[1];
    var saldo_ini=$('#banco_mes_anterior').text().split('Saldo Banco Mes Anterior: $');
    var saldo_fin=$('#saldo').text().split('Saldo Final en Banco: $');
    var ingreso=$('#abono').text().split('Total Ingreso: $');
    var egresos=$('#cargo').text().split('Total Egreso: $');
    //alert(mes+" "+anio+" "+saldo_ini[1]+" "+saldo_fin[1]+" "+ingreso[1]+" "+egresos[1]);

    $.ajax({
      type:"POST",
      url:"<?php echo base_url();?>Dasa/Save_Reporte_flujo",
      data:{mes:mes, anio:anio, saldo_ini:saldo_ini[1], saldo_fin:saldo_fin[1], ingreso:ingreso[1], egresos:egresos[1]},
      success:function(result){
            //alert(result);
            if(result){
              alert('Registro Actualizado');
              if(result=='existe')
              alert('Registro ya existe');
            }else{
              alert('Falló el servidor. Registro no actualizado');
            }
          }
        });
  }

</script>