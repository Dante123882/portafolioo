<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre  = trim($_POST['nombre'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');
    $correoDestino = trim($_POST['correoDestino'] ?? '');

    if ($nombre === '' || $email === '' || $mensaje === '' || $correoDestino === '') {
        echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            icon: 'warning',
            title: 'Campos incompletos',
            text: 'Por favor llena todos los campos.',
            confirmButtonColor: '#f59e0b'
        }).then(() => {
            window.history.back();
        });
        </script>";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'danterodzflores@gmail.com';
        $mail->Password   = 'tcjhvllenalqbavj';
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        $mail->setFrom('danterodzflores@gmail.com', 'Formulario de Contacto');
        $mail->addReplyTo($email, $nombre);
        $mail->addAddress($correoDestino);

        $mail->isHTML(true);
        $mail->Subject = 'Nuevo mensaje desde el Portafolio';
        $mail->Body = "
            <h3>Nuevo mensaje recibido</h3>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Mensaje:</strong><br>{$mensaje}</p>
        ";

        $mail->send();

        echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Enviando...</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
<script>
Swal.fire({
    icon: 'success',
    title: '¡Mensaje enviado!',
    text: 'Tu mensaje fue enviado correctamente 😊',
    confirmButtonColor: '#0e9c15'
}).then(() => {
    window.location.href = 'contacto.html';
});
</script>
</body>
</html>
";


    } catch (Exception $e) {
    echo "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Error</title>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
<body>
<script>
Swal.fire({
    icon: 'error',
    title: 'Error al enviar',
    text: 'No se pudo enviar el mensaje.',
    confirmButtonColor: '#ef4444'
}).then(() => {
    window.history.back();
});
</script>
</body>
</html>
";

    }
}