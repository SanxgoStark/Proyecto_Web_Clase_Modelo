<?php
  session_start();
  session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Proyecto</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
</head>
<body>
<!-- Se incluye la cabecera header.php generica para centralizar todos los cambios -->
<? include "header.php"; ?>

<style type="text/css">
	.renglon{margin-top: 65px;}
</style>


<!-- contenedor -->
<div class="container" style="background: rgba(100,100,100,0.7);">
	<div class="row renglon">
		<div class="col-md-12">
			<!--  -->
			<form action="validar.php" method="post">
  <fieldset>
    <legend style="position: center">Login</legend>
   
    <div class="form-group">
      <label for="idEmail" class="col-md-4">Email address</label>
      <input type="email" class="form-control" id="idEmail" aria-describedby="emailHelp" placeholder="Enter email" name="x">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="y">
      <!-- por defecto el boton es submit -->
      <button type="">Enviar</button>
    </div>
    
</form>
		</div>
	</div>

</div>

<?php

// con esto se logra que el recurso login reciba el parametro m de validar y en base a m login 
//mande mensaje a la vista del cliente -->
if (isset($_GET['m']) && $_GET['m']==1)
  echo '<h1>DATOS INCORRECTOS.</h1>';

// manejo de erro m con sesiones
session_start();
if (isset($_SESSION['error']) && $_SESSION['error']>"")
  echo '<h1>'.$SESSION['error'].'</h1>';

?>

</body>
</html>