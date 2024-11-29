document.querySelectorAll('nav ul li a').forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetSection = document.getElementById(targetId);

        window.scrollTo({
            top: targetSection.offsetTop - 60, // Compensa la altura del header fijo
            behavior: 'smooth'
        });
    });
});
// Añadir al final del archivo index.js
function validarFormulario() {
    const nombre = document.querySelector('input[name="nombre"]').value.trim();
    const apellido = document.querySelector('input[name="apellido"]').value.trim();
    const telefono = document.querySelector('input[name="telefono"]').value.trim();
    const habitacion = document.querySelector('select[name="habitacion"]').value;
    const fechaEntrada = document.querySelector('input[name="fecha_entrada"]').value;
    const fechaSalida = document.querySelector('input[name="fecha_salida"]').value;
    const precio = document.querySelector('select[name="precio"]').value;

    if (!nombre || !apellido || !telefono || !habitacion || !fechaEntrada || !fechaSalida || !precio) {
        alert('Por favor, complete todos los campos');
        return false;
    }

    if (!/^\d{7,}$/.test(telefono)) {
        alert('El teléfono debe contener solo números y al menos 7 dígitos');
        return false;
    }

    const entradaDate = new Date(fechaEntrada);
    const salidaDate = new Date(fechaSalida);

    if (salidaDate <= entradaDate) {
        alert('La fecha de salida debe ser posterior a la fecha de entrada');
        return false;
    }

    return true;
}
// JavaScript para manejar la visualización de formularios
document.getElementById('registerLink').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el enlace recargue la página
    document.getElementById('authPopup').style.display = 'none'; // Oculta el formulario de inicio de sesión
    document.getElementById('registerPopup').style.display = 'block'; // Muestra el formulario de registro
});

document.getElementById('loginLink').addEventListener('click', function(event) {
    event.preventDefault(); // Evita que el enlace recargue la página
    document.getElementById('registerPopup').style.display = 'none'; // Oculta el formulario de registro
    document.getElementById('authPopup').style.display = 'block'; // Muestra el formulario de inicio de sesión
});