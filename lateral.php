<?php 
require_once ('ProductoDAO.class.php');
session_start();

?>

	<!--inicio r-sidebar-->
	<!--Inicio contenido sidebar derecho-->
	<div class="r-sidebar_principal">
		<div class="cajita_lateral">		
			<div class="lateral titulo" style="color:#fff; border:solid 1px #5a5a5a; 
			background: #5a5a5a;">C&Aacute;TALOGO VIRTUAL</div>
			<div class="clear"></div><br>
			<table align="center" border="0" width="150">
				<tr style="height: 22px" onMouseOver="this.style.background='#D6D6D6'" onMouseOut="this.style.background=''">
					<td valign="middle" style="color:#D6D6D6; border-bottom:solid 1px #D6D6D6;"><a href="corporativo" target="_blank"><span class="titulo_plomo">- Cat&aacute;logo Corporativo</span></a></td>
				</tr>
				<tr style="height: 22px" onMouseOver="this.style.background='#D6D6D6'" onMouseOut="this.style.background=''">
					<td valign="middle" style="color:#D6D6D6; border-bottom:solid 1px #D6D6D6;"><a href="industrial" target="_blank"><span class="titulo_plomo">- Cat&aacute;logo Industrual</span></a></td>
				</tr>
			</table>
			<div class="clear"></div><br><br>
			<div class="lateral titulo" style="color:#fff; border:solid 1px #5a5a5a; 
			background: #5a5a5a;">CATEGOR&Iacute;AS</div>
			<div class="clear"></div>
			<?foreach ($categorias as $categoria){?>
				<!--<img src="images/punto.jpg" />&nbsp;
					<a href="envio_producto.php?pag_actual=Listado&cod_grupo=<?echo $categoria->cod_codigo?>&cod_familia=0">
						<span class="titulo_productos_bold"><?echo $categoria->descr?></span>
					</a>-->
				<div class="clear"></div><br>
				<table align="center" border="0" width="150">
					<?$color=0;
					$codigos = $productoDAO->obtenerCodigos(3,0,$categoria->cod_codigo);
					foreach ($codigos as $codigo){
					if ($color==0){
						$dcolor="#D6D6D6";
						$color=1;
					}elseif ($color==1){
						$dcolor="#D6D6D6";
						$color=2;
					}elseif ($color==2){
						$dcolor="#D6D6D6";
						$color=3;
					}elseif ($color==3){
						$dcolor="#D6D6D6";
						$color=0;
					}
					?>
					<tr style="height: 22px" onMouseOver="this.style.background='#D6D6D6';" onMouseOut="this.style.background=''">
						<td valign="middle" style="color:#D6D6D6; border-bottom:solid 1px #D6D6D6;">- <a href="envio_producto.php?pag_actual=Listado&cod_grupo=<?echo $categoria->cod_codigo?>&cod_familia=<?echo $codigo->cod_codigo?>"><span class="titulo_plomo"><?echo $codigo->descr?></span></a></td>
					</tr>
					<tr style="height: 2px">
						<td></td>
					</tr>
					<?}?>
				</table>
			<?}?>
		</div>
		<div class="clear"></div><br><br>
		<div class="lateral titulo" style="color:#67A41A; border-top:solid 1px #67A41A; border-right:solid 1px #67A41A;">B&Uacute;SQUEDA</div>
		<div class="clear"></div>
		<label for="finput_principal" class="titulo_cajita">&nbsp;Producto:&nbsp;</label>
		<input name="txt_buscar" class="finput_principal" id="buscar" value="<? echo $buscar?>" type="text" style="width: 135px" maxlength="60"
		onkeypress="valida(event)">
		<div class="clear"></div><br>
		<input type="button" value="Buscar" name="Buscar" class="boton_buscar" onClick="Validacion_Buscar();"><br>
		<div class="clear"></div><br><br>
		<div class="lateral titulo" style="color:#da4531; border-top:solid 1px #da4531; border-right:solid 1px #da4531;">LO M&Aacute;S VISTO</div>
		<div class="clear"></div>
		<?$visitas = $productoDAO->obtenerVisitas();
		$cont=1;
		foreach ($visitas as $visita){?>
			<div class="cajita_visita">
				<table align="center" border="0" width="110">
					<tr height="10">
						<td colspan="2"></td>
					</tr>
					<tr height="80" valign="middle">
						<td valign="top"><img src="images/nro_<?echo $cont?>.png" alt="visitas" border="0" title="visitas"/></td>
						<td width="90" align="left" valign="middle">
							<a href="envio_producto.php?visita=1&cod_producto=<?php echo $visita->cod_prod?>">
							<img src="<?php echo $visita->imagen?>" title="productos" alt="productos" class="dimensionar" style="width: 42px;"/></a>
						</td>	
					</tr>
					<tr align="left">
						<td colspan="2" height="35" align="left">
							<a href="envio_producto.php?visita=1&cod_producto=<?php echo $visita->cod_prod?>">
							<span class="titulo_cajita"><?php echo substr($visita->descr,0,40)?></span></a>
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<!--<span class="titulo_productos">$<?php echo number_format($visita->precio, 0, '', '.')?>.-</span><br><span class="titulo_productos">IVA Incluído</span>-->
						</td>	
					</tr>
				</table>
			</div>
		<?$cont=$cont+1;
		}?>
	</div>
	<!--fin r-sidebar-->

</body>
</html>