<?php
  include '../funciones/funcionescomaltapro.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Alta Productos</title>
  </head>
  <body>
    <h1>Alta Productos</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Nombre: <input type=text name=nombre placeholder="Nombre"></p>
    <p>Precio: <input type=text name=precio placeholder="Precio"></p>
    <p>
      <select name="categoria">Categoria:
        <?php
          $options = optionsCategorias($conn);
          $size = count($options);

          for ($i=0; $i < $size; $i+=2) {
            echo "<option value=".$options[$i].">".$options[$i+1]."</option>";
          }
         ?>
      </select>
    </p>
    <p><input type=submit name=alta value=Alta></p>
    </form>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $nombre = test_input($_POST['nombre']);
    $precio = test_input($_POST['precio']);
    $categoria = test_input($_POST['categoria']);
    //Logica de negocio
    altaProducto($nombre,$precio,$categoria,$conn);
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
