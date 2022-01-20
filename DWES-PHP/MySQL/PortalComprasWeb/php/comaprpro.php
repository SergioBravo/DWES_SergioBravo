<?php
  include '../funciones/funcionescomaprpro.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Productos en almacen</title>
  </head>
  <body>
    <h1>Productos en almacen</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>
      <select name="almacen">Almacen:
        <?php
          $optionsAl = optionsAlmacen($conn);
          $size = count($optionsAl);

          for ($i=0; $i < $size; $i+=2) {
            echo "<option value=".$optionsAl[$i].">".$optionsAl[$i+1]."</option>";
          }
         ?>
      </select>
    </p>
    <p>
      <select name="producto">Producto:
        <?php
          $optionsPro = optionsProducto($conn);
          $size = count($optionsPro);

          for ($i=0; $i < $size; $i+=2) {
            echo "<option value=".$optionsPro[$i].">".$optionsPro[$i+1]."</option>";
          }
         ?>
      </select>
    </p>
    <p></p><input type="text" name="cantidad" placeholder="Cantidad">
    <p><input type=submit name=asignar value=Asignar></p>
    </form>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Limpiamos los parametros
    $almacen = test_input($_POST['almacen']);
    $producto = test_input($_POST['producto']);
    $cantidad = test_input($_POST['cantidad']);
    //Logica de negocio
    asignarProductosAlmacen($almacen,$producto,$cantidad,$conn);
    echo "Producto añadido al almacen";
    //Cerramos conexión
    cerrarConexión($conn);
  }
 ?>
