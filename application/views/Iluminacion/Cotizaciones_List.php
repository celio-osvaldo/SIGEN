
<!--Mostrar lista de Anticipos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Cotizaciones</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewCotizacionModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nueva Cotización</button>
  </div>
</div>

<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_cotizacion" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>id_cotización</th>
          <th>Folio</th>
          <th>Fecha</th>
          <th>Cliente</th>
          <th>id_cliente</th>
          <th>Obra</th>
          <th>Subtotal</th>
          <th>Iva</th>
          <th>Total</th>
          <th>Tiempo de Entrega</th>
          <th>Vigencia</th>
          <th>Elaboró</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($lista_cotizaciones->result() as $row) {
         ?>
         <tr>
          <td id="<?php echo "id_cotizacion".$row->id_cotizacion;?>"><?php echo "".$row->id_cotizacion.""; ?></td>
          <td id="<?php echo "folio".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_folio.""; ?></td>
          <td id="<?php echo "fecha".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_fecha.""; ?></td>
          <td id="<?php echo "cliente".$row->id_cotizacion;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
          <td id="<?php echo "id_cliente".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_id_cliente.""; ?></td>
          <td id="<?php echo "obra".$row->id_cotizacion;?>"><?php echo "".$row->cotizacion_obra.""; ?></td>
          <td id="<?php echo "subtotal".$row->id_cotizacion;?>">$<?php echo "".$row->cotizacion_subtotal.""; ?></td>
          <td id="<?php echo "iva".$row->id_cotizacion;?>">$<?php echo "".$row->cotizacion_iva.""; ?></td>
          <td id="<?php echo "total".$row->id_cotizacion;?>">$<?php echo "".$row->cotizacion_total.""; ?></td>
          <td id="<?php echo "tiempo_entrega".$row->id_cotizacion;?>">$<?php echo "".$row->cotizacion_tiempo_entrega.""; ?></td>
          <td id="<?php echo "vigencia".$row->id_cotizacion;?>">$<?php echo "".$row->cotizacion_vigencia.""; ?></td>
          <td id="<?php echo "elabora".$row->id_cotizacion;?>">$<?php echo "".$row->cotizacion_elabora.""; ?></td>

          <td>
            <a class="navbar-brand" href="#" onclick="EditCotizacion(this.id)" role="button" id="<?php echo $row->id_cotizacion; ?>">
              <button class="btn btn-outline-secondary " title="Editar Registro"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20px" alt="Editar" style="filter: invert(100%)" />
              </button>
            </a>
            <a class="navbar-brand" href="#" onclick="Add_Product(this.id)" role="button" id="<?php echo $row->id_cotizacion; ?>"><button class="btn btn-outline-secondary" title="Agregar Producto"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="20px" alt="Agregar" style="filter: invert(100%)"></button>
            </a>
            <a class="navbar-brand" href="#" onclick="Details_Cotizacion(this.id)" role="button" id="<?php echo $row->id_cotizacion; ?>"><button class="btn btn-outline-secondary" title="Ver Detalles de Cotización"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)"></button>
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

<!-- Modal New Cotización -->
<div class="modal fade" id="NewCotizacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nueva Cotización</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Folio</label>
            <input type="text" id="new_folio" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label>Fecha de Elaboración</label>
            <input type="date" id="new_fecha_elabora" class="form-control">
          </div>
        </div>
        <label>Atención (Cliente)</label>
        <select class="form-control" id="new_cliente">
          <option disabled selected>----Seleccionar Cliente----</option>
          <?php foreach ($catalogo_cliente->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
          <?php } ?>
        </select>
        <label>Obra</label><br>
        <input type="text" maxlength="200" id="new_obra" class="form-control input-sm">
        <div class="form-row">
          <div class="form-group col-md-5">
            <label>Tiempo de Entrega (días)</label>
            <input type="number" id="new_tiem_entrega" class="form-control input-sm">
          </div>
          <div class="form-group col-md-4">
            <label>Vigencia (días)</label>
            <input type="numer" id="new_vigencia" class="form-control input-sm">
          </div>
        <label>Nombre de quien Elabora Cotización</label>
        <input type="text" maxlength="200" id="new_elabora" class="form-control input-sm">
        <label>Estado de Cotización</label>
        <select class="form-control" id="new_estado">
          <option value="Activo">Activo</option>
          <option value="Vencido">Vencido</option>
          <option value="Cancelado">Cancelado</option>
          <option value="Entregado">Entregado</option>
        </select>
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
    $('#table_cotizacion').DataTable();
  });
</script>