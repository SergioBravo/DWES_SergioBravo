<?php
  include '../funciones/funcionesempsalarioemp.php';
  //Abrimos la conexión
  $conn = abrirConexion();
?>

<html lang=es dir=ltr>
  <head>
    <meta charset=utf-8>
    <title>Cambiar Salario Empleado</title>
  </head>
  <body>
    <h1>Cambiar Salario Empleado</h1>
    <form method=post action = <?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>>
    <p>Empleado:
      <select name=empleado>
      <?php
          $datos = optionsEmpleado($conn);
          $size = count($datos);

          for ($i=0; $i < $size; $i++) {
              $partes = explode(" ",$datos[$i]);//0 DNI 1 Nombre
              echo "<option value=".$partes[0].">".$partes[1]."</option>";
          }
       ?>
     </select>
    </p>
    <p>Incremento/Decremento % Salario: <input type="text" name="salario"></p>
    <p><input type=submit name=cambiar value=Cambiar></p>
    </form>
  </body>
</html>

<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $empleado = $_POST['empleado'];
    $salario = test_input($_POST['salario']);

    //Cambio de salario
    cambiarSalario($empleado,$salario,$conn);
    //Cerramos conexión
    cerrarConexion($conn);
  }
 ?>
