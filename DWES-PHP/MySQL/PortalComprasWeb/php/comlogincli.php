<?php
  session_start();
?>
<html>
  <head>
    <title>Login Usuarios</title>
  </head>
  <body>
    <?php
      if(isset($_SESSION['nombre'])){
        echo "<p>Has iniciado sesion: " . $_SESSION['nombre'] . "";
        echo "<h1>Portal Compras</h1>";
        echo "<h2><a href='./comprocli.php'>Comprar Productos</h2>";
        echo "<h2><a href='./comconscli.php'>Consulta de Compras</h2>";
        echo "<p><a href='../funciones/cerrarSesion.php'>Cerrar Sesion</a></p>";
      }
      else {
    ?>
      <form action="../funciones/comprobarLogin.php" method="POST">
        <h1>Login</h1>
        <p>Usuario: <input type="text" name="nombre" placeholder="Usuario" required/></p>
        <p>Contraseña: <input type="password" name="contraseña" required/></p>
        <input type="submit" value="Login" />
      </form>
    <?php
    	}
    ?>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
