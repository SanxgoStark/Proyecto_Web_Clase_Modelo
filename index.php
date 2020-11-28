<?php
  session_start();
  session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Proyecto</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/micss.css">
</head>

<body>
<!-- Se incluye la cabecera header.php generica para centralizar todos los cambios -->
<? include "header.php"; ?>
<div class="container" style="background: rgba(200,200,200);">
  <div class="row mt-3">
    <div class="col-md-12">
    </div>
  </div>
</div>  
<!-- Agrega la parte de encuesta al principio en home
<style type="text/css">
	.renglon{margin-top: 65px;}
</style>


<div style="background-color: white; background-position: center; background-size: cover;" class="jumbotron">
  <h1 style="color: black" class="display-3">Encuesta</h1>
  <br/>
  <p style="color: black; font-size: 17px ">Codigo de encuesta</p>
  <input  type="input" name="hola">
  <p class="lead"></p>
  <hr class="my-4">
  <p></p>
  <p class="lead">
    <a style ="color: white" class="boton_2" href="#" role="button">Encuesta</a>
    <a style="color: white" class="boton_2" href="#" role="button">Encuestas disponibles</a>
  </p>
</div>
-->

</body>
</html>