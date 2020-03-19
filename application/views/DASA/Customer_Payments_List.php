<!--Mostrar lista de clientes y obras -->

<div class="row">
  <div class="col">
    <h2 align="center">Lista de Pagos realizados. </h2>
    <div class="col" align="center">
      <span class="badge badge-info">
        <h6 align="center">
          Obra/Cliente:<hr><?php echo $obra->obra_cliente_nombre; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Total de Obra:<hr>$<?php echo $obra->obra_cliente_imp_total; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Total Pagado:<hr>$<?php echo $obra->obra_cliente_pagado; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Saldo:<hr>$<?php echo $obra->obra_cliente_saldo; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Comentarios:<hr><?php echo $obra->obra_cliente_comentarios; ?>
        </h6>
      </span>
    </div>
  </div>
</div>



<div class="row">
  <div class="col-md-12">
    <div class="container">
      <div class="card bg-card">
        <div class="container">
          <table class="table table-striped table-bordered table-condensed" id="table_payments_list">
            <thead  class="bg-primary">
              <tr>
                <th>Fecha de Pago</th>
                <th>Pago</th>
                <th>Comentarios</th>
                <th>Editar</th>

              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($payments_list->result() as $row) {
                ?>
                <tr>
                  <td id="<?php echo "fecha".$row->id_venta_mov;?>"> <?php echo "".$row->venta_mov_fecha.""; ?>  </td>
                  <td id="<?php echo "pago".$row->id_venta_mov;?>"><?php echo "".$row->venta_mov_monto.""; ?> </td>
                  <td id="<?php echo "coment".$row->id_venta_mov;?>"> <?php echo "".$row->venta_mov_comentario.""; ?>
                </td>
                <td>
                  <a class="navbar-brand" onclick="Edit_pay(this.id)" role="button" id="<?php echo $row->id_venta_mov; ?>"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico"></a>
                </td>
              </tr>
              <?php 
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>


<!-- Modal Edit Pay Customer_Project -->
<div class="modal fade" id="EditPayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Fecha de Pago</label>
        <input type="text" name="" id="edit_fecha" class="form-control input-sm">
        <label>Importe de Pago</label>
        <input type="text" name="" id="edit_imp_pago" class="form-control input-sm">
        <label>Comentarios</label>
        <textarea id="edit_coment" class="form-control input-sm" maxlength="200"></textarea>
        <input type="text" id="edit_id_vent_mov" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateRegister" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready( function () {
    $('#table_payments_list').DataTable();
  });
</script>

<script type="text/javascript">
//Función para Mostrar Modal de Editar un registro Pago
  function Edit_pay($id){
    //alert("Editar "+$id);
    var fecha=$("#fecha"+$id).text();
    var pago=$("#pago"+$id).text();
    var coment=$("#coment"+$id).text();
    var id_venta_mov=$id;
    $("#EditPayModal").modal();
    $("#edit_fecha").val(fecha);
    $("#edit_imp_pago").val(pago);
    $("#edit_coment").val(coment);
    $("#edit_id_obra").val(id_venta_mov);
    }
</script>
