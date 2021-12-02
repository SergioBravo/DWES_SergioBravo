<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Alta Departamento</title>
  </head>
  <body>
    <h1>Alta Departamento</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Departamento: <input type=text name=nombre placeholder="Departamento"></p>
    <p><input type=submit name=alta value=Alta></p>
    </form>
  </body>
</html>
<?php
include './funciones/funcionesPDO.php';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $nombre = test_input($_POST['nombre']);
    //Abrimos la conexión
    $conn = abrirConexion();
    //Logica de negocio
    altaDepartamento($nombre,$conn);
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
