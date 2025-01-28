// 1. Validación de Campos (Nombre con mínimo 3 caracteres)
// HTML: <input id="nombre" type="text">
const inputNombre = document.getElementById('nombre');
const errorNombre = document.querySelector('#errorNombre');

inputNombre.addEventListener('input', () => {
    if (inputNombre.value.length < 3) {
        errorNombre.textContent = "Mínimo 3 caracteres";
    } else {
        errorNombre.textContent = "";
    }
});
//2. Gestión Individualizada de Errores
function validarCampo(campo, min) {
    const error = document.getElementById(`error${campo.id}`);
    if (campo.value.length < min) {
        error.textContent = `Error en ${campo.id}: Mínimo ${min} caracteres`;
        return false;
    }
    error.textContent = "";
    return true;
}

// 3. Selección de Elementos
// Por ID
const btn = document.getElementById('miBoton');

// Por Clase
const errores = document.getElementsByClassName('error');

// querySelector
const primerError = document.querySelector('.error');

// querySelectorAll
const todosErrores = document.querySelectorAll('.error');

// 4. Cambio de Contenido
// textContent (solo texto)
document.getElementById('titulo').textContent = "Nuevo título";

// innerHTML (con HTML)
document.querySelector('.contenido').innerHTML = "<strong>Texto</strong> con formato";

// setAttribute
document.getElementById('imagen').setAttribute('src', 'nueva-imagen.jpg');

// style
document.body.style.backgroundColor = "#f0f0f0";

// classList
document.getElementById('mensaje').classList.add('activo');

// 5. Manipulación del DOM
// Agregar elemento
const nuevoDiv = document.createElement('div');
nuevoDiv.textContent = "Soy nuevo!";
document.body.appendChild(nuevoDiv);

// Eliminar elemento
const elementoAEliminar = document.querySelector('.viejo');
elementoAEliminar.parentNode.removeChild(elementoAEliminar);

// 6. Eventos
// Asociar evento clic
document.getElementById('btn').addEventListener('click', (e) => {
    e.preventDefault(); // Prevenir acción por defecto
    e.stopPropagation(); // Detener propagación
    console.log("Clickeado!");
});

// Delegación de eventos (para elementos dinámicos)
document.getElementById('lista').addEventListener('click', (e) => {
    if (e.target.classList.contains('item')) {
        console.log("Elemento de lista clickeado");
    }
});

// 7. BOM
// Dimensiones ventana
console.log(`Ancho: ${window.innerWidth}, Alto: ${window.innerHeight}`);

// URL actual
console.log("URL:", window.location.href);

// User Agent
console.log("Navegador:", navigator.userAgent);

// Redirección
window.location.href = "https://google.com";

// Historial
history.pushState({}, "", "/nueva-ruta");

// Temporizadores
setTimeout(() => console.log("Hola después de 2 segundos"), 2000);
setInterval(() => console.log("Cada 1 segundo"), 1000);

// Ventana emergente
alert("¡Esto es un alert!");

// 8. Ejemplo Completo de Validación de Formulario
// HTML: <form id="miForm"><input type="text" id="usuario"></form>
document.getElementById('miForm').addEventListener('submit', (e) => {
    e.preventDefault();
    const usuario = document.getElementById('usuario').value;

    if (usuario.length < 5) {
        document.getElementById('errorUsuario').textContent = "Mínimo 5 caracteres";
        return;
    }

    // Envío exitoso
    alert("Formulario válido!");
});

// 9. Delegación de Eventos (Ejemplo Lista Dinámica)
// HTML: <ul id="lista"><li class="item">Item 1</li></ul>
document.getElementById('lista').addEventListener('click', (e) => {
    if (e.target && e.target.matches('li.item')) {
        e.target.style.textDecoration = "line-through";
    }
});

// 10. Temporizadores y Animación
let posicion = 0;
const elemento = document.getElementById('animar');

const animacion = setInterval(() => {
    posicion += 5;
    elemento.style.left = posicion + "px";

    if (posicion > 300) {
        clearInterval(animacion);
    }
}, 50);