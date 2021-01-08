<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="../Resources/Logos/system2.ico">
	<link rel="stylesheet" href="..\assets\bootstrap_4.4\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\GeneralStyles.css">
	<script src="..\assets\Jquery\jquery-3.4.1.min.js"></script>
	<script src="..\assets\bootstrap_4.4\js\bootstrap.min.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\smartmenus\jquery.smartmenus.min.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\smartmenus\addons\bootstrap-4\jquery.smartmenus.bootstrap-4.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\renderMenu.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\menuScript.js"></script>

  <script src="..\assets\multiple-select-1.5.2\dist\multiple-select.min.js"></script>
  <link rel="stylesheet" type="text/css" href="..\assets\multiple-select-1.5.2\dist\multiple-select.min.css">



<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>




  <style type="text/css">
 .modal-open {
    overflow: scroll;
}
  </style>

</head>
<body>

	<div class="header_gral">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
		<a class="navbar-brand" href="<?php echo base_url()?>Welcome/Companies"><img src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul id="<?php echo $type; ?>"></ul>
		</div>
		<a data-toggle="modal" href="#Change_Pass" style="color:white;"><img height="20" width="20" src="<?php echo base_url() ?>Resources/Icons/key.ico">Modificar Contraseña</a>
		<a class="navbar-brand" role="button"><img src="..\Resources\Icons\user_accounts_15362.ico" width="50" height="50" /><?php  echo $alias; ?></a>
		<a class="btn btn-outline-light" href="<?php echo base_url()?>Dasa/Logout" role="button">Cerrar Sesión</a>
	</nav>
	</div>

<!-- Modal Edit Product Anticipo -->
<div class="modal fade" id="Change_Pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Modificar Contraseña de Acceso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Contraseña Actual*</label>
        <input type="password" id="actual" onkeyup="Minimo()" class="form-control col-md-8">
      </div>
      <div class="modal-body">
        <label>Contraseña Nueva*</label>
        <input type="password" disabled="true" onkeyup="Minimo()" id="nueva" class="form-control col-md-8">
        <label>Confirme la Nueva Contraseña*</label>
        <input type="password" onkeyup="Nueva2()" disabled="true" id="nueva_2" class="form-control col-md-8">
      </div>
      <h6 class="bg-warning"><p id="mensaje"></p></h6>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdatePass_btn" disabled="true" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function(){

    $('#UpdatePass_btn').click(function(){
      actual=$('#actual').val();
      nueva=$('#nueva').val();
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>Iluminacion/ChangePass",
        data:{actual:actual, nueva:nueva},
        success:function(result){
            //alert(result);
            if(result=="pass_nuevo_actualizado"){
              alert('Contraseña actualizada');
            }else{
              if(result=="Error"){
                alert('Error del Servidor. Inténtelo nuevamente.');
              }else{
                alert('Error. Contraseña actual indicada es incorrecta.');
              }

            }
            //Update();
          }
        });
    });
  });


  function Minimo() {
    if($("#actual").val()==$("#nueva").val()){
      $("#mensaje").text("*La contraseña nueva no puede ser igual a la contraseña actual");
       $("#nueva_2").attr('disabled','true');
       $("#nueva_2").val("");
    }else{
      $("#nueva").removeAttr('disabled');
      if($("#nueva").val().length>7){
       $("#mensaje").text("");
       $("#nueva_2").removeAttr('disabled');
      }else{
        $("#mensaje").text("*La contraseña nueva debe tener como mínimo 8 caracteres");
        $("#nueva_2").val("");
        $("#nueva_2").attr('disabled','true');
      }
    }
  }
  function Nueva2() {
    nueva=$("#nueva").val();
    nueva_2=$("#nueva_2").val();
    if(nueva==nueva_2){
      $("#UpdatePass_btn").removeAttr('disabled');
      $("#mensaje").text("");
    }else{
      $("#UpdatePass_btn").attr('disabled', 'true');
      $("#mensaje").text("*Confirmación de Contraseña no coincide con la Contraseña Nueva");
    }
  }
</script>


<script>
var timeout;
var base_url = "<?php echo base_url()?>Dasa/Logout";
document.onmousemove = function() {
  clearTimeout(timeout);
  timeout = setTimeout(function() {
        $.ajax({
    type:"POST",
    url:"<?php echo base_url();?>Dasa/Verifica_Sesion",
     data:{},
      success:function(result){
        if(!result){  
  location.href= "<?php echo base_url()?>Dasa/Logout";
        }
        else{
          location.href= "<?php echo base_url()?>Dasa/Logout";
        }
       }
  });
  }, 2701000);  //A los 45 min de que no se mueva el mouse sobre la página, se cerrará la sesión
}
</script>