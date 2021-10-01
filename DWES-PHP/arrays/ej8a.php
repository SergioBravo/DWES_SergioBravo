<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
       $alumnos = array ("Ana"=>5, "Sergio"=>10, "Carlos"=>7, "Dani"=>9, "Bea"=>4);#Definimos un array asociativo
       $max = 0;
       $amax = "";
       $amin = "";
       $min = 10;
       $suma = 0;

       foreach ($alumnos as $key => $value) {
         if ($value > $max){$amax = $key;$max = $value;}//Si algo es mayor que el valor actual de max se guarda
         if ($value < $min){$amin = $key;$min = $value;}//Si algo es menor que el valor actual de min se guarda
         $suma +=$value;
       }

       echo "El alumno con la mayor nota es: ".$amax."<br>";
       echo "El alumno con la menor nota es: ".$amin."<br>";
       echo "La media de las notas de BDD es: ".$suma/count($alumnos);
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
