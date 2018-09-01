<?php
function loguear($usuario, $clave)
{
	if($usuario == "marmoles_mario" && $clave == "artigas627!")
	{
		header_remove();
		$_SESSION["logueado"] = 1;
		header("Location:index.php");
	}
	else
	{
		echo "<h4 style='position:absolute;top:100px;left:500px;color:red;'>Error. Usuario y clave incorrectos.</br><a href='index.php'>Volver</a></h4>";
	}
}
function conectarse()
{
mysql_connect("localhost","marmoles_mario","artigas627!");
mysql_select_db("marmoles_gol_db");
}
function PaginaActual() {
 $pageURL = 'http';
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") 
 {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } 
 else 
 {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}
function paginacionArticulos($pagina, $nombretabla, $cat)
{
	mysql_connect("localhost","root","");
	mysql_select_db("andicarc_db"); //conexion a DB
	$tbl_name = $nombretabla;		//nombre de la tabla
	// maximo de paginas visibles (a la izquierda o a la derecha)
	$adyacentes = 3;
	if($cat == "all")
	{
		$query = "SELECT COUNT(*) as num FROM $nombretabla";//WHERE tipo = 0
	}
	else
	{
		$query = "SELECT COUNT(*) as num FROM $nombretabla WHERE categoria = '$cat'";//WHERE tipo = 0
	}
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	
	/* Declaracion de variables */
	$targetpage = $pagina;
	$limit = 20; 								//items por pagina
	if(isset($_GET['page']))
	{
		$page = $_GET['page'];
	}
	else
	{
		$page = 1;
	}
	if($page) 
		$start = ($page - 1) * $limit; 			//primer item a mostrar
	else
		$start = 0;
	
	/* Obteniendo datos */
	if($cat == "all")
	{
		$sql = "SELECT * FROM $nombretabla LIMIT $start, $limit"; //WHERE tipo = 0 ORDER BY fecha DESC
	}
	else
	{
		$sql = "SELECT * FROM $nombretabla WHERE categoria = '$cat' LIMIT $start, $limit";
	}
	$result = mysql_query($sql);
	
	/* Variables */
	if ($page == 0) $page = 1;					
	$prev = $page - 1;							
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);	
	$lpm1 = $lastpage - 1;						
	
	/* Paginacion */
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//pages	
		if ($lastpage < 7 + ($adyacentes * 2))
		{	
			for ($contador = 1; $contador <= $lastpage; $contador++)
			{
				if ($contador == $page)
					$pagination.= "<span class=\"current\">$contador-</span>";
				else
					$pagination.= "<a href=\"$targetpage?page=$contador&cat=$cat\">$contador</a>-";					
			}
		}
		elseif($lastpage > 5 + ($adyacentes * 2))	//cuando haya esta cantidad de paginas, se esconden algunas
		{
			//cerca del principio - esconder las del medio y el final
			if($page < 1 + ($adyacentes * 2))		
			{
				for ($contador = 1; $contador < 4 + ($adyacentes * 2); $contador++)
				{
					if ($contador == $page)
						$pagination.= "<span class=\"current\">$contador-</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$contador&cat=$cat\">$contador</a>-";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1&cat=$cat\">$lpm1</a>-";
				$pagination.= "<a href=\"$targetpage?page=$lastpage&cat=$cat\">$lastpage</a>-";		
			}
			//en el medio - esconder el principio y el final
			elseif($lastpage - ($adyacentes * 2) > $page && $page > ($adyacentes * 2))
			{
				$pagination.= "<a href=\"$targetpage?page=1\">1</a>-";
				$pagination.= "<a href=\"$targetpage?page=2\">2</a>-";
				$pagination.= "...";
				for ($contador = $page - $adyacentes; $contador <= $page + $adyacentes; $contador++)
				{
					if ($contador == $page)
						$pagination.= "<span class=\"current\">$contador-</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$contador&cat=$cat\">$contador</a>-";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?page=$lpm1&cat=$cat\">$lpm1</a>-";
				$pagination.= "<a href=\"$targetpage?page=$lastpage&cat=$cat\">$lastpage</a>-";		
			}
			//al final - esconder las del principio y el medio
			else
			{
				$pagination.= "<a href=\"$targetpage?page=1&cat=$cat\">1</a>-";
				$pagination.= "<a href=\"$targetpage?page=2&cat=$cat\">2</a>-";
				$pagination.= "...";
				for ($contador = $lastpage - (2 + ($adyacentes * 2)); $contador <= $lastpage; $contador++)
				{
					if ($contador == $page)
						$pagination.= "<span class=\"current\">$contador-</span>";
					else
						$pagination.= "<a href=\"$targetpage?page=$contador&cat=$cat\">$contador</a>-";					
				}
			}
		}
		$pagination.= "</div>\n";
	}
?>
	<?php
		while($row = mysql_fetch_array($result))
		{
			//rel='lightbox[imagen]' data-ob_share='false' atras del target_blank
			echo "</br><div style='height:370px;'><a href='".$row["imagen"]."' target='_blank'><img style='height:100%;width:100%;' src='".$row["imagen"]."'></img></a></div>";
			echo "<hr></hr>";
			echo "</br>";
		}
		if($page != 0)
		{
			if($lastpage != $page)
			{
				if($page != 1)
				{
				echo "<center>";
				echo "<a href='".$pagina."?page=".$prev."&cat=".$cat."'><<</a> || <a href='".$pagina."?page=".$next."&cat=".$cat."'>>></a></br></br>";
				echo "</center>";
				}
				else
				{
					echo "<center>";
					echo "<a href='".$pagina."?page=".$next."&cat=".$cat."'>>></a></br></br>";
					echo "</center>";
				}
			}
			else
			{
				echo "<center>";
				echo "<a href='".$pagina."?page=".$prev."&cat=".$cat."'><<</a></br></br>";
				echo "</center>";
			}
		}
	?>
	<?=$pagination?>
	<?php
}
?>
