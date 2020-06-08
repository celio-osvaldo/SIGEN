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
		<a class="navbar-brand" role="button"><img src="..\Resources\Icons\user_accounts_15362.ico" width="50" height="50" /><?php  echo $alias; ?></a>
		<a class="btn btn-outline-light" href="<?php echo base_url()?>Dasa/Logout" role="button">Cerrar Sesión</a>
	</nav>
	</div>

