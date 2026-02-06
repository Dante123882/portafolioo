<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// <!-- $nombre = $_SESSION['usuario'];-->
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Netflix Style</title>

    <!-- Fuente estilo Netflix -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>

<div class="background-overlay"></div>

<main class="dashboard">

<h2>Bienvenido</h2>

    <p class="mensaje">
        Acceso concedido correctamente.<br>
        Mantén tu cuenta segura actualizando tu contraseña.
    </p>

    <div class="acciones">
        <a href="perfil.php" class="btn principal">Ver perfil</a>
        <a href="cambiar_password.php" class="btn principal">Cambiar contraseña</a>
        <a href="logout.php" class="btn secundario">Cerrar sesión</a>
    </div>

    <section class="info">
        <h3>Estado de la cuenta</h3>
        <ul>
            <li class="ok">Sesión activa</li>
            <li class="ok">Datos cifrados</li>
            <li class="warn">Contraseña sin actualizar</li>
        </ul>
    </section>

</main>

</body>
</html>
