<?php

	// HOJA PARA ESTILOS EN GENERAL

	// el recurso va a utilizar todas las sesiones (sesiones qu lebanto el usuario) - (ip,so y navegador)

	// Para verificar que el usurio se legee
	session_start();

	// validacion para usuario
	// si la sesion no existe redireccionar a index.php
	// si no existe la variable nombre mandolo an index
	if(!isset($_SESSION['nombre'])){
		//si sesion no existe
		header("location: ../index.php?m=100");
	}
	
	//echo "has llefado al home desde login"

	// verificar que la sesion existe

	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="../css/bootstrap.css">
	<!-- con el rand se obliga al navegador a consultar de nuevo los recusos sin accesar al cache -->
	<link rel="stylesheet" href="../css/micss.css?v=1.1">
	<!-- añadir jquery-confim.js
	       jquery-confirm.css
	       jquery 3.5.1min -->
	
</head>
<body>