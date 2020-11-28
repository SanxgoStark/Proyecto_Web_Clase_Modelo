<?php

?>


<!-- Este es un header especial para el administrador-->

<!-- concentracion de nav bar para no tener qeu hacer cambios de rutas en todos los archivos -->
<!-- al hacer cambios aqui se veran reflajados en dos los archivos donde tenga el include  -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor01">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Inicio
          <span class="sr-only">(current)</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="perfil.php">Perfil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Encuestas</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">TipoE</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">TipoP</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../index.php">Cerrar Sesion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../about.html">About</a>
      
    </ul>
    
  </div>
  <span class="badge badge-pill badge-secondary" style="font-size: 1.5em; "><img class="miniFoto" src="../fotos/<? echo $_SESSION['foto'] ?>"><? echo $_SESSION['nombre'];?></span>


</nav>
  <!--<a href="../login.php?=correcto">Cerrar Sesion</a>-->