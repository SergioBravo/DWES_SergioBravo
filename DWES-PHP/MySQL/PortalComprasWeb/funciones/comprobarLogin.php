<?php
  include "./funcionescomlogincli.php";
  $conn = abrirConexion();
  session_start();
?>
<html>
  <head>
    <title>Comprobar Login</title>
  </head>
  <body>
    <?php
      if(isset($_POST['nombre']) && isset($_POST['contraseña'])){
        $nombre = test_input($_POST['nombre']);
        $contraseña = test_input($_POST['contraseña']);
        if (comprobarInicio($nombre,$contraseña,$conn)) {
          $_SESSION['nombre'] = $_POST['nombre'];
          $_SESSION['NIF'] = sacarNif($nombre,$contraseña,$conn);
          $_SESSION['CARRITO'] = array();
          echo "Bienvenido! Sesión iniciada: ".$_SESSION['nombre'];
        }
        else {
          echo "Usuario o contraseña incorrecto";
        }
      }
      else{
        if(isset($_SESSION['nombre']) && $_SESSION['contraseña']){
          echo "Sesión iniciada: ".$_SESSION['nombre'];
        }
        else{
          echo "Acceso Restringido debes hacer Login con tu usuario";
        }
      }
      cerrarConexión($conn);
    ?>
    <br /><a href="../php/comlogincli.php">Volver a pagina de login</a>
  </body>
</html>
