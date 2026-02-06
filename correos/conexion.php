<?php
// $host = "localhost";
// $user = "CarlaV";
// $pass = "Vazmaga2*";
// $database = "correos";

// servidor del profe
$host = "localhost";
$user = "alumno_21"; //tu alumno
$pass = "90qveuCJD6bJU0RGZdWm5Nr6b"; // la segunda contraseña 
$database = "alumno_21";


try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "conexion exitosa";
} catch (PDOException $e) {
    echo "error de conexion: " . $e->getMessage();
}
