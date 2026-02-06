<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/inicio_sesion.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesion</title>
</head>
<body>
    <form action="login.php" method="POST">
    <input type="text" name="login" placeholder="Correo o teléfono" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Iniciar sesión</button>
    <a href="registro.php">Registro</a>
    <a href="index.php">← Volver</a>
</form>

</body>
</html>