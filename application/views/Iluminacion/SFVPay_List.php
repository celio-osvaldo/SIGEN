<!--Mostrar lista de Pagos de SFV -->

<div class="container">
  <button class="btn btn-success" onclick="Lista_SFV()">Regresar a SFV</button>
</div>
<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_sfv_pay_list" class="table table-striped table-hover display" style="font-size: 10pt;">
      <div class="row">
        <div class="col">
          <h2 align="center">Lista de Pagos en SFV </h2>
          <div class="col" align="center">
            <span class="badge badge-info">
              <h6 align="center">
                Cliente:<hr><?php echo $sfv_info->catalogo_cliente_empresa; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                KWh totales:<hr><?php echo $sfv_info->pago_sfv_kwh; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Importe total:<hr>$<?php echo $sfv_info->pago_sfv_imp_total; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Total pagado:<hr>$<?php echo $sfv_info->pago_sfv_pagado; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Saldo:<hr>$<?php echo $sfv_info->pago_sfv_saldo; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Fecha último pago:<hr><?php echo $sfv_info->pago_sfv_fecha_ult_pago; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                <?php $total_realizados=$sfv_info->pagos_realizados-1;
                if($total_realizados==-1){
                  $total_realizados=0;
                } ?>
                Pagos realizados/total:<hr><?php echo $total_realizados."/".$sfv_info->pago_sfv_cant_pagos; ?>
              </h6>
            </span>
            <span class="badge badge-info">
              <h6 align="center">
                Comentarios:<hr><?php echo $sfv_info->pago_sfv_coment; ?>
              </h6>
            </span>
          </div>
        </div>
      </div>
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="false">id_lista_pago_sfv</th>
          <th>No. Pago</th>
          <th>Fecha de Pago</th>
          <th>KWh Facturados</th>
          <th>Total Pago</th>
          <th>Subtotal</th>
          <th>Iva</th>
          <th>Comentarios</th>
          <th>Comprobante</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($sfv_lista_pago->result() as $row) {
          ?>
          <tr>
            <td hidden="true" id="<?php echo "id_lista_pago_sfv".$row->id_lista_pago_sfv;?>"><?php echo "".$row->id_lista_pago_sfv.""; ?></td>
            <td id="<?php echo "num_pago".$row->id_lista_pago_sfv;?>"><?php echo "".$row->lista_pago_sfv_num_pago.""; ?></td>
            <td id="<?php echo "fecha".$row->id_lista_pago_sfv;?>"><?php echo "".$row->lista_pago_sfv_fecha.""; ?></td>
            <td id="<?php echo "kwh_facturado".$row->id_lista_pago_sfv;?>"><?php echo "".$row->lista_pago_sfv_kwh_factu.""; ?></td>
            <td id="<?php echo "total_pago".$row->id_lista_pago_sfv;?>">$<?php echo "".$row->lista_pago_sfv_total.""; ?></td>
            <td id="<?php echo "subtotal".$row->id_lista_pago_sfv;?>">$<?php echo "".$row->lista_pago_sfv_sub_total.""; ?></td>
            <td id="<?php echo "iva".$row->id_lista_pago_sfv;?>">$<?php echo "".$row->lista_pago_sfv_iva.""; ?></td>
            <td id="<?php echo "coment".$row->id_lista_pago_sfv;?>"><?php echo "".$row->lista_pago_sfv_coment.""; ?></td>
            <td id="<?php echo "comprobante".$row->id_lista_pago_sfv;?>"><label hidden="true" id="<?php echo "url_".$row->id_lista_pago_sfv;?>"><?php echo base_url().$row->lista_pago_sfv_url_comprobante; ?></label> <a  onclick="ver_comprobante(this.id)" role="button" id="<?php echo $row->id_lista_pago_sfv;?>"><button class="btn btn-outline-secondary" title="Ver comprobante de pago"><img  width="25" src="..\Resources\Icons\frame_gallery_image_images_photo_picture_pictures_icon_123209.ico" style="filter: invert(100%)" /></button></a>
            </td>
            <td>
              <a class="navbar-brand" onclick="EditPay(this.id)" role="button" id="<?php echo $row->id_lista_pago_sfv; ?>"><button class="btn btn-outline-secondary"><img width="25"  src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" title="Editar Pago" style="filter: invert(100%)" /></button></a>
              <a class="navbar-brand" onclick="DeletePay(this.id)" role="button" id="<?php echo $row->id_lista_pago_sfv; ?>"><button class="btn btn-outline-secondary"><img  width="25" src="..\Resources\Icons\delete.ico" title="Eliminar Pago" style="filter: invert(100%)" /></button></a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </tbody>
    </table>
  </div>
</div>


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


<!-- Modal Edit Pay SFV -->
<div class="modal fade" id="EditPayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title" id="title">Editar Pago de SFV<br><label id="title_pago"></label>
          <div style="text-align: center"><label id="title_num_pago" class="bg-warning"></label></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6>
        <input type="text" id="edit_id_lista_pago_sfv" hidden="true">
        <label>Fecha</label><br>
        <input type="date" id="pago_fecha" class="form-control col-md-5">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Total </label>
            <input type="number" min="0" onchange="Calcula()" id="pago_total" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label>SubTotal </label>
            <input type="number" min="0" id="subtotal" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label>IVA </label>
            <input type="number" min="0" id="iva" class="form-control">
          </div>
        </div>
        <label>KWh Totales</label><br>
        <input type="number" min="0" id="kwh_total" class="form-control col-md-4"><br>
        <label>Comprobante de Pago</label><br>
        <!-- Form -->
        <form method='post' enctype="multipart/form-data">
          <input type="file" id="comprobante_sfv" accept="application/pdf, image/*" class="form-control "><br>
        </form>
        <label>Comentarios</label><br>
        <textarea id="coment" maxlength="200" class="form-control input-sm"></textarea>
        </h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Edit_SFV_Pay" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Delete Pay SFV -->
<div class="modal fade" id="DeletePayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger" >
        <h5 class="modal-title" id="title">Eliminar Pago de SFV<br><label id="delete_title_pago"></label>
          <div style="text-align: center"><label id="title_num_pago" class="bg-warning"></label></div></h5>
        <button type="button" class="close" data-dismiss="modal" onclick="limpiar_modal()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modal_body_delete">
        <input type="text" id="delete_id_lista_pago_sfv" hidden="true">
        <h6>
          <label>Fecha</label><span class="badge badge-danger" id="delete_pago_fecha"></span><br>
          <label>Total</label><span class="badge badge-danger" id="delete_pago_total"></span><br>
          <label>SubTotal</label><span class="badge badge-danger" id="delete_subtotal"></span><br>
          <label>IVA</label><span class="badge badge-danger" id="delete_iva"></span><br>
          <label>KWh Totales</label><span class="badge badge-danger" id="delete_kwh_total"></span><br>
          <label>Comentarios</label><span class="badge badge-danger" id="delete_coment"></span><br>
        </h6>
        <h6 class="bg-warning"><p>Al eliminar el pago, será borrada toda la información de este</p></h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiar_modal()" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Delete_SFV_Pay" data-dismiss="modal">Eliminar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_sfv_pay_list').DataTable();

    $('#Edit_SFV_Pay').click(function(){
      var id_lista_pago_sfv=$("#edit_id_lista_pago_sfv").val();
      var fecha=$("#pago_fecha").val();
      var importe_total=<?php echo $sfv_info->pago_sfv_imp_total;?>;
      var id_pago_sfv=<?php echo $sfv_info->id_pago_sfv;?>;
      var pago_total=$("#pago_total").val();
      var subtotal=$("#subtotal").val();
      var iva=$("#iva").val();
      var kwh_total=$("#kwh_total").val();
      var coment=$("#coment").val();
      var datos = new FormData();
      var files = $('#comprobante_sfv')[0].files[0];
      //alert("id_lista pago: "+id_lista_pago_sfv);
      datos.append('file',files);
      datos.append('id_pago_sfv',id_pago_sfv);
      datos.append('id_lista_pago_sfv',id_lista_pago_sfv);    
      datos.append('importe_total',importe_total);
      datos.append('fecha',fecha);
      datos.append('pago_total',pago_total);
      datos.append('subtotal',subtotal);
      datos.append('iva',iva);
      datos.append('kwh_total',kwh_total);
      datos.append('coment',coment);

      //alert("importe total: "+importe_total);
      var errores=[];
      i=0;
      if(fecha==""){
        errores.push("*Ingrese una fecha válida\n");
        i++;
      }
      if(pago_total==0){
        errores.push("*Importe total debe ser mayor a 0\n");
        i++;
      }
      if(subtotal==0){
        errores.push("*SubTotal debe ser mayor a 0\n");
        i++;
      }
      if(iva==0){
        errores.push("*IVA debe ser mayor a 0\n");
        i++;
      }
      var total=parseFloat(iva)+parseFloat(subtotal);
      if(pago_total!=total){
        errores.push("*La suma del SubTotal + IVA no coincide con el Importe Total\n");
        i++;
      }
      if(kwh_total==0){
        errores.push("*KWh Totales debe ser mayor a 0");
        i++;
      }
      if (errores.length==0){
        $.ajax({
          url: '<?php echo base_url();?>Iluminacion/Edit_Pay_SFV',
          type: 'post',
          data: datos,
          contentType: false,
          processData: false,
          success:function(result){
            //alert(result);
            if(result=="ok-ok"){
              alert('Pago Actualizado. Imagen Actualizada');
            }else{
              if(result=="error-ok"){
                alert('Pago Actualizado. Imagen No Actualizada\nFormatos aceptados: jpg, png, jpeg, gif , pdf');
              }else{
                if(result=="ok"){
                  alert('Pago Actualizado. No se adjuntó Imagen');
                }else{
                  alert('Error. Pago no Actualizado. Imagen no Actualizada');
                }                
              }              
            }
          }
        });
        Update();
        Update();
      }else{
        mensaje="";
        for (var i = 0; i < errores.length; i++) {
          mensaje=mensaje+errores[i].toString();
        }
        alert(mensaje);
      }
      Update();  
    });

    $('#Delete_SFV_Pay').click(function(){
      var id_lista_pago_sfv=$("#delete_id_lista_pago_sfv").val();
      var id_pago_sfv=<?php echo $sfv_info->id_pago_sfv;?>;
      var importe_total=<?php echo $sfv_info->pago_sfv_imp_total;?>;
      alert(id_lista_pago_sfv+" id_pagos: "+id_pago_sfv+" total"+importe_total);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/DeletePay_SFV",
        data:{id_lista_pago_sfv:id_lista_pago_sfv, id_pago_sfv:id_pago_sfv, importe_total:importe_total},
        success:function(result){
            alert(result);
            if(result){
              alert('Pago Eliminado');
            }else{
              alert('Falló el servidor. Pago no eliminado');
            }
          }
        });
      Update(); 
    });

  });

    function ver_comprobante($id_lista_pago_sfv){
    var id_lista_pago_sfv=$id_lista_pago_sfv;
    var comprobante=$("#url_"+$id_lista_pago_sfv).text().split(".");
    var url=$("#url_"+$id_lista_pago_sfv).text();
    //alert(comprobante[0]+" "+comprobante[1]);
    if (comprobante[0]=="<?php echo base_url()?>") {
      alert("No se adjuntó comprobante de pago");
    }else{
      $('#ver_comprobanteModal').modal();
        $('#modal-body').append("<embed id='imagen_modal' frameborder='0' width='100%'' height='400px'>");    
      $('#imagen_modal').attr({"src" : url});
    }
  }



  function EditPay($id_lista_pago_sfv){
    var id_lista_pago_sfv=$id_lista_pago_sfv;
    var num_pago=$("#num_pago"+id_lista_pago_sfv).text();
    var fecha=$("#fecha"+id_lista_pago_sfv).text();
    var kwh_facturado=$("#kwh_facturado"+id_lista_pago_sfv).text();
    var total_pago=$("#total_pago"+id_lista_pago_sfv).text().split('$');
    var subtotal=$("#subtotal"+id_lista_pago_sfv).text().split('$');
    var iva=$("#iva"+id_lista_pago_sfv).text().split('$');
    var coment=$("#coment"+id_lista_pago_sfv).text();
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
    $('#EditPayModal').modal();
    $('#title_pago').text("No. de Pago: "+num_pago);
    $('#edit_id_lista_pago_sfv').val(id_lista_pago_sfv);
     $("#pago_fecha").val(fecha);
     $("#kwh_total").val(kwh_facturado);
     $("#pago_total").val(total_pago[1]);
     $("#iva").val(iva[1]);
     $("#subtotal").val(subtotal[1]);
     $("#coment").val(coment);  
  }


  function DeletePay($id_lista_pago_sfv){
    var id_lista_pago_sfv=$id_lista_pago_sfv;
    var num_pago=$("#num_pago"+id_lista_pago_sfv).text();
    var fecha=$("#fecha"+id_lista_pago_sfv).text();
    var kwh_facturado=$("#kwh_facturado"+id_lista_pago_sfv).text();
    var total_pago=$("#total_pago"+id_lista_pago_sfv).text().split('$');
    var subtotal=$("#subtotal"+id_lista_pago_sfv).text().split('$');
    var iva=$("#iva"+id_lista_pago_sfv).text().split('$');
    var coment=$("#coment"+id_lista_pago_sfv).text();
    var comprobante=$("#url_"+$id_lista_pago_sfv).text().split(".");
    var url=$("#url_"+$id_lista_pago_sfv).text();
    var base_url="<?php echo base_url()?>";
    //alert(nombre_prod+" "+cantidad+" "+precio_venta[1]+" "+coment);
    $('#DeletePayModal').modal();
    $('#delete_title_pago').text("No. de Pago: "+num_pago);
    $('#delete_id_lista_pago_sfv').val(id_lista_pago_sfv);
     $("#delete_pago_fecha").text(fecha);
     $("#delete_kwh_total").text(kwh_facturado);
     $("#delete_pago_total").text(total_pago[1]);
     $("#delete_iva").text(iva[1]);
     $("#delete_subtotal").text(subtotal[1]);
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

  }



  function Calcula(){
  var pago_total=$('#pago_total').val();
  var sub=(pago_total*0.84).toFixed(2);
  var iva=(pago_total*0.16).toFixed(2);
  $('#subtotal').val(sub);
  $('#iva').val(iva);
  }

  function Lista_SFV(){
    $("#page_content").load("Pagos_SFV");
  }

  function limpiar_modal(){
    $('#sin_comprobante').remove();
    $('#con_comprobante').remove();
  }

  function Update(){
  $('#btncancelar').click();
  var id_pago_sfv=<?php echo $sfv_info->id_pago_sfv;?>;
  $("#page_content").load("SFV_Pay_List",{id_pago_sfv:id_pago_sfv});
  }



</script>