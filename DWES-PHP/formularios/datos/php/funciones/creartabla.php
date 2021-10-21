<?php
  function crearTabla($nombre,$apellido1,$apellido2,$email,$sexo) {
    echo "<table border=1>";
      echo "<tr>";
        echo "<th>Nombre</th>";
        if ($apellido1 != "" || $apellido2 != "") {
          echo "<th>Apellidos</th>";
        }
        echo "<th>Email</th>";
        echo "<th>Sexo</th>";
      echo "</tr>";

      echo "<tr>";
        echo "<td>$nombre</td>";
        if ($apellido1 != "" || $apellido2 != "") {
          echo "<td>$apellido1 $apellido2</td>";
        }
        echo "<td>$email</td>";
        echo "<td>$sexo</td>";
      echo "</tr>";
    echo "</table>";
  }
 ?>
