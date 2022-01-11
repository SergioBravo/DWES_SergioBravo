<?php
  include '../funciones/funcionescomconsalm.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Productos en Almacen</title>
  </head>
  <body>
    <h1>Productos en Almacen</h1>
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
    <p><input type=submit name=stock value=stock></p>
    </form>
    <p>
      <ol>
        <?php
          if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Limpiamos los parametros
            $almacen = test_input($_POST['almacen']);
            //Logica de negocio
            $stock = stockAlmacen($almacen,$conn);
            //Mostrar empleados
            $size = count($stock);

            if ($size == 0) {echo "<p>No hay productos en el almacen</p>";}
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
