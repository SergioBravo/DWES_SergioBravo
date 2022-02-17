<?php
  if (isset($error)) {//En caso de existir la variable error
    echo "<h2>No hay patines para devolver</h2>";
  }
   else if (isset($mensaje)) {//En caso de vaciar el carrito mostramos un mensaje
     echo "<h2>Patinete Aparcado</h2>";
   }
   else {
 ?>
<html>

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Bienvenido a EPATIN</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
  </head>

  <body>
    <h1>Servicio de ALQUILER PATINETES ELÉCTRICOS</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Menú Usuario - APARCAR PATINETE </div>
		<div class="card-body">



	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">

    <B>Bienvenido/a: </B><?php echo $datosCliente[0]." ".$datosCliente[1] ?><BR><BR>
		<B>Saldo Cuenta: </B><?php echo $datosCliente[2] ?> €<BR><BR>

			<B>PATINETES ALQUILADOS: </B><select name="patinetes" class="form-control">
        <?php
          for ($i=0; $i < $sizeAlquilados; $i++) {
            echo "<option value=".$alquilados[$i].">".$alquilados[$i]."</option>";
          }
         ?>
			</select>
		<BR><BR>
		<div>
			<input type="submit" value="Aparcar Patinete" name="devolver" class="btn btn-warning disabled">
			<input type="submit" value="Volver" name="volver" class="btn btn-warning disabled">
		</div>
	</form>
	<!-- FIN DEL FORMULARIO -->
	<a href = "conInicio.php">Cerrar Sesion</a>

  </body>

</html>
<?php } ?>
