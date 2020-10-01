<!--Mostrar lista de pagos de Proyectos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Pagos a Proyectos</h3>
  </div>
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




<div class="card bg-card" id="tbl_body"> 

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
$(document).ready(function() {
    $('#table_customer').DataTable();
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

  function llena_tabla($activo) {
   //alert('Ver Detalles');
   var activo=$activo;
   //alert(activo);
   $("#tbl_body").load("customer_payments_tbl_body",{activo:activo});                
 }

</script>


