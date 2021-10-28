<?php
  function copiarFichero($origen,$destino) {
    if (!file_exists($origen)){
      echo "<p>No existe el fichero</p>";
      fopen($origen,"w+");
      echo "<p>Se ha creado el fichero</p>";
      copy($origen,$destino);
      echo "<p>Se ha copiado $origen a $destino</p>";
    }
    else {
      copy($origen,$destino);
      echo "<p>Se ha copiado el fichero $origen a $destino</p>";
    }
  }

  function renombrarFichero($origen,$destino) {
    if (!file_exists($origen)){
      echo "<p>No existe el fichero</p>";
      fopen($origen,"w+");
      echo "<p>Se ha creado el fichero</p>";
      rename($origen,$destino);
      echo "<p>Se ha renombrado $origen por $destino</p>";
    }
    else {
      rename($origen,$destino);
      echo "<p>Se ha renombrado el fichero $origen por $destino</p>";
    }
  }

  function borrarFichero($origen) {
    if (!file_exists($origen)){echo "<p>Operacion invalida NO EXISTE EL FICHERO</p>";}
    else {unlink($origen);echo "<p>Se ha borrado el fichero $origen</p>";}//usamos la funcion unlink
  }
 ?>
