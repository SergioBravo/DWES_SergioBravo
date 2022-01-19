<?php
  include '../funciones/funcionescomconstock.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Productos en Stock</title>
  </head>
  <body>
    <h1>Productos en Stock</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
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
    <p><input type=submit name=stock value=stock></p>
    </form>
    <p>
      <ol>
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Limpiamos los parametros
            $producto = test_input($_POST['producto']);
            //Logica de negocio
            $stock = stockProducto($producto,$conn);
            //Mostrar empleados
            $size = count($stock);

            if ($size == 0) {echo "<p>No se han encontrado este producto</p>";}
            else {
              for ($i=0; $i < $size; $i++) {
                echo "<li>".$stock[$i]."</li>";
              }
            }
            //Cerramos conexión
            cerrarConexión($conn);
          }
         ?>
      </ol>
    </p>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
