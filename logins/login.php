<?php
session_start();

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "hotel_reservas");

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    // Validar campos
    if (empty($usuario) || empty($contrasena)) {
        die("Por favor, completa todos los campos.");
    }

    // Consulta segura
    $stmt = $conn->prepare("SELECT id, password FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $stmt->bind_result($id, $hashedPassword);
    $stmt->fetch();

    if ($id && password_verify($contrasena, $hashedPassword)) {
        $_SESSION['usuario_id'] = $id;
        $_SESSION['usuario'] = $usuario;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
}
$conn->close();
?>
