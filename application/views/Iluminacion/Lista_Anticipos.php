
<!--Mostrar lista de Anticipos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Anticipos</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewAnticipoModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Anticipo</button>
  </div>
</div>

      <div class="card bg-card">
        <div class="table-responsive">
          <table id="table_customer" class="table table-striped table-hover display" style="font-size: 10pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
              <tr>
                <th>Proyecto</th>
                <th>Cliente</th>
                <th>Importe Total</th>
                <th>Pagado</th>
                <th>Saldo</th>
                <th hidden="true">Estado_id</th>
                <th>Estado</th>
                <th>Comentarios</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>

          </tbody>
        </table>
      </div>
    </div>