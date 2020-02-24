<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="shortcut icon" href="../Resources/icons/Boo_24669.ico">
	<link rel="stylesheet" href="..\assets\bootstrap_4.4\css\bootstrap.min.css">
<<<<<<< HEAD
	<link href="../assets/Personalized/css/GeneralStyles.css" rel="stylesheet">
=======
	<link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\GeneralStyles.css">
	<!-- <link rel="stylesheet" href="..\assets\Personalized\js\smartmenus\addons\bootstrap-4\jquery.smartmenus.bootstrap-4.css"> -->
>>>>>>> ac29ffef86037216ea77b0636eec6f96478dac6a

</head>
<body>
	<div class="header_gral">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
			<a class="navbar-brand" href="#"><img  src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

<<<<<<< HEAD
			<a class="navbar-brand ml-auto">Usuario: <?php  echo $alias; ?></a>

			<a class="btn btn-danger" href="<?php echo base_url()?>Dasa/Logout" role="button" >Cerrar Sesión</a>
		</nav>
	</div>
=======
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul id="<?php echo $type; ?>"></ul>
		</div>
		<a class="navbar-brand" role="button"><img src="..\Resources\Icons\user_accounts_15362.ico" width="50" height="50" /><?php  echo $alias; ?></a><!-- 
		<a class="navbar-brand"><link rel="stylesheet" href="..\Resources\Icons\user_accounts_15362.ico"><?php  echo $alias; ?> </a> -->
		<a class="btn btn-outline-danger" href="<?php echo base_url()?>Dasa/Logout" role="button">Cerrar Sesión</a>
	</nav>
>>>>>>> ac29ffef86037216ea77b0636eec6f96478dac6a
