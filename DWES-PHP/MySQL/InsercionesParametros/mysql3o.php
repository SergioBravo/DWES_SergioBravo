<?php
/*Inserción en tabla Prepared Statement - MySQLi Object-oriented*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO departamento (nombre_Departamento) VALUES (?)");
$stmt->bind_param('ss', $nombre);

// set parameters and execute
$nombre = 'Ciencias';
$stmt->execute();

$nombre = 'Compras';
$stmt->execute();

echo "New records created successfully";

$stmt->close();
$conn->close();
?>
