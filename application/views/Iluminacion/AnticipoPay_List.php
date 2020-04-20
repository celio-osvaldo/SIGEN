<!--Mostrar lista de Pagos de Anticipo -->

<div class="container">
  <button class="btn btn-success" onclick="Lista_Anticipos()">Regresar a Lista de Anticipos</button>
</div>
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_anticipo_prod_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Pagos en Anticipo </h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Cliente:<hr><?php echo $anticipo_info->catalogo_cliente_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Total de Anticipo:<hr>$<?php echo $anticipo_info->anticipo_total; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Total Pagado:<hr>$<?php echo $anticipo_info->anticipo_pago; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Saldo:<hr>$<?php echo $anticipo_info->anticipo_resto; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Comentarios:<hr><?php echo $anticipo_info->anticipo_coment; ?>
              </h6>
            </span>
          </div>
        </div>
      </div>
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="false">id_pagos_anticipo</th>
          <th>Fecha de Pago</th>
          <th>Cantidad de Pago</th>
          <th>Comentarios</th>
          <th>Comprobante</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($anticipo_pagos->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_pagos_anticipo".$row->id_pagos_anticipo;?>"><?php echo "".$row->id_pagos_anticipo.""; ?></td>
            <td id="<?php echo "fecha".$row->id_pagos_anticipo;?>"><?php echo "".$row->pagos_anticipo_fecha.""; ?></td>
            <td id="<?php echo "cantidad".$row->id_pagos_anticipo;?>">$<?php echo "".$row->pagos_anticipo_cantidad.""; ?></td>
            <td id="<?php echo "coment".$row->id_pagos_anticipo;?>"><?php echo "".$row->pagos_anticipo_coment.""; ?></td>
            <td id="<?php echo "comprobante".$row->id_pagos_anticipo;?>"><label hidden="true" id="<?php echo "url_".$row->id_pagos_anticipo;?>"><?php echo base_url().$row->pagos_anticipo_url_comprobante; ?></label> <a  onclick="ver_comprobante(this.id)" role="button" id="<?php echo $row->id_pagos_anticipo;?>"><button class="btn btn-outline-secondary" title="Ver comprobante de pago"><img src="..\Resources\Icons\frame_gallery_image_images_photo_picture_pictures_icon_123209.ico" style="filter: invert(100%)" /></button></a>
            </td>
            <td>
              <a class="navbar-brand" onclick="EditPay(this.id)" role="button" id="<?php echo $row->id_pagos_anticipo; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" title="Editar Pago" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeletePay(this.id)" role="button" id="<?php echo $row->id_pagos_anticipo; ?>"><button class="btn btn-outline-secondary"><img src="..\Resources\Icons\delete.ico" title="Eliminar Pago" style="filter: invert(100%)" /></button></a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>
              <!--
// Show image preview
          $('#preview').append("<a href='<?php echo base_url() ?>"+response+"' target='_blank'><img src='<?php echo base_url() ?>"+response+"' width='100' height='100' style='display: inline-block;'></a>");
        -->
<!-- Modal Ver Comprobante de Pago -->
<div class="modal fade" id="ver_comprobanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titlecomprobanteModal">Comprobante de Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal-body">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edit Pay Anticipo -->
<div class="modal fade" id="EditPayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleProductModal">Editar Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Fecha de Pago</label>
        <input type="date" id="edit_fecha" class="form-control input-sm">
        <label>Cantidad Pagada</label>
        <input type="number" min="0" id="edit_cantidad" class="form-control input-sm">
        <label>Comentarios</label>
        <textarea id="edit_coment" class="form-control input-sm" maxlength="200"></textarea>
        <label>Comprobante de Pago</label><br>
        <!-- Form -->
        <form method='post'  enctype="multipart/form-data">
          <input type="file" id="edit_pago_imagen" accept="application/pdf, image/*" class="form-control"><br>
        </form>
        <input type="text" id="edit_id_pay_ant" hidden="true">
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdatePay" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Delete Pay Anticipo -->
<div class="modal fade" id="DeletePayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title" id="titleDeleteProductModal">Eliminar Pago</h5>
        <button type="button" class="close" onclick="limpiar_modal()" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="modal_body_delete" class="modal-body">
        <input type="text" id="delete_id_pagos_anticipo" hidden="true">
        <h6><label>Fecha: </label><span class="badge badge-danger" id="delete_fecha"></span></h6>
        <h6><label>Cantidad: $</label><span class="badge badge-danger" id="delete_cantidad"></span></h6>
        <h6><label>Comentarios: </label><span class="badge badge-danger" id="delete_coment"></span></h6>
        <h6 class="bg-warning"><p>Al eliminar el pago, será borrada toda la información de este</p></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="limpiar_modal()" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-danger" id="Delete_Pay" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_anticipo_prod_list').DataTable();

        //Función para actualizar el registro de un Pago
        $('#UpdatePay').click(function(){
          id_pagos_anticipo=$("#edit_id_pay_ant").val();
          fecha=$("#edit_fecha").val();
          cantidad=$("#edit_cantidad").val();
          coment=$("#edit_coment").val();
          id_anticipo=<?php echo $anticipo_info->id_anticipo; ?>;
          var datos = new FormData();
              var files = $('#edit_pago_imagen')[0].files[0];
              datos.append('file',files);
              datos.append('id_anticipo',id_anticipo);
              datos.append('cantidad',cantidad);
              datos.append('fecha',fecha);
              datos.append('coment',coment);
              datos.append('id_pagos_anticipo',id_pagos_anticipo);
   //alert(id_anticipo+" "+id_pagos_anticipo+" "+fecha+" "+cantidad+" "+coment);
       if(cantidad>0&&fecha!=""){
        $.ajax({
          url: '<?php echo base_url();?>Iluminacion/EditPay_Anticipo',
          type: 'post',
          data: datos,
          contentType: false,
          processData: false,
          success:function(result){
            //alert(result);
            alert("Datos Actualizados");
            Update_Page(id_anticipo); 
          }
        });
      }else{
        alert("Debe Ingresar una cantidad mayor a 0 (cero) y una fecha válida");
      }     
      Update_Page(id_anticipo); 
    });

        
        $('#Delete_Pay').click(function(){
          id_pagos_anticipo=$("#delete_id_pagos_anticipo").val();
          id_anticipo=<?php echo $anticipo_info->id_anticipo; ?>;
         // alert(id_anticipo+" id_pagos: "+id_pagos_anticipo);
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/DeletePay_Anticipo",
          data:{id_anticipo:id_anticipo, id_pagos_anticipo:id_pagos_anticipo},
          success:function(result){
            //alert(result);
            if(result){
              alert('Pago Eliminado');
            }else{
              alert('Falló el servidor. Pago no eliminado');
            }
          }
        });
      Update_Page(id_anticipo); 
    });
  });

  function ver_comprobante($id_pagos_anticipo){
    var id_pagos_anticipo=$id_pagos_anticipo;
    var comprobante=$("#url_"+$id_pagos_anticipo).text().split(".");
    var url=$("#url_"+$id_pagos_anticipo).text();
    //alert(comprobante[0]+" "+comprobante[1]);
    if (comprobante[0]=="<?php echo base_url()?>") {
      alert("No se adjuntó comprobante de pago");
    }else{
      $('#ver_comprobanteModal').modal();
        $('#modal-body').append("<embed id='imagen_modal' frameborder='0' width='100%'' height='400px'>");    
      $('#imagen_modal').attr({"src" : url});
    }
  }


  function EditPay($id_pagos_anticipo){
    var id_pagos_anticipo=$id_pagos_anticipo;
    var fecha=$("#fecha"+id_pagos_anticipo).text();
    var cantidad=$("#cantidad"+id_pagos_anticipo).text().split('$');
    var coment=$("#coment"+id_pagos_anticipo).text();
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
    $('#EditPayModal').modal();
     $("#edit_fecha").val(fecha);
     $("#edit_cantidad").val(parseFloat(cantidad[1]));
     $("#edit_coment").val(coment);
     $("#edit_id_pay_ant").val(id_pagos_anticipo);
  }

  function DeletePay($id_pagos_anticipo){
    var id_pagos_anticipo=$id_pagos_anticipo;
    var fecha=$("#fecha"+id_pagos_anticipo).text();
    var cantidad=$("#cantidad"+id_pagos_anticipo).text().split('$');
    var coment=$("#coment"+id_pagos_anticipo).text();
    var comprobante=$("#url_"+$id_pagos_anticipo).text().split(".");
    var url=$("#url_"+$id_pagos_anticipo).text();
    var base_url="<?php echo base_url()?>";
    //alert(comprobante[0].length+" url: "+url+" base url: "+base_url.length);
    $('#DeletePayModal').modal();
    $('#delete_id_pagos_anticipo').text(id_pagos_anticipo);
     $("#delete_fecha").text(fecha);
     $("#delete_cantidad").text(cantidad[1]);
     $("#delete_coment").text(coment);
     if (comprobante[0].length==base_url.length) {
      $('#modal_body_delete').append("<div id='sin_comprobante'><h6><label id='lbl_comprobante1'>Comprobante: </label><span class='badge badge-danger' id='delete_comprobante_1'></span></h6></div>");    
      $('#delete_comprobante_1').text("No se Adjuntó Comprobante");
      $('#delete_comprobante_2').remove();
      $('#lbl_comprobante2').text("");
    }else{
      $('#modal_body_delete').append("<div id='con_comprobante'><label id='lbl_comprobante2'>Comprobante: </label><embed id='delete_comprobante_2' frameborder='0' width='100%'' height='400px'></div>");    
      $('#delete_comprobante_2').attr({"src" : url});
      $('#delete_comprobante_1').remove();
      $('#lbl_comprobante1').text("");
    }
     
     $("#delete_id_pagos_anticipo").val(id_pagos_anticipo);
  }

  function Update_Page($id_anticipo){
    id_anticipo=$id_anticipo;
    $("#page_content").load("Anticipo_Pagos_List",{id_anticipo:id_anticipo});
  }

  function Lista_Anticipos(){
    $("#page_content").load("Anticipos");
  }
  function limpiar_modal(){
    $('#sin_comprobante').remove();
    $('#con_comprobante').remove();
  }

</script>