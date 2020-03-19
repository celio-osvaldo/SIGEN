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
	<script type="text/javascript" src="..\assets\Personalized\DataTables\datatables.min.js"></script>

	
</head>
<body>
	 <title> <?php echo $title ?></title>
	<!-- <div class="header_dasa"> -->
		<nav class="navbar navbar-expand-lg navbar-light header_dasa">
			<a class="navbar-brand" href="<?php echo base_url()?>Welcome/Companies"><img  src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></a>

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Inventario</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item"  id="Produc_inv">Productos</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Material Oficina</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Obras / Clientes</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" id="Customers_list">Lista Obras/Clientes</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ventas</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" id="Customers_Payments">Movimientos (Pagos)</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Anticipos</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Pagos SFV</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Cotizaciones</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Recibo de entrega</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Catálogos</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Proveedores</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Productos</a>
							<div class="dropdown-divider"></div>
							<a class="dropdown-item" href="#">Clientes</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Flujo de Efectivo</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" href="#">Reporte Mensual</a>
						</div>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Gastos</a>
						<div class="dropdown-menu" aria-labelledby="navbarDropdown">
							<a class="dropdown-item" id="billsV">Ventas(Facturas)</a>	
							<div class="dropdown-divider"></div>
							<p class="dropdown-item" >Operativos</p>
							<a class="dropdown-item" id="pettyCashV">Caja Chica</a>
							<a class="dropdown-item"  href="#">Gastos</a>
							<a class="dropdown-item" id="viaticsV">Viaticos</a>	
						</div>
					</li>
				</ul>
			</div>
			<a class="navbar-brand" role="button"><img src="..\Resources\Icons\user_accounts_15362.ico" width="50" height="50" /><?php  echo $alias; ?></a>
			<a class="btn btn-outline-light" href="<?php echo base_url()?>Dasa/Logout" role="button">Cerrar Sesión</a>
		</nav>
		<!-- </div> -->
		<div class="jumbotron" id="page_content">
			<h1 class="display-1" align="center">¡Bienvenido!</h1>
			<p class="lead" align="center">Selecciona la opción deseada del menú superior</p>
		</div>