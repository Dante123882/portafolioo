<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

$forzado = isset($_GET['force']);
$error = null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cambiar contraseña | Netflix Style</title>

    <!-- Fuente -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/cambiar_password.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<div class="background-overlay"></div>

<main class="password-box">

    <h1 class="logo">NETFLIX</h1>

    <h2>Cambiar contraseña</h2>

    <?php if ($forzado): ?>
        <p class="mensaje-forzado">
            Por seguridad, debes cambiar tu contraseña antes de continuar.
        </p>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alerta error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="actualizar_password.php" method="POST">

        <div class="campo">
            <input type="password" name="actual" required>
            <label>Contraseña actual</label>
        </div>

        <div class="campo">
            <input type="password" name="nueva" required>
            <label>Nueva contraseña</label>
        </div>

        <div class="campo">
            <input type="password" name="confirmar" required>
            <label>Confirmar contraseña</label>
        </div>

        <button class="btn principal">
            Actualizar contraseña
        </button>

    </form>

    <?php if (!$forzado): ?>
        <div class="links">
            <a href="dashboard.php">← Volver</a>
        </div>
    <?php endif; ?>

</main>

</body>
</html>
<script>
const params = new URLSearchParams(window.location.search);

if (params.get('error') === 'nomatch') {
    Swal.fire({
        icon: 'error',
        title: 'Contraseñas no coinciden',
        text: 'La nueva contraseña y la confirmación deben ser iguales.',
        confirmButtonColor: '#e50914'
    });

    // Limpiar URL
    history.replaceState(null, null, window.location.pathname);
}
</script>