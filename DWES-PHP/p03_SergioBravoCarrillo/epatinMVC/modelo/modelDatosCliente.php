<?php
  function sacarDatosCliente($dni,$conn) {//Le pasamos el dni de un cliente y la conexión a la bdd y devolvemos el nombre que corresponde a dicho dni
    try {
      $datos = array();
      $stmt = $conn->prepare("SELECT nombre,apellido,saldo FROM eclientes WHERE dni = '$dni'");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $datos[0] = $row["nombre"];
          $datos[1] = $row["apellido"];
          $datos[2] = $row["saldo"];
       }
       return $datos;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
