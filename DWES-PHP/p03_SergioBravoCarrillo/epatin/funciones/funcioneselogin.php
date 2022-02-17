<?php
  function comprobarLogin($correo,$contraseña,$conn) {//Le pasamos un correo de un cliente y su contraseña
                                      //comprobamos que los datos coinciden con los que hay en la bdd y devolvemos un booleano indicando si es un login valido o no
    try {
      $valido = false;
      $stmt = $conn->prepare("SELECT email,dni FROM eclientes WHERE dni = '$contraseña'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      foreach($stmt->fetchAll() as $row) {
        if ($row['dni'] == $contraseña && $row['email'] == $correo) {$valido = true;}
      }

     return $valido;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
 ?>
