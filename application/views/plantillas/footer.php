</div>
<div class="col-md-1"></div>
</div>

<link href="../assets/Personalized/css/GeneralStyles.css" rel="stylesheet">


<div class="footer_gral">
	<nav class="text-left navbar-expand-lg navbar-dark bg-dark">
		<h3>SiGeN<img src="<?php echo base_url() ?>Resources/Logos/grupo.ico"></h3>
		<h6>Sistema de Gestión de Negocios</h6>
	</nav>
</div>

</body>
</html> 

<script>//script to load the users list
	$(document).ready(function(){
		$('#lista_usuario').click(function(){
			$('#page_content').load('Users_List');
		});
		$('#Lista_Solicitudes').click(function(){
			$('#page_content').load('Lista_Solicitudes');
		});
		$('#Flujo_Efectivo').click(function(){
			$('#page_content').load('Flujo_Efectivo');
		});
		$('#Flujo_Efectivo_proyecto').click(function(){
			$('#page_content').load('Flujo_Efectivo_proyecto');
		});
		$('#Nube').click(function(){
			$('#page_content').load('Ver_Nube');
		});

	});

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