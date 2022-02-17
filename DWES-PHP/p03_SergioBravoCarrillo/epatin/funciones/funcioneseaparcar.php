<?php
  function devolverPatin($dni,$patin,$fechaD,$conn) {//Actualizamos en la tabla ealquileres los datos que se nos pasan
    try {//Intentamos realizar el update
      $datos = sacarDatosPatin($dni,$patin,$conn);
      $inicio = strtotime($datos[0]);
      $fin = strtotime($fechaD);
      $intervalo  = abs($fin - $inicio);
      $cantidad = floatval($datos[1])*$intervalo;

      $stmt = $conn->prepare("UPDATE ealquileres SET preciototal = '$cantidad',fecha_devolucion = '$fechaD' WHERE dni = '$dni' AND matricula = '$patin'");

      $stmt->execute();
      actualizarSueldo($dni,$cantidad,$conn);
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }

  function sacarDatosPatin($dni,$patin,$conn) {//Sacamos la fecha de incio del alquiler y el precio base de epatin
    try {
      $datos = array();
      $stmt = $conn->prepare("SELECT ealquileres.fecha_alquiler,epatines.preciobase FROM ealquileres,epatines
                              WHERE ealquileres.matricula = epatines.matricula
                              AND ealquileres.dni = '$dni' AND epatines.matricula = '$patin'");
      $stmt->execute();
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

      foreach($stmt->fetchAll() as $row) {
        $datos[0] = $row['fecha_alquiler'];
        $datos[1] = $row['preciobase'];
      }

     return $datos;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function actualizarSueldo($dni,$cantidad,$conn) {
    try {//Intentamos realizar el update
      $stmt = $conn->prepare("UPDATE eclientes SET saldo = saldo-'$cantidad' WHERE dni = '$dni'");

      $stmt->execute();
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }
 ?>
