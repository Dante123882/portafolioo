<?php
include 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    die("❌ Sesión no válida");
}

$id = $_SESSION['usuario_id'];

$actual    = $_POST['actual'] ?? '';
$nueva     = $_POST['nueva'] ?? '';
$confirmar = $_POST['confirmar'] ?? '';

if ($nueva !== $confirmar) {
    header("Location: cambiar_password.php?error=nomatch");
    exit;
}

$sql = "SELECT password FROM usuarios WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    die("❌ Usuario no encontrado");
}

if (!password_verify($actual, $usuario['password'])) {
    header("Location: cambiar_password.php?error=nomatch");
    exit;
}

$nuevaHash = password_hash($nueva, PASSWORD_DEFAULT);

$sql = "UPDATE usuarios SET password = :password WHERE id = :id";
$stmt = $pdo->prepare($sql);

if ($stmt->execute([
    'password' => $nuevaHash,
    'id' => $id
])) {
    header("Location:index.php");
} else {
    echo "❌ Error al actualizar";
}
