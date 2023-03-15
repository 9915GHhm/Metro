<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<title>Sitio de muestra de una plicación web</title>
	<meta name="description" content="Bienvenido a los cursos de C#, VisualBasic y PHP + MySql con Responsive Web Design"/>
	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<link rel="shortcut icon" type="image/x-icon" href="./public/img/Logo_Jr.ico" />
	<link rel="author" type="text/plain" href="humans.txt" />
	<link rel="sitemap" type="application/xml" title="Sitemap" href="sitemap.xml"/>
	<link rel="stylesheet" href="./public/css/flexslider.css" />
	<link rel="stylesheet" href="./public/css/estilos.css" />
	</head>
	<body>
		<header>
			<h1>Jr`s Software...<br> 
			códigos backend y frontend</h1>
			<nav>
				<ul>
					<li><a href="./">Inicio</a></li>
					<li><a href="acerca">Acerca</a></li>
					<li><a href="trabajos">Trabajos</a></li>
					<li><a href="contacto">Contacto</a></li>
				</ul>
			</nav>
<?php
if($_SESSION['ok'])
{
?>
<nav class = "item  i-b  v-middle  ph12  lg10  lg-right  menu">
    <ul id="menu-horizontal" class="slide">
        <li style = "background:#0000FF">Menú+
    <ul>
        <li class = "nobullet  item  inline"><a id="clr" href = "./">Inicio</a></li>
	    <li class = "nobullet  item  inline"><a id="clr" href = "users">Usuarios</a></li>
	    <li class = "nobullet  item  inline"><a id="clr" href = "salir">Salir</a></li>
    </ul>
</nav>
<?php
}	
?>
</header>
<main class = "container  center  main">
