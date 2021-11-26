<?php
  function test_input($data) {//Limpiamos los datos que nos pasan
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);

    return $data;
  }

  function abrirConexion() {//Devolvemos la conexión con el servidor si ha sido posible realizarla si no mostramos un mensaje
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname="empleados1n";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname",$username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function crearOptions() {
    $conn = abrirConexion();

    try {
      $stmt = $conn->prepare("SELECT * FROM departamento");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados

	    foreach($stmt->fetchAll() as $row) {
        echo "<option value=".$row["nombre_Departamento"].">".$row["nombre_Departamento"]."</option>";
     }
    }
    catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
  }

  function altaEmpleado($dni,$nombre,$fecha,$departamento) {//Le pasamos los datos del empleado y lo insertamos
    try {//Intentamos insertar el campo
      $conn = abrirConexion();

      $stmt = $conn->prepare("INSERT INTO empleado(dni,nombre_Empleado,fecha_nacimiento,nombre_Departamento) VALUES (:DNI,:NOMBRE,:FECHA,:DEPARTAMENTO)");

      $stmt->bindParam(':DNI', $dni);//Definimos el parametro a insertar
      $stmt->bindParam(':NOMBRE', $nombre);//Definimos el parametro a insertar
      $stmt->bindParam(':FECHA', $fecha);//Definimos el parametro a insertar
      $stmt->bindParam(':DEPARTAMENTO', $departamento);//Definimos el parametro a insertar
      $stmt->execute();//Ejecutamos el insert

      echo "<h1>Empleado creado</h1>";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }

    $conn = null;//Cerramos la conexión
  }
 ?>
