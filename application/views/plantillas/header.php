<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="../Resources/icons/Boo_24669.ico">
	<link rel="stylesheet" href="..\assets\bootstrap_4.4\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\GeneralStyles.css">
	<script src="..\assets\Jquery\jquery-3.4.1.min.js"></script>
	<script src="..\assets\bootstrap_4.4\js\bootstrap.min.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\smartmenus\jquery.smartmenus.min.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\smartmenus\addons\bootstrap-4\jquery.smartmenus.bootstrap-4.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\renderMenu.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\menuScript.js"></script>

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
		<a data-toggle="modal" href="#Change_Pass" style="color:blue;">Modificar Contraseña</a>
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
        <input type="password" id="actual" class="form-control col-md-8">
      </div>
      <div class="modal-body">
        <label>Contraseña Nueva*</label>
        <input type="password" id="nueva" class="form-control col-md-8">
        <label>Confirme la Nueva Contraseña*</label>
        <input type="password" id="nueva_2" class="form-control col-md-8">
      </div>
      <h6 class="bg-warning"><p>Al eliminar/agregar el producto, la cantidad de este se agregará/descontará a la existenia en almacen.</p></h6>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btncancelar">Cancelar</button>
        <button type="button" class="btn btn-primary" id="UpdateProduct" data-dismiss="modal">Actualizar</button>
      </div>
    </div>
  </div>
</div>

