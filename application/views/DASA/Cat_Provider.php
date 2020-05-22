<!--Mostrar lista de Proveedores -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Catálogo de Proveedores</h3>
  </div>
    <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewProviderModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Proveedor</button>
  </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_provider" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Editar</th>
          <th>Nombre Fiscal</th>
          <th>Giro</th>
          <th hidden="true">id_giro_proveedor</th>
          <th>RFC</th>
          <th>Contactos</th>
          <th>Puestos</th>
          <th>Telefonos</th>
          <th>Celular</th>
          <th>Email</th>
          <th>Comentarios</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($catalogo_proveedor->result() as $row) {
         ?>
         <tr>
          <td><a class="navbar-brand" href="#" onclick="EditProvider(this.id)" role="button" id="<?php echo $row->id_catalogo_proveedor; ?>">
            <button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
            </button>
          </a></td>
           <td id="<?php echo "nom_fiscal".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_nom_fiscal.""; ?></td>
           <td id="<?php echo "giro".$row->id_catalogo_proveedor;?>"><?php echo "".$row->nombre_giro.""; ?></td>
           <td hidden="true" id="<?php echo "id_giro_proveedor".$row->catalogo_proveedor_id_giro;?>"><?php echo "".$row->catalogo_proveedor_id_giro.""; ?></td>
           <td id="<?php echo "rfc".$row->id_catalogo_proveedor;?>"><?php echo "".$row->rfc.""; ?></td>
           <td id="<?php echo "contactos".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_contacto1 ?><hr><?php echo "*". $row->catalogo_proveedor_contacto2; ?></td>
           <td id="<?php echo "puestos".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_puesto1?><hr><?php echo "*".$row->catalogo_proveedor_puesto2; ?></td>
           <td id="<?php echo "tels".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_tel1 ?><hr><?php echo "*".$row->catalogo_proveedor_tel2; ?></td>
           <td id="<?php echo "cels".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_cel1 ?><hr><?php echo "*".$row->catalogo_proveedor_cel2; ?></td>
           <td id="<?php echo "emails".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_email1 ?><hr><?php echo "*".$row->catalogo_proveedor_email2; ?></td>
           <td id="<?php echo "coment".$row->id_catalogo_proveedor;?>"><?php echo "".$row->catalogo_proveedor_coment; ?></td>

         </tr>
         <?php 
       }
       ?>
     </tbody>
   </table>
 </div>
</div>

<!-- Modal New Provider -->
<div class="modal fade" id="NewProviderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre Fiscal</label>
        <input type="text" id="new_nom_fiscal" class="form-control input-sm">
        <label>Nombre Comercial</label>
        <input type="text" id="new_nom_comer" class="form-control input-sm">
        <label>RFC</label><br>   
        <input type="text" maxlength="13" id="new_rfc" class="form-control input-sm"><br>
        <label>Giro</label>
        <select class="form-control" type="text" name="new_giro" id="new_giro" required="true">
          <option selected>Seleccionar Giro</option>
          <?php foreach ($catalogo_giro->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_giro.""; ?>"><?php echo "".$row->nombre_giro.""; ?></option>
          <?php } ?>
        </select>
        <label>Contacto 1</label><br>
        <input type="text" id="new_cont1" class="form-control input-sm"><br>
        <label>Puesto 1</label><br>
        <input type="text" id="new_puesto1" class="form-control input-sm"><br>
        <label>Teléfono 1</label><br>
        <input type="text" id="new_tel1" class="form-control input-sm"><br>
        <label>Celular 1</label><br>
        <input type="text" id="new_cel1" class="form-control input-sm"><br>
        <label>Email 1</label><br>
        <input type="email" id="new_email1" class="form-control input-sm" required="true"><br>
        <label>Contacto 2</label><br>
        <input type="text" id="new_cont2" class="form-control input-sm"><br>
        <label>Puesto 2</label><br>
        <input type="text" id="new_puesto2" class="form-control input-sm"><br>
        <label>Teléfono 2</label><br>
        <input type="text" id="new_tel2" class="form-control input-sm"><br>
        <label>Celular 2</label><br>
        <input type="text" id="new_cel2" class="form-control input-sm"><br>
        <label>Email 2</label><br>
        <input type="email" id="new_email2" class="form-control input-sm"><br>
        <label>Comentarios</label><br>
        <textarea id="new_coment" maxlength="200" class="form-control input-sm"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="NewProvider" data-dismiss="modal">Agregar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Provider -->
<div class="modal fade" id="EditProviderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre Fiscal</label>
        <input type="text" id="edit_nom_fiscal" class="form-control input-sm">
        <label>Giro</label>
        <select class="form-control" type="text" name="edit_id_giro" id="edit_id_giro" required="true">
          <option selected>Seleccionar Giro</option>
          <?php foreach ($catalogo_giro->result() as $row){ ?>
            <option value="<?php echo "".$row->id_catalogo_giro.""; ?>"><?php echo "".$row->nombre_giro.""; ?></option>
          <?php } ?>
        </select>
        <label>RFC</label><br>   
        <input type="text" maxlength="13" id="edit_rfc" class="form-control input-sm"><br>
        <label>Contacto 1</label><br>
        <input type="text" id="edit_cont1" class="form-control input-sm"><br>
        <label>Puesto 1</label><br>
        <input type="text" id="edit_puesto1" class="form-control input-sm"><br>
        <label>Teléfono 1</label><br>
        <input type="text" id="edit_tel1" class="form-control input-sm"><br>
        <label>Celular 1</label><br>
        <input type="text" id="edit_cel1" class="form-control input-sm"><br>
        <label>Email 1</label><br>
        <input type="email" id="edit_email1" class="form-control input-sm" required="true"><br>
        <label>Contacto 2</label><br>
        <input type="text" id="edit_cont2" class="form-control input-sm"><br>
        <label>Puesto 2</label><br>
        <input type="text" id="edit_puesto2" class="form-control input-sm"><br>
        <label>Teléfono 2</label><br>
        <input type="text" id="edit_tel2" class="form-control input-sm"><br>
        <label>Celular 2</label><br>
        <input type="text" id="edit_cel2" class="form-control input-sm"><br>
        <label>Email 2</label><br>
        <input type="email" id="edit_email2" class="form-control input-sm"><br>
        <label>Comentarios</label><br>
        <textarea id="edit_coment" maxlength="200" class="form-control input-sm"></textarea>
        <input type="text" id="edit_id_provider" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateProvider" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  $(document).ready( function () {
    $('#table_provider').DataTable();

    $('#UpdateProvider').click(function(){
      nom_fiscal=$("#edit_nom_fiscal").val();
      id_giro_proveedor=$("#edit_id_giro").val();
      rfc=$("#edit_rfc").val();
      cont1=$("#edit_cont1").val();
      puesto1=$("#edit_puesto1").val();
      tel1=$("#edit_tel1").val();
      cel1=$("#edit_cel1").val();
      email1=$("#edit_email1").val();
      cont2=$("#edit_cont2").val();
      puesto2=$("#edit_puesto2").val();
      tel2=$("#edit_tel2").val();
      cel2=$("#edit_cel2").val();
      email2=$("#edit_email2").val();
      coment=$("#edit_coment").val();
      id_cat=$("#edit_id_provider").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_fiscal!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Dasa/UpdateProvider",
          data:{nom_fiscal:nom_fiscal, id_giro_proveedor:id_giro_proveedor, rfc:rfc,cont1:cont1, puesto1:puesto1, tel1:tel1,cel1:cel1, email1:email1, cont2:cont2, puesto2:puesto2, tel2:tel2, cel2:cel2, email2:email2, coment:coment,id_cat:id_cat},
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
        alert("Debe ingresar nombre de Proveedor");
      }
    });

    $('#NewProvider').click(function(){
      nom_fiscal=$("#new_nom_fiscal").val();
      nom_comer=$("#new_nom_comer").val();
      rfc=$("#new_rfc").val();
      giro=$("#new_giro").val();
      cont1=$("#new_cont1").val();
      puesto1=$("#new_puesto1").val();
      tel1=$("#new_tel1").val();
      cel1=$("#new_cel1").val();
      email1=$("#new_email1").val();
      cont2=$("#new_cont2").val();
      puesto2=$("#new_puesto2").val();
      tel2=$("#new_tel2").val();
      cel2=$("#new_cel2").val();
      email2=$("#new_email2").val();
      coment=$("#new_coment").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_fiscal!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Dasa/NewProvider",
          data:{nom_fiscal:nom_fiscal, nom_comer:nom_comer, rfc:rfc, giro:giro, cont1:cont1, puesto1:puesto1, tel1:tel1,cel1:cel1, email1:email1, cont2:cont2, puesto2:puesto2, tel2:tel2, cel2:cel2,email2:email2,coment:coment},
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
        alert("Debe ingresar nombre de Proveedor");
      }
    });

  });
</script>

<script type="text/javascript">
  //Función para Mostrar Modal de Editar un registro de Cliente/Obra
  function EditProvider($id_catalogo_proveedor){
    //alert("Editar "+$id_catalogo_proveedor);
    var id_cat=$id_catalogo_proveedor;
    var nom_fiscal=$('#nom_fiscal'+id_cat).text();
    var giro=$('#giro'+id_cat).text();
    var id_giro_proveedor=$('#id_giro_proveedor').text();
    var rfc=$('#rfc'+id_cat).text();
    var contactos = $('#contactos'+id_cat).text().split("*");
    var puestos=$('#puestos'+id_cat).text().split("*");
    var tels=$('#tels'+id_cat).text().split("*");
    var cels=$('#cels'+id_cat).text().split("*");
    var emails=$('#emails'+id_cat).text().split("*");
    var coment=$('#coment'+id_cat).text();
    $("#EditProviderModal").modal();
    $("#edit_nom_fiscal").val(nom_fiscal);
    $("#edit_id_giro option:contains("+giro+")").attr('selected', true);
    $("#edit_rfc").val(rfc);
    $("#edit_cont1").val(contactos[0]);
    $("#edit_puesto1").val(puestos[0]);
    $("#edit_tel1").val(tels[0]);
    $("#edit_cel1").val(cels[0]);
    $("#edit_email1").val(emails[0]);
    $("#edit_cont2").val(contactos[1]);
    $("#edit_puesto2").val(puestos[1]);
    $("#edit_tel2").val(tels[1]);
    $("#edit_cel2").val(cels[1]);
    $("#edit_email2").val(emails[1]);
    $("#edit_coment").val(coment);
    $("#edit_id_provider").val(id_cat);
    }

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("Catalogo_Proveedor");
  }

</script>