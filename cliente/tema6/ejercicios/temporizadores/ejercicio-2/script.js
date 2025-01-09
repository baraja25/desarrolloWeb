let intervaloColor;
const startButton = document.querySelector('#start');
const stopButton = document.querySelector('#stop');

// genera un color aleatorio basado en hexadecimal
function generarColorAleatorio() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
// Inicia el bucle de cambiar colores
function startColorChange() {
    startButton.disabled = true;
    stopButton.disabled = false;

    intervaloColor = setInterval(() => {
        document.body.style.backgroundColor = generarColorAleatorio();
    }, 1000)
}

// Para el timer
function stopColorChange() {
    clearInterval(intervaloColor);
    startButton.disabled = false;
    stopButton.disabled = true;
}

startButton.addEventListener('click', startColorChange);
stopButton.addEventListener('click', stopColorChange);