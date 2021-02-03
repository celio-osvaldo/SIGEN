<!--Mostrar Reporte de Flujo de Efectivo por Proyecto-->

<div class="row">
  <div class="col-9">
    <h3 align="center">Reporte de Flujo de Efectivo por Proyecto</h3>
  </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <select class="form-control" type="text" name="id_obra_cliente" id="id_obra_cliente" required="true">
                <option selected="true"  value="selecciona">-----Seleccione Proyecto-----</option>
            <?php foreach ($proyectos->result() as $row){ ?>
                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
            <?php } ?>
            </select>
        </div>
            <button type="button" class="btn btn-info" id="btn_genera" onclick="Genera_Reporte_proyecto()">Generar Reporte</button>

    </div>
</div>
<hr>
<div class="card bg-card">
        <div class="table-responsive" id="table_div" >

 

    <script type="text/javascript">
    	

 	function Genera_Reporte_proyecto(){
 		id_obra_cliente=$("#id_obra_cliente").val();
        //alert(id_obra_cliente);
        if(id_obra_cliente!="selecciona"){
            var datos_a_pasar = {
                id_obra_cliente:id_obra_cliente
                }
    		$("#table_div").load("Reporte_flujo_efectivo_proyecto",datos_a_pasar);
        }else{
            alert("Seleccione un Proyecto");
        }
    	}
    </script>
