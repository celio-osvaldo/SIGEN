<!--Mostrar lista de pagos de Eventos -->

<div class="row">
  <div class="col-9">
    <h3 align="center">Lista de Pagos a Eventos</h3>
  </div>
</div>

<div class="row">
    <div class="form-group row">
        <label class="col-md-6">Ver Eventos</label>
    <div class="col-md-6">
      <select multiple="multiple" class="multiple-select" id="estado_proyecto" placeholder="Seleccione">
          <option value="1" selected="true">Activo</option>
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
        <h5 class="modal-title" >Registrar Pago a Evento: <input class="sinborde" size="40" type="text" readonly="true" id="Obra_nombre" style="background-color: silver"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-3">
            <label class="label-control">#Recibo</label>
            <input type="text" name="no_recibo" id="no_recibo" class="form-control">
          </div>
          <div class="col-md-4">
            <label class="label-control">Cantidad de Pago</label>
            <input type="text" onblur="SeparaMiles(this.id)" name="" id="pago_obra" class="form-control input-sm" required="true">
          </div>
          <div class="col-md-5">
            <label class="label-control">Fecha de Pago</label>
            <input type="date" id="fecha_pago" class="form-control input-sm" required="true">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Concepto del Pago</label>
            <textarea id="coment_obra" class="form-control input-sm" maxlength="200"></textarea>
          </div>
        </div>
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
  $(document).ready( function () {
    $('#table_customer').DataTable();

$(function() {
    $('.multiple-select').multipleSelect()
  });

  $(function() {
    $('#estado_proyecto').change(function () {
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

    $('#guardarpago').click(function(){
      id_obra=$('#id_obra').val();
      cant_pago=$('#pago_obra').val();
      cant_pago=cant_pago.replace(/\,/g, '');
      fecha=$('#fecha_pago').val();
      coment=$('#coment_obra').val();
      no_recibo=$('#no_recibo').val();

      cant_pago_letra=NumeroALetras(cant_pago);

      //alert(id_obra+" "+cant_pago+" "+fecha+" "+coment);
       if (cant_pago>0&&fecha_pago!="") {//Verificamos que los campos no estén vacíos
        $.ajax({
          type:"POST",
          url:"<?php echo base_url();?>Quinta/AddCustomersPay",
          data:{id_obra:id_obra, cant_pago:cant_pago, fecha:fecha, coment:coment, cant_pago_letra:cant_pago_letra, no_recibo:no_recibo},
          success:function(result){
            //alert(result);
            refrescar();
            if(result==1){
              alert('Pago Agregado');
            }else{
              alert('Falló el servidor. Pago no agregado');
            }
          }
        });
      }else{
        alert("Debe ingresar Cantidad de Pago mayor a 0 e indicar una fecha");
      }
    });
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


   var id_max_recibo="<?php echo $id_max_recibo->venta_mov_factura; ?>";
    if(id_max_recibo==''){
    id_max_recibo="0";
  }
  //alert(id_max_recibo);
  next_id=parseInt(id_max_recibo)+1;
  //alert(id_max_recibo);
  $("#no_recibo").val(next_id);
  }


  function Details($id) {
   //alert('Ver Detalles');
   var id_obra=$id;
   $("#page_content").load("Payments_List",{id_obra:id_obra});
                      
 }

  function llena_tabla($activo) {
   //alert('Ver Detalles');
   var activo=$activo;
   //alert(activo);
   $("#tbl_body").load("Customer_Payments_tbl",{activo:activo});                
 }



 
function Unidades(num){
 
  switch(num)
  {
    case 1: return "UN";
    case 2: return "DOS";
    case 3: return "TRES";
    case 4: return "CUATRO";
    case 5: return "CINCO";
    case 6: return "SEIS";
    case 7: return "SIETE";
    case 8: return "OCHO";
    case 9: return "NUEVE";
  }
 
  return "";
}
 
function Decenas(num){
 
  decena = Math.floor(num/10);
  unidad = num - (decena * 10);
 
  switch(decena)
  {
    case 1:
      switch(unidad)
      {
        case 0: return "DIEZ";
        case 1: return "ONCE";
        case 2: return "DOCE";
        case 3: return "TRECE";
        case 4: return "CATORCE";
        case 5: return "QUINCE";
        default: return "DIECI" + Unidades(unidad);
      }
    case 2:
      switch(unidad)
      {
        case 0: return "VEINTE";
        default: return "VEINTI" + Unidades(unidad);
      }
    case 3: return DecenasY("TREINTA", unidad);
    case 4: return DecenasY("CUARENTA", unidad);
    case 5: return DecenasY("CINCUENTA", unidad);
    case 6: return DecenasY("SESENTA", unidad);
    case 7: return DecenasY("SETENTA", unidad);
    case 8: return DecenasY("OCHENTA", unidad);
    case 9: return DecenasY("NOVENTA", unidad);
    case 0: return Unidades(unidad);
  }
}//Unidades()
 
function DecenasY(strSin, numUnidades){
  if (numUnidades > 0)
    return strSin + " Y " + Unidades(numUnidades)
 
  return strSin;
}//DecenasY()
 
function Centenas(num){
 
  centenas = Math.floor(num / 100);
  decenas = num - (centenas * 100);
 
  switch(centenas)
  {
    case 1:
      if (decenas > 0)
        return "CIENTO " + Decenas(decenas);
      return "CIEN";
    case 2: return "DOSCIENTOS " + Decenas(decenas);
    case 3: return "TRESCIENTOS " + Decenas(decenas);
    case 4: return "CUATROCIENTOS " + Decenas(decenas);
    case 5: return "QUINIENTOS " + Decenas(decenas);
    case 6: return "SEISCIENTOS " + Decenas(decenas);
    case 7: return "SETECIENTOS " + Decenas(decenas);
    case 8: return "OCHOCIENTOS " + Decenas(decenas);
    case 9: return "NOVECIENTOS " + Decenas(decenas);
  }
 
  return Decenas(decenas);
}//Centenas()
 
function Seccion(num, divisor, strSingular, strPlural){
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  letras = "";
 
  if (cientos > 0)
    if (cientos > 1)
      letras = Centenas(cientos) + " " + strPlural;
    else
      letras = strSingular;
 
  if (resto > 0)
    letras += "";
 
  return letras;
}//Seccion()
 
function Miles(num){
  divisor = 1000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMiles = Seccion(num, divisor, "MIL", "MIL");
  strCentenas = Centenas(resto);
 
  if(strMiles == "")
    return strCentenas;
 
  return strMiles + " " + strCentenas;
 
  //return Seccion(num, divisor, "UN MIL", "MIL") + " " + Centenas(resto);
}//Miles()
 
function Millones(num){
  divisor = 1000000;
  cientos = Math.floor(num / divisor)
  resto = num - (cientos * divisor)
 
  strMillones = Seccion(num, divisor, "UN MILLON", "MILLONES");
  strMiles = Miles(resto);
 
  if(strMillones == "")
    return strMiles;
 
  return strMillones + " " + strMiles;
 
  //return Seccion(num, divisor, "UN MILLON", "MILLONES") + " " + Miles(resto);
}//Millones()
 
function NumeroALetras(num,centavos){
  var data = {
    numero: num,
    enteros: Math.floor(num),
    centavos: (((Math.round(num * 100)) - (Math.floor(num) * 100))),
    letrasCentavos: "",
  };
  if(centavos == undefined || centavos==false) {
    data.letrasMonedaPlural="PESOS";
    data.letrasMonedaSingular="PESOS";
  }else{
    data.letrasMonedaPlural="/100 M.N.";
    data.letrasMonedaSingular="/100 M.N.";
  }
 
  if (data.centavos > 0)
    data.letrasCentavos = data.centavos +"/100 M.N." ;
  else
    data.letrasCentavos = data.centavos +"0/100 M.N." ;
 
  if(data.enteros == 0)
    return "CERO " + data.letrasMonedaPlural + " " + data.letrasCentavos;
  if (data.enteros == 1)
    return Millones(data.enteros) + " " + data.letrasMonedaSingular + " " + data.letrasCentavos;
  else
    return Millones(data.enteros) + " " + data.letrasMonedaPlural + " " + data.letrasCentavos;
}//NumeroALetras()


</script>