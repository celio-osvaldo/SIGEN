<div class="row">
  <div class="col-md-6" align="center">
    <h6>REPORTE DE ESTIMACIONES</h6>
  </div>
  <div class="col-md-6" align="center" id="fecha_reporte">
    <h6>FECHA DE REPORTE: <label id="fecha_hoy"><?php date_default_timezone_set('America/Mexico_City'); echo date("d/m/Y"); ?></label></h6>
  </div>
</div>
<div class="row">
  <div class="col-md-12" align="center" style="background-color: #CCC0DA" id="proyecto">
    <b>DASA - <label id="nom_proy"><?php echo $obra->obra_cliente_nombre ?></b></label>
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
          <th>Fecha de Entrega Factura a IIFEA</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $pagadas=0;
        $por_pagar=0;
        foreach ($payments_list->result() as $row) {
          ?>
          <tr>
            <td id="<?php echo "folio".$row->id_venta_mov;?>"><input class="form-control form-control-sm" size="2" type="text" id="<?php echo "folio_txt".$row->id_venta_mov;?>" name="<?php echo "folio_txt".$row->id_venta_mov;?>" value="<?php echo $row->venta_mov_factura ?>" onchange="Pasa_label('<?php echo 'folio*'.$row->id_venta_mov;?>')"><label hidden="true" id="<?php echo "folio_lbl".$row->id_venta_mov;?>"><?php echo $row->venta_mov_factura ?></label></td>

            <td id="<?php echo "concepto".$row->id_venta_mov;?>"> <?php echo "".$row->venta_mov_comentario.""; ?></td>

            <td id="<?php echo "monto".$row->id_venta_mov;?>">$<?php echo number_format($row->venta_mov_monto,2,'.',',').""; ?> </td>

            <?php if ($row->venta_mov_estim_estatus){
              $pagadas+=$row->venta_mov_monto;?>
              <td id="<?php echo "estatus".$row->id_venta_mov;?>"><label hidden="true"  id="<?php echo "estatus_id".$row->id_venta_mov;?>">1</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_paloma(this.id)" id="<?php echo $row->id_venta_mov;?>"><img height="25" src="..\Resources\Icons\paloma.ico"></button></td>
              
            <?php }else{
              $por_pagar+=$row->venta_mov_monto;?>
               <td id="<?php echo "estatus".$row->id_venta_mov;?>"><label hidden="true"  id="<?php echo "estatus_id".$row->id_venta_mov;?>">0</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_menos(this.id)" id="<?php echo $row->id_venta_mov;?>"><img height="25" src="..\Resources\Icons\menos.ico"></button></td>
            <?php } ?>

            <td><input class="form-control form-control-sm col-md-8" onblur="SeparaMiles(this.id)" type="text" id="<?php echo "amortizacion_txt".$row->id_venta_mov;?>" value="<?php echo number_format($row->venta_mov_estim_amor_ant,2,'.',',') ?>" onchange="Pasa_label('<?php echo 'amortizacion*'.$row->id_venta_mov;?>')"><label hidden="true">$</label><label hidden="true" id="<?php echo "amortizacion_lbl".$row->id_venta_mov;?>"><?php echo number_format($row->venta_mov_estim_amor_ant,2,'.',',') ?></label></td>

            <td><input type="text" class="form-control form-control-sm col-md-8" onblur="SeparaMiles(this.id)" id="<?php echo "anticipo_amort_txt".$row->id_venta_mov;?>" value="<?php echo number_format($row->venta_mov_estim_ant_amort,2,'.',',') ?>" onchange="Pasa_label('<?php echo 'anticipo_amort*'.$row->id_venta_mov;?>')"><label hidden="true">$</label><label hidden="true" id="<?php echo "anticipo_amort_lbl".$row->id_venta_mov;?>"><?php echo number_format($row->venta_mov_estim_ant_amort,2,'.',',') ?></label></td>

            <td><input type="date" class="form-control form-control-sm col-md-12" id="<?php echo "fecha_txt".$row->id_venta_mov;?>" value="<?php echo $row->venta_mov_estim_fecha ?>" onchange="Pasa_label('<?php echo 'fecha*'.$row->id_venta_mov;?>')"><label hidden="true" id="<?php echo "fecha_lbl".$row->id_venta_mov;?>"><?php echo $row->venta_mov_estim_fecha ?></label></td>
        </tr>
        <?php 
        }
        ?>
      </tbody>
      <tfoot style="font-weight: bold;">
        <tr hidden="true">
          <td>PAGADAS: $<label id="pagadas_lbl"><?php echo number_format($pagadas,2, '.', ',') ?></label></td>
          <td>POR PAGAR: $<label id="por_pagar_lbl"><?php echo number_format($por_pagar,2, '.', ',') ?></label></td>
          <td>DEDUCCIONES: $<label id="deducciones_lbl"><?php echo number_format($obra->obra_cliente_deducciones,2,'.',',') ?></label></td>
          <td>SUMA: $<label id="suma_lbl"></label></td>
          <td>TOTAL CONTRATO: $<label id="total_contrato_lbl"></label></td>
          <td>ESTATUS</td>
          <td>0=Pago Pendiente 1=Pagado</td>
        </tr>

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
          <td bgcolor="#FDE9D9"><input type="text" id="deducciones" value="<?php echo number_format($obra->obra_cliente_deducciones,2,'.',',') ?>" onblur="SeparaMiles(this.id)" onchange="CalculaSuma()" name="deducciones"></td><hr>
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
    $('#table_estimacion').DataTable( 
    { 
      dom: 'Blfrtip',
      buttons: [ 
        {
            extend: 'excel',
            title: 'Reporte de Estimaciones\n Empresa: DASA Proyecto: '+$("#nom_proy").text()+' \n'+ $("#fecha_hoy").text(),
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
            extend: 'pdf',
            title: 'Reporte de Estimaciones\n Empresa: DASA Proyecto: '+$("#nom_proy").text()+' \n'+ $("#fecha_hoy").text(),
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
            title: 'Reporte de Estimaciones\n Empresa: DASA Proyecto: '+$("#nom_proy").text()+' \n'+ $("#fecha_hoy").text(),
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
    CalculaSuma();
});

   function CalculaSuma(){
    pagadas=$("#pagadas").text().split('$');
    //alert(pagadas);
    por_pagar=$("#por_pagar").text().split('$');
    deducciones=$("#deducciones").val().replace(/\,/g, '').replace(/\'/g, '');
    if (deducciones==""||isNaN(deducciones)) {
      deducciones="0.00";
      $("#deducciones").val(deducciones);
      alert("Valor Ingresado Incorrecto\nNo debe ingresar caracteres $#,*/-%");
    }

    $("#deducciones_lbl").text($("#deducciones").val());

    suma=parseFloat(pagadas[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(por_pagar[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(deducciones.replace(/\,/g, '').replace(/\'/g, ''));
     var resultado=suma.toLocaleString("en");
  $("#suma").text("$"+parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $("#suma_lbl").text(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

  total_contrato=<?php echo $obra->obra_cliente_imp_total ?>;
  //alert(total_contrato);

     var total_contrato=total_contrato.toLocaleString("en");
  $("#total_contrato").text(parseFloat(total_contrato.replace(/,/g, "").replace(/\'/g, '')).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  $("#total_contrato_lbl").text(parseFloat(total_contrato.replace(/,/g, "").replace(/\'/g, '')).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
   }

   function Estatus_paloma($id_venta_mov){
    $("#estatus"+$id_venta_mov).html('<label hidden="true" id="<?php echo "estatus_id".$row->id_venta_mov;?>">0</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_menos(this.id)" id="'+$id_venta_mov+'"><img height="25" src="../Resources/Icons/menos.ico"></button>');
    monto=$("#monto"+$id_venta_mov).text().split('$');

    pagadas=$("#pagadas").text().split('$');

    pagadas=parseFloat(pagadas[1].replace(/\,/g, '').replace(/\'/g, ''))-parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    pagadas=pagadas.toLocaleString("en");
    $("#pagadas").text("$"+parseFloat(pagadas.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $("#pagadas_lbl").text(parseFloat(pagadas.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    por_pagar=$("#por_pagar").text().split('$');
    por_pagar=parseFloat(por_pagar[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    por_pagar=por_pagar.toLocaleString("en");
    $("#por_pagar").text("$"+parseFloat(por_pagar.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $("#por_pagar_lbl").text(parseFloat(por_pagar.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

   }
      function Estatus_menos($id_venta_mov){
    $("#estatus"+$id_venta_mov).html('<label hidden="true" id="<?php echo "estatus_id".$row->id_venta_mov;?>">1</label><button class="btn btn-sm btn-outline-secondary btn-xs" onclick="Estatus_paloma(this.id)"  id="'+$id_venta_mov+'"><img height="25" src="../Resources/Icons/paloma.ico"></button>');
    monto=$("#monto"+$id_venta_mov).text().split('$');

    pagadas=$("#pagadas").text().split('$');

    pagadas=parseFloat(pagadas[1].replace(/\,/g, '').replace(/\'/g, ''))+parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    pagadas=pagadas.toLocaleString("en");
    $("#pagadas").text("$"+parseFloat(pagadas.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $("#pagadas_lbl").text(parseFloat(pagadas.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));

    por_pagar=$("#por_pagar").text().split('$');
    por_pagar=parseFloat(por_pagar[1].replace(/\,/g, '').replace(/\'/g, ''))-parseFloat(monto[1].replace(/\,/g, '').replace(/\'/g, ''));
    por_pagar=por_pagar.toLocaleString("en");
    $("#por_pagar").text("$"+parseFloat(por_pagar.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    $("#por_pagar_lbl").text(parseFloat(por_pagar.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{6})+(?!\d))/g, "'").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
   }

   function Guardar(){

    <?php 
    $total=0;
    $total_guarda=0;
    foreach ($payments_list->result() as $row2) {
      $total++;
      ?>
      folio_txt=$("#folio_txt"+<?php echo $row2->id_venta_mov ?>).val();
      id_venta_mov=<?php echo $row2->id_venta_mov ?>;
      estatus_id=$("#estatus"+id_venta_mov).text();

      amortizacion=$("#amortizacion_txt"+<?php echo $row2->id_venta_mov ?>).val().replace(/\,/g, '').replace(/\'/g, '');
      anticipo_amort=$("#anticipo_amort_txt"+<?php echo $row2->id_venta_mov ?>).val().replace(/\,/g, '').replace(/\'/g, '');
      fecha=$("#fecha_txt"+<?php echo $row2->id_venta_mov ?>).val();
     
      deducciones=$("#deducciones").val().replace(/\,/g, '').replace(/\'/g, '');
      id_obra_cliente=<?php echo $obra->id_obra_cliente ?>;
      //alert(id_venta_mov+" "+estatus_id)
      //alert("folio_"+folio_txt+" estatus_"+estatus_id+" amortizacion_"+amortizacion+" anticipo_amort_"+anticipo_amort+" fecha_"+fecha);

        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Dasa/Guarda_estimacion",
          data:{folio_txt:folio_txt, estatus_id:estatus_id, amortizacion:amortizacion, anticipo_amort:anticipo_amort, fecha:fecha, id_venta_mov:id_venta_mov, deducciones:deducciones, id_obra_cliente:id_obra_cliente},
          success:function(result){
            if(result==1){
             // alert("entra");
            }
          }
        });
    <?php 
    }
    ?>
    alert("Datos Guardados");
    Carga_pagina();
 
   }

   function Pasa_label($id){
    //alert($id);
    elemento=$id.split('*');
    //alert(elemento[0]+" "+elemento[1]);
    valor=$("#"+elemento[0]+"_txt"+elemento[1]).val();
    //alert(valor);
    $("#"+elemento[0]+"_lbl"+elemento[1]).text(valor);
   }

   function Carga_pagina(){
     var id_obra=<?php echo $obra->id_obra_cliente ?>;
    //alert(id_obra);
    $("#page_content").load("Estimacion_tbl",{id_obra:id_obra});
   }

</script>
