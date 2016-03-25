<? 
require_once ('SeiDAO.class.php');
session_start();

//parametro de entrada
if(!$_GET['id_tarea']){
	$id_tarea=0;
}else{
	$id_tarea = (int)$_GET['id_tarea'];
}

if(isset ($_GET['action'])){
    //Si el cliente ha seleccionado un producto
	switch ($_GET['action']){
		
        case 'ver':
			$seiDAO = new SeiDAO();
			$tareas = $seiDAO->obtenerPorTarea($id_tarea);
			foreach ($tareas as $tarea){
				$descr = $tarea->descr;
				$detalle = $tarea->detalle;
				$asignado = $tarea->usu_asignado;
				$fecini = date("d-m-Y",strtotime($tarea->fec_ini));
				$fecfin = date("d-m-Y",strtotime($tarea->fec_fin));
				$prioridad = $tarea->cod_prioridad;
				$tipo_req = $tarea->cod_tipo_req;
			}
			break;

        case 'guardar':
            $seiDAO = new SeiDAO();
			echo "prioridad: ".$_POST['prioridad'];
			echo "  -  tipo_req: ".$_POST['tipo_req'];
			exit;
            $guardar = $seiDAO->guardarTarea($id_tarea, $_POST['descr'], nl2br($_POST['detalle']), $_POST['asignado'], $_POST['fecini'], $_POST['fecfin'], $_POST['prioridad'], $_POST['tipo_req'], $_SESSION['Sei_IdUsuario'], 1);
           
			 header('Location: crear_tarea.php');
			break;
		
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Crear tarea</title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<link type="image/x-icon" href="images/sei.ico" rel="shortcut icon" />
	<link type="image/x-icon" href="images/sei.ico" rel="icon" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="pragma" content="no-cache" />
	<link rel="stylesheet" type="text/css" href="css/wa-style.css">
	<link href="css/calendario.css" type="text/css" rel="stylesheet">
	<script src="js/calendar.js" type="text/javascript"></script>
	<script src="js/calendar-es.js" type="text/javascript"></script>
	<script src="js/calendar-setup.js" type="text/javascript"></script>
	<!--Declaracion de Scripts-->
	<script type="text/javascript">
	function ValidaFecha(fecha){
		var dtCh= "-";
		var minYear=1900;
		var maxYear=2100;
		function isInteger(s){
			var i;
			for (i = 0; i < s.length; i++){
				var c = s.charAt(i);
				if (((c < "0") || (c > "9"))) return false;
			}
			return true;
		}
		function stripCharsInBag(s, bag){
			var i;
			var returnString = "";
			for (i = 0; i < s.length; i++){
				var c = s.charAt(i);
				if (bag.indexOf(c) == -1) returnString += c;
			}
			return returnString;
		}
		function daysInFebruary (year){
			return (((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0))) ? 29 : 28 );
		}
		function DaysArray(n) {
			for (var i = 1; i <= n; i++) {
				this[i] = 31
				if (i==4 || i==6 || i==9 || i==11) {this[i] = 30}
				if (i==2) {this[i] = 29}
			}
			return this
		}
		function isDate(dtStr){
			var daysInMonth = DaysArray(12)
			var pos1=dtStr.indexOf(dtCh)
			var pos2=dtStr.indexOf(dtCh,pos1+1)
			var strDay=dtStr.substring(0,pos1)
			var strMonth=dtStr.substring(pos1+1,pos2)
			var strYear=dtStr.substring(pos2+1)
			strYr=strYear
			if (strDay.charAt(0)=="0" && strDay.length>1) strDay=strDay.substring(1)
			if (strMonth.charAt(0)=="0" && strMonth.length>1) strMonth=strMonth.substring(1)
			for (var i = 1; i <= 3; i++) {
				if (strYr.charAt(0)=="0" && strYr.length>1) strYr=strYr.substring(1)
			}
			month=parseInt(strMonth)
			day=parseInt(strDay)
			year=parseInt(strYr)
			if (pos1==-1 || pos2==-1){
				return false
			}
			if (strMonth.length<1 || month<1 || month>12){
				return false
			}
			if (strDay.length<1 || day<1 || day>31 || (month==2 && day>daysInFebruary(year)) || day > daysInMonth[month]){
				return false
			}
			if (strYear.length != 4 || year==0 || year<minYear || year>maxYear){
				return false
			}
			if (dtStr.indexOf(dtCh,pos2+1)!=-1 || isInteger(stripCharsInBag(dtStr, dtCh))==false){
				return false
			}
			return true
		}
		if(isDate(fecha)){
			return true;
		}else{
			return false;
		}
	}

	function Validaciones(id_tarea){ 
	var filtro = /^([a-zA-Z0-9_.-])+@(([a-zA-Z0-9-])+.)+([a-zA-Z0-9]{2,4})+$/;
		if (document.formulario.descr.value==''){
		alert('Debe ingresar una descripcion');
		document.formulario.descr.focus();   
		}else{
			if (document.formulario.detalle.value==''){
			alert('Debe Ingresar un detalle');
			document.formulario.detalle.focus();   
			}else{
				if (document.formulario.asignado.value==0){
				alert('Debe asignar a un ingeniero');
				document.formulario.asignado.focus();   
				}else{	
					if (document.formulario.fecini.value==''){
					alert('Debe ingresar una fecha de inicio');
					document.formulario.fecini.focus();   
					}else{	
						if (!ValidaFecha(document.formulario.fecini.value)){
							alert( "La fecha de inicio no es valida" );
							document.formulario.fecini.focus();
						}else{
							if (document.formulario.fecfin.value==''){
							alert('Debe ingresar una fecha de termino');
							document.formulario.fecfin.focus();   
							}else{
								if (!ValidaFecha(document.formulario.fecfin.value)){
									alert( "La fecha de termino no es valida" );
									document.formulario.fecfin.focus();
								}else{
									if (document.formulario.prioridad.value==-1){
									alert('Debe asignar una prioridad al requerimiento');
									document.formulario.prioridad.focus();   
									}else{	
										document.formulario.action="crear_tarea.php?action=guardar&id_tarea="+id_tarea;
										document.formulario.submit();
									}
								}
							}
						}
					}
				}
			}
		}
	}
	
	window.onload=function(){
		var pos=window.name || 0;
		window.scrollTo(0,pos);
	}
	
	window.onunload=function(){
		window.name=self.pageYOffset || (document.documentElement.scrollTop+document.body.scrollTop);
	}
	</script>
	</head>
	<body>
	<!--inicio contenedor general-->
	<div id="wrapper">
		<!--Encabezado de pagina-->
		<?include("cab_pagina.php");?>
		<!--inicio main-->
		<div id="main">
			<h1><a href="crear_tarea.php">Crear Tarea</a> | <a href="listado_tarea.php">Listar Tareas</a></h1>
			
		<form name="formulario" method="POST">	
		
			<!--inicio content-->
			<div class="content">
				<fieldset class="ffieldset_tarea">
				<legend class="flegend">Crear Nueva Tarea</legend>
					<span class="alerta_mensaje"><?echo $mensaje_email?></span>
					<div class="clear"></div>
					<label for="finput" class="flabel">Descripci&oacute;n:</label>
					<input name="descr" type="text" class="finput" id="descr" value="<? echo $descr?>" tabindex="3" maxlength="100" style="width:400px;"/>
					<div class="clear"></div>
					<label for="finput" class="flabel">Detalle:</label>
					<textarea name="detalle" id="detalle" tabindex="2" class="finput" rows="10" style="width:400px;"><? echo $detalle?></textarea>
					<div class="clear"></div>
					<hr>
					<label for="finput" class="flabel">Asignado a:</label>
					<select name="asignado" class="finput" id="asignado" tabindex="1" style="width:300px;" onchange="Recarga(<?echo $cod_grupo?>,<?echo $cod_familia?>)">
					<option value="0" selected>Seleccione una opcion</option>
					<?$usuarios = $seiDAO->obtenerListaUsuario();
					foreach ($usuarios as $usuario){
						if ($asignado == $usuario->id_usuario){?>
							<option value=<?echo $usuario->id_usuario;?> selected><?echo $usuario->nombre;?></option>
						<?}else{?>
							<option value=<?echo $usuario->id_usuario;?>><?echo $usuario->nombre;?></option>
						<?}
					}?>
					</select>
					<div class="clear"></div>
					<label for="finput" class="flabel">Fecha Inicio:</label>
					<input name="fecini" type="text" class="finput" id="fecini" value="<? echo $fecini?>" onkeypress="return numeros(event)" tabindex="3" maxlength="10" style="width:100px;"/>&nbsp;&nbsp;
					  <img src="images/calendario.png" border="0" title="Fecha Inicio" id="lanzador1">
						<!-- script que define y configura el calendario--> 
						<script type="text/javascript"> 
						   Calendar.setup({ 
							inputField     :    "fecini",     // id del campo de texto 
							 ifFormat     :     "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
							 button     :    "lanzador1"     // el id del botón que lanzará el calendario 
						}); 
						</script>
	
					<div class="clear"></div>
					<label for="finput" class="flabel">Fecha Termino:</label>
					<input name="fecfin" type="text" class="finput" id="fecfin" value="<? echo $fecfin?>" onkeypress="return numeros(event)" tabindex="3" maxlength="10" style="width:100px;"/>&nbsp;&nbsp;
						<img src="images/calendario.png" border="0" title="Fecha Termino" id="lanzador2">
						<!-- script que define y configura el calendario--> 
						<script type="text/javascript"> 
						   Calendar.setup({ 
							inputField     :    "fecfin",     // id del campo de texto 
							 ifFormat     :     "%d-%m-%Y",     // formato de la fecha que se escriba en el campo de texto 
							 button     :    "lanzador2"     // el id del botón que lanzará el calendario 
						}); 
						</script>
						
					<div class="clear"></div>
					<label for="finput" class="flabel">Prioridad:</label>
					<select name="prioridad" class="finput" id="prioridad" tabindex="1" style="width:300px;" onchange="Recarga(<?echo $cod_grupo?>,<?echo $cod_familia?>)">
					<?$codigos = $seiDAO->obtenerListas(3);
					foreach ($codigos as $codigo){
						if ($prioridad == $codigo->descr){?>
							<option value=<?echo $codigo->cod_codigo;?> selected><?echo $codigo->descr;?></option>
						<?}else{?>
							<option value=<?echo $codigo->cod_codigo;?>><?echo $codigo->descr;?></option>
						<?}
					}?>
					</select>
					
					<div class="clear"></div>
					<label for="finput" class="flabel">Tipo Tarea:</label>
					<select name="tipo_req" class="finput" id="tipo_req" tabindex="1" style="width:300px;" onchange="Recarga(<?echo $cod_grupo?>,<?echo $cod_familia?>)">
					<?$codigos = $seiDAO->obtenerListas(5);
					foreach ($codigos as $codigo){
						if ($tipo_req == $codigo->descr){?>
							<option value=<?echo $codigo->cod_codigo;?> selected><?echo $codigo->descr;?></option>
						<?}else{?>
							<option value=<?echo $codigo->cod_codigo;?>><?echo $codigo->descr;?></option>
						<?}
					}?>
					</select>
					
					<div class="clear"></div>
					<input type="button" value="Crear Tarea" name="botoncillo" id="botoncillo" class="boton_cotizar" tabindex="7" onClick="Validaciones(<?echo $id_tarea ?>)"><br>
					<!--fin content-->
					<div class="clear"></div>
					<span class="alerta_mensaje"><?echo $mensaje_email?></span>
				</fieldset>
			</div>
		</form>
		</div>
		<div class="clear"></div>
		<!--pie de pagina-->
		<?include("pie_pagina.php");?>
	</div>
	<!--fin contenedor general-->
	</body>
</html>
