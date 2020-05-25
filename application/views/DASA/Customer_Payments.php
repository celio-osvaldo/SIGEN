<!--Mostrar lista de pagos de Proyectos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Pagos a Proyectos</h3>
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
                 <td id="<?php echo "nom_cliente".$row->id_obra_cliente;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
                 <td id="<?php echo "imp_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_imp_total,2,'.',',').""; ?></td>
                 <td id="<?php echo "pagado_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_pagado,2,'.',',').""; ?></td>
                 <td id="<?php echo "saldo_obra".$row->id_obra_cliente;?>">$<?php echo number_format($row->obra_cliente_saldo,2,'.',',').""; ?></td>
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



<!-- Modal Add Customer_Payments -->
<div class="modal fade" id="AddPayments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Registrar Pago de Proyecto: <input class="sinborde" size="40" type="text" readonly="true" id="Obra_nombre" style="background-color: silver"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Cantidad de Pago</label>
        <input type="text" min="0" onblur="SeparaMiles(this.id)" id="pago_obra" class="form-control input-sm" required="true">
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
      cant_pago=cant_pago.replace(/\,/g, '');
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

function SeparaMiles($id){
  valor=$("#"+$id).val();
    valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){
    //alert("entro");
    valor=0.00;
    //alert(valor);
  }
  var resultado=valor.toLocaleString("en");
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }



</script>


