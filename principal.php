<?php 
require_once ('SeiDAO.class.php');
session_start();

if(isset ($_GET['action'])){
    //Si el cliente ha seleccionado un producto
	switch ($_GET['action']){
        case 'cerrar':
			
			session_destroy();
			echo "<script type='text/javascript'>";
			echo "parent.location.href = 'acceso.php';";
			echo "</script>";
	
            break;
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Sistema de Seguimiento</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="robots" content="all" />
<link type="image/x-icon" href="images/sei.ico" rel="shortcut icon" />
<link type="image/x-icon" href="images/sei.ico" rel="icon" />
<meta http-equiv="expires" content="0" />
<meta http-equiv="pragma" content="no-cache" />

<script type="text/javascript" src="inc/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="inc/wowslider.js"></script>
<link rel="stylesheet" type="text/css" href="css/wa-style.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link href="css/home.css" type="text/css" rel="stylesheet" media="screen"  />
<link href="css/wow.css" type="text/css" rel="stylesheet" media="screen"  />

<script type="text/javascript">
var nav4 = window.Event ? true : false;
function acceptNum(evt){    
var key = nav4 ? evt.which : evt.keyCode;   
return (key <= 13 || (key>= 48 && key <= 57));
}

function test(){
txt = document.forms[0].texto.value.toUpperCase();
alert(txt);
}

function valida(e){
  tecla=(document.all) ? e.keyCode : e.which;
  if(tecla == 13)
    Validacion_Buscar()
}

function Validacion_Buscar(){ 
	if (document.frmprincipal.txt_buscar.value==''){
		alert('Debe ingresar una descripcion de Producto');
		document.frmprincipal.txt_buscar.focus();  
	}else{
		var descr_prod = document.frmprincipal.txt_buscar.value;
		document.frmprincipal.action="envio_producto.php?pag_actual=Busqueda&descr_prod="+descr_prod;
		document.frmprincipal.submit();
	}
}
	
function Recuperar(){ 
var bOk = false;
var filtro = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
if (!filtro.test(document.frmprincipal.txt_mail2.value.trim())) {
alert("La dirección de email es incorrecta.");
document.frmprincipal.txt_mail2.focus();
}else{
	bOk = true; 
	document.frmprincipal.action="acceso.php?obtenerclave=1&recuperar=1";
	document.frmprincipal.submit();
	}
}

</script>
</head>
<body>
<?

?>
<!--inicio contenedor general-->
	<div id="wrapper">
		<!--Encabezado de pagina-->
		<?include("cab_pagina.php");?>
		<!--inicio main-->
		<div id="main">
			<form name="frmprincipal" method="post"> 
			
			<!--Lateral-->
			
			
			<!--inicio content-->
			<div class="content">
				
			
				<div class="clear"></div>
				<!--minicroslider-->

				
				</hr>
				<!--fin minicroslider-->
				<div class="clear"></div>
			
			</div>
			<!--fin content-->
			</form>
		</div>
		<!-- fin del main-->
		
		<div class="clear"></div>
		<!--pie de pagina-->
		<?include("pie_pagina.php");?>
	</div>
	<!--fin contenedor general-->
</body>
</html>