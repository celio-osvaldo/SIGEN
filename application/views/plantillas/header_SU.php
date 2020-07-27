<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<META HTTP-EQUIV="Cache-Control" CONTENT ="no-cache">
	<link rel="shortcut icon" href="../Resources/Logos/system2.ico">
	<link rel="stylesheet" href="..\assets\bootstrap_4.4\css\bootstrap.min.css">	
	<link rel="stylesheet" type="text/css" href="..\assets\Personalized\css\GeneralStyles.css">
	<script src="..\assets\Jquery\jquery-3.4.1.min.js"></script>
	<script src="..\assets\bootstrap_4.4\js\bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="..\assets\Personalized\DataTables\datatables.min.css"/>
	<script type="text/javascript" src="..\assets\Personalized\DataTables\datatables.min.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\moment.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\jspdf.debug.js"></script>



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
	<title> <?php echo $title ?></title>
	<div class="header_gral">
		<nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
			<a class="navbar-brand" href="<?php echo base_url()?>Welcome/Companies"><img  src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b>Usuario</b></a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" id="lista_usuario">Lista de Usuarios</a>
						</div>
					</li>

				</ul>
			</div>
			<a class="navbar-brand" role="button"><img src="..\Resources\Icons\user_accounts_15362.ico" width="50" height="50" /><?php  echo $alias; ?></a>
			<a class="btn btn-outline-light" href="<?php echo base_url()?>Dasa/Logout" role="button">Cerrar Sesión</a>
		</nav>
	</div>

<script>
var myVar = setInterval(Check_Sesion, 11000); //Cada 11 segundos verifica la sesión, si ya expiró redirige a la página para iniciar sesión nuevamente


function Check_Sesion(){
	  $.ajax({
    type:"POST",
    url:"<?php echo base_url();?>Dasa/Verifica_Sesion",
     data:{},
      success:function(result){
      	if(!result){	
  location.href= "<?php echo base_url()?>Dasa/Logout";
      	}
       }
  });
}

</script