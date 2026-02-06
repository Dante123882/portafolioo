<?php
session_start();
include 'conexion.php';

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $login    = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    $sql = "SELECT * FROM usuarios 
            WHERE email = :login OR telefono = :login";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':login' => $login]);

    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($password, $usuario['password'])) {

        // Sesión
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['password_actualizada'] = $usuario['password_actualizada'];

        // Redirección correcta
        header("Location: dashboard.php");
        exit;

    } else {
        // ❌ Solo aquí se activa la alerta
        $error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión | Netflix Style</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="background-overlay"></div>

<main class="login-box">

    <h1 class="logo">NETFLIX</h1>

    <!-- ALERTA SOLO SI HAY ERROR -->
    <?php if ($error): ?>
        <div class="alerta error">
            Correo, teléfono o contraseña incorrectos
        </div>
    <?php endif; ?>

    <form method="POST">

        <div class="campo">
            <input type="text" name="login" required>
            <label>Email o teléfono</label>
        </div>

        <div class="campo">
            <input type="password" name="password" required>
            <label>Contraseña</label>
        </div>

        <button type="submit" class="btn principal">
            Iniciar sesión
        </button>

    </form>

    <div class="links">
        <a href="index.php">← Volver al inicio</a>
    </div>

</main>

</body>
</html>
