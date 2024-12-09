const canvas = document.querySelector('canvas');
const ctx = canvas.getContext('2d');

const $player = document.querySelector('#player');
const $bricks = document.querySelector('#bricks');
const breakSound = new Audio('sounds/break.wav');
const bounceSound = new Audio('sounds/bounce.wav');
const gameOverSound = new Audio('sounds/gameOver.wav');

canvas.width = 448;
canvas.height = 400;

// Variables del estado del juego
let gameStarted = false; // Para controlar el estado inicial del juego
let gameOver = false;
let victory = false; // Para rastrear si se ganó el juego

let score = 0;
let animationFrameId; // Guardará el ID del requestAnimationFrame actual

// Botones
const restartButton = document.querySelector('#restartButton');
const startButton = document.querySelector('#startButton');

// Variables de la pelota
const ballRadius = 4;
let x = canvas.width / 2;
let y = canvas.height - 30;
let dx = 2;
let dy = -2;

// Variables de la paleta
const paddleHeight = 10;
const paddleWidth = 50;
let paddleX = (canvas.width - paddleWidth) / 2;
let paddleY = canvas.height - paddleHeight - 10;
let rightPressed = false;
let leftPressed = false;

// Variables de los ladrillos
const brickRowCount = 6;
const brickColCount = 12;
const brickWidth = 30;
const brickHeight = 14;
const brickPadding = 5;
const brickOffsetTop = 80;
const brickOffsetLeft = 16;

const BRICK_STATUS = { ACTIVE: 1, DESTROYED: 0 };
let bricks = [];

// Función para generar ladrillos
function generateBricks() {
    bricks = [];
    for (let c = 0; c < brickColCount; c++) {
        bricks[c] = [];
        for (let r = 0; r < brickRowCount; r++) {
            const brickX = c * (brickWidth + brickPadding) + brickOffsetLeft;
            const brickY = r * (brickHeight + brickPadding) + brickOffsetTop;
            const randomColor = Math.floor(Math.random() * 8);

            bricks[c][r] = {
                x: brickX,
                y: brickY,
                status: BRICK_STATUS.ACTIVE,
                color: randomColor
            };
        }
    }
}

// Inicializar ladrillos
generateBricks();

// Dibujar la pelota
function drawBall() {
    ctx.beginPath();
    ctx.arc(x, y, ballRadius, 0, 2 * Math.PI);
    ctx.fillStyle = '#fff';
    ctx.fill();
    ctx.closePath();
}

// Dibujar la paleta
function drawPaddle() {
    ctx.drawImage($player, 68, 0, 40, paddleHeight, paddleX, paddleY, paddleWidth, paddleHeight);
}

// Dibujar ladrillos
function drawBricks() {
    for (let c = 0; c < brickColCount; c++) {
        for (let r = 0; r < brickRowCount; r++) {
            const brick = bricks[c][r];
            if (brick.status === BRICK_STATUS.ACTIVE) {
                const clipX = brick.color * 32;
                ctx.drawImage($bricks, clipX, 0, 31, 14, brick.x, brick.y, brickWidth, brickHeight);
            }
        }
    }
}

// Detectar colisiones
function collisionDetection() {
    for (let c = 0; c < brickColCount; c++) {
        for (let r = 0; r < brickRowCount; r++) {
            const brick = bricks[c][r];
            if (brick.status === BRICK_STATUS.ACTIVE) {
                if (
                    x > brick.x &&
                    x < brick.x + brickWidth &&
                    y > brick.y &&
                    y < brick.y + brickHeight
                ) {
                    dy = -dy;
                    brick.status = BRICK_STATUS.DESTROYED;
                    score += 10;
                    breakSound.play();
                }
            }
        }
    }
}

// Movimiento de la pelota
function ballMovement() {
    if (x + dx > canvas.width - ballRadius || x + dx < ballRadius) {
        dx = -dx;
        bounceSound.play();
    }
    if (y + dy < ballRadius) {
        dy = -dy;
        bounceSound.play();
    }
    if (y + dy > paddleY && x > paddleX && x < paddleX + paddleWidth) {
        dy = -dy;
        bounceSound.play();
    } else if (y + dy > canvas.height - ballRadius) {
        gameOver = true;
        gameOverSound.play();
    }

    if (!gameOver) {
        x += dx;
        y += dy;
    }
}

// Movimiento de la paleta
function paddleMovement() {
    if (rightPressed && paddleX < canvas.width - paddleWidth) {
        paddleX += 7;
    } else if (leftPressed && paddleX > 0) {
        paddleX -= 7;
    }
}

// Limpiar el canvas
function cleanCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

// Mostrar pantalla de inicio
function drawStartScreen() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.5)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = "white";
    ctx.font = "40px Verdana";
    ctx.textAlign = "center";
    ctx.fillText("Pelotazo Destructivo", canvas.width / 2, canvas.height / 2 - 20);
    ctx.font = "24px Arial";
    ctx.fillText("Haz clic en el botón para comenzar", canvas.width / 2, canvas.height / 2 + 20);
}

function drawVictoryScreen() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.5)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = "white";
    ctx.font = "48px Arial";
    ctx.textAlign = "center";
    ctx.fillText("¡Victoria!", canvas.width / 2, canvas.height / 2 - 20);
    ctx.font = "24px Arial";
    ctx.fillText("Haz clic en el botón para reiniciar", canvas.width / 2, canvas.height / 2 + 20);
    restartButton.style.display = "block";
}


// Función principal del juego
function draw() {
    cleanCanvas();

    if (victory) {
        drawVictoryScreen();
        return; // Detiene el ciclo de animación si se ganó
    }

    if (!gameOver) {
        drawScore();
        drawBall();
        drawPaddle();
        drawBricks();
        collisionDetection();
        ballMovement();
        paddleMovement();

        // Verificar si se ha ganado
        if (checkVictory()) {
            victory = true;
        }
    } else {
        drawGameOver();
        return; // Detiene el ciclo si el juego termina
    }

    animationFrameId = requestAnimationFrame(draw);
}



// Iniciar el juego
function startGame() {
    if (!gameStarted) {
        gameStarted = true;
        startButton.style.display = "none";
        draw();
    }
}

// Reiniciar el juego
function restartGame() {
    if (animationFrameId) {
        cancelAnimationFrame(animationFrameId); // Detén el bucle previo
    }

    gameOver = false;
    victory = false; // Reinicia el estado de victoria
    score = 0;
    x = canvas.width / 2;
    y = canvas.height - 30;
    dx = 2; // Reinicia la velocidad horizontal
    dy = -2; // Reinicia la velocidad vertical
    paddleX = (canvas.width - paddleWidth) / 2;
    generateBricks();
    restartButton.style.display = "none";
    draw(); // Comienza un nuevo ciclo de animación
}


function checkVictory() {
    for (let c = 0; c < brickColCount; c++) {
        for (let r = 0; r < brickRowCount; r++) {
            if (bricks[c][r].status === BRICK_STATUS.ACTIVE) {
                return false; // Hay al menos un ladrillo activo
            }
        }
    }
    return true; // Todos los ladrillos han sido destruidos
}


// Iniciar eventos
function initEvents() {
    document.addEventListener('keydown', (e) => {
        if (e.key === "ArrowRight" || e.key === "d") rightPressed = true;
        if (e.key === "ArrowLeft" || e.key === "a") leftPressed = true;
    });
    document.addEventListener('keyup', (e) => {
        if (e.key === "ArrowRight" || e.key === "d") rightPressed = false;
        if (e.key === "ArrowLeft" || e.key === "a") leftPressed = false;
    });
    restartButton.addEventListener("click", restartGame);
    startButton.addEventListener("click", startGame);
}

function drawScore() {
    ctx.font = "16px Arial";
    ctx.fillStyle = "white";
    ctx.fillText(`Puntuación: ${score}`, 60, 20);
}

function drawGameOver() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.5)";
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = "white";
    ctx.font = "48px Arial";
    ctx.textAlign = "center";
    ctx.fillText("Game Over", canvas.width / 2, canvas.height / 2 - 20);
    ctx.font = "24px Arial";
    ctx.fillText("Haz clic en el botón para reiniciar", canvas.width / 2, canvas.height / 2 + 20);
    restartButton.style.display = "block";
}

// Inicializar
initEvents();
drawStartScreen();
