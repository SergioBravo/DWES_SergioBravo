<?php
include './funciones/funcionesPDO.php';

  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
      echo "<title>Alta Departamento</title>";
    echo "</head>";
    echo "<body>";
      echo "<h1>Alta Departamento</h1>";
      echo "<form method=post action=".htmlspecialchars($_SERVER["PHP_SELF"]).">";
        echo "<p>Departamento: <input type=text name=nombre></p>";
        echo "<p><input type=submit name=alta value=Alta></p>";
      echo "</form>";
    echo "</body>";
  echo "</html>";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = test_input($_POST['nombre']);
    altaDepartamento($nombre);
  }
 ?>
