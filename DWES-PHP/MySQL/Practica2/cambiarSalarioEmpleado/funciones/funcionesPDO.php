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

  function optionsEmpleado($conn) {//Nos devuelve los nombres y dni de los empleados para crear luego las options
    try {
      $con = 0;
      $stmt = $conn->prepare("SELECT dni,nombre FROM empleado");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
        foreach($stmt->fetchAll() as $row) {
          $datos[$con] = $row["dni"]." ".$row["nombre"];
          $con++;
       }
       return $datos;
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function cambiarSalario($empleado,$salario,$conn) {
    try {
      $empleado = "\"".$empleado."\"";

      if ($salario[0] == "-") {
        $salario = floatval("0.".substr($salario,1,strlen($salario)));
        $stmt = $conn->prepare("UPDATE empleado SET salario = salario - (salario*$salario) WHERE dni = $empleado");
        $stmt->execute();//Ejecutamos el update

        echo "<h1>Salario decrementado</h1>";
      }
      else {
        $salario = floatval("1.".substr($salario,1,strlen($salario)));
        $stmt = $conn->prepare("UPDATE empleado SET salario = salario*$salario WHERE dni = $empleado");
        $stmt->execute();//Ejecutamos el update

        echo "<h1>Salario incrementado</h1>";
      }
    }
    catch (PDOException $e) {//En caso de fallar el Update mostramos el mensaje de error
      echo "Error: ".$e->getMessage();
    }
  }
 ?>
