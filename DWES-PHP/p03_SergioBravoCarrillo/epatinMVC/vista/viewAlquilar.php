<!--En caso de tener algun error los mostramos por pantalla -->
<?php
 if (isset($error)) {//En caso de existir la variable error
   switch ($error) {
     case 1:
       echo "<h2>No se pueden alquilar más patines</h2>";
       break;
     case 2:
       echo "<h2>Ya se ha añadido ese producto al carrito</h2>";
       break;
     case 3:
       echo "<h2>No hay productos en el carrito</h2>";
       break;
     case 4:
       echo "<h2>No se puede realizar el alquiler su saldo es inferior a 10€</h2>";
       break;
   }
 }
  else if (isset($mensajes)) {//En caso de vaciar el carrito mostramos un mensaje
    switch ($mensajes) {
      case 1:
        echo "<h2>Patin añadido al carrito</h2>";
        break;
      case 2:
        echo "<h2>Se han alquilado los patines</h2>";
        break;
      case 3:
        echo "<h2>El carrito se ha vaciado</h2>";
        break;
    }
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
		<div class="card-header">Menú Usuario - ALQUILAR PATINETES</div>
		<div class="card-body">


	<!-- INICIO DEL FORMULARIO -->
	<form action="" method="post">

    <B>Bienvenido/a: </B><?php echo $datosCliente[0]." ".$datosCliente[1] ?><BR><BR>
		<B>Saldo Cuenta: </B><?php echo $datosCliente[2] ?> €<BR><BR>

		<B>PATINETES disponibles </B><?php echo $_SESSION['fecha'] ?><BR>

			<select name="patinetes" class="form-control">
        <?php
          //Mostramos los patines disponibles
          for ($i=0; $i < $sizeoptionsPatines; $i++) {
            echo "<option value=".$optionsPatines[$i].">".$optionsPatines[$i]."</option>";
          }
         ?>
			</select>


		<BR> <BR><BR><BR><BR><BR>
		<div>
			<p>
        <input type="submit" value="Agregar a Cesta" name="agregar" class="btn btn-warning disabled">
  			<input type="submit" value="Realizar Alquiler" name="alquilar" class="btn btn-warning disabled">
  			<input type="submit" value="Vaciar Cesta" name="vaciar" class="btn btn-warning disabled">
      </p>
      <p><input type="submit" value="Volver" name="volver" class="btn btn-warning disabled"></p>
		</div>
	</form>
 <p><a href = "../controlador/conCerrarSesion.php">Cerrar Sesion</a></p>
 </body>
</html>
<?php } ?>
