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
					<li><a href="cargalotes.php">Lotes</a></li>
					<li><a href="productos.php" class="current">Productos</a></li>
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
				if(isset($_POST["borrarprod"]))
				{
					require_once("funciones.php");
					conectarse();
					$idprod = $_POST["idprod"];
					$consulteta = mysql_query("DELETE FROM productos WHERE id = $idprod");
					if($consulteta)
					{
						echo "<p>Producto borrado con exito</p>";
					}
					else
					{
						echo "<p>Error</p>";
					}
				}
				require_once("funciones.php");
				conectarse();
				/*$consulta = mysql_query("SELECT id FROM lotes ORDER BY id DESC");
				$ultimoid = mysql_result($consulta, 0);*/
			?>
				<div class="templatemo_title">
                    	CARGA DE PRODUCTOS/TERMINACIONES
                </div>
				<form action="logout.php" method="post">
				<p>Ingrese un nuevo producto/terminacion: </p><input type="text" name="nuevoprod" />
				</br></br>
				<input type="submit" name="ingresarprod" value="Ingresar" />
				</form>
				</br>
				<div class="templatemo_title">
                    	PRODUCTOS EXISTENTES
                </div>
				<?php
				$consulta = mysql_query("SELECT * FROM productos");
				while($a = mysql_fetch_assoc($consulta))
				{
					echo "<form action='productos.php' method='post'>";
					echo "<p>".$a["producto"]."</p><input type='submit'  name='borrarprod' value='Borrar'/><input type='hidden' name='idprod' value='".$a["id"]."' />";
					echo "</form></br>";
				}
				?>
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