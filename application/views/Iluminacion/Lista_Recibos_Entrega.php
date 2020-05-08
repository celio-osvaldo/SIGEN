
<!--Mostrar lista de Recibos de Entrega -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Recibos de Entrega</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewReciboModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Recibo de Entrega</button>
  </div>
</div>

<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_recibo" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Folio</th>
          <th>Fecha</th>
          <th>Empresa</th>
          <th>Id_empresa</th>
          <th>Editar</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($recibo_entrega->result() as $row) {
         ?>
         <tr>
          <td id="<?php echo "folio".$row->id_recibo_entrega;?>"><?php echo "".$row->recibo_entrega_folio.""; ?></td>
          <td id="<?php echo "fecha".$row->id_recibo_entrega;?>" hidden="true"><?php echo "".$row->recibo_entrega_fecha.""; ?></td>
          <td id="<?php echo "empresa".$row->id_recibo_entrega;?>">$<?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
          <td id="<?php echo "id_empresa".$row->id_recibo_entrega;?>">$<?php echo "".$row->recibo_entrega_id_cliente.""; ?></td>
          <td>
            <a class="navbar-brand" href="#" onclick="EditAnticipo(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>">
              <button class="btn btn-outline-secondary " title="Editar Registro"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
              </button>
            </a>
            <a class="navbar-brand" href="#" onclick="EditAnticipo(this.id)" role="button" id="<?php echo $row->id_anticipo; ?>">
              <button class="btn btn-outline-secondary " title="Editar Registro"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
              </button>
            </a>
          </td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
</div>
</div>


<!-- Modal New Recibo -->
<div class="modal fade" id="NewReciboModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo Recibo de Entrega</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
            <div class="form-group col-md-4">
              <b><label>Folio</label></b>
              <input type="text" id="new_folio"  class="form-control">
            </div>
            <div class="form-group col-md-6">
              <b><label>Fecha de Entrega</label></b>
              <input type="date" id="new_fecha_entrega" class="form-control">
            </div>
          </div>
          <b><label>Origen de la entrega</label></b><br>
            <input type="radio" name="radio" checked="true" id="radio_nuevo" value="nuevo"><label>Sin Origen</label><br>
            <input type="radio" name="radio" id="radio_anticipo" value="anticipo"><label>Anticipo</label><br>
            <input type="radio" name="radio" id="radio_cotizacion" value="cotizacion"><label>Cotización</label><br>
          <div id="cat_cliente">
            <b><label>Cliente</label></b>
            <select class="form-control" name="new_cliente" id="new_cliente">
              <option disabled selected>----Seleccionar Cliente----</option>
              <?php foreach ($catalogo_cliente->result() as $row){ ?>
              <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="cat_anticipo" hidden="true">
            <b><label>Anticipo</label></b>
            <select class="form-control" name="new_anticipo" id="new_anticipo">
              <option disabled selected>----Seleccionar Anticipo----</option>
              <?php foreach ($lista_anticipos->result() as $row){ ?>
              <option value="<?php echo "".$row->id_anticipo.""; ?>"><?php echo "".$row->catalogo_cliente_empresa." Total: $".$row->anticipo_total." Comentario: ".$row->anticipo_coment.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <div id="cat_cotizacion" hidden="true">
            <b><label>Cotización</label></b>
            <select class="form-control" name="new_cotizacion" id="new_cotizacion">
              <option disabled selected>----Seleccionar Cotización----</option>
              <?php foreach ($lista_cotizaciones->result() as $row){ ?>
              <option value="<?php echo "".$row->id_cotizacion.""; ?>"><?php echo "Folio: ".$row->cotizacion_folio." Empresa: ".$row->catalogo_cliente_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
          <br>
          <b><label>Domicilio de Entrega</label></b>
          <textarea id="new_domicilio" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewAnticipo" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">

  $(document).ready(function(){
    $('#table_recibo').DataTable();

    $('#radio_anticipo').click(function(){
      if($("#radio_anticipo").is(":checked")){
        $("#new_cliente").attr("disabled","true");
        $("#cat_cliente").attr("hidden","true");
        $("#cat_anticipo").removeAttr("hidden");
        $("#cat_cotizacion").attr("hidden","true");
      }      
    });
    $('#radio_cotizacion').click(function(){
      if($("#radio_cotizacion").is(":checked")){
        $("#new_cliente").attr("disabled","true");
        $("#cat_cliente").attr("hidden","true");
        $("#cat_anticipo").attr("hidden","true");
        $("#cat_cotizacion").removeAttr("hidden");
      }      
    });
    $('#radio_nuevo').click(function(){
      if($("#radio_nuevo").is(":checked")){
        $("#new_cliente").removeAttr("disabled");
        $("#cat_cliente").removeAttr("hidden");
        $("#cat_anticipo").attr("hidden","true");
        $("#cat_cotizacion").attr("hidden","true");
      }      
    });


    });