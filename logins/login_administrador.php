<?php
// Configuración de base de datos
$host = 'localhost';
$dbname = 'hotel_reservas';
$user = 'root';
$password = '';

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Verificar si es un POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    try {
        // Consultar la base de datos para el usuario
        $stmt = $pdo->prepare("SELECT contraseña FROM administradores WHERE usuario = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['contraseña'])) {
            echo "Bienvenido, " . htmlspecialchars($username) . "!";
            // Aquí podrías redirigir a un panel de administrador
        } else {
            echo "Credenciales inválidas.";
        }
    } catch (PDOException $e) {
        die("Error al verificar el usuario: " . $e->getMessage());
    }
}
?>
