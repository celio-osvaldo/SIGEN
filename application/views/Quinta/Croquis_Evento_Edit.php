<link href="../assets/Personalized/css/PDFStyles_Contrato_QM.css" rel="stylesheet">

<div class="row">
	<div class="col-md-12" align="center">
		<label>CROQUIS DE ACOMODO DE MOBILIARIO PARA EVENTO</label>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<select class="form-control" type="text" name="new_giro" id="new_giro" required="true">
          <option selected>Seleccionar Mobiliario</option>
           <?php foreach ($detalles_mobiliario->result() as $row){ ?>
            <option value="<?php echo "".$row->id_mobiliarioq.""; ?>"><?php echo "".$row->prod_alm_nom.""; ?></option>
          <?php } ?>
        </select>
	</div>
	<div class="col-md-8">
		<table class="tb_croquis" style="margin: 0 auto;">
	<tr >
		<td class="td_pasto_final"  colspan="8" bgcolor="green" align="center" >
			<img style="width: 1cm; height: 0.7cm" src="..\Resources\Logos\logo_qm.png">
		</td>
	</tr>
	<tr>
		<td class="td_mesa_pasto_final" style="width: 0.89cm; border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" >

		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-right-style: solid; border-right-color: black" >
			
		</td>
	</tr>

	<tr>
		<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-right-style: solid; border-right-color: black; border-bottom-style: solid; border-bottom-color: black">
			
		</td>
	</tr>


	<tr>
		<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black;"  >
			
		</td>
	</tr>

	<tr>
		<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black"  >
			
		</td>
	</tr>

	<tr>
		<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >
			
		</td>
		<td class="td_mesa_pista_baile" style="border: dotted; border-width: 1px; border-color: #AFABAB" bgcolor=" #FFF2CC"  >
			
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
		<td class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_entrada" bgcolor="white">
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1"  >
			
		</td>
		<td class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black"  >
			
		</td>
	</tr>

	<tr>
		<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black; border-bottom-style: solid; border-bottom-color: black" bgcolor="#A9D18E" >
			
		</td>
		<td class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black; border-bottom-style: solid; border-bottom-color: black"  >
			
		</td>
		<td class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" >
			
		</td>
		<td colspan="2" class="td_entrada" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" bgcolor="white" >
			
		</td>

		<td class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black"  >
			
		</td>
		<td class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black; border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black"  >
			
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



