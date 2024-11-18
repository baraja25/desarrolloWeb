var canvas, ctx;

var img = new Image();

window.onload = function () {
    
    canvas = document.querySelector("#myCanvas");
    ctx = canvas.getContext("2d");
    
    
    img.src = "./ibai.png";
    ctx.drawImage(img, 0, 0);


}


