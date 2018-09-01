<?php
session_start();
date_default_timezone_set('America/Argentina/Buenos_Aires');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/html">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Travertino Andino S.A</title>
    <meta name="keywords" content="travertino andino s.a marmol piedras"/>
    <meta name="description"
          content="Una aplicacion web para llevar acabo cuentas y gerenciamiento de datos de la empresa Travertino Andino S.A"/>
    <link href="estilo.css" rel="stylesheet" type="text/css"/>
    <script language="javascript" type="text/javascript">
        window.onload = function () {
            document.getElementById("textoprimero").focus();
        };
        function clearText(field) {

            if (field.defaultValue == field.value) field.value = '';
            else if (field.value == '') field.value = field.defaultValue;

        }
    </script>


<!-- SCRIP PARA MOSTRAR EL CARGAR CAMION -->
    <script language="javascript">
        function toggle() {
            var ele = document.getElementById("toggleText");
            var text = document.getElementById("displayText");
            if(ele.style.display == "inline-block") {
                ele.style.display = "none";
                text.innerHTML = "Cambiar numero de camión";
            }
            else {
                ele.style.display = "inline-block";
                text.innerHTML = "Cancelar";
            }
        }
    </script>

    <!-- SCRIP PARA MOSTRAR EL CARGAR NUEVO CAMION -->
    <script language="javascript">
        function toggle2() {
            var ele2 = document.getElementById("toggleText2");
            var text2 = document.getElementById("displayText2");
            if(ele2.style.display == "inline-block") {
                ele2.style.display = "none";
                text2.innerHTML = "Camión Nuevo";
            }
            else {
                ele2.style.display = "inline-block";
                text2.innerHTML = "Cancelar";
            }
        }
    </script>

    <!--[if lt IE 7]>
    <style type="text/css">

        .templatemo_icon_home {
            behavior: url(iepngfix.htc);
        }

        .templatemo_icon_cube {
            behavior: url(iepngfix.htc);
        }

        .templatemo_icon_tick {
            behavior: url(iepngfix.htc);
        }

    </style>
    <![endif]-->
</head>
<body>
<div id="templatemo_container">
    <div id="templatemo_header">
        <div id="templatemo_login">
            <?php
            if (isset($_SESSION["logueado"])) {
                ?>
                <form method="post" action="logout.php">
                    <label>Login:</label>
                    <input type="submit" name="logout" value="" class="boton"/>
                </form>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- End Of Header -->

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


        </div>
        <!-- End Of left Content -->
        <div id="templatemo_right_content">
            <div id="templatemo_content_area">
                <?php
                if (isset($_SESSION["logueado"])) {
                    ?>
                    <div class="templatemo_title">
                        CONSTANTE
                    </div>
                    <?php
                    if (isset($_POST["cambiar"]) == false) {
                        require_once("funciones.php");
                        conectarse();
                        $consulta = mysql_query("SELECT * FROM constante");
                        if ($consulta) {
                            $constante = mysql_result($consulta, 0);
                            echo "<p>Usted esta trabajando con la constante " . $constante . ".</p>";
                        } else {
                            echo "<p><b>Ha ocurrido un error. Por favor contacte al administrador del sistema.</b></p>";
                        }
                        ?>
                        <form method="post" action="logout.php"><p>Puede cambiarla aqui:</p><input type="text"
                                                                                                   name="constante"
                                                                                                   maxlength="3"/></br>
                            <input type="submit" name="cambiar" value="Cambiar"/></br></form>
                    <?php
                    } else {
                        require_once("funciones.php");
                        conectarse();
                        $nuevak = $_POST["constante"];
                        $consulta = mysql_query("UPDATE constante SET constante = '$nuevak'");
                        if ($consulta) {
                            echo "<p>Constante cambiada con exito!</p>";
                        } else {
                            echo "<p>Ha ocurrido un error. Ingreso algun caracter que no sea un numero? Vuelva a intentarlo.</p>";
                        }
                    }
                    ?>
                    <div class="templatemo_title">
                        NUEVO BLOQUE
                    </div>
                    <?php
                    if (isset($_POST["ingresar"])) //ESTO NO SUCEDE NUNCA
                    {
                        require_once("funciones.php");
                        conectarse();
                        $consulta = mysql_query("SELECT * FROM constante");
                        $constante = mysql_result($consulta, 0);
                        $fechai = date('c');
                        $remito = $_POST["remito"];
                        $alto = $_POST["alto"];
                        $ancho = $_POST["ancho"];
                        $profundo = $_POST["profundo"];
                        $toneladas = $ancho * $alto * $profundo * $constante;
                        $color = $_POST["color"];
                        $observaciones = $_POST["observaciones"];
                        echo $fechai . "</br>";
                        echo $remito . "</br>";
                        echo $bloque . "</br>";
                        echo $alto . "</br>";
                        echo $ancho . "</br>";
                        echo $profundo . "</br>";
                        echo $toneladas . "</br>";
                        echo $color . "</br>";
                        echo $observaciones . "</br>";
                        $query = mysql_query("INSERT INTO bloques (fechai, remito, alto, ancho, profundo, toneladas, color, observaciones, fechae, disp) VALUES ('$fechai', '$remito', '$alto', '$ancho', '$profundo', '$toneladas', '$color', '$observaciones', 0, 1)");
                        if ($query) {
                            echo "<p>Bloque insertado con exito.</p>";
                        } else {
                            echo "<p>Ha ocurrido un error. Ha ingresado los valores correctamente? No puede mezclar numeros y caracteres alfabeticos en un campo. Intentelo <a href='bloques.php'>de nuevo</a>.</p>";
                        }
                    } else {
                        ?>


                        <!-- ACA PIDO EL NUMERO DE CAMION -->

                <?php
                if (isset($_GET["rem"])) //Para que aparezca el ultimo remito ingresado
                {
                    $rem = $_GET["rem"];
                } else {
                    $rem = "";
                }
                require_once("funciones.php");
                conectarse();
                $consulta = mysql_query("SELECT camion FROM Camion");
                $idcamion = mysql_result($consulta, 0);
                ?>

                <form method="post" action="logout.php">

                    <p><b>Recuerde que para ingresar numeros decimales usted debe hacer uso del punto ( . ) y no
                                    de la coma ( , ). Esto se debe a que el sistema funciona con numeracion
                                    norteamericana.</b></p></br>

                           <h2 style="color:#9bcdff;"> Actualmente se encuentra trabajando con el camion: <div class="number_result"><?php echo $idcamion; ?></div></h2>

                    <!--                    Empieza cosa turbia de botones       -->

                    <div class="camion_div">

                        <div id="toggleText" class="camion_div1" style="display: none">
                            <p>Elija un numero de camión<select name="camionid">

                                    <?php
                                    $consultita = mysql_query("SELECT camion FROM Camion");
                                    while ($u = mysql_fetch_assoc($consultita)) {
                                        echo "<option value='" . $u["camion"] . "'>" . $u["camion"] . "</option>";
                                    }
                                    ?>
                                </select><input type="submit" name="submit3861" class="input1" value="Cambiar" /><br>

                                <!-- ingresar nuevo camion - Funciona bien -->

                            <div id="toggleText2" class="camion_div2" style="display: none">
                                <p>Ingrese numero de camión: <input type="text" name="camion"/><input type="submit" name="submit_camion" class="input1" value="Añadir" />
                            </div>
                            <span style="font-size: 14px; padding-left: 5px;"><a id="displayText2" href="javascript:toggle2();" style="color: #FF7000 !important; ">Añadir nuevo camion</a></span>
                        </div></p>
                        <p><a id="displayText" href="javascript:toggle();">Cambiar numero de camión</a></p>


                           </div>
                        </form>
                        <!-- TERMINA LA PARTE DEL CAMION -->

                        <!--EMPIEZA LA FORM PARA COMPLETAR-->
                        <form method="post" action="logout.php">
                            <?php
                            if (isset($_GET["rem"])) //Para que aparezca el ultimo remito ingresado
                            {
                                $rem = $_GET["rem"];
                            } else {
                                $rem = "";
                            }
                            require_once("funciones.php");
                            conectarse();
                            $consulta = mysql_query("SELECT bloque FROM Camion");
                            $idbloque = mysql_result($consulta, 0);
                            $sku = $idcamion * 10 + $idbloque;
                            $Nsku = $idcamion . ' - ' . $idbloque;

                            ?>

                            <h2 style="color:#9bcdff;">Ingrese datos para el <b>bloque</b>
                                numero <?php echo $idbloque; ?></h2>

                            <p>SKU: <?php echo $Nsku; ?></p>

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

                            <p>Remito: </p><input type="text" name="remito" id="textoprimero"
                                                  value="<?php echo $rem; ?>"/></br>
                            <p>Alto (en metros): </p><input type="text" name="alto"/></br>
                            <p>Ancho (en metros): </p><input type="text" name="ancho"/></br>
                            <p>Profundo (en metros): </p><input type="text" name="profundo"/></br>
                            <p>Color: </p><select name="color">
                                <?php
                                $consultita = mysql_query("SELECT * FROM colores");
                                while ($u = mysql_fetch_assoc($consultita)) {
                                    echo "<option value='" . $u["color"] . "'>" . $u["color"] . "</option>";
                                }
                                ?>
                            </select>

                            <p>Observaciones: </p>
                            <input type="text" name="observaciones"/></br></br>
                            <input type="hidden" name="sku" value="<?php echo "$sku"; ?>"/>
                            <input type="hidden" name="nsku" value="<?php echo "$Nsku"; ?>"/>
                            <input type="hidden" name="idcamion" value="<?php echo "$idcamion"; ?>"/>
                            <input type="submit" name="ingresar" value="Ingresar"/></br>
                        </form>
                    <?php
                    }
                    ?>

                    <div class="templatemo_title">
                        BLOQUES (ULTIMOS 5)
                    </div>

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
                        $consulta = mysql_query("SELECT * FROM bloques ORDER BY id DESC LIMIT 5");
                        $consultaultimo = mysql_query("SELECT valor FROM enqueid");
                        $ultimo = mysql_result($consultaultimo, 0);
                        $ultimo = $ultimo - 1;
                        while ($u = mysql_fetch_assoc($consulta)) {
                            if ($u["disp"] == 1) {
                                $colorfondo = "white";
                            } else {
                                $colorfondo = "red";
                            }
                            echo "<tr>";
                            if ($u["disp"] == 1) {
                                echo "<form action='filania.php' method='post'>";
                            } else {
                                echo "<form action='lotes.php?q=bloques' method='post'>";
                            }
                            echo "<input type='hidden' name='idbloque' value='" . $u["id"] . "' />";
                            echo "<input type='hidden' name='fechai' value='" . $u["fechai"] . "' />";
                            echo "<input type='hidden' name='fechae' value='" . $u["fechae"] . "' />";
                            echo "<input type='hidden' name='toneladas' value='" . $u["toneladas"] . "' />";
                            echo "<input type='hidden' name='color' value='" . $u["color"] . "' />";
                            echo "<input type='hidden' name='observaciones' value='" . $u["observaciones"] . "' />";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . date("d-m-Y", strtotime($u["fechai"])) . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["remito"] . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["id"] . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["alto"] . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["ancho"] . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["profundo"] . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["toneladas"] . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["color"] . "</td>";
                            echo "<td style='background-color:" . $colorfondo . ";'>" . $u["observaciones"] . "</td>";
                            if ($u["disp"] == 0) //Para que no me tire 31 de diciembre de 1969
                            {
                                echo "<td style='background-color:" . $colorfondo . ";'>" . date("d-m-Y", strtotime($u["fechae"])) . "</td>";
                            } else {
                                echo "<td style='background-color:" . $colorfondo . ";'>" . $u["fechae"] . "</td>";
                            }
                            if ($u["id"] == $ultimo) {
                                if ($u["disp"] == 1)//Para ver si es un bloque a egresar
                                {
                                    echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar'/></td>";
                                    echo "<td style='background-color:white;'><input type='submit' name='borrarbloque' value='Borrar'/></td>";
                                } else {
                                    echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar' disabled='disabled'/></td>";
                                    echo "<td style='background-color:white;'><input type='submit' name='borrarbloque' value='Borrar'/></td>";
                                }
                            } else {
                                if ($u["disp"] == 1) {
                                    echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar'/></td>";
                                } else {
                                    echo "<td style='background-color:white;'><input type='submit' name='egresar' value='Egresar' disabled='disabled'/></td>";
                                }
                            }
                            echo "</form>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                <?php
                } else {
                    echo "<div class='templatemo_title'>
                    	LOGUEO
                    </div>
                    
                    <p>Usted debe estar <a href='index.php'>logueado</a> para poder utilizar cualquier funcion del sistema.</p>";
                }
                ?>
            </div>
        </div>
        <!-- End Of Right Content -->
        <div id="templatemo_right_content_bottom">
            Copyright © 2014 Travertino S.A
        </div>
    </div>
    <!-- End Of Content -->
</div>
<!-- End Of Container -->
<!--  Free CSS Templates from www.TemplateMo.com  -->

<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js'></script>
<script type='text/javascript' src='js/logging.js'></script>
</body>
</html>