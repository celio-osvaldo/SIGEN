<!--Mostrar lista de Proyectos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Proyectos</h3>
</div>
<div class="col-3">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#NewClientModal"><img src="<?php echo base_url() ?>Resources/Icons/add_icon.ico">Nuevo Proyecto</button>
 </div>

<div class="row">
    <div class="form-group row">
        <label class="col-md-6">Ver Proyectos</label>
    <div class="col-md-6">
      <select multiple="multiple" class="multiple-select" id="estado_proyecto" placeholder="Seleccione">
          <option value="1">Activo</option>
          <option value="2">Pagado</option>
          <option value="3">Cancelado</option>
      </select>
    </div>
  </div>
</div>

</div>

      <div class="card bg-card"  id="tbl_body">
        
    </div>





    <!-- Modal Add Customer_Project -->
    <div class="modal fade" id="NewClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Agregar Nuevo Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label>Nombre Proyecto</label>
                <input type="text" name="" id="nom_obra" class="form-control input-sm">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="label-control">Cliente</label>
                <select class="form-control" name="customer" id="customer">
                  <option disabled selected>----Seleccionar Cliente----</option>
                  <?php foreach ($customerlist->result() as $row){ ?>
                  <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                  <?php } ?>
            </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label>Importe Total</label>
                <input type="text" onblur="SeparaMiles(this.id)" id="imp_obra" class="form-control input-sm">
              </div>
              <div class=" col-md-6">
                <label class="label-control">Aplicar a Flujo de Efectivo:</label>
                <select class="form-control" id="addflujo" name="addflujo">
                  <option value="1">SI</option>
                  <option value="0">NO</option>
                </select>
              </div>
            </div>        
           <div class="row">
             <div class="col-md-12">
                <label>Comentarios</label>
                <textarea id="coment_obra" class="form-control input-sm" maxlength="200"></textarea>
             </div>
           </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
            <button type="button" class="btn btn-primary" id="guardarnuevo" data-dismiss="modal">Guardar</button>
          </div>
        </div>
      </div>
    </div>



    <!-- Modal Edit Customer_Project -->
    <div class="modal fade" id="EditClientModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modificar Proyecto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <label>Nombre de Proyecto</label>
                <input type="text" name="" id="edit_nom_obra" class="form-control input-sm">
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
               <label class="label-control">Cliente</label>
               <select class="form-control" name="edit_customer" id="edit_customer">
                <?php foreach ($customerlist->result() as $row){ ?>
                  <option value="<?php echo "".$row->id_catalogo_cliente.""; ?>"><?php echo "".$row->catalogo_cliente_empresa.""; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
             <label>Importe Total</label>
             <input type="text" onblur="SeparaMiles(this.id)" id="edit_imp_obra" class="form-control input-sm">
           </div>
           <div class=" col-md-6">
            <label class="label-control">Aplicar a Flujo de Efectivo:</label>
            <select class="form-control" id="edit_addflujo" name="edit_addflujo">
              <option value="1">SI</option>
              <option value="0">NO</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Estado</label><br>   
            <select id="edit_estado_obra">
              <option value="1">Activo</option>
              <option value="2">Pagado</option>
              <option value="3">Cancelado</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label>Comentarios</label>
            <textarea id="edit_coment_obra" class="form-control input-sm" maxlength="200"></textarea>
            <input type="text" id="edit_id_obra" hidden="true">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateRegister" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<!--script para llenar la tabla con la libreria DataTable -->
<script type="text/javascript">
  $(document).ready( function () {
    tabla=$('#table_customer').DataTable();
  } );


    $(function() {
    $('.multiple-select').multipleSelect()
  });


  $(function() {
    $('#estado_proyecto').multipleSelect("checkAll").change(function () {
      sel=document.getElementById("estado_proyecto");
        activo="";
        for (var i = 0; i < sel.options.length; i++) {
                if(sel.options[i].selected==true){
                  activo+=(i+1);
                }else{

                }
              }
          llena_tabla(activo);         
    }).change()
  });

</script>

<!--script Limpiar Ventana Modal Nuevo Cliente/Obra -->
<script type="text/javascript">
  $("#btncancelar").on("click",function(event){ 
    $('#nom_obra').val("");
    $('#imp_obra').val("");
    $('#coment_obra').val("");
  });

//funcion para Guardar nuevo cliente/obra
  $(document).ready(function(){
    $('#guardarnuevo').click(function(){
      nombre=$('#nom_obra').val();
      id_cliente=$('#customer').val();
      //alert(id_cliente);
      importe=$('#imp_obra').val();
      importe=importe.replace(/\,/g, '');
      coment=$('#coment_obra').val();
      addflujo=$('#addflujo').val();

      if (nombre!=""&&importe!=""&&id_cliente!=null) {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Salinas/AddCustomerProject",
          data:{nombre:nombre, id_cliente:id_cliente, importe:importe,coment:coment, addflujo:addflujo},
          success:function(result){
            //alert(result);
            if(result==1){
              alert('Registro Agregado');
             CloseModal();
            }else{
              alert('Falló el servidor. Registro no agregado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Proyecto, Cliente e Importe");
      }
    });

    //Función para actualizar el registro
    $('#UpdateRegister').click(function(){
    act_nom=$("#edit_nom_obra").val();
    act_cliente=$("#edit_customer").val();
    act_imp=$("#edit_imp_obra").val();
    act_imp=act_imp.replace(/\,/g, '');
    //alert(act_imp);
    act_estado=$("#edit_estado_obra").val();
    act_coment=$("#edit_coment_obra").val();
    id=$("#edit_id_obra").val();
    act_addflujo=$("#edit_addflujo").val();
    //alert(act_nom+act_imp+act_estado+act_coment);
      if (act_nom!=""&&act_imp!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Salinas/EditCustomerProject",
          data:{act_nom:act_nom, act_cliente:act_cliente, act_imp:act_imp, act_estado:act_estado, act_coment:act_coment,id:id, act_addflujo:act_addflujo},
          success:function(result){
            //alert(result);
            if(result==1){
              alert('Registro Actualizado');
              CloseModal();
            }else{
              alert('Falló el servidor. Registro no actualizado');
            }
          }
        });
      }else{
        alert("Debe ingresar nombre de Proyecto e Importe Total");
      } 
    });
  });

  function CloseModal(){
    $('#btncancelar').click();
    $('#NewClientModal').modal("hide");
    $('.modal-backdrop').remove();
    $("#page_content").load("CustomerProjects");
  }

//Función para Mostrar Modal de Editar un registro de Cliente/Obra
  function Edit($id){
    //alert("Editar "+$id);
    var nombre=$("#nom_obra"+$id).text();
    var cliente=$("#nom_cliente"+$id).text();
    var importe=$("#imp_obra"+$id).text().split("$");
    importe[1]=importe[1].replace(/\,/g, '');
    var estado=$("#estado_obra"+$id).text();
    var coment=$("#coment_obra"+$id).text();
    var id=$id;
    var editflujo=$("#aplica_flujo"+$id).text().trim();
    if(editflujo==0){
        editflujo="NO";
    }else{
        editflujo="SI";
    }
    $("#EditClientModal").modal();
    $("#edit_nom_obra").val(nombre);
    $("#edit_customer option").removeAttr('selected');
    $("#edit_customer option:contains("+cliente+")").attr('selected', true);
    $("#edit_imp_obra").val(parseFloat(importe[1]));
    $("#edit_estado_obra").val(estado);
    $("#edit_coment_obra").val(coment);
    $("#edit_id_obra").val(id);
    $("#edit_addflujo option").removeAttr('selected');
    $("#edit_addflujo option:contains("+editflujo+")").attr('selected', true);
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

  function llena_tabla($activo) {
   //alert('Ver Detalles');
   var activo=$activo;
   //alert(activo);
   $("#tbl_body").load("Customer_Projects_tbl_body",{activo:activo});                
 }

</script>
