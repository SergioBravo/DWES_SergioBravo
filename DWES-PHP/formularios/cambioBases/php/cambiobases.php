<?php
include './funciones/convertir.php';
  echo "<html lang=es dir=ltr>";
    echo "<head>";
      echo "<meta charset=utf-8>";
    echo "<title>Cambio Bases</title>";
  echo "</head>";
  echo "<body>";
    echo "<h1 align=center>CAMBIO DE BASES</h1>";
    echo "<div class=cajaForm align=center>";
    $numero = $_POST['numero'];
    $base = $_POST['base'];
      echo "<form action=cambiobase.php method=post>";
        echo "<p>";
        echo "<label for=num>Número Decimal</label>";
        echo "<input type=text name=num readonly value=$numero>";
        echo "</p>";
        #PRINCIPIO CODIGO
        switch ($base) {
          case 'bin':
            echo "El número $num en Binario es: ".Convertir($numero,2);
            break;
          case 'octa':
              echo "El número $num en Octal es: ".Convertir($numero,8);
            break;
          case 'hexa':
              echo "El número $num en Hexadecimal es: ".Convertir($numero,16);
            break;
          case 'all':
            echo "<div>";
              echo "<table border=1px>";
                echo "<tr>";
                  echo "<td>";
                    echo "Binario";
                  echo "</td>";
                  echo "<td>";
                    echo Convertir($numero,2);
                  echo "</td>";
                echo "</tr>";

                echo "<tr>";
                  echo "<td>";
                    echo "Octal";
                  echo "</td>";
                  echo "<td>";
                    echo Convertir($numero,8);
                  echo "</td>";
                echo "</tr>";

                echo "<tr>";
                  echo "<td>";
                    echo "Hexadecimal";
                  echo "</td>";
                  echo "<td>";
                    echo Convertir($numero,16);
                  echo "</td>";
                echo "</tr>";
              echo "</table>";
            echo "</div>";
            break;
          default:
            echo "Selecciona una base";
            break;
        }
        #FINAL CODIGO
        echo "</form>";
      echo "</div>";
  echo "</body>";
  echo "</html>";
?>
