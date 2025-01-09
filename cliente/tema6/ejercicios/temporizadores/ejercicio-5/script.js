let timerId;
let seconds = 0;
const timerElement = document.getElementById('timer');
const startButton = document.getElementById('startButton');
const stopButton = document.getElementById('stopButton');
const resetButton = document.getElementById('resetButton');

// Función para iniciar el temporizador
function startTimer() {
    startButton.disabled = true;
    stopButton.disabled = false;
    resetButton.disabled = true;

    timerId = setInterval(() => {
        seconds++;
        timerElement.textContent = seconds;
    }, 1000);
}

// Función para detener el temporizador
function stopTimer() {
    clearInterval(timerId);
    startButton.disabled = false;
    stopButton.disabled = true;
    resetButton.disabled = false;
}

// Función para reiniciar el temporizador
function resetTimer() {
    clearInterval(timerId);
    seconds = 0; // Reiniciar los segundos
    timerElement.textContent = seconds;
    startButton.disabled = false;
    stopButton.disabled = true;
    resetButton.disabled = true;
}

// Asignar eventos a los botones
startButton.addEventListener('click', startTimer);
stopButton.addEventListener('click', stopTimer);
resetButton.addEventListener('click', resetTimer);