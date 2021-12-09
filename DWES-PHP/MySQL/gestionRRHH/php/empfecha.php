<?php
  include '../funciones/funcionesempfecha.php';
  //Abrimos la conexión
  $conn = abrirConexion();
?>

<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Mostrar Empleados Fecha</title>
  </head>
  <body>
    <h1>Mostrar Empleados Fecha</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Fecha: <input type="date" name="fecha"></p>
    <p><input type=submit name=ver value=Visualizar></p>
    </form>
    <ol>
      <!---PRINCIPIO CODIGO -->
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $fecha = test_input($_POST['fecha']);
          //Mostrar empleados
          $mensajes = verEmpleadosFecha($fecha,$conn);
          $size = count($mensajes);

          if ($size == 0) {echo "<p>No se han encontrado empleados</p>";}
          else {
            for ($i=0; $i < $size; $i++) {
              echo "<li>".$mensajes[$i]."</li>";
            }
          }
          //Cerramos conexión
          cerrarConexion($conn);
        }
       ?>
      <!---FINAL CODIGO -->
    </ol>
  </body>
</html>
