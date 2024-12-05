const canvas = document.querySelector('canvas');
const ctx = canvas.getContext('2d');

const $player = document.querySelector('#player');
const $bricks = document.querySelector('#bricks');

canvas.width = 448;
canvas.height = 400;
/* Estado del juego */
let gameOver = false;
const restartButton = document.querySelector('#restartButton');
/* Variables Pelota */
const ballRadius = 4;
// posicion pelota
let x = canvas.width / 2;
let y = canvas.height - 30;
/* Velocidad pelota */
let dx = 5;
let dy = -5;
/* Variables de la paleta */
const paddleHeight = 10;
const paddleWidth = 50;

let paddleX = (canvas.width - paddleWidth) / 2;
let paddleY = (canvas.height - paddleHeight - 10);

let rightPressed = false;
let leftPressed = false;

/* Variables de bricks */

const brickRowCount = 6;
const brickColCount = 13;
const brickWidth = 30;
const brickHeight = 14;
const brickPadding = 2;
const brickOffsetTop = 80;
const brickOffsetLeft = 16;
const bricks = [];

const BRICK_STATUS = {
    ACTIVE: 1,
    DESTROYED: 0
}

// Función para generar ladrillos aleatorios
function generateBricks() {
    for (let c = 0; c < brickColCount; c++) {
        bricks[c] = [];
        for (let r = 0; r < brickRowCount; r++) {
            // calcular la posicion del ladrillo
            const brickX = c * (brickWidth + brickPadding) + brickOffsetLeft;
            const brickY = r * (brickHeight + brickPadding) + brickOffsetTop;
            // asignar color aleatorio
            const random = Math.floor(Math.random() * 8);

            bricks[c][r] = {
                x: brickX,
                y: brickY,
                status: BRICK_STATUS.ACTIVE,
                color: random
            };
        }
    }
}
//inicializar los ladrillos
generateBricks();


function drawBall() {
    ctx.beginPath();
    ctx.arc(x, y, ballRadius, 0, 2 * Math.PI);
    ctx.fillStyle = '#fff';
    ctx.fill();
    ctx.closePath();
}

function drawPaddle() {
    // ctx.fillStyle = '#09f';
    // ctx.fillRect(
    //     paddleX, // coordenada x
    //     paddleY, // coordenada y
    //     paddleWidth, // el ancho del dibujo
    //     paddleHeight // el alto del dibujo
    // )

    ctx.drawImage(
        $player, //imagen
        68, // coordenadas de recorte
        0, // coordenadas de recorte
        40, // tamaño recorte
        paddleHeight, // tamaño de recorte
        paddleX,    //posicion X del dibujo
        paddleY,    //posicion y del dibujo
        paddleWidth,    //ancho del dibujo
        paddleHeight    //alto del dibujo
    );
}

function drawBricks() {
    for (let c = 0; c < brickColCount; c++) {
        for (let r = 0; r < brickRowCount; r++) {
            const currentBrick = bricks[c][r];
            if (currentBrick.status === BRICK_STATUS.DESTROYED) continue;


            const clipX = currentBrick.color * 32;

            ctx.drawImage(
                $bricks,
                clipX,
                0,
                31,
                14,
                currentBrick.x,
                currentBrick.y,
                brickWidth,
                brickHeight
            )
        }
    }
}


function collisionDetection() {
    for (let c = 0; c < brickColCount; c++) {
        for (let r = 0; r < brickRowCount; r++) {
            const currentBrick = bricks[c][r];
            if (currentBrick.status === BRICK_STATUS.DESTROYED) continue;


            // Verificar si la pelota colisiona con el ladrillo
            const isBallCollidingX = x + ballRadius > currentBrick.x && x - ballRadius < currentBrick.x + brickWidth;
            const isBallCollidingY = y + ballRadius > currentBrick.y && y - ballRadius < currentBrick.y + brickHeight;
            if (isBallCollidingX && isBallCollidingY) {
                dy = -dy;
                currentBrick.status = BRICK_STATUS.DESTROYED;
            }
        }
    }
}

function ballMovement() {
    //rebota pared derecha
    if (
        x + dx > canvas.width - ballRadius ||
        x + dx < ballRadius
    ) {
        dx = -dx;
    }
    // rebotar pared izquierda
    if (y + dy < ballRadius) {
        dy = -dy;
    }


    const ballxSameAsPaddle = // comprueba si la pelota esta en la misma coordenada que la pala
        x > paddleX &&
        x < paddleX + paddleWidth;

    const ballTouchingPaddle =
        y + dy > paddleY;

    if (ballxSameAsPaddle && ballTouchingPaddle) {
        dy = -dy; // cambia la direccion de la pelota
    } else if (y + dy > canvas.width - ballRadius) {
        gameOver = true;
    }
    //mover la pelota

    if (!gameOver) {
        x += dx;
        y += dy;
    }
}

function paddleMovement() {
    if (rightPressed && paddleX < canvas.width - paddleWidth) {
        paddleX += 7;
    } else if (leftPressed && paddleX > 0) {
        paddleX -= 7;
    }
}

function cleanCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function initEvents() {
    document.addEventListener('keydown', keyDownHandler);
    document.addEventListener('keyup', keyUpHandler);
    // Evento de clic para el botón de reinicio
    restartButton.addEventListener("click", restartGame);

    function keyDownHandler(event) {
        const {key} = event;
        if (key === 'Right' || key === 'ArrowRight' || key === 'd') {
            rightPressed = true;
        } else if (key === 'Left' || key === 'ArrowLeft' || key === 'a') {
            leftPressed = true;
        }
    }

    function keyUpHandler(event) {
        const {key} = event;
        if (key === 'Right' || key === 'ArrowRight' || key === 'd') {
            rightPressed = false;
        } else if (key === 'Left' || key === 'ArrowLeft' || key === 'a') {
            leftPressed = false;
        }
    }


}

// Función para reiniciar el juego
function restartGame() {
    gameOver = false; // Reiniciar el estado del juego
    x = canvas.width / 2; // Reiniciar la posición de la pelota
    y = canvas.height - 30;
    paddleX = (canvas.width - paddleWidth) / 2; // Reiniciar la posición de la pala
    restartButton.style.display = "none"; // Ocultar el botón de reinicio
    generateBricks(); // Generar nuevos ladrillos
}

function drawGameOver() {
    ctx.fillStyle = "rgba(0, 0, 0, 0.5)"; // Fondo semi-transparente
    ctx.fillRect(0, 0, canvas.width, canvas.height); // Dibuja el fondo

    ctx.fillStyle = "white"; // Color del texto
    ctx.font = "48px Arial"; // Estilo de fuente
    ctx.textAlign = "center"; // Alinear el texto al centro
    ctx.fillText("Game Over", canvas.width / 2, canvas.height / 2 - 20); // Dibuja el texto
    ctx.font = "24px Arial"; // Estilo de fuente para el botón
    ctx.fillText("Haz clic en el botón para reiniciar", canvas.width / 2, canvas.height / 2 + 20); // Mensaje ctx.fillText("Haz clic en el botón para reiniciar", canvas.width / 2, canvas.height / 2 + 20); // Mensaje

    restartButton.style.display = "block"; // Mostrar el botón de reinicio
}

function draw() {
    cleanCanvas();
    if (!gameOver) {
        drawBall();
        drawPaddle();
        drawBricks();
        //drawScore();

        //colisiones y movimientos
        collisionDetection();
        ballMovement();
        paddleMovement();
    } else {
        drawGameOver();
    }
    window.requestAnimationFrame(draw);// se llama constantemente

}

initEvents();
draw();