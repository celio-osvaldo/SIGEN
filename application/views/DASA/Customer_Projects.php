
<!--Mostrar lista de clientes y obras -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Obras/Clientes</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewClientModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nueva Obra/Cliente</button>
  </div>
</div>



<div class="row">
  <div class="col-md-12">
    <div class="container">
      <div class="card bg-card">
        <div class="container">
          <table class="table table-striped table-bordered table-condensed" id="table_customer">
            <thead  class="bg-primary">
              <tr>
                <th>Obra/Cliente</th>
                <th>Importe Total</th>
                <th>Pagado</th>
                <th>Saldo</th>
                <th>Estado</th>
                <th>Comentarios</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="#"><img src="<?php echo base_url() ?>Resources/Icons/edit.ico"></a></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
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
        <textarea id="coment_obra" class="form-control input-sm" maxlength="200"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardarnuevo">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!--script para llenar la tabla con la libreria DataTable -->
<script type="text/javascript">
  $(document).ready( function () {
    $('#table_customer').DataTable();
  } );
</script>

<!--script Limpiar Ventana Modal Nuevo Cliente/Obra -->
<script type="text/javascript">
  $("#btncancelar").on("click",function(event){ 
    $('#nom_obra').val("");
    $('#imp_obra').val("");
    $('#coment_obra').val("");
  });

//funcion para Guardar nuevo cliente/obra
  $(document).ready(function(){
    $('#guardarnuevo').click(function(){
      nombre=$('#nom_obra').val();
      importe=$('#imp_obra').val();
      coment=$('#coment_obra').val();
      if (nombre!=""&&importe!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Dasa/AddCustomerProject",
          data:{nombre:nombre, importe:importe,coment:coment},
          success:function(result){
            alert(result);
            if(result==1){
              alert('Registro Agregado');
            }else{
              alert('Falló el servidor. Registro no agregado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Obra/cliente e Importe Total");
      }

    });
  });
</script>



