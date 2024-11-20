const canvas = new fabric.Canvas("canvas");

var rect = new fabric.Rect({
    left: 100,
    top: 100,
    width: 200,
    height: 200,
    fill: "gold",
});

canvas.add(rect);


inputfile.onchange = (archivo) => {
    const file = archivo.target.files[0];
    const url = URL.createObjectURL(file);
    const imgNode = new Image();
    imgNode.src = url;
    imgNode.onload = () => {
        const img = new fabric.Image(imgNode, {
            left: 100,
            top: 100,
        });
        canvas.add(img);
    };
};

btn.onclick = () => {
    const dataURL = canvas.toDataURL("image/png");
    const a = document.createElement("a");
    a.download = "Mi composicion.png";
    a.href = dataURL;
    a.click();
};