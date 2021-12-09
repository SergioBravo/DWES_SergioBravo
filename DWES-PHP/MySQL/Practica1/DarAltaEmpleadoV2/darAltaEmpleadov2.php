<?php
include './funciones/funcionesPDO.php';

  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>Alta Empleado</title>";
    echo "</head>";
    echo "<body>";
      echo "<h1>Alta Empleado</h1>";
      echo "<form method=post action=".htmlspecialchars($_SERVER["PHP_SELF"]).">";
        echo "<p>DNI: <input type=text name=dni></p>";
        echo "<p>NOMBRE: <input type=text name=nombre></p>";
        echo "<p>FECHA: <input type=text name=fecha></p>";
        echo "<p>DEPARTAMENTO: <select name=departamento>";
          crearOptions();
        echo "</select></p>";
        echo "<p><input type=submit name=alta value=Alta></p>";
      echo "</form>";
    echo "</body>";
  echo "</html>";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = test_input($_POST['dni']);
    $nombre = test_input($_POST['nombre']);
    $fecha = test_input($_POST['fecha']);
    $departamento = test_input($_POST['departamento']);

    altaEmpleado($dni,$nombre,$fecha,$departamento);
  }
 ?>
