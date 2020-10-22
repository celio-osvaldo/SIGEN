<div class="row">
  <div class="col-md-6" align="center">
    <h6>REPORTE DE ESTIMACIONES</h6>
  </div>
  <div class="col-md-6" align="center" id="fecha_reporte">
    <h6>FECHA DE REPORTE: <?php date_default_timezone_set('America/Mexico_City'); echo date("d/m/Y"); ?></h6>
  </div>
</div>
<div class="row">
  <div class="col-md-12" align="center" style="background-color: #CCC0DA" id="proyecto">
    <b>DASA - <?php echo $obra->obra_cliente_nombre ?></b>
  </div>
</div>

<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_estimacion" class="table table-striped table-hover display" style="font-size: 9pt; ">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Folio</th>
          <th>Concepto</th>
          <th>Monto Factura</th>
          <th>Estatus</th>
          <th>Amortización por Anticipo (-)</th>
          <th>Anticipo por Amortizar</th>
          <th>Fecha de Entrega</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $pagadas=0;
        $por_pagar=0;
        foreach ($payments_list->result() as $row) {
          ?>
          <tr>
            <td id="<?php echo "folio".$row->id_venta_mov;?>"><input class="form-control form-control-sm" size="2" type="text" id="<?php echo "folio_txt".$row->id_venta_mov;?>" name="<?php echo "folio_txt".$row->id_venta_mov;?>" value="<?php echo $row->venta_mov_factura ?>"></td>
            <td id="<?php echo "concepto".$row->id_venta_mov;?>"> <?php echo "".$row->venta_mov_comentario.""; ?></td>
            <td id="<?php echo "monto".$row->id_venta_mov;?>">$<?php echo number_format($row->venta_mov_monto,2,'.',',').""; ?> </td>

            <?php if ($row->venta_mov_estim_estatus){
              $pagadas+=$row->venta_mov_monto;?>
              <td id="<?php echo "estatus".$row->id_venta_mov;?>"><label hidden="true" id="<?php echo "estatus_id".$row->id_venta_mov;?>">1</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_paloma(this.id)" id="<?php echo $row->id_venta_mov;?>"><img height="25" src="..\Resources\Icons\paloma.ico"></button></td>
              
            <?php }else{
              $por_pagar+=$row->venta_mov_monto;?>
               <td id="<?php echo "estatus".$row->id_venta_mov;?>"><label hidden="true" id="<?php echo "estatus_id".$row->id_venta_mov;?>">0</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_menos(this.id)" id="<?php echo $row->id_venta_mov;?>"><img height="25" src="..\Resources\Icons\menos.ico"></button></td>
            <?php } ?>

            <td><input class="form-control form-control-sm col-md-8" onblur="SeparaMiles(this.id)" type="text" id="<?php echo "amortizacion".$row->id_venta_mov;?>" value="<?php echo $row->venta_mov_estim_amor_ant ?>"></td>
            <td><input type="text" class="form-control form-control-sm col-md-8" onblur="SeparaMiles(this.id)" id="<?php echo "anticipo_amort".$row->id_venta_mov;?>" value="<?php echo $row->venta_mov_estim_ant_amort ?>"></td>
            <td><input type="date" class="form-control form-control-sm col-md-12" id="<?php echo "fecha".$row->id_venta_mov;?>" value="<?php echo $row->venta_mov_estim_fecha ?>"></td>
        </tr>
        <?php 
        }
        ?>
      </tbody>
      <tfoot style="font-weight: bold;">
        <tr>
          <td bgcolor="#00B050">PAGADAS</td>
          <td id="pagadas" bgcolor="#00B050">$<?php echo number_format($pagadas,2, '.', ',') ?></td>
          <td colspan="3"></td>
          <td align="center" colspan="2">
            <a class="navbar-block" onclick="Guardar(this.id)" role="button" id="guardar"><button class="btn btn-sm btn-block btn-outline-secondary btn-xs"><img src="..\Resources\Icons\guardar.ico" width="15" alt="Guardar">  GUARDAR REPORTE DE ESTIMACIONES</button></a>
          </td>
        </tr>
        <tr>
          <td bgcolor="#B7DEE8">POR PAGAR</td>
          <td bgcolor="#B7DEE8" id="por_pagar">$<?php echo number_format($por_pagar,2, '.', ',') ?></td>
          <td colspan="5"></td>
        </tr>
        <tr>
          <td bgcolor="#FDE9D9">DEDUCCIONES</td>
          <td bgcolor="#FDE9D9"><input type="text" id="deducciones" value="0.00" onblur="SeparaMiles(this.id)" onchange="CalculaSuma()" name="deducciones"></td><hr>
          <td colspan="5"></td>
        </tr>
        <tr>
          <td bgcolor="#FFFF00">SUMA</td>
          <td bgcolor="#FFFF00"><label id="suma"></label></td>
          <td colspan="5"></td>
        </tr>
        <tr>
          <td bgcolor="#FFFF00">TOTAL CONTRATO</td>
          <td bgcolor="#FFFF00">$<label id="total_contrato"></label></td>
          <td colspan="5"></td>
        </tr>
      </tfoot>
    </table>
  </div>
</div>

<script type="text/javascript">
   $(document).ready( function () {
    $('#table_estimacion').DataTable();
    CalculaSuma();
});

   function CalculaSuma(){
    pagadas=$("#pagadas").text().split('$');
    //alert(pagadas);
    por_pagar=$("#por_pagar").text().split('$');
    deducciones=$("#deducciones").val();
    if (deducciones==""||isNaN(deducciones)) {
      deducciones="0.00";
      $("#deducciones").val(deducciones);
      alert("Valor Ingresado Incorrecto\nNo debe ingresar caracteres $#,*/-%");
    }
    suma=parseFloat(pagadas[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(por_pagar[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(deducciones.replace(/\,/g, '').replace(/\'/g, ''));
     var resultado=suma.toLocaleString("en");
  $("#suma").text("$"+parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  total_contrato=<?php echo $obra->obra_cliente_imp_total ?>;
  //alert(total_contrato);

     var total_contrato=total_contrato.toLocaleString("en");
  $("#total_contrato").text(parseFloat(total_contrato.replace(/,/g, "").replace(/\'/g, '')).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
   }

   function Estatus_paloma($id_venta_mov){
    $("#estatus"+$id_venta_mov).html('<label hidden="true" id="<?php echo "estatus_id".$row->id_venta_mov;?>">0</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_menos(this.id)" id="'+$id_venta_mov+'"><img height="25" src="../Resources/Icons/menos.ico"></button>');
    monto=$("#monto"+$id_venta_mov).text().split('$');

    pagadas=$("#pagadas").text().split('$');

    pagadas=parseFloat(pagadas[1].replace(/\,/g, '').replace(/\'/g, ''))-parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    pagadas=pagadas.toLocaleString("en");
    $("#pagadas").text("$"+parseFloat(pagadas.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    por_pagar=$("#por_pagar").text().split('$');
    por_pagar=parseFloat(por_pagar[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    por_pagar=por_pagar.toLocaleString("en");
    $("#por_pagar").text("$"+parseFloat(por_pagar.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

   }
      function Estatus_menos($id_venta_mov){
    $("#estatus"+$id_venta_mov).html('<label hidden="true" id="<?php echo "estatus_id".$row->id_venta_mov;?>">1</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_paloma(this.id)"  id="'+$id_venta_mov+'"><img height="25" src="../Resources/Icons/paloma.ico"></button>');
    monto=$("#monto"+$id_venta_mov).text().split('$');

    pagadas=$("#pagadas").text().split('$');

    pagadas=parseFloat(pagadas[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    pagadas=pagadas.toLocaleString("en");
    $("#pagadas").text("$"+parseFloat(pagadas.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    por_pagar=$("#por_pagar").text().split('$');
    por_pagar=parseFloat(por_pagar[1].replace(/\,/g, '').replace(/\'/g, ''))-parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    por_pagar=por_pagar.toLocaleString("en");
    $("#por_pagar").text("$"+parseFloat(por_pagar.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

   }

</script>
