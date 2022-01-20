<?php
  include "./funcionescomlogincli.php";
  $conn = abrirConexion();

  if(isset($_POST['nombre']) && isset($_POST['contraseña'])){
    session_start();
    $nombre = test_input($_POST['nombre']);
    $contraseña = test_input($_POST['contraseña']);
  } else {
    session_start();
    $nombre = "";
    $contraseña = "";
  }
?>
<html>
  <head>
    <title>Login Usuario</title>
  </head>
  <body>
    <?php
      if (comprobarInicio($nombre,$contraseña,$conn) || isset($_SESSION['nombre'])) {
        if (!isset($_SESSION['nombre'])) {//En caso de no existir creamos la variable de sesion nombre
          $_SESSION['nombre'] = $_POST['nombre'];
        }
        if (!isset($_SESSION['NIF'])) {
          $_SESSION['NIF'] = sacarNif($nombre,$contraseña,$conn);
        }
        echo "<p>Has iniciado sesion: " . $_SESSION['nombre'] . "";
        echo "<h1>Portal Compras</h1>";
        echo "<h2><a href='../php/comprocli.php'>Comprar Productos</h2>";
        echo "<h2><a href='../php/comconscli.php'>Consulta de Compras</h2>";
        echo "<p><a href='./cerrarSesion.php'>Cerrar Sesion</a></p>";
      }
      else {
          echo "Usuario o contraseña incorrecto";
          echo "<p><a href='../php/comlogincli.php'>Volver a pagina de login</a></p>";
        }
    cerrarConexión($conn);
    ?>
  </body>
</html>
