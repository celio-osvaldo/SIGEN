<!--Mostrar lista de SFV -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Pagos SFV</h3>
  </div>
  <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewSFVModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo SFV</button>
  </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_sfv" class="table table-striped table-hover display" style="font-size: 9pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th hidden="true">Id_pago_SFV</th>
          <th>Nombre del Cliente</th>
          <th hidden="true">idcliente</th>
          <th>KWh Totales</th>
          <th>Importe Total</th>
          <th>Total Pagado</th>
          <th>Saldo</th>
          <th>Fecha último pago</th>
          <th>Estado</th>
          <th>Pagos Realizados</th>
          <th hidden="true">Pagos realizados reales</th>
          <th>Total de Pagos</th>
          <th>Comentarios</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($lista_pagos_sfv->result() as $row) {
          $pagos_realizados=$row->pagos_realizados-1;
          if($pagos_realizados==-1){
            $pagos_realizados=0;
          }
         ?>
         <tr>
          <td hidden="true" id="<?php echo "id_pago_sfv".$row->id_pago_sfv;?>"><?php echo "".$row->id_pago_sfv.""; ?></td>
          <td id="<?php echo "nom_cliente".$row->id_pago_sfv;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
          <td hidden="true" id="<?php echo "id_cliente".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_id_cliente.""; ?></td>
          <td id="<?php echo "kwh_totales".$row->id_pago_sfv;?>"><?php echo number_format($row->pago_sfv_kwh,0,'.',',').""; ?></td>
          <td id="<?php echo "imp_total".$row->id_pago_sfv;?>">$<?php echo number_format($row->pago_sfv_imp_total,5,'.',',').""; ?></td>
          <td id="<?php echo "total_pagado".$row->id_pago_sfv;?>">$<?php echo number_format($row->pago_sfv_pagado,5,'.',',').""; ?></td>
          <td id="<?php echo "saldo".$row->id_pago_sfv;?>">$<?php echo number_format($row->pago_sfv_saldo,5,'.',',').""; ?></td>
          <td id="<?php echo "fecha_ult_pago".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_fecha_ult_pago.""; ?></td>
          <td id="<?php echo "estado".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_estado.""; ?></td>
          <td id="<?php echo "pagos_realizados".$row->id_pago_sfv;?>"><?php echo "".$pagos_realizados.""; ?></td>
          <td hidden="true" id="<?php echo "pagos_realizados_real".$row->id_pago_sfv;?>"><?php echo "".$row->pagos_realizados.""; ?></td>
          <td id="<?php echo "total_pagos".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_cant_pagos.""; ?></td>
          <td id="<?php echo "coment".$row->id_pago_sfv;?>"><?php echo "".$row->pago_sfv_coment.""; ?></td>
          <td>
            <div class="row">
              <a class="btn btn-outline-secondary" title="Agregar Pago" onclick="Add_Pago(this.id)" role="button" id="<?php echo $row->id_pago_sfv; ?>"><img src="..\Resources\Icons\addbuttonwithplussigninacircle_79538.ico" width="20px" style="filter: invert(100%)"></a>
              <a class="btn btn-outline-secondary" title="Ver detalles de Pagos" onclick="Pago_SFV_Details(this.id)" role="button" id="<?php echo $row->id_pago_sfv; ?>"><img src="..\Resources\Icons\lupa.ico" width="20px" alt="Detalles" style="filter: invert(100%)"></a>
              <a class="btn btn-outline-secondary" title="Editar Registro" onclick="EditRecibo(this.id)" role="button" id="<?php echo $row->id_pago_sfv; ?>"><img width="20px" src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" style="filter: invert(100%)" /></a>
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

<!-- Modal New SFV -->
<div class="modal fade" id="NewSFVModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nuevo SFV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Cliente</label>
            <select class="form-control" id="new_cliente">
              <option disabled selected>----Seleccionar Cliente----</option>
              <?php foreach ($catalogo_cliente->result() as $row){ ?>
                <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="row">
          <div  class="col-md-5">
            <label class="label-control">KWh Totales</label>
             <input type="number" min="0" id="new_kwh" class="form-control">
          </div>
          <div class="col-md-5">
             <label class="label-control">Total de Pagos</label>
            <input type="number" min="1" id="new_cant_pagos" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="label-control">Importe Total</label>
            <input type="text" onblur="Separa_Miles(this.id)" id="new_imp_total" class="form-control">
          </div>
        </div>        
        <label>Comentarios</label><br>
        <textarea id="new_coment" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewSFV" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Add Pay SFV -->
<div class="modal fade" id="Add_PayModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" >
        <h5 class="modal-title" id="title">Agregar Pago de SFV<label id="title_pago"></label><br>
          <div style="text-align: center"><label id="title_num_pago" class="bg-warning"></label></div></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="id_pago_sfv" hidden="true">
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">Fecha</label>
            <input type="date" id="pago_fecha" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="label-control">Total </label>
            <input type="text" value="0.00" onblur="Separa_Miles(this.id)" onchange="Calcula()" id="pago_total" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="label-control">SubTotal </label>
            <input type="text" value="0.00" onblur="Separa_Miles(this.id)" id="subtotal" class="form-control">
          </div>
          <div class="col-md-3">
            <label class="label-control">IVA </label>
            <input type="text" value="0.00" onblur="Separa_Miles(this.id)" min="0" id="iva" class="form-control">
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <label class="label-control">KWh Totales</label>
            <input type="number" min="0" value="0" id="kwh_total" class="form-control">
          </div>
          <div class="col-md-8">
            <label class="label-control">Comprobante de Pago</label>
            <!-- Form -->
            <form method='post' enctype="multipart/form-data">
              <input type="file" id="comprobante_sfv" accept="application/pdf, image/*" class="form-control ">
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Comentarios</label>
            <textarea id="coment" maxlength="200" class="form-control input-sm"></textarea>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="Add_SFV_Pay" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div> 

<!-- Modal Edit SFV -->
<div class="modal fade" id="EditRegistroModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar SFV</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="text" id="edit_id_pago_sfv" hidden="true">
        <label>Cliente</label>
        <select class="form-control" id="edit_cliente">
          <option disabled selected>----Seleccionar Cliente----</option>
          <?php foreach ($catalogo_cliente->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
          <?php } ?>
        </select>
        <div class="row">
          <div class="col-md-5">
             <label class="label-control">KWh Totales</label>  
             <input type="number" min="0" id="edit_kwh" class="form-control">
          </div>
          <div class=" col-md-5">
            <label class="label-control">Total de Pagos</label>
            <input type="number" min="1" id="edit_cant_pagos" class="form-control">
          </div>
        </div>

        <div class="row">
          <div class="col-md-5">
            <label class="label-control">Importe Total</label>
            <input type="text" onblur="Separa_Miles(this.id)" id="edit_imp_total" class="form-control ">
          </div>
          <div class=" col-md-5">
            <label class="label-control">Estado</label>
           <select id="edit_estado" class="form-control">
            <option value="Activo">Activo</option>
            <option value="Pagado">Pagado</option>
            <option value="Cancelado">Cancelado</option>
          </select>
        </div>
        </div>

       
        
        
       
        <label>Comentarios</label><br>
        <textarea id="edit_coment" maxlength="150" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateSFV" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){
    $('#table_sfv').DataTable({
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

    $('#NewSFV').click(function(){
      cliente=$('#new_cliente').val();
      kwh=$('#new_kwh').val();
      cant_pagos=$('#new_cant_pagos').val();
      imp_total=$('#new_imp_total').val();
      imp_total=imp_total.replace(/\,/g, '');
      coment=$('#new_coment').val();
      //alert(cliente+kwh+cant_pagos+imp_total+coment);
      if (cliente!=null) {
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/NewSFV",
          data:{cliente:cliente, kwh:kwh, cant_pagos:cant_pagos, imp_total:imp_total, coment:coment},
          success:function(result){
              //alert(result);
              if(result){
                alert('Nuevo SFV Agregado');
              }else{
                alert('Falló el servidor. Nuevo SFV no Agregado');
              }
              Update();
            }
          });
      }else{
        alert("Debe indicar un cliente");
      }

    });

    $('#UpdateSFV').click(function(){
      id_pago_sfv=$('#edit_id_pago_sfv').val();
      cliente=$('#edit_cliente').val();
      kwh=$('#edit_kwh').val();
      cant_pagos=$('#edit_cant_pagos').val();
      imp_total=$('#edit_imp_total').val();
      imp_total=imp_total.replace(/\,/g, '');
      coment=$('#edit_coment').val();
      estado=$('#edit_estado').val();
      //alert(cliente+kwh+cant_pagos+imp_total+coment);
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/UpdateSFV",
        data:{cliente:cliente, kwh:kwh, cant_pagos:cant_pagos, imp_total:imp_total,estado:estado, coment:coment, id_pago_sfv:id_pago_sfv},
        success:function(result){
            //alert(result);
            if(result){
              alert('Registro SFV Actualizado');
            }else{
              alert('Falló el servidor. Registro SFV no Actualizado');
            }
            Update();
          }
        });
    });


    $('#Add_SFV_Pay').click(function(){
      var id_pago_sfv=$("#id_pago_sfv").val();
      var num_pago=$("#title_num_pago").text().split(': ');
      var fecha=$("#pago_fecha").val();
      var importe_total=$("#imp_total"+id_pago_sfv).text().split('$');
      importe_total[1]=importe_total[1].replace(/\,/g, '');
      var pago_total=$("#pago_total").val();
      pago_total=pago_total.replace(/\,/g, '');
      //alert(pago_total);
      var subtotal=$("#subtotal").val();
      subtotal=subtotal.replace(/\,/g, '');
      var iva=$("#iva").val();
      iva=iva.replace(/\,/g, '');
      var kwh_total=$("#kwh_total").val();
      //kwh_total=kwh_total.replace(/\,/g, '');
      var coment=$("#coment").val();
      var datos = new FormData();
      var files = $('#comprobante_sfv')[0].files[0];
      datos.append('file',files);
      datos.append('id_pago_sfv',id_pago_sfv);
      if(num_pago[1]){
         datos.append('num_pago',num_pago[1]);
      }else{
         datos.append('num_pago',num_pago[0]);
      }     
      datos.append('importe_total',importe_total[1]);
      datos.append('fecha',fecha);
      datos.append('pago_total',pago_total);
      datos.append('subtotal',subtotal);
      datos.append('iva',iva);
      datos.append('kwh_total',kwh_total);
      datos.append('coment',coment);

      //alert("importe total: "+importe_total[1]);
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
          url: '<?php echo base_url();?>Iluminacion/Add_Pay_SFV',
          type: 'post',
          data: datos,
          contentType: false,
          processData: false,
          success:function(result){
            //alert(result);
            if(result=="ok-ok"){
              alert('Pago agregado. Imagen Guardada');
            }else{
              if(result=="error-ok"){
                alert('Pago agregado. Imagen No guardada\nFormatos aceptados: jpg, png, jpeg, gif , pdf');
              }else{
                if(result=="ok"){
                  alert('Pago Agregado. No se adjuntó Imagen');
                }else{
                  alert('Error. Pago no agregado. Imagen no guardada');
                }                
              }              
            }
          }
        });
        Update();
      }else{
        mensaje="";
        for (var i = 0; i < errores.length; i++) {
          mensaje=mensaje+errores[i].toString();
        }
        alert(mensaje);
        $('Add_PayModal').removeClass('modal-open');
        $('.modal-backdrop').remove();
      }
      Update();  
    });


  });

function Add_Pago($id_pago_sfv){
  var id_pago_sfv=$id_pago_sfv;
  var nom_cliente=$("#nom_cliente"+id_pago_sfv).text();
  var num_pago=$("#pagos_realizados_real"+id_pago_sfv).text();
  $('#Add_PayModal').modal();
  $("#id_pago_sfv").val(id_pago_sfv); 
  $("#title_pago").text("Cliente: "+nom_cliente);  
  if(num_pago==0){
    $("#title_num_pago").text("ENGANCHE");
  }else{
    $("#title_num_pago").text("Número de Pago: "+num_pago);  
  }
}

function Calcula(){
  var pago_total=$('#pago_total').val();
  pago_total=pago_total.replace(/\,/g, '');
  var sub=(pago_total*0.84).toFixed(2);
  var iva=(pago_total*0.16).toFixed(2);
  sub=sub.toLocaleString("en");
  //alert(sub+" "+iva);
  $("#subtotal").val(parseFloat(sub.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  iva=iva.toLocaleString("en");
  $("#iva").val(parseFloat(iva.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
}

function EditRecibo($id_pago_sfv){
  var id_pago_sfv=$id_pago_sfv;
  nom_cliente=$("#nom_cliente"+id_pago_sfv).text();
  id_cliente=$("#id_cliente"+id_pago_sfv).text();
  kwh_totales=$("#kwh_totales"+id_pago_sfv).text().replace(/\,/g, '');
  imp_total=$("#imp_total"+id_pago_sfv).text().split('$');
  total_pagado=$("#total_pagado"+id_pago_sfv).text().split('$');
  saldo=$("#saldo"+id_pago_sfv).text().split('$');
  fecha_ult_pago=$("#fecha_ult_pago"+id_pago_sfv).text();
  estado=$("#estado"+id_pago_sfv).text();
  pagos_realizados=$("#pagos_realizados"+id_pago_sfv).text();
  total_pagos=$("#total_pagos"+id_pago_sfv).text();
  coment=$("#coment"+id_pago_sfv).text();

  $('#EditRegistroModal').modal();
  $('#edit_cliente').val(id_cliente).attr('selected', true);
  $('#edit_kwh').val(kwh_totales);
  $('#edit_cant_pagos').val(total_pagos);
  $('#edit_imp_total').val(imp_total[1]);
  $('#edit_coment').val(coment);
  $('#edit_estado').val(estado).attr('selected',true);
  $('#edit_id_pago_sfv').val(id_pago_sfv);

}

function Pago_SFV_Details($id_pago_sfv){
  var id_pago_sfv=$id_pago_sfv;
  $("#page_content").load("SFV_Pay_List",{id_pago_sfv:id_pago_sfv});
}


function Update(){
  $('#btncancelar').click();
  $("#page_content").load("Pagos_SFV");
}





</script>