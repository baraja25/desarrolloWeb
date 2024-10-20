let carta = "carta1";

window.addEventListener("load", function() {
    document.getElementById("carta2").style.display = "none";
    document.getElementById("carta3").style.display = "none";
})


function mostrarCarta(cual) {
    document.getElementById(carta).style.display = "none";
    carta = cual;
    document.getElementById(carta).style.display = "block";
}
