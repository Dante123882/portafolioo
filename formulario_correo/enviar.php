<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$whatsapp = $_POST['whatsapp'];

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vazquezcarla159@gmail.com';
    $mail->Password = 'xttr arpi roup xcae';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('vazquezcarla159@gmail.com', 'Formulario');
    $mail->addAddress($correo, $nombre);

    $mail->Subject = 'Gracias por contactarnos';
    $mail->Body = "Hola $nombre,
Hemos recibido tu información.

Correo: $correo
WhatsApp: $whatsapp";

    $mail->send();

    echo "<script>
      alert('Correo enviado correctamente');
      window.location.href='index.html';
    </script>";

} catch (Exception $e) {
    echo "Error al enviar: {$mail->ErrorInfo}";
}