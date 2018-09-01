<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Travertino Andino S.A</title>
<meta name="keywords" content="travertino andino s.a marmol piedras" />
<meta name="description" content="Una aplicacion web para llevar acabo cuentas y gerenciamiento de datos de la empresa Travertino Andino S.A" />
<link href="estilo.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="../font-awesome-4.3.0/css/font-awesome.min.css">
<script language="javascript" type="text/javascript">
function clearText(field){

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;

}
</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
<script> 
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").slideToggle("slow");
  });
});
</script>
<!--[if lt IE 7]>
<style type="text/css">
    
    .templatemo_icon_home { behavior: url(iepngfix.htc); }
    .templatemo_icon_cube { behavior: url(iepngfix.htc); }
    .templatemo_icon_tick { behavior: url(iepngfix.htc); }
    
</style>
<![endif]-->
</head>
<body>
	<div id="templatemo_container">
		<div id="templatemo_header">
        	<div id="templatemo_login">
			<?php
			if(isset($_SESSION["logueado"]))
			{?>
            	<form method="post" action="logout.php">
                    <label>Login:</label>
                	  <input type="submit" name="logout" value="" class="boton"/>
               	</form>
			<?php
			}
			?>
            </div>
        </div><!-- End Of Header -->
        
        <div id="templatemo_content">
        	<div id="templatemo_left_content">
            	<div class="templatemo_menu">
                	<ul>
						<li><a href="index.php">Inicio</a></li>
					</ul>
                </div>

            <div class="templatemo_section_bottom_line"></div>
			
			<div class="templatemo_menu">
			<center><h3 style="color:#9bcdff;">Consultas</h3></center>
			<ul>
				<li><a href="lotes.php?q=bloques" <?php if($_GET["q"] == "bloques"){ echo "class='current'"; } ?>>Bloques</a></li>
				<li><a href="lotes.php?q=filania" <?php if($_GET["q"] == "filania"){ echo "class='current'"; } ?>>Filania</a></li>
				<li><a href="lotes.php?q=lotes" <?php if($_GET["q"] == "lotes"){ echo "class='current'"; } ?>>Lotes</a></li>
				<li><a href="ordenpedido.php">Orden de pedido</a></li>
				<li><a href="ordenproduccion.php">Orden de produccion</a></li>
			</ul>
		</div>
		<div class="templatemo_section_bottom_line"></div>
		
		<div class="templatemo_menu">
				<center><h3 style="color:#9bcdff;">Cargas</h3></center>
				<ul>
					<li><a href="bloques.php">Bloques y filania</a></li>
					<li><a href="cargalotes.php">Lotes</a></li>
					<li><a href="productos.php">Productos</a></li>
					<li><a href="cordenpedido.php">Orden de pedido</a></li>
					<li><a href="cordenproduccion.php">Orden de produccion</a></li>
				</ul>
		</div>
	<div class="templatemo_section_bottom_line"></div>
			
			
            <div class="templatemo_section">
            	<div class="templatemo_icon_cube">
              		<h1>AYUDA</h1>
                    <p>
                    	Consulte la guia de ayuda en cualquier momento haciendo click <a href="ayuda.php">aqui</a>.
                    </p>
                </div>
			</div>
            <div class="templatemo_section_bottom_line"></div>
            
            <div class="templatemo_section">
            	<div class="templatemo_icon_tick">
                	<h1>PROTECCION</h1>
                    <p>
                    	Su sistema de datos esta protegido
                    </p>
                </div>
			</div>
            <div class="templatemo_section_bottom_line"></div>
            

            </div><!-- End Of left Content -->
            <div id="templatemo_right_content">
				<div id="templatemo_content_area">
				<?php
				if(isset($_SESSION["logueado"]))
				{
					if(isset($_GET["q"]))
					{
						if($_GET["q"] == "bloques")
						{
							if(isset($_POST["borrarbloque"]))
							{
								require_once("funciones.php");
								conectarse();
								$idbloque = $_POST["idbloque"];
								$kueri = mysql_query("DELETE FROM bloques WHERE id = '$idbloque'");
								if($kueri)
								{
									mysql_query("UPDATE enqueid SET valor = valor - 1");
									echo "<p>El bloque ".$idbloque.", ha sido eliminado exitosamente.</p>";
								}
								else
								{
									echo "<p>Hubo un error en la eliminacion. Por favor, intentelo nuevamente.</p>";
								}
							}
						?>
							<div class="templatemo_title">
								BLOQUES
							</div>
							<div id="flip"><h3 style="color:#9bcdff;">Click aqui para ordenar por fecha</h3></div>
							<form action="lotes.php?q=bloques&ordenar=1" method="post">
							<?php
							if(isset($_GET["ordenar"]))
							{//Lo mismo pero con la fecha ya puesta, y el coso display-eado
							?>
							<div id="panel">
							<p>De la fecha:</p><input type="date" name="fechab" value="<?php echo $_POST["fechab"]; ?>"></input>
							</br>
							<p>A la fecha:</p><input type="date" name="fechab2" value="<?php echo $_POST["fechab2"]; ?>"></input>
							</br></br>
							<input type="submit" name="ordenarxfecha" value="Ordenar"></input></br></br></br>
							</div>
							<?php
							}//Lo normal
							else
							{
							?>
							<div style="display:none;" id="panel">
							<p>De la fecha:</p><input type="date" name="fechab"></input>
							</br>
							<p>A la fecha:</p><input type="date" name="fechab2"></input>
							</br></br>
							<input type="submit" name="ordenarxfecha" value="Ordenar"></input></br></br></br>
							</div>
							<?php
							}
							?>
							</form>
							<table border="1">
							<tr>
							<td style="background-color:white;"><b>Fecha Ingreso</b></td>
							<td style="background-color:white;"><b>Remito</b></td>
							<td style="background-color:white;"><b>Bloque</b></td>
							<td style="background-color:white;"><b>Alto</b></td>
							<td style="background-color:white;"><b>Ancho</b></td>
							<td style="background-color:white;"><b>Profundo</b></td>
							<td style="background-color:white;"><b>Toneladas</b></td>
							<td style="background-color:white;"><b>Color</b></td>
							<td style="background-color:white;"><b>Observaciones</b></td>
							<td style="background-color:white;"><b>Fecha Egreso</b></td>
							</tr>
							 <?php
							require_once("funciones.php");
							conectarse();
							if(isset($_GET["ordenar"]) == false)
							{
								$consulta = mysql_query("SELECT * FROM bloques");
							}
							else
							{
								$fechab = $_POST["fechab"];
								$fechab2 = $_POST["fechab2"];
								$consulta = mysql_query("SELECT * FROM bloques WHERE fechai >= '$fechab' AND fechai <= '$fechab2'");
							}
							$consultaultimo = mysql_query("SELECT valor FROM enqueid");
					/*		if ($consultaultimo == FALSE){ 
								    die(mysql_error()); // TODO: better error handling
								}*/
							$ultimo = mysql_result($consultaultimo, 0);
							$ultimo = $ultimo - 1;
							while($u = mysql_fetch_assoc($consulta))
							{
								if($u["disp"] == 1)
								{
									$colorfondo = "white";
								}
								else
								{
									$colorfondo = "red";
								}
								echo "<tr>";
								if($u["disp"] == 1)
								{
									echo "<form action='filania.php' method='post'>";
								}
								else
								{
									echo "<form action='lotes.php?q=bloques' method='post'>";
								}
								echo "<input type='hidden' name='idbloque' value='".$u["id"]."' />";
								echo "<input type='hidden' name='fechai' value='".$u["fechai"]."' />";
								echo "<input type='hidden' name='fechae' value='".$u["fechae"]."' />";
								echo "<input type='hidden' name='toneladas' value='".$u["toneladas"]."' />";
								echo "<input type='hidden' name='color' value='".$u["color"]."' />";
								echo "<input type='hidden' name='observaciones' value='".$u["observaciones"]."' />";
								echo "<td style='background-color:".$colorfondo.";'>".date("d-m-Y", strtotime($u["fechai"]))."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["remito"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["id"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["alto"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["ancho"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["profundo"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["toneladas"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["color"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["observaciones"]."</td>";
								if($u["fechae"] > 0)
								{
									echo "<td style='background-color:".$colorfondo.";'>".date("d-m-Y", strtotime($u["fechae"]))."</td>";
								}
								else
								{
									echo "<td style='background-color:".$colorfondo.";'>".$u["fechae"]."</td>";
								}
								if($u["id"] == $ultimo)
								{
									if($u["disp"] == 1)//Para ver si es un bloque a egresar
									{
										echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar'/></td>";
										echo "<td style='background-color:white;'><input type='submit' name='borrarbloque' value='Borrar'/></td>";
									}
									else
									{
										echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar' disabled='disabled'/></td>";
										echo "<td style='background-color:white;'><input type='submit' name='borrarbloque' value='Borrar'/></td>";
									}
								}
								else
								{
									if($u["disp"] == 1)
									{
										echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar'/></td>";
									}
									else
									{
										echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar' disabled='disabled'/></td>";
									}
								}
								echo "</form>";
								echo "</tr>";
							}
							?>
							</table></br>
							<p><b>Nota: Para borrar un bloque, el mismo debe estar egresado primero.</b></p>
						<?php
						}
						elseif($_GET["q"] == "filania") //SUJETO A BORRAR. QUIZAS NO SE NECESITA
						{
						?>
							<div class="templatemo_title">
								FILANIA
							</div>
							<table class="table_filania">
							<thead>
								<tr>
							<td><b>Fecha</b></td>
							<td><b>Bloque</b></td>
							<td><b>Toneladas</b></td>
							<td><b>Color</b></td>
							<td class="mas_padding"><b>M<sup>L</sup></b></td>
							<td class="mas_padding"><b>M<sup>2</sup></b></td>
							<td><b>Horas</b></td>
							<td><b>Corte</b></td>
							<td><b>Observaciones</b></td>
							</tr>
							</thead>
								<tbody>
							 <?php
							require_once("funciones.php");
							conectarse();
							$consulta = mysql_query("SELECT * FROM filania");
							while($u = mysql_fetch_assoc($consulta))
							{
								if($u["disp"] == 1)
								{
									$colorfondo = "";
								}
								else
								{
									$colorfondo = "red";
								}
								echo "<tr>";
								echo "<form action='filania.php' method='post'>";
								echo "<input type='hidden' name='idf' value=".$u['id']."></input>";
								echo "<td style='background-color:".$colorfondo.";'>".date("d-m-Y", strtotime($u["fecha"]))."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["bloque"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["toneladas"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["color"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["mlineales"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["mcuadrados"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["horas"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["corte"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["observaciones"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'><button type='submit' name='borrarf' class='icon-remove-sign' ></button></td>";
								echo "</form>";
								echo "</tr>";
							}
							?>
								</tbody>
							</table>
						<?php
						}
						elseif($_GET["q"] == "lotes")
						{
							if(isset($_POST["borrarlote"]))
							{
								require_once("funciones.php");
								conectarse();
								$idlote = $_POST["idlote"];
								$borrado = mysql_query("DELETE FROM lotes WHERE id = '$idlote'");
								if($borrado)
								{
									echo "<p>Lote ".$idlote." borrado con exito</p>";
								}
								else
								{
									echo "<p>Error al borrar lote ".$idlote.". Intentelo nuevamente.</p>";
								}
							}
						?>
							<div class="templatemo_title">
								LOTES
							</div>
							<table class="table_lotes">
								<thead><tr>
									<td><b>Lote</b></td>
									<td><b>Fecha</b></td>
									<td><b>Producto</b></td>
									<td><b>M²</b></td>
									<td><b>Corte</b></td>
									<td><b>Color</b></td>
								</tr></thead>
								<tbody>
							 <?php
							require_once("funciones.php");
							conectarse();
							$consulta = mysql_query("SELECT * FROM lotes");
							$consultaultimo = mysql_query("SELECT * FROM lotes ORDER BY id DESC LIMIT 1");
							$ultimo = mysql_result($consultaultimo, 0);
							while($u = mysql_fetch_assoc($consulta))
							{
								if($u["disp"] == 1)
								{
									$colorfondo = "";
								}
								else
								{
									$colorfondo = "red";
								}
								echo "<tr>";
								if($u["disp"] == 1)
								{
									echo "<form action='lotes.php?q=lotes' method='post'>";
								}
								else
								{
									echo "<form action='lotes.php?q=lotes' method='post'>";
								}
								echo "<input type='hidden' name='idlote' value='".$u["id"]."' />";
								echo "<td style='background-color:".$colorfondo.";'>".$u["id"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".date("d-m-Y", strtotime($u["fecha"]))."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["producto"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["mcuadrados"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["aov"]."</td>";
								echo "<td style='background-color:".$colorfondo.";'>".$u["color"]."</td>";
								if($u["id"] == $ultimo)
								{
									if($u["disp"] == 1)//Para ver si es un bloque a egresar
									{
										echo "<td style='background-color:white;'><input type='submit' name='borrarlote' value='Borrar'/></td>";
									}
									else
									{
										echo "<td style='background-color:white;'><input type='submit' name='borrarlote' value='Borrar'/></td>";
									}
								}
								echo "</form>";
								echo "</tr>";
							}
							?>
								</tbody>
						</table>
						<?php
						}
					}
					else
					{
					?>
                	<div class="templatemo_title">
                    	Consultas
                    </div>
                    
                    <p><a href="lotes.php?q=bloques">Ver bloques</a></p>
					<p><a href="lotes.php?q=filania">Ver filania</a></p>
					<p><a href="lotes.php?q=lotes">Ver lotes</a></p>
					
					<?php
					}
					?>

                    
			  </div>
            </div><!-- End Of Right Content -->
			<?php
			}
			else
			{
				echo "<div class='templatemo_title'>
                   	LOGUEO
                </div>
                    
                <p>Usted debe estar <a href='index.php'>logueado</a> para poder utilizar cualquier funcion del sistema.</p>
				</div>
				</div>";
			}
			?>
            <div id="templatemo_right_content_bottom">
            	Copyright © 2014 Travertino S.A
            </div>
        </div><!-- End Of Content -->
    </div><!-- End Of Container -->
	<!--  Free CSS Templates from www.TemplateMo.com  -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>
