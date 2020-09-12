<!--Mostrar Reporte de Flujo de Efectivo -->

<div class="row justify-content-md-center">
  <div class="col-md-5" style="align-content: center">
    <h3 align="center">Reporte de Flujo de Efectivo</h3>
  </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-md-3">
    	<label class="label-control">Seleccionar Año y Mes (AAAA-MM)</label>
    	<input class="form-control" type="month" id="mes_reporte">
    </div>
    <div class="col-md-3">
        <label class="label-control">Selecciona la Empresa</label>
        <select class="form-control" type="text" name="empresa" id="empresa" required="true">
            <option selected="true"  value="selecciona">-----Seleccione Empresa-----</option>
            <?php foreach ($companies->result() as $row){ ?>
            <option value="<?php echo "".$row->id_empresa.""; ?>"><?php echo "".$row->empresa_nom.""; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-md-3">
        <label class="label-control"></label>
	   <button type="button" class="btn btn-info btn-lg form-control" id="btn_genera" onclick="Genera_Reporte()">Generar Reporte</button>
    </div>
</div>
<hr>
<div class="card bg-card">
        <div class="table-responsive" id="table_div" >

 

    <script type="text/javascript">
        function MaysPrimera(string){
          return string.charAt(0).toUpperCase() + string.slice(1);
      }

 	function Genera_Reporte(){
 		fecha=$('#mes_reporte').val();
 		fecha_reporte=fecha.split('-');//posición 0 del arreglo=año, posición 1 del arrelgo=mes
 		if(fecha!=""&&fecha_reporte[0]>2000&&fecha_reporte[1]>0&&fecha_reporte[1]<=12){
            empresa=$('#empresa').val();
            if (empresa!="selecciona") {
                anio=fecha_reporte[0];
                mes=fecha_reporte[1];
                empresa=empresa
                var datos_a_pasar = {
                    anio : anio, 
                    mes : mes
                    }
                    nom_empresa=$('select[name="empresa"] option:selected').text();

                    nom_empresa = MaysPrimera(nom_empresa.toLowerCase());


                $("#table_div").load("../"+nom_empresa+"/Reporte_flujo_efectivo",datos_a_pasar);
            }else{
                alert("Error! Debe seleccionar una Empresa");
                document.getElementById("empresa").focus();
                $("#table_div").empty();
            }


 		}else{
 			alert("Error! Fecha Incorrecta\nDebe indicar el año y mes para generar el reporte\nFormato (AAAA-MM)");
 			document.getElementById("mes_reporte").focus();
 			$("#table_div").empty();
 		}
    	}
    </script>
