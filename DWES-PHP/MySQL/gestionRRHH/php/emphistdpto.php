<?php
  include '../funciones/funcionesemphistdpto.php';
  //Abrimos la conexión
  $conn = abrirConexion();
?>

<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Mostrar historico departamento</title>
  </head>
  <body>
    <h1>Mostrar Historico Departamento</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Departamento:
      <select name=departamento>
        <?php
          //Creamos el select de los departamentos
            selectDepartamento($conn)
       ?>
     </select>
    </p>
    <p><input type=submit name=ver value=Visualizar></p>
    </form>
    <ol>
      <!---PRINCIPIO CODIGO -->
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $departamento = $_POST['departamento'];
          //Mostrar empleados
          verHistorico($departamento,$conn);
          //Cerramos conexión
          cerrarConexion($conn);
        }
       ?>
      <!---FINAL CODIGO -->
    </ol>
  </body>
</html>
