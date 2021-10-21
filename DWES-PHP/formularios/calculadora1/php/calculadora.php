<?php
include './funciones/operaciones.php';
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      echo "<h1 align=center>CALCULADORA</h1>";
      echo "<div name=resultado align=center>";
      #PRINCIPIO CODIGO
        $op1 = $_POST['op1'];//Recogemos los datos que se introducen en la caja de texto dentro del formulario de nombre op1
        $op2 = $_POST['op2'];//Recogemos los datos que se introducen en la caja de texto dentro del formulario de nombre op1
        $operacion = $_POST['operaciones'];//Recogemos el value que tenga el input radio una vez que enviamos le formulario

        switch ($operacion) {
          case 'suma':
            echo "Resultado operación: $op1 + $op2 = ".Suma($op1,$op2);
            break;
          case 'resta':
            echo "Resultado operación: $op1 - $op2 = ".Resta($op1,$op2);
            break;
          case 'producto':
            echo "Resultado operación: $op1 * $op2 = ".Producto($op1,$op2);
            break;
          case 'division':
            if (Division($op1,$op2) == -1){echo "No se puede dividir entre 0";}
            else {echo "Resultado operación: $op1 / $op2 = ".Division($op1,$op2);}
            break;
          default:
            echo "Selecciona una operacion";
            break;
        }
      #FINAL CODIGO
      echo "</div>";
    echo "</body>";
  echo "</html>";
 ?>
