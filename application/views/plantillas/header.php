<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="../Resources/icons/Boo_24669.ico">
	<link rel="stylesheet" href="..\assets\bootstrap_4.4\css\bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\GeneralStyles.css">
	<!-- <link rel="stylesheet" href="..\assets\Personalized\js\smartmenus\addons\bootstrap-4\jquery.smartmenus.bootstrap-4.css"> -->

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="<?php echo $corp; ?>">
		<a class="navbar-brand" href="#">Logo Sistema</a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul id="<?php echo $type; ?>"></ul>
		</div>
		<a class="navbar-brand" role="button"><img src="..\Resources\Icons\user_accounts_15362.ico" width="50" height="50" /><?php  echo $alias; ?></a><!-- 
		<a class="navbar-brand"><link rel="stylesheet" href="..\Resources\Icons\user_accounts_15362.ico"><?php  echo $alias; ?> </a> -->
		<a class="btn btn-outline-light" href="<?php echo base_url()?>Dasa/Logout" role="button">Cerrar Sesión</a>
	</nav>

	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
