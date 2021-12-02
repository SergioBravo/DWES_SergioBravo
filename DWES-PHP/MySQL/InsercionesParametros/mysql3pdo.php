<?php
/*Inserción en tabla Prepared Statement- mysql PDO*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO departamento (nombre_Departamento) VALUES (:nombre)");
    $stmt->bindParam(':nombre', $nombre);

    // insert a row
	  $nombre = 'Ciencias';
    $stmt->execute();

    // insert another row
    $nombre = 'Compras';
    $stmt->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null;
?>
