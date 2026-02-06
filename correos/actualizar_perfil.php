<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario_id'])) {
    die("❌ Sesión no válida");
}

$id = $_SESSION['usuario_id'];
$nombre = trim($_POST['nombre']);

// Validar nombre
if (empty($nombre)) {
    die("❌ Nombre inválido");
}

// -------------------- FOTO --------------------
$fotoNombre = null;

if (!empty($_FILES['foto']['name'])) {

    $permitidos = ['image/jpeg', 'image/png', 'image/jpg'];

    if (!in_array($_FILES['foto']['type'], $permitidos)) {
        die("❌ Solo JPG o PNG");
    }

    $extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
    $fotoNombre = uniqid() . "." . $extension;
    $ruta = "uploads/" . $fotoNombre;

    move_uploaded_file($_FILES['foto']['tmp_name'], $ruta);

    // Guardar nombre + foto
    $sql = "UPDATE usuarios SET nombre = :nombre, foto_perfil = :foto WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nombre' => $nombre,
        'foto'   => $fotoNombre,
        'id'     => $id
    ]);

} else {
    // Solo actualizar nombre
    $sql = "UPDATE usuarios SET nombre = :nombre WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'nombre' => $nombre,
        'id'     => $id
    ]);

    //Actualizar telefono
    $sql = "UPDATE usuarios SET telefono = :telefono WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'telefono' => $_POST['telefono'],
        'id'     => $id
    ]);
}

header("Location: perfil.php");
exit;