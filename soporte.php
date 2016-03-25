<?php
require_once ('SeiDAO.class.php');
session_start();

if(isset ($_GET['action'])){
    //Si el cliente ha seleccionado un producto
	switch ($_GET['action']){
		case 'ingresar':
		
		$seiDAO = new SeiDAO();
		$usuarios = $seiDAO->ingresarRequerimientos($_POST['codarea'], $_POST['incidencia'], $_POST['observacion'],$_SESSION['Sei_IdUsuario']);
			echo "<script type='text/javascript'>";
			echo "parent.location.href = 'soporte.php';";
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
function ValidarIncidencias(){
	theForm	= document.frmrequerimiento;
			if (theForm.observacion.value==''){
				alert('Error: Debe ingresar Observacion');
				theForm.observacion.focus();   
			}else{
				theForm.action="soporte.php?action=ingresar";
				theForm.submit();
			}
}
</script>
</head>
<body>

<center>
    <h2>Sistema de Seguimiento de Errores e Incidencias</h2>
    <p><strong>Bienvenido:</strong> <?echo $_SESSION['Sei_NomUsuario'];?> <a href="principal.php?action=cerrar">Cerrar Sesi&oacute;n</a></p>
<? 
$seiDAO = new SeiDAO();
$requerimientos = $seiDAO->mostrarRequerimientos();
$monitoreos = $seiDAO->monitoreoControl();
$num_incidencias = $seiDAO->numeroIncidencias();
$cod_areas = $seiDAO->codigoArea();
?>
		<div style="margin:20px 0;"></div>

    <div class="easyui-tabs" style="width:700px;height:auto">
        <div title="Ver Requerimientos" style="padding:10px">
		<?include("ver_requerimientos.php");?>
        </div>
		<div title="Ingresar Requerimientos" style="padding:10px">
		<?include("ingresar_requerimientos.php");?>
        </div>
		<div title="Ver Incidencias" style="padding:10px">
		<?include("ver_incidencias_soporte.php");?>
        </div>
		<div title="Monitoreo de Control" style="padding:10px">
		<?include("monitoreo_control.php");?>
        </div>
        <div title="Ayuda" data-options="iconCls:'icon-help',closable:true" style="padding:10px">
		<?include("ayuda_soporte.php");?>
        </div>
    </div>

</center>
</body>
</html>
