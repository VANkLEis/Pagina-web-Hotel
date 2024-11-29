<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Reserva</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>

<section id="formulario-reserva">
    <h2>Hacer Reserva</h2>

    <?php
    // Mostrar mensaje de éxito si está presente en la URL
    if (isset($_GET['mensaje'])) {
        echo "<p style='color: green;'>" . htmlspecialchars($_GET['mensaje']) . "</p>";
    }
    ?>

    <form action="reservas.php" method="POST" onsubmit="return validarFormulario()">
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido" placeholder="Apellido" required>
        <input type="tel" name="telefono" placeholder="Teléfono" required>
        <select name="habitacion" required>
            <option value="">Selecciona Habitación</option>
            <option value="Individual">Habitación Individual</option>
            <option value="Doble">Habitación Doble</option>
            <option value="Familiar">Habitación Familiar</option>
            <option value="Suite">Suite</option>
        </select>
        <label>Fecha de Entrada:</label>
        <input type="date" name="fecha_entrada" required>
        <label>Fecha de Salida:</label>
        <input type="date" name="fecha_salida" required>
        <select name="precio" required>
            <option value="">Selecciona Precio</option>
            <option value="50000">Individual - $50.000</option>
            <option value="90000">Doble - $90.000</option>
            <option value="150000">Familiar - $150.000</option>
            <option value="200000">Suite - $200.000</option>
        </select>
        <button type="submit">Reservar</button>
    </form>
</section>

<script>
    function validarFormulario() {
        // Aquí puedes agregar validaciones adicionales si es necesario
        return true; // Cambia esto según la validación n
    }
</script>
</body>
</html>