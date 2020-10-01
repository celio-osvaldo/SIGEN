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
	<link rel="stylesheet" type="text/css" href="..\assets\Personalized\DataTables\datatables.min.css"/>
	<script type="text/javascript" src="..\assets\Personalized\DataTables\datatables.min.js"></script>
	<script type="text/javascript" src="..\assets\Personalized\js\moment.js"></script>

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
	<title> <?php echo $title ?></title>
	<nav class="navbar navbar-expand-lg navbar-dark header_dasa">
		<a class="navbar-brand" href="<?php echo base_url()?>Welcome/Companies"><img  src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></a>

		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Almacén</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" id="Alm_Products">Productos</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="Alm_Oficina">Material Oficina</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Proyectos</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" id="Customers_list">Lista de Proyectos</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gestión de Pagos</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" id="Customers_Payments">Movimientos (Pagos)</a>
					<!--		<a class="dropdown-item" href="#">Anticipos</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Pagos SFV</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Cotizaciones</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Recibo de entrega</a>
						</div>
					-->
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" id="Cat_Proveedor">Proveedores</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="Produc_inv">Productos/Servicios</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="Cat_customer">Clientes</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Flujo de Efectivo</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" id="Flujo_Efectivo">Reporte Mensual</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" id="Flujo_Efectivo_proyecto">Reporte Por Proyecto</a>
					</div>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Egreso</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" id="billsV">Gasto de Obra</a>	
						<div class="dropdown-divider"></div>

						<div class="dropdown-submenu">
							<a class="dropdown-item">Operativos</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" id="pettyCashV">Caja Chica</a></li>
								<li><a class="dropdown-item"  id="other_expens">Otros Gastos</a></li>
								<li><a class="dropdown-item" id="viaticsV">Viaticos</a></li>
							</ul>
						</div>
					</div>
				</li>
			</ul>
		</div>
		<a class="navbar-brand" role="button"><img src="..\Resources\Icons\user_accounts_15362.ico" width="50" height="50" /><?php  echo $alias; ?></a>
		<a class="btn btn-outline-light" id="btn_cerrar" href="<?php echo base_url()?>Dasa/Logout" role="button">Cerrar Sesión</a>
	</nav>




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