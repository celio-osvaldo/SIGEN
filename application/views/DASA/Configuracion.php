<div class="jumbotron" id="page_content">
    <h3 align="center">Configuración Datos de Empresa</h3>
<div class="row">
  <div class="col-md-12">
    <div class="card bg-card">
      <div class="margins">
        <div class="table-responsive">
          <table id="table_config" class="table table-hover display table-striped" style="font-size: 10pt;">
            <thead class="bg-primary" style="color: #FFFFFF;" align="center">
              <tr>
                <th hidden="true">Id_empresa</th>
                <th>Nombre de Empresa</th>
                <th>RFC</th>
                <th>Domicilio</th>
                <th>Teléfono</th>
                <th>Whatsapp</th>
                <th>Email</th>
                <th>Sitio Web</th>
                <th>Logotipo</th>
                <th hidden="true">url_logo</th>
                <th>Editar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              foreach ($datos_empresa->result() as $row) {?>
                <tr>
                  <td hidden="true" id="<?php echo "id_empresa".$row->id_empresa.""; ?>"><?php echo "".$row->id_empresa.""; ?></td>
                  <td id="<?php echo "empresa_nom".$row->id_empresa.""; ?>"><?php echo "".$row->empresa_nom_fiscal.""; ?></td>
                  <td id="<?php echo "rfc".$row->id_empresa.""; ?>"><?php echo "".$row->empresa_rfc.""; ?></td>
                  <td id="<?php echo "domicilio".$row->id_empresa.""; ?>"><?php echo "".$row->empresa_domic.""; ?></td>
                  <td id="<?php echo "tel".$row->id_empresa.""; ?>"><?php echo "".$row->emp_tel.""; ?></td>
                  <td id="<?php echo "whatsapp".$row->id_empresa.""; ?>"><?php echo "".$row->emp_whatsapp.""; ?></td>
                  <td id="<?php echo "email".$row->id_empresa.""; ?>"><?php echo "".$row->emp_email.""; ?></td>
                  <td id="<?php echo "sitio_web".$row->id_empresa.""; ?>"><?php echo "".$row->emp_web.""; ?></td>
                  <td id="<?php echo "logo".$row->id_empresa.""; ?>"><a role="button" class="btn btn-outline-dark" onclick="Display_logo(this.id)" id="<?php echo "".$row->id_empresa.""; ?>" data-toggle="modal" data-target="#imgProduct"><img src="<?php echo base_url() ?>Resources/Icons/frame_gallery_image_images_photo_picture_pictures_icon_123209.ico" alt=""></a></td>
                  <td hidden="true" id="<?php echo "url_logo".$row->id_empresa.""; ?>"><?php echo $row->empresa_logo ?></td>
                  <td><a role="button" class="btn btn-outline-dark" onclick="Edit_datos(this.id)" id="<?php echo "".$row->id_empresa.""; ?>" data-toggle="modal" data-target="#productE"><img src="..\Resources\Icons\353430-checkbox-edit-pen-pencil_107516.ico" alt="Editar" style="filter: invert(100%)" /></a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

</div>

<!-- Modal Edit Customer_Project -->
<div class="modal fade" id="Edit_Datos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editar Datos de Empresa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-8">
            <label class="label-control">Nombre de Empresa</label>
            <input class="form-control" type="text" name="empresa_nom" id="empresa_nom">
          </div>
          <div class="col-md-4">
            <label class="label-control">RFC</label>
            <input class="form-control" type="text" name="rfc" id="rfc">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Domicilio</label>
            <textarea  class="form-control" name="domicilio" id="domicilio"></textarea>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label class="label-control">Teléfono</label>
            <input class="form-control" type="number" name="tel" id="tel">
          </div>
          <div class="col-md-6">
            <label class="label-control">Whatsapp</label>
            <input class="form-control" type="number" name="whatsapp" id="whatsapp">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Email</label>
            <input class="form-control" type="text" name="email" id="email">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Sitio Web</label>
            <input class="form-control" type="text" name="sitio_web" id="sitio_web">
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <label class="label-control">Logo</label>
            <input type="file" class="form-control" name="editlogo" id="editlogo" accept="application/pdf, image/*">
          </div>  
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateDatos" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>



<!-- Bill modal -->
<div class="modal fade bd-example-modal-lg" id="viewBill" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div style="height: 500px; ">
       <iframe width="100%" height="100%"  id="showbill"></iframe>
       </div>
    </div>
  </div>
</div>
<!-- end modal -->

<script type="text/javascript">
  $(document).ready( function () {
    $('#table_config').DataTable();
  });

  $('#UpdateDatos').click(function(){
    id_empresa=$("#id_empresa").text();
    empresa_nom=$("#empresa_nom").val();
    rfc=$("#rfc").val();
    domicilio=$("#domicilio").val();
    tel=$("#tel").val();
    email=$("#email").val();
    sitio_web=$("#sitio_web").val();
    whatsapp=$("#whatsapp").val();

    var datos = new FormData();
    var files = $('#editlogo')[0].files[0];
    datos.append('file',files);
    datos.append('id_empresa', id_empresa);
    datos.append('empresa_nom', empresa_nom);
    datos.append('rfc', rfc);
    datos.append('domicilio', domicilio);
    datos.append('tel', tel);
    datos.append('email', email);
    datos.append('sitio_web', sitio_web);
    datos.append('whatsapp', whatsapp);

    //alert(id_empresa+empresa_nom+rfc+domicilio+tel+email);
    $.ajax({
      type:"POST",
      url:"<?php echo base_url();?>Dasa/Edit_Datos_Emp",
      data: datos,
      contentType: false,
      processData: false,
      success:function(result){
                //alert(result);
                if(result>0){
                  alert('Registro Actualizado');
                  location.href= "<?php echo base_url()?>Dasa/Configuracion";
                }else{
                  alert('Falló el servidor. Registro no actualizado');
                }
              }
      });
  });

</script>


<script>

  function Edit_datos($id_empresa){
    empresa_nom=$("#empresa_nom"+$id_empresa).text();
    rfc=$("#rfc"+$id_empresa).text();
    domicilio=$("#domicilio"+$id_empresa).text();
    tel=$("#tel"+$id_empresa).text();
    email=$("#email"+$id_empresa).text();
    sitio_web=$("#sitio_web"+$id_empresa).text();
    whatsapp=$("#whatsapp"+$id_empresa).text();

    //alert(empresa_nom+rfc+domicilio+tel+email);

    $("#Edit_Datos").modal();
    $("#empresa_nom").val(empresa_nom);
    $("#rfc").val(rfc);
    $("#domicilio").val(domicilio);
    $("#tel").val(tel);
    $("#email").val(email);
    $("#sitio_web").val(sitio_web);
    $("#whatsapp").val(whatsapp);
  }


  function Display_logo($id){
    var url="<?php echo base_url()?>"+$("#url_logo"+$id).text()+"?"+Date.now();
    //alert(url);
    url_verifica=url.split('?');
    //alert(url_verifica[0]+" "+"<?php echo base_url()?>");

    if(url_verifica[0]=="<?php echo base_url()?>"){
         alert("No se adjuntó logo");
    }else{
        $("#viewBill").modal();
        $("#showbill").prop("src", url);
    }
}


</script>