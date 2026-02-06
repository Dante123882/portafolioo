<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/registro.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    

<form action="enviar.php" method="POST">

    <input type="text" name="nombre" placeholder="Nombre completo" required>

    <input type="email" name="email" placeholder="Correo electrónico" required>

    <input type="text" name="telefono" placeholder="Teléfono" required>

    <h3>📦 Selecciona tu plan</h3>
    <select name="plan" required>
        <option value="">Seleccionar plan</option>
        <option value="Básico">Básico - 1 pantalla</option>
        <option value="Estándar">Estándar - HD</option>
        <option value="Premium">Premium - 4K</option>
    </select>

    <h3>💳 Método de pago</h3>
    <select name="metodo_pago" required>
        <option value="">Seleccionar método</option>
        <option value="Tarjeta">Tarjeta</option>
        <option value="PayPal">PayPal</option>
    </select>

    <button type="submit">Registrarse</button>
    <a href="inicio_sesion.php">Iniciar sesión</a>
    <a href="index.php">← Volver</a>
</form>
</body>
</html>

<script>
const params = new URLSearchParams(window.location.search);

if (params.get('error') === 'email') {
    Swal.fire({
        icon: 'error',
        title: 'Correo ya registrado',
        text: 'Correo o número en uso. Intenta otra vez.',
        confirmButtonColor: '#e50914'
    });

    // LIMPIAR URL
    history.replaceState(null, null, window.location.pathname);
}
</script>