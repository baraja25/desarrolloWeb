var canvas , ctx;


window.onload = function () {
    canvas = document.querySelector("#myCanvas");
    ctx = canvas.getContext("2d");

    ctx.fillStyle = "gold";
    ctx.fillRect(20, 20, 180, 180);
    ctx.clearRect(60, 60, 50, 50);


    ctx.strokeStyle = "red";
    ctx.lineWidth = 4;
    ctx.strokeRect(60,60,50,50);

    ctx.font = "Bold 20px Tahoma";
    ctx.textAlign = "center";
    ctx.fillStyle = "blue";
    ctx.fillText("Diseño Interfaces", 200, 200);


    canvas = document.querySelector("#myCanvas2");
    ctx2 = canvas.getContext("2d");


    ctx2.beginPath();
    ctx2.arc(200, 200, 100, 0, Math.PI/2, false);
    ctx2.lineTo(200, 200);
    ctx2.closePath();

    ctx2.fillStyle = "#050505";
    ctx2.fill();
}