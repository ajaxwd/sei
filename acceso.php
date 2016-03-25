<?php
require_once ('SeiDAO.class.php');
session_start();

//Parámetros de entrada
$id_encuesta = 1;

$_SESSION['Enc_Acceso'] = false;
$_SESSION['msj'] = "";
if(isset ($_GET['action'])){
    //Si el cliente ha seleccionado un producto
	switch ($_GET['action']){
        case 'entrar':
			$seiDAO = new SeiDAO();
			$usuarios = $seiDAO->obtenerUsuario($_POST['nom_usuario'], $_POST['clave']);
			foreach ($usuarios as $usuario){
					$_SESSION['Sei_Acceso'] = true;
					$_SESSION['Sei_IdUsuario'] = $usuario->id_usuario;
					$_SESSION['Sei_NomUsuario'] = $usuario->nombre;
					$_SESSION['Sei_EmailUsuario'] = $usuario->email;
					$_SESSION['Sei_CargoUsuario'] = $usuario->cargo;
					$_SESSION['Sei_CodPerfil'] = $usuario->cod_perfil;
					$_SESSION['msj'] = "";

					if($_SESSION['Sei_CodPerfil'] == 2){
					echo "<script type='text/javascript'>";
					echo "parent.location.href = 'usuario.php';";
					echo "</script>";
				} elseif ($_SESSION['Sei_CodPerfil'] == 3){
					echo "<script type='text/javascript'>";
					echo "parent.location.href = 'soporte.php';";
					echo "</script>";
					}else{
					echo "<script type='text/javascript'>";
					echo "parent.location.href = 'principal.php';";
					echo "</script>";
					}

			}

			if (!$_SESSION['Sei_Acceso']){
				$_SESSION['msj'] = "Los datos ingresados no son válidos";
			}
			break;
		case 'cerrar':

			session_destroy();
			echo "<script type='text/javascript'>";
			echo "parent.location.href = 'index.php';";
			echo "</script>";

            break;
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sistema de Encuestas Importadora BBB</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link type="image/x-icon" href="images/encuesta.ico" rel="shortcut icon" />
<link type="image/x-icon" href="images/encuesta.ico" rel="icon" />
<link href="css/estilos.css" type="text/css" rel="stylesheet" media="screen"  />
<script language="javascript" type="text/javascript" src="js/md5.js"></script>
<script type="text/javascript" src="js/funcion.js"></script>
<script type="text/javascript">
function Validaciones(){
	theForm	= document.formulario_acceso;

	if (vacio(theForm.nom_usuario.value,'Error: Debe ingresar su Nombre de Usuario') == false){
	theForm.nom_usuario.focus();
	}else{
		if (vacio(theForm.clave.value,'Error: Debe ingresar su Clave') == false){
		theForm.clave.focus();
		}else{
			theForm.action="acceso.php?action=entrar";
			theForm.submit();
		}
	}
}

</script>
</head>

<body id="dwHome">
<!--cabecera-->
<div id="fondoBlanco">
	<!--inicio content-->
	<div class="content_access">
	<header>
    <div id="header">
     	<a href="index.php"><img src="images/logo.png" alt="Sei" width="150" height="46" border="0" class="head_logo" /></a>
	</div>
	</header>
		<span align="center"><h1>Sistema de Seguimiento de Errores e Incidencias<h1></span>
		<h4>Inicio de Sesi&oacute;n</h4>
		<div class="clear"></div>
		<form method="post" id="formulario_acceso" name="formulario_acceso" >
			<div class="clear"></div><br>
			<label for="finput_principal" class="flabel_principal">&nbsp;Usuario</label>
			<input name="nom_usuario" class="finput_principal" id="nom_usuario" value="" type="text" maxlength="100">
			<div class="clear"></div><br>
			<label for="finput_principal" class="flabel_principal">&nbsp;Clave</label>
			<input name="clave" class="finput_principal" id="clave" type="password" maxlength="100">
			<p class="texto_pequeño"><?echo $_SESSION['msj']?></p>
			<div class="clear"></div><br>
			<input type="button" class="link_button" value="Iniciar Sesi&oacute;n" name="enviar" onclick="Validaciones();" />
			<div class="clear"></div><br>
			<a href="obtener.php">¿Olvido su clave?</a><br>
			<div class="clear"></div><br>
	    </form>
	</div>
</div>
</body>

</html>
