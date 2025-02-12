// Ejercicio 1: Crear una cookie
function crearCookie(nombre, valor, diasExpiracion) {
    const fecha = new Date();
    fecha.setTime(fecha.getTime() + (diasExpiracion * 24 * 60 * 60 * 1000));
    const expiracion = "expires=" + fecha.toUTCString();
    document.cookie = nombre + "=" + valor + ";" + expiracion + ";path=/";
}

const nombreUsuario = prompt("Introduce tu nombre:");
crearCookie("usuario", nombreUsuario, 7);
console.log("Cookie creada correctamente");

// Ejercicio 2: Leer y mostrar una cookie
function obtenerCookie(nombre) {
    const nombreEQ = nombre + "=";
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let cookie = cookies[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(nombreEQ) === 0) {
            return cookie.substring(nombreEQ.length, cookie.length);
        }
    }
    return "";
}

const valorCookie = obtenerCookie("usuario");
if (valorCookie) {
    alert("Valor de la cookie usuario: " + valorCookie);
} else {
    alert("No se encontró la cookie usuario");
}

// Ejercicio 3: Modificar una cookie
if (valorCookie) {
    const nuevoNombreUsuario = prompt("Introduce un nuevo nombre:");
    crearCookie("usuario", nuevoNombreUsuario, 7);
    console.log("Cookie modificada correctamente. Nuevo valor: " + nuevoNombreUsuario);
}

// Ejercicio 4: Eliminar una cookie
function eliminarCookie(nombre) {
    crearCookie(nombre, "", -1);
}

eliminarCookie("usuario");
if (!obtenerCookie("usuario")) {
    console.log("Cookie eliminada correctamente");
} else {
    console.log("No se pudo eliminar la cookie");
}