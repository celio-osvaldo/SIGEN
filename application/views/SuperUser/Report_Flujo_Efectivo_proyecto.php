<!--Mostrar Reporte de Flujo de Efectivo -->

<div class="row justify-content-md-center">
  <div class="col-md-5" style="align-content: center">
    <h3 align="center">Reporte de Flujo de Efectivo por Proyecto</h3>
  </div>
</div>

<div class="row justify-content-md-center">
    <div class="col-md-3">
        <label class="label-control">Selecciona la Empresa</label>
        <select class="form-control" onchange="Selecciona_Proyecto()" type="text" name="empresa" id="empresa" required="true">
            <option selected="true"  value="selecciona">-----Seleccione Empresa-----</option>
            <?php foreach ($companies->result() as $row){ ?>
            <option value="<?php echo "".$row->id_empresa.""; ?>"><?php echo "".$row->empresa_nom.""; ?></option>
            <?php } ?>
        </select>
    </div>

<div class="col-md-2" id="radio_proy_sfv" hidden="true">
    <div class="radio">
          <label><input onclick="Ver_Catalogo_2(this.id)"  type="radio" name="proy_sfv" id="proy_sfv" value="sfv">SFV</label><br>
    </div>
    <div class="radio">
          <label><input onclick="Ver_Catalogo_2(this.id)"  type="radio" name="proy_sfv" id="proy_sfv" value="proy">Proyectos</label>
    </div>
</div>


<script type="text/javascript">
    function Ver_Catalogo_2($id_btn){
        var id=$id_btn;
        //alert($('input:radio[name='+id+']:checked').val());
        if($('input:radio[name='+id+']:checked').val()=="sfv"){
            $("#sfv_ilumina").removeAttr("hidden");
            $("#proy_ilumina").attr('hidden','true');
        }else{
            $("#proy_ilumina").removeAttr("hidden");
            $("#sfv_ilumina").attr('hidden','true');
        }
    }
</script>



    <div class="col-md-5">
        <label class="label-control">Seleccione el Proyecto</label>
        <select hidden="true" class="form-control" type="text" name="proy_dasa" id="proy_dasa" required="true">
            <option selected="true"  value="selecciona_proy">-----Seleccione Proyecto DASA-----</option>
            <?php foreach ($proyectos_dasa->result() as $row){ ?>
                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
            <?php } ?>
        </select>

        <select hidden="true" class="form-control" type="text" name="proy_salinas" id="proy_salinas" required="true">
            <option selected="true"  value="selecciona_proy">-----Seleccione Proyecto Salinas-----</option>
            <?php foreach ($proyectos_salinas->result() as $row){ ?>
                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
            <?php } ?>
        </select>

        <select hidden="true" class="form-control" type="text" name="proy_ilumina" id="proy_ilumina" required="true">
            <option selected="true"  value="selecciona_proy">-----Seleccione Proyecto Iluminación-----</option>
            <?php foreach ($proyectos_ilumina->result() as $row){ ?>
                <option value="<?php echo "".$row->id_obra_cliente.""; ?>"><?php echo "".$row->obra_cliente_nombre.""; ?></option>
            <?php } ?>
        </select>

        <select hidden="true" class="form-control" type="text" name="sfv_ilumina" id="sfv_ilumina" required="true">
            <option selected="true"  value="selecciona_proy">-----Seleccione SFV Iluminación-----</option>
            <?php foreach ($sfv_ilumina->result() as $row){ ?>
                <option value="<?php echo "".$row->id_pago_sfv.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
            <?php } ?>
        </select>

    </div>
    <div class="col-md-2">
        <label class="label-control"></label>
	   <button type="button" class="btn btn-info btn-lg form-control" id="btn_genera" onclick="Genera_Reporte()">Generar Reporte</button>
    </div>
</div>
<hr>
<div class="card bg-card">
        <div class="table-responsive" id="table_div" >

 

    <script type="text/javascript">

        function Selecciona_Proyecto(){
            empresa=$('#empresa').val();
            if (empresa==1) {//Se activa las lista de la empresa Iluminacion
                //$("#proy_ilumina").removeAttr('hidden');
                $("#radio_proy_sfv").removeAttr('hidden');
                $("#proy_dasa").attr('hidden','true');
                $("#proy_salinas").attr('hidden','true');
            }

            if (empresa==2) {//Se activa las lista de la empresa DASA
                $("#proy_dasa").removeAttr('hidden');
                $("#proy_ilumina").attr('hidden','true');
                $("#radio_proy_sfv").attr('hidden','true');
                $("#proy_salinas").attr('hidden','true');
            }

            if (empresa==3) {//Se activa las lista de la empresa Salinas
                $("#proy_salinas").removeAttr('hidden');
                $("#proy_dasa").attr('hidden','true');
                $("#proy_ilumina").attr('hidden','true');
                $("#radio_proy_sfv").attr('hidden','true');
            }

            if (empresa=="selecciona") {//Se activa las lista de la empresa Salinas
                $("#proy_salinas").attr('hidden','true');
                $("#proy_dasa").attr('hidden','true');
                $("#proy_ilumina").attr('hidden','true');
                $("#radio_proy_sfv").attr('hidden','true');
            }
        }

 	function Genera_Reporte(){
 		empresa=$('#empresa').val();
 		if(empresa!="selecciona"){
            id_proyecto="selecciona";
            if(empresa==1){
                id_proyecto="selecciona";
                proy_sfv=$('input:radio[name=proy_sfv]:checked').val()
                if(proy_sfv=="sfv"){
                    id_proyecto=$("#sfv_ilumina").val()
                }else{
                    id_proyecto=$("#proy_ilumina").val()
                }
            }
            if(empresa==2){
                id_proyecto=$("#proy_dasa").val()
            }
            if(empresa==3){
                id_proyecto=$("#proy_salinas").val()
            }
            //alert(id_proyecto);
            if (id_proyecto!="selecciona_proy") {
                empresa=empresa
                var datos_a_pasar = {
                    id_obra_cliente : id_proyecto, 
                    empresa : empresa
                    }
                    nom_empresa=$('select[name="empresa"] option:selected').text();
                    if (nom_empresa!="ILUMINACION") {
                        $("#table_div").load("../"+nom_empresa+"/Reporte_flujo_efectivo_proyecto",datos_a_pasar); 
                    }else{
                        alert("Reporte en Construcción");
                    }
                
            }else{
                alert("Seleccione un Proyecto");
                $("#table_div").empty();
            }


 		}else{
 			alert("Seleccione una Empresa");
 			document.getElementById("empresa").focus();
 			$("#table_div").empty();
 		}
    	}
    </script>
