<?php 
require_once ('SeiDAO.class.php');
session_start();

$_SESSION['existe'] = false;
if(isset ($_GET['action'])){
    //Si el cliente ha seleccionado un producto
	switch ($_GET['action']){
        		
		case 'recuperar':		
			
			$seiDAO = new SeiDAO();
			$email= $_POST['email'];
			$usuarios = $seiDAO->obtenerClave($_POST['email']);
			foreach ($usuarios as $usuario){
				$nombre = $usuario->nombre;
				$clave = $usuario->clave;
				
				//Enviar correo
				$destinatario = $_POST['email'];
				$remitente = "noreply@insico.cl";
				$asunto = "Obtener Clave Secreta";
					
				$cuerpo = '
				<html>
				<head>
				   <title>Sistema de Seguimiento de Errores e Incidencias</title>
				</head>
				<body>
				<p><b>Estimado(a) '.$nombre.', su clave secreta es: <b>'.$clave.'</b></p>
				<br>
				<br>Para acceder al sistema haga click <a href="localhost/sei/acceso.php"><b>Aquí</b></a>
				<br>
				<br>
				<p><b>Saludos Cordiales</p>
				<p><b>Atte,</p>
				<p><b>Administración</p>
				</body>
				</html>
				';

				//para el envío en formato HTML
				$headers = "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
				$headers .= "From: Insico S.A. <$remitente>\r\n";
				$headers .= "Reply-To: $remitente\r\n";
				$headers .= "Return-path: $remitente\r\n";

				mail($destinatario,$asunto,$cuerpo,$headers); 
				
				$_SESSION['recupera'] = true;
				$_SESSION['msj'] ="";
				echo "<script LANGUAGE='JavaScript'>";
				echo "alert('Su clave ha sido enviada a su correo.');";
				echo "parent.location.href = 'acceso.php';";
				echo "</script>";
			
			}
			if (!$usuarios){
				$_SESSION['recupera'] = true;
				$_SESSION['msj'] = "El Email ingresado no esta en nuestros registros, favor intente con otro.";
				echo "<script LANGUAGE='JavaScript'>";
				echo "parent.location.href = 'obtener.php';";
				echo "</script>";
			}
			break;
			
		case 'volver':
			$_SESSION['recupera'] = false;
			$_SESSION['msj'] ="";
			
			echo "<script LANGUAGE='JavaScript'>";
			echo "parent.location.href = 'index.php';";
			echo "</script>";
			break;
		
		
	}
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Obtener Contraseña</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/encuesta.ico" rel="shortcut icon" />
<link type="image/x-icon" href="images/encuesta.ico" rel="icon" />
<link href="css/estilos.css" type="text/css" rel="stylesheet" media="screen"  />
<script language="javascript" type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript" src="js/funcion.js"></script>
<script type="text/javascript">

function ValidarRecupera(){

	theForm	= document.formulario_recupera;


	if (email(theForm.email.value,'Error: Debe ingresar email del contacto') == false){
		theForm.email.focus();
	}else{
		document.formulario_recupera.action="obtener.php?action=recuperar";
		document.formulario_recupera.submit();
	}
}

function volver()
{
	document.formulario_recupera.action="acceso.php";
	document.formulario_recupera.submit();
}
</script>

</head>

<body id="dwContacto">
<!--cabecera-->
<div id="fondoBlanco">
	<!--inicio content-->
	<div class="content">
	<header>
		<div id="header"> 
			<a href="index.php"><img src="images/logo.png" alt="Sei" width="150" height="46" border="0" class="head_logo" /></a>
		</div>
	</header>

<h1>Recupera Contrase&ntilde;a</h1>
<!--cuadro dialogo-->
<div id="miniContacto">
</div>
<h3>Favor ingrese el Email con el cual se registro para enviarle su Contrase&ntilde;a.</h3>
<!--formulario contacto-->
<div id="formu1">
<form method="post" name="formulario_recupera" action="registro.php">
<fieldset>
<h4>Obtener Contrase&ntilde;a</h4>

  <label for="email" class="fm1_label">Email:</label>
  <input type="email" name="email" id="email" maxlength="60" tabindex="1" value="" /><br />
  <br class="clear" />
  <input type="button" class="link_button" value="Obtener" name="obtener" onclick="ValidarRecupera();" />
  <input type="button" class="link_button" value="Volver" name="volver" onclick="volver();" />
  <br class="clear" /><br/>	
  <h3><? echo $_SESSION['msj']?></h3>  
  <br class="clear" />
</fieldset>
</form>

</div>

</div>
</div>
</body>
</html>

