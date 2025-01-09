let timerId;

const messageElement = document.querySelector('#message');
const startButton = document.querySelector('#start');
const cancelButton = document.querySelector('#cancel');

function startTimer() {
    messageElement.textContent = "Temporizador iniciado. Esperando 5 segundos...";
    startButton.disabled = true; //desahibilitar el boton de inicio
    cancelButton.disabled = false; //habilitar el boton de cancelacion

    timerId = setTimeout(() => {
        messageElement.textContent = "Tiempo terminado";
        startButton.disabled = false;
        cancelButton.disabled = true;
    }, 5000);
}

function cancelTimer() {
    clearTimeout(timerId);
    messageElement.textContent = "Temporizador cancelado";
    startButton.disabled = false;
    cancelButton.disabled = true;
}

startButton.addEventListener("click", startTimer);
cancelButton.addEventListener("click", cancelTimer);