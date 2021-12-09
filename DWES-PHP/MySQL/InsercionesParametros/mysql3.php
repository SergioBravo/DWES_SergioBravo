<?php
/*Inserción en tabla Prepared Statement - MySQLi procedural*/

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "empleados1n";

$conn  = mysqli_connect($servername,$username , $password, $dbname);

/* check connection */
if (!$conn ) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$stmt = mysqli_prepare($conn, "INSERT INTO departamento (nombre_Departamento) VALUES (?)");
mysqli_stmt_bind_param($stmt, 'ss', $nombre);

/*bound parameters*/
$nombre = 'Ciencias';
/* execute prepared statement */
mysqli_stmt_execute($stmt);
printf("%d Row inserted.\n", mysqli_stmt_affected_rows($stmt));

/*bound parameters*/
$nombre = 'Compras';
/* execute prepared statement */
mysqli_stmt_execute($stmt);

printf("%d Row inserted.\n", mysqli_stmt_affected_rows($stmt));

/* close statement and connection */
mysqli_stmt_close($stmt);


/* close connection */
mysqli_close($conn );
?>
