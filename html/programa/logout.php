<?php session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<?php
if(isset($_POST["logout"]))
{
	session_destroy();
	header('Location: index.php');
}
else
{
	if(isset($_POST["login"]))
	{
		if($_POST["username"] == "mario" && $_POST["password"] == "artigas627")
		{
			$_SESSION["logueado"] = 1;
			header("Location:index.php");
		}
		else
		{
			echo "<h4 style='position:absolute;top:100px;left:500px;color:red;'>Error. Usuario y clave incorrectos.</br><a href='index.php'>Volver</a></h4>";
		}
	}
	else
	{
		if(isset($_POST["cambiar"]))
		{
			require_once("funciones.php");
			conectarse();
			$nuevak = $_POST["constante"];
			$consulta = mysql_query("UPDATE constante SET constante = '$nuevak'");
			if($consulta)
			{
				header("Location: bloques.php");
			}
			else
			{
				echo "<p>Ha ocurrido un error. Ingreso algun caracter que no sea un numero? Vuelva a intentarlo.</p>";
			}
		}
		else
		{
			if(isset($_POST["ingresar"]))
			{
				require_once("funciones.php");
				conectarse();
				$consulta = mysql_query("SELECT * FROM constante");
				$consultaid = mysql_query("SELECT valor FROM enqueid");
				$idbloque = mysql_result($consultaid, 0);
				$constante = mysql_result($consulta, 0);
				$day = $_POST["day"];
				$month = $_POST["month"];
				$year = $_POST["year"];
				$fechai = $year . $month . $day;
				$remito = $_POST["remito"];
				$alto = $_POST["alto"];
				$ancho = $_POST["ancho"];
				$profundo = $_POST["profundo"];
				$toneladas = ($ancho * $alto * $profundo * $constante);
				$color = $_POST["color"];
				$observaciones = $_POST["observaciones"];
				$sku = $_POST["sku"];
				$Nsku = $_POST["nsku"];
				$idcamion = $_POST["idcamion"];
				$query = mysql_query("INSERT INTO bloques (sku, nsku, id, fechai, remito, alto, ancho, profundo, toneladas, color, observaciones, fechae, disp) VALUES ('$sku' , '$Nsku' , '$idbloque', '$fechai', '$remito', '$alto', '$ancho', '$profundo', '$toneladas', '$color', '$observaciones', 0, 1)");
				mysql_query("UPDATE Camion SET bloque = bloque + 1 WHERE camion = '$idcamion'");
				if($query)
				{
					mysql_query("UPDATE enqueid SET valor = valor + 1");

					header("Location: bloques.php?rem=$remito");
				}
				else
				{
					echo "<p style='position:absolute;top:150px;left:230px;'>Ha ocurrido un error. Ha ingresado los valores correctamente? No puede mezclar numeros y caracteres alfabeticos en un campo. Intentelo <a href='bloques.php'>de nuevo</a>.</p>";
				}
			}
			else
			{
				if(isset($_POST["ingresarf"]))
				{
					require_once("funciones.php");
					conectarse();
					$fecha = $_POST["fecha"];
					$bloque = $_POST["idbloque"];
					$toneladas = $_POST["toneladas"];
					$color = $_POST["color"];
					$mlineales = $_POST["mlineales"];
					$mcuadrados = $_POST["mcuadrados"];
					$observaciones = $_POST["observaciones"];
					$horas = $_POST["horas"];
					$corte = $_POST["corte"];
					$sku = $_POST["sku"];
					$nsku = $_POST["nsku"];
					$remito = $_POST["remito"];

					$query = mysql_query("INSERT INTO filania (sku, nsku, remito, fecha, bloque, toneladas, color, mlineales, mcuadrados, observaciones, horas, corte, disp) VALUES ('$sku', '$nsku', '$remito' , '$fecha', '$bloque', '$toneladas', '$color', '$mlineales', '$mcuadrados', '$observaciones', '$horas', '$corte', 1)");
					if($query)
					{
						header("Location: lotes.php?q=filania");
					}
					else
					{
						echo "<p>Ha ocurrido un error. Ha ingresado los valores correctamente? No puede mezclar numeros y caracteres alfabeticos en un campo. Intentelo <a href='bloques.php'>de nuevo</a>.</p>";
					}
					$sku = $_POST["sku"];
					$fechae = date("c");
					mysql_query("UPDATE bloques SET disp = 0, fechae = '$fechae' WHERE sku = '$sku'");
				}
				else
				{
					if(isset($_POST["ingresarlote"]))
					{
						require_once("funciones.php");
						conectarse();
						$day = $_POST["day"];
						$month = $_POST["month"];
						$year = $_POST["year"];
						$fecha = $year . $month . $day;
						$producto = $_POST["producto"];
						$mcuadrados = $_POST["mcuadrados"];
						$corte = $_POST["corte"];
						$color = $_POST["color"];
						$consulta = mysql_query("INSERT INTO lotes (fecha, producto, mcuadrados, aov, color, disp) VALUES ('$fecha', '$producto','$mcuadrados', '$corte', '$color', 1)");
						if($consulta)
						{
							header("Location: cargalotes.php");
						}
						else
						{
							echo "<p style='position:absolute;top:150px;left:230px;'>Ha ocurrido un error. Ha ingresado los valores correctamente? No puede mezclar numeros y caracteres alfabeticos en un campo. Intentelo <a href='cargalotes.php'>de nuevo</a>.</p>";
						}
					}
					else
					{
						if(isset($_POST["ingresarprod"]))
						{
							require_once("funciones.php");
							conectarse();
							$producto = $_POST["nuevoprod"];
							$consulta = mysql_query("INSERT INTO productos (producto) VALUES ('$producto')");

							if($consulta)
							{
								header("Location: productos.php");
							}
							else
							{
								echo "<h4 style='color:red;'>Error</h4>";
							}
						}
						else
						{
							if(isset($_POST["submit_camion"]))
							{
								require_once("funciones.php");
								conectarse();
								$camion = $_POST["camion"];
								$bloque = 1;
								$consulta = mysql_query("INSERT INTO Camion (camion, bloque, ultima_fecha) VALUES ('$camion' , '$bloque' , now())");


								if($consulta)
								{
									header("Location: bloques.php");
								}
								else
								{
									echo "<h4 style='color:red;'>Error</h4>";
								}
								mysql_query("ALTER TABLE  Camion ORDER BY  ultima_fecha DESC ");
							}
							else
							{
								if (isset($_POST["submit3861"]))
								{
									require_once("funciones.php");
									conectarse();
									$camionid = $_POST["camionid"];
									$consulta = mysql_query("UPDATE Camion SET ultima_fecha = NOW() WHERE  camion = '$camionid'");
									mysql_query("ALTER TABLE  Camion ORDER BY  ultima_fecha DESC ");

									header("Location: bloques.php");
								} else
								{
									echo "<h4 style='color:red;'>Error</h4>";
								}
							}

						}
					}
				}
			}
		}
	}
}
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
</body>
</html>