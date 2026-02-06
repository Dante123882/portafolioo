<?php
include 'conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function generarPassword($longitud = 8) {
    return substr(str_shuffle(
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'
    ), 0, $longitud);
}


// DATOS
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$plan = $_POST['plan'];
$metodo = $_POST['metodo_pago'];

// GENERAR CONTRASEÑA
$passwordPlano = generarPassword(10);
$passwordHash = password_hash($passwordPlano, PASSWORD_DEFAULT);

// VERIFICAR SI EL CORREO YA EXISTE
$sql = "SELECT id FROM usuarios WHERE email = :email";
$stmt = $pdo->prepare($sql);
$stmt->execute(['email' => $email]);

if ($stmt->rowCount() > 0) {
    header("Location: registro.php?error=email");
    exit;
}

// GUARDAR USUARIO
$sql = "INSERT INTO usuarios 
(nombre, email, telefono, password, plan, metodo_pago)
VALUES (:nombre, :email, :telefono, :password, :plan, :metodo)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    'nombre' => $nombre,
    'email' => $email,
    'telefono' => $telefono,
    'password' => $passwordHash,
    'plan' => $plan,
    'metodo' => $metodo
]);

// ENVIAR CORREO
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'danterodzflores@gmail.com';
    $mail->Password = 'tcjhvllenalqbavj';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('danterodzflores@gmail.com', 'MiFlix');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Bienvenido a MiFlix 🎬';

    $mail->Body = "
        <h2>Hola $nombre 👋</h2>
        <p>Gracias por registrarte en <b>MiFlix</b>.</p>

        <p><b>Plan seleccionado:</b> $plan</p>
        <p><b>Método de pago:</b> $metodo</p>

        <hr>
        <p><b>Usuario:</b> $email</p>
        <p><b>Contraseña:</b> <strong>$passwordPlano</strong></p>

        <p>Te recomendamos cambiar tu contraseña al iniciar sesión.</p>
    ";

    $mail->send();

    header("Location: index.php");
    exit;

} catch (Exception $e) {
    echo "⚠️ Usuario creado, pero error al enviar correo.";
}