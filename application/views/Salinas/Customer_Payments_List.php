<!--Mostrar lista de Pagos de Proyectos -->

<div class="row">
  <div class="col">
    <h2 align="center">Lista de Pagos Realizados </h2>
    <div class="col" align="center">
      <span class="badge badge-info">
        <h6 align="center">
          Proyecto/Cliente:<hr><?php echo $obra->obra_cliente_nombre; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Total de Proyecto:<hr>$<?php echo number_format($obra->obra_cliente_imp_total,2,'.',','); ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Total Pagado:<hr>$<?php echo number_format($obra->obra_cliente_pagado,2,'.',','); ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Saldo:<hr>$<?php echo number_format($obra->obra_cliente_saldo,2,'.',','); ?>
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




<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_payments_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
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
            <td id="<?php echo "fecha".$row->id_venta_mov;?>"><?php echo "".$row->venta_mov_fecha.""; ?>  </td>
            <td id="<?php echo "pago".$row->id_venta_mov;?>">$<?php echo number_format($row->venta_mov_monto,2,'.',',').""; ?> </td>
            <td id="<?php echo "coment".$row->id_venta_mov;?>"> <?php echo "".$row->venta_mov_comentario.""; ?>
          </td>
          <td>
            <a class="navbar-brand" onclick="Edit_pay2(this.id)" role="button" id="<?php echo $row->id_venta_mov; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></button></a>
          </td>
        </tr>
        <?php 
      }
      ?>
    </tbody>
  </table>
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
        <input type="date" name="" id="edit_fecha" class="form-control input-sm">
        <label>Importe de Pago</label>
        <input type="text" onblur="SeparaMiles(this.id)" id="edit_imp_pago" class="form-control input-sm">
        <label>Comentarios</label>
        <textarea id="edit_coment" class="form-control input-sm" maxlength="200"></textarea>
        <input type="text" id="edit_id_vent_mov" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdatePay" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Justifica Cambios Customer_Pays -->
<div class="modal fade" id="JustificaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Justifica el cambio solicitado:</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea id="txt_justifica" onkeyup="countChars(this);" class="form-control input-sm" maxlength="500"></textarea>
        <p id="charNum">Restan 500 caracteres</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Solicita_Cambio" data-dismiss="modal">Solicitar Cambio</button>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
  $(document).ready( function () {
    $('#table_payments_list').DataTable();

        //Función para actualizar el registro
        $('#UpdatePay').click(function(){
          act_fecha=$("#edit_fecha").val();
          act_imp=$("#edit_imp_pago").val();
          act_imp=act_imp.replace(/\,/g, '');
          act_coment=$("#edit_coment").val();
          id=$("#edit_id_vent_mov").val();
          //alert(act_fecha+act_imp+act_coment+id);

          fecha=$("#fecha"+id).text();
          importe=$("#pago"+id).text();
          importe=importe.replace(/\$/g, '');
          importe=importe.replace(/\,/g, '');
          coment=$("#coment"+id).text();

      if (act_fecha!=""&&act_imp!="") {//Verificamos que los campos no estén vacíos
          
          total=act_imp-importe;
          if(act_fecha.trim()!=fecha.trim()||total!=0){

            //alert(act_fecha+" "+fecha+" dif fecha"+dif_fecha+" "+act_imp+" "+importe+" total:"+total);
            $("#JustificaModal").modal();//Abrimos modal para solicitar la justificación del cambio

          }else{
            $.ajax({
              type:"POST",
              url:"<?php echo base_url();?>Salinas/EditCustomerPay",
              data:{act_fecha:act_fecha, act_imp:act_imp, act_coment:act_coment,id:id},
              success:function(result){
                //alert(result);
                if(result=='actualizado'){
                  alert('Registro Actualizado');
                  Update_Page();
                }else{
                  alert('Falló el servidor. Registro no actualizado');
                }
              }
            });
          }
      }else{
        alert("Debe ingresar fecha de Pago e Importe Total");
      } 
    });


    $('#Solicita_Cambio').click(function(){
      txt_justifica=$("#txt_justifica").val();
      fecha_old=$("#fecha"+id).text();
      importe_old=$("#pago"+id).text();
      importe_old=importe_old.replace(/\$/g, '');
      importe_old=importe_old.replace(/\,/g, '');
      coment_old=$("#coment"+id).text();
      //alert(importe_old);
      if(txt_justifica!=""){
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Salinas/EditCustomerPay_Admin",
          data:{act_fecha:act_fecha, act_imp:act_imp, act_coment:act_coment, fecha_old:fecha_old, importe_old:importe_old, coment_old:coment_old, id:id, txt_justifica:txt_justifica},
                success:function(result){
                  //alert(result);
                  if(result){
                    alert('Solicitud enviada al Administrador para actualizar los datos indicados.');
                    CloseModal();
                  }else{
                    alert('Falló el servidor. Solicitud para actualizar no enviada.');
                  }
                }
              });
           }else{
            alert("Actualización de datos no completada. Debe justificar los cambios solicitados ya que estos requieren autorización del Administrador.");
           }
    });



  });
    </script>

    <script type="text/javascript">
//Función para Mostrar Modal de Editar un registro Pago
function Edit_pay2($id){
    //alert("Editar "+$id);
    var fecha=$("#fecha"+$id).text();
    //alert(fecha);
    var pago=$("#pago"+$id).text().split('$');
    pago[1]=pago[1].replace(/\,/g, '');
    //alert(pago);
    var coment=$("#coment"+$id).text();
    var id_venta_mov=$id;
    //alert(id_venta_mov);
    $("#EditPayModal").modal();
    document.getElementById("edit_fecha").valueAsDate = new Date(fecha);
    $("#edit_imp_pago").val(parseFloat(pago[1]));
    $("#edit_coment").val(coment);
    $("#edit_id_vent_mov").val(id_venta_mov);
  }

  function Update_Page(){
    $("#page_content").load("CustomerPayments");
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
