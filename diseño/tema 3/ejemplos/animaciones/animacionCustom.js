const canvas = document.getElementById("myCanvas");
const ctx = canvas.getContext("2d");
const image = new Image();
image.src = "ibai.png";
image.width = 100;
image.height = 110;

let x = 100; //posicion inicial
let y = 100; //posicion inicial
let dx = 2; //velocidad inicial
let dy = 2; //velocidad inicial


image.onload = function () {
    requestAnimationFrame(actualizar);
}

function actualizar() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // limpiar la imagen
    ctx.drawImage(image, x, y); //dibujar la imagen


    //actualizar la posicion
    x += dx;
    y += dy;

    //comprobar colision
    if (x + image.width > canvas.width || x < 0) {
        dx = -dx; // cambiar la direccion en el eje x
    }

    if (y + image.height > canvas.height || y < 0) {
        dy = -dy; // cambiar la direccion en el eje y
    }

    requestAnimationFrame(actualizar);
}