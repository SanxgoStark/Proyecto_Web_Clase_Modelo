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
      <form method="post" action="reqiUsuario.php">
  <fieldset>
    <legend>Registro</legend>
    <div class="form-group row">
      <div class="col-sm-10">
      </div>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email address</label>
      <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Nombre</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Nombre" name="nombre">
    </div>

    <div class="form-group">
      <label for="exampleInputPassword1">Apellidos</label>
      <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Apellidos" name="apellidos">
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
  </fieldset>
</form>
    </div>
  </div>

</div>


</body>
</html>