<?php
  function ConsultarPatines($dni,$inicio,$fin,$conn) {//Le pasamos el dni del cliente, el inicio y fin y devolvemos un array con los datos de alquileres de patines del mismo entre ambas fechas
    try {
      $con = 0;
      $ventas = array();

      $stmt = $conn->prepare("SELECT epatines.matricula,ealquileres.fecha_alquiler FROM ealquileres,eclientes,epatines
        WHERE ealquileres.dni = eclientes.dni AND ealquileres.matricula = epatines.matricula
        AND eclientes.dni = '$dni' AND ealquileres.fecha_alquiler >= '$inicio' AND '$fin' <= ifnull(ealquileres.fecha_devolucion,'2221-12-12 00:00:00')");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $ventas[$con] = $row["matricula"];
          $con++;
          $ventas[$con] = $row["fecha_alquiler"];
          $con++;
       }
       return $ventas;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
