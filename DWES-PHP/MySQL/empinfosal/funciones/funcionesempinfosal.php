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
          echo "<option value=".$row["cod_dpto"].">".$row["nombre_dpto"]."</option>";
       }
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }

  function mostrarSalario($departamento,$conn) {//Le pasamos un departamento y la conexión a la BBDD y devolvemos los salarios de cada empleado del departamento
    try {
      $stmt = $conn->prepare("SELECT empleado.nombre,empleado.salario FROM empleado,departamento,emple_depart
                              WHERE empleado.dni = emple_depart.dni AND departamento.cod_dpto = emple_depart.cod_dpto
                              AND departamento.cod_dpto = '$departamento' AND emple_depart.fecha_fin IS NULL");
      $stmt->execute();

      //Guardamos los resultados en un array asociativo
      $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);//Guardo los resultados
      $suma = 0;//Para almacenar la suma de salarios de cada departamento
        foreach($stmt->fetchAll() as $row) {
          echo $row["nombre"]." --> ".$row["salario"]."€ <br>";
          $suma += $row["salario"];
       }
       if ($suma == 0) {echo "No hay empleados trabajando en el departamento";}
       else {
         echo "<br>Total = ".$suma."€";
       }
    }
    catch(PDOException $e) {
        echo "Error: ".$e->getMessage();
    }
  }
 ?>
