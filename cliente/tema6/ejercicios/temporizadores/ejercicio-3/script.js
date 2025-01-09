
let timerId;
const messageElement = document.querySelector('#message');
const startButton = document.querySelector('#start');
const cancelButton = document.querySelector('#stop');

function startTimer() {
    let countdown = 10; // Inicializa el contador en 10
    messageElement.textContent = "Temporizador iniciado. Esperando 10 segundos...";
    startButton.disabled = true; // Deshabilitar el botón de inicio
    cancelButton.disabled = false; // Habilitar el botón de cancelación

    timerId = setInterval(() => {
        if (countdown >= 0) {
            messageElement.textContent = `Temporizador iniciado. Esperando ${countdown} segundos...`;
            countdown--; // Decrementar el contador
        }
        if (countdown < 0) {
            clearInterval(timerId); // Detener el intervalo
            messageElement.textContent = "¡Tiempo terminado!";
            startButton.disabled = false; // Habilitar el botón de inicio
            cancelButton.disabled = true; // Deshabilitar el botón de cancelación
        }
    }, 1000); // Actualiza cada segundo
}

// Función para cancelar el temporizador
function cancelTimer() {
    clearInterval(timerId);
    messageElement.textContent = "Temporizador cancelado.";
    startButton.disabled = false; // Habilitar el botón de inicio
    cancelButton.disabled = true; // Deshabilitar el botón de cancelación
}

// Asignar eventos a los botones
startButton.addEventListener('click', startTimer);
cancelButton.addEventListener('click', cancelTimer);