
<div class="footer_iluminacion">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2">
				<img src="<?php echo base_url() ?>Resources/Logos/Slogan_iluminacion.jpg" width="200" height="70">
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

	<script>//script to load the Provider Catalog
			$(document).ready(function(){
				$("#Cat_Proveedor").click(function(){
					$("#page_content").load("Catalogo_Proveedor");
				});
			});
	</script>

	<script>//script to load the GetInventories controller on click at the link with the id Produc_inv
			$(document).ready(function(){
				$("#Produc_inv").click(function(){
					$("#page_content").load("GetInventories");
					});
				});
	</script>

		</script>
	<script>//script to load the report of viatics of controller on click at the link with the id pettyCashV
			$(document).ready(function(){
				$("#Cat_customer").click(function(){
					$("#page_content").load("Catalogo_Cliente");
				});
			});
	</script>
	
	<script>//script to load the report of viatics of controller on click at the link with the id pettyCashV
			$(document).ready(function(){
				$("#Cat_cotizante").click(function(){
					$("#page_content").load("Catalogo_Cotizante");
				});
			});
	</script>
	<script>//script to load Anticipos List
			$(document).ready(function(){
				$("#Anticipos").click(function(){
					$("#page_content").load("Anticipos");
				});
			});
	</script>
	<script>
		$(document).ready(function(){
			$("#SFV").click(function(){
				$("#page_content").load("Pagos_SFV");
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("#Cotizaciones").click(function(){
				$("#page_content").load("Cotizaciones");
			});
		});
	</script>
	<script>
		$(document).ready(function(){
			$("#Recibo_Entrega").click(function(){
				$("#page_content").load("Recibo_Entrega");
			});
		});
	</script>
	
	<script>
		$(document).ready(function(){
			$("#Flujo_Efectivo").click(function(){
				$("#page_content").load("Flujo_Efectivo");
			});
		});
	</script>

	<script>
		$(document).ready(function(){
				$("#billsV").click(function(){
				$("#page_content").load("GetListCostOfSale");
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
	<script>//script to load Office Product Inventorie
		$(document).ready(function(){
				$("#other_expens").click(function(){
				$("#page_content").load("OtherExpens");
			});
		});
	</script>
	<script>//script to load the report of viatics of controller on click at the link with the id viaticsV
		$(document).ready(function(){
				$("#viaticsV").click(function(){
				$("#page_content").load("GetAllViatics");
			});
		});

	$('#Lista_Solicitudes').click(function(){
			$('#page_content').load('Lista_Solicitudes');
		});
	</script>


<script type="text/javascript">
	   function Separa_Miles($id){  //Separador de Miles con 5 dígitos decimales
      valor=$("#"+$id).val();
      valor=valor.replace(/\,/g, '');//si el valor ingresado contiene "comas", se eliminan
      if(valor==""||isNaN(valor)){
        //alert("entro");
          valor=0.00000;
          //alert(valor);
        }
      var resultado=valor.toLocaleString("en");
      valor_final=parseFloat(resultado.replace(/,/g, "")).toFixed(5).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      valor_final=valor_final.split(".");
      valor_final[1]=valor_final[1].replace(/,/g, "");

      valor_completo=valor_final[0]+"."+valor_final[1];
      $("#"+$id).val(valor_completo);
    }

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
</script>


	</body>
</html> 