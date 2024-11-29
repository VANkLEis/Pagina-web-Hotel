<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php"); // Redirigir al login si no está autenticado
    exit();
}

// Validar y sanitizar la sesión
$usuario = filter_var($_SESSION['usuario'], FILTER_SANITIZE_STRING);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Bienvenido, <?php echo $usuario; ?>!</h1>
    <p>Esta es tu área de usuario.</p>
    <a href="reservas.php">Realizar una reserva</a><br>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>
