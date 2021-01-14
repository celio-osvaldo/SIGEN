<link href="../assets/Personalized/css/PDFStyles_Contrato_QM.css" rel="stylesheet">

<!--
<div>
	<a class="btn btn-outline-secondary" onclick="Croquis(this.id)" role="button" id="<?php echo $datos_evento->id_obra_cliente; ?>">Actualizar</a>
</div>
-->
<script type="text/javascript">
	function Croquis($id){
		id_evento=$id;
		$("#page_content").load("Croquis",{id_evento:id_evento});
	}
</script>


<div class="row">
	<div class="col-md-12" align="center">
		<label><b>CROQUIS DE ACOMODO DE MOBILIARIO PARA EVENTO</b></label>
	</div>
</div>

<div class="row">
	<div class="col-md-2" align="right" style="margin: auto">
		<div class="row">
			<div class="col-md-12">
				<label class="label-control">Mesa Invitados</label>
				<a class="btn btn-outline-secondary"><img id="mesa_inv" draggable="true" ondragstart="Selecciona(this.id)" src="..\Resources\Icons\mesa1.ico" width="30px" height="30px"><br></a>
				<label class="label-control">Mesa Principal</label>
				<a class="btn btn-outline-secondary"><img draggable="true" id="mesa_princi" src="..\Resources\Icons\mesa2.ico" ondragstart="Selecciona(this.id)" width="30px" height="30px"></a>
			</div>
		</div>
		<div class="row" style="text-align: left; ;background-color: #; width: 100%;  border: 3px solid #FF5959">
			<div class="col-md-12" id="zona_elimina" ondrop="Elimina(this.id)" ondragenter="Lugar(this.id)">
				<img draggable="false" src="..\Resources\Icons\delete.ico">
				<label class="label-control">Ingresa mobiliario para Eliminar</label>
			</div>

		</div>
	</div>

	<script type="text/javascript">
		id_objeto="";
		id_lugar="";
		function Selecciona($id_objeto){

			id_objeto=document.querySelector('#'+$id_objeto);
			objeto_id=$id_objeto;
		}
	/*
		id_objeto.addEventListener('dragstart', e=>{
		console.log('Drag Start');
	});

		id_objeto.addEventListener('dragend', e=>{
		console.log('Drag End');
	});

		id_objeto.addEventListener('drag', e=>{
		console.log('Drag');
	});


	//const mesa10 =document.querySelector('#mesa10');

	*/

	/*
	const pasto1 =document.querySelector('#pasto_1');

	pasto1.addEventListener('dragenter', e=>{
		console.log('Drag Enter');
	});


	pasto1.addEventListener('dragleave', e=>{
		console.log('Drag Leave');
	});


	pasto1.addEventListener('dragover', e=>{
		e.preventDefault();
		console.log('Drag Over');
	});

	*/
	function Lugar($id_lugar){
		id_lugar =document.querySelector('#'+$id_lugar);
		id_lugar.addEventListener('dragover', e=>{
			e.preventDefault();
		//console.log('Drag Over'+$id_lugar);
	});

	}
	function Clona($id_lugar){
		//id_lugar.appendChild(id_objeto.cloneNode(true));
		var x = id_objeto.cloneNode(false);
		x.setAttribute("id", "objeto_"+$id_lugar);
		x.setAttribute("ondragleave", "Selecciona(this.id)");
		id_lugar.appendChild(x);

		lugar=$id_lugar;
		id_evento=<?php echo $datos_evento->id_obra_cliente; ?>;
		//alert("id_lugar: "+$id_lugar+" id_objeto: "+objeto_id+" id_evento "+id_evento);
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/Add_Obj_Croquis",
          data:{lugar:lugar, objeto_id:objeto_id, id_evento:id_evento},
          success:function(result){
            //alert(result);
            if(result){
              alert('Objeto Agregado');
            }else{
              alert('Falló el servidor. Objeto no Agregado');
            }
          }
        });
	}

	function Elimina($id_lugar2){
		id_objeto=objeto_id.split("_");
		if(id_objeto[0]=="objeto"){
			$('#'+objeto_id).remove();

			
		}
		//document.getElementById(id_objeto).removeAttribute('src');

	}


</script>


<div class="col-md-8">
	<table class="tb_croquis" style="margin: 0 auto;">
		<tr >
			<td class="td_pasto_final"  colspan="8" bgcolor="green" align="center" >
				<img draggable="false" style="width: 1cm; height: 0.7cm" src="..\Resources\Logos\logo_qm.png">
			</td>
		</tr>
		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm; border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_1" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_2" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_3" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_4" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_5" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_6" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_7" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-right-style: solid; border-right-color: black" >
			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm; border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_8" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_9" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_10" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_11" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_12" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_13" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" >

			</td>
			<td id="pasto_14" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-right-style: solid; border-right-color: black" >
			</td>
		</tr>


		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista1" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black">
			</td>
			<td id="pista2" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista3" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista4" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista5" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista6" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista7" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black;"  >

			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista8" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black">
			</td>
			<td id="pista9" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista10" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista11" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista12" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista13" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista14" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black;"  >

			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista15" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >

			</td>
			<td id="pista16" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_baile" style="border: dotted; border-width: 1px; border-color: #AFABAB" bgcolor=" #FFF2CC"  >

			</td>

			<td class="td_mesa_pista_baile" bgcolor="white" colspan="4"  >
				PISTA DE BAILE
			</td>
			<td class="td_mesa_pista_baile"  style="border-right: solid; border-width: 1px; color: white" bgcolor="gray" >
				ESPACIO DE MÚSICA
			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista17" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >

			</td>
			<td id="pista18" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista19" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td class="td_entrada" bgcolor="white">

			</td>
			<td id="pista20" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista21" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1"  >

			</td>
			<td id="pista22" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black"  >

			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black; border-bottom-style: solid; border-bottom-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista23" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black; border-bottom-style: solid; border-bottom-color: black"  >

			</td>
			<td id="pista24" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" >

			</td>
			<td id="pista25" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" >

			</td>
			<td colspan="2" class="td_entrada" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" bgcolor="white" >

			</td>

			<td id="pista26" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black"  >

			</td>
			<td id="pista27" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black; border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black"  >

			</td>
		</tr>
	</table>

	<table class="tb_croquis" style="margin: 0 auto;">
		<tr>
			<td colspan="4" class="" style="border: none"></td>
			
		</td>
		<td class="td_recepcion" style=" border-color: black;color: white" bgcolor="#AFABAB" >
			ENTRADA PRINCIPAL
		</td>
		<td class="" style=" border-bottom-style: solid" >
			
		</td>

	</tr>
</table>
</div>
</div>



