<?php
// Configuración de la base de datos
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'hotel_reservas';

try {
    // Conexión a la base de datos
    $conn = new mysqli($host, $user, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si se envió una solicitud POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = trim($_POST['regNombre']);
        $apellido = trim($_POST['regApellido']);
        $email = trim($_POST['regEmail']);
        $password = trim($_POST['regPassword']);

        // Validación de campos
        if (empty($nombre) || empty($apellido) || empty($email) || empty($password)) {
            die("Todos los campos son obligatorios.");
        }

        // Verificar si el email ya existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            die("Este correo ya está registrado.");
        }

        $stmt->close();

        // Insertar nuevo usuario
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO usuarios (nombre, apellido, email, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $apellido, $email, $hashedPassword);

        if ($stmt->execute()) {
            echo "Registro exitoso.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
} finally {
    // Cerrar la conexión
    $conn->close();
}
?>