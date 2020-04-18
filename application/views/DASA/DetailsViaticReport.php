<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<h3>Detalles de viático</h3>
	</div>
	<div class="col-md-1"></div>
</div>

<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="card bg-card">
				<div class="margins">
					<div class="table-responsive-lg">
						<table  class="table table-hover" style="font-size: 10pt;">
		                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
		                        <tr>
		                            <th>Fecha de reporte</th>
		                            <th>Proyecto/Motivo</th>
		                            <th>Total de días</th>
		                            <th>Fecha inicio</th>
		                            <th>Fecha fin</th>
		                            <th></th>
		                            <th>Total Gasto</th>
		                        </tr>
		                    </thead>
		                    <tbody>
		                        <tr><?php foreach ($viatico->result() as $row) {?>
		                            <td><?php echo $row->viaticos_fecha; ?></td>
		                            <td><?php echo $row->obra_cliente_nombre; ?></td>
		                            <td><?php echo $row->viaticos_total_días; ?></td>
		                            <td><?php echo $row->viaticos_fecha_ini; ?></td>
		                            <td><?php echo $row->viaticos_fecha_fin; ?></td>
		                            <td>$</td>
		                            <td><?php echo $row->viaticos_total; ?></td>
		                        </tr><?php } ?>
		                    </tbody>
                		</table>
					</div>
				</div>
		</div>
	</div>
	<div class="col-md-1"></div>
</div>
		<br>
		<div class="row">
			<div class="col-md-1"></div>
			<div class="col-md-7">
				<h3>Desglose de gastos</h3>
			</div>
			<div class="col-md-3">
				<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newExpend"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Agregar Gasto</button>
			</div>
			<div class="col-md-1"></div>
			<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="card bg-card">
						<div class="margins">
							<table id="table_id" class="table table-hover display" style="font-size: 10pt;">
			                    <thead class="bg-primary" style="color: #FFFFFF;" align="center">
			                        <tr>
			                            <th>Empleado</th>
			                            <th>Fecha</th>
			                            <th>Concepto</th>
			                            <th></th>
			                            <th class="dato">Importe</th>
			                            <th>Tipo de comprobante</th>
			                            <th>Evidencia</th>
			                        </tr>
			                    </thead>
			                    <tfoot>
							        <tr>
							            <td colspan=4>Total</td>
							            <td></td>
							        </tr>
							    </tfoot>
			                    <tbody>
			                        <tr><?php foreach ($detail->result() as $row) {?>
			                            <td><?php echo $row->viaticos_empleado; ?></td>
			                            <td><?php echo $row->lista_viatico_fecha; ?></td>
			                            <td><?php echo $row->lista_viatico_concepto; ?></td>
			                            <td>$</td>
			                            <td><?php echo $row->lista_viatico_importe; ?></td>
			                            <td><?php echo $row->lista_viatico_comprobante; ?></td>
			                            <td align="center"><a role="button" class="btn btn-outline-dark" id="<?php echo "".$row->id_lista_viatico.""; ?>" data-toggle="modal" data-target="#showBill"><img src="..\Resources\Icons\invoice_icon_128337.ico" alt="Editar" style="filter: invert(100%)"></a></td>
			                        </tr><?php } ?>
			                    </tbody>
                			</table>
						</div>
					</div>
				</div>
			<div class="col-md-1"></div>
		</div>


<script type="text/javascript">
    $(document).ready( function () {
        $('#table_id').DataTable();
        var suma = 0;
		$('#table_id tr.dato').each(function(){ //filas con clase 'dato', especifica una clase, asi no tomas el nombre de las columnas
		 suma += doubleval($(this).find('td').eq(4).text()||0,10) //numero de la celda 3
		})
		alert(suma)
    } );
</script>


<!-- new report of viatics modal -->
<div class="modal fade" id="newExpend"data-backdrop="static" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo reporte de viaticos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form class="form-group" id="addReport">

        	<div class="modal-body">
                <div class="row">
                	<div class="col-md-9">
                		<input type="hidden" name="addexpendId" id="addexpendId">
                		<?php foreach ($max->result() as $row){ ?>
                                <input class="form-control" type="hidden" name="maxid" id="maxid" value="<?php echo "".($row->id_lista_viatico + 1).""; ?>" required="true">
                            <?php } ?>
                            <?php foreach ($viatico->result() as $row) {?>
                            <input type="hidden" id="idViatic" name="idViatic" value="<?php echo $row->id_viaticos; ?>">
                        	<?php } ?>
                	</div>
                	<div class="col-md-3">
                		<input class="form-control" id="addDate" name="addDate" type="date" onchange="DateObtain(this)" value="<?php date_default_timezone_set('UTC'); echo date("Y-m-d"); ?>"></input>
                	</div>
                	<div class="col-md-12">
                		<label>Nombre del empleado</label>
                		<input class="form-control" id="employ" name="employ" type="text" required="true"></input>
                	</div>
                	<div class="col-md-6">
                		<label>Concepto de gasto</label>
                		<input type="text" class="form-control" name="addconcept" id="addconcept" required="true" required="true">
                	</div>
                	<div class="col-md-6">
                		<label>Importe</label>
                		<input type="number" name="addImport" id="addImport" min="0" class="form-control" required="true">
                	</div>
                	<div class="col-md-6">
                		<label>Tipo de Comprobante</label>
                		<select class="form-control" id="addTypeVoucher" name="addTypeVoucher" required="true">
                			<option selected="Seleccionar"></option>
                			<option value="Cheque">Cheque</option>
                			<option value="Factura">Factura</option>
                			<option value="Recibo">Recibo</option>
                			<option value="Ticket">Ticket</option>
                		</select>
                	</div>
                	<div class="col-md-6">
                		<label>Evidencia</label>
                		<input type="file" class="form-control" id="addEvidence" name="addEvidence" required="true" accept="application/pdf">
                	</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success submitBtn" id="saveExpend">Guardar</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal" id="cancel">Cancelar</button>
            </div>

        </form>

    </div>
  </div>
</div>
<!-- end modal -->

<!-- script by add new report in petty cash -->
<script>
$(document).ready(function(e){
    $("#addReport").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>Dasa/AddViaticExpend',
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#addReport').css("opacity",".5");
            },
            success: function(data){
                if(data == 1){
                    $('#addReport')[0].reset();
                    // $('.statusMsg').html('<span style="font-size:18px;color:#34A853">Form data submitted successfully.</span>');
                    alert('Información del costo de venta actualizada');
                    CloseModal();
                }else{
                  alert('Falló el servidor. Verifique que la información sea correcta');
                }
                $('#addReport').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
        });
    });
    
    //file type validation
    $("#addEvidence").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        if(!(imagefile)){
            alert('Please select a valid file (PDF).');
            $("#addEvidence").val('');
            return false;
        }else{
          //alert('imagen subida');
        }
    });
});

function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("GetAllViatics");
  }
</script>