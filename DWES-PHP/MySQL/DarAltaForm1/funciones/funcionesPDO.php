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

  function altaDepartamento($campo) {//Le pasamos el nombre del departamento y lo metemos en la tabla departamento
    try {//Intentamos insertar el campo
      $conn = abrirConexion();

      $stmt = $conn->prepare("INSERT INTO departamento (nombre_Departamento) VALUES (:nombre)");

      $stmt->bindParam(':nombre', $campo);//Definimos el parametro a insertar
      $stmt->execute();//Ejecutamos el insert

      echo "Departamento $campo creado";
    }
    catch (PDOException $e) {//En caso de fallar el Insert mostramos el mensaje de error
      echo "Error: " . $e->getMessage();
    }

    $conn = null;//Cerramos la conexión
  }
 ?>
