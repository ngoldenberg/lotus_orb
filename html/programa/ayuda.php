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
			
			
            <div class="templatemo_section">
            	<div class="templatemo_icon_cube">
              		<h1>AYUDA</h1>
                    <p>
                    	Consulte la guia de ayuda en cualquier momento haciendo click <a>aqui</a>.
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
                    	GUIA DE AYUDA
                    </div>
                    
                    <p>Ayuda en construccion.</p>
                    
            </div><!-- End Of Right Content -->
            <div id="templatemo_right_content_bottom">
            	Copyright © 2024 Your Company Name | Designed by <a title="free css templates" href="http://www.templatemo.com" target="_parent">Free CSS Templates</a>
            </div>
        </div>
		</div><!-- End Of Content -->
    </div><!-- End Of Container -->
	<!--  Free CSS Templates from www.TemplateMo.com  -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>