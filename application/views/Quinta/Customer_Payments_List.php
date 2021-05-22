<!--Mostrar lista de Pagos de Eventos -->

<div class="row">
  <div class="col">
    <h2 align="center">Lista de Pagos Realizados </h2>
    <div class="col" align="center">
      <span class="badge badge-info">
        <h6 align="center">
          Contrato:<hr><?php echo $obra->obra_cliente_contrato; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Evento/Cliente:<hr><?php echo $obra->obra_cliente_nombre; ?>
        </h6>
      </span>
      <span class="badge badge-info">
        <h6 align="center">
          Importe Total de Evento:<hr>$<?php echo number_format($obra->obra_cliente_imp_total,2,'.',','); ?>
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

<div class="row">
  <div class="col-md-12" align="right">
    <button type="button" onclick="Regresar()" class="btn btn-success" >Regresar a lista de Eventos</button>
  </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_payments_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>No.</th>
          <th>Fecha de Pago</th>
          <th>Pago</th>
          <th>Concepto</th>
          <th>Acciones</th>

        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($payments_list->result() as $row) {
          ?>
          <tr>
            <td id="<?php echo "no_recibo".$row->id_venta_mov;?>"><?php echo "".$row->venta_mov_factura.""; ?>  </td>
            <td id="<?php echo "fecha".$row->id_venta_mov;?>"><?php echo "".$row->venta_mov_fecha.""; ?>  </td>
            <td id="<?php echo "pago".$row->id_venta_mov;?>">$<?php echo number_format($row->venta_mov_monto,2,'.',',').""; ?> </td>
            <td id="<?php echo "coment".$row->id_venta_mov;?>"> <?php echo "".$row->venta_mov_comentario.""; ?>
          </td>
          <td>
           <div class="row" >
            <form action="<?php echo base_url();?>Quinta/Genera_PDF_Recibo_Pago" method="POST" target='_blank'>
             <input type="text" hidden="true" id="id_venta_mov" name="id_venta_mov" value="<?php echo $row->id_venta_mov ?>">
             <input hidden="true" id="folio" type="text" name="folio">
              <button class="btn btn-outline-secondary"  type="submit" title="Imprimir Recibo de Entrega"><img width="20px" src="..\Resources\Icons\imprimir.ico" width="20px" style="filter: invert(100%)"></button>
           </form>
            <a class="btn btn-outline-secondary" onclick="Edit_pay2(this.id)" role="button" id="<?php echo $row->id_venta_mov; ?>"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" width="20" title="Editar" style="filter: invert(100%)" /></a>

            <a class="btn btn-outline-secondary" onclick="Delete_pay(this.id)" role="button" id="<?php echo $row->id_venta_mov; ?>"><img src="..\Resources\Icons\delete.ico" width="20" title="Eliminar" style="filter: invert(100%)" /></a>
          </div>
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
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">#Recibo</label>
            <input type="text" name="edit_no_recibo" id="edit_no_recibo" class="form-control" onblur="Verifica(this.id)" required="true">
          </div>
          <div class="col-md-5">
            <label class="label-control">Fecha de Pago</label>
            <input type="date" name="" id="edit_fecha" class="form-control input-sm" onblur="Verifica(this.id)" required="true">
          </div>
          <div class="col-md-4">
            <label class="label-control">Importe de Pago</label>
            <input type="text" onblur="SeparaMiles(this.id)" id="edit_imp_pago" onblur="Verifica(this.id)" class="form-control input-sm" required="true">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Concepto de Pago</label>
            <textarea id="edit_coment" class="form-control input-sm" maxlength="200"></textarea>
          </div>
        </div>
        <input type="text" id="edit_id_vent_mov" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdatePay" disabled="true" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Pay Customer_Project -->
<div class="modal fade" id="DeletePayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Eliminar Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">#Recibo</label>
            <input type="text" name="delete_no_recibo" id="delete_no_recibo" disabled="true" class="form-control">
          </div>
          <div class="col-md-5">
            <label class="label-control">Fecha de Pago</label>
            <input type="date" name="delete_fecha" id="delete_fecha" disabled="true" class="form-control input-sm">
          </div>
          <div class="col-md-4">
            <label class="label-control">Importe de Pago</label>
            <input type="text" onblur="SeparaMiles(this.id)" id="delete_imp_pago" disabled="true" class="form-control input-sm">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Concepto de Pago</label>
            <textarea id="delete_coment" class="form-control input-sm" disabled="true" maxlength="200"></textarea>
          </div>
        </div>
        <input type="text" id="delete_id_vent_mov" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="DeletePay" data-dismiss="modal">Eliminar</button>
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

  function Verifica(id){
    dato=$("#"+id).val();
    
    if(dato==""){
      $("#UpdatePay").attr("disabled","true");
      $('#'+id).addClass("is-invalid");
    }else{
     $("#UpdatePay").removeAttr("disabled");
     $('#'+id).removeClass("is-invalid");
   }


 }

  $(document).ready( function () {
    $('#table_payments_list').DataTable({
        initComplete: function() {
            $(this.api().table().container()).find('input').parent().wrap('<form>').parent().attr('autocomplete', 'off');
        },
         /****** add this */
        "searching": true,
        // "autoFill": true,
        "language": {
            "lengthMenu": "Por página: _MENU_",
            "zeroRecords": "Sin resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(Filtrado de _MAX_ registros en total)",
            "search": "Búsqueda",
                "paginate": {
            "previous": "Anterior",
            "next": "Siguiente"
          }
        },
    });

        //Función para actualizar el registro
        $('#UpdatePay').click(function(){
          act_fecha=$("#edit_fecha").val();
          act_imp=$("#edit_imp_pago").val();
          act_imp=act_imp.replace(/\,/g, '');
          act_coment=$("#edit_coment").val();
          id=$("#edit_id_vent_mov").val();
          no_recibo=$("#edit_no_recibo").val();
          //alert(act_fecha+act_imp+act_coment+id);

          fecha=$("#fecha"+id).text();
          importe=$("#pago"+id).text();
          importe=importe.replace(/\$/g, '');
          importe=importe.replace(/\,/g, '');
          coment=$("#coment"+id).text();
          cant_pago_letra=NumeroALetras(act_imp);

      if (act_fecha!=""&&act_imp!="") {//Verificamos que los campos no estén vacíos
          
          total=act_imp-importe;
        //  if(act_fecha.trim()!=fecha.trim()||total!=0){

            //alert(act_fecha+" "+fecha+" dif fecha"+dif_fecha+" "+act_imp+" "+importe+" total:"+total);
            //$("#JustificaModal").modal();//Abrimos modal para solicitar la justificación del cambio

         // }else{
            $.ajax({
              type:"POST",
              url:"<?php echo base_url();?>Quinta/EditCustomerPay",
              data:{act_fecha:act_fecha, act_imp:act_imp, act_coment:act_coment,id:id, cant_pago_letra:cant_pago_letra, no_recibo:no_recibo},
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
       //   }
      }else{
        alert("Debe ingresar fecha de Pago e Importe Total");
      } 
    });

    $('#DeletePay').click(function(){
      id=$("#delete_id_vent_mov").val();
      delete_imp=$("#delete_imp_pago").val();
      delete_imp=delete_imp.replace(/\,/g, '');
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url(); ?>Quinta/DeletePayment',
      data: {id:id, delete_imp:delete_imp},
    }).done(res=>{
          //Accion a realzar si se completa la solicitud
          if(res){
            alert("Pago Eliminado Correctamente");
            Update_Page();
          }
          if(!res){
            alert("Pago no eliminado, intentelo nuevamente");
            Update_Page();
          }
          
        }).fail(err=>{
          //Acción a realizar en caso de un error, solicitud no realizada
          alert("Error intentelo nuevamente");
          Update_Page();
        }).always(res=>{
          //Acción a realizar independientemente si existe error o no
          //Update_Page();
        });

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
          url:"<?php echo base_url();?>Iluminacion/EditCustomerPay_Admin",
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
    var coment=$("#coment"+$id).text().trim();
    var id_venta_mov=$id;
    var no_recibo=$("#no_recibo"+$id).text().trim();
    //alert(id_venta_mov);
    $("#EditPayModal").modal();
    document.getElementById("edit_fecha").valueAsDate = new Date(fecha);
    $("#edit_imp_pago").val(parseFloat(pago[1]));
    $("#edit_coment").val(coment);
    $("#edit_id_vent_mov").val(id_venta_mov);
    $("#edit_no_recibo").val(no_recibo);
  }

function Delete_pay($id){
    //alert("Eliminar "+$id);
    var fecha=$("#fecha"+$id).text();
    //alert(fecha);
    var pago=$("#pago"+$id).text().split('$');
    pago[1]=pago[1].replace(/\,/g, '');
    //alert(pago);
    var coment=$("#coment"+$id).text().trim();
    var id_venta_mov=$id;
    var no_recibo=$("#no_recibo"+$id).text().trim();
    //alert(id_venta_mov);
    $("#DeletePayModal").modal();
    document.getElementById("delete_fecha").valueAsDate = new Date(fecha);
    $("#delete_imp_pago").val(parseFloat(pago[1]));
    $("#delete_coment").val(coment);
    $("#delete_id_vent_mov").val(id_venta_mov);
    $("#delete_no_recibo").val(no_recibo);
  }
  
//Función para Mostrar Modal de Editar un registro Pago
function Print_Recibo($id){

  }

  function Update_Page(){
    $("#page_content").load("CustomerPayments");
  }

  function Regresar(){
    $("#page_content").load("CustomerPayments");
  }



</script>
