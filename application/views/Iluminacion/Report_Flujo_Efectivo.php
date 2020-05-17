<!--Mostrar Reporte de Flujo de Efectivo -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Reporte de Flujo de Efectivo</h3>
  </div>
</div>

<div class="container">
	<label>Seleccionar Año y Mes (AAAA-MM)</label>
	<input type="month" id="mes_reporte">
	<button type="button" class="btn btn-info" id="btn_genera" onclick="Genera_Reporte()">Generar Reporte</button>
</div>
<hr>
<div class="card bg-card">
        <div class="table-responsive" id="table_div" >

 

    <script type="text/javascript">
    	

 	function Genera_Reporte(){
 		fecha=$('#mes_reporte').val();
 		fecha_reporte=fecha.split('-');//posición 0 del arreglo=año, posición 1 del arrelgo=mes
 		if(fecha!=""&&fecha_reporte[0]>2019&&fecha_reporte[1]>0&&fecha_reporte[1]<=12){
    		anio=fecha_reporte[0];
    		mes=fecha_reporte[1];
    		var datos_a_pasar = {
    			anio : anio, 
    			mes : mes
    			}
    		$("#table_div").load("Reporte_flujo_efectivo",datos_a_pasar);

 		}else{
 			alert("Error! Fecha Incorrecta\nDebe indicar el año y mes para generar el reporte\nFormato (AAAA-MM)");
 			document.getElementById("mes_reporte").focus();
 			$("#table_div").empty();
 		}
    	}
    </script>
