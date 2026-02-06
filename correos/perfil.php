<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.html");
    exit;
}

$id = $_SESSION['usuario_id'];

$sql = "SELECT nombre, telefono, plan, foto_perfil 
        FROM usuarios 
        WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$foto = $user['foto_perfil'] ?: 'default.png';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/perfil.css">
</head>
<body>

<div class="perfil-container">
    <h2>Mi Perfil</h2>

    <div class="foto-perfil">
        <img src="uploads/<?= htmlspecialchars($foto) ?>">
    </div>

    <form action="actualizar_perfil.php" method="POST" enctype="multipart/form-data">

        <label>Nombre</label>
        <input type="text" name="nombre"
               value="<?= htmlspecialchars($user['nombre']) ?>" required>

        <label>Número de teléfono</label>
        <input type="text" name="telefono"
               value="<?= htmlspecialchars($user['telefono']) ?>" required>

        <label>Plan actual</label>
        <input type="text"
               value="<?= htmlspecialchars($user['plan']) ?>" disabled>

        <label>Cambiar foto</label>
        <input type="file" name="foto" accept="image/*">

        <button type="submit">Guardar cambios</button>

        <div class="links">
            <a href="dashboard.php">← Volver</a>
        </div>
    </form>
</div>

</body>
</html>