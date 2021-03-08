<!--Mostrar lista de Cotizantes -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Catálogo de Cotizantes</h3>
  </div>
    <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewCotizanteModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Cotizante</button>
  </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_cotizante" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Editar</th>
          <th>Nombre</th>
          <th>Empresa</th>
          <th>Telefono</th>
          <th>Email</th>
          <th>Comentarios</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($catalogo_cotizante->result() as $row) {
         ?>
         <tr>
          <td><a class="navbar-brand" href="#" onclick="EditCotizante(this.id)" role="button" id="<?php echo $row->id_catalogo_cotizante; ?>">
            <button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
            </button>
          </a></td>
           <td id="<?php echo "nombre".$row->id_catalogo_cotizante;?>"><?php echo "".$row->catalogo_cotizante_nombre.""; ?></td>
           <td id="<?php echo "empresa".$row->id_catalogo_cotizante;?>"><?php echo "".$row->catalogo_cotizante_empresa.""; ?></td>
           <td id="<?php echo "tel".$row->id_catalogo_cotizante;?>"><?php echo "".$row->catalogo_cotizante_tel ?></td>
           <td id="<?php echo "mail".$row->id_catalogo_cotizante;?>"><?php echo "".$row->catalogo_cotizante_mail?></td>
           <td id="<?php echo "coment".$row->id_catalogo_cotizante;?>"><?php echo "".$row->catalogo_cotizante_coment.""; ?></td>
         </tr>
         <?php 
       }
       ?>
     </tbody>
   </table>
 </div>
</div>

<!-- Modal New Cotizante -->
<div class="modal fade" id="NewCotizanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cotizante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre del Cotizante</label>
        <input type="text" id="new_nom_cotizante" class="form-control input-sm">
        <label>Empresa</label><br>   
        <input type="text" maxlength="200" id="new_empresa" class="form-control input-sm"><br>
        <label>Teléfono</label><br>
        <input type="text" id="new_tel" class="form-control col-4"><br>
        <label>Email</label><br>
        <input type="email" id="new_email" class="form-control input-sm" required="true"><br>
        <label>Comentarios</label><br>
        <textarea id="new_coment" maxlength="200" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewCotizante" data-dismiss="modal">Agregar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Cotizante -->
<div class="modal fade" id="EditCotizanteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre del Cotizante</label>
        <input type="text" id="edit_nom_cotizante" class="form-control input-sm">
        <label>Empresa</label><br>   
        <input type="text" maxlength="13" id="edit_empresa" class="form-control input-sm"><br>
        <label>Teléfono</label><br>
        <input type="text" id="edit_tel" class="form-control col-4"><br>
        <label>Email</label><br>
        <input type="email" id="edit_email" class="form-control input-sm" required="true"><br>
        <label>Comentarios</label><br>
        <textarea id="edit_coment" maxlength="200" class="form-control input-sm"></textarea>
        <input type="text" id="edit_id_cotizante" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateCotizante" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  $(document).ready( function () {
    $('#table_cotizante').DataTable({
      dom: 'Blfrtip',
      buttons: [ 
        {
            extend: 'excel',
            title: 'Catálogo de Cotizantes\n Empresa: Iluminación',
            exportOptions: {
                modifier: {
                    
                },
            },
            header: true,
            footer: true
        },
        {
            extend: 'pdf',
            title: 'Catálogo de Cotizantes\n Empresa: Iluminación',
            orientation: 'landscape',
            pageSize: 'LETTER',
            exportOptions: {
                modifier: {
                    
                }
            },
            header: true,
            footer: true
        },

                {
            extend: 'copy',
           title: 'Catálogo de Cotizantes\n Empresa: Iluminación',
            orientation: 'landscape',
            pageSize: 'LETTER',
            exportOptions: {
                modifier: {
                }
            },
            header: true,
            footer: true
        }]
    });

    $('#UpdateCotizante').click(function(){
      nom_cotizante=$("#edit_nom_cotizante").val();
      empresa=$("#edit_empresa").val();
      tel=$("#edit_tel").val();
      email=$("#edit_email").val();
      coment=$("#edit_coment").val();
      id_cot=$("#edit_id_cotizante").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_cotizante!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/UpdateCotizante",
          data:{nom_cotizante:nom_cotizante, empresa:empresa, tel:tel, email:email, coment:coment, id_cot:id_cot},
          success:function(result){
            //alert(result);
            if(result){
              alert('Registro Actualizado');
             Update();
            }else{
              alert('Falló el servidor. Registro no Actualizado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Cotizante");
      }
    });

    $('#NewCotizante').click(function(){
      nom_cotizante=$("#new_nom_cotizante").val();
      empresa=$("#new_empresa").val();
      tel=$("#new_tel").val();
      email=$("#new_email").val();
      coment=$("#new_coment").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_cotizante!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Iluminacion/NewCotizante",
          data:{nom_cotizante:nom_cotizante, empresa:empresa, tel:tel, email:email, coment:coment},
          success:function(result){
            //alert(result);
            if(result){
              alert('Registro Agregado');
             Update();
            }else{
              alert('Falló el servidor. Registro no Agregado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Cliente");
      }
    });

  });
</script>

<script type="text/javascript">
  //Función para Mostrar Modal de Editar un registro de Cliente/Obra
  function EditCotizante($id_catalogo_cotizante){
    //alert("Editar "+$id_catalogo_proveedor);
    var id_cot=$id_catalogo_cotizante;
    var nom_cotizante=$('#nombre'+id_cot).text();
    var empresa=$('#empresa'+id_cot).text();
    var tel=$('#tel'+id_cot).text();
    var email=$('#mail'+id_cot).text();
    var coment=$('#coment'+id_cot).text();
    $("#EditCotizanteModal").modal();
    $("#edit_nom_cotizante").val(nom_cotizante);
    $("#edit_empresa").val(empresa);
    $("#edit_tel").val(tel);
    $("#edit_email").val(email);
    $("#edit_coment").val(coment);
    $("#edit_id_cotizante").val(id_cot);
    }

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("Catalogo_Cotizante");
  }

</script>