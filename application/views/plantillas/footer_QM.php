<div class="footer_QM">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<img src="<?php echo base_url() ?>Resources/Logos/QM.png" width="150" height="70">
			</div>
			<?php foreach ($datos_empresa->result() as $row) {
				
			?>
			<div class="col-md-7" style="font-size: 10pt;">
				<div class="row">
					<label>Dirección: <?php echo $row->empresa_domic; ?></label> 
				</div>
				<div class="row">
					<label>Teléfono: <?php echo $row->emp_tel; ?></label>
				</div>
				<div class="row">
					<label>Email: <?php echo $row->emp_email; ?></label>
				</div>
			</div>
			<?php 
			}
			?>
			<div class="col-md-3">
				<h3 align="right">SiGeN<img src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></h3>
				<h6 align="right">Sistema de Gestión de Negocios</h6>
			</div>
		</div>
	</div>
</div>


		<script>//script to load the GetProducts/Services controller on click at the link with the id Produc_inv
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

		<script>//script to load Office Product Inventorie
			$(document).ready(function(){
				$("#Flujo_Efectivo").click(function(){
					$("#page_content").load("FlujoEfectivo");
				});
			});
		</script>
		
		<script>//script to load Office Product Inventorie
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

		<script>//script to load Office Product Inventorie
			$(document).ready(function(){
				$("#nomina").click(function(){
					$("#page_content").load("Nomina");
				});
			});
		</script>

		<script>//script to load Office Product Inventorie
			$(document).ready(function(){
				$("#servicios").click(function(){
					$("#page_content").load("Servicios");
				});
			});
		</script>

<script type="text/javascript">
function countChars(obj){
    var maxLength = 500;
    var strLength = obj.value.length;
    var charRemain = (maxLength - strLength);
    
    if(charRemain < 0){
        document.getElementById("charNum").innerHTML = '<span style="color: red;">Has excedido los '+maxLength+' caracteres permitidos.</span>';
    }else{
        document.getElementById("charNum").innerHTML = 'Restan '+charRemain+' caracteres ';
    }
}

function SeparaMiles($id){
  valor=$("#"+$id).val();
    valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
  if(valor==""||isNaN(valor)){
    //alert("entro");
    valor=0.00;
    //alert(valor);
  }
  var resultado=valor.toLocaleString("en");
  $("#"+$id).val(parseFloat(resultado.replace(/,/g, "")).toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","));
  }
</script>

</body>
</html> 