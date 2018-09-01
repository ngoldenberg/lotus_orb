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
	<?php
	if(isset($_SESSION["logueado"]) == false)
	{
		//Sangria en blanco a arreglar
		?>
			<div id="templatemo_header">
				<div id="templatemo_login">
					<form method="post" action="logout.php">
						<label>Login:</label>
						  <input name="username" value="usuario" type="text" onfocus="clearText(this)" onblur="clearText(this)" class="textfield"/>
						  <input name="password" value="clave" type="password" onfocus="clearText(this)" onblur="clearText(this)" class="textfield"/>
						  <input type="submit" name="login" value="" class="button"/>
					</form>
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
						<div class="templatemo_title">
							BIENVENIDO
						</div>
						
						<p>En construccion.</p>

						
				  </div>
				</div><!-- End Of Right Content -->
				<div id="templatemo_right_content_bottom">
					Copyright © 2014 Travertino S.A
				</div>
			</div><!-- End Of Content -->
		<?php
	}
	else
	{
	?>
	<div id="templatemo_header">
		<div id="templatemo_login">
			<form method="post" action="logout.php">
				<label>Login:</label>
				  <input type="submit" name="logout" value="" class="boton"/>
			</form>
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
				<li><a href="ordenpedido.php" class="current">Orden de pedido</a></li>
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
				<div class="templatemo_title">
					-
				</div>
				
				<p>En construccion.</p>

				
		  </div>
		</div><!-- End Of Right Content -->
		<div id="templatemo_right_content_bottom">
			Copyright © 2014 Travertino S.A
		</div>
	</div>
	<?php
	}
	?>
    </div><!-- End Of Container -->
	<!--  Free CSS Templates from www.TemplateMo.com  -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>