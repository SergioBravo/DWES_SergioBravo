<?php
  include '../funciones/funcionescomaltaalm.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Alta Almacenes</title>
  </head>
  <body>
    <h1>Alta Almacenes</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Localidad: <input type=text name=localidad placeholder="Localidad"></p>
    </p>
    <p><input type=submit name=alta value=Alta></p>
    </form>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $localidad = test_input($_POST['localidad']);
    //Logica de negocio
    altaProducto($localidad,$conn);
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
