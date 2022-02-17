<?php
  function optionsPatines($conn) {//Le pasamos la conexión a la bdd y sacamos todos los patines disponibles
    try {
      $con = 0;
      $stmt = $conn->prepare("SELECT matricula FROM epatines WHERE disponible = 'S'");
      $stmt->execute();

      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        foreach($stmt->fetchAll() as $row) {
          $options[$con] = $row["matricula"];
          $con++;
       }
       return $options;
    }
    catch(PDOException $e) {
        echo mostrarErrores($e);
    }
  }

  function actualizarDisponible($patin,$conn,$disponible) {//Le pasamos una matricula, la conexion a la bdd y la disponibilidad y cambiamos la disponibilidad del patin
    try {//Intentamos realizar el update
      $stmt = $conn->prepare("UPDATE epatines SET disponible = '$disponible' WHERE matricula = '$patin'");

      $stmt->execute();
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }
  }

  function alquilarPatin($dni,$patin,$fechaA,$conn) {
    try {
      $stmt = $conn->prepare("INSERT INTO ealquileres (dni,matricula,fecha_alquiler) VALUES (:DNI,:MATRICULA,:FECHA)");

      $stmt->bindParam(':DNI', $dni);
      $stmt->bindParam(':MATRICULA', $patin);
      $stmt->bindParam(':FECHA', $fechaA);

      $stmt->execute();
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }
 ?>
