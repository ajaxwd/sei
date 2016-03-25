<?session_start();?>
	<!--inicio header-->
	<div id="header">
		<!--logo-->
		<div id="logo">
			<a title="<?$empresa->fantasia;?>.cl" href="index.php">
			<span><?$empresa->fantasia;?>.cl</span>
			</a>
		</div>
		<!--fin logo-->
		<div class="clear"></div>
	</div>
	<!--menu-->
	<div id="menuhead">
		<div id="contieneMenu">
			<!--<table width="971" border="0" bgcolor="#68a41a">
				<tr style="height: 5px;">
					<td width="480" align="left" class="titulo_blanco">Bienvenidos al sitio web de <?echo $empresa->fantasia;?></td>
					<td align="right" class="titulo_blanco" style="font-size: 15px;"><img src="images/fono.png" title="fono" alt="fono" class="dimensionar" style="width: 20px;"/>&nbsp;<?echo $empresa->fono;?></td>
				</tr>
			</table>-->
			<div id="menu">
			<? $seiDAO = new SeiDAO();
			$modulos = $seiDAO->obtenerMenu($_SESSION['Sei_CodPerfil']);
			$i = 1;
			foreach ($modulos as $modulo){?>
					<a href="<?echo $modulo->url?>" class="men2"><?echo $modulo->descr?></a>
			<?$i=$i+1;
			}?>
			&nbsp;&nbsp;<span class="titulo_productos">Buscar SEI:</span> <input type="text" name="buscar">
			<input type="button" class="link_button" value="Buscar" name="buscar" onclick="" />
			</div>
		</div>
	</div>
	<!--fin menu-->
	<div class="clear"></div>
	<span class="titulo_productos" align="right">Bienvenido <?echo $_SESSION['Sei_NomUsuario']?>  |  Perfil: <?echo $seiDAO->obtenerDescripcion(1,$_SESSION['Sei_CodPerfil'])?>  |  <a href="principal.php?action=cerrar">Cerrar Sesi&oacute;n</a></span>
	<div class="clear"></div>
	<!--</div><div class="clear"><!--</div>-->
	
	<!--fin header-->
