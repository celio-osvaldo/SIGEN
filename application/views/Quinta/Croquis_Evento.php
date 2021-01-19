<link href="../assets/Personalized/css/PDFStyles_Contrato_QM.css" rel="stylesheet">

<p style="text-align: center; font-size: 14">
	<b>CROQUIS DE ACOMODO DE MOBILIARIO PARA EVENTO</b>
</p>

<table class="tb_croquis" style="margin: 0 auto;">
		<tr >
			<td class="td_pasto_final"  colspan="8" bgcolor="green" align="center" >
				<img style="width: 1cm; height: 0.7cm" src="Resources\Logos\logo_qm.png">
			</td>
		</tr>
		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm; border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pasto1"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto1") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto2"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto2") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>

			</td>
			<td id="pasto3"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto3") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
						if ($row->croquis_acomodo_obj=="mesa_inv") {
						?>
						<img id="mesa_princi" src="Resources\Icons\mesa1.png" width="30px" height="30px">
						<?php
						}else{
							?>
						<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
						<?php
						}					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto4"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto4") {
						switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto5"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto5") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto6"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto6") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto7"  class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-right-style: solid; border-right-color: black" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto7") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm; border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pasto8"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto8") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto9"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto9") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto10"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto10") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto11"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto11") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto12"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto12") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto13"  class="td_mesa_pasto_final" bgcolor="#A9D18E" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto13") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pasto14"  class="td_mesa_pasto_final" bgcolor="#A9D18E" style="border-right-style: solid; border-right-color: black" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pasto14") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
		</tr>


		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista1"  class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black">
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista1") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista2"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista2") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista3"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista3") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista4"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista4") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista5"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista5") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista6"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista6") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista7"  class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black;"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista7") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista8"  class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black">
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista8") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista9"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista9") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista10"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista10") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista11"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista11") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista12"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista12") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista13"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista13") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista14"  class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black;"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista14") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista15"  class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista15") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista16"  class="td_mesa_pista_baile" style="border: dotted; border-width: 1px; border-color: #AFABAB" bgcolor=" #FFF2CC"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista16") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
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
			<td id="pista17"  class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista17") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista18"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista18") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista19"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista19") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td class="td_entrada" bgcolor="white">

			</td>
			<td id="pista20"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista20") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista21"  class="td_mesa_pista_1"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista21") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista22"  class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista22") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
		</tr>

		<tr>
			<td class="td_mesa_pasto_final" style="width: 0.89cm;border-left-style: solid; border-left-color: black; border-bottom-style: solid; border-bottom-color: black" bgcolor="#A9D18E" >

			</td>
			<td id="pista23"  class="td_mesa_pista_1" style="border-left-style: solid;border-left-color: black; border-bottom-style: solid; border-bottom-color: black"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista23") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista24"  class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista24") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista25"  class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista25") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td colspan="2" class="td_entrada" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black" bgcolor="white" >

			</td>

			<td id="pista26"  class="td_mesa_pista_1" style=" border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista26") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td id="pista27"  class="td_mesa_pista_1" style="border-right-style: solid; border-right-color: black; border-bottom-style: solid; border-bottom-style: solid; border-bottom-color: black"  >
				<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="pista27") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
		</tr>
	</table>

	<table class="tb_croquis" style="margin: 0 auto;">
		<tr>
			<td colspan="4" class="" style="border: none"></td>


			<td  id="entrada1" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_recepcion" style=" color: white" bgcolor="#AFABAB" >
								<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="entrada1") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td  id="entrada2" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_recepcion" style=" color: white" bgcolor="#AFABAB">
								<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="entrada2") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td class="" style="" >
			</td>
		</tr>

		<tr>
			<td colspan="4" class="" style="border: none"></td>


			<td  id="entrada3" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_recepcion" style=" color: white" bgcolor="#AFABAB" >
								<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="entrada3") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td  id="entrada4" ondrop="Clona(this.id)" ondragover="Lugar(this.id)" class="td_recepcion" style="color: white" bgcolor="#AFABAB">
								<?php foreach ($croquis_acomodo->result() as $row) {
					if ($row->croquis_acomodo_pos=="entrada4") {
							switch ($row->croquis_acomodo_obj) {
							case 'mesa_princi':
								?>
								<img id="mesa_princi" src="Resources\Icons\mesa2.png" width="30px" height="30px">
								<?php
								break;
							case 'mesa_inv':
								?>
								<img id="mesa_inv" src="Resources\Icons\mesa1.png" width="30px" height="30px">
								<?php
							break;
							case 'mesa_regalo':
								?>
								<img id="mesa_regalo" src="Resources\Icons\regalos.png" width="30px" height="30px">
								<?php
							break;
							case 'modulo_sanit':
								?>
								<img id="modulo_sanit" src="Resources\Icons\cabina.png" width="30px" height="30px">
								<?php
							break;
							case 'esc_fotos':
								?>
								<img id="esc_fotos" src="Resources\Icons\fotos.png" width="30px" height="30px">
								<?php
							break;
						}
					}
					?>
					<?php
				} ?>
			</td>
			<td class="" style=" " >
			</td>
		</tr>

		<tr>
			<td colspan="4" class="" style="border: none"></td>
			<td>ENTRADA PRINCIPAL</td>
		</tr>


	</table>
