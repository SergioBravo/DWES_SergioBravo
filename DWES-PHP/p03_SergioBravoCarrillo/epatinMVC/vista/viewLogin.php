<!--En caso de tener algun error los mostramos por pantalla -->
<?php
 if (isset($error)) {//En caso de existir la variable error
   switch ($error) {
     case 0:
       echo "<h2>Falta Usuario/Contraseña</h2>";
       break;
     case 1:
       echo "<h2>Usuario/Contraseña incorrecto porfavor compruebe las credenciales</h2>";
       break;
   }
 } else {
 ?>
<html>
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page - EPATIN</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
 </head>

<body>
    <h1>ALQUILER PATINETES ELÉCTRICOS</h1>

    <div class="container ">
        <!--Aplicacion-->
		<div class="card border-success mb-3" style="max-width: 30rem;">
		<div class="card-header">Login Usuario</div>
		<div class="card-body">

		<form id="" name="" action="" method="post" class="card-body">

		<div class="form-group">
			Email <input type="text" name="email" placeholder="email" class="form-control">
        </div>
		<div class="form-group">
			Clave <input type="password" name="password" placeholder="password" class="form-control">
        </div>

		<input type="submit" name="submit" value="Login" class="btn btn-warning disabled">
        </form>

	    </div>
    </div>
    </div>
    </div>

</body>
</html>
<?php } ?>
