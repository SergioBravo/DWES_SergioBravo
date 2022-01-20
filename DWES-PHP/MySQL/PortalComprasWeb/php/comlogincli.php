<html>
  <head>
    <title>Login Usuarios</title>
  </head>
  <body>
      <form action="../funciones/comprobarLogin.php" method="POST">
        <h1>Login</h1>
        <p>Usuario: <input type="text" name="nombre" placeholder="Usuario" required/></p>
        <p>Contraseña: <input type="password" name="contraseña" required/></p>
        <input type="submit" value="Login" />
      </form>
    <p><a href="../index.html">Volver al menu</a></p>
  </body>
</html>
