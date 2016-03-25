<?php
require_once ('SeiDAO.class.php');
session_start();


if(isset ($_GET['action'])){
    //Si el cliente ha seleccionado un producto
	$destacado= $_GET['destacado'];
	$cod_grupo= $_GET['cod_grupo'];
	$cod_familia= $_GET['cod_familia'];
	switch ($_GET['action']){
        case 'agregar':
            //Recupero el producto de codigo indicado en la base de datos
            $productoDAO = new ProductoDAO();
			//Inserto contador de visitas al producto
			$visitas = $productoDAO->guardaContadorVisitas((int)$_GET['idGrupo'].(int)$_GET['idFamilia'].(int)$_GET['idProducto']);
			
			$producto = $productoDAO->obtenerProducto((int)$_GET['idGrupo'],(int)$_GET['idFamilia'],(int)$_GET['idProducto']);
            //Agrego al carrito de compras el producto recuperado de la base de datos
            $carrito->agregarProducto($producto);
			
			//Guardo nuevamente el carrito de la session
			$_SESSION['carrito'] = $carrito;

			header('Location: cotizar.php');
			exit(); //Paramos el script
	
            break;

        case 'vacear':
            //Reemplazo el atributo carrito de la sesion con un objeto carrito sin productos
            $carrito = new Carrito(session_id(),session_id(),session_id());
            break;

        case 'eliminar':
            //$carrito = new Carrito(session_id());
            $carrito->eliminarProducto((int)$_GET['idGrupo'],(int)$_GET['idFamilia'],(int)$_GET['idProducto']);
            break;

        case 'actualizar': 
            //Atrapamos el nombre y valor de todos los textbox...
            //Luego vemos si tanto el codigo y la cantidad son mayores que 0.
            //Y actualizamos la cantidad 1 a 1 de cada producto
            foreach($_GET as $cod_producto => $cantidad){
                    if((int)$cod_producto > 0 && (int)$cantidad > 0){
                        //Actualizamos la cantidad para un mismo producto
                        $carrito->actualizarCantidadIngresada($cod_producto, $cantidad);
                    }
            }          
            break;

        case 'guardar':
            $productoDAO = new ProductoDAO();
            $facnum = $productoDAO->guardarFactura($carrito->productos,$carrito->calcularMonto(),$carrito->calcularDescuento(),$carrito->calcularPrecioTotal());
            break;
    }
    
    
    header('Location: listado_tarea.php?destacado='.$destacado.'&cod_grupo='.$cod_grupo.'&cod_familia='.$cod_familia);
    exit(); //Paramos el script
}

//Parámetros de entrada

//Muestra todas las tareas
$seiDAO = new SeiDAO;
$tareas = $seiDAO->obtenerListado(0,0,0);
$num_total_registros = count($tareas);

$nro_registros = 20; //temporalmente habilitado para mostrar el maximo de registros por pagina
$pagina = false;

//examino la pagina a mostrar y el inicio del registro a mostrar
if (isset($_SESSION["pagina"]))
	$pagina = $_SESSION["pagina"];
	
if (!$pagina) {
	$inicio = 0;
	$pagina = 1;
}
else {
	$inicio = ($pagina - 1) * $nro_registros;
}

//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $nro_registros);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Listado Productos | <?echo $empresa->fantasia?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<meta name="author" content="<?echo $empresa->fantasia?>" />
	<meta name="robots" content="all" />
	<meta name="Reply-to" content="<?echo $empresa->email?>" />
	<meta name="keywords" content="<?echo $Obtenerkeywords?>" />
	<meta name="descripcion" content="<?echo $empresa->descripcion?>" />
	<link type="image/x-icon" href="images/contemplor.ico" rel="shortcut icon" />
	<link type="image/x-icon" href="images/contemplor.ico" rel="icon" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="pragma" content="no-cache" />

	<link rel="stylesheet" type="text/css" href="css/wa-style.css">
	<script type="text/javascript">
		function valida(e){
		  tecla=(document.all) ? e.keyCode : e.which;
		  if(tecla == 13)
			Validacion_Buscar()
		}

		function Validacion_Buscar(){ 
			if (document.frmlistado.txt_buscar.value==''){
				alert('Debe ingresar una descripcion de Producto');
				document.frmlistado.txt_buscar.focus();  
			}else{
				var descr_prod = document.frmlistado.txt_buscar.value;
				document.frmlistado.action="envio_producto.php?pag_actual=Busqueda&descr_prod="+descr_prod;
				document.frmlistado.submit();
			}
		}
		
		function Recarga(cod_grupo, cod_familia)
			{	
				var combo = document.getElementById("registros");
				var nro_registros = combo.options[combo.selectedIndex].text; 
				document.frmlistado.action="envio_producto.php?pag_actual=Listado&cod_grupo=" + cod_grupo + "&cod_familia=" + cod_familia + "&nro_registros=" + nro_registros;
				document.frmlistado.submit();
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
			<form name="frmlistado" action="listado_tarea.php" method="post">
			
			<!--inicio content-->
			<div class="content_productos">
				<div id="top-info">
					<a href="javascript:void(0);" onclick="window.location='catalogo.php';"><img src="images/icono_atras.png" alt="atras" width="25" height="20"/></a>
				</div>
				<h1>Listado de Tareas</h1>
				<?//Muestra todos los productos
                $seiDAO = new SeiDAO;
				$tareas = $seiDAO->obtenerListado(0,$inicio,$nro_registros);
				$i=1;?>
				<table border="0" width="770" cellspacing="0">
					<tr class="titulo_cajita"  valign="middle" style="background: #ebebeb;">
						<td colspan="3"><? echo "Encontrado(s): ".$num_total_registros. " producto(s)"?></td>
					</tr>
					<tr class="titulo_cajita_bold">
						<td colspan="2">Mostrando la p&aacute;gina <?echo $pagina?> de <?echo $total_paginas?> p&aacute;gina(s).</td>
						<td align="right">
							<?if ($total_paginas > 1) {
								if ($pagina != 1)
									echo '<a href="envio_producto.php?pag_actual=Listado&cod_grupo='.$cod_grupo.'&cod_familia='.$cod_familia.'&nro_registros='.$nro_registros.'&pagina='.($pagina-1).'"><img src="images/izq.gif" border="0"></a>';
								for ($i=1;$i<=$total_paginas;$i++) {
									if ($pagina == $i)
										//si muestro el indice de la pagina actual, no coloco enlace
										echo '  <span class="titulo_verde_cajita_bold">'.$i.'</span>  ';
									else
										//si el indice no corresponde con la pagina mostrada actualmente,
										//coloco el enlace para ir a esa pagina
										echo '  <a href="envio_producto.php?pag_actual=Listado&cod_grupo='.$cod_grupo.'&cod_familia='.$cod_familia.'&nro_registros='.$nro_registros.'&pagina='.$i.'">'.$i.'</a>  ';
								}
								if ($pagina != $total_paginas)
									echo '<a href="envio_producto.php?pag_actual=Listado&cod_grupo='.$cod_grupo.'&cod_familia='.$cod_familia.'&nro_registros='.$nro_registros.'&pagina='.($pagina+1).'"><img src="images/der.gif" border="0"></a>';
							}?>
						</td>
					</tr>
					<tr>
						<td colspan="3" style="height: 20px;">&nbsp;</td>
					</tr>
				</table>
				<table border="0" width="770">
				<?foreach ($tareas as $tarea){?>
					
						<!-- MUESTRA LOS PRODUCTOS EN LISTA-->
						<tr valign = "middle" onMouseOver="this.style.background='#ebebeb'" onMouseOut="this.style.background=''">
							<td width="60px" align="center"><b><a href="javascript:void(0);" onClick="window.location='crear_tarea.php?action=ver&id_tarea=<?echo $tarea->id_tarea?>'"><?echo $tarea->id_tarea?></a>
							<td width="60px" align="center"><?php echo $tarea->fec_creacion ;?></td>
							<td width="60px" align="center"><?php echo $tarea->descr ;?></td>
							<td width="60px" align="center"><?php echo substr($tarea->detalle,0,70);?></td>
						</tr>
								
					
					<?$i=$i+1;
				}?>
				</table>	
	
				<div class="clear"></div>
				<div align="center">
					<?if ($total_paginas > 1) {
						if ($pagina != 1)
							echo '<a href="envio_producto.php?pag_actual=Listado&cod_grupo='.$cod_grupo.'&cod_familia='.$cod_familia.'&nro_registros='.$nro_registros.'&pagina='.($pagina-1).'"><img src="images/izq.gif" border="0"></a>';
						for ($i=1;$i<=$total_paginas;$i++) {
							if ($pagina == $i)
								//si muestro el indice de la pagina actual, no coloco enlace
								echo '  <span class="titulo_verde">'.$i.'</span>  ';
							else
								//si el indice no corresponde con la pagina mostrada actualmente,
								//coloco el enlace para ir a esa pagina
								echo '  <a href="envio_producto.php?pag_actual=Listado&cod_grupo='.$cod_grupo.'&cod_familia='.$cod_familia.'&nro_registros='.$nro_registros.'&pagina='.$i.'">'.$i.'</a>  ';
						}
						if ($pagina != $total_paginas)
							echo '<a href="envio_producto.php?pag_actual=Listado&cod_grupo='.$cod_grupo.'&cod_familia='.$cod_familia.'&nro_registros='.$nro_registros.'&pagina='.($pagina+1).'"><img src="images/der.gif" border="0"></a>';
					}?>
				</div><hr>
			</div>	
			<!--fin content-->
		</form>
        </div>
		<div class="clear"></div>
		
</div>
<div class="popup-overlay"></div>

		<!--pie de pagina-->
		<?include("pie_pagina.php");?>
	</div>
	<!--fin contenedor general-->
    </body>
</html>
