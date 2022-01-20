<?php
  session_start();
  include '../funciones/funcionescomconscli.php';
  //Abrimos la conexión
  $conn = abrirConexion();
 ?>
<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Ver prodcutos comprados</title>
  </head>
  <body>
    <h1>Ver productos comprados</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <?php
      echo "<h2>Sesión iniciada: ".$_SESSION['nombre']."</h2>";
     ?>
    <p>Inicio: <input type="date" name="inicio"></p>
    <p>Fin: <input type="date" name="fin"></p>
    <p><input type=submit name=ver value="Ver compras"></p>
    </form>
    <ol>
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          //Variable para calculo del total
          $total = 0;
          //Limpiamos los parametros
          $inicio = test_input($_POST['inicio']);
          $fin = test_input($_POST['fin']);
          //Logica de negocio
          $cliente = $_SESSION['NIF'];
          $mensaje = verProductos($cliente,$inicio,$fin,$conn,$total);
          $size = count($mensaje);

          if ($size == 0) {echo "<p>Ese cliente no ha comprado ningun producto en esas fechas</p>";}
          else {
            for ($i=0; $i < $size; $i++) {
              echo "<li>".$mensaje[$i]."</li>";
            }
          }
          echo "<p>El montante es $total €";
          //Cerramos conexión
          cerrarConexión($conn);
        }
      echo "</ol>";
      ?>
    <p><a href="../funciones/comprobarLogin.php">Volver al menú de usuario</a></p>
  </body>
</html>
