<!--Mostrar lista de clientes y obras -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Pagos a Proyectos</h3>
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
                <th>Proyecto</th>
                <th>Importe Total</th>
                <th>Pagado</th>
                <th>Saldo</th>
                <th>Último Pago</th>
                <th>Comentarios</th>
                <th>Registrar Pago</th>
                <th>Detalles de Pagos</th>

              </tr>
            </thead>
            <tbody>
              <?php 
              foreach ($customerspays->result() as $row) {
               ?>
               <tr>
                 <td id="<?php echo "nom_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_nombre.""; ?></td>
                 <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_imp_total.""; ?></td>
                 <td id="<?php echo "pagado_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_pagado.""; ?></td>
                 <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_saldo.""; ?></td>
                 <td id="<?php echo "ult_pago_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_ult_pago.""; ?></td>
                 <td id="<?php echo "coment_obra".$row->id_obra_cliente;?>"><?php echo "".$row->obra_cliente_comentarios.""; ?></td>
                 <td>
                  <a class="navbar-brand" href="#" onclick="AddPay(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico"></a>
                </td>
                <td>
                  <a class="navbar-brand" href="#" onclick="Details(this.id)" role="button" id="<?php echo $row->id_obra_cliente; ?>"><img src="..\Resources\Icons\lupa.ico"></a>
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


<!-- Modal Add Customer_Payments -->
<div class="modal fade" id="AddPayments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Registrar Pago de Obra: <input class="sinborde" size="40" type="text" readonly="true" id="Obra_nombre" style="background-color: silver"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Cantidad de Pago</label>
        <input type="number" name="" id="pago_obra" class="form-control input-sm" required="true">
        <label>Fecha de Pago</label>
        <input type="date" id="fecha_pago" class="form-control input-sm" required="true">
        <label>Comentario del Pago</label>
        <textarea id="coment_obra" class="form-control input-sm" maxlength="50"></textarea>
        <input type="number" id="id_obra" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="guardarpago" data-dismiss="modal">Guardar Pago</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready( function () {
    $('#table_customer').DataTable();

    $('#guardarpago').click(function(){
      id_obra=$('#id_obra').val();
      cant_pago=$('#pago_obra').val();
      fecha=$('#fecha_pago').val();
      coment=$('#coment_obra').val();
      //alert(id_obra+" "+cant_pago+" "+fecha+" "+coment);
       if (cant_pago>0&&fecha_pago!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Dasa/AddCustomersPay",
          data:{id_obra:id_obra, cant_pago:cant_pago, fecha:fecha, coment:coment},
          success:function(result){
            //alert(result);
            refrescar();
            if(result==1){
              alert('Pago Agregado');
            }else{
              alert('Falló el servidor. Pago no agregado');
            }
          }
        });
      }else{
        alert("Debe ingresar Cantidad de Pago mayor a 0 e indicar una fecha");
      }
    });
  });

  function refrescar(){
    //Actualiza la el div con los datos de CustomerPayments
    $("#page_content").load("CustomerPayments");
  }


  function AddPay($id) {
    $('#AddPayments').modal();
    var obra=$('#nom_obra'+$id).text();
    $('#id_obra').val($id);
    $('#Obra_nombre').val(obra);
  }


  function Details($id) {
   //alert('Ver Detalles');
   var id_obra=$id;
   $("#page_content").load("Payments_List",{id_obra:id_obra});
                      
 }
</script>


