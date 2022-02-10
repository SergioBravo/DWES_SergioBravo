<?php
  session_start();
  include "funcionesComunes/funcionesComunes.php";
  $conn = abrirConexion();
  $datosCliente = sacarDatosCliente($_SESSION['dni'],$conn);
 ?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a EPATIN</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
 </head>

 <body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - OPERACIONES </div>
		<div class="card-body">


		<B>Bienvenido/a: </B><?php echo $datosCliente[0]." ".$datosCliente[1] ?><BR><BR>
		<B>Saldo Cuenta: </B><?php echo $datosCliente[2] ?> €<BR><BR>

		<!--Formulario con enlaces -->
		<ul>
			<li><a href="ealquilar.php">Alquilar Patin</a></li>
			<li><a href="econsultar.php">Consultar Alquileres</a></li>
			<li><a href="eaparcar.php">Aparcar Patin</a></li>
		</ul>



		  <BR><a href="funciones/cerrarSesion.php">Cerrar Sesión</a>
	</div>



   </body>

</html>
