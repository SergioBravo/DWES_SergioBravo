<?php
  function abrirConexion() {//Devolvemos la conexión con el servidor si ha sido posible realizarla si no mostramos un mensaje
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="empleadosnn";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function cerrarConexion($conn) {$conn = null;}//Cerramos la conexión

  function selectDepartamento($conn) {
    try {
      $stmt = $conn->prepare("SELECT * FROM departamento");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          echo "<option value=".$row["cod_dpto"].">".$row["cod_dpto"]." ".$row["nombre_dpto"]."</option>";
       }
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function selectEmpleado($conn) {
    try {
      $stmt = $conn->prepare("SELECT * FROM empleado");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          echo "<option value=".$row["dni"].">".$row["dni"]." ".$row["nombre"]."</option>";
       }
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function PonerFechaFin($dni,$conn) {//Le pasamos un empleado y la conexión para poner una fecha de fin a su trabajo en el antiguo departamento
    $dni = "\"$dni\"";
    try {
      $stmt = $conn->prepare("UPDATE emple_depart SET fecha_fin = :FECHA_FIN WHERE fecha_fin IS NULL AND dni = $dni");
      //Definimos los parametros a insertar
      $fechaFin = date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");
      $stmt->bindParam(':FECHA_FIN', $fechaFin);
      $stmt->execute();//Ejecutamos el update
    }
    catch (PDOException $e) {//En caso de fallar el Update mostramos el mensaje de error
      echo "Error: ".$e->getMessage();
    }
  }

  function cambiarDepEmp($empleado,$departamento,$conn) {
    try {//Intentamos insertar el campo
      $stmt = $conn->prepare("INSERT INTO emple_depart(dni,cod_dpto,fecha_ini,fecha_fin) VALUES (:DNI,:COD,:FECHA_INI,:FECHA_FIN)");
      //Definimos los parametros a insertar
      $stmt->bindParam(':DNI', $empleado);
      $stmt->bindParam(':COD', $departamento);
      $fechaIni = date("Y")."-".date("m")."-".date("d")." ".date("H").":".date("i").":".date("s");//aaaa-mm-dd hh:mm:ss
      $stmt->bindParam(':FECHA_INI', $fechaIni);
      $fechaFin = null;
      $stmt->bindParam(':FECHA_FIN', $fechaFin);
      $stmt->execute();//Ejecutamos el insert

      echo "<h1>Se ha cambiado al empleado</h1>";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: ".$e->getMessage();
    }
  }
 ?>
