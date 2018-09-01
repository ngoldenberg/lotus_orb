<?php 
session_start(); 
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Travertino Andino S.A</title>
<meta name="keywords" content="travertino andino s.a marmol piedras" />
<meta name="description" content="Una aplicacion web para llevar acabo cuentas y gerenciamiento de datos de la empresa Travertino Andino S.A" />
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
function cambiartexto(){
	$("#mlin").val($("#mcuad").val() * 0.6);
}
function clearText(field){

    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;

}
</script>
<!--[if lt IE 7]>
<style type="text/css">
    
    .templatemo_icon_home { behavior: url(iepngfix.htc); }
    .templatemo_icon_cube { behavior: url(iepngfix.htc); }
    .templatemo_icon_tick { behavior: url(iepngfix.htc); }
    
</style>
<![endif]-->
</head>
<?php
if(isset($_POST["borrarf"]))
{
	require_once("funciones.php");
	conectarse();
	$idf = $_POST["idf"];
	mysql_query("DELETE FROM filania WHERE id = '$idf'");	
}
?>
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
					<li><a href="lotes.php?q=bloques">Bloques</a></li>
					<li><a href="lotes.php?q=filania">Filania</a></li>
					<li><a href="lotes.php?q=lotes">Lotes</a></li>
					<li><a href="ordenpedido.php">Orden de pedido</a></li>
					<li><a href="ordenproduccion.php">Orden de produccion</a></li>
				</ul>
			</div>
			<div class="templatemo_section_bottom_line"></div>
			
		<div class="templatemo_menu">
				<center><h3 style="color:#9bcdff;">Cargas</h3></center>
				<ul>
					<li><a href="bloques.php" class="current">Bloques y filania</a></li>
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
					if(isset($_POST["egresar"]))
					{
						$remito = $_POST["remito"];
						$sku = $_POST["sku"];
						$nsku = $_POST["nsku"];
						$day = $_POST["day"];
						$month = $_POST["month"];
						$year = $_POST["year"];
						$fechae = $year . $month . $day;

				?>
						<div class="templatemo_title">
							FILANIA
						</div>
						<form method="post" action="logout.php">
							<p><b>Ingrese los datos para la filania del bloque <span style="color: red;" ><?php echo $nsku; ?></span></b></p>

<!--							INGRESO TODOS LOS HIDDEN-->
							<input type="hidden" name="idbloque" value="<?php echo $idbloque; ?>"/>
							<input type="hidden" name="nsku" value="<?php echo $nsku; ?>"/>
							<input type="hidden" name="sku" value="<?php echo $sku; ?>"/>

							<p>Fecha de egreso: <?php echo date("d-m-Y", strtotime($fechae)); ?></p><input type="hidden"
																										   name="fecha"
																										   value="<?php echo $fechae; ?>"/>

							<p>Toneladas: <?php echo $_POST["toneladas"]; ?></p><input type="hidden" name="toneladas"
																					   value="<?php echo $_POST["toneladas"]; ?>"/>

							<p>Color: <?php echo $_POST["color"]; ?></p><input type="hidden" name="color"
																			   value="<?php echo $_POST["color"]; ?>"/>

							<p>Metros lineales: <input id="mcuad" onchange="cambiartexto()" type="text"
													   name="mcuadrados"/></p>

							<p>Metros cuadrados: <input id="mlin" type="text" name="mlineales" readonly="readonly"/></p>

							<p>Horas empleadas: <input type="text" name="horas"/></p>

							<p>Corte: </p><select name="corte">
								<option>Agua</option>
								<option>Veta</option>
							</select>
							<?php echo "<p>Observaciones: <input name='observaciones' type='text' value='" . $_POST["observaciones"] . "' /></p>"; ?>
							</br>
							<input type="submit" name="ingresarf" value="Ingresar"></input>
					</form>
				<?php
					}
					else
					{
						?>
						<div class="templatemo_title">
                    	FILANIA
						</div>
						<table border="1">
						<tr>
						<td style="background-color:white;"><b>Fecha</b></td>
						<td style="background-color:white;"><b>Bloque</b></td>
						<td style="background-color:white;"><b>Toneladas</b></td>
						<td style="background-color:white;"><b>Color</b></td>
						<td style="background-color:white;"><b>Metros lineales</b></td>
						<td style="background-color:white;"><b>Metros cuadrados</b></td>
						<td style="background-color:white;"><b>Observaciones</b></td>
						</tr>
						 <?php
						require_once("funciones.php");
						conectarse();
						$consulta = mysql_query("SELECT * FROM filania");
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
							echo "<form action='filania.php' method='post'>";
							echo "<input type='hidden' name='idf' value=".$u['id']."></input>";
							echo "<td style='background-color:".$colorfondo.";'>".date("d-m-Y", strtotime($u["fecha"]))."</td>";
							echo "<td style='background-color:".$colorfondo.";'>".$u["bloque"]."</td>";
							echo "<td style='background-color:".$colorfondo.";'>".$u["toneladas"]."</td>";
							echo "<td style='background-color:".$colorfondo.";'>".$u["color"]."</td>";
							echo "<td style='background-color:".$colorfondo.";'>".$u["mlineales"]."</td>";
							echo "<td style='background-color:".$colorfondo.";'>".$u["mcuadrados"]."</td>";
							echo "<td style='background-color:".$colorfondo.";'>".$u["observaciones"]."</td>";
							echo "<td style='background-color:".$colorfondo.";'><input type='submit' name='borrarf' value='Borrar'></input></td>";
							echo "</form>";
							echo "</tr>";
						}
						?>
						</table>
					<?php
					}
                }
				else
				{
					echo "<div class='templatemo_title'>
                    	LOGUEO
                    </div>
                    
                    <p>Usted debe estar <a href='index.php'>logueado</a> para poder utilizar cualquier funcion del sistema.</p>";
				}
				?>				
			  </div>
            </div><!-- End Of Right Content -->
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