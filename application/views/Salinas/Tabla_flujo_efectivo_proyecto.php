


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
   </tr>
 </thead>
 <tbody>
  <!--Datos de Ingresos -->
  <?php  $no=1; $saldo_total=0;
    $suma_ingresos=0;
    $suma_egresos=0;
    foreach ($ingresos_venta_mov->result() as $row) {
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



</tbody>
<tfoot>
  <tr>
    <th></th>
    <th></th>
    <th></th>
    <th id="cargo_total">Total Egreso: $<?php echo number_format($suma_egresos,2,'.',',')?></th>
    <th id="abono_total">Total Ingreso: $<?php echo number_format($suma_ingresos,2,'.',',')?></th>
    <th id="saldo_total">Saldo Final del Proyecto: $<?php echo number_format($saldo_total,2,'.',',')?></th>
  </tr>
</tfoot>
</table>

<script type="text/javascript">
  $(document).ready( function () {

    $('#table_flujo_efectivo').DataTable( 
    { 
      dom: 'Bfrtip',
      buttons: [ 
        {
            extend: 'pdf',
            title: 'Flujo de Efectivo\n Empresa: SALINAS \n'+$('#fecha_letra').text(),
            orientation: 'landscape',
            pageSize: 'LETTER',
            exportOptions: {
                modifier: {
                    //page: 'current'
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
                    //page: 'current'
                }
            },
            header: true,
            footer: true
        }]
      });
  });



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