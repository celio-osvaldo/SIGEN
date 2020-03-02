
<!--Mostrar lista de clientes y obras -->

<div class="row">
    <div class="col-sm col-md-3">
      <input type="search" class="form-control" id="search" placeholder="Nombre Obra/Cliente">
    </div>
    <div class="col-sm col-md-1">
        <button type="button" class="btn btn-primary">Buscar</button>
    </div>
    <div class="col-sm">
        <h3 align="left">Lista de Obras/Clientes</h3>
    </div>
    <div class="col-sm">
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewClientModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nueva Obra/Cliente</button>
    </div>
</div>


<div class="row">
    <div class="col-sm col-md-2 offset-md-3">
      <div class="col-sm"><button type="button" class="btn btn-success">Ver pagadas</button></div>
    </div>
    <div class="col-sm col-md-2">
         <div class="col-sm"><button type="button" class="btn btn-warning">Ver pendientes</button></div>
    </div>
</div>

<div class="row">
    <table class="table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th scope="col">Obra/Cliente</th>
      <th scope="col">Importe Total</th>
      <th scope="col">Pagado</th>
      <th scope="col">Saldo</th>
      <th scope="col">Estado</th>
      <th scope="col">Comentarios</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td></th>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
</div>




<!-- Modal -->
<div class="modal fade" id="NewClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nueva Obra/Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre Obra/Cliente</label>
        <input type="text" name="" id="nom_obra" class="form-control input-sm">
        <label>Importe Total</label>
        <input type="number" name="" id="imp_obra" class="form-control input-sm">
        <label>Comentarios</label>
        <input type="coment" name="" id="coment_obra" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>




