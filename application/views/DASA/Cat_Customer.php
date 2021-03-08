<!--Mostrar lista de Clientes -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Catálogo de Clientes</h3>
  </div>
    <div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewCustomerModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Cliente</button>
  </div>
</div>


<div class="card bg-card">
  <div class="table-responsive">
    <table id="table_customer" class="table table-striped table-hover display" style="font-size: 10pt;">
      <thead class="bg-primary" style="color: #FFFFFF;" align="center">
        <tr>
          <th>Editar</th>
          <th>Nombre Fiscal</th>
          <th>Cliente</th>
          <th>RFC</th>
          <th>Contactos</th>
          <th>Puestos</th>
          <th> Telefonos</th>
          <th>Celular</th>
          <th>Email</th>
          <th>Comentarios</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($catalogo_cliente->result() as $row) {
         ?>
         <tr>
          <td><a class="navbar-brand" href="#" onclick="EditCustomer(this.id)" role="button" id="<?php echo $row->id_catalogo_cliente; ?>">
            <button class="btn btn-outline-secondary"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" />
            </button>
          </a></td>
           <td id="<?php echo "nom_fiscal".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_nom_fiscal.""; ?></td>
           <td id="<?php echo "cliente".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></td>
           <td id="<?php echo "rfc".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_rfc.""; ?></td>
           <td id="<?php echo "contactos".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_contacto1 ?><hr><?php echo "*". $row->catalogo_cliente_contacto2; ?></td>
           <td id="<?php echo "puestos".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_puesto1?><hr><?php echo "*".$row->catalogo_cliente_puesto2; ?></td>
           <td id="<?php echo "tels".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_tel1 ?><hr><?php echo "*".$row->catalogo_cliente_tel2; ?></td>
           <td id="<?php echo "cels".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_cel1 ?><hr><?php echo "*".$row->catalogo_cliente_cel2; ?></td>
           <td id="<?php echo "emails".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_email1 ?><hr><?php echo "*".$row->catalogo_cliente_email2; ?></td>
           <td id="<?php echo "coment".$row->id_catalogo_cliente;?>"><?php echo "".$row->catalogo_cliente_coment; ?></td>

         </tr>
         <?php 
       }
       ?>
     </tbody>
   </table>
 </div>
</div>

<!-- Modal New Customer -->
<div class="modal fade" id="NewCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre Fiscal</label>
        <input type="text" id="new_nom_fiscal" class="form-control input-sm">
        <label>Nombre Cliente</label>
        <input type="text" id="new_nom_comer" class="form-control input-sm">
        <label>RFC</label><br>   
        <input type="text" maxlength="13" id="new_rfc" class="form-control input-sm"><br>
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
        <button type="button" class="btn btn-primary" id="NewCustomer" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Customer -->
<div class="modal fade" id="EditCustomerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modificar Cliente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Nombre Fiscal</label>
        <input type="text" id="edit_nom_fiscal" class="form-control input-sm">
        <label>Nombre Cliente</label>
        <input type="text" id="edit_nom_customer" class="form-control input-sm">
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
        <input type="text" id="edit_id_customer" hidden="true">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateCustomer" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>




<script type="text/javascript">
  $(document).ready( function () {
    $('#table_customer').DataTable({
      dom: 'Blfrtip',
      buttons: [ 
        {
            extend: 'excel',
            title: 'Catálogo Clientes\n Empresa: DASA',
            exportOptions: {
                modifier: {
                    
                },
            },
            header: true,
            footer: true
        },
        {
            extend: 'pdf',
            title: 'Catálogo Clientes\n Empresa: DASA',
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
              title: 'Catálogo Clientes\n Empresa: DASA',
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

    $('#UpdateCustomer').click(function(){
      nom_fiscal=$("#edit_nom_fiscal").val();
      nom_comer=$("#edit_nom_customer").val();
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
      id_cat=$("#edit_id_customer").val();
      //alert(nom_fiscal+nom_comer+rfc+cont1+puesto1+tel1+cel1+email1+cont2+puesto2+tel2+cel2+email2+coment);
      if (nom_fiscal!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Dasa/UpdateCustomer",
          data:{nom_fiscal:nom_fiscal, nom_comer:nom_comer, rfc:rfc,cont1:cont1, puesto1:puesto1, tel1:tel1,cel1:cel1, email1:email1, cont2:cont2, puesto2:puesto2, tel2:tel2, cel2:cel2, email2:email2, coment:coment,id_cat:id_cat},
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
        alert("Debe ingresar nombre de Cliente");
      }
    });

    $('#NewCustomer').click(function(){
      nom_fiscal=$("#new_nom_fiscal").val();
      nom_comer=$("#new_nom_comer").val();
      rfc=$("#new_rfc").val();
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
          url:"<?php echo base_url();?>Dasa/NewCustomer",
          data:{nom_fiscal:nom_fiscal, nom_comer:nom_comer, rfc:rfc,cont1:cont1, puesto1:puesto1, tel1:tel1,cel1:cel1, email1:email1, cont2:cont2, puesto2:puesto2, tel2:tel2, cel2:cel2,email2:email2,coment:coment},
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
  function EditCustomer($id_catalogo_cliente){
    //alert("Editar "+$id_catalogo_proveedor);
    var id_cat=$id_catalogo_cliente;
    var nom_fiscal=$('#nom_fiscal'+id_cat).text();
    var nom_comer=$('#cliente'+id_cat).text();
    var rfc=$('#rfc'+id_cat).text();
    var contactos = $('#contactos'+id_cat).text().split("*");
    var puestos=$('#puestos'+id_cat).text().split("*");
    var tels=$('#tels'+id_cat).text().split("*");
    var cels=$('#cels'+id_cat).text().split("*");
    var emails=$('#emails'+id_cat).text().split("*");
    var coment=$('#coment'+id_cat).text();
    $("#EditCustomerModal").modal();
    $("#edit_nom_fiscal").val(nom_fiscal);
    $("#edit_nom_customer").val(nom_comer);
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
    $("#edit_id_customer").val(id_cat);
    }

  function Update(){
    $('#btncancelar').click();
    $("#page_content").load("Catalogo_Cliente");
  }

</script>