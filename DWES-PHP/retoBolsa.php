<?php
  echo "<html>";
    echo "<head></head>";
    echo "<body>";
      #PRINCIPIO CODIGO
      for ($i=0; $i < 50; $i++) {//Creamos el array de la bolsa de forma dinamica
        $nombre = "empresa".($i+1);
        $bolsa[$nombre] = array();//Se creara la key cada fila con el nombre con formato "EmpresaX"
        for ($x=0; $x < 9 ; $x++) {
          $atributo = "valor".$x;//Se creara la key de cada columna con el nombre con formato "ValorX"
          $bolsa[$nombre][$atributo] = rand(0, 15000);//Añadimos el valor a cada celda del cojunto EmpresaX-ValorX
        }
      }

      //Mostramos el array
      echo "<table border=1>";
        echo "<legend><h2>Tabla de atributos de cada empresa en la bolsa</h2></legend>";
        echo "<tr>";
          echo "<th>Empresa</th>";
        for ($i=0; $i < count($bolsa["empresa".($i+1)]); $i++) {//Este for cuenta el número de columnas del array y las crea en la tabla que mostraremos
          echo "<th>Valor".($i+1)."</th>";
        }
        echo "</tr>";
        foreach ($bolsa as $empresa => $atributos) {
          echo "<tr>";
            echo "<td>$empresa</td>";
            foreach ($atributos as $atributo => $valor) {
              echo "<td width=50>$valor</td>";
            }
          echo "</tr>";
        }
      echo "</table>";
      #FINAL CODIGO
    echo "</body>";
  echo "</html>";
 ?>
