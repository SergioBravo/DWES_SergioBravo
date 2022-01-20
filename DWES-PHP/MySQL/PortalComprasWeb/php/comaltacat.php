<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Alta Categorias</title>
  </head>
  <body>
    <h1>Alta Categorias</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Categoría Producto: <input type=text name=nombre placeholder="Categoría"></p>
    <p><input type=submit name=alta value=Alta></p>
    </form>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
<?php
include '../funciones/funcionescomaltacat.php';
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $nombre = test_input($_POST['nombre']);
    //Abrimos la conexión
    $conn = abrirConexion();
    //Logica de negocio
    altaCategoria($nombre,$conn);
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
