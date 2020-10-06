<div class="footer_salinas">
	<div class="container-fluid">
		<div class="row">
			<div class="col-3">
				<img src="<?php echo base_url() ?>Resources/Logos/SALINAS.png" width="200" height="70">
			</div>
			<div class="col-2">
				Dirección <br>Teléfono <br>Email
			</div>
			<div class="col-7">
				<h3 align="right">SiGeN<img src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></h3>
				<h6 align="right">Sistema de Gestión de Negocios</h6>
			</div>
		</div>
	</div>
</div>

<script>//script to load the GetInventories controller on click at the link with the id Produc_inv
		$(document).ready(function(){
			$("#Produc_inv").click(function(){
				$("#page_content").load("GetInventories");
			});
		});
	</script>

	<script>
			$(document).ready(function(){//script to load the CustomerProjects controller on click at the link with the id Customers_list
				$("#Customers_list").click(function(){
					$("#page_content").load("CustomerProjects");
				});
			});
		</script>

		<script>
			$(document).ready(function(){//script to load the CustomerProjects controller on click at the link with the id Customers_list
				$("#Customers_Payments").click(function(){
					$("#page_content").load("CustomerPayments");
				});
			});
		</script>
		<script>
			$(document).ready(function(){//script to load the bills of controller on click at the link with the id billsV
				$("#billsV").click(function(){
					$("#page_content").load("GetListCostOfSale");
				});
			});
		</script>
		<script>//script to load the report of viatics of controller on click at the link with the id viaticsV
		$(document).ready(function(){
			$("#viaticsV").click(function(){
				$("#page_content").load("GetAllViatics");
			});
		});
	</script>
		<script>//script to load the report of viatics of controller on click at the link with the id pettyCashV
		$(document).ready(function(){
			$("#pettyCashV").click(function(){
				$("#page_content").load("PettyCash");
			});
		});
	</script>
		<script>//script to load the Provider Catalog
		$(document).ready(function(){
			$("#Cat_Proveedor").click(function(){
				$("#page_content").load("Catalogo_Proveedor");
			});
		});
	</script>
				<script>//script to load the report of viatics of controller on click at the link with the id pettyCashV
				$(document).ready(function(){
					$("#Cat_customer").click(function(){
						$("#page_content").load("Catalogo_Cliente");
					});
				});
			</script>

		<script>//script to load Products Inventorie
		$(document).ready(function(){
			$("#Alm_Products").click(function(){
				$("#page_content").load("InventarioProductos");
			});
		});
	</script>
	
		<script>//script to load Office Product Inventorie
		$(document).ready(function(){
			$("#Alm_Oficina").click(function(){
				$("#page_content").load("InventarioOficina");
			});
		});
	</script>

		<script>
		$(document).ready(function(){
			$("#Flujo_Efectivo").click(function(){
				$("#page_content").load("FlujoEfectivo");
			});
		});
	</script>

		<script>//
			$(document).ready(function(){
				$("#Flujo_Efectivo_proyecto").click(function(){
					$("#page_content").load("FlujoEfectivo_Proyecto");
				});
			});
		</script>
	
		<script>//script to load Office Product Inventorie
		$(document).ready(function(){
			$("#other_expens").click(function(){
				$("#page_content").load("OtherExpens");
			});
		});
			$('#Lista_Solicitudes').click(function(){
			$('#page_content').load('Lista_Solicitudes');
		});
	</script>


</body>
</html> 