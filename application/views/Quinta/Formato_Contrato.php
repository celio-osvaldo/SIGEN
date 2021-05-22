

	<p align="right">
		<label class="label-control"><b>Contrato No.  </b><?php echo $datos_evento->obra_cliente_contrato; ?></label>
	</p>

	<p class="col-md-12" align="right">
		<?php $date=date_create($detalles_evento->evento_detalle_fecha); ?>
		<?php date_default_timezone_set("America/Mexico_City"); ?>
		<?php switch (strftime('%m')) {
			case '1':
				$mes="enero";
				break;
			case '2':
				$mes="febrero";
				break;
			case '3':
				$mes="marzo";
				break;
			case '4':
				$mes="abril";
				break;
			case '5':
				$mes="mayo";
				break;
			case '6':
				$mes="junio";
				break;
			case '7':
				$mes="julio";
				break;
			case '8':
				$mes="agosto";
				break;
			case '9':
				$mes="septiembre";
				break;
			case '10':
				$mes="octubre";
				break;
			case '11':
				$mes="noviembre";
				break;
			case '12':
				$mes="diciembre";
				break;

		} ?>
		<label class="label-control">Teocaltiche, Jalisco a <?php echo strftime('%e de '); echo $mes; echo strftime(' de %G')?></label>
	</p>

		<?php switch (strftime("%m", strtotime($detalles_evento->evento_detalle_fecha))) {
			case '1':
				$mes2="Enero";
				break;
			case '2':
				$mes2="Febrero";
				break;
			case '3':
				$mes2="Marzo";
				break;
			case '4':
				$mes2="Abril";
				break;
			case '5':
				$mes2="Mayo";
				break;
			case '6':
				$mes2="Junio";
				break;
			case '7':
				$mes2="Julio";
				break;
			case '8':
				$mes2="Agosto";
				break;
			case '9':
				$mes2="Septiembre";
				break;
			case '10':
				$mes2="Octubre";
				break;
			case '11':
				$mes2="Noviembre";
				break;
			case '12':
				$mes2="Diciembre";
				break;

		} ?>
<?php switch (strftime("%m", strtotime($detalles_evento->evento_detalle_fecha_fin))) {
			case '1':
				$mes_fin="Enero";
				break;
			case '2':
				$mes_fin="Febrero";
				break;
			case '3':
				$mes_fin="Marzo";
				break;
			case '4':
				$mes_fin="Abril";
				break;
			case '5':
				$mes_fin="Mayo";
				break;
			case '6':
				$mes_fin="Junio";
				break;
			case '7':
				$mes_fin="Julio";
				break;
			case '8':
				$mes_fin="Agosto";
				break;
			case '9':
				$mes_fin="Septiembre";
				break;
			case '10':
				$mes_fin="Octubre";
				break;
			case '11':
				$mes_fin="Noviembre";
				break;
			case '12':
				$mes_fin="Diciembre";
				break;

		} ?>



<p style="text-align: justify;">
	CONTRATO DE ARRENDAMIENTO DE SALÓN PARA EVENTOS SOCIALES, QUE CELEBRAN POR UNA PARTE <b>QUINTA MONTICELLO</b> REPRESENTADA POR JIMENA CRUZ MORA A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ <b>“EL ARRENDADOR”,</b> Y POR LA OTRA (LA/EL) C. <b><?php echo $datos_evento->catalogo_cliente_empresa;?></b> A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ <b>“EL ARRENDATARIO”</b>, LA FECHA DEL EVENTO SERÁ: <b><?php echo strftime("%e de ", strtotime($detalles_evento->evento_detalle_fecha)); echo $mes2; echo strftime(' de %G ', strtotime($detalles_evento->evento_detalle_fecha)); ?></b> PARA <b><?php echo $detalles_evento->evento_detalle_personas ?></b> INVITADOS, INICIADO A LAS <b><?php echo date('H:i',strtotime($detalles_evento->evento_detalle_hora_inicio)) ?> HRS.</b> AL TENOR DE LAS SIGUIENTES DECLARACIONES Y CLAUSULAS:
</p>
<p style="text-align: center">
	<b>DECLARACIONES</b>
</p>

<p style="text-align: justify;">
<ul style="list-style: none">
<li>I.- Declara “EL ARRENDADOR”:
	<ul style="list-style: none">
<li>a)	Domicilio ubicado en Calle Constitución # 500 , Col. San Pedro.</li>
<li>b)	Para la atención de dudas, aclaraciones, reclamaciones o para proporcionar servicios de orientación, señala el teléfono 346-105-6285 y correo electrónico quintamonticello@gmail.com, con un horario de atención de 10:00 horas a 18:00 horas.</li>
</ul>
<li>II.- Declara “EL ARRENDATARIO”: 
	<ul style="list-style: none">
<li>a)	Llamarse como ha quedado plasmado en el proemio de este Contrato. </li>
<li>b)	Que es su deseo obligarse en los términos y condiciones del presente Contrato, manifestando que cuenta con la capacidad legal para la celebración de este Contrato. </li>
<li>c)	Su domicilio se encuentra ubicado en la calle <b><?php echo $datos_evento->catalogo_cliente_calle ?></b>, número <b><?php echo $datos_evento->catalogo_cliente_numero ?></b> , Col. <b><?php echo $datos_evento->catalogo_cliente_colonia ?></b>, Código Postal <b><?php echo $datos_evento->catalogo_cliente_cp?></b>, en <b><?php echo $datos_evento->catalogo_cliente_mun_estado ?></b>, el cual señala como domicilio convencional para todos los efectos legales del presente Contrato. </li>
</ul>
En virtud de las Declaraciones anteriores, “Las partes” convienen en obligarse conforme a las siguientes: 
</p>
<p style="text-align: center">
	<b>CLÁUSULAS</b>
</p>
<p style="text-align: justify;">
	PRIMERA.- “El Salón de Eventos” se dispondrá para la realización del evento de <b><?php echo $detalles_evento->evento_detalle_tipo_evento; ?></b> el día <b><?php echo strftime("%e de ", strtotime($detalles_evento->evento_detalle_fecha)); echo $mes2; echo strftime(' de %G ', strtotime($detalles_evento->evento_detalle_fecha)); ?></b> y se rentará por  <b><?php echo $detalles_evento->evento_detalle_total_horas; ?></b> horas, iniciando a las <b><?php echo  date('H:i',strtotime($detalles_evento->evento_detalle_hora_inicio)); ?></b> horas y terminará las <b><?php echo  date('H:i',strtotime($detalles_evento->evento_detalle_hora_fin)); ?></b> horas, del día <b><?php echo strftime("%e de ", strtotime($detalles_evento->evento_detalle_fecha_fin)); echo $mes_fin; echo strftime(' de %G ', strtotime($detalles_evento->evento_detalle_fecha_fin)); ?></b>. La renta del salón incluye:
	<ul style="list-style: disc;">

 	<?php 
        foreach ($detalles_mobiliario->result() as $row) {
        	if ($row->id_mobiliario=="0") {
        		?>
        		<li><?php echo $row->evento_mobiliario_cantidad." ". $row->evento_mobiliario_coment; ?></li>
        		<?php
        	}else{
    ?>
    	<li><?php echo $row->evento_mobiliario_cantidad." ". $row->prod_alm_descripcion; ?></li>
    <?php
		}
	}
	?>
	</ul>
	<br>
	SEGUNDA. “El arrendatario” se obliga a pagar por concepto de renta del Salón es de <b>$<?php echo number_format($datos_evento->obra_cliente_imp_total,2,'.',',');?> <?php echo $detalles_evento->evento_detalle_monto_txt ;?></b> Se compromete a pagar de la siguiente manera: <b>$<?php echo number_format($detalles_evento->evento_detalle_anticipo,2,'.',',') ?>  <?php echo $detalles_evento->evento_detalle_anticipo_txt ;?> para apartar la fecha (no reembolsables),</b> quedando pendiente la cantidad de <b>$<?php echo number_format($detalles_evento->evento_detalle_resto,2,'.',',') ?> <?php echo $detalles_evento->evento_detalle_resto_txt ;?></b> de el resto para sea cubierto a más tardar <b>15 DÍAS ANTES DEL EVENTO.</b>
<br><br>
TERCERA.- QUINTA MONTICELLO, no se hace responsable por desastres naturales y excluye a ésta última de cualquier responsabilidad por accidentes ocurridos durante el evento en el inmueble arrendado.
<br><br>
CUARTA.- “El arrendatario” se obliga al buen uso del inmueble y a la conservación y devolución de las instalaciones, muebles y equipos en el mismo estado en el que le fueron entregados.
<br><br>
QUINTA.- “El arrendador” a la firma del presente Contrato entrega a “El arrendatario” copia del Reglamento del inmueble, el cual forma parte del presente Contrato, por lo que “El arrendatario” se obliga a cumplir con las disposiciones reglamentarias que rigen el inmueble y a <b>procurar</b> que los asistentes al evento observen la misma conducta. 
<br><br>
SEXTA.- Si por alguna causa imputable “El arrendatario” suspendiera el evento el anticipo se devolverá de la siguiente forma: 6 meses antes 100%, 3 meses antes 50%. En ambos casos se excluye el dinero de apartado del lugar, este no es reembolsable.
<br><br>
SEPTIMA.- En caso de que “El arrendador” se encuentre imposibilitado para otorgar en arrendamiento el Salón por caso fortuito o fuerza mayor, como incendio, temblor u otros acontecimientos de la naturaleza o hechos del hombre ajenos a la voluntad de “El arrendador”, no se considerara como causa de incumplimiento, pero “El arrendador” deberá de reintegrar a “El arrendatario” las cantidades que le hubiera entregado.
<br><br> 
OCTAVA.- En caso de que el Salón sufriere un menoscabo por culpa o negligencia debidamente comprobada de “El arrendatario” o de sus invitados, este se obliga a cubrir los gastos de reparación del mismo dentro de los 10 (diez) días naturales siguientes, el costo de la reparación dependerá del estado actual y desgaste habitual en que se encontraba el Salón para el uso objeto del presente Contrato, así como del valor del bien dañado que sea fehacientemente comprobable por parte del “El arrendador”. 
<br><br>
Leído que fue por las partes el contenido del presente Contrato y sabedoras de su alcance legal, lo firman por duplicado en la Ciudad de TEOCALTICHE, JALISCO  a los <?php echo strftime('%e días del mes de '); echo $mes; echo strftime(' del año %G')?>. 
</p>
<br><br>
<table class="tb2" style="width: 100%; text-align: center">
	<tr>
		<td>
			
		</td>
		<td>
			
		</td>
	</tr>
	<tr>
		<td>
			<hr style="width: 65%; color: black">
			<label>JIMENA CRUZ MORA</label>
		</td>
		<td>
			<hr style="width: 65%; color: black">
			<label><?php echo $datos_evento->catalogo_cliente_empresa;?></label>
		</td>
	</tr>
	<tr>
		<td>
			<label>EL ARRENDADOR</label>
		</td>
		<td>
			<label>EL ARRENDATARIO</label>
		</td>
	</tr>
</table>

</p>





