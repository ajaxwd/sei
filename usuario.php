<?php
require_once ('SeiDAO.class.php');
session_start();

if(isset ($_GET['action'])){
    //Si el cliente ha ingresar una incidencia
	switch ($_GET['action']){
			case 'ingresar':
			$seiDAO = new SeiDAO();
			$usuarios = $seiDAO->ingresarIncidencias($_POST['Descripcion'], $_POST['Detalle'], $_POST['Dependencia'],$_SESSION['Sei_IdUsuario']);
			echo "<script type='text/javascript'>";
			echo "parent.location.href = 'usuario.php';";
			echo "</script>";
			break;

      case 'cerrar':
			session_destroy();
			echo "<script type='text/javascript'>";
			echo "parent.location.href = 'acceso.php';";
			echo "</script>";
      break;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <?include("head.php");?>
<script type="text/javascript">
function Vali_Incidencias(){
	theForm	= document.ff;

	if (vacio(theForm.Descripcion.value,'Error: Debe ingresar Descripcion') == false){
	theForm.Descripcion.focus();
	}else{
		if (vacio(theForm.Detalle.value,'Error: Debe ingresar su Detalle') == false){
		theForm.Detalle.focus();
		}else{
			if (vacio(theForm.Dependencia.value,'Error: Debe ingresar Dependencia') == false){
				theForm.Dependencia.focus();
			}else{
				theForm.action="usuario.php?action=ingresar";
				theForm.submit();
			}
		}
	}
}
</script>
</head>
<body>

<center>
    <h2>Sistema de Seguimiento de Errores e Incidencias</h2>
    <p><strong>Bienvenido:</strong> <?echo $_SESSION['Sei_NomUsuario'];?> <a href="principal.php?action=cerrar">Cerrar Sesi&oacute;n</a></p>
<? $seiDAO = new SeiDAO();
$incidencias = $seiDAO->mostrarIncidencias($_SESSION['Sei_IdUsuario']);
?>
		<div style="margin:20px 0;"></div>

    <div class="easyui-tabs" style="width:700px;height:auto">
        <div title="Ver Incidencias" style="padding:10px">
		<?include("ver_incidencias.php");?>
        </div>
        <div title="Ingresar Incidencias" style="padding:10px">
		<?include("ingresar_incidencias.php");?>
        </div>
        <div title="Ayuda" data-options="iconCls:'icon-help',closable:true" style="padding:10px">
		<?include("ayuda_usuario.php");?>
        </div>
    </div>

</center>
</body>
</html>
