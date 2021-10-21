<?php
include "./funciones/operaciones2.php";
echo "<html lang=es dir=ltr>";
  echo "<head>";
    echo "<meta charset=utf-8>";
    echo "<title></title>";
  echo "</head>";
  echo" <body>";
    echo "<h1 align=center>CALCULADORA</h1>";
    echo "<div name=cajaForm align=center>";
      echo "<form method=post action=".htmlspecialchars($_SERVER["PHP_SELF"]).">";
        echo "<p>";
          echo "<label for=op1>Operando1</label>";
          echo "<input type=text name=op1>";
        echo "</p>";
        echo "<p>";
          echo "<label for=op2>Operando2</label>";
        echo "<input type=text name=op2>";
        echo "</p>";
        echo "<div name=checkbox>";
          echo "<p>Selecciona operación</p>";
          echo "<input type=radio name=operaciones value=suma>Suma<br>";
          echo "<input type=radio name=operaciones value=resta>Resta<br>";
          echo "<input type=radio name=operaciones value=producto>Producto<br>";
          echo "<input type=radio name=operaciones value=division>Division<br>";
        echo "</div>";
        echo "<input type=submit name=enviar value=Enviar>";
        echo "<input type=reset name=borrar value=Borrar>";
    echo "</form>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
  }//finswitch
}//finif
#FINAL CODIGO
    echo "</div>";
  echo "</body>";
echo "</html>";
?>
