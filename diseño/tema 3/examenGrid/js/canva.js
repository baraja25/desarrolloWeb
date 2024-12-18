var canvas = document.getElementById("miCanvas");
var ctx = canvas.getContext("2d");
//circulo
ctx.beginPath();
ctx.arc(250, 250, 50, 0, 2 * Math.PI);
ctx.strokeStyle = "black";
ctx.lineWidth = 5;
ctx.stroke();
ctx.closePath();
//esto se supone que deberia ser un cuarto de circulo
ctx.beginPath();
ctx.arc(250, 350, 50, 0, Math.PI * 2);
ctx.strokeStyle = "black";
ctx.lineWidth = 5;
ctx.stroke();
ctx.closePath();
//la cola
ctx.beginPath();
ctx.moveTo(300, 350);
ctx.lineTo(350, 350);
ctx.lineTo(350, 280);
ctx.lineTo(400, 280)
ctx.strokeStyle = "black";
ctx.lineWidth = 5;
ctx.stroke();
ctx.closePath();