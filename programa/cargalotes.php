<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Travertino Andino S.A</title>
<meta name="keywords" content="travertino andino s.a marmol piedras" />
<meta name="description" content="Una aplicacion web para llevar acabo cuentas y gerenciamiento de datos de la empresa Travertino Andino S.A" />
<link href="estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript">
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
				<li><a href="bloques.php">Bloques y filania</a></li>
				<li><a href="cargalotes.php" class="current">Lotes</a></li>
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
				require_once("funciones.php");
				conectarse();
				/*$consulta = mysql_query("SELECT id FROM lotes ORDER BY id DESC");
				$ultimoid = mysql_result($consulta, 0);*/
			?>
				<div class="templatemo_title">
                    	CARGA DE LOTES
                </div>
				<form action="logout.php" method="post">
				<p>Fecha: <select name="day">
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
  <option value="13">13</option>
  <option value="14">14</option>
  <option value="15">15</option>
  <option value="16">16</option>
  <option value="17">17</option>
  <option value="18">18</option>
  <option value="19">19</option>
  <option value="20">20</option>
  <option value="21">21</option>
  <option value="22">22</option>
  <option value="23">23</option>
  <option value="24">24</option>
  <option value="25">25</option>
  <option value="26">26</option>
  <option value="27">27</option>
  <option value="28">28</option>
  <option value="29">29</option>
  <option value="30">30</option>
  <option value="31">31</option>
</select>&nbsp;<select name="month">
  <option value="01">01</option>
  <option value="02">02</option>
  <option value="03">03</option>
  <option value="04">04</option>
  <option value="05">05</option>
  <option value="06">06</option>
  <option value="07">07</option>
  <option value="08">08</option>
  <option value="09">09</option>
  <option value="10">10</option>
  <option value="11">11</option>
  <option value="12">12</option>
</select>&nbsp;<select name="year">
  <option value="2015">2015</option>
  <option value="2012">2012</option>
  <option value="2013">2013</option>
  <option value="2014">2014</option>
  <option value="2016">2016</option>

</select></p>
				<p>Producto: </p>
				<select name="producto">
				<?php
				$consultita = mysql_query("SELECT * FROM productos");
				while($u = mysql_fetch_assoc($consultita))
				{
					echo "<option value='".$u["producto"]."'>".$u["producto"]."</option>";
				}
				?>
				</select>
				<p>Metros cuadrados: </p><input type="text" name="mcuadrados"></input>
				<p>Corte: </p><select name="corte"><option value="agua">Agua</option><option value="veta">Veta</option></select></br></br>
				<p>Color: </p><select name="color">
							<?php
				$consultita = mysql_query("SELECT * FROM colores");
				while ($u = mysql_fetch_assoc($consultita)) {
					echo "<option value='" . $u["color"] . "'>" . $u["color"] . "</option>";
				}
				?>
					</select>
				</br></br>
				<input type="submit" value="Ingresar" name="ingresarlote"></input>

				</form>
				</br>
				<div class="templatemo_title">
                    	LOTES (ULTIMOS 5)
                </div>
				
				<table border="1">
					<tr>
					<td style="background-color:white;"><b>Lote</b></td>
					<td style="background-color:white;"><b>Fecha</b></td>
					<td style="background-color:white;"><b>Producto</b></td>
					<td style="background-color:white;"><b>Metros Cuadrados</b></td>
					<td style="background-color:white;"><b>Corte</b></td>
					<td style="background-color:white;"><b>Color</b></td>
					</tr>
					 <?php
					require_once("funciones.php");
					conectarse();
					$consulta = mysql_query("SELECT * FROM lotes ORDER BY id DESC LIMIT 5");
					$consultaultimo = mysql_query("SELECT * FROM lotes ORDER BY id DESC LIMIT 1");
					$ultimo = mysql_result($consultaultimo, 0);
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
				</table>
			<?php
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
		</div>
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
